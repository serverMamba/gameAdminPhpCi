<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class dailipay_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	public function getDailiPayList($daili_no, $adduser, $describe, $start_time, $end_time, $per, $start) {
		$this->db->from ( 'smc_dailipay_no' );
		if ($daili_no) {
			$this->db->where ( 'daili_no', $daili_no );
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
			$this->db->where ( 'addtime < ', $end_time );
		}
		
		$this->db->limit ( $per, $start );
		$this->db->order_by ( 'id', 'DESC' );
		$query = $this->db->get ();
		$res = $query->result_array ();
		return $res;
	}
	public function getDailiPayNum($daili_no, $adduser, $describe, $start_time, $end_time, $per, $start) {
		$this->db->from ( 'smc_dailipay_no' );
		if ($daili_no) {
			$this->db->where ( 'daili_no', $daili_no );
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
			$this->db->where ( 'addtime < ', $end_time );
		}
		
		$res = $this->db->count_all_results ();
		return $res;
	}
	
	public function addDailiPayNew($data) {
		$res = $this->db->insert ( 'smc_dailipay_no', $data );
		return $res;
	}
	
	public function getDailiPayInfo($id){
		$this->db->from ( 'smc_dailipay_no' );
		$this->db->where ( 'id', $id );
		$this->db->limit(1);
		$query = $this->db->get ();
		return $query->row_array ();
	}
	
	public function deleteOneDailiPay($id)
	{
		$this->db->delete('smc_dailipay_no', array('id' => $id));
	}
	
	public function updateDailiPay($id, $data) {
		$this->db->where ( 'id', $id );
		$res = $this->db->update ( 'smc_dailipay_no', $data );
		return $res;
	}
	
	
	public function writeLog($txt) {
		if(!$txt)
		{
			return 1;
		}
		$type = "dailipaymgr";
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
	
	
}