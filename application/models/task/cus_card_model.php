<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class cus_card_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	//$id, $status, $bankcard_no,$bank_branch, $cardholder_name, $cardholder_mobile, $adduser, $describe, $start_time, $end_time
	public function getCardList($id, $status, $bankcard_no,$bank_branch, $cardholder_name, $cardholder_mobile, $adduser, $describe, $start_time, $end_time, $per, $start, $admin_name) {
		$this->db->from ( 'smc_task_bankcard' );
		if ($id) {
			$this->db->where ( 'id', $id );
		}
		if ($status) {
			$this->db->where ( 'status', $status );
		}
		if ($bankcard_no) {
			$this->db->where ( 'bankcard_no', $bankcard_no );
		}
		if ($bank_branch) {
			$this->db->where ( "bank_branch like ", "%".$bank_branch."%" );
		}
		if ($cardholder_name) {
			$this->db->where ( "cardholder_name like ", "%".$cardholder_name."%" );
		}
		if ($adduser){
			$this->db->where ( "adduser", $adduser );
		}
		if ($describe) {
			$this->db->where ( "describe like ", "%".$describe."%" );
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
	public function getCardNum($id, $status, $bankcard_no,$bank_branch, $cardholder_name, $cardholder_mobile, $adduser, $describe, $start_time, $end_time, $admin_name) {
	$this->db->from ( 'smc_task_bankcard' );
		if ($id) {
			$this->db->where ( 'id', $id );
		}
		if ($status) {
			$this->db->where ( 'status', $status );
		}
		if ($bankcard_no) {
			$this->db->where ( 'bankcard_no', $bankcard_no );
		}
		if ($bank_branch) {
			$this->db->where ( "bank_branch like ", "%".$bank_branch."%" );
		}
		if ($cardholder_name) {
			$this->db->where ( "cardholder_name like ", "%".$cardholder_name."%" );
		}
		if ($adduser){
			$this->db->where ( "adduser", $adduser );
		}
		if ($describe) {
			$this->db->where ( "describe like ", "%".$describe."%" );
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
	
	public function addCardNew($data) {
		$res = $this->db->insert ( 'smc_task_bankcard', $data );
		return $res;
	}
	
	public function getCardId($uuid) {
		$this->db->select ( 'id' );
		$this->db->from ( 'smc_task_bankcard' );
		$this->db->where ( 'uuid', $uuid );
		$this->db->limit ( 1 );
		$q = $this->db->get ();
		$res = $q->row_array ();
		return $res;
	}
	
	public function getCardInfo($id)
	{
		$this->db->from ( 'smc_task_bankcard' );
		$this->db->where ( 'id', $id );
		$this->db->limit(1);
		$query = $this->db->get ();
		return $query->row_array ();
	}
	
	public function deleteOneCard($id)
	{
		$this->db->delete('smc_task_bankcard', array('id' => $id));
	}
	
	public function modifyOneCard($id, $updateData)
	{
		$dbResult = $this->db->update('smc_task_bankcard', $updateData, array('id' => $id));
		
		if ($dbResult <= 0)
		{
			return false;
		}

		return true;
	}
	
	public function updatecard($id, $data) {
		$this->db->where ( 'id', $id );
		$res = $this->db->update ( 'smc_task_bankcard', $data );
		return $res;
	}
	
	
	public function writeLog($txt) {
		if(!$txt)
		{
			return 1;
		}
		$type = "cardmgr";
		$fileName = "/log/".$type.".log";
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
	
	public function getCardInfoExpPai($bankcard_no)
	{
		if($bankcard_no){
			$this->db->from ( 'smc_task_cardexp_pai' );
			$this->db->where ( 'bankcard_no', $bankcard_no );
			$this->db->limit(1);
			$query = $this->db->get ();
			return $query->row_array ();
		}
		return array();
	}
	public function modifyCardInfoExpPai($bankcard_no, $modifyData)
	{
		$infoExp = $this->getCardInfoExpPai($bankcard_no);
		if($infoExp && count($infoExp)>0){
			$dbResult = $this->db->update('smc_task_cardexp_pai', $modifyData, array('bankcard_no' => $bankcard_no));
			if (!$dbResult)
			{
				return false;
			}else{
				return true;
			}
		}else{
			$modifyData['bankcard_no'] = $bankcard_no;
			$dbResult = $this->db->insert ( 'smc_task_cardexp_pai', $modifyData );
			if($dbResult){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
}