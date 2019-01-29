<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class cus_task_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	//$card_id, $amount, $notify_cardholder,$out_trade_no, $res_code, $adduser, $start_time, $end_time
	public function getTaskList($card_id, $amount, $notify_cardholder,$out_trade_no, $res_code, $adduser, $pay_platform, $start_time, $end_time, $per, $start) {
		$this->db->from ( 'smc_task_form' );
		if ($card_id) {
			$this->db->where ( 'card_id', $card_id );
		}
		if ($amount) {
			$this->db->where ( 'amount', $amount );
		}
		if ($notify_cardholder) {
			$this->db->where ( 'notify_cardholder', $notify_cardholder );
		}
		if ($out_trade_no) {
			$this->db->where ( 'out_trade_no', $out_trade_no );
		}
		if ($res_code) {
			$this->db->where ( 'res_code', $res_code );
		}
		if ($adduser) {
			$this->db->where ( 'adduser', $adduser );
		}
		if ($pay_platform) {
			$this->db->where ( 'pay_platform', $pay_platform );
		}
		if ($start_time) {
			$this->db->where ( 'addtime >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'addtime <= ', $end_time );
		}
		
		$this->db->limit ( $per, $start );
		$this->db->order_by ( 'id', 'DESC' );
		$query = $this->db->get ();
		$res = $query->result_array ();
		return $res;
	}
	public function getTaskNum($card_id, $amount, $notify_cardholder,$out_trade_no, $res_code, $adduser, $pay_platform, $start_time, $end_time) {
	$this->db->from ( 'smc_task_form' );
		if ($card_id) {
			$this->db->where ( 'card_id', $card_id );
		}
		if ($amount) {
			$this->db->where ( 'amount', $amount );
		}
		if ($notify_cardholder) {
			$this->db->where ( 'notify_cardholder', $notify_cardholder );
		}
		if ($out_trade_no) {
			$this->db->where ( 'out_trade_no', $out_trade_no );
		}
		if ($res_code) {
			$this->db->where ( 'res_code', $res_code );
		}
		if ($adduser) {
			$this->db->where ( 'adduser', $adduser );
		}
		if ($pay_platform) {
			$this->db->where ( 'pay_platform', $pay_platform );
		}
		if ($start_time) {
			$this->db->where ( 'addtime >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'addtime <= ', $end_time );
		}
		
		$res = $this->db->count_all_results ();
		return $res;
	}
	
	public function addTaskNew($data) {
		$res = $this->db->insert ( 'smc_task_form', $data );
		return $res;
	}
	
	public function getTaskId($out_trade_no) {
		$this->db->select ( 'id' );
		$this->db->from ( 'smc_task_form' );
		$this->db->where ( 'out_trade_no', $out_trade_no );
		$this->db->limit ( 1 );
		$q = $this->db->get ();
		$res = $q->row_array ();
		return $res;
	}
	
	
	public function getTaskInfo($id)
	{
		$this->db->from ( 'smc_task_form' );
		$this->db->where ( 'id', $id );
		$query = $this->db->get ();
		$res = $query->row_array ();
		return $res;
	}
	
	public function updatetask($out_trade_no, $data) {
		$this->db->where ( 'out_trade_no', $out_trade_no );
		$res = $this->db->update ( 'smc_task_form', $data );
		return $res;
	}
	
	
	
	public function inserttaskNew($data) {
		$this->writeLog("0 inserttaskNew: ".$data);
		//$db1 = $this->load->database ( 'db_task', true );
		$res = $this->db->insert ( 'smc_task_form', $data );
		$this->writeLog("1 res: ".$res);
		//$this->db->close ();
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
	public function gettaskForm($task_id)
	{
		//$db1 = $this->load->database ( 'db_task', true );
		$this->db->from ( 'smc_task_form' );
		$this->db->where ( 'id', $task_id );
		$query = $this->db->get ();
		$res = $query->row_array ();
		//$this->db->close ();
		return $res;
	}
	public function getChildSolution($task_id) {
		$start = 0;
		$per = 10;
		$sql = "select * from smc_task_form where task_id=$task_id order by id desc LIMIT $start,$per";
		$query = $this->db->query ( $sql );
		$res = $query->result_array ();
		return $res;
	}	
	public function deltask($id) {
		//$db1 = $this->load->database ( 'db_task', true );
		$this->deltaskSoluction($id);
		$this->db->where ( 'id', $id );
		$res = $this->db->delete ( 'smc_task_form' );
		//$this->db->close ();
		return $res;
	}
	public function deltaskSoluction($id)
	{
		//$db1 = $this->load->database ( 'db_task', true );
		$this->db->where ( 'task_id', $id );
		$res = $this->db->delete ( 'smc_task_form');
		//$this->db->close ();
		return $res;
	}
	
	public function getTaskForms($res_code, $pay_platform){
		$this->db->from ( 'smc_task_form' );
		if ($res_code) {
			$this->db->where ( 'res_code', $res_code );
		}
		if ($pay_platform) {
			$this->db->where ( 'pay_platform', $pay_platform );
		}
		$this->db->order_by ( 'id', 'DESC' );
		$query = $this->db->get ();
		$res = $query->result_array ();
		return $res;
	}
	
	public function writeLog($txt) {
		if(!$txt)
		{
			return 1;
		}
		$type = "cus_task";
		//$fileName = "c:/log/".$type.date ( 'Ymd', time () ).".log";
		$fileName = "/log/".$type.date ( 'Ymd', time () ).".log";
		$myfile = fopen($fileName, "a+");
		if($myfile)
		{
			$txt = "[" . date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
			fwrite($myfile, $txt);
			fclose($myfile);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	
}