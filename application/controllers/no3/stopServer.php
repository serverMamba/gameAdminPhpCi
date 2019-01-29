<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class StopServer extends CI_Controller {
	var $cpass = 'axxxxxxxxxxx';
	var $salt = 'abc123';
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'stop_server' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Stop_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "紧急停服" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "紧急停服" 
				)
		);
		$this->load->view ( 'no3/stop_server_views', $data );
	}
	
	public function stop(){
		$game_id = $this->input->post('game_id',true);
		$pass = $this->input->post('pass',true);
		
		if($pass == '' || crypt ( $pass, $this->salt) != $this->cpass){
			$this->session->set_flashdata ( 'error', '密码错误' );
			redirect ( 'no3/stopServer' );
		}
		
		if($game_id == 'all'){
			$this->Stop_model->stopDDZ();
			$this->Stop_model->stopNIUNIU();
			$this->Stop_model->stopZJH();
			$this->Stop_model->stopSG();
		}else if($game_id == 1){
			$this->Stop_model->stopDDZ();
		}else if($game_id == 2){
			$this->Stop_model->stopZJH();
		}else if($game_id == 3){
			$this->Stop_model->stopNIUNIU();
		}else if($game_id == 24){
			$this->Stop_model->stopSG();
		}
		
		$this->session->set_flashdata ( 'success', '停服成功,请稍后' );
		redirect ( 'no3/stopServer' );
	}
	
	public function test(){
		echo  crypt ( $this->pass, $this->salt);
	}
	
	public function server(){
		//$this->Stop_model->stopDDZ();
		//$this->Stop_model->stopNIUNIU();
		//$this->Stop_model->stopZJH();
		echo 's';
	}
}
