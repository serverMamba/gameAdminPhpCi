<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class areaStatisticsChannel extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'user_areaStatisticsChannel' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/user_channelstatistics_model' );
	}
	public function index() {
		//$this->user_channelstatistics_model->writeLog("----------------------------");
		$channelList = $this->config->item ( 'channellist' );
		$query ['start_time'] = $this->input->post ( 'start_time', true )?$this->input->post ( 'start_time', true ):date("Y-m-d",strtotime("-1 day"))." 00:00:00";
		$query ['end_time'] = $this->input->post ( 'end_time', true )?$this->input->post ( 'end_time', true ):date("Y-m-d",time())." 00:00:00";
		//$this->user_channelstatistics_model->writeLog("start_time=".$query ['start_time'].",end_time=".$query ['end_time']);
		$query ['select_area_province'] = $this->input->post ( 'select_area_province', true )?urldecode($this->input->post ( 'select_area_province', true )):"";
		$query ['select_area_city'] = $this->input->post ( 'select_area_city', true )?urldecode($this->input->post ( 'select_area_city', true )):"";
		
		$query ['usertype'] = $this->input->post ( 'usertype', true )?urldecode($this->input->post ( 'usertype', true )):"registertime";//registertime
		$query ['channel_id'] = $this->input->post ( 'channel_id', true )?urldecode($this->input->post ( 'channel_id', true )):"";
		//$this->user_channelstatistics_model->writeLog("usertype=".$query ['usertype'].",channel_id=".$query ['channel_id']);
		
// 		$query['area_province'] = $this->input->post ( 'area_province', true )?urldecode($this->input->post ( 'area_province', true )):"";
// 		$query['area_city'] = $this->input->post ( 'area_city', true )?urldecode($this->input->post ( 'area_city', true )):"";
		
		//$this->user_channelstatistics_model->writeLog(">>> ".$query['select_area_province'].",".$query['select_area_city']);
		
		$query['area_province'] = $this->user_channelstatistics_model->getAreaProvince();
		$query['area_city'] = "";
		
		if($query ['select_area_province'])
		{
			$query['area_city'] = $this->user_channelstatistics_model->getAreaCity($query ['select_area_province']);
		}
		else{
			$query['area_city'] = "";
		}
		//$this->user_channelstatistics_model->writeLog(">>> ".$query['area_province'].",".$query['area_city']);
		
		$errMsg = "";
		$dbDataArr = array();
		$chart_data = array();
		if(!$query ['start_time'])
		{
			$errMsg = "请输入开始时间！";
			$this->session->set_flashdata ( 'error', $errMsg );
		}else{
			$zero1=strtotime ($query ['start_time']); //当前时间  ,注意H 是24小时 h是12小时
			$zero2=strtotime ($query ['end_time']);  //过年时间，不能写2014-1-21 24:00:00  这样不对
			$guonian=ceil(($zero2-$zero1)/86400); //60s*60min*24h
			if($guonian>30)
			{
				$errMsg = "时间跨度不能超过30天！";
				$this->session->set_flashdata ( 'error',  $errMsg);
			}
			else if($query ['start_time'] && $query ['end_time'])
			{
				$dbDataArr = "rl"==$query ['usertype']?$this->user_channelstatistics_model->getDBDataArr2Types($channelList,$query ['start_time'],$query ['end_time'],$query ['channel_id'],$query ['select_area_province'],$query ['select_area_city']):$this->user_channelstatistics_model->getDBDataArr($channelList,$query ['start_time'],$query ['end_time'],$query ['usertype'],$query ['channel_id'],$query ['select_area_province'],$query ['select_area_city']);
				$chart_data = "rl"==$query ['usertype']?$this->user_channelstatistics_model->getChartDataArr2Types($dbDataArr):$this->user_channelstatistics_model->getChartDataArr($dbDataArr,$query ['usertype']);
			}
		}
		
		$viewDataArr = array();
		$index = 0;
		$pieData = "";
		$fixTitle = ($query ['usertype'] == 'registertime')?"新增玩家":"活跃玩家";
		$pieTitle = $fixTitle.'IP区域分布百分比('.$query['start_time']."-".$query['end_time'].")";
		if("rl"==$query ['usertype'])
		{
			$totalNumR = 0;
			$totalNumL = 0;
			foreach ($dbDataArr["registertime"] as $areaName=>$recNum)
			{
				$totalNumR = $totalNumR+$recNum;
			}
			foreach ($dbDataArr["last_login_time"] as $areaName=>$recNum)
			{
				$totalNumL = $totalNumL+$recNum;
			}
			foreach ($dbDataArr["registertime"] as $areaName=>$recNum)
			{
				$tmpDataArr["index"] = ++$index;
				$tmpDataArr["areaName"] = $areaName;
				$recNumL = $dbDataArr["last_login_time"][$areaName]?$dbDataArr["last_login_time"][$areaName]:0;
				$tmpDataArr["recNum"] = $recNum." | ".$recNumL;
				$tmpDataArr["rate"] = (round($recNum/$totalNumR,4)*100)."%"." | ".(round($recNumL/$totalNumL,4)*100)."%";
				$tmpDataArr["total"] = $totalNumR." | ".$totalNumL;
				array_push($viewDataArr, $tmpDataArr);
			}
		}
		else{
			$totalNum = 0;
			foreach ($dbDataArr as $areaName=>$recNum)
			{
				$totalNum = $totalNum+$recNum;
			}
			foreach ($dbDataArr as $areaName=>$recNum)
			{
				$tmpDataArr["index"] = ++$index;
				$tmpDataArr["areaName"] = $areaName;
				$tmpDataArr["recNum"] = $recNum;
				$tmpDataArr["rate"] = (round($recNum/$totalNum,4)*100)."%";
				$tmpDataArr["total"] = $totalNum;
				array_push($viewDataArr, $tmpDataArr);
			}
			$pieData = $this->user_channelstatistics_model->getPieData($dbDataArr,$totalNum);
		}
		
		$thArr = array(1=>"序号",2=>"区域",3=>"数量",4=>"百分比",5=>"总数");
		if("rl"==$query ['usertype']){
			$thArr = array(1=>"序号",2=>"区域",3=>"新增数量 | 活跃数量",4=>"新增百分比 | 活跃百分比",5=>"新增总数 | 活跃总数");
		}
		else if("last_login_time"==$query ['usertype']){
			$thArr = array(1=>"序号",2=>"区域",3=>"活跃数量",4=>"活跃百分比",5=>"活跃总数");
		}
		else if("registertime"==$query ['usertype']){
			$thArr = array(1=>"序号",2=>"区域",3=>"新增数量",4=>"新增百分比",5=>"新增总数");
		}
		//$this->user_channelstatistics_model->writeLog("$chart_data,".count($chart_data));
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营报表",
						"child" => "玩家IP区域统计" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "玩家IP区域统计" 
				),
				'query' => $query,
				'errMsg' => $errMsg,
				'thArr' => $thArr,
				'db_data' => $viewDataArr,
				'chart_data' => $chart_data,
				'pieData' => $pieData,
				'pieTitle' =>$pieTitle,
				'channel_list' => $channelList
		);
		
		$this->load->view ( 'no3/user_areaStatisticsChannel_views', $data );
	}
	
}