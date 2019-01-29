<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Packetupgrade_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getPackageList($select_tag) {
		$this->db->from ( 'smc_version' );
		if ($select_tag) {
			$this->db->where ( 'packagename', $select_tag );
		}
		$this->db->order_by ( 'packagename' );
		$this->db->order_by ( 'latestVersion', 'DESC' );
		$query = $this->db->get ();

		$result_ary = $query->result_array();
		
		// 先找到每个tag在allChannelList中的index
		$tagIndex = array();
		$tagChannelId = array();
		$allChannelList = $this->config->item('allChannelList');
		$allChannelCount = count($allChannelList);
		for ($i = 0; $i < $allChannelCount; $i++)
		{
			$c = $allChannelList[$i];
			$tagIndex[$c['tag']] = $i;
			$tagChannelId[$c['tag']] = $c['channelId'];
		}
		
		// 设置每一个结果都把index设置一下
		$resultCount = count($result_ary);
		for ($i = 0; $i < $resultCount; $i++)
		{
			if (!isset($tagIndex[$result_ary[$i]['packagename']]))
			{
				$result_ary[$i]['i'] = -1;
				$result_ary[$i]['channelId'] = -1;
			}
			else
			{
				$result_ary[$i]['i'] = $tagIndex[$result_ary[$i]['packagename']];
				$result_ary[$i]['channelId'] = $tagChannelId[$result_ary[$i]['packagename']];
			}
		}

		usort($result_ary, array('Packetupgrade_model', 'sortByTagAndVersion'));
		return $result_ary;
	}
	
	// 根据tag和版本号来排序
	static function sortByTagAndVersion($a, $b)
	{
		if ($a['i'] > $b['i'])
		{
			return 1;
		}
		else if ($a['i'] < $b['i'])
		{
			return -1;
		}
		else
		{
			return $b['latestVersion'] - $a['latestVersion'];
		}
	}
	
	public function insertPacket($data) {
		return $this->db->insert ( 'smc_version', $data );
	}
	public function updatePacket($id, $data) {
		$this->db->where ( 'id', $id );
		return $this->db->update ( 'smc_version', $data );
	}

	public function removePackage($id) {
		$this->db->where(array('id' => $id));
		return $this->db->delete ( 'smc_version' );
	}

	public function getPackage($id) {
		$this->db->from ( 'smc_version' );
		$this->db->where ( 'id', $id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
}
