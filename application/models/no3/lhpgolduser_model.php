<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 连环炮金币兑换记录
 */

class lhpgolduser_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_statistics($userid, $starttime, $endtime, $per, $start){
    	$goldrecords = array();
    	$goldrecords["detail"] = array();
    	$goldrecords["count"] = 0;
    	
    	$where = "1=1";
    	if($userid){
    		$where = $where." and userid=".$userid;
    	}
    	
    	$sql = "SELECT date,userid,duihuan_gold,fanzhuan_gold,cha_gold,date1 from smc_log_lhpgolduser where $where and is_day=1 and date>='$starttime' and date<'$endtime' ORDER BY date1 desc,cha_gold desc,duihuan_gold desc limit $start,$per";
    	
    	$db = $this->load->database ( 'default_slave', true );
    	$query = $db->query ( $sql );
    	$goldrecords["detail"] = $query->result_array ();
    	
    	$sql = "SELECT count(1) rec_num from smc_log_lhpgolduser where is_day=1 and date>='$starttime' and date<'$endtime'";
    	$query = $db->query ( $sql );
    	$dataArr = $query->result_array ();
    	foreach($dataArr as $row)
    	{
    		$goldrecords["count"] = $row['rec_num'];
    		break;
    	}
    	$db->close ();
    	return $goldrecords;
    }
    
    
    private function writeLog($txt) {
    	$log_file = "/log/lhpgolduser.log";
    	$handle = fopen ( $log_file, "a+" );
    	$dateTime = date("Y-m-d H:i:s", time());
    	$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
    	fclose ( $handle );
    }
    
}
