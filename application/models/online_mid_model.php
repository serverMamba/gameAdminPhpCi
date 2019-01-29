<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
	/*
 * 支付相关
 */
class Online_mid_model extends MY_Model {
	public function __construct() {
		parent::__construct ();
		require_once (APPPATH . 'third_party/message/pb_message.php');
		$this->_require ( 'pb_proto_onlinedata' );
	}
	public function test() {
		$this->_require ( 'pb_proto_pbclientgameserver' );
		$scoreoper = new GameServerMiddleLayerServerScoreOperation ();
		$scoreoper->set_userID ( 10000 );
		$scoreoper->set_score ( 1000 );
		$scoreoper->set_gameCode ( '999999' );
		$scoreoper->set_addtype ( $chip > 0 ? EnumAddScoreType::enumAddScoreType_BackgroundAdd : EnumAddScoreType::enumAddScoreType_BackgroundSub );
		$dret = $chip > 0 ? EnumAddScoreType::enumAddScoreType_BackgroundAdd : EnumAddScoreType::enumAddScoreType_BackgroundSub;
		
		$buf = $scoreoper->SerializeToString ();
		
		echo $buf;
	}
	public function get_onlinemsgx($romid) {
		if (in_array ( $romid, array (
				'0',
				'5',
				'17',
				"18",
				"20",
				"21",
				"49",
				"51",
				"52",
				"54",
				"145",
				"146",
				"148",
				"149",
				"177",
				"178" 
		) )) {
			return $this->get_onlinemsg1 ( $romid );
		}
		if (in_array ( $romid, array (
				"97",
				"98",
				"101" 
		) )) {
			return $this->get_onlinemsg4 ( $romid );
		}
		if (in_array ( $romid, array (
				'257' 
		) )) {
			
			return $this->get_onlinemsg3 ( $romid );
		}
	}
	public function get_onlinemsgip($romid, $ip) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"1" => array (
						TEXAS_SERVER_PORT 
				),
				"5" => array (
						TEXAS_SERVER_PORT 
				),
				"18" => array (
						NIUNIU_SERVER_PORT 
				),
				"20" => array (
						NIUNIU_SERVER_PORT 
				),
				"21" => array (
						NIUNIU_SERVER_PORT 
				),
				"49" => array (
						ZJH_SERVER_PORT 
				),
				"52" => array (
						ZJH_SERVER_PORT 
				),
				"54" => array (
						ZJH_SERVER_PORT
				),
				"97" => array (
						DDZ_SERVER_PORT 
				),
				"98" => array (
						DDZ_SERVER_PORT 
				),
				"101" => array (
						DDZ_SERVER_PORT 
				),
				"193" => array (
						FISH_SERVER_PORT 
				),
				"289" => array (
						ARCADE_SERVER_PORT 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			// print_r($ret) ;
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg($romid) {
		if (in_array ( $romid, array (
				'0',	// 全部
				'1',
				'5',
				'17',	// 牛牛
				"18",
				"20",	// 看牌抢庄牛牛
				"21",	// 百人牛牛
				"49",	// 三张牌
				"52",	// 百人三张
				"54",	// 红黑大战
				"99",
				"145",
				"146",
				"148",
				"149",
				"177",
				"178",
				"289",	// 电玩城
				"322",	// 连环炮
				'23',
				'24'
		) )) {
			return $this->get_onlinemsg1 ( $romid );
		}
		
		if (in_array ( $romid, array (
				"97",	// 普通斗地主
				"98",	// 欢乐斗地主
				"101" 	// 癞子斗地主
		) )) {
			return $this->get_onlinemsg4 ( $romid );
		}
		if (in_array ( $romid, array (
				'257' 
		) )) {
			
			return $this->get_onlinemsg3 ( $romid );
		}
		
		if (in_array ( $romid, array (
				'193' // 捕鱼
		) )) {
			return $this->get_onlinemsg5 ( $romid );
		}
		if (in_array ( $romid, array (
				'100' 
		) )) {
			return $this->get_onlinemsg2 ( $romid );
		}
		
		if (in_array ( $romid, array (
				'289' 	// 电玩城
		) )) {
			return $this->get_onlinemsg20 ( $romid );
		}
	}
	public function get_onlinemsg8($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						"15301" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			// $ip = "211.151.33.253";
			// $ip = "211.151.130.4";
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg7($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						"15301" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			// $ip = "211.151.33.250";
			// $ip = "123.56.200.73";
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg6($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						"15301" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			// $ip = "211.151.33.252";
			// $ip = "123.56.200.14";
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg5($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						FISH_SERVER_PORT 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = FISH_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg4($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"97" => array (
						DDZ_SERVER_PORT 
				),
				"98" => array (
						DDZ_SERVER_PORT 
				),
				"101" => array (
						DDZ_SERVER_PORT 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = DDZ_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg1($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				6 => "新手场",
				7 => "初级场",
				8 => "中级场",
				9 => "高级场",
				100 => "测试" 
		);
		
		$portarray = array (
				"0" => array (
						DDZ_SERVER_IP.':'.DDZ_SERVER_PORT => DDZ_SERVER_PORT,
						ZJH_SERVER_IP.':'.ZJH_SERVER_PORT => ZJH_SERVER_PORT,
						NIUNIU_SERVER_IP.':'.NIUNIU_SERVER_PORT => NIUNIU_SERVER_PORT,
 						FISH_SERVER_IP.':'.FISH_SERVER_PORT => FISH_SERVER_PORT,
 						ARCADE_SERVER_IP.':'.ARCADE_SERVER_PORT => ARCADE_SERVER_PORT,
						NIUNIUML_SERVER_IP.':'.NIUNIUML_SERVER_PORT => NIUNIUML_SERVER_PORT,
						SANGONG_SERVER_IP.':'.SANGONG_SERVER_PORT => SANGONG_SERVER_PORT,
 			// 			LHP_SERVER_IP => LHP_SERVER_PORT,
				),
// 				"1" => array (
// 						TEXAS_SERVER_PORT 
// 				),
// 				"5" => array (
// 						TEXAS_SERVER_PORT 
// 				),
				"17" => array (
						NIUNIU_SERVER_IP => NIUNIU_SERVER_PORT 
				),
				"20" => array (
						NIUNIU_SERVER_IP => NIUNIU_SERVER_PORT 
				),
				"21" => array (
						NIUNIU_SERVER_IP => NIUNIU_SERVER_PORT 
				),
				"49" => array (
						ZJH_SERVER_IP => ZJH_SERVER_PORT 
				),
				"52" => array (
						ZJH_SERVER_IP => ZJH_SERVER_PORT
				),	
				"54" => array (
						ZJH_SERVER_IP => ZJH_SERVER_PORT
				),
				"289" => array (
						ARCADE_SERVER_IP => ARCADE_SERVER_PORT 
				),
// 				"322" => array (
// 						LHP_SERVER_IP => LHP_SERVER_PORT 
// 				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		foreach ( $portarray [$romid] as $key => $value ) {
			$tmp_ary = explode(':', $key);
			$ip = $tmp_ary[0];
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		$this->writeLog(json_encode($rrt));
		return $rrt;
	}
	public function get_onlinemsg2($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"177" => array (
						"9112" 
				),
				"97" => array (
						"9102",
						"9103" 
				),
				"98" => array (
						"9102",
						"9103" 
				),
				"100" => array (
						"9102",
						"9103" 
				),
				"101" => array (
						"9102",
						"9103" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			// $ip = "211.151.33.254";
			// $ip = "123.56.200.183";
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->tournamentGameStatus_size ();
			
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->tournamentGameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg3($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"257" => array (
						"9101",
						"9102" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			// $ip = "119.81.64.139";
			// $ip = "123.56.200.154";
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->GameStatus_size ();
			
			// echo $gamecount;
			
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->GameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg20($romid) {
		$portarray = array (
				"289" => array (
						ARCADE_SERVER_PORT 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = ARCADE_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->GameStatus_size ();
			
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->GameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg21($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						"15501" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->GameStatus_size ();
			
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->GameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}
	public function get_onlinemsg22($romid) {
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				100 => "测试" 
		);
		
		$portarray = array (
				"193" => array (
						"15501" 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = SOCKET_SERVER_IP;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->GameStatus_size ();
			
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->GameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" . $value] = $roomitem->onlineUserCount ()>=100000000?0:$roomitem->onlineUserCount ();
				}
			}
		}
		return $rrt;
	}

	private function writeLog($txt) {
		$log_file = "/log/online_model.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}

}
