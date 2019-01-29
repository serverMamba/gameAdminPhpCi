<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

writeLog("switchRedis start --------------");
doSwitchProxy($db,$config);
exit();


function test1($db){
	if($db){
		$proxy_arr=getdbiplist($db);
		$num=0;
		foreach ($proxy_arr as $proxy){
			$status = pingAddress($proxy);
			writeLog(++$num.": $status=> $proxy");
		}
	}
}

function doSwitchProxy($db,$config){
	$tag_arr = switchDBproxys($db);
	$num = switchRedisProxys($config,$tag_arr);
	writeLog("switchRedis success $num");
}

function getAllEffectivePorxys(){
	$effectivePorxys= array();
	$proxy_arr=allproxys();
	foreach ($proxy_arr as $proxy){
		$status = pingAddress($proxy);
		if($status&&!in_array($proxy,$effectivePorxys)){
			array_push($effectivePorxys,$proxy);
		}
	}
	return $effectivePorxys; 
}
function getSwitchSqls($db){
	$dbiplist = getdbiplist($db);
	//优先恢复IP组合分配
	$proxy_arr=allproxys();
	$effectivePorxys= array();
	if(count($dbiplist)<5){
		foreach ($proxy_arr as $proxy){
			$status = pingAddress($proxy);
			if($status&&!in_array($proxy,$effectivePorxys)){
				array_push($effectivePorxys,$proxy);
				if(count($effectivePorxys)>=5){
					$sqlarr = array();
					$sql0 = "UPDATE smc_proxy_ip set ip_list='".$effectivePorxys[0]."' where id%2=1";
					$sql1 = "UPDATE smc_proxy_ip set ip_list='".$effectivePorxys[1]."' where id%2=0";
					$sql2 = "UPDATE smc_proxy_ip set ip_list=CONCAT('".$effectivePorxys[2].",',ip_list) where id%3=1";
					$sql3 = "UPDATE smc_proxy_ip set ip_list=CONCAT('".$effectivePorxys[3].",',ip_list) where id%3=2";
					$sql4 = "UPDATE smc_proxy_ip set ip_list=CONCAT('".$effectivePorxys[4].",',ip_list) where id%3=0";
					array_push($sqlarr,$sql0);
					array_push($sqlarr,$sql1);
					array_push($sqlarr,$sql2);
					array_push($sqlarr,$sql3);
					array_push($sqlarr,$sql4);
					return $sqlarr;
				}
			}
		}
	}
	
	//检查db不通的proxy
	$impassDBiplist=array();
	foreach ($dbiplist as $proxy){
		//if(in_array($proxy,getGFproxys())){continue;}//高防不做处理
		$status = pingAddress($proxy);
		if(!$status&&!in_array($proxy,$impassDBiplist)){
			writeLog("err_ip $status=>$proxy");
			array_push($impassDBiplist,$proxy);
		}
	}
	
	if(!$impassDBiplist||empty($impassDBiplist)||count($impassDBiplist)<=0){
		writeLog("all dbproxy ok");
		exit ();
	}
	
	//获得其他通的proxy
	$effectivePorxys= array();
	foreach ($proxy_arr as $proxy){
		$status = pingAddress($proxy);
		if($status&&!in_array($proxy,$effectivePorxys)&&!in_array($proxy,$dbiplist)){
			array_push($effectivePorxys,$proxy);
		}
	}
	if(count($effectivePorxys)<=0){
		foreach ($dbiplist as $proxy){
			$status = pingAddress($proxy);
			if($status&&!in_array($proxy,$effectivePorxys)){
				array_push($effectivePorxys,$proxy);//只能重复使用
			}
		}
		foreach (getGFproxys() as $proxy){
			$status = pingAddress($proxy);
			if($status&&!in_array($proxy,$effectivePorxys)){
				array_push($effectivePorxys,$proxy);//使用高防
			}
		}
		if(count($effectivePorxys)<=0){
			array_push($effectivePorxys,'103.198.75.39');//使用备用高防
			writeLog("only gaofang2 !!!");
			writeLog("only gaofang2 !!!");
		}
	}
	
	//整理替换sql
	$sqlarr = array();
	$count_db = count($impassDBiplist);
	$count_other = count($effectivePorxys);
	for ($x=0; $x<$count_db; $x++){
		$sql0 = "UPDATE smc_proxy_ip set ip_list=replace(ip_list,'".$impassDBiplist[$x]."','".$effectivePorxys[$x%$count_other]."') where ip_list ='".$impassDBiplist[$x]."' ";
		if(!in_array($sql0,$sqlarr)){
			array_push($sqlarr,$sql0);
		}
		$sql1 = "UPDATE smc_proxy_ip set ip_list=replace(ip_list,'".$impassDBiplist[$x].",','".$effectivePorxys[$x%$count_other].",') where ip_list like '".$impassDBiplist[$x].",%' ";
		if(!in_array($sql1,$sqlarr)){
			array_push($sqlarr,$sql1);
		}
		$sql2 = "UPDATE smc_proxy_ip set ip_list=replace(ip_list,',".$impassDBiplist[$x]."',',".$effectivePorxys[$x%$count_other]."') where ip_list like '%,".$impassDBiplist[$x]."' ";
		if(!in_array($sql2,$sqlarr)){
			array_push($sqlarr,$sql2);
		}
		$sql3 = "UPDATE smc_proxy_ip set ip_list=replace(ip_list,',".$impassDBiplist[$x].",',',".$effectivePorxys[$x%$count_other].",') where ip_list like '%,".$impassDBiplist[$x].",%' ";
		if(!in_array($sql3,$sqlarr)){
			array_push($sqlarr,$sql3);
		}
	}
	if(!$sqlarr || empty($sqlarr) || count($sqlarr)<=0){
		writeLog("no switch sql!!!");
		exit("no switch sql!!!");
	}
	return $sqlarr;
}
function switchDBproxys($db){
	$sqlarr = getSwitchSqls($db);
	
	$db_default = $db ['default'];
	$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn) {
		writeLog('connection lose cannot switch');
		exit ( 'connection lose cannot switch' );
	}
	mysql_select_db ( $db_default ['database'], $conn );
	foreach ($sqlarr as $sql){
		$result = mysql_query ( $sql, $conn );
		if ($result) {
			writeLog(' switch db success: '.$sql);
		} else {
			writeLog(' switch db fail: '.$sql);
		}
	}
	
	$sql = "SELECT tag,ip_list from smc_proxy_ip";
	$result = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $result ) <= 0) {
		mysql_close ( $conn );
		writeLog('smc_proxy_ip tag_rows is 0');
		exit ( 'smc_proxy_ip tag_rows is 0' );
	}else{
		$tag_arr = array();
		writeLog("tag_num_rows=".mysql_num_rows ( $result ));
		while ( $rowTabItem = mysql_fetch_array ( $result, MYSQL_ASSOC ) ) {
			if($rowTabItem['tag']){
				$tag_arr [$rowTabItem['tag']] = $rowTabItem['ip_list'];
			}
		}
		mysql_close ( $conn );
		return $tag_arr;
	}
	mysql_close ( $conn );
	return null;
}
function switchRedisProxys ($config,$tag_arr){
	if($config&&$tag_arr&&count($tag_arr)>0){
		$redis_config = $config ['redis'];
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$num = 0;
		foreach ( $tag_arr as $tag => $ip_list ) {
			$redis->set ( 'ip_list_' . $tag, $ip_list );
			$num++;
		}
		$redis->close ();
		return $num;
	}else{
		writeLog("switchRedis error: config=$config,tag_arr=".json_encode($tag_arr));
	}
	return 0;
}
function getdbiplist($db){
	$db_default = $db ['default'];
	$conn = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
	if (! $conn) {
		writeLog('connection lose');
		exit ( 'connection lose' );
	}
	mysql_select_db ( $db_default ['database'], $conn );
	$sql = "SELECT GROUP_CONCAT(DISTINCT ip_list) as ip_list from smc_proxy_ip";
	$result = mysql_query ( $sql, $conn );
	if (mysql_num_rows ( $result ) <= 0) {
		mysql_close ( $conn );
		writeLog('smc_proxy_ip rows is 0');
		exit ( 'smc_proxy_ip rows is 0' );
	}else{
		$db_iplist = split(",",mysql_result ( $result, 0, 'ip_list' ));
		$ip_list = array();
		foreach ($db_iplist as $proxy){
			if(!in_array($proxy,$ip_list)){
				array_push($ip_list,$proxy);
			}
		}
		writeLog("db_iplist=".json_encode($ip_list));
		mysql_close ( $conn );
		return $ip_list;
	}
	mysql_close ( $conn );
	return null;
}
function getGFproxys(){
	return array('120.77.97.46');//备用、高防
}
function allproxys(){
	$proxyarr = array('192.168.38.226,120.77.217.226,120.77.37.76,192.168.179.12,120.77.212.176,120.77.216.232,120.77.219.1,120.77.219.220,120.77.219.158,120.77.220.29');
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
	$pingresult = exec("ping -c 1 {$address}", $outcome, $status);
	if (0 == $status) {
		$status = telPort($address,9102);
	} else {
		$status = false;
	}
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