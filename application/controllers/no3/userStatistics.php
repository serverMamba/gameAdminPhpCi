<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class UserStatistics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'user_statistics' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/User_statistics_model' );
	}
	public function index() {
		$channel_id = $this->input->get ( 'channel_id' ) ? $this->input->get ( 'channel_id' ) : 0;
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "用户数据统计" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "用户数据统计" 
				),
				'chart_data' => $this->User_statistics_model->getUserStatistics ( $channel_id, 14 ),
				'channel_list' => $this->config->item ( 'channellist' ),
				'channel_id' => $channel_id 
		);
		
		$this->load->view ( 'no3/user_statistics_views', $data );
	}
}