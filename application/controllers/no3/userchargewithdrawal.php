<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Userchargewithdrawal extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yybb_charge_withdrawal' )) {
			redirect ( 'no3/index' );
		}
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "充值提现记录" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "充值提现记录" 
				),
				"header2" => array (
						"father" => "运营报表",
						"child" => "充值提现记录 " 
				),
		);
		
		$this->load->view ( 'no3/user_charge_withdrawal_views', $data );
	}

	/**
	 * 获取某用户的每日充值提现金额
	 */
	public function getUserChargeWithdrawalDailyData()
	{
		$this->load->model ( 'no3/User_charge_withdrawal_model' );
		$userId = $this->input->get_post ( 'userId' );
		$startTime = $this->input->get_post ( 'startTime' );
		$endTime = $this->input->get_post ( 'endTime' );
		if (empty ( $userId ) || empty ( $startTime ) || empty ( $endTime ))
		{
			echo json_encode ( array (
					"status" => "1" ,
					"msg" => "缺少参数",
			) );
			return;
		}

		// 1. 找到开始那天的0点，以及结束那天的后一天的0点，作为时间区间
		$oneDaySec = 24 * 3600;

		$startTime = strtotime($startTime . " 00:00:00");
		// $startDate = date('YmdHis', $startTime);
		$endTime = strtotime($endTime . " 00:00:00 +1 day");
		// $endDate = date('YmdHis', $endTime);
		
		if ($endTime <= $startTime)
		{
			echo json_encode ( array (
					"status" => "1" ,
					"msg" => "时间区间不正确",
			) );
			return;
		}
		
		$days = intval(($endTime - $startTime) / $oneDaySec);
		
		// 2. 获取数据
		$chargeDBData = $this->User_charge_withdrawal_model->getUserChargeDailyData ( $userId, $startTime, $endTime);
		$withdrawalDBData = $this->User_charge_withdrawal_model->getUserWithdrawalDailyData ( $userId, $startTime, $endTime);

		// 3. 对数据做处理，处理成每天都有数据
		$dateTimestampArray = array();
		$dateArray = array();
		$totalCharge = 0;
		$totalWithdrawal = 0;
		$chargeDailyData = array();
		$withdrawalDailyData = array();
		
		for ($i = 0; $i < $days; $i++)
		{
			$dateArray[] = date('Y-m-d', $startTime + $i * $oneDaySec);
		}
		
		for ($i = 0; $i < count($chargeDBData); $i++)
		{
			$oneData = $chargeDBData[$i];
			$totalCharge += $oneData['money'];
			
			$chargeDate = date("Y-m-d", $oneData['add_time']);
			if (!isset($chargeDailyData[$chargeDate]))
			{
				$chargeDailyData[$chargeDate] = $oneData['money'];
			}
			else
			{
				$chargeDailyData[$chargeDate] += $oneData['money'];
			}
		}
		
		for ($i = 0; $i < count($withdrawalDBData); $i++)
		{
			$oneData = $withdrawalDBData[$i];
			$totalWithdrawal += $oneData['cash_money'];
			
			$withdrawDate = date("Y-m-d", $oneData['add_time']);
			if (!isset($withdrawalDailyData[$withdrawDate]))
			{
				$withdrawalDailyData[$withdrawDate] = $oneData['cash_money'];
			}
			else
			{
				$withdrawalDailyData[$withdrawDate] += $oneData['cash_money'];
			}
		}
		
		echo json_encode ( array(
				'date' => $dateArray,
				'chargeData' => $chargeDailyData,
				'withdrawalData' => $withdrawalDailyData,
				'totalCharge' => $totalCharge,
				'totalWithdrawal' => $totalWithdrawal,
				) );
	}
}
