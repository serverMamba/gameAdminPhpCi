<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Brechargel extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kefu_recharge_list' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Brecharge_model' );
	}
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : 0;
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', time () - 7 * 86400 );
		$query ['start_time_time'] = $this->input->get ( 'start_time_time', true ) ? $this->input->get ( 'start_time_time', true ) : "00:00";
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', time () + 86400 );
		$query ['end_time_time'] = $this->input->get ( 'end_time_time', true ) ? $this->input->get ( 'end_time_time', true ) : "00:00";
		$query ['admin_id'] = $this->input->get ( 'admin_id', true ) ? $this->input->get ( 'admin_id', true ) : '';
		
		$startTime = $query ['start_time'] . " " . $query ['start_time_time'];
		
		$endTime = $query ['end_time'] . " " . $query ['end_time_time'];
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$orderList = array ();
		$totalNum = 0;
		$this->Brecharge_model->get_dindan_his ( $query ['user_id'],$startTime, $endTime, $query ['admin_id'], $start, $per, $orderList, $totalNum );
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "客服人工订单查询" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "客服人工查询" 
				),
				"header2" => array (
						"father" => "玩家订单查询",
						"child" => "客服人工订单数据 " 
				),
				'order_list' => $orderList,
				'kefu_list' => $this->Brecharge_model->getKefuList (),
				'query' => $query,
				'sum' => $this->Brecharge_model->getSum ( $query ['user_id'],$startTime, $endTime, $query ['admin_id'] )
		);
		
		$data ['total_rows'] = $totalNum;
		
		$this->load->library ( 'pagination' );
		$url = site_url ( 'no3/brecharge/index' ) . '?' . http_build_query ( $query );
		$config ['base_url'] = $url;
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/brecharge_list_views', $data );
	}
}