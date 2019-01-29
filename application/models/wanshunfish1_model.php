<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class Wanshunfish1_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
         $this->payment_tables = $this->config->item('payment_tables');
    }
    
    
    public function get_exchange_his($userid, $mystarttime, $myendtime, $beginindex){
        
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
        $dbtablesx = "CASINOFISHGAMERECORD";
        
        $startx = @strtotime($mystarttime);
        $endx   = @strtotime($myendtime);
        
        $sqltable ="(";
        
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
        $where="";
        if(strlen($userid) !=0)   
        {
        	$escapeUserId = $db->escape($userid);
        	$xx = strlen($where)>0? " and ":"" ; $where = $where.$xx." userid = $escapeUserId";
        }

        if(strlen($mystarttime) !=0)  
        {
        	$escapeMystarttime = $db->escape($mystarttime);
        	$xx = strlen($where)>0? " and ":"" ; $where = $where.$xx." recordtime >= $escapeMystarttime";
        }

        if(strlen($myendtime) !=0) 
        {
        	$escapeMyendtime = $db->escape($myendtime);
        	$xx = strlen($where)>0? " and ":"" ; $where = $where.$xx." recordtime <= $escapeMyendtime";
        }
        
       for($ii = $startx ;$ii<= $endx;$ii=$ii+60*60*24){
            
        //$ii = $startx;
             $tablename = $dbtablesx.date('Ymd', $ii);
             $sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
        
             $queryzz = $db->query($sqlzz);
        
             $retzz = $this->_dealwith_ret( $queryzz);
        
             $tableflag1 = count($retzz);
             
              if($tableflag1>0){
                if(strlen($sqltable)>2){
                    $sqltable =  $sqltable. " union all (select * from  $tablename where $where )";  
                }else{
                   $sqltable =  $sqltable. "(select * from  $tablename where $where )";
                    // $sqltable =  "select * from  $tablename";
                }
             }
        }
       
         if(strlen($sqltable)<6){
             return array("count"=>0,"detail"=>""); 
         }
       	$sqltable =  $sqltable. ") as aa";
        $sql = "SELECT * FROM $sqltable limit $beginindex , 20 ";//order by aa.recordtime desc
        $sql1 = "select count(id) as count from $sqltable";
        
       $query =  $db->query($sql);
       $ret = $this->_dealwith_ret($query); 
        
       $query1 =  $db->query($sql1);
       $ret1 = $this->_dealwith_ret($query1); 
       return array("count"=>$ret1,"detail"=>$ret ); 
        
    }
    
        public function get_total_static3($starttime,  $endtime,  $modeid){
        
        $mysplit1 = explode("-", $starttime);
        $myyear1 = $mysplit1[0];
        $mymonth1 = substr("00" . $mysplit1[1], -2);
        $myday1 = substr("00" . $mysplit1[2], -2);
        
        $mysplit2 = explode("-", $endtime);
        $myyear2 = $mysplit2[0];
        $mymonth2 = substr("00" . $mysplit2[1], -2);
        $myday2 = substr("00" . $mysplit2[2], -2);
        
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);
        $where = "where date  <= '$myyear2-$mymonth2-$myday2' and date  >= '$myyear1-$mymonth1-$myday1'";
        
        $tablename = "CASINOSCOREDISTRIBUTION";
        
        $select ="id,date,rangeid,mincoupon,maxcoupon,count";
          
        if($modeid == "1")
        {
           $select ="id,date,rangeid,minscore as mincoupon,maxscore as maxcoupon,count";
           $tablename = "CASINOSCOREDISTRIBUTION";   
        }else{
            $select ="id,date,rangeid,mincoupon,maxcoupon,count"; 
            $tablename = "CASINOCOUPONDISTRIBUTION";   
         }
          
        $sql = "select $select from $tablename $where order by date desc";
        
        
        $query = $db->query($sql );
        $ret = $this->_dealwith_ret($query);
        return $ret ;
        
    }
    
    public function get_total_static2($starttime,   $gameid,$modeid,  $roomid){
        
        $mysplit1 = explode("-", $starttime);
        $myyear1 = $mysplit1[0];
        $mymonth1 = substr("00" . $mysplit1[1], -2);
        $myday1 = substr("00" . $mysplit1[2], -2);
        
        
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);
        $where = "where date  <= '$myyear1-$mymonth1-$myday1' and date  >= '$myyear1-$mymonth1-$myday1'";
          
        if($gameid =="0")
        {
           $where =  $where." and gametype = -1 "; 
        }else{
            
           $where =  $where." and gametype = $gameid ";   
        }
         
        if($roomid =="10000")
        {
           $where = $where ." and roomid = -1";   
        }else{
           $where = $where ." and roomid = $roomid";  
         }
         
        $sort = "order by winscore";
         
        if( $modeid == "1"){
          $sort = "order by winscore";  
        }else{
          $sort = "order by winscore desc";   
        }
         
        $sql = "select * from CASINOWINSCORETOP $where $sort  limit 100";
 
        $query = $db->query($sql );
        $ret = $this->_dealwith_ret($query);
        return $ret ;
        
    }
    
    public function get_total_static1($starttime,  $endtime, $gameid,  $roomid){
        
        $mysplit1 = explode("-", $starttime);
        $myyear1 = $mysplit1[0];
        $mymonth1 = substr("00" . $mysplit1[1], -2);
        $myday1 = substr("00" . $mysplit1[2], -2);
        
        $mysplit2 = explode("-", $endtime);
        $myyear2 = $mysplit2[0];
        $mymonth2 = substr("00" . $mysplit2[1], -2);
        $myday2 = substr("00" . $mysplit2[2], -2);
        
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);
        $where = "where date  <= '$myyear2-$mymonth2-$myday2' and date  >= '$myyear1-$mymonth1-$myday1'";
          
        if($gameid =="0")
        {
           $where =  $where." and gametype = -1 "; 
        }else{
            
           $where =  $where." and gametype = $gameid ";   
        }
         
        if($roomid =="10000")
        {
           $where = $where ." and roomid = -1";   
        }else{
           $where = $where ." and roomid = $roomid";  
         }
          
        $sql = "select * from CASINOWINSCOREDISTRIBUTION $where order by date desc";
        
        
        $query = $db->query($sql );
        $ret = $this->_dealwith_ret($query);
        return $ret ;
        
    }
    
      public function getsql($strdate) {
        $sql = "(";
        foreach ($this->payment_tables as $key => $value) {
            $sql = $sql . "( select userid,gamecode,totalfee from CASINOBUYHISDB." . $value['tbname'] . " where ( tradeTime > '$strdate 00:00:00') and ( tradeTime < '$strdate 23:59:59') )UNION ALL";
        }
        $len = strlen($sql);
        $sql = substr($sql, 0, $len - 9);
        $sql = $sql . ")";
        return $sql;
    }

    public function get_total_static($time,$key,$gameid,$channel) {
        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        $myday = substr("00" . $mysplit[2], -2);
 

        
       if ($key == "total1") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(new_device_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
       if ($key == "total2") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
       if ($key == "total3") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(new_realuser_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
      
       if ($key == "total4") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(new_playgame_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
     
       if ($key == "total5") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(new_guest_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
      
       if ($key == "total6") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";   
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(firstgame_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
      
      if ($key == "total22") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";   
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(retention_lastday_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         
         
         $startx = @strtotime("$myyear-$mymonth-$myday"." 00:00:00");
        
         $yest = date('Y-m-d',$startx -60*60*24);
         
         
         $where1 = "where statistics_date = '$yest'";
          
         if($gameid !="10000")
         {
            $where1 =  $where1." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where1 = $where1 ." and channelid = $channel";   
         }
          
         $sql1 = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where1";

         $query1 = $db->query($sql1 );
         $ret1 = $this->_dealwith_ret($query1);
         
          
        
        
         $rr = array();
         $rr["合计"] = "0.000%";
         if($ret1[0]['xx']>0)
         {
           $rr["合计"] = round($ret[0]['xx']*100 / $ret1[0]['xx'],3)."%";
         }
         return $rr;
      }
      
      if ($key == "total23") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(retention_7day_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         
         
         $startx = @strtotime("$myyear-$mymonth-$myday"." 00:00:00");
        
         $yest = date('Y-m-d',$startx -60*60*24*7);
         
         
         $where1 = "where statistics_date = '$yest'";
          
         if($gameid !="10000")
         {
            $where1 =  $where1." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where1 = $where1 ." and channelid = $channel";   
         }
          
         $sql1 = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where1";

         $query1 = $db->query($sql1 );
         $ret1 = $this->_dealwith_ret($query1);
         
          
        
        
         $rr = array();
         $rr["合计"] = "0.000%";
         if($ret1[0]['xx']>0)
         {
           $rr["合计"] = round($ret[0]['xx']*100 / $ret1[0]['xx'],3)."%";
         }
         return $rr;
      }
      
      
     if ($key == "total7") {
         $where = "where statistics_time<= '$myyear-$mymonth-$myday 23:59:59'  and statistics_time>= '$myyear-$mymonth-$myday 00:00:00'";
         
 
          
         if($gameid !="10000")
         {
            $where =  $where." and (game_code = $gameid or game_code = 10000+$gameid)";    
         }
/*
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
  */       
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);
        $sql =  "select max(server_membernum) as max,min(server_membernum) as min,avg(server_membernum) as avg  from CASINOTOTALONLINESTATISTICS $where";

        $query = $db->query($sql );
        $ret = $this->_dealwith_ret($query);
       
        $rr = array();
        $rr["合计"] = floor($ret[0]['avg']);
        return $rr;
      }
      
     if ($key == "total8") {
         $where = "where statistics_time<= '$myyear-$mymonth-$myday 23:59:59'  and statistics_time>= '$myyear-$mymonth-$myday 00:00:00'";
          

         if($gameid !="10000")
         {
            $where =  $where." and (game_code = $gameid or game_code = 10000+$gameid)";  
         }
         /*       
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          * 
          */
         
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);
        $sql =  "select max(server_membernum) as max,min(server_membernum) as min,avg(server_membernum) as avg  from CASINOTOTALONLINESTATISTICS $where";

        $query = $db->query($sql );
        $ret = $this->_dealwith_ret($query);
       
        $rr = array();
        $rr["合计"] = $ret[0]['max'];
        return $rr;
      }
      
      if ($key == "total9") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(total_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
      
       if ($key == "total18") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(firstpay_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
       if ($key == "total19") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(activepay_user_count_oldclient) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
       if ($key == "total20") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";    
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(active_user_7day_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
 
     
       if ($key == "total10") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(active_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
       
      
      
        if ($key == "total16") {
            
             $CI = &get_instance();
             $db = $CI->load->database('globalinfo', true);
            
             $where = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where =  $where." and channelid = $channel";   
            }

            $sql = "select sum(pay_user_count_oldclient) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
         }
        
          if ($key == "total17") {
              
             $CI = &get_instance();
             $db = $CI->load->database('globalinfo', true);
              
            $where = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where =  $where." and channelid = $channel";   
            }

            $sql = "select sum(pay_total_money_oldclient) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;

        }
        
        
        
        if ($key == "total12") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(active_device_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }
      
      if ($key == "total21") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameid !="10000")
         {
            $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";  
         }
         
         if($channel !="10000")
         {
            $where = $where ." and channelid = $channel";   
         }
          
         $sql = "select sum(active_device_7day_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;
      }

        $rr = array();
        $rr["合计"] = -1;
        return $rr;
    }


}
