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
	$out_date = $argv [1];
} else {
	echo 'date error';
	exit ();
}
$total = 0;
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

$sql = "SELECT * from CASINOGAMEHISDB.CASINOGAMEHISTORY$out_date where gamecode = 999990 group by userid,happentime HAVING count(*) > 1";
$query = mysql_query ( $sql, $conn_235 );
if (mysql_num_rows ( $query ) > 0) {
	while ( $row = mysql_fetch_assoc ( $query ) ) {
		$total += intval ( $row ['chips'] );
		$user_id = $row ['userid'];
		$pay_success_time = strtotime ( $row ['happentime'] );
		$sql = "SELECT * FROM db_smc.smc_order WHERE user_id = '$user_id' AND pay_success_time = '$pay_success_time' AND pay_platform = 6 LIMIT 1";
		$q1 = mysql_query ( $sql, $conn_202 );
		if (mysql_num_rows ( $q1 ) > 0) {
			while ( $row1 = mysql_fetch_assoc ( $q1 ) ) {
				$order_sn = $row1 ['order_sn'];
				$money = $row1 ['money'];
				$sql22 = "INSERT INTO db_smc.smc_tmp (user_id,order_sn,pay_success_time,money) VALUES ('$user_id','$order_sn','$pay_success_time','$money')";
				mysql_query ( $sql22, $conn_202 );
				echo $order_sn . ' success' . "\n";
			}
		}
	}
}
mysql_close ( $conn_201 );
mysql_close ( $conn_202 );
mysql_close ( $conn_235 );
echo 'total:' . $total . "\n";
echo 'SUCCESS';