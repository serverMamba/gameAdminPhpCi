<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Order_statistics_model extends CI_Model {
	var $chart_broad_width = 0;
	public function __construct() {
		parent::__construct ();
	}
	// 充值总数，充值总用户，充值总额，提现总额，税收总额
	public function getOrderStatistics($channel_id, $date) {
		$this->load->database ( 'default' );
		$return_ary = array (
				'pay_total_num' => array (
						'labels' => array (),
						'datasets' => array (
								array (
										'label' => '今日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'green',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '昨日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'red',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '前日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'blue',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '上周充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'yellow',
										'spanGaps' => true,
										'lineTension' => 0.1 
								) 
						) 
				) 
		);
		$yesterday_total_money = 0;
		// 昨日
		$this->db->select ( 'date,pay_total_num' );
		$this->db->from ( 'smc_log_order' );
		$this->db->where ( 'channel_id', $channel_id );
		$this->db->where ( 'date1', date ( 'Ymd', strtotime ( $date . '000000' ) - 3600 * 24 ) );
		$this->db->order_by ( 'date', 'ASC' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			// $query_ary = array_reverse ( $query->result_array () );
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					array_push ( $return_ary [$k] ['labels'], date ( 'H:i', strtotime ( $row ['date'] . '0000' ) + 3600 ) );
					$yesterday_total_money += $row ['pay_total_num'] / 100;
					array_push ( $return_ary [$k] ['datasets'] [1] ['data'], $yesterday_total_money );
				}
			}
		}
		
		$today_total_money = 0;
		// 今日
		$this->db->select ( 'date,pay_total_num' );
		$this->db->from ( 'smc_log_order' );
		$this->db->where ( 'channel_id', $channel_id );
		$this->db->where ( 'date1', $date );
		$this->db->order_by ( 'date', 'ASC' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			// $query_ary = array_reverse ( $query->result_array () );
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					$today_total_money += $row ['pay_total_num'] / 100;
					array_push ( $return_ary [$k] ['datasets'] [0] ['data'], $today_total_money );
				}
			}
		}
		
		$day_before_yesterday_total_money = 0;
		// 前日
		$this->db->select ( 'date,pay_total_num' );
		$this->db->from ( 'smc_log_order' );
		$this->db->where ( 'channel_id', $channel_id );
		$this->db->where ( 'date1', date ( 'Ymd', strtotime ( $date . '000000' ) - 3600 * 48 ) );
		$this->db->order_by ( 'date', 'ASC' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			// $query_ary = array_reverse ( $query->result_array () );
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					$day_before_yesterday_total_money += $row ['pay_total_num'] / 100;
					array_push ( $return_ary [$k] ['datasets'] [2] ['data'], $day_before_yesterday_total_money );
				}
			}
		}
		
		$last_week_total_money = 0;
		// 上周
		$this->db->select ( 'date,pay_total_num' );
		$this->db->from ( 'smc_log_order' );
		$this->db->where ( 'channel_id', $channel_id );
		$this->db->where ( 'date1', date ( 'Ymd', strtotime ( $date . '000000' ) - 3600 * 24 * 7 ) );
		$this->db->order_by ( 'date', 'ASC' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			// $query_ary = array_reverse ( $query->result_array () );
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					$last_week_total_money += $row ['pay_total_num'] / 100;
					array_push ( $return_ary [$k] ['datasets'] [3] ['data'], $last_week_total_money );
				}
			}
		}
		
		$this->db->close ();
		return $return_ary;
	}

	/**
	 * 处理当某一天的某个小时没有收入时的状况，手动插入一条数据
	 * @param unknown_type $query_ary
	 */
	private function dealWithDateTotalIncome(&$query_ary)
	{
		$lastDateTime = 0;
		for ($i = 0; $i < count($query_ary); $i++)
		{
			$dateTime = strtotime ( $query_ary[$i] ['date'] . '0000' );
			if ($lastDateTime != 0 && $lastDateTime != $dateTime - 3600)
			{
				// 缺少这个记录，手动插入一条
				$dateTime = $lastDateTime + 3600;
				array_splice( $query_ary, $i, 0, array(array('date' => date('YmdH', $dateTime), 'pay_total_num' => 0)));
			}

			$lastDateTime = $dateTime;
		}
	}

	public function getOrderStatistics1($channel_id, $show_type, $day_num) {
		$this->load->database ( 'default' );
		$return_ary = array ();
		if ($show_type == 2) {
			$sql = "SELECT date1 as date, SUM(order_total_num) AS order_total_num,SUM(user_total_num) AS user_total_num ,SUM(pay_total_num) as pay_total_num,SUM(cash_money) as cash_money,SUM(choushui_money) as choushui_money,SUM(cash_total_money) as cash_total_money
			FROM smc_log_order where channel_id = '$channel_id' group by date1 ORDER BY date1 DESC LIMIT $day_num";
			$query = $this->db->query ( $sql );
		} else {
			$this->db->from ( 'smc_log_order' );
			$this->db->where ( 'channel_id', $channel_id );
			$this->db->order_by ( 'date', 'DESC' );
			$this->db->limit ( $day_num );
			$query = $this->db->get ();
		}
		if ($query->num_rows () > 0) {
			$return_ary = array_reverse ( $query->result_array () );
			foreach ( $return_ary as $k => $v ) {
				$return_ary [$k] ['date'] = date ( 'Y-m-d H:i', strtotime ( $v ['date'] . '0000' ) );
				$return_ary [$k] ['pay_total_num'] = ($v ['pay_total_num'] / 100) . '元';
				$return_ary [$k] ['cash_money'] = ($v ['cash_money'] / 100) . '元';
				$return_ary [$k] ['choushui_money'] = ($v ['choushui_money'] / 100) . '元';
				$return_ary [$k] ['cash_total_money'] = ($v ['cash_total_money'] / 100) . '元';
			}
		}
		$this->db->close ();
		return $return_ary;
	}
	public function getKefuStatistics($start_date, $end_date) {
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );
		
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->select ( 'id,admin_name' );
		$db->from ( 'smc_admin' );
		$db->where ( 'role_id', 2 ); // 客服角色是2
		$query = $db->get ();
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				$sql = "SELECT COUNT(*) AS c FROM smc_chat WHERE admin_id = '" . $row->id . "' AND add_time >= '$start_time' AND add_time  <= '$end_time'";
				$q = $db->query ( $sql );
				array_push ( $return_ary, array (
						'admin_id' => $row->id,
						'admin_name' => $row->admin_name,
						'reply_count' => $q->row ()->c 
				) );
			}
		}
		$db->close();
		return $return_ary;
	}
}
