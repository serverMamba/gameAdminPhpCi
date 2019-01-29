<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class coffee_mid_model extends MY_Model {

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
        $db = $CI->load->database('dbhischartee', true);
        
        $startx = @strtotime($mytime." 00:00:00");
        
        $yest = date('Y-m-d',$startx -60*60*24);
        
        $aweek = date('Y-m-d',$startx -60*60*24*7);
         
        $amon = date('Y-m-d',$startx -60*60*24*30);
 
        $where1 = "where stattime  >= '$mytime 00:00:00' and  stattime <= '$mytime 23:59:59'";
        
        $where2 = "where stattime  >= '$yest 00:00:00' and  stattime  <= '$yest 23:59:59'";
        
        $where3 = "where stattime  >= '$aweek 00:00:00' and  stattime <= '$aweek 23:59:59'";
        
        $where4 = "where stattime  >= '$amon 00:00:00' and  stattime  <= '$amon 23:59:59'";
     
        if($gameid != "0")
        {
           $where1 = $where1." and  gametype = $gameid";
           $where2 = $where2." and  gametype = $gameid";
           $where3 = $where3." and  gametype = $gameid";
           $where4 = $where4." and  gametype = $gameid";
        }
        
        $sql1 =  "select substr(stattime,12,5) as tm ,sumchips/100 as sumchips,sumcofferchips/100 as sumcofferchips from CASINOSUMCHIPHISTORY $where1 ";
        $sql2 =  "select substr(stattime,12,5) as tm ,sumchips/100 as sumchips,sumcofferchips/100 as sumcofferchips from CASINOSUMCHIPHISTORY $where2 ";
        $sql3 =  "select substr(stattime,12,5) as tm ,sumchips/100 as sumchips,sumcofferchips/100 as sumcofferchips from CASINOSUMCHIPHISTORY $where3  ";
        $sql4 =  "select substr(stattime,12,5) as tm ,sumchips/100 as sumchips,sumcofferchips/100 as sumcofferchips from CASINOSUMCHIPHISTORY $where4  ";
        
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
    
 
    public function get_hismsg($gameid,$mytime) {
            return $this->get_hismsg1($gameid,$mytime);
 
    }

}
