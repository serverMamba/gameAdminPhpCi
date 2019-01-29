<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Reportcs extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'amdin_list_manage' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Admin_model' );
	}
	public function get_his_data() {
		$this->load->model ( 'cs_mid_model' );
		$gameid = $this->input->get_post ( 'gameid' );
		$mytime = $this->input->get_post ( 'mytime' );
		$res = $this->his_mid_model->get_hismsg ( $gameid, $mytime );
		echo json_encode ( $res );
	}
	public function allbroke() {
		$query_date = $this->input->get_post ( 'time' );
		
		if (empty ( $query_date )) {
			$query_date = date ( 'Y-m-d' );
			// $query_date = date('Y-m-d', strtotime('-1 day'));
		}
		
		$this->load->model ( 'pay_model' );
		
		$gamepay = $this->pay_model->get_gamepay_by_date ( $query_date );
		
		$this->load->model ( 'history_model' );
		
		$strdate = str_replace ( '-', '', $query_date );
		// $ret = $this->history_model->get_broke_by_date_and_game($strdate);
		
		$ret = array ();
		
		$retx = $this->history_model->get_broke_all ( $query_date );
		foreach ( $retx as $key => $value ) {
			$item_id = $value ["item_id"];
			$service_fee = $value ["service_fee"];
			$ret [$item_id] = $service_fee;
		}
		
		/*
		 * $retxTexasPoker =
		 * $this->history_model->get_broke_TexasPoker($strdate);
		 * $retxNiuNiuQiangZhuang =
		 * $this->history_model->get_broke_NiuNiuQiangZhuang($strdate) ;
		 * $retxZJH = $this->history_model->get_broke_ZJH($strdate) ; $retxDDZ =
		 * $this->history_model->get_broke_DDZ($strdate) ; $retxGUANDAN =
		 * $this->history_model->get_broke_GUANDAN($strdate) ; $retxMJ2P =
		 * $this->history_model->get_broke_MJ2P($strdate) ; $retxMJ =
		 * $this->history_model->get_broke_MJ($strdate) ;
		 * $retxCASINOROULETTEHISTORY =
		 * $this->history_model->get_broke_CASINOROULETTEHISTORY($strdate) ;
		 * $retxCASINOROULETTEHISTORY1 =
		 * $this->history_model->get_broke_CASINOROULETTEHISTORY1($strdate) ;
		 * $retxCASINOROULETTEHISTORY3 =
		 * $this->history_model->get_broke_CASINOROULETTEHISTORY3($strdate) ;
		 * $retxCASINOROULETTEHISTORY4 =
		 * $this->history_model->get_broke_CASINOROULETTEHISTORY4($strdate) ;
		 * $ret["0"] = $retxTexasPoker; $ret["1"] = $retxNiuNiuQiangZhuang;
		 * $ret["2"] = '百家乐'; $ret["3"] = $retxZJH; $ret["4"] = '水果机'; $ret["5"]
		 * = '大转轮'; $ret["6"] = $retxDDZ; $ret["7"] = '梭哈'; $ret["8"] =
		 * $retxGUANDAN; $ret["9"] = '21点'; $ret["10"] = '抢庄牛牛'; $ret["11"] =
		 * '十三张'; $ret["12"] = "扑鱼OL"; $ret["13"] = "扑鱼在线"; $ret["14"] =
		 * $retxMJ2P; $ret["15"] = "kLKPY(15)"; $ret["16"] = "teenpatti(16)";
		 * $ret["17"] = "Oker(17)" ; $ret["18"] = $retxMJ ; $ret["19"] =
		 * "Oker(19)";
		 */
        
        /*
        $other = array();
        
        $adwall_total = $this->history_model->get_adwall_total($strdate);
        $other['广告墙'] = $adwall_total;

        $roulette_total = $this->history_model->get_roulette_total($strdate);
        $other['转盘净分'] = abs($roulette_total);
        
        $roulette_total1 = $this->history_model->get_roulette_total1($strdate);
        $other['转盘赢金豆'] = $roulette_total1;
        
        $roulette_total2 = $this->history_model->get_roulette_total2($strdate);
        $other['转盘赢兑奖劵'] = $roulette_total2;
        
        $tiger_total = $this->history_model->get_tiger_total($strdate);
        $other['老虎机净分'] = $tiger_total;
        
        $tiger_total = $this->history_model->get_choushui_total($strdate);
        $other['总净分'] = $tiger_total;
        
        $tiger_total = $this->history_model->get_fafang_total($strdate);
        $other['总发放'] = $tiger_total;
         */
        
        $data = array (
				'ret' => $ret,
				// 'other' => $other,
				'gamepay' => $gamepay 
		);
		
		echo json_encode ( $data );
	}
	public function index() {
		$data = array (
				"gamelist" => $this->config->item ( 'gamelist' ),
				"choose" => array (
						"father" => "运营报表",
						"child" => "净分分析" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "净分分析" 
				),
				"header2" => array (
						"father" => "净分分析",
						"child" => "用直方图的方式表达净分" 
				),
				"header3" => array (
						"father" => "净分分析后台创建于2014年6月20日",
						"child" => " 游戏运营从2014年6月25日开始 (v1.0) " 
				) 
		);
		$this->load->view ( 'no3/reportcsview', $data );
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
