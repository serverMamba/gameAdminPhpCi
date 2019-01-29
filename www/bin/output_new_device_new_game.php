<?php
error_reporting ( E_ALL );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

if (isset ( $argv [1] )) {
	$db_date = $argv [1];
} else {
	$db_date = date ( 'Ymd' );
}

$line = "\n";
$db_default = $db ['default'];
$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn );
mysql_query ( "SET NAMES 'utf8'" );

$db_u1 = $db ['gamebuyee'];
$conn_u1 = mysql_connect ( $db_u1 ['hostname'], $db_u1 ['username'], $db_u1 ['password'] );
if (! $conn_u1) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_u1 ['database'], $conn_u1 );
mysql_query ( "SET NAMES 'utf8'" );

$db_his = $db ['gamehis'];
$conn_his = mysql_connect ( $db_his ['hostname'], $db_his ['username'], $db_his ['password'] );
if (! $conn_his) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_his ['database'], $conn_his );
mysql_query ( "SET NAMES 'utf8'" );
//
$sql = "select r.userid from CASINOREGISTERHISTORY$db_date AS r WHERE r.newdevice = 1 AND exists (select * from CASINOGAMEHISTORY$db_date AS l where l.eventtype in (1, 2) and l.userid = r.userid)";
$query = mysql_query ( $sql, $conn_his );
while ( $row = mysql_fetch_array ( $query, MYSQL_ASSOC ) ) {
	$user_id = $row ['userid'];
	$tmp = $user_id & 0x00000000000000FF;
	$dbx = ($tmp & 0xF0) >> 4;
	$server = 'eus' . $dbx;
	$posx = $tmp & 0x0F;
	$sql_user = "SELECT * FROM CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx WHERE userid = '$user_id' LIMIT 1";
	if ($dbx <= 7) {
		$query22 = mysql_query ( $sql_user, $conn_u1 );
	} else {
		$query22 = mysql_query ( $sql_user, $conn );
	}
	
	$db_index = mysql_result ( $query22, 0, 'dbindex' );
	$table_index = mysql_result ( $query22, 0, 'tableindex' );
	
	$sql_user1 = "SELECT id,nickname,password,registertime,lastLoginIp,user_chips,user_level,ip,mac,channel_id,alipay_real_name,alipay_account,alipay_change_time,totalBuy,total_total_money
				FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id' LIMIT 1";
	if ($db_index <= 7) {
		$query222 = mysql_query ( $sql_user1, $conn_u1 );
	} else {
		$query222 = mysql_query ( $sql_user1, $conn );
	}
	
	$registerip = mysql_result ( $query222, 0, 'ip' );
	$registertime = mysql_result ( $query222, 0, 'registertime' );
	$lastloginip = mysql_result ( $query222, 0, 'lastLoginIp' );
	$alipay_account = mysql_result ( $query222, 0, 'alipay_account' );
	$alipay_real_name = mysql_result ( $query222, 0, 'alipay_real_name' );
	$totalBuy = mysql_result ( $query222, 0, 'totalBuy' );
	$total_total_money = mysql_result ( $query222, 0, 'total_total_money' );
	$channel_id = mysql_result ( $query222, 0, 'channel_id' );
	$user_chips = mysql_result ( $query222, 0, 'user_chips' );
	
	$sql_i = "INSERT INTO smc_tmp (user_id,registerip,registertime,lastloginip,alipay_account,alipay_real_name,user_chips,total_buy,total_total_money,channel_id)
		VALUES ('$user_id','$registerip','$registertime','$lastloginip','$alipay_account','$alipay_real_name','$user_chips','$totalBuy','$total_total_money','$channel_id')";
	mysql_query ( $sql_i, $conn );
	
	echo $user_id . $line;
}

mysql_close ( $conn_his );
mysql_close ( $conn_u1 );
mysql_close ( $conn );
