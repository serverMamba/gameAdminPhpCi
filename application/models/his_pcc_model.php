<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class his_pcc_model extends MY_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function get_hispccmsg($stime,$etime) {
		$stime = intval($stime);
		$etime = intval($etime);
		if($stime < strtotime('2016-10-01 00:00:00')){
			$stime = strtotime('2016-10-01 00:00:00');
		}
		if($etime > time()){
			$etime = time();
		}
		$starttime = date('Y-m-d', $stime);
		$endtime = date('Y-m-d', $etime);
		$CI = &get_instance ();
		$db = $CI->load->database ( 'gamebuyee', true );
		
		$sql = "SELECT
					statistics_date,
					sum(pay_total_money) / 100 AS sum_total_pay,
					sum(cash_money+cash_money1) / 100 AS sum_total_cash,
					sum(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui + lhp_choushui + malai_niuniu_choushui + sangong_choushui + hongheidz_choushui)/100 as sum_total_choushui,
					0 as sum_total_pcc
				FROM
					CASINOBUSINESSSTATISTICS t
				WHERE
					statistics_date >= '$starttime'
				AND statistics_date <= '$endtime'
				GROUP BY
					statistics_date";
		$this->writeLog(strtotime($starttime)."-".strtotime($endtime).">>>$sql");
		$query = $db->query ( $sql );
		$db->close ();
		$ret = $this->_dealwith_ret ( $query );
		
		$ret_pay = array();
		$ret_cash = array();
		$ret_choushui = array();
		$ret_pcc = array();
		foreach ($ret as $row){
			array_push($ret_pay,array("tm"=>$row['statistics_date'],"ct"=>intval($row['sum_total_pay'])));
			array_push($ret_cash,array("tm"=>$row['statistics_date'],"ct"=>intval($row['sum_total_cash'])));
			array_push($ret_choushui,array("tm"=>$row['statistics_date'],"ct"=>intval($row['sum_total_choushui'])));
			array_push($ret_pcc,array("tm"=>$row['statistics_date'],"ct"=>(intval($row['sum_total_pay'])-intval($row['sum_total_cash'])-intval($row['sum_total_choushui']))));
		}
		$res = array("sum_total_pay"=>$ret_pay,"sum_total_cash"=>$ret_cash,"sum_total_choushui"=>$ret_choushui,"sum_total_pcc"=>$ret_pcc,"min_time"=>strtotime($starttime),"max_time"=>strtotime($endtime));
		return $res;
	}
	
	public function writeLog($txt) {
		if(!$txt)
		{
			return 1;
		}
		$fileName = "/log/hispcc.log";
		$myfile = fopen($fileName, "a+");
		if($myfile)
		{
			$txt = "[" . date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
			fwrite($myfile, $txt);
			fclose($myfile);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
}
