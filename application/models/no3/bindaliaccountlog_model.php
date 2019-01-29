<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class bindaliaccountlog_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getBindAliaccountLogList($alipay_account, $user_id, $bind, $start_time, $end_time, $per, $start, $tabArr) {
		//$this->writeLog('getBindAliaccountLogList: $start_time='.$start_time.',$end_time='.$end_time.',$per='.$per.',$start='.$start.",tabArr=".$tabArr);
		$sql = $this->contructSql($alipay_account, $user_id, $bind, $start_time, $end_time, $per, $start, $tabArr);
		if(!empty($sql))
		{
			$sql = " select * from ($sql) x order by recordtime desc LIMIT $start,$per";
		}
		if($sql && !empty($sql))
		{
			$db = $this->load->database ( 'gamehis', true );
			$query = $db->query ( $sql );
			$db->close ();
			return $query->result_array ();
		}
		return array();
	}
	public function getDataNum($alipay_account, $user_id, $bind, $start_time, $end_time, $per, $start, $tabArr) {
		//$this->writeLog('getDataNum: $start_time='.$start_time.',$end_time='.$end_time.',$per='.$per.',$start='.$start.",tabArr=".$tabArr);
		$sql = $this->contructSql($alipay_account, $user_id, $bind, $start_time, $end_time, $per, $start, $tabArr);
		if(!empty($sql))
		{
			$sql = " select count(1) rec_num from ($sql) x order by recordtime desc";
		}
		if($sql && !empty($sql))
		{
			$db = $this->load->database ( 'gamehis', true );
			$query = $db->query ( $sql );
			$dataArr = $query->result_array ();
			$db->close ();
			foreach($dataArr as $row)
			{
				return $row['rec_num'];
			}
		}
		return 0;
	}
	public function contructSql($alipay_account, $user_id, $bind, $start_time, $end_time, $per, $start, $tabArr)
	{
		//$this->writeLog('contructSql: $start_time='.$start_time.',$end_time='.$end_time.",tabArr=".$tabArr);
		$where = "";
		if($alipay_account)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." alipay_account='".$alipay_account."'";
		}
		if($user_id)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." userid=".$user_id;
		}
		if($bind)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." bind=".$bind;
		}
		if($start_time)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." recordtime>='".$start_time."'";
		}
		if($end_time)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." recordtime<='".$end_time."'";
		}
		if(!empty($where)){
			$where = " where ".$where;
		}
		//$this->writeLog('$where='.$where);
		$sql = "";
		foreach ($tabArr as $k => $v){
			//$this->writeLog("$k -> $v"." p=".strtotime($k).",s=".strtotime($start_time).",e=".strtotime($end_time));
			$flag = strtotime($k)>=strtotime($start_time) && strtotime($k)<=strtotime($end_time);
			//$this->writeLog("flag=".$flag.",$start_time,$end_time");
			if($flag)
			{
				if(!empty($sql)){
					$sql = $sql." union all ";
				}
				$sql = $sql." SELECT * FROM ".$v.$where." ";
			}
		}
		//$this->writeLog('contructSql='.$sql);
		return $sql;
		
	}
	
	public function getBaseTableName()
	{
		return "CASINOBINDALIPAYACCOUNT";
	}
	
	public function getBindaliaccountlogTables()
	{
		$sql = "SELECT DISTINCT TABLE_NAME from information_schema.`COLUMNS` where TABLE_NAME LIKE '".$this->getBaseTableName()."%' ORDER BY TABLE_NAME desc";
		//$this->writeLog('getBindaliaccountlogTables='.$sql);
		$db = $this->load->database ( 'gamehis', true );
		$query = $db->query ( $sql );
		$db->close ();
		$res_arr = $query->result_array ();
		//$this->writeLog("getBindaliaccountlogTables: res_arr =  ".$res_arr." ".count($res_arr));
		$res = array();
		if($res_arr)
		{
			foreach ($res_arr as $k => $v)
			{
				$index = str_replace($this->getBaseTableName(),"",$v['TABLE_NAME']);
				$res[$index] = $v['TABLE_NAME']; 
				//$this->writeLog("getBindaliaccountlogTables: ".$index." => ".$v['TABLE_NAME']);
				//Array_push($res, $index);
			}
		}
		return $res;
	}
	
	public function saveBindAliLog($uid,$alipay_account){
		if($uid && $alipay_account)
		{
			try {
				$db = $this->load->database ( 'gamehis', true );
				$data = array(
						'userid'=>$uid,
						'alipay_account'=>$alipay_account,
						'bind'=>1
				);
				$tableName = "CASINOBINDALIPAYACCOUNT".date ( 'Ymd', time () );
				$res = $db->insert ( $tableName, $data );
				$db->close();
			}catch (Exception $e){}
		}		
	}
	public function createLogTable()
	{
		$fix = date ( 'Ymd', time () );
		$tableName = $this->getBaseTableName().$fix;
		$sql = "CREATE TABLE IF NOT EXISTS `".$tableName."` (
			  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
			  `userid` bigint(20) unsigned NOT NULL,
			  `alipay_account` varchar(128) DEFAULT NULL,
			  `bind` tinyint(1) NOT NULL DEFAULT '0',
			  `recordtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
			  PRIMARY KEY (`id`),
			  KEY `userid` (`userid`,`recordtime`),
			  KEY `alipay_account` (`alipay_account`)
			) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;";
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
		$filename = "bindAliaccountlog";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
