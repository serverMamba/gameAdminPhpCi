<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Reporttotal extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yybb_yysjzb' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_reporttotal_data() {
		$this->load->model ( 'totalreport_model' );
		
		$time = $this->input->get_post ( 'time' );
		$key = $this->input->get_post ( 'key' );
		
		$channel = $this->input->get_post ( 'channel' );
		
		$saveres = "";
		
		$myfilename = "$channel-$key.log";
		$dir = "/log/business_log/$time";
		
		if (! is_dir ( $dir )) {
			mkdir ( $dir );
		}
		
		if (false && file_exists ( $dir . '/' . $myfilename )) {
			$saveres = file_get_contents ( $dir . '/' . $myfilename, LOCK_EX );
		} else {
			$res = $this->totalreport_model->get_total_static ( $time, $key, $channel );
			$saveres = json_encode ( $res );
			
			$today = date ( 'Y-m-d' );
			if (date ( 'Y-m-d', strtotime ( $time . ' 00:00:00' ) ) != $today && date ( 'H' ) != '00') {
				file_put_contents ( $dir . '/' . $myfilename, $saveres, LOCK_EX );
			}
		}
		
		echo $saveres;
	}
	public function index() {
		$gamecodehuang = $this->config->item ( 'gamecode' );
		$channellisthuang = $this->config->item ( 'channellist' );
		$nochannellist = $this->config->item ( 'no_tongji' );
		foreach ( $nochannellist as $k => $v ) {
			unset ( $channellisthuang [$k] );
		}
		$initdata = 6;
		
		$initdatastr = "斗地主(6)";
		$data = array (
				"initdatastr" => $initdatastr,
				"initdata" => $initdata,
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $gamecodehuang,
				"channellist" => $channellisthuang,
				"choose" => array (
						"father" => "运营报表",
						"child" => "运营数据总表" 
				),
				"header1" => array (
						"father" => "运营报表",
						"child" => "运营数据总表" 
				),
				"header2" => array (
						"father" => "运营数据总表",
						"child" => "运营数据明细 " 
				) 
		);
		$this->load->view ( 'no3/reporttotalview', $data );
	}
	
	/**
	 * 导出数据
	 */
	public function exportData()
	{
		$this->load->model ( 'totalreport_model' );
		$channelId = $this->input->get ( 'channelId' );
		$forOutter = $this->input->get ( 'forOutter' );
		$startDate = $this->input->get ( 'startDate' );
		$endDate = $this->input->get ( 'endDate' );
		
		if (empty($channelId) || empty($startDate) || empty($endDate))
		{
			$this->session->set_flashdata ( 'error', '参数不正确' );
			redirect ( 'no3/reporttotal' );
		}

		$res = $this->totalreport_model->exportData ( $channelId, $forOutter, $startDate, $endDate );
		if (!$res)
		{
			$this->session->set_flashdata ( 'error', '生成失败' );
			redirect ( 'no3/reporttotal' );
		}
	}
}
