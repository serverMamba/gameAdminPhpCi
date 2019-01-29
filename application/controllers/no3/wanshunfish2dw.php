<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Wanshunfish2dw extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'dwcxianmu_wanshunfish2' )) {
			redirect ( 'no3/index' );
		}
		$this->load->helper ( 'other' );
	}
	public function get_exchange_data() {
		$this->load->model ( 'wanshunfish2dw_model' );
		$action = $this->input->get_post ( 'action' );
		$mystarttime = $this->input->get_post ( 'mystarttime' );
		$myendtime = $this->input->get_post ( 'myendtime' );
		$userid = $this->input->get_post ( 'userid' );
		$beginindex = $this->input->get_post ( 'beginindex' );
		$res = $this->wanshunfish2dw_model->get_exchange_his ( $userid, $mystarttime, $myendtime, $beginindex );
		echo json_encode ( $res );
	}
	public function index() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"gamelist" => $this->config->item ( 'gamecode' ),
				"choose" => array (
						"father" => "电玩城项目",
						"child" => "水果机猜大小记录" 
				),
				"header1" => array (
						"father" => "电玩城项目",
						"child" => "水果机猜大小记录" 
				),
				"header2" => array (
						"father" => "捕水果机猜大小记录",
						"child" => "水果机猜大小记录记录历史统计 " 
				),
				"header3" => array (
						"father" => "水果机猜大小记录记录创建于2015年11月13日",
						"child" => "水果机猜大小记录记录游戏运营从2014年6月25日开始 (v1.0) " 
				) 
		);
		$this->load->view ( 'no3/wanshunfish2dw_view', $data );
	}
}
