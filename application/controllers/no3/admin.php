<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct ( );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'amdin_list_manage' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Admin_model' );
	}
	public function adminList() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				'admin_list' => $this->Admin_model->getAdminList () 
		);
		$this->load->view ( 'no3/admin_list_views', $data );
	}
	public function toAdd() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				'role_list' => $this->Admin_model->getRoleList () 
		);
		$this->load->view ( 'no3/admin_info_views', $data );
	}
	public function toEdit() {
		$admin_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $admin_id) {
			redirect ( 'no3/admin/adminList' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "管理员列表" 
				),
				'role_list' => $this->Admin_model->getRoleList (),
				'admin' => $this->Admin_model->getAdmin ( '', $admin_id ) 
		);
		$this->load->view ( 'no3/admin_info_views', $data );
	}
	public function add() {
		$data ['admin_name'] = trim ( $this->input->post ( 'admin_name', true ) );
		if ($data ['admin_name'] == '' || strlen ( $data ['admin_name'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入管理员账号名称' );
			redirect ( 'no3/admin/toAdd' );
		}
		
		$data ['pass'] = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['role_id'] = trim ( $this->input->post ( 'role_id', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		$data ['add_time'] = time ();
		
		if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
			$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
			redirect ( 'no3/admin/toAdd' );
		}
		
		if ($data ['role_id'] == 0) {
			$this->session->set_flashdata ( 'error', '请选择角色' );
			redirect ( 'no3/admin/toAdd' );
		}
		
		$admin = $this->Admin_model->getAdmin ( $data ['admin_name'] );
		if (! empty ( $admin )) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/admin/toAdd' );
		}
		
		if ($this->Admin_model->insertAdmin ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功 ' );
			redirect ( 'no3/admin/adminList' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/admin/adminList' );
		}
	}
	public function edit() {
		$admin_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $admin_id) {
			redirect ( 'no3/admin/adminList' );
		}
		
		$data ['admin_name'] = trim ( $this->input->post ( 'admin_name', true ) );
		if ($data ['admin_name'] == '' || strlen ( $data ['admin_name'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入管理员账号名称' );
			redirect ( 'no3/admin/toEdit/' . $admin_id );
		}
		
		$pass = trim ( $this->input->post ( 'pass1', true ) );
		$pass2 = trim ( $this->input->post ( 'pass2', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		
		if ($pass != '') {
			$data ['pass'] = $pass;
			if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
				$this->session->set_flashdata ( 'error', '密码错误,请重新输入' );
				redirect ( 'no3/admin/toEdit/' . $admin_id );
			}
		}
		
		if ($admin_id == 1) {
			$data ['role_id'] = 1;
			$data ['status'] = 1;
		} else {			
			$data ['role_id'] = trim ( $this->input->post ( 'role_id', true ) );
			if ($data ['role_id'] == 0) {
				$this->session->set_flashdata ( 'error', '请选择角色' );
				redirect ( 'no3/admin/toEdit/' . $admin_id );
			}
		}
		
		$admin = $this->Admin_model->getAdmin ( $data ['admin_name'] );
		if (! empty ( $admin ) && $admin ['id'] != $admin_id) {
			$this->session->set_flashdata ( 'error', '该账号已经存在,请输入其他账号' );
			redirect ( 'no3/admin/toEdit/' . $admin_id );
		}
		
		if ($this->Admin_model->updateAdmin ( $admin_id, $data )) {
			$this->session->set_flashdata ( 'success', '修改成功 ' );
			redirect ( 'no3/admin/adminList' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/admin/adminList' );
		}
	}
	public function del() {
		$admin_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $admin_id) {
			redirect ( 'no3/admin/adminList' );
		}
		
		if ($admin_id == 1) {
			redirect ( 'no3/admin/adminList' );
		}
		
		if ($this->Admin_model->deleteAdmin ( $admin_id )) {
			$this->session->set_flashdata ( 'success', '删除成功' );
			redirect ( 'no3/admin/adminList' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/admin/adminList' );
		}
	}
	
	/**
	 * 管理员登录日志
	 */
	public function loginLog()
	{
		$query = array();
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));

		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$startIndex = ($page - 1) * $per;
		
		$recordList = array();
		$recordNum = 0;
		
		$this->Admin_model->getLoginLog($query['start_time'], $query['end_time'], $startIndex, $per, $recordList, $recordNum);
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "管理员登录日志" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "管理员登录日志"
				),
				'loginLog_list' => $recordList,
				'query' => $query
		);
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/admin/loginLog' );
		$config ['total_rows'] = $recordNum;
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/admin_login_log_view', $data );
	}
}