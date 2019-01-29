<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Stop extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'amdin_list_manage' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Stop_model' );
	}
	
	public function server(){
		$this->Stop_model->stopDDZ();
		//$this->Stop_model->stopNIUNIU();
		//$this->Stop_model->stopZJH();
		echo 's';
	}
}