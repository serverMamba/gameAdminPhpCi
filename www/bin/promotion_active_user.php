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
	$tg_date = $argv [1];
} else {
	$tg_date = date ( "Ymd", strtotime ( "-1 day" ) );
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

$sql_d = "DELETE FROM smc_tg_promotion_active_user WHERE tg_date = '$tg_date'";
mysql_query ( $sql_d, $conn );

$sql = "SELECT id FROM smc_tg_promotion";
$query = mysql_query ( $sql, $conn );
while ( $row = mysql_fetch_array ( $query, MYSQL_ASSOC ) ) {
	$promotion_id = $row ['id'];
	echo $promotion_id . ' start' . $line;
	$sql1 = "SELECT DISTINCT(userid) AS user_id FROM CASINOLOGINHISTORY$tg_date  l join CASINOUSERCHANNEL c on c.user_id = l.userid WHERE c.promotion_id = '$promotion_id'";
	$a_query = mysql_query ( $sql1, $conn_his );
	if (mysql_num_rows ( $a_query ) == 0) {
		continue;
	}
	
	while ( $a_row = mysql_fetch_array ( $a_query, MYSQL_ASSOC ) ) {
		$user_id = $a_row ['user_id'];
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
		
		$sql_user1 = "SELECT win_game,lose_game,draw_game,id,nickname,password,registertime,lastLoginIp,user_chips,user_level,ip,mac,channel_id,alipay_real_name,alipay_account,alipay_change_time,totalBuy,total_total_money
		FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id' LIMIT 1";
		if ($db_index <= 7) {
			$query222 = mysql_query ( $sql_user1, $conn_u1 );
		} else {
			$query222 = mysql_query ( $sql_user1, $conn );
		}
		
		$registerip = mysql_result ( $query222, 0, 'ip' );
		$registertime = strtotime ( mysql_result ( $query222, 0, 'registertime' ) );
		$total_pay = mysql_result ( $query222, 0, 'totalBuy' );
		$chips = mysql_result ( $query222, 0, 'user_chips' );
		$game_num = intval ( mysql_result ( $query222, 0, 'win_game' ) ) + intval ( mysql_result ( $query222, 0, 'lose_game' ) ) + intval ( mysql_result ( $query222, 0, 'draw_game' ) );
		
		$sql_i = "INSERT INTO smc_tg_promotion_active_user (tg_date,promotion_id,user_id,register_time,register_ip,game_num,chips,total_pay) 
			VALUES ('$tg_date','$promotion_id','$user_id','$registertime','$registerip','$game_num','$chips','$total_pay')";
		mysql_query ( $sql_i, $conn );
		echo $user_id . ':' . $promotion_id . $line;
	}
}

mysql_close ( $conn_his );
mysql_close ( $conn_u1 );
mysql_close ( $conn );

echo 'success' . $line;
