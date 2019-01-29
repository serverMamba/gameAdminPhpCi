<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpgameswitch extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_gameswitch' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/lhp_game_switch_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "游戏开关" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "游戏开关" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "游戏开关" 
				),
				'game_switch_list' => $this->lhp_game_switch_model->getGameSwitchList (),
		);
		
		
		$this->load->view ( 'no3/lhpgame_switch_view', $data );
	}

	/**
	 * AJax开关游戏
	 */
	public function switchGame() {
		$channelIdString = $this->input->post ( 'channelId', true );
		if ($channelIdString === "") {
			$this->show ( '0', '渠道号错误' );
		}

		$channelId = intval ($channelIdString);
		
		$dataString = $this->input->post ( 'data', true );
		if (! $dataString) 
		{
			$this->show ( '0', '修改数据没有传输' );
		}
		$data = json_decode($dataString);
		if (count($data) == 0)
		{
			$this->show ( '0', '数据格式不正确' );
		}
		$this->lhp_game_switch_model->updateGameSwitch ($channelId, $data);

		exit ( json_encode ( (object)array() ) );
	}

	private function show($status, $msg) {
		$return_ary = array (
				'status' => $status,
				'msg' => $msg 
		);
		exit ( json_encode ( $return_ary ) );
	}
	
	
	private function writeLog($txt) {
		$log_file = "/log/lhpgame_switch.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
}
