<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Packetupgrade extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'yygl_zhenbaoshenji' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'Packetupgrade_model' );
	}
	public function toAdd() {
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "整包升级服务器管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "整包升级服务器管理" 
				),
				"header2" => array (
						"father" => "整包升级服务器管理",
						"child" => "整包升级服务器管理" 
				),
				'taglist' => $this->config->item ( 'taglist' ) 
		);
		$this->load->view ( 'no3/packetupgradeinfoview', $data );
	}
	public function add() {
		$data ['packagename'] = trim ( $this->input->post ( 'packagename', true ) );
		$data ['latestVersion'] = trim ( $this->input->post ( 'latestversion', true ) );
		$data ['expiredVersion'] = trim ( $this->input->post ( 'expiredversion', true ) );
		$data ['url'] = trim ( $this->input->post ( 'url', true ) );
		$data ['status'] = $this->input->post ( 'status', true );
		
		if ($data ['packagename'] == '0') {
			$this->session->set_flashdata ( 'error', '请选择游戏' );
			redirect ( 'no3/packetupgrade/toAdd' );
		}
		
		if (! $data ['latestVersion'] ) {
			$data ['latestVersion'] = 0;
		}
		
		if (! $data ['expiredVersion']) {
			$data ['latestVersion'] = 0;
		}
		
		if ($this->Packetupgrade_model->insertPacket ( $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->set ( 'versionstatus_' . $data ['packagename'] . '_' . $data ['latestVersion'], $data ['status'] . '' );
			$redis->del ( 'versioninfo_' . $data ['packagename'] );
			$redis->close ();
			
			$this->session->set_flashdata ( 'success', '添加成功' );
			redirect ( 'no3/packetupgrade' );
		} else {
			$this->session->set_flashdata ( 'error', '添加失败' );
			redirect ( 'no3/packetupgrade' );
		}
	}
	public function onLine() {
		$id = $this->uri->segment ( 4 );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$packetage = $this->Packetupgrade_model->getPackage ( $id );
		if (empty ( $packetage )) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$data = array (
				'status' => 1 
		);
		if ($this->Packetupgrade_model->updatePacket ( $id, $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->set ( 'versionstatus_' . $packetage ['packagename'] . '_' . $packetage ['latestVersion'], '1' );
			$redis->del ( 'versioninfo_' . $packetage ['packagename'] );
			$redis->close ();
			
			$this->session->set_flashdata ( 'success', '成功' );
			redirect ( 'no3/packetupgrade' );
		} else {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
	}
	public function offLine() {
		$id = $this->uri->segment ( 4 );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$packetage = $this->Packetupgrade_model->getPackage ( $id );
		if (empty ( $packetage )) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$data = array (
				'status' => 0 
		);
		if ($this->Packetupgrade_model->updatePacket ( $id, $data )) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->set ( 'versionstatus_' . $packetage ['packagename'] . '_' . $packetage ['latestVersion'], '0' );
			$redis->del ( 'versioninfo_' . $packetage ['packagename'] );
			$redis->close ();
			
			$this->session->set_flashdata ( 'success', '成功' );
			redirect ( 'no3/packetupgrade' );
		} else {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
	}

	/**
	 * 删除某id
	 */
	public function remove() {
		$id = $this->input->get ( 'id' );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$packetage = $this->Packetupgrade_model->getPackage ( $id );
		if (empty ( $packetage )) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$this->Packetupgrade_model->removePackage ( $id );
		$this->_refreshRedis($packetage ['packagename']);
		
		$this->session->set_flashdata ( 'success', '成功' );
		redirect ( 'no3/packetupgrade' );
	}
	
	/**
	 * 刷新Redis
	 */
	public function refreshRedis()
	{
		$id = $this->input->get ( 'id' );
		if (! $id) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$packetage = $this->Packetupgrade_model->getPackage ( $id );
		if (empty ( $packetage )) {
			$this->session->set_flashdata ( 'error', '失败' );
			redirect ( 'no3/packetupgrade' );
		}
		
		$this->_refreshRedis($packetage ['packagename']);
		$this->session->set_flashdata ( 'success', '成功' );
		redirect ( 'no3/packetupgrade' );
	}
	
	/**
	 * 私有方法，所谓刷新其实只需要清掉redis即可
	 * @param string $tag
	 */
	private function _refreshRedis($tag)
	{
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		// 清versioninfo
		$redis->del('versioninfo_' . $tag );

		// 清所有versionstatus
		$versionStatusKeys = $redis->keys('versionstatus_' . $tag . '_' . "*" );
		foreach($versionStatusKeys as $k => $v)
		{
			$redis->del ( $v );
		}
		$redis->close ();
	}

	public function index() {
		$select_tag = $this->input->get ( 'tag', true ) ? $this->input->get ( 'tag', true ) : '';
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "整包升级服务器管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "整包升级服务器管理" 
				),
				"header2" => array (
						"father" => "整包升级服务器管理",
						"child" => "整包升级服务器管理" 
				),
				'packageList' => $this->Packetupgrade_model->getPackageList ( $select_tag ),
				'taglist' => $this->config->item ( 'taglist' ),
				'select_tag' => $select_tag 
		);
		$this->load->view ( 'no3/packetupgradeview', $data );
	}
}
