<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class AlipayBlackList extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_wjddcx' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Black_alipay_model' );
	}
	public function index() {
		$query ['alipay_account'] = $this->input->get ( 'alipay_account', true ) ? $this->input->get ( 'alipay_account', true ) : '';
		$query ['alipay_real_name'] = $this->input->get ( 'alipay_real_name', true ) ? $this->input->get ( 'alipay_real_name', true ) : '';
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付宝黑名单" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付宝黑名单" 
				),
				"header2" => array (
						"father" => "玩家订单查询",
						"child" => "支付宝黑名单 " 
				),
				'alipay_list' => $this->Black_alipay_model->getBlackAlipayList ( $query, $start, $per ),
				'query' => $query 
		);
		
		$data ['total_rows'] = $this->Black_alipay_model->getBlackAlipayNum ( $query );
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/alipayBlackList/index' ) . '?alipay_account=' . $query ['alipay_account'].'&alipay_real_name='.$query ['alipay_real_name'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/black_alipay_list_views', $data );
	}
	public function toAddBlack() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付宝黑名单" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付宝黑名单" 
				),
				"header2" => array (
						"father" => "玩家订单查询",
						"child" => "支付宝黑名单 " 
				) 
		);
		
		$this->load->view ( 'no3/black_alipay_info_views', $data );
	}
	public function addBlack() {
		$data ['alipay_account'] = $this->input->post ( 'alipay_account', true );
		if (! $data ['alipay_account']) {
			$this->session->set_flashdata ( 'error', '请填写支付宝帐号' );
			redirect ( 'no3/alipayBlackList/toAddBlack' );
		}
		
		$data ['alipay_real_name'] = $this->input->post ( 'alipay_real_name', true );
		if (! $data ['alipay_real_name']) {
			$this->session->set_flashdata ( 'error', '请填写支付宝实名' );
			redirect ( 'no3/alipayBlackList/toAddBlack' );
		}
		
		$data ['is_lock'] = 1;
		$data ['discribe'] = $this->input->post ( 'discribe', true );
		$data ['add_time'] = time ();
		
		if ($this->Black_alipay_model->insertBlack ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/alipayBlackList' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/alipayBlackList' );
		}
	}
	public function delBlack() {
		$id = intval ( $this->input->get ( 'id', true ) );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/alipayBlackList' );
		}
		
		if ($this->Black_alipay_model->deleteBlack ( $id )) {
			$this->session->set_flashdata ( 'success', '删除成功' );
			redirect ( 'no3/alipayBlackList' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/alipayBlackList' );
		}
	}
}
