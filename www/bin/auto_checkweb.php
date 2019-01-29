<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

writeLog("checkweb start --------------");
doCheckWeb($config);
exit();


function doCheckWeb($config){
	$tip_msg = checkServer();
	writeLog("now: $tip_msg");
	saveMsgRedis ($config,$tip_msg);
}

function saveMsgRedis ($config,$tip_msg){
	if($config){
		$redis_config = $config ['redis'];
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		writeLog("old: ".$redis->get ( 'auto_web_check'));
		$redis->set ( 'auto_web_check', $tip_msg );
		$redis->close ();
		return true;
	}else{
		writeLog("saveMsgRedis error: config=$config");
		return false;
	}
}
function checkServer(){
	$webarr = array(
// 			"iplist.yuming.com" => "http://iplist.yuming.com/ip?tag=com.liuliugame1.xsddz99",
// 			"webapi1.yuming.com" => "http://webapi1.yuming.com/api/versionStatus?tag=com.igame.wcddz&v=2003",
// 			"webapi1.yuming.com" => "http://webapi1.yuming.com/api/versionStatus?tag=com.igame.wcddz&v=2003",
// 			"update.yuming.com" => "http://update.yuming.com/game/md5.txt",
// 			"autopatch.yuming.com" => "http://autopatch.yuming.com/game/md5.txt",
			"webapi.yuming.com" => "http://webapi.yuming.com/ip",
			"webapi.yuming.com" => "http://webapi.yuming.com/ip",
			"i.yuming.com" => "http://i.yuming.com/cashorder/1.txt",
			"chat.yuming.com" => "https://chat.yuming.com/api/chat/sendMessage",
			"dl.yuming.com" => "http://dl.yuming.com/xsddz_21048.apk",
			"d.yuming.com" => "http://d.yuming.com/1.txt",
			"tuiguang.yuming.com" => "http://tuiguang.yuming.com/login",
	);
	$tip_msg = "";
	foreach ($webarr as $key=>$curl){
		$httpCode = doCheck($curl);
		if(200==intval($httpCode)||405==intval($httpCode)){
			continue;
		}
		$tip_msg .= $key.":$httpCode,";
	}
	return $tip_msg;
}
function doCheck($curl){
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $curl );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt	( $ch, CURLOPT_TIMEOUT, 5);
	if(strpos($curl, 'https') === 0){
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	}
	curl_setopt ( $ch, CURLOPT_POST, 1 );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( null ) );
	$return = curl_exec ( $ch );
	$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
	curl_close ( $ch );
	return $httpCode;
}
function telPort($ip,$port=9102){
	$res = false;
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_set_nonblock($sock);
	socket_connect($sock,$ip, $port);
	socket_set_block($sock);
	$ret = @socket_select($r = array($sock), $w = array($sock), $f = array($sock), 5);
	$res = $ret==1;
	socket_close ( $sock );
	if(!$res){
		if($ret==2){
			writeLog("$ip,$port,close");
		}else if($ret==0){
			writeLog("$ip,$port,timeout");
		}else{
			writeLog("$ip,$port,ret=$ret");
		}
	}
	return $res;
}

function writeLog($txt) {
	echo "[".date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
	/* 
	$fileName = "/log/auto_switch_proxy.log";
	$myfile = fopen($fileName, "a+");
	if($myfile)
	{
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
		fwrite($myfile, $txt);
		fclose($myfile);
		return 1;
	}
	else
	{
		return 0;
	} */
}