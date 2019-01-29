<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Total_model extends CI_Model {
	var $totaldb = null;
	
	public function __construct() {
		parent::__construct();
		$this->totaldb = $this->load->database('total', true);
	}

    public function get_total($strDate) {
        $query = $this->totaldb->query("SELECT * FROM total WHERE total_time LIKE '" . $strDate . "%' ORDER BY total_time DESC");
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_profit($strDate) {
        $query = $this->totaldb->query("SELECT * FROM profit WHERE profit_day = '$strDate'");
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }


    public function get_top_user() {
        $query = $this->totaldb->query('SELECT * FROM top_user ORDER BY profit_day DESC');
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_top_num() {
        $query = $this->totaldb->query('SELECT * FROM top_num ORDER BY profit_day DESC');
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_reg_num($fromDay, $toDay) {
        $query = $this->totaldb->query("SELECT * FROM reg_num WHERE profit_day > '$fromDay' AND profit_day <= '$toDay'");
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
   
    /*
     * 查询包含前30天内的每日注册数
     */
    public function get_day_reg_num($fromDay, $toDay) {
        $query = $this->totaldb->query("SELECT profit_day, day_reg_num FROM reg_num WHERE profit_day > '$fromDay' AND profit_day <= '$toDay'");
    	if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

}
