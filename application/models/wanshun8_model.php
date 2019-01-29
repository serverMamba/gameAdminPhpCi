<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class Wanshun8_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
         $this->payment_tables = $this->config->item('payment_tables');
    }
    
    
    public function get_exchange_his($gametype,$mydate){
        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);

        $sql1 =  "select daily_firstgameuser_count,daily_firstgameuser_newestversion_count from CASINOGLOBALINFO.CASINONEWLOBBYDATASTAT where statistics_date  = '$mydate'  and gametype = $gametype";
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
        if(count($ret1)>0){
            $ret[] = array( "name"=> "今日新增游戏用户","value"=>$ret1[0]["daily_firstgameuser_count"]);
            $ret[] = array( "name"=> "今日新增游戏用户","value"=>$ret1[0]["daily_firstgameuser_newestversion_count"]);
        }else{
             $ret[] = array("name"=> "今日新增游戏用户","value"=>0);
             $ret[] = array("name"=> "最新版新增游戏用户","value"=>0);
        }
  
     
        $sql2 =  "select daily_activeuser_count,daily_activeuser_newestversion_count,daily_totaluser_newestversion_count from CASINOGLOBALINFO.CASINONEWLOBBYDATASTAT where statistics_date  = '$mydate'  and gametype = $gametype";
        $query2 =  $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2); 
        if(count($ret2)>0){
            $ret[] = array("name"=>"今日活跃用户(指定游戏)","value"=>$ret2[0]["daily_activeuser_count"]);
            $ret[] = array("name"=>"最新版活跃用户(指定游戏)","value"=>$ret2[0]["daily_activeuser_newestversion_count"]);
            $ret[] = array("name"=>"新版用户总数量(指定游戏)","value"=>$ret2[0]["daily_totaluser_newestversion_count"]);
        }else{
            $ret[] = array("name"=>"今日活跃用户(指定游戏)","value"=>0);
            $ret[] = array("name"=>"最新版活跃用户(指定游戏)","value"=>0);
            $ret[] = array("name"=>"新版用户总数量(指定游戏)","value"=>0);
        }
        
        $sql3 =  "select daily_activeuser_count,daily_activeuser_newestversion_count,daily_totaluser_newestversion_count from CASINOGLOBALINFO.CASINONEWLOBBYDATASTAT where statistics_date  = '$mydate'  and gametype = -1";
        $query3 =  $db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3); 
        if(count($ret3)>0){
            $ret[] = array("name"=>"今日活跃用户(全平台)","value"=>$ret3[0]["daily_activeuser_count"]);
            $ret[] = array("name"=>"最新版活跃用户(全平台)","value"=>$ret3[0]["daily_activeuser_newestversion_count"]);
            $ret[] = array("name"=>"新版用户总数量(全平台)","value"=>$ret3[0]["daily_totaluser_newestversion_count"]);
        }else{
            $ret[] = array("name"=>"今日活跃用户(全平台)","value"=>0);
            $ret[] = array("name"=>"最新版活跃用户(全平台)","value"=>0);
            $ret[] = array("name"=>"新版用户总数量(全平台)","value"=>0);
        }
        
        
        $sql4 =  "select "
                 . "firstgameuser_1daybefore_retainlogin_count / firstgameuser_1daybefore_count as a,"
                 . "firstgameuser_1daybefore_retaingame_count / firstgameuser_1daybefore_count as b ,"
                 . "firstgameuser_7daybefore_retainlogin_count / firstgameuser_7daybefore_count as c, "
                 . "firstgameuser_7daybefore_retaingame_count / firstgameuser_7daybefore_count as d ,"
                 . "firstgameuser_14daybefore_retainlogin_count / firstgameuser_14daybefore_count as e, "
                 . "firstgameuser_14daybefore_retaingame_count / firstgameuser_14daybefore_count as f, "
                . "firstgameuser_30daybefore_retainlogin_count / firstgameuser_30daybefore_count as g ,"
                . "firstgameuser_30daybefore_retaingame_count / firstgameuser_30daybefore_count as h "
                . "from CASINOGLOBALINFO.CASINONEWLOBBYDATASTAT where statistics_date  = '$mydate'  and gametype = $gametype";
        $query4 =  $db->query($sql4);
        $ret4 = $this->_dealwith_ret($query4); 
        if(count($ret4)>0){
            $ret[] = array("name"=>"次日留存","value"=>$ret4[0]["a"]);
            $ret[] = array("name"=>"次日游戏留存","value"=>$ret4[0]["b"]);
            $ret[] = array("name"=>"周留存","value"=>$ret4[0]["c"]);
            $ret[] = array("name"=>"周游戏留存","value"=>$ret4[0]["d"]);
            $ret[] = array("name"=>"14日留存","value"=>$ret4[0]["e"]);
            $ret[] = array("name"=>"14日游戏留存","value"=>$ret4[0]["f"]);
            $ret[] = array("name"=>"月留存","value"=>$ret4[0]["g"]);
            $ret[] = array("name"=>"月游戏留存","value"=>$ret4[0]["h"]);
        }else{
            $ret[] = array("name"=>"次日留存","value"=>0);
            $ret[] = array("name"=>"次日游戏留存","value"=>0);
            $ret[] = array("name"=>"周留存","value"=>0);
            $ret[] = array("name"=>"周游戏留存","value"=>0);
            $ret[] = array("name"=>"14日留存","value"=>0);
            $ret[] = array("name"=>"14日游戏留存","value"=>0);
            $ret[] = array("name"=>"月留存","value"=>0);
            $ret[] = array("name"=>"月游戏留存","value"=>0);
        }
        
        
        
        
        
        
        
        return $ret; 
    }
    
    /*
    public function get_exchange_his($userid, $mystarttime, $myendtime, $status,$wupin, $beginindex){
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
        $startx = @strtotime($mystarttime);
        $endx   = @strtotime($myendtime);
        $where = "where happentime  >= '$mystarttime' and  happentime <= '$myendtime'";
        
        if (!empty($userid)) {
            if (!is_numeric($userid)) {
                $ret = $this->usernew_mid_model->account2id1($userid);
                $userid = $ret['userid'];
            } 
        } 
        
       if (!empty($userid)) {
           $where = $where . " and userid = $userid";
           $userinfo = $this->usernew_mid_model->query_user_info($userid);
           $account = $userinfo["defailUserInfo"]["userAccount"];
           $nickname = $userinfo["basicUserInfo"]["userNick"];
        } 

       $sqllist = array();
       
        for($ii = $startx ;$ii<= $endx;$ii=$ii+60*60*24){
             $tablename = "CASINOCOUPONCHANGEHIS".date('Ymd', $ii);
             $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
             $query = $db->query($sql);
             $ret = $this->_dealwith_ret($query);
             if(count($ret)>=1)
             {
                $sqllist[] =  "(SELECT * from $tablename $where)";
             }
        }
        
        $newsql = implode("union all",$sqllist);
        
        $sql =  "select * from  ($newsql) as aa  limit $beginindex , 20 ";
        $sql1 = "select count(*) as count from  ($newsql) as aa";
        

       $query =  $db->query($sql);
       $ret = $this->_dealwith_ret($query); 
        
       $query1 =  $db->query($sql1);
       $ret1 = $this->_dealwith_ret($query1); 
       return array("count"=>$ret1,"detail"=>$ret,"account" => $account ,"nickname" =>$nickname,"status"=>"0" ); 
    }
     * 
     * 
     */
    
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
