<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class paylimit extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_paylimit' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/paylimit_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
	}
	public function index() {
		//$this->writeLog("paylimit index-----------------");
		$query ['limit_target'] = $this->input->post ( 'limit_target', true ) ? $this->input->post ( 'limit_target', true ) : '';
		$query ['optuser'] = $this->input->post ( 'optuser', true ) ? $this->input->post ( 'optuser', true ): '';
		$query ['discribe'] = $this->input->post ( 'discribe', true ) ? $this->input->post ( 'discribe', true ) : '';
		$query ['start_time'] = $this->input->post ( 'start_time', true ) ? $this->input->post ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->post ( 'end_time', true ) ? $this->input->post ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		//$this->writeLog("paylimit limit_target=".$query ['limit_target'].",optuser=".$query ['optuser'].",discribe=".$query ['discribe'].",start_time=".$query ['start_time'].",end_time=".$query ['end_time']);
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
	
		$data_num = $this->paylimit_model->getDataNum($query ['limit_target'], $query ['optuser'], $query ['start_time'], $query ['end_time'], $query ['discribe']);
		$data_list = $this->paylimit_model>-getDataList($query ['limit_target'], $query ['optuser'], $query ['start_time'], $query ['end_time'], $query ['discribe'], $per, $start);
		//$this->writeLog("paylimit $data_num $data_list");
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "禁止支付管理"
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "禁止支付管理"
				),
				'data_list' => $data_list,
				'optuser_list' => $this->paylimit_model->getOptuserList(),
				'query' => $query
		);
		$data ['total_rows'] = $data_num;
		//$this->writeLog('4 total_rows='.$data ['total_rows']);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/paylimit/index' );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
	
		//$this->writeLog('5 index: $per='.$per.',$page='.$page.', limit_target='.$query ['limit_target'].',optuser='.$query ['optuser'].',discribe='.$query ['discribe'].',start_time='.$query ['start_time']);
		$this->load->view ( 'no3/paylimit_views', $data );
	}
	public function toAddPaylimit() {
		//$this->writeLog("paylimit toAddPaylimit-----------------");
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "禁止支付管理"
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "禁止支付管理"
				),
				'taglist' => $this->config->item ( 'taglist' )
		);
		$config ['base_url'] = site_url ( 'no3/paylimitnew_views' );
		$this->load->view ( 'no3/paylimitnew_views', $data );
	}
	public function ajaxDelPaylimit()
	{
		//$this->writeLog("paylimit ajaxDelPaylimit-----------------");
		$limit_target = $this->input->post ( 'limit_target' ) ? $this->input->post ( 'limit_target' ) : '';
		$limit_target = urldecode($limit_target);
		//$this->writeLog("paylimit limit_target=".$limit_target);
		if (!$limit_target) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$flag = $this->paylimit_model->delPaylimit($limit_target);
		//$this->writeLog("paylimit res=".$flag);
		$return_ary = array (
				'status' => '0',
				'msg' => '删除失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'msg' => '删除成功'
			);
		}
		exit ( json_encode ( $return_ary ) );
	
	}
	public function ajaxAddPayLimit() {
		//$this->writeLog("ajaxAddPayLimit-----------------");
		$limit_target = $this->input->post ( 'limit_target' ) ? $this->input->post ( 'limit_target' ) : "";
		$discribe = $this->input->post ( 'discribe' ) ? $this->input->post ( 'discribe' ) : "";
		$optuser = $this->session->userdata('admin_name');
		//$this->writeLog("ajaxAddPayLimi limit_target=$limit_target ,discribe=$discribe ,optuser=$optuser");
		if (!$limit_target || !$discribe) {
			$return_ary = array (
					'status' => '0',
					'msg' => '参数错误！'
			);
			exit ( json_encode ( $return_ary ) );
			return;
		}
	
		$limit_target = urldecode($limit_target);
		$discribe = urldecode($discribe);
		//$this->writeLog("ajaxAddPayLimit urldecode limit_target=$limit_target,discribe=$discribe");
		$data = array (
				'limit_target' => $limit_target,
				'discribe' => $discribe,
				'add_time' => date ( 'Y-m-d H:i:s', time()),
				'optuser' => $optuser
		);
		$flag = $this->paylimit_model->addPayLimit($data);
		//$this->writeLog("ajaxAddPayLimi flag=$flag");
		$return_ary = array (
				'status' => '0',
				'optuser' => $optuser,
				'time' => date('y-m-d h:i:s',time()),
				'msg' => '保存失败'
		);
		if($flag)
		{
			$return_ary = array (
					'status' => '1',
					'optuser' => $optuser,
					'time' => date('y-m-d h:i:s',time()),
					'msg' => '成功'
			);
			//$this->writeLog("ajaxAddPayLimi 1");
		}
		
		exit ( json_encode ( $return_ary ) );
	}
	
	public function ajaxSyncPaylimit()
	{
		$res = $this->paylimit_model->syncPaylimtToRedis();
		$return_ary = array (
				'status' => $res?'1':'0',
				'msg' => $res?'同步成功':'同步失败'
		);
		exit ( json_encode ( $return_ary ) );
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "paylimit";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
	
}
