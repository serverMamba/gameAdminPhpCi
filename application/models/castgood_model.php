<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class castgood_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
        public function get_static_good_config() {
        $good_config[] =array("id"=>"card10",   "type"=>"1", "name"=>"手机充值","price"=>"10.00","coupon"=>"3500","pic"=>"card10.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config[] =array("id"=>"card30",  "type"=>"1", "name"=>"手机充值","price"=>"30.00","coupon"=>"3500","pic"=>"card30.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config[] =array("id"=>"card50",  "type"=>"1", "name"=>"手机充值","price"=>"50.00","coupon"=>"3500","pic"=>"card50.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config[] =array("id"=>"312637",  "type"=>"2", "name"=>"iphone","price"=>"5000.00","coupon"=>"750000","pic"=>"312637_1541192_pic200_1958.jpg","discrible"=>"土豪金苹果（APPLE）iPhone5....","choosed"=>"true");
        $good_config[] =array("id"=>"312673",  "type"=>"2", "name"=>"iPad","price"=>"2000.00","coupon"=>"300000","pic"=>"312673_1541199_pic200_5978.jpg","discrible"=>"白色&nbsp;苹果（Apple）iPa....","choosed"=>"true");
        $good_config[] =array("id"=>"277420",  "type"=>"4", "name"=>"Note3","price"=>"3800.00","coupon"=>"570000","pic"=>"277420_0_pic200_7906.jpg","discrible"=>"三星 Galaxy Note 3 N9006....","choosed"=>"true");
        return $good_config;
    }
    
    /*
    public function get_static_good_config($id) {
        $good_config["card10"] =array("type"=>"1", "name"=>"手机充值","price"=>"10.00","coupon"=>"3500","pic"=>"card10.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config["card30"] =array("type"=>"1", "name"=>"手机充值","price"=>"30.00","coupon"=>"3500","pic"=>"card30.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config["card50"] =array("type"=>"1", "name"=>"手机充值","price"=>"50.00","coupon"=>"3500","pic"=>"card50.png","discrible"=>"移动，电信，联通10元充值卡。","choosed"=>"true");
        $good_config["312637"] =array("type"=>"2", "name"=>"iphone","price"=>"5000.00","coupon"=>"750000","pic"=>"312637_1541192_pic200_1958.jpg","discrible"=>"土豪金苹果（APPLE）iPhone5....","choosed"=>"true");
        $good_config["312673"] =array("type"=>"2", "name"=>"iPad","price"=>"2000.00","coupon"=>"300000","pic"=>"312673_1541199_pic200_5978.jpg","discrible"=>"白色&nbsp;苹果（Apple）iPa....","choosed"=>"true");
        $good_config["277420"] =array("type"=>"4", "name"=>"Note3","price"=>"3800.00","coupon"=>"570000","pic"=>"277420_0_pic200_7906.jpg","discrible"=>"三星 Galaxy Note 3 N9006....","choosed"=>"true");
        return $good_config[$id];
    }
    */
    
    public function get_good_msg($action,$mainversionid,$subversionid,$systemid,$gameid,$beginindex){
        $CI = &get_instance();
        $db = $CI->load->database('dbhischart', true);
        
        $sql =  " select * from  CASINOGLOBALINFO.CASINOGAMEADWALLINFO  ";
 
       $query =  $db->query($sql);
       $ret = $this->_dealwith_ret($query); 
       return $ret; 
     }
    
     public function get_exchange_his($userid, $mystarttime, $myendtime, $status,$wupin, $beginindex) {
       
        $CI = &get_instance();
        $db = $CI->load->database('gamehis', true);
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



       
/*      
       if (!empty($userid)) {
           
        $where = $where." and  userid = $userid ";
        $userinfo = $this->usernew_mid_model->query_user_info($userid);
        $account = $userinfo["defailUserInfo"]["userAccount"];
        
        $nickname = $userinfo["basicUserInfo"]["userNick"];
       }
 * 
 * 
 */
    /*   
       if($gameid != "10000")
       {
        $sql =  "select * from  CASINOCOUPONCHANGEHIS left join CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT on CASINOCOUPONCHANGEHIS.productid = CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT.id $where and gamecode = $gameid   limit $beginindex , 20 ";
        $sql1 =  "select count(*) as count from  CASINOCOUPONCHANGEHIS  left join CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT on CASINOCOUPONCHANGEHIS.productid = CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT.id $where and  gamecode = $gameid  ";
       }else{
        $sql =  "select * from  CASINOCOUPONCHANGEHIS left join CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT on CASINOCOUPONCHANGEHIS.productid = CASINOGLOBALINFO.CASINOEXCHANGEPRODUCT.id $where limit $beginindex , 20 ";
        $sql1 =  "select count(*) as count from  CASINOCOUPONCHANGEHIS  $where ";   
       }
    */   
 

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
