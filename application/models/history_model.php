<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class History_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        // 用到的表名
        $this->dbgamehis    = $this->dbalias['dbgamehis'];
        $this->tbbroke      = $this->dbalias['tbbroke'];
        $this->tbgift       = $this->dbalias['tbgift'];
        $this->tbgiftchip   = $this->dbalias['tbgiftchip'];
        $this->tbbgaddsub   = $this->dbalias['tbaddsubhis'];
        $this->tbadwall     = $this->dbalias['tbadwall'];
        $this->tbofficegift = $this->dbalias['tbofficegift'];
        $this->tbgamehis    = $this->dbalias['tbgamehis'];
        $this->tbreghis     = $this->dbalias['tbreghis'];

        // 数据库配置
        $this->dbconfig['database'] = $this->dbgamehis;
        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);

    }
    

    public function get_roulette_total($strdate) 
    {
        $sql = "SELECT SUM(chips) AS total FROM {$this->tbgamehis}$strdate WHERE eventtype = 14";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        
        return $ret[0]['total'];
    }
    
    public function get_roulette_total1($strdate) 
    {
        $sql = "SELECT SUM(winchips) AS total FROM CASINOROULETTEHISTORY$strdate";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        
        return $ret[0]['total'];
    }
    
    public function get_roulette_total2($strdate) 
    {
        $sql = "SELECT SUM(wincoupons) AS total FROM CASINOROULETTEHISTORY$strdate";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret[0]['total'];
    }
    
    public function get_tiger_total($strdate) 
   {
        $sql = "SELECT (sum(scorelost) - sum(scorewin) ) AS total FROM CASINOLAOHUJIGAMERECORD$strdate";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret[0]['total'];
    }

    /**
     * 某天的广告墙统计
     * @param string $strdate
     */
    public function get_adwall_total($strdate) {
        $sql = "SELECT SUM(chips) AS total FROM {$this->tbgamehis}$strdate WHERE eventtype = 6";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret[0]['total'];
     }
    
    
    public function  get_choushui_total($strdate){
        $sql = "SELECT SUM(chips) AS total FROM {$this->tbgamehis}$strdate ";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret[0]['total']/2;
    }

        
    public function get_fafang_total($strdate){
        $sql = "select sum(chips) AS total from CASINOGAMEHISTORY$strdate where chips > 0 and eventtype not in (1,2,31,14,15,32,24)";
       // $sql = "SELECT SUM(chips) AS total FROM {$this->tbgamehis}$strdate ";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret[0]['total'];
    }
    
    /**
     * 某天所有游戏的抽水统计分别数据
     * @param string $strdate
     * @return number
     */
    public function get_broke_by_date_and_game($strdate) {
        
        $sql1 = "SELECT SUM(chips) AS total, gamecode FROM {$this->tbgamehis}$strdate WHERE eventtype IN ('1', '2', '24') AND chips < 0 GROUP BY gamecode";
        $sql2 = "SELECT SUM(chips) AS total, gamecode FROM {$this->tbgamehis}$strdate WHERE eventtype IN ('1', '2', '24') AND chips > 0 GROUP BY gamecode";
        
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        $ret2 = $this->_dealwith_ret($this->db->query($sql2));
        
        $tmp1 = array();
        $tmp2 = array();
        $ret  = array();
        foreach ($ret1 as $k)
        {
            $tmp1[strval($k['gamecode'])] = $k['total'];
        }
        
        foreach ($ret2 as $k)
        {
            $tmp2[strval($k['gamecode'])] = $k['total'];
        }
        
        foreach ($tmp1 as $k => $v)
        {
            $ret[$k] = abs($tmp1[$k]) - $tmp2[$k];
        }
       
         return $ret;
    }
    
    /**
     * 某天的总抽水统计
     * @param string $strdate
     * @return number
     */
    public function get_broke_by_date($strdate) 
    {
        $sql1 = "SELECT SUM(chips) AS total FROM {$this->tbgamehis} WHERE happentime LIKE '{$strdate}%' AND chips < 0";
        $sql2 = "SELECT SUM(chips) AS total FROM {$this->tbgamehis} WHERE happentime LIKE '{$strdate}%' AND chips > 0";

        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        $ret2 = $this->_dealwith_ret($this->db->query($sql2));
        
        return abs(abs($ret1[0]['total']) - abs($ret2[0]['total']));
    }
    
    /*
     * 抽水
     */
    public function get_broke($account) {
        $query = $this->db->get_where($this->tbbroke, array('userid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /*
     * 广告墙 
     */
    public function get_adwall($account) {
        $query = $this->db->get_where($this->tbadwall, array('userid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /*
     * 官方赠送
     */
    public function get_officegift($account) {
        $this->_use_read_db();
        $this->db = $this->load->database($this->dbconfig, true);
        $query = $this->db->get_where($this->tbofficegift, array('touserid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /*
     * 送礼物
     */
    public function get_gift($account) {
        $query = $this->db->get_where($this->tbgift, array('fromuserid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /*
     * 送筹码
     */
    public function get_chip($account) {
        $query = $this->db->get_where($this->tbgiftchip, array('fromuserid' => $account));
        return $this->_dealwith_ret($query); 
    }


    /*
     * 后台加减分 
     */
    public function get_bgaddsub($account) 
    {
        $this->db->order_by('happentime', 'desc');
        $query = $this->db->get_where($this->tbbgaddsub, array('userid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /**
     * 添加后台加减分记录
     * @param array $data array(userid, chipnum, happentime, eventcode, remark)
     */
    public function add_bgaddsub($data) 
    {
        $this->_use_write_db();
        $this->_use_db($this->dbgamehis);
        $this->db = $this->load->database($this->dbconfig, true);
        $query = $this->db->insert($this->tbbgaddsub, $data);
        return $this->db->affected_rows(); 
    }


    public function get_giftlist() {
        $query = $this->db->get_where($this->tbbgaddsub, array('userid' => $account));
        return $this->_dealwith_ret($query); 
    }

    /*
     * 输赢记录
     */
    public function get_win($account, $strdate, $strtime1, $strtime2) 
    {
        $this->db->where('userid', $account);
        $this->db->where('happentime > ', $strdate . ' ' . $strtime1 );
        $this->db->where('happentime < ', $strdate . ' ' . $strtime2 );
        $this->db->order_by('happentime', 'desc');
        $query = $this->db->get($this->tbgamehis . str_replace('-', '', $strdate));

        return $this->_dealwith_ret($query); 
    }
    
    
      public function get_songfeng($account, $strdate) 
    {
        $mytime = explode("-", $strdate);
        $filename = "http://211.151.33.246/present_score_" . $mytime[0] . $mytime[1] . $mytime[2] . "_10.0.0.6_10004_mid.log";
        $content = file_get_contents($filename);
        $myarray = explode("\n", $content);
        $myarrayx = array();
        foreach ($myarray as $key => $value) {
             $xxx = str_replace("user[","",$value);
             
             $xxx = str_replace("score[","",$xxx);
             
             $xxx = str_replace("]","",$xxx);
              
             $xxx = str_replace(",","",$xxx);
            
             $myarray1 = explode(" ", $xxx);
             
             if(empty($account))
             {
              $myarrayx[] = array("time"=>$myarray1[0],"sid"=>$myarray1[1],"sc"=>$myarray1[3],"did"=>$myarray1[4],"dc"=>$myarray1[6]);
             }else{
                 if(($account == $myarray1[1] ) ||($account ==$myarray1[4]))
                 {
                   $myarrayx[] = array("time"=>$myarray1[0],"sid"=>$myarray1[1],"sc"=>$myarray1[3],"did"=>$myarray1[4],"dc"=>$myarray1[6]);  
                 }
             }
        }
         return $myarrayx;
    }
    
    
    /**
     * 注册人数统计
     * @return array
     */
    public function get_regnum() {
    	$sql = "SELECT registertime, count(*) as num FROM " ;
    	$sql .= " (SELECT substring(registertime, 1, 10) as registertime from " . $this->tbreghis . ") as T";
//     	$sql .= " WHERE statistics_time > '$strdate $start:00'";
    	$sql .= " GROUP BY registertime ";
//     	$sql .= " ORDER BY registertime DESC ";
    	$query = $this->db->query($sql);
    	$ret = $this->_dealwith_ret($query);
    	return $ret;
    }
    
    /**
     * 游戏加减分
     * @param string $gameid
     * @param string $strdate
     * @param string $starttime
     * @param string $endtime
     * @return array
     */
    public function get_game_addsub($gameid, $strdate, $starttime, $endtime) {
        
        $sql = "SELECT * FROM {$this->tbgamehis}";
        $sql .= " WHERE gamecode = $gameid";
        $sql .= " AND happentime > '" . $strdate . ' ' . $starttime . "'";
        $sql .= " AND happentime < '" . $strdate . ' ' . $endtime . "'";
        $query = $this->db->query($sql);
        $ret = $this->_dealwith_ret($query);
        return $ret;
        
    }
    
    
    public function get_broke_all($str) {
        $CI = &get_instance();
       $db = $CI->load->database('gamebuyee', true);
      //  $sql = "select * from CASINOGLOBALINFO.CASINOSERVICEFEESTAT where stat_date = '$str';";
        $sql = "select * from CASINOSERVICEFEESTAT where stat_date = '$str';";
        $query =  $db->query($sql);
        $ret1 = $this->_dealwith_ret( $query); 
        return $ret1;  
     }
    
    
    /*
    public function get_broke_all($str) 
    {
        $sql = "select * from CASINOGLOBALINFO.CASINOSERVICEFEESTAT where stat_date = $str;";
        $ret = $this->_dealwith_ret($this->db->query($sql));
        return $ret;
    }
    
    */
    
    
    public function get_broke_TexasPoker($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from CASINOGAMEHISDB.CASINOGAMERECORD_TexasPoker_$str where isrobot = 0;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    
    public function get_broke_NiuNiuQiangZhuang($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from (select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuQiangZhuang_$str where isrobot = 0 union all select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuSeenCardQZ_$str where isrobot = 0) as nn;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_NiuNiuMalai($str)
    {
    	$sql1 = "select sum(user_table_fee) as total from (select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_NiuNiuMalai_$str where isrobot = 0) as nn;";
    	$ret1 = $this->_dealwith_ret($this->db->query($sql1));
    	return $ret1[0]['total'];
    }
    
    
    public function get_broke_ZJH($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from CASINOGAMEHISDB.CASINOGAMERECORD_ZJH_$str where isrobot = 0;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_DDZ($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from (select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_DDZ_$str where isrobot = 0 union all select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_DDZHUANLE_$str where isrobot = 0 union all select user_table_fee from CASINOGAMEHISDB.CASINOGAMERECORD_DDZLAIZI_$str where isrobot = 0) as ddz;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    
     public function get_broke_GUANDAN($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from CASINOGAMEHISDB.CASINOGAMERECORD_GUANDAN_$str where isrobot = 0;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_MJ2P($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from CASINOGAMEHISDB.CASINOGAMERECORD_MJ2P_$str where isrobot = 0;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_MJ($str) 
    {
        $sql1 = "select sum(user_table_fee) as total from CASINOGAMEHISDB.CASINOGAMERECORD_MJ_$str where isrobot = 0";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_CASINOROULETTEHISTORY($str) 
    {
        $sql1 = "select sum(chipcost) as total from CASINOGAMEHISDB.CASINOROULETTEHISTORY$str;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_CASINOROULETTEHISTORY1($str) 
    {
        $sql1 = "select sum(winchips) as total from CASINOGAMEHISDB.CASINOROULETTEHISTORY$str;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
    public function get_broke_CASINOROULETTEHISTORY3($str) 
    {
        $sql1 = "select sum(wincoupons) as total from CASINOGAMEHISDB.CASINOROULETTEHISTORY$str;";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }
    
        public function get_broke_CASINOROULETTEHISTORY4($str) 
    {
        $sql1 = "select (sum(scorelost) - sum(scorewin)) as total from CASINOGAMEHISDB.CASINOLAOHUJIGAMERECORD$str";
        $ret1 = $this->_dealwith_ret($this->db->query($sql1));
        return $ret1[0]['total'];
    }

    /******************************
     * test code from here 
     *****************************/

}
