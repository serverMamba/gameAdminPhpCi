<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class syjqr_mid_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        $this->_require('pb_proto_onlinedata');
    }

  public function getrangeby($min,$max){
      echo $this->get_detail_hisx($min,$max);
     
  }
    
     public function get_detail_hisx($min,$max) {

          $where = "  where  scoreWinFromRobot >=$min and scoreWinFromRobot < $max ";

        $sql1 = "select count(id) as cc from (
(select id from CASINOUSERDB_0. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_0. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_1. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_2. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_3. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_4. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_5. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_6. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_7. CASINOUSER_15 $where) 
) as tt;";

        $sql2 = "select count(id) as cc from (
(select id from CASINOUSERDB_8. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_8. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_9. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_10. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_11. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_12. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_13. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_14. CASINOUSER_15 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_0 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_1 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_2 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_3 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_4 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_5 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_6 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_7 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_8 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_9 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_10 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_11 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_12 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_13 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_14 $where) union all
(select id from CASINOUSERDB_15. CASINOUSER_15 $where) 
) as tt;";
        
        
        $CI1 = &get_instance();
        $db1 = $CI1->load->database('us1', true);
        
        $query1 = $db1->query($sql1);
        $ret1 = $this->_dealwith_ret($query1);
        
        
        $CI2 = &get_instance();
        $db2 = $CI2->load->database('us2', true);
        
        $query2 = $db2->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);
        
        $rrz = $ret1[0]["cc"] +  $ret2[0]["cc"] ;
        
          return $rrz;
        
    }

}
