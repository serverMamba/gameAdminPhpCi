<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Clientbug_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function insertBugSolution($data) {
		return $this->db->insert ( 'smc_client_bug_handle', $data );
	}
	public function insertBugNew($data) {
		return $this->db->insert ( 'smc_client_bug', $data );
	}
	public function getBugId($uuid) {
		$this->db->select ( 'id' );
		$this->db->from ( 'smc_client_bug' );
		$this->db->where ( 'uuid', $uuid );
		$this->db->limit ( 1 );
		$q = $this->db->get ();
		return $q->row_array ();
	}
	public function getClientBugList($id, $user_id, $operuser, $start_time, $end_time, $status, $bugtype, $describe, $per, $start) {
		$db1 = $this->load->database ( 'cashorder2', true );
		$db1->from ( 'smc_client_bug' );
		if ($id) {
			$db1->where ( 'id', $id );
		}
		if ($user_id) {
			$db1->where ( 'user_id', $user_id );
		}
		if ($operuser) {
			$db1->where ( 'operuser', $operuser );
		}
		if ($start_time) {
			$db1->where ( 'opertime >= ', $start_time );
		}
		if ($end_time) {
			$db1->where ( 'opertime <= ', $end_time );
		}		
		if ($status) {
			$db1->where ( 'status', $status );
		}
		if ($bugtype) {
			$db1->where ( 'bugtype', $bugtype );
		}
		if ($describe) {
			$db1->where ( "describe like ", "%".$describe."%" );
		}
		$db1->limit ( $per, $start );
		$db1->order_by ( 'id', 'DESC' );
		$query = $db1->get ();
		$return_ary = $query->result_array ();
	
		return $return_ary;
	}
	public function getOrderNum($id, $user_id, $operuser, $start_time, $end_time, $status, $bugtype, $describe) {
		$db1 = $this->load->database ( 'cashorder2', true );
		$db1->from ( 'smc_client_bug' );
		if ($id) {
			$db1->where ( 'id', $id );
		}
		if ($user_id) {
			$db1->where ( 'user_id', $user_id );
		}
		if ($operuser) {
			$db1->where ( 'operuser', $operuser );
		}
		if ($start_time) {
			$db1->where ( 'opertime >= ', $start_time );
		}
		if ($end_time) {
			$db1->where ( 'opertime <= ', $end_time );
		}		
		if ($status) {
			$db1->where ( 'status', $status );
		}
		if ($bugtype) {
			$db1->where ( 'bugtype', $bugtype );
		}
		if ($describe) {
			$db1->where ( "describe like ", "%".$describe."%" );
		}
		return $db1->count_all_results ();
	}
	function sortArrByField(&$array, $field, $desc = false) {
		$fieldArr = array ();
		foreach ( $array as $k => $v ) {
			$fieldArr [$k] = $v [$field];
		}
		$sort = $desc == false ? SORT_ASC : SORT_DESC;
		array_multisort ( $fieldArr, $sort, $array );
	}
	public function getBugForm($bug_id)
	{
		$this->db->from ( 'smc_client_bug' );
		$this->db->where ( 'id', $bug_id );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function getChildSolution($bug_id) {
		$this->db->from ( 'smc_client_bug_handle' );
		$this->db->where ( 'bug_id', $bug_id );
		//$this->db->order_by ( 'opertime', 'DESC' );
		$query = $this->db->get ();
		return $query->result_array ();
	}	
	public function updateClientBug($id, $data) {
		$this->db->where ( 'id', $id );
		return $this->db->update ( 'smc_client_bug', $data );
	}
	public function delClientBug($id) {
		$this->delBugSoluction($id);
		$this->db->where ( 'id', $id );
		return $this->db->delete ( 'smc_client_bug' );
	}
	public function delBugSoluction($id)
	{
		$this->db->where ( 'bug_id', $id );
		return $this->db->delete ( 'smc_client_bug_handle');
	}
	
}