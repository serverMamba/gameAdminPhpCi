<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Wanshunfish2 extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yybb_wanshunfish2' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_exchange_data() {
		$this->load->model ( 'wanshunfish2_model' );
		$action = $this->input->get_post ( 'action', true );
		$mystarttime = $this->input->get_post ( 'mystarttime', true );
		$myendtime = $this->input->get_post ( 'myendtime', true );
		$userid = intval ( $this->input->get_post ( 'userid' ) );
		$beginindex = $this->input->get_post ( 'beginindex', true );
		$res = $this->wanshunfish2_model->get_exchange_his ( $userid, $mystarttime, $myendtime, $beginindex );
		echo json_encode ( $res );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $this->config->item ( 'gamecode' ),
				"choose" => array (
						"father" => "捕鱼项目",
						"child" => "捕鱼使用技能记录" 
				),
				"header1" => array (
						"father" => "捕鱼项目",
						"child" => "捕鱼使用技能记录" 
				),
				"header2" => array (
						"father" => "捕鱼使用技能记录",
						"child" => "捕鱼使用技能记录历史统计 " 
				) 
		);
		$this->load->view ( 'no3/wanshunfish2_view', $data );
	}
}
