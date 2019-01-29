<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransfercheck extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_zfg_transfer' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'dindan_model' );
	}

	public function get_dindan_data() {
		$mystarttime = $this->input->get_post ( 'mystarttime' );
		$myendtime = $this->input->get_post ( 'myendtime' );
		$userid = $this->input->get_post ( 'userid' );
		$dindan = $this->input->get_post ( 'dindan' );
		$account = $this->input->get_post ( 'account' );
		$beginindex = $this->input->get_post ( 'beginindex' );
		$statusid = $this->input->get_post ( 'statusid' );
		$gameid = $this->input->get_post ( 'gameid' );
		
		$res = $this->dindan_model->get_dindan_his ( $userid, $dindan, $statusid, $gameid, $mystarttime, $myendtime, $account, $beginindex );
		
		echo json_encode ( $res );
	}

	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : 0;
		$query ['order_sn'] = $this->input->get ( 'order_sn', true ) ? $this->input->get ( 'order_sn', true ) : '';
		$query ['alipay_orderid'] = $this->input->get ( 'alipay_orderid', true ) ? $this->input->get ( 'alipay_orderid', true ) : '';
		$query ['alipay_account'] = $this->input->get ( 'alipay_account', true ) ? $this->input->get ( 'alipay_account', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true )  : date('Y-m-d', time() - 1 * 86400);
		$query ['start_time_time'] = $this->input->get ( 'start_time_time', true ) ? $this->input->get ( 'start_time_time', true )  : "00:00";
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true )  : date('Y-m-d', time() + 86400);
		$query ['end_time_time'] = $this->input->get ( 'end_time_time', true ) ? $this->input->get ( 'end_time_time', true )  : "00:00";
		$query ['order_status'] = ($this->input->get ( 'order_status', true ) !== false) ? intval ( $this->input->get ( 'order_status', true ) ) : 0;
		
		$startTime = $query['start_time'] . " " . $query['start_time_time'];

		$endTime = $query['end_time'] . " " . $query['end_time_time'];

		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$orderList = array();
		$orderNum = 0;
		$this->dindan_model->get_alipay_transfer_dindan_his ( 
				$query ['user_id'], $query ['order_sn'], $query['alipay_orderid'], 
				$startTime, $endTime, $query ['alipay_account'], intval($query ['order_status']), 
				$start, $per, $orderList, $orderNum );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付宝转账订单审核" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付宝转账订单审核" 
				),
				"header2" => array (
						"father" => "客服管理",
						"child" => "支付宝转账订单审核 " 
				),
				'order_list' => $orderList,
				'query' => $query,
		);
		
		$data ['total_rows'] = $orderNum;
		
		$this->load->library ( 'pagination' );
		$url = site_url ( 'no3/alipaytransfercheck/index' ) . '?' . http_build_query($query);
		$config ['base_url'] = $url;
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/alipaytransfercheck_view', $data );
	}
	
	/**
	 * 检查失败
	 */
	function markFail()
	{
		$orderid = $this->input->get ( 'id', true );
		if (empty($orderid))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}

		$closeReason = $this->input->get('closeReason', true);
		if ($closeReason == "")
		{
			$closeReason = "订单号不存在或者提交错误，请核实后再次提交。";
		}
		
		$order = $this->dindan_model->getOrderAllInfo ( $orderid );
		if (count($order) == 0)
		{
			$this->session->set_flashdata ( 'error', '订单未找到' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[markFail] orderId: $orderid, closeReason: $closeReason, adminId: $admin_id, admin_name: $admin_name");

		if ($order ['status'] == 0)
		{
			if ($this->orderFail($order, $closeReason))
			{
				$redis_config = $this->config->item ( 'redis' );
				$redis = new Redis ();
				$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
				$redis->del('al_' . $order['third_order_sn']);
				$redis->close();
				$this->writeLog ( '[markFail] order transfer success: ' . $orderid);
				$this->session->set_flashdata ( 'success', '修改成功' );
				redirect ( 'no3/alipaytransfercheck' );
			}
			else
			{
				$this->writeLog ( '[markFail] order state failed: ' . $orderid);
				$this->session->set_flashdata ( 'error', '修改失败' );
				redirect ( 'no3/alipaytransfercheck' );
			}
		} else {
			$this->writeLog ( '[markFail] order state error or money incorrect: ' . $orderid);
			$this->session->set_flashdata ( 'error', '订单状态不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}
	}
	/**
	 * 确认转账成功
	 */
	function transferSuccess()
	{
		$orderid = $this->input->get ( 'id', true );
		if (empty($orderid))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		
		$order = $this->dindan_model->getOrderAllInfo ( $orderid );
		if (count($order) == 0)
		{
			$this->session->set_flashdata ( 'error', '订单未找到' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[transferSuccess] orderId: " . $orderid . ", adminId: " . $admin_id . ", admin_name: " . $admin_name);

		if ($order ['status'] == 0)
		{
			if ($this->orderSuccess($order))
			{
				$this->writeLog ( '[transferSuccess] order transfer success: ' . $orderid);
				$this->session->set_flashdata ( 'success', '修改成功' );
				redirect ( 'no3/alipaytransfercheck' );
			}
			else
			{
				$this->writeLog ( '[transferSuccess] order state failed: ' . $orderid);
				$this->session->set_flashdata ( 'error', '修改失败' );
				redirect ( 'no3/alipaytransfercheck' );
			}
		} else {
			$this->writeLog ( '[transferSuccess] order state error or money incorrect: ' . $orderid);
			$this->session->set_flashdata ( 'error', '订单状态不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}
	}
	
	function changeMoney()
	{
		$orderid = $this->input->get ( 'id', true );
		if (empty($orderid))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}

		$money = $this->input->get ( 'money', true );
		$money = intval($money);
		if ($money == 0)
		{
			$this->session->set_flashdata ( 'error', '数值不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		
		$order = $this->dindan_model->getOrderAllInfo ( $orderid );
		if (count($order) == 0)
		{
			$this->session->set_flashdata ( 'error', '订单未找到' );
			redirect ( 'no3/alipaytransfercheck' );
		}

		if ($order ['status'] != 0)
		{
			$this->session->set_flashdata ( 'error', '订单状态不正确' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[changeMoney] orderId: " . orderid . ", adminId: " . $admin_id . ", admin_name: " . $admin_name);

		if ($this->dindan_model->updateMoney($orderid, $money))
		{
			$this->writeLog ( '[changeMoney] success: ' . $orderid);
			$this->session->set_flashdata ( 'success', '修改成功' );
			redirect ( 'no3/alipaytransfercheck' );
		}
		else
		{
			$this->writeLog ( '[changeMoney] failed: ' . $orderid);
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/alipaytransfercheck' );
		}
	}

	private function orderFail($order, $closeReason)
	{
		if (empty ( $order )) {
			return false;
		}

		$this->load->database ( 'default' );
		$this->load->model ( 'no3/Chat_model' );
		$orderid = $order['order_sn'];
		$data = array (
				'status' => ORDER_STATUS_FAIL,
				'pay_success_time' => time (),
		);
		$this->db->where ( 'order_sn', $orderid );
		if ($this->db->update ( 'smc_order', $data )) {
			// 需要发一段话
			$autoReplyData = array();
			$autoReplyData ['content'] = "您好，您的支付宝转账充值失败，订单号：{$order['third_order_sn']}, 失败原因：$closeReason";
			$autoReplyData ['user_id'] = $order['user_id'];
			$autoReplyData ['add_time'] = time () + 5;
			// 表示管理员在说话
			$autoReplyData ['admin_id'] = 1;
			$autoReplyData ['is_recharge'] = 1;
			$this->Chat_model->insertRMessage ( $autoReplyData );

			return true;
		}
		
		return false;
	}
	
	private function orderSuccess($order)
	{
		if (empty ( $order )) {
			return false;
		}
	
		$orderid = $order['order_sn'];
	
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
	
		if ($order ['status'] == ORDER_STATUS_NEW && $redis->incr ( $orderid ) === 1) {
			$this->load->model ( 'detail_model' );
			$gold = intval ( $order ['money'] );
			if ($this->detail_model->score_operation ( $order ['user_id'], $gold )) {
				$this->load->database ( 'default' );
	
				$data = array (
						'status' => ORDER_STATUS_SUCCESS,
						'pay_success_time' => time (),
				);
				$this->db->where ( 'order_sn', $orderid );
				if ($this->db->update ( 'smc_order', $data )) {
						
					$this->load->model ( 'api/User_model' );
					$user_db_index = $this->User_model->getUserDBPos ( $order ['user_id'] );
					if (! empty ( $user_db_index )) {
						$db1 = $this->load->database ( 'eus' . $user_db_index ['dbindex'], true );
						$sql = "UPDATE CASINOUSER_" . $user_db_index ['tableindex'] . " SET totalBuy = totalBuy + '" . $gold . "' WHERE id = '" . $order ['user_id'] . "'";
						$db1->query ( $sql );
						$db1->close ();
					}
						
					// 更新总支付金额
					$redis->incr ( 'alipay_tr_total_pay_' . date ( 'Ymd' ), intval ( $order ['money'] / 100  ) );

					if ($redis->exists ( 'euc_' . $order ['user_id'] )) {
						$redis->incr ( 'euc_' . $order ['user_id'], intval ( $order ['money'] / 100 ) );
					} else {
						$now = time ();
						$expire_time = strtotime ( date ( 'Ymd' . '000000' ) ) + 3600 * 24 - $now;
						$redis->setex ( 'euc_' . $order ['user_id'], $expire_time, intval ( $order ['money'] / 100 ) );
					}
					$redis->close ();

					$this->load->model ( 'no3/Chat_model' );
					// 需要发一段话
					$autoReplyData = array();
					$rechargeMoney = intval($order['money'] / 100);
					$autoReplyData ['content'] = "您好，您的支付宝转账充值成功，订单号：{$order['third_order_sn']}, 金额：$rechargeMoney";
					$autoReplyData ['user_id'] = $order['user_id'];
					$autoReplyData ['add_time'] = time () + 5;
					// 表示管理员在说话
					$autoReplyData ['admin_id'] = 1;
					$autoReplyData ['is_recharge'] = 1;
					$this->Chat_model->insertRMessage ( $autoReplyData );

					return true;
				}
			} else {
				$redis->del ( $orderid );
				$redis->close ();
				$this->writeLog ("[orderSuccess]" .  'score operation failed: ' . $orderid );
			}
		} else {
			$redis->close ();
			$this->writeLog ("[orderSuccess]" .  'order state error: ' . $orderid . ". orderInfo: " . json_encode($order) );
			return false;
		}
	
		return false;
	}

	private function writeLog($txt) {
		$log_file = "/log/alipaycheck.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
}
