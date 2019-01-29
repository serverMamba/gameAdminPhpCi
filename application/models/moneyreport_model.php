<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class moneyreport_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
        // $this->payment_tables = $this->config->item('payment_tables');
    }

    public function get_money_static($time, $key, $gameid,$channel) {
        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        $myday = substr("00" . $mysplit[2], -2);

        $CI = &get_instance();
        $db = $CI->load->database('globalinfo', true);

        if ($key == "hyrs") {

            $where = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                  $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)";   
            }
            
             if ($channel != "10000") {
                  $where =  $where." and channelid = $channel";   
            }

            $sql = "select sum(active_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }

        if ($key == "ffrs") {

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

        if ($key == "scffrs") {

            $where = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where =  $where." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
             if ($channel != "10000") {
                  $where =  $where." and channelid = $channel";   
            }

            $sql = "select sum(firstpay_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }



        if ($key == "ffyhbl") {
            $where1 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where1 =  $where1." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where1 =  $where1." and channelid = $channel";   
            }

            $sql1 = "select sum(active_user_count) as xx from CASINOBUSINESSSTATISTICS $where1";

            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);


            $where2 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where2 =  $where2." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where2 =  $where2." and channelid = $channel";   
            }

            $sql2 = "select sum(pay_user_count_oldclient) as xx from CASINOBUSINESSSTATISTICS $where2";

            $query2 = $db->query($sql2);
            $ret2 = $this->_dealwith_ret($query2);


            $rr = array();
            if ($ret1[0]['xx'] == 0) {
                $rr["合计"] = '0.000%';
            } else {
                $rr["合计"] = round($ret2[0]['xx']*100 / $ret1[0]['xx'], 3)."%";
            }
            return $rr;
        }


        if ($key == "ffje") {
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


        if ($key == "arpu") {

            $where1 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where1 =  $where1." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where1 =  $where1." and channelid = $channel";   
            }

            $sql1 = "select sum(active_user_count) as xx from CASINOBUSINESSSTATISTICS $where1";

            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);


            $where2 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where2 =  $where2." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where2 =  $where2." and channelid = $channel";   
            }

            $sql2 = "select sum(pay_total_money_oldclient) as xx from CASINOBUSINESSSTATISTICS $where2";

            $query2 = $db->query($sql2);
            $ret2 = $this->_dealwith_ret($query2);


            $rr = array();
            if ($ret1[0]['xx'] == 0) {
                $rr["合计"] = '0.000';
            } else {
                $rr["合计"] = round($ret2[0]['xx'] / $ret1[0]['xx'], 3);
            }
            return $rr;
        }


        if ($key == "srffyhbl") {
            $where1 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where1 =  $where1." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where1 =  $where1." and channelid = $channel";   
            }

            $sql1 = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where1";

            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);


            $where2 = "where statistics_date = '$myyear-$mymonth-$myday'";

            if ($gameid != "10000") {
                $where2 =  $where2." and (gamecode = $gameid or gamecode = 10000+$gameid)"; 
            }
            
            if ($channel != "10000") {
                  $where2 =  $where2." and channelid = $channel";   
            }

            $sql2 = "select sum(new_pay_user_count) as xx from CASINOBUSINESSSTATISTICS $where2";

            $query2 = $db->query($sql2);
            $ret2 = $this->_dealwith_ret($query2);


            $rr = array();
            if ($ret1[0]['xx'] == 0) {
                $rr["合计"] = "0.000%";
            } else {
                $rr["合计"] = round($ret2[0]['xx']*100 / $ret1[0]['xx'], 3)."%";
            }
            return $rr;
        }


        $rr = array();
        $rr["合计"] = -1;
        return $rr;
    }

   
}
