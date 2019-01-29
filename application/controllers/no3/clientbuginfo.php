<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ClientBugInfo extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_clientbug' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/clientbug_model' );
	}
	public function index() {
		$select_tag = $this->input->get ( 'tag', true ) ? $this->input->get ( 'tag', true ) : '';
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
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$config ['base_url'] = site_url ( 'no3/clientbuginfo/index' );
		$this->load->view ( 'no3/sys_notice_list_views', $data );
	}
	public function toAdd() {
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
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$this->load->view ( 'no3/clientbugnew_views', $data );
	}
	public function toEdit() {
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'no3/clientbug' );
		}
		
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
				'operuser' => $this->session->userdata('admin_name'),
				'notice' => $this->clientbug_model->getBugForm ( $id ),
				'taglist' => $this->config->item ( 'taglist' ),
				'bugtypeArr' => $bugtypeArr = array ("bug" => "游戏Bug","install" => "无法安装","conn" => "无法连接","slow" => "游戏卡顿","flash" => "游戏闪退","other" => "其他问题")
		);
		$this->load->view ( 'no3/clientbuginfo_views', $data );
	}
	public function ajaxDelBug()
	{
		$bug_id = $this->input->post ( 'bug_id' ) ? $this->input->post ( 'bug_id' ) : 0;
		if (!$bug_id) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$flag = $this->clientbug_model->delClientBug($bug_id);
		$return_ary = array (
				'status' => '0',
				'msg' => $bug_id.'删除失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'msg' => $bug_id.'删除成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	
	}
	public function ajaxClosebug()
	{
		$bug_id = $this->input->post ( 'bug_id' ) ? $this->input->post ( 'bug_id' ) : "";
		if (!$bug_id) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$data = array (
					'status' => 1
		);
		$flag = $this->clientbug_model->updateClientBug($bug_id, $data);
		$return_ary = array (
				'status' => '0',
				'msg' => '关闭失败'
		);
		if($flag)
		{
			$return_ary = array (
				'status' => '1',
				'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
		
	}
	public function ajaxGetChildSolution()
	{
		$bug_id = $this->input->post ( 'bug_id' ) ? $this->input->post ( 'bug_id' ) : 0;
		if (!$bug_id) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$solutions = $this->clientbug_model->getChildSolution($bug_id);
		$return_ary = array (
				'status' => '0',
				'msg' => '无过往处理记录！'
		);
		if($solutions)
		{
			$return_ary = array (
					'status' => '1',
					'solutions' => $solutions,
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxSaveSolution() {
		$bug_id = $this->input->post ( 'bug_id' ) ? $this->input->post ( 'bug_id' ) : 0;
		$solution = $this->input->post ( 'solution' ) ? $this->input->post ( 'solution' ) : "";
		$operuser = $this->session->userdata('admin_name');
		if (!$bug_id || !$solution) {
			$return_ary = array (
				'status' => '0',
				'operuser' => $operuser,
				'time' => date('y-m-d h:i:s',time()),
				'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$solution = urldecode($solution);
		$data = array (
				'bug_id' => $bug_id,
				'operuser' => $operuser,
				'solution' => $solution
		);
		$flag = $this->clientbug_model->insertBugSolution($data);
		$return_ary = array (
				'status' => '0',
				'operuser' => $operuser,
				'time' => date('y-m-d h:i:s',time()),
				'msg' => '保存失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'operuser' => $operuser,
					'time' => date('y-m-d h:i:s',time()),
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxSaveBugNew() {
		$user_id = $this->input->post ( 'user_id' ) ? $this->input->post ( 'user_id' ) : "";
		$phonesystem = $this->input->post ( 'phonesystem' ) ? $this->input->post ( 'phonesystem' ) : "";
		$phonemodel = $this->input->post ( 'phonemodel' ) ? $this->input->post ( 'phonemodel' ) : "";
		$networktype = $this->input->post ( 'networktype' ) ? $this->input->post ( 'networktype' ) : "";
		$address = $this->input->post ( 'address' ) ? $this->input->post ( 'address' ) : "";
		$appsize = $this->input->post ( 'appsize' ) ? $this->input->post ( 'appsize' ) : "";
		$appsource = $this->input->post ( 'appsource' ) ? $this->input->post ( 'appsource' ) : "";
		$bugtype = $this->input->post ( 'bugtype' ) ? $this->input->post ( 'bugtype' ) : "bug";
		$describe = $this->input->post ( 'describe' ) ? $this->input->post ( 'describe' ) : "";
		$operuser = $this->session->userdata('admin_name');
		$status = 0;//默认开启状态
	
		if (!$user_id || !$phonesystem || !$networktype || !$describe) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
	
		$user_id = urldecode($user_id);
		$phonemodel = urldecode($phonemodel);
		$address = urldecode($address);
		$appsource = urldecode($appsource);
		$describe = urldecode($describe);
		$uuid = md5(uniqid());
		$data = array (
				'user_id' => $user_id,
				'phonesystem' => $phonesystem,
				'phonemodel' => $phonemodel,
				'networktype' => $networktype,
				'address' => $address,
				'appsize' => $appsize,
				'appsource' => $appsource,
				'bugtype' => $bugtype,
				'describe' => $describe,
				'operuser' => $operuser,
				'status' => $status,
				'uuid' => $uuid
		);
		$flag = $this->clientbug_model->insertBugNew($data);
		$return_ary = array (
				'status' => '0',
				'operuser' => $operuser,
				'time' => date('y-m-d h:i:s',time()),
				'msg' => '保存失败'
		);
		$res = $this->clientbug_model->getBugId($uuid);
		if($flag && !empty ( $res ) && $res['id'])
		{
			$return_ary = array (
					'status' => '1',
					'operuser' => $operuser,
					'time' => date('y-m-d h:i:s',time()),
					'bug_id' => $res['id'],
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function createBugForm()
	{
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
				'operuser' => $this->session->userdata('admin_name'),
				'taglist' => $this->config->item ( 'taglist' ),
				'bugtypeArr' => $bugtypeArr = array ("bug" => "游戏Bug","install" => "无法安装","conn" => "无法连接","slow" => "游戏卡顿","flash" => "游戏闪退","other" => "其他问题")
		);
		$this->load->view ( 'no3/clientbugnew_views', $data );
	}
	
}
