<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhp_cwstatistics_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	public function get_statistic($starttime, $endtime){
		$sql = "SELECT order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold,date1 from smc_log_lhpgold where is_day=1 and date1>='$starttime' and date1<'$endtime' ORDER BY date1 desc";
		
		$db = $this->load->database ( 'default_slave', true );
		$query = $db->query ( $sql );
		$dataArr = $query->result_array ();
		$db->close ();
		
		return $dataArr;
	}
	
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "lhp_cwstatistics_model";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
}
