<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 用户资料中间层请求类
 * 
 * @author ARTFANTASY (artfantasy@gmail.com)
 * @version 2011.03.17 19:18
 */

class Userinfo_mid {
	protected $debug = false;				//是否开启DEBUG模式，开启将会打印很多信息
	protected $host = '10.0.0.3';	//中间层IP
	protected $port = '18301';				//中间层端口号
	
	protected $midware = null;
	
	/**
	 * 构造函数
	 * 在新写其它类似中间层时，构造函数可以直接复制本函数(From Midware_transform.php)
	 * 
	 * @param array $config 为方便调试可设定自定义中间层配置，一般情况下不用传入该参数
	 */
	public function __construct($config = array()) {
		if(ENVIRONMENT == 'development') {	//如果是开发环境
			$this->host = '192.168.190.99';
			$this->port = '18301';
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
	 * 获取用户信息
	 * 如果没有该用户的信息记录,不会返回false,而是会返回一个所有键对应的值都为空的数组
	 * 
	 * @param string $account
	 * @param mixed $field 要获取的字段，可传数组或逗号分隔的键名
	 * @return mixed false or array
	 */
	public function get($account, $field = 'nickname') {
		$account = mysql_escape_string(strtolower(trim($account)));
		if(!is_array($field)) $field = explode(',', $field);
		
		if(empty($account) || empty($field)) return false;
		array_walk($field, @create_function('&$v,$k','$v=mysql_escape_string(trim($v));'));
		
		$result = $this->midware->request('R', $field, $account);

		if(is_array($result) && $result[1] == '00' && count($result) > 3) {
			$ret = array();
			$result = array_slice($result, 2);
			reset($result);
			$key = next($result);
			while ($key) {
				$ret[$key] = next($result);
				$key = next($result);
			}
			
			return $ret;
		} else if(is_array($result) && $result[1] == '01') {
			return array_combine($field, array_fill(0, count($field), ''));
		} else {
			return false;
		}
	}
	
	/**
	 * 设置用户信息
	 * 
	 * @param string $account
	 * @param array $info 要设置的用户信息数组
	 */
	public function set($account, $info) {
		$account = mysql_escape_string(strtolower(trim($account)));
		if(empty($account) || !is_array($info) || empty($info)) return false;
		
		$request = array();
		foreach ($info as $key => $value) {
			$request[] = mysql_escape_string(trim($key));
			//$request[] = mysql_escape_string($value);
			$request[] = $value;
		}

		$result = $this->midware->request('W', $request, $account);
		if(is_array($result) && $result[2] == $account && $result[1] == '00') {
			/*
			//以下三个字段更新时需要通知GIS中间层进行推荐排序等（万恶的业务逻辑，写在这里）
			if(array_key_exists('user_faceurl',$info) || array_key_exists('sex',$info) || array_key_exists('user_birthyear',$info)) {
				$CI = &get_instance();
				$CI->load->library('midware/gis_mid');
				$CI->gis_mid->userinfo_update_notify($account, $info);
			}
			 */
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * 给计数器型字段增减数值
	 * 比如积分，勋章数，荣誉值什么的
	 * 
	 * $info示例：
	 * 	array(
	 * 		'user_score'		=>	15,
	 * 		'user_badgenumber	=>	-3
	 * 	);
	 * 
	 * @param string $account
	 * @param array $info 可以同时为几个计数器增减值，增加值时数组对应键值为正数，减少值时数组对应键值为负数
	 * @return boolean
	 */
	public function add($account, $info) {
		$account = mysql_escape_string(strtolower(trim($account)));
		if(empty($account) || !is_array($info) || empty($info)) return false;
		
		$request = array();
		foreach ($info as $key => $value) {
			$request[] = mysql_escape_string(trim($key));
			$request[] = intval($value);
		}
		
		$result = $this->midware->request('A', $request, $account);
		return (is_array($result) && $result[2] == $account && $result[1] == '00');
	}
	
	/**
	 * 增减积分
	 * 
	 * @param string $account
	 * @param int $add_score 正数为增加，负数为减少
	 * @return boolean
	 */
	public function add_score($account , $add_score) {
		return $this->add($account, array('score' => $add_score));
	}
	
	/**
	 * 清除该用户在中间层中的用户信息Cache
	 * 一般开发不需要调用，只有怀疑中间层缓存有错误时才用一下
	 * 
	 * @param string $account
	 * @return boolean
	 */
	public function clear_cache($account) {
		$account = mysql_escape_string(strtolower(trim($account)));
		if(empty($account)) return false;
		
		$result = $this->midware->request('C', array(), $account);
		return (is_array($result) && $result[2] == $account && $result[1] == '00');
	}
}
