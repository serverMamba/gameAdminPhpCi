<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Reportonline extends CI_Controller {
	public function __construct() {
		parent::__construct ( );
	}
	public function get_online_data() {
		$this->load->model ( 'online_mid_model' );
		$gameid = $this->input->get_post ( 'gameid' );
		$res = $this->online_mid_model->get_onlinemsg ( $gameid );
		echo json_encode ( $res );
	}
	public function get_online_dataip() {
		$this->load->model ( 'online_mid_model' );
		$gameid = $this->input->get_post ( 'gameid' );
		$ip = $this->input->get_post ( 'ip' );
		$res = $this->online_mid_model->get_onlinemsgip ( $gameid, $ip );
		echo json_encode ( $res );
	}
	public function index() {
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yybb_ddzxrs' )) {
			redirect ( 'no3/index' );
		}
		$gamecodehuang = $this->config->item ( 'gamelist' );	
		$initdata = 0;
		$initdatastr = "全部";
		
		$data = array (
				"initdatastr" => $initdatastr,
				"initdata" => $initdata,
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $gamecodehuang,
				"choose" => array (
						"father" => "运营报表",
						"child" => "当前在线人数" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "当前在线人数" 
				),
				"header2" => array (
						"father" => "当前在线人数",
						"child" => "在线人数实时统计 " 
				)
		);
		$this->load->view ( 'no3/reportonlineview', $data );
	}
}
