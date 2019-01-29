<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Alipaytransfer_failreport extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_zfg_transfer_fail_report' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/alipaytransfer_failreport_model' );
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/Order_model' );
		$this->load->model ( 'no3/Card_model' );
	}

	public function index() {
		$query ['alipay_orderid'] = $this->input->get ( 'alipay_orderid', true ) ? $this->input->get ( 'alipay_orderid', true ) : '';
		$query ['alipay_account'] = $this->input->get ( 'alipay_account', true ) ? $this->input->get ( 'alipay_account', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true )  : date('Y-m-d', time() - 1 * 86400);
		$query ['start_time_time'] = $this->input->get ( 'start_time_time', true ) ? $this->input->get ( 'start_time_time', true )  : "00:00";
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true )  : date('Y-m-d', time() + 86400);
		$query ['end_time_time'] = $this->input->get ( 'end_time_time', true ) ? $this->input->get ( 'end_time_time', true )  : "00:00";
		$query ['status'] = ($this->input->get ( 'status', true ) !== false) ? intval ( $this->input->get ( 'status', true ) ) : 0;
		
		$startTime = $query['start_time'] . " " . $query['start_time_time'];

		$endTime = $query['end_time'] . " " . $query['end_time_time'];

		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$reportList = array();
		$reportNum = 0;
		$this->alipaytransfer_failreport_model->get_failreport_list ( 
				$query ['alipay_orderid'], $query['alipay_account'], 
				$startTime, $endTime, $query ['status'], 
				$start, $per, $reportList, $reportNum );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "支付宝转账出错报告" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "支付宝转账出错报告" 
				),
				"header2" => array (
						"father" => "客服管理",
						"child" => "支付宝转账出错报告 " 
				),
				'reportList' => $reportList,
				'query' => $query,
		);
		
		$data ['total_rows'] = $reportNum;
		
		$this->load->library ( 'pagination' );
		$url = site_url ( 'no3/alipaytransfer_failreport/index' ) . '?' . http_build_query($query);
		$config ['base_url'] = $url;
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/alipaytransfer_failreport_view', $data );
	}
	
	/**
	 * 关闭
	 */
	function close()
	{
		$id = $this->input->get ( 'id', true );
		if (empty($id))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}

		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[close] id: $id, admin_id: $admin_id, admin_name: $admin_name");
		
		$report = $this->alipaytransfer_failreport_model->getReportById($id);

		if ($report['status'] == 0)
		{
			if ($this->alipaytransfer_failreport_model->closeReport($id))
			{
				$this->writeLog ( '[close] close success: ' . $id);
				$this->session->set_flashdata ( 'success', '修改成功' );
				redirect ( 'no3/alipaytransfer_failreport' );
			}
			else
			{
				$this->writeLog ( '[close] close report failed, id: ' . $id);
				$this->session->set_flashdata ( 'error', '修改失败' );
				redirect ( 'no3/alipaytransfer_failreport' );
			}
		} else {
			$this->writeLog ( '[close] report state error, id: ' . $id . ", state: " . $report['status']);
			$this->session->set_flashdata ( 'error', '订单状态不正确' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
	}
	
	/**
	 * 关系所有系统报告
	 */
	function closeAllSysReport()
	{
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[closeAllSysReport] admin_id: $admin_id, admin_name: $admin_name");
		
		if ($this->alipaytransfer_failreport_model->closeAllSysReport())
		{
			$this->writeLog ( '[closeAllSysReport] close success');
			$this->session->set_flashdata ( 'success', '修改成功' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
		else
		{
			$this->writeLog ( '[closeAllSysReport] close report failed');
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
	}

	/**
	 * 确认转账成功
	 */
	function transferSuccess()
	{
		$id = $this->input->get ( 'id', true );
		if (empty($id))
		{
			$this->writeLog ( '[transferSuccess] lack of param: id');
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
		
		$userId = $this->input->get ( 'userId', true );
		if (empty($userId))
		{
			$this->writeLog ( '[transferSuccess] lack of param: userId');
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
		
		$report = $this->alipaytransfer_failreport_model->getReportById($id);
		if (count($report) == 0)
		{
			$this->writeLog ( '[transferSuccess] report not found, id: ' . $id);
			$this->session->set_flashdata ( 'error', '报告未找到' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
		
		$admin_id = $this->session->userdata ( 'id' );
		$admin_name = $this->session->userdata ( 'admin_name' );
		
		$this->writeLog ( "[transferSuccess] id: " . $id . ", adminId: " . $admin_id . ", admin_name: " . $admin_name);

		if ($report ['status'] == 0)
		{
			$order_sn = "";
			$errMessage = "";
			if ($this->setReportSuccess($report, $userId, $order_sn, $errMessage))
			{
				// 先设置为成功
				$this->alipaytransfer_failreport_model->setReportSuccess($id, $userId);
				
				// 进行发货，加金币
				$order = $this->Order_model->getOrderAllInfo ( $order_sn );
				if ($this->orderSuccess($order))
				{
					// 加金币后设置卡已用
					$cardNum = "";
					$cardPass = "";
					if (!$this->Card_model->useCardByOrderId($order_sn, $cardNum, $cardPass))
					{
						$this->writeLog ( '[transferOrder SUCCESS] Use card failed, orderId: ' . $order_sn . ", cardNum: " . $cardNum);
					}
					else
					{
						$this->writeLog ( '[transferOrder SUCCESS] Use card success, orderId: ' . $order_sn . ", cardNum: " . $cardNum . ", cardPass: " . $cardPass);
					}
						
					$this->writeLog ( '[transferSuccess] deal success, id: ' . $id . ", userId: " . $userId . ", orderId: " . $order_sn);
					$this->session->set_flashdata ( 'success', '发货成功' );
					redirect ( 'no3/alipaytransfer_failreport' );
				}
				else
				{
					$this->writeLog ( '[transferSuccess FAIL] Deal order fail. id: ' . $id . ", orderId: " . $order_sn);
					$this->session->set_flashdata ( 'fail', '订单创建成功，但是发货失败，需要到支付宝转账订单审核进行处理' );
					redirect ( 'no3/alipaytransfer_failreport' );
				}
			}
			else
			{
				$this->writeLog ( '[transferSuccess] set report success failed, id: ' . $id . ", userId: " . $userId);
				$this->session->set_flashdata ( 'error', '修改失败，失败原因：' . $errMessage);
				redirect ( 'no3/alipaytransfer_failreport' );
			}
		} else {
			$this->writeLog ( '[transferSuccess] order state error: ' . $id . ", status: " . $report['status']);
			$this->session->set_flashdata ( 'error', '报告状态不正确' );
			redirect ( 'no3/alipaytransfer_failreport' );
		}
	}
	
	/**
	 * 需要创建订单，并且发货
	 * @param unknown_type $report
	 * @param unknown_type $userId
	 */
	private function setReportSuccess($report, $userId, &$order_sn, &$errMessage)
	{
		$this->writeLog ( '[setReportSuccess START] ' . json_encode($report) . ", userId: " . $userId);
		$errMessage = "";

		$alipayOrderId = $report['alipayOrderId'];
		$money = $report['money'];
		$alipayAccount = $report['alipayAccount'];
		
		if (strlen($alipayOrderId) != 32)
		{
			$this->writeLog ( '[setReportSuccess FAIL] Wrong alipay alipayOrderId: ' . $alipayOrderId);
			$errMessage = "订单号不正确";
			return false;
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );

		$money = intval($money);
		
		$user_info = $this->User_model->getUserInfo ( $userId );
		if (empty ( $user_info )) {
			$this->writeLog ( '[setReportSuccess FAIL] User not found, alipayOrderId: ' . $alipayOrderId . ', userId: ' . $userId);
			$errMessage = "用户未找到";
			return false;
		}
		
		// 判断是否已经存在该支付宝订单号
		if ($redis->incr('al_' . $alipayOrderId) != 1)
		{
			$this->writeLog ( '[setReportSuccess FAIL] Duplicate alipayOrderId, alipayOrderId: ' . $alipayOrderId);
			$errMessage = "订单号已存在，请关闭此订单";
			return false;
		}

		$merchantTime = date ( 'YmdHis' );
		$now = time ();
		$order_sn = $this->getOrderSn ( $userId );
		
		// 成功
		$data_db = array (
				'user_id' => $userId,
				'order_sn' => $order_sn,
				'add_time' => $now,
				'money' => $money * 100,
				'pay_type' => 'alipay',
				'refer' => 1, // 其实不知道用户用的是ios还是android，只能随便填一个
				'third_order_sn' => $alipayOrderId,
				'channel_id' => $user_info ['channel_id'],
				'before_chips' => $user_info ['user_chips'],
				'pay_platform' => PAY_PLATFORM_ZFB_TRANSFER_WEB,
				'param' => $alipayAccount,
		);

		if ($this->Order_model->insertOrder ( $data_db )) {
			// 生成卡号密码
			$cardNum = "";
			$cardPass = "";
			if (!$this->Card_model->createNewCard($userId, $order_sn, $alipayOrderId, $alipayAccount, $money, $cardNum, $cardPass))
			{
				$this->writeLog ( '[setReportSuccess SUCCESS] Create card failed, orderId: ' . $order_sn);
			}
			else
			{
				$this->writeLog ( '[setReportSuccess SUCCESS] Create card success, orderId: ' . $order_sn . ", cardNum: " . $cardNum . ", cardPass: " . $cardPass);
			}

			$this->writeLog ( '[setReportSuccess SUCCESS] Create order successful. alipayOrderId: ' . $alipayOrderId . ", orderId: " . $order_sn);
			return true;
		} else {
			$this->writeLog ( '[setReportSuccess FAIL] Insert into DB failed. alipayOrderId: ' . $alipayOrderId);
			// 需要清掉redis，用于重新生成订单
			$redis->del('al_' . $alipayOrderId);
			$errMessage = "插入数据库失败";
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

					/*
					$this->load->model ( 'no3/Chat_model' );
					// 需要发一段话
					$autoReplyData = array();
					$rechargeMoney = intval($order['money'] / 100);
					$autoReplyData ['content'] = "您好，您的支付宝转账充值成功，订单号：{$order['third_order_sn']}, 金额：$rechargeMoney";
					$autoReplyData ['user_id'] = $order['user_id'];
					$autoReplyData ['add_time'] = time () + 5;
					// 表示管理员在说话
					$autoReplyData ['admin_id'] = 1;
					$this->Chat_model->insertMessage ( $autoReplyData );
					*/

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
		echo $txt . "<br/>";
		$log_file = "/log/alipaycheck_failreport.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}

	private function getOrderSn($user_id) {
		$this->load->helper ( 'string' );
	
		$type = array (
				'alpha',
				'alnum',
				'numeric'
		);
	
		$order_sn = random_string ( $type [array_rand ( $type )], 6 ) . time () . $user_id . random_string ( $type [array_rand ( $type )], 4 );
		return $order_sn;
	}

}
