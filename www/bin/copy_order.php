<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

if (isset ( $argv [1] )) {
	$date = $argv [1];
} else {
	echo 'date error';
	exit ();
}

$line = "\n";
$db_default = $db ['default'];

$start_time = strtotime ( $date . '000000' );
$end_time = $start_time + 3600 * 24;

$month = substr ( $date, 0, 6 );

$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn );

$sql = "INSERT INTO CASINOBUYHISDB.ORDER" . $month . " SELECT * FROM db_smc.smc_order WHERE status = 1 AND add_time >= '$start_time' AND add_time < '$end_time'";
echo $sql;
$q = mysql_query ( $sql );
exit;
if ($q) {
	$sql = "DELETE FROM db_smc.smc_order WHERE add_time >= '$start_time' AND add_time < '$end_time'";
	$qq = mysql_query ( $sql );
	if ($qq) {
		mysql_close ( $conn );
		exit ( 'CASINOBUYHISDB.ORDER' . $month . ' ok' . $line );
	} else {
		mysql_close ( $conn );
		exit ( 'CASINOBUYHISDB.ORDER' . $month . ' fail' . $line );
	}
}
