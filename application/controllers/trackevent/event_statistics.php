<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Event_statistics extends CI_Controller {

	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'agent_account' )) {
			redirect ( 'no3/index' );
		}

		$this->load->model ( 'trackevent/track_event_model' );
	}

	public function index() {
		$query ['start_date'] = $this->input->get ( 'start_date', true ) ? $this->input->get ( 'start_date', true )  : date('Y-m-d', time());
		$query ['end_date'] = $this->input->get ( 'end_date', true ) ? $this->input->get ( 'end_date', true )  : date('Y-m-d', time());
		$query ['channel_id'] = $this->input->get ( 'channel_id', true ) ? $this->input->get ( 'channel_id', true )  : -1;

		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "埋点统计",
						"child" => "事件统计" 
				),
				"header1" => array (
						"father" => "埋点统计",
						"child" => "事件统计" 
				) ,
				'events' => $this->track_event_model->getAllEventsWithName(),
				'channelList' => $this->config->item('channellist'),
				'query' => $query,
		);
		$this->load->view ( 'no3/agent_account_list_views', $data );
	}
	public function toAdd() {
		$nochannellist = $this->config->item ( 'no_tongji' );
		$channellist = $this->config->item ( 'channellist' );
		foreach ( $nochannellist as $k => $v ) {
			unset ( $channellist [$k] );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "代理帐号管理" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "代理帐号管理" 
				),
				'channel_list' => $channellist,
				'report_field_list' => $this->report_field 
		);		
		$this->load->view ( 'no3/agent_account_info_views', $data );
	}
	public function toEdit() {
		$agentAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $agentAccount_id) {
			redirect ( 'no3/agentAccount' );
		}
		$nochannellist = $this->config->item ( 'no_tongji' );
		$channellist = $this->config->item ( 'channellist' );
		foreach ( $nochannellist as $k => $v ) {
			unset ( $channellist [$k] );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "代理帐号管理" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "代理帐号管理" 
				),
				'channel_list' => $channellist,
				'report_field_list' => $this->report_field ,
				'agent_account' => $this->Agent_account_model->getAgentAccount ( '', $agentAccount_id ) 
		);
		$this->load->view ( 'no3/agent_account_info_views', $data );
	}
	public function add() {
		$data ['account'] = trim ( $this->input->post ( 'account', true ) );
		if ($data ['account'] == '' || strlen ( $data ['account'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输代理账号' );
			redirect ( 'no3/agentAccount/toAdd' );
		}
		
		$data ['pass'] = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		$data ['add_time'] = time ();
		
		if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
			$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
			redirect ( 'no3/agentAccount/toAdd' );
		}
		
		$agentAccount = $this->Agent_account_model->getAgentAccount ( $data ['account'] );
		if (! empty ( $agentAccount )) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/agentAccount/toAdd' );
		}
		
		$channel_priv = $this->input->post ( 'channel_priv' );
		if (empty ( $channel_priv )) {
			$channel_priv = array();
		}
		$data['channel_priv'] = json_encode($channel_priv);
		
		$field_priv = $this->input->post ( 'field_priv' );
		if (empty ( $field_priv )) {
			$field_priv = array();
		}
		$data['field_priv'] = json_encode($field_priv);
		
		$data['host'] = preg_replace('/\s+/', '', $this->input->post('host'));

		if ($this->Agent_account_model->insertAgentAccount ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功 ' );
			redirect ( 'no3/agentAccount' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/agentAccount' );
		}
	}
	public function edit() {
		$agentAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $agentAccount_id) {
			redirect ( 'no3/agentAccount' );
		}
		
		$data ['account'] = trim ( $this->input->post ( 'account', true ) );
		if ($data ['account'] == '' || strlen ( $data ['account'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入代理账号' );
			redirect ( 'no3/agentAccount/toEdit/' . $agentAccount_id );
		}
		
		$pass = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		
		if ($pass != '') {
			$data ['pass'] = $pass;
			if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
				$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
				redirect ( 'no3/agentAccount/toEdit/' . $agentAccount_id );
			}
		}
		
		$channel_priv = $this->input->post ( 'channel_priv' );
		if (empty ( $channel_priv )) {
			$channel_priv = array();
		}
		$data['channel_priv'] = json_encode($channel_priv);
		
		$field_priv = $this->input->post ( 'field_priv' );
		if (empty ( $field_priv )) {
			$field_priv = array();
		}
		$data['field_priv'] = json_encode($field_priv);
		
		$agentAccount = $this->Agent_account_model->getAgentAccount ( $data ['account'] );
		if (! empty ( $agentAccount ) && $agentAccount ['id'] != $agentAccount_id) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/agentAccount/toEdit/' . $agentAccount_id );
		}
		
		$data['host'] = preg_replace('/\s+/', '', $this->input->post('host'));
		if ($this->Agent_account_model->updateAgentAccount ( $agentAccount_id, $data )) {
			$this->session->set_flashdata ( 'success', '修改成功 ' );
			redirect ( 'no3/agentAccount' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/agentAccount' );
		}
	}
	public function del() {
		$agentAccount_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $agentAccount_id) {
			redirect ( 'no3/agentAccount' );
		}
		
		if ($this->Agent_account_model->deleteAgentAccount ( $agentAccount_id )) {
			$this->session->set_flashdata ( 'success', '删除成功' );
			redirect ( 'no3/agentAccount' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/agentAccount' );
		}
	}
}