<?php
error_reporting ( 0 );
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
	$date = date ( 'Ymd' );
}

if (! is_numeric ( $date ) || strlen ( $date ) != 8) {
	exit ( 'date error' );
}

$channellist = $config ['channellist'];
$taglist = $config ['taglist'];
$line = "\n";
$db_history = $db ['gamehis'];
$conn = mysql_pconnect ( $db_history ['hostname'], $db_history ['username'], $db_history ['password'] );
if (! $conn) {
	echo 'connection lose' . $line;
	exit ();
}
mysql_select_db ( $db_history ['database'], $conn );

$reg_table_name = 'CASINOREGISTERHISTORY' . $date;
$login_table_name = 'CASINOLOGINHISTORY' . $date;

echo 'start fix Register ' . $reg_table_name . $line;
$sql = "select * from $reg_table_name where channelid = 0 and tag <> ''";
$query = mysql_query ( $sql, $conn );
if (mysql_num_rows ( $query ) > 0) {
	while ( $row = mysql_fetch_assoc ( $query ) ) {
		$channel_id = intval ( array_search ( $taglist [$row ['tag']], $channellist ) );
		if (! $channel_id) {
			continue;
		}
		
		if (updateUserChannel ( $db, $row ['userid'], $channel_id )) {
			$sql = "UPDATE $reg_table_name SET channelid = '$channel_id' WHERE id =" . $row ['id'];
			mysql_query ( $sql, $conn );
			echo "UPDATE register success" . $line;
			$sql = "SELECT channel_id FROM CASINOUSERCHANNEL WHERE user_id = " . $row ['userid'] . " LIMIT 1";
			$qu1 = mysql_query ( $sql, $conn );
			if (mysql_num_rows ( $qu1 ) > 0 && mysql_result ( $qu1, 0, 'channel_id' ) == 0) {
				$sql = "UPDATE CASINOUSERCHANNEL SET channel_id = '$channel_id' WHERE user_id = " . $row ['userid'];
				mysql_query ( $sql, $conn );
			}
		}
	}
}
echo 'end fix Register ' . $reg_table_name . $line;
echo 'start fix Login ' . $login_table_name . $line;

$user_channel_ary = array ();
$start = 0;
$limit = 1000;
while ( true ) {
	$sql = "select * from $login_table_name LIMIT $start,$limit";
	$loqu = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $loqu ) > 0) {
		while ( $row1 = mysql_fetch_assoc ( $loqu ) ) {
			if ($row1 ['channelid'] > 0) {
				continue;
			} else {
				if (isset ( $user_channel_ary [$row1 ['userid']] )) {
					$channel_id = $user_channel_ary [$row1 ['userid']];
				} else {
					$sql22 = "SELECT channel_id FROM CASINOUSERCHANNEL WHERE user_id = " . $row1 ['userid'] . " LIMIT 1";
					$qu11 = mysql_query ( $sql22, $conn );
					if (mysql_num_rows ( $qu11 ) > 0) {
						if (mysql_result ( $qu11, 0, 'channel_id' ) > 0) {
							$channel_id = mysql_result ( $qu11, 0, 'channel_id' );
							$user_channel_ary [$row1 ['userid']] = mysql_result ( $qu11, 0, 'channel_id' );
						} else {
							continue;
						}
					}
				}
				
				$sql = "UPDATE $login_table_name SET channelid = '$channel_id' WHERE userid = " . $row1 ['userid'];
				mysql_query ( $sql, $conn );
				
			}
		}
		echo 'fix Login History : '.$start.$line;
		$start += $limit;		
	} else {
		break;
	}
}
echo 'end fix Login ' . $login_table_name . $line;
mysql_close ( $conn );
echo 'SUCCESS';
exit ();
function updateUserChannel($db_config, $user_id, $channel_id) {
	$tmp = $user_id & 0x00000000000000FF;
	$dbx = ($tmp & 0xF0) >> 4;
	$server = $db_config ['eus' . $dbx];
	$posx = $tmp & 0x0F;
	$conn1 = mysql_connect ( $server ['hostname'], $server ['username'], $server ['password'] );
	if (! $conn1) {
		echo $user_id . ' POS ERROR';
		return false;
	}
	mysql_select_db ( $server ['database'], $conn1 );
	$sql = "SELECT dbindex,tableindex FROM CASINOUSER2ACCOUNT_$posx WHERE userid = '$user_id' LIMIT 1";
	$user_q = mysql_query ( $sql, $conn1 );
	mysql_close ( $conn1 );
	if (mysql_num_rows ( $user_q ) > 0) {
		$db_index = mysql_result ( $user_q, 0, 'dbindex' );
		$tableindex = mysql_result ( $user_q, 0, 'tableindex' );
	} else {
		echo $user_id . ' POS ERROR111';
		return false;
	}
	
	$server = $db_config ['eus' . $db_index];
	$conn2 = mysql_connect ( $server ['hostname'], $server ['username'], $server ['password'] );
	if (! $conn2) {
		echo $user_id . ' POS ERROR333';
		return false;
	}
	mysql_select_db ( $server ['database'], $conn2 );
	$sql = "SELECT channel_id FROM CASINOUSER_$tableindex WHERE id = '$user_id' LIMIT 1";
	$user_q = mysql_query ( $sql, $conn2 );
	
	if (mysql_num_rows ( $user_q ) > 0) {
		$user_channel_id = mysql_result ( $user_q, 0, 'channel_id' );
		if ($user_channel_id == 0) {
			$sql1 = "UPDATE CASINOUSER_$tableindex SET channel_id = '$channel_id' WHERE id = '$user_id'";
			mysql_query ( $sql1, $conn2 );
			echo 'USER UPDATE SUCCESS : ' . $user_id . '-' . $channel_id . "\n";
			mysql_close ( $conn2 );
			return true;
		}
		mysql_close ( $conn2 );
		return false;
	} else {
		mysql_close ( $conn2 );
		echo $user_id . ' POS ERROR444';
		return false;
	}
}