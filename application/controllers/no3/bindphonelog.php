<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class bindphonelog extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_bindphonelog' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'api/User_model' );
		$this->load->model ( 'no3/bindphonelog_model' );
		$this->load->model ( 'no3/Admin_model' );
		$this->load->model ( 'no3/Push_model' );
	}
	public function index() {
		//$this->writeLog("0--------------------------------");
		$query ['user_id'] = $this->input->get ( 'user_id', true ) ? $this->input->get ( 'user_id', true ) : '';
		$query ['mobile'] = $this->input->get ( 'mobile', true ) ? $this->input->get ( 'mobile', true ) : '';
		$query ['bind'] = $this->input->get ( 'bind' );
		$query ['start_time'] = $this->input->get ( 'start_time', true ) ? $this->input->get ( 'start_time', true ) : date ( 'Y-m-d', strtotime ( '-7 day' ) );
		$query ['end_time'] = $this->input->get ( 'end_time', true ) ? $this->input->get ( 'end_time', true ) : date ( 'Y-m-d', strtotime ( '1 day' ));
		
		$per = 20;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$flag = false;
		$days = ceil((strtotime($query ['end_time']) - strtotime($query ['start_time']))/86400); //60s*60min*24h
		//$this->writeLog('1 $days='.$days);
		if($days > 30)
		{
			//$this->writeLog('$days > 30');
			$flag = true;//超过30天或小于0要求重新设置条件
			$this->session->set_flashdata ( 'error', "时间跨度不可以超过30天" );
		}
		if($days <= 0)
		{
			//$this->writeLog('$days <= 0');
			$flag = true;//超过30天或小于0要求重新设置条件
			$this->session->set_flashdata ( 'error', "时间跨度不可以低于0天" );
		}
		$tabArr = $this->getBindPhoneLogTables();
		$recordlist = $flag ? array() : $this->bindphonelog_model->getBindphoneLogList ( $query ['mobile'], $query ['user_id'], $query ['bind'], $query ['start_time'], $query ['end_time'], $per, $start, $tabArr);
		$recordNum = $flag ? 0 : $this->bindphonelog_model->getDataNum ( $query ['mobile'], $query ['user_id'], $query ['bind'], $query ['start_time'], $query ['end_time'], $per, $start, $tabArr);
		//$this->writeLog('3 $recordlist='.$recordlist.",recordNum=".$recordNum);
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "绑定手机记录" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "绑定手机记录" 
				),
				'bindphonelog_list' => $recordlist,
				'query' => $query
		);
		$this->load->library ( 'pagination' );
		$config ['base_url'] = site_url ( 'no3/bindphonelog/index' ) . '?id='.$query ['id'].'&user_id=' . $query ['user_id'] . '&operuser=' . $query ['operuser'] . '&start_time=' . $query ['start_time'] . '&end_time=' . $query ['end_time'].'&status='.$query ['status'].'&bugtype='.$query ['bugtype'].'&describe='.$query ['describe'];
		$config ['total_rows'] = $recordNum;
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		//$this->writeLog('5 index: $per='.$per.',$page='.$page.', mobile='.$query ['mobile'].',user_id='.$query ['user_id'].',bind='.$query ['bind'].',start_time='.$query ['start_time']);
		$this->load->view ( 'no3/bindphonelog_views', $data );
	}
	
	public static $bindPhoneLogTables;
	
	public function getBindPhoneLogTables()
	{
		if(!isset(self::$bindPhoneLogTables))
		{
			self::$bindPhoneLogTables = $this->bindphonelog_model->getBindPhoneLogTables();
			//$this->writeLog('$bindPhoneLogTables is not set ');
		}
		$resArr = self::$bindPhoneLogTables;
		//$this->writeLog('2 bindPhoneLogTables='.($resArr).",".count($resArr));
		return $resArr;
	} 
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "bindphonelog";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}
