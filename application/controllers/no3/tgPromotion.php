<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TgPromotion extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'tg_account_promotion' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Tg_account_model' );
	}
	public function index() {
		$per = 30;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广统计" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广统计" 
				),
				'promotion_list' => $this->Tg_account_model->getPromotionList ($start,$per) 
		);
		$data ['total_rows'] = $this->Tg_account_model->getPromotionCount ();
		
		$this->load->library ( 'pagination' );
		$url = site_url ( 'no3/tgPromotion' );
		$config ['base_url'] = $url;
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/tg_promotion_list_views', $data );
	}
	public function report(){
		$promotion_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		$query['end_date'] = $this->input->get ( 'end_date' ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		$query['start_date'] = $this->input->get ( 'start_date' ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d', strtotime ( $query['end_date'] . ' 00:00:00' ) - 3600 * 24 * 6 );
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广统计"
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广统计"
				),
				'report' => $this->Tg_account_model->getPromotionStat($query['start_date'], $query['end_date'], $promotion_id),
				'query' => $query,
				'promotion_id' => $promotion_id
				
		);

		$this->load->view ( 'no3/tg_promotion_report_views', $data );
		
	}
}