<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpgolduser extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhp_golduser' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/lhpgolduser_model' );
		$this->load->model ( 'no3/Admin_model' );
	}
	public function index() {
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ($this->input->get ( 'user_id', true )) : 0;
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-30 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$days = ceil((strtotime($query ['end_time']) - strtotime($query ['start_time']))/86400); //60s*60min*24h
		$goldrecords = $this->lhpgolduser_model->get_statistics( $query ['user_id'], $query ['start_time'], $query ['end_time'], $per, $start );
		$recordlist = $goldrecords["detail"];
		$recordNum = $goldrecords["count"];
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "玩家兑换统计" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "玩家兑换统计" 
				),
				"header2" => array (
						"father" => "平安游戏项目",
						"child" => "玩家兑换统计 " 
				),
				'lhpgoldrecord_list' => $recordlist,
				'query' => $query
		);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/lhpgolduser/index' ) . '?id='.$query ['id'].'&user_id=' . $query ['user_id'] . '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'];
		$config ['total_rows'] = $recordNum;
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/lhpgolduser_views', $data );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "lhpgolduser";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
