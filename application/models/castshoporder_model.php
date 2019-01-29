<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class castshoporder_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
    public function exportData($action,$goodtype,$myendtime,$mystarttime,$status,$userid,$beginindex) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="user.csv"');
        header('Cache-Control: max-age=0');
        // 判断是否合法的时间
        if (!isDate($mystarttime))
        {
        	return array();
        }
         
        if (!isDate($myendtime))
        {
        	return array();
        }
        $CI = &get_instance();
        $db = $CI->load->database('gamebuygood', true);
        
         $where = "where ordertime  >= '$mystarttime' and  ordertime <= '$myendtime' and producttype <=1";
        
        if (!empty($userid)) {
            $where =  $where ." and userid = $userid" ;
         }
         
         if ($goodtype !="9999") {
            $where =  $where ." and producttype = $goodtype" ;
         }
         
          if ($status !="9999") {
            $where =  $where ." and salestatus = $status" ;
         }
        
     //   $sql =  " select orderid,ordertime,producttype,productid,productname,price,coupon,userid,gameid,mobile,salestatus,enable from  CASINOGOODORDERPAY $where ";
        
        $sql =  " select orderid,ordertime,mobile,userid,producttype,productid,productname,price,coupon,salestatus,enable from  CASINOGOODORDERPAY $where ";
        
        $query =  $db->query($sql);

        $fp = fopen('php://output', 'a');


       // $head = array('orderid','ordertime','producttype','productid','productname','price','coupon','userid','gameid','mobile','salestatus','enable');
      //  $head = array('流水号','订单时间','产品类型','产品ID','产品名称','价格','兑换券','用户ID','游戏ID','电话号码','发货状态','订单状态');
         $head = array("订单号","订单时间","手机号码","用户ID","商品类型","商品ID","商品名称","价格","兑换券","发货确认","订单确认", "总兑换券","兑换券数量（现在）","倍数关系","本id对应电话数","总付费","注册时间");
        foreach ($head as $i => $v) {
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        fputcsv($fp, $head);

        $cnt = 0;
        $limit = 100000;
        
        $ret = $this->_dealwith_ret($query); 
        
         foreach ($ret as $key => $value) {

          $useridxx = $value["userid"];
          $msg =$this->get_user_msg($useridxx);
          $ret[$key]["allcouponx"] = $msg[0]["coupon_total_given"];
          $ret[$key]["couponx"] = $msg[0]["coupon"];
  
          $ret[$key]["beishu"] = ceil( $ret[$key]["allcouponx"] /$ret[$key]["coupon"]);
          $ret[$key]["phonecount"] =$this->get_phone_count($useridxx);
          
          $ret[$key]["totalBuy"] = $msg[0]["totalBuy"];
           
           $ret[$key]["registertimex"] = $msg[0]["registertime"];
         }

          foreach ($ret as $index => $row) {
            $cnt ++;
            if ($limit == $cnt) { 
                ob_flush();
                flush();
                $cnt = 0;
            }

            foreach ($row as $i => $v) {
                $row[$i] = iconv('utf-8', 'gbk', $v)."\t";
            }
            fputcsv($fp, $row);
        }
    }
    
    
      public function updateorderx($orderid,$salestatus,$enable) {
        $CI = &get_instance();
        $db = $CI->load->database('gamebuygood', true);
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
    
    
     public function  get_user_msg($id){
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;
        
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
        $db = $CI->load->database($server, true);
        
       $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";
       $sql =  "select * from $databases where userid = $id ";
       $query =  $db->query($sql);
       $ret = $this->_dealwith_ret($query); 
       if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            $databases = "CASINOUSERDB_$dbx1.CASINOUSER_$posx1";
            $server = "eus".$dbx1;
            $db = $CI->load->database($server, true);
            $sql =  "select * from $databases where id = $id ";
            $query =  $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            return $ret;
        }
      return array();  
   }
   
      public function get_phone_count($id){
         $CI = &get_instance();
         $db = $CI->load->database('gamebuygood', true);
        
         $sql =  " select count(*) as cc from  CASINOGOODORDERPAY where userid = $id group by mobile ";
         
         $query =  $db->query($sql);
         $ret = $this->_dealwith_ret($query); 
         
         return $ret[0]["cc"];
         
     }

    public function get_shoporder_msg($action,$goodtype,$myendtime,$mystarttime,$status,$userid,$beginindex){
        
        $CI = &get_instance();
        $db = $CI->load->database('gamebuygood', true);
        // 判断是否合法的时间
        if (!isDate($mystarttime))
        {
        	return array();
        }
         
        if (!isDate($myendtime))
        {
        	return array();
        } 
         $where = "where ordertime  >= '$mystarttime' and  ordertime <= '$myendtime' and producttype <=1";
        
        if (!empty($userid)) {
            $where =  $where ." and userid = $userid" ;
         }
         
         if ($goodtype !="9999") {
            $where =  $where ." and producttype = $goodtype" ;
         }
         
          if ($status !="9999") {
            $where =  $where ." and salestatus = $status" ;
         }
        
        $sql =  " select * from  CASINOGOODORDERPAY $where ";
 
       $query =  $db->query($sql);
       $ret = $this->_dealwith_ret($query); 
       
       foreach ($ret as $key => $value) {

          $useridxx = $value["userid"];
          $msg =$this->get_user_msg($useridxx);
          $ret[$key]["allcouponx"] = $msg[0]["coupon_total_given"];
          $ret[$key]["couponx"] = $msg[0]["coupon"];
          $ret[$key]["registertimex"] = $msg[0]["registertime"];
          $ret[$key]["beishu"] = ceil( $ret[$key]["allcouponx"] /$ret[$key]["coupon"]);
          
          $ret[$key]["totalBuy"] = $msg[0]["totalBuy"];
           
           $ret[$key]["phonecount"] =$this->get_phone_count($useridxx);
         }
       return $ret; 
     }
     
     public function test() {
        echo "AAAAAAAAAAAAAAAAAAAAAA";
        $userinfo = $this->usernew_mid_model->query_user_info("890007");
        $account = $userinfo["defailUserInfo"]["userAccount"];
        $nickname = $userinfo["basicUserInfo"]["userNick"];
        print_r($account);
        print_r($nickname);
        echo "BBBBBBBBBBBBBBBBBBBBBBBBBBB";
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
        $where = "where happentime  >= '$mystarttime' and  happentime <= '$myendtime' and producttype <=1";
        
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
