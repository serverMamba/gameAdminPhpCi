<?php
error_reporting ( E_ALL );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';
require_once "PHPExcel.php";

$line = "\n";

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

$file = '/home/houtai/www/bin/22.xlsx';
$objReader = new PHPExcel_Reader_Excel2007 ();
$objExcel = $objReader->load ( $file );
$sheet = $objExcel->getSheet ( 0 );
$highestRow = $sheet->getHighestRow ();
$highestColumm = $sheet->getHighestColumn ();

for($row = 4; $row <= $highestRow - 1; $row ++) {
	if ($sheet->getCell ( 'F' . $row )->getValue () == '转账') {
		$order_sn = $sheet->getCell ( 'E' . $row )->getValue ();
		
		$sql = "SELECT id,status,update_time,real_cash_money FROM db_smc.smc_cash_order WHERE order_sn = '$order_sn' and update_time >= 1524412800 AND update_time <= 1524499199 and status = 1 LIMIT 1";
		$q201 = mysql_query ( $sql, $conn_201 );
		if (mysql_num_rows ( $q201 ) == 0) {
			$sql = "SELECT id,status,update_time,real_cash_money FROM db_smc.smc_cash_order WHERE order_sn = '$order_sn' LIMIT 1";
			$q202 = mysql_query ( $sql, $conn_202 );
			if (mysql_num_rows ( $q202 ) == 0) {
				echo $order_sn . ' not exit' . $line;
			}else{
				//echo $order_sn.' ok'.$line;
			}
		}else{
			//echo $order_sn.' ok'.$line;
		}
		continue;
	}
}

mysql_close ( $conn_201 );
mysql_close ( $conn_202 );