<?php
error_reporting(E_ALL);
set_time_limit ( 0 );
ini_set ( 'default_socket_timeout', - 1 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

if (isset ( $argv [1] )) {
	$date = $argv [1];
} else {
	exit('error');
}

$db_start_date =  strtotime ( $date . '000000' );
$db_end_date = $db_start_date + 3600*24;

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

$sql = "SELECT sum(user_score_end - user_score_begin) as c,user_id,count(*) AS play_num from CASINOGAMEHISDB.CASINOGAMERECORD_BaiRenZhaJinHua_$date 
		WHERE user_score_begin <> user_score_end GROUP BY user_id HAVING c > 10000 ORDER BY c desc";
$query = mysql_query($sql,$conn_235);
while ( $row = mysql_fetch_array ( $query, MYSQL_ASSOC ) ) {
	$user_id = $row ['user_id'];
	echo $user_id."\n";
	$tmp = $user_id & 0x00000000000000FF;
	$dbx = ($tmp & 0xF0) >> 4;
	$server = 'eus' . $dbx;
	$posx = $tmp & 0x0F;
	$sql_user = "SELECT * FROM CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx WHERE userid = '$user_id' LIMIT 1";
	if ($dbx <= 7) {
		$query22 = mysql_query ( $sql_user, $conn_201 );
	} else {
		$query22 = mysql_query ( $sql_user, $conn_202 );
	}
	
	$db_index = mysql_result ( $query22, 0, 'dbindex' );
	$table_index = mysql_result ( $query22, 0, 'tableindex' );
	
	$sql_user1 = "SELECT id,nickname,password,registertime,lastLoginIp,user_chips,user_level,ip,mac,channel_id,alipay_real_name,alipay_account,alipay_change_time,totalBuy,total_total_money
					FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id' LIMIT 1";
	if ($db_index <= 7) {
		$query222 = mysql_query ( $sql_user1, $conn_201 );
		
		$sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE user_id = '$user_id' AND add_time >= '$db_start_date' AND add_time < '$db_end_date'";
		$query1 = mysql_query ( $sql, $conn_201 );
		$cash_money1 = intval ( mysql_result ( $query1, 0, 'cash_chips' ) );
		
	} else {
		$query222 = mysql_query ( $sql_user1, $conn_202 );
		
		$sql = "SELECT SUM(cash_money) AS cash_chips FROM db_smc.smc_cash_order WHERE user_id = '$user_id' AND add_time >= '$db_start_date' AND add_time < '$db_end_date'";
		$query1 = mysql_query ( $sql, $conn_202 );
		$cash_money1 = intval ( mysql_result ( $query1, 0, 'cash_chips' ) );
	}
	
	$win_chips = $row['c'];
	$play_num = $row['play_num'];
	$registerip = mysql_result ( $query222, 0, 'ip' );
	$lastloginip = mysql_result ( $query222, 0, 'lastLoginIp' );
	$alipay_account = mysql_result ( $query222, 0, 'alipay_account' );
	$alipay_real_name = mysql_result ( $query222, 0, 'alipay_real_name' );
	
	$sql = "SELECT SUM(money) AS recharge_chpis FROM db_smc.smc_order WHERE user_id = '$user_id' AND status = 1 AND add_time  >= '$db_start_date' AND add_time < '$db_end_date'";
	$query2 = mysql_query ( $sql, $conn_202 );
	$recharge_chpis = intval ( mysql_result ( $query2, 0, 'recharge_chpis' ) );
	
	$sql = "INSERT INTO db_smc.smc_tmp (user_id,win_chips,alipay_account,alipay_real_name,recharge_money,cash_money,play_num,last_login_ip,register_ip) 
			VALUES ('$user_id','$win_chips','$alipay_account','$alipay_real_name','$recharge_chpis','$cash_money1','$play_num','$lastloginip','$registerip')";
	mysql_query($sql,$conn_202);
	echo '123';
}
echo '345';
mysql_close ( $conn_201 );
mysql_close ( $conn_202 );
mysql_close ( $conn_235 );