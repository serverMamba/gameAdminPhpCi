<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backuser_model extends CI_Model {
	var $userdb = null;
	
	public function __construct() {
		parent::__construct();
		$this->userdb = $this->load->database('', true);
	}

    public function get_userinfo_by_username($username) {
		$query = $this->userdb->get_where('backend_user', array('username'=> $username), 1);
		if(!is_object($query) || !$query->conn_id) {
			return false;
    	}else if($query->num_rows() > 0) {
			return $query->row_array();
		} else {
			return array();
		}
    }
    
    public function add_user($username, $password, $gid, $realname = '') {
    	$insert = array(
    		'username'	=>	$username,
    		'password'	=>	$password,
    		'gid'		=>	$gid,
    		'realname'	=>	$realname
    	);
    	return $this->userdb->insert('backend_user', $insert);
    }
    
    public function delete_user($uid) {
    	return $this->userdb->delete('backend_user', array('uid'=>$uid), 1);
    }
    
    public function update_user_by_uid($uid, $update) {
    	return $this->userdb->update('backend_user', $update, array('uid'=>$uid), 1);
    }
    
	public function update_user_by_username($username, $update) {
    	return $this->userdb->update('backend_user', $update, array('username'=>$username), 1);
    }
    
    public function add_login_count($username, $num = 1) {
    	$method = $num > 0 ? '+' : '-';
    	$num = abs(intval($num));
    	$this->userdb->set('login_count', "login_count{$method}{$num}", false);
    	$this->userdb->where('username', $username);
    	return $this->userdb->update('backend_user');
    }
    
    public function is_last_admin_user($uid) {
    	$query = $this->userdb->get_where('backend_user', array('gid'=>1));
    	if(!is_object($query) || !$query->conn_id) {
    		return null;
    	} else if($query->num_rows() > 0) {
			$admin_users =  $query->result_array();
			return count($admin_users) == 1 && $admin_users[0]['uid'] == $uid;
		} else {
			return false;
		}
    }
    
    public function get_all_user() {
    	$query = $this->userdb->get('backend_user');
    	if(!is_object($query) || !$query->conn_id) {
			return false;
    	}else if($query->num_rows() > 0) {
			return $query->result_array();
		} else {
			return array();
		}
    }

    public function edit_password($uid, $password, $new_password) {
        $update = array('password' => $new_password);
        return $this->userdb->update('backend_user', $update , array('uid'=>$uid, 'password'=>$password), 1); 
    }
}
