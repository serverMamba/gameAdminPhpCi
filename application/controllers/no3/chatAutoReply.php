<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ChatAutoReply extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'chat_auto_reply' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Chat_auto_reply_model' );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "自动回复设置" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "自动回复设置 ",
				),
				"header2" => array (
						"father" => "玩家订单查询",
						"child" => "自动回复设置 " 
				),
				'chat_auto_reply_list' => $this->Chat_auto_reply_model->getChatAutoReplyList (),
		);
		
		$this->load->view ( 'no3/chat_auto_reply_view', $data );
	}


	/**
	 * 新增自动回复
	 */
	public function addReply() {
		$data ['keywords'] = $this->input->post ( 'keywords', true );
		if (! $data ['keywords']) {
			$this->session->set_flashdata ( 'error', '请填写关键词' );
			redirect ( 'no3/chatAutoReply' );
		}
		
		$data ['reply'] = $this->input->post ( 'reply', true );
		if (! $data ['reply']) {
			$this->session->set_flashdata ( 'error', '请填写回复内容' );
			redirect ( 'no3/chatAutoReply' );
		}
		
		if ($this->Chat_auto_reply_model->insertAutoReply ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/chatAutoReply' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/chatAutoReply' );
		}
	}
	
	/**
	 * 删除回复
	 */
	public function delReply() {
		$id = intval ( $this->input->get ( 'id', true ) );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/chatAutoReply' );
		}
		
		if ($this->Chat_auto_reply_model->deleteAutoReply ( $id )) {
			$this->session->set_flashdata ( 'success', '删除成功' );
			redirect ( 'no3/chatAutoReply' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/chatAutoReply' );
		}
	}

	/**
	 * 更新自动回复内容
	 */
	public function ajaxUpdateReply() {
		$id = intval ( $this->input->post ( 'id', true ) );
		if (! $id) {
			$this->show ( '0', '自动回复id错误' );
		}
		
		$keywords = $this->input->post ( 'keywords', true );
		if (! $keywords) {
			$this->show ( '0', '关键词错误' );
		}
		
		$reply = $this->input->post ( 'reply', true );
		if (! $reply) {
			$this->show ( '0', '回复内容错误 ');
		}
		
		$updateData = array('keywords' => $keywords, 'reply' => $reply) ;
		if (!$this->Chat_auto_reply_model->updateAutoReply ( $id, $updateData)) {
			$this->show ( '0', '更新失败 ');
		} else {
			exit ( json_encode ( (object)$updateData ) );
		}
	}

	private function show($status, $msg) {
		$return_ary = array (
				'status' => $status,
				'msg' => $msg 
		);
		exit ( json_encode ( $return_ary ) );
	}
}
