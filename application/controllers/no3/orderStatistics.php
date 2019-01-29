<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class OrderStatistics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'order_statistics' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Order_statistics_model' );
	}
	public function index() {
		$channel_id = $this->input->get('channel_id') ? $this->input->get('channel_id') : 0;
		$show_type = $this->input->get('show_type') ? $this->input->get('show_type') : 1;
		$v = $this->input->get('v') ? $this->input->get('v') : 1;
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "充值提现数据" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "充值提现数据" 
				),
				'channel_list' => $this->config->item ( 'channellist' ),
				'channel_id' => $channel_id,
				'show_type' => $show_type,
				'show_v' => $v
		);
		
		if($v == 1){
			$data['chart_data'] = $this->Order_statistics_model->getOrderStatistics1 ( $channel_id, $show_type,14 );
		}else{
			$data['chart_data'] = $this->Order_statistics_model->getOrderStatistics ( $channel_id, $show_type,14 );
		}
		$this->load->view ( 'no3/order_statistics_views', $data );
	}
}