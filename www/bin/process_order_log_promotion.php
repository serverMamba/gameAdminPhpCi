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
$db_default1 = $db ['cashorder1'];

$date_db = date ( 'YmdH', time () - 3600 * $step );
$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn );

$conn1 = mysql_connect ( $db_default1 ['hostname'], $db_default1 ['username'], $db_default1 ['password'] );
if (! $conn1) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default1 ['database'], $conn1 );

$db_time_start = strtotime ( $date_db . '0000' );
$db_time_end = $db_time_start + 3600;
$date1 = date ( 'Ymd', $db_time_start );

$sql = "DELETE FROM smc_log_order_promotion WHERE date = '$date_db'";
mysql_query ( $sql, $conn );

$sql111 = "SELECT DISTINCT(promotion_id) as promotion_id FROM smc_user order by promotion_id";
$query111 = mysql_query ( $sql111, $conn );
while ( $row = mysql_fetch_assoc ( $query111 ) ) {
	$promotion_id = $row['promotion_id'];
	echo $promotion_id."\n";
	if($promotion_id == 0){
		continue;
	}
	$sql = "SELECT count(*) AS order_num from smc_order o JOIN smc_user u ON u.user_id = o.user_id 
			WHERE o.`status` = 1 AND u.promotion_id = '$promotion_id' AND o.add_time >= '$db_time_start' AND o.add_time < '$db_time_end'";
	$result = mysql_query ( $sql, $conn );
	$order_total_num = mysql_result ( $result, 0, 'order_num' );
	
	if ($order_total_num > 0) {
		$sql = "SELECT count(DISTINCT(o.user_id)) AS user_num from smc_order o JOIN smc_user u ON u.user_id = o.user_id 
				WHERE o.`status` = 1 AND u.promotion_id = '$promotion_id' AND o.add_time >= '$db_time_start' AND o.add_time < '$db_time_end'";
		$result = mysql_query ( $sql, $conn );
		$user_total_num = mysql_result ( $result, 0, 'user_num' );
		
		$sql = "SELECT SUM(o.money) AS total_money from smc_order o JOIN smc_user u ON u.user_id = o.user_id 
		WHERE o.`status` = 1 AND u.promotion_id = '$promotion_id' AND o.add_time >= '$db_time_start' AND o.add_time < '$db_time_end'";
		$result = mysql_query ( $sql, $conn );
		$pay_total_num = mysql_result ( $result, 0, 'total_money' );
	} else {
		$user_total_num = 0;
		$pay_total_num = 0;
	}
	
	$sql = "SELECT SUM(cash_money) AS cash_total_money from smc_cash_order WHERE promotion_id = '$promotion_id' AND add_time >= '$db_time_start' AND add_time < '$db_time_end'";
	$result = mysql_query ( $sql, $conn );
	$cash_total_money1 = mysql_result ( $result, 0, 'cash_total_money' );
	if (! is_numeric ( $cash_total_money1 )) {
		$cash_total_money1 = 0;
	}
	
	$sql = "SELECT SUM(cash_money) AS cash_total_money from smc_cash_order WHERE promotion_id = '$promotion_id' AND add_time >= '$db_time_start' AND add_time < '$db_time_end'";
	$result = mysql_query ( $sql, $conn1 );
	$cash_total_money2 = mysql_result ( $result, 0, 'cash_total_money' );
	if (! is_numeric ( $cash_total_money2 )) {
		$cash_total_money2 = 0;
	}
	
	$cash_total_money = $cash_total_money1 + $cash_total_money2;
	
	$sql = "SELECT SUM(real_cash_money) AS cash_money from smc_cash_order WHERE status = 1 AND promotion_id = '$promotion_id' AND update_time >= '$db_time_start' AND update_time < '$db_time_end'";
	$result = mysql_query ( $sql, $conn );
	$cash_money1 = mysql_result ( $result, 0, 'cash_money' );
	if (is_numeric ( $cash_money1 ) && $cash_money1 > 0) {
		$sql = "SELECT SUM(cash_money - real_cash_money) AS choushui_money from smc_cash_order WHERE status = 1 AND promotion_id = '$promotion_id' AND update_time >= '$db_time_start' AND update_time < '$db_time_end'";
		$result = mysql_query ( $sql, $conn );
		$choushui_money1 = mysql_result ( $result, 0, 'choushui_money' );
	} else {
		$cash_money1 = 0;
		$choushui_money1 = 0;
	}
	
	$sql = "SELECT SUM(real_cash_money) AS cash_money from smc_cash_order WHERE status = 1 AND promotion_id = '$promotion_id' AND update_time >= '$db_time_start' AND update_time < '$db_time_end'";
	$result = mysql_query ( $sql, $conn1 );
	$cash_money2 = mysql_result ( $result, 0, 'cash_money' );
	if (is_numeric ( $cash_money2 ) && $cash_money2 > 0) {
		$sql = "SELECT SUM(cash_money - real_cash_money) AS choushui_money from smc_cash_order WHERE status = 1 AND promotion_id = '$promotion_id' AND update_time >= '$db_time_start' AND update_time < '$db_time_end'";
		$result = mysql_query ( $sql, $conn1 );
		$choushui_money2 = mysql_result ( $result, 0, 'choushui_money' );
	} else {
		$cash_money2 = 0;
		$choushui_money2 = 0;
	}
	
	$cash_money = $cash_money1 + $cash_money2;
	$choushui_money = $choushui_money1 + $choushui_money2;
	
	$sql = "INSERT INTO smc_log_order_promotion (date,order_total_num,user_total_num,pay_total_num,cash_money,choushui_money,cash_total_money,promotion_id,date1)
	VALUE ('$date_db','$order_total_num','$user_total_num','$pay_total_num','$cash_money','$choushui_money','$cash_total_money','$promotion_id','$date1')";
	echo $sql."\n";
	mysql_query ( $sql, $conn );
}
echo 'success';
mysql_close ( $conn );
mysql_close ( $conn1 );