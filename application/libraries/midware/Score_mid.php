<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 注册存储过程中间层请求类
 * 
 * @author ARTFANTASY (artfantasy@gmail.com)
 * @version 2011.03.14 14:46
 */

class Score_mid {
	protected $debug = false;				//是否开启DEBUG模式，开启将会打印很多信息
	protected $host = '10.0.0.3';	 	//中间层IP
	protected $port = '22221';				//中间层端口号

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
			$this->host = '127.0.0.1';
			$this->port = '22221';
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

	public function get_score($id) {
        $result = $this->midware->request('R', array(), $id);
		if (is_array($result) && $result['1'] == '00') {
			return $result[3];
		} else {
			return false;
		}
	}
    
	public function add_score($id, $score, $from='USER_WEB_BUY') {
		$result = $this->midware->request('A', array($score, $from), $id);
		if (is_array($result) && $result['1'] == '00') {
			return $result[3];
		} else {
			return false;
		}
	}
    
    public function del_score($id, $score, $from='USER_WEB_BUY') {
		$result = $this->midware->request('D', array($score, $from), $id);
		if (is_array($result) && $result['1'] == '00') {
			return $result[3];
		} else {
			return false;
		}
	}
}
