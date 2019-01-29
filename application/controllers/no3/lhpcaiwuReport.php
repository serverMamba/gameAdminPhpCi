<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpcaiwuReport extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_cwtongji' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/lhp_cwstatistics_model' );
	}
	public function index1() {
		exit( 'no3/lhp_cwstatistics_model');
	}
	public function index() {
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' , strtotime ( '-30 day' ));
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "财务统计"
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "财务统计"
				),
				'statistics_list' => $this->lhp_cwstatistics_model->get_statistic ( $query ['start_date'],$query ['end_date'] ),
				'query' => $query
		);
		//exit( $query ['end_date'].',lhpcw_reporttotalview,no3/lhp_cwstatistics_model');
		$this->load->view ( 'no3/lhpcw_reporttotalview', $data );
	}
}
