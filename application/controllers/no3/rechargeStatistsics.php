<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class RechargeStatistsics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'recharge_statistics' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Order_statistics_model' );
	}
	public function index() {
		$channel_id = $this->input->get ( 'channel_id' ) ? $this->input->get ( 'channel_id' ) : 0;
		$date = $this->input->get ( 'date' ) ? $this->input->get ( 'date' ) : date ( 'Y-m-d' );
		// $v = $this->input->get('v') ? $this->input->get('v') : 1;
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "充值数据统计" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "充值数据统计" 
				),
				'channel_list' => $this->config->item ( 'channellist' ),
				'channel_id' => $channel_id,
				'date' => $date
		);
		
		$data ['chart_data'] = $this->Order_statistics_model->getOrderStatistics ( $channel_id, date ( 'Ymd', strtotime ( $date, $date . ' 00:00:00' ) )  );
		$this->load->view ( 'no3/recharge_statistics_views', $data );
	}
}