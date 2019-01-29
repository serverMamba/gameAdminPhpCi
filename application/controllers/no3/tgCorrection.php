<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class TgCorrection extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'tg_correction' )) {
			redirect ( 'no3/index' );
		}
		if('admin'!=$this->session->userdata('admin_name')){
			exit("no priv");
		}
		$this->load->model ( 'no3/Tg_account_model' );
		$this->load->helper('date');
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "推广管理",
						"child" => "推广ID修正" 
				),
				"header1" => array (
						"father" => "推广管理",
						"child" => "推广ID修正" 
				),
		);
		
		$this->load->view ( 'no3/tg_correction_view', $data );
	}
	
	public function ajaxQueryPromotion(){
		$return_ary = array("code"=>"0","msg"=>"查询失败");
		$paramuid = $this->input->post ( 'user_id', true );
		$return_ary ['user_id'] = intval(trim ( $paramuid ));
		if(!$return_ary ['user_id']||empty($return_ary ['user_id'])||$return_ary ['user_id']=="0"){
			$return_ary['code'] = 0;
			$return_ary['msg'] = "用户ID$paramuid 无效，请重新输入";
			exit ( json_encode ( $return_ary ) );
		}
		$data_promotion = $this->Tg_account_model->queryPromotionID($return_ary ['user_id']);
		$return_ary['data_promotion'] = $data_promotion;
		if(!$data_promotion){
			$return_ary['code'] = 0;
			$return_ary['msg'] = "查询失败，请确认该用户ID是否存在！";
		}else{
			$channellist = $this->config->item('channellist');
			$channel_name = $data_promotion['channel_id']==0?"集集棋牌":$channellist[$data_promotion['channel_id']];
        	$return_ary['code'] = 1;
			$return_ary['msg'] = "查询成功 ($channel_name)";
		}
		exit ( json_encode ( $return_ary ) );
	}
	public function ajaxCorrectionPromotion(){
		$this->writeLog(" ajaxCorrectionPromotion: ".json_encode($_POST));
		$return_ary = array("code"=>"0","msg"=>"修正失败");
		$paramuid = $this->input->post ( 'user_id', true );
		$parampromotionid = $this->input->post ( 'promotion_id', true );
		$return_ary ['user_id'] = intval(trim ( $paramuid ));
		$return_ary ['promotion_id'] = intval(trim ( $parampromotionid ));
		$whiteFlag = in_array($this->getIp(),$this->whiteIpArr());//是否有权特殊处理
		if(!$return_ary ['user_id']||empty($return_ary ['user_id'])){
			$return_ary['code'] = 0;
			$return_ary['msg'] = "用户ID$paramuid 无效，请重新输入";
			exit ( json_encode ( $return_ary ) );
		}
		if(!$whiteFlag){
			if(!$return_ary ['promotion_id']||empty($return_ary ['promotion_id'])||$return_ary ['promotion_id']=="0"){
				$return_ary['code'] = 0;
				$return_ary['msg'] = "推广ID$parampromotionid 无效，请重新输入";
				exit ( json_encode ( $return_ary ) );
			}	
		}
		
		$data_promotion_old = $this->Tg_account_model->queryPromotionID($return_ary ['user_id']);
		$return_ary['data_promotion'] = $data_promotion_old;
		$this->writeLog(">>>data_old=".json_encode($data_promotion_old));
		if(!$whiteFlag&&!$data_promotion_old){
			$return_ary['code'] = 0;
			$return_ary['msg'] = "服务端复查失败，修改失败！";
			exit ( json_encode ( $return_ary ) );
		}else if(!$whiteFlag&&intval($data_promotion_old['proid_1'])>0&&intval($data_promotion_old['proid_1'])==intval($data_promotion_old['proid_2'])&&intval($data_promotion_old['proid_1'])==intval($data_promotion_old['proid_3'])){
			$return_ary['code'] = 0;
			$return_ary['msg'] = "服务端复查原推广ID".$data_promotion_old['proid_1']."合法，无权修改！";
			exit ( json_encode ( $return_ary ) );
		}else{
			$res = $this->Tg_account_model->updatePromotionID($paramuid,$parampromotionid);
			$this->writeLog(">>> update_res=$res");
			$data_promotion_new = $this->Tg_account_model->queryPromotionID($return_ary ['user_id']);
			$return_ary['data_promotion'] = $data_promotion_new;
			$this->writeLog(">>> data_new=".json_encode($data_promotion_new));
			$this->logCorrectionPromotion($return_ary ['user_id'],$return_ary ['promotion_id'],$data_promotion_old,$data_promotion_new,$res);
			if($data_promotion_new
					&&$parampromotionid==intval($data_promotion_new['proid_1'])
					&&$parampromotionid==intval($data_promotion_new['proid_2'])
					&&$parampromotionid==intval($data_promotion_new['proid_3'])){
				$return_ary['code'] = 1;
				$return_ary['msg'] = "修改成功！";
				exit ( json_encode ( $return_ary ) );
			}
			else{
				$return_ary['code'] = 0;
				$return_ary['msg'] = "修改失败！";
				exit ( json_encode ( $return_ary ) );
			}
		}
		
		exit ( json_encode ( $return_ary ) );
	}
	
	private function logCorrectionPromotion($user_id,$promotion_id,$data_promotion_old,$data_promotion_new,$flag){
		$data_log=array();
		$data_log['user_id'] = $user_id;
		$data_log['promotion_id'] = $promotion_id;
		$data_log['admin_name'] = $this->session->userdata('admin_name');
		$data_log['correction_ip'] = $this->getIp();
		$data_log['promotion_old'] = $data_promotion_old['proid_1'].','.$data_promotion_old['proid_2'].','.$data_promotion_old['proid_3'];
		$data_log['promotion_new'] = $data_promotion_new['proid_1'].','.$data_promotion_new['proid_2'].','.$data_promotion_new['proid_3'];
		$data_log['flag'] = $flag;
		$data_log['discribe'] = '游戏后台';
		$this->Tg_account_model->insertCorrectionLog($data_log);
	}
	
	public function tgCorrectionLog(){
		$this->writeLog("tgCorrectionLog: ".json_encode($_GET));
		$per = 5;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$query = array();
		$query ['user_id'] = intval($this->input->get ( 'user_id', true ));
		$query ['admin_name'] = $this->input->get ( 'admin_name', true );
		$query ['admin_name'] = str_replace(" ","",$query ['admin_name']);
		$query ['promotion_old'] = $this->input->get ( 'promotion_old', true )?$this->input->get ( 'promotion_old', true ):"";
		$query ['promotion_old'] = str_replace(" ","",$query ['promotion_old']);
		$query ['promotion_new'] = $this->input->get ( 'promotion_new', true )?$this->input->get ( 'promotion_new', true ):"";
		$query ['promotion_new'] = str_replace(" ","",$query ['promotion_new']);
		$query ['start_time'] = $this->input->get ( 'start_time', true );
		$query ['end_time'] = $this->input->get ( 'end_time', true );
		// 判断是否日期格式
		if (!$query ['start_time']||!isDate($query ['start_time']))
		{
			$query ['start_time'] = date ( 'Y-m-d', strtotime ( '-30 day' ) );
		}
		if (!$query ['end_time']||!isDate($query ['end_time']))
		{
			$query ['end_time'] = date ( 'Y-m-d', strtotime ( '1 day' ));
		}
		$data = array();
		$data['correction_log_list'] = $this->Tg_account_model->getCorrectionLogList($query ['user_id'],$query ['admin_name'],$query ['start_time'],$query ['end_time'],$start,$per,$query ['promotion_old'],$query ['promotion_new']);
		$config ['total_rows'] = $this->Tg_account_model->getCorrectionLogNum($query ['user_id'],$query ['admin_name'],$query ['start_time'],$query ['end_time'],$query ['promotion_old'],$query ['promotion_new']);
		$config ['per_page'] = $per;
		$config ['base_url'] = site_url ( 'no3/tgCorrection/tgCorrectionLog' ) . '?user_id='.$query ['user_id'].'&admin_name=' . $query ['admin_name'] . '&start_time=' . $query ['start_time']. '&end_time=' . $query ['end_time']. '&promotion_old=' . $query ['promotion_old']. '&promotion_new=' . $query ['promotion_new'];
		$this->load->library ( 'pagination' );
		$this->pagination->initialize ( $config );
		$data['query'] = $query;
		$this->load->view ( 'no3/tg_correctionlog_views', $data );
	}
	
	private function writeLog($txt) {
		$log_file = "/log/tgCorrection.log";
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
	private function whiteIpArr(){
		return array('127.0.0.1','127.0.0.1','127.0.0.1','127.0.0.1');
	}
	
	
	private function patchxz(){
		$uids = array();
		$parampromotionid = 0;
		$resstr = "";$num=0;
		foreach ($uids as $paramuid){
			$res = $this->Tg_account_model->updatePromotionID($paramuid,$parampromotionid);
			$resstr = $resstr.",".(++$num)."-$paramuid-$res";
		}
		exit($resstr);
	}
	
	
}