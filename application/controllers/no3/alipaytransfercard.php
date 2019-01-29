<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransfercard extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_alipay_transfer_card' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/alipaytransfer_card_model' );
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Order_model' );
	}

	public function index() {
		$query ['alipay_orderid'] = $this->input->get ( 'alipay_orderid', true ) ? $this->input->get ( 'alipay_orderid', true ) : '';
		$query ['alipay_account'] = $this->input->get ( 'alipay_account', true ) ? $this->input->get ( 'alipay_account', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true )  : date('Y-m-d', time() - 1 * 86400);
		$query ['start_time_time'] = $this->input->get ( 'start_time_time', true ) ? $this->input->get ( 'start_time_time', true )  : "00:00";
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true )  : date('Y-m-d', time() + 86400);
		$query ['end_time_time'] = $this->input->get ( 'end_time_time', true ) ? $this->input->get ( 'end_time_time', true )  : "00:00";
		$query ['card_num'] = ($this->input->get ( 'card_num', true ) !== false) ?  $this->input->get ( 'card_num', true )  : "";
		$query ['card_pass'] = ($this->input->get ( 'card_pass', true ) !== false) ?  $this->input->get ( 'card_pass', true )  : "";
		$query ['user_id'] = ($this->input->get ( 'user_id', true ) !== false) ?  $this->input->get ( 'user_id', true )  : "";
		$query ['status'] = ($this->input->get ( 'status', true ) !== false) ? intval ( $this->input->get ( 'status', true ) ) : -1;
		
		$startTime = $query['start_time'] . " " . $query['start_time_time'];
		$endTime = $query['end_time'] . " " . $query['end_time_time'];

		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$cardList = array();
		$cardNum = 0;
		$this->alipaytransfer_card_model->get_card_list ( $query , $startTime, $endTime, $start, $per, $cardList, $cardNum );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付宝转账卡号卡密" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付宝转账卡号卡密" 
				),
				"header2" => array (
						"father" => "客服管理",
						"child" => "支付宝转账卡号卡密 " 
				),
				'cardList' => $cardList,
				'query' => $query,
		);
		
		$data ['total_rows'] = $cardNum;
		
		$this->load->library ( 'pagination' );
		$url = site_url ( 'no3/alipaytransfercard/index' ) . '?' . http_build_query($query);
		$config ['base_url'] = $url;
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/alipaytransfer_card_view', $data );
	}
}
