<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Packetmodel extends CI_Controller {
	public function __construct() {
		parent::__construct ( );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_mokuaishenji' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_proxy_data() {

		$this->load->model ( 'packetmodel_model' );
		$res = $this->packetmodel_model->get_proxy_msg ();
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
		$this->load->model ( 'packetmodel_model' );
		$upgradetag = $this->input->get_post ( 'upgradetag' );
		$modelname = $this->input->get_post ( 'modelname' );
		
		$version = $this->input->get_post ( 'version' );
		$overversion = $this->input->get_post ( 'overversion' );
		
		$res = $this->packetmodel_model->update_proxy_msg ( $upgradetag, $modelname, $version, $overversion );
		echo json_encode ( $res );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "模块升级服务器管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "模块升级服务器管理" 
				),
				"header2" => array (
						"father" => "模块升级服务器管理",
						"child" => "模块升级服务器管理" 
				)
		);
		$this->load->view ( 'no3/packetmodelview', $data );
	}
}
