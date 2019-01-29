<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Report_test extends CI_Controller {
	var $base_url = 'http://13.124.100.60:8080/';
	var $dev_base_url = 'http://background.yuming.com/';
	var $ALL_CHANNEL_ID = 10000;
	var $VERIFY_KEY = 'c8c750eaca30fa1cc1d79eeccbe0b013';
	
	var $ip_allow_ary = array (
			'127.0.0.1',
	);
	var $user_array = array (
			array (
					'username' => 'coffee',
					'password' => 'coffee123cc',
					'priv' => 'all' 
			),
			array (
					'username' => 'test',
					'password' => 'test',
					'priv' => 'total1|total3|total4|total15|total17|total19|total18|total31' 
			),
			array (
					'username' => 'aoinjj',
					'password' => 'xvohnjdshn',
					'priv' => 'total1|total3|total4|total15|total17|total19|total18|total31' 
			),
			array (
					'username' => 'bobo',
					'password' => 'bobo123yc',
					'priv' => 'total1|total3|total4|total15|total17|total19|total18|total31' 
			) 
	);
	
	var $agents = array(
		'my' => array(
			'channels' => array(
				72 => '快乐赢三张Ios(小宇)',
				1072 => '快乐赢三张Android(小宇)',
				77 => '奇遇电玩城Ios',
				1077 => '奇遇电玩城Android',
				79 => '捕鱼旺旺旺Ios',
				1079 => '捕鱼旺旺旺Android',
				80 => '我要扎金花Ios',
				1080 => '我要扎金花Android',
				81 => '乐乐电玩城Ios',
				1081 => '乐乐电玩城Android',
				71 => '嘟嘟炸金花Ios',
				73 => '德扑世界Ios',
				74 => '世伽电玩城Ios',
				89 => '风云棋牌Ios',
				1089 => '风云棋牌Android',
				20003 => '肥猫扎金花iOS',
				21003 => '肥猫扎金花Android',
				60 => '经典斗地主2Ios(上海关哥)',
				1060 => '经典斗地主2Android(上海关哥)',
				67 => '德扑之王Ios(上海关哥)',
				1067 => '德扑之王Android(上海关哥)' ,
				76 => '义豪炸金花Ios(上海关哥)',
				1076 => '义豪炸金花Android(上海关哥)',
				20002 => '辉辉斗地主iOS(上海关哥)',
				21002 => '辉辉斗地主Android(上海关哥)',
				1083 => '葡金电玩城Android(小宇)',
				11032 => '欲望城市Android(小宇)',
				11045 => '全民疯狂玩地主Android(小宇)',
				11044 => '真人玩金花Android(小宇)',
				11006 => '布布玩金花Android(小宇)',
			),
			
			'view' => 'report/report2_views'
		),

		'xiaoxi' => array(
			'channels' => array(
				49=>'全民玩德扑Ios',
				1049=>'全民玩德扑Android',
				54 => '月月电玩城Ios',
				1054 => '月月电玩城Android'
			),
			
			'view' => 'report/report5_views'
		),
			
		'guange' => array(
			'channels' => array(
				60 => '经典斗地主2Ios(上海关哥)',
				1060 => '经典斗地主2Android(上海关哥)',
				67 => '德扑之王Ios(上海关哥)',
				1067 => '德扑之王Android(上海关哥)' ,
				76 => '义豪炸金花Ios(上海关哥)',
				1076 => '义豪炸金花Android(上海关哥)',
				20002 => '辉辉斗地主iOS(上海关哥)',
				21002 => '辉辉斗地主Android(上海关哥)',
			),
			
			'view' => 'report/report4_views'
		),

		'bossZhou' => array(
			'channels' => array(
				20017 =>	'汇发斗地主iOS',
				21017 =>	'汇发斗地主Android',
				20024 =>	'牛牛斗地主iOS',
				21024 =>	'牛牛斗地主Android',
				20021 =>	'捕鱼小司机iOS',
				21021 =>	'捕鱼小司机Android',
				210021 =>	'捕鱼小司机Android2',
				91001	 =>	'胖胖炸金花Android',
				91002	 =>	'王者斗地主Android',
				91003	 =>	'八哥电玩城Android',
				91004	 =>	'飞天捕鱼Android',
				91005	 =>	'瓜瓜斗地主Android',
			),
			
			'view' => 'report/report3_views'
		),
	);

	
	var $DEV_MODE = true;

	public function __construct() {
		parent::__construct ();
		exit("error");
		$this->load->model ( 'agent_model_test' );
		if ($this->DEV_MODE && in_array ( $this->getIp(), $this->ip_allow_ary ))
		{
			$this->base_url = $this->dev_base_url;
			return;
		}
		$data['errMsg'] = "非法访问";
		echo $this->load->view ( 'report/error_view', $data, true);
		exit();
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

	public function xciwhinsdfiofnsdkfn() {
		$data ['base_url'] = $this->base_url;
		$this->load->view ( 'report/lock_views', $data );
	}
	public function toLogin() {
		$data ['base_url'] = $this->base_url;
		$this->load->view ( 'report/login_views', $data );
	}
	public function login() {
		$return_ary = array ();
		$username = trim ( $this->input->post ( 'username', true ) );
		$password = trim ( $this->input->post ( 'pass', true ) );
		
		if ($username == '' || $password == '') {
			$return ['msg'] = '请填写帐号密码';
			$return ['status'] = '0';
			exit ( json_encode ( $return ) );
		}
		
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && $v ['password'] == $password) {
				$return ['msg'] = '登录成功';
				$return ['status'] = '1';
				$return ['username'] = $v ['username'];
				$return ['password'] = md5 ( $v ['password'] );
				
				$this->writeLog('Login success, username: ' . $username);
				exit ( json_encode ( $return ) );
			}
		}
		
		$return ['msg'] = '帐号密码错误';
		$return ['status'] = '0';
		$this->writeLog('Login failed, username: ' . $username . ', password: ' . $password);
		exit ( json_encode ( $return ) );
	}
	
	/**
	 * 获取某个渠道、key对应的值
	 */
	private function getValueByDateChannelKey($time, $channelId, $key)
	{
		$result = "";

		$dir = "/log/report_log/$time";
		$myfilename = "$channelId-$key.log";
		if (1==2&&file_exists ( $dir . '/' . $myfilename )) {
			$result = file_get_contents ( $dir . '/' . $myfilename, LOCK_EX );
		} else {
			$result = $this->agent_model_test->get_total_static ( $time, $key, $channelId );
			if (! is_dir ( $dir )) {
				mkdir ( $dir );
			}
			$today = date ( 'Y-m-d' );
			if (date ( 'Y-m-d', strtotime ( $time . ' 00:00:00' ) ) != $today && date ( 'H' ) != '00') {
				file_put_contents ( $dir . '/' . $myfilename, $result, LOCK_EX );
			}
		}
		
		return $result;
	}

	/**
	 * 获取上个月的数据
	 * @param unknown_type $channelId
	 * @param unknown_type $key
	 * @return string
	 */
	private function getValueOfLastMonth($channelId, $key)
	{
		$result = "";

		$last_month = "";
		$cur_month = "";
		$time = date ( 'Y-m-d' );
		$this->agent_model_test->getLastCurMonth($time, $last_month, $cur_month);
		

		$dir = "/log/report_log/$last_month";
		$myfilename = "$channelId-$key.log";
		if (file_exists ( $dir . '/' . $myfilename )) {
			$result = file_get_contents ( $dir . '/' . $myfilename, LOCK_EX );
		} else {
			$result = $this->agent_model_test->get_total_static ( $time, $key . '_last_month', $channelId );
			if (! is_dir ( $dir )) {
				mkdir ( $dir );
			}
			if (date ( 'd' ) != '01') {
				file_put_contents ( $dir . '/' . $myfilename, $result, LOCK_EX );
			}
		}
		
		return $result;
	}

	public function tongji() {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		$is_valid = false;
		$data ['priv'] = '';
		//exit(md5 ( $password ));
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
				$data ['priv'] = $v ['priv'];
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		
		$priv_ary = explode ( '|', $data ['priv'] );
		
		$return_ary = array ();
		$data ['time'] = array ();
		$data ['field_list'] = array ();
		$data ['channel_list'] = array ();
		$channel_list_config = $this->config->item ( 'channellist' );
		$report_field_config_tmp = json_decode ( $this->config->item ( 'report_field' ), true );
		if ($data ['priv'] == 'all') {
			$report_field_config = $report_field_config_tmp;
		} else {
			$report_field_config = array ();
			foreach ( $report_field_config_tmp as $k => $v ) {
				if (in_array ( $v ['key'], $priv_ary )) {
					array_push ( $report_field_config, $v );
				}
			}
		}
		
		$report_field = array ();
		$field_priv = array ();
		foreach ( $report_field_config as $rf ) {
			if ($rf ['key'] == 'total17') {
				array_unshift ( $data ['field_list'], $rf ['value'] );
				array_unshift ( $field_priv, $rf ['key'] );
			} else {
				array_push ( $data ['field_list'], $rf ['value'] );
				array_push ( $field_priv, $rf ['key'] );
			}
		}
		
		$channel_list = array ();
		foreach ( $channel_list_config as $kk => $cc ) {
			if (in_array ( $kk, $this->my_channel_list )) {
				array_unshift ( $channel_list, $kk );
			} else {
				array_push ( $channel_list, $kk );
			}
		}
		
		if (empty ( $channel_list ) || empty ( $field_priv )) {
			exit ( 'no priv' );
		}
		
		$channel_id = $this->input->get ( 'channel_id' ) ? intval ( $this->input->get ( 'channel_id', true ) ) : $this->ALL_CHANNEL_ID;
		
		foreach ( $channel_list as $c ) {
			$data ['channel_list'] [$c] = $channel_list_config [$c];
		}
		
		$now = time ();
		$start_time = $now - 6 * 3600 * 24;
		$end_time = $now;
		// 计算每天
		for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
			$time = date ( 'Y-m-d', $i );
			
			$report_data = array ();
			$num = 0;
			foreach ( $field_priv as $t ) {
				$report_data [$t] = $this->getValueByDateChannelKey($time, $channel_id, $t);
			}
			$return_ary [$time] = $report_data;
			array_push ( $data ['time'], $time );
		}
		
		// 计算上月
		$time1 = date ( 'Y-m-d' );
		$data ['last_month_total_data'] = array ();
		foreach ( $field_priv as $t ) {
			$data ['last_month_total_data'][$t] = $this->getValueOfLastMonth($channel_id, $t);
		}
		
		// 当月累计
		$data ['cur_month_total_data'] = array ();
		foreach ( $field_priv as $t ) {
			$data ['cur_month_total_data'][$t] = $this->agent_model_test->get_total_static ( $time1, $t . '_cur_month', $channel_id );
		}
		
		$data ['report_data'] = $return_ary;
		$data ['channel_id'] = $channel_id;
		$data ['username'] = $username;
		$data ['password'] = $password;
		foreach ( $nochannellist as $k => $v ) {
			unset ( $data ['channel_list'] [$k] );
		}
		$this->load->view ( 'report/report1_views', $data );
	}

	// 某个代理的统计结果
	private function specAgentList($agentName)
	{
		if (!key_exists($agentName, $this->agents))
		{
			exit ( '不存在的页面!' );
		}

		$channelList = $this->agents[$agentName]['channels'];
		$viewName = $this->agents[$agentName]['view'];
		
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
				$data ['priv'] = $v ['priv'];
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		
		$priv_ary = explode ( '|', $data ['priv'] );
		
		$return_ary = array ();
		$data ['time'] = array ();
		$data ['field_list'] = array ();
		$data ['channel_list'] = array ();
		$report_field_config = json_decode ( $this->config->item ( 'report_field' ), true );
		
		$report_field = array ();
		$field_priv = array ();
		foreach ( $report_field_config as $rf ) {
			if ($rf ['key'] == 'total17') {
				array_unshift ( $data ['field_list'], $rf ['value'] );
				array_unshift ( $field_priv, $rf ['key'] );
			} else {
				array_push ( $data ['field_list'], $rf ['value'] );
				array_push ( $field_priv, $rf ['key'] );
			}
		}
		
		$channel_list = array ();
		foreach ( $channelList as $kk => $cc ) {
			array_push ( $channel_list, $kk );
		}
		
		if (empty ( $channel_list ) || empty ( $field_priv )) {
			exit ( 'no priv' );
		}
		
		$channel_id = $this->input->get ( 'channel_id' ) ? intval ( $this->input->get ( 'channel_id', true ) ) : $this->ALL_CHANNEL_ID;
		
		foreach ( $channel_list as $c ) {
			$data ['channel_list'] [$c] = $channelList [$c];
		}
		
		$now = time ();
		$start_time = $now - 6 * 3600 * 24;
		$end_time = $now;
		// 计算每天
		for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
			$time = date ( 'Y-m-d', $i );
			
			$report_data = array ();
			foreach ( $field_priv as $t ) {
				// 如果要查看全部，则直接使用数据库查询
				if ($channel_id == $this->ALL_CHANNEL_ID)
				{
					$report_data [$t] = $this->agent_model_test->get_total_static ( $time, $t, $channel_id, $channel_list );
				}
				else 
				{
					$report_data [$t] = $this->getValueByDateChannelKey($time, $channel_id, $t);
				}
			}
			$return_ary [$time] = $report_data;
			array_push ( $data ['time'], $time );
		}
		
		// 计算上月
		$time = date ( 'Y-m-d' );
		$data ['last_month_total_data'] = array ();
		foreach ( $field_priv as $t ) {
			// 如果要查看全部，则直接使用数据库查询
			if ($channel_id == $this->ALL_CHANNEL_ID)
			{
				$data ['last_month_total_data'][$t] = $this->agent_model_test->get_total_static ( $time, $t . '_last_month', $channel_id, $channel_list );
			}
			else 
			{
				$data ['last_month_total_data'][$t] = $this->getValueOfLastMonth($channel_id, $t);
			}
		}
		
		// 当月累计
		$data ['cur_month_total_data'] = array ();
		foreach ( $field_priv as $t ) {
			$data ['cur_month_total_data'] [$t] = $this->agent_model_test->get_total_static ( $time, $t . '_cur_month', $channel_id, $channel_list);
		}
		
		$data ['report_data'] = $return_ary;
		$data ['channel_id'] = $channel_id;
		$data ['username'] = $username;
		$data ['password'] = $password;
		$this->load->view ( $viewName, $data );
	}

	public function myTongjiList() {
		$this->specAgentList('my');
	}
	
	public function xiaoxiTongjiList() {
		$this->specAgentList('xiaoxi');
	}

	public function guangeTongjiList() {
		$this->specAgentList('guange');
	}
	
	public function bossZhouTongjiList()
	{
		$this->specAgentList('bossZhou');
	}
	
	public function bossZhouReport()
	{
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		
		$data ['fin_list'] = $this->agent_model_test->getMyChannelTotal ( $query ['start_date'], $query ['end_date'], $this->agents['bossZhou']['channels'] );
		
		foreach ( $data ['fin_list'] as $k => $v ) {
			$pay [$k] = $v ['total_pay'];
		}
		array_multisort ( $pay, SORT_DESC, $data ['fin_list'] );
		$this->load->view ( 'report/my_channel_tongji_views', $data );
	}

	public function channelReport() {
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		
		$data ['fin_list'] = $this->agent_model_test->getTotal ( $query ['start_date'], $query ['end_date'] );
		$data ['total'] = $data ['fin_list'] ['全部'];
		unset ( $data ['fin_list'] ['全部'] );
		
		foreach ( $data ['fin_list'] as $k => $v ) {
			$pay [$k] = $v ['total_pay'];
		}
		array_multisort ( $pay, SORT_DESC, $data ['fin_list'] );
		$this->load->view ( 'report/channel_tongji_views', $data );
	}
	public function myChannelReport() {
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d' );
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		
		$data ['fin_list'] = $this->agent_model_test->getMyChannelTotal ( $query ['start_date'], $query ['end_date'], $this->agents['my']['channels'] );
		// $data ['total'] = $data ['fin_list'] ['全部'];
		// unset ( $data ['fin_list'] ['全部'] );
		
		foreach ( $data ['fin_list'] as $k => $v ) {
			$pay [$k] = $v ['total_pay'];
		}
		array_multisort ( $pay, SORT_DESC, $data ['fin_list'] );
		$this->load->view ( 'report/my_channel_tongji_views', $data );
	}
	public function rechargeReport() {
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		$query ['channel_id'] = $this->input->get ( 'channel_id', true ) ? intval ( $this->input->get ( 'channel_id', true ) ) : 0;
		$data ['report_data'] = $this->agent_model_test->getOrderStatistics ( $query ['channel_id'], date ( 'Ymd' ) );
		$this->load->view ( 'report/recharge_tongji_views', $data );
	}
	public function rechargePlatform() {
		$this->load->model ( 'dindan_model' );
		$data ['base_url'] = $this->base_url;
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		$data ['report_data'] = $this->agent_model_test->getPayStatics ( date ( 'Y-m-d' ), date ( 'Y-m-d' ) );
		$data ['pay_list'] = $this->dindan_model->getPayList ();
		$this->load->view ( 'report/recharge_platform_tongji_views', $data );
	}
	public function onlineReport() {
		$username = trim ( $this->input->get ( 'username', true ) );
		$password = trim ( $this->input->get ( 'password', true ) );
		
		if ($username != 'coffee') {
			exit ( '非法操作!' );
		}
		
		$is_valid = false;
		$data ['priv'] = '';
		foreach ( $this->user_array as $k => $v ) {
			if ($v ['username'] == $username && md5 ( $v ['password'] ) == $password) {
				$is_valid = true;
			}
		}
		
		if (! $is_valid) {
			exit ( '非法操作!' );
		}
		$data ['online_report'] = array ();
		$data ['total'] = array ();
		$data ['total_all'] = 0;
		$game_code = array (
				18 => '牛牛',
				20 => '抢庄牛牛',
				49 => '三张牌',
				52 => '三张牌百人',
				97 => '经典斗地主',
				98 => '欢乐斗地主',
				101 => '癞子斗地主',
				193 => '捕鱼' 
		);
		$gametypex = array (
				0 => "新手场",
				1 => "初级场",
				2 => "中级场",
				3 => "高级场",
				4 => "vip场",
				6 => "新手场",
				7 => "初级场",
				8 => "中级场",
				9 => "高级场",
				100 => "百人场1",
				101 => "百人场2" 
		);
		$data ['base_url'] = $this->base_url;
		$romid = '0';
		require_once (APPPATH . 'third_party/message/pb_message.php');
		$this->_require ( 'pb_proto_onlinedata' );
		$portarray = array (
				"0" => array (
						DDZ_SERVER_IP => DDZ_SERVER_PORT,
						ZJH_SERVER_IP => ZJH_SERVER_PORT,
						NIUNIU_SERVER_IP => NIUNIU_SERVER_PORT,
						FISH_SERVER_IP => FISH_SERVER_PORT 
				) 
		);
		
		$query = new Onlinedata_GameStatus ();
		$query->set_gameType ( $romid );
		$buf = $query->SerializeToString ();
		
		$rrt = array ();
		foreach ( $portarray [$romid] as $key => $value ) {
			$ip = $key;
			$ret = $this->_request_midlayer_res1 ( $buf, 20159, $ip, $value );
			$rsp = new Onlinedata_OnlineGameStatusReport ();
			$rsp->ParseFromString ( $ret );
			$gamecount = $rsp->gameStatus_size ();
			// echo 'gamecount='.$gamecount."\n";
			for($gamecountx = 0; $gamecountx < $gamecount; $gamecountx ++) {
				$item = $rsp->gameStatus ( $gamecountx );
				$roomcount = $item->roomStatus_size ();
				$gameid = $item->gameType ();
				for($roomcountx = 0; $roomcountx < $roomcount; $roomcountx ++) {
					$roomitem = $item->roomStatus ( $roomcountx );
					$data ['online_report'] [$game_code [$gameid]] [$gametypex [$roomitem->roomID ()]] = $roomitem->onlineUserCount ();
					if (isset ( $data ['total'] [$game_code [$gameid]] )) {
						$data ['total'] [$game_code [$gameid]] += $roomitem->onlineUserCount ();
					} else {
						$data ['total'] [$game_code [$gameid]] = $roomitem->onlineUserCount ();
					}
					
					$data ['total_all'] += $roomitem->onlineUserCount ();
					// $rrt [$gameid] ["no" . $roomitem->roomID ()] [$ip . ":" .
					// $value] = $roomitem->onlineUserCount ();
				}
			}
		}
		$this->load->view ( 'report/online_report_views', $data );
	}
	public function _request_midlayer_res1($buf, $command, $host, $port) {
		// require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
		$this->_require ( 'pb_proto_pbclientgameserver' );
		$pack = new Packet ();
		$pack->set_version ( 0 );
		$pack->set_command ( $command );
		$pack->set_connectionid ( "99" );
		$pack->set_serialized ( $buf );
		$buf_pack = $pack->SerializeToString ();
		
		$buf_length = sprintf ( '%08x', strlen ( $buf_pack ) );
		$buf_length = $this->_ntohl ( $buf_length );
		
		$request_stream = pack ( 'H*', $buf_length ) . $buf_pack;
		
		$socket = socket_create ( AF_INET, SOCK_STREAM, SOL_TCP ) or die ( 'Could not create socket' );
		socket_set_option ( $socket, SOL_SOCKET, SO_RCVTIMEO, array (
				'sec' => 20,
				'usec' => 0 
		) );
		socket_set_option ( $socket, SOL_SOCKET, SO_SNDTIMEO, array (
				'sec' => 20,
				'usec' => 0 
		) );
		
		$conn = socket_connect ( $socket, $host, $port );
		
		if (! $conn) {
			exit ( "socket connect error" );
			return false;
		}
		$res = socket_write ( $socket, $request_stream );
		if (! $res) {
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ( $errorcode );
			
			die ( "Couldn't create socket: [$errorcode] $errormsg" );
		}
		
		if (! $conn) {
			exit ( 'connet fail' );
			return false;
		}
		
		$read_length = socket_read ( $socket, 4 );
		
		if (strlen ( $read_length ) <= 0) {
			$errorcode = socket_last_error ();
			$errormsg = socket_strerror ( $errorcode );
			// echo $errorcode ,"---",$errormsg,"---",'no response';
			
			return false;
		}
		
		$read_length = unpack ( 'H*', $read_length );
		$read_length = $read_length [1];
		$buf_length = base_convert ( $this->_ntohl ( $read_length ), 16, 10 );
		$response_stream = socket_read ( $socket, $buf_length );
		
		$response_pack = new Packet ();
		$response_pack->ParseFromString ( $response_stream );
		// print_r($response_pack);
		$ret = $response_pack->serialized ();
		socket_close ( $socket );
		
		return $ret;
	}
	private function _ntohl($n) {
		$ret = substr ( $n, 6, 2 ) . substr ( $n, 4, 2 ) . substr ( $n, 2, 2 ) . substr ( $n, 0, 2 );
		return $ret;
	}
	protected function _require($filename) {
		// echo APPPATH . "third_party/proto/$filename.php";
		require_once (APPPATH . "third_party/proto/$filename.php");
	}
	
	public function writeLog($txt) {
		$log_file = "/log/report_test.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
	
}
