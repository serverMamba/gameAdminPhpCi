<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Admin_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	private function getIp() {
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$cip = $_SERVER ["HTTP_CLIENT_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
			$cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		} elseif (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$cip = $_SERVER ["REMOTE_ADDR"];
		} else {
			$cip = "无法获取！";
		}
		return $cip;
	}

	public function getAdminList() {
		$this->db->select ( 'a.id,a.admin_name,r.role_name,a.status' );
		$this->db->from ( 'smc_admin a' );
		$this->db->join ( 'smc_admin_role r', 'r.id = a.role_id' );
		$this->db->order_by ( 'id' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function getAdmin($admin_name, $id = 0) {
		$this->db->select ( 'id,admin_name,status,salt,pass,role_id,is_chat' );
		$this->db->from ( 'smc_admin' );
		if ($id) {
			$this->db->where ( 'id', $id );
		} else {
			//exit('a='.$admin_name);
			$this->db->where ( 'admin_name', $admin_name );
		}
		$this->db->limit ( 1 );
		$query = $this->db->get ();

		return $query->row_array ();
	}
	public function insertAdmin($data) {
		$data ['salt'] = rand ( 10000, 99999 );
		$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		return $this->db->insert ( 'smc_admin', $data );
	}
	public function updateAdmin($admin_id, $data) {
		if (isset ( $data ['pass'] ) && $data ['pass']) {
			$data ['salt'] = rand ( 10000, 99999 );
			$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		}
		$this->db->where ( 'id', $admin_id );
		return $this->db->update ( 'smc_admin', $data );
	}
	public function getRole($role_id) {
		$this->db->select ( 'id,role_name,priv' );
		$this->db->from ( 'smc_admin_role' );
		$this->db->where ( 'id', $role_id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function getRoleList() {
		$return = array ();
		$this->db->select ( 'id,role_name,priv' );
		$this->db->from ( 'smc_admin_role' );
		$this->db->order_by ( 'id' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$return = $query->result_array ();
			foreach ( $return as $k => $v ) {
				$this->db->select ( 'admin_name' );
				$this->db->from ( 'smc_admin' );
				$this->db->where ( 'role_id', $v ['id'] );
				$this->db->order_by ( 'id' );
				$q_admin = $this->db->get ();
				if ($q_admin->num_rows () > 0) {
					$admin_array = array ();
					foreach ( $q_admin->result () as $row ) {
						array_push ( $admin_array, $row->admin_name );
					}
					$return [$k] ['admin_list'] = implode ( ',', $admin_array );
				} else {
					$return [$k] ['admin_list'] = '--';
				}
			}
		}
		return $return;
	}
	public function insertRole($data) {
		return $this->db->insert ( 'smc_admin_role', $data );
	}
	public function updateRole($role_id, $data) {
		$this->db->where ( 'id', $role_id );
		return $this->db->update ( 'smc_admin_role', $data );
	}
	public function deleteAdmin($admin_id) {
		$this->db->where ( 'id', $admin_id );
		return $this->db->delete ( 'smc_admin' );
	}
	
	/**
	 * 获取登录日志
	 * @param int $startTime
	 * @param int $endTime
	 * @param int $start
	 * @param int $per
	 * @param array $recordList
	 * @param int $recordNum
	 */
	public function getLoginLog($startTimeStr, $endTimeStr, $startIndex, $per, &$recordList, &$recordNum)
	{
		$startTime = strtotime($startTimeStr);
		$endTime = strtotime($endTimeStr);
		
		$this->db->select('adminAccount, loginIP, from_unixtime(loginTime) as loginTime');
		$this->db->from('smc_admin_login_log');
		$this->db->where(array(
				'loginTime >= ' => $startTime,
				'loginTime <= ' => $endTime,
				));
		$this->db->order_by('id', 'desc');
		$this->db->limit($per, $startIndex);
		
		$recordList = $this->db->get()->result_array();

		$this->db->from('smc_admin_login_log');
		$this->db->where(array(
				'loginTime >= ' => $startTime,
				'loginTime <= ' => $endTime,
				));
		$recordNum = $this->db->count_all_results();

		return;
	}
	
	/**
	 * 记录登录日志
	 * @param unknown_type $adminName
	 */
	function recordLogin($adminName)
	{
		$insertData = array(
				'adminAccount' => $adminName,
				'loginIP' => $this->getIp(),
				'loginTime' => time()
				);
		$this->db->insert('smc_admin_login_log', $insertData);
	}
}