<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Chat_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function insertMessage($data) {
		if ($this->db->insert ( 'smc_chat', $data )) {
			$data1 ['user_update_time'] = $data ['add_time'];
			$data1 ['update_time'] = $data ['add_time'];
			$data1 ['is_user_reply'] = 1;
			$this->db->where ( 'user_id', $data ['user_id'] );
			return $this->db->update ( 'smc_chat_session', $data1 );
		} else {
			return 0;
		}
	}
	public function createChatSession($user_id) {
		$this->db->select ( 'id,admin_id,user_update_time' );
		$this->db->from ( 'smc_chat_session' );
		$this->db->where ( 'user_id', $user_id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ($query->num_rows () == 0) {
			$data ['user_id'] = $user_id;
			$data ['admin_id'] = $this->selectChatAdmin ();
			$data ['update_time'] = 0;
			return $this->db->insert ( 'smc_chat_session', $data );
		}
		
		if ($query->row ()->admin_id == 0) {
			$data ['admin_id'] = $this->selectChatAdmin ();
			if ($data ['admin_id'] == 0) {
				return 1;
			}
			$this->db->where ( 'user_id', $user_id );
			return $this->db->update ( 'smc_chat_session', $data );
		}
		
		if (time () - $query->row ()->user_update_time < 2) {
			return 'quick';
		}
		
		return 1;
	}
	public function selectChatAdmin() {
		$admin_ary = array ();
		$this->db->select ( 'id' );
		$this->db->from ( 'smc_admin' );
		$this->db->where ( 'is_chat', 1 );
		$this->db->where ( 'status', 1 );
		$query = $this->db->get ();
		if ($query->num_rows () == 0) {
			return 0;
		}
		
		foreach ( $query->result () as $row ) {
			array_push ( $admin_ary, $row->id );
		}
		
		if (count ( $admin_ary ) == 1) {
			return $admin_ary [0];
		}
		
		return $admin_ary [array_rand ( $admin_ary )];
	}
	public function getChatContentList($user_id, $tmp_time = '') {
		$this->db->select ( 'c.content,c.add_time,c.user_id,c.admin_id,a.admin_name' );
		$this->db->from ( 'smc_chat c' );
		$this->db->join ( 'smc_admin a', 'a.id = c.admin_id', 'left' );
		$this->db->where ( 'c.user_id', $user_id );
		if ($tmp_time) {
			$this->db->where ( 'c.add_time > ', $tmp_time );
		}
		$this->db->order_by ( 'c.id', 'DESC' );
		$this->db->limit ( 50 );
		$query = $this->db->get ();
		$return_ary = $query->result_array ();
		return array_reverse ( $return_ary );
	}
}