<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Infoback extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_wjfkyj' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_back_data() {
		$this->load->model ( 'back_model' );
		$res = $this->back_model->get_back_message ();
		echo json_encode ( $res );
	}
	public function save_single_data() {
		$this->load->model ( 'back_model' );
		$userid = $this->input->get_post ( 'userid' );
		$id = $this->input->get_post ( 'id' );
		$data = $this->input->get_post ( 'data' );
		$res = $this->back_model->save_single_data ( $id, $userid, $data );
		echo json_encode ( $res );
	}
	public function get_single_data() {
		$this->load->model ( 'back_model' );
		$userid = $this->input->get_post ( 'userid' );
		$res = $this->back_model->get_single_data ( $userid );
		echo json_encode ( $res );
	}
	public function index() {
		$paygamelisthuang = $this->config->item ( 'paygamelist' );
		$payment_tableshuang = $this->config->item ( 'payment_tables' );
		$channellistxhuang = $this->config->item ( 'channellistx' );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $paygamelisthuang,
				"paylist" => $payment_tableshuang,
				"choose" => array (
						"father" => "客服管理",
						"child" => "玩家反馈建议" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "玩家反馈建议" 
				),
				"header2" => array (
						"father" => "玩家反馈建议",
						"child" => "在线回答玩家的提问 " 
				),
				"header3" => array (
						"father" => "玩家反馈建议创建于2014年9月2日",
						"child" => " 游戏运营从2014年9月10日开始 (v1.0) " 
				) 
		);
		$this->load->view ( 'no3/infobackview', $data );
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
		)
		;
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
