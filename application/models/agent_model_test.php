<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Agent_model_test extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getAgentAccount($account, $id = 0) {
		$this->db->select ( 'id,account,status,salt,pass,channel_priv,field_priv' );
		$this->db->from ( 'smc_agent_account' );
		if ($id) {
			$this->db->where ( 'id', $id );
		} else {
			$this->db->where ( 'account', $account );
		}
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function isLogin() {
		if ($this->session->userdata ( 'login_status' )) {
			return true;
		} else {
			return false;
		}
	}
	
	public function getLastCurMonth($time, &$lastMonth, &$curMonth)
	{
		$lastMonth = date ( 'Y-m', strtotime ( $time . ' -1 month' ) );
		$curMonth = date ( 'Y-m', strtotime ( $time ) );
		if ($lastMonth == $curMonth)
		{
			// 在3月30号查询的时候last_month_start_date会变成17-03-01，这是因为1month这里被算成28天（即上个月的天数），所以这里多减三天，可以保证落到上个月的某一天
			$lastMonth = date ( 'Y-m', strtotime ( $time . ' -1 month -3 day' ) );
		}
	}
	
	public function getLastCurMonthDate($time, &$lastMonthStartDate, &$lastMonthEndDate, &$curMonthStartDate, &$curMonthEndDate)
	{
		$lastMonthStartDate = date ( 'Y-m-01', strtotime ( $time . ' -1 month' ) );
		$curMonthStartDate = date ( 'Y-m-01', strtotime ( $time ) );
		if ($lastMonthStartDate == $curMonthStartDate)
		{
			// [170330] 在3月30号查询的时候last_month_start_date会变成17-03-01，这是因为1month这里被算成28天（即上个月的天数），所以这里多减三天，可以保证落到上个月的某一天
			$lastMonthStartDate = date ( 'Y-m-01', strtotime ( $time . ' -1 month -3 day' ) );
		}
		
		$lastMonthEndDate = date ( 'Y-m-d', strtotime ( $lastMonthStartDate . ' +1 month -1 day' ) );
		$curMonthEndDate = date ( 'Y-m-d', strtotime ( $curMonthStartDate . ' +1 month -1 day' ) );
	}
	
	/**
	 * 获取统计数据
	 * @param unknown_type $time
	 * @param unknown_type $key
	 * @param unknown_type $channel		10000表示所有
	 * @param unknown_type $allChannels	当10000的时候，如果allChannels为空表示所有，非空表示这些的总和
	 * @return string|number|unknown
	 */
	public function get_total_static($time, $key, $channel, $allChannels = null) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$noChannelIdArray = array();
		foreach ($nochannellist as $k => $v)
		{
			$noChannelIdArray[] = $k;
		}
		$mysplit = explode ( "-", $time );
		$myyear = $mysplit [0];
		$mymonth = substr ( "00" . $mysplit [1], - 2 );
		$myday = substr ( "00" . $mysplit [2], - 2 );
		
		$last_month_start_date = "";
		$last_month_end_date = "";
		$cur_month_start_date = "";
		$cur_month_end_date = "";
		$this->getLastCurMonthDate($time, $last_month_start_date, $last_month_end_date, $cur_month_start_date, $cur_month_end_date);
		
		$originKey = $key;
		/////////////////////////////////
		// 如下这一段是针对有按月统计内容的
		// 判断是本月还是上月，还是某天
		$lastMonth = false;
		$curMonth = false;
		if (strpos($key, '_cur_month') != false)
		{
			$key = substr($key, 0, strpos($key, '_cur_month'));
			$curMonth = true;
		}
		else if (strpos($key, '_last_month') != false)
		{
			$key = substr($key, 0, strpos($key, '_last_month'));
			$lastMonth = true;
		}

		$key2Fields = array(
				"total15" => array("field" => "sum(pay_total_num)", "append" => ""),
				"total1" => array("field" => "sum(new_device_count)", "append" => ""),
				"total2" => array("field" => "sum(new_user_count)", "append" => ""),
				"total3" => array("field" => "sum(new_realuser_count)", "append" => ""),
				"total4" => array("field" => "sum(new_playgame_user_count)", "append" => ""),
				"total18" => array("field" => "sum(choushui_money+choushui_money1) / 100", "append" => "元"),
				"total19" => array("field" => "sum(cash_money+cash_money1) / 100", "append" => "元"),
				"total17" => array("field" => "sum(pay_total_money) / 100", "append" => "元"),
				"total29" => array("field" => "sum(ddz_choushui) / 100", "append" => "元"),
				"total30" => array("field" => "sum(huanle_ddz_choushui) / 100", "append" => "元"),
				"total24" => array("field" => "sum(laizi_ddz_choushui) / 100", "append" => "元"),
				"total25" => array("field" => "sum(zjh_choushui) / 100", "append" => "元"),
				"total26" => array("field" => "sum(niuniu_choushui) / 100", "append" => "元"),
				"total27" => array("field" => "sum(qiangzhuang_niuniu_choushui) / 100", "append" => "元"),
				"total28" => array("field" => "sum(buyu_choushui) / 100", "append" => "元"),
				"total35" => array("field" => "sum(fruit_money+bao_money+fruit_compare_money) / 100", "append" => "元"),
				"total36" => array("field" => "sum(zjh_bairen_choushui) / 100", "append" => "元"),
				"total31" => array("field" => "sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui + lhp_choushui + malai_niuniu_choushui + sangong_choushui + hongheidz_choushui) / 100", "append" => "元"),
				"total_lhp" => array("field" => "sum(lhp_choushui) / 100", "append" => "元"),
				"total_nnml" => array("field" => "sum(malai_niuniu_choushui) / 100", "append" => "元"),
				"total_sangong" => array("field" => "sum(sangong_choushui) / 100", "append" => "元"),
				"total_hongheidz" => array("field" => "sum(hongheidz_choushui) / 100", "append" => "元"),
				);
		
		if (isset($key2Fields[$key]))
		{
			$field = $key2Fields[$key];
			$CI = &get_instance ();
			$db = $CI->load->database ( 'gamebuyee', true );
			
			$db->select("{$field['field']} as xx");
			$db->from('CASINOBUSINESSSTATISTICS');
			
			// 日期条件
			if ($lastMonth)
			{
				$db->where(array(
						"statistics_date >=" =>  "$last_month_start_date",
						"statistics_date <=" =>  "$last_month_end_date",
						));
			}
			else if ($curMonth)
			{
				$db->where(array(
						"statistics_date >=" =>  "$cur_month_start_date",
						"statistics_date <=" =>  "$cur_month_end_date",
						));
			}
			else
			{
				$db->where(array("statistics_date" =>  "$myyear-$mymonth-$myday"));
			}
			
			// channelId条件
			if ($channel != "10000") 
			{
				$db->where(array("channelid" => $channel));
			}
			else
			{
				if ($allChannels == null)
				{
					$db->where_not_in('channelId', $noChannelIdArray);
				}
				else
				{
					$db->where_in('channelId', $allChannels);
				}
				
			}
			
			$query = $db->get();
			$ret = $this->_dealwith_ret ( $query );
			$rr = array ();
			if ($ret[0]['xx'] == null)
			{
				$ret [0] ['xx'] = 0;
			}
				
			$number = round(floatval($ret[0]['xx']), 2);
			
			if ($field['append'] == '元')
			{
				$number = number_format ( $number, 2, '.', ',' ) ;
			}
		
			return $number . $field['append'];
		}

		/////////////////////////////////
		// 如下这一段是针对无按月统计内容的
		$key = $originKey;
		
		$key2Fields = array(
				"total5" => array("field" => "sum(new_guest_count)", "append" => ""),
				"total6" => array("field" => "sum(firstgame_user_count)", "append" => ""),
				"total9" => array("field" => "sum(total_user_count)", "append" => ""),
				"total20" => array("field" => "sum(active_user_7day_count)", "append" => ""),
				"total10" => array("field" => "sum(active_user_count)", "append" => ""),
				"total16" => array("field" => "sum(pay_user_count)", "append" => ""),
				"total12" => array("field" => "sum(active_device_count)", "append" => ""),
				"total21" => array("field" => "sum(active_device_7day_count)", "append" => ""),
				);
		
		if (isset($key2Fields[$key]))
		{
			$field = $key2Fields[$key];
			$CI = &get_instance ();
			$db = $CI->load->database ( 'gamebuyee', true );
			
			$db->select("{$field['field']} as xx");
			$db->from('CASINOBUSINESSSTATISTICS');
			
			// 日期条件
			$db->where(array("statistics_date" =>  "$myyear-$mymonth-$myday"));
			
			// channelId条件
			if ($channel != "10000") 
			{
				$db->where(array("channelid" => $channel));
			}
			else
			{
				if ($allChannels == null)
				{
					$db->where_not_in('channelId', $noChannelIdArray);
				}
				else
				{
					$db->where_in('channelId', $allChannels);
				}
				
			}
			
			$query = $db->get();
			$ret = $this->_dealwith_ret ( $query );
			$rr = array ();
			if ($ret[0]['xx'] == null)
			{
				$ret [0] ['xx'] = 0;
			}
				
			$number = round(floatval($ret[0]['xx']), 2);
			
			if ($field['append'] == '元')
			{
				$number = number_format ( $number, 2, '.', ',' ) ;
			}
		
			return $number . $field['append'];
		}

		/////////////////////////////////
		// 如下这一段是针对特殊情况
		if ($key == "total22") {
			$CI = &get_instance ();
			$db = $CI->load->database ( 'gamebuyee', true );
			$where = "where statistics_date = '$myyear-$mymonth-$myday'";
			
			if ($channel != "10000") {
				$where = $where . " and channelid = $channel";
			} else {
				foreach ( $nochannellist as $k => $v ) {
					$where = $where . " and channelid <> $k";
				}
			}
			
			$sql = "select sum(retention_lastday_count) as xx from CASINOBUSINESSSTATISTICS $where";
			
			$query = $db->query ( $sql );
			$ret = $this->_dealwith_ret ( $query );
			
			$startx = @strtotime ( "$myyear-$mymonth-$myday" . " 00:00:00" );
			
			$yest = date ( 'Y-m-d', $startx - 60 * 60 * 24 );
			
			$where1 = "where statistics_date = '$yest'";
			
			if ($channel != "10000") {
				$where1 = $where1 . " and channelid = $channel";
			} else {
				foreach ( $nochannellist as $k => $v ) {
					$where = $where . " and channelid <> $k";
				}
			}
			
			$sql1 = "select sum(new_device_count) as xx from CASINOBUSINESSSTATISTICS $where1";
			
			$query1 = $db->query ( $sql1 );
			$ret1 = $this->_dealwith_ret ( $query1 );
			
			$return = "0.000%";
			if ($ret1 [0] ['xx'] > 0) {
				$return = round ( $ret [0] ['xx'] * 100 / $ret1 [0] ['xx'], 3 ) . "%";
			}
			return $return;
		}
		
		if ($key == "total23") {
			$CI = &get_instance ();
			$db = $CI->load->database ( 'gamebuyee', true );
			$where = "where statistics_date = '$myyear-$mymonth-$myday'";
			
			if ($channel != "10000") {
				$where = $where . " and channelid = $channel";
			} else {
				foreach ( $nochannellist as $k => $v ) {
					$where = $where . " and channelid <> $k";
				}
			}
			
			$sql = "select sum(retention_7day_count) as xx from CASINOBUSINESSSTATISTICS $where";
			
			$query = $db->query ( $sql );
			$ret = $this->_dealwith_ret ( $query );
			
			$startx = @strtotime ( "$myyear-$mymonth-$myday" . " 00:00:00" );
			
			$yest = date ( 'Y-m-d', $startx - 60 * 60 * 24 * 7 );
			
			$where1 = "where statistics_date = '$yest'";
			
			if ($channel != "10000") {
				$where1 = $where1 . " and channelid = $channel";
			} else {
				foreach ( $nochannellist as $k => $v ) {
					$where = $where . " and channelid <> $k";
				}
			}
			
			$sql1 = "select sum(new_device_count) as xx from CASINOBUSINESSSTATISTICS $where1";
			
			$query1 = $db->query ( $sql1 );
			$ret1 = $this->_dealwith_ret ( $query1 );
			
			$return = "0.000%";
			if ($ret1 [0] ['xx'] > 0) {
				$return = round ( $ret [0] ['xx'] * 100 / $ret1 [0] ['xx'], 3 ) . "%";
			}
			return $return;
		}
		
		if ($key == "total7") {
			$where = "where statistics_time<= '$myyear-$mymonth-$myday 23:59:59'  and statistics_time>= '$myyear-$mymonth-$myday 00:00:00'";
			
			$total_num = 0;
			$CI = &get_instance ();
			$db = $CI->load->database ( 'globalinfo', true );
			$sql = "select sum(server_membernum) as num from CASINOTOTALONLINESTATISTICS $where group by statistics_time";
			$query = $db->query ( $sql );
			$result = $query->result_array ();
			if (! empty ( $result )) {
				foreach ( $result as $row ) {
					$total_num += $row ['num'];
				}
			}
			
			return floor ( $total_num / count ( $result ) );
		}
		
		if ($key == "total8") {
			$where = "where statistics_time<= '$myyear-$mymonth-$myday 23:59:59'  and statistics_time>= '$myyear-$mymonth-$myday 00:00:00'";
			
			$max_num = 0;
			$CI = &get_instance ();
			$db = $CI->load->database ( 'globalinfo', true );
			$sql = "select sum(server_membernum) as num from CASINOTOTALONLINESTATISTICS $where group by statistics_time";
			$this->writeLog("total8: ".$sql);
			$query = $db->query ( $sql );
			$result = $query->result_array ();
			if (! empty ( $result )) {
				foreach ( $result as $row ) {
					if ($max_num < $row ['num']) {
						$max_num = $row ['num'];
					}
				}
			}
			return $max_num;
		}
		
		return '--';
	}
	public function getTotal($start_date, $end_date) {
		$db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
		$channel_list = $this->config->item ( 'channellist' );
		
		$return_ary ['全部'] = array (
				'total_pay_show' => number_format ( $this->getTotalPay ( $db, - 1, $start_date, $end_date ), 2, '.', ',' ),
				'total_pay' => $this->getTotalPay ( $db, - 1, $start_date, $end_date ),
				'total_cash' => $this->getTotalCash ( $db, - 1, $start_date, $end_date ),
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, - 1, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, - 1, $start_date, $end_date ) 
		);
		$return_ary ['集集棋牌'] = array (
				'total_pay_show' => number_format ( $this->getTotalPay ( $db, 0, $start_date, $end_date ), 2, '.', ',' ),
				'total_pay' => $this->getTotalPay ( $db, 0, $start_date, $end_date ),
				'total_cash' => $this->getTotalCash ( $db, 0, $start_date, $end_date ),
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, 0, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, 0, $start_date, $end_date ) 
		);
		foreach ( $channel_list as $k => $v ) {
			$return_ary [$v] = array (
					'total_pay_show' => number_format ( $this->getTotalPay ( $db, $k, $start_date, $end_date ), 2, '.', ',' ),
					'total_pay' => $this->getTotalPay ( $db, $k, $start_date, $end_date ),
					'total_cash' => $this->getTotalCash ( $db, $k, $start_date, $end_date ),
					'total_cash_choushui' => $this->getTotalCashChoushui ( $db, $k, $start_date, $end_date ),
					'total_choushui' => $this->getTotalChoushui ( $db, $k, $start_date, $end_date ) 
			);
		}
		
		$db->close ();
		return $return_ary;
	}
	public function getMyChannelTotal($start_date, $end_date, $channel_list) {
		$db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
// 		$channel_list = $this->config->item ( 'channellist' );
		
		foreach ( $channel_list as $k => $v ) {
			$return_ary [$v] = array (
					'total_pay_show' => number_format ( $this->getTotalPay ( $db, $k, $start_date, $end_date ), 2, '.', ',' ),
					'total_pay' => $this->getTotalPay ( $db, $k, $start_date, $end_date ),
					'total_cash' => $this->getTotalCash ( $db, $k, $start_date, $end_date ),
					'total_cash_choushui' => $this->getTotalCashChoushui ( $db, $k, $start_date, $end_date ),
					'total_choushui' => $this->getTotalChoushui ( $db, $k, $start_date, $end_date ) 
			);
		}
		
		$db->close ();
		return $return_ary;
	}
	private function getTotalCash($db, $channel_id, $start_date, $end_date) {
		$where = '';
		if ($channel_id >= 0) {
			$where = " AND channelid = '$channel_id'";
		}
		$sql = "select sum(cash_money+cash_money1) as xx from CASINOBUSINESSSTATISTICS WHERE statistics_date >= '$start_date' AND statistics_date <= '$end_date' $where";
		$query = $db->query ( $sql );
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	private function getTotalPay($db, $channel_id, $start_date, $end_date) {
		$where = '';
		if ($channel_id >= 0) {
			$where = " AND channelid = '$channel_id'";
		}
		$sql = "select sum(pay_total_money) as xx from CASINOBUSINESSSTATISTICS WHERE statistics_date >= '$start_date' AND statistics_date <= '$end_date' $where";
		$query = $db->query ( $sql );
		// return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
		return $query->row ()->xx / 100;
	}
	private function getTotalCashChoushui($db, $channel_id, $start_date, $end_date) {
		$where = '';
		if ($channel_id >= 0) {
			$where = " AND channelid = '$channel_id'";
		}
		$sql = "select sum(choushui_money+choushui_money1) as xx from CASINOBUSINESSSTATISTICS WHERE statistics_date >= '$start_date' AND statistics_date <= '$end_date' $where";
		$query = $db->query ( $sql );
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	private function getTotalChoushui($db, $channel_id, $start_date, $end_date) {
		$where = '';
		if ($channel_id >= 0) {
			$where = " AND channelid = '$channel_id'";
		}
		$sql = "select sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui + lhp_choushui + malai_niuniu_choushui + sangong_choushui + hongheidz_choushui) as xx from CASINOBUSINESSSTATISTICS WHERE statistics_date >= '$start_date' AND statistics_date <= '$end_date' $where";
		$query = $db->query ( $sql );
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	public function getOrderStatistics($channel_id, $date) {
		$return_ary = array (
				'pay_total_num' => array (
						'labels' => array (),
						'datasets' => array (
								array (
										'label' => '今日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'pointColor' => '#fff',
										'fill' => false,
										'borderColor' => 'green',
										'spanGaps' => true,
										'lineTension' => 0.1,
										'borderWidth' => 1 
								),
								array (
										'label' => '昨日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'pointColor' => '#fff',
										'fill' => false,
										'borderColor' => 'red',
										'spanGaps' => true,
										'lineTension' => 0.1,
										'borderWidth' => 1 
								),
								array (
										'label' => '前日充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'blue',
										'spanGaps' => true,
										'lineTension' => 0.1,
										'borderWidth' => 1 
								),
								array (
										'label' => '上周充值',
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'yellow',
										'spanGaps' => true,
										'lineTension' => 0.1,
										'borderWidth' => 1 
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
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					$last_week_total_money += $row ['pay_total_num'] / 100;
					array_push ( $return_ary [$k] ['datasets'] [3] ['data'], $last_week_total_money );
				}
			}
		}
		
		return $return_ary;
	}
	public function getPayStatics($start_date, $end_date) {
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );
		
		$db = $this->load->database ( 'default', true );
		$sql = "SELECT pay_platform,SUM(money/100) AS total_money FROM smc_order WHERE status = 1 AND add_time >= $start_time AND add_time <= $end_time GROUP BY pay_platform";
		$query = $db->query ( $sql );
		return $query->result_array ();
	}
	protected function _dealwith_ret($query) {
		if (! is_object ( $query ) || ! $query->conn_id) {
			return false;
		} else if (count ( $query->result_array () ) > 0) {
			return $query->result_array ();
		} else {
			return array ();
		}
	}
	
	public function writeLog($txt) {
		$log_file = "/log/report_test.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
}