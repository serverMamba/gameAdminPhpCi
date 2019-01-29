<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class taskmgr extends CI_Controller {
	//微派
	private $df_url_weipay = "http://dkapi.wiipay.cn/transfer/transfer.do";
	private $appcode = '1xxxxxxxx';
	private $appid_weipay = "0xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";//d2716d66eea30bc9636edda3dba99409
	private $key_weipay = "0xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx";
	
	//汇亿
	private $huiyi_appid = '1xxxxxxx';
	private $huiyi_key = '0xxxxxxxxxxxxxxxxxxxxxxxxxxxxx';
	private $huiyi_df_url = 'http://umipayment.com/agentPay';
	private $huiyi_df_notify = 'http://webapi.yuming.com/task/dfhuiyi/notify';
	
	//蓉银
	private $rongyin_merchantId = 'rxxxxxxxxx'; // 正式
	private $rongyin_apiKey = '0xxxxxxxxxxxxxxxxxxxxxxxxxxxx'; // 正式
	private $rongyin_dfUri = 'http://39.108.210.127/jczf/public/index.php/yimei/pay/paidpay'; // 提交地址，格式
	private $rongyin_df_notify = 'http://webapi.yuming.com/task/dfrongyin/notify';
	
	//派支付
	private $paipay_appid = '1xxxxxxxxxxx';
	private $paipay_merchant_private_key='-----BEGIN PRIVATE KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
-----END PRIVATE KEY-----';
	private $paipay_merchant_public_key = '-----BEGIN PUBLIC KEY-----
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOG4HKWdQS
-----END PUBLIC KEY-----';
	private $paipay_df_url="https://transfer.yourton.net/transfer";//"https://transfer.vc-pai.com/transfer";
	
	var $pay_platform_list = array ();
	
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin () || ! $this->session->userdata ( 'admin_name' )) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'cwgl_task' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'task/cus_task_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->pay_platform_list = $this->config->item ( 'alipay_pay' ) + $this->config->item ( 'wx_pay' ) + $this->config->item ( 'official_alipay_pay' );
	}
	public function index() {
		$query ['card_id'] = $this->input->get ( 'card_id', true ) ? intval ( $this->input->get ( 'card_id', true ) ) : 0;
		$query ['amount'] = $this->input->get ( 'amount', true ) ? $this->input->get ( 'amount', true ) : '';
		$query ['notify_cardholder'] = $this->input->get ( 'notify_cardholder', true ) ? intval ( $this->input->get ( 'notify_cardholder', true ) ) : '';
		$query ['out_trade_no'] = $this->input->get ( 'out_trade_no', true ) ? intval ( $this->input->get ( 'out_trade_no', true ) ) : '';
		$query ['res_code'] = $this->input->get ( 'res_code', true ) ? $this->input->get ( 'res_code', true ) : '';
		$query ['adduser'] = $this->input->get ( 'adduser', true ) ? $this->input->get ( 'adduser', true ) : '';
		$query ['bankcard_no'] = $this->input->get ( 'bankcard_no', true ) ? intval ( $this->input->get ( 'bankcard_no', true ) ) : '';
		$query ['bank_branch'] = $this->input->get ( 'bank_branch', true ) ? $this->input->get ( 'bank_branch', true ) : '';
		$query ['cardholder_name'] = $this->input->get ( 'cardholder_name', true ) ? $this->input->get ( 'cardholder_name', true ) : '';
		$query ['cardholder_mobile'] = $this->input->get ( 'cardholder_mobile', true ) ? $this->input->get ( 'cardholder_mobile', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ) );
		$query ['pay_platform'] = $this->input->get ( 'pay_platform', true ) ? $this->input->get ( 'pay_platform', true ) : "";
		$add_user = $this->session->userdata ( 'admin_name' );
		$this->doUpdatePaiOrdersStatus();
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "财务管理",
						"child" => "代付订单管理" 
				),
				"header1" => array (
						"father" => "财务管理",
						"child" => "代付订单管理" 
				),
				'cash_order_list' => $this->cus_task_model->getTaskList ( $query ['card_id'], $query ['amount'], $query ['notify_cardholder'], $query ['out_trade_no'], $query ['res_code'], $query ['adduser'],$query ['pay_platform'], $query ['start_time'], $query ['end_time'], $per, $start ),
				'states' => $this->taskStateArr (),
				'query' => $query,
				'pay_platform_list'=> $this->pay_platform_list, 
		);
		$data ['total_rows'] = $this->cus_task_model->getTaskNum ( $query ['card_id'], $query ['amount'], $query ['notify_cardholder'], $query ['out_trade_no'], $query ['res_code'], $query ['adduser'],$query ['pay_platform'], $query ['start_time'], $query ['end_time'] );
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'task/taskmgr/index' ) . '?card_id=' . $query ['card_id'] . '&amount=' . $query ['amount'] . '&notify_cardholder=' . $query ['notify_cardholder'] . '&out_trade_no=' . $query ['out_trade_no'] . '&res_code=' . $query ['res_code'] . '&adduser=' . $query ['adduser'] .'&pay_platform='.$query ['pay_platform']. '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		$this->load->view ( 'task/taskmgr_views', $data );
	}
	public function ajaxAddRongyinForm(){
		$this->writeLog('ajaxAddRongyinForm--------------------');
		$card_id = $this->input->post ( 'card_id' ) ? intval ( $this->input->post ( 'card_id' ) ) : 0;
		$amount = $this->input->post ( 'amount' ) ? intval ( $this->input->post ( 'amount' ) ) : 0;
		
		$return_ary = array (
				'status' => '0',
				'msg' => ''
		);
		
		if ($amount <= 0) {
			$return_ary ['msg'] = '金额error！';
			exit ( json_encode ( $return_ary ) );
		}
		if ($card_id <= 0) {
			$return_ary ['msg'] = '账户ID不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		$this->load->model ( 'task/cus_card_model' );
		$cardInfo = $this->cus_card_model->getCardInfo ( $card_id );
		if (empty ( $cardInfo )) {
			$return_ary ['msg'] = '服务器错误： 获取账户详情失败！';
			exit ( json_encode ( $return_ary ) );
		}
		$bankcard_no = $cardInfo ['bankcard_no'];
		$cardholder_name = $cardInfo ['cardholder_name'];
		$bank_branch = $cardInfo ['bank_branch'];
		
		$out_trade_no = $this->getOrderSn ( $_SESSION ['smc_id'] );
		$adduser = $_SESSION ['smc_admin_name'];
		
		$post_data = array (
				"realname" => $cardholder_name,
				"cardNo" => $bankcard_no,
				"code" => $this->rongyin_merchantId,
				"txAmount" => $amount*100,
				"outOrderNo" => $out_trade_no,
				"notifyUrl" => $this->rongyin_df_notify,
		);
		ksort ( $post_data );
		reset ( $post_data );
		$str = '';
		foreach ( $post_data as $key => $value ) {
			if ($value != '') {
				$str .= $key . '=' . $value . '&';
			}
		}
		$str .= 'key=' . $this->rongyin_apiKey;
		$post_data ['sign'] = strtoupper(md5 ( $str ));
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $this->rongyin_dfUri );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $post_data ) );
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		$this->writeLog($return.", ".mb_convert_encoding($return, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5'));
		$return_ary = json_decode ( $return, true );
		if (isset ( $return_ary ['code'] ) && $return_ary ['code'] == $this->rongyin_merchantId) {
			$data = array (
					'card_id' => $card_id,
					'adduser' => $adduser,
					'addtime' => date ( 'Y-m-d H:i:s', time () ),
					'amount' => $amount,
					'out_trade_no' => $out_trade_no,
					'bankcard_no' => $bankcard_no,
					'cardholder_name' => $cardholder_name,
					'bank_branch' => $bank_branch,
					'res_code' => $return_ary ['resultStatus'],
					'pay_platform' => PAY_PLATFORM_RONGYINPAY
			);
			if($this->cus_task_model->addTaskNew ( $data )){
				$return_ary['status'] = '1';
				$return_ary ['msg'] = $return_ary['reMsg'];
				exit ( json_encode ( $return_ary ) );
			}else{
				$return_ary['msg'] = '代付提交成功，但数据库写入失败，请联系管理员';
				exit ( json_encode ( $return_ary ) );
			}
		}else{
			$return_ary ['msg'] = $return_ary['reMsg'];
			exit ( json_encode ( $return_ary ) );
		}
	}
	public function ajaxAddTaskForm() {
		$this->writeLog('start');
		$card_id = $this->input->post ( 'card_id' ) ? intval ( $this->input->post ( 'card_id' ) ) : 0;
		$amount = $this->input->post ( 'amount' ) ? intval ( $this->input->post ( 'amount' ) ) : 0;
		$notify_cardholder = $this->input->post ( 'notify_cardholder' ) ? $this->input->post ( 'notify_cardholder' ) : 'y';
		
		$return_ary = array (
				'status' => '0',
				'msg' => '' 
		);
		
		if ($amount <= 0) {
			$return_ary ['msg'] = '金额error！';
			exit ( json_encode ( $return_ary ) );
		}
		if ($card_id <= 0) {
			$return_ary ['msg'] = '账户ID不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		$this->load->model ( 'task/cus_card_model' );
		$cardInfo = $this->cus_card_model->getCardInfo ( $card_id );
		if (empty ( $cardInfo )) {
			$return_ary ['msg'] = '服务器错误： 获取账户详情失败！';
			exit ( json_encode ( $return_ary ) );
		}
		$this->writeLog('111');
		$bankcard_no = $cardInfo ['bankcard_no'];
		$bank_branch = $cardInfo ['bank_branch'];
		$cardholder_name = $cardInfo ['cardholder_name'];
		$cardholder_mobile = $cardInfo ['cardholder_mobile'];
		
		$out_trade_no = $this->getOrderSn ( $_SESSION ['smc_id'] );
		$adduser = $_SESSION ['smc_admin_name'];
		
		$post_data = array (
				'version' => '2.0',
				'transfer_type' => 'bankcard',
				'amount' => $amount . '.00',
				'bankcard_no' => $bankcard_no,
				'bank_name' => $bank_branch,
				'bank_branch' => '',
				'cardholder_name' => $cardholder_name,
				'out_trade_no' => $out_trade_no,
				'appid' => $this->appid_weipay 
		);
		$this->writeLog('222 out_trade_no='.$out_trade_no);
		if ($notify_cardholder == 'y') {
			$post_data ['cardholder_mobile'] = $cardholder_mobile;
			$post_data ['notify_cardholder'] = 'y';
		} else {
			$post_data ['cardholder_mobile'] = '';
			$post_data ['notify_cardholder'] = 'n';
		}
		$post_data ['sign'] = $this->genSign ( $post_data );
		$this->writeLog('333=>'.json_encode($post_data));
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $this->df_url_weipay );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $post_data ) );
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		$this->writeLog($return.", ".mb_convert_encoding($return, 'UTF-8', 'UTF-8,GBK,GB2312,BIG5'));
		$return_ary = json_decode ( $return, true );
		if (isset ( $return_ary ['code'] ) && $return_ary ['code'] == 10000) {
			$data = array (
					'card_id' => $card_id,
					'adduser' => $adduser,
					'addtime' => date ( 'Y-m-d H:i:s', time () ),
					'amount' => $amount,
					'notify_cardholder' => $notify_cardholder,
					'out_trade_no' => $out_trade_no,
					'bankcard_no' => $bankcard_no,
					'bank_branch' => $bank_branch,
					'cardholder_name' => $cardholder_name,
					'cardholder_mobile' => $cardholder_mobile,
					'res_code' => $return_ary ['code'],
					'pay_platform' => PAY_PLATFORM_WEIPAY
			);
			if($this->cus_task_model->addTaskNew ( $data )){
				$return_ary['status'] = '1';
				exit ( json_encode ( $return_ary ) );
			}else{
				$return_ary['msg'] = '代付提交成功，但数据库写入失败，请联系管理员';
				exit ( json_encode ( $return_ary ) );
			}
		}else{
			$return_ary ['msg'] = $return_ary['message'];
			exit ( json_encode ( $return_ary ) );
		}
	}
	public function genSign($param, $sign) {
		$str_ary = array ();
		ksort ( $param );
		foreach ( $param as $k => $v ) {
			if ($v) {
				array_push ( $str_ary, $k . '=' . $v );
			}
		}
		return strtoupper ( md5 ( implode ( '&', $str_ary ) . $this->key_weipay ) );
	}
	public function getOrderSn($user_id) {
		$this->load->helper ( 'string' );
		
		$type = array (
				'alpha',
				'alnum',
				'numeric' 
		);
		
		$order_sn = random_string ( $type [array_rand ( $type )], 6 ) . time () . $user_id . random_string ( $type [array_rand ( $type )], 4 );
		return $order_sn;
	}
	public function taskStateArr() {
		$data = array (
				"0" => '待处理',
				"10000" => '打款成功',
				"10001" => '转账处理中',
				"10002" => '转账失败',
				"10003" => '转账取消',
				"10004" => '余额查询成功',
				"10005" => '查无此交易',
				"10101" => '单笔金额超出支付上限',
				"10102" => '总金额超出支付上限',
				"10103" => '余额不足',
				"10201" => '请求参数不正确',
				"10301" => 'sign 签名不正确',
				"10302" => 'key 值不存在或未开通',
				"10303" => 'appid 错误',
				"10304" => '打款记录已经存在',
				"10401" => '请求异常',
				"10500" => '未知错误',
		);
		return $data;
	}
	private function paipayStateMap(){
		$stateMap = array(
				"0" => '0',
				"0000"=>"10000",
				"0001"=>"10001",
				"0002"=>"10002",
				"0003"=>"10003",
				"0004"=>"10004",
				"1003"=>"10005",
				"1004"=>"10101",
				"1005"=>"10201",
				"1006"=>"10301",
				"1007"=>"10302",
				"1008"=>"10103",
				"1009"=>"10303",
				"2000"=>"10401",
				"9000"=>"10500",
				);
		return $stateMap;
	}
	public function taskInfo() {
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'task/taskmgr' );
		} else {
			$data = array (
					'menu' => $this->Common_model->getAdminMenuList (),
					"choose" => array (
							"father" => "财务管理",
							"child" => "代付订单管理" 
					),
					"header1" => array (
							"father" => "财务管理",
							"child" => "代付订单管理" 
					),
					"header2" => array (
							"father" => "代付订单管理",
							"child" => "代付订单详情 " 
					),
					'adduser' => $this->session->userdata ( 'admin_name' ),
					'notice' => $this->cus_task_model->getTaskInfo ( $id ) 
			);
			$this->load->view ( 'task/taskinfo_views', $data );
		}
	}
	public function writeLog($txt) {
		$log_file = "/log/taskmgr.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
	public function ajaxAddHuiyiForm(){
		$this->writeLog ( '[NOTIFY] POST: ' . json_encode ( $_POST ) );
		$this->writeLog ( '[NOTIFY] GET: ' . json_encode ( $_GET ) );
		$card_id = $this->input->post ( 'card_id' ) ? intval ( $this->input->post ( 'card_id' ) ) : 0;
		$amount = $this->input->post ( 'amount' ) ? intval ( $this->input->post ( 'amount' ) ) : 0;
		
		$return_ary = array (
				'status' => '0',
				'msg' => ''
		);
		
		if ($amount <= 0) {
			$return_ary ['msg'] = '金额error！';
			exit ( json_encode ( $return_ary ) );
		}
		if ($card_id <= 0) {
			$return_ary ['msg'] = '账户ID不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		$this->load->model ( 'task/cus_card_model' );
		$cardInfo = $this->cus_card_model->getCardInfo ( $card_id );
		if (empty ( $cardInfo )) {
			$return_ary ['msg'] = '服务器错误： 获取账户详情失败！';
			exit ( json_encode ( $return_ary ) );
		}
		$appid = $this->huiyi_appid;
		$mchorder_id = $this->getOrderSn ( $_SESSION ['smc_id'].$appid );
		$customer_name = $cardInfo ['cardholder_name'];
		$customer_type = $cardInfo ['customer_type'];
		$notify_url = $this->huiyi_df_notify;
		$account_type = $cardInfo ['account_type'];
		$card_number = $cardInfo ['bankcard_no'];
		$pay_password = $cardInfo ['pay_password'];
		$headquarters_bank_id = $cardInfo ['headquarters_bank_id'];
		$bank_name = $cardInfo ['bank_branch'];
		$issue_bank_id = $cardInfo ['issue_bank_id'];
		$adduser = $_SESSION ['smc_admin_name'];
		
		$data = array (
				'card_id' => $card_id,
				'adduser' => $adduser,
				'addtime' => date ( 'Y-m-d H:i:s', time () ),
				'amount' => $amount,
				'out_trade_no' => $mchorder_id,
				'bankcard_no' => $card_number,
				'bank_branch' => $bank_name,
				'cardholder_name' => $customer_name,
				'customer_type' => $customer_type,
				'account_type' => $account_type,
				'headquarters_bank_id' => $headquarters_bank_id,
				'issue_bank_id' => $issue_bank_id,
				'pay_platform' => PAY_PLATFORM_HUIYI
		);
		if(!$this->cus_task_model->addTaskNew ( $data )){
			$return_ary ['msg'] = '服务器错误，连接DB失败！';
			exit ( json_encode ( $return_ary ) );
		}
		$s_headquarters_bank_id = $headquarters_bank_id?"&headquarters_bank_id=$headquarters_bank_id":"";
		$s_issue_bank_id = $issue_bank_id?"&issue_bank_id=$issue_bank_id":"";
		if('04'!==$account_type){
			$s_headquarters_bank_id="";
			$s_issue_bank_id="";
		}
		$sign_params = "account_type=$account_type&amount=$amount&appid=$appid&bank_name=$bank_name&card_number=$card_number&customer_name=$customer_name&customer_type=$customer_type";
		$sign_params = $sign_params."$s_headquarters_bank_id$s_issue_bank_id&mchorder_id=$mchorder_id&notify_url=$notify_url";
		$this->writeLog ("sign_params=".$sign_params.$this->huiyi_key);
		$sign = strtolower ( md5 ($sign_params.$this->huiyi_key));
		$this->writeLog ("sign=".$sign);
		$bank_name = urlencode ( $bank_name);
		$customer_name = urlencode ( $customer_name);
		$notify_url = urlencode ( $notify_url);
		$sign_params = "account_type=$account_type&amount=$amount&appid=$appid&bank_name=$bank_name&card_number=$card_number&customer_name=$customer_name&customer_type=$customer_type";
		$sign_params = $sign_params."&headquarters_bank_id=$headquarters_bank_id&issue_bank_id=$issue_bank_id&mchorder_id=$mchorder_id&notify_url=$notify_url";
		$urlstr = $this->huiyi_df_url."?".$sign_params."&sign=".$sign;
		$this->writeLog ("urlstr=".$urlstr);
		
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $urlstr );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		$response = curl_exec ( $ch );
		curl_close ( $ch );
		$result = json_decode ( $response, true );
		$this->writeLog ( 'df huiyi response: ' . $response );
		$errorcode = $result['errorcode'];
		$errormsg = $result['errormsg'];
		$return_ary ['msg'] = $errormsg;
		exit ( json_encode ( $return_ary ) );
	}
	
	
	public function ajaxAddPaiForm(){
		$this->writeLog ( '[ajaxAddPaiForm] POST: ' . json_encode ( $_POST ) );
		$this->writeLog ( '[ajaxAddPaiForm] GET: ' . json_encode ( $_GET ) );
		$card_id = $this->input->post ( 'card_id' ) ? intval ( $this->input->post ( 'card_id' ) ) : 0;
		$amount = $this->input->post ( 'amount' ) ? intval ( $this->input->post ( 'amount' ) ) : 0;
		
		$recv_bank_code = $this->input->post ( 'bank_code' ) ? $this->input->post ( 'bank_code' ) : "";
		$recv_province = $this->input->post ( 'province_code' ) ? $this->input->post ( 'province_code' ) : "";
		$recv_city = $this->input->post ( 'city_code' ) ? $this->input->post ( 'city_code' ) : "";
		$recv_bank_code = str_replace( " ", "",$recv_bank_code);
		$recv_province = str_replace( " ", "",$recv_province);
		$recv_city = str_replace( " ", "",$recv_city);
		
		$return_ary = array (
				'status' => '0',
				'msg' => '提款失败'
		);
		
		if ($amount <= 0) {
			$return_ary ['msg'] = '金额error！';
			exit ( json_encode ( $return_ary ) );
		}
		if ($card_id <= 0) {
			$return_ary ['msg'] = '账户ID不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		if (!$recv_bank_code) {
			$return_ary ['msg'] = '银行代码不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		if (!$recv_province) {
			$return_ary ['msg'] = '省份代码不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		if (!$recv_city) {
			$return_ary ['msg'] = '城市代码不可空！';
			exit ( json_encode ( $return_ary ) );
		}
		
		$this->load->model ( 'task/cus_card_model' );
		$cardInfo = $this->cus_card_model->getCardInfo ( $card_id );
		if (empty ( $cardInfo )) {
			$return_ary ['msg'] = '服务器错误： 获取账户详情失败！';
			exit ( json_encode ( $return_ary ) );
		}
		$interface_version = "V3.1.0";
		$mer_transfer_no=$this->getOrderSn ( time() );
		$merchant_no=$this->paipay_appid;//商户号
		$tran_code="DMTI";
		$recv_accno=$cardInfo ['bankcard_no'];
		$recv_name=$cardInfo ['cardholder_name'];
		$tran_amount=$amount."";
		$tran_fee_type="1";//扣除手续费的方式：0：从转账金额中扣除 1：从账户余额中扣除
		$tran_type="0";//转账的方式（0：普通  1：加急）
		$remark="普通转账，从账户余额中扣除手续费";
		$sign_type="RSA-S";
		$adduser = $_SESSION ['smc_admin_name'];
		
		$dbdata = array (
				'card_id' => $card_id,
				'adduser' => $adduser,
				'addtime' => date ( 'Y-m-d H:i:s', time () ),
				'amount' => $amount,
				'out_trade_no' => $mer_transfer_no,
				'bankcard_no' => $cardInfo ['bankcard_no'],
				'bank_branch' => $cardInfo ['bank_branch'],
				'cardholder_name' => $cardInfo ['cardholder_name'],
				'customer_type' => $cardInfo ['customer_type'],
				'account_type' => $cardInfo ['account_type'],
				'headquarters_bank_id' => $cardInfo ['headquarters_bank_id'],
				'issue_bank_id' => $cardInfo ['issue_bank_id'],
				'pay_platform' => PAY_PLATFORM_PAIPAY
		);
		if(!$this->cus_task_model->addTaskNew ( $dbdata )){
			$return_ary ['msg'] = '服务器错误，连接DB失败！';
			exit ( json_encode ( $return_ary ) );
		}
		
		$signStr= "";
		$signStr = $signStr."interface_version=".$interface_version."&";
		$signStr = $signStr."mer_transfer_no=".$mer_transfer_no."&";
		$signStr = $signStr."merchant_no=".$merchant_no."&";
		$signStr = $signStr."recv_accno=".$recv_accno."&";
		$signStr = $signStr."recv_bank_code=".$recv_bank_code."&";
		$signStr = $signStr."recv_city=".$recv_city."&";
		$signStr = $signStr."recv_name=".$recv_name."&";
		$signStr = $signStr."recv_province=".$recv_province."&";
		if($remark != ""){
			$signStr = $signStr."remark=".$remark."&";
		}
		$signStr = $signStr."tran_amount=".$tran_amount."&";
		$signStr = $signStr."tran_code=".$tran_code."&";
		$signStr = $signStr."tran_fee_type=".$tran_fee_type."&";
		$signStr = $signStr."tran_type=".$tran_type;
		
		$merchant_private_key= openssl_get_privatekey($this->paipay_merchant_private_key);
		openssl_sign($signStr,$encryptData,$merchant_private_key,OPENSSL_ALGO_MD5);
		$sign_info = base64_encode($encryptData);

		$webdata =array("merchant_no"=>$merchant_no,
				"tran_type"=>$tran_type,
				"tran_fee_type"=>$tran_fee_type,
				"tran_code"=>$tran_code,
				"sign_type"=>$sign_type,
				"sign_info"=>$sign_info,
				"tran_amount"=>$tran_amount,
				"remark"=>$remark,
				"recv_province"=>$recv_province,
				"recv_name"=>$recv_name,
				"recv_city"=>$recv_city,
				"recv_accno"=>$recv_accno,
				"mer_transfer_no"=>$mer_transfer_no,
				"recv_bank_code"=>$recv_bank_code,
				"interface_version"=>$interface_version
		);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->paipay_df_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($webdata));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$dfdata=curl_exec($ch);
		curl_close($ch);
		$this->writeLog("dfdata=".json_encode($dfdata));
		$result = array();
		if($dfdata){
			$result = json_decode ( json_encode(simplexml_load_string($dfdata)), TRUE );
			$result = $result['dinpay']?$result['dinpay']:$result;
			$this->writeLog("result=".json_encode($result).$result['recv_code']);
			if($result['result_code']=='0' && $result['recv_code']=='0000'&& $result['mer_transfer_no']==$mer_transfer_no && $result['merchant_no']==$merchant_no){
				$return_ary['status']=1;
			}else{
				$return_ary['status']=0;
			}
			$return_ary ['msg'] = $result['recv_info'];
		}else{
			$return_ary ['msg'] = $result['服务器通讯错误，提款失败'];
		}
		
		$stateMap = $this->paipayStateMap();
		$queryData = $this->paipayDfQuery($mer_transfer_no);
		$this->writeLog("queryData=".json_encode($queryData));
		$updatedata = array();
		$updatedata['opertime'] = date ( 'Y-m-d H:i:s', time () );
		$updatedata['res_code'] = $stateMap[$queryData['recv_code']];
		$updatedata['res_msg'] = $queryData ['recv_info'];
		$updatedata['platform_orderid'] = $queryData['transfer_no'];
		$flag = $this->cus_task_model->updatetask($mer_transfer_no,$updatedata);
		$this->writeLog("flag=$flag,mer_transfer_no=$mer_transfer_no,recv_code=".$queryData['recv_code'].",mapcode=".$stateMap[$queryData['recv_code']]);
		exit ( json_encode ( $return_ary ) );
		
	}
	private function paipayDfQuery($mer_transfer_no){
		if(!$mer_transfer_no){
			return null;
		}
		$merchant_no =$this->paipay_appid;
		$tran_code ="DMTQ";
		$interface_version="V3.1.0";
		$sign_type ="RSA-S";
		
		$signStr= "";
		$signStr = $signStr."interface_version=".$interface_version."&";
		$signStr = $signStr."mer_transfer_no=".$mer_transfer_no."&";
		$signStr = $signStr."merchant_no=".$merchant_no."&";
		$signStr = $signStr."tran_code=".$tran_code;
		
		$merchant_private_key= openssl_get_privatekey($this->paipay_merchant_private_key);
		openssl_sign($signStr,$encrypted,$merchant_private_key,OPENSSL_ALGO_MD5);
		$sign_info=base64_encode($encrypted);
		
		$data =array("merchant_no"=>$merchant_no,
				"mer_transfer_no"=>$mer_transfer_no,
				"tran_code"=>$tran_code,
				"sign_type"=>$sign_type,
				"sign_info"=>$sign_info,
				"interface_version"=>$interface_version
		);
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->paipay_df_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resdata=curl_exec($ch);
		
		curl_close($ch);
		if($resdata){
			$result = json_decode ( json_encode(simplexml_load_string($resdata)), TRUE );
			return $result;
		}
		return null;
	}
	public function updatePaiOrdersStatus(){
// 		$this->doUpdatePaiOrdersStatus();
		header('location: ' . site_url('task/taskmgr/index'));
	}
	private function doUpdatePaiOrdersStatus(){
		$taskForms = $this->cus_task_model->getTaskForms('10001', PAY_PLATFORM_PAIPAY);
		if($taskForms && !empty($taskForms) && count($taskForms)>0){
			$num = 0;
			$this->writeLog("count_task=".count($taskForms));
			$stateMap = $this->paipayStateMap();
			foreach ($taskForms as $v){
				$mer_transfer_no = $v['out_trade_no'];
				if($mer_transfer_no){
					$queryData = $this->paipayDfQuery($mer_transfer_no);
					$this->writeLog(++$num.",queryData=".json_encode($queryData));
					$updatedata = array();
					$updatedata['opertime'] = date ( 'Y-m-d H:i:s', time () );
					$updatedata['res_code'] = $stateMap[$queryData['recv_code']];
					$updatedata['res_msg'] = $queryData ['recv_info'];
					$updatedata['platform_orderid'] = $queryData['transfer_no'];
					$flag = $this->cus_task_model->updatetask($mer_transfer_no,$updatedata);
					$this->writeLog($num.",flag=$flag,mer_transfer_no=$mer_transfer_no,recv_code=".$queryData['recv_code'].",mapcode=".$stateMap[$queryData['recv_code']]);
				}
			}
		}
	}
	
	
}