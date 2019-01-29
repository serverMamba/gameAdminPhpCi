<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Wanshunfish12 extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yybb_puyudatinzhshi' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_zhanshi_data() {
		$this->load->model ( 'wanshunfish12_model' );
		
		$action = $this->input->get_post ( 'action', true );
		$mytasktime = $this->input->get_post ( 'mytasktime', true );
		$myendtime = $this->input->get_post ( 'myendtime', true );
		$userid = intval ( $this->input->get_post ( 'userid' ) );
		$account = $this->input->get_post ( 'account', true );
		$beginindex = $this->input->get_post ( 'beginindex', true );
		// $gameid = $this->input->get_post('gameid');
		
		// if (empty($account)&&empty($userid)) {
		// echo json_encode(array("status"=>"1"));
		// return;
		// }
		
		// $res =
		// $this->wanshunfish7_model->get_zhanshi_his($userid,$gameid,$mystarttime,$myendtime,$account,$beginindex);
		
		$res = $this->wanshunfish12_model->get_zhanshi_his ( $userid, $mytasktime, $account, $beginindex );
		
		echo json_encode ( $res );
	}
	public function index() {
		$gamecodehuang = $this->config->item ( 'gamelist' );
		// if(($usernamezz == "huangwei") || ( $usernamezz == "qihualiang"))
		// {
		// $gamecodehuang =
		// array_merge_recursive($this->config->item('gamelisthuang'),$this->config->item('gamelist'));
		// }
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $gamecodehuang,
				"choose" => array (
						"father" => "捕鱼项目",
						"child" => "捕鱼大厅钻石抽奖查询" 
				),
				"header1" => array (
						"father" => "捕鱼项目",
						"child" => "捕鱼大厅钻石抽奖查询" 
				),
				"header2" => array (
						"father" => "捕鱼大厅钻石抽奖查询",
						"child" => "显示捕鱼大厅钻石抽奖查询状态。 " 
				) 
		);
		$this->load->view ( 'no3/wanshunfish12_view', $data );
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
