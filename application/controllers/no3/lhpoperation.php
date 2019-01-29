<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Lhpoperation extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_operation_summary' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}

	function characet($data) {
		if (! empty ( $data )) {
			$fileType = mb_detect_encoding ( $data, array (
					'UTF-8',
					'GBK',
					'LATIN1',
					'BIG5' 
			) );
			if ($fileType != 'UTF-8') {
				$data = mb_convert_encoding ( $data, 'utf-8', $fileType );
			}
		}
		return $data;
	}

	public function get_reportgame_data() {
		$this->load->model ( 'lhpoperation_model' );
		$starttime = $this->input->get_post ( 'starttime' );
		$endtime = $this->input->get_post ( 'endtime' );
		
		$res = $this->lhpoperation_model->get_game_statistic( $starttime, $endtime );
		$saveres = json_encode ( $res );
		echo $saveres;
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "运营总表" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "运营总表" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "运营总表" 
				) 
		);
		$this->load->view ( 'no3/lhpoperation_view', $data );
	}
}
