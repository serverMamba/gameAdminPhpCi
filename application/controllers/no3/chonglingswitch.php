<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class chonglingswitch extends MY_Controller {

	// redis的Key
	private $CLOSE_TRANSFER_PAY_KEY = "closeTransferPay";
	private $CLOSE_TRANSFER_TAKE_KEY = "closeTransferTake";

	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_chonglingswitch' )) {
			redirect ( 'no3/index' );
		}
	}

	public function index() {
		//$this->writeLog("---------------------------");
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		$paySwitchString = $redis->get($this->CLOSE_TRANSFER_PAY_KEY);
		//$this->writeLog("paySwitchString=$paySwitchString");
		$paySwitch = array();
		if (!$paySwitchString)
		{
			// 没有找到则认为打开
			$paySwitch['close'] = 0;
			$paySwitch['notice'] = "";
		}
		else
		{
			//$paySwitch = json_decode($paySwitchString, true);
			$paySwitch['close'] = intval($paySwitchString);
			$paySwitch['notice'] = "";
		}
		
		$takeSwitchString = $redis->get($this->CLOSE_TRANSFER_TAKE_KEY);
		//$this->writeLog("takeSwitchString=$takeSwitchString");
		$takeSwitch = array();
		if (!$takeSwitchString)
		{
			// 没有找到则认为打开
			$takeSwitch['close'] = 0;
			$takeSwitch['notice'] = "";
		}
		else
		{
			//$takeSwitch = json_decode($takeSwitchString, true);
			$takeSwitch['close'] = intval($takeSwitchString);
			$takeSwitch['notice'] = "";
		}

		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "充领开关" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "充领开关" 
				),
				"header2" => array (
						"father" => "运营管理",
						"child" => "充领开关 " 
				),
				'paySwitch' => $paySwitch,
				'takeSwitch' => $takeSwitch,
		);
		
		
		$this->load->view ( 'no3/chonglingswitch_view', $data );
	}
	
	/**
	 * 修改“充”配置
	 */
	public function modifyPay()
	{
		$close = intval($this->input->post('close'));
		$notice = $this->input->post('notice');
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		$paySwitch = array(
				'close' => $close,
				'notice' => $notice,
				);
		//$redis->set($this->CLOSE_TRANSFER_PAY_KEY, json_encode($paySwitch));
		$redis->set($this->CLOSE_TRANSFER_PAY_KEY, $close);
		//$this->writeLog("key=".$this->CLOSE_TRANSFER_PAY_KEY.",close=$close");
		$this->session->set_flashdata ( 'success', '修改“充”成功' );
		redirect ( 'no3/chonglingswitch' );
	}
	/**
	 * 修改“领”配置
	 */
	public function modifyTake()
	{
		$close = intval($this->input->post('close'));
		$notice = $this->input->post('notice');
	
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
	
		$takeSwitch = array(
				'close' => $close,
				'notice' => $notice,
		);
		//$redis->set($this->CLOSE_TRANSFER_TAKE_KEY, json_encode($takeSwitch));
		$redis->set($this->CLOSE_TRANSFER_TAKE_KEY, $close);
		//$this->writeLog("key=".$this->CLOSE_TRANSFER_TAKE_KEY.",close=$close");
		$this->session->set_flashdata ( 'success', '修改“领”成功' );
		redirect ( 'no3/chonglingswitch' );
	}
	
	public function writeLog($txt) {
		if(!$txt){return;}
		$filename = "chonglingswitch";
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
