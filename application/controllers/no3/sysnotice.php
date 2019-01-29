<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Sysnotice extends MY_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_xtgg' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Notice_model' );
	}
	public function index() {
		$select_tag = $this->input->get ( 'tag', true ) ? $this->input->get ( 'tag', true ) : '';
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				'notice_list' => $this->Notice_model->getNoticeList ( $select_tag, $start, $per ),
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		
		$data ['total_rows'] = $this->Notice_model->getNoticeNum ();
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/sysnotice/index' );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/sys_notice_list_views', $data );
	}
	public function toAdd() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				'allChannelList' => $this->config->item ( 'allChannelList' ) 
		);
		// print_r($this->config->item('taglist'));
		$this->load->view ( 'no3/sys_notice_info_views', $data );
	}
	public function add() {
		$data ['title'] = trim ( $this->input->post ( 'title', true ) );
		if ($data ['title'] == '' || strlen ( $data ['title'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入标题' );
			redirect ( 'no3/sysnotice/toAdd' );
		}
		
		$data ['tags'] = $this->input->post ( 'tag' );
		if (count($data ['tags']) == 0) {
			$this->session->set_flashdata ( 'error', '请选择渠道' );
			redirect ( 'no3/sysnotice/toAdd' );
		}
		
		$data ['content'] = trim ( $this->input->post ( 'content', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		$data ['add_time'] = time ();
		$data ['summary'] = '';
		$data ['is_carousel'] = $this->input->post ( 'is_carousel', true );
		
		if ($this->Notice_model->insertNotice ( $data )) {
			$this->session->set_flashdata ( 'success', '添加成功 ' );
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			foreach ($data['tags'] as $t)
			{
				if ($t == 'all') {
					$channel_list = $this->config->item ( 'taglist' );
					foreach ( $channel_list as $k => $v ) {
						$redis->del ( 'carousellist_' . $k );
					}
					
					// 全部都删就直接break了
					break;
				} else {
					$redis->del ( 'carousellist_' . $t );
				}
			}
			$redis->close ();
			
			redirect ( 'no3/sysnotice' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/sysnotice' );
		}
	}
	public function toEdit() {
		$notice_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $notice_id) {
			redirect ( 'no3/sysnotice' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "系统公告" 
				),
				'allChannelList' => $this->config->item ( 'allChannelList' ),
				'notice' => $this->Notice_model->getNotice ( $notice_id ),
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$this->load->view ( 'no3/sys_notice_info_views', $data );
	}
	public function edit() {
		$notice_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $notice_id) {
			redirect ( 'no3/sysnotice' );
		}
		
		$data ['title'] = trim ( $this->input->post ( 'title', true ) );
		if ($data ['title'] == '' || strlen ( $data ['title'] ) > 200) {
			$this->session->set_flashdata ( 'error', '请输入标题' );
			redirect ( 'no3/sysnotice/toEdit/' . $notice_id );
		}
		
		// 为了支持多个tag复选，所以编辑做了这样的修改：首先删除此notice_id对应项，然后按照内容进行插入操作
		/*
		$data ['tag'] = trim ( $this->input->post ( 'notice_tag' ) );
		if ($data ['tag'] == '0') {
			$this->session->set_flashdata ( 'error', '请选择渠道' );
			redirect ( 'no3/sysnotice/toEdit/' . $notice_id );
		}
		*/

		$data ['tags'] = $this->input->post ( 'tag' );
		if (count($data ['tags']) == 0) {
			$this->session->set_flashdata ( 'error', '请选择渠道' );
			redirect ( 'no3/sysnotice/toAdd' );
		}
		
		
		$data ['content'] = trim ( $this->input->post ( 'content', true ) );
		$data ['status'] = trim ( $this->input->post ( 'status', true ) );
		$data ['add_time'] = time ();
		$data ['summary'] = '';
		$data ['is_carousel'] = $this->input->post ( 'is_carousel', true );
		
		if ($this->Notice_model->updateNotice ( $notice_id, $data )) {
			$this->session->set_flashdata ( 'success', '修改成功 ' );
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			
			foreach ($data['tags'] as $t)
			{
				if ($t == 'all') {
					$channel_list = $this->config->item ( 'taglist' );
					foreach ( $channel_list as $k => $v ) {
						$redis->del ( 'carousellist_' . $k );
					}
					
					// 全部都删就直接break了
					break;
				} else {
					$redis->del ( 'carousellist_' . $t );
				}
			}
			$redis->close ();
			
			/*
			if ($data ['tag'] == 'all') {
				$channel_list = $this->config->item ( 'taglist' );
				foreach ( $channel_list as $k => $v ) {
					$redis->del ( 'carousellist_' . $k );
				}
			} else {
				$redis->del ( 'carousellist_' . $data ['tag'] );
			}
			$redis->close ();
			*/

			redirect ( 'no3/sysnotice' );
		} else {
			$this->session->set_flashdata ( 'error', '修改失败' );
			redirect ( 'no3/sysnotice' );
		}
	}
	public function del() {
		$notice_id = $this->uri->segment ( 4 ) ? intval ( $this->uri->segment ( 4 ) ) : 0;
		if (! $notice_id) {
			redirect ( 'no3/sysnotice' );
		}
		if ($this->Notice_model->delNotice ( $notice_id )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );			
			$channel_list = $this->config->item ( 'taglist' );
			foreach ( $channel_list as $k => $v ) {
				$redis->del ( 'carousellist_' . $k );
			}
			$redis->close ();
			$this->session->set_flashdata ( 'success', '删除成功 ' );
			redirect ( 'no3/sysnotice' );
		} else {
			$this->session->set_flashdata ( 'error', '删除失败' );
			redirect ( 'no3/sysnotice' );
		}
	}
	
	/**
	 * 批量删除
	 */
	public function batchDelete()
	{
		$idsStr = $this->input->post('ids');
		
		$idArray = json_decode($idsStr);
		if ($this->Notice_model->batchDelete ( $idArray )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );			
			$channel_list = $this->config->item ( 'taglist' );
			foreach ( $channel_list as $k => $v ) {
				$redis->del ( 'carousellist_' . $k );
			}
			$redis->close ();
		} 
		
		echo json_encode(array('status' => 1));
	}
}
