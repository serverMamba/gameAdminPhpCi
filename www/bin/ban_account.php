<?php
error_reporting ( E_ALL );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';
require_once dirname ( __FILE__ ) . '/../../application/third_party/message/pb_message.php';
require_once dirname ( __FILE__ ) . '/../../application/third_party/proto/pb_proto_pbclientgameserver.php';

if (isset ( $argv [1] )) {
	$sdb_p = $argv [1];
} else {
	exit('param error');
}

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

$db_235 = $db ['gamehis'];
$conn_235 = mysql_pconnect ( $db_235 ['hostname'], $db_235 ['username'], $db_235 ['password'] );
if (! $conn_235) {
	exit ( 'connection lose' . "\n" );
}
mysql_query ( "SET NAMES 'utf8'" );

$sdb = 'CASINOUSERDB_'.$sdb_p;

$sql = "(SELECT id from $sdb.CASINOUSER_0 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_1 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_2 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_3 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_4 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_5 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_6 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_7 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_8 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_9 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_10 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_11 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_12 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_13 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_14 where `password` = '198918ww') UNION ALL
(SELECT id from $sdb.CASINOUSER_15 where `password` = '198918ww');";

if($sdb_p <= 7){
	$query2 = mysql_query ( $sql, $conn_201 );
}else{
	$query2 = mysql_query ( $sql, $conn_202 );
}

while ( $row = mysql_fetch_array ( $query2, MYSQL_ASSOC ) ) {
	$user_id = $row ['id'];
	
	// $tmp = $user_id & 0x00000000000000FF;
	// $dbx = ($tmp & 0xF0) >> 4;
	// $server = 'eus' . $dbx;
	// $posx = $tmp & 0x0F;
	// $sql_user = "SELECT * FROM CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx
	// WHERE userid = '$user_id' LIMIT 1";
	// if ($dbx <= 7) {
	// $query22 = mysql_query ( $sql_user, $conn_his );
	// } else {
	// $query22 = mysql_query ( $sql_user, $conn );
	// }
	
	// $db_index = mysql_result ( $query22, 0, 'dbindex' );
	// $table_index = mysql_result ( $query22, 0, 'tableindex' );
	
	// $sql_user1 = "SELECT
	// id,nickname,password,registertime,lastLoginIp,user_chips,user_level,ip,mac,channel_id,alipay_real_name,alipay_account,alipay_change_time
	// FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id'
	// LIMIT 1";
	// if ($db_index <= 7) {
	// $query222 = mysql_query ( $sql_user1, $conn_his );
	// } else {
	// $query222 = mysql_query ( $sql_user1, $conn );
	// }
	
	// $registerip = mysql_result ( $query222, 0, 'ip' );
	// $registertime = mysql_result ( $query222, 0, 'registertime' );
	// $lastloginip = mysql_result ( $query222, 0, 'lastLoginIp' );
	// $alipay_account = mysql_result ( $query222, 0, 'alipay_account' );
	// $alipay_real_name = mysql_result ( $query222, 0, 'alipay_real_name' );
	
	// $sql_order = "SELECT SUM(money/100) as c FROM smc_order WHERE user_id =
	// '$user_id' and pay_platform = 6 and status = 1";
	// $query_order = mysql_query ( $sql_order, $conn );
	// if (mysql_num_rows ( $query_order ) > 0) {
	// $order_money = mysql_result ( $query_order, 0, 'c' );
	// }
	
	// $cash_money = 0;
	// $sql22 = "SELECT SUM(cash_money/100) as c FROM db_smc.smc_cash_order
	// where user_id = '$user_id' and status = 1";
	// $qq = mysql_query ( $sql22, $conn );
	// if (mysql_num_rows ( $qq ) > 0) {
	// $cash_money += intval ( mysql_result ( $qq, 0, 'c' ) );
	// }
	
	// $sql22 = "SELECT SUM(cash_money/100) as cc FROM db_smc.smc_cash_order
	// where user_id = '$user_id' and status = 1";
	// $qq = mysql_query ( $sql22, $conn_his );
	// if (mysql_num_rows ( $qq ) > 0) {
	// $cash_money += intval ( mysql_result ( $qq, 0, 'cc' ) );
	// }
	
	// $sql_i = "INSERT INTO smc_tmp
	// (user_id,registerip,registertime,lastloginip,alipay_account,alipay_real_name,order_money,cash_money)
	// VALUES
	// ('$user_id','$registerip','$registertime','$lastloginip','$alipay_account','$alipay_real_name','$order_money','$cash_money')";
	// mysql_query ( $sql_i, $conn );
	
	// echo $user_id . $line;
	
	// // echo $total_money . $line;
	
	$sql33 = "SELECT * FROM CASINOBLACKLISTDB.CASINOUSERIDBLACKLIST WHERE userid = '$user_id'";
	$qqq = mysql_query ( $sql33, $conn_202 );
	if (mysql_num_rows ( $qqq ) == 0) {
		$command = 80015;
		$query = new AddUserIDBlackListReq ();
		$query->set_userID ( $user_id );
		$query->set_describecontent ( '刷钱' );
		$rsp = new AddUserIDBlackListRsp ();
		$buf = $query->SerializeToString ();
		$ret = _request_midlayer_res ( $buf, $command );
		$rsp->ParseFromString ( $ret );
		if ($rsp->returncode () == 0) {
			$sql111 = "INSERT INTO CASINOBLACKLISTDB.CASINOUSERIDBLACKLIST (userid,describecontent) VALUES ('$user_id','刷钱作弊')";
			mysql_query ( $sql111, $conn_202 );
		}
		echo $user_id . $line;
	}
}
echo 'success';
mysql_close ( $conn_201 );
mysql_close ( $conn_202 );
mysql_close ( $conn_235 );
function getUserDBPos($user_id) {
	$tmp = $user_id & 0x00000000000000FF;
	$dbx = ($tmp & 0xF0) >> 4;
	$server = 'eus' . $dbx;
	$posx = $tmp & 0x0F;
	$db = $this->load->database ( $server, true );
	$db->select ( 'dbindex,tableindex' );
	$db->from ( 'CASINOUSER2ACCOUNT_' . $posx );
	$db->where ( 'userid', $user_id );
	$db->limit ( 1 );
	$query = $db->get ();
	$db->close ();
	$user_db_index = $query->row_array ();
	if (empty ( $user_db_index )) {
		return false;
	}
	return $user_db_index;
}
function _request_midlayer_res($buf, $command) {
	// require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
	$pack = new Packet ();
	$pack->set_version ( 0 );
	$pack->set_command ( $command );
	$pack->set_serialized ( $buf );
	
	$buf_pack = $pack->SerializeToString ();
	
	$buf_length = sprintf ( '%08x', strlen ( $buf_pack ) );
	$buf_length = _ntohl ( $buf_length );
	
	$request_stream = pack ( 'H*', $buf_length ) . $buf_pack;
	
	$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP ) or die ( 'Could not create socket' );
	socket_set_option ( $socket, SOL_SOCKET, SO_RCVTIMEO, array (
			'sec' => 1,
			'usec' => 0 
	) );
	socket_set_option ( $socket, SOL_SOCKET, SO_SNDTIMEO, array (
			'sec' => 1,
			'usec' => 0 
	) );
	
	// $length = count ( $this->midlayer );
	// for($i = 0; $i < $length; $i ++) {
	// try {
	// $conn = socket_connect ( $socket, $this->midlayer [$i] ['host'],
	// $this->midlayer [$i] ['port'] );
	// } catch ( Exception $e ) {
	// log_message ( 'error', "MY_Model | error - {$e->getMessage()}" );
	// }
	
	// if ($conn) {
	// break;
	// }
	// }
	
	$conn = socket_connect ( $socket, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT );
	
	socket_write ( $socket, $request_stream );
	
	if (! $conn) {
		// echo 'connet fail';
		return false;
	}
	
	$read_length = socket_read ( $socket, 4 );
	if (strlen ( $read_length ) <= 0) {
		// echo 'no response';
		return false;
	}
	
	$read_length = unpack ( 'H*', $read_length );
	$read_length = $read_length [1];
	$buf_length = base_convert ( _ntohl ( $read_length ), 16, 10 );
	$response_stream = socket_read ( $socket, $buf_length );
	
	$response_pack = new Packet ();
	$response_pack->ParseFromString ( $response_stream );
	
	$ret = $response_pack->serialized ();
	socket_close ( $socket );
	
	return $ret;
}
function _ntohl($n) {
	$ret = substr ( $n, 6, 2 ) . substr ( $n, 4, 2 ) . substr ( $n, 2, 2 ) . substr ( $n, 0, 2 );
	return $ret;
}