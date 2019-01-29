<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getUserDBPosByAccount($account) {
		$host = SOCKET_SERVER_IP;
		$port = 9109;
		
		$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP ) or die ( 'Could not create socket' );
		$conn = socket_connect ( $socket, $host, $port );
		
		socket_write ( $socket, $account );
		$str = socket_read ( $socket, 1024 ); /* 倒数第二位为库索引，倒数第一位为表索引 */
		socket_close ( $socket );
		
		// 防止溢出，截取后8位
		$str = substr ( $str, - 8 );
		$str = strrev ( dechex ( $str ) );
		$tb = hexdec ( $str {0} );
		$db = hexdec ( $str {1} );
		
		$ret = array (
				'useraccount' => $account,
				'dbindex' => $db,
				'tableindex' => $tb 
		);
		return $ret;
	}
	public function isExitUserByAccont($account) {
		$user_index = $this->getUserDBPosByAccount ( $account );
		if (empty ( $user_index )) {
			return false;
		}
		
		$db = $this->load->database ( 'eus' . $user_index ['dbindex'], true );
		$db->select ( 'id' );
		$db->from ( 'CASINOUSER_' . $user_index ['tableindex'] );
		$db->where ( 'user_email', $account );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		if ($query->num_rows () > 0) {
			return true;
		} else {
			return false;
		}
	}
	public function getUserDBPos($user_id) {
		$tmp = $user_id & 0x00000000000000FF;
		$dbx = ($tmp & 0xF0) >> 4;
		$server = 'eus' . $dbx . '_slave';
		$posx = $tmp & 0x0F;
		$db = $this->load->database ( $server, true );
		$db->select ( 'dbindex,tableindex' );
		$db->from ( 'CASINOUSER2ACCOUNT_' . $posx );
		$db->where ( 'userid', $user_id );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		$user_db_index = $query->row_array ();
		if (empty ( $user_db_index )) {
			return false;
		}
		return $user_db_index;
	}
	public function getUserInfoByAccount($account) {
		$user_db_index = $this->getUserDBPosByAccount ( $account );
		if (! $user_db_index) {
			return array ();
		}
		
		$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
		$db1->select ( '*' );
		$db1->from ( 'CASINOUSER_' . $user_db_index ['tableindex'] );
		$db1->where ( 'user_email', $account );
		$db1->limit ( 1 );
		$query = $db1->get ();		
		$user_info = $query->row_array ();
		if (empty ( $user_info )) {
			$db1->select ( '*' );
			$db1->from ( 'CASINOOLDACCOUNT2NEWACCOUNT_' . $user_db_index ['tableindex'] );
			$db1->where ( 'newuseraccount', $account );
			$db1->limit ( 1 );
			$query = $db1->get ();
			$db_index = $query->row_array ();
			if (! empty ( $db_index )) {
				$db2 = $this->load->database ( 'eus' . $db_index ['dbindex'], true );
				$db2->select ( '*' );
				$db2->from ( 'CASINOUSER_' . $db_index ['tableindex'] );
				$db2->where ( 'user_email', $account );
				$db2->limit ( 1 );
				$query = $db2->get ();
				$db2->close ();
				$user_info = $query->row_array ();
				$user_info['dbindex'] = $db_index ['dbindex'];
				$user_info['tableindex'] = $db_index ['tableindex'];
			}
		}else{
			$user_info['dbindex'] = $user_db_index ['dbindex'];
			$user_info['tableindex'] = $user_db_index ['tableindex'];
		}
		$db1->close ();
		return $user_info;
	}
	public function getUserInfo($user_id) {
		$user_db_index = $this->getUserDBPos ( $user_id );
		if (! $user_db_index) {
			return array ();
		}
		$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
		$db1->select ( '*' );
		$db1->from ( 'CASINOUSER_' . $user_db_index ['tableindex'] );
		$db1->where ( 'id', $user_id );
		$db1->limit ( 1 );
		$query = $db1->get ();
		$db1->close ();
		$user_info = $query->row_array ();
		return $user_info;
	}
	public function getUserAlipayInfo($user_id) {
		$db = $this->load->database ( 'default', true );
		$db->select ( 'alipay_account,alipay_real_name' );
		$db->from ( 'smc_user' );
		$db->where ( 'user_id', $user_id );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		$user_info = $query->row_array ();
		return $user_info;
	}
	public function updateUserInfo($dbindex, $tableindex, $user_id, $data) {
		$db = $this->load->database ( 'eus' . $dbindex, true );
		$db->where ( 'id', $user_id );
		return $db->update ( 'CASINOUSER_' . $tableindex, $data );
	}
	public function insertUserAlipay($data) {
		$db = $this->load->database ( 'default', true );
		$res = $db->insert ( 'smc_user', $data );
		$db->close ();
		return $res;
	}
	public function updateUserAlipay($user_id, $data) {
		$db = $this->load->database ( 'default', true );
		$db->where ( 'user_id', $user_id );
		$res = $db->update ( 'smc_user', $data );
		$db->close ();
		return $res;
	}
	public function validSMScode($mobile, $code) {
		$db = $this->load->database ( 'default', true );
		$db->select ( 'id,sms_code' );
		$db->from ( 'smc_sms_code' );
		$db->where ( 'mobile', $mobile );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		if ($query->num_rows () > 0) {
			if ($query->row ()->sms_code == $code) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
	public function insertSMSCode($mobile, $code) {
		$db = $this->load->database ( 'default', true );
		$db->select ( 'id' );
		$db->from ( 'smc_sms_code' );
		$db->where ( 'mobile', $mobile );
		$db->limit ( 1 );
		$query = $db->get ();
		if ($query->num_rows () > 0) {
			$data = array (
					'sms_code' => $code 
			);
			$db->where ( 'mobile', $mobile );
			$r = $db->update ( 'smc_sms_code', $data );
			$db->close ();
		} else {
			$data = array (
					'sms_code' => $code,
					'mobile' => $mobile 
			);
			$r = $db->insert ( 'smc_sms_code', $data );
			$db->close ();
		}
		return $r;
	}
	public function haveNewCash($user_id) {
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->select ( 'id,cash_money,update_time,discribe,status' );
		$db->from ( 'smc_cash_order' );
		$db->where ( 'user_id', $user_id );
		$db->where ( 'status > ', 0 );
		$db->where ( 'is_notice', 0 );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		if ($query->num_rows () > 0) {
			$return_ary = array (
					'id' => $query->row ()->id,
					'cash_money' => $query->row ()->cash_money / 100,
					'time' => date ( 'Y-m-d H:i', $query->row ()->update_time ),
					'discribe' => $query->row ()->discribe,
					'status' => $query->row ()->status 
			);
		}
		return $return_ary;
	}
	public function getCashOrder() {
		$db = $this->load->database ( 'default', true );
		$db->select ( 'id,alipay_account,alipay_real_name,cash_money' );
		$db->from ( 'smc_cash_order' );
		$db->where ( 'status', 0 );
		$db->order_by ( 'id' );
		$db->limit ( 50 );
		$query = $db->get ();
		$db->close ();
		return $query->result_array ();
	}
}
