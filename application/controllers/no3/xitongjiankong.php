<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Xitongjiankong extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'ywgl_xitongjiankong' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_proxy_data() {
		$this->load->model ( 'xitongjiankong_model' );
		$res = $this->xitongjiankong_model->get_proxy_msg ();
		echo $res;
	}
	public function save_jsversion_data() {
		$this->load->model ( 'jsversionex_model' );
		
		$action = $this->input->get_post ( 'action' );
		$Version = $this->input->get_post ( 'Version' );
		$Tag = $this->input->get_post ( 'Tag' );
		
		$res = $this->jsversionex_model->save_jsversion_msg ( $Tag, $Version );
		echo json_encode ( $res );
	}
	public function update_proxy_data() {
		$this->load->model ( 'xitongjiankong_model' );
		$gamename = $this->input->get_post ( 'gamename' );
		$serverip = $this->input->get_post ( 'serverip' );
		
		$BindingAddress = $this->input->get_post ( 'BindingAddress' );
		$ConnectAddress = $this->input->get_post ( 'ConnectAddress' );
		
		$res = $this->proxyfordds_model->update_proxy_msg ( $gamename, $serverip, $BindingAddress, $ConnectAddress );
		echo json_encode ( $res );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "系统监控" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "系统监控" 
				),
				"header2" => array (
						"father" => "系统监控",
						"child" => "系统监控" 
				)
		);
		$this->load->view ( 'no3/xitongjiankongview', $data );
	}
}
