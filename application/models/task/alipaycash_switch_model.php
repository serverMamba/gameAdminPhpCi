<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaycash_switch_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	
	//$app_id, $status, $email,$pc_ip, $update_admin, $start_time, $end_time
	public function getAlipayConfigList($app_id, $status, $email, $pc_ip, $update_admin, $start_time, $end_time, $per, $start, $check_flag=0) {
		$this->db->from ( 'smc_alipay_cash_config' );
		if ($app_id) {
			$this->db->where ( 'app_id', $app_id );
		}
		if ($status) {
			$this->db->where ( 'status', $status );
		}
		if ($email) {
			$this->db->where ( "email like ", "%".$email."%" );
		}
		if ($pc_ip) {
			$this->db->where ( "pc_ip like ", "%".$pc_ip."%" );
		}
		if ($update_admin){
			$this->db->where ( "update_admin", $update_admin );
		}
		if ($start_time) {
			$this->db->where ( 'oper_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'oper_time < ', $end_time );
		}
		if ($check_flag) {
			$this->db->where ( 'check_flag', $check_flag );
		}
		$this->db->limit ( $per, $start );
		$this->db->order_by ( 'id', 'DESC' );
		$query = $this->db->get ();
		$res = $query->result_array ();
		return $res;
	}
	public function getAlipayConfigNum($app_id, $status, $email,$pc_ip, $update_admin, $start_time, $end_time, $check_flag=0) {
		$this->db->from ( 'smc_alipay_cash_config' );
		if ($app_id) {
			$this->db->where ( 'app_id', $app_id );
		}
		if ($status) {
			$this->db->where ( 'status', $status );
		}
		if ($email) {
			$this->db->where ( "email like ", "%".$email."%" );
		}
		if ($pc_ip) {
			$this->db->where ( "pc_ip like ", "%".$pc_ip."%" );
		}
		if ($update_admin){
			$this->db->where ( "update_admin", $update_admin );
		}
		if ($start_time) {
			$this->db->where ( 'oper_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'oper_time < ', $end_time );
		}
		if ($check_flag) {
			$this->db->where ( 'check_flag', $check_flag );
		}
		
		$res = $this->db->count_all_results ();
		return $res;
	}
	
	public function addAlipayConfigRecord($data) {
		$data['update_ip'] = $this->getIp();
		$res = $this->db->insert ( 'smc_alipay_cash_config', $data );
		return $res;
	}
	public function getAlipayConfigInfo($app_id)
	{
		$this->db->from ( 'smc_alipay_cash_config' );
		$this->db->where ( 'app_id', $app_id );
		$this->db->limit(1);
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function updateAlipayConfig($app_id, $data) {
		$this->db->where ( 'app_id', $app_id );
		$data['oper_time'] = date('Y-m-d H:i:s',time());
		$data['update_ip'] = $this->getIp();
		$res = $this->db->update ( 'smc_alipay_cash_config', $data );
		return $res;
	}

	public function deleteAlipayConfig($app_id)
	{
		return $this->db->delete('smc_alipay_cash_config', array('app_id' => $app_id));
	}
	
	
	private function getIp() {
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$cip = $_SERVER ["HTTP_CLIENT_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
			$cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		} elseif (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$cip = $_SERVER ["REMOTE_ADDR"];
		} else {
			$cip = "无法获取！";
		}
		return $cip;
	}
	public function writeLog($txt) {
		if(!$txt)
		{
			return 1;
		}
		$type = "alipaycashswtichmgr";
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