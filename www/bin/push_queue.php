<?php
set_time_limit ( 0 );
ini_set ( 'default_socket_timeout', - 1 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';

$redis_config = $config ['redis'];
$redis = new Redis ();
$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
while ( true ) {
	$return_ary = $redis->blpop ( 'ios_push_queue', 100 );
	if (! empty ( $return_ary ) && ! empty ( $return_ary [1] )) {
		echo $return_ary [1];
		$push_ary = json_decode ( $return_ary [1], true );
		$badge = $redis->incr ( $push_ary ['user_id'] . '_badge_num' );
		push ( $push_ary, $badge );
	}
}
$redis->close ();

// BLPOP
function push($push_ary, $badge) {
	$deviceToken = $push_ary ['device'];
	$passphrase = $push_ary ['pass'];
	$message = array (
			'body' => $push_ary ['message'] 
	);
	$body ['aps'] = array (
			'alert' => $push_ary ['message'],
			'sound' => 'default',
			'badge' => $badge 
	);
	$body ['type'] = 3;
	$body ['msg_type'] = 4;
	$body ['title'] = '你好';
	$body ['msg'] = '你收到一个新消息';
	
	$ctx = stream_context_create ();
	stream_context_set_option ( $ctx, 'ssl', 'local_cert', '../' . $push_ary ['pem'] ); // 记得把生成的push.pem放在和这个php文件同一个目录
	stream_context_set_option ( $ctx, 'ssl', 'passphrase', $passphrase );
	$fp = stream_socket_client ( 
			// 这里需要特别注意，一个是开发推送的沙箱环境，一个是发布推送的正式环境，deviceToken是不通用的
			// 'ssl://gateway.sandbox.push.apple.com:2195', $err,
			'ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx );
	if (! $fp)
		return false;
		// exit ( "Failed to connect: $err $errstr" . PHP_EOL );
		// echo 'Connected to APNS' . PHP_EOL;
	$payload = json_encode ( $body );
	$msg = chr ( 0 ) . pack ( 'n', 32 ) . pack ( 'H*', $deviceToken ) . pack ( 'n', strlen ( $payload ) ) . $payload;
	$result = fwrite ( $fp, $msg, strlen ( $msg ) );
	fclose ( $fp );
}