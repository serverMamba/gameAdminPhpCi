<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class FinStatistics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'cwtj' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Fin_statistics_model' );
		$this->load->helper('date');
	}
	public function index() {
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		
		// 判断是否日期格式
		if (!isDate($query ['start_date']))
		{
			$this->session->set_flashdata ( 'error', '日期格式不正确' );
			redirect ( 'no3/finStatistics' );
		}
		
		if (!isDate($query ['end_date']))
		{
			$this->session->set_flashdata ( 'error', '日期格式不正确' );
			redirect ( 'no3/finStatistics' );
		}

		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "财务统计" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "财务统计" 
				),
				'statistics_list' => $this->Fin_statistics_model->getTotal ( $query ['start_date'],$query ['end_date'] ),
				'query' => $query 
		);
		
		$this->load->view ( 'no3/fin_statistics_views', $data );
	}
	public function getNewDataForYestaday() {
	    // test
        log_message('error', ', ok11');
		$date_yestaday = date ( 'Y-m-d', time () - 3600 * 24 * 1 );
		$query ['start_date'] = $date_yestaday;
		$query ['end_date'] = $date_yestaday;
		$this->Fin_statistics_model->updateYestadayTotalPay();
        // test
        log_message('error', ', ok12');
		// 判断是否日期格式
		if (!isDate($query ['start_date']))
		{
			$this->session->set_flashdata ( 'error', '日期格式不正确' );
			redirect ( 'no3/finStatistics' );
		}
        // test
        log_message('error', ', ok13');
	
		if (!isDate($query ['end_date']))
		{
			$this->session->set_flashdata ( 'error', '日期格式不正确' );
			redirect ( 'no3/finStatistics' );
		}
        // test
        log_message('error', ', ok14');
	
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "财务统计"
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "财务统计"
				),
				'statistics_list' => $this->Fin_statistics_model->getTotal ( $query ['start_date'],$query ['end_date'] ),
				'query' => $query
		);

        // test
        log_message('error', ', ok15, statistics_list = ' . json_encode($data['statistics_list']));
		$this->load->view ( 'no3/fin_statistics_views', $data );
	}
	public function syncChannelConfigToDB(){
		$num = $this->Fin_statistics_model->syncChannelConfigToDB();
		exit($num);
	}
	
}