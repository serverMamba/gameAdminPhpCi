<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 注册存储过程中间层请求类
 * 
 * @author Yan.GF (yangf332@gmail.com)
 * @version 2012.12
 */

class Userchip_mid {
	protected $debug = false;				//是否开启DEBUG模式，开启将会打印很多信息
	protected $host = '10.0.0.3';	 	//中间层IP
	protected $port = '19601';				//中间层端口号

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
			$this->port = '19601';
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

    // 查看用户加减分纪录
    public function get_change_score($account, $from_time, $to_time, $offset, $limit=30) {
        //$result = $this->midware->request('R', array($offset, $limit), $account, true);
        // 缓存只能30条，清除缓存需要插入新记录 
        $result = $this->midware->request('T', array($from_time, $to_time, $offset, $limit), $account, true);

		if (is_array($result) && $result['2'] == '00') {
			return $result[3];
		} else if (is_array($result) && $result['2'] == '01') {
            return array();
		} else {
			return false;
		}
    }

    // 查看某一时间点加减分纪录
    public function get_score_by_time($offset=0, $limit=30, $from_time/*'2012-12-28 14:13:30'*/) {
        // 缓存只能30条，清除缓存需要插入新记录 
        $result = $this->midware->request('S', array($offset, 30), $from_time, true);

        if (is_array($result) && $result['2'] == '00') {
            return $result[3];
        } else {
            return false;
        }
    }

}
