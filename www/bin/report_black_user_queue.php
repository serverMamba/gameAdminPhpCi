<?php
set_time_limit ( 0 );
ini_set ( 'default_socket_timeout', - 1 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';
require_once dirname ( __FILE__ ) . '/../../application/third_party/message/pb_message.php';
require_once dirname ( __FILE__ ) . '/../../application/third_party/proto/pb_proto_pbclientgameserver.php';

$db_201 = $db ['gamebuyee'];
$conn_201 = mysql_pconnect ( $db_201 ['hostname'], $db_201 ['username'], $db_201 ['password'] );
if (! $conn_201) {
	exit ( 'connection lose' ."\n" );
}
mysql_query ( "SET NAMES 'utf8'", $conn_201 );

$db_202 = $db ['default'];
$conn_202 = mysql_pconnect ( $db_202 ['hostname'], $db_202 ['username'], $db_202 ['password'] );
if (! $conn_202) {
	exit ( 'connection lose' ."\n" );
}
mysql_query ( "SET NAMES 'utf8'", $conn_202 );

// 封号局数
$black_game_num = 20;
$desc = '被举报时游戏局数小于' . $black_game_num . '局，疑似作弊，封号处理';

$redis_config = $config ['redis'];
$redis = new Redis ();
$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

try{
	while ( true ) {
		// 检查数据库是否连接
		if (!mysql_ping($conn_201))
		{
			writeLog('DB1 connection lost');
			$conn_201 = mysql_pconnect ( $db_201 ['hostname'], $db_201 ['username'], $db_201 ['password'] );
			if (! $conn_201) {
				sleep(5);
				continue;
			}
			mysql_query ( "SET NAMES 'utf8'", $conn_201 );
		}

		if (!mysql_ping($conn_202))
		{
			writeLog('DB2 connection lost');
			$conn_202 = mysql_pconnect ( $db_202 ['hostname'], $db_202 ['username'], $db_202 ['password'] );
			if (! $conn_202) {
				sleep(5);
				continue;
			}
			mysql_query ( "SET NAMES 'utf8'", $conn_202 );
		}
		
		// 检查redis连接
		if ($redis->ping() != '+PONG')
		{
			writeLog('Redis connection lost');
			$redis = new Redis ();
			if (!$redis->connect ( $redis_config ['host'], $redis_config ['port'] ))
			{
				sleep(5);
				continue;
			}
		}

		// 从队列中拿数据
		$return_ary = $redis->blpop ( 'report_user_queue', 100 );
		if (! empty ( $return_ary ) && ! empty ( $return_ary [1] )) {
			$user_id = intval($return_ary [1]);
			
			$sql44 = "SELECT id FROM CASINOBLACKLISTDB.CASINOUSERIDBLACKLIST WHERE userid = '$user_id' LIMIT 1";
			$qq = mysql_query($sql44,$conn_202);
			if(mysql_num_rows($qq) > 0){
				writeLog($user_id.' already ok');
				continue;
			}
			$tmp = $user_id & 0x00000000000000FF;
			$dbx = ($tmp & 0xF0) >> 4;
			$server = 'eus' . $dbx;
			$posx = $tmp & 0x0F;
			$sql_user = "SELECT * FROM CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx WHERE userid = '$user_id' LIMIT 1";
			if ($dbx <= 7) {
				$query22 = mysql_query ( $sql_user, $conn_201 );
			} else {
				$query22 = mysql_query ( $sql_user, $conn_202 );
			}
			
			$db_index = mysql_result ( $query22, 0, 'dbindex' );
			$table_index = mysql_result ( $query22, 0, 'tableindex' );
			
			$sql_user1 = "SELECT id,win_game,lose_game FROM CASINOUSERDB_$db_index.CASINOUSER_$table_index WHERE id = '$user_id' LIMIT 1";
			if ($db_index <= 7) {
				$query222 = mysql_query ( $sql_user1, $conn_201 );
			} else {
				$query222 = mysql_query ( $sql_user1, $conn_202 );
			}
			
			$total_game_num = intval(mysql_result($query222, 0,'win_game')) + intval(mysql_result($query222, 0,'lose_game'));
			if($total_game_num < $black_game_num){
				if(blackUser($user_id, $desc)){
					$sql = "INSERT INTO CASINOBLACKLISTDB.CASINOUSERIDBLACKLIST (userid,describecontent) VALUES ('$user_id','$desc')";
					mysql_query($sql,$conn_202);
				}
				writeLog($user_id.' ok');
			}
		}
	}
}
catch (Exception $e)
{
	writeLog("Exeption: " . $e);
}

$redis->close ();
mysql_close($conn_201);
mysql_close($conn_202);



function blackUser($user_id,$desc) {
	$command = 80015;
	$query = new AddUserIDBlackListReq ();
	$query->set_userID ( $user_id );
	$query->set_describecontent ( $desc );
	$rsp = new AddUserIDBlackListRsp ();
	
	$buf = $query->SerializeToString ();
	
	$ret = _request_midlayer_res ( $buf, $command );
	
	$rsp->ParseFromString ( $ret );
	return $rsp->returncode () === EnumResult::enumResultSucc;
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

function writeLog($msg)
{
	$dateTime = date("Y-m-d H:i:s", time());
	echo "[$dateTime] $msg\n";
}