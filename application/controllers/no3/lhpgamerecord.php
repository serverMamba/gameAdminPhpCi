<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Lhpgamerecord extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_gamerecord' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_record_data() {
		$this->load->model ( 'lhpgamerecord_model' );
		$mystarttime = $this->input->get_post ( 'mystarttime' );
		$myendtime = $this->input->get_post ( 'myendtime' );
		$userid = $this->input->get_post ( 'userid' );
		$machineid = $this->input->get_post ( 'machineid' );
		$beginindex = $this->input->get_post ( 'beginindex' );
		
		$res = $this->lhpgamerecord_model->get_exchange_his ( $userid, $machineid, $mystarttime, $myendtime, $beginindex );
		
		echo json_encode ( $res );
	}

	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $this->config->item ( 'gamecode' ),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "连环炮游戏记录" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "连环炮游戏记录" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "连环炮游戏记录 " 
				),
		);
		$this->load->view ( 'no3/lhpgamerecord_view', $data );
	}
}
