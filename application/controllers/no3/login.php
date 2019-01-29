<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Login extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		$this->load->model ( 'no3/configs_model', 'configs' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->helper ( 'other' );
	}
	
	public function index() {
		$msg = $this->checkRedisAndDB();
		if($msg){
//			exit($msg." please call the manager!!! ");
		}
		$this->load->view ( 'no3/loginview' );
	}
	public function toLogin() {
		$admin_name = trim ( $this->input->post ( 'Username', true ) );
		$password = trim ( $this->input->post ( 'Pasword', true ) );

		if ($admin_name == '' || $password == '') {
			redirect ( 'no3/login' );
		}

		$admin = $this->Admin_model->getAdmin ( $admin_name );
		if (empty ( $admin )) {
			redirect ( 'no3/login' );
		}

		if ($admin ['status'] == 0 || crypt ( $password, $admin ['salt'] ) != $admin ['pass']) {
			redirect ( 'no3/login' );
		}

		session_start();
		$_SESSION['smc_id'] = $admin ['id'];
		$_SESSION['smc_admin_name'] = $admin ['admin_name'];
		$_SESSION['smc_role_id'] = $admin ['role_id'];
		
		$admin_data = array (
				'id' => $admin ['id'],
				'admin_name' => $admin ['admin_name'],
				'role_id' => $admin ['role_id'],
				'login_status' => true 
		);
		$this->session->set_userdata ( $admin_data );
		
		// [170325] 记录登录日志
		$this->Admin_model->recordLogin($admin['admin_name']);
		redirect ( site_url ( 'no3/index' ) );
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
	
	private function checkRedisAndDB(){
		$iparr = array(
			"web_redis_nei" => "127.0.0.1",
			"mainDB2_nei" => "192.168.1.119",
		);
		$tip_msg = "";
		foreach ($iparr as $key=>$ip){
			$status = $this->pingAddress($ip);
			if($status){
				continue;
			}
			$tip_msg .= $key.":inner ping failed,";
		}
		return $tip_msg;
	}
	private function pingAddress($address) {
		$status = -1;
		$pingresult = exec("ping -c 1 {$address}", $outcome, $status);
		if (0 == $status) {
			return true;
		}
		return false;
	}
}
