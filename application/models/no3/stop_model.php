<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Stop_model extends MY_Model {
	public function __construct() {
		parent::__construct ();
		require_once (APPPATH . 'third_party/message/pb_message.php');
		$this->_require ( 'pb_proto_onlinedata' );
	}
	public function stopDDZ() {
		$romid = 97;
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$ret = $this->_request_midlayer_res1 ( $buf, 20300, DDZ_SERVER_IP, DDZ_SERVER_PORT );
		print_r($ret);
	}
	
	public function stopNIUNIU(){
		$romid = 18;
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		$ret = $this->_request_midlayer_res1 ( $buf, 20300, NIUNIU_SERVER_IP, NIUNIU_SERVER_PORT );
		
		print_r($ret);
	}
	
	public function stopZJH(){
		$romid = 49;
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		$ret = $this->_request_midlayer_res1 ( $buf, 20300, ZJH_SERVER_IP, ZJH_SERVER_PORT );
		
		print_r($ret);
	}
	public function stopTex(){
		$romid = 1;
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
	
		$rrt = array ();
		$ret = $this->_request_midlayer_res1 ( $buf, 20300, TEXAS_SERVER_IP, TEXAS_SERVER_PORT );
	
		print_r($ret);
	}
	public function stopSG(){
		$romid = 24;
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
	
		$rrt = array ();
		$ret = $this->_request_midlayer_res1 ( $buf, 20300, SANGONG_SERVER_IP, SANGONG_SERVER_PORT );
	
		print_r($ret);
	}
}