<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_lib {
	private $auth_key = 'erv$gM&N{NDnIQ8(KB$rt~7Aa$Onyz7D';
	private $strict = true; //严格模式判断是否登录，会检查浏览器user_agent,IP地址变化等
	
	public function init_login() {
            return;
		if (session_id() == '' && !session_start()) die("Session Start Fail!");
		if (empty($_COOKIE['SMC_USER']) || empty($_COOKIE['SMC_AUTH'])) {
			session_unset();
			return false;
		}
		
		if (!empty($_SESSION['SMC_AUTH']) && ($_COOKIE['SMC_AUTH'] === $_SESSION['SMC_AUTH']) && ($_COOKIE['SMC_AUTH'] == $this->_info_auth($_COOKIE['SMC_USER']))) {
			return true;
		} else {
			if($_COOKIE['SMC_AUTH'] != $this->_info_auth($_COOKIE['SMC_USER'])) {
				session_unset();
				return false;
			}
	
			$user_info_tmp = gzuncompress(base64_decode($_COOKIE['SMC_USER']));
			parse_str($user_info_tmp,$user_info);
			if(!is_array($user_info)) {
				session_unset();
				return false;
			}
	
			foreach($user_info as $key => $value) {
				$_SESSION[$key] = rawurldecode($value);
			}
			$_SESSION['SMC_AUTH'] = $_COOKIE['SMC_AUTH'];
			return true;
		}
	}
	
	public function set_login_cookie($username, $login_expried_time = 0) {
		$CI = &get_instance();
		$CI->load->model('backuser_model');
		
		$result = $CI->backuser_model->get_userinfo_by_username($username);
		if(empty($result)) return false;	//取用户信息失败
		unset($result['password']); 
		
		
		$userinfo = array(
			'SMC_UID'			=>	$result['uid'],
			'SMC_USERNAME'		=>	$result['username'],
			'SMC_REALNAME'		=>	$result['realname'],
			'SMC_GID'			=>	$result['gid'],
			'SMC_ACCESS'		=>	$result['access'],
			'SMC_SYSTIME'		=>	microtime(), //这个值会确保用户信息未变化的情况下，每次生成的SMC_AUTH值都是不一样的
		);
		
		$package = '';
		foreach($userinfo as $key => $value) {
			$package .= '&' . $key . '=' . urlencode($value);
		}

		$package = base64_encode(gzcompress($package, 9));
		$info_auth = $this->_info_auth($package);
		
		setcookie('SMC_AUTH', $info_auth, $login_expried_time, '/');
		setcookie('SMC_USER', $package, $login_expried_time, '/');
		return true;
	}
	
	public function logout() {
		$expried = time() - 86400;
		setcookie('SMC_AUTH', '', $expried, '/');
		setcookie('SMC_USER', '', $expried, '/');
		setcookie('SMC_NO3_YG', '', $expried, '/');
		return true;
	}
	
	private function _info_auth($userinfo_package) {
		$CI = &get_instance();
		if($this->strict) {
			return sha1(md5($userinfo_package . $this->auth_key . $CI->input->server('HTTP_USER_AGENT') . $CI->input->ip_address()));
		} else {
			return sha1(md5($userinfo_package . $this->auth_key));
		}
	}
}