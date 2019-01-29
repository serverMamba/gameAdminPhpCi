<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransfer_card_model extends CI_Model {

	public function __construct() {
		parent::__construct ();
	}

	/**
	 * 获取卡列表
	 * @param unknown_type $query
	 * @param unknown_type $startTime
	 * @param unknown_type $endTime
	 * @param unknown_type $start
	 * @param unknown_type $per
	 * @param unknown_type $cardList
	 * @param unknown_type $cardNum
	 */
	function get_card_list ( $query, $startTime, $endTime, $start, $per, &$cardList, &$cardNum )
	{
		$cardList = array();
		$cardNum = 0;

		$db = $this->load->database ( 'default_slave', true );
		
		$db->from ( 'smc_card' );
		if ($query['alipay_orderid']) {
			$db->where ( 'alipayOrderId', $query['alipay_orderid'] );
		}
		
		if($query['alipay_account']){
			$db->where ( 'alipayAccount', $query['alipay_account'] );
		}
		
		if($query['status'] != -1) 
		{
			$db->where ( 'status', $query['status'] );
		}
		
		if($query['user_id']) 
		{
			$db->where ( 'userId', $query['user_id'] );
		}
		
		if($query['card_num']) 
		{
			$db->where ( 'cardNum', $query['card_num'] );
		}
		
		if($query['card_pass']) 
		{
			$db->where ( 'cardPass', $query['card_pass'] );
		}
		
		if ($startTime) {
			$db->where ( 'createTime >= ', strtotime ( $startTime ) );
		}
		if ($endTime) {
			$db->where ( 'createTime <= ', strtotime ( $endTime ) );
		}

		$db->order_by ( 'createTime', 'DESC' );
		$db->limit ( $per, $start );
		$dbQuery = $db->get ();
		$cardList = $dbQuery->result_array ();
		
		///////////
		// 总数量
		$db->from ( 'smc_card' );
		if ($query['alipay_orderid']) {
			$db->where ( 'alipayOrderId', $query['alipay_orderid'] );
		}
		
		if($query['alipay_account']){
			$db->where ( 'alipayAccount', $query['alipay_account'] );
		}
		
		if($query['status'] != -1) 
		{
			$db->where ( 'status', $query['status'] );
		}
		
		if($query['user_id']) 
		{
			$db->where ( 'userId', $query['user_id'] );
		}
		
		if($query['card_num']) 
		{
			$db->where ( 'cardNum', $query['card_num'] );
		}
		
		if($query['card_pass']) 
		{
			$db->where ( 'cardPass', $query['card_pass'] );
		}
		
		if ($startTime) {
			$db->where ( 'createTime >= ', strtotime ( $startTime ) );
		}
		if ($endTime) {
			$db->where ( 'createTime <= ', strtotime ( $endTime ) );
		}

		$cardNum = $db->count_all_results();
		
		return;
	}
	
}
