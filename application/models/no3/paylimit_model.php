<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class paylimit_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	public function addPayLimit($data) {
		if(!$data||!$data["limit_target"]||empty($data["limit_target"]))
		{
			return false;
		}
		//$this->writeLog("paylimit_model addPayLimit data=$data");
		$sql = "INSERT INTO `smc_pay_limit`(limit_target,optuser,add_time,discribe) VALUES ('".$data["limit_target"]."', '".$data["optuser"]."', '".$data["add_time"]."', '".$data["discribe"]."');";
		//$this->writeLog("paylimit_model sql=$sql");
		//$res = $this->db->insert ( 'smc_pay_limit', $data );
		$res = $this->db->query ( $sql );
		//$this->writeLog("paylimit_model addPayLimit res=$res");
		$resR = $this->addToRedis($data["limit_target"]);
		if(!$resR)
		{
			//$this->writeLog(">>> addToRedis res=$resR");
		}
		return $res;
	}
	public function delPaylimit($limit_target) {
		if(!$limit_target)
		{
			return false;
		}
		//$this->writeLog("paylimit_model delPaylimit $limit_target");
		$sql = "delete from smc_pay_limit where limit_target='".$limit_target."'";
		//$this->writeLog("paylimit_model delPaylimit sql=$sql");
		//$this->db->where ( 'id', $id );
		//$res = $this->db->delete ( 'smc_pay_limit' );
		$res = $this->db->query ( $sql );
		//$this->writeLog("paylimit_model delPaylimit res=$res");
		$resR = $this->delFromRedis($limit_target);
		if(!$resR)
		{
			//$this->writeLog(">>> addToRedis res=$resR");
		}
		return $res;
	}
	public function getDataList($limit_target, $optuser, $start_time, $end_time, $discribe, $per, $start) {
		//$this->writeLog("paylimit_model getDataList $limit_target, $optuser, $start_time, $end_time, $discribe, $per, $start");
		
		$this->db->from ( 'smc_pay_limit' );
		if ($limit_target) {
			$this->db->where ( 'limit_target', $limit_target );
		}
		if ($optuser) {
			$this->db->where ( 'optuser', $optuser );
		}
		if ($start_time) {
			$this->db->where ( 'add_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'add_time <= ', $end_time );
		}		
		if ($discribe) {
			$this->db->where ( "discribe like ", "%".$discribe."%" );
		}
		$this->db->limit ( $per, $start );
		$this->db->order_by ( 'id', 'DESC' );
		$query = $this->db->get ();
		$return_ary = $query->result_array ();
		
		//$this->writeLog("paylimit_model getDataNum getDataList=$return_ary");
		return $return_ary;
	}
	public function getDataNum($limit_target, $optuser, $start_time, $end_time, $discribe) {
		//$this->writeLog("paylimit_model getDataNum $limit_target, $optuser, $start_time, $end_time, $discribe");
		//$this->autoCreateTab();
		$this->db->from ( 'smc_pay_limit' );
		if ($limit_target) {
			$this->db->where ( 'limit_target', $limit_target );
		}
		if ($optuser) {
			$this->db->where ( 'optuser', $optuser );
		}
		if ($start_time) {
			$this->db->where ( 'add_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'add_time <= ', $end_time );
		}		
		if ($discribe) {
			$this->db->where ( "discribe like ", "%".$discribe."%" );
		}
		$res = $this->db->count_all_results ();
		
		//$this->writeLog("paylimit_model getDataNum res=$res");
		return $res;
	}
	
	public function getOptuserList()
	{
		$sql = "select DISTINCT optuser from smc_pay_limit";
		$query = $this->db->query($sql);
		$query_result = $query->result_array();
		$res = array();
		foreach ($query_result as $value)
		{
			$res[$value['optuser']] = $value['optuser'];
		}
		return $res;
	}
	
	public function addToRedis($uid)
	{
		if($uid)
		{
			$res = false;
			try{
				$redis_config = $this->config->item ( 'redis' );
				$redis = new Redis ();
				$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
				$res = $redis->sAdd($this->getPaylimitKey(), $uid."");
				//$this->writeLog("addToRedis: ".$res);
				$redis->close ();
			}catch (Exception $e) {
				//$this->writeLog(">>> addToRedis Exception: ".$e->getMessage());
            }
			return $res;
		}
		return true;
	}
	
	public function delFromRedis($uid)
	{
		if($uid)
		{
			$res = false;
			try{
				$redis_config = $this->config->item ( 'redis' );
				$redis = new Redis ();
				$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
				$flag = $redis->sIsMember($this->getPaylimitKey(), $uid."");
				if($flag)
				{
					$res = $redis->sRem($this->getPaylimitKey(), $uid."");
				}
				else
				{
					$res = true;
				}
				$res = $redis->sAdd($this->getPaylimitKey(), "-1");//确保键值存在
				//$this->writeLog("delFromRedis: ".$res);
				$redis->close ();
			}catch (Exception $e) {
				//$this->writeLog(">>> delFromRedis Exception: ".$e->getMessage());
            }
			return $res;
		}
		return true;
	}
	
	public function getPaylimitFromMySQL()
	{
		try {
			$sql = "select id,limit_target from smc_pay_limit";
			//$this->writeLog("getPaylimitFromMySQL $sql");
			$query = $this->db->query($sql);
			$query_result = $query->result_array();
			$targetArr = array();
			foreach ($query_result as $value)
			{
				$targetArr[$value['id']] = $value['limit_target'];
			}
			//$this->writeLog("getPaylimitFromMySQL count_targetArr=".count($targetArr));
			return $targetArr;
		}catch (Exception $e0)
		{
			//$this->writeLog("getPaylimitFromMySQL Exception: ".$e0->getMessage());
			return null;
		}
		return null;
	}
	
	public function setPaylimitToRedis($targetArr)
	{
		try{
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$connFlag = $redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			//$this->writeLog("setPaylimitToRedis conn=".$connFlag);
			if($connFlag)
			{
				//确保MySQL查询成功，再清除重置redis
				if($targetArr && count($targetArr)>0)
				{
					$delFlag = $redis->delete($this->getPaylimitKey());
					//$this->writeLog("setPaylimitToRedis delFlag=".$delFlag);
					foreach ($targetArr as $value)
					{
						$redis->sAdd($this->getPaylimitKey(), $value);
					}
				}
				$redis->sAdd($this->getPaylimitKey(), "-1");//每次同步，需要确保键值存在
				$redis->close ();
				//$this->writeLog("setPaylimitToRedis res:true");
				return true;
			}
			return false;
		}catch (Exception $e1) {
			//$this->writeLog("setPaylimitToRedis Exception: ".$e1->getMessage());
			return false;
		}
		return false;
	}
	
	public function syncPaylimtToRedis()
	{
		$targetArr = $this->getPaylimitFromMySQL();
		$res = $this->setPaylimitToRedis($targetArr);
		return $res;
	}
	
	function autoCreateTab()
	{
		$sql = "CREATE TABLE if not exists `smc_pay_limit` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `limit_target` varchar(50) NOT NULL,
				  `optuser` varchar(50) DEFAULT NULL,
				  `add_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				  `discribe` text,
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `limit_target` (`limit_target`)
				) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;";
		$res = $this->db->query ( $sql );
	}
	
	function getPaylimitKey()
	{
		return 'paylimit_uid';
	}
	
	function sortArrByField(&$array, $field, $desc = false) {
		$fieldArr = array ();
		foreach ( $array as $k => $v ) {
			$fieldArr [$k] = $v [$field];
		}
		$sort = $desc == false ? SORT_ASC : SORT_DESC;
		array_multisort ( $fieldArr, $sort, $array );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "paylimit";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}