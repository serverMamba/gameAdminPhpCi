<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class detail_model extends MY_Model {

    var $db = null;
    var $payment_tables = null;

    public function __construct() {
        parent::__construct();
        $this->load->model('usernew_mid_model');
        $this->load->model ( 'no3/paylimit_model' );
         require_once(APPPATH . 'third_party/message/pb_message.php');
         
        $this->_require('pb_proto_pbclientgameserver');
        $this->_require('pb_proto_onlinedata');
        //$this->_require('pb_proto_SMCmiddlelayerserver');
    }

    public function kickuser($uid) {

        $query = new KickOffUserReq();
        $query->set_userID($uid);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80041);

        $rsp = new KickOffUserRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    public function add_blacklist($type, $content, $desc) {
        if ($type == '1') {
            $command = 80013;
            $query = new AddIPBlackListReq();
            $query->set_userip($content);
            $query->set_describecontent($desc);
            $rsp = new AddIPBlackListRsp();
        } elseif ($type == '2') {
            $command = 80017;
            $query = new AddMACBlackListReq();
            $query->set_usermac($content);
            $query->set_describecontent($desc);
            $rsp = new AddMACBlackListRsp();
        } elseif ($type == '3') {
            $command = 80015;
            $query = new AddUserIDBlackListReq();
            $query->set_userID($content);
            $query->set_describecontent($desc);
            $rsp = new AddUserIDBlackListRsp();
        }

        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, $command);

        $rsp->ParseFromString($ret);
		if ($rsp->returncode () == 0) {
			$CI = &get_instance ();
			$db = $CI->load->database ( 'us3', true );
			if($type == '1'){
// 				$data = array(
// 						'userip'=>$content,
// 						'describecontent'=>$desc
// 				);
// 				$db->insert('CASINOIPBLACKLIST',$data);				
			}else if($type == '2'){
// 				$data = array(
// 						'usermac'=>$content,
// 						'describecontent'=>$desc
// 				);
// 				$db->insert('CASINOMACBLACKLIST',$data);
			}else if ($type == '3') {
        		$data = array(
        			'userid'=>intval($content),
        			'describecontent'=>$desc
        		);
        		
        		$db->insert('CASINOUSERIDBLACKLIST',$data);
			}
		}
        return $rsp->returncode() === EnumResult::enumResultSucc;

    } 

    public function del_blacklist($type, $rid) {
        if ($type == '1') {
            $command = 80031;
            $query = new deleteIPBlackListReq();
            $query->set_userip($rid);
            $rsp = new deleteIPBlackListRsp();
        } elseif ($type == '2') {
            $command = 80035;
            $query = new deleteMACBlackListReq();
            $query->set_usermac($rid);
            $rsp = new deleteMACBlackListRsp();
        } elseif ($type == '3') {
            $command = 80033;
            $query = new deleteUserIDBlackListReq();
            $query->set_userID($rid);
            $rsp = new deleteUserIDBlackListRsp();
        }

        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, $command);

        $rsp->ParseFromString($ret);
        
        if ($rsp->returncode () == 0) {
        	$CI = &get_instance ();
        	$db = $CI->load->database ( 'us3', true );
        	if($type == '1'){
//         		$db->where('userip',$rid);
//         		$db->delete('CASINOIPBLACKLIST');
        	}else if($type == '2'){
//         		$db->where('usermac',$rid);
//         		$db->delete('CASINOMACBLACKLIST');
        	}else if ($type == '3') {	       		
        		$db->where('userid',$rid);
        		$db->delete('CASINOUSERIDBLACKLIST');
        	}
        }

        return $rsp->returncode() == EnumResult::enumResultSucc;


    } 
    
      public function  get_robot_lastday($id){
          
        $CI = &get_instance();
      
        $db = $CI->load->database('globalinfo', true);

        $sql =  "select sum(winscorelastday) as cc from CASINOROBOTWINSCORELASTDAY where userid = '$id' ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count($ret) == 0) {return 0;}
        
        return  $ret[0]["cc"]+0;   
   }
   
      public function  get_game_statusx($id){
       
        $tmp = $id & 0x00000000000000FF;
        //echo 'tmp='.$tmp.'---';
  
        $dbx = ($tmp & 0xF0) >> 4;
       // echo 'dbx='.$dbx.'---';

        $posx = $tmp & 0x0F ;  
        //echo 'posx='.$posx.'---';

        $server = "eus".$dbx;
       	//eus13
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERGAMEINFO_$posx";

        $sql =  "select * from $databases where userid = $id ";
    
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        $versionstatus  =  $this->get_user_versionstatus($id);
        $firstplaystatus = $this->get_user_firstplaystatus($id);
        
         
        foreach ($versionstatus as $key => $value) {
            $sskey = $value["gamecode"];
            $ssvalue = $value["newestversion"];
            $itemxx[$sskey] = $ssvalue;
        }
        
        foreach ( $firstplaystatus as $key => $value) {
             $sskey = $value["gametype"];
            $ssvalue = $value["firstgametime"];
             $itemyy[$sskey] = $ssvalue;
         }
        
         foreach ($ret as $key => $value) {
            $gametype = $ret[$key]["gametype"];
            if($itemxx[$gametype] == null){
                $ret[$key]["newestversion"] = 0;
            }else{
                $ret[$key]["newestversion"] = $itemxx[$gametype];  
            }
            
            if($itemyy[$gametype] == null){
                $ret[$key]["firstgametime"] = 0;
            }else{
                 $ret[$key]["firstgametime"] = $itemyy[$gametype];
            }
           
         }
        
       // $ret["versionstatus"] = $versionstatus ;
        
       // $ret["firstplaystatus"] = $firstplaystatus  ;
        
        return $ret;
   }
    
   public function  get_game_statusy($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
         $server = "eus".$dbx;
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_statusyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["signcardcount"] = 0;
            $rty[0]["notecarddeviceeffectivetime"]= 0;
            $rty[0]["cofferchips"]= 0;
            $rty[0]["cofferpassword"]= 0;
            return $rty;
        }
   }
   
   
   public function  get_databases($id){
        $tmp = $id & 0x00000000000000FF;
        $dbx = ($tmp & 0xF0) >> 4;
        $server = "eus".$dbx;
        $posx = $tmp & 0x0F ;   
        $databases1 = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";
        
        $sql =  "select * from $databases1 where userid = $id ";
         
        $CI = &get_instance();
        $db = $CI->load->database($server, true);
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        $dbindex= $ret[0]["dbindex"];
        $tableindex= $ret[0]["tableindex"];
        
        $servercoff = "eus". $dbindex;
        
        $databasescoff = "CASINOUSERDB_$dbindex.CASINOUSERBAGGAGEINFO_$tableindex";
       
        $dbcoff = $CI->load->database($servercoff, true);
        
        return array("databases"=>$databases1,"databasescoff"=>$databasescoff,  "ip"=>$db->hostname , "ipcoff"=>$dbcoff->hostname );
       
   }
   
   
   public function  get_game_fish($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;
        
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_fishyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["signcardcount"] = 0;
            $rty[0]["notecarddeviceeffectivetime"]= 0;
            $rty[0]["cofferchips"]= 0;
            $rty[0]["cofferpassword"]= 0;
            return $rty;
        }
   }
   
   
    public function  get_game_fishyykkk($dbx1,$posx1,$id){
        $dbx = $dbx1;
        $posx = $posx1;
        
        $server = "eus".$dbx;
        /*
 
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
       // $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERFISHCONTROLINFO_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
        	$ret[0]['dailyshotcoun'] = $ret[0]['dailyshotcount'];
            return $ret;
         }else{
            $rty =  array();
            
            $rty[0]["periodwinscore"] = 0;
            $rty[0]["periodgamecount"] = 0;
            $rty[0]["dailywinscore"] = 0;
            $rty[0]["totalplayscore"] = 0;
            $rty[0]["totalwinscore"] = 0;
            $rty[0]["totalshotcount"] = 0;
            $rty[0]["dailyshotcoun"] = 0;
            $rty[0]["forcepool"] = 0;
            $rty[0]["rewardpool"] = 0;
            return $rty;
        }
   }
   
   public function  get_game_fishkkk($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;
        
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_fishyykkk($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["periodwinscore"] = 0;
            $rty[0]["periodgamecount"] = 0;
            $rty[0]["dailywinscore"] = 0;
            $rty[0]["totalplayscore"] = 0;
            $rty[0]["totalwinscore"] = 0;
            $rty[0]["totalshotcount"] = 0;
            $rty[0]["dailyshotcoun"] = 0;
            $rty[0]["forcepool"] = 0;
            $rty[0]["rewardpool"] = 0;
            return $rty;
        }
   }
   
   
   
   
   
  /*
   
   public function  get_game_fishkkkjjj($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERGAMEINFO_$posx";

        $sql =  "select * from $databases where userid = $id and gametype = 193";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            return  $ret;
         }else{
            $rty =  array();
            $rty[0]["lastgametime"] = 0;
            return $rty;
        }
   }
   * 
   * 
   */
   
   
   public function  get_game_fishyy($dbx1,$posx1,$id){
        $dbx = $dbx1;
        $posx = $posx1;
        
        $server = "eus".$dbx;
 
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
       // $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERFISHINFO_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            return $ret;
         }else{
            $rty =  array();
            $rty[0]["explevel"] = 0;
            $rty[0]["expvalue"]= 0;
            $rty[0]["money"]= 0;
            $rty[0]["secondmoney"]= $server;
            $rty[0]["gunindex"]= 0;
            return $rty;
        }
   }
   
   
   public function  get_game_fishtool($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;
        
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_fishtoolyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["skill1num"] = 0;
            $rty[0]["skill2num"]= 0;
            $rty[0]["skill3num"]= 0;
            return $rty;
        }
   }
   
   public function  get_game_fishtoolyy($dbx1,$posx1,$id){
       
        $dbx = $dbx1;
        $posx = $posx1;
        
        $server = "eus".$dbx;
 
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
       
       // $tmp = $id & 0x00000000000000FF;
  
      //  $dbx = ($tmp & 0xF0) >> 4;
       // $server = "us3";
        
       // if($dbx>7){
        //  $server = "us2";  
       // }
      //  $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERFISHSKILLINFO_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            //$dbx1 = $ret[0]["dbindex"];
            //$posx1  = $ret[0]["tableindex"];
           // return $this->get_game_statusyy($dbx1,$posx1,$id);
            return $ret;
         }else{
            $rty =  array();
            $rty[0]["skill1num"] = 0;
            $rty[0]["skill2num"]= 0;
            $rty[0]["skill3num"]= 0;
            return $rty;
        }
   }
   
   
   
   public function  get_game_vipy($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;
        
        /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_vipyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["fishlevel"] = 0;
            $rty[0]["fishexp"]= 0;
            $rty[0]["fishexpiredate"]= 0;
            $rty[0]["fishlastrewarddate"]= 0;
            return $rty;
        }
   }
   
   
   public function  get_game_vipyy($dbx1,$posx1,$id){
        $dbx = $dbx1;
        $posx = $posx1;
        
        $server = "eus".$dbx;
        
        /*
 
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
         * 
         */
       // $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

       // $databases = "CASINOUSERDB_$dbx.CASINOUSERFISHINFO_$posx";
        
        $databases = "CASINOUSERDB_$dbx.CASINOUSERVIP_$posx";

        $sql =  "select userid as fishuserid , level as fishlevel , exp as fishexp , expiredate as fishexpiredate ,lastrewarddate as fishlastrewarddate  from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            return $ret;
         }else{
            $rty =  array();
           $rty[0]["fishlevel"] = 0;
            $rty[0]["fishexp"]= 0;
            $rty[0]["fishexpiredate"]= 0;
            $rty[0]["fishlastrewarddate"]= 0;
            return $rty;
        }
   }
   
   /*
    public function  get_game_vipy($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

           $databases = "CASINOUSERDB_$dbx.CASINOUSERVIP_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        if(count( $ret)>0){
            //$dbx1 = $ret[0]["dbindex"];
            //$posx1  = $ret[0]["tableindex"];
           // return $this->get_game_statusyy($dbx1,$posx1,$id);
            return $ret;
         }else{
            $rty =  array();
            $rty[0]["level"] = 0;
            $rty[0]["exp"]= 0;
            $rty[0]["expiredate"]= 0;
            $rty[0]["lastrewarddate"]= 0;
            return $rty;
        }
   }
   */
   
      public function  get_user_versionstatus($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        $server = "globalinfo";
        
        if($dbx>7){
          $server = "globalinfo1";  
        }
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERLOGININFO_$posx";

        $sql =  "select gamecode , newestversion from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        return $ret;
        
        /*
        
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_statusyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["signcardcount"] = 0;
            $rty[0]["notecarddeviceeffectivetime"]= 0;
            $rty[0]["cofferchips"]= 0;
            $rty[0]["cofferpassword"]= 0;
            return $rty;
        }
         * 
         */
   }
   
   
      
      public function  get_user_firstplaystatus($id){
       
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        $server = "globalinfo";
        
        if($dbx>7){
          $server = "globalinfo1";  
        }
        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSERGAMEINFO_$posx";

        $sql =  "select gametype , firstgametime from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
        return $ret;
        
        /*
        if(count( $ret)>0){
            $dbx1 = $ret[0]["dbindex"];
            $posx1  = $ret[0]["tableindex"];
            return $this->get_game_statusyy($dbx1,$posx1,$id);
         }else{
            $rty =  array();
            $rty[0]["signcardcount"] = 0;
            $rty[0]["notecarddeviceeffectivetime"]= 0;
            $rty[0]["cofferchips"]= 0;
            $rty[0]["cofferpassword"]= 0;
            return $rty;
        }
         * 
         */
   }
   
   
   
    public function  get_game_statusyy($dbx1,$posx1,$id){
        
        $server = "eus".$dbx1;
        
        /*
        $server = "us3";
        
        if($dbx1>7){
          $server = "us2";  
        }
         * 
         */
       
        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);

        $databases1 = "CASINOUSERDB_$dbx1.CASINOUSERBAGGAGEINFO_$posx1";

        $sql1 =  "select * from $databases1 where userid = $id ";
 
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 

        return  $ret1;   
   }
   
   
   public function get_index($id){
        $tmp = $id & 0x00000000000000FF;
  
        $dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;

        $posx = $tmp & 0x0F ;   
       
        $CI = &get_instance();
      
        $db = $CI->load->database( $server, true);

        $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";

        $sql =  "select * from $databases where userid = $id ";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
        
   
        $dbx1 = $ret[0]["dbindex"];
        $posx1  = $ret[0]["tableindex"];
        
        return array("dbx"=>$dbx1,"pos"=>$posx1 );
       
   }
    
   public function  get_block_statusx($ip,$id,$mac,$alipay_account,$alipay_real_name ){
       
        $CI = &get_instance();
        $db_black = $CI->load->database('black', true);
   
        $sql1 =  "select * from CASINOIPBLACKLIST where userip = '$ip'";
        $sql2 =  "select * from CASINOMACBLACKLIST where usermac = '$mac' ";
        
        $query1 =  $db_black->query($sql1);
        $ret1 = $this->_dealwith_ret($query1);
        
        $query2 =  $db_black->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);
        
        $ttt =$this->get_index($id);

        $dbx1 = $ttt["dbx"];
        $posx1  = $ttt["pos"];
            
        $sql3 =  "select * from CASINOUSERDB_$dbx1.CASINOBLACKUSER_$posx1 where userid = $id ";
        
       // $sql3 =  "select * from CASINOUSERIDBLACKLIST where userid = $id ";
        $db = $CI->load->database("eus". $dbx1, true);
        
        $query3 =  $db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3); 

        $count4 = $this->getBlackAlipayAccountInfo($alipay_account,$alipay_real_name);
        $count5 = $this->paylimit_model->getDataNum($id, null, null, null, null);
        return array("m1"=>count($ret1),"m2"=>count($ret2),"m3"=>count($ret3),"m4"=>$count4,"m5"=>$count5);   
   }
   
   public function getBlackAlipayAccountInfo($alipay_account,$alipay_real_name){
   		$this->load->model ( 'no3/Order_model' );
   		$num = $this->Order_model->getBlackRecNum($alipay_account, $alipay_real_name);
   		return $num;
   }
   
    public function score_operation($uid, $chip) {
      //  $this->_require('pb_proto_clientgameserver');
      
    	$CI = &get_instance();
    	$db_smc = $CI->load->database('default', true);
    	
    	$data = array(
    			'admin_id'=>$this->session->userdata ( 'id' ),
    			'user_id' => $uid,
    			'add_time' =>time(),
    			'action' => '充值'.$chip.'金币',
    			'chips' => $chip
    		);
    	$db_smc->insert('smc_admin_log',$data);
    	$db_smc->close();

        $scoreoper = new GameServerMiddleLayerServerScoreOperation();
        $scoreoper->set_userID($uid);
        $scoreoper->set_score($chip);
        $scoreoper->set_gameCode('999999');
        $scoreoper->set_addtype(19);
        
        $buf = $scoreoper->SerializeToString();

       $ret = $this->_request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);

        $rsp = new GameServerMiddleLayerServerScoreOperationRsp();
        $rsp->ParseFromString($ret);
		
        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    public function score_operation_by_cash($uid, $chip) {
    	//  $this->_require('pb_proto_clientgameserver');
    	$scoreoper = new GameServerMiddleLayerServerScoreOperation();
    	$scoreoper->set_userID($uid);
    	$scoreoper->set_score($chip);
    	$scoreoper->set_gameCode('999992');
    	$scoreoper->set_addtype(19);
    
    	$buf = $scoreoper->SerializeToString();
    
    	$ret = $this->_request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);
    
    	$rsp = new GameServerMiddleLayerServerScoreOperationRsp();
    	$rsp->ParseFromString($ret);
    
    	return $rsp->returncode() == EnumResult::enumResultSucc;
    }

	public function score_operation_by_kefu_recharge($uid, $chip) {
    	//  $this->_require('pb_proto_clientgameserver');
    
    	$scoreoper = new GameServerMiddleLayerServerScoreOperation();
    	$scoreoper->set_userID($uid);
    	$scoreoper->set_score($chip);
    	$scoreoper->set_gameCode('999994');
    	$scoreoper->set_addtype(EnumAddScoreType::enumAddScoreType_BackgroundAdd);
    
    	$buf = $scoreoper->SerializeToString();
    
    	$ret = $this->_request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);
    
    	$rsp = new GameServerMiddleLayerServerScoreOperationRsp();
    	$rsp->ParseFromString($ret);
    
    	return $rsp->returncode() === EnumResult::enumResultSucc ;
    }
    
   	public function score_operation_by_recharge($uid, $chip) {
      //  $this->_require('pb_proto_clientgameserver');

        $scoreoper = new GameServerMiddleLayerServerScoreOperation();
        $scoreoper->set_userID($uid);
        $scoreoper->set_score($chip);
        $scoreoper->set_gameCode('999990');
        $scoreoper->set_addtype(EnumAddScoreType::enumAddScoreType_BackgroundAdd);
        
        $buf = $scoreoper->SerializeToString();

       	$ret = $this->_request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);
		
        $rsp = new GameServerMiddleLayerServerScoreOperationRsp();
        $rsp->ParseFromString($ret);
        
        return $rsp->returncode() == EnumResult::enumResultSucc ? true : false;
    }
    
    public function score_operation_by_agent($uid, $chip,$agent_id) {
    	//  $this->_require('pb_proto_clientgameserver');
    	$scoreoper = new GameServerMiddleLayerServerScoreOperation();
    	$scoreoper->set_userID($uid);
    	$scoreoper->set_score($chip);
    	$scoreoper->set_gameCode('999999');
    	//echo 'agent_id:'.$agent_id;
    	$scoreoper->set_channelid($agent_id);
    	//exit('455');
    	//$scoreoper->set_addtype(7);
    	$scoreoper->set_addtype(EnumAddScoreType::enumAddScoreType_Channel);
    
    	$buf = $scoreoper->SerializeToString();
    
    	$ret = $this->_request_midlayer_res1($buf,60002, DISPATCH_SERVER_IP, DISPATCH_SERVER_PORT);
    
    	$rsp = new GameServerMiddleLayerServerScoreOperationRsp();
    	$rsp->ParseFromString($ret);

    	return $rsp->returncode() == EnumResult::enumResultSucc;
    }
   
   public function update_basic_userinfo($uid, $k, $v) {
 
       $listkv["nickname"] = 1;
       $listkv["password"] = 15;
       $listkv["speaker"] =16;
       $listkv["coupon"] =9;
       $listkv["vip_level"] =5;
       $listkv["user_chips"] =1;
       $listkv["fishWeaponCurLevel"] =11;
       $listkv["user_avatar_url"] =4;
       
       if($k == "newlevel")
       {
            $url = "http://".SOCKET_SERVER_IP.":6001/smc?command=80021";
            $post_data = array("UserID"=>$uid,"Type"=>4,"Num"=>$v,);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
            $output = curl_exec($ch);
            curl_close($ch);
            $output = json_decode($output);
            return $output;
       }
       
       if($k == "coupon")
       {
          $this->usernew_mid_model->adduseruser($uid, $v, "1","23","1","1","-1","","");
          return 1;
       }
       
       if($k == "user_chips")
       {
          	if($this->score_operation($uid, $v)){
          		echo 'yes';
          	}else{
          		echo 'no';
          	}
       		//echo $this->score_operation_by_agent($uid, $v, 1);
          	return 1;
       }
       
       // [170313] 修改胜利失败次数
       if ($k == "win_game" || $k == "lose_game" || $k == "draw_game")
       {
       		//直接修改数据库
       		$tmp = $uid & 0x00000000000000FF;
       		$dbx = ($tmp & 0xF0) >> 4;
       		$server = 'eus' . $dbx;
       		$posx = $tmp & 0x0F;
       		$db = $this->load->database ( $server, true );
       		$db->select ( 'dbindex,tableindex' );
       		$db->from ( 'CASINOUSER2ACCOUNT_' . $posx );
       		$db->where ( 'userid', $uid );
       		$db->limit ( 1 );
       		$query = $db->get ();
       		$db->close ();
       		$user_db_index = $query->row_array ();
       		if (empty ( $user_db_index )) {
       			return false;
       		}
       		
       		$db1 = $this->load->database ( 'eus'.$user_db_index['dbindex'], true );
       		$data = array($k=>$v);
       		$db1->where ( 'id', $uid );
       		$res = $db1->update ( 'CASINOUSER_'.$user_db_index['tableindex'], $data );
       		$db1->close();
       		return true;
       }
      	
       if($k == "alipay_account" || $k == "alipay_real_name" ){
       		$db = $this->load->database ( 'default', true );
       		$db->where ( 'user_id', $uid );
       		$db->from('smc_user');
       		$db->limit(1);
       		$q = $db->get();
       		if($q->num_rows() > 0){
       			$data = array($k=>$v);
       			$db->where ( 'user_id', $uid );
       			$res = $db->update ( 'smc_user', $data );
       			$db->close();
       		}else{
       			$data = array(
       				'user_id'=>$uid,
       				$k=> trim($v)
       			);
       			if($k == 'alipay_account'){
       				$data['alipay_real_name'] = '';
       			}else{
       				$data['alipay_account'] = '';
       			}
       			
       			$res = $db->insert ( 'smc_user', $data );    
       			$db->close();
       		}
       		if($k == 'alipay_account')
       		{
       			$this->load->model ( 'no3/bindaliaccountlog_model' );
       			$this->bindaliaccountlog_model->saveBindAliLog($uid,$v);
       		}
       		$tmp = $uid & 0x00000000000000FF;
       		$dbx = ($tmp & 0xF0) >> 4;
       		$server = 'eus' . $dbx;
       		$posx = $tmp & 0x0F;
       		$db = $this->load->database ( $server, true );
       		$db->select ( 'dbindex,tableindex' );
       		$db->from ( 'CASINOUSER2ACCOUNT_' . $posx );
       		$db->where ( 'userid', $uid );
       		$db->limit ( 1 );
       		$query = $db->get ();
       		$db->close ();
       		$user_db_index = $query->row_array ();
       		if (empty ( $user_db_index )) {
       			return false;
       		}
       		
       		$db1 = $this->load->database ( 'eus'.$user_db_index['dbindex'], true );
       		$data = array($k=>$v);
       		$db1->where ( 'id', $uid );
       		$res = $db1->update ( 'CASINOUSER_'.$user_db_index['tableindex'], $data );
       		$db1->close();
       		
       		
       		return $res;
       }
       
       if($k == 'boundmobilenumber'){
	       	$tmp = $uid & 0x00000000000000FF;
	       	$dbx = ($tmp & 0xF0) >> 4;
	       	$server = 'eus' . $dbx;
	       	$posx = $tmp & 0x0F;
	       	$db = $this->load->database ( $server, true );
	       	$db->select ( 'dbindex,tableindex' );
	       	$db->from ( 'CASINOUSER2ACCOUNT_' . $posx );
	       	$db->where ( 'userid', $uid );
	       	$db->limit ( 1 );
	       	$query = $db->get ();
	       	$db->close ();
	       	$user_db_index = $query->row_array ();
	       	if (empty ( $user_db_index )) {
	       		return false;
	       	}
	       	 
	       	$db1 = $this->load->database ( 'eus'.$user_db_index['dbindex'], true );
	       	$data = array($k=>$v);
	       	$db1->where ( 'id', $uid );
	       	$res = $db1->update ( 'CASINOUSER_'.$user_db_index['tableindex'], $data );
	       	$db1->close();
	       	 
	       	 
	       	return $res;
       }
       
        $pair = new PairIntString();
        $pair->set_fieldName( $listkv[$k]);
        $pair->set_fieldValue($v);

        $query = new GameServerModifyUserInfoRequest();
        $query->set_userid($uid);
        $query->set_kv(0, $pair);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res1($buf,80102, DDZ_SERVER_IP, DDZ_SERVER_PORT);
        $rsp = new GameServerModifyUserInfoResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;

    }

    public function   save_bat_hisx($action,$items,$value ,$discrible ){
         switch ($action) {
            case "addjindu":
                 foreach ($items as $key => $v) {
                  $this->score_operation($v["id"], $value);
                }
                 break;
            case "addcoupou":
                  foreach ($items as $key => $v) {
                   $this->usernew_mid_model->adduseruser($v["id"], $value, "1","-1","-1","-1","-1","","");
                }
                 break;
                 
           case "modifynickname":
                  foreach ($items as $key => $v) {
                     $this->update_basic_userinfo($v["id"],"nickname", $value);
                }
                 break;
       
            default:
                echo "No number between 1 and 3";
        }
        
    }    
    
    
    
   public function update_fish($id, $field, $value,$dbx,$posx) {

       /*
        $server = "us3";
        
        if($dbx>7){
          $server = "us2";  
        }
        * 
        */
       
        $server = "mus".$dbx;

        $CI = &get_instance();
      
        $db = $CI->load->database($server, true);
        
        $databases = "CASINOUSERDB_$dbx.CASINOUSERBAGGAGEINFO_$posx";

         if($field == "secondmoney"){
            $databases = "CASINOUSERDB_$dbx.CASINOUSERFISHINFO_$posx"; 
         }
      
        $sql =  "UPDATE $databases SET $field = $value WHERE userid = $id";
        
        $query =  $db->query($sql);
        $ret = $this->_dealwith_ret($query); 
 
        return $ret;
    }
    
    
    
    public function save_detail_hisx($action, $userid, $help, $value,$discrible, $admin_name ) {
        switch ($action) {
            case "fongzhanghao":
               if($value=="0") {$this->add_blacklist(3, $userid,$discrible);}
               if($value=="1") {$this->del_blacklist(3, $userid);}
                break;
            case "fongip":
               if($value=="0") {$this->add_blacklist(1, $userid,$discrible);}
               if($value=="1") {$this->del_blacklist(1, $userid);}
                break;
            case "fongmac":
               if($value=="0") {$this->add_blacklist(2, $userid,$discrible);}
               if($value=="1") {$this->del_blacklist(2, $userid);}
                break;
            case "modifyfield":
            	$redis_config = $this->config->item ( 'redis' );
            	$redis = new Redis ();
            	$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
            	$redis->del ( 'user' . $userid. '_pass' );
            	$redis->close();
                $this->update_basic_userinfo($userid, $help, $value);
                 break;
            case "ticketout" :
               //  $this->kickuser($userid);
                 $this->kickuser($help);
                 break;
            case "limitpay" :
            	if($value=="0") {
            		$data = array (
            				'limit_target' => $userid,
            				'discribe' => $discrible,
            				'add_time' => date ( 'Y-m-d H:i:s', time()),
            				'optuser' => $admin_name
            		);
            		$this->paylimit_model->addPayLimit($data);
            	}
            	if($value=="1") {
            		$this->paylimit_model->delPaylimit($userid);
            	}
                 break;
            case "modifyfish":
                 $id = $userid;
                 $tmp = $id & 0x00000000000000FF;
                 $dbx = ($tmp & 0xF0) >> 4;
                 
                 $server = "mus".$dbx;
                 
                 /*
                 $server = "us3";
                 if($dbx>7){
                    $server = "us2";  
                 }*/
                 $posx = $tmp & 0x0F ;   
                 $CI = &get_instance();
                 $db = $CI->load->database($server, true);
                 $databases = "CASINOUSERDB_$dbx.CASINOUSER2ACCOUNT_$posx";
                // echo $databases;
                 $sql =  "select * from $databases where userid = $id ";
                 $query =  $db->query($sql);
                 $ret = $this->_dealwith_ret($query); 
                 if(count( $ret)>0){
                      $dbx1 = $ret[0]["dbindex"];
                      $posx1  = $ret[0]["tableindex"];
                       $this->update_fish($userid, $help, $value, $dbx1,$posx1);
                 }else{
                      echo "Error Data ID";
                      return $rty;
                }
                break;
            default:
                echo "No number between 1 and 3";
        }
    }
    
    public function array_sort($arr,$keys,$type='asc'){ 
	$keysvalue = $new_array = array();
	foreach ($arr as $k=>$v){
		$keysvalue[$k] = $v[$keys];
	}
	if($type == 'asc'){
		asort($keysvalue);
	}else{
		arsort($keysvalue);
	}
	reset($keysvalue);
	foreach ($keysvalue as $k=>$v){
		$new_array[$k] = $arr[$k];
	}
	return $new_array; 
} 


public function get_all_data_jindu() {
    $where ="";
        $sql16_0 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_0.CASINOUSER_15 $where)
     ) as tt  order by user_chips desc limit 100;";

        $sql16_1 = "select id,user_chips from (              
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_1.CASINOUSER_15 $where) 
    ) as tt order by user_chips desc limit 100;";


        $sql16_2 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_2.CASINOUSER_15 $where) 
     ) as tt order by user_chips desc limit 100;";

        $sql16_3 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_3.CASINOUSER_15 $where) 
        ) as tt order by user_chips desc limit 100;";


        $sql16_4 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_4.CASINOUSER_15 $where) 
         ) as tt order by user_chips desc limit 100;";

        $sql16_5 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_5.CASINOUSER_15 $where) 
      ) as tt order by user_chips desc limit 100;";

        $sql16_6 = "select id,user_chips from (  
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_6.CASINOUSER_15 $where) 
         ) as tt order by user_chips desc limit 100;";

        $sql16_7 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_7.CASINOUSER_15 $where) 
) as tt order by user_chips desc limit 100;";

        $sql16_8 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_8.CASINOUSER_15 $where) 
         ) as tt order by user_chips desc limit 100;";

        $sql16_9 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_9.CASINOUSER_15 $where)
    ) as tt order by user_chips desc limit 100;";

        $sql16_10 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_10.CASINOUSER_15 $where)
         ) as tt order by user_chips desc limit 100;";

        $sql16_11 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_11.CASINOUSER_15 $where)
     ) as tt order by user_chips desc limit 100;";

        $sql16_12 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_12.CASINOUSER_15 $where)
         ) as tt order by user_chips desc limit 100;";

        $sql16_13 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_13.CASINOUSER_15 $where) 
      ) as tt order by user_chips desc limit 100;";

        $sql16_14 = "select id,user_chips from (
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_14.CASINOUSER_15 $where) 
         ) as tt order by user_chips desc limit 100;";

        $sql16_15 = "select id,user_chips from ( 
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_0 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_1 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_2 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_3 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_4 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_5 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_6 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_7 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_8 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_9 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_10 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_11 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_12 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_13 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_14 $where) union all
(select id,user_chips from CASINOUSERDB_15.CASINOUSER_15 $where) 
) as tt order by user_chips desc limit 100;";


  

        $CI0 = &get_instance();
        $db0 = $CI0->load->database('eus0', true);

        $query0 = $db0->query($sql16_0);
        $ret0 = $this->_dealwith_ret($query0);
  

  

        $CI1 = &get_instance();
        $db1 = $CI1->load->database('eus1', true);

        $query1 = $db1->query($sql16_1);
        $ret1 = $this->_dealwith_ret($query1);
    


        $CI2 = &get_instance();
        $db2 = $CI2->load->database('eus2', true);

        $query2 = $db2->query($sql16_2);
        $ret2 = $this->_dealwith_ret($query2);


     

        $CI3 = &get_instance();
        $db3 = $CI3->load->database('eus3', true);

        $query3 = $db3->query($sql16_3);
        $ret3 = $this->_dealwith_ret($query3);
   


        $CI4 = &get_instance();
        $db4 = $CI4->load->database('eus4', true);

        $query4 = $db4->query($sql16_4);
        $ret4 = $this->_dealwith_ret($query4);



        $CI5 = &get_instance();
        $db5 = $CI5->load->database('eus5', true);

        $query5 = $db5->query($sql16_5);
        $ret5 = $this->_dealwith_ret($query5);


        $CI6 = &get_instance();
        $db6 = $CI6->load->database('eus6', true);

        $query6 = $db6->query($sql16_6);
        $ret6 = $this->_dealwith_ret($query6);


        $CI7 = &get_instance();
        $db7 = $CI7->load->database('eus7', true);

        $query7 = $db7->query($sql16_7);
        $ret7 = $this->_dealwith_ret($query7);

        $CI8 = &get_instance();
        $db8 = $CI8->load->database('eus8', true);

        $query8 = $db8->query($sql16_8);
        $ret8 = $this->_dealwith_ret($query8);

        $CI9 = &get_instance();
        $db9 = $CI9->load->database('eus9', true);

        $query9 = $db9->query($sql16_9);
        $ret9 = $this->_dealwith_ret($query9);

        $CI10 = &get_instance();
        $db10 = $CI10->load->database('eus10', true);

        $query10 = $db10->query($sql16_10);
        $ret10 = $this->_dealwith_ret($query10);


        $CI11 = &get_instance();
        $db11 = $CI11->load->database('eus11', true);

        $query11 = $db11->query($sql16_11);
        $ret11 = $this->_dealwith_ret($query11);

        $CI12 = &get_instance();
        $db12 =$CI12->load->database('eus12', true);

        $query12 = $db12->query($sql16_12);
        $ret12 = $this->_dealwith_ret($query12);

        $CI13 = &get_instance();
        $db13 = $CI13->load->database('eus13', true);

        $query13 = $db13->query($sql16_13);
        $ret13 = $this->_dealwith_ret($query13);



        $CI14 = &get_instance();
        $db14 = $CI14->load->database('eus14', true);

        $query14 = $db14->query($sql16_14);
        $ret14 = $this->_dealwith_ret($query14);



        $CI15 = &get_instance();
        $db15 = $CI15->load->database('eus15', true);

        $query15 = $db15->query($sql16_15);
        $ret15 = $this->_dealwith_ret($query15);

       $rrx = array_merge_recursive($ret0, $ret1, $ret2, $ret3, $ret4, $ret5, $ret6, $ret7, $ret8, $ret9, $ret10, $ret11, $ret12, $ret13, $ret14, $ret15);
        
        return $rrx ;

        
         
        
        /*
        $rry = $this->array_sort($rrx, "id");
        $rrz = array();
        foreach ($rry as $key => $value) {

            $fishkkk = $this->get_game_fishkkk($value["id"]);

            $fish = $this->get_game_fish($value["id"]);

            $fishtool = $this->get_game_fishtool($value["id"]);

            $rty = $this->get_game_statusy($value["id"]);

            $rty1 = $this->get_game_vipy($value["id"]);
        }
         * 
         */
    }

public function get_all_data_coffee() {
    $where ="";
        $sql16_0 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_0.CASINOUSERBAGGAGEINFO_15 $where)
     ) as tt  order by cofferchips desc limit 100;";

        $sql16_1 = "select userid,cofferchips from (              
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_1.CASINOUSERBAGGAGEINFO_15 $where) 
    ) as tt order by cofferchips desc limit 100;";


        $sql16_2 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_2.CASINOUSERBAGGAGEINFO_15 $where) 
     ) as tt order by cofferchips desc limit 100;";

        $sql16_3 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_3.CASINOUSERBAGGAGEINFO_15 $where) 
        ) as tt order by cofferchips desc limit 100;";


        $sql16_4 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_4.CASINOUSERBAGGAGEINFO_15 $where) 
         ) as tt order by cofferchips desc limit 100;";

        $sql16_5 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_5.CASINOUSERBAGGAGEINFO_15 $where) 
      ) as tt order by cofferchips desc limit 100;";

        $sql16_6 = "select userid,cofferchips from (  
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_6.CASINOUSERBAGGAGEINFO_15 $where) 
         ) as tt order by cofferchips desc limit 100;";

        $sql16_7 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_7.CASINOUSERBAGGAGEINFO_15 $where) 
) as tt order by cofferchips desc limit 100;";

        $sql16_8 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_8.CASINOUSERBAGGAGEINFO_15 $where) 
         ) as tt order by cofferchips desc limit 100;";

        $sql16_9 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_9.CASINOUSERBAGGAGEINFO_15 $where)
    ) as tt order by cofferchips desc limit 100;";

        $sql16_10 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_10.CASINOUSERBAGGAGEINFO_15 $where)
         ) as tt order by cofferchips desc limit 100;";

        $sql16_11 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_11.CASINOUSERBAGGAGEINFO_15 $where)
     ) as tt order by cofferchips desc limit 100;";

        $sql16_12 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_12.CASINOUSERBAGGAGEINFO_15 $where)
         ) as tt order by cofferchips desc limit 100;";

        $sql16_13 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_13.CASINOUSERBAGGAGEINFO_15 $where) 
      ) as tt order by cofferchips desc limit 100;";

        $sql16_14 = "select userid,cofferchips from (
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_14.CASINOUSERBAGGAGEINFO_15 $where) 
         ) as tt order by cofferchips desc limit 100;";

        $sql16_15 = "select userid,cofferchips from ( 
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_0 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_1 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_2 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_3 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_4 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_5 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_6 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_7 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_8 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_9 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_10 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_11 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_12 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_13 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_14 $where) union all
(select userid,cofferchips from CASINOUSERDB_15.CASINOUSERBAGGAGEINFO_15 $where) 
) as tt order by cofferchips desc limit 100;";


  

        $CI0 = &get_instance();
        $db0 = $CI0->load->database('eus0', true);

        $query0 = $db0->query($sql16_0);
        $ret0 = $this->_dealwith_ret($query0);
  

  

        $CI1 = &get_instance();
        $db1 = $CI1->load->database('eus1', true);

        $query1 = $db1->query($sql16_1);
        $ret1 = $this->_dealwith_ret($query1);
    


        $CI2 = &get_instance();
        $db2 = $CI2->load->database('eus2', true);

        $query2 = $db2->query($sql16_2);
        $ret2 = $this->_dealwith_ret($query2);


     

        $CI3 = &get_instance();
        $db3 = $CI3->load->database('eus3', true);

        $query3 = $db3->query($sql16_3);
        $ret3 = $this->_dealwith_ret($query3);
   


        $CI4 = &get_instance();
        $db4 = $CI4->load->database('eus4', true);

        $query4 = $db4->query($sql16_4);
        $ret4 = $this->_dealwith_ret($query4);



        $CI5 = &get_instance();
        $db5 = $CI5->load->database('eus5', true);

        $query5 = $db5->query($sql16_5);
        $ret5 = $this->_dealwith_ret($query5);


        $CI6 = &get_instance();
        $db6 = $CI6->load->database('eus6', true);

        $query6 = $db6->query($sql16_6);
        $ret6 = $this->_dealwith_ret($query6);


        $CI7 = &get_instance();
        $db7 = $CI7->load->database('eus7', true);

        $query7 = $db7->query($sql16_7);
        $ret7 = $this->_dealwith_ret($query7);

        $CI8 = &get_instance();
        $db8 = $CI8->load->database('eus8', true);

        $query8 = $db8->query($sql16_8);
        $ret8 = $this->_dealwith_ret($query8);

        $CI9 = &get_instance();
        $db9 = $CI9->load->database('eus9', true);

        $query9 = $db9->query($sql16_9);
        $ret9 = $this->_dealwith_ret($query9);

        $CI10 = &get_instance();
        $db10 = $CI10->load->database('eus10', true);

        $query10 = $db10->query($sql16_10);
        $ret10 = $this->_dealwith_ret($query10);


        $CI11 = &get_instance();
        $db11 = $CI11->load->database('eus11', true);

        $query11 = $db11->query($sql16_11);
        $ret11 = $this->_dealwith_ret($query11);

        $CI12 = &get_instance();
        $db12 =$CI12->load->database('eus12', true);

        $query12 = $db12->query($sql16_12);
        $ret12 = $this->_dealwith_ret($query12);

        $CI13 = &get_instance();
        $db13 = $CI13->load->database('eus13', true);

        $query13 = $db13->query($sql16_13);
        $ret13 = $this->_dealwith_ret($query13);



        $CI14 = &get_instance();
        $db14 = $CI14->load->database('eus14', true);

        $query14 = $db14->query($sql16_14);
        $ret14 = $this->_dealwith_ret($query14);



        $CI15 = &get_instance();
        $db15 = $CI15->load->database('eus15', true);

        $query15 = $db15->query($sql16_15);
        $ret15 = $this->_dealwith_ret($query15);

       $rrx = array_merge_recursive($ret0, $ret1, $ret2, $ret3, $ret4, $ret5, $ret6, $ret7, $ret8, $ret9, $ret10, $ret11, $ret12, $ret13, $ret14, $ret15);
        
   
        return $rrx ;

        
         
        
        /*
        $rry = $this->array_sort($rrx, "id");
        $rrz = array();
        foreach ($rry as $key => $value) {

            $fishkkk = $this->get_game_fishkkk($value["id"]);

            $fish = $this->get_game_fish($value["id"]);

            $fishtool = $this->get_game_fishtool($value["id"]);

            $rty = $this->get_game_statusy($value["id"]);

            $rty1 = $this->get_game_vipy($value["id"]);
        }
         * 
         */
    }
    
    
    public function get_all_data() {
      $cofee = $this->get_all_data_coffee(); 
      $jindu = $this->get_all_data_jindu(); 
      return array("cofee"=>$cofee,"jindu"=>$jindu);
    }
    
    public function writeLog($txt) {
    	$log_file = "/log/detail.log";
    	$handle = fopen ( $log_file, "a+" );
    	$str = fwrite ( $handle, $txt . "\n" );
    	fclose ( $handle );
    }

    public function  get_detail_hisx($userid,$accountid,$mac,$ip,$channel='',$alipay_account='', $alipay_name = '', $mobile='',$is_recharge='all') {
		$CI = &get_instance ();
		$db = $CI->load->database ( 'eus0_slave', true );
        
        $items = array();
        if(!empty($userid)){
          $items[] = "id = " . $db->escape($userid);
        }
        
          if(!empty($accountid)){
          $items[] = "user_email = " . $db->escape($accountid);
        }
        
		if(!empty($mac)){
			$items[] = "mac = " . $db->escape($mac);
		}
				
        if(!empty($ip)){
			$items[] = "ip = " . $db->escape($ip);
        }
        
        
        if(!empty($channel)){
			$items[] = "activate_device = " . $db->escape($channel);
        }
        
   	 	if(!empty($alipay_account)){
			$items[] = "alipay_account = " . $db->escape($alipay_account);
        }
        
   	 	if(!empty($alipay_name)){
			$items[] = "alipay_real_name = " . $db->escape($alipay_name);
        }
        
        if(!empty($mobile)){
			$items[] = "boundmobilenumber = " . $db->escape($mobile);
        }
        
        if($is_recharge != 'all'){
        	if($is_recharge == '1'){
        		$items[] = "total_total_money <> 0";
        	}else{
        		$items[] = "total_total_money = 0";
        	}
        }
        
        $where = implode(" and ",$items);
        //$this->writeLog($where);
        if(strlen($where) > 0 ) {$where = " where ".$where;}
        
/*
        $sql1 = "select * from (
(select * from CASINOUSERDB_0. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_15 $where) 
) as tt limit 10000;";

        $sql2 = "select * from (
(select * from CASINOUSERDB_8. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_15 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_15 $where) 
) as tt limit 10000;";
        
        */
        
        
                $sql16_0 = "select * from (
(select * from CASINOUSERDB_0. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_0. CASINOUSER_15 $where)
     ) as tt limit 10000;";
                
   $sql16_1 = "select * from (              
(select * from CASINOUSERDB_1. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_1. CASINOUSER_15 $where) 
    ) as tt limit 10000;";
    

  $sql16_2= "select * from (
(select * from CASINOUSERDB_2. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_2. CASINOUSER_15 $where) 
     ) as tt limit 10000;";
                
   $sql16_3 = "select * from ( 
(select * from CASINOUSERDB_3. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_3. CASINOUSER_15 $where) 
        ) as tt limit 10000;";
    

  $sql16_4 = "select * from (
(select * from CASINOUSERDB_4. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_4. CASINOUSER_15 $where) 
         ) as tt limit 10000;";
                
   $sql16_5 = "select * from ( 
(select * from CASINOUSERDB_5. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_5. CASINOUSER_15 $where) 
      ) as tt limit 10000;";
  
  $sql16_6 = "select * from (  
(select * from CASINOUSERDB_6. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_6. CASINOUSER_15 $where) 
         ) as tt limit 10000;";
                
   $sql16_7 = "select * from ( 
(select * from CASINOUSERDB_7. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_7. CASINOUSER_15 $where) 
) as tt limit 10000;";

        $sql16_8 = "select * from (
(select * from CASINOUSERDB_8. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_8. CASINOUSER_15 $where) 
         ) as tt limit 10000;";
                
   $sql16_9 = "select * from ( 
(select * from CASINOUSERDB_9. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_9. CASINOUSER_15 $where)
    ) as tt limit 10000;";
    
        $sql16_10 = "select * from (
(select * from CASINOUSERDB_10. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_10. CASINOUSER_15 $where)
         ) as tt limit 10000;";
                
   $sql16_11 = "select * from ( 
(select * from CASINOUSERDB_11. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_11. CASINOUSER_15 $where)
     ) as tt limit 10000;";
    
  $sql16_12 = "select * from (
(select * from CASINOUSERDB_12. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_12. CASINOUSER_15 $where)
         ) as tt limit 10000;";
                
   $sql16_13 = "select * from ( 
(select * from CASINOUSERDB_13. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_13. CASINOUSER_15 $where) 
      ) as tt limit 10000;";
    
  $sql16_14 = "select * from (
(select * from CASINOUSERDB_14. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_14. CASINOUSER_15 $where) 
         ) as tt limit 10000;";
                
   $sql16_15 = "select * from ( 
(select * from CASINOUSERDB_15. CASINOUSER_0 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_1 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_2 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_3 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_4 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_5 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_6 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_7 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_8 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_9 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_10 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_11 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_12 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_13 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_14 $where) union all
(select * from CASINOUSERDB_15. CASINOUSER_15 $where) 
) as tt limit 10000;";
        
       
  /*
        $CI1 = &get_instance();
        $db1 = $CI1->load->database('us1', true);
        
        $query1 = $db1->query($sql1);
        $ret1 = $this->_dealwith_ret($query1);
        
        
        $CI2 = &get_instance();
        $db2 = $CI2->load->database('us2', true);
        
        $query2 = $db2->query($sql2);
        $ret2 = $this->_dealwith_ret($query2);
   * 
   */

        $CI0 = &get_instance();
        $db0 = $CI0->load->database('eus0', true);
        
        $query0 = $db0->query($sql16_0);
        //exit($db0->last_query());
        $ret0 = $this->_dealwith_ret($query0);
        
    //    print_r($ret0);
        
  

        $CI1 = &get_instance();
        $db1 = $CI1->load->database('eus1', true);
        
        $query1 = $db1->query($sql16_1);
        $ret1 = $this->_dealwith_ret($query1);
     
        
        $CI2 = &get_instance();
        $db2 = $CI2->load->database('eus2', true);
        
        $query2 = $db2->query($sql16_2);
        $ret2 = $this->_dealwith_ret($query2);
        
    
        $CI3 = &get_instance();
        $db3 = $CI3->load->database('eus3', true);
        
        $query3 = $db3->query($sql16_3);
        $ret3 = $this->_dealwith_ret($query3);
        
 
        $CI4 = &get_instance();
        $db4 = $CI4->load->database('eus4', true);
        
        $query4 = $db4->query($sql16_4);
        $ret4 = $this->_dealwith_ret($query4);
        
        
        $CI5 = &get_instance();
        $db5 = $CI5->load->database('eus5', true);
        
        $query5 = $db5->query($sql16_5);
        $ret5 = $this->_dealwith_ret($query5);
        
     
        $CI6 = &get_instance();
        $db6 = $CI6->load->database('eus6', true);
        
        $query6 = $db6->query($sql16_6);
        $ret6 = $this->_dealwith_ret($query6);
        
    
        $CI7 = &get_instance();
        $db7 = $CI7->load->database('eus7', true);
        
        $query7 = $db7->query($sql16_7);
        $ret7 = $this->_dealwith_ret($query7);
        
  
        $CI8 = &get_instance();
        $db8 = $CI8->load->database('eus8', true);
        
        $query8 = $db8->query($sql16_8);
        $ret8 = $this->_dealwith_ret($query8);
        
        
        $CI9 = &get_instance();
        $db9 = $CI9->load->database('eus9', true);
        
        $query9 = $db9->query($sql16_9);
        $ret9 = $this->_dealwith_ret($query9);
     
        
        $CI10 = &get_instance();
        $db10 = $CI10->load->database('eus10', true);
        
        $query10 = $db10->query($sql16_10);
        $ret10 = $this->_dealwith_ret($query10);
        
    
        $CI11 = &get_instance();
        $db11 = $CI11->load->database('eus11', true);
        
        $query11 = $db11->query($sql16_11);
        $ret11 = $this->_dealwith_ret($query11);
        
 
        $CI12 = &get_instance();
        $db12 = $CI12->load->database('eus12', true);
        
        $query12 = $db12->query($sql16_12);
        $ret12 = $this->_dealwith_ret($query12);
        
        $CI13 = &get_instance();
        $db13= $CI13->load->database('eus13', true);
        
        $query13 = $db13->query($sql16_13);
        $ret13 = $this->_dealwith_ret($query13);
        
     
        $CI14 = &get_instance();
        $db14 = $CI14->load->database('eus14', true);
        
        $query14 = $db14->query($sql16_14);
        $ret14 = $this->_dealwith_ret($query14);
        
    
        $CI15 = &get_instance();
        $db15 = $CI15->load->database('eus15', true);
        
        $query15 = $db15->query($sql16_15);
        $ret15 = $this->_dealwith_ret($query15);
        
        $redis_config = $this->config->item ( 'redis' );
        $redis = new Redis ();
        $redis->connect ( $redis_config ['host'], $redis_config ['port'] );

     //    $rrx = array_merge_recursive($ret1, $ret2);
        $channellist = $this->config->item('channellist');
        $rrx = array_merge_recursive($ret0,$ret1, $ret2,$ret3,$ret4,$ret5,$ret6,$ret7,$ret8,$ret9, $ret10,$ret11,$ret12,$ret13,$ret14,$ret15);
        $rry =$this->array_sort($rrx,"id");
        $rrz = array();
        $db = $this->load->database ( 'default', true );
        $db_black = $this->load->database ( 'black', true );
            
        $this->load->model("api/User_model");
		foreach ( $rry as $key => $value ) {
              
			// $fishkkkyyy = $this->get_game_fishkkkjjj($value["id"]);
          
			$fishkkk = $this->get_game_fishkkk ( $value ["id"] );
            
			$fish = $this->get_game_fish ( $value ["id"] );
        
			$fishtool = $this->get_game_fishtool ( $value ["id"] );
            
			$rty = $this->get_game_statusy ( $value ["id"] );
			
			$rty1 = $this->get_game_vipy ( $value ["id"] );
			
			$value ["signcardcount"] = $rty [0] ["signcardcount"];
			if ($rty [0] ["notecarddeviceeffectivetime"] > 0) {
				$value ["notecarddeviceeffectivetime"] = (round ( (time () - $rty [0] ["notecarddeviceeffectivetime"]) / 3600 )) . "小时";
			} else {
				$value ["notecarddeviceeffectivetime"] = "0小时";
			}
        
        	// $value["lastgametime"] = $fishkkkjjj[0]["lastgametime"] ;
        	// 找到数据库位置
        	$user_db_index = $this->User_model->getUserDBPos($value['id']);
        	$value['dbIndex'] = $user_db_index['dbindex'];
        	$value['tableIndex'] = $user_db_index['tableindex'];
        
			$value ["periodwinscore"] = $fishkkk [0] ["periodwinscore"];
			$value ["periodgamecount"] = $fishkkk [0] ["periodgamecount"];
			$value ["dailywinscore"] = $fishkkk [0] ["dailywinscore"];
			$value ["totalplayscore"] = $fishkkk [0] ["totalplayscore"];
			$value ["totalwinscore"] = $fishkkk [0] ["totalwinscore"];
			$value ["totalshotcount"] = $fishkkk [0] ["totalshotcount"];
			$value ["dailyshotcoun"] = $fishkkk [0] ["dailyshotcoun"];
			$value ["forcepool"] = $fishkkk [0] ["forcepool"];
			$value ["rewardpool"] = $fishkkk [0] ["rewardpool"];
        
			$value ["explevel"] = $fish [0] ["explevel"];
			$value ["expvalue"] = $fish [0] ["expvalue"];
			$value ["money"] = $fish [0] ["money"];
			$value ["secondmoney"] = $fish [0] ["secondmoney"];
			$value ["gunindex"] = $fish [0] ["gunindex"];
        
			$value ["skill1num"] = $fishtool [0] ["skill1num"];
			$value ["skill2num"] = $fishtool [0] ["skill2num"];
			$value ["skill3num"] = $fishtool [0] ["skill3num"];
         
			$value ["cofferchips"] = $rty [0] ["cofferchips"];
        
			$value ["cofferpassword"] = $rty [0] ["cofferpassword"];
        
			$value ["silvertreasureboxcount"] = $rty [0] ["silvertreasureboxcount"];
                    
			$value ["goldentreasureboxcount"] = $rty [0] ["goldentreasureboxcount"];
                  
			$value ["newlevel"] = $rty1 [0] ["fishlevel"];
        
			$value ["exp"] = $rty1 [0] ["fishexp"];
        
			$tests = $rty1 [0] ["fishexpiredate"] - (time () / (24 * 60 * 60));
        
			if ($tests < 0)
				$tests = 0;
        
			$value ["expiredate"] = ceil ( $tests ) . "天";
        
			$value ["lastrewarddate"] = $rty1 [0] ["fishlastrewarddate"];
          
			if (! empty ( $userid )) {
				$value ["config"] = $this->get_databases ( $userid );
        }
        
        
        $db->where ( 'user_id', $value['id'] );
        $db->from('smc_user');
        $db->limit(1);
        $q = $db->get();
        if($q->num_rows() > 0){
        	$value['alipay_account'] = $q->row()->alipay_account;
        	$value['alipay_real_name'] = $q->row()->alipay_real_name;
        }else{
        	$value['alipay_account'] = '';
        	$value['alipay_real_name'] = '';
        }
        
        $value['channel_id'] = $value['channel_id']==0?"集集棋牌":$channellist[$value['channel_id']];
        $value['totalBuy'] = ($value['totalBuy'] / 100 ).'元';
        $value['total_total_money'] = ($value['total_total_money'] / 100 ).'元';
        $value['last_login_time'] = date('Y-m-d H:i:s',$value['last_login_time'] - 3600*8);
        
        if($redis->get('reported_' . $value['id']) == '1'){
        	$ttl = intval($redis->ttl('reported_' . $value['id']));
        	$value['is_reported'] = '是,剩余' . round($ttl/60) . '分钟';
        }else{
        	$value['is_reported'] = '否';
        }
        
        //黑名单信息
        $db_black->select('describecontent,opertime');
        $db_black->from('CASINOUSERIDBLACKLIST');
        $db_black->where('userid', $value['id']);
        $db_black->limit(1);
        $q_black = $db_black->get();
        if($q_black->num_rows() > 0){
        	$value['black_des'] = $q_black->row()->opertime.'被封，原因：'.$q_black->row()->describecontent;
        }else{
        	$value['black_des'] = '';
        }
        $this->writeLog(">>>uid=".$value['id'].",black=".$q_black->num_rows());
         $rrz[] =   $value;
        }
        $db->close();
        $db_black->close();
        $redis->close();
        
        return $rrz;
    }
    
    public function get_detail_his($userid, $mac) {

        $this->load->model('usernew_mid_model');

        if (!empty($userid_account)) {
            if (!is_numeric($userid_account)) {
                $ret = $this->usernew_mid_model->account2id1($userid_account);
                $userid = $ret['userid'];
            } else {
                $userid = $userid_account;
            }
        }

        if (empty($userid)) {
            echo js_alert('不存在这个账号，请检查输入账号是否正确。');
            return;
        }

        if (!empty($userid)) {
            $userinfo = $this->usernew_mid_model->query_user_info2($userid);
        }

        return array("usemsg" => $userinfo, "detail" => $ret, "account" => $account, "nickname" => $nickname, "status" => "0");
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
