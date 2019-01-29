<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gameddzupload extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
                // $this->load->model('gamemessage_model',"gamemessage");
	}
        
 
        
        public function get_config() {
            
$item =array(
                "channelid"=>"27",
                "channelname"=>"奇虎360",
                "channeldiscrible"=>"奇虎公司，国内最大的渠道",
                "gamename"  => "欢乐斗地主360版本",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCLZDJ_360_android_V2.5.4.9_201505191630.apk",
                "version" => "650",
                "versionstr" => "2.5.4.9",
                "size" => "17.3",
                "md5" => "2728B9842A580EEE49E54E201C2751AF",
                "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "543",
                "updatetype"  => "01",
                "updatecontent" => "1.修正兑换券无法兑换话费的问题\n2.优化所有游戏出牌响应速度\n3.优化网络，提高随机配桌的速度\n4.优化电池方案，略微减少耗电\n5.优化支付时客户端响应速度\n6.更换了游戏语音\n7.修复已知Bug\n8.优化用户游戏体验\n",                );
            $result[] = $item;
            
            $item =array(
                "channelid"=>"01",
                "channelname"=>"通用渠道",
                "channeldiscrible"=>"一起游戏通用渠道",
                "gamename"  => "一起欢乐斗地主",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCDJ_YDMM_android_V2.6.0.0_201505281044.apk",
                "version" => "639",
                "versionstr" => "2.6.0.0",
                "size" => "12.50",
                "md5" => "A7AECDE557A2864119A7AB4ED0E2CCA9",
                "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            
            $item =array(
                "channelid"=>"09",
                "channelname"=>"小米",
                "channeldiscrible"=>"小米渠道包",
                "gamename"  => "一起欢乐斗地主（支持癞子+单机）",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCLZDJ_xiaomi_android_V2.6.0.0_201505281756.apk",
                "version" => "649",
                 "versionstr" => "2.6.0.0",
                "size" => "14.9",
                "md5" => "09AAB186E79CA0D7B9E1B78C4B8F190E",
                 "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            
            $item =array(
                "channelid"=>"33",
                "channelname"=>"酷派",
                "channeldiscrible"=>"酷派渠道包",
                "gamename"  => "一起欢乐斗地主（支持癞子+单机）",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/coolpad.android.ddz.2.5.4.4.201503101750.apk",
                "version" => "594",
                "versionstr" => "2.5.4.4",
                "size" => "15.8",
                "md5" => "C838150636AB36FDFA062D0006EB41A7",
                "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "539",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
             $item =array(
                "channelid"=>"29",
                "channelname"=>"电信爱游戏",
                "channeldiscrible"=>"电信渠道包",
                "gamename"  => "一起欢乐斗地主",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCLZDJ_dianxinaiyouxi_android_V2.6.0.0_201505281751.apk",
                "version" => "647",
                "versionstr" => "2.6.0.0",
                "size" => "13.00",
                "md5" => "6F6C28605F6BCB88A858C709A412C745",
                 "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            $item =array(
                "channelid"=>"46",
                "channelname"=>"华为",
                "channeldiscrible"=>"华为渠道包",
                "gamename"  => "一起欢乐斗地主",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCDJ_HUAWEI_android_V2.6.0.0_201506051050.apk",
                "version" => "644",
                "versionstr" => "2.6.0.0",
                "size" => "15.20",
                "md5" => "B0B6B86DF2329BD2FA7F049630F8D395",
                 "packagename" =>"com.bohaoo.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
             $item =array(
                "channelid"=>"1",
                "channelname"=>"移动mm",
                "channeldiscrible"=>"移动mm渠道改名包",
                "gamename"  => "一起斗地主（支持单机）",
                "gameid"  => "48",
                "downloadurl"=>"http://www.515game.com/res/YQDDZZCDJ_YDMM_android_V2.6.0.0_201506051034.apk",
                "version" => "640",
                "versionstr" => "2.6.0.0",
                "size" => "12.50",
                "md5" => "19080616FCA157CE58720D80FFD1725D",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
             $item =array(
                "channelid"=>"1",
                "channelname"=>"移动mm",
                "channeldiscrible"=>"移动mm渠道改名包",
                "gamename"  => "单机斗地主",
                "gameid"  => "49",
                "downloadurl"=>"http://www.515game.com/res/DJDDZ_YDMM_android_V2.6.0.0_201506021310.apk",
                "version" => "641",
                "versionstr" => "2.6.0.0",
                "size" => "12.50",
                "md5" => "3CDD3E1E110C434573833F679B0C9BC4",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            $item =array(
                "channelid"=>"1",
                "channelname"=>"移动mm",
                "channeldiscrible"=>"移动mm渠道改名包",
                "gamename"  => "一起欢乐斗地主",
                "gameid"  => "50",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZ_YDMM_android_V2.6.0.0_201506021138.apk",
                "version" => "642",
                "versionstr" => "2.6.0.0",
                "size" => "12.50",
                "md5" => "D99324B92818914420A57BCBB36183CA",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
             $item =array(
                "channelid"=>"47",
                "channelname"=>"联想",
                "channeldiscrible"=>"联想A包",
                "gamename"  => "一起欢乐斗地主",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZ_lianxiangAleshangdian_android_V2.5.4.9_201505191635.apk",
                "version" => "645",
                "versionstr" => "2.5.4.9",
                "size" => "13.40",
                "md5" => "085C9277E2D12FE77CB7A5BC1CC85BBC",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "543",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            $item =array(
                "channelid"=>"14",
                "channelname"=>"百度",
                "channeldiscrible"=>"百度包",
                "gamename"  => "一起欢乐斗地主（支持癞子+单机）",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/YQHLDDZZCLZDJ_baidu_android_V2.6.0.0_201505281055.apk",
                "version" => "643",
                "versionstr" => "2.6.0.0",
                "size" => "16.70",
                "md5" => "4BBCA8E31F4431523D0B0E5C87DCD461",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
            
            $item =array(
                "channelid"=>"32",
                "channelname"=>"和游戏",
                "channeldiscrible"=>"和游戏",
                "gamename"  => "欢乐斗地主（支持单机）",
                "gameid"  => "41",
                "downloadurl"=>"http://www.515game.com/res/HLDDZZCDJ_heyouxi_android_V2.6.0.0_201506081320.apk",
                "version" => "643",
                "versionstr" => "2.6.0.0",
                "size" => "14.30",
                "md5" => "842BEDF3E70CDA2FFC01183521FE4BA7",
                 "packagename" =>"com.yuqi.doudizhu",
                "updateversion" => "560",
                "updatetype"  => "01",
                "updatecontent" => "1.游戏界面全面优化，视觉体验提升\n2.增强网络稳定性，不掉线，更流畅\n3.充值流程优化，更便捷，更多优惠\n4.新游戏“掼蛋”上线，欢迎体验\n5.修复已知Bug\n6.优化用户游戏体验\n",
                );
            $result[] = $item;
             
            return $result;
        }
        
        
               
       public function get_gamemessage_data(){
          //$gamecode =$this->input->get_post("gameid");
          //$roomid   =$this->input->get_post("roomid");
         // $ret=$this->gamemessage->get_gamemessage_data($gamecode, $roomid);
           $ret = $this->get_config();
          echo json_encode( $ret);
       }
       

        
   public function save_gamemessage_data(){
           $id =$this->input->get_post("id");
           $gamecode =$this->input->get_post("gameid");
           $roomid   =$this->input->get_post("roomid");
           $inter    =$this->input->get_post("inter");
           $msg      =$this->input->get_post("msg");
           $ret=$this->gamemessage->save_gamemessage_data($id,$gamecode,$roomid,$inter,$msg); 
           echo json_encode( $ret);
       }
       
    public function insert_gamemessage_data() {
        $ret = $this->get_config();
        $this->load->model('usernew_mid_model');
        foreach ($ret as $key => $value) {
            $channelid = $value["channelid"];
            $channelname = $value["channelname"];
            $channeldiscrible = $value["channeldiscrible"];
            $gamename = $value["gamename"];
            $gameid = $value["gameid"];
            $downloadurl = $value["downloadurl"];
            $version = $value["version"];
            $versionstr = $value["versionstr"];
            $size = $value["size"];
            $md5 = $value["md5"];
            $packagename = $value["packagename"];
            $updateversion = $value["updateversion"];
            $updatetype = $value["updatetype"];
            $updatecontent = $value["updatecontent"];
            $this->usernew_mid_model->add_download_config($channelid, $channelname, $channeldiscrible, $gamename, $gameid, $downloadurl, $version,$versionstr,$size,$md5,$packagename, $updateversion, $updatetype, $updatecontent);
        }
        echo "save ok";
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
        
           $gamecodehuang = $this->config->item('gamecodeforchoose');
           $channellisthuang = $this->config->item('channellist');
        
           if($usernamezz  == "huangwei") 
           {
            $gamecodehuang = array_merge_recursive($this->config->item('gamecodehuang'),$this->config->item('gamecode'));
            $channellisthuang = array_merge_recursive($this->config->item('channellisthuang'),$this->config->item('channellist'));
           }
            
           $usernamezz = $_COOKIE['SMC_NO3_YG'];
           $data =array(
               "systemconfig" => $this->configs->get_navmenu(),
               "menucheck" => $menucheck,
               "message" =>array("username"=> $usernamezz,"mail"=>"aaa"),
               "gamelist" => $gamecodehuang,
               "choose" => array("father"=>"运营管理","child"=>"斗地主升级策略管理"),
               "header1" => array("father"=>"运营管理","child"=>"斗地主升级策略管理"),
               "header2" => array("father"=>"斗地主升级策略管理","child"=>"实施斗地主升级策略 "),
               "header3" => array("father"=>"斗地主升级策略管理后台创建于2014年12月26日","child"=>" 游戏运营从2015年1月1日开始 (v1.0) "),
          );
           $this->load->view('no3/gameddzuploadview',$data);
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
