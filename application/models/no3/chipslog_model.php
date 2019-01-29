<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class chipslog_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getChipsLogList($admin_id, $user_id, $chips, $start_time, $end_time, $per, $start) {
		$db1 = $this->load->database ( 'default', true );
		$db1->from ( 'smc_admin_log' );
		if ($admin_id) {
			$db1->where ( 'admin_id', $admin_id );
		}
		if ($user_id) {
			$db1->where ( 'user_id', $user_id );
		}
		if ($chips) {
			$db1->where ( 'chips >= ', $chips );
		}
		if ($start_time) {
			$db1->where ( 'add_time >= ', strtotime($start_time) );
		}
		if ($end_time) {
			$db1->where ( 'add_time <= ', strtotime($end_time) );
		}		
		$db1->limit ( $per, $start );
		$db1->order_by ( 'id', 'DESC' );
		$query = $db1->get ();
		$return_ary = $query->result_array ();
	
		//$this->writeLog('getChipsLogList: $return_ary='.$return_ary.', $admin_id='.$admin_id.',$user_id='.$user_id.',$chips='.$chips.',$start_time='.$start_time.',$end_time='.$end_time,true);
		return $return_ary;
	}
	public function getRecordNum($admin_id, $user_id, $chips, $start_time, $end_time) {
		$db1 = $this->load->database ( 'default', true );
		$db1->from ( 'smc_admin_log' );
		if ($admin_id) {
			$db1->where ( 'admin_id', $admin_id );
		}
		if ($user_id) {
			$db1->where ( 'user_id', $user_id );
		}
		if ($chips) {
			$db1->where ( 'chips >= ', $chips );
		}
		if ($start_time) {
			$db1->where ( 'add_time >= ', strtotime($start_time) );
		}
		if ($end_time) {
			$db1->where ( 'add_time <= ', strtotime($end_time) );
		}
		
		$res = $db1->count_all_results ();
		//$this->writeLog('getRecordNum: $res='.$res.', $admin_id='.$admin_id.',$user_id='.$user_id.',$chips='.$chips.',$start_time='.$start_time.',$end_time='.$end_time,true);
		return $res;
	}
	public function getAdminNameList()
	{
		$db1 = $this->load->database ( 'default', true );
		$db1->select ( 'id,admin_name' );
		$db1->from ( 'smc_admin' );
		$db1->order_by ( 'id', 'DESC' );
		$query = $db1->get ();
		$return_ary = $query->result_array ();
		$res = array();
		foreach ( $return_ary as $row ) {
			$res[$row['id']] = $row['admin_name'];
			//$this->writeLog('getAdminNameList: '.$row['id'].'=>'.$row['admin_name']);
		}
		//$this->writeLog('getAdminNameList: count($res)='.count($res));
		return $res;
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
		$filename = "chipslog";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}