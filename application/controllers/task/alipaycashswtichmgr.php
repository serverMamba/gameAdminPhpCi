<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class AlipayCashSwtichMgr extends CI_Controller {
	// redis的Key
	private $ALIPAYCASHSWTICH_STATUS_KEY = "alipaycashswtich_status";
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin () || !$this->session->userdata('admin_name')) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_alipaycashmgr' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'task/alipaycash_switch_model' );
		$this->load->model ( 'no3/Admin_model' );
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
	private function whiteIpArr(){
		return array('127.0.0.1','127.0.0.1','127.0.0.1','127.0.0.1');
	}
	public function index() {
		$this->writeLog("------------------------------------------");
		$query ['app_id'] = $this->input->get ( 'app_id', true ) ? trim ($this->input->get ( 'app_id', true )) : '';
		$query ['status'] = $this->input->get ( 'status', true ) ? intval ( $this->input->get ( 'status', true ) ) : 0;
		$query ['email'] = $this->input->get ( 'email', true ) ? trim ($this->input->get ( 'email', true )) : '';
		$query ['pc_ip'] = $this->input->get ( 'pc_ip', true ) ? trim ($this->input->get ( 'pc_ip', true )) : '';
		$query ['update_admin'] = $this->input->get ( 'update_admin', true ) ? trim ($this->input->get ( 'update_admin', true )) : '';
		$query ['check_flag'] = $this->input->get ( 'check_flag', true ) ? intval ( $this->input->get ( 'check_flag', true ) ) : 0;
		
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-300 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		// 判断是否日期格式
		if (!$query ['start_time']||!isDate($query ['start_time']))
		{
			$query ['start_time'] = date ( 'Y-m-d', strtotime ( '-300 day' ) );
		}
		if (!$query ['end_time']||!isDate($query ['end_time']))
		{
			$query ['end_time'] = date ( 'Y-m-d', strtotime ( '1 day' ));
		}
		
		$admin_name=$this->session->userdata('admin_name');
		
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$switch_status = $redis->get($this->ALIPAYCASHSWTICH_STATUS_KEY);
		$alipaycashps_status = $redis->exists ( $this->ALIPAYCASHSWTICH_STATUS_KEY."_PS" );//提现进程状态
		$redis->close ();
		$this->writeLog($this->ALIPAYCASHSWTICH_STATUS_KEY."=$switch_status");
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "提现支付宝管理" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "提现支付宝管理" 
				),
				'alipaycashps_status' => $alipaycashps_status,
				'switch_status' => $switch_status,
				'status_arr' => array(1=>'已启用', 2=>'已停用'),
				'check_flag_arr' => array(1=>'测试通过', 2=>'测试失败', 3=>'未测试'),
				'config_list' => $this->alipaycash_switch_model->getAlipayConfigList ( $query ['app_id'], $query ['status'], $query ['email'],$query ['pc_ip'], $query ['update_admin'], $query ['start_time'], $query ['end_time'], $per, $start, $query ['check_flag']),
				'query' => $query
		);
		$data ['total_rows'] = $this->alipaycash_switch_model->getAlipayConfigNum ( $query ['app_id'], $query ['status'], $query ['email'],$query ['pc_ip'], $query ['update_admin'], $query ['start_time'], $query ['end_time'], $query ['check_flag'] );
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'task/alipaycashswtichmgr/index' ) . '?app_id='.$query ['app_id'].'&status=' . $query ['status'] . '&email=' . $query ['email']. '&pc_ip=' . $query ['pc_ip'] . '&update_admin=' . $query ['update_admin'] . '&start_time=' . $query ['start_time'] . '&end_time='.$query ['end_time'] . '&check_flag='.$query ['check_flag'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		if('admin'!=$this->session->userdata('admin_name') || !in_array($this->getIp(),$this->whiteIpArr())){
			$this->load->view ( 'task/alipaycashswitchmgrforkefu_views', $data );
		}else{
			$this->load->view ( 'task/alipaycashswitchmgr_views', $data );
		}
	}
	public function addAlipayConfig()
	{
		if('admin'!=$this->session->userdata('admin_name') || !in_array($this->getIp(),$this->whiteIpArr())){exit('err');}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "提现支付宝管理"
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "提现支付宝管理"
				),
				"header2" => array(
						"father"=>"提现支付宝管理",
						"child"=>"提现支付宝创建"
				),
		);
		$this->load->view ( 'task/alipayconfignew_views', $data );
	}
	
	public function ajaxAddAlipayConfigNew() {
		if('admin'!=$this->session->userdata('admin_name') || !in_array($this->getIp(),$this->whiteIpArr())){exit('err');}
		$oper_time = date('Y-m-d H:i:s',time());
		$update_admin = $this->session->userdata('admin_name');
		$app_id = $this->input->post ( 'app_id' ) ? trim($this->input->post ( 'app_id' )) : "";
		$alipay_public_key = $this->input->post ( 'alipay_public_key' ) ? trim($this->input->post ( 'alipay_public_key' )) : "";
		$merchant_private_key= $this->input->post ( 'merchant_private_key' ) ? trim($this->input->post ( 'merchant_private_key' )) : "";
		$email = $this->input->post ( 'email' ) ? trim($this->input->post ( 'email' )) : "";
		$pc_ip = $this->input->post ( 'pc_ip' ) ? trim($this->input->post ( 'pc_ip' )) : "";
		$describe = $this->input->post ( 'describe' ) ? $this->input->post ( 'describe' ) : "";
		
		if (!$app_id || !$alipay_public_key || !$merchant_private_key) {
			$return_ary = array (
					'status' => '0',
					'msg' => '缺少必填信息！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$describe = trim(urldecode($describe));
		$this->writeLog("add: $app_id");
		$data = array (
				'app_id' => $app_id,
				'merchant_private_key' => $merchant_private_key,
				'alipay_public_key' => $alipay_public_key,
				'email' => $email,
				'pc_ip' => $pc_ip,
				'update_admin' => $update_admin,
				'describe' => $describe,
				'oper_time' => date('Y-m-d H:i:s',time()),
		);
		$flag = $this->alipaycash_switch_model->addAlipayConfigRecord($data);
		$return_ary = array (
				'code' => $flag?'1':'0',
				'adduser' => $update_admin,
				'time' => date('Y-m-d H:i:s',time()),
				'msg' => $flag?'保存成功':'保存失败'
		);
		$res_json = json_encode ( $return_ary );
		exit ( $res_json );
	}
	private function doCheck($app_id){
		$curl = "http://webapi.yuming.com/api/alipaycashcheck/check";
		$webdata = array("appid"=>$app_id);
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$curl);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($webdata));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 3);
		$dfdata=curl_exec($ch);
		curl_close($ch);
		$this->writeLog("dfdata=".json_encode($dfdata));
		$dfdata=json_decode ( $dfdata, true );
		return $dfdata;
	}
	//检测提现支付宝是否可用
	public function check(){
		$this->writeLog("check: ".json_encode($_GET));
		$update_admin = $this->session->userdata('admin_name');
		$app_id = $this->input->get ( 'app_id' ) ? trim($this->input->get ( 'app_id' )) : "";
		if (! $app_id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
		}else{
			$config = $this->alipaycash_switch_model->getAlipayConfigInfo ( $app_id );
			if($config && !empty($config) && $config['merchant_private_key']&& $config['alipay_public_key']){
				$dfdata = $this->doCheck($app_id);
				$flagcheck = '40004'==$dfdata['code'] && 'ORDER_NOT_EXIST'==$dfdata['msg'];
				$check_flag = $flagcheck?1:2;
				$describe = $flagcheck?"测试通过，测试时间：".date('Y-m-d H:i:s',time()):$dfdata['code']." ".$dfdata['msg'];
				$flag = $this->alipaycash_switch_model->updateAlipayConfig($app_id, array("check_flag"=>$check_flag,"describe"=>$describe,'update_admin'=>$update_admin));
				$fixstr = $flag?"":"更新db失败";
				if($flagcheck){
					$this->session->set_flashdata ( 'success', '检测通过'.$fixstr );
				}else{
					$this->session->set_flashdata ( 'error', '未通过检测' );
				}
			}else{
				$this->session->set_flashdata ( 'error', '获取db信息失败' );
			}
		}
		redirect ( 'task/alipaycashswtichmgr' );
	}
	public function delete(){
		if('admin'!=$this->session->userdata('admin_name') || !in_array($this->getIp(),$this->whiteIpArr())){exit('err');}
		$this->writeLog("delete: ".json_encode($_GET));
		$app_id = $this->input->get ( 'app_id' ) ? trim($this->input->get ( 'app_id' )) : "";
		if (! $app_id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
		}else{
			$flag = $this->alipaycash_switch_model->deleteAlipayConfig($app_id);
			if($flag){
				$this->session->set_flashdata ( 'success', '删除成功：'.$app_id );
			}else{
				$this->session->set_flashdata ( 'error', '删除失败：'.$app_id );
			}
		}
		redirect ( 'task/alipaycashswtichmgr' );
	}
	public function close(){
		$this->writeLog("close: ".json_encode($_GET));
		$update_admin = $this->session->userdata('admin_name');
		$app_id = $this->input->get ( 'app_id' ) ? trim($this->input->get ( 'app_id' )) : "";
		if (! $app_id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
		}else{
			$describe = "禁用时间：".date('Y-m-d H:i:s',time());
			$flag = $this->alipaycash_switch_model->updateAlipayConfig($app_id, array("status"=>2,"check_flag"=>3,"describe"=>$describe,'update_admin'=>$update_admin));
			if($flag){
				$this->session->set_flashdata ( 'success', '禁用成功：'.$app_id );
			}else{
				$this->session->set_flashdata ( 'error', '禁用失败：'.$app_id );
			}
		}
		redirect ( 'task/alipaycashswtichmgr' );
	}
	public function open(){
		$this->writeLog("open: ".json_encode($_GET));
		$update_admin = $this->session->userdata('admin_name');
		$app_id = $this->input->get ( 'app_id' ) ? trim($this->input->get ( 'app_id' )) : "";
		if (! $app_id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
		}else{
			$config = $this->alipaycash_switch_model->getAlipayConfigInfo ( $app_id );
			if($config && !empty($config) && $config['merchant_private_key']&& $config['alipay_public_key']){
				$dfdata = $this->doCheck($app_id);
				$flagcheck = '40004'==$dfdata['code'] && 'ORDER_NOT_EXIST'==$dfdata['msg'];
				$check_flag = $flagcheck?1:2;
				$status = $flagcheck?1:2;
				$describe = $flagcheck?"测试通过，测试时间：".date('Y-m-d H:i:s',time()):$dfdata['code']." ".$dfdata['msg'];
				$flag = $this->alipaycash_switch_model->updateAlipayConfig($app_id, array("status"=>$status,"check_flag"=>$check_flag,"describe"=>$describe,'update_admin'=>$update_admin));
				if(!$check_flag){
					$this->session->set_flashdata ( 'error', '开启失败！（服务端复测未通过）' );
				}else{
					if($flag){
						$this->session->set_flashdata ( 'success', '开启成功：'.$app_id );
					}else{
						$this->session->set_flashdata ( 'error', '开启失败：'.$app_id );
					}
				}
			}else{
				$this->session->set_flashdata ( 'error', '服务端获取信息失败：'.$app_id );
			}
		}
		redirect ( 'task/alipaycashswtichmgr' );
	}
	
	/**
	 * 修改操作
	 */
	public function modifySwitch()
	{
		$ip = $this->getIp();
		$admin = $this->session->userdata('admin_name');
		$alipaycashswtich_status = $_POST['alipaycashswtich_status']?$_POST['alipaycashswtich_status']:$_GET['alipaycashswtich_status'];
		$alipaycashswtich_status = $alipaycashswtich_status?trim($alipaycashswtich_status):"close";
		if("open"!=$alipaycashswtich_status){
			$alipaycashswtich_status = "close";
		}
		$this->writeLog("modifySwitch: $alipaycashswtich_status");
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->set($this->ALIPAYCASHSWTICH_STATUS_KEY, $alipaycashswtich_status);
		if("open"==$alipaycashswtich_status){
			$redis->setex ( $this->ALIPAYCASHSWTICH_STATUS_KEY."_PS", 60, '1' );
		}
		$res = $redis->get($this->ALIPAYCASHSWTICH_STATUS_KEY);
		$redis->close ();
		if("open"==$res){
			$this->session->set_flashdata ( 'error', '已开启支付宝提现，请务必通知客服停止人工提现！！！' );
		}else{
			$this->session->set_flashdata ( 'error', '已关闭支付宝提现，请通知客服开始人工提现！！！');
		}
		redirect ( 'task/alipaycashswtichmgr' );
	}
	
	public function writeLog($txt) {
		$log_file = "/log/alipaycashswtichmgr.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$ip = $this->getIp();
		$admin = $this->session->userdata('admin_name');
		$str = fwrite ( $handle, "[$dateTime][$ip][$admin] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
}