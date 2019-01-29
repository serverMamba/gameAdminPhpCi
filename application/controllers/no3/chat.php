<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Chat extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kefu_chat' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Chat_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
		$this->load->model ( 'api/User_model' );
	}
	public function rgkf() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		$brecharge = $redis->get ( 'brecharge' );
		if ($brecharge == '1') {
			$redis->set ( 'brecharge', '2' );
		} else {
			$redis->set ( 'brecharge', '1' );
		}
		$redis->close ();
		
		$this->session->set_flashdata ( 'success', '设置成功' );
		redirect ( 'no3/chat' );
	}
	public function index() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			redirect ( 'no3/login' );
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				'is_chat' => $admin ['is_chat'],
				'chat_list' => $this->Chat_model->getChatSessionList ( $admin_id, $start, $per, $redis ),
				'reply_list' => $this->Chat_model->getQuickContentList (),
				'super_admin_list' => $this->Chat_model->getSuperAdminAry (),
				'web_check' => $this->checkServer(),
		);
		
		$data ['total_rows'] = $this->Chat_model->getChatSessionNum ( $admin_id );
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/chat/index' );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		if ($redis->get ( 'emergency_reply' )) {
			$data ['is_emergency'] = 1;
		} else {
			$data ['is_emergency'] = 0;
		}
		
		$data['brecharge'] = $redis->get ( 'brecharge' );
		$redis->close ();
		$this->load->view ( 'no3/chat_list_views', $data );
	}
	public function setAdminIsChat() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			redirect ( 'no3/login' );
		}
		
		if ($admin ['role_id'] == 1) {
			$this->session->set_flashdata ( 'error', '超级管理员不能设置' );
			redirect ( 'no3/chat' );
		}
		
		$is_chat = $admin ['is_chat'] ? 0 : 1;
		if ($is_chat == 0) {
			$chat_admin_num = $this->Chat_model->getChatAdminNum ();
			if ($chat_admin_num <= 1) {
				$this->session->set_flashdata ( 'error', '当前在线客服不能少于1个，不能离线' );
				redirect ( 'no3/chat' );
			}
		}
		
		$data = array (
				'is_chat' => $is_chat 
		);
		if ($this->Admin_model->updateAdmin ( $admin_id, $data )) {
			// // 转客服的逻辑
			if ($is_chat == 0) {
				$this->Chat_model->offLineUpdateChatAdmin ( $admin_id );
			}
			
			$this->session->set_flashdata ( 'success', '设置成功' );
			redirect ( 'no3/chat' );
		} else {
			$this->session->set_flashdata ( 'error', '设置失败' );
			redirect ( 'no3/chat' );
		}
	}
	public function reply() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			redirect ( 'no3/login' );
		}
		
		$user_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $user_id) {
			redirect ( 'no3/chat' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->session->set_flashdata ( 'error', '该聊天已经分配给其他客服' );
			redirect ( 'no3/chat' );
		}
		
		$chat_content_list = $this->Chat_model->getChatContentList ( $user_id, '' );
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				'user_id' => $user_id,
				'chat_list' => $chat_content_list,
				'tmp_time' => $chat_content_list [count ( $chat_content_list ) - 1] ['add_time'],
				'reply_list' => $this->Chat_model->getQuickContentList () 
		);
		
		$this->load->view ( 'no3/chat_info_views', $data );
	}
	public function ajaxSetReply() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			$this->show ( 0, '管理员不存在' );
		}
		
		$user_id = $this->input->get ( 'user_id' ) ? intval ( $this->input->get ( 'user_id' ) ) : 0;
		if (! $user_id) {
			$this->show ( 0, '参数错误' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->show ( 0, '该聊天已经分配给其他客服' );
		}
		
		$data ['is_user_reply'] = 0;
		if ($this->Chat_model->updateSession ( $user_id, $data )) {
			$this->show ( 1, 'ok' );
		} else {
			$this->show ( 0, '系统错误' );
		}
	}
	public function setReply() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			redirect ( 'no3/chat' );
		}
		
		$user_id = $this->input->get ( 'user_id' ) ? intval ( $this->input->get ( 'user_id' ) ) : 0;
		if (! $user_id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/chat' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->session->set_flashdata ( 'error', '该聊天已经分配给其他客服' );
			redirect ( 'no3/chat' );
		}
		
		$data ['is_user_reply'] = 0;
		if ($this->Chat_model->updateSession ( $user_id, $data )) {
			$this->session->set_flashdata ( 'success', '成功' );
			redirect ( 'no3/chat' );
		} else {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/chat' );
		}
	}
	public function closeChatSession() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin = $this->Admin_model->getAdmin ( '', $admin_id );
		if (empty ( $admin )) {
			redirect ( 'no3/login' );
		}
		
		$user_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $user_id) {
			redirect ( 'no3/chat' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->session->set_flashdata ( 'error', '该聊天已经分配给其他客服' );
			redirect ( 'no3/chat' );
		}
		
		$data ['admin_id'] = 0;
		if ($this->Chat_model->updateSession ( $user_id, $data )) {
			$this->session->set_flashdata ( 'success', '完成' );
			redirect ( 'no3/chat' );
		} else {
			$this->session->set_flashdata ( 'error', '关闭失败' );
			redirect ( 'no3/chat' );
		}
	}
	public function toOtherAdmin() {
		$admin_id = $this->session->userdata ( 'id' );
		$user_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $user_id) {
			redirect ( 'no3/chat' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->session->set_flashdata ( 'error', '该聊天已经分配给其他客服' );
			redirect ( 'no3/chat' );
		}
		
		$admin_list = $this->Chat_model->getSelectAdminList ( $admin_id );
		if (empty ( $admin_list )) {
			$this->session->set_flashdata ( 'error', '没有其他客服在线，无法分配' );
			redirect ( 'no3/chat' );
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				'user_id' => $user_id,
				'admin_list' => $admin_list 
		);
		
		$this->load->view ( 'no3/chat_select_admin_views', $data );
	}
	public function batchToOtherAdmin() {
		$admin_id = $this->session->userdata ( 'id' );
		$admin_list = $this->Chat_model->getSelectAdminList ( $admin_id );
		if (empty ( $admin_list )) {
			$this->session->set_flashdata ( 'error', '没有其他客服在线，无法分配' );
			redirect ( 'no3/chat' );
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				'admin_list' => $admin_list,
				'session_num' => $this->Chat_model->getNoProcessChatSessionNum ( $admin_id ) 
		);
		
		$this->load->view ( 'no3/batch_chat_select_admin_views', $data );
	}
	public function assignAdmin() {
		$admin_id = $this->session->userdata ( 'id' );
		$user_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $user_id) {
			redirect ( 'no3/chat' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $admin_id && ! in_array ( $admin_id, $this->Chat_model->getSuperAdminAry () ))) {
			$this->session->set_flashdata ( 'error', '该聊天已经分配给其他客服' );
			redirect ( 'no3/chat' );
		}
		
		$assign_admin_id = intval ( $this->input->post ( 'admin_id', true ) );
		if (! $assign_admin_id) {
			$this->session->set_flashdata ( 'error', '请选择客服' );
			redirect ( 'no3/chat/toOtherAdmin/' . $user_id );
		}
		
		$data ['admin_id'] = $assign_admin_id;
		if ($this->Chat_model->updateSession ( $user_id, $data )) {
			$this->session->set_flashdata ( 'success', '分配成功' );
			redirect ( 'no3/chat' );
		} else {
			$this->session->set_flashdata ( 'error', '分配失败' );
			redirect ( 'no3/chat' );
		}
	}
	public function batchAssignAdmin() {
		$admin_id = $this->session->userdata ( 'id' );
		$assign_admin_id = intval ( $this->input->post ( 'admin_id', true ) );
		if (! $assign_admin_id) {
			$this->session->set_flashdata ( 'error', '请选择客服' );
			redirect ( 'no3/chat/batchToOtherAdmin' );
		}
		
		$session_num = $this->Chat_model->getNoProcessChatSessionNum ( $admin_id );
		$covert_num = intval ( $this->input->post ( 'assign_num', true ) );
		if ($covert_num > $session_num) {
			$this->session->set_flashdata ( 'error', '转客服数量不能大于未处理数量' );
			redirect ( 'no3/chat/batchToOtherAdmin' );
		}
		
		$data ['admin_id'] = $assign_admin_id;
		if ($this->Chat_model->batchUpdateSession ( $admin_id, $data, $covert_num )) {
			$this->session->set_flashdata ( 'success', '批量分配成功' );
			redirect ( 'no3/chat' );
		} else {
			$this->session->set_flashdata ( 'error', '批量分配失败' );
			redirect ( 'no3/chat' );
		}
	}
	public function quickReplyList() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				'reply_list' => $this->Chat_model->getQuickContentList () 
		);
		$this->load->view ( 'no3/chat_quick_content_list_views', $data );
	}
	public function addQuickReplyContent() {
		$data ['content'] = strip_tags ( $this->input->post ( 'content', true ) );
		if (trim ( $data ['content'] ) == '') {
			$this->session->set_flashdata ( 'error', '请输入内容' );
			redirect ( 'no3/chat/quickReplyList' );
		}
		
		if ($this->Chat_model->insertQuickReply ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/chat/quickReplyList' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/chat/quickReplyList' );
		}
	}
	public function delQuickReplyContent() {
		$id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $id) {
			redirect ( 'no3/chat/quickReplyList' );
		}
		
		if ($this->Chat_model->delQuickReply ( $id )) {
			$this->session->set_flashdata ( 'success', '删除成功' );
			redirect ( 'no3/chat/quickReplyList' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/chat/quickReplyList' );
		}
	}
	public function emergencyReply() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "在线客服" 
				) 
		);
		$this->load->view ( 'no3/chat_emergency_reply_views', $data );
	}
	public function addEmergencyContent() {
		$content = strip_tags ( $this->input->post ( 'content', true ) );
		if (trim ( $content ) == '') {
			$this->session->set_flashdata ( 'error', '请输入内容' );
			redirect ( 'no3/chat/emergencyReply' );
		}
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->set ( 'emergency_reply', $content );
		$redis->close ();
		$this->session->set_flashdata ( 'success', '开启紧急回复成功' );
		redirect ( 'no3/chat' );
	}
	public function closeEmergency() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->del ( 'emergency_reply' );
		$redis->close ();
		$this->session->set_flashdata ( 'success', '关闭紧急回复成功' );
		redirect ( 'no3/chat' );
	}
	public function cancelGag() {
		$user_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $user_id) {
			redirect ( 'no3/chat' );
		}
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$redis->del ( 'gag_' . $user_id );
		$redis->close ();
		$this->session->set_flashdata ( 'success', '解除禁言成功' );
		redirect ( 'no3/chat' );
	}
	public function ajaxGag() {
		$user_id = intval ( $this->input->get ( 'user_id', true ) );
		if (! $user_id) {
			$this->show ( '0', '用户id错误' );
		}
		
		$gag_time = intval ( $this->input->get ( 'gag_time', true ) );
		
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		if ($gag_time == - 1) {
			$r = $redis->set ( 'gag_' . $user_id, '1' );
		} else {
			$r = $redis->setex ( 'gag_' . $user_id, $gag_time, '1' );
		}
		$redis->close ();
		if ($r) {
			$this->show ( '1', '成功' );
		} else {
			$this->show ( '0', '失败' );
		}
	}
	public function ajaxGetContent() {
		$tmp_time = $this->input->post ( 'tmp_time', true ) ? intval ( $this->input->post ( 'tmp_time', true ) ) : 0;
		$user_id = intval ( $this->input->post ( 'user_id', true ) );
		if (! $user_id) {
			$this->show ( '0', '用户id错误' );
		}
		
		$chat_content_list = $this->Chat_model->getChatContentList ( $user_id, $tmp_time );
		$return_ary = array (
				'status' => '1',
				'msg' => '成功',
				'content_list' => $chat_content_list 
		);
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxPostContent() {
		$data ['admin_id'] = $this->session->userdata ( 'id' );
		$role_id = $this->session->userdata ( 'role_id' );
		
		$user_id = intval ( $this->input->post ( 'user_id', true ) );
		if (! $user_id) {
			$this->show ( '0', '用户id错误' );
		}
		
		$data ['content'] = strip_tags ( urldecode ( $this->input->post ( 'content', true ) ) );
		if ($data ['content'] == '') {
			$this->show ( '0', '请输入内容' );
		}
		
		$chat_session = $this->Chat_model->getSession ( $user_id );
		if (empty ( $chat_session ) || ($chat_session ['admin_id'] != $data ['admin_id'] && ! in_array ( $data ['admin_id'], $this->Chat_model->getSuperAdminAry () ))) {
			$this->show ( '0', '该聊天已经分配给其他客服' );
		}
		
		if ($role_id == 14) {
			$data ['is_recharge'] = 1;
		}
		$data ['user_id'] = $user_id;
		$data ['add_time'] = time ();
		if ($this->Chat_model->insertMessage ( $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$chat_session_ary = $this->Chat_model->getLastNotReplyChatSession ( $data ['admin_id'], 0, 1, $redis );
			$redis->close ();
			$return_ary = array (
					'status' => '1',
					'msg' => '回复成功',
					'admin_name' => $this->session->userdata ( 'admin_name' ),
					'add_time' => date ( 'Y-m-d H:i:s', $data ['add_time'] ),
					'next_user_id' => $chat_session_ary [0] ['user_id'],
					'next_admin_id' => $chat_session_ary [0] ['admin_id'] 
			);
			// 推送
			$this->Push_model->addPushQueue ( $user_id, $data ['content'] );
			exit ( json_encode ( $return_ary ) );
		} else {
			$this->show ( '0', '系统错误' );
		}
	}
	private function show($status, $msg) {
		$return_ary = array (
				'status' => $status,
				'msg' => $msg 
		);
		exit ( json_encode ( $return_ary ) );
	}
	
	public function checkServer(){
		$redis_config = $this->config->item ( 'redis' );
		$status = $this->pingAddress($redis_config ['host']);
		if(!$status){
			return "Redis不通，请通知技术人员！";
		}
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$tip_msg = $redis->get("auto_web_check");
		$redis->close ();
		if($tip_msg){
			$tip_msg = "异常SERVER,请通知技术人员: [".$tip_msg."]";
		}
		return $tip_msg;
	}
	private function doCheck($curl){
		$httpCode = 0;
		try{
			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $curl );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt	( $ch, CURLOPT_TIMEOUT, 2);  //单位 秒，也可以使用
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( null ) );
			$return = curl_exec ( $ch );
			$httpCode = curl_getinfo($ch,CURLINFO_HTTP_CODE);
			curl_close ( $ch );
		}catch(Exception $e){
			
		}
		return $httpCode;
	}
	private function pingAddress($address) {
		$status = -1;
		$pingresult = exec("ping -c 1 {$address}", $outcome, $status);
		if (0 == $status) {
			return true;
		}
		return false;
	}
	
}