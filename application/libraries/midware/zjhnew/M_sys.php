<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 注册存储过程中间层请求类
 * 
 * @author Yan.GF (yangf332@gmail.com)
 * @version 2013.01.17
 */

class M_sys {
    protected $debug = false;               //是否开启DEBUG模式，开启将会打印很多信息
    protected $host = '10.0.0.3';       //中间层IP
    protected $port = '19601';              //中间层端口号

    protected $midware = null;

    // ------------------------------------------------------------------------

    /**
     * 构造函数
     * 在新写其它类似中间层时，构造函数可以直接复制本函数(From Midware_transform.php)
     * 
     * @param array $config 为方便调试可设定自定义中间层配置，一般情况下不用传入该参数
     */
    public function __construct($config = array()) {
        if(ENVIRONMENT == 'development') {  //如果是开发环境
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

    // 插入一条购买
    public function insert_purchase($account, $type, $chip, $source, $insert_date) {
        $result = $this->midware->request('A', array($type, $chip, $source, $insert_date), $account, true);
        if (is_array($result) && $result['2'] == '00') {
            return true;
        } else if (is_array($result) && $result['2'] == '01') {
            return array();
        } else {
            return false;
        }
    }

    // 查询一个类型的购买纪录
    public function get_purchase_by_type($type, $query_date, $offset, $limit) {
        $query_date = str_replace('-', '', $query_date);

        $result = $this->midware->request('B', array($query_date, $offset, $limit), $type, true);

        if (is_array($result) && $result['2'] == '00') {
            return $result[3];
        } else if (is_array($result) && $result['2'] == '01') {
            return array();
        } else {
            return false;
        }
    }

    // 查询一个类型的一个用户购买纪录 
    public function get_purchase_by_user($type, $account, $query_date, $offset, $limit) {
        $query_date = str_replace('-', '', $query_date);

        $result = $this->midware->request('C', array($account, $query_date, $offset, $limit), $type, true);

        if (is_array($result) && $result['2'] == '00') {
            return $result[3];
        } else if (is_array($result) && $result['2'] == '01') {
            return array();
        } else {
            return false;
        }       
    }

    // 查询最近的购买纪录
    public function get_purchase_recently($offset, $limit=50, $query_date) {
        $query_date = str_replace('-', '', $query_date);
        $result = $this->midware->request('D', array($offset, $limit), $query_date, true);

       if (is_array($result) && $result['2'] == '00') {
            return $result[3];
        } else if (is_array($result) && $result['2'] == '01') {
            return array();
        } else {
            return false;
        }
    }

    public function show() {
        return 'M_sys 2';
    }
}
