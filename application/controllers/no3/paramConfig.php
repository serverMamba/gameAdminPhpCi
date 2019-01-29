<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ParamConfig extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'param_config' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Param_config_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "参数设置" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "参数设置" 
				),
				'config_list' => $this->Param_config_model->getParamConfig () 
		);
		$this->load->view ( 'no3/param_config_views', $data );
	}
	public function save() {
		foreach ( $_POST as $k => $v ) {
			$data = array (
					'config_value' => $v 
			);
			$this->Param_config_model->update ( $k, $data );
		}
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->del ( 'param_config' );
		$redis->close();
		$this->session->set_flashdata ( 'success', '修改成功 ' );
		redirect ( 'no3/paramConfig' );
	}
}
