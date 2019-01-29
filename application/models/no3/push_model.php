<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Push_model extends CI_Model {
	var $key_array = array (
			'com.client.doudizhu1' => array (
					'pem' => 'push_pem/client.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.doudizhu' => array (
					'pem' => 'push_pem/liuliu1doudizhu.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.bubuzhajinhua' => array (
					'pem' => 'push_pem/com.liuliugame1.bubuzhajinhua.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.fageqipai1' => array (
					'pem' => 'push_pem/com.liuliugame1.fageqipai1.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.jileyouxi' => array (
					'pem' => 'push_pem/com.liuliugame1.jileyouxi.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.vvyouxi' => array (
					'pem' => 'push_pem/com.liuliugame1.vvyouxi.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.wwdwc' => array (
					'pem' => 'push_pem/com.liuliugame1.wwdwc.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.zhenzhenyouxi' => array (
					'pem' => 'push_pem/zz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.kuruiyouxi' => array (
					'pem' => 'push_pem/kurui.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.dakayouxi' => array (
					'pem' => 'push_pem/dakayouxi.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.amdp' => array (
					'pem' => 'push_pem/com.liuliugame1.amdp.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.huoliniuniu' => array (
					'pem' => 'push_pem/com.liuliugame1.huoliniuniu.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ttzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.ttzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.cjysz' => array (
					'pem' => 'push_pem/com.liuliugame1.cjysz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.nnzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.nnzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ftqp' => array (
					'pem' => 'push_pem/com.liuliugame1.ftqp.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.bsddz' => array (
					'pem' => 'push_pem/com.liuliugame1.bsddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.bzqp' => array (
					'pem' => 'push_pem/com.liuliugame1.bzqp.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.nnzy' => array (
					'pem' => 'push_pem/com.liuliugame1.nnzy.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.hlysz' => array (
					'pem' => 'push_pem/com.liuliugame1.hlysz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.tjly' => array (
					'pem' => 'push_pem/com.liuliugame1.tjly.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.fkzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.fkzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ljddz' => array (
					'pem' => 'push_pem/com.liuliugame1.ljddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.thzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.thzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.daddz' => array (
					'pem' => 'push_pem/com.liuliugame1.daddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ywds' => array (
					'pem' => 'push_pem/com.liuliugame1.ywds.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.kgzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.kgzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.lkddz2' => array (
					'pem' => 'push_pem/com.liuliugame1.lkddz2.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ylddz' => array (
					'pem' => 'push_pem/com.liuliugame1.ylddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.qqddz' => array (
					'pem' => 'push_pem/com.liuliugame1.qqddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ddzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.ddzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.ffddz' => array (
					'pem' => 'push_pem/com.liuliugame1.ffddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.jdddz' => array (
					'pem' => 'push_pem/com.liuliugame1.jdddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.byjh' => array (
					'pem' => 'push_pem/com.liuliugame1.byjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.tyby' => array (
					'pem' => 'push_pem/com.liuliugame1.tyby.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.zrzjh' => array (
					'pem' => 'push_pem/com.liuliugame1.zrzjh.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.qmfkddz' => array (
					'pem' => 'push_pem/com.liuliugame1.qmfkddz.pem',
					'pass' => 'dilsjhhd' 
			),
			'com.liuliugame1.nnsj' => array (
					'pem' => 'push_pem/com.liuliugame1.nnsj.pem',
					'pass' => 'dilsjhhd' 
			) 
	);
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	private function getUserDevice($user_id) {
		$this->db->select ( 'ios_push_device,tag' );
		$this->db->from ( 'smc_user' );
		$this->db->where ( 'user_id', $user_id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			return $query->row_array ();
		} else {
			return false;
		}
	}
	public function addPushQueue($user_id, $message) {
		$device_ary = $this->getUserDevice ( $user_id );
		if (empty ( $device_ary ) || ! array_key_exists ( $device_ary ['tag'], $this->key_array ) || strlen ( $device_ary ['ios_push_device'] ) < 20) {
			return false;
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$push_ary = array (
				'device' => $device_ary ['ios_push_device'],
				'message' => $message,
				'pem' => $this->key_array [$device_ary ['tag']] ['pem'],
				'pass' => $this->key_array [$device_ary ['tag']] ['pass'],
				'user_id' => $user_id 
		);
		$redis->rPush ( 'ios_push_queue', json_encode ( $push_ary ) );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "push_model";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$this->getIp()." ".$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
}