<?php
set_time_limit ( 0 );
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

$line = "\n";
$db_default = $db ['default'];
$db_gamehis = $db ['gamehis'];
$dbtablesx = "PinganGameScoreRecord_";

$now = time ();
$datefix = date ( 'Ymd', $now );
$date1 = date ( 'Y-m-d', $now );
$date_db = date ( 'Y-m-d H:i:s', $now - 600 * $step );
$db_time_start = date ( 'Y-m-d', $now)." 00:00:00";
$db_time_end = date ( 'Y-m-d H:i:s', $now);
echo "0>>> ".$date_db.",".$db_time_start.",".$db_time_end;
$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn_default) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn_default );

$conn_gamehis = mysql_connect ( $db_gamehis ['hostname'], $db_gamehis ['username'], $db_gamehis ['password'] );
if (! $conn_gamehis) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_gamehis ['database'], $conn_gamehis );

$sql = "DELETE FROM smc_log_lhpgold WHERE date = '$date_db'";
echo "1-1>>> ".$sql."\n";
mysql_query ( $sql, $conn_default );

$sql = "DELETE FROM smc_log_lhpgold WHERE is_day=1 and date1 = '$date1'";
echo "1-2>>> ".$sql."\n";
mysql_query ( $sql, $conn_default );

$sql = "SELECT id FROM smc_log_lhpgold WHERE date = '$date_db' LIMIT 1";
$result = mysql_query ( $sql, $conn_default );
if (mysql_num_rows ( $result ) > 0) {
	exit ( 'log is exist' . $line );
}

$dbtablesx = $dbtablesx.$datefix;
echo "1>>> ".$dbtablesx.",".$db_time_start.",".$db_time_end."\n";
$where = '';

$sql = "SELECT count(*) AS order_num from $dbtablesx WHERE happentime >= '$db_time_start' AND happentime < '$db_time_end' $where";
$result = mysql_query ( $sql, $conn_gamehis );
$order_total_num = mysql_result ( $result, 0, 'order_num' );
echo "2 select_order_total_num_sql>>>".$order_total_num.",".$sql."\n";

$user_total_num = 0;
$duihuan_gold = 0;
$fanzhuan_gold = 0;
$cha_gold = 0;
if ($order_total_num > 0) {
	$sql = "SELECT count(DISTINCT(userid)) AS user_num from $dbtablesx WHERE happentime >= '$db_time_start' AND happentime < '$db_time_end' $where";
	echo "3 select_usernum_sql>>>".$sql."\n";
	$result = mysql_query ( $sql, $conn_gamehis );
	$user_total_num = mysql_result ( $result, 0, 'user_num' );
	
	$sql = "SELECT SUM(deltascore)*-1 AS duihuan_gold from $dbtablesx WHERE deltascore<=0 and happentime >= '$db_time_start' AND happentime < '$db_time_end' $where";
	echo "4 select_duihuan_gold_sql>>>".$sql."\n";
	$result = mysql_query ( $sql, $conn_gamehis );
	$duihuan_gold = mysql_result ( $result, 0, 'duihuan_gold' );
	
	$sql = "SELECT SUM(deltascore) AS fanzhuan_gold from $dbtablesx WHERE deltascore>0 and happentime >= '$db_time_start' AND happentime < '$db_time_end' $where";
	echo "5 select_fanzhuan_gold_sql>>>".$sql."\n";
	$result = mysql_query ( $sql, $conn_gamehis );
	$fanzhuan_gold = mysql_result ( $result, 0, 'fanzhuan_gold' );
	
	$sql = "SELECT SUM(deltascore) AS cha_gold from $dbtablesx WHERE happentime >= '$db_time_start' AND happentime < '$db_time_end' $where";
	echo "6 select_cha_gold_sql>>>".$sql."\n";
	$result = mysql_query ( $sql, $conn_gamehis );
	$cha_gold = mysql_result ( $result, 0, 'cha_gold' );
} else {
	$user_total_num = 0;
	$duihuan_gold = 0;
	$fanzhuan_gold = 0;
	$cha_gold = 0;
}

$sql = "INSERT INTO smc_log_lhpgold (date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold,date1)
VALUE ('$date_db','$order_total_num','$user_total_num','$duihuan_gold','$fanzhuan_gold','$cha_gold','$date1')";
echo "7 insert_sql>>>".$sql."\n";
$result = mysql_query ( $sql, $conn_default );
if ($result) {
	echo $date_db . ' order_log success' . $line;
} else {
	echo $date_db . ' order_log faile' . $line;
}

$sql = "INSERT INTO smc_log_lhpgold (date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold,date1,is_day)
VALUE ('$date_db','$order_total_num','$user_total_num','$duihuan_gold','$fanzhuan_gold','$cha_gold','$date1','1')";
echo "8 insert_sql>>>".$sql."\n";
$result = mysql_query ( $sql, $conn_default );
if ($result) {
	echo $date_db . ' order_log_day success' . $line;
} else {
	echo $date_db . ' order_log_day faile' . $line;
}

mysql_close ( $conn_default );
mysql_close ( $conn_gamehis );