<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Lhpchoushui extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_choushui' )) {
			redirect ( 'no3/index' );
		}
	}
	
	public function index()
	{
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "抽水监控" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "抽水监控" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "抽水监控" 
				),
		);
		$this->load->view ( 'no3/lhpchoushuiview', $data );
	}
}
