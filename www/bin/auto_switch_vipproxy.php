<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

writeLog("switchVIPRedis start --------------");
switchRedisProxys($config);
exit();


function switchRedisProxys ($config){
	if($config){
		$redis_config = $config ['redis'];
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$ip_list = getAllEffectivePorxys();
		$redis->set ( 'vip_iplist', json_encode($ip_list) );
		$redis->close ();
		$num = count($ip_list);
		writeLog("switchVIPRedis success $num:".json_encode($ip_list));
		return $num;
	}else{
		writeLog("switchVIPRedis error: config=$config");
	}
	return 0;
}

function getAllEffectivePorxys(){
	$effectivePorxys= array();
	$proxy_arr=vipproxys();
	foreach ($proxy_arr as $proxy){
		$status = pingAddress($proxy);
		if($status&&!in_array($proxy,$effectivePorxys)){
			array_push($effectivePorxys,$proxy);
		}
	}
	return $effectivePorxys; 
}
function vipproxys(){
	$proxyarr = array('120.77.97.46');//高防  
	$ip_list = array();
	foreach ($proxyarr as $proxy){
		if(!in_array($proxy,$ip_list)){
			array_push($ip_list,$proxy);
		}
	}
	return $ip_list;
}
/**
 * 使用PHP检测能否ping通IP或域名
 * @param type $address
 * @return boolean
 */
function pingAddress($address) {
	$status = -1;
	/* if (strcasecmp(PHP_OS, 'WINNT') === 0) {
		// Windows 服务器下
		$pingresult = exec("ping -n 1 {$address}", $outcome, $status);
	} elseif (strcasecmp(PHP_OS, 'Linux') === 0) {
		// Linux 服务器下
		$pingresult = exec("ping -c 1 {$address}", $outcome, $status);
	}  */
	
	// Linux 服务器下
	/* $pingresult = exec("ping -c 1 {$address}", $outcome, $status);
	if (0 == $status) {
		$status = telPort($address,9102);
	} else {
		$status = false;
	} */
	$status = telPort($address,9102);
	return $status;
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