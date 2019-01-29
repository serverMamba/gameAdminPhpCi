<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_charge_withdrawal_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
    /**
     * 获取用户每日充值数据
     * @param string $userId
     * @param int $startTime
     * @param int $endTime
     */
    public function getUserChargeDailyData($userId, $startTime, $endTime)
    {
    	$db = $this->load->database('default_slave', true);
    	$db->select('money / 100 as money, add_time')->from('smc_order');
    	$db->where(array(
    			'user_id' => $userId,
    			'status' => 1,
    			'add_time >=' => $startTime,
    			'add_time <=' => $endTime,
    			));
    	
    	$dbResult = $db->get()->result_array();
    	
    	return $dbResult;
    }
    
    /**
     * 获取用户每日提现数据
     * @param string $userId
     * @param int $startTime
     * @param int $endTime
     */
    public function getUserWithdrawalDailyData($userId, $startTime, $endTime)
    {
    	$db1 = $this->load->database('cashorder1_slave', true);
    	$db1->select('cash_money / 100 as cash_money, add_time')->from('smc_cash_order');
    	$db1->where(array(
    			'user_id' => $userId,
    			'status' => 1,
    			'add_time >=' => $startTime,
    			'add_time <=' => $endTime,
    			));
    	
    	$dbResult1 = $db1->get()->result_array();

    	$db2 = $this->load->database('cashorder2_slave', true);
    	$db2->select('cash_money / 100 as cash_money, add_time')->from('smc_cash_order');
    	$db2->where(array(
    			'user_id' => $userId,
    			'status' => 1,
    			'add_time >=' => $startTime,
    			'add_time <=' => $endTime,
    			));
    	
    	$dbResult2 = $db2->get()->result_array();
    	
    	$dbResult = array_merge($dbResult1, $dbResult2);
    	
    	return $dbResult;
    }
}