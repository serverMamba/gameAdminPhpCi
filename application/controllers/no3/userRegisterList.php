<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class UserRegisterList extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'register_list' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/User_model' );
	}
	public function index() {
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date('Y-m-d' ,strtotime('-1 day'));
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date('Y-m-d');
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "用户注册列表" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "用户注册列表" 
				),
				'user_list' => $this->User_model->getUserRegisterList($query ['start_time'], $query ['end_time'], $start, $per),
				'query' => $query ,
				'channel_list' => $this->config->item('channellist')
		);
		
		$data ['total_rows'] = $this->User_model->getUserRegisterNum ($query ['start_time'], $query ['end_time'] );
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/userRegisterList/index' ) . '?start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );

		$this->load->view ( 'no3/user_register_list_views', $data );
	}
}