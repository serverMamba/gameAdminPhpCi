<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$line = "\n";
$db_cash_order1 = $db ['cashorder1'];
$conn1 = mysql_connect ( $db_cash_order1 ['hostname'], $db_cash_order1 ['username'], $db_cash_order1 ['password'] );
if (! $conn1) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_cash_order1 ['database'], $conn1 );

$sql = "SELECT * FROM smc_cash_order ORDER BY id DESC LIMIT 500";
$query1 = mysql_query ( $sql, $conn1 );
if (mysql_num_rows ( $query1 ) > 0) {
	$db_cash_order2 = $db ['cashorder2'];
	$conn2 = mysql_connect ( $db_cash_order2 ['hostname'], $db_cash_order2 ['username'], $db_cash_order2 ['password'] );
	if (! $conn2) {
		exit ( 'connection lose' . $line );
	}
	mysql_select_db ( $db_cash_order2 ['database'], $conn2 );
	
	while ($row = mysql_fetch_array($query1,MYSQL_ASSOC)){
		$sql3 = "SELECT id FROM smc_cash_order WHERE order_sn = '".$row['order_sn']."' LIMIT 1";
		$q3 = mysql_query($sql3,$conn2);
		if(mysql_num_rows($q3) > 0){
			mysql_query("DELETE FROM smc_cash_order WHERE order_sn = '".$row['order_sn']."' ",$conn1);
		}else{
			$sql1 = "INSERT INTO smc_cash_order (user_id,cash_money,add_time,status,alipay_account,alipay_real_name,balance,order_sn)
				VALUES ('".$row['user_id']."','".$row['cash_money']."','".$row['add_time']."','".$row['status']."','".$row['alipay_account']."','".$row['alipay_real_name']."','".$row['balance']."','".$row['order_sn']."')";
			if(mysql_query($sql1,$conn2)){
				mysql_query("DELETE FROM smc_cash_order WHERE order_sn = '".$row['order_sn']."' ",$conn1);
			}
		}
	}
	
	mysql_close($conn1);
	mysql_close($conn2);
	echo 'ok';
} else {
	mysql_close ( $conn1 );
	echo 'no cash order';
}