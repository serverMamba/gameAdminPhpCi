<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Role extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'admin_priv' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Admin_model' );
	}
	public function RoleList() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "角色列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "角色列表" 
				),
				'role_list' => $this->Admin_model->getRoleList () 
		);
		$this->load->view ( 'no3/admin_role_list_views', $data );
	}
	public function toAdd() {
		$this->load->model ( 'no3/configs_model', 'configs' );
		$total_menu_list = $this->configs->get_navmenu ();
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "角色列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "添加角色" 
				),
				'total_menu' => $total_menu_list 
		);
		$this->load->view ( 'no3/admin_role_info_views', $data );
	}
	public function addRole() {
		$data ['role_name'] = trim ( $this->input->post ( 'role_name', true ) );
		if ($data ['role_name'] == '' || strlen ( $data ['role_name'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入角色名称' );
			redirect ( 'no3/role/toAdd' );
		}
		
		$priv = $this->input->post ( 'priv', true );
		if (! empty ( $priv )) {
			$data ['priv'] = json_encode ( $priv );
		} else {
			$data ['priv'] = '[]';
		}
		if ($this->Admin_model->insertRole ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/role/RoleList' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/role/RoleList' );
		}
	}
	public function toEdit() {
		$role_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $role_id) {
			redirect ( 'no3/role/RoleList' );
		}
		
		$this->load->model ( 'no3/configs_model', 'configs' );
		$total_menu_list = $this->configs->get_navmenu ();
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运维管理",
						"child" => "角色列表" 
				),
				"header1" => array (
						"father" => "运维管理",
						"child" => "添加角色" 
				),
				'total_menu' => $total_menu_list,
				'role' => $this->Admin_model->getRole ( $role_id ) 
		);
		$this->load->view ( 'no3/admin_role_info_views', $data );
	}
	public function edit() {
		$role_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $role_id) {
			redirect ( 'no3/role/RoleList' );
		}
		
		$role = $this->Admin_model->getRole ( $role_id );
		if (empty ( $role ) || $role ['priv'] == 'all') {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/role/RoleList' );
		}
		
		$data ['role_name'] = trim ( $this->input->post ( 'role_name', true ) );
		if ($data ['role_name'] == '' || strlen ( $data ['role_name'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入角色名称' );
			redirect ( 'no3/role/toEdit/' . $role_id );
		}
		
		$priv = $this->input->post ( 'priv', true );
		if (! empty ( $priv )) {
			$data ['priv'] = json_encode ( $priv );
		} else {
			$data ['priv'] = '[]';
		}
		
		if ($this->Admin_model->updateRole ( $role_id, $data )) {
			$this->session->set_flashdata ( 'success', '修改成功' );
			redirect ( 'no3/role/RoleList' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/role/RoleList' );
		}
	}
}