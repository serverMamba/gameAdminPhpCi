<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Miniblog extends MY_Controller {
	public $home_base_url = 'http://www.91guoguo.com';
	public $blog_pic_url = 'http://www.91guoguo.com';

	public function __construct() {
		parent::__construct(true);
	}
	
	public function newest($page = 1) {
		$page = intval($page);
		if($page < 1) $page = 1;
		$pernum = 30;
		
		$this->load->helper('other');
		$this->load->library('midware/miniblog_mid');
		$newest = $this->miniblog_mid->get_newest_blog('guest', $pernum, ($page - 1) * $pernum);
		if(is_array($newest) && !empty($newest)) {
			foreach ($newest as &$var) {
				$var['type'] = array_key_exists($var['type_id'], $this->miniblog_mid->miniblog_type_ids) ? $this->miniblog_mid->miniblog_type_ids["{$var['type_id']}"] : '未定义';
				$var['pic_url'] = empty($var['pic_url']) ? '' : $this->blog_pic_url . $var['pic_url'];
				$var['url']	= $this->home_base_url . '/home/' . $var['account'] . '?v=miniblog&id=' . $var['blogid'];
				$var['hurl'] = $this->home_base_url . '/home/' . $var['account'];
				$var['prime_url'] = '/miniblog/set_prime/' . $var['type_id'] . '/' . $var['account'] . '/' . $var['blogid'];
				$var['delete_url'] = '/miniblog/delete_blog/' . $var['account'] . '/' . $var['blogid'];
				if($var['source_id'] > 0) {
					$var['source_url'] = $this->home_base_url . '/home/' . $var['source_account'] . '?v=miniblog&id=' . $var['source_id'];
				}
			}
			unset($var);
		}
		
		$data = array(
			'newest'	=> $newest,
			'pageinfo'	=>	simple_page_info(site_url('miniblog/newest/{page}'), $page, $pernum, count($newest)),
		);
		
		$this->load->view('miniblog/newest', $data);
	}
	
	public function delete_blog($account, $blogid) {
		$this->load->library('midware/miniblog_mid');
		//echo js_alert("为防止造成一些缓存异常，暂未提供删除操作");
		//exit;
		
		$result = $this->miniblog_mid->delete_blog($account, $blogid);
		if($result) {
			echo js_echo('history.back(-1);');
		} else {
			echo js_alert("删除微博失败");
		}
	}
	
	public function prime($page = 1) {
		$page = intval($page);
		if($page < 1) $page = 1;
		$pernum = 30;
		
		$this->load->helper('other');
		$this->load->library('midware/miniblog_mid');
		$prime = $this->miniblog_mid->get_prime_blog_list($pernum, ($page - 1) * $pernum);
		if(is_array($prime) && !empty($prime)) {
			foreach ($prime as &$var) {
				$var = $this->miniblog_mid->get_blog_by_blogid($var['account'], $var['blogid']);
				$var['type'] = array_key_exists($var['type_id'], $this->miniblog_mid->miniblog_type_ids) ? $this->miniblog_mid->miniblog_type_ids["{$var['type_id']}"] : '未定义';
				$var['pic_url'] = empty($var['pic_url']) ? '' : $this->blog_pic_url . $var['pic_url'];
				$var['url']	= $this->home_base_url . '/home/' . $var['account'] . '?v=miniblog&id=' . $var['blogid'];
				$var['hurl'] = $this->home_base_url . '/home/' . $var['account'];
				$var['cancel_url'] = '/miniblog/cancel_prime/' . $var['account'] . '/' . $var['blogid'];
				if($var['source_id'] > 0) {
					$var['source_url'] = $this->home_base_url . '/home/' . $var['source_account'] . '?v=miniblog&id=' . $var['source_id'];
				}
			}
			unset($var);
		}
		
		$data = array(
			'prime'	=> $prime,
			'pageinfo'	=>	simple_page_info(site_url('miniblog/prime/{page}'), $page, $pernum, count($prime)),
		);
		
		$this->load->view('miniblog/prime', $data);
	}
	
	public function set_prime($type_id, $account, $blogid) {
		$this->load->library('midware/miniblog_mid');
		$result = $this->miniblog_mid->set_prime_blog($type_id, $account, $blogid);
		if($result) {
			echo js_echo('history.back(-1);');
		} else {
			echo js_alert("设置精华失败");
		}
	}
	
	public function cancel_prime($account, $blogid) {
		$this->load->library('midware/miniblog_mid');
		$result = $this->miniblog_mid->cancel_prime_blog($account, $blogid);
		if($result) {
			echo js_echo('history.back(-1);');
		} else {
			echo js_alert("取消精华失败");
		}
	}
}