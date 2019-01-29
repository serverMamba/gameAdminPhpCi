<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class PayConfig extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'pay_config' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Payconfig_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				),
				'config_list' => $this->Payconfig_model->getList () 
		);
		$this->load->view ( 'no3/pay_config_list_views', $data );
	}
	public function toAdd() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				) 
		);
		$this->load->view ( 'no3/pay_config_info_views', $data );
	}
	public function toEdit() {
		$id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/payConfig' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付账号" 
				),
				'pay_config' => $this->Payconfig_model->get ( $id ) 
		);
		if (empty ( $data ['pay_config'] )) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/payConfig' );
		}
		$this->load->view ( 'no3/pay_config_info_views', $data );
	}
	public function add() {
		$data ['agent_id'] = trim ( $this->input->post ( 'agent_id', true ) );
		$data ['pay_key'] = trim ( $this->input->post ( 'pay_key', true ) );
		$data ['pay_secrect'] = trim ( $this->input->post ( 'pay_secrect', true ) );
		$data ['status'] = $this->input->post ( 'status', true );
		
		if (! $data ['agent_id'] || ! $data ['pay_key'] || ! $data ['pay_secrect']) {
			$this->session->set_flashdata ( 'error', '不能为空' );
			redirect ( 'no3/payConfig/toAdd' );
		}
		
		if ($this->Payconfig_model->insert ( $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->del ( 'pay_account' );
			$redis->close();
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/payConfig' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/payConfig' );
		}
	}
	public function edit() {
		$id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/payConfig' );
		}
		
		$data ['agent_id'] = trim ( $this->input->post ( 'agent_id', true ) );
		$data ['pay_key'] = trim ( $this->input->post ( 'pay_key', true ) );
		$data ['pay_secrect'] = trim ( $this->input->post ( 'pay_secrect', true ) );
		$data ['status'] = $this->input->post ( 'status', true );
		
		if (! $data ['agent_id'] || ! $data ['pay_key'] || ! $data ['pay_secrect']) {
			$this->session->set_flashdata ( 'error', '不能为空' );
			redirect ( 'no3/payConfig/toEdit/' . $id );
		}
		
		if ($this->Payconfig_model->update ( $id, $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->del ( 'pay_account' );
			$redis->close();
			$this->session->set_flashdata ( 'success', '修改成功' );
			redirect ( 'no3/payConfig' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/payConfig' );
		}
	}
}