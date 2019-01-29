<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Castsys extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_xtgg' )) {
			redirect ( 'no3/index' );
		}
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				"header2" => array (
						"father" => "系统公告",
						"child" => "实时修改在线系统公告信息 " 
				) 
		);
		$this->load->view ( 'no3/sys_notice_list_views', $data );
	}
	
	
}
