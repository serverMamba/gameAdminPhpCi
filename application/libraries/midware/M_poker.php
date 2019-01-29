<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * IP管理
 */

class M_poker {
    protected $debug = false;               //是否开启DEBUG模式，开启将会打印很多信息
    protected $host = '10.0.0.3';  //中间层IP
    protected $port = '19301';              //中间层端口号
    
    protected $midware = null;
    
    /**
     * 构造函数
     * 在新写其它类似中间层时，构造函数可以直接复制本函数(From Midware_transform.php)
     * 
     * @param array $config 为方便调试可设定自定义中间层配置，一般情况下不用传入该参数
     */
    public function __construct($config = array()) {
        if(ENVIRONMENT == 'development') {  //如果是开发环境
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
     * 取一个ip是否在黑名单
     * @param  [type] $ip [description]
     * @return [type]     [description]
     */
    public function get($ip) {

        $ip = mysql_escape_string(strtolower(trim($ip)));
        if (empty($ip)) return false;

        $request = array('ip' => $ip);
        
        $result = $this->midware->request('1', array(), $ip);
        
        if (is_array($result) && $result['2'] == '00') {
            return true; //存在
        } else if (is_array($result) && $result['2'] == '01'){
            return 0;    //不存在
        } else {
            return false;
        }

    }

    /**
     * 插入一个ip
     * @param [type] $ip [description]
     */
    public function add($ip) {
        $ip = mysql_escape_string(strtolower(trim($ip)));
        if (empty($ip)) return false;

        $result = $this->midware->request('2', array(), $ip);
        return (is_array($result) && $result[2] == '00');

    }

    /**
     * 删除一个ip
     * @param  [type] $ip [description]
     * @return [type]     [description]
     */
    public function del($ip) {

        $ip = mysql_escape_string(strtolower(trim($ip)));
        if (empty($ip)) return false;
        
        $result = $this->midware->request('3', array(), $ip);
        return (is_array($result) && $result[2] == '00');

    }

    public function get_all() {
        $result = $this->midware->request('4', array(), 'system', true);

        if (is_array($result) && $result['2'] == '00') {
            return $result[3]; 
        } else {
            return array();
        }
    }
    
}
