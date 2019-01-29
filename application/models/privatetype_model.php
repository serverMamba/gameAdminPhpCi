<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class totalreport_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
         $this->payment_tables = $this->config->item('payment_tables');
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

    public function get_total_static($time, $key, $gameid) {
        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        $myday = substr("00" . $mysplit[2], -2);
        $tablename = "CASINOTABLECUSTOMPAYORDER" . $myyear ."_" .$mysplit[1] ;
        
        $logintable = "CASINOLOGINHISTORY" . $myyear .$mymonth.$myday ;
        
        $CI = &get_instance();
        $db = $CI->load->database('gamebuy', true);

      if ($key == "hyrs") {
          $CI = &get_instance();
          $db = $CI->load->database('gamehis', true);
          
          $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$logintable'";

          $query1 = $db->query($sql1);

          $ret1 = $this->_dealwith_ret($query1);
          
          $tableflag2 = count($ret1);


        if ($tableflag2 < 1) {
            $rr = array();
            $rr["合计"] = 0;
            return $rr;
        }
          
          $sql = "select count(*) as xx from (select userid from $logintable group by userid) as aa;";
          if($gameid !="0")
          {
            $sql = "select count(*) as xx from (select userid from $logintable group by userid) as aa;;";   
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
       if ($key == "ffrs") {
            
           $strdata = $myyear."-" .$mymonth."-".$myday;
            
           $sql1 = $this->getsql($strdata);
 
           $sql = "select count(*) as xx from ( select userid as xx  from ($sql1) as aa group by userid ) bb;";
          
          if($gameid !="0")
          {
             $sql = "select count(*) as xx from ( select userid as xx  from ($sql1) as aa group by userid ) bb;";
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
         if ($key == "scffrs") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and money = 2;";
          
          if($gameid !="0")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and gamecode = $gameid and money = 2;";   
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
       if ($key == "ffyhbl") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and money = 10;";
          
          if($gameid !="0")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and gamecode = $gameid and money = 10;";   
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }

        
        if ($key == "ffje") {
            $strdata = $myyear."-" .$mymonth."-".$myday;
            
           $sql1 = $this->getsql($strdata);
 
           $sql = " select sum(totalfee) as xx  from ($sql1) as aa  ;";
          
          if($gameid !="0")
          {
             $sql = " select sum(totalfee) as xx  from ($sql1) as aa ;";
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
        if ($key == "arpu") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and money = 50;";
          
          if($gameid !="0")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and gamecode = $gameid and money = 50;";   
          }
          $query = $db->query($sql );
          $ret = $this->_dealwith_ret($query);
       
          $rr = array();
          $rr["合计"] = $ret[0]['xx'];
          return $rr;
        }
        
        
      if ($key == "srffyhbl") {
          $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and money = 100;";
          
          if($gameid !="0")
          {
            $sql = "select count(orderid) as xx  from $tablename  where  callbacktime > '$myyear-$mymonth-$myday 00:00:00' and  callbacktime < '$myyear-$mymonth-$myday 23:59:59'  and producttype = 201 and gamecode = $gameid and money = 100;";   
          }
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
