<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 注册存储过程中间层请求类
 * 
 * @author ARTFANTASY (artfantasy@gmail.com)
 * @version 2011.03.14 14:46
 */

class Register_poker {
	protected $debug = false;				//是否开启DEBUG模式，开启将会打印很多信息
	protected $host = '10.0.0.3';	 	//中间层IP
	//protected $port = '19301';				//中间层端口号
	protected $port = '20301';				//中间层端口号

	protected $midware = null;

	// ------------------------------------------------------------------------

	/**
	 * 构造函数
	 * 在新写其它类似中间层时，构造函数可以直接复制本函数(From Midware_transform.php)
	 * 
	 * @param array $config 为方便调试可设定自定义中间层配置，一般情况下不用传入该参数
	 */
	public function __construct($config = array()) {
		if(ENVIRONMENT == 'development') {	//如果是开发环境
			$this->host = '192.168.190.99';
			$this->port = '19991';
		}

		if(!is_array($config)) $config = array();

		$config['host'] = array_key_exists('host', $config) ? $config['host'] : $this->host;
		$config['port'] = array_key_exists('port', $config) ? $config['port'] : $this->port;
		$config['debug'] = array_key_exists('debug', $config) ? $config['debug'] : $this->debug;


		$class_name = __CLASS__;
		$CI = &get_instance();
		$CI->load->library('midware/midware', $config, $class_name);
		$this->midware = &$CI->$class_name;
	}


	/**
	 * 建立账号
	 * 
	 * @param
	 * @param
	 * @return
	 */
	public function create_new_user($email, $account, $password, $regfrom, $regip) {
		$password = mysql_escape_string($password);
		if((empty($account) && empty($email)) || empty($password)) {
			return false;
		}
		if (!empty($email))
		{
			$email_id = $this->get_id_from_email($email);
			if ($email_id > 0) {
				return array('1', $email_id);
			} else if ($email_id === false) {
				return array('99');
			}
		}

		if (!empty($account))
		{
			$acc_id = $this->get_id_from_account($account);
			if ($acc_id > 0 && !empty($email)) {
				$result1 = $this->update_user_email($acc_id, $email);
				$result2 = $this->update_user_pass($acc_id, $password);
				if ($result1 === true && $result2 === true) {
					return array('2', $acc_id);
				} else {
					return array('99');
				}
			} else if ($acc_id > 0 ) {
				return array('2', $acc_id);
			} else if ($acc_id === false) {
				return array('99');
			}
		}

		if (empty($email)) {
			$result = $this->insert_acc_user($account, $password, $regfrom, $regip);
		} else if (empty($account)) {
			$result = $this->insert_email_user($email, $password, $regfrom, $regip);
		} else {
			$result = $this->insert_new_user($email, $account, $password, $regfrom, $regip);
		}
		if ($result > 0) {
			return array('0', $result);
		} else {
			return array('99');
		}
	}

	public function get_id_from_email($email) {
		if (empty($email)) {
			return false;
		}

		$result = $this->midware->request('C', array(), $email);
		if (is_array($result) && $result['2'] == '00') {
			return $this->midware->ignore_len($result[3]);
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}

	public function get_id_from_account($account) {
		if (empty($account)) {
			return false;
		}

		$result = $this->midware->request('B', array(), $account);
		if (is_array($result) && $result['2'] == '00') {
			return $this->midware->ignore_len($result[3]);
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}

	public function get_info_from_id($id) {
		if (empty($id)) {
			return false;
		}

		$result = $this->midware->request('E', array(), $id, true);

		if (is_array($result) && $result['2'] == '00') {
			return $result[3][0];
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}

	public function update_user_email($id, $email) {
		if (empty($id) || empty($email)) {
			return false;
		}

		$result = $this->midware->request('D', array($email), $id);
		if (is_array($result) && $result['2'] == '00') {
			return true;
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}
	
	public function update_user_pass($id, $pass) {
		if (empty($id) || empty($pass)) {
			return false;
		}

		$result = $this->midware->request('H', array($pass), $id);
		if (is_array($result) && $result['2'] == '00') {
			return true;
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}

	public function insert_new_user($email, $acc, $pass, $regfrom, $regip) {
		if (empty($acc) || empty($email) || empty($pass)) {
			return false;
		}

		$key = rand();

		$result = $this->midware->request('A', array($email, $acc, $pass, $regfrom, $regip), $key);
		if (is_array($result) && $result['2'] == '00') {
			return $result[3];
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}
	public function insert_email_user($email, $pass, $regfrom, $regip) {
		if (empty($email) || empty($pass)) {
			return false;
		}

		$result = $this->midware->request('F', array($pass, $regfrom, $regip), $email);
		if (is_array($result) && $result['2'] == '00') {
			return $result[3];
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}
	public function insert_acc_user($acc, $pass, $regfrom, $regip) {
		if (empty($acc) || empty($pass)) {
			return false;
		}

		$result = $this->midware->request('G', array($pass, $regfrom, $regip), $acc);
		if (is_array($result) && $result['2'] == '00') {
			return $result[3];
		} else if (is_array($result) && $result['2'] == '01'){
			return 0;
		} else {
			return false;
		}
	}

    public function show() {
        return 'Register_poker 2';
    }
}
