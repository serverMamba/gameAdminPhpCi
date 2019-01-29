<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Sysmaintenance extends MY_Controller {

	// redis的Key
	var $GAME_SWITCH = "gameSwitch";

	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_xtwh' )) {
			redirect ( 'no3/index' );
		}
	}

	public function index() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		$gameSwitchString = $redis->get($this->GAME_SWITCH);
		$gameSwitch = array();
		if (!$gameSwitchString)
		{
			// 没有找到则认为打开
			$gameSwitch['open'] = 1;
			$gameSwitch['notice'] = "";
		}
		else
		{
			$gameSwitch = json_decode($gameSwitchString, true);
		}

		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "系统维护" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "系统维护" 
				),
				"header2" => array (
						"father" => "运营管理",
						"child" => "系统维护 " 
				),
				'gameSwitch' => $gameSwitch,
		);

		log_message();
		
		$this->load->view ( 'no3/sysmaintenance_view', $data );
	}
	
	/**
	 * 修改配置
	 */
	public function modify()
	{
		$open = intval($this->input->post('open'));
		$notice = $this->input->post('notice');
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		$gameSwitch = array(
				'open' => $open,
				'notice' => $notice,
				);
		$redis->set($this->GAME_SWITCH, json_encode($gameSwitch));

		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/sysmaintenance' );
	}
}
