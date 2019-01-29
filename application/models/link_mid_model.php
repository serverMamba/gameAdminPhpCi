<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class link_mid_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        $this->_require('pb_proto_onlinedata');
        
        // 用到的表名
        $this->dbglobal     = $this->dbalias['dbglobal'];
        $this->tbadwall     = $this->dbalias['tbadwallinfo'];
        $this->tbgameadwall = $this->dbalias['tbgameadwall'];
        $this->tbglobgift   = $this->dbalias['tbglobgift'];
        $this->tbtotalchip  = $this->dbalias['tbtotalchip'];
        $this->tbonlinestat = $this->dbalias['tbonlinestat'];
        $this->tbbroadcast  = $this->dbalias['tbbroadecast'];
        $this->propertytype = $this->dbalias['propertytype'];
        $this->propertylist = $this->dbalias['propertylist'];
        $this->gifttype     = $this->dbalias['gifttype'];
        $this->giftlist     = $this->dbalias['giftlist'];
        $this->tbmaxid      = $this->dbalias['tbmaxid'];
        $this->chiprank     = $this->dbalias['topchipslist'];
        $this->notifycation = $this->dbalias['notifycation'];
        
        // 数据库配置
        $this->dbconfig['database'] = $this->dbglobal;
        $this->db = $this->load->database($this->dbconfig, true);
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
    
    
      public function get_onlinestat($strdate, $start, $end,$gameid) {

        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);
        
       // print_r($this->db);
        
        $startx = @strtotime($strdate." 00:00:00");
        
        $yest = date('Y-m-d',$startx -60*60*24);
        
        $aweek = date('Y-m-d',$startx -60*60*24*7);
         
        $amon = date('Y-m-d',$startx -60*60*24*30);
        
        $where1 = " WHERE statistics_time > '$strdate $start:00' AND statistics_time < '$strdate $end:00'";
        
        $where2 = " WHERE statistics_time > '$yest $start:00' AND statistics_time < '$yest $end:00'";
         
        $where3 = " WHERE statistics_time > '$aweek $start:00' AND statistics_time < '$aweek $end:00'";
          
        $where4 = " WHERE statistics_time > '$amon $start:00' AND statistics_time < '$amon $end:00'";
        
        if($gameid != "10000")
        {
           $where1 = $where1." and  game_code = $gameid";
           $where2 = $where2." and  game_code = $gameid";
           $where3 = $where3." and  game_code = $gameid";
           $where4 = $where4." and  game_code = $gameid";
        }
        
        $sql1 = "SELECT substr(statistics_time,12,5) as tm,sum(server_membernum) as ct  FROM " . $this->tbonlinestat .$where1 ." group by tm ORDER BY tm";         
        $query1 = $this->db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1);
        
        $sql2 = "SELECT substr(statistics_time,12,5) as tm,sum(server_membernum) as ct  FROM " . $this->tbonlinestat .$where2 ." group by tm ORDER BY tm";         
        $query2 = $this->db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);
        
        $sql3 = "SELECT substr(statistics_time,12,5) as tm,sum(server_membernum) as ct  FROM " . $this->tbonlinestat .$where3 ." group by tm ORDER BY tm";         
        $query3 = $this->db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3);
        
        $sql4 = "SELECT substr(statistics_time,12,5) as tm,sum(server_membernum) as ct  FROM " . $this->tbonlinestat .$where4 ." group by tm ORDER BY tm";         
        $query4 = $this->db->query($sql4);
        $ret4 = $this->_dealwith_ret($query4);
        
        return array("today"=>$ret1,"yest"=>$ret2,"aweek"=>$ret3,"amon"=>$ret4); 

    }
    
    public function get_hismsg1($gameid,$mytime) {
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

    public function get_hismsg($gameid,$mytime) {
        
        if (in_array($gameid, array('0', '17',"18","49","97","98","145","146","177","178","193","257"))){
            return $this->get_hismsg1($gameid,$mytime);
        }
        
        if (in_array($gameid, array('100'))){
          return $this->get_hismsg2($gameid,$mytime);  
        }
 
    }

}
