<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Fin_statistics_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getTotal_bak($start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
		$channel_list = $this->config->item ( 'channellist' );
		$p_all = $this->getTotalPay ( $db, - 1, $start_date, $end_date );
		$c_all = $this->getTotalCash ( $db, - 1, $start_date, $end_date );
		$this->writeLog ( "all>>>$p_all,$c_all" );
		$c_p_all = $this->get_C_P ( $c_all, $p_all );
		$return_ary_all ['全部'] = array (
				'total_pay' => $p_all,
				'total_cash' => $c_all,
				'total_c_p' => $c_p_all,
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, - 1, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, - 1, $start_date, $end_date ) 
		);
		// $return_ary ['未知渠道'] = array (
		$p_0 = $this->getTotalPay ( $db, 0, $start_date, $end_date );
		$c_0 = $this->getTotalCash ( $db, 0, $start_date, $end_date );
		$this->writeLog ( "0>>>$p_0,$c_0" );
		$c_p_0 = $this->get_C_P ( $c_0, $p_0 );
		$return_ary_k ['集集棋牌'] = array (
				'total_pay' => $p_0,
				'total_cash' => $c_0,
				'total_c_p' => $c_p_0,
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, 0, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, 0, $start_date, $end_date ) 
		);
		foreach ( $channel_list as $k => $v ) {
			if (isset ( $nochannellist [$k] )) {
				continue;
			}
			$p_k = $this->getTotalPay ( $db, $k, $start_date, $end_date );
			$c_k = $this->getTotalCash ( $db, $k, $start_date, $end_date );
			$c_p_k = $this->get_C_P ( $c_k, $p_k );
			$cash_choushui_k = $this->getTotalCashChoushui ( $db, $k, $start_date, $end_date );
			$choushui_k = $this->getTotalChoushui ( $db, $k, $start_date, $end_date );
			if ($p_k == 0 && $c_k == 0 && $cash_choushui_k == 0 && $choushui_k == 0) {
				continue;
			}
			$return_ary_k [$v] = array (
					'total_pay' => $p_k,
					'total_cash' => $c_k,
					'total_c_p' => $c_p_k,
					'total_cash_choushui' => $cash_choushui_k,
					'total_choushui' => $choushui_k 
			);
		}
		$this->writeLog ( "k>>>end" . count ( $return_ary_k ) );
		// $arr1 = array_map(create_function('$n', 'return $n["total_c_p"];'),
		// $return_ary_k);
		// array_multisort($arr1,SORT_DESC,$return_ary_k );
		$return_ary = array_merge ( $return_ary_all, $return_ary_k );
		$db->close ();
		return $return_ary;
	}
	public function getTotal($start_date, $end_date) {
		$return_ary = array ();
		if (! isDate ( $start_date ) || ! isDate ( $end_date )) {
			return $return_ary;
		}
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db = $this->load->database ( 'gamebuyee', true );
		$channel_list = $this->config->item ( 'channellist' );
		$v_0 = number_format ( 0, 2, '.', ',' );
		$tmp_item = array (
				'total_pay' => $v_0,
				'total_cash' => $v_0,
				'total_c_p' => $v_0,
				'total_csm' => $v_0,
				'total_cash_choushui' => $v_0,
				'total_choushui' => $v_0 
		);
		$return_ary ['全部'] = $tmp_item;
		$return_ary ['集集棋牌'] = $tmp_item;
		$wheresql = "";
		if ($nochannellist && count ( $nochannellist ) > 0) {
			foreach ( $nochannellist as $channelid => $name ) {
				if ($wheresql) {
					$wheresql .= ",";
				}
				$wheresql .= $channelid;
			}
		}
		if ($wheresql) {
			$wheresql = " channelid not in($wheresql) and ";
		}
		foreach ( $channel_list as $channelid => $name ) {
			if (isset ( $nochannellist [$channelid] )) {
				continue;
			}
			$return_ary [$name] = $tmp_item;
		}
		$sql = "SELECT 
				-1 as channelid, 
				sum(pay_total_money)/100 as total_pay, 
				sum(cash_money+cash_money1)/100 as total_cash,
				(sum(cash_money+cash_money1)-sum(pay_total_money))/100 as  total_c_p,
				sum(cash_send_money+cash_send_money1)/100 as total_csm,
				sum(choushui_money+choushui_money1)/100 as total_cash_choushui,
				sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui)/100 as total_choushui
				from CASINOBUSINESSSTATISTICS 
				where $wheresql statistics_date >= '$start_date' and statistics_date <= '$end_date' union all
				SELECT 
				channelid, 
				sum(pay_total_money)/100 as total_pay, 
				sum(cash_money+cash_money1)/100 as total_cash,
				(sum(cash_money+cash_money1)-sum(pay_total_money))/100 as  total_c_p,
				sum(cash_send_money+cash_send_money1)/100 as total_csm,
				sum(choushui_money+choushui_money1)/100 as total_cash_choushui,
				sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui)/100 as total_choushui
				from CASINOBUSINESSSTATISTICS 
				where $wheresql statistics_date >= '$start_date' and statistics_date <= '$end_date'
				GROUP BY channelid";
		$query = $db->query ( $sql );
		$return_ary_db = $query->result_array ();
		$db->close ();
		foreach ( $return_ary_db as $k => $v ) {
			$channelid_item = $v ['channelid'];
			$name_k = $channel_list [$channelid_item];
			if (- 1 == $channelid_item) {
				$name_k = '全部';
			} else if (0 == $channelid_item) {
				$name_k = '集集棋牌';
			} else {
				$name_k = $name_k ? $name_k : "未知渠道$channelid_item";
			}
			$tmp_item = array (
					'total_pay' => number_format ( $v ['total_pay'], 2, '.', ',' ),
					'total_cash' => number_format ( $v ['total_cash'], 2, '.', ',' ),
					'total_c_p' => number_format ( $v ['total_c_p'], 2, '.', ',' ),
					'total_csm' => number_format ( $v ['total_csm'], 2, '.', ',' ),
					'total_cash_choushui' => number_format ( $v ['total_cash_choushui'], 2, '.', ',' ),
					'total_choushui' => number_format ( $v ['total_choushui'], 2, '.', ',' ) 
			);
			$return_ary [$name_k] = $tmp_item;
		}
		foreach ( $return_ary as $k => $v ) {
			if ($v ['total_pay'] == 0 && $v ['total_cash'] == 0 && $v ['total_cash_choushui'] == 0 && $v ['total_choushui'] == 0) {
				unset ( $return_ary [$k] );
			}
		}
		return $return_ary;
	}
	static function sortByNewRegist($a, $b) {
		if ($a ['new_regist'] == $b ['new_regist']) {
			return 0;
		}
		
		return ($a ['new_regist'] > $b ['new_regist']) ? - 1 : 1;
	}
	
	/**
	 * 为运营报表的渠道统计获取数据
	 * 
	 * @param int $start_date        	
	 * @param int $end_date        	
	 */
	public function getTotalForOpertionReport($start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
		$channel_list = $this->config->item ( 'channellist' );
		
		$return_ary [] = array (
				'name' => '全部',
				'new_regist' => $this->getTotalNewRegistration ( $db, - 1, $start_date, $end_date ),
				'total_pay' => $this->getTotalPay ( $db, - 1, $start_date, $end_date ),
				'total_cash' => $this->getTotalCash ( $db, - 1, $start_date, $end_date ),
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, - 1, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, - 1, $start_date, $end_date ) 
		);
		$return_ary [] = array (
				// 'name' => '未知渠道',
				'name' => '集集棋牌',
				'new_regist' => $this->getTotalNewRegistration ( $db, 0, $start_date, $end_date ),
				'total_pay' => $this->getTotalPay ( $db, 0, $start_date, $end_date ),
				'total_cash' => $this->getTotalCash ( $db, 0, $start_date, $end_date ),
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, 0, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, 0, $start_date, $end_date ) 
		);
		foreach ( $channel_list as $k => $v ) {
			if (isset ( $nochannellist [$k] )) {
				continue;
			}
			$return_ary [] = array (
					'name' => $v,
					'new_regist' => $this->getTotalNewRegistration ( $db, $k, $start_date, $end_date ),
					'total_pay' => $this->getTotalPay ( $db, $k, $start_date, $end_date ),
					'total_cash' => $this->getTotalCash ( $db, $k, $start_date, $end_date ),
					'total_cash_choushui' => $this->getTotalCashChoushui ( $db, $k, $start_date, $end_date ),
					'total_choushui' => $this->getTotalChoushui ( $db, $k, $start_date, $end_date ) 
			);
		}
		
		$db->close ();
		
		// 进行排序
		usort ( $return_ary, array (
				'Fin_statistics_model',
				'sortByNewRegist' 
		) );
		
		return $return_ary;
	}
	public function getTotal1($start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
		$channel_list = $this->config->item ( 'channellist' );
		
		$return_ary ['全部'] = array (
				'total_pay' => $this->getTotalPay ( $db, - 1, $start_date, $end_date ),
				'total_cash' => $this->getTotalCash ( $db, - 1, $start_date, $end_date ),
				'total_cash_choushui' => $this->getTotalCashChoushui ( $db, - 1, $start_date, $end_date ),
				'total_choushui' => $this->getTotalChoushui ( $db, - 1, $start_date, $end_date ),
				'total_cash_num' => $this->getCashNum ( $start_date, $end_date ) 
		);
		
		$db->close ();
		return $return_ary;
	}
	private function getCashNum($start_date, $end_date) {
		// 2016-10-13
		$db_start_date = strtotime ( $start_date . ' 00:00:00' );
		$db_end_date = strtotime ( $end_date . ' 23:59:59' );
		
		$db = $this->load->database ( 'cashorder1', true );
		$db->from ( 'smc_cash_order' );
		$db->where ( 'add_time >= ', $db_start_date );
		$db->where ( 'add_time <= ', $db_end_date );
		$cash_num = $db->count_all_results ();
		$db->close ();
		
		$db1 = $this->load->database ( 'cashorder2', true );
		$db1->from ( 'smc_cash_order' );
		$db1->where ( 'add_time >= ', $db_start_date );
		$db1->where ( 'add_time <= ', $db_end_date );
		$cash_num1 = $db1->count_all_results ();
		$db1->close ();
		
		return intval ( $cash_num + $cash_num1 );
	}
	private function getTotalCash($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(cash_money+cash_money1) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	private function get_C_P($c, $p) {
		$c_p = 0; // floatval(str_replace(",","",$c.""))-floatval(str_replace(",","",$p.""));
		return $c_p;
	}
	private function getTotal_C_P($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(cash_money+cash_money1)-sum(pay_total_money) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		$res = number_format ( $query->row ()->xx / 100, 2, '.', '' );
		return $res;
	}
	private function getTotalNewRegistration($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(new_device_count) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		return $query->row ()->xx;
	}
	public function updateYestadayTotalPay() {
		$step = 1; // 昨日数据
		$channellist = $this->config->item ( 'channellist' );
		$pay_statics_platforms = $this->config->item ( 'pay_statics_platforms' );
		$pay_statics_timedelay = $this->config->item ( 'pay_statics_timedelay' );
		$table_from = 'smc_order';
		$table_to = 'CASINOPAYTOTALSTATISTICS';
		
		$date_yestaday = date ( 'Y-m-d', time () - 3600 * 24 * $step );
		$date_today = date ( 'Y-m-d', time () - 3600 * 24 * ($step - 1) );
		$this->writeLogTmp ( "---------------$date_yestaday~$date_today--------------------------- " );
		$conn_default = $this->load->database ( 'default', true );
		if (! $conn_default) {
			return null;
		}
		$conn_stat = $this->load->database ( 'gamebuyee', true );
		if (! $conn_stat) {
			$conn_default->close ();
			return null;
		}
		
		$db_time_start = strtotime ( $date_yestaday . ' 00:00:00' );
		$db_time_end = strtotime ( $date_today . ' 00:00:00' );
		
		$sql = "DELETE FROM $table_to WHERE statistics_date = '$date_yestaday'";
		$this->writeLogTmp ( ">>> " . $sql );
		$conn_stat->query ( $sql );
		
		$sql = "SELECT GROUP_CONCAT(DISTINCT channel_id) channels,GROUP_CONCAT(DISTINCT  pay_platform) platforms from $table_from where (add_time>=" . strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step + 1) ) ) . " and add_time<=" . strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step - 1) ) ) . ") or (pay_success_time>=" . strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step + 1) ) ) . " and pay_success_time<=" . strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step - 1) ) ) . ")";
		$this->writeLogTmp ( ">>> " . $sql );
		$result = $conn_default->query ( $sql )->result_array ();
		if (! $result || count ( $result ) <= 0) {
			$this->writeLogTmp ( ">>> payforms is null" );
			return null;
		}
		$db_channels = array ();
		$db_platforms = array ();
		if (count ( $result ) > 0) {
			if ($result [0] && $result [0] ['channels']) {
				$this->writeLogTmp ( ">>> channels=" . $result [0] ['channels'] );
				$db_channels = split ( ",", $result [0] ['channels'] );
			}
			if ($result [0] && $result [0] ['platforms']) {
				$this->writeLogTmp ( ">>> platforms=" . $result [0] ['platforms'] );
				$db_platforms = split ( ",", $result [0] ['platforms'] );
			}
		}
		// 补全$db_channels
		foreach ( $channellist as $k => $v ) {
			if (! in_array ( $k, $db_channels )) {
				array_push ( $db_channels, $k );
			}
		}
		foreach ( $db_channels as $tmp_channel ) {
			$pay_total_channel = 0;
			foreach ( $db_platforms as $tmp_platform ) {
				$time_field = isset ( $pay_statics_platforms [intval ( $tmp_platform )] ) ? $pay_statics_platforms [intval ( $tmp_platform )] : 'pay_success_time'; // 默认到帐时间
				$timedelay = (isset ( $pay_statics_timedelay [intval ( $tmp_platform )] )) ? $pay_statics_timedelay [intval ( $tmp_platform )] : 0;
				$db_time_start_tmp = $db_time_start + $timedelay;
				$db_time_end_tmp = $db_time_end + $timedelay;
				$sql = "SELECT SUM(money) AS total_money,count(distinct(user_id)) AS pay_user_count,count(id) AS pay_total_num FROM $table_from WHERE status=1  and pay_platform=$tmp_platform and channel_id=$tmp_channel and $time_field>=$db_time_start_tmp and $time_field<$db_time_end_tmp";
				// $this->writeLogTmp(">>> ".$sql);
				$result = $conn_default->query ( $sql )->result_array ();
				$total_money = 0;
				$pay_user_count = 0;
				$pay_total_num = 0;
				if (count ( $result ) > 0) {
					$total_money = $result [0] && $result [0] ['total_money'] ? intval ( $result [0] ['total_money'] ) : 0;
					$pay_user_count = $result [0] && $result [0] ['pay_user_count'] ? intval ( $result [0] ['pay_user_count'] ) : 0;
					$pay_total_num = $result [0] && $result [0] ['pay_total_num'] ? intval ( $result [0] ['pay_total_num'] ) : 0;
				}
				$sql = "insert into $table_to (`statistics_date`,`channelid`,`pay_platform`,`pay_user_count`,
`pay_total_money`,`pay_total_num`,`stat_standard`) values ('$date_yestaday',$tmp_channel,$tmp_platform,$pay_user_count,$total_money,$pay_total_num,'$time_field')";
				// $this->writeLogTmp(">>> ".$sql);
				$conn_stat->query ( $sql );
				$pay_total_channel = $pay_total_channel + $total_money;
			}
			$sql1 = " update CASINOBUSINESSSTATISTICS set pay_total_money=$pay_total_channel where channelid=$tmp_channel and statistics_date='$date_yestaday' ";
			$this->writeLogTmp ( ">>> " . $sql1 );
			$conn_stat->query ( $sql1 );
		}
		
		$conn_default->close ();
		$conn_stat->close ();
	}
	private function getTotalPay($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(pay_total_money) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	private function getTotalCashChoushui($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(choushui_money+choushui_money1) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	private function getTotalChoushui($db, $channel_id, $start_date, $end_date) {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$db->where ( array (
				'statistics_date >= ' => $start_date,
				'statistics_date <= ' => $end_date 
		) );
		if ($channel_id >= 0) {
			$db->where ( 'channelid', $channel_id );
		} else {
			foreach ( $nochannellist as $k => $v ) {
				$db->where ( 'channelid <>', $k );
			}
		}
		
		$db->select ( 'sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui) as xx' );
		$db->from ( 'CASINOBUSINESSSTATISTICS' );
		$query = $db->get ();
		return number_format ( $query->row ()->xx / 100, 2, '.', ',' );
	}
	
	// [170217] modify: 新增两个筛选项：channel和pay_type
	public function getPayStatics_old($start_date, $end_date, $select_channel, $pay_type, $stat_time) {
		$return_ary = array ();
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );
		$stat_time = "add_time" === $stat_time ? "add_time" : "pay_success_time";
		$time_type = "创建时间";
		if ("pay_success_time" == $stat_time) {
			$time_type = "到帐时间";
		}
		$db = $this->load->database ( 'default', true );
		
		$db->select ( 'pay_platform,SUM(money/100) AS total_money' )->from ( 'smc_order' );
		$db->where ( array (
				'status' => 1,
				$stat_time . ' >=' => $start_time,
				$stat_time . ' <=' => $end_time 
		) );
		if ($select_channel != '') {
			// $this->writeLog("channel_id>>>".$select_channel);
			$db->where ( 'channel_id', $select_channel );
		}
		if ($pay_type != '') {
			// $this->writeLog("pay_type>>>".$pay_type);
			$db->where ( 'pay_type', $pay_type );
		}
		
		$db->group_by ( 'pay_platform' );
		$query = $db->get ();
		$return_ary = $query->result_array ();
		
		/*
		 * $sql = "SELECT pay_platform,SUM(money/100) AS total_money FROM
		 * smc_order WHERE status = 1 AND add_time >= $start_time AND add_time
		 * <= $end_time GROUP BY pay_platform"; $query = $db->query ( $sql );
		 * $return_ary = $query->result_array ();
		 */
		
		// 查询成功率，即status为1的订单除以总数
		foreach ( $return_ary as $k => $v ) {
			$db->where ( 'pay_platform', $v ['pay_platform'] );
			$db->where ( 'add_time >= ', $start_time );
			$db->where ( 'add_time <= ', $end_time );
			if ($select_channel != '') {
				$db->where ( 'channel_id', $select_channel );
			}
			if ($pay_type != '') {
				$db->where ( 'pay_type', $pay_type );
			}
			$total_num = $db->count_all_results ( 'smc_order' );
			
			$db->where ( 'status', 1 );
			$db->where ( 'pay_platform', $v ['pay_platform'] );
			$db->where ( 'add_time >= ', $start_time );
			$db->where ( 'add_time <= ', $end_time );
			if ($select_channel != '') {
				$db->where ( 'channel_id', $select_channel );
			}
			if ($pay_type != '') {
				$db->where ( 'pay_type', $pay_type );
			}
			$success_num = $db->count_all_results ( 'smc_order' );
			
			$return_ary [$k] ['success_rate'] = round ( ($success_num / $total_num) * 100, 2 ) . '%';
			
			$return_ary [$k] ['time_type'] = $time_type;
		}
		
		$db->close ();
		return $return_ary;
	}
	public function getPlatformArr($start_date, $end_date, $select_channel, $pay_type) {
		$platformArr = array ();
		$stat_time = 'add_time';
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );
		$db = $this->load->database ( 'default', true );
		/**
		 * $db->select('GROUP_CONCAT(DISTINCT pay_platform)
		 * pay_platform_str')->from('smc_order');
		 * $db->where(array(
		 * 'status' => 1,
		 * $stat_time.' >=' => $start_time,
		 * $stat_time.' <=' => $end_time,
		 * ));
		 * if ($select_channel != '')
		 * {
		 * $db->where('channel_id', $select_channel);
		 * }
		 * if ($pay_type != '')
		 * {
		 * $db->where('pay_type', $pay_type);
		 * }
		 *
		 * $query = $db->get();
		 */
		$whereSql = " where status=1 ";
		if ($select_channel != '') {
			$whereSql = $whereSql . " and channel_id=$select_channel ";
		}
		if ($pay_type != '') {
			$whereSql = $whereSql . " and pay_type='$pay_type' ";
		}
		$whereSql = $whereSql . " and ((add_time>=$start_time and add_time<=$end_time) or (pay_success_time>=$start_time and pay_success_time<=$end_time))";
		$sql = "select GROUP_CONCAT(DISTINCT pay_platform) pay_platform_str from smc_order " . $whereSql;
		// $this->writeLog("getPlatformArr sql=".$sql);
		$query = $db->query ( $sql );
		$return_ary = $query->result_array ();
		$db->close ();
		$pay_platform_str = "";
		foreach ( $return_ary as $k => $v ) {
			$pay_platform_str = $v ['pay_platform_str'];
			break;
		}
		// $this->writeLog("pay_platform_str=".$pay_platform_str);
        if (!empty($pay_platform_str)) {
            $platformArr = explode ( ",", $pay_platform_str );
        }
		// $this->writeLog("count_platformArr=".count($platformArr));
		return $platformArr;
	}
	
	// [170217] modify: 新增两个筛选项：channel和pay_type
	public function getPayStatics($start_date, $end_date, $select_channel, $pay_type, $stat_time) {
		$platformArr = $this->getPlatformArr ( $start_date, $end_date, $select_channel, $pay_type );
		$return_ary = array ();
		if (! $platformArr || count ( $platformArr ) <= 0) {
			return $return_ary;
		}
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );
		$stat_time = "add_time" === $stat_time ? "add_time" : "pay_success_time";
		$this->writeLog ( "getPayStatics>>> start_date=$start_date,end_date=$end_date,start_time=$start_time,end_time=$end_time" );
		$db = $this->load->database ( 'default', true );
		
		$selectSql = " pay_platform,SUM(money/100) AS total_money ";
		$tableSql = " smc_order ";
		$whereSql = " where status=1 ";
		if ($select_channel != '') {
			// $this->writeLog("getPayStatics
			// select_channel>>>".$select_channel);
			$whereSql = $whereSql . " and channel_id=$select_channel";
		}
		if ($pay_type != '') {
			// $this->writeLog("getPayStatics pay_type>>>".$pay_type);
			$whereSql = $whereSql . " and pay_type='$pay_type'";
		}
		
		$sql = "";
		$pay_statics_platforms = $this->config->item ( 'pay_statics_platforms' );
		foreach ( $platformArr as $platform ) {
			$timeField = $pay_statics_platforms [$platform] ? $pay_statics_platforms [$platform] : "pay_success_time"; // 默认到帐时间
			$timeSql0 = $start_time;
			$timeSql1 = $end_time;
			$pay_statics_timedelay = $this->config->item ( 'pay_statics_timedelay' );
			$timedelay = ($pay_statics_timedelay && $pay_statics_timedelay [$platform]) ? $pay_statics_timedelay [$platform] : 0;
			$timeSql0 = $start_time + $timedelay;
			$timeSql1 = $end_time + $timedelay;
			$whereSqlTmp = $whereSql . " and pay_platform=$platform and $timeField>=$timeSql0 and $timeField<=$timeSql1";
			
			$sqlTmp = "select $selectSql from $tableSql $whereSqlTmp";
			$sqlFix = "";
			if ($sql) {
				$sqlFix = " union all ";
			}
			$sql = $sql . $sqlFix . $sqlTmp;
		}
		$query = $db->query ( $sql );
		$return_ary = $query->result_array ();
		
		/*
		 * $sql = "SELECT pay_platform,SUM(money/100) AS total_money FROM
		 * smc_order WHERE status = 1 AND add_time >= $start_time AND add_time
		 * <= $end_time GROUP BY pay_platform"; $query = $db->query ( $sql );
		 * $return_ary = $query->result_array ();
		 */
		
		// 查询成功率，即status为1的订单除以总数
		foreach ( $return_ary as $k => $v ) {
			$db->where ( 'pay_platform', $v ['pay_platform'] );
			$db->where ( 'add_time >= ', $start_time );
			$db->where ( 'add_time <= ', $end_time );
			if ($select_channel != '') {
				$db->where ( 'channel_id', $select_channel );
			}
			if ($pay_type != '') {
				$db->where ( 'pay_type', $pay_type );
			}
			$total_num = $db->count_all_results ( 'smc_order' );
			
			$db->where ( 'status', 1 );
			$db->where ( 'pay_platform', $v ['pay_platform'] );
			$db->where ( 'add_time >= ', $start_time );
			$db->where ( 'add_time <= ', $end_time );
			if ($select_channel != '') {
				$db->where ( 'channel_id', $select_channel );
			}
			if ($pay_type != '') {
				$db->where ( 'pay_type', $pay_type );
			}
			$success_num = $db->count_all_results ( 'smc_order' );
			
			$return_ary [$k] ['success_rate'] = round ( ($success_num / $total_num) * 100, 2 ) . '%';
			$time_type = "创建时间";
			if ("pay_success_time" == $pay_statics_platforms [$v ['pay_platform']]) {
				$time_type = "到帐时间";
			}
			$return_ary [$k] ['time_type'] = $time_type;
		}
		
		$db->close ();
		return $return_ary;
	}
	public function getDuizhangList() {
		$return_ary = array ();
		$db = $this->load->database ( 'gamebuyee', true );
		$db->from ( 'CASINORECONCILIATION' );
		$db->order_by ( 'listorder', 'DESC' );
		$db->limit ( 5 );
		$query = $db->get ();
		$db->close ();
		$return_ary = $query->result_array ();
		if (! empty ( $return_ary )) {
			foreach ( $return_ary as $k => $v ) {
				$add_chips = $v ['recharge_chips'] - $v ['cash_chips'] - $v ['choushui_chips'] + $v ['register_chips'] + $v ['bind_phone_chips'];
				$return_ary [$k] ['add_chips'] = $add_chips;
			}
		}
		return $return_ary;
	}
	public function writeLogTmp($txt, $dayflag = false) {
		if (! $txt) {
			return;
		}
		$filename = "payStatics_tmp";
		if ($dayflag) {
			$filename = $filename . date ( '_Y-m-d', time () );
		}
		$log_file = "/log/" . $filename . ".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[" . date ( 'Y-m-d H:i:s', time () ) . "] " . $txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	public function writeLog($txt, $dayflag = false) {
		if (! $txt) {
			return;
		}
		$filename = "payStatics";
		if ($dayflag) {
			$filename = $filename . date ( '_Y-m-d', time () );
		}
		$log_file = "/log/" . $filename . ".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[" . date ( 'Y-m-d H:i:s', time () ) . "] " . $txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	public function syncChannelConfigToDB() {
		$sql0 = "CREATE TABLE IF NOT EXISTS `smc_channel_config` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		   `channelId` varchar(10)  DEFAULT '',
		  `tag` varchar(10)  DEFAULT '',
		  `packagename` varchar(500)  DEFAULT '',
		  `url` varchar(1024)  DEFAULT '',
		  `status` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  KEY `channelId` (`channelId`),
		  KEY `tag` (`tag`)
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		
		$db = $this->load->database ( 'default', true );
		$query = $db->query ( $sql0 );
		$query = $db->query ( "TRUNCATE table smc_channel_config" );
		$channel_list = $this->config->item ( 'allChannelList' );
		$num = 0;
		foreach ( $channel_list as $v ) {
			$channelId = $v ['channelId'];
			$tag = $v ['tag'];
			$name = $v ['name'];
			$sql = "insert into smc_channel_config(channelId,tag,packagename) values('$channelId','$tag','$name')";
			$query = $db->query ( $sql );
			$num ++;
		}
		$db->close ();
		return $num;
	}
}
