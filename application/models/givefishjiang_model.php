<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class givefishjiang_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
    
     public function get_givefishjiang_his($userid,$gameid,$mystarttime,$myendtime,$beginindex) {
         
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
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
        $endx = @strtotime($myendtime);
     
        $where  = "where gametime  >= '$mystarttime 00:00:00' and gametime <= '$myendtime 23:59:59'";
        $order="";
        
        if (!empty($userid)) {
            $where  = $where ." and userid = $userid " ;
        }
        
        $sqltable ="(";
        
        for($ii = $startx ;$ii<= $endx;$ii=$ii+60*60*24){
            
             $tablename = "CASINOLOTTERYGAMERECORD".date('Ymd', $ii);
             $sqlzz = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
         
             $queryzz = $db->query($sqlzz);
             $retzz = $this->_dealwith_ret( $queryzz);
             $tableflag1 = count($retzz);
             if($tableflag1>0){
                if(strlen($sqltable)>2){
                    $sqltable =  $sqltable. " union all (select * from  $tablename $where )"; 
                }else{
                     $sqltable =  $sqltable. "(select * from  $tablename $where )";
                }
             }
          }
          
        $sqltable =  $sqltable .") as haha";
       
         if(strlen($sqltable)<6){
             return array("count"=>0,"detail"=>""); 
         }
        
        $sql = "select * from $sqltable order by gametime desc limit   $beginindex , 20 ";
        $sql1 = "select count(*) as count from  $sqltable";
        
        //echo $sql;
        
       // return;
        
   
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
  

        return array("count"=>$ret1,"detail"=>$ret,"account" => $account ,"nickname" =>$nickname,"status"=>"0" ); 

        
        /*
        $tabsub = "CASINOPRESENTSCOREHIS";
        

        if($num == "2"){
            
             $sql = "select userid,count(userid) as cuseid,max(userleftscore) as maxinu,min(userleftscore) as mininu,sum(userpresentscore) as sumu from $tabsub $where group by userid  order by sumu desc limit $beginindex , 200 ";
          //  $sql1 = "select count(userid) as count from  $tabsub $where group by userid";
        }
        
        if($num == "3"){
            $sql = "select touserid as userid,count(touserid) as cuseid,max(touserleftscore) as maxinu,min(touserleftscore) as mininu,sum(touseracceptscore) as sumu from $tabsub $where group by userid  order by sumu desc limit 0 , 200 ";
           // $sql1 = "select count(touserid) as count from  $tabsub $where group by userid";
        }

 
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
       // $query1 =  $db->query($sql1);
       // $ret1 = $this->_dealwith_ret($query1); 
         * 
         * 
         */
  

        return array("count"=>1,"detail"=>$ret,"account" => $account ,"nickname" =>$nickname,"status"=>"0" ); 
 
     }
     
     public function get_currmonth($userid,$paytype) {
        $tablename =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',time());
        
        $tablename1 =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',strtotime('-1 month',time()));

        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);
        
        $endtime = date('Y-m-d H:i:s',time());
        
        $starttime = date('Y-m-d H:i:s',time() - 24*60*60*30);
        
        $sql1 = "select sum(money) summoney from $tablename where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
        
        $sql2 = "select sum(money) summoney from $tablename1 where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
        $query2 =  $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);
        
        $ret = $ret1[0]["summoney"] + $ret2[0]["summoney"];

        return $ret; 
     }
    
     public function get_near_order($userid) {
        $tablename =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);
        
        $sql = "select max(ordertime) maxtime from $tablename where userid = '$userid' ";
        $query =  $db->query($sql);
        
      
         return $this->_dealwith_ret($query); 
     }
    
     public function getorder($orderid) {
        $tablename =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);
        
        $sql = "select * from $tablename where orderid = '$orderid'";
        $query =  $db->query($sql);
       
         return $this->_dealwith_ret($query); 
     }
     
     
      public function updateorder($orderid,$realmoney,$callbacktime,$callbackstatus) {
        $tablename =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);
        
        $record = array(
            "callbacktime" => $callbacktime,
            "realmoney" => $realmoney,
            "callbackstatus" => $callbackstatus
        );
        $db->where('orderid', $orderid);
        $ret =  $db->update($tablename, $record);
        return $ret;
     }
     
     public function  insertorder($ordertime, $callbacktime,$deviceid,$userid,$gamecode,$gameid,$paytype,$producttype,$productid,$channel,$carrier,$mobile,$ip,$orderid,$money,$realmoney,$callbackstatus)
     {
        $tablename =  "CASINOTABLECUSTOMPAYORDER".date('Y_n',time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);
        $data = array(
             "ordertime" => $ordertime, 
            "callbacktime" => $callbacktime,
            "deviceid" => $deviceid,
            "userid" => $userid,
            "gamecode" => $gamecode,
            "gameid" => $gameid,
            "paytype" => $paytype,
            "producttype" => $producttype,
            "productid" => $productid,
            "channel" => $channel,
            "carrier" => $carrier,
            "mobile" => $mobile,
            "ip" => $ip,
            "orderid" => $orderid,
            "money" => $money,
            "realmoney" => $realmoney,
            "callbackstatus" => $callbackstatus
        );
        $db->insert($tablename, $data);
       // $db->trans_commit();
        return $db->affected_rows(); 
     }

}
