<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class totalreportm_model extends MY_Model {

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

    public function get_totalm_static($time, $key, $gameid, $channel,$starttime,$endtime) {
        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        //$myday = substr("00" . $mysplit[2], -2);

        if ($key == "totalm1") {
            $CI = &get_instance();
           // $db = $CI->load->database('globalinfo', true);
            $db = $CI->load->database('gamebuyee', true);
            $where = "where statistics_date <= '$myyear-$mymonth-31' and statistics_date >= '$myyear-$mymonth-00'";

            if ($gameid != "10000") {
                $where = $where . " and (gamecode = $gameid or gamecode = 10000+$gameid)";
            }

            if ($channel != "10000") {
                $where = $where . " and channelid = $channel";
            }

            $sql = "select sum(new_device_count) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }

        if ($key == "totalm2") {
            $CI = &get_instance();
           // $db = $CI->load->database('globalinfo', true);
             $db = $CI->load->database('gamebuyee', true);
            $where = "where statistics_date <= '$myyear-$mymonth-31' and statistics_date >= '$myyear-$mymonth-00'";

            if ($gameid != "10000") {
                $where = $where . " and (gamecode = $gameid or gamecode = 10000+$gameid)";
            }

            if ($channel != "10000") {
                $where = $where . " and channelid = $channel";
            }

            $sql = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }


        if ($key == "totalm17") {
            $CI = &get_instance();
           // $db = $CI->load->database('globalinfo', true);
             $db = $CI->load->database('gamebuyee', true);

            $where = "where register_month_first_date = '$starttime-01' and pay_month_first_date <= '$endtime-31' and pay_month_first_date >= '$starttime-00'";
            
            if ($gameid != "10000") {
                $where = $where . " and (gamecode = $gameid or gamecode = 10000+$gameid)";
            }

            if ($channel != "10000") {
                $where = $where . " and channelid = $channel";
            }

           // $sql = "select sum(pay_total_money_oldclient) as xx from CASINOBUSINESSSTATISTICS $where";
            
            $sql = "select sum(pay_total_money_oldclient) as xx from CASINOUSERLIFECYCLESTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }
        
         if ($key == "maxpeopleid") {
             $CI = &get_instance();
             $db = $CI->load->database('globalinfo', true);
            
            $sql = "select id from CASINOGLOBALINFO.CASINOUSERIDGENERATOR";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = $ret[0]['id'];
            return $rr;
             
         }


        $rr = array();
        $rr["合计"] = -1;
        return $rr;
    }

}
