<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class UserReport extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'user_report' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/User_report_model' );
	}
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : 0;
// 		$query ['order_sn'] = $this->input->get ( 'order_sn', true ) ? $this->input->get ( 'order_sn', true ) : '';
// 		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true )  : 0;
// 		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true )  : 0;
 		$query ['game'] = $this->input->get ( 'game', true ) ? intval ( $this->input->get ( 'game', true ) )  : 0;
 		$query ['order_status'] = $this->input->get ( 'order_status', true ) ? intval ( $this->input->get ( 'order_status', true ) ) : 0;
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "举报管理" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "举报管理" 
				),
				'user_report_list' => $this->User_report_model->userReportList ( $start, $per ,$query) ,
				'query' => $query
		);
		$data ['total_rows'] = $this->User_report_model->getUserReportNum ();
		
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/userReport/index' );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/user_report_list_views', $data );
	}
	public function playback() {
		$user_id = $this->input->get ( 'user_id' ) ? intval ( $this->input->get ( 'user_id' ) ) : 0;
		$type = $this->input->get ( 'type' ) ? intval ( $this->input->get ( 'type' ) ) : 0;
		$game_number = $this->input->get ( 'game_number' ) ? intval ( $this->input->get ( 'game_number' ) ) : 0;
		if (! $type) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/userReport' );
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "举报管理" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "举报管理" 
				),
				'play_record' => $this->User_report_model->getGamePlayRecord ( $type, $game_number, $user_id ),
				'type' => $type 
		);
		$this->load->view ( 'no3/user_report_play_record_views', $data );
	}
	public function cancelReport() {
		$this->load->model ( 'no3/Chat_model' );
		$id = $this->input->get ( 'id' ) ? intval ( $this->input->get ( 'id' ) ) : 0;
		$discribe = $this->input->get ( 'discribe' ) ? urldecode ( $this->input->get ( 'discribe' ) ) : '';
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误' );
			redirect ( 'no3/userReport' );
		}
		
		$report = $this->User_report_model->getUserReport ( $id );
		if (empty ( $report )) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
			redirect ( 'no3/userReport' );
		}
		
		$data = array (
				'status' => 1 
		);
		if ($this->User_report_model->updateUserReport ( $id, $data )) {
			
			// 客服消息和推送
			if ($this->Chat_model->createChatSession ( $report ['user_id'] )) {
				$data1 ['admin_id'] = 1;
				$data1 ['content'] = $discribe;
				$data1 ['user_id'] = $report ['user_id'];
				$data1 ['add_time'] = time ();
				$this->Chat_model->insertMessage ( $data1 );
			}
			
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			
			$redis_game_config = $this->config->item ( 'game_redis' );
			$redis_game = new Redis ();
			$redis_game->connect ( $redis_game_config ['host'], $redis_game_config ['port'] );
			$redis_game->auth ( '{DE162344-69B1-41C6-8F6D-0085FE821AC7}{8FCFE755-611D-44E2-A11A-9F22EF130804}' );
			$redis_game->select ( 14 );
			
			$users_list = explode ( '|', $report ['table_users'] );
			foreach ( $users_list as $v ) {
				$redis->del ( 'reported_' . $v );
				$redis_game->del ( $v . '_reported' );
			}
			$redis->close ();
			$redis_game->close ();
			$this->session->set_flashdata ( 'success', '处理成功' );
			redirect ( 'no3/userReport' );
		} else {
			$this->session->set_flashdata ( 'error', '处理失败' );
			redirect ( 'no3/userReport' );
		}
	}
}