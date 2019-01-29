<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class WithdrawalTotal extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'cwgl_withdrawal_total' )) {
			redirect ( 'no3/index' );
		}
	}
	public function index() {

		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "提现总额统计" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "提现总额统计" 
				),
				'data' => $this->getWithdrawalTotal( $query ['start_date'], $query ['end_date']),
				'query' => $query ,
		);
		
		$this->load->view ( 'no3/withdrawal_total_views', $data );
	}
	
	private function getWithdrawalTotal($start_date, $end_date)
	{
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 23:59:59' );

		// 第一个库
		$db1 = $this->load->database ( 'cashorder1_slave', true );
		// 总共提现
		$db1->from ( 'smc_cash_order' );
		$db1->where ( 'status', CASH_ORDER_STATUS_SUCCESS );
		$db1->where ( 'alifee != ', 0 );
		$db1->where ( 'update_time >= ', $start_time );
		$db1->where ( 'update_time <= ', $end_time );
		$db1->select('sum(cash_money) / 100 as cm, sum(real_cash_money) / 100 as rcm, sum(alirealtransfer) / 100 as art, sum(alifee) / 100 as af');
		
		$db1Data = $db1->get ()->row_array();
		$db1Data['fee'] = $db1Data['cm'] - $db1Data['rcm'];

		// 人工处理的提现总额
		$db1->from ( 'smc_cash_order' );
		$db1->where ( 'status', CASH_ORDER_STATUS_SUCCESS );
		$db1->where ( 'alifee', 0 );
		$db1->where ( 'update_time >= ', $start_time );
		$db1->where ( 'update_time <= ', $end_time );
		$db1->select('sum(cash_money) / 100 as cm, sum(real_cash_money) / 100 as rcm');
		
		$db1DataManual = $db1->get ()->row_array();
		$db1Data['man'] = $db1DataManual['cm'];
		$db1Data['manfee'] = $db1DataManual['cm'] - $db1DataManual['rcm'];

		// 第二个库
		$db2 = $this->load->database ( 'cashorder2_slave', true );
		// 总共提现
		$db2->from ( 'smc_cash_order' );
		$db2->where ( 'status', CASH_ORDER_STATUS_SUCCESS );
		$db2->where ( 'alifee != ', 0 );
		$db2->where ( 'update_time >= ', $start_time );
		$db2->where ( 'update_time <= ', $end_time );
		$db2->select('sum(cash_money) / 100 as cm, sum(real_cash_money) / 100 as rcm, sum(alirealtransfer) / 100 as art, sum(alifee) / 100 as af');
		
		$db2Data = $db2->get ()->row_array();
		$db2Data['fee'] = $db2Data['cm'] - $db2Data['rcm'];
		
		$db2->from ( 'smc_cash_order' );
		$db2->where ( 'status', CASH_ORDER_STATUS_SUCCESS );
		$db2->where ( 'alifee', 0 );
		$db2->where ( 'update_time >= ', $start_time );
		$db2->where ( 'update_time <= ', $end_time );
		$db2->select('sum(cash_money) / 100 as cm, sum(real_cash_money) / 100 as rcm');
		
		$db2DataManual = $db2->get ()->row_array();
		$db2Data['man'] = $db2DataManual['cm'];
		$db2Data['manfee'] = $db2DataManual['cm'] - $db2DataManual['rcm'];
		
		return array(
				'cm' => $db1Data['cm'] + $db2Data['cm'],
				'feeTotal' => $db1Data['fee'] + $db2Data['fee'] + $db1Data['manfee'] + $db2Data['manfee'],
				'man' => $db1Data['man'] + $db2Data['man'],
				'fee' => $db1Data['fee'] + $db2Data['fee'],
				'art' => $db1Data['art'] + $db2Data['art'],
				'af' => $db1Data['af'] + $db2Data['af'],
				);
	}
}