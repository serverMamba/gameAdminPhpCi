<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class rechargesee extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'kfgl_rechargesee' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/bakuser_model' );
		
	}
	public function index() {
		//左条件
		$query = $this->contructQuery();
		
		$per = 10;
		$page = $this->input->get ( 'page' ) ? intval ( $this->input->get ( 'page' ) ) : 1;
		$start = ($page - 1) * $per;
		
		$this->load->library ( 'pagination' );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "客服管理",
						"child" => "帐号及充值排查"
				),
				"header1" => array (
						"father" => "客服管理",
						"child" => "帐号及充值排查"
				),
				"currPage" => $page,
				"query" => $query,
				'user_info_list' => $this->bakuser_model->getUserInfoList ($query, $per, $start ),
				'keyArr' => $this->getKeyArr()
		);
		
		$data ['total_rows'] = $this->bakuser_model->getRecordNum ($query);
		$config ['base_url'] = site_url ( 'no3/rechargesee/index' );
		$config ['total_rows'] = $data ['total_rows'];
		$config ['per_page'] = $per;
		$this->pagination->initialize ( $config );
		
		$data ['pageContent'] = $this->pagination->create_links();
		$data ['pageContent'] = str_replace("a href=\"http","a href=\"javascript:void(0)\" onclick=\"doQueryInfoUsers('http",$data ['pageContent']);
		$data ['pageContent'] = str_replace("\" data-ci","')\" data-ci",$data ['pageContent']);
		//$whereSql = $page.">>>".$this->bakuser_model->contructSqlStr($query);
		//$this->session->set_flashdata ( 'success', $whereSql );
		$this->load->view ( 'no3/rechargesee_views', $data );
	}
	public function getKeyArr()
	{
		$keyArr = array ("id", "nickname", "registertime", "ip", "mac", "alipay_account", "totalBuy", "lastLoginIp", "user_chips", "total_total_money", "boundmobilenumber", "last_login_time", "win_game", "lose_game", "draw_game", "sum_game");
		return $keyArr;
	}
	public function contructQuery()
	{
		$query = array();
		$keyArr = $this->getKeyArr();
		if($keyArr)
		{
			for($i=0; $i<count($keyArr); $i++)
			{
				$columnName = $keyArr[$i];
				$query [$columnName] = $this->input->post ( $columnName, true ) ? $this->input->post ( $columnName, true ) : '';
				$query ['operation_'.$columnName] = $this->input->post ( 'operation_'.$columnName, true ) ? $this->input->post ( 'operation_'.$columnName, true ) : '>=';
				$query ['extra_'.$columnName] = $this->input->post ( 'extra_'.$columnName, true ) ? $this->input->post ( 'extra_'.$columnName, true ) : '';
				$query ['operation_extra_'.$columnName] = $this->input->post ( 'operation_extra_'.$columnName, true ) ? $this->input->post ( 'operation_extra_'.$columnName, true ) : '<=';
			}
		}
		if(!$query ['last_login_time'])
		{
			$query ['last_login_time'] = date('Y-m-d H:i:s',strtotime('-7 day'));
			$query ['operation_last_login_time'] = '>=';
		}
		return $query;
	}
	
	
}