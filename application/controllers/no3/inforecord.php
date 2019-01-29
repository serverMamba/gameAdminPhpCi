<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Inforecord extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_wjyyjl' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_gameuser_data() {
		$this->load->model ( 'gamehis_model' );
		
		$action = $this->input->get_post ( 'action', true );
		$mystarttime = $this->input->get_post ( 'mystarttime', true );
		$myendtime = $this->input->get_post ( 'myendtime', true );
		$userid = intval ( $this->input->get_post ( 'userid' ) );
		$paijuhao = $this->input->get_post ( 'paijuhao', true );
		$beginindex = $this->input->get_post ( 'beginindex', true );
		$gameid = $this->input->get_post ( 'gameid', true );
		
		$res = $this->gamehis_model->get_game_his ( $userid, $gameid, $mystarttime, $myendtime, $paijuhao, $beginindex );
		
		echo json_encode ( $res );
	}
	
	/**
	 * [170303] 获取用户游戏次数的数据
	 */
	public function getOnlineData() {
		$this->load->model ( 'gamehis_model' );
		
		$startTime = $this->input->get_post ( 'mystarttime' );
		$endTime = $this->input->get_post ( 'myendtime' );
		$userid = $this->input->get_post ( 'userid' );
		$gameid = $this->input->get_post ( 'gameid' );
		
		if (empty ( $startTime ) || empty ( $endTime ) || empty ( $userid ) || $gameid === '') {
			exit ( json_encode ( array (
					'status' => 1,
					'msg' => "缺少参数" 
			) ) );
		}
		
		if ($gameid == 0) {
			exit ( json_encode ( array (
					'status' => 1,
					'msg' => "请选择游戏" 
			) ) );
		}
		
		// 1. 找到开始那天的0点，以及结束那天的后一天的0点，作为时间区间
		$oneDaySec = 24 * 3600;
		
		$startTime = strtotime ( substr ( $startTime, 0, 10 ) . " 00:00:00" );
		$endTime = strtotime ( substr ( $endTime, 0, 10 ) . " 00:00:00 +1 day" );
		
		if ($endTime <= $startTime) {
			echo json_encode ( array (
					"status" => "1",
					"msg" => "时间区间不正确" 
			) );
			return;
		}
		
		$days = intval ( ($endTime - $startTime) / $oneDaySec );
		
		// 2. 获取数据
		$dbResult = $this->gamehis_model->getOnlineData ( $userid, $gameid, $startTime, $endTime );
		
		// 3. 按照每小时统计数据
		$timeArray = array ();
		for($i = 0; $i < $days * 24; $i ++) {
			$timeArray [] = date ( 'Y-m-d H', $startTime + $i * 3600 );
		}
		
		$totalPlayTimes = count ( $dbResult );
		
		// 这里存每个小时的游戏次数
		$dataMap = array ();
		$winTimes = 0;
		$loseTimes = 0;
		$drawTimes = 0;
		for($i = 0; $i < $totalPlayTimes; $i ++) {
			$recordTime = substr ( $dbResult [$i] ['record_timestamp'], 0, 13 );
			if (! isset ( $dataMap [$recordTime] )) {
				$dataMap [$recordTime] = 1;
			} else {
				$dataMap [$recordTime] ++;
			}
			
			if ($dbResult [$i] ['user_game_result'] == 1) {
				$winTimes ++;
			} else if ($dbResult [$i] ['user_game_result'] == 2) {
				$loseTimes ++;
			} else if ($dbResult [$i] ['user_game_result'] == 0) {
				$drawTimes ++;
			}
		}
		
		echo json_encode ( array (
				"timeArray" => $timeArray,
				"playTimes" => $dataMap,
				"winTimes" => $winTimes,
				"loseTimes" => $loseTimes,
				"drawTimes" => $drawTimes,
				"totalPlayTimes" => $totalPlayTimes 
		) );
	}
	public function index() {
		$gamecodehuang = $this->config->item ( 'gamelist' );
		foreach ( $gamecodehuang as $k => $v ) {
			if ($v > 150) {
				unset ( $gamecodehuang [$k] );
			}
		}
		
		$data = array (
				"gamelist" => $gamecodehuang,
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "玩家游戏记录" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "玩家游戏记录" 
				),
				"header2" => array (
						"father" => "玩家游戏记录",
						"child" => "查看用户在指定时间的游戏情况。 " 
				) 
		);
		$this->load->view ( 'no3/inforecordview', $data );
	}
	public function frameset() {
		if (! $this->uid) {
			$this->_gologin ();
			return;
		}
		
		$this->load->view ( 'frameset' );
	}
	public function header() {
		if (! $this->uid) {
			$this->_gologin ();
			return;
		}
		
		$this->load->view ( 'header' );
	}
	public function nav() {
		if (! $this->uid) {
			$this->_gologin ();
			return;
		}
		
		$this->load->view ( 'nav' );
	}
	public function sysinfo() {
		if (! $this->uid) {
			$this->_gologin ();
			return;
		}
		
		$this->load->database ();
		$query = $this->db->query ( 'SELECT version() as version' );
		$db_info = $query->row_array ();
		
		$data = array (
				'server_env' => $_SERVER ['SERVER_SOFTWARE'],
				'php_version' => phpversion (),
				'database' => 'MySQL ' . $db_info ['version'],
				'max_memory_limit' => ini_get ( 'memory_limit' ),
				'file_uploads' => ini_get ( 'file_uploads' ) ? '允许' : '禁用',
				'upload_max_filesize' => ini_get ( 'upload_max_filesize' ),
				'post_max_size' => ini_get ( 'post_max_size' ),
				'php_display_errors' => ini_get ( 'display_errors' ) ? '开启' : '禁用',
				'php_error_reporting' => ini_get ( 'error_reporting' ),
				'magic_quotes_gpc' => ini_get ( 'magic_quotes_gpc' ) ? '开启' : '禁用' 
		);
		$this->load->view ( 'sysinfo', $data );
	}
	private function _login() {
		$gourl = $this->input->get ( 'gourl' );
		$msg = @base64_decode ( $this->input->get ( 'msg' ) );
		$this->load->view ( 'login', array (
				'gourl' => $gourl,
				'msg' => $msg 
		) );
	}
	public function login_submit() {
		$callback = $this->input->get ( 'callback' );
		$username = $this->input->get ( 'username' );
		$password = $this->input->get ( 'password' );
		$password = md5 ( $password );
		$gourl = $this->input->get ( 'gourl' );
		
		if (empty ( $gourl ))
			$gourl = site_url ( DEFAULT_PAGE_URI );
		
		if (empty ( $username )) {
			echo jsonp_return ( $callback, RESPONSE_PARAMS_ERROR, '需要输入帐号才能进行登录' );
			return;
		}
		
		if (empty ( $password )) {
			echo jsonp_return ( $callback, RESPONSE_PARAMS_ERROR, '需要输入密码才能进行登录' );
			return;
		}
		
		$this->load->model ( 'backuser_model' );
		$userinfo = $this->backuser_model->get_userinfo_by_username ( $username );
		
		if ($userinfo === false) {
			echo jsonp_return ( $callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1001)' );
			return;
		} elseif (empty ( $userinfo ) || $userinfo ['password'] != $password) {
			echo jsonp_return ( $callback, 2, '帐号或密码错误' );
			return;
		}
		
		$this->load->library ( 'login_lib' );
		$cookie_ok = $this->login_lib->set_login_cookie ( $username );
		if ($cookie_ok) {
			$this->backuser_model->add_login_count ( $username, 1 );
			// $this->backuser_model->update_user_by_username($username,
			// array('last_login_time'=>date('Y-m-d H:i:s'),
			// 'last_login_ip'=>$this->input->ip_address()));
			$this->backuser_model->update_user_by_username ( $username, array (
					'last_login_ip' => $this->input->ip_address () 
			) );
			echo jsonp_return ( $callback, RESPONSE_OK, $gourl );
		} else {
			echo jsonp_return ( $callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1002)' );
		}
	}
	public function logout() {
		$gourl = $this->input->get ( 'gourl' );
		if (empty ( $gourl ))
			$gourl = site_url ( DEFAULT_PAGE_URI );
		
		$this->load->library ( 'login_lib' );
		$this->login_lib->logout ();
		header ( "location: $gourl" );
	}
}
