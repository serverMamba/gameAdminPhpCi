<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$step = 1;
if (isset ( $argv [1] )) {
	$step = $argv [1];
	if ($step <= 0) {
		$step = 1;
	}
} else {
	$step = 1;
}

$line = "\n";
$db_default = $db ['default'];
$db_stat = $db ['gamebuyee'];
$table_to = 'CASINOTGINCOMESTAT';

$date_yestaday = date ( 'Y-m-d', time () - 3600 * 24 * $step );
$db_time_start = strtotime ( $date_yestaday . ' 00:00:00' );
writeLog ( $date_yestaday );

doStatIncome ( $date_yestaday, $config ['channellist'], $db_default, $db_stat );
function doStatIncome($date_yestaday, $channellist, $db_default, $db_stat) {
	$statAccountArr = getStatAccount ( $db_default );
	$num = 0;
	if ($statAccountArr) {
		foreach ( $statAccountArr as $member ) {
			$res_data = getIncomeStatistics ( $member, $date_yestaday, $date_yestaday, $channellist, json_decode ( $member ['channel_priv'] ), $db_default, $db_stat );
			addStatRecord($res_data,$date_yestaday,$member,$db_stat);
			updateBlance($res_data,$date_yestaday,$member,$db_default,$db_stat);
		}
	}
}
function getDBRes($sql, $conn) {
	return tranDbResToArr ( mysql_query ( $sql, $conn ) );
}
function getArr0($query) {
	if ($query && count ( $query ) > 0) {
		foreach ( $query as $row ) {
			return $row;
		}
	}
	return array ();
}
function tranDbResToArr($query) {
	$res_arr = array ();
	if ($query && mysql_num_rows ( $query ) > 0) {
		while ( $row = mysql_fetch_assoc ( $query ) ) {
			array_push ( $res_arr, $row );
		}
	}
	return $res_arr;
}
function getStatAccount($db_default) {
	$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn_default) {
		exit ( 'connection default lose' . $line );
	}
	mysql_select_db ( $db_default ['database'], $conn_default );
	
	$sql = "SELECT id,account,channel_priv,commission,commission_show,balance from smc_tg_account where account='test'";
	$result = getDBRes ( $sql, $conn_default );
	mysql_close ( $conn_default );
	return $result;
}
function updateBlance($result,$day,$member,$db_default,$db_stat){
	$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn_default) {
		exit ( 'connection default lose' . $line );
	}
	mysql_select_db ( $db_default ['database'], $conn_default );
	$his_db = mysql_connect ( $db_stat ['hostname'], $db_stat ['username'], $db_stat ['password'] );
	if (! $his_db) {
		exit ( 'connection stat lose' . $line );
	}
	mysql_select_db ( $db_stat ['database'], $his_db );
	
	$sql = "SELECT count(id) as num_log from CASINOTGBLANCELOG where stat_account_id=".$member['id']." and statistics_date='".$day."'";
	$reslog = getArr0(getDBRes ( $sql, $his_db ));
	if($reslog['num_log']<=0){
		if($result && array_key_exists("total_income",$result)){
			$sql0 = "update smc_tg_account set balance=balance+".$result['total_income']." where stat_account_id=".$member['id'];
			writeLog($sql0);
			//$flag0 = mysql_query ( $sql0, $conn_default );
			$sql1 = "insert into CASINOTGBLANCELOG(stat_account_id,stat_account,start_balance,day_income_amount,addtime,statistics_date)"
					." values(".$member['id'].",'".$member['account']."',".$member['balance'].",".$result['total_income'].",'".date("Y-m-d H:i:s", time())."','".$day."')";
			$flag1 = mysql_query ( $sql1, $his_db );
		}
	}
	
	mysql_close ( $his_db );
	mysql_close ( $conn_default );
}
function addStatRecord($result,$day,$member,$db_stat){
	$num = 0;
	$his_db = mysql_connect ( $db_stat ['hostname'], $db_stat ['username'], $db_stat ['password'] );
	if (! $his_db) {
		exit ( 'connection stat lose' . $line );
	}
	mysql_select_db ( $db_stat ['database'], $his_db );
	
	if($result && array_key_exists($day,$result) && $result[$day]){
		$sql0 = "delete from CASINOTGINCOMESTAT where stat_account_id=".$member['id']." and statistics_date='".$day."'";
		$flag0 = mysql_query ( $sql0, $his_db );
		foreach ($result[$day] as $rdata){
			$r_commission_amount = $rdata['commission_amount']?$rdata['commission_amount']:0;
			$r_name = array_key_exists("name",$rdata)?$rdata['name']:"";
			$r_account_id = array_key_exists("account_id",$rdata)?$rdata['account_id']:0;
			$r_income_amount = array_key_exists("income_amount",$rdata)?$rdata['income_amount']:0;
			$r_commission = array_key_exists("commission",$rdata)?$rdata['commission']:0;
			$r_agent_name = array_key_exists("agent_name",$rdata)?$rdata['agent_name']:"";
			$r_promotion_id = array_key_exists("promotion_id",$rdata)?$rdata['promotion_id']:0;
			$r_channel_id = array_key_exists("channel_id",$rdata)?$rdata['channel_id']:0;
			$sql1 = "insert into CASINOTGINCOMESTAT(stat_account_id,stat_account,stat_commission,statistics_date,"
					."commission_amount,name,account_id,income_amount,commission,agent_name,promotion_id,channel_id) "
					 ." values(".$member['id'].",'".$member['account']."',".$member['commission'].",'".$day."',"
					 		.$r_commission_amount.",'".$r_name."',".$r_account_id.",".$r_income_amount.",".$r_commission
							.",'".$r_agent_name."',".$r_promotion_id.",".$r_channel_id.")";
			$flag1 = mysql_query ( $sql1, $his_db );
		}
	}
	
	mysql_close ( $his_db );
}
function getIncomeStatistics($member, $start_date, $end_date, $channellist, $channel_priv, $db_default, $db_stat) {
	$member_channel_priv_array = $channel_priv;
	$channel_list_ary = $channellist;
	$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn_default) {
		exit ( 'connection default lose' . $line );
	}
	mysql_select_db ( $db_default ['database'], $conn_default );
	$his_db = mysql_connect ( $db_stat ['hostname'], $db_stat ['username'], $db_stat ['password'] );
	if (! $his_db) {
		mysql_close ( $conn_default );
		exit ( 'connection stat lose' . $line );
	}
	mysql_select_db ( $db_stat ['database'], $his_db );
	
	$return_ary = array ();
	$return_ary ['total_income'] = 0;
	$return_ary ['total_mission'] = 0;
	$members_promotion_list = array ();
	
	$sql = "select `id`,name from smc_tg_promotion where tg_account_id=" . $member ['id'];
	$pq = getDBRes ( $sql, $conn_default );
	foreach ( $pq as $row ) {
		$members_promotion_list [$row['id']] = $row['name'];
	}
	$start_time = strtotime ( $start_date . ' 00:00:00' );
	$end_time = strtotime ( $end_date . ' 00:00:00' );
	
	for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
		$day = date ( 'Y-m-d', $i );
		$db_day = date ( 'Ymd', $i );
		$return_ary [$day] = array ();
		// 包
		if (is_array ( $member_channel_priv_array ) && ! empty ( $member_channel_priv_array )) {
			foreach ( $member_channel_priv_array as $channel_id ) {
				$sql1 = "select IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui + sangong_choushui + hongheidz_choushui),0) AS c from CASINOBUSINESSSTATISTICS where statistics_date='" . $day . "' and channelid=$channel_id limit 1";
				$query = getDBRes ( $sql1, $his_db );
				$row0 = getArr0 ( $query );
				if ($row0 && $row0 ['c']) {
					array_push ( $return_ary [$day], array (
							'commission_amount' => $row0 ['c'],
							'name' => $channel_list_ary [$channel_id],
							'account_id' => $member ['id'],
							'income_amount' => $row0 ['c'] * $member ['commission'] 
					) );
				}
			}
		}
		
		// 直推
		if (! empty ( $members_promotion_list )) {
			foreach ( $members_promotion_list as $pid => $pname ) {
				$sql1 = " select IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui + sangong_choushui + hongheidz_choushui),0) AS c from CASINOPROMOTIONSTAT where statistics_date='" . $day . "' and promotionid=$pid limit 1 ";
				$query = getDBRes ( $sql1, $his_db );
				$row0 = getArr0 ( $query );
				if ($row0 && $row0 ['c']) {
					$tmp = array (
							'promotion_id' => $pid,
							'commission_amount' => $row0 ['c'],
							'name' => $pname,
							'account_id' => $member ['id'],
							'income_amount' => $row0 ['c'] * $member ['commission'] 
					);
					if ($member ['commission_show'] > 0) {
						$tmp ['commission_amount'] = $tmp ['income_amount'] / $member ['commission_show'];
					}
					array_push ( $return_ary [$day], $tmp );
				}
			}
		}
		
		// 查自己的下级代理
		// 下级代理要先查出来，因为每个下级代理的提成不一样。。。要分别计算
		$sql1 = "select a.id,a.channel_name,a.commission,a.account,a.channel_priv from smc_tg_account a where a.parent_id=" . $member ['id'];
		$pq1 = getDBRes ( $sql1, $conn_default );
		if (count ( $pq1 ) > 0) {
			foreach ( $pq1 as $row_c ) {
				// 包
				$channel_ary = array ();
				// 下级代理的直推包
				if ($row_c && $row_c['channel_priv']) {
					$child_channel_ary = json_decode ( $row_c['channel_priv'], true );
					if (! empty ( $child_channel_ary )) {
						foreach ( $child_channel_ary as $cca ) {
							array_push ( $channel_ary, $cca );
						}
					}
				}
				if ($row_c && $row_c['id']){
					// 下级代理的下级代理所有包
					$channel_ary = getChildPackageByAccount ( $row_c['id'], $conn_default, $channel_ary );
				}
				
				foreach ( $channel_ary as $ca ) {
					$sql2 = "select IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui + sangong_choushui + hongheidz_choushui),0) AS c from CASINOBUSINESSSTATISTICS where statistics_date='" . $day . "' and channelid=$ca limit 1";
					$query = getDBRes ( $sql2, $his_db );
					$row0 = getArr0 ( $query );
					if ($row0 && $row0 ['c']) {
						array_push ( $return_ary [$day], array (
								'channel_id' => $ca,
								'commission_amount' => $row0 ['c'],
								'name' => $channel_list_ary [$ca],
								'agent_name' => $row_c['channel_name'],
								'account_id' => $row_c['id'],
								'commission' => $row_c['commission'],
								'income_amount' => $row0 ['c'] * ($member ['commission'] - $row_c['commission']) 
						) );
					}
				}
				
				// 推广链
				$promotion_ids_ary = array ();
				if($row_c && $row_c['id']){
					// 先统计下级代理的直推
					$sql1 = "select p.id,p.name from smc_tg_promotion p where p.tg_account_id=" . $row_c['id'];
					$pq = getDBRes ( $sql1, $conn_default );
					if (count ( $pq ) > 0) {
						foreach ( $pq as $row1 ) {
							array_push ( $promotion_ids_ary, $row1['id'] );
						}
					}
					// 然后递归统计下级代理的下级代理所有的推广
					$promotion_ids_ary = getPromotionIdsByAccount ( $row_c['id'], $conn_default, $promotion_ids_ary );
				}
				
				foreach ( $promotion_ids_ary as $pid ) {
					$promotion_info = getPromotionInfoNoPriv ( $pid, $conn_default );
					$sql2 = "select  IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money+zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui + sangong_choushui + hongheidz_choushui),0) AS c from CASINOPROMOTIONSTAT where statistics_date='" . $day . "' and promotionid=$pid limit 1";
					$query = getDBRes ( $sql2, $his_db );
					$row0 = getArr0 ( $query );
					if ($row0 && $row0 ['c']) {
						array_push ( $return_ary [$day], array (
								'promotion_id' => $pid,
								'commission_amount' => $row0 ['c'],
								'name' => $promotion_info ['name'],
								'agent_name' => $row_c['channel_name'],
								'account_id' => $row_c['id'],
								'commission' => $row_c['commission'],
								'income_amount' => $row0 ['c'] * ($member ['commission'] - $row_c['commission']) 
						) );
					}
				}
			}
		}
		
		if (! empty ( $return_ary [$day] )) {
			// 合计
			$total_ary = array (
					'name' => 'total_day' 
			);
			foreach ( $return_ary [$day] as $k => $v ) {
				! isset ( $total_ary ['commission_amount'] ) ? $total_ary ['commission_amount'] = $v ['commission_amount'] : $total_ary ['commission_amount'] += $v ['commission_amount'];
				! isset ( $total_ary ['income_amount'] ) ? $total_ary ['income_amount'] = $v ['income_amount'] : $total_ary ['income_amount'] += $v ['income_amount'];
			}
			
			$return_ary ['total_income'] += $total_ary ['income_amount'];
			$return_ary ['total_mission'] += $total_ary ['commission_amount'];
			//array_push ( $return_ary [$day], $total_ary );
		} else {
			unset ( $return_ary [$day] );
		}
	}
	
	
	mysql_close ( $conn_default );
	mysql_close ( $his_db );
	writeLog ( $member ['id'] ."-". $return_ary['total_income'] );
	writeLog ( json_encode($return_ary) );
	return $return_ary;
}

// 递归取下级代理所有的包
function getChildPackageByAccount($account_id, $conn_default, $channel_array) {
	$sql = "select id,channel_priv from smc_tg_account where parent_id=$account_id";
	$pq1 = getDBRes ( $sql, $conn_default );
	if (count ( $pq1 ) > 0) {
		foreach ( $pq1 as $row ) {
			if ($row['channel_priv']) {
				$channel_priv_ary = json_decode ( $row['channel_priv'] );
				if (! empty ( $channel_priv_ary )) {
					foreach ( $channel_priv_ary as $cc ) {
						if (! in_array ( $cc, $channel_array )) {
							array_push ( $channel_array, $cc );
						}
					}
				}
			}
			$channel_array = getChildPackageByAccount ( $row['id'], $conn_default, $channel_array );
		}
	}
	return $channel_array;
}
// 递归取出下级代理所有的推广
function getPromotionIdsByAccount($account_id, $conn_default, $promotion_ids_ary) {
	$sql = "select p.id,a.id AS account_id from smc_tg_promotion p join smc_tg_account a on p.tg_account_id = a.id and a.parent_id=$account_id";
	$pq1 = getDBRes ( $sql, $conn_default );
	if (count ( $pq1 ) > 0) {
		foreach ( $pq1 as $row ) {
			array_push ( $promotion_ids_ary, $row['id'] );
			$promotion_ids_ary = getPromotionIdsByAccount ( $row['account_id'], $conn_default, $promotion_ids_ary );
		}
	}
	return $promotion_ids_ary;
}
function getPromotionInfoNoPriv($promotion_id, $conn_default) {
	$sql = "select id,promotion_url,tg_account_id,short_url,name from smc_tg_promotion where id=$promotion_id limit 1";
	$query = getDBRes ( $sql, $conn_default );
	return getArr0 ( $query );
}
function writeLog($txt) {
	echo "[" . date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
}
function test001() {
	$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn_default) {
		exit ( 'connection default lose' . $line );
	}
	mysql_select_db ( $db_default ['database'], $conn_default );
	
	$conn_stat = mysql_connect ( $db_stat ['hostname'], $db_stat ['username'], $db_stat ['password'] );
	if (! $conn_stat) {
		exit ( 'connection stat lose' . $line );
	}
	mysql_select_db ( $db_stat ['database'], $conn_stat );
	
	mysql_close ( $conn_default );
	mysql_close ( $conn_stat );
}


