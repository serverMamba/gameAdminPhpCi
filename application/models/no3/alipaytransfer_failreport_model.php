<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransfer_failreport_model extends CI_Model {

	var $sysReportOrderId = "00000000000000000000000000000000";
	public function __construct() {
		parent::__construct ();
	}
	
	/**
	 * 获取失败报告
	 * @param unknown_type $alipay_orderid
	 * @param unknown_type $alipay_account
	 * @param unknown_type $startTime
	 * @param unknown_type $endTime
	 * @param unknown_type $status
	 * @param unknown_type $start
	 * @param unknown_type $per
	 * @param unknown_type $reportList
	 * @param unknown_type $reportNum
	 */
	function get_failreport_list (
		$alipay_orderid, $alipay_account,
		$startTime, $endTime, $status,
		$start, $per, &$reportList, &$reportNum )
	{
		$reportList = array();
		$reportNum = 0;

		$db = $this->load->database ( 'default_slave', true );
		
		$db->from ( 'smc_alipay_transfer_fail_report' );
		if ($alipay_orderid) {
			$db->where ( 'alipayOrderId', $alipay_orderid );
		}
		
		if($alipay_account){
			$db->where ( 'alipayAccount', $alipay_account );
		}
		
		if ($startTime) {
			$db->where ( 'time >= ', strtotime ( $startTime ) );
		}
		if ($endTime) {
			$db->where ( 'time <= ', strtotime ( $endTime ) );
		}

		if ($status != -1) 
		{
			$db->where ( 'status', $status );
		}
		
		$db->order_by ( 'time', 'DESC' );
		$db->limit ( $per, $start );
		$query = $db->get ();
		$reportList = $query->result_array ();
		
		// 总数量
		$db->from ( 'smc_alipay_transfer_fail_report' );
		if ($alipay_orderid) {
			$db->where ( 'alipayOrderId', $alipay_orderid );
		}
		
		if($alipay_account){
			$db->where ( 'alipayAccount', $alipay_account );
		}
		
		if ($startTime) {
			$db->where ( 'time >= ', strtotime ( $startTime ) );
		}
		if ($endTime) {
			$db->where ( 'time <= ', strtotime ( $endTime ) );
		}

		if ($status != -1) 
		{
			$db->where ( 'status', $status );
		}
		$reportNum = $db->count_all_results();
		
		return;
	}
	
	function getReportById($id)
	{
		$db = $this->load->database ( 'default_slave', true );
		
		$db->from ( 'smc_alipay_transfer_fail_report' );
		$db->where ( 'id', $id );
		$query = $db->get ();
		return $query->row_array ();
	}

	function closeReport($id)
	{
		$db = $this->load->database ( 'default', true );
		$db->where ( 'id', $id );
		return $db->update( 'smc_alipay_transfer_fail_report', array('status' => 2, 'dealTime' => time()));
	}

	function closeAllSysReport()
	{
		$db = $this->load->database ( 'default', true );
		$db->where ( array(
				'alipayOrderId' => $this->sysReportOrderId,
				'status' => 0,
				) );
		return $db->update( 'smc_alipay_transfer_fail_report', array('status' => 2, 'dealTime' => time()));
	}

	function setReportSuccess($id, $userId)
	{
		$db = $this->load->database ( 'default', true );
		$db->where ( 'id', $id );
		return $db->update( 'smc_alipay_transfer_fail_report', array(
				'status' => 1, 
				'memo' => $userId,
				'dealTime' => time()
				));
	}
}
