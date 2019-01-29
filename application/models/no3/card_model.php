<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Card_model extends CI_Model {
	
	var $CARD_PASS_KEY = "cceb91a5ce1adaa0c96d7640e9594483";
	var $CARD_STATE_NOT_USED = 0;
	var $CARD_STATE_USED = 1;

	public function __construct() {
		parent::__construct ();
		$this->load->helper ( 'string' );
		$this->load->database('default');
	}
	
	/**
	 * 生成卡号，卡号的组合：[3位支付宝ID][10位日期时间][5位随机数]
	 * @param unknown_type $alipayAccountSN
	 */
	private function generateCardNum($alipayAccountSN)
	{
		$alipaySN = sprintf("%03d", $alipayAccountSN);
		$random = random_string ( 'alnum', 5 );
		$dateTime = date('YmdHis', time());
		
		return $alipaySN . $dateTime . $random;
	}
	
	/**
	 * 生成卡密，卡密的组合：[6位随机数字][5位由卡号算出来的值][4位随机字母加数字]
	 * @param unknown_type $cardNum
	 * @return string
	 */
	private function generateCardPass($cardNum)
	{
		$calcFromCardNum = md5($cardNum . $this->CARD_PASS_KEY);
		$cardPass = random_string ( 'numeric', 6 ) . substr($calcFromCardNum, 5, 5) . random_string ( 'alnum', 4 );
		return $cardPass;
	}

	/**
	 * 通过支付宝账号找到支付宝转账的配置
	 * @param unknown_type $alipayAccount
	 */
	private function getAlipayConfigByAccount($alipayAccount)
	{
		$alipayConfigs = $this->config->item('alipay_transfer');
		
		foreach($alipayConfigs as $k => $v)
		{
			if ($v['account'] == $alipayAccount)
			{
				return $v;
			}
		}
		
		return null;
	}
	
	private function insertChatMessage($userId, $alipayOrderId, $cardNum, $cardPass, $money)
	{
		$this->load->model ( 'no3/Chat_model' );

		// 需要发一段话
		$autoReplyData = array();
		$autoReplyData ['content'] = "您好，您购买的充值卡已经对应金额到账，支付宝订单号为：$alipayOrderId, 卡号：$cardNum, 密码：$cardPass, 金额：$money 元。此卡号卡密已经使用，无需再询问客服。";
		$autoReplyData ['user_id'] = $userId;
		$autoReplyData ['add_time'] = time () + 5;
		// 表示管理员在说话
		$autoReplyData ['admin_id'] = 1;
		$autoReplyData['is_recharge'] = 1;
		$this->Chat_model->insertRMessage ( $autoReplyData );
	}
	/**
	 * 生成卡号卡密
	 * @param unknown_type $userId
	 * @param unknown_type $orderId
	 * @param unknown_type $alipayOrderId
	 * @param unknown_type $alipayAccountSN
	 * @param unknown_type $cardNum
	 * @param unknown_type $cardPass
	 * @param unknown_type $use
	 */
	public function createNewCard($userId, $orderId, $alipayOrderId, $alipayAccount, $money, &$cardNum, &$cardPass, $use = false)
	{
		$alipayConfig = $this->getAlipayConfigByAccount($alipayAccount);
		if ($alipayConfig == null)
		{
			log_message('error', 'Alipay account not found: ' . $alipayAccount);
			return false;
		}
	
		$cardNum = $this->generateCardNum($alipayConfig['id']);
		$cardPass = $this->generateCardPass($cardNum);
		
		$now = time();

		$status = 0;
		if ($use)
		{
			$status = 1;
		}

		$insertData = array(
				'orderId' => $orderId,
				'userId' => $userId,
				'alipayOrderId' => $alipayOrderId,
				'alipayAccount' => $alipayAccount,
				'cardNum' => $cardNum,
				'cardPass' => $cardPass,
				'money' => $money,
				'status' => $status,
				'createTime' => $now,
				);
		
		$dbRet = $this->db->insert('smc_card', $insertData);
		if (!$dbRet)
		{
			log_message('error', 'Insert into smc_card failed, data: ' . json_encode($insertData));
			return false;
		}
		
		return true;
	}
	
	/**
	 * 设置卡号卡密已发货
	 * @param unknown_type $cardNum
	 * @param unknown_type $cardPass
	 */
	public function useCard($cardNum, $cardPass)
	{
		$this->db->from('smc_card');
		$this->db->where(array(
				'cardNum' => $cardNum,
				'cardPass' => $cardPass
				));
		
		$cardData = $this->db->get()->row_array();
		if (count($cardData) == 0)
		{
			log_message('error', 'Card not found, cardNum: ' . $cardNum . ', cardPass: ' . $cardPass);
			return false;
		}
		
		if ($cardData['status'] != $this->CARD_STATE_NOT_USED)
		{
			log_message('error', 'Card status incorrect, cardNum: ' . $cardNum . ', status: ' . $cardData['status']);
			return false;
		}
		
		$dbRet = $this->db->update('smc_card', 
				array('status' => $this->CARD_STATE_USED, 'useTime' => time()), 
				array(
				'cardNum' => $cardNum,
				'cardPass' => $cardPass
				));
		
		if (!$dbRet)
		{
			log_message('error', 'Update smc_card failed, cardNum: ' . $cardNum);
			return false;
		}
		
		$this->insertChatMessage($cardData['userId'], $cardData['alipayOrderId'], $cardData['cardNum'], $cardData['cardPass'], $cardData['money']);
		return true;
	}
	
	/**
	 * 设置卡号卡密已发货
	 * @param unknown_type $orderId
	 */
	public function useCardByOrderId($orderId, &$cardNum, &$cardPass)
	{
		$this->db->from('smc_card');
		$this->db->where(array(
				'orderId' => $orderId,
				));
		
		$cardData = $this->db->get()->row_array();
		if (count($cardData) == 0)
		{
			log_message('error', 'Card not found, orderId: ' . $orderId);
			return false;
		}
		
		if ($cardData['status'] != $this->CARD_STATE_NOT_USED)
		{
			log_message('error', 'Card status incorrect, orderId: ' . $orderId);
			return false;
		}
		
		$cardNum = $cardData['cardNum'];
		$cardPass = $cardData['cardPass'];
		
		$dbRet = $this->db->update('smc_card', 
				array('status' => $this->CARD_STATE_USED, 'useTime' => time()), 
				array(
				'orderId' => $orderId,
				));
		
		if (!$dbRet)
		{
			log_message('error', 'Update smc_card failed, cardNum: ' . $orderId);
			return false;
		}

		$this->insertChatMessage($cardData['userId'], $cardData['alipayOrderId'], $cardData['cardNum'], $cardData['cardPass'], $cardData['money']);
		
		return true;
	}
}
