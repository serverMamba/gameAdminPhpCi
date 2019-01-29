<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class dailipaymgr extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin () || !$this->session->userdata('admin_name')) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_dailipay' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/dailipay_model' );
		$this->load->model ( 'no3/Admin_model' );
	}
	public function index() {
		$this->writeLog("dailipaymgr--------------------------");
		$query ['daili_no'] = $this->input->get ( 'daili_no', true ) ? $this->input->get ( 'daili_no', true ) : '';
		$query ['adduser'] = $this->input->get ( 'adduser', true ) ? $this->input->get ( 'adduser', true ) : '';
		$query ['describe'] = $this->input->get ( 'describe', true ) ? $this->input->get ( 'describe', true ) : '';
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-1000 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));

		$admin_name=$this->session->userdata('admin_name');
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "客服代理充值账户管理" 
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "客服代理充值账户管理" 
				),
				'daili_no_list' => $this->dailipay_model->getDailiPayList ( $query ['daili_no'], $query ['adduser'], $query ['describe'], $query ['start_time'], $query ['end_time'], $per, $start),
				'query' => $query
		);
		$data ['total_rows'] = $this->dailipay_model->getDailiPayNum ( $query ['daili_no'], $query ['adduser'], $query ['describe'], $query ['start_time'], $query ['end_time'] );
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/dailipaymgr/index' ) . '?daili_no='.$query ['daili_no'] . '&adduser=' . $query ['adduser'] . '&describe='.$query ['describe']. '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'];
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		$this->writeLog("query: ".json_encode($data['daili_no_list']));
		$this->load->view ( 'no3/dailipay_mgr_views', $data );
	}
	public function createNewDailiPay()
	{
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "客服代理充值账户管理"
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "客服代理充值账户管理"
				),
				"header2" => array(
						"father"=>"客服代理充值账户管理",
						"child"=>"客服代理充值账户创建 "
				),
		);
		$this->load->view ( 'no3/dailipay_new_views', $data );
	}
	
	public function ajaxAddDailiPayNew() {
		$this->writeLog("ajaxAddDailiPayNew-------------------------");
		$this->writeLog ( '[NOTIFY] POST: ' . json_encode ( $_POST ) );
		$this->writeLog ( '[NOTIFY] GET: ' . json_encode ( $_GET ) );
		$status = 'y';//状态： 1 开启， 2 关闭
		$addtime = date('Y-m-d H:i:s',time());
		$adduser = $this->session->userdata('admin_name');
		$daili_no = $this->input->post ( 'daili_no' ) ? $this->input->post ( 'daili_no' ) : "";
		$describe = $this->input->post ( 'describe' ) ? $this->input->post ( 'describe' ) : "";
		
		if (!$daili_no) {
			$return_ary = array (
					'status' => '0',
					'msg' => '代理账号不可为空！'
			);
			$this->writeLog("0 参数错误 ");
			exit ( json_encode ( $return_ary ) );
			return;
		}
		$describe = trim(urldecode($describe));
		
		$data = array (
				'addtime' => $addtime,
				'adduser' => $adduser,
				'daili_no' => $daili_no,
				'describe' => $describe,
		);
		$flag = 0;
		try{
			$flag = $this->dailipay_model->addDailiPayNew($data);
		}catch(Exception $e){
			$flag = 0;
		}
		
		$return_ary = array (
				'status' => $flag?1:0,
				'adduser' => $adduser,
				'time' => date('Y-m-d H:i:s',time()),
				'msg' => $flag?'新增成功':'新增失败,请核查账户是否已经存在！',
		);
		$res_json = json_encode ( $return_ary );
		$this->writeLog("add: ".json_encode($data));
		exit ( $res_json );
	}
	
	
	/**
	 * 删除
	 */
	public function delete()
	{
		$id = $this->input->get ( 'id' ) ? $this->input->get ( 'id' ) : 0;
		if (! $id) {
			$this->session->set_flashdata ( 'error', '参数错误1' );
		}
		else{
			$this->dailipay_model->deleteOneDailiPay($id);
			$this->writeLog("delete: id=$id");
			$this->session->set_flashdata ( 'success', '删除成功' );
		}

		redirect ( 'no3/dailipaymgr' );
	}
	
	private function writeLog($txt) {
		$log_file = "/log/dailipaymgr.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$ip = $this->getIp();
		$admin_name = $this->session->userdata('admin_name');
		$str = fwrite ( $handle, "[$dateTime][$ip][$admin_name]" . $txt . "\n" );
		fclose ( $handle );
	}
	private function getIp() {
		if (! empty ( $_SERVER ["HTTP_CLIENT_IP"] )) {
			$cip = $_SERVER ["HTTP_CLIENT_IP"];
		} elseif (! empty ( $_SERVER ["HTTP_X_FORWARDED_FOR"] )) {
			$cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
		} elseif (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$cip = $_SERVER ["REMOTE_ADDR"];
		} else {
			$cip = "无法获取！";
		}
		return $cip;
	}
	
}