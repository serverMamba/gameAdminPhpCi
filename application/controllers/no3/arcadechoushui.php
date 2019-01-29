<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Arcadechoushui extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'dwcxianmu_choushui' )) {
			redirect ( 'no3/index' );
		}
	}
	
	public function index()
	{
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "电玩城项目",
						"child" => "抽水监控" 
				),
				"header1" => array (
						"father" => "电玩城项目",
						"child" => "抽水监控" 
				),
				"header2" => array (
						"father" => "电玩城项目",
						"child" => "抽水监控" 
				),
		);
		$this->load->view ( 'no3/arcadechoushuiview', $data );
	}
}
