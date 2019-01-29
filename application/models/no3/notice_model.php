<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Notice_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getNoticeNum() {
		$this->db->from ( 'smc_sys_notice' );
		return $this->db->count_all_results ();
	}
	public function getNoticeList($tag, $start, $per) {
		$this->db->from ( 'smc_sys_notice' );
		if ($tag) {
			$this->db->where ( 'tag', $tag );
		}
		$this->db->order_by ( 'add_time', 'DESC' );
		$this->db->limit ( $per, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}

	public function insertNotice($data) {
		// 构建插入数据库的内容
		$batchInsertData = array();
		foreach ($data['tags'] as $v)
		{
			$batchInsertData[] = array(
					'title' => $data['title'],
					'content' => $data['content'],
					'status' => $data['status'],
					'add_time' => $data['add_time'],
					'summary' => $data['summary'],
					'is_carousel' => $data['is_carousel'],
					'tag' => $v,
					);
		}

		return $this->db->insert_batch ( 'smc_sys_notice', $batchInsertData );
	}

	public function updateNotice($id, $data) {
		$this->db->where ( 'id', $id );
		$this->db->delete('smc_sys_notice');
		// return $this->db->update ( 'smc_sys_notice', $data );

		// 构建插入数据库的内容
		$batchInsertData = array();
		foreach ($data['tags'] as $v)
		{
			$batchInsertData[] = array(
					'title' => $data['title'],
					'content' => $data['content'],
					'status' => $data['status'],
					'add_time' => $data['add_time'],
					'summary' => $data['summary'],
					'is_carousel' => $data['is_carousel'],
					'tag' => $v,
					);
		}

		return $this->db->insert_batch ( 'smc_sys_notice', $batchInsertData );
	}
	public function getNotice($id) {
		$this->db->from ( 'smc_sys_notice' );
		$this->db->where ( 'id', $id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function delNotice($id) {
		$this->db->where ( 'id', $id );
		return $this->db->delete ( 'smc_sys_notice' );
	}
	
	/**
	 * 批量删除
	 * @param array $idArray
	 */
	public function batchDelete ( $idArray )
	{
		$this->db->where_in ( 'id', $idArray );
		return $this->db->delete ( 'smc_sys_notice' );
	}
}