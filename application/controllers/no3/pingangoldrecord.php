<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class pingangoldrecord extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'pingan_goldrecord' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'pingangoldrecord_model' );
	}
	public function get_record_data() {
		$query ['userid'] = $this->input->get_post ( 'user_id' );
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$flag = false;
		$days = ceil((strtotime($query ['end_time']) - strtotime($query ['start_time']))/86400); //60s*60min*24h
		if($days > 30)
		{
			$flag = true;//超过30天或小于0要求重新设置条件
			$this->session->set_flashdata ( 'error', "时间跨度不可以超过30天" );
		}
		if($days <= 0)
		{
			$flag = true;//超过30天或小于0要求重新设置条件
			$this->session->set_flashdata ( 'error', "时间跨度不可以低于0天" );
		}
		$recordlist = array();
		$recordNum = 0;
		if($flag){
			$goldrecords = $this->pingangoldrecord_model->get_exchange_his ( $query ['userid'], $query ['start_time'], $query ['end_time'], $per, $start );
			$recordlist = $goldrecords["detail"];
			$recordNum = $goldrecords["count"];
		}
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $this->config->item ( 'gamecode' ),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录 " 
				),
				"bindphonelog_list" => $goldrecords["detail"],
				'query' => $query
		);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/pingangoldrecord/index' ) . '?user_id=' . $userid . '&start_time=' . $mystarttime . '&end_time=' . $myendtime.'&page='.$page;
		$config ['total_rows'] = $goldrecords["count"];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/pingangoldrecord_view', $data );
	}
	
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $this->config->item ( 'gamecode' ),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "平安金币兑换记录 " 
				),
		);
		$this->load->view ( 'no3/pingangoldrecord_view', $data );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "pingangoldrecord";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "c:/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
