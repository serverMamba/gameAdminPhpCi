<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 平安金币兑换记录
 */

class pingangoldrecord_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_exchange_his($userid, $mystarttime, $myendtime, $per, $start){
        
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
        $dbtablesx = "PinganGameScoreRecord_";
        $userid = intval($userid);
        // 判断是否合法的时间
        if (!isDate($mystarttime))
        {
        	return array();
        }
         
        if (!isDate($myendtime))
        {
        	return array();
        } 
        $startx = @strtotime($mystarttime);
        $endx   = @strtotime($myendtime);
           
        $sqltable ="(";
        
        $where = "where 1=1 ";
        $originalWhereLength = strlen($where);
        if($userid>0)   { $where = $where . " and userid = $userid"; }
        if(strlen($mystarttime) !=0)  { $where = $where . " and happentime >= '$mystarttime'";}
        if(strlen($myendtime) !=0)  { $where = $where . " and happentime <= '$myendtime'";}
        if (strlen($where) == $originalWhereLength)
        {
        	$where = "";
        }
       	for($ii = $startx ;$ii <= $endx; $ii = $ii+60*60*24)
       	{
			$tablename = $dbtablesx.date('Ymd', $ii);
			$sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
			$queryzz = $db->query($sqlzz);
			$retzz = $this->_dealwith_ret( $queryzz);
			$tableflag1 = count($retzz);

			if($tableflag1 > 0)
			{
				if(strlen($sqltable) > 2)
				{
					$sqltable = $sqltable. " union all (select * from  $tablename $where )";  
				}
				else
				{
					$sqltable = $sqltable. "(select * from  $tablename $where )";
				}
			}
        }
       
        if(strlen($sqltable) < 6)
        {
            return array("count" => 0, "detail" => array()); 
        }

       	$sqltable =  $sqltable. ") as aa";
        $sql = "SELECT * FROM $sqltable order by happentime desc limit $start,$per ";
        $sql1 = "select count(*) as count from $sqltable";
		$query =  $db->query($sql);
		$ret = $this->_dealwith_ret($query); 

		$query1 =  $db->query($sql1);
		$ret1 = $this->_dealwith_ret($query1); 
		return array("count" => $ret1[0]['count'], "detail" => $ret ); 
    }
    
    
    private function writeLog($txt) {
    	$log_file = "/log/pingangoldrecord.log";
    	$handle = fopen ( $log_file, "a+" );
    	$dateTime = date("Y-m-d H:i:s", time());
    	$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
    	fclose ( $handle );
    }
    
}
