<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class gameagentapply extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_gameagentapply' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/gameagentapply_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
	}
	public function index() {
		$query ['name'] = $this->input->get ( 'name', true ) ? $this->input->get ( 'name', true ) : '';
		$query ['telephone'] = $this->input->get ( 'telephone', true ) ? $this->input->get ( 'telephone', true ) : '';
		$query ['qq'] = $this->input->get ( 'qq' ) ? $this->input->get ( 'qq', true ) : '';
		$query ['weixin'] = $this->input->get ( 'weixin', true ) ? $this->input->get ( 'weixin', true ) : '';
		$query ['ip'] = $this->input->get ( 'ip', true ) ? $this->input->get ( 'ip', true ) : '';
		$query ['status'] = $this->input->get ( 'status', true ) ? intval ( $this->input->get ( 'status' ) ) : -1;
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$flag = false;
		$recordlist = $flag ? array() : $this->gameagentapply_model->getgameagentapplyList ( $query ['name'], $query ['telephone'], $query ['qq'], $query ['weixin'], $query ['ip'], $query ['status'], $per, $start);
		$recordNum = $flag ? 0 : $this->gameagentapply_model->getDataNum ( $query ['name'], $query ['telephone'], $query ['qq'], $query ['weixin'], $query ['ip'], $query ['status']);
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "游戏代理查询" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "游戏代理查询" 
				),
				'gameagentapply_list' => $recordlist,
				'query' => $query
		);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/gameagentapply/index' ) . '?name='.$query ['name'].'&telephone=' . $query ['telephone'] . '&qq=' . $query ['qq'] .'&weixin='.$query ['weixin'].'&ip='.$query ['ip'].'&status='.$query ['status'];
		$config ['total_rows'] = $recordNum;
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$this->load->view ( 'no3/gameagentapply_views', $data );
	}
	
	public function ajaxChangeStatus() {
		$id = $this->input->post ( 'id' ) ? intval ($this->input->post ( 'id' )) : 0;
		$status = $this->input->post ( 'status' ) ? intval ($this->input->post ( 'status' )) : 0;
		//$operuser = $this->session->userdata('admin_name');
		$flag = $this->gameagentapply_model->changeStatus($id,$status);
		$this->writeLog("ajaxChangeStatus: id=".$id.",status=".$status);
		$return_ary = array (
				'status' => '0',
				'msg' => '保存失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'msg' => '成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	}
	
	public function batchProcess(){
		$status = $this->input->get( 'status' );
		$select_cash_ids = $this->input->post ( 'select_cash_ids' );
		if (empty ( $select_cash_ids )) {
			$this->session->set_flashdata ( 'error', '请选择操作项' );
			redirect ( 'no3/gameagentapply' );
			return;
		}
		
		foreach ( $select_cash_ids as $id ) {
			$flag = $this->gameagentapply_model->changeStatus($id,$status);
		}
		$this->session->set_flashdata ( 'success', '修改成功' );
		redirect ( 'no3/gameagentapply' );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "gameagentapply";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}