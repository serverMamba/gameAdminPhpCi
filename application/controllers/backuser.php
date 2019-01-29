<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backuser extends MY_Controller {
	
	public function __construct() {
		parent::__construct(true, false);
	}
	
	public function user_manage() {
		if(empty($this->uid)) {
			echo '<h2>你貌似不在登录状态</h2><h3>可能你在其它页面退出了系统</h3>';
			return;
		} elseif($this->gid != 1) {
			echo '<h2>禁止访问</h2><h3>本功能需要具有较高的系统管理权限，请确认你的帐号是否具有权限</h3>';
			return;
		}
		
		$this->load->model('backuser_model');
		$all_user = $this->backuser_model->get_all_user();
		$groups = $this->config->item('groups');

		$this->load->view('backuser/user_manage', array('all_user'=>$all_user, 'groups'=>$groups));
	}
	
	public function add_user_submit() {
		$callback		= $this->input->get('callback');
		$username		= $this->input->get('username');
		$password		= $this->input->get('password');
		$gid			= $this->input->get('gid');
		$realname		= $this->input->get('realname');
		
		if(empty($this->uid)) {
			echo jsonp_return($callback, RESPONSE_UN_LOGIN);
			return;
		} else if($this->gid != 1) {
			echo jsonp_return($callback, RESPONSE_ACCESS_DENIED);
			return;
		}
		
		if(empty($username)) {
			echo jsonp_return($callback, 2);
			return false;
		} 
		
		if(empty($password)) {
			echo jsonp_return($callback, 3);
			return;
		} else {
			$password = md5($password);
		}
		
		$groups = $this->config->item('groups');
		if(!array_key_exists($gid, $groups)) {
			echo jsonp_return($callback, 4);
			return;
		}
		
		if(empty($realname)) {
			echo jsonp_return($callback, 5);
			return;
		}
		
		$this->load->model('backuser_model');
		if($this->backuser_model->get_userinfo_by_username($username) !== array()) {
			echo jsonp_return($callback, 6);
			return;
		}
		
		$result = $this->backuser_model->add_user($username, $password, $gid, $realname);
		echo $result ? jsonp_return($callback, RESPONSE_OK) : jsonp_return($callback, RESPONSE_SYSTEM_BUSY);
	}
	
	function d() {
		$this->load->model('backuser_model');
		$result = $this->backuser_model->is_last_admin_user(1);
		var_dump($result);
	}
	
	public function delete_user_submit() {
		$callback		= $this->input->get('callback');
		$uid = $this->input->get('uid');
		$uid = intval($uid);
		
		if(empty($this->uid)) {
			echo jsonp_return($callback, RESPONSE_UN_LOGIN);
			return;
		} else if($this->gid != 1) {
			echo jsonp_return($callback, RESPONSE_ACCESS_DENIED);
			return;
		}
		
		$this->load->model('backuser_model');
		if($this->backuser_model->is_last_admin_user($uid) !== false) {
			echo jsonp_return($callback, 2);
			return;
		}
		
		$result = $this->backuser_model->delete_user($uid);
		echo  $result ? jsonp_return($callback, RESPONSE_OK) : jsonp_return($callback, RESPONSE_SYSTEM_BUSY);
	}
	
	public function edit_user_submit() {
		$callback		= $this->input->get('callback');
		$uid			= intval($this->input->get('uid'));
		$username		= $this->input->get('username');
		$password		= $this->input->get('password');
		$gid			= $this->input->get('gid');
		$realname		= $this->input->get('realname');
		
		if(empty($this->uid)) {
			echo jsonp_return($callback, RESPONSE_UN_LOGIN);
			return;
		} else if($this->gid != 1) {
			echo jsonp_return($callback, RESPONSE_ACCESS_DENIED);
			return;
		}
		
		$update = array();
		if(!empty($username)) {
			$update['username'] = $username;
		} 
		
		if(!empty($password)) {
			$update['password'] = md5($password);
		} 
		
		$groups = $this->config->item('groups');
		if(!array_key_exists($gid, $groups)) {
			echo jsonp_return($callback, 2);
			return;
		}
		
		$this->load->model('backuser_model');
		if($gid != 1 && $this->backuser_model->is_last_admin_user($uid) !== false) {
			echo jsonp_return($callback, 3);
			return;
		} else {
			$update['gid'] = $gid;
		}
		
		if(!empty($realname)) {
			$update['realname'] = $realname;
		} 
		
		$userinfo = $this->backuser_model->get_userinfo_by_username($username);
		if($userinfo === false) {
			echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY);
			return;
		} else if(!empty($userinfo) && $userinfo['uid'] != $uid) {
			echo jsonp_return($callback, 4);
			return;
		}
		
		$result = $this->backuser_model->update_user_by_uid($uid, $update);
		echo $result ? jsonp_return($callback, RESPONSE_OK) : jsonp_return($callback, RESPONSE_SYSTEM_BUSY);
	}
	
	public function edit_password() {
		if(empty($this->uid)) {
			echo '<h2>你貌似不在登录状态</h2><h3>可能你在其它页面退出了系统</h3>';
			return;
		}
		
		$this->load->view('backuser/edit_password');
	}
	
	public function edit_password_submit() {
		$callback		= $this->input->get('callback');
		$password		= $this->input->get('password');
		$new_password	= $this->input->get('new_password');
		$new_password2	= $this->input->get('new_password2');
		
		if(empty($this->uid)) {
			echo jsonp_return($callback, RESPONSE_UN_LOGIN);
			return;
		}
		
		if(empty($password)) {
			echo jsonp_return($callback, 2);
			return;
		} else {
			$password = md5($password);
		}
		
		if(empty($new_password)) {
			echo jsonp_return($callback, 3);
			return;
		}
		
		if($new_password != $new_password2) {
			echo jsonp_return($callback, 4);
			return;
		} else {
			$new_password = md5($new_password2);
		}
		
		$this->load->model('backuser_model');
		$result = $this->backuser_model->edit_password($this->uid, $password, $new_password);
		if($result == 1) {
			echo jsonp_return($callback, RESPONSE_OK);
		} elseif($result == -1) {
			echo jsonp_return($callback, 5);
		} else {
			echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY);
		}
	}
}
