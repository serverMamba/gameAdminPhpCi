<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class castshoporder1_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
    public function exportData($action,$orderid,$myendtime,$mystarttime,$phoneid,$userid,$beginindex) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user.csv"');
        header('Cache-Control: max-age=0');
        
        
    $statuslist  = array();
    
    
     $statuslist["0000"] = "提交成功";
     $statuslist["1001"] = "参数不完整";
     $statuslist["1002"] = "手机号不正确";
     $statuslist["1003"] = "金额不正确";
     $statuslist["1004"] = "用户不存在";
     $statuslist["1005"] = "密码不正确";
     $statuslist["2001"] = "用户暂停";
     $statuslist["1006"] = "IP鉴权失败";
     $statuslist["1007"] = "md5key验证不正确";
     $statuslist["2002"] = "账户余额异常";
     $statuslist["2003"] = "手机号是黑名单";
     $statuslist["2004"] = "订单是重复";
     $statuslist["2005"] = "余额不足";
     $statuslist["2006"] = "该产品未开通";
     $statuslist["9999"] = "系统错误";
     
     
     $statuslist1  = array();
    
    
     $statuslist1["0000"] = "查询成功";
     $statuslist1["1001"] = "参数不完整";
     $statuslist1["1002"] = "手机号不正确";
     $statuslist1["1003"] = "金额不正确";
     $statuslist1["1004"] = "用户不存在";
     $statuslist1["1005"] = "密码不正确";
     $statuslist1["2001"] = "用户暂停";
     $statuslist1["1006"] = "IP鉴权失败";
     $statuslist1["1007"] = "md5key验证不正确";
     
     $statuslist1["9999"] = "系统错误";
     
     $statuslist2  = array();
    
    
     $statuslist2["1000"] = "订单支付成功";
     $statuslist2["1001"] = "订单下单失败";
     $statuslist2["1002"] = "订单支付中";
     $statuslist2["1003"] = "订单支付失败";
     $statuslist2["1004"] = "订单不存在";

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
        $where = "where submittime  >= '$mystarttime' and  submittime <= '$myendtime'";
        
        
         if (!empty($userid)) {
            $where =  $where ." and userid = $userid" ;
         }
         
         if (!empty($orderid)) {
            $where =  $where ." and orderid = $orderid" ;
         }
         
          if (!empty($phoneid)) {
            $where =  $where ." and mobile = $phoneid" ;
         }
        
     //   $sql =  " select orderid,ordertime,producttype,productid,productname,price,coupon,userid,gameid,mobile,salestatus,enable from  CASINOGOODORDERPAY $where ";
        
        $sql =  " select id , userid,huafei,huafeiquan,orderid, mobile, submittime,finishtime,submitresult,queryresult, status from CASINOHUAFEIEXCHANGEHIS $where order by id desc";
        
        $query =  $db->query($sql);

        $fp = fopen('php://output', 'a');


       // $head = array('orderid','ordertime','producttype','productid','productname','price','coupon','userid','gameid','mobile','salestatus','enable');
      //  $head = array('流水号','订单时间','产品类型','产品ID','产品名称','价格','兑换券','用户ID','游戏ID','电话号码','发货状态','订单状态');
         $head = array("系统ID","用户ID","话费数","一元兑奖劵数","订单号","手机号码","订单时间","完成时间","兑换提交状态","兑换查询","兑换查询状态");
        foreach ($head as $i => $v) {
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        fputcsv($fp, $head);

        $cnt = 0;
        $limit = 100000;
        
        $ret = $this->_dealwith_ret($query); 

          foreach ($ret as $index => $row) {
            $cnt ++;
            if ($limit == $cnt) { 
                ob_flush();
                flush();
                $cnt = 0;
            }
            
            foreach ($row as $i => $v) {

                if($i == "submitresult"){
                    $row[$i] = $statuslist[trim($row[$i])];
                }
                
                if($i == "queryresult"){
                    $row[$i] =  $statuslist1[trim($row[$i])];
                }
                
                if($i == "status"){
                    $row[$i] =  $statuslist2[trim($row[$i])];
                }
            }

            foreach ($row as $i => $v) {
                 
                if(($i != "huafei")&&($i != "huafeiquan")){
                  $row[$i] = iconv('utf-8', 'gbk', $v)."\t";
                }
            }
            fputcsv($fp, $row);
        }
    }
    
    
      public function updateorderx($orderid,$salestatus,$enable) {
        $CI = &get_instance();
        $db = $CI->load->database('gamebuy', true);
        $confirmtime = date('Y-m-d H:i:s',time());
        
         /*
        $sql = "UPDATE CASINOGOODORDERPAY SET confirmtime='$confirmtime',salestatus=$salestatus ,enable=$enable WHERE orderid='$orderid' and confirmtime ='0000-00-00 00:00:00'";
        $db->query($sql );
        */

        $record = array(
            "confirmtime" => $confirmtime,
            "salestatus" => $salestatus,
            "enable" => $enable
        );
        $db->where('orderid', $orderid);
      //  $db->where('confirmtime', "0000-00-00 00:00:00");

        $ret =  $db->update("CASINOGOODORDERPAY", $record);
        return $ret;
       
     }
     
    
    public function save_config_data($data1,$data2){
        $kv1 = array();
        foreach ($data1 as $key => $value){
               $kv1[$value["key"]] = $value["value"];
            }
        
        $kv2 = array();
        foreach ($data2 as $key => $value){
               $kv2[$value["key"]] = $value["value"];
            }
            
        foreach ($kv1  as $key => $salestatus){
              $enable = $kv2[$key];
              $this->updateorderx($key,$salestatus,$enable);
               //echo $key,"--",$salestatus,"--", $enable,"</br>";
            }
        
    }

    public function get_shoporder_msg($action,$orderid,$myendtime,$mystarttime,$phoneid,$userid,$beginindex){
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
        $where = "where submittime  >= '$mystarttime' and  submittime <= '$myendtime'";
        
        if (!empty($userid)) {
            $where =  $where ." and userid = $userid" ;
         }
         
         if (!empty($orderid)) {
            $where =  $where ." and orderid = $orderid" ;
         }
         
          if (!empty($phoneid)) {
            $where =  $where ." and mobile = $phoneid" ;
         }
        
        $sql =  " select * from  CASINOHUAFEIEXCHANGEHIS  $where order by id desc";
 
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
