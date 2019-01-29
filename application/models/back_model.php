<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class back_model extends MY_Model {
	var $db = null;
	var $payment_tables = null;
	public function __construct() {
		parent::__construct ();
		$this->load->model ( 'usernew_mid_model' );
	}
	public function save_single_data($id, $userid, $data) {
		$this->load->model ( 'usernew_mid_model' );
		$from = "1857803";
		$to = trim ( $userid );
		$msg = trim ( $data );
		$mysqlid = trim ( $id );
		
		$updatesql = "UPDATE  CASINOQUESTION SET answer = '$msg' WHERE id = $mysqlid";
		
		$CI = &get_instance ();
		$db = $CI->load->database ( 'globalinfo', true );
		
		$query = $db->query ( $updatesql );
		$this->_dealwith_ret ( $query );
		$this->usernew_mid_model->add_offline_msg ( $from, $to, $msg );
	}
	public function get_single_data($userid) {
		$CI = &get_instance ();
		$db = $CI->load->database ( 'globalinfo', true );
		
		$query = $db->query ( "select * from  CASINOGLOBALINFO.CASINOQUESTION  where userid = '$userid' order by ytime desc;" );
		$ret = $this->_dealwith_ret ( $query );
		return $ret;
	}
	public function get_back_message() {
		$CI = &get_instance ();
		$db = $CI->load->database ( 'globalinfo', true );
		
		$query = $db->query ( "select userid,max(ytime) as tt ,count(ytime) as cc ,qmsg,answer from  CASINOGLOBALINFO. CASINOQUESTION group by userid order by tt desc limit 300;" );
		$ret = $this->_dealwith_ret ( $query );
		return array (
				"count" => $query->num_rows(),
				"detail" => $ret,
				"account" => '',
				"nickname" => '',
				"status" => "0" 
		);
	}
	public function get_dindan_his($userid, $statusid, $gameid, $mystarttime, $myendtime, $account, $beginindex) {
		$CI = &get_instance ();
		$db = $CI->load->database ( 'gamebuy', true );
		$userid = intval($userid);
		// 判断是否合法的时间
		if (!isDate($mystarttime))
		{
			return array("count"=>0,"detail"=>"");
		}
		
		if (!isDate($myendtime))
		{
			return array("count"=>0,"detail"=>"");
		}	
		$startx = @strtotime ( $mystarttime );
		$endx = @strtotime ( $myendtime );
		
		if (! empty ( $account )) {
			if (! is_numeric ( $account )) {
				$ret = $this->usernew_mid_model->account2id1 ( $account );
				$userid = $ret ['userid'];
			}
		}
		
		$where = "where ((ordertime  >= '$mystarttime' and  ordertime <= '$myendtime') or (ordertime1  >= '$mystarttime' and  ordertime1 <= '$myendtime'))";
		
		if (! empty ( $userid )) {
			$where = $where . " and userid = $userid ";
			$userinfo = $this->usernew_mid_model->query_user_info ( $userid );
			$account = $userinfo ["defailUserInfo"] ["userAccount"];
			$nickname = $userinfo ["basicUserInfo"] ["userNick"];
		}
		
		if ($statusid != "999") {
			$where = $where . " and callbackstatus = $statusid ";
		}
		
		if ($gameid != "0") {
			$where = $where . " and gameid = $gameid ";
		}
		
		$sqltable = "(";
		
		for($ii = $startx; $ii <= $endx; $ii = $ii + 60 * 60 * 24 * 30) {
			
			$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', $ii );
			$sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
			
			$queryzz = $db->query ( $sqlzz );
			
			$retzz = $this->_dealwith_ret ( $queryzz );
			
			$tableflag1 = count ( $retzz );
			
			if ($tableflag1 > 0) {
				if (strlen ( $sqltable ) > 2) {
					$sqltable = $sqltable . " union all (select * from  $tablename $where )";
				} else {
					$sqltable = $sqltable . "(select * from  $tablename $where )";
				}
			}
		}
		
		$sqltable = $sqltable . ") as aa";
		
		$sql = "select * from $sqltable order by aa.id desc limit $beginindex , 20 ";
		
		$sql1 = "select count(*) as count from $sqltable";
		
		$query = $db->query ( $sql );
		$ret = $this->_dealwith_ret ( $query );
		
		$query1 = $db->query ( $sql1 );
		$ret1 = $this->_dealwith_ret ( $query1 );
		return array (
				"count" => $ret1,
				"detail" => $ret,
				"account" => $account,
				"nickname" => $nickname,
				"status" => "0" 
		);
	}
	public function get_currmonth($userid, $paytype) {
		$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', time () );
		
		$tablename1 = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', strtotime ( '-1 month', time () ) );
		
		$CI = &get_instance ();
		$db = $CI->load->database ( 'hisorder', true );
		
		$endtime = date ( 'Y-m-d H:i:s', time () );
		
		$starttime = date ( 'Y-m-d H:i:s', time () - 24 * 60 * 60 * 30 );
		
		$sql1 = "select sum(money) summoney from $tablename where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
		$query1 = $db->query ( $sql1 );
		$ret1 = $this->_dealwith_ret ( $query1 );
		
		$sql2 = "select sum(money) summoney from $tablename1 where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
		$query2 = $db->query ( $sql2 );
		$ret2 = $this->_dealwith_ret ( $query2 );
		
		$ret = $ret1 [0] ["summoney"] + $ret2 [0] ["summoney"];
		
		return $ret;
	}
	public function get_near_order($userid) {
		$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', time () );
		$CI = &get_instance ();
		$db = $CI->load->database ( 'hisorder', true );
		
		$sql = "select max(ordertime) maxtime from $tablename where userid = '$userid' ";
		$query = $db->query ( $sql );
		
		return $this->_dealwith_ret ( $query );
	}
	public function getorder($orderid) {
		$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', time () );
		$CI = &get_instance ();
		$db = $CI->load->database ( 'hisorder', true );
		
		$sql = "select * from $tablename where orderid = '$orderid'";
		$query = $db->query ( $sql );
		
		return $this->_dealwith_ret ( $query );
	}
	public function updateorder($orderid, $realmoney, $callbacktime, $callbackstatus) {
		$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', time () );
		$CI = &get_instance ();
		$db = $CI->load->database ( 'hisorder', true );
		
		$record = array (
				"callbacktime" => $callbacktime,
				"realmoney" => $realmoney,
				"callbackstatus" => $callbackstatus 
		);
		$db->where ( 'orderid', $orderid );
		$ret = $db->update ( $tablename, $record );
		return $ret;
	}
	public function insertorder($ordertime, $callbacktime, $deviceid, $userid, $gamecode, $gameid, $paytype, $producttype, $productid, $channel, $carrier, $mobile, $ip, $orderid, $money, $realmoney, $callbackstatus) {
		$tablename = "CASINOTABLECUSTOMPAYORDER" . date ( 'Y_n', time () );
		$CI = &get_instance ();
		$db = $CI->load->database ( 'hisorder', true );
		$data = array (
				"ordertime" => $ordertime,
				"callbacktime" => $callbacktime,
				"deviceid" => $deviceid,
				"userid" => $userid,
				"gamecode" => $gamecode,
				"gameid" => $gameid,
				"paytype" => $paytype,
				"producttype" => $producttype,
				"productid" => $productid,
				"channel" => $channel,
				"carrier" => $carrier,
				"mobile" => $mobile,
				"ip" => $ip,
				"orderid" => $orderid,
				"money" => $money,
				"realmoney" => $realmoney,
				"callbackstatus" => $callbackstatus 
		);
		$db->insert ( $tablename, $data );
		// $db->trans_commit();
		return $db->affected_rows ();
	}
}
