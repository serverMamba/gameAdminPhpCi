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
//mysql_select_db ( $db_history ['database'], $conn );

// $db_cashorder1 = $db ['cashorder1'];
// $conn2 = mysql_pconnect ( $db_cashorder1 ['hostname'], $db_cashorder1 ['username'], $db_cashorder1 ['password'] );
// if (! $conn2) {
// 	echo 'connection lose' . $line;
// 	exit ();
// }
// mysql_select_db ( $db_cashorder1 ['database'], $conn2 );

// $db_cashorder2 = $db ['cashorder2'];
// $conn2 = mysql_pconnect ( $db_cashorder2 ['hostname'], $db_cashorder2 ['username'], $db_cashorder2 ['password'] );
// if (! $conn2) {
// 	echo 'connection lose' . $line;
// 	exit ();
// }
// mysql_select_db ( $db_cashorder2 ['database'], $conn2 );

$sql = "SELECT channel_id,id,user_id from db_smc.smc_cash_order where channel_id = 0";
$query = mysql_query ( $sql, $conn );
if (mysql_num_rows ( $query ) > 0) {
	while ( $row = mysql_fetch_assoc ( $query ) ) {
		$sql = "SELECT channel_id FROM CASINOGAMEHISDB.CASINOUSERCHANNEL WHERE user_id = " . $row ['user_id'] . " LIMIT 1";
		$qu1 = mysql_query ( $sql, $conn );
		if (mysql_num_rows ( $qu1 ) > 0 && mysql_result ( $qu1, 0, 'channel_id' ) > 0) {
			$channel_id = mysql_result ( $qu1, 0, 'channel_id' );
			$sql = "UPDATE db_smc.smc_cash_order SET channel_id = '$channel_id' WHERE id = " . $row ['id'];
			mysql_query ( $sql, $conn );
		}else{
			continue;
		}
		echo $row['id'].' success';
	}
}
mysql_close ( $conn );
//mysql_close ( $conn2 );
echo 'success';