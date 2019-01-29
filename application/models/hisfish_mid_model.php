<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class hisfish_mid_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        $this->_require('pb_proto_onlinedata');
    }

    public function test() {

        $this->_require('pb_proto_pbclientgameserver');
        $scoreoper = new GameServerMiddleLayerServerScoreOperation();
        $scoreoper->set_userID(10000);
        $scoreoper->set_score(1000);
        $scoreoper->set_gameCode('999999');
        $scoreoper->set_addtype($chip > 0 ? EnumAddScoreType::enumAddScoreType_BackgroundAdd :
                        EnumAddScoreType::enumAddScoreType_BackgroundSub);
        $dret = $chip > 0 ? EnumAddScoreType::enumAddScoreType_BackgroundAdd :
                EnumAddScoreType::enumAddScoreType_BackgroundSub;

        $buf = $scoreoper->SerializeToString();

        echo $buf;
    }
    
    public function get_hismsg1($gameid,$mytime) {
             $CI = &get_instance();
        $db = $CI->load->database('dbhischart', true);
        
        $startx = @strtotime($mytime." 00:00:00");
        
        $yest = date('Y-m-d',$startx -60*60*24);
        
        $aweek = date('Y-m-d',$startx -60*60*24*7);
         
        $amon = date('Y-m-d',$startx -60*60*24*30);
 
        $where1 = "where statistics_time  >= '$mytime 00:00:00' and  statistics_time <= '$mytime 23:59:59' and roomid =4 and gametype = 193 ";
        
        $where2 = "where statistics_time  >= '$mytime 00:00:00' and  statistics_time  <= '$mytime 23:59:59' and roomid =3 and gametype = 193 ";
        
        $where3 = "where statistics_time  >= '$mytime 00:00:00' and  statistics_time <= '$mytime 23:59:59' and roomid =2 and gametype = 193 ";
        
        $where4 = "where statistics_time  >= '$mytime 00:00:00' and  statistics_time  <= '$mytime 23:59:59' and roomid =1 and gametype = 193 ";
        
        $gameserverip["193"] = '183.56.162.113';
//         $gameserverip["20193"] = "211.151.33.252";
//         $gameserverip["30193"] = "211.151.33.250";
//         $gameserverip["40193"] = "211.151.130.4";
        
        $xxip = $gameserverip[$gameid];
        
        
     
        if($gameid != "0")
        {
           $where1 = $where1." and  gameserverip = '$xxip'";
           $where2 = $where2." and  gameserverip = '$xxip'";
           $where3 = $where3." and  gameserverip = '$xxip'";
           $where4 = $where4." and  gameserverip = '$xxip'";
        }
        
        
        $sql1 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINODETAILONLINESTATISTICS $where1 group by statistics_time ";
        $sql2 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINODETAILONLINESTATISTICS $where2 group by statistics_time ";
        $sql3 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINODETAILONLINESTATISTICS $where3 group by statistics_time ";
        $sql4 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINODETAILONLINESTATISTICS $where4 group by statistics_time ";
        
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
        
        $query2 =  $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2); 
        
        $query3 =  $db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3); 
        
        $query4 =  $db->query($sql4);
        $ret4 = $this->_dealwith_ret($query4); 

        return array("today"=>$ret1,"yest"=>$ret2,"aweek"=>$ret3,"amon"=>$ret4);    
    
    }
    
    /*
    public function get_hismsg2($gameid,$mytime) {
        $CI = &get_instance();
        $db = $CI->load->database('dbhischart', true);
        
        $startx = @strtotime($mytime." 00:00:00");
        
        $yest = date('Y-m-d',$startx -60*60*24);
        
        $aweek = date('Y-m-d',$startx -60*60*24*7);
         
        $amon = date('Y-m-d',$startx -60*60*24*30);
 
        $where1 = "where statistics_time  >= '$mytime 00:00:00' and  statistics_time <= '$mytime 23:59:59'";
        
        $where2 = "where statistics_time  >= '$yest 00:00:00' and  statistics_time  <= '$yest 23:59:59'";
        
        $where3 = "where statistics_time  >= '$aweek 00:00:00' and  statistics_time <= '$aweek 23:59:59'";
        
        $where4 = "where statistics_time  >= '$amon 00:00:00' and  statistics_time  <= '$amon 23:59:59'";
     
        if($gameid != "0")
        {
           $where1 = $where1." and  gametype = $gameid";
           $where2 = $where2." and  gametype = $gameid";
           $where3 = $where3." and  gametype = $gameid";
           $where4 = $where4." and  gametype = $gameid";
        }
        
        $sql1 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINOONLINETOURNAMENTGAMESTATISTICS $where1 group by statistics_time ";
        $sql2 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINOONLINETOURNAMENTGAMESTATISTICS $where2 group by statistics_time ";
        $sql3 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINOONLINETOURNAMENTGAMESTATISTICS $where3 group by statistics_time ";
        $sql4 =  "select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINOONLINETOURNAMENTGAMESTATISTICS $where4 group by statistics_time ";
        
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
        
        $query2 =  $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2); 
        
        $query3 =  $db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3); 
        
        $query4 =  $db->query($sql4);
        $ret4 = $this->_dealwith_ret($query4); 

        return array("today"=>$ret1,"yest"=>$ret2,"aweek"=>$ret3,"amon"=>$ret4);    
    
    }
     * 
     * 
     */

    //public function get_hismsg($gameid,$mytime) {
        
        /*
        if (in_array($gameid, array('0','1', '17',"18","20","21","49","51","52", "97","98","101","145","146","148","149","177","178","193","257"))){
            return $this->get_hismsg1($gameid,$mytime);
        }
        
        if (in_array($gameid, array('100'))){
          return $this->get_hismsg2($gameid,$mytime);  
        }
         * 
         */
 
    //}

}
