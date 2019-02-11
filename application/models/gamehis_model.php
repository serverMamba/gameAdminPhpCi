<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class gamehis_model extends MY_Model {
	var $db = null;
	var $payment_tables = null;
	var $dbtables = array (
				"1" => "CASINOGAMERECORD_TexasPoker_",
				"5" => "CASINOGAMERECORD_BaiRenTexasPoker_",
				"17" => "CASINOGAMERECORD_NiuNiuQiangZhuang_",
				"20" => "CASINOGAMERECORD_NiuNiuSeenCardQZ_",
				"21" => "CASINOGAMERECORD_BaiRenNiuNiu_",
				"23" => "CASINOGAMERECORD_NiuNiuMalai_",
				"24" => "CASINOGAMERECORD_SG_",
				"49" => "CASINOGAMERECORD_ZJH_",
				"52" => "CASINOGAMERECORD_BaiRenZhaJinHua_",
				"54" => "CASINOGAMERECORD_BaiRenZhaJinHuaRB_",
				"97" => "CASINOGAMERECORD_DDZ_",
				"98" => "CASINOGAMERECORD_DDZHUANLE_",
				"101" => "CASINOGAMERECORD_DDZLAIZI_"
		);

	public function __construct() {
		parent::__construct ();
	}
	public function get_game_his($userid, $gameid, $mystarttime, $myendtime, $paijuhao, $beginindex) {
		$CI = &get_instance ();
		$db = $CI->load->database ( 'gamehis', true );
		// 判断是否合法的时间
		if (!isValidTime($mystarttime))
		{
			return array();
		}
		 
		if (!isValidTime($myendtime))
		{
			return array();
		}	
		$dbtablesx = $this->dbtables [$gameid];
		$startx = @strtotime ( $mystarttime );
		$endx = @strtotime ( $myendtime );
		
		$where = "where 0=0 ";
		if (strlen ( $userid ) != 0) {
			$where = $where . " and " . " user_id = '$userid'";
		}
		if (strlen ( $mystarttime ) != 0) {
			$where = $where . " and " . " record_timestamp >= '$mystarttime'";
		}
		if (strlen ( $myendtime ) != 0) {
			$where = $where . " and " . " record_timestamp <= '$myendtime'";
		}
		if (strlen ( $paijuhao ) != 0) {
			$where = $where . " and " . " game_number = '$paijuhao'";
		}
		
		if ($gameid == 0)
		{
			$sqltable = "(";
			
			$allGameGeneralFields = "user_id, user_nickname, game_number,room_id,user_game_result,user_table_fee,user_score_begin,user_score_end,earn_score,user_offline_status,isrobot,game_time,record_timestamp";
			
			for($ii = $startx; $ii <= $endx; $ii = $ii + 60 * 60 * 24) 
			{
				foreach ($this->dbtables as $kk=>$vv){
					$tablename = $vv . date ( 'Ymd', $ii );
					$sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
					
					$queryzz = $db->query ( $sqlzz );
					
					$retzz = $this->_dealwith_ret ( $queryzz );
					
					$tableflag1 = count ( $retzz );
					
					if ($tableflag1 > 0) {
						if (strlen ( $sqltable ) > 2) {
							$sqltable = $sqltable . " union all (select $kk as gameId, $allGameGeneralFields from  $tablename $where)";
						} else {
							$sqltable = $sqltable . "(select $kk as gameId, $allGameGeneralFields from  $tablename $where)";
						}
					}
				}
			}
			
			if (strlen ( $sqltable ) < 6) {
				return array (
//						"count" => 0,
                    "count" => 888,
						"detail" => "" 
				);
			}
			$sqltable = $sqltable . ") as aa";
			
			$sql = "select * from $sqltable order by record_timestamp desc limit $beginindex , 20 ";
			$sql1 = "select count(*) as count from $sqltable";

			$query = $db->query ( $sql );
			$ret = $this->_dealwith_ret ( $query );
			
			$query1 = $db->query ( $sql1 );
			$ret1 = $this->_dealwith_ret ( $query1 );
			return array (
//					"count" => $ret1,
                "count" => 888,
					"detail" => $ret 
			);
		}
		else
		{
			$sqltable = "(";
			
			for($ii = $startx; $ii <= $endx; $ii = $ii + 60 * 60 * 24) 
			{
				$tablename = $dbtablesx . date ( 'Ymd', $ii );
				$sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
				
				$queryzz = $db->query ( $sqlzz );
				
				$retzz = $this->_dealwith_ret ( $queryzz );
				
				$tableflag1 = count ( $retzz );
				
				if ($tableflag1 > 0) {
					if (strlen ( $sqltable ) > 2) {
						$sqltable = $sqltable . " union all (select * from  $tablename $where)";
					} else {
						$sqltable = $sqltable . "(select * from  $tablename $where)";
					}
				}
			}
			
			if (strlen ( $sqltable ) < 6) {
				return array (
						"count" => 0,
						"detail" => "" 
				);
			}
			$sqltable = $sqltable . ") as aa";
			
			$sql = "select * from $sqltable order by record_timestamp desc limit $beginindex , 20 ";
			$sql1 = "select count(*) as count from $sqltable";

			$query = $db->query ( $sql );
			$ret = $this->_dealwith_ret ( $query );
			
			$query1 = $db->query ( $sql1 );
			$ret1 = $this->_dealwith_ret ( $query1 );
			return array (
					"count" => $ret1,
					"detail" => $ret 
			);
		}
	}

	// 获取在线数据
	public function getOnlineData ( $userid, $gameid, $startTime, $endTime )
	{
		$CI = &get_instance ();
		$db = $CI->load->database ( 'gamehis', true );
		
		$dbtablesx = $this->dbtables [$gameid];
		
		$oneDaySec = 24 * 3600;
		$days = intval(($endTime - $startTime) / $oneDaySec);
		$sqltable = "";
		
		$where = "";
		if (strlen ( $userid ) != 0) {
			$where = "where user_id = '$userid'";
		}

		for($i = 0; $i < $days; $i++) {
			$dateTime = $startTime + $i * $oneDaySec;
			$tablename = $dbtablesx . date ( 'Ymd', $dateTime );
			$sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
			$queryzz = $db->query ( $sqlzz );
			$retzz = $this->_dealwith_ret ( $queryzz );
			$tableflag1 = count ( $retzz );
			
			if ($tableflag1 > 0) {
				if (strlen ( $sqltable ) > 2) {
					$sqltable = $sqltable . " union select user_game_result,record_timestamp from  $tablename $where";
				} else {
					$sqltable = $sqltable . "select user_game_result,record_timestamp from $tablename $where";
				}
			}
		}
		
		if (strlen ( $sqltable ) < 6) {
			return array ();
		}
		
		$query = $db->query ( $sqltable );
		$ret = $this->_dealwith_ret ( $query );
		return $ret;
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
	
	public function writeLog($txt) {
		$log_file = "/log/gamehis_model.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
}
