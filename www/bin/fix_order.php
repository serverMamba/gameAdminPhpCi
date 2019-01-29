<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$line = "\n";
$db_history = $db ['gamehis'];
$conn = mysql_pconnect ( $db_history ['hostname'], $db_history ['username'], $db_history ['password'] );
if (! $conn) {
	echo 'connection lose' . $line;
	exit ();
}
mysql_select_db ( $db_history ['database'], $conn );

$db_default = $db ['default'];
$conn1 = mysql_pconnect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn1) {
	echo 'connection lose' . $line;
	exit ();
}
mysql_select_db ( $db_default ['database'], $conn1 );

$sql = "SELECT channel_id,id,user_id from smc_order where channel_id = 0";
$query = mysql_query ( $sql, $conn1 );
if (mysql_num_rows ( $query ) > 0) {
	while ( $row = mysql_fetch_assoc ( $query ) ) {
		$sql = "SELECT channel_id FROM CASINOUSERCHANNEL WHERE user_id = " . $row ['user_id'] . " LIMIT 1";
		$qu1 = mysql_query ( $sql, $conn );
		if (mysql_num_rows ( $qu1 ) > 0 && mysql_result ( $qu1, 0, 'channel_id' ) > 0) {
			$channel_id = mysql_result ( $qu1, 0, 'channel_id' );
			$sql = "UPDATE smc_order SET channel_id = '$channel_id' WHERE id = " . $row ['id'];
			mysql_query ( $sql, $conn1 );
		}else{
			continue;
		}
		echo $row['id'].' success';
	}
}
mysql_close ( $conn );
mysql_close ( $conn1 );
echo 'success';