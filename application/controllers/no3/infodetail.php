<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Infodetail extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
        // test
//		if (! $this->Common_model->isPriv ( 'kfgl_wjxxxx' )) {
//			redirect ( 'no3/index' );
//		}
		$this->load->helper ( 'other' );
	}
	public function get_game_status() {
		$this->load->model ( 'detail_model' );
		$id = $this->input->get_post ( 'id' );
		$res = $this->detail_model->get_game_statusx ( $id );
		echo json_encode ( $res );
	}
	public function get_all_data() {
		$this->load->model ( 'detail_model' );
		$res = $this->detail_model->get_all_data ();
		echo json_encode ( $res );
	}
	public function get_block_status() {
		//$this->writeLog("get_block_status----------------------------------");
		$this->load->model ( 'detail_model' );
		$ip = $this->input->get_post ( 'ip' );
		$id = $this->input->get_post ( 'id' );
		$mac = $this->input->get_post ( 'mac' );
		$alipay_account = $this->input->get_post ( 'alipay_account' );
		$alipay_real_name = $this->input->get_post ( 'alipay_real_name' );
		//$this->writeLog("$ip, $id, $mac,$alipay_account,$alipay_real_name");
		$res = $this->detail_model->get_block_statusx ( $ip, $id, $mac,$alipay_account,$alipay_real_name );
		echo json_encode ( $res );
	}
	public function save_detail_data() {
		$this->load->model ( 'detail_model' );
		
		$action = $this->input->get_post ( 'action' );
		$userid = $this->input->get_post ( 'userid' );
		
		$help = $this->input->get_post ( 'help' );
		$value = $this->input->get_post ( 'value' );
		
		$discrible = $this->input->get_post ( 'discrible' );
		$admin_name = $this->session->userdata('admin_name');
		$res = $this->detail_model->save_detail_hisx ( $action, $userid, $help, $value, $discrible, $admin_name );
		$this->writeLog("[save_detail_data] ".$this->session->userdata ( 'id' ).",".$this->session->userdata ( 'admin_name' ).",$action,$userid,$help,$value,$discrible");
		echo json_encode ( $res );
	}
	public function addBlackAlipay() {
		$data ['alipay_account'] = $this->input->get_post ( 'alipay_account' );
		if($data ['alipay_account']){
			$data ['alipay_account'] = trim($data ['alipay_account']);
		}
		$data ['alipay_real_name'] = $this->input->get_post ( 'alipay_real_name' );
		if($data ['alipay_real_name']){
			$data ['alipay_real_name'] = trim($data ['alipay_real_name']);
		}
		$data ['is_lock'] = 1;
		$data ['discribe'] = $this->input->get_post ( 'discrible' );
		$data ['add_time'] = time ();
		//$this->writeLog("addBlackAlipay alipay_account=".$data ['alipay_account'].",alipay_real_name=".$data ['alipay_real_name']);
		if($data ['alipay_account'] && $data ['alipay_real_name'])
		{
			$this->load->model ( 'no3/Black_alipay_model' );
			$res = $this->Black_alipay_model->insertBlack ( $data );
			if ($res) {
				$this->session->set_flashdata ( 'success', '添加成功' );
			} else {
				$this->session->set_flashdata ( 'error', '添加失败' );
			}
			$jsonres = json_encode ( $res );
			//$this->writeLog("addBlackAlipay jsonres=$jsonres");
			echo $jsonres;
		}else{
			//$this->writeLog("addBlackAlipay error");
			echo "error";
		}
	}

	/**
	 * [170219] add: 新增一个查询条件：支付宝真名
	 */
	public function get_detail_data() {
		$this->load->model ( 'detail_model' );
		$action = $this->input->get_post ( 'action' );
		$userid = $this->input->get_post ( 'userid' );
		$accountid = $this->input->get_post ( 'accountid' );
		$mac = $this->input->get_post ( 'mac' );
		$ip = $this->input->get_post ( 'ip' );
		$alipay_account = $this->input->get_post ( 'alipay_account' );
		$alipay_name = $this->input->get_post ( 'alipay_name' );
		$mobile = $this->input->get_post ( 'mobile' );
		$is_recharge = $this->input->get_post ( 'is_recharge' );
		if (empty ( $userid ) && empty ( $mac ) && empty ( $ip ) && empty ( $accountid ) && empty($alipay_account) && empty($alipay_name) && empty($mobile) && empty($is_recharge)) {
			echo json_encode ( array (
					"status" => "1" 
			) );
			return;
		}
		if($userid >=  50000000){
			exit('[]');
		}
		$res = $this->detail_model->get_detail_hisx ( $userid, $accountid, $mac, $ip, '',$alipay_account , $alipay_name, $mobile,$is_recharge);
		
		echo json_encode ( $res );
	}
	
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id' ) ? intval ( $this->input->get ( 'user_id' ) ) : 0;
		$query ['alipay_account'] = $this->input->get ( 'alipay_account' ) ? $this->input->get ( 'alipay_account' ) : '';
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "用户信息管理" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "用户信息管理" 
				),
				"header2" => array (
						"father" => "玩家详细信息",
						"child" => "玩家详细信息,创建于2014年7月25日. " 
				),
				"header3" => array (
						"father" => "玩家详细信息将后台创建于2014年7月25日",
						"child" => " 游戏运营从2014年7月25日开始 (v1.0) " 
				),
				'query' => $query 
		);
		$this->load->view ( 'no3/infodetailview', $data );
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
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "infodetail";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$this->getIp()." ".$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	private function getIp() {
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$cip = $_SERVER ["HTTP_CLIENT_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
			$cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		} elseif (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$cip = $_SERVER ["REMOTE_ADDR"];
		} else {
			$cip = "无法获取！";
		}
		return $cip;
	}
	
}
