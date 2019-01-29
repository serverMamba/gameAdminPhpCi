<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class CashTest extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isPriv ( 'cash_order' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Order_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
		$this->load->model ( 'no3/Chat_model' );
	}
	public function index() {
		$v0 = intval ( $this->Order_model->calMoney ( 5000000 / 100 ) ) * 100;
		$v1 = intval ( $this->Order_model->calMoney ( 50000 / 100 ) ) * 100;
		$res = "v0=$v0,v1=$v1";
		exit($res);
	}

}
