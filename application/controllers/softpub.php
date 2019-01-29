<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Softpub extends MY_Controller {
	public $soft_path = '/var/www/tiaozhanbei.com/www/res/';

	public function __construct() {
		parent::__construct(true);
		
		if(ENVIRONMENT == 'development') {
			$this->soft_path = '/Users/artfantasy/Sites/tiaozhanbei.com/branches/www/res/';
		}
	}
	
	public function android() {
		$this->load->helper('file');
		$data = get_file_info($this->soft_path . 'guoguo.apk');
		$data['version'] = read_file($this->soft_path . 'android_update.html');
		
		$this->load->view('softpub/android', $data);
	}
	
	public function android_upload() {
		$this->load->library('upload');
		$this->load->helper('file');
		
		if($this->input->server('REQUEST_METHOD') != 'POST' || empty($_FILES)) {
			header('location: ' . site_url('softpub/android'));
			return;
		}
		
		$version = trim($this->input->post('version'));
		
		//修改上传失败提示语
		$this->lang->load('upload');
		$upload_error = &$this->lang->language;
		$upload_error['upload_invalid_filetype'] = '仅允许上传 apk 文件格式';
		$upload_error['upload_unable_to_write_file'] = '上传文件夹不可写，请联系网站开发人员';
		$upload_error['upload_no_file_selected'] = '请指定需要上传的文件';
		
		$config = array(
			'upload_path'	=>	$this->soft_path,
			'allowed_types'	=>	'apk',
			'file_name'		=>	'guoguo.apk',
			'overwrite'		=>	true,
			'mimes'			=>	array('apk'=>'application/octet-stream')
		);
		
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('upload_file')) {
			echo js_alert($this->upload->display_errors('',''));
			return;
		}
		
		if(!empty($version)) {
			$result = write_file($this->soft_path . 'android_update.html', $version, 'w');
			if(!$result) {
				echo js_alert('新版本已成功发布，但版本号写入失败，请联系网站开发人员', 'url', site_url('softpub/android'));
				return;
			}
		}
		
		echo js_alert('新版本已成功发布，版本号为：' . $version, 'url', site_url('softpub/android'), 'succeed');
	}
	
	public function pc() {
		$this->load->helper('file');
		$data = get_file_info($this->soft_path . 'GG.exe');
		
		$this->load->view('softpub/pc', $data);
	}
	
	public function pc_upload() {
		$this->load->library('upload');
		$this->load->helper('file');
		
		if($this->input->server('REQUEST_METHOD') != 'POST' || empty($_FILES)) {
			header('location: ' . site_url('softpub/pc'));
			return;
		}

		//修改上传失败提示语
		$this->lang->load('upload');
		$upload_error = &$this->lang->language;
		$upload_error['upload_invalid_filetype'] = '仅允许上传 exe 文件格式';
		$upload_error['upload_unable_to_write_file'] = '上传文件夹不可写，请联系网站开发人员';
		$upload_error['upload_no_file_selected'] = '请指定需要上传的文件';
		
		$config = array(
			'upload_path'	=>	$this->soft_path,
			'allowed_types'	=>	'exe',
			'file_name'		=>	'GG.exe',
			'overwrite'		=>	true,
		);
		
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('upload_file')) {
			echo js_alert($this->upload->display_errors('',''));
			return;
		}
		
		echo js_alert('新PC版本已成功发布', 'url', site_url('softpub/pc'), 'succeed');
	}
	
	public function iphone() {
		$this->load->helper('file');
		$data = get_file_info($this->soft_path . 'guoguo.ipa');
		
		$this->load->view('softpub/iphone', $data);
	}
	
	public function iphone_upload() {
		$this->load->library('upload');
		$this->load->helper('file');
		
		if($this->input->server('REQUEST_METHOD') != 'POST' || empty($_FILES)) {
			header('location: ' . site_url('softpub/iphone'));
			return;
		}

		//修改上传失败提示语
		$this->lang->load('upload');
		$upload_error = &$this->lang->language;
		$upload_error['upload_invalid_filetype'] = '仅允许上传 ipa 文件格式';
		$upload_error['upload_unable_to_write_file'] = '上传文件夹不可写，请联系网站开发人员';
		$upload_error['upload_no_file_selected'] = '请指定需要上传的文件';
		
		$config = array(
			'upload_path'	=>	$this->soft_path,
			'allowed_types'	=>	'*',
			'file_name'		=>	'guoguo.ipa',
			'overwrite'		=>	true,
		);
		
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('upload_file')) {
			echo js_alert($this->upload->display_errors('',''));
			return;
		}
		
		echo js_alert('新iPhone版本已成功发布', 'url', site_url('softpub/iphone'), 'succeed');
	}
	
	public function question($page = 1) {
		$page = $page < 1 ? 1 : intval($page);
		$per_page_num = 30;
		
		$this->load->helper('other');
		$this->load->database();
		
		$total_num = $this->db->count_all_results('download_question');
		$total_page = ceil($total_num / $per_page_num);
		if($page > $total_page) $page = $total_page;
		
		$this->db->order_by('id','desc');
		$result = $this->db->get('download_question', $per_page_num, ($page - 1) * $per_page_num);
		$question = array();
		foreach ($result->result_array() as $row) {
			$question[] = $row;
		}
		
		$data = array(
			'question'	=>	$question,
			'pageinfo'	=>	common_page_info($total_page, $page, site_url('softpub/question/{page}'))
		);
		$this->load->view('softpub/question', $data);
	}
}
