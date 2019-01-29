<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class shopreport_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
    }

    public function get_shop_static($time, $key, $gameid,$channel) {
        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        $myday = substr("00" . $mysplit[2], -2);
        $tablename = " CASINOTABLECUSTOMPAYORDER" . $myyear ."_" .$mysplit[1] ;
        
       
        $CI = &get_instance();
        $db = $CI->load->database('gamebuy', true);
        
        $where = "where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'";
        
        if($gameid != "10000")
        {
           $where  = $where." and gamecode = $gameid";   
        }
        
        if($channel != "10000")
        {
           $where  = $where." and channel = $channel";   
        }
        
        
      if ($key == "money30") {
          
          $where = $where ." and money = 30;";
          
          $sql = "select count(orderid) as xx  from $tablename  $where";
           
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
       if ($key == "money5") {
           
          $where = $where ." and money = 5;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
         if ($key == "money2") {
             
          $where = $where ." and money = 2;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
       if ($key == "money10") {
          $where = $where ." and money = 10;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }

        
        if ($key == "money15") {
            
          $where = $where ." and money = 15;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
        if ($key == "money50") {
          $where = $where ." and money = 50;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
      if ($key == "money100") {
         // $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and money = 100;";
          
         // if($gameid !="10000")
          //{
           // $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and gamecode = $gameid and money = 100;";   
         // }
          
           $where = $where ." and money = 100;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
         // $rr["合计"] = $sql ;
          return $rr;
        }
        
         if ($key == "money500") {
          //$sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and money = 500;";
          
         // if($gameid !="10000")
         // {
          //  $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and gamecode = $gameid and money = 500;";   
         // }
             
               $where = $where ." and money = 500;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
          
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
                 if ($key == "money1000") {
         // $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and money = 1000;";
          
         // if($gameid !="10000")
         // {
          //  $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and gamecode = $gameid and money = 1000;";   
         // }
             
                        $where = $where ." and money = 1000;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
                     
                     
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        if ($key == "money5000") {
         // $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and money = 5000;";
          
         // if($gameid !="10000")
          //{
           // $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'   and gamecode = $gameid and money = 5000;";   
         // }
                         $where = $where ." and money = 5000;";
          $sql = "select count(orderid) as xx  from $tablename  $where";
            
            
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
       if ($key == "moneyyk") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and money = 10";
          
          if($gameid !="10000")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and gamecode = $gameid and money = 10";   
          }
          
           if($channel != "10000")
        {
            $sql   =  $sql ." and channel = $channel";   
        }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
      if ($key == "moneyjk") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and money = 30";
          if($gameid !="10000")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and gamecode = $gameid and money = 30";   
          }
          
           if($channel != "10000")
        {
            $sql   =  $sql ." and channel = $channel";   
        }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
        if ($key == "moneyzs") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and money = 50";
          
          if($gameid !="10000")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 204 and gamecode = $gameid and money = 50";   
          }
          
           if($channel != "10000")
        {
            $sql   =  $sql ." and channel = $channel";   
        }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
        
        $rr = array();
        $rr["合计"] = -50;
        return $rr;
    }

    public function get_currmonth($userid, $paytype) {
        $tablename = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', time());

        $tablename1 = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', strtotime('-1 month', time()));

        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);

        $endtime = date('Y-m-d H:i:s', time());

        $starttime = date('Y-m-d H:i:s', time() - 24 * 60 * 60 * 30);

        $sql1 = "select sum(money) summoney from $tablename where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
        $query1 = $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1);

        $sql2 = "select sum(money) summoney from $tablename1 where userid = '$userid' and paytype = '$paytype' and callbacktime >= '$starttime' and callbacktime <= '$endtime' ";
        $query2 = $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);

        $ret = $ret1[0]["summoney"] + $ret2[0]["summoney"];

        return $ret;
    }

    public function get_near_order($userid) {
        $tablename = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);

        $sql = "select max(ordertime) maxtime from $tablename where userid = '$userid' ";
        $query = $db->query($sql);


        return $this->_dealwith_ret($query);
    }

    public function getorder($orderid) {
        $tablename = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);

        $sql = "select * from $tablename where orderid = '$orderid'";
        $query = $db->query($sql);

        return $this->_dealwith_ret($query);
    }

    public function updateorder($orderid, $realmoney, $callbacktime, $callbackstatus) {
        $tablename = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', time());
        $CI = &get_instance();
        $db = $CI->load->database('hisorder', true);

        $record = array(
            "callbacktime" => $callbacktime,
            "realmoney" => $realmoney,
            "callbackstatus" => $callbackstatus
        );
        $db->where('orderid', $orderid);
        $ret = $db->update($tablename, $record);
        return $ret;
    }

    public function insertorder($ordertime, $callbacktime, $deviceid, $userid, $gamecode, $gameid, $paytype, $producttype, $productid, $channel, $carrier, $mobile, $ip, $orderid, $money, $realmoney, $callbackstatus) {
        $tablename = "CASINOTABLECUSTOMPAYORDER" . date('Y_n', time());
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
