<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class KefuStatistsics extends CI_Controller {
	public function __construct() {
		parent::__construct ( );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kefu_statistics' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Order_statistics_model' );
	}
	public function index() {
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "客服数据统计" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "客服数据统计" 
				),
				'query' => $query,
				'statistics_list' => $this->Order_statistics_model->getKefuStatistics ( $query ['start_date'],$query ['end_date'] ),
		);

		$this->load->view ( 'no3/kefu_statistics_views', $data );
	}
}