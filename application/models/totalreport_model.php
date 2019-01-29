<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class totalreport_model extends MY_Model {
	var $db = null;
	var $payment_tables = null;
	public function __construct() {
		parent::__construct ();
		$this->payment_tables = $this->config->item ( 'payment_tables' );
	}
	public function getsql($strdate) {
		$sql = "(";
		foreach ( $this->payment_tables as $key => $value ) {
			$sql = $sql . "( select userid,gamecode,totalfee from CASINOBUYHISDB." . $value ['tbname'] . " where ( tradeTime > '$strdate 00:00:00') and ( tradeTime < '$strdate 23:59:59') )UNION ALL";
		}
		$len = strlen ( $sql );
		$sql = substr ( $sql, 0, $len - 9 );
		$sql = $sql . ")";
		return $sql;
	}
	public function get_total_static($time, $key, $channel) {
		$mysplit = explode ( "-", $time );
		$myyear = $mysplit [0];
		$mymonth = substr ( "00" . $mysplit [1], - 2 );
		$myday = substr ( "00" . $mysplit [2], - 2 );
		$nochannellist = $this->config->item ( 'no_tongji' );
		
		$key2Fields = array(
				"total15" => array("field" => "sum(pay_total_num)", "append" => ""),
				"total1" => array("field" => "sum(new_device_count)", "append" => ""),
				"total2" => array("field" => "sum(new_user_count)", "append" => ""),
				"total3" => array("field" => "sum(new_realuser_count)", "append" => ""),
				"total4" => array("field" => "sum(new_playgame_user_count)", "append" => ""),
				"total5" => array("field" => "sum(new_guest_count)", "append" => ""),
				"total6" => array("field" => "sum(firstgame_user_count)", "append" => ""),
				"total9" => array("field" => "sum(total_user_count)", "append" => ""),
				"total18" => array("field" => "sum(choushui_money+choushui_money1) / 100", "append" => "元"),
				"total_alifee" => array("field" => "sum(alifee+alifee1) / 100", "append" => "元"),
				"total19" => array("field" => "sum(cash_money+cash_money1) / 100", "append" => "元"),
				"total20" => array("field" => "sum(active_user_7day_count)", "append" => ""),
				"total10" => array("field" => "sum(active_user_count)", "append" => ""),
				"total16" => array("field" => "sum(pay_user_count)", "append" => ""),
				"total17" => array("field" => "sum(pay_total_money) / 100", "append" => "元"),
				"total12" => array("field" => "sum(active_device_count)", "append" => ""),
				"total21" => array("field" => "sum(active_device_7day_count)", "append" => ""),
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
			$db->where('statistics_date', "$myyear-$mymonth-$myday");
			
			if ($channel != "10000") {
				$db->where('channelid', $channel);
			} else {
				foreach ($nochannellist as $k=>$v){
					$db->where('channelid <>', $k);
				}
			}
			
			$db->select("{$field['field']} as xx")->from('CASINOBUSINESSSTATISTICS');
			$query = $db->get();
			$ret = $this->_dealwith_ret ( $query );
			$rr = array ();
			if ($ret[0]['xx'] == null)
			{
				$ret [0] ['xx'] = 0;
			}
			
			$number = round(floatval($ret[0]['xx']), 2);

			$rr ["合计"] = $number . $field['append'];
			return $rr;
		}
		else if ($key == "total22") {
			$CI = &get_instance ();
			// 搜索昨日注册用户今日登录数
			$db = $CI->load->database ( 'gamebuyee', true );
			$db->where('statistics_date', "$myyear-$mymonth-$myday");
			
			if ($channel != "10000") {
				$db->where('channelid', $channel);
			} else {
				foreach ($nochannellist as $k=>$v){
					$db->where('channelid <>', $k);
				}
			}
			
			$db->select("sum(retention_lastday_count) as xx")->from('CASINOBUSINESSSTATISTICS');
			$query = $db->get();
			$ret = $this->_dealwith_ret ( $query );
			
			// 搜索昨日注册数
			$startx = @strtotime ( "$myyear-$mymonth-$myday" . " 00:00:00" );
			$yest = date ( 'Y-m-d', $startx - 60 * 60 * 24 );
			$db->where('statistics_date', $yest);
			
			if ($channel != "10000") {
				$db->where('channelid', $channel);
			} else {
				foreach ($nochannellist as $k=>$v){
					$db->where('channelid <>', $k);
				}
			}
			
			$db->select("sum(new_device_count) as xx")->from('CASINOBUSINESSSTATISTICS');
			$query1 = $db->get();
			$ret1 = $this->_dealwith_ret ( $query1 );
			
			$rr = array ();
			$rr ["合计"] = "0.000%";
			if ($ret1 [0] ['xx'] > 0) {
				$rr ["合计"] = round ( $ret [0] ['xx'] * 100 / $ret1 [0] ['xx'], 3 ) . "%";
			}
			return $rr;
		}
		else if ($key == "total23") {
			$CI = &get_instance ();
			// 搜索七日前注册用户今日登录数
			$db = $CI->load->database ( 'gamebuyee', true );

			$db->where('statistics_date', "$myyear-$mymonth-$myday");
			
			if ($channel != "10000") {
				$db->where('channelid', $channel);
			} else {
				foreach ($nochannellist as $k=>$v){
					$db->where('channelid <>', $k);
				}
			}
			
			$db->select("sum(retention_7day_count) as xx")->from('CASINOBUSINESSSTATISTICS');
			$query = $db->get();
			
			$ret = $this->_dealwith_ret ( $query );
			
			// 搜索七日前注册用户数
			$startx = @strtotime ( "$myyear-$mymonth-$myday" . " 00:00:00" );
			$yest = date ( 'Y-m-d', $startx - 60 * 60 * 24 * 7 );
			$db->where('statistics_date', $yest);
			
			if ($channel != "10000") {
				$db->where('channelid', $channel);
			} else {
				foreach ($nochannellist as $k=>$v){
					$db->where('channelid <>', $k);
				}
			}
			
			$db->select("sum(new_device_count) as xx")->from('CASINOBUSINESSSTATISTICS');
			$query1 = $db->get();
			$ret1 = $this->_dealwith_ret ( $query1 );
			
			$rr = array ();
			$rr ["合计"] = "0.000%";
			if ($ret1 [0] ['xx'] > 0) {
				$rr ["合计"] = round ( $ret [0] ['xx'] * 100 / $ret1 [0] ['xx'], 3 ) . "%";
			}
			return $rr;
		}
		else if ($key == "total7") {
			$total_num = 0;
			$CI = &get_instance ();
			$db = $CI->load->database ( 'globalinfo', true );
			/**$db->where(array(
					'statistics_time<= ' => "$myyear-$mymonth-$myday 23:59:59",
					'statistics_time>= ' => "$myyear-$mymonth-$myday 00:00:00",
					));
			
			$db->select('sum(server_membernum) as num')->from('CASINOTOTALONLINESTATISTICS')->group_by('statistics_time');
			$query = $db->get ();**/
			$sql = "select sum(server_membernum) as num from CASINOTOTALONLINESTATISTICS where statistics_time>='"."$myyear-$mymonth-$myday 00:00:00"."' and statistics_time<= '"."$myyear-$mymonth-$myday 23:59:59"."' GROUP BY statistics_time";
			$query = $db->query($sql);
			$result = $query->result_array ();
			if (! empty ( $result )) {
				foreach ( $result as $row ) {
					$total_num += $row ['num'];
				}
			}
			
			$rr = array ();
			$rr ["合计"] = floor ( $total_num / count ( $result ) );
			return $rr;
		}
		else if ($key == "total8") {
			$max_num = 0;
			$CI = &get_instance ();
			$db = $CI->load->database ( 'globalinfo', true );
			/**$db->where(array(
					'statistics_time<= ' => "$myyear-$mymonth-$myday 23:59:59",
					'statistics_time>= ' => "$myyear-$mymonth-$myday 00:00:00",
					));
			
			$db->select('sum(server_membernum) as num')->from('CASINOTOTALONLINESTATISTICS')->group_by('statistics_time');
			$query = $db->get ();**/
			$sql = "select sum(server_membernum) as num from CASINOTOTALONLINESTATISTICS where statistics_time>='"."$myyear-$mymonth-$myday 00:00:00"."' and statistics_time<= '"."$myyear-$mymonth-$myday 23:59:59"."' GROUP BY statistics_time";
			$query = $db->query($sql);
			$result = $query->result_array ();
			if (! empty ( $result )) {
				foreach ( $result as $row ) {
					if ($max_num < $row ['num']) {
						$max_num = $row ['num'];
					}
				}
			}
			
			$rr = array ();
			$rr ["合计"] = floor ( $max_num );
			return $rr;
		}

		$rr = array ();
		$rr ["合计"] = - 1;
		return $rr;
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
	
	/**
	 * 导出数据
	 * @param $channelId
	 * @param $forOutter  目前只有欲望都市需要这个字段
	 * @param $startDate
	 * @param $endDate
	 */
	public function exportData($channelId, $forOutter, $startDate, $endDate)
	{
		$this->load->model('Common_model');

		$CI = &get_instance ();
		$db = $CI->load->database ( 'gamebuyee', true );
		
		// 找到统计总数时不需要计入的渠道
		$nochannellist = $this->config->item ( 'no_tongji' );

		$db->where(array(
				'statistics_date >= ' => $startDate,
				'statistics_date <= ' => $endDate,
				));

		$fileName = "";
		if ($channelId != "10000") {
			$channelInfo = $this->Common_model->getChannelInfoById($channelId);
			if ($channelInfo == null)
			{
				return false;
			}
			
			$fileName = "渠道统计报表_" . $channelInfo['name'] . "_{$startDate}_{$endDate}.csv";

			$db->where(array('channelid' => $channelId));
		}
		else 
		{
			foreach ($nochannellist as $k=>$v)
			{
				$db->where(array('channelid <>' => $k));
			}

			$fileName = "渠道统计报表_全部渠道_{$startDate}_{$endDate}.csv";
		}

        header('Content-Type: application/vnd.ms-excel');
        header('Cache-Control: max-age=0');
        header("Content-Disposition: attachment;filename=\"$fileName\"");

		$db->select('statistics_date, sum(new_device_count) as ndc, sum(new_user_count) as nuc, ' . 
				'sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui + lhp_choushui + malai_niuniu_choushui + sangong_choushui + hongheidz_choushui) as total_choushui');
		$db->group_by('statistics_date');
		$db->from('CASINOBUSINESSSTATISTICS');

		$fp = fopen ( 'php://output', 'a' );
		
		$head = array (
				"日期",
				"新增设备数",
				"新增注册数",
				"游戏总抽水",
		);

		foreach ( $head as $i => $v ) {
			$head [$i] = iconv ( 'utf-8', 'gbk', $v );
		}
		
		fputcsv ( $fp, $head );
		
		$cnt = 0;
		$limit = 100000;
		
		$query = $db->get();
		$ret = $this->_dealwith_ret ( $query );
		
		$totalNewDevice = 0;
		$totalNewRegisterUser = 0;
		$totalChoushui = 0;
		foreach ( $ret as $key => $value ) {
			$totalNewDevice += intval($value['ndc']);
			$totalNewRegisterUser += intval($value['nuc']);
			
			// 欲望都市对外的计算方法有一点变化
			if ($forOutter == 1)
			{
				$ret[$key]['total_choushui'] = $this->calcYWDSOutterChoushui($channelId, $value['statistics_date'], floatval($ret[$key]['total_choushui'] / 100));
			}
			else
			{
				$ret[$key]['total_choushui'] = floatval($ret[$key]['total_choushui'] / 100);
			}

			$totalChoushui += $ret[$key]['total_choushui'];
		}
		
		foreach ( $ret as $index => $row ) {
			$cnt ++;
			if ($limit == $cnt) {
				ob_flush ();
				flush ();
				$cnt = 0;
			}
			
			foreach ( $row as $i => $v ) {
				$row [$i] = iconv ( 'utf-8', 'gbk', $v ) . "\t";
			}
			fputcsv ( $fp, $row );
		}
		
		$foot = array (
				"合计",
				"" . $totalNewDevice,
				"" . $totalNewRegisterUser,
				"" . $totalChoushui,
		);

		foreach ( $foot as $i => $v ) {
			$foot [$i] = iconv ( 'utf-8', 'gbk', $v ) . "\t";
		}
		fputcsv ( $fp, $foot );
		
		return true;
	}
	
	private function calcYWDSOutterChoushui($channelId, $date, $choushui)
	{
		if ($channelId == '32' || $channelId == '277')
		{
			$dateRatio = array(
					'2017-02-06' => 0.78,
					'2017-02-09' => 0.75,
					'2017-02-10' => 0.72,
					'2017-02-11' => 0.7,
					'2017-02-12' => 0.68,
					'2017-02-13' => 0.66,
					'2017-02-14' => 0.64,
					'2017-02-15' => 0.62,
					'2017-02-16' => 0.6,
					'2017-05-24' => 0.58,
					'2017-05-25' => 0.57,
					'2017-05-26' => 0.56,
					'2017-05-27' => 0.55,
					'2017-05-28' => 0.54,
					'2017-05-29' => 0.53,
					'2017-05-30' => 0.52,
					'2017-05-31' => 0.51,
					'2017-06-01' => 0.50,
					'2017-06-02' => 0.48,
					'2017-06-03' => 0.46,
					'2017-06-04' => 0.44,
					'2017-06-05' => 0.42,
					'2017-06-06' => 0.4,
					);

			$ratio = 1;
			if (isset($dateRatio[$date]))
			{
				$ratio = $dateRatio[$date];
			}
			else if ($date > '2017-02-16')
			{
				$ratio = 0.6;
			}
			else if ($date >= '2017-01-05')
			{
				$ratio = 0.8;
			}

			return round ( $choushui * $ratio, 2 );
		}
		else if ($channelId == '91006')
		{
			return 0.5;
		}
		else if ($channelId == '91007')
		{
			return 0.5;
		}
		else if ($channelId == '91009')
		{
			return 0.5;
		}
		
		return 1;
	}
	
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "totalreport_model";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
