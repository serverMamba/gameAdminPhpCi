<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Brecharge_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getKefuList() {
		$db = $this->load->database ( 'default_slave', true );
		$db->select ( 'id,admin_name' );
		$db->from ( 'smc_admin' );
		$db->where ( 'role_id', 14 );
		$query = $db->get ();
		$db->close ();
		return $query->result_array ();
	}
	public function getOrderByThird($third_order_sn) {
		$db = $this->load->database ( 'default_slave', true );
		$db->select ( 'id' );
		$db->from ( 'smc_order' );
		$db->where ( 'third_order_sn', $third_order_sn );
		$db->limit ( 1 );
		$query = $db->get ();
		$db->close ();
		if ($query->num_rows () == 0) {
			return true;
		} else {
			return false;
		}
	}
	public function getSum($userid, $mystarttime, $myendtime, $admin_id, $start, $per) {
		$db = $this->load->database ( 'default_slave', true );
		$db->select ( 'SUM(money/100) AS m' );
		$db->from ( 'smc_order' );
		if ($userid) {
			$db->where ( 'user_id', $userid );
		}
		
		if ($mystarttime) {
			$db->where ( 'add_time >= ', strtotime ( $mystarttime ) );
		}
		if ($myendtime) {
			$db->where ( 'add_time <= ', strtotime ( $myendtime ) );
		}
		
		if ($admin_id) {
			$db->where ( 'refer', $admin_id );
		}
		
		$db->where ( 'pay_platform', 98 );
		$query = $db->get ();
		$db->close ();
		return $query->row ()->m;
	}
	public function get_dindan_his($userid, $mystarttime, $myendtime, $admin_id, $start, $per, &$order_list, &$totalNum) {
		$db = $this->load->database ( 'default_slave', true );
		
		$db->from ( 'smc_order' );
		if ($userid) {
			$db->where ( 'user_id', $userid );
		}
		
		if ($mystarttime) {
			$db->where ( 'add_time >= ', strtotime ( $mystarttime ) );
		}
		if ($myendtime) {
			$db->where ( 'add_time <= ', strtotime ( $myendtime ) );
		}
		
		if ($admin_id) {
			$db->where ( 'refer', $admin_id );
		}
		
		$db->where ( 'pay_platform', 98 );
		
		$db->order_by ( 'add_time', 'DESC' );
		$db->limit ( $per, $start );
		$query = $db->get ();
		$order_list = $query->result_array ();
		if (! empty ( $order_list )) {
			foreach ( $order_list as $k => $v ) {
				if ($v ['status'] == 0) {
					$order_list [$k] ['status'] = '未支付';
				} else if ($v ['status'] == 1) {
					$order_list [$k] ['status'] = '支付成功';
				} else {
					$order_list [$k] ['status'] = '支付失败';
				}
				
				$order_list [$k] ['add_time'] = date ( 'Y-m-d H:i:s', $v ['add_time'] );
				if ($v ['pay_success_time']) {
					$order_list [$k] ['pay_success_time'] = date ( 'Y-m-d H:i:s', $v ['pay_success_time'] );
				} else {
					$order_list [$k] ['pay_success_time'] = ' - ';
				}
				
				$order_list [$k] ['money'] = $v ['money'] / 100;
				
				if ($v ['status'] == 1) {
					$order_list [$k] ['after_chips'] = $v ['before_chips'] + $v ['money'];
				} else {
					$order_list [$k] ['after_chips'] = '--';
				}
			}
		}
		
		// 计算数量
		$db->from ( 'smc_order' );
		if ($userid) {
			$db->where ( 'user_id', $userid );
		}
		
		if ($mystarttime) {
			$db->where ( 'add_time >= ', strtotime ( $mystarttime ) );
		}
		if ($myendtime) {
			$db->where ( 'add_time <= ', strtotime ( $myendtime ) );
		}
		
		if ($admin_id) {
			$db->where ( 'refer', $admin_id );
		}
		
		$db->where ( 'pay_platform', 98 );
		
		$totalNum = $db->count_all_results ();
	}
	public function addMemberChips($user_id, $chips, $user_info, $kefu_id, $third_order_sn = '') {
		$db = $this->load->database ( 'default', true );
		$now = time ();
		$this->load->model ( 'detail_model' );
		if ($this->detail_model->score_operation_by_kefu_recharge ( $user_id, $chips )) {
			$order_db = array (
					'user_id' => $user_id,
					'order_sn' => $this->getOrderSn ( $user_id ),
					'add_time' => $now,
					'pay_success_time' => $now,
					'money' => $chips,
					'pay_type' => 'kefu_recharge',
					'refer' => $kefu_id,
					'third_order_sn' => $third_order_sn,
					'channel_id' => $user_info ['channel_id'],
					'before_chips' => $user_info ['user_chips'],
					'pay_platform' => 98,
					'status' => 1 
			);
			$db->insert ( 'smc_order', $order_db );
			$db->close ();
			return true;
		} else {
			return false;
		}
	}
	private function getOrderSn($user_id) {
		$this->load->helper ( 'string' );
		
		$type = array (
				'alpha',
				'alnum',
				'numeric' 
		);
		
		$order_sn = random_string ( $type [array_rand ( $type )], 6 ) . time () . $user_id . random_string ( $type [array_rand ( $type )], 4 );
		return $order_sn;
	}
}