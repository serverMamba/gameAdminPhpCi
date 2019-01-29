<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ClientBug extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_clientbug' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/clientbug_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
	}
	public function index() {
		$query ['id'] = $this->input->get ( 'id', true ) ? intval ( $this->input->get ( 'id', true ) ) : 0;
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : '';
		$query ['operuser'] = $this->input->get ( 'operuser', true ) ? $this->input->get ( 'operuser', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		$query ['status'] = $this->input->get ( 'status', true ) ? $this->input->get ( 'status', true ) : '';
		$query ['bugtype'] = $this->input->get ( 'bugtype', true ) ? $this->input->get ( 'bugtype', true ) : '';
		$query ['describe'] = $this->input->get ( 'describe', true ) ? $this->input->get ( 'describe', true ) : '';
		
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "客户端缺陷工单" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "客户端缺陷工单" 
				),
				'cash_order_list' => $this->clientbug_model->getClientBugList ( $query ['id'], $query ['user_id'], $query ['operuser'], $query ['start_time'], $query ['end_time'], $query ['status'], $query ['bugtype'], $query ['describe'], $per, $start ),
				'query' => $query,
				'bugtypeArr' => $bugtypeArr = array ("bug" => "游戏Bug","install" => "无法安装","conn" => "无法连接","slow" => "游戏卡顿","flash" => "游戏闪退","other" => "其他问题")
		);
		$data ['total_rows'] = $this->clientbug_model->getOrderNum ( $query ['id'], $query ['user_id'], $query ['operuser'], $query ['start_time'], $query ['end_time'], $query ['status'], $query ['bugtype'], $query ['describe'] );
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/clientbug/index' ) . '?id='.$query ['id'].'&user_id=' . $query ['user_id'] . '&operuser=' . $query ['operuser'] . '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'].'&status='.$query ['status'].'&bugtype='.$query ['bugtype'].'&describe='.$query ['describe'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		$this->load->view ( 'no3/clientbug_views', $data );
	}
	public function createBugForm()
	{
		$this->load->view ( 'no3/clientbugnew_views', null );
	}
	public function batchFinish() {
		$admin_id = $this->session->userdata ( 'id' );
		$select_cash_ids = $this->input->post ( 'select_cash_ids' );
		if (empty ( $select_cash_ids )) {
			$this->session->set_flashdata ( 'error', '请选择工单' );
			redirect ( 'no3/clientbug' );
		}
	
		$data = array (
				'status' => 1,
				'update_user' => $operuser = $this->session->userdata('admin_name'),
				'update_time' => time ()
		);
	
		foreach ( $select_cash_ids as $id ) {
			$flag = $this->clientbug_model->updateClientBug($id, $data);
		}
	
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/clientbug' );
	}
	
	
}