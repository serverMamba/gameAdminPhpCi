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

$gua_time = 1483286888;
$line = "\n";
$db_default = $db ['default'];
$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn );
mysql_query ( "SET NAMES 'utf8'" );

$db_his = $db ['gamebuyee'];
$conn_his = mysql_connect ( $db_his ['hostname'], $db_his ['username'], $db_his ['password'] );
if (! $conn_his) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_his ['database'], $conn_his );
mysql_query ( "SET NAMES 'utf8'" );

//充值补单
// $sql = "SELECT * FROM smc_order WHERE status = 1 and pay_success_time >= '$gua_time' order by pay_success_time";
// $query2 = mysql_query ( $sql, $conn );
// while ( $row = mysql_fetch_array ( $query2, MYSQL_ASSOC ) ) {
// 	if(score_operation($row['user_id'],$row['money'])){
// 		echo $row['user_id'].'ok'.$line;
// 	}else{
// 		echo $row['user_id'].'error'.$line;
// 	}
// }

//提现补单
$sql = "SELECT * from db_smc.smc_cash_order where `status` = 2 and update_time >= '$gua_time'";
$query2 = mysql_query ( $sql, $conn );
while ( $row = mysql_fetch_array ( $query2, MYSQL_ASSOC ) ) {
	if(score_operation_cash($row['user_id'],$row['cash_money'])){
		echo $row['user_id'].'ok'.$line;
	}else{
		echo $row['user_id'].'error'.$line;
	}
}

$sql = "SELECT * from db_smc.smc_cash_order where `status` = 2 and update_time >= '$gua_time'";
$query2 = mysql_query ( $sql, $conn_his );
while ( $row = mysql_fetch_array ( $query2, MYSQL_ASSOC ) ) {
	if(score_operation_cash($row['user_id'],$row['cash_money'])){
		echo $row['user_id'].'ok'.$line;
	}else{
		echo $row['user_id'].'error'.$line;
	}
}

echo 'success';
mysql_close ( $conn );
mysql_close($conn_his);

function score_operation($uid, $chip) {
	//  $this->_require('pb_proto_clientgameserver');

	$scoreoper = new GameServerMiddleLayerServerScoreOperation();
	$scoreoper->set_userID($uid);
	$scoreoper->set_score($chip);
	$scoreoper->set_gameCode('999990');
	$scoreoper->set_addtype(EnumAddScoreType::enumAddScoreType_BackgroundAdd);

	$buf = $scoreoper->SerializeToString();

	//echo DISPATCH_SERVER_IP;
	$ret = _request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);

	$rsp = new GameServerMiddleLayerServerScoreOperationRsp();
	$rsp->ParseFromString($ret);

	$r = $rsp->returncode() === EnumResult::enumResultSucc ? true : false;
	//$this->writeLog(date('Y-m-d H:i:s ').$uid.'--'.$chip.': returncode:'.$rsp->returncode()."\n");
	return $r;
}
function score_operation_cash($uid, $chip) {
	//  $this->_require('pb_proto_clientgameserver');

	$scoreoper = new GameServerMiddleLayerServerScoreOperation();
	$scoreoper->set_userID($uid);
	$scoreoper->set_score($chip);
	$scoreoper->set_gameCode('999992');
	$scoreoper->set_addtype(EnumAddScoreType::enumAddScoreType_BackgroundAdd);

	$buf = $scoreoper->SerializeToString();

	//echo DISPATCH_SERVER_IP;
	$ret = _request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);

	$rsp = new GameServerMiddleLayerServerScoreOperationRsp();
	$rsp->ParseFromString($ret);

	$r = $rsp->returncode() === EnumResult::enumResultSucc ? true : false;
	//$this->writeLog(date('Y-m-d H:i:s ').$uid.'--'.$chip.': returncode:'.$rsp->returncode()."\n");
	return $r;
}
function _request_midlayer_res1($buf, $command,$host,$port) {
	//require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
	//$this->_require('pb_proto_pbclientgameserver');
	$pack = new Packet();
	$pack->set_version(0);
	$pack->set_command($command);
	$pack->set_connectionid("99");
	$pack->set_serialized($buf);
	$buf_pack   = $pack->SerializeToString();

	$buf_length = sprintf('%08x', strlen($buf_pack));
	$buf_length = _ntohl($buf_length);

	$request_stream = pack('H*', $buf_length) . $buf_pack;

	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
	socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>20, 'usec'=>0));
	socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>20, 'usec'=>0));

	// socket_set_option($socket, SOL_SOCKET,SO_KEEPALIVE,10000);
	// $arrOpt = array('l_onoff' => 1, 'l_linger' => 1);
	// socket_set_block($socket);
	// socket_set_option($socket, SOL_SOCKET, SO_LINGER, $arrOpt);
	//   echo $host,":",$port;
	$conn = socket_connect($socket, $host,$port);

	if (!$conn) {
		//$this->writeLog(date('Y-m-d H:i:s connect'));
		return false;
	}

	socket_write($socket, $request_stream);

	//  sleep(10);

	if (!$conn) {
		//   echo 'connet fail';
		return false;
	}
	//  socket_set_block($socket);
	// socket_set_noblock($socket);

	$read_length = socket_read($socket, 4);

	//  print_r($read_length);


	//  print_r($read_length);

	if (strlen($read_length) <= 0) {
		$errorcode = socket_last_error();
		$errormsg = socket_strerror($errorcode);
		//$this->writeLog(date('Y-m-d H:i:s length'));
		 
		return false;
	}

	$read_length = unpack('H*', $read_length);
	$read_length = $read_length[1];
	$buf_length = base_convert(_ntohl($read_length), 16, 10);
	$response_stream = socket_read($socket, $buf_length);

	$response_pack = new Packet();
	$response_pack->ParseFromString($response_stream);
	//  print_r($response_pack);
	$ret = $response_pack->serialized();
	socket_close($socket);

	return $ret ;
}
function _ntohl($n) {
	$ret = substr($n, 6, 2) . substr($n, 4, 2) . substr($n, 2, 2) . substr($n, 0, 2);
	return $ret;
}