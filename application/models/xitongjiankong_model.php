<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class xitongjiankong_model extends MY_Model {
	var $db = null;
	var $payment_tables = null;
	public function __construct() {
		parent::__construct ();
		// $this->load->model('usernew_mid_model');
	}
	public function post_curl_msg($url, $post_data) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_HEADER, FALSE );
		curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, FALSE );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
		curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 60 );
		curl_setopt ( $ch, CURLOPT_POST, TRUE );
		// curl_setopt($ch, CURLOPT_GET, TRUE);
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
		$response = curl_exec ( $ch );
		// var_dump(curl_error($ch));
		curl_close ( $ch );
		
		return $response;
	}
	public function get_proxy_msg() {
		$tablexx = array ();
		$tablexx ["pay"] = array (
				"IP" => "211.151.33.249",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "支付回调(pay)",
				"systemttl" => "155",
				"databasettl" => "55",
				"Redisttl" => "5",
				"Dispatchttl" => "15",
				"MoniterTime" => "2000" 
		);
		$tablexx ["paybak"] = array (
				"IP" => "211.151.36.100",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "支付回调备份(pay)",
				"systemttl" => "155",
				"databasettl" => "55",
				"Redisttl" => "5",
				"Dispatchttl" => "15",
				"MoniterTime" => "2000" 
		);
		$tablexx ["order"] = array (
				"IP" => "211.151.33.4",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "订单(order)",
				"systemttl" => "175",
				"databasettl" => "75",
				"Redisttl" => "3",
				"Dispatchttl" => "13",
				"MoniterTime" => "2000" 
		);
		$tablexx ["smc"] = array (
				"IP" => "211.151.33.251",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "后台(smc)",
				"systemttl" => "166",
				"databasettl" => "100",
				"Redisttl" => "20",
				"Dispatchttl" => "20",
				"MoniterTime" => "2000" 
		);
		$tablexx ["Dispatch"] = array (
				"IP" => "211.151.33.254",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "Dispatch(主)",
				"systemttl" => "174",
				"databasettl" => "不需要",
				"Redisttl" => "8",
				"Dispatchttl" => "13",
				"MoniterTime" => "2000" 
		);
		$tablexx ["Dispatchbak"] = array (
				"IP" => "211.151.33.246",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "Dispatch(备)",
				"systemttl" => "174",
				"databasettl" => "不需要",
				"Redisttl" => "8",
				"Dispatchttl" => "13",
				"MoniterTime" => "2000" 
		);
		$tablexx ["GameServer"] = array (
				"IP" => "211.151.32.20",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "GameServer",
				"systemttl" => "305",
				"databasettl" => "不需要",
				"Redisttl" => "不需要",
				"Dispatchttl" => "1",
				"MoniterTime" => "2000" 
		);
		$tablexx ["shop"] = array (
				"IP" => "211.151.33.247",
				"Port" => "80",
				"Path" => "payment/ping",
				"modulename" => "商城(shop)",
				"systemttl" => "166",
				"databasettl" => "不需要",
				"Redisttl" => "不需要",
				"Dispatchttl" => "不需要",
				"MoniterTime" => "2000" 
		);
		
		$post_data = json_encode ( $tablexx );
		$TT = $this->post_curl_msg ( "http://27.115.62.98:6900/getstatus/api", $post_data );
		$TTjson = json_decode ( $TT );
		$ret = array ();
		foreach ( $tablexx as $key => $value ) {
			$value ["systemttl"] = $TTjson->$key->systemttl;
			$value ["databasettl"] = $TTjson->$key->databasettl;
			$value ["Redisttl"] = $TTjson->$key->Redisttl;
			$ret [] = $value;
		}
		return json_encode ( $ret );
	}
	public function update_proxy_msg($gamename, $serverip, $BindingAddress, $ConnectAddress) {
		$magic = md5 ( $gamename . "jhsdgvfiuergbiwregiuwire" );
		$url = "http://" . $serverip . "/modify/api?gamename=$gamename&BindingAddress=$BindingAddress&ConnectAddress=$ConnectAddress&magic=$magic";
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
		curl_setopt ( $ch, CURLOPT_TIMEOUT, 15 );
		$output = curl_exec ( $ch );
		curl_close ( $ch );
		return "ok";
	}
	public function save_jsversion_msg($Tag, $Version) {
		return false;
	}
	public function get_jsversion_msg() {
		return $output;
	}
}
