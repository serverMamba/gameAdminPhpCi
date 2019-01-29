<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class CaiwuReport extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yingyingtongji' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Fin_statistics_model' );
	}
	public function index() {
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "运营统计"
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "运营统计"
				),
				'statistics_list' => $this->Fin_statistics_model->getTotal1 ( $query ['start_date'],$query ['end_date'] ),
				'query' => $query
		);
	
		$this->load->view ( 'no3/reporttotalview1', $data );
	}
}
