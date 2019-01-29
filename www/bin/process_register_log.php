<?php
date_default_timezone_set('Asia/Shanghai');
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$channellist = $config ['channellist'];
$line = "\n";
$db_default = $db ['default'];
$db_history = $db ['gamehis'];

$date_hour_db = date ( 'YmdH', time () - 3600 );
$query_log_db = 'CASINOREGISTERHISTORY' . substr ( $date_hour_db, 0, 8 );
$query_log_login_db = 'CASINOLOGINHISTORY' . substr ( $date_hour_db, 0, 8 );

$db_time_start = strtotime ( $date_hour_db . '0000' );
$db_time_end = $db_time_start + 3600;

$date1 = date('Ymd',$db_time_start);
$db_time_start_db = date ( 'Y-m-d H:i:s', $db_time_start );
$db_time_end_db = date ( 'Y-m-d H:i:s', $db_time_end );

$conn = mysql_connect ( $db_history ['hostname'], $db_history ['username'], $db_history ['password'] );
if (! $conn) {
	echo 'connection lose' . $line;
	exit ();
}
mysql_select_db ( $db_history ['database'], $conn );


$conn1 = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn1) {
	echo 'connection lose' . $line;
	exit ();
}
mysql_select_db ( $db_default ['database'], $conn1 );

$sql = "DELETE FROM smc_log_user WHERE date = '$date_hour_db'";
mysql_query ( $sql, $conn1 );

foreach ( $channellist as $k => $v ) {
	$sql = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='$query_log_db'";
	$result = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $result ) == 0) {
		$reg_user_num = 0;
	} else {
		$sql = "SELECT count(DISTINCT(registerip)) AS user_num FROM " . $query_log_db . " WHERE channelid = '$k' AND registertime >= '$db_time_start_db' AND registertime < '$db_time_end_db'";
		$result = mysql_query ( $sql, $conn );
		$reg_user_num = mysql_result ( $result, 0, 'user_num' );
	}
	
	// 日活
	$sql = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='$query_log_login_db'";
	$result = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $result ) == 0) {
		$login_user_num = 0;
	} else {
		$sql = "SELECT count(DISTINCT(loginip)) AS user_num FROM " . $query_log_login_db . " WHERE channelid = '$k' AND logintime >= '$db_time_start_db' AND logintime < '$db_time_end_db'";
		$result = mysql_query ( $sql, $conn );
		$login_user_num = mysql_result ( $result, 0, 'user_num' );
	}
	
	$sql = "INSERT INTO smc_log_user (date,reg_user_num,login_user_num,channel_id,date1) VALUE ('$date_hour_db','$reg_user_num','$login_user_num','$k','$date1')";
	mysql_query ( $sql, $conn1 );
}
// 注册
// 判断表是否存在
$sql = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='$query_log_db'";
$result = mysql_query ( $sql, $conn );
if (mysql_num_rows ( $result ) == 0) {
	$reg_user_num = 0;
} else {
	$sql = "SELECT count(DISTINCT(registerip)) AS user_num FROM " . $query_log_db . " WHERE registertime >= '$db_time_start_db' AND registertime < '$db_time_end_db'";
	$result = mysql_query ( $sql, $conn );
	$reg_user_num = mysql_result ( $result, 0, 'user_num' );
}

// 日活
$sql = "SELECT table_name FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_NAME='$query_log_login_db'";
$result = mysql_query ( $sql, $conn );
if (mysql_num_rows ( $result ) == 0) {
	$login_user_num = 0;
} else {
	$sql = "SELECT count(DISTINCT(loginip)) AS user_num FROM " . $query_log_login_db . " WHERE logintime >= '$db_time_start_db' AND logintime < '$db_time_end_db'";
	$result = mysql_query ( $sql, $conn );
	$login_user_num = mysql_result ( $result, 0, 'user_num' );
}

$sql = "INSERT INTO smc_log_user (date,reg_user_num,login_user_num,channel_id,date1) VALUE ('$date_hour_db','$reg_user_num','$login_user_num','0','$date1')";
$result = mysql_query ( $sql, $conn1 );
if ($result) {
	echo $date_hour_db . ' register_log success' . $line;
} else {
	echo $date_hour_db . ' register_log faile' . $line;
}

mysql_close ( $conn );
mysql_close ( $conn1 );
