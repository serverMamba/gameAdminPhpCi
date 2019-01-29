<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipayformal extends MY_Controller {
	
	// 一些redis的Key
	var $ALIPAY_AMOUNT_KEY = "alipayAmount";
	var $FORMAL_ALIPAY_PLATFORM_TYPE = "alipayPlatformType";
	var $FORMAL_ALIPAY_SWITCH_TIME = "alipaySwitchTime";
	var $FORMAL_ALIPAY_CONCURRENT_ORDER_CONTROL = "alipayOrderControl";
	private $CLOSE_PAY_KEY = "closePay";
	private $WX_PAY_PLATFORMS = "wxpaypf";
	private $ALI_PAY_PLATFORMS_RANGE = "alipaypf_range";
	private $WX_PAY_PLATFORMS_RANGE = "wxpaypf_range";
	private $QQ_PAY_PLATFORMS_RANGE = "qqpaypf_range";
	private $JD_PAY_PLATFORMS_RANGE = "jdpaypf_range";
	private $YL_PAY_PLATFORMS_RANGE = "ylpaypf_range";
	var $formalAlipayPayPlatforms = array ();
	var $qqPayPlatforms = array ();
	var $jdPayPlatforms = array ();
	var $ylPayPlatforms = array ();
	var $wxPayPlatforms = array ();
	var $alipayPlatforms = array ();
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_formalalipay' )) {
			redirect ( 'no3/index' );
		}
		$this->qqPayPlatforms = $this->config->item ( 'qq_pay' );
		$this->jdPayPlatforms = $this->config->item ( 'jd_pay' );
		$this->ylPayPlatforms = $this->config->item ( 'yl_pay' );
		$this->wxPayPlatforms = $this->config->item ( 'wx_pay' );
		$this->formalAlipayPayPlatforms = $this->config->item ( 'official_alipay_pay' );
		$this->alipayPlatforms = $this->config->item ( 'alipay_pay' );
	}
	public function index() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		$alipayAmount = intval ( $redis->get ( $this->ALIPAY_AMOUNT_KEY ) );
		$selectedPlatformType = intval ( $redis->get ( $this->FORMAL_ALIPAY_PLATFORM_TYPE ) );
		$alipaySwitchTimeString = $redis->get ( $this->FORMAL_ALIPAY_SWITCH_TIME );
		
		// 开关时间的第一个数字是开启时间，第二个数字是关闭时间
		$switchTime = array ();
		if ($alipaySwitchTimeString) {
			$switchTime = explode ( ",", $alipaySwitchTimeString );
		}
		
		if (count ( $switchTime ) != 2) {
			$switchTime = array (
					"",
					"" 
			);
		}
		
		// 支付宝控制
		$alipayOrderControlString = $redis->get ( $this->FORMAL_ALIPAY_CONCURRENT_ORDER_CONTROL );
		$alipayOrderControl = array ();
		if ($alipayOrderControlString) {
			$alipayOrderControl = explode ( ",", $alipayOrderControlString );
		}
		
		if (count ( $alipayOrderControl ) != 2) {
			// 默认值
			$alipayOrderControl = array (
					1,
					1 
			);
		}
		
		// 开关
		$closePay = intval ( $redis->get ( $this->CLOSE_PAY_KEY ) );
		// 微信
		$wxPayPlatformsString = $redis->get ( $this->WX_PAY_PLATFORMS );
		$wxPayOpenPlatforms = array ();
		if ($wxPayPlatformsString) {
			$wxPayOpenPlatforms = json_decode ( $wxPayPlatformsString );
		}
		// $this->writeLog("index:".$this->QQ_PAY_PLATFORMS_RANGE."=".$qqPayPlatformsString);
		// 支付宝开关
		// platform => open, min, max
		$alipayPlatformsRangeString = $redis->get ( $this->ALI_PAY_PLATFORMS_RANGE );
		$alipayPlatformsRange = array ();
		if ($alipayPlatformsRangeString) {
			$alipayPlatformsRange = json_decode ( $alipayPlatformsRangeString, true );
		}
		// 微信开关
		// platform => open, min, max
		$wxPlatformsRangeString = $redis->get ( $this->WX_PAY_PLATFORMS_RANGE );
		$wxPlatformsRange = array ();
		if ($wxPlatformsRangeString) {
			$wxPlatformsRange = json_decode ( $wxPlatformsRangeString, true );
		}
		// QQ
		// platform => open, min, max
		$qqPlatformsRangeString = $redis->get ( $this->QQ_PAY_PLATFORMS_RANGE );
		$qqPlatformsRange = array ();
		if ($qqPlatformsRangeString) {
			$qqPlatformsRange = json_decode ( $qqPlatformsRangeString, true );
		}
		// JD
		// platform => open, min, max
		$jdPlatformsRangeString = $redis->get ( $this->JD_PAY_PLATFORMS_RANGE );
		$jdPlatformsRange = array ();
		if ($jdPlatformsRangeString) {
			$jdPlatformsRange = json_decode ( $jdPlatformsRangeString, true );
		}
		// YL
		// platform => open, min, max
		$ylPlatformsRangeString = $redis->get ( $this->YL_PAY_PLATFORMS_RANGE );
		$ylPlatformsRange = array ();
		if ($ylPlatformsRangeString) {
			$ylPlatformsRange = json_decode ( $ylPlatformsRangeString, true );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "支付管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "支付管理" 
				),
				"header2" => array (
						"father" => "运营管理",
						"child" => "支付管理 " 
				),
				'closePay' => $closePay,
				'brecharge' => $redis->get ( 'brecharge' ),
				'formalAlipays' => $this->formalAlipayPayPlatforms,
				'alipayAmount' => $alipayAmount,
				'openTime' => $switchTime [0],
				'closeTime' => $switchTime [1],
				'controlDuration' => $alipayOrderControl [0],
				'controlOrderNum' => $alipayOrderControl [1],
				'selectedPlatformType' => $selectedPlatformType,
				'wxPays' => $this->wxPayPlatforms,
				'wxPayOpen' => $wxPayOpenPlatforms,
				'qqPays' => $this->qqPayPlatforms,
				'jdPays' => $this->jdPayPlatforms,
				'ylPays' => $this->ylPayPlatforms,
				'aliPays' => $this->alipayPlatforms,
				// 'aliPayOpen' => $aliPayOpenPlatforms,
				'alipayRange' => $alipayPlatformsRange,
				'wxpayRange' => $wxPlatformsRange,
				'qqpayRange' => $qqPlatformsRange, 
				'jdpayRange' => $jdPlatformsRange,
				'ylpayRange' => $ylPlatformsRange,
		);
		$redis->close ();
		$this->load->view ( 'no3/alipayformal_view', $data );
	}
	
	/**
	 * 修改配置
	 */
	public function modify() {
		$alipayAmount = intval ( $this->input->post ( 'alipayAmount' ) );
		$selectedPlatformType = intval ( $this->input->post ( 'formalAlipayPlatformType' ) );
		$openTime = $this->input->post ( 'openTime' );
		$closeTime = $this->input->post ( 'closeTime' );
		$controlDuration = $this->input->post ( 'controlDuration' );
		$controlOrderNum = $this->input->post ( 'controlOrderNum' );
		
		if ($alipayAmount < 0) {
			$this->session->set_flashdata ( 'error', '金额不正确' );
			redirect ( 'no3/alipayformal' );
		}
		
		if ($selectedPlatformType != 0 && ! array_key_exists ( $selectedPlatformType, $this->formalAlipayPayPlatforms )) {
			$this->session->set_flashdata ( 'error', '支付宝平台不正确' );
			redirect ( 'no3/alipayformal' );
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		if ($openTime !== "" && $closeTime !== "") {
			$openTime = intval ( $openTime );
			$closeTime = intval ( $closeTime );
			if ($openTime > 24 || $openTime < 0) {
				$this->session->set_flashdata ( 'error', '开启时间填写不正确' );
				redirect ( 'no3/alipayformal' );
			}
			
			if ($closeTime > 24 || $closeTime < 0) {
				$this->session->set_flashdata ( 'error', '关闭时间填写不正确' );
				redirect ( 'no3/alipayformal' );
			}
			
			$switchTime = array (
					$openTime,
					$closeTime 
			);
			$redis->set ( $this->FORMAL_ALIPAY_SWITCH_TIME, implode ( ",", $switchTime ) );
		}
		
		if ($controlDuration !== "" && $controlOrderNum !== "") {
			$controlDuration = intval ( $controlDuration );
			$controlOrderNum = intval ( $controlOrderNum );
			if ($controlDuration <= 0) {
				$this->session->set_flashdata ( 'error', '控制时间填写不正确' );
				redirect ( 'no3/alipayformal' );
			}
			
			if ($controlOrderNum <= 0) {
				$this->session->set_flashdata ( 'error', '控制单数填写不正确' );
				redirect ( 'no3/alipayformal' );
			}
			
			$alipayControl = array (
					$controlDuration,
					$controlOrderNum 
			);
			$redis->set ( $this->FORMAL_ALIPAY_CONCURRENT_ORDER_CONTROL, implode ( ",", $alipayControl ) );
		}
		
		$redis->set ( $this->ALIPAY_AMOUNT_KEY, $alipayAmount );
		$redis->set ( $this->FORMAL_ALIPAY_PLATFORM_TYPE, $selectedPlatformType );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	/**
	 * 关闭支付
	 */
	public function closePay() {
		$closePay = intval ( $this->input->post ( 'closePay' ) );
		$brecharge = intval ( $this->input->post ( 'brecharge' ) );
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		$redis->set ( $this->CLOSE_PAY_KEY, $closePay );
		$redis->set ( 'brecharge', $brecharge );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	/**
	 * 支付宝支付
	 */
	public function alipayPay() {
		$alipayPayPlatforms = $this->input->post ( 'alipayPayPlatforms' );
		
		if (! $alipayPayPlatforms) {
			$alipayPayPlatforms = array ();
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		// 遍历所有的支付宝支付方式，获取最大值最小值
		$alipayPlatformsRange = array ();
		foreach ( $this->alipayPlatforms as $k => $v ) {
			$min = intval ( $_POST ['min' . $k] );
			$max = intval ( $_POST ['max' . $k] );
			$closeStart = intval ( $_POST ['closeStart' . $k] );
			$closeEnd = intval ( $_POST ['closeEnd' . $k] );
			if (in_array ( $k, $alipayPayPlatforms )) {
				$open = 1;
			} else {
				$open = 0;
			}
			
			$alipayPlatformsRange [$k] = array (
					"open" => $open,
					"min" => $min,
					"max" => $max,
					"closeStart" => $closeStart,
					"closeEnd" => $closeEnd
			);
		}
		
		$redis->set ( $this->ALI_PAY_PLATFORMS_RANGE, json_encode ( $alipayPlatformsRange ) );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	/**
	 * 微信支付
	 */
	public function wxPay() {
		$wxPayPlatforms = $this->input->post ( 'wxPayPlatforms' );
		
		if (! $wxPayPlatforms) {
			$wxPayPlatforms = array ();
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		// 遍历所有的微信第三方支付方式，获取最大值最小值
		$wxpayPlatformsRange = array ();
		foreach ( $this->wxPayPlatforms as $k => $v ) {
			$min = intval ( $_POST ['min' . $k] );
			$max = intval ( $_POST ['max' . $k] );
			if (in_array ( $k, $wxPayPlatforms )) {
				$open = 1;
			} else {
				$open = 0;
			}
			
			$wxpayPlatformsRange [$k] = array (
					"open" => $open,
					"min" => $min,
					"max" => $max 
			);
		}
		
		$redis->set ( $this->WX_PAY_PLATFORMS_RANGE, json_encode ( $wxpayPlatformsRange ) );
		// $redis->set ( $this->WX_PAY_PLATFORMS, json_encode ( $wxPayPlatforms
		// ) );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	/**
	 * QQ支付
	 */
	public function qqPay() {
		$this->writeLog ( "post_qqPay:" . $_POST );
		$qqPayPlatforms = $this->input->post ( 'qqPayPlatforms' );
		if (! $qqPayPlatforms) {
			$qqPayPlatforms = array ();
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		// 遍历所有的QQ支付方式，获取最大值最小值
		$qqPlatformsRange = array ();
		foreach ( $this->qqPayPlatforms as $k => $v ) {
			$min = intval ( $_POST ['min' . $k] );
			$max = intval ( $_POST ['max' . $k] );
			$this->writeLog ( "$k:$min,$max" );
			if (in_array ( $k, $qqPayPlatforms )) {
				$open = 1;
			} else {
				$open = 0;
			}
			
			$qqPlatformsRange [$k] = array (
					"open" => $open,
					"min" => $min,
					"max" => $max 
			);
		}
		$this->writeLog ( $this->QQ_PAY_PLATFORMS_RANGE . ">>" . json_encode ( $qqPlatformsRange ) );
		$redis->set ( $this->QQ_PAY_PLATFORMS_RANGE, json_encode ( $qqPlatformsRange ) );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	/**
	 * JD支付
	 */
	public function jdPay() {
		$this->writeLog ( "post_jdPay:" . $_POST );
		$jdPayPlatforms = $this->input->post ( 'jdPayPlatforms' );
		if (! $jdPayPlatforms) {
			$jdPayPlatforms = array ();
		}
	
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
	
		// 遍历所有的QQ支付方式，获取最大值最小值
		$jdPlatformsRange = array ();
		foreach ( $this->jdPayPlatforms as $k => $v ) {
			$min = intval ( $_POST ['min' . $k] );
			$max = intval ( $_POST ['max' . $k] );
			$this->writeLog ( "$k:$min,$max" );
			if (in_array ( $k, $jdPayPlatforms )) {
				$open = 1;
			} else {
				$open = 0;
			}
				
			$jdPlatformsRange [$k] = array (
					"open" => $open,
					"min" => $min,
					"max" => $max
			);
		}
		$this->writeLog ( $this->JD_PAY_PLATFORMS_RANGE . ">>" . json_encode ( $jdPlatformsRange ) );
		$redis->set ( $this->JD_PAY_PLATFORMS_RANGE, json_encode ( $jdPlatformsRange ) );
	
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}

	/**
	 * YL支付
	 */
	public function ylPay() {
		$this->writeLog ( "post_ylPay:" . $_POST );
		$ylPayPlatforms = $this->input->post ( 'ylPayPlatforms' );
		if (! $ylPayPlatforms) {
			$ylPayPlatforms = array ();
		}
	
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
	
		// 遍历所有的QQ支付方式，获取最大值最小值
		$ylPlatformsRange = array ();
		foreach ( $this->ylPayPlatforms as $k => $v ) {
			$min = intval ( $_POST ['min' . $k] );
			$max = intval ( $_POST ['max' . $k] );
			$this->writeLog ( "$k:$min,$max" );
			if (in_array ( $k, $ylPayPlatforms )) {
				$open = 1;
			} else {
				$open = 0;
			}
	
			$ylPlatformsRange [$k] = array (
					"open" => $open,
					"min" => $min,
					"max" => $max
			);
		}
		$this->writeLog ( $this->YL_PAY_PLATFORMS_RANGE . ">>" . json_encode ( $ylPlatformsRange ) );
		$redis->set ( $this->YL_PAY_PLATFORMS_RANGE, json_encode ( $ylPlatformsRange ) );
	
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal' );
	}
	
	// //////////////////////////////////////////
	// 修改支付配置
	// //////////////////////////////////////////
	// redis keys
	private $JUBAO_CONFIG = "jubaoCfg";
	private $CHANGFU_CONFIG = "cfCfg";
	public function config() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		$jubaoConfigString = $redis->get ( $this->JUBAO_CONFIG );
		$jubaoConfig = array ();
		if ($jubaoConfigString) {
			$jubaoConfig = json_decode ( $jubaoConfigString, true );
		}
		
		$cfConfigString = $redis->get ( $this->CHANGFU_CONFIG );
		$cfConfig = array ();
		if ($cfConfigString) {
			$cfConfig = json_decode ( $cfConfigString, true );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "支付管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "支付管理" 
				),
				"header2" => array (
						"father" => "运营管理",
						"child" => "支付管理 " 
				),
				'jubaoConfig' => $jubaoConfig,
				'cfConfig' => $cfConfig 
		);
		
		$this->load->view ( 'no3/alipayformal_config_view', $data );
	}
	public function modifyConfig() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		// 聚宝云
		$jubaoPartnerId = $this->input->post ( 'jubaoPartnerId', true );
		if ($jubaoPartnerId) {
			$jubaoPartnerId = trim ( $jubaoPartnerId );
		}
		
		$jubaoConfig = array (
				'partnerId' => $jubaoPartnerId 
		);
		$redis->set ( $this->JUBAO_CONFIG, json_encode ( $jubaoConfig ) );
		
		// 畅付
		$cfAppId = $this->input->post ( 'cfAppId' );
		if ($cfAppId) {
			$cfAppId = trim ( $cfAppId );
		}
		
		$cfSecretKey = $this->input->post ( 'cfSecretKey' );
		if ($cfSecretKey) {
			$cfSecretKey = trim ( $cfSecretKey );
		}
		
		$cfConfig = array (
				'appId' => $cfAppId,
				'secretKey' => $cfSecretKey 
		);
		$redis->set ( $this->CHANGFU_CONFIG, json_encode ( $cfConfig ) );
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/alipayformal/config' );
	}
	private function writeLog($txt) {
		echo $txt . "<br/>";
		$log_file = "/log/alipayformal.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
}
