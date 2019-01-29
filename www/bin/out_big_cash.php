<?php
error_reporting ( E_ALL );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

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

$start = 0;
$limit = 1000;

while ( true ) {
	echo 'start='.$start.$line;
	$sql = "SELECT user_id FROM smc_user order by id LIMIT $start,$limit";
	$query = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $query ) > 0) {
		while ( $row = mysql_fetch_array ( $query, MYSQL_ASSOC ) ) {
			$user_id = $row ['user_id'];
			
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
			
			$sql_user1 = "SELECT totalBuy,total_total_money,lastLoginIp,last_login_time FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id' LIMIT 1";
			if ($db_index <= 7) {
				$query333 = mysql_query ( $sql_user1, $conn_u1 );
			} else {
				$query333 = mysql_query ( $sql_user1, $conn );
			}
			
			$total_pay = mysql_result ( $query333, 0, 'totalBuy' );
			$total_cash = mysql_result ( $query333, 0, 'total_total_money' );
			
			if ($total_cash >= 5000000 && $total_cash > $total_pay) {
				$sql_in = "INSERT INTO db_smc.smc_tmp1 (user_id,total_pay,total_cash) VALUES
											('$user_id','$total_pay','$total_cash')";
				mysql_query ( $sql_in, $conn );
				echo $user_id . $line;
			}
		}
		$start = $start + $limit;
	}else{
		break;
	}
}

mysql_close ( $conn_his );
mysql_close ( $conn_u1 );
mysql_close ( $conn );

echo 'success' . $line;