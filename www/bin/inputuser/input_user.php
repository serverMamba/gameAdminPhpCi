<?php
error_reporting ( E_ALL );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../../application/config/database.php';

if (isset ( $argv [1] )) {
	$db_index = intval ( $argv [1] );
} else {
	exit ( 'param error' );
}

if ($db_index < 0 && $db_index > 15) {
	exit ( 'param error1' );
}

$limit = 1000;
$line = "\n";
$db_user = $db ['eus' . $db_index];
$conn = mysql_connect ( $db_user ['hostname'], $db_user ['username'], $db_user ['password'] );
if (! $conn) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_user ['database'], $conn );
mysql_query ( "SET NAMES 'utf8'" );

$db_log = $db ['gamehis'];
$conn_his = mysql_connect ( $db_log ['hostname'], $db_log ['username'], $db_log ['password'] );
if (! $conn_his) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_log ['database'], $conn_his );
mysql_query ( "SET NAMES 'utf8'" );


$db_name = $db_user ['database'];
for($i = 0; $i <= 15; $i ++) {
	$start = 0;
	while (true){
		$sql = "SELECT id,nickname,password,registertime,user_email,user_chips,ip,mac,win_game,lose_game,draw_game,channel_id,totalBuy,lastLoginIp,lastLoginMac,alipay_real_name,alipay_account,total_total_money,boundmobilenumber,last_login_time
				FROM $db_name.CASINOUSER_$i ORDER BY id LIMIT $start,$limit";
		$query = mysql_query($sql,$conn);
	}
}