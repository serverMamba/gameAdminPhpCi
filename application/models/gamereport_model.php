<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class gamereport_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_game_static($time, $key, $gameid) {
       
        $robet ="(3343329,3343330,3343331,3343332,3343333,3343334,3343335,3343336,3343337,3343339,3343340,3343341,3343343,3343347,3343349,3343350,3343351,3343352,3343353,3343355,
            3343356,3343357,3343358,3343360,3343361,3343363,3343364,3343365,3343366,3343367,3343368,3343369,334337,3343372,3343373,3343374,3343375,3343376,3343377,3343378,3343379,
            3343380,3343381,3343383,3343384,3343385,3343386,3343387,3343388,3343389,3343390,3343391,3343392,3343393,3343394,3343396,3343397,3343399,3343400,3343402,3343403,3343404,
            3343405,3343406,3343408,3343409,3343411,3343412,3343415,3343416,3343417,3343419,3343421,3343424,3343425,3343426,3343427,3343429,3343431,3343432,3343433,3343435,3343437,
            3343438,3343439,3343440,3343443,3343444,3343445,3343447,3343448,3343449,3343450,3343451,3343452,3343453,3343454,3343455,3343456,3343458,3333868, 3333869, 3333872, 3333873, 3333875, 3333876, 3333877, 3333878, 3333879, 3333880, 3333882, 3333883, 3333885, 3333886, 3333888,
3333890, 3333891, 3333893, 3333894, 3333897, 3333898, 3333899, 3333900, 3333902, 3333903, 3333904, 3333906, 3333907, 3333909, 3333910,
3333911, 3333913, 3333914, 3333916, 3333917, 3333918, 3333919, 3333921, 3333922, 3333923, 3333924, 3333925, 3333926, 3333927, 3333928,
3333929, 3333930, 3333931, 3333932, 3333933, 3333934, 3333935, 3333936, 3333938, 3333940, 3333941, 3333944, 3333945, 3333946, 3333947,
3333948, 3333949, 3333952, 3333953, 3333954, 3333955, 3333957, 3333958, 3333959, 3333960, 3333961, 3333963, 3333964, 3333965, 3333966,
3333968, 3333969, 3333970, 3333971, 3333972, 3333973, 3333976, 3333977, 3333980, 3333981, 3333983, 3333984, 3333986, 3333987, 3333988,
3333989, 3333991, 3333992, 3333993, 3333995, 3333997, 3333998, 3334000, 3334001, 3334002)";
        
        $robet1 = "(3779257,3779258,3779260,3779262,3779264,3779265,3779266,3779268,3779269,3779272,3779273,3779275,3779276,3779277,3779279,3779281,3779283,3779284,3779285,3779286,
                 3779288,3779290,3779291,3779293,3779294,3779295,3779297,3779298,3779299,3779300,3779301,3779302,3779303,3779305,3779307,3779308,3779310,3779311,3779312,3779313,
                 3779315,3779316,3779318,3779319,3779320,3779321,3779322,3779323,3779324,3779325,3779326,3779328,3779329,3779332,3779334,3779335,3779336,3779338,3779341,3779342,
                 3779343,3779345,3779346,3779348,3779349,3779350,3779352,3779354,3779355,3779356,3779357,3779358,3779359,3779361,3779362,3779364,3779367,3779368,3779369,3779371,
                 3779372,3779374,3779377,3779379,3779380,3779381,3779382,3779383,3779385,3779386,3779388,3779390,3779392,3779394,3779396,3779397,3779398,3779400,3779402,3779403,3779410, 3779411, 3779413, 3779417, 3779418, 3779420, 3779421, 3779422, 3779423, 3779424, 3779426, 3779427, 3779428, 3779429,
3779431, 3779432, 3779434, 3779435, 3779436, 3779437, 3779439, 3779440, 3779441, 3779442, 3779443, 3779444, 3779446, 3779447, 3779448, 3779449, 3779451, 3779452,
3779453, 3779454, 3779455, 3779456, 3779458, 3779459, 3779460, 3779461, 3779462, 3779463, 3779464, 3779465, 3779466, 3779467, 3779469, 3779470, 3779471, 3779472,
3779473, 3779474, 3779475, 3779476, 3779477, 3779479, 3779480, 3779482, 3779483, 3779484, 3779486, 3779487, 3779489, 3779490, 3779491, 3779493, 3779495, 3779497,
3779498, 3779499, 3779500, 3779501, 3779502, 3779504, 3779505, 3779506, 3779508, 3779509, 3779511, 3779512, 3779513, 3779516, 3779517, 3779518, 3779519, 3779520,
3779521, 3779522, 3779523, 3779524, 3779525, 3779526, 3779527, 3779529, 3779530, 3779533, 3779534, 3779536, 3779537, 3779538)"; 
         
        $robet2 = "(3897426,3897427,3897429,3897430,3897431,3897432,3897433,3897435,3897436,3897439,3897440,3897442,3897443,3897444,3897445,3897446,3897449,3897450,3897452,3897453,3897455,3897456,3897457,3897458,3897459,3897461,3897463,3897465,3897466,3897467,3897469,3897472,3897474,3897475,3897476,3897477,3897478,3897479,3897480,3897481,3897485,3897486,3897487,3897489,3897491,3897492,3897493,3897494,3897496,3897498,3897499,3897501,3897502,3897503,3897505,3897507,3897508,3897510,3897511,3897512,3897513,3897514,3897515,3897517,3897519,3897521,3897522,3897523,3897525,3897527,3897528,3897529,3897531,3897532,3897534,3897535,3897536,3897537,3897538,3897539,3897540,3897542,3897543,3897546,3897548,3897549,3897551,3897552,3897553,3897554,3897555,3897556,3897557,3897558,3897559,3897561,3897562,3897563,3897565,3897566,3897624,3897625,3897627,3897628,3897629,3897630,3897631,3897633,3897634,3897635,3897636,3897637,3897638,3897639,3897640,3897641,3897642,3897643,3897644,3897645,3897646,3897647,3897648,3897649,3897651,3897652,3897654,3897655,3897656,3897657,3897658,3897659,3897660,3897661,3897663,3897665,3897666,3897667,3897669,3897670,3897672,3897674,3897675,3897677,3897678,3897679,3897680,3897681,3897683,3897685,3897686,3897687,3897688,3897690,3897691,3897692,3897693,3897694,3897695,3897696,3897698,3897699,3897701,3897704,3897705,3897706,3897707,3897708,3897709,3897711,3897712,3897715,3897716,3897718,3897719,3897720,3897721,3897722,3897724,3897725,3897726,3897730,3897731,3897732,3897734,3897735,3897737,3897739,3897740,3897743,3897744,3897745,3897746,3897748,3897749,3897750,3897752,3897754,3897757,3897758)";
         
         $robet3 = "(3357126, 3357127, 3357128, 3357129, 3357131, 3357132, 3357133, 3357135, 3357137, 3357140, 3357141, 3357142, 3357143, 3357144, 3357145, 3357146, 3357148, 3357149,
3357150, 3357151, 3357153, 3357154, 3357155, 3357157, 3357159, 3357161, 3357162, 3357163, 3357165, 3357166, 3357168, 3357169, 3357171, 3357172, 3357175, 3357177,
3357178, 3357179, 3357180, 3357181, 3357183, 3357186, 3357187, 3357189, 3357190, 3357191, 3357192, 3357193, 3357194, 3357195, 3357196, 3357197, 3357199, 3357200,
3357201, 3357202, 3357203, 3357204, 3357206, 3357207, 3357208, 3357209, 3357210, 3357211, 3357212, 3357213, 3357214, 3357215, 3357216, 3357220, 3357221, 3357223,
3357224, 3357225, 3357226, 3357229, 3357230, 3357231, 3357232, 3357234, 3357236, 3357237, 3357239, 3357241, 3357242, 3357243, 3357244, 3357245, 3357247, 3357249,
3357250, 3357251, 3357252, 3357253, 3357255, 3357256, 3357259, 3357260, 3357261, 3357262, 3357274, 3357276, 3357278, 3357279, 3357280, 3357281, 3357282, 3357283,
3357284, 3357285, 3357286, 3357287, 3357288, 3357289, 3357290, 3357291, 3357292, 3357293, 3357294, 3357295, 3357296, 3357297, 3357300, 3357301, 3357302, 3357303,
3357304, 3357305, 3357307, 3357308, 3357310, 3357311, 3357312, 3357313, 3357314, 3357315, 3357316, 3357317, 3357318, 3357320, 3357321, 3357323, 3357325, 3357326,
3357328, 3357329, 3357330, 3357333, 3357334, 3357335, 3357336, 3357339, 3357340, 3357341, 3357342, 3357343, 3357344, 3357345, 3357346, 3357347, 3357348, 3357349,
3357351, 3357352, 3357353, 3357354, 3357356, 3357357, 3357358, 3357360, 3357361, 3357362, 3357363, 3357364, 3357365, 3357366, 3357368, 3357369, 3357371, 3357372,
3357373, 3357374, 3357375, 3357377, 3357379, 3357380, 3357381, 3357383, 3357384, 3357386, 3357388, 3357389, 3357390, 3357391, 3357392, 3357393, 3357396, 3357398,
3357400, 3357401)";


        $mysplit = explode("-", $time);
        $myyear = $mysplit[0];
        $mymonth = substr("00" . $mysplit[1], -2);
        $myday = substr("00" . $mysplit[2], -2);

        $dbtables = array("1"=>"CASINOGAMERECORD_TexasPoker_", "145" => "CASINOGAMERECORD_GUANDAN_", "146" => "CASINOGAMERECORD_GUANDANPrivate_","148" => "CASINOGAMERECORD_GUANDAN_","178"=>"CASINOGAMERECORD_MJ_","257"=>"CASINOGAMERECORD_TeenPatti_","18"=>"CASINOGAMERECORD_NiuNiuQiangZhuang_","17"=>"CASINOGAMERECORD_NiuNiu_",  "20"=>"CASINOGAMERECORD_NiuNiuSeenCardQZ_", "49"=>"CASINOGAMERECORD_ZJH_",  "97" => "CASINOGAMERECORD_DDZ_", "98" => "CASINOGAMERECORD_DDZHUANLE_", "100" => "CASINOGAMERECORD_DDZTOURNAMENT_", "101"=>"CASINOGAMERECORD_DDZLAIZI_", "177" => "CASINOGAMERECORD_MJ2P_");
        
        $gameidlist = array("1"=>"0","145" =>"8",  "20"=>"1", "178"=>"18","257"=>"16", "0"=>"10000","17" => "1","145"=>"8", "146"=>"8","148"=>"8","18" => "1", "49" => "3", "97" => "6", "98" => "6", "100" => "6","101" => "6", "177" => "14");
        
        $gameidy = $gameidlist[$gameid];

        $dbtablesx = $dbtables[$gameid];
        
        $gt = "user_id>=100000";
        $lt = "user_id < 100000";
        
         if($gameid == "1"){
           $gt = "isrobot <> 1";
           $lt = "isrobot = 1";    
        }
        
        if($gameid == "97"){
          // $gt = "user_id not in  $robet";
          // $lt = "user_id in $robet"; 
             $gt = "isrobot <> 1";
           $lt = "isrobot = 1";    
        }
        
         if($gameid == "98"){
           //$gt = "user_id not in  $robet3";
          // $lt = "user_id in $robet3"; 
              $gt = "isrobot <> 1";
           $lt = "isrobot = 1";    
        }
        
        if($gameid == "257"){
           $gt = "user_id not in  $robet1";
           $lt = "user_id in $robet1";    
        }
        
        if($gameid == "177"){
           $gt = "((user_id not in  $robet2) and (user_id > 100000))";
           $lt = "((user_id in $robet2) or (user_id < 100000))";    
        }
        
        
        if(($gameid == "17")||($gameid == "18")||($gameid == "20")||($gameid == "49")){
           $gt = "isrobot <> 1";
           $lt = "isrobot = 1";    
        }

        $tablename = $dbtablesx . $myyear . $mymonth . $myday;
        
        if($gameid == "148"){
           $tablename = "CASINOGAMERECORD_GUANDANTVTournament"; 
        }

        $CI = &get_instance();
        $db = $CI->load->database('gamehis_slave', true);

        if ($key == "yxjs") {
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $sql = "select aa.room_id as roomid,count(aa.game_number) as count  from (select room_id,game_number from $tablename where $gt group by room_id,game_number) aa group by aa.room_id;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");
            $rr = array();

            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;

            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(game_number) as count from (select game_number from $tablename  where $gt group by game_number) aa;";

            $query1 = $db->query($sql1);

            $ret1 = $this->_dealwith_ret($query1);

            $rr["合计"] =   $ret1[0]["count"];
            return $rr;
        }

        if ($key == "yxjshi") {

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $sql = "select room_id as roomid,sum(game_time) as count from $tablename where $gt group by room_id;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();

            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;

            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = round($ret[$keyx]["count"] / 3600, 2);
            }

            $sql1 = "select sum(game_time) as count from $tablename where $gt;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = round((float) $ret1[0]["count"] / 3600, 2);
            return $rr;
        }

        if ($key == "scsr") {
            $this->payment_tables = $this->config->item('payment_tables');
            $ssum = 0;
            foreach ($this->payment_tables as $keyx => $valuex) {
                $namex = $valuex["tbname"];
                $sql = "select sum(totalfee) as xx  from CASINOBUYHISDB.$namex  where  tradeTime > '$myyear-$mymonth-$myday 00:00:00' and  tradeTime < '$myyear-$mymonth-$myday 23:59:59' and gamecode = 29;";
                $query = $db->query($sql);
                $ret = $this->_dealwith_ret($query);
                $ssum = $ssum + $ret[0]['xx'];
            }

            $rr = array();
            $rr["合计"] = 0;
            if (count($ret) > 0) {
                $rr["合计"] = $ssum;
            }
            return $rr;
        }

        if ($key == "dxl") {

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $sql = "select aa.room_id as roomid,count(aa.game_number) as count  from (select room_id,game_number from $tablename where $gt group by room_id,game_number) aa group by aa.room_id;";

            $query = $db->query($sql);

            $ret = $this->_dealwith_ret($query);

            $rr = array();

            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;

            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(game_number) as count from (select game_number from $tablename  where $gt group by game_number) aa;";

            $query1 = $db->query($sql1);

            $ret1 = $this->_dealwith_ret($query1);

            $rr["合计"] = $ret1[0]["count"];

            $sql2 = "select aa.room_id as roomid,count(aa.game_number) as count  from (select room_id,game_number from $tablename where $gt and user_offline_status<>0  group by room_id,game_number) aa group by aa.room_id;";

            $query2 = $db->query($sql2);

            $ret2 = $this->_dealwith_ret($query2);

            $rr2 = array();

            $rr2["新手场"] = 0;
            $rr2["初级场"] = 0;
            $rr2["中级场"] = 0;
            $rr2["高级场"] = 0;
            $rr2["vip场"] = 0;
            $rr2["合计"] = 0;

            foreach ($ret2 as $keyx => $value) {
                $rr2[$gametypex[$ret[$keyx]["roomid"]]] = $ret2[$keyx]["count"];
            }

            $sql3 = "select count(game_number) as count from (select game_number from $tablename  where $gt and user_offline_status<>0 group by game_number) aa;";

            $query3 = $db->query($sql3);

            $ret3 = $this->_dealwith_ret($query3);

            $rr2["合计"] = $ret3[0]["count"];


            $rr3 = array();

            $rr3["新手场"] = 0;
            $rr3["初级场"] = 0;
            $rr3["中级场"] = 0;
            $rr3["高级场"] = 0;
            $rr3["vip场"] = 0;
            $rr3["合计"] = 0;

            if ($rr["新手场"] > 0) {
                $rr3["新手场"] = round($rr2["新手场"] * 100 / $rr["新手场"], 2);
            }
            if ($rr["初级场"] > 0) {
                $rr3["初级场"] = round($rr2["初级场"] * 100 / $rr["初级场"], 2);
            }
            if ($rr["中级场"] > 0) {
                $rr3["中级场"] = round($rr2["中级场"] * 100 / $rr["中级场"], 2);
            }
            if ($rr["高级场"] > 0) {
                $rr3["高级场"] = round($rr2["高级场"] * 100 / $rr["高级场"], 2);
            }
            if ($rr["vip场"] > 0) {
                $rr3["vip场"] = round($rr2["vip场"] * 100 / $rr["vip场"], 2);
            }
            if ($rr["合计"] > 0) {
                $rr3["合计"] = round($rr2["合计"] * 100 / $rr["合计"], 2);
            }

            return $rr3;
        }


        if ($key == "dryxrs") {

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $sql = "select aa.room_id as roomid,count(aa.user_id) as count from (select room_id,user_id from $tablename where $gt group by room_id,user_id) aa group by aa.room_id ;";

            $query = $db->query($sql);

            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(user_id) as count from (select user_id from $tablename where $gt group by user_id) aa;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = $ret1[0]["count"];
            return $rr;
        }
        
        //机器人净分

      if ($key == "jqrjf") {

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

           $sql = "select room_id as roomid,sum(user_score_end - user_score_begin + user_table_fee) as count from $tablename where $lt group by room_id";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(user_score_end - user_score_begin + user_table_fee) as count from $tablename where $lt;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = $ret1[0]["count"];
            return $rr;
        }
        
         //机器人加分
        
         if ($key == "jqrgf") {
             
            $tablename = "CASINOGAMEHISTORY" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }


            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            
            $tmpcode = 1000;
            
             if ($gameid == 177) {
                $tmpcode = 14;
            }
            if ($gameid == 178) {
                $tmpcode = 18;
            }
            if (($gameid == 97) || ($gameid == 98) || ($gameid == 101)) {
                $tmpcode = 6;
            }
            if ($gameid == 257) {
                $tmpcode = 16;
            }
            if ($gameid == 1) {
                $tmpcode = 0;
            }
            if (($gameid == 17) || ($gameid == 18) || ($gameid == 20)) {
                $tmpcode = 1;
            }
            if ($gameid == 49) {
                $tmpcode = 3;
            }
            if (($gameid == 145) || ($gameid == 146)) {
                $tmpcode = 8;
            }

            $sql1 = "select sum(chips) as count from $tablename where eventtype = 31 and chips > 0 and gamecode = $tmpcode;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] =  $ret1[0]["count"];
            return $rr;
        }
        
        //机器人减分
        
         if ($key == "jqrsf") {
             
            $tablename = "CASINOGAMEHISTORY" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            
            
            $tmpcode = 1000;
            
             if ($gameid == 177) {
                $tmpcode = 14;
            }
            if ($gameid == 178) {
                $tmpcode = 18;
            }
            if (($gameid == 97) || ($gameid == 98) || ($gameid == 101)) {
                $tmpcode = 6;
            }
            if ($gameid == 257) {
                $tmpcode = 16;
            }
            if ($gameid == 1) {
                $tmpcode = 0;
            }
            if (($gameid == 17) || ($gameid == 18) || ($gameid == 20)) {
                $tmpcode = 1;
            }
            if ($gameid == 49) {
                $tmpcode = 3;
            }
            if (($gameid == 145) || ($gameid == 146)) {
                $tmpcode = 8;
            }

            $sql1 = "select sum(chips) as count from $tablename where eventtype = 31 and chips < 0 and gamecode = $tmpcode;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] =  $ret1[0]["count"];
            return $rr;
        }
        
        
        if ($key == "zzf") {
            
            $strdate = $myyear.$mymonth.$myday;
            
            if(($gameid == "17")||($gameid == "49"))
            {
               // $tablename = "CASINOGAMEHISTORY".$strdate;
            }
 
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            
            if(($gameid == "17")||($gameid == "49"))
            {
                /*
                $sql1 = "SELECT SUM(chips) AS total from $tablename WHERE eventtype IN ('1', '2', '24') AND chips < 0 AND gamecode = $gameidy";
                $sql2 = "SELECT SUM(chips) AS total from $tablename WHERE eventtype IN ('1', '2', '24') AND chips > 0 AND gamecode = $gameidy";
                $query1 = $db->query($sql1);
                $query2 = $db->query($sql2);
                $ret1 = $this->_dealwith_ret($query1);
                $ret2 = $this->_dealwith_ret($query2);
        
                $rr = array();
                $rr["合计"] = abs($ret1[0]["total"]) - abs($ret2[0]["total"])  ;
                return $rr;
                 * 
                 */
            }

            $sql = "select room_id as roomid,sum(user_table_fee) as count from $tablename where $gt group by room_id";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(user_table_fee) as count from $tablename where $gt;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = $ret1[0]["count"];
            return $rr;
        }



        if ($key == "djhs") {

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $sql = "select aa.room_id as roomid,sum(aa.game_time) as count from  (select game_time, room_id from $tablename  group by game_number) as aa  group by aa.room_id;";

            $query = $db->query($sql);

            $ret = $this->_dealwith_ret($query);
            $rr = array();

            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;

            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = round($ret[$keyx]["count"], 2);
            }

            $sql1 = "select sum(aa.game_time) as count from (select game_time, room_id from $tablename  group by game_number) as aa;";

            $query1 = $db->query($sql1);

            $ret1 = $this->_dealwith_ret($query1);

            $rr["合计"] = round((float) $ret1[0]["count"], 2);

            $sql2 = "select aa.room_id as roomid,count(aa.game_number) as count  from (select room_id,game_number from $tablename  group by room_id,game_number) aa group by aa.room_id;";

            $query2 = $db->query($sql2);

            $ret2 = $this->_dealwith_ret($query2);

            $rr2 = array();

            $rr2["新手场"] = 0;
            $rr2["初级场"] = 0;
            $rr2["中级场"] = 0;
            $rr2["高级场"] = 0;
            $rr2["vip场"] = 0;
            $rr2["合计"] = 0;

            foreach ($ret2 as $keyx => $value) {
                $rr2[$gametypex[$ret[$keyx]["roomid"]]] = $ret2[$keyx]["count"];
            }

            $sql3 = "select count(game_number) as count from (select game_number from $tablename  group by game_number) aa;";

            $query3 = $db->query($sql3);

            $ret3 = $this->_dealwith_ret($query3);

            $rr2["合计"] = $ret3[0]["count"];


            $rr3 = array();

            $rr3["新手场"] = 0;
            $rr3["初级场"] = 0;
            $rr3["中级场"] = 0;
            $rr3["高级场"] = 0;
            $rr3["vip场"] = 0;
            $rr3["合计"] = 0;

            if ($rr2["新手场"] > 0)
                $rr3["新手场"] = round($rr["新手场"] / ($rr2["新手场"] ), 2);
            if ($rr2["初级场"] > 0)
                $rr3["初级场"] = round($rr["初级场"] / ($rr2["初级场"] ), 2);
            if ($rr2["中级场"] > 0)
                $rr3["中级场"] = round($rr["中级场"] / ($rr2["中级场"] ), 2);
            if ($rr2["高级场"] > 0)
                $rr3["高级场"] = round($rr["高级场"] / ($rr2["高级场"] ), 2);
            if ($rr2["vip场"] > 0)
                $rr3["vip场"] = round($rr["vip场"] / ($rr2["vip场"] ), 2);
            if ($rr2["合计"] > 0)
                $rr3["合计"] = round($rr["合计"] / ($rr2["合计"] ), 2);

            return $rr3;
        }



        if ($key == "zzsfwf") {
            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            return $rr;
        }

        /*
        if ($key == "xzyh") {

            $mysplit = explode("-", $time);
            $myyear = $mysplit[0];
            $mymonth = substr("00" . $mysplit[1], -2);
            $myday = substr("00" . $mysplit[2], -2);
            $tablename = "CASINOREGISTERHISTORY" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $sql = "select count(*) as count from $tablename where gamecode = $gameid;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = 0;

            if (count($ret) > 0) {
                $rr["合计"] = $ret[0]["count"];
            }
            return $rr;
        }
         * 
         * 
         */

        if ($key == "dyhyyh") {

            $mysplit = explode("-", $time);
            $myyear = $mysplit[0];
            $mymonth = substr("00" . $mysplit[1], -2);
            $myday = substr("00" . $mysplit[2], -2);

            $logintable = "CASINOLOGINHISTORY" . $myyear . $mymonth . $myday;


            $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$logintable'";

            $query1 = $db->query($sql1);

            $ret1 = $this->_dealwith_ret($query1);

            $tableflag2 = count($ret1);


            if ($tableflag2 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            $sql = "select count(*) as xx from (select userid from $logintable where gamecode = $gameid group by userid) as aa;";
            if ($gameid != "0") {
                $sql = "select count(*) as xx from (select userid from $logintable where gamecode = $gameid group by userid) as aa;;";
            }
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }

        if ($key == "qrhyyh") {

            $yytime = @strtotime("$myyear-$mymonth-$myday 00:00:00");

            $logintable = "CASINOLOGINHISTORY" . $myyear . $mymonth . $myday;

            $mysqlx = "(select userid from $logintable where gamecode = $gameid )";

            for ($i = 1; $i < 7; $i++) {
                //  $mydate = date('Y-m-d', time($yytime) - 60 * 60 * 24 * $i);
                $mydate = date('Y-m-d', $yytime - 60 * 60 * 24 * $i);
                $mysplitx = explode("-", $mydate);

                $myyear = $mysplitx[0];
                $mymonth = $mysplitx[1];
                $myday = $mysplitx[2];

                $logintable = "CASINOLOGINHISTORY" . $myyear . $mymonth . $myday;

                $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$logintable'";

                $query1 = $db->query($sql1);

                $ret1 = $this->_dealwith_ret($query1);

                $tableflag2 = count($ret1);

                if ($tableflag2 >= 1) {
                    $mysqlx = $mysqlx . "union all" . "(select userid from $logintable where gamecode = $gameid )";
                }
            }


            $sql = "select count(*) as xx from (select bb.userid from ($mysqlx) as bb  group by bb.userid) as aa;";
            if ($gameid != "0") {
                $sql = "select count(*) as xx from (select bb.userid from ($mysqlx) as bb  group by bb.userid) as aa;";
            }

            //  echo $sql;
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }


        if ($key == "ssrhyyh") {
            $yytime = @strtotime("$myyear-$mymonth-$myday 00:00:00");
            $logintable = "CASINOLOGINHISTORY" . $myyear . $mymonth . $myday;

            $mysqlx = "(select userid from $logintable where gamecode = $gameid )";

            for ($i = 1; $i < 14; $i++) {
                // $mydate = date('Y-m-d', time($yytime) - 60 * 60 * 24 * $i);
                $mydate = date('Y-m-d', $yytime - 60 * 60 * 24 * $i);
                $mysplitx = explode("-", $mydate);

                $myyear = $mysplitx[0];
                $mymonth = $mysplitx[1];
                $myday = $mysplitx[2];

                $logintable = "CASINOLOGINHISTORY" . $myyear . $mymonth . $myday;

                $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$logintable'";

                $query1 = $db->query($sql1);

                $ret1 = $this->_dealwith_ret($query1);

                $tableflag2 = count($ret1);

                if ($tableflag2 >= 1) {
                    $mysqlx = $mysqlx . "union all" . "(select userid from $logintable where gamecode = $gameid )";
                }
            }


            $sql = "select count(*) as xx from (select bb.userid from ($mysqlx) as bb  group by bb.userid) as aa;";
            if ($gameid != "0") {
                $sql = "select count(*) as xx from (select bb.userid from ($mysqlx) as bb  group by bb.userid) as aa;";
            }
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = $ret[0]['xx'];
            return $rr;
        }

        //兑换券总量
        if ($key == "dhjzn") {
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
             $where = "where result = 0 ";
          
            if($gameid !="0")
            {
               $gamecode = $gameidlist[$gameid];
               $where =  $where." and gametype = $gameid and gamecode= $gamecode"; 
             }

            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
           if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
            
            return $rr;
        }
        
       //兑换券总发放人数
        if ($key == "dhjzffrs") {
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
             $where = "where result = 0 ";
          
             if($gameid !="0")
            {
                $gamecode = $gameidlist[$gameid];
                $where =  $where." and gametype = $gameid and gamecode= $gamecode  "; 
             }
            
            $sql = "select count(*) as count from (select userid from $tablename $where group by userid) as bbb";
            $query = $db->query($sql);
            $ret0 = $this->_dealwith_ret($query);

           // $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
             $sql = "select roomid,count(roomid) as count from (select roomid,userid from $tablename $where group by roomid,userid) as aaa group by roomid;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

         
            $rr["合计"] = $ret0[0]["count"];
            return $rr;
        }


        //兑换券人均获得
        if ($key == "dhjrjhd") {
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0";
          
            if($gameid !="0")
            {
               $gamecode = $gameidlist[$gameid];
               $where =  $where." and gametype = $gameid and gamecode= $gamecode "; 
             }
            
            $sql = "select count(*) as count from (select userid from $tablename $where group by userid) as bbb";
            $query = $db->query($sql);
            $ret0 = $this->_dealwith_ret($query);

            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            
            $sql2 = "select roomid,count(roomid) as count from (select roomid,userid from $tablename $where group by roomid,userid) as aaa group by roomid;";
            $query2 = $db->query($sql2);
            $ret2 = $this->_dealwith_ret($query2);
            
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                if($ret2[$keyx]["count"] == 0){
                   $rr[$gametypex[$ret[$keyx]["roomid"]]] = 0;  
                }else{
                  $rr[$gametypex[$ret[$keyx]["roomid"]]] = round($ret[$keyx]["count"] / $ret2[$keyx]["count"],0);
                }
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = round($ret1[0]["count"]/$ret0[0]["count"],0);
            return $rr;
        }

        //兑换券每小时发放
        if ($key == "dhjmxsff") {

            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;

            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 ";
          
            if($gameid !="0")
            {
               $where =  $where." and gametype = $gameid "; 
             }

            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where  group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = round($ret[$keyx]["count"]/24,0);
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where ;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $rr["合计"] = round($ret1[0]["count"]/24,0);
            return $rr;
        }
        
     if ($key == "xzyh") {
         $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameidy !="10000")
         {
            $where =  $where." and (gamecode = $gameidy or gamecode = 10000+$gameidy)"; 
         }
         
       //  if($channel !="10000")
        // {
           // $where = $where ." and channelid = $channel";   
       //  }
          
         $sql = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx'];
         return $rr;

        }


        if ($key == "zczs") {
            
            
            $CI = &get_instance();
         $db = $CI->load->database('globalinfo', true);
         $where = "where statistics_date = '$myyear-$mymonth-$myday'";
          
         if($gameidy !="10000")
         {
            $where =  $where." and (gamecode = $gameidy or gamecode = 10000+$gameidy)"; 
         }
         
       //  if($channel !="10000")
        // {
           // $where = $where ." and channelid = $channel";   
       //  }
          
         $sql = "select sum(new_user_count) as xx from CASINOBUSINESSSTATISTICS $where";

         $query = $db->query($sql );
         $ret = $this->_dealwith_ret($query);
         $rr = array();
         $rr["合计"] = $ret[0]['xx']*3000;
        // $rr["合计"] =  $sql;
          
         return $rr;

        }

       

        if ($key == "jjlq") {


            $tablename1 = "CASINOGAMEHISTORY" . $myyear . $mymonth . $myday;
            $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename1'";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $tableflag2 = count($ret1);

            if ($tableflag2 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }

            // $sql = "select sum(chips) as count from CASINOGAMEHISTORY20140521  where eventtype =12 and gamecode = 999999 ;";
            $sql = "select sum(chips) as count from $tablename1  where eventtype =12 and gamecode = $gameidy ;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = 0;
            if (count($ret) > 0) {
                $rr["合计"] = $ret[0]["count"] + 0;
            }
            return $rr;
        }

        if ($key == "dljl") {

            $tablename1 = "CASINOGAMEHISTORY" . $myyear . $mymonth . $myday;
            $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename1'";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $tableflag2 = count($ret1);

            if ($tableflag2 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            //  $sql = "select sum(chips) as count from CASINOGAMEHISTORY20140521  where eventtype =13 and gamecode = 999999 ;";
            $sql = "select sum(chips) as count from $tablename1   where eventtype =13 and gamecode = $gameidy ;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = 0;
            if (count($ret) > 0) {
                $rr["合计"] = $ret[0]["count"] + 0;
            }
            return $rr;
        }

        if ($key == "rwjl") {

            $tablename1 = "CASINOGAMEHISTORY" . $myyear . $mymonth . $myday;
            $sql1 = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename1'";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            $tableflag2 = count($ret1);

            if ($tableflag2 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            //  $sql = "select sum(chips) as count from CASINOGAMEHISTORY20140521  where eventtype = 25 and gamecode = 999999 ;";
            $sql = "select sum(chips) as count from $tablename1  where eventtype = 25 and gamecode = $gameidy ;";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $rr = array();
            $rr["合计"] = 0;
            if (count($ret) > 0) {
                $rr["合计"] = $ret[0]["count"] + 0;
            }
            return $rr;
        }



        if ($key == "zgzxrs") {
            $CI = &get_instance();
            $db = $CI->load->database('dbhischart', true);

            $where = "where statistics_time  >= '$myyear-$mymonth-$myday 00:00:00' and  statistics_time <= '$myyear-$mymonth-$myday 23:59:59'";
            if ($gameid != "0") {
                $where = $where . " and  gametype = $gameid";
            }
            $sql = "select max(ct) as count from( select substr(statistics_time,12,5) as tm ,sum(roomusercount) as ct from CASINODETAILONLINESTATISTICS $where group by statistics_time) aa";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);

            $rr = array();
            $rr["合计"] = $ret[0]["count"] + 0;
            return $rr;
        }
        
         //18  特别 
        
        
         if ($key == "nnhsdhjsl"){
             
             if($gameid != '18'){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 18 and taskid = 0 ";
 
            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
             if(count($ret1)>0)
            {
               $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
                  
         }
              
         if ($key == "jlhsdhjsl"){
             
             if($gameid != '18'){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 18 and taskid = 1 ";
 
            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
             if(count($ret1)>0)
            {
               $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
                  
         }
              
         if ($key == "nnhsdhjcs"){
             
             if($gameid !="18"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 18 and taskid = 0 ";
            
  
            $sql = "select roomid ,count(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
              return $rr;
                  
         }
              
         if ($key == "jlhsdhjcs"){
             
             if($gameid !="18"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 18 and taskid = 1 ";
            
  
            $sql = "select roomid ,count(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
              return $rr;
                  
         }
      
         
        
        //49  特别
        
        
        if ($key == "bzff") {
            
            if($gameid != '49'){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 1 ";
 
            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
             if(count($ret1)>0)
            {
               $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
            
            
        }
        if ($key == "bzffcs") {
            
             if($gameid !="49"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 1 ";
            
  
            $sql = "select roomid ,count(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
              return $rr;
            
        }
        if ($key == "A235hsff") {
            
            if($gameid !="49"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
             $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
          $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 2";
            

            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
             if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
            
        }
        if ($key == "A235hsffcs") {
             
            if($gameid !="49"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
              
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 2 ";
            

            $sql = "select roomid ,count(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
            
        }
        if ($key == "allbzff") {
            
             if($gameid !="49"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
           $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 0 ";
            
  
            $sql = "select roomid ,sum(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select sum(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
            
        }
        if ($key == "allbzffcs") {
            
             if($gameid !="49"){
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
             }
            
            $tablename = "CASINOCOUPONCHANGEHIS" . $myyear . $mymonth . $myday;
            
            $sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tablename'";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $tableflag1 = count($ret);

            if ($tableflag1 < 1) {
                $rr = array();
                $rr["合计"] = 0;
                return $rr;
            }
            
            $where = "where result = 0 and reason = 0 and gametype = 49 and taskid = 0";
          
            $sql = "select roomid ,count(couponnumadded) as count from $tablename $where group by roomid";
            $query = $db->query($sql);
            $ret = $this->_dealwith_ret($query);
            $gametypex = array(0 => "新手场", 1 => "初级场", 2 => "中级场", 3 => "高级场", 4 => "vip场");

            $rr = array();
            $rr["新手场"] = 0;
            $rr["初级场"] = 0;
            $rr["中级场"] = 0;
            $rr["高级场"] = 0;
            $rr["vip场"] = 0;
            $rr["合计"] = 0;
            foreach ($ret as $keyx => $value) {
                $rr[$gametypex[$ret[$keyx]["roomid"]]] = $ret[$keyx]["count"];
            }

            $sql1 = "select count(couponnumadded) as count from $tablename $where;";
            $query1 = $db->query($sql1);
            $ret1 = $this->_dealwith_ret($query1);
            if(count($ret1)>0)
            {
            $rr["合计"] = $ret1[0]["count"];
            }
            
              return $rr;
            
        }


        $rr = array();
        $rr["合计"] = 0;
        return $rr;
    }

}
