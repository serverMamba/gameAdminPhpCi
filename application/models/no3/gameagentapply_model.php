<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class gameagentapply_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getgameagentapplyList($name, $telephone, $qq, $weixin, $ip, $status, $per, $start) {
		$sql = $this->contructSql($name, $telephone, $qq, $weixin, $ip, $status);
		if(!empty($sql))
		{
			$sql = $sql." order by id desc LIMIT $start,$per";
		}
		if($sql && !empty($sql))
		{
			$db = $this->load->database ( 'default_slave', true );
			$query = $db->query ( $sql );
			$db->close ();
			return $query->result_array ();
		}
		return array();
	}
	public function getDataNum($name, $telephone, $qq, $weixin, $ip, $status) {
		$sql = $this->contructSql($name, $telephone, $qq, $weixin, $ip, $status);
		if(!empty($sql))
		{
			$sql = " select count(1) rec_num from ".$this->getBaseTableName();
		}
		if($sql && !empty($sql))
		{
			$db = $this->load->database ( 'default_slave', true );
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
	public function contructSql($name, $telephone, $qq, $weixin, $ip, $status)
	{
		$where = "";
		if($name)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." name='".$name."'";
		}
		if($telephone)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." telephone='".$telephone."'";
		}
		if($qq)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." qq='".$qq."'";
		}
		if($weixin)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." weixin='".$weixin."'";
		}
		if($ip)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." ip='".$ip."'";
		}
		if($status===0||$status===1||$status===2)
		{
			if(!empty($where)){
				$where = $where.' and ';
			}
			$where = $where." status=".$status;
		}
		if(!empty($where)){
			$where = " where ".$where;
		}
		//$this->writeLog('$where='.$where);
		$sql = " SELECT * FROM ".$this->getBaseTableName().$where." ";
		$this->writeLog('contructSql='.$sql);
		return $sql;
		
	}
	
	public function changeStatus($id,$status)
	{
		$data = array ('status' => $status);
		$db = $this->load->database ( 'default_slave', true );
		$db->where ( 'id', $id );
		$res = $db->update ( $this->getBaseTableName(), $data );
		$db->close ();
		
		return $res;
	}
	
	public function getBaseTableName()
	{
		return "smc_game_agent_apply";
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
		$filename = "gameagentapply";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
