<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usernew_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        $this->dbalias   = $this->config->item('dbalias');
        // 用到的表名
        $this->dbuser    = $this->dbalias['dbuser'];
        $this->tbuser    = $this->dbalias['tbuser'];
        $this->tbuseridx = $this->dbalias['tbuseridx'];
    }


    /*
     * 查询用户信息通过sql语句
     */
    public function get_user_by_s($account) {

        $idx = $this->get_user_db_idx($account);

        if (!$idx || empty($idx)) {
            return false;
        }

        $idx_db = $idx['dbindex']; 
        $idx_tb = $idx['tableindex']; 
        $email  = $idx['useraccount']; 

        $this->_use_read_userdb($idx_db);
        $this->_use_db($this->dbuser . $idx_db);
        print_r($this->dbconfig);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $query = $this->db->get_where($this->tbuser . $idx_tb, array('user_email' => $email));

        if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            $arr = $query->result_array();
            return $arr[0];
        } else {
            return array();
        }
       
    }

    /*
     * 更新用户信息
     * @return boolean
     */
    public function update_userinfo($account, $k, $v) {

        $idx = $this->get_user_db_idx($account);
        if (!$idx || empty($idx)) {
            return false;
        }

        $idx_db = $idx['dbindex']; 
        $idx_tb = $idx['tableindex']; 
        $email  = $idx['useraccount']; 

        $this->_use_write_userdb($idx_db);

        $this->_use_db($this->dbuser . $idx_db);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $result = $this->db->update($this->tbuser . $idx_tb, array($k => $v), array('user_email' => $email));

        return $result;
    }

    public function addvalue($account, $k, $v) {
        $ret = $this->update_value($account, $k, '+', $v);
        return $ret;
    }

    public function reducevalue($account, $k, $v) {
        $ret = $this->update_value($account, $k, '-', $v);
        return $ret;
    }

    /*
     * 根据操作符更新值,比如在原值上增减
     */
    public function update_value($account, $k, $operator, $v) {
        $idx = $this->get_user_db_idx($account);
        if (!$idx || empty($idx)) {
            return false;
        }

        $idx_db = $idx['dbindex']; 
        $idx_tb = $idx['tableindex']; 
        $email  = $idx['useraccount']; 

        $this->_use_write_userdb($idx_db);

        $this->_use_db($this->dbuser . $idx_db);
        $this->db = $this->load->database($this->dbconfig, true);
        
        $this->db->where('user_email', $email);
        //$this->db->where('id', $uid);
        $this->db->set($k, "$k $operator $v", false);
        $result = $this->db->update($this->tbuser . $idx_tb);

        return $result;
    }

    /*
     * 得到用户信息的库表索引
     */
    public function get_user_db_idx($account) {
        
        if (strpos($account, '@') || strpos($account, ':')) {
            $ret = $this->get_info_index_by_email($account);      
        } else {
            $ret = $this->get_info_index_by_uid($account);
        }

        return $ret;
    }


    /*
     * 得到用户信息的库表索引
     * return array(id, userid, useraccount, dbindex, tableindex)
     */ 
    public function get_info_index_by_uid($uid) {

        $idx = $this->_get_map_idx_by_uid($uid);
        $idx_db = $idx['idx_db']; 
        $idx_tb = $idx['idx_tb']; 
        
        

        $this->_use_read_userdb($idx_db);
        $this->_use_db($this->dbuser . $idx_db);
        
   
        $ret = $this->db = $this->load->database($this->dbconfig, true);
        
        
        $query = $this->db->get_where($this->tbuseridx . $idx_tb, array('userid' => $uid));

        if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            $arr = $query->result_array();
            return $arr[0];
        } else {
            return array();
        }        

    }
    
    /*
     * 得到用户信息的库表索引(by email)
     * return array(useraccount, dbindex, tableindex)
     */
    public function get_info_index_by_email($email) {
        //echo 'Usernew_model | get_info_index_by_email';
        $host = 'fasthashserver.pokerjoin.com';
        $port = 3012;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        $conn = socket_connect($socket, $host, $port);

        socket_write($socket, $email);
        $str = socket_read($socket, 1024); /* 倒数第二位为库索引，倒数第一位为表索引 */
        socket_close($socket);
       
        // 防止溢出，截取后8位
        $str = substr($str, -8);
        $str = strrev(dechex($str));
        $tb = hexdec($str{0});
        $db = hexdec($str{1});
        
        $ret = array(
            'useraccount' => $email,
            'dbindex'     => $db,
            'tableindex'  => $tb,
        );

        return $ret;
    }

    /*
     * 通过uid得到映射库表索引
     */
    private function _get_map_idx_by_uid($uid) {
        $tmp = $uid & 0x00000000000000FF;
        return array(
            'idx_db' => ($tmp & 0xF0) >> 4,
            'idx_tb' => $tmp & 0x0F    
        ); 

    }


    /******************************
     * test code from here 
     *****************************/

}
