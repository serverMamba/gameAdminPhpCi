<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Brecharge extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kefu_recharge' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Brecharge_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "人工充值" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "人工充值" 
				) 
		);
		$this->load->view ( 'no3/back_recharge_views', $data );
	}
	public function recharge() {
		$admin_id = $_SESSION ['smc_id'];
		$user_id = $this->input->post ( 'user_id', true ) ? intval ( $this->input->post ( 'user_id', true ) ) : 0;
		$money = $this->input->post ( 'money', true ) ? intval ( $this->input->post ( 'money', true ) ) : 0;
		$third_order_sn = $this->input->post ( 'third_order_sn', true ) ? $this->input->post ( 'third_order_sn', true ) : '';
		
		if (! $user_id || ! $money) {
			$this->session->set_flashdata ( 'error', '系统错误!' );
			redirect ( 'no3/brecharge/index' );
		}
		
		if ($money <= 0) {
			$this->session->set_flashdata ( 'error', '充值金额必须大于0!' );
			redirect ( 'no3/brecharge/index' );
		}
		
		$user = $this->User_model->getUserInfo ( $user_id );
		if (empty ( $user )) {
			$this->session->set_flashdata ( 'error', '该用户不存在!' );
			redirect ( 'no3/brecharge/index' );
		}
		
		if(!$this->Brecharge_model->getOrderByThird($third_order_sn)){
			$this->session->set_flashdata ( 'error', '订单号存在!' );
			redirect ( 'no3/brecharge/index' );
		}
		
		if ($this->Brecharge_model->addMemberChips ( $user_id, $money * 100, $user, $admin_id ,$third_order_sn)) {
			$this->session->set_flashdata ( 'success', '充值成功!' );
			redirect ( 'no3/brecharge/index' );
		} else {
			$this->session->set_flashdata ( 'error', '充值失败!' );
			redirect ( 'no3/brecharge/index' );
		}
	}
}