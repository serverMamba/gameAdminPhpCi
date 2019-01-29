<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransferswitch extends MY_Controller {

	var $INVALID_ALIPAY_ACCOUNT = "invalidAlipayAccount";
	var $ALIPAY_TRANSFER_SWITCH_TIME = "transferSwitchTime";

	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_alipaytransfer' )) {
			redirect ( 'no3/index' );
		}
	}

	public function index() {
	    // test
        log_message('error', ', ok11');
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
        // test
        log_message('error', ', ok12');
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
        // test
        log_message('error', ', ok13');
		
		$alipaySwitchTimeString = $redis->get($this->ALIPAY_TRANSFER_SWITCH_TIME);
		
		// 开关时间的第一个数字是开启时间，第二个数字是关闭时间
		$switchTime = array();
		if ($alipaySwitchTimeString)
		{
			$switchTime = explode(",", $alipaySwitchTimeString);
		}
		
		if (count($switchTime) != 2)
		{
			$switchTime = array("", "");
		}


		$alipayAccounts = $this->getAlipayAccounts();
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "转账支付宝管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "转账支付宝管理" 
				),
				"header2" => array (
						"father" => "运营管理",
						"child" => "转账支付宝管理 " 
				),
				'alipayAccounts' => $alipayAccounts,
				'openTime' => $switchTime[0],
				'closeTime' => $switchTime[1],
		);
		
		
		$this->load->view ( 'no3/alipaytransferswitch_view', $data );
	}
	
	private function getAlipayAccounts()
	{
		$allAccounts = $this->config->item('alipay_transfer');
		
		// 获取到所有被关掉的账号
		$redisConfig = $this->config->item('redis');
		$redis = new Redis();
		$redis->connect($redisConfig['host'], $redisConfig['port']);
		
		$invalidAccounts = $redis->sMembers($this->INVALID_ALIPAY_ACCOUNT);
		
		for($i = 0; $i < count($allAccounts); $i++)
		{
			if (in_array($allAccounts[$i]['account'], $invalidAccounts))
			{
				$allAccounts[$i]['invalid'] = true;
			}
			else
			{
				$allAccounts[$i]['invalid'] = false;
			}
		}
		
		return $allAccounts;
	}
	
	/**
	 * 修改开关时间
	 */
	public function modify()
	{
		$openTime = $this->input->post('openTime');
		$closeTime = $this->input->post('closeTime');
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		if ($openTime !== "" && $closeTime !== "")
		{
			$openTime = intval($openTime);
			$closeTime = intval($closeTime);
			if ($openTime > 24 || $openTime < 0)
			{
				$this->session->set_flashdata ( 'error', '开启时间填写不正确' );
				redirect ( 'no3/alipaytransferswitch' );
			}
			
			if ($closeTime > 24 || $closeTime < 0)
			{
				$this->session->set_flashdata ( 'error', '关闭时间填写不正确' );
				redirect ( 'no3/alipaytransferswitch' );
			}
			
			$switchTime = array($openTime, $closeTime);
			$redis->set($this->ALIPAY_TRANSFER_SWITCH_TIME, implode(",", $switchTime));
		}
		
		$this->session->set_flashdata ( 'success', '开关时间修改成功' );
		redirect ( 'no3/alipaytransferswitch' );
	}
	
	/**
	 * 手动添加invalid alipayAccount
	 */
	public function addInvalid()
	{
		$alipayAccount = $this->input->get('alipayAccount');
		log_message('error', "Start to CLOSE alipay transfer account: " . $alipayAccount);

		$alipayConfigs = $this->config->item('alipay_transfer');
		$found = false;
		foreach ($alipayConfigs as $v)
		{
			if ($v['account'] == $alipayAccount)
			{
				$found = true;
				break;
			}
		}
		
		if (!$found)
		{
			$this->session->set_flashdata ( 'error', '账号不存在' );
			redirect ( 'no3/alipaytransferswitch' );
		}

		$redisConfig = $this->config->item('redis');
		$redis = new Redis();
		$redis->connect($redisConfig['host'], $redisConfig['port']);
		
		if ($redis->sIsMember($this->INVALID_ALIPAY_ACCOUNT, $alipayAccount) == 1)
		{
			$this->session->set_flashdata ( 'error', '该账号已在不可用列表中' );
			redirect ( 'no3/alipaytransferswitch' );
		}

		log_message('error', "Alipay transfer account CLOSED: " . $alipayAccount);
		$redis->sAdd($this->INVALID_ALIPAY_ACCOUNT, $alipayAccount);
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipaytransferswitch' );
	}

	/**
	 * 手动移除某个不可以用的alipayAccount
	 */
	public function removeInvalid()
	{
		$alipayAccount = $this->input->get('alipayAccount');
		log_message('error', "Start to OPEN alipay transfer account: " . $alipayAccount);

		$redisConfig = $this->config->item('redis');
		$redis = new Redis();
		$redis->connect($redisConfig['host'], $redisConfig['port']);
		
		$res = $redis->sRem($this->INVALID_ALIPAY_ACCOUNT, $alipayAccount);
		
		if ($res == 1)
		{
			log_message('error', "Alipay transfer account OPENED: " . $alipayAccount);
			$this->session->set_flashdata ( 'success', '修改成功' );
			redirect ( 'no3/alipaytransferswitch' );
		}
		else
		{
			$this->session->set_flashdata ( 'error', '不在列表中' );
			redirect ( 'no3/alipaytransferswitch' );
		}
	}
 	
}
