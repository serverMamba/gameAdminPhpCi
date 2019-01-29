<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class PayStatistics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'paycwtj' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Fin_statistics_model' );
		$this->load->model ( 'dindan_model' );
	}
	public function index() {
		// modify: 增加筛选条件:tag、pay_type(weixin/alipay)
		$select_channel = $this->input->get ( 'channel', true ) ? $this->input->get ( 'channel', true ) : '';
		$pay_type = $this->input->get ( 'pay_type', true ) ? $this->input->get ( 'pay_type', true ) : '';
		$query ['stat_time'] = $this->input->get ( 'stat_time', true ) ? $this->input->get ( 'stat_time', true ) : '';
		
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		$statDatas = array();
		if($query ['stat_time']){
			$statDatas = $this->Fin_statistics_model->getPayStatics_old ( $query ['start_date'], $query ['end_date'], $select_channel, $pay_type, $query ['stat_time'] );
		}else{
			$statDatas = $this->Fin_statistics_model->getPayStatics ( $query ['start_date'], $query ['end_date'], $select_channel, $pay_type, $query ['stat_time'] );
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "支付统计" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "支付统计" 
				),
				'statistics_list' => $statDatas,
				'query' => $query ,
				'select_channel' => $select_channel,
				'pay_type' => $pay_type,
				'channellist' => $this->config->item ( 'channellist' ),
				'pay_list' => $this->dindan_model->getPayList()
		);
		$this->load->view ( 'no3/pay_statistics_views', $data );
	}
	

	private function writeLog($txt) {
		$log_file = "/log/PayStatistics.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
}
