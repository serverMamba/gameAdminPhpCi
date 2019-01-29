<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infoshop extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                   redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
     public function get_shop_data() {
        $this->load->model('shop_model');

        $action = $this->input->get_post('action');
        $mystarttime = $this->input->get_post('mystarttime');
        $myendtime = $this->input->get_post('myendtime');
        $userid = $this->input->get_post('userid');
        $orderid = $this->input->get_post('orderid');
        $beginindex = $this->input->get_post('beginindex');
       // $channelid = $this->input->get_post('channelid');
        $platformid = $this->input->get_post('platformid');
        $gameid = $this->input->get_post('gameid');
       // $platformid = "9999";
        $channelid = "9999";
        $res = $this->shop_model->get_shop_his($mystarttime, $myendtime, $userid, $orderid, $beginindex,$platformid, $channelid, $gameid);
        echo json_encode($res);
    }
    
    
    public function get_shopexcel_data() {
        $this->load->model('shop_model');

        $action = $this->input->get_post('action');
        $mystarttime = $this->input->get_post('mystarttime');
        $myendtime = $this->input->get_post('myendtime');
        $userid = $this->input->get_post('userid');
        $orderid = $this->input->get_post('orderid');
        $beginindex = $this->input->get_post('beginindex');
        $platformid = $this->input->get_post('platformid');
        $gameid = $this->input->get_post('gameid');
        $channelid = "9999";
        $this->shop_model->get_shopexcel_his($mystarttime, $myendtime, $userid, $orderid, $beginindex,$platformid, $channelid, $gameid);
       
    }

    public function index() {
        $menucheck = array();
        $myfilename = DYCONFIG."private_data.log";
        if (file_exists($myfilename)) {
            $saveres = file_get_contents($myfilename, LOCK_EX);
             $rxry = json_decode($saveres);
             foreach ($rxry as $rx => $ry){
                  foreach ($ry as $key => $val){
                      $menucheck[$rx][$key] = $rxry->$rx->$key;
                   }
             }
        }            
            
           $usernamezz = $_COOKIE['SMC_NO3_YG'];
           
          
           $paygamelisthuang = $this->config->item('paygamelist');
           $payment_tableshuang = $this->config->item('payment_tables');
           $channellistxhuang = $this->config->item('channellistx');
           
           if(($usernamezz !="huanwei")&&($usernamezz !="huangwei")&&($usernamezz !="wangshun")&&($usernamezz !="songxiaoniang")&&($usernamezz !="supermaster")&&($usernamezz !="lijuan")&&($usernamezz !="huangbihong")){
                redirect(site_url('no3/login'));
                return;
            }
        
          //   if(($usernamezz  == "huangwei") || ( $usernamezz  == "qihualiang"))
          // {
           // $paygamelisthuang = array_merge_recursive($this->config->item('paygamelisthuang'),$this->config->item('paygamelist'));
          //  $payment_tableshuang = array_merge_recursive($this->config->item('payment_tableshuang'),$this->config->item('payment_tables'));
          //  $channellistxhuang = array_merge_recursive($this->config->item('channellisthuang'),$this->config->item('channellist'));
         //  }
           
           $data =array(
               "systemconfig" => $this->configs->get_navmenu(),
               "menucheck" => $menucheck,
               "gamelist" =>  $paygamelisthuang,
               "paylist"  =>  $payment_tableshuang,
               "channellist"  =>  $channellistxhuang,
               "message" =>array("username"=> $usernamezz,"mail"=>"aaa"),
               "choose" => array("father"=>"客服管理","child"=>"玩家商城记录"),
               "header1" => array("father"=>"客服管理","child"=>"玩家商城记录"),
               "header2" => array("father"=>"玩家商城记录","child"=>"玩家商城的购买历史记录，创建与2014年9月1日 "),
               "header3" => array("father"=>"玩家商城记录创建于2014年5月20日","child"=>" 游戏运营从2014年5月25日开始 (v1.0) "),
          );
           $this->load->view('no3/infoshopview',$data);
	}
	
	public function frameset() {
		if(!$this->uid) {
			$this->_gologin();
			return;
		}
		
		$this->load->view('frameset');
	}
	
	public function header() {
		if(!$this->uid) {
			$this->_gologin();
			return;
		}
		
		$this->load->view('header');
	}
	
	public function nav() {
		if(!$this->uid) {
			$this->_gologin();
			return;
		}
		
		$this->load->view('nav');
	}
	
	public function sysinfo() {
		if(!$this->uid) {
			$this->_gologin();
			return;
		}
		
		$this->load->database();
		$query = $this->db->query('SELECT version() as version');
		$db_info = $query->row_array();
		
		$data = array(
			'server_env' 			=> $_SERVER['SERVER_SOFTWARE'],
			'php_version' 			=> phpversion(),
			'database' 				=> 'MySQL ' . $db_info['version'],
			'max_memory_limit' 		=> ini_get('memory_limit'),
			'file_uploads' 			=> ini_get('file_uploads') ? '允许' : '禁用',
			'upload_max_filesize' 	=> ini_get('upload_max_filesize'),
			'post_max_size' 		=> ini_get('post_max_size'),
			'php_display_errors'	=> ini_get('display_errors') ? '开启' : '禁用',
			'php_error_reporting' 	=> ini_get('error_reporting'),
			'magic_quotes_gpc'		=> ini_get('magic_quotes_gpc') ? '开启' : '禁用',
		
		);		
		$this->load->view('sysinfo', $data);
	}
	
	private function _login() {
		$gourl 	= $this->input->get('gourl');
		$msg	= @base64_decode($this->input->get('msg'));
		$this->load->view('login', array('gourl'=>$gourl,'msg'=>$msg));
	}
	
	public function login_submit() {
		$callback	= $this->input->get('callback');
		$username	= $this->input->get('username');
		$password	= $this->input->get('password');
		$password	= md5($password);
		$gourl		= $this->input->get('gourl');
		
		if(empty($gourl)) $gourl = site_url(DEFAULT_PAGE_URI);
		
		if(empty($username)) {
			echo jsonp_return($callback, RESPONSE_PARAMS_ERROR, '需要输入帐号才能进行登录');
			return;
		}
		
		if(empty($password)) {
			echo jsonp_return($callback, RESPONSE_PARAMS_ERROR, '需要输入密码才能进行登录');
			return;
		}
		
		$this->load->model('backuser_model');
		$userinfo = $this->backuser_model->get_userinfo_by_username($username);
		
		if($userinfo === false) {
			echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1001)');
			return;
		} elseif(empty($userinfo) || $userinfo['password'] != $password) {
			echo jsonp_return($callback, 2, '帐号或密码错误');
			return;
		}

		$this->load->library('login_lib');
		$cookie_ok = $this->login_lib->set_login_cookie($username);
		if($cookie_ok) {
			$this->backuser_model->add_login_count($username, 1);
			//$this->backuser_model->update_user_by_username($username, array('last_login_time'=>date('Y-m-d H:i:s'), 'last_login_ip'=>$this->input->ip_address()));
			$this->backuser_model->update_user_by_username($username, array('last_login_ip'=>$this->input->ip_address()));
			echo jsonp_return($callback, RESPONSE_OK, $gourl);
		} else {
			echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1002)');
		}
	}
	
	public function logout() {
		$gourl = $this->input->get('gourl');
		if(empty($gourl)) $gourl = site_url(DEFAULT_PAGE_URI);
		
		$this->load->library('login_lib');
		$this->login_lib->logout();
		header("location: $gourl");
	}
}
