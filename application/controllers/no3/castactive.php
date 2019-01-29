<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castactive extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
    public function  score_operation($account, $v){
        $url = "http://211.151.33.246:6001/smc?command=80003";
        $post_data = array("UserID"=>$account,"Score"=>$v,"AddType"=>6,"GameCode"=>0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
   
    public function   score_operation_test(){
         header("Content-type: text/html; charset=utf-8");
         $account = "890007";
         $v = 100000;
         $output=$this->score_operation($account,$v);
         print_r($output);
   }
    
   public function  add_pay_record($param){
        $TradeNo = $param['tradeno'];
        $PayType =$param['paytype'];
        $UserID = $param['userid'];
        $GameCode =$param['gamecode'];
        $PlatFormID =$param['platformid'];
        $TotalFee= $param['totalfee'];
        $ProductID =$param['productid'];
        $ProductDesc =$param['des'];
        $url = "http://211.151.33.246:6001/smc?command=80007";
        $post_data = array("TradeNo"=>$TradeNo,"PayType"=>$PayType,"UserID"=>$UserID,"GameCode"=>$GameCode, "PlatFormID"=>$PlatFormID, "TotalFee"=>$TotalFee, "ProductID"=>$ProductID,"ProductDesc"=>$ProductDesc);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
   
    public function  add_pay_record_test(){
         header("Content-type: text/html; charset=utf-8");
         $param = array();
         $param['tradeno'] = "12345678999";
         $param['paytype'] = "41";
         $param['userid'] = "890007";
         $param['gamecode'] = "41";
         $param['platformid'] = "44";
         $param['totalfee'] = "30";
         $param['productid'] = "02000017";
         $param['des'] = "十全武功";
         $output=$this->add_pay_record($param);
         print_r($output);
   }
   
   public function  add_buqian($account, $v){
        $url = "http://211.151.33.246:6001/smc?command=80021";
        $post_data = array("UserID"=>$account,"Type"=>2,"Num"=>$v,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
   }
   
   public function  add_buqian_test(){
         $account = "890007";
         $v = 10;
         $output =$this->add_buqian($account,$v);
         print_r($output);
   }
   
   
     public function  add_jipai($account, $v){
        $url = "http://211.151.33.246:6001/smc?command=80021";
        $post_data = array("UserID"=>$account,"Type"=>3,"Num"=>$v,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
   }
   
   public function  add_jipai_test(){
         $account = "890007";
         $v = 10;
         $output = $this->add_jipai($account,$v);
         print_r($output);
   }
    
    
    public function get_v5($account){
        $url = "http://211.151.33.246:6001/smc?command=80021";
        $post_data = array("UserID"=>$account,"Type"=>101,"Num"=>0,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
    
    public function  get_v5_test(){
         $account  =  890007;
         $output = $this->get_v5($account);
         print_r($output);
   }
   
   
    public function get_v10($account){
        $url = "http://211.151.33.246:6001/smc?command=80021";
        $post_data = array("UserID"=>$account,"Type"=>102,"Num"=>0,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output1 = json_decode($output);
        if($output1->ResultCode == 0 ) return true;
        return false;
    }
    
    public function  get_v10_test(){
         $account  =  890007;
         $output = $this->get_v10($account);
         print_r($output);
   }
   
   
    public function get_v30($account){
        $url = "http://211.151.33.246:6001/smc?command=80021";
         $post_data = array("UserID"=>$account,"Type"=>103,"Num"=>0,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
    
    public function  get_v30_test(){
         $account  =  890007;
         $output = $this->get_v30($account);
         print_r($output);
   }
   
    public function get_v50($account){
        $url = "http://211.151.33.246:6001/smc?command=80021";
        $post_data = array("UserID"=>$account,"Type"=>104,"Num"=>0,);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
    
    public function  get_v50_test(){
         $account  = 890007;
         $output = $this->get_v50($account);
         print_r($output);
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
           $data =array(
               "systemconfig" => $this->configs->get_navmenu(),
               "menucheck" => $menucheck,
               "message" =>array("username"=> $usernamezz,"mail"=>"aaa"),
               "choose" => array("father"=>"运营管理","child"=>"活动设定"),
               "header1" => array("father"=>"运营管理","child"=>"活动设定"),
               "header2" => array("father"=>"二人麻将","child"=>"在线人数实时统计 "),
               "header3" => array("father"=>"二人麻将后台创建于2014年5月20日","child"=>" 游戏运营从2014年5月25日开始 (v1.0) "),
          );
           $this->load->view('no3/indexview',$data);
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
