<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TgAgentBlanceLog extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'tg_agentblancelog' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Tg_account_model' );
		$this->load->helper('date');
	}
	public function index() {
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date('Y-m-d' ,strtotime('-30 day'));
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		$query ['agent_account'] = $this->input->get ( 'agent_account', true ) ? $this->input->get ( 'agent_account', true ) : "";
		$query ['data_type'] = $this->input->get ( 'data_type', true ) ? $this->input->get ( 'data_type', true ) : "";
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval($this->input->get ( 'user_id', true )) : 0;
		
		$query ['agent_account'] = str_replace(" ","",$query ['agent_account']);
		$query ['data_type'] = str_replace(" ","",$query ['data_type']);
		// 判断是否日期格式
		if (!$query ['start_time']||!isDate($query ['start_time']))
		{
			$query ['start_time'] = date ( 'Y-m-d', strtotime ( '-30 day' ) );
		}
		if (!$query ['end_time']||!isDate($query ['end_time']))
		{
			$query ['end_time'] = date ( 'Y-m-d', strtotime ( '1 day' ));
		}
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广信用金日志" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广信用金日志" 
				),
				'log_list' => $this->Tg_account_model->getAgentBalanceLogList($query ['agent_account'], $query ['data_type'], $query ['user_id'], strtotime($query ['start_time']), strtotime($query ['end_time']), $start, $per),
				'query' => $query ,
				'channel_list' => $this->config->item('channellist')
		);
		
		$data ['total_rows'] = $this->Tg_account_model->getAgentBalanceLogNumber($query ['agent_account'], $query ['data_type'], $query ['user_id'], strtotime($query ['start_time']), strtotime($query ['end_time']));
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/tgAgentBlanceLog/index' ) . '?start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time']. '&agent_account=' . $query ['agent_account'] . '&data_type=' . $query ['data_type'] . '&user_id=' . $query ['user_id'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/tg_agentblance_log_views', $data );
	}
}