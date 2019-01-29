<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Checkweb extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
	}
	
	public function test0(){
		sleep(10);
		exit("1");
	}
	
	public function checkServer(){
		$webarr = array(
				"webapi.yuming.com" => "http://webapi.yuming.com/ip",
				"webapi.yuming.com" => "http://webapi.yuming.com/ip",
				"i.yuming.com" => "http://i.yuming.com/cashorder/1.txt",
				"chat.yuming.com" => "https://chat.yuming.com/api/chat/test",
				"chat.yuming.com" => "https://chat.yuming.com/api/chat/test",
				"dl.yuming.com" => "http://dl.yuming.com/xsddz_21048.apk",
				"d.yuming.com" => "http://d.yuming.com/",
				);
		$tip_msg = "";
		foreach ($webarr as $key=>$curl){
			$httpCode = $this->doCheck($curl);
			if(200==intval($httpCode)||405==intval($httpCode)){
				continue;
			}
			$tip_msg .= $key.":$httpCode, ";
		}
		if($tip_msg){
			$tip_msg = "SERVER异常: $tip_msg 请通知技术人员查看！！！";
		}
		exit($tip_msg);
	}
	private function doCheck($curl){
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $curl );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		if(substr($curl, 0, strlen("https")) === "https"){
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);  // 从证书中检查SSL加密算法是否存在
		}
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( null ) );
		$return = curl_exec ( $ch );
		$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		curl_close ( $ch );
		return $httpCode;
	}
	private function telPort($ip,$port=80){
		$res = false;
		$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_nonblock($sock);
		socket_connect($sock,$ip, $port);
		socket_set_block($sock);
		$ret = @socket_select($r = array($sock), $w = array($sock), $f = array($sock), 5);
		$res = $ret==1;
		socket_close ( $sock );
		return $res;
	}
	
}