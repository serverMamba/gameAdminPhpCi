<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 连环炮游戏记录
 */

class Lhpgamerecord_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_exchange_his($userid, $machineid, $mystarttime, $myendtime, $beginindex){
        
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
        $dbtablesx = "CASINOGAMERECORD_LHP_";
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
        if(strlen($userid) !=0)   { $where = $where . " and userid = '$userid'"; }
        if(strlen($machineid) !=0)   { $where = $where . " and machineid = '$machineid'"; }
        if(strlen($mystarttime) !=0)  { $where = $where . " and recordtime >= '$mystarttime'";}
        if(strlen($myendtime) !=0)  { $where = $where . " and recordtime <= '$myendtime'";}
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
        $sql = "SELECT * FROM $sqltable order by id desc limit $beginindex, 20 ";
        $sql1 = "select count(*) as count from $sqltable";
   
		$query =  $db->query($sql);
		$ret = $this->_dealwith_ret($query); 

		$query1 =  $db->query($sql1);
		$ret1 = $this->_dealwith_ret($query1); 
		return array("count" => $ret1[0]['count'], "detail" => $ret ); 
    }
}
