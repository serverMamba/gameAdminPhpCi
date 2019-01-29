<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpgoldrecord extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_goldrecord' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/lhpgoldrecord_model' );
		$this->load->model ( 'no3/Admin_model' );
	}
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ($this->input->get ( 'user_id', true )) : 0;
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
		if(!$flag){
			$goldrecords = $this->lhpgoldrecord_model->get_exchange_his ( $query ['user_id'], $query ['start_time'], $query ['end_time'], $per, $start );
			$recordlist = $goldrecords["detail"];
			$recordNum = $goldrecords["count"];
		}
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "金币兑换记录" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "金币兑换记录" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "金币兑换记录 " 
				),
				'lhpgoldrecord_list' => $recordlist,
				'query' => $query
		);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/lhpgoldrecord/index' ) . '?id='.$query ['id'].'&user_id=' . $query ['user_id'] . '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'];
		$config ['total_rows'] = $recordNum;
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/lhpgoldrecord_views', $data );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "lhpgoldrecord";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
