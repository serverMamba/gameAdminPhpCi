<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Infodetail1 extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                 if(empty($_COOKIE['SMC_NO3_YG'])){
                   redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
      public function      get_game_status(){
       $this->load->model('detail_model');
       $id = $this->input->get_post('id');
       $res = $this->detail_model->get_game_statusx($id); 
        echo json_encode($res);  
          
      }
        
      public function     get_block_status(){
       $this->load->model('detail_model');
       $ip = $this->input->get_post('ip');
       $id = $this->input->get_post('id');
       $mac = $this->input->get_post('mac');
       $res = $this->detail_model->get_block_statusx($ip,$id,$mac ); 
        echo json_encode($res);
       }
        
        
     public function   save_detail_data(){
         
        if( ! in_array($_COOKIE['SMC_NO3_YG'],array("huanwei","huangwei","songxiaoniang","supermaster"))) {
            echo "noprivate";
            return;
        }
         
        $this->load->model('detail_model');

       $action = $this->input->get_post('action');
       $userid = $this->input->get_post('userid');
     
       $help = $this->input->get_post('help');
       $value = $this->input->get_post('value');
       $discrible =$_COOKIE['SMC_NO3_YG']."@". $this->input->get_post('discrible');
       $admin_name = $this->session->userdata('admin_name');
       $res = $this->detail_model->save_detail_hisx($action,$userid,$help,$value ,$discrible, $admin_name );
       echo json_encode($res);
         
     }
     
     public function   save_bat_data(){
        if( ! in_array($_COOKIE['SMC_NO3_YG'],array("huanwei","huangwei","songxiaoniang","supermaster"))) {
            echo "noprivate";
            return;
        }
        $this->load->model('detail_model');

       $action = $this->input->get_post('action');
       $items = $this->input->get_post('items');

       $value = $this->input->get_post('value');
       
       $discrible = $_COOKIE['SMC_NO3_YG']."@". $this->input->get_post('discrible');
       
       $res = $this->detail_model->save_bat_hisx($action,$items,$value ,$discrible );
       echo json_encode($res);
         
     }
        
    public function get_detail_data() {
       $this->load->model('detail_model');
       $action = $this->input->get_post('action');
       $userid = $this->input->get_post('userid');
       $accountid = $this->input->get_post('accountid');
       $mac = $this->input->get_post('mac');
       $ip = $this->input->get_post('ip');
       $channel = $this->input->get_post('channel');
       if (empty($userid)&&empty($mac)&&empty($ip)&&empty($accountid)&&empty($channel)) {
           echo json_encode(array("status"=>"1"));
           return;
       }
       $res = $this->detail_model->get_detail_hisx($userid,$accountid,$mac,$ip,$channel);
       
       
       foreach ($res as $key => $value) {
           // $res1 = $this->detail_model->get_game_statusx($value["id"]);
            $res2 =  $this->detail_model->get_robot_lastday($value["id"]);

            $onlinetime = 0;
            $gamenum = 0;
            $winnum = 0;
            $losenum = 0;
            $drawnum = 0;
            $winscore = 0;
            $losescore = 0;
            $servicefee = 0;

            foreach ($res1 as $key1 => $value1) {
                $onlinetime = $onlinetime + $value1["onlinetime"];
                $gamenum = $gamenum+ $value1["gamenum"];
                $winnum = $winnum+ $value1["winnum"];
                $losenum = $losenum+ $value1["losenum"];
                $drawnum = $drawnum+ $value1["drawnum"];
                $winscore = $winscore+ $value1["winscore"];
                $losescore = $losescore+ $value1["losescore"];
                $servicefee = $servicefee+ $value1["servicefee"];
            }
           $res[$key]["onlinetime"] =  $onlinetime;
           $res[$key]["gamenum"] =  $gamenum;
           $res[$key]["winnum"] =  $winnum;
           $res[$key]["losenum"] =  $losenum;
           $res[$key]["drawnum"] =  $drawnum;
           $res[$key]["winscore"] =  $winscore;
           $res[$key]["losescore"] =  $losescore;
           
            $res[$key]["jinfen"] =  $winscore - $losescore ;
           $res[$key]["servicefee"] = $res2;// $servicefee;
            
        }
         echo json_encode($res);
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
               "choose" => array("father"=>"客服管理","child"=>"用户信息管理（研发）"),
               "header1" => array("father"=>"客服管理","child"=>"用户信息管理（研发）"),
               "header2" => array("father"=>"玩家详细信息（研发）","child"=>"玩家详细信息,创建于2014年9月3日. "),
               "header3" => array("father"=>"玩家详细信息将后台创建于2014年7月25日","child"=>" 游戏运营从2014年7月25日开始 (v1.0) "),
          );
           $this->load->view('no3/infodetailview1',$data);
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
			'database' 			=> 'MySQL ' . $db_info['version'],
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
