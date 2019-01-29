<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

define("AUTO_REPLY_DATA_KEY", 'auto_reply_data');

class Chat_auto_reply_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}

	public function getChatAutoReplyList() {
		$this->db->from ( 'smc_chat_auto_reply' );
		$this->db->select ( '*' );
		$this->db->order_by ( 'id', 'DESC' );
		// $this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		
		return $query->result_array ();
	}

	public function insertAutoReply($data) {
		$ret = $this->db->insert ( 'smc_chat_auto_reply', $data );
		
		$this->clearRedis();
		return $ret;
	}

	public function updateAutoReply($id, $newData) {
		$this->db->where('id', $id);
		$ret = $this->db->update ( 'smc_chat_auto_reply', $newData );
		
		$this->clearRedis();
		return $ret;
	}

	public function deleteAutoReply($id) {
		// 清空redis
		$this->clearRedis();

		$this->db->where ( 'id', $id );
		return $this->db->delete ( 'smc_chat_auto_reply' );
	}
	
	private function clearRedis()
	{
		// 清空redis
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->del(AUTO_REPLY_DATA_KEY);
	}
}
