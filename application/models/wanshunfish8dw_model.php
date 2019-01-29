<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class wanshunfish8dw_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_game_static($starttime,$endtime) {
  
        $CI = &get_instance();
        $db = $CI->load->database('gamebuyee', true);
       // $sql = "select * from CASINOGLOBALINFO.CASINOFISHSTAT where statistics_date <= '$endtime' and statistics_date >= '$starttime'";
        $sql = "select * from CASINOSTATDB.CASINOVIDEOARCADESTAT where statistics_date <= '$endtime' and statistics_date >= '$starttime'";
        $query = $db->query($sql);
        $ret = $this->_dealwith_ret($query);
        return $ret;
   
    }

}
