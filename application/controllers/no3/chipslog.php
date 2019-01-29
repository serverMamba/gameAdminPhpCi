<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class chipslog extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_chipslog' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/chipslog_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
	}
	public function index() {
		$query ['admin_id'] = $this->input->get ( 'admin_id', true ) ? intval ( $this->input->get ( 'admin_id', true ) ) : 0;
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? intval ( $this->input->get ( 'user_id', true ) ) : '';
		$query ['chips'] = $this->input->get ( 'chips', true ) ? $this->input->get ( 'chips', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "加金币记录" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "加金币记录" 
				),
				'chipslog_list' => $this->chipslog_model->getChipsLogList ( $query ['admin_id'], $query ['user_id'], $query ['chips'], $query ['start_time'], $query ['end_time'], $per, $start ),
				'query' => $query,
				'adminnames' => $this->chipslog_model->getAdminNameList()
		);
		$data ['total_rows'] = $this->chipslog_model->getRecordNum ( $query ['admin_id'], $query ['user_id'], $query ['chips'], $query ['start_time'], $query ['end_time'] );
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/chipslog/index' ) . '?id='.$query ['id'].'&user_id=' . $query ['user_id'] . '&operuser=' . $query ['operuser'] . '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'].'&status='.$query ['status'].'&bugtype='.$query ['bugtype'].'&describe='.$query ['describe'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		//$this->writeLog('index: $per='.$per.',$page='.$page.', admin_id='.$query ['admin_id'].',user_id='.$query ['user_id'].',chips='.$query ['chips'].',start_time='.$query ['start_time'],true);
		
		$this->load->view ( 'no3/chipslog_views', $data );
	}
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "chipslog";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}