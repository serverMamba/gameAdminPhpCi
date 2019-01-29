<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class give_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
    
     public function get_give_his($num,$userid,$userid1,$gameid,$mystarttime,$myendtime,$account,$account1,$beginindex) {
         
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
        
       
        $startx = @strtotime($mystarttime);
        $endx = @strtotime($myendtime);
     
         if (!empty($account)) {
            if (!is_numeric($account)) {
                $ret = $this->usernew_mid_model->account2id1($account);
                $userid = $ret['userid'];
            } 
        } 
        
        if (!empty($account1)) {
            if (!is_numeric($account1)) {
                $ret1 = $this->usernew_mid_model->account2id1($account1);
                $userid1 = $ret1['userid'];
            } 
        } 
        
        $where  = "where happentime  >= '$mystarttime 00:00:00' and  happentime <= '$myendtime 23:59:59'";
        
        $order="";
        
       
        
        if (!empty($userid)) {
            $where  = $where ." and userid = $userid " ;
          //  $userinfo = $this->usernew_mid_model->query_user_info($userid);
           // $account = $userinfo["defailUserInfo"]["userAccount"];
           // $nickname = $userinfo["basicUserInfo"]["userNick"];
        }
        
        if (!empty($userid1)) {
            $where  = $where ." and touserid = $userid1 " ;
          //  $userinfo = $this->usernew_mid_model->query_user_info($userid);
           // $account = $userinfo["defailUserInfo"]["userAccount"];
           // $nickname = $userinfo["basicUserInfo"]["userNick"];
        }

        $tabsub = "CASINOPRESENTSCOREHIS";
        
        if ($num == "1") {
            $sql = "select userid,userpresentscore,userleftscore,touserid,touseracceptscore,touserleftscore,gamecode,happentime from $tabsub  $where $order limit $beginindex , 20 ";
            $sql1 = "select count(*) as count from  $tabsub $where";
        }

        if($num == "2"){
            
             $sql = "select userid,userpresentscore,userleftscore,touserid,touseracceptscore,touserleftscore,gamecode,happentime from $tabsub  $where $order limit $beginindex , 20 ";
            $sql1 = "select count(*) as count from  $tabsub $where";
        }
        
        if($num == "3"){
            
                $sql = "select userid,userpresentscore,userleftscore,touserid,touseracceptscore,touserleftscore,gamecode,happentime,sum(userleftscore) as sum1 from $tabsub  $where $order limit $beginindex , 20 ";
        $sql1 = "select count(*) as count from  $tabsub $where"; 
        }

 
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
  

        return array("count"=>$ret1,"detail"=>$ret,"account" => $account ,"nickname" =>$nickname,"status"=>"0" ); 
 
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
