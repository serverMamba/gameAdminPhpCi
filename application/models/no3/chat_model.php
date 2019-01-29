<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Chat_model extends CI_Model {
	var $super_chat_admin_ary = array (
			1,
			9,
			22,
			16 
	);
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getSuperAdminAry() {
		return $this->super_chat_admin_ary;
	}
	public function getSelectAdminList($admin_id) {
		$this->db->from ( 'smc_admin' );
		$this->db->where ( 'is_chat', 1 );
		$this->db->where ( 'status', 1 );
		$this->db->where ( 'id <>', $admin_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'role_id', 14 );
		} else {
			$this->db->where ( 'role_id <>', 14 );
		}
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function updateSession($user_id, $data) {
		$this->db->where ( 'user_id', $user_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		return $this->db->update ( 'smc_chat_session', $data );
	}
	public function batchUpdateSession($admin_id, $data, $covert_num) {
		$this->db->select ( 'id' );
		$this->db->from ( 'smc_chat_session' );
		$this->db->where ( 'admin_id', $admin_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		$this->db->where ( 'is_user_reply', 1 );
		$this->db->order_by ( 'user_update_time', 'ASC' );
		$this->db->limit ( $covert_num );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$this->db->where ( 'id', $row->id );
				$this->db->update ( 'smc_chat_session', $data );
			}
		}
		return true;
	}
	public function insertMessage($data) {
		if ($this->db->insert ( 'smc_chat', $data )) {
			$data1 ['update_time'] = $data ['add_time'];
			$data1 ['is_user_reply'] = 0;
			$this->db->where ( 'user_id', $data ['user_id'] );
			if ($this->session->userdata ( 'role_id' ) == 14) {
				$this->db->where ( 'is_recharge', 1 );
			} else {
				$this->db->where ( 'is_recharge', 0 );
			}
			return $this->db->update ( 'smc_chat_session', $data1 );
		} else {
			return 0;
		}
	}
	public function insertRMessage($data) {
		if ($this->db->insert ( 'smc_chat', $data )) {
			$data1 ['update_time'] = $data ['add_time'];
			$data1 ['is_user_reply'] = 0;
			$this->db->where ( 'user_id', $data ['user_id'] );
			$this->db->where ( 'is_recharge', 1 );
			return $this->db->update ( 'smc_chat_session', $data1 );
		} else {
			return 0;
		}
	}
	public function createChatSession($user_id) {
		$this->db->select ( 'id,admin_id' );
		$this->db->from ( 'smc_chat_session' );
		$this->db->where ( 'user_id', $user_id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ($query->num_rows () == 0) {
			$data ['user_id'] = $user_id;
			$data ['admin_id'] = 0;
			$data ['update_time'] = 0;
			$data ['user_update_time'] = 0;
			return $this->db->insert ( 'smc_chat_session', $data );
		}
		return 1;
	}
	public function getSession($user_id) {
		$this->db->select ( 'admin_id,update_time,id' );
		$this->db->from ( 'smc_chat_session' );
		$this->db->where ( 'user_id', $user_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function getChatAdminNum() {
		$this->db->where ( 'is_chat', 1 );
		$this->db->where ( 'status', 1 );
		return $this->db->count_all_results ( 'smc_admin' );
	}
	// 下线分配
	public function offLineUpdateChatAdmin($admin_id) {
		$admin_list = $this->getSelectAdminList ( 0 );
		if (! empty ( $admin_list )) {
			$data ['admin_id'] = $admin_list [0] ['id'];
		} else {
			$data ['admin_id'] = 0;
		}
		$this->db->where ( 'admin_id', $admin_id );
		$this->db->where ( 'is_user_reply', 1 );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		if ($this->db->update ( 'smc_chat_session', $data )) {
			$data1 ['admin_id'] = 0;
			
			$this->db->where ( 'admin_id', $admin_id );
			$this->db->where ( 'is_user_reply', 0 );
			return $this->db->update ( 'smc_chat_session', $data1 );
		}
	}
	
	// 上线分配
	public function onLineUpdateChatAdmin($admin_id) {
	}
	public function getNoProcessChatSessionNum($admin_id) {
		$this->db->where ( 'admin_id', $admin_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		$this->db->where ( 'is_user_reply', 1 );
		return $this->db->count_all_results ( 'smc_chat_session' );
	}
	public function getChatSessionNum($admin_id) {
		if (! in_array ( $admin_id, $this->super_chat_admin_ary )) {
			$this->db->where ( 'admin_id', $admin_id );
		}
		return $this->db->count_all_results ( 'smc_chat_session' );
	}
	public function getChatSessionList($admin_id, $start, $limit, $redis) {
		$channel_list = $this->config->item ( 'channellist' );
		$this->load->model ( 'api/User_model' );
		$return_ary = array ();
		$this->db->select ( 'user_id,is_user_reply' );
		$this->db->from ( 'smc_chat_session' );
		if (! in_array ( $admin_id, $this->super_chat_admin_ary )) {
			$this->db->where ( 'admin_id', $admin_id );
		}
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		$this->db->order_by ( 'is_user_reply', 'DESC' );
		$this->db->order_by ( 'user_update_time', 'DESC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$return_ary = $query->result_array ();
		if (! empty ( $return_ary )) {
			foreach ( $return_ary as $k => $v ) {
				$this->db->select ( 'c.content,c.add_time,c.admin_id,c.user_id,a.admin_name' );
				$this->db->from ( 'smc_chat c' );
				$this->db->join ( 'smc_admin a', 'a.id = c.admin_id', 'left' );
				$this->db->where ( 'c.user_id', $v ['user_id'] );
				if ($this->session->userdata ( 'role_id' ) == 14) {
					$this->db->where ( 'c.is_recharge', 1 );
				} else {
					$this->db->where ( 'c.is_recharge', 0 );
				}
				$this->db->order_by ( 'c.id', 'DESC' );
				$this->db->limit ( 1 );
				$query = $this->db->get ();
				if ($query->num_rows () == 0) {
					unset ( $return_ary [$k] );
					continue;
				}
				$return_ary [$k] ['content'] = $query->row ()->content;
				$return_ary [$k] ['add_time'] = $query->row ()->add_time;
				$return_ary [$k] ['user_id'] = $query->row ()->user_id;
				$return_ary [$k] ['admin_id'] = $query->row ()->admin_id;
				$return_ary [$k] ['admin_name'] = $query->row ()->admin_name;
				if ($redis->get ( 'gag_' . $v ['user_id'] ) == '1') {
					$return_ary [$k] ['is_gag'] = 1;
				} else {
					$return_ary [$k] ['is_gag'] = 0;
				}
				
				$user_db_index = $this->User_model->getUserDBPos ( $v ['user_id'] );
				if (! empty ( $user_db_index )) {
					$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
					$sql = "SELECT channel_id FROM CASINOUSER_" . $user_db_index ['tableindex'] . " WHERE id = '" . $v ['user_id'] . "' LIMIT 1";
					$q = $db1->query ( $sql );
					$db1->close ();
					if (isset ( $channel_list [$q->row ()->channel_id] )) {
						$return_ary [$k] ['channel'] = $channel_list [$q->row ()->channel_id];
					} else {
						$return_ary [$k] ['channel'] = "--";
					}
				} else {
					
					$return_ary [$k] ['channel'] = '--';
				}
			}
		}
		return $return_ary;
	}
	
	/**
	 * 获取最老的未回复的用户
	 *
	 * @param unknown_type $admin_id        	
	 * @param unknown_type $start        	
	 * @param unknown_type $limit        	
	 * @param unknown_type $redis        	
	 * @return Ambigous <number, string>
	 */
	public function getLastNotReplyChatSession($admin_id, $start, $limit, $redis) {
		$channel_list = $this->config->item ( 'channellist' );
		$this->load->model ( 'api/User_model' );
		$return_ary = array ();
		$this->db->select ( 'user_id,is_user_reply' );
		$this->db->from ( 'smc_chat_session' );
		if (! in_array ( $admin_id, $this->super_chat_admin_ary )) {
			$this->db->where ( 'admin_id', $admin_id );
		}
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'is_recharge', 1 );
		} else {
			$this->db->where ( 'is_recharge', 0 );
		}
		$this->db->order_by ( 'is_user_reply', 'DESC' );
		$this->db->order_by ( 'user_update_time', 'ASC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		// echo $this->db->last_query();
		$return_ary = $query->result_array ();
		if (! empty ( $return_ary )) {
			foreach ( $return_ary as $k => $v ) {
				$this->db->select ( 'c.content,c.add_time,c.admin_id,c.user_id,a.admin_name' );
				$this->db->from ( 'smc_chat c' );
				$this->db->join ( 'smc_admin a', 'a.id = c.admin_id', 'left' );
				$this->db->where ( 'c.user_id', $v ['user_id'] );
				if ($this->session->userdata ( 'role_id' ) == 14) {
					$this->db->where ( 'c.is_recharge', 1 );
				} else {
					$this->db->where ( 'c.is_recharge', 0 );
				}
				$this->db->order_by ( 'c.id', 'DESC' );
				$this->db->limit ( 1 );
				$query = $this->db->get ();
				if ($query->num_rows () == 0) {
					unset ( $return_ary [$k] );
					continue;
				}
				$return_ary [$k] ['content'] = $query->row ()->content;
				$return_ary [$k] ['add_time'] = $query->row ()->add_time;
				$return_ary [$k] ['user_id'] = $query->row ()->user_id;
				$return_ary [$k] ['admin_id'] = $query->row ()->admin_id;
				$return_ary [$k] ['admin_name'] = $query->row ()->admin_name;
				if ($redis->get ( 'gag_' . $v ['user_id'] ) == '1') {
					$return_ary [$k] ['is_gag'] = 1;
				} else {
					$return_ary [$k] ['is_gag'] = 0;
				}
				
				$user_db_index = $this->User_model->getUserDBPos ( $v ['user_id'] );
				if (! empty ( $user_db_index )) {
					$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
					$sql = "SELECT channel_id FROM CASINOUSER_" . $user_db_index ['tableindex'] . " WHERE id = '" . $v ['user_id'] . "' LIMIT 1";
					$q = $db1->query ( $sql );
					$db1->close ();
					if (isset ( $channel_list [$q->row ()->channel_id] )) {
						$return_ary [$k] ['channel'] = $channel_list [$q->row ()->channel_id];
					} else {
						$return_ary [$k] ['channel'] = "--";
					}
				} else {
					$return_ary [$k] ['channel'] = '--';
				}
			}
		}
		return $return_ary;
	}
	public function getChatContentList($user_id, $tmp_time = '') {
		$this->db->select ( 'c.content,c.add_time,c.user_id,c.admin_id,a.admin_name' );
		$this->db->from ( 'smc_chat c' );
		$this->db->join ( 'smc_admin a', 'a.id = c.admin_id', 'left' );
		$this->db->where ( 'c.user_id', $user_id );
		if ($this->session->userdata ( 'role_id' ) == 14) {
			$this->db->where ( 'c.is_recharge', 1 );
		} else {
			$this->db->where ( 'c.is_recharge', 0 );
		}
		if ($tmp_time) {
			$this->db->where ( 'c.add_time > ', $tmp_time );
		}
		$this->db->order_by ( 'c.add_time', 'DESC' );
		$this->db->limit ( 50 );
		$query = $this->db->get ();
		$return_ary = $query->result_array ();
		if (! empty ( $return_ary )) {
			foreach ( $return_ary as $k => $v ) {
				$return_ary [$k] ['add_time_show'] = date ( 'Y-m-d H:i:s', $v ['add_time'] );
			}
		}
		return array_reverse ( $return_ary );
	}
	public function getQuickContentList() {
		$this->db->from ( 'smc_chat_quick_reply_content' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function insertQuickReply($data) {
		return $this->db->insert ( 'smc_chat_quick_reply_content', $data );
	}
	public function delQuickReply($id) {
		$this->db->where ( 'id', $id );
		return $this->db->delete ( 'smc_chat_quick_reply_content' );
	}
}
