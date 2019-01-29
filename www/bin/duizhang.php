<?php
set_time_limit ( 0 );
ini_set ( 'default_socket_timeout', - 1 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

if (isset ( $argv [1] )) {
	$step = $argv [1];
} else {
	$step = 1;
}

$db_201 = $db ['gamebuyee'];
$conn_201 = mysql_pconnect ( $db_201 ['hostname'], $db_201 ['username'], $db_201 ['password'] );
if (! $conn_201) {
	exit ( 'connection lose' . "\n" );
}
mysql_query ( "SET NAMES 'utf8'" );

$db_202 = $db ['default'];
$conn_202 = mysql_pconnect ( $db_202 ['hostname'], $db_202 ['username'], $db_202 ['password'] );
if (! $conn_202) {
	exit ( 'connection lose' . "\n" );
}
mysql_query ( "SET NAMES 'utf8'" );

$db_235 = $db ['gamehis'];
$conn_235 = mysql_pconnect ( $db_235 ['hostname'], $db_235 ['username'], $db_235 ['password'] );
if (! $conn_235) {
	exit ( 'connection lose' . "\n" );
}
mysql_query ( "SET NAMES 'utf8'" );

$date = date ( 'Ymd', time () - 3600 * $step );
$date_db = date ( 'YmdH', time () - 3600 * $step );
$db_time_start = strtotime ( $date_db . '0000' );
$db_time_end = $db_time_start + 3600;
$db_time_start_show = date ( 'Y-m-d H:i:s', $db_time_start );
$db_time_end_show = date ( 'Y-m-d H:i:s', $db_time_end );
$db_date_insert = date ( 'YmdH', $db_time_start ) . '-' . date ( 'YmdH', $db_time_end );

$sql = "SELECT id FROM CASINOSTATDB.CASINORECONCILIATION WHERE date = '$db_date_insert' LIMIT 1";
$query = mysql_query ( $sql, $conn_201 );
if (mysql_num_rows ( $query ) > 0) {
	$sql = "DELETE FROM CASINOSTATDB.CASINORECONCILIATION WHERE date = '$db_date_insert'";
	mysql_query ( $sql, $conn_201 );
}

$sql = "SELECT sumchips,sumcofferchips FROM CASINOSTATDB.CASINOSUMCHIPHISTORY WHERE stattime >= '$db_time_start_show' order by stattime limit 1";
$query = mysql_query ( $sql, $conn_201 );
$start_chips = intval ( mysql_result ( $query, 0, 'sumchips' ) ) + intval ( mysql_result ( $query, 0, 'sumcofferchips' ) );

$sql = "SELECT sumchips,sumcofferchips FROM CASINOSTATDB.CASINOSUMCHIPHISTORY WHERE stattime >= '$db_time_end_show' order by stattime limit 1";
$query = mysql_query ( $sql, $conn_201 );
$end_chips = intval ( mysql_result ( $query, 0, 'sumchips' ) ) + intval ( mysql_result ( $query, 0, 'sumcofferchips' ) );

$change_chips = $end_chips - $start_chips;

// 充值加的金币
$sql = "SELECT SUM(money) AS recharge_chpis FROM db_smc.smc_order WHERE status = 1 AND pay_success_time >= '$db_time_start' AND pay_success_time < '$db_time_end'";
$query = mysql_query ( $sql, $conn_202 );
$recharge_chpis = intval ( mysql_result ( $query, 0, 'recharge_chpis' ) );

// 提现
$sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE status = 1 AND add_time >= '$db_time_start' AND add_time < '$db_time_end'";
$query = mysql_query ( $sql, $conn_201 );
$cash_money1 = intval ( mysql_result ( $query, 0, 'cash_chips' ) );

$sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE status = 1 AND add_time >= '$db_time_start' AND add_time < '$db_time_end'";
$query = mysql_query ( $sql, $conn_202 );
$cash_money2 = intval ( mysql_result ( $query, 0, 'cash_chips' ) );

$cash_money = $cash_money1 + $cash_money2;

// 提现退款
// $sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE status = 2 AND update_time >= '$db_time_start' AND add_time < '$db_time_end'";
// $query = mysql_query ( $sql, $conn_201 );
// $tuikuan1 = intval ( mysql_result ( $query, 0, 'cash_chips' ) );

// $sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE status = 2 AND update_time >= '$db_time_start' AND update_time < '$db_time_end'";
// $query = mysql_query ( $sql, $conn_202 );
// $tuikuan2 = intval ( mysql_result ( $query, 0, 'cash_chips' ) );
// $cash_money = $cash_money - $tuikuan1 - $tuikuan2;

$total_choushui = 0;
// 抽水
//斗地主
$sql = "select SUM(earn_score) as ddz_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_DDZ_$date WHERE room_id > 0 AND record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'ddz_choushui' ) );
//欢乐斗地主
$sql = "select SUM(earn_score) as huanle_ddz_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_DDZHUANLE_$date WHERE room_id > 0 AND record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'huanle_ddz_choushui' ) );
//癞子
$sql = "select SUM(earn_score) as laizi_ddz_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_DDZLAIZI_$date WHERE room_id > 0 AND record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'laizi_ddz_choushui' ) );
//扎金花
$sql = "select SUM(earn_score) as zjh_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_ZJH_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'zjh_choushui' ) );
//百人扎金花
// $sql = "select SUM(earn_score) as zjh_bairen_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_BaiRenZhaJinHua_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
// $query = mysql_query ( $sql, $conn_235 );
// $total_choushui += intval ( mysql_result ( $query, 0, 'zjh_bairen_choushui' ) );
//牛牛
$sql = "select SUM(earn_score) as niuniu_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuQiangZhuang_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'niuniu_choushui' ) );
//牛牛看牌
$sql = "select SUM(earn_score) as niuniu_seedcard_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuSeenCardQZ_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'niuniu_seedcard_choushui' ) );
//马来牛牛
$sql = "select SUM(earn_score) as malai_niuniu_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuMalai_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'malai_niuniu_choushui' ) );
//三公
$sql = "select SUM(earn_score) as sangong_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_SG_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'sangong_choushui' ) );

//红黑大战
$sql = "select SUM(earn_score) as hongheidz_choushui from CASINOGAMEHISDB.CASINOGAMERECORD_BaiRenZhaJinHuaRB_$date WHERE record_timestamp >= '$db_time_start_show' AND record_timestamp < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$total_choushui += intval ( mysql_result ( $query, 0, 'hongheidz_choushui' ) );

//捕鱼
$buyuchoushui = 0;
$sql = "select SUM(earnscore*-1) as buyu_choushui from CASINOGAMEHISDB.CASINOFISHINGENTERLEAVERECORD$date WHERE recordtime >= '$db_time_start_show' AND recordtime < '$db_time_end_show'";
// $sql = "SELECT userid,substring_index(group_concat(totalplayscore ORDER BY totalplayscore ASC),',',1) AS tp,substring_index(group_concat(totalwinscore ORDER BY totalwinscore DESC),',',1) AS ts FROM CASINOGAMEHISDB.CASINOFISHGAMERECORD$date 
// 		where recordtime >= '$db_time_start_show' and recordtime < '$db_time_end_show' GROUP BY userid";
$query = mysql_query ( $sql, $conn_235 );
// while ( $row = mysql_fetch_assoc ( $query ) ) {
// 	$total_choushui += intval(($row['tp'] + $row['ts']) * -1);
// 	$buyuchoushui +=  intval(($row['tp'] + $row['ts']) * -1);
// 	//echo $buyuchoushui."\n";
// }
//echo $buyuchoushui;
$total_choushui += intval ( mysql_result ( $query, 0, 'buyu_choushui' ) );

//注册送金币
$sql = "select count(*) AS register_num from CASINOGAMEHISDB.CASINOREGISTERHISTORY$date WHERE registertime >= '$db_time_start_show' AND registertime < '$db_time_end_show'";
$query = mysql_query ( $sql, $conn_235 );
$register_num = intval ( mysql_result ( $query, 0, 'register_num' ) );
$register_chips = $register_num * 300;

//绑手机送金币
$sql = "select sum(chips) AS chips from CASINOGAMEHISDB.CASINOGAMEHISTORY$date where eventtype = '40' and happentime >= '$db_time_start_show' and happentime < '$db_time_end_show';";
$query = mysql_query ( $sql, $conn_235 );
$phone_chips = intval ( mysql_result ( $query, 0, 'chips' ) );

$sql = "INSERT INTO CASINOSTATDB.CASINORECONCILIATION (date,change_chips,recharge_chips,cash_chips,choushui_chips,register_chips,listorder,bind_phone_chips) 
		VALUES ('$db_date_insert','$change_chips','$recharge_chpis','$cash_money','$total_choushui','$register_chips','$date_db','$phone_chips')";
mysql_query ( $sql, $conn_201 );

mysql_close ( $conn_201 );
mysql_close ( $conn_202 );
mysql_close ( $conn_235 );