<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class CashOrder extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'cash_order' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Order_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
		$this->load->model ( 'no3/Chat_model' );
	}
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : 0;
		$query ['alipay_account'] = $this->input->get ( 'alipay_account', true ) ? $this->input->get ( 'alipay_account', true ) : '';
		$query ['order_sn'] = $this->input->get ( 'order_sn', true ) ? $this->input->get ( 'order_sn', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-1 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d' );
		$query ['order_status'] = ($this->input->get ( 'order_status', true ) != "") ? $this->input->get ( 'order_status', true ) : CASH_ORDER_STATUS_NOT_COMPLETE;
		$tip_msg = "11";
		$goto_artificial = $this->ifGotoArtificialCash($tip_msg);
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "提现订单" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "提现订单" 
				),
				'tip_msg' => $tip_msg,
				'goto_artificial' => $goto_artificial,
				'cash_order_list' => $this->Order_model->getCashOrderList ( $query ['user_id'], $query ['alipay_account'], $query ['start_time'], $query ['end_time'], $query ['order_status'], $query['order_sn'] ),
				'query' => $query,
				'no_process_num' => $this->Order_model->getNoPorcessCashOrderNum () 
		);
		
		$this->load->view ( 'no3/cash_order_list_views', $data );
	}
	public function batchFinish() {
		$admin_id = $this->session->userdata ( 'id' );
		$select_cash_ids = $this->input->post ( 'select_cash_ids' );
		if (empty ( $select_cash_ids )) {
			$this->session->set_flashdata ( 'error', '请选择订单' );
			redirect ( 'no3/cashOrder' );
		}
		
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("batchFinish");
		$data1 = array (
				'status' => CASH_ORDER_STATUS_SUCCESS,
				'update_time' => time (),
				'discribe' => $admin_name.'批量完成',
		);
		$flag = $this->Order_model->createBatchLogTab();
		foreach ( $select_cash_ids as $id ) {
			$order = $this->Order_model->getCashOrder ( $id );
			if (! empty ( $order )) {
				$data1 ['real_cash_money'] = intval ( $this->Order_model->calMoney ( $order ['cash_money'] / 100 ) ) * 100;
				if (($order ['status'] == CASH_ORDER_STATUS_DEALING || $order ['status'] == CASH_ORDER_STATUS_UNKNOWN || $order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) &&
						 $this->Order_model->updateCashOrder ( $id, $data1 )) {
					$this->Order_model->logBatchCashOrder($id,$order['status'],time (),$this->session->userdata ( 'admin_name' ),'batchFinish');
					$user_db_index = $this->User_model->getUserDBPos ( $order ['user_id'] );
					if (! empty ( $user_db_index )) {
						$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
						$sql = "UPDATE CASINOUSER_" . $user_db_index ['tableindex'] . " SET total_total_money = total_total_money + '" . $order ['cash_money'] . "' WHERE id = '" . $order ['user_id'] . "'";
						$db1->query ( $sql );
						$db1->close ();
					}
					
					if ($this->Chat_model->createChatSession ( $order ['user_id'] )) {
						$data ['admin_id'] = $admin_id;
						$data ['content'] = '您的兑换已经处理完毕，请查看支付宝账单,处理时间（' . date ( 'Y-m-d H:i', $data1 ['update_time'] ) . '）';
						$data ['user_id'] = $order ['user_id'];
						$data ['add_time'] = time ();
						if ($this->Chat_model->insertMessage ( $data )) {
							// 推送
							$this->Push_model->addPushQueue ( $order ['user_id'], '您的兑换已成功' );
						}
					}
				}
			}
		}
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/cashOrder' );
	}
	public function batchSuccess(){
		$admin_id = $this->session->userdata ( 'id' );
		$select_cash_ids = $this->input->post ( 'select_cash_ids' );
		if (empty ( $select_cash_ids )) {
			$this->session->set_flashdata ( 'error', '请选择订单' );
			redirect ( 'no3/cashOrder' );
		}
		
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("batchSuccess");
		$data1 = array (
				'status' => CASH_ORDER_STATUS_SUCCESS,
				'update_time' => time (),
				'discribe' => $admin_name.'批量成功',
		);
		$flag = $this->Order_model->createBatchLogTab();
		foreach ( $select_cash_ids as $id ) {
			$order = $this->Order_model->getCashOrder ( $id );
			$data1 ['real_cash_money'] = intval ( $this->Order_model->calMoney ( $order ['cash_money'] / 100 ) ) * 100;
			if (! empty ( $order )) {
				$this->Order_model->updateCashOrder ( $id, $data1 );
				$this->Order_model->logBatchCashOrder($id,$order['status'],time (),$this->session->userdata ( 'admin_name' ),'batchSuccess');
			}
		}
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/cashOrder' );
	}
	public function refund() {
		$admin_id = $this->session->userdata ( 'id' );
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'no3/cashOrder' );
		}
		
		$discribe = $this->input->get ( 'discribe' ) ? $this->input->get ( 'discribe' ) : '';
		
		$cash_order = $this->Order_model->getCashOrder ( $id );
		if (empty ( $cash_order )) {
			$this->session->set_flashdata ( 'error', '参数错误2' );
			redirect ( 'no3/cashOrder' );
		}
		
		if (($cash_order ['status'] != CASH_ORDER_STATUS_NEW) && ($cash_order ['status'] != CASH_ORDER_STATUS_WAIT_REVIEW) && ($cash_order ['status'] != CASH_ORDER_STATUS_DEALING)) {
			$this->session->set_flashdata ( 'error', '参数错误3' );
			redirect ( 'no3/cashOrder' );
		}
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("refund: $id");
		$data = array (
				'discribe' => urldecode ( $discribe )." ".$admin_name,
				'status' => 2,
				'update_time' => time () 
		);
		if ($this->Order_model->updateCashOrder ( $id, $data )) {
			$this->load->model ( 'detail_model' );
			$this->detail_model->score_operation_by_cash ( $cash_order ['user_id'], $cash_order ['cash_money'] );
			
			// 客服消息和推送
			if ($this->Chat_model->createChatSession ( $cash_order ['user_id'] )) {
				$data1 ['admin_id'] = $admin_id;
				$data1 ['content'] = '您的兑换失败，因为' . $data ['discribe'] . '，您的兑换金币已返还到您的游戏账户，处理时间（' . date ( 'Y-m-d H:i', $data ['update_time'] ) . '）';
				$data1 ['user_id'] = $cash_order ['user_id'];
				$data1 ['add_time'] = time ();
				if ($this->Chat_model->insertMessage ( $data1 )) {
					// 推送
					$this->Push_model->addPushQueue ( $cash_order ['user_id'], '您的兑换失败' );
				}
			}
			
			$this->session->set_flashdata ( 'success', '退款成功' );
			redirect ( 'no3/cashOrder' );
		} else {
			$this->session->set_flashdata ( 'error', '退款失败' );
			redirect ( 'no3/cashOrder' );
		}
	}
	public function reviewOrder() {
		$admin_id = $this->session->userdata ( 'id' );
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'no3/cashOrder' );
		}
		
		$cash_order = $this->Order_model->getCashOrder ( $id );
		if (empty ( $cash_order )) {
			$this->session->set_flashdata ( 'error', '参数错误2' );
			redirect ( 'no3/cashOrder' );
		}
		
		if ($cash_order ['status'] != CASH_ORDER_STATUS_NEW) {
			$this->session->set_flashdata ( 'error', '参数错误3' );
			redirect ( 'no3/cashOrder' );
		}
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("reviewOrder: $id");
		$data = array (
				'status' => CASH_ORDER_STATUS_REVIEW_PASS,
				'update_time' => time (), 
				'discribe' => $admin_name.'审核通过',
		);
		if ($this->Order_model->updateCashOrder ( $id, $data )) {
			$this->session->set_flashdata ( 'success', '审核通过' );
			redirect ( 'no3/cashOrder' );
		} else {
			$this->session->set_flashdata ( 'error', '审核失败' );
			redirect ( 'no3/cashOrder' );
		}
	}
	public function batchProcessAgain() {
		$admin_id = $this->session->userdata ( 'id' );
		$select_cash_ids = $this->input->post ( 'select_cash_ids' );
		if (empty ( $select_cash_ids )) {
			$this->session->set_flashdata ( 'error', '请选择订单' );
			redirect ( 'no3/cashOrder' );
		}
		
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("batchProcessAgain");
		$data1 = array (
				'status' => CASH_ORDER_STATUS_NEW,
				'update_time' => time (),
				'discribe' => $admin_name.'批量重新处理',
				'is_process' => 1
		);
		
		foreach ( $select_cash_ids as $id ) {
			$order = $this->Order_model->getCashOrder ( $id );
			if (! empty ( $order )) {
				if ($order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) {
					$this->Order_model->deleteOneBlack ( $order ['alipay_account'], $order ['alipay_real_name'] );
					$this->Order_model->updateCashOrder ( $id, $data1 );
				}
				else if ($order['status'] == CASH_ORDER_STATUS_DEALING)
				{
					$this->Order_model->updateCashOrder ( $id, $data1 );
				}
				else if ($order['status'] == CASH_ORDER_STATUS_UNKNOWN)
				{
					$this->Order_model->updateCashOrder ( $id, $data1 );
				}
			}
		}
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/cashOrder' );
	}
	public function processAgain() {
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'no3/cashOrder' );
		}
		
		$cash_order = $this->Order_model->getCashOrder ( $id );
		if (empty ( $cash_order )) {
			$this->session->set_flashdata ( 'error', '参数错误2' );
			redirect ( 'no3/cashOrder' );
		}
		if ($cash_order ['status'] != CASH_ORDER_STATUS_WAIT_REVIEW && 
				$cash_order['status'] != CASH_ORDER_STATUS_DEALING && 
				$cash_order['status'] != CASH_ORDER_STATUS_UNKNOWN) {
			$this->session->set_flashdata ( 'error', '参数错误3' );
			redirect ( 'no3/cashOrder' );
		}
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("processAgain: $id");
		$this->Order_model->deleteOneBlack ( $cash_order ['alipay_account'], $cash_order ['alipay_real_name'] );
		
		$data = array (
				'status' => 0,
				'update_time' => time (),
				'discribe' => $admin_name.'重新处理',
				'is_process' => 1
		);
		if ($this->Order_model->updateCashOrder ( $id, $data )) {
			$this->session->set_flashdata ( 'success', '重新处理成功' );
			redirect ( 'no3/cashOrder' );
		} else {
			$this->session->set_flashdata ( 'error', '重新处理失败' );
			redirect ( 'no3/cashOrder' );
		}
	}
	
	/**
	 * 查看支付宝相关日志数据
	 */
	public function checkAlipayLogData()
	{
		$order_sn = $this->input->get ( 'order_sn', true );
		if (empty($order_sn))
		{
			$this->session->set_flashdata ( 'error', '订单号不存在' );
			redirect ( 'no3/cashOrder' );
		}

		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "提现订单" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "提现订单(查看支付宝日志数据)" 
				),
				'data' => $this->Order_model->getRelatedAlipayLogData ( $order_sn ),
		);
		
		$this->load->view ( 'no3/cash_order_alipay_data_view', $data );
	}
	
	/**
	 * 设置订单成功
	 */
	public function setCashOrderSuccess()
	{
		$id = $this->input->get ( 'id', true );
		if (empty($id))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/cashOrder' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("setCashOrderSuccess: $id");
		$data1 = array (
				'status' => CASH_ORDER_STATUS_SUCCESS,
				'update_time' => time (),
				'discribe' => $admin_name.'确认转账成功',
		);
		
		$order = $this->Order_model->getCashOrder ( $id );
		if (! empty ( $order )) {
			$data1 ['real_cash_money'] = intval ( $this->Order_model->calMoney ( $order ['cash_money'] / 100 ) ) * 100;
			if (($order ['status'] == CASH_ORDER_STATUS_DEALING || $order ['status'] == CASH_ORDER_STATUS_UNKNOWN || $order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) &&
					 $this->Order_model->updateCashOrder ( $id, $data1 )) {
				$user_db_index = $this->User_model->getUserDBPos ( $order ['user_id'] );
				if (! empty ( $user_db_index )) {
					$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
					$sql = "UPDATE CASINOUSER_" . $user_db_index ['tableindex'] . " SET total_total_money = total_total_money + '" . $order ['cash_money'] . "' WHERE id = '" . $order ['user_id'] . "'";
					$db1->query ( $sql );
					$db1->close ();
				}
				
				if ($this->Chat_model->createChatSession ( $order ['user_id'] )) {
					$data ['admin_id'] = $admin_id;
					$data ['content'] = '您的兑换已经处理完毕，请查看支付宝账单,处理时间（' . date ( 'Y-m-d H:i', $data1 ['update_time'] ) . '）';
					$data ['user_id'] = $order ['user_id'];
					$data ['add_time'] = time ();
					if ($this->Chat_model->insertMessage ( $data )) {
						// 推送
						$this->Push_model->addPushQueue ( $order ['user_id'], '您的兑换已成功' );
					}
				}
			}
		}
		
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/cashOrder' );
	}

	public function clearBlackAlipayAccount() {
		// exit('123');
		$this->writeLog("clearBlackAlipayAccount");
		$this->Order_model->deleteBlack ();
		$this->session->set_flashdata ( 'success', '清空成功' );
		redirect ( 'no3/cashOrder' );
	}
	
	private function writeLog($txt) {
		if(!$txt){return;}
		$log_file = "/log/cashOrder.log";
		$handle = fopen ( $log_file, "a+" );
		$admin_name = $this->session->userdata ( 'admin_name' );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "][" .$this->getIp()."][$admin_name] ".$txt;
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
	
	private function cashAlipayTips(){
		$res = array(
				"00"=>"支付宝提现已停止，请通知技术人员查看或开始人工提现",
				"01"=>"支付宝提现已关闭，请通知技术人员查看",
				"11"=>"支付宝提现运行中...",
				"10"=>"支付宝提现异常，请通知技术人员重启进程！！！",
				);
		return $res;
	}
	private function ifGotoArtificialCash(&$tip_msg){
		$tip_msg = "11";
		$admin_name = $this->session->userdata ( 'admin_name' );
		if(!$admin_name){return false;}
		$tip_msg = $this->alipayCashStatus();
		if("11"==$flag_str){//正常运行，禁止人工
			return false;
		}
		if("10"==$flag_str){//提现进程异常！！！禁止人工
			return false;
		}
		if("01"==$flag_str){//总闸已经关闭，等待进程结束
			return false;
		}
		if("00"==$flag_str){//人为关闭或进程自行关闭,开始人工
			return true;
		}
		return false;
	}
	private function alipayCashStatus(){
		$ALIPAYCASHSWTICH_STATUS_KEY = "alipaycashswtich_status";
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$switch_status = $redis->get($ALIPAYCASHSWTICH_STATUS_KEY);
		$alipaycashps_status = $redis->exists ( $ALIPAYCASHSWTICH_STATUS_KEY."_PS" );//提现进程状态
		$redis->close ();
		$a = "1";
		$b = "1";
		if("open"!=$switch_status){
			$a = "0";
		}
		if(!$alipaycashps_status){
			$b = "0";
		}
		return $a.$b;
	}
	public function setCashArtificial(){
		$admin_name = $this->session->userdata ( 'admin_name' );
		$ip = $this->getIp();
		
		//首先判断提现进程是否开启
		$tip_msg = "11";
		$artificialflag = $this->ifGotoArtificialCash($tip_msg);
		if(!$artificialflag){
			$this->session->set_flashdata ( 'error', '提现支付宝运行中，不可人工提现！' );
			redirect ( 'no3/cashOrder' );
		}
		
		$id = $this->input->get ( 'id', true );
		if (empty($id))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/cashOrder' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		$this->writeLog("setCashArtificial: $id");
		$order = $this->Order_model->getCashOrder ( $id );
		if (empty ( $order )) {
			$this->session->set_flashdata ( 'error', '订单不存在' );
			redirect ( 'no3/cashOrder' );
		}
		if(CASH_ORDER_STATUS_NEW!=$order['status'] && CASH_ORDER_STATUS_REVIEW_PASS!=$order['status']){
			$this->session->set_flashdata ( 'error', '新建或审核通过订单，才可人工提现' );
			redirect ( 'no3/cashOrder' );
			return false;
		}
		$data1 = array (
				'status' => CASH_ORDER_STATUS_DEALING,
				'update_time' => time (),
				'discribe' => $admin_name.'人工提现中...',
		);
		$flag = $this->Order_model->updateCashOrder ( $id, $data1 );
		$info = $this->Order_model->getUserBankCardInfo($order['user_id']);
		if(!$info || empty($info)){
			//未绑卡处理
			$flag0 = $this->cashNoBankcard($id, $order, $admin_name, $admin_id);
			$this->session->set_flashdata ( 'error', '玩家未绑定银行卡' );
			redirect ( 'no3/cashOrder' );
		}else{
			//打开转账界面
			$info['user_id'] = $order['user_id'];
			$info['order_sn'] = $id;
			$info['cash_money'] =  intval ( $this->Order_model->calMoney ( $order ['cash_money'] / 100 ) );
			$info['admin_name'] = $admin_name;
			$info['admin_id'] = $admin_id;
			echo $this->pageHtml ( "http://webapi.yuming.com/al/bt", $info );
		}
		
		
	}
	private function cashNoBankcard($id, $cash_order, $admin_name, $admin_id){
		$data = array (
				'discribe' => "玩家未绑定银行卡 ".$admin_name,
				'status' => 2,
				'update_time' => time ()
		);
		if ($this->Order_model->updateCashOrder ( $id, $data )) {
			$this->load->model ( 'detail_model' );
			$this->detail_model->score_operation_by_cash ( $cash_order ['user_id'], $cash_order ['cash_money'] );
				
			// 客服消息和推送
			if ($this->Chat_model->createChatSession ( $cash_order ['user_id'] )) {
				$data1 ['admin_id'] = $admin_id;
				$data1 ['content'] = '请绑定银行卡重试，您的兑换金币已返还到您的游戏账户，处理时间（' . date ( 'Y-m-d H:i', $data ['update_time'] ) . '）';
				$data1 ['user_id'] = $cash_order ['user_id'];
				$data1 ['add_time'] = time ();
				if ($this->Chat_model->insertMessage ( $data1 )) {
					// 推送
					$this->Push_model->addPushQueue ( $cash_order ['user_id'], '您的兑换失败' );
				}
			}
			return true;
		} else {
			return false;
		}
		return false;
	}
	public function pageHtml($Url, $PostArry) {
		if (! is_array ( $PostArry )) {
			throw new Exception ( "无法识别的数据类型【PostArry】" );
		}
		$FormString = "<body onLoad=\"document.actform.submit()\">loading...<form  id=\"actform\" name=\"actform\" method=\"post\" action=\"" . $Url . "\">";
		foreach ( $PostArry as $key => $value ) {
			$FormString .= "<input name=\"" . $key . "\" type=\"hidden\" value='" . $value . "'>\r\n";
		}
		$FormString .= "</form></body>";
	
		return $FormString;
	}
	
}
