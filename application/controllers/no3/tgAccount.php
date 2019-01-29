<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TgAccount extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'tg_account' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Tg_account_model' );
	}
	public function index() {
		$tg_account_list = array ();
		$flagEditAgentBalance = 'admin'==$this->session->userdata('admin_name') && in_array($this->getIp(),$this->whiteIpArr());
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				'flagEditAgentBalance' => $flagEditAgentBalance,
				'tg_account_list' => $this->Tg_account_model->getTgAccountList ( $tg_account_list, 0 ) 
		);
		$this->load->view ( 'no3/tg_account_list_views', $data );
	}
	public function toAdd() {
		$priv_ary = json_decode ( $this->config->item ( 'report_field' ), true );
		foreach ( $priv_ary as $k => $v ) {
			if ($v ['key'] == 'total7' || $v ['key'] == 'total8') {
				unset ( $priv_ary [$k] );
			}
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "推广帐号" 
				),
				'promotion_user_priv' => $priv_ary,
				'channel_list' => $this->config->item ( 'channellist' ),
				'menu_list' => $this->Tg_account_model->getMenuList () 
		);
		$this->load->view ( 'no3/tg_account_info_views', $data );
	}
	public function toEdit() {
		$tgAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $tgAccount_id) {
			redirect ( 'no3/tgAccount' );
		}
		$priv_ary = json_decode ( $this->config->item ( 'report_field' ), true );
		foreach ( $priv_ary as $k => $v ) {
			if ($v ['key'] == 'total7' || $v ['key'] == 'total8') {
				unset ( $priv_ary [$k] );
			}
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "推广帐号" 
				),
				'promotion_user_priv' => $priv_ary,
				'channel_list' => $this->config->item ( 'channellist' ),
				'tg_account' => $this->Tg_account_model->getTgAccount ( '', $tgAccount_id ),
				'menu_list' => $this->Tg_account_model->getMenuList () 
		);
		$this->load->view ( 'no3/tg_account_info_views', $data );
	}
	public function add() {
		$data ['account'] = trim ( $this->input->post ( 'account', true ) );
		if ($data ['account'] == '' || strlen ( $data ['account'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输推广账号' );
			redirect ( 'no3/tgAccount/toAdd' );
		}
		if ($data ['account'] != str_replace(" ","",$data ['account'])) {
			$this->session->set_flashdata ( 'error', '推广账号由字母及数字组成，不可夹杂空格等非法字符！' );
			redirect ( 'no3/tgAccount/toAdd' );
		}
		
		$data ['pass'] = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		$data ['add_time'] = time ();
		
		if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
			$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
			redirect ( 'no3/tgAccount/toAdd' );
		}
		
		$tgAccount = $this->Tg_account_model->getTgAccount ( $data ['account'] );
		if (! empty ( $tgAccount )) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/tgAccount/toAdd' );
		}
		$data ['channel_name'] = trim ( $this->input->post ( 'channel_name', true ) );
		$data ['host'] = str_replace ( 'http://', '', trim ( $this->input->post ( 'host', true ) ) );
		
		$field_priv = $this->input->post ( 'field_priv', true );
		if (empty ( $field_priv )) {
			$field_priv = array ();
		}
		$data ['priv'] = json_encode ( $field_priv );
		
		$channel_priv = $this->input->post ( 'channel_priv', true );
		if (empty ( $channel_priv )) {
			$channel_priv = array ();
		}
		$data ['channel_priv'] = json_encode ( $channel_priv );
		
		if ($this->Tg_account_model->insertTgAccount ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功 ' );
			redirect ( 'no3/tgAccount' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/tgAccount' );
		}
	}
	public function edit() {
		$tgAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $tgAccount_id) {
			redirect ( 'no3/tgAccount' );
		}
		
		$data ['account'] = trim ( $this->input->post ( 'account', true ) );
		if ($data ['account'] == '' || strlen ( $data ['account'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入推广账号' );
			redirect ( 'no3/tgAccount/toEdit/' . $tgAccount_id );
		}
		if ($data ['account'] != str_replace(" ","",$data ['account'])) {
			$this->session->set_flashdata ( 'error', '推广账号由字母及数字组成，不可夹杂空格等非法字符！' );
			redirect ( 'no3/tgAccount/toEdit/' . $tgAccount_id );
		}
		
		$pass = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		
		if ($pass != '') {
			$data ['pass'] = $pass;
			if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
				$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
				redirect ( 'no3/tgAccount/toEdit/' . $tgAccount_id );
			}
		}
		
		$data ['channel_name'] = trim ( $this->input->post ( 'channel_name', true ) );
		$data ['host'] = str_replace ( 'http://', '', trim ( $this->input->post ( 'host', true ) ) );
		
		$field_priv = $this->input->post ( 'field_priv', true );
		if (empty ( $field_priv )) {
			$field_priv = array ();
		}
		$data ['priv'] = json_encode ( $field_priv );
		
		$channel_priv = $this->input->post ( 'channel_priv', true );
		if (empty ( $channel_priv )) {
			$channel_priv = array ();
		}
		$data ['channel_priv'] = json_encode ( $channel_priv );
		
		$tgAccount = $this->Tg_account_model->getTgAccount ( $data ['account'] );
		if (! empty ( $tgAccount ) && $tgAccount ['id'] != $tgAccount_id) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/tgAccount/toEdit/' . $tgAccount_id );
		}
		if ($this->Tg_account_model->updateTgAccount ( $tgAccount_id, $data )) {
			$this->session->set_flashdata ( 'success', '修改成功 ' );
			redirect ( 'no3/tgAccount' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/tgAccount' );
		}
	}
	// public function del() {
	// $tgAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment
	// ( 4 ) ) : 0;
	// if (! $tgAccount_id) {
	// redirect ( 'no3/tgAccount' );
	// }
	
	// if ($this->Tg_account_model->deleteTgAccount ( $tgAccount_id )) {
	// $this->session->set_flashdata ( 'success', '删除成功' );
	// redirect ( 'no3/tgAccount' );
	// } else {
	// $this->session->set_flashdata ( 'error', '删除失败' );
	// redirect ( 'no3/tgAccount' );
	// }
	// }
	public function toEditAgentBalance() {
		$accessIp = $this->getIp();
		if(!in_array($accessIp,$this->whiteIpArr()) || 'admin'!=$this->session->userdata('admin_name')){
			$this->session->set_flashdata ( 'error', '无权修改' );
			redirect ( 'no3/tgAccount' );
		}
		
		$tgAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $tgAccount_id) {
			redirect ( 'no3/tgAccount' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "推广帐号" 
				),
				'tg_account' => $this->Tg_account_model->getTgAccount ( '', $tgAccount_id ),
				'menu_list' => $this->Tg_account_model->getMenuList () 
		);
		$this->load->view ( 'no3/tg_account_agent_balance_info_views', $data );
	}
	public function editAgentBalance() {
		$accessIp = $this->getIp();
		if(!in_array($accessIp,$this->whiteIpArr()) || 'admin'!=$this->session->userdata('admin_name')){
			$this->session->set_flashdata ( 'error', '无权修改' );
			redirect ( 'no3/tgAccount' );
		}
		$tgAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $tgAccount_id) {
			redirect ( 'no3/tgAccount' );
		}
		
		$money = intval ( $this->input->post ( 'money', true ) );
		if ($money == 0) {
			$this->session->set_flashdata ( 'error', '请填写正确的信用金额' );
			redirect ( 'no3/tgAccount/toEditAgentBalance/' . $tgAccount_id );
		}
		
		$tgAccount = $this->Tg_account_model->getTgAccount ( '', $tgAccount_id );
		if (empty ( $tgAccount )) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/tgAccount/toEditAgentBalance/' . $tgAccount_id );
		}
		
		if ($money > 0) {
			$res = $this->Tg_account_model->plusAgentBalance ( $tgAccount_id, $money * 100, $tgAccount ['agent_balance_lock'] );
		} else {
			$db_money = abs ( $money );
			if ($db_money * 100 > $tgAccount ['agent_balance']) {
				$this->session->set_flashdata ( 'error', '该用户信用金不足' );
				redirect ( 'no3/tgAccount/toEditAgentBalance/' . $tgAccount_id );
			}
			$res = $this->Tg_account_model->reduceAgentBalance ( $tgAccount_id, $db_money * 100, $tgAccount ['agent_balance_lock'] );
		}
		
		if ($res) {
			$this->writeLog("editAgentBalance: agent_account=".$tgAccount['account'].",money=$money");
			$data = array (
					'add_time' => time (),
					'admin_id' => $_SESSION ['smc_id'],
					'admin_name' => $this->session->userdata('admin_name'),
					'agent_account_id' => $tgAccount_id,
					'agent_account' => $tgAccount['account'],
					'money' => $money * 100,
					'data_type' => 'houtai', 
					'agentbalanace_before' => $tgAccount['agent_balance'],
					'content' => $accessIp,
			);
			$this->Tg_account_model->insertAgentBalanceLog ( $data );
			
			$this->session->set_flashdata ( 'success', '修改成功 ' );
			redirect ( 'no3/tgAccount/toEditAgentBalance/' . $tgAccount_id );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败，请重新尝试' );
			redirect ( 'no3/tgAccount/toEditAgentBalance/' . $tgAccount_id );
		}
	}
	public function operationList() {
		$tg_account_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				'operation_list' => $this->Tg_account_model->getOperationList ( $tg_account_id, $start, $per ) 
		);
		
		$data ['total_rows'] = $this->Tg_account_model->getOperationNumber ( $tg_account_id );
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/tgAccount/operationList/' . $tg_account_id );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/tg_account_operation_list_views', $data );
	}
	public function income() {
		$tg_account_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		$tg_account = $this->Tg_account_model->getTgAccount ( '', $tg_account_id );
		if (empty ( $tg_account )) {
			redirect ( 'no3/tgAccount' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广帐号" 
				) 
		);
		
		$norec = $this->input->get ( 'norec' ) ? intval($this->input->get ( 'norec' )):0;
		$end_date = $this->input->get ( 'end_date' ) ? $this->input->get ( 'end_date', true ) : date ( 'Y-m-d' );
		$start_date = $this->input->get ( 'start_date' ) ? $this->input->get ( 'start_date', true ) : date ( 'Y-m-d', strtotime ( $end_date . ' 00:00:00' ) - 3600 * 24 * 6 );

		$return_ary = $this->Tg_account_model->getIncomeStatistics ( $tg_account, $start_date, $end_date );
		
		$data['tg_account_id'] = $tg_account_id;
		$data ['total_income'] = $return_ary ['total_income'];
		$data ['total_mission'] = $return_ary ['total_mission'];
		$data ['total_pay'] = $return_ary ['total_pay'];
		unset ( $return_ary ['total_income'] );
		unset ( $return_ary ['total_mission'] );
		unset ( $return_ary ['total_pay'] );
		$data ['promotion_data'] = $norec?array():$return_ary;
		$data ['start_date'] = $start_date;
		$data ['end_date'] = $end_date;
		
		$this->writeLog(">>>".$tg_account_id.":".$start_date."-".$end_date);
		$this->writeLog("total_income=".$data ['total_income'].",total_mission=".$data ['total_mission'].",total_pay=".$data ['total_pay']);
		
		$this->load->view ( 'no3/tg_account_income_views', $data );
	}
	
	private function writeLog($txt) {
		$log_file = "/log/tgAccount.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$ip = $this->getIp();
		$admin_name = $this->session->userdata('admin_name');
		$str = fwrite ( $handle, "[$dateTime][$ip][$admin_name]" . $txt . "\n" );
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
	private function whiteIpArr(){
		return array('127.0.0.1');
	}
	
	
}