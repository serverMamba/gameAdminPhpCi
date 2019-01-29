<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpgoldStatistsics extends CI_Controller {
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'lhpgold_statistics' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/lhpgold_statistics_model' );
	}
	public function index() {
		$type_val = $this->input->get ( 'type_val' ) ? $this->input->get ( 'type_val' ) : 'duihuan_gold';
		$date = $this->input->get ( 'date' ) ? $this->input->get ( 'date' ) : date ( 'Y-m-d' );
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "平安游戏项目",
						"child" => "金币兑换曲线" 
				),
				"header1" => array (
						"father" => "平安游戏项目",
						"child" => "金币兑换曲线" 
				),
				'type_list' => $this->statTypeList(),
				'type_val' => $type_val,
				'date' => $date
		);
		
		$data ['chart_data'] = $this->lhpgold_statistics_model->getOrderStatistics ( $type_val, date ( 'Ymd', strtotime ( $date, $date . ' 00:00:00' ) ), $this->statTypeList() );
		$this->load->view ( 'no3/lhpgold_statistics_views', $data );
	}
	
	private function statTypeList(){
		$res = array(
				"order_total_num"=>"兑换单数",
				"user_total_num"=>"兑换人数",
				"duihuan_gold"=>"兑换金币总额",
				"fanzhuan_gold"=>"反转金币总额",
				"cha_gold"=>"金币差额",
				);
		return $res;
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "lhpgoldStatistsics";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	
}