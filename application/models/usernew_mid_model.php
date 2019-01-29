<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 
 */
class Usernew_mid_model extends MY_Model {

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        //$this->_require('pb_proto_clientgameserver');
        //$this->_require('pb_proto_SMCmiddlelayerserver');
        $this->_require('pb_proto_pbclientgameserver');
        $this->load->helper('other');
    }
    
    
      public function add_download_config($channelid, $channelname, $channeldiscrible, $gamename, $gameid, $downloadurl, $version,$versionstr,$size,$md5,$packagename, $updateversion, $updatetype, $updatecontent) {
        $this->_require('pb_proto_updatemessage');
        $query = new UpdateMessage_ModifyUpdateInfoRequest();
        $query->set_channelID($channelid);
        $query->set_gameID($gameid);
        $query->set_channelName($channelname);
        $query->set_channelDesc($channeldiscrible);
        $query->set_gameName($gamename);
        $query->set_downloadURL($downloadurl);
        $query->set_version($version);
        $query->set_versionStr($versionstr);
        $query->set_md5($md5);
        $query->set_packageName($packagename);
        $query->set_packageSize($size);
        $query->set_updateVersion($updateversion);
        $query->set_updateType($updatetype);
        $query->set_updateContent($updatecontent);
        $buf = $query->SerializeToString();
        // $ret = $this->_request_midlayer_res1($buf, 60139, "211.151.33.246", "10003");
       // $ret = $this->_request_midlayer_res1($buf, 80118, "27.115.62.98", "10003");
        $ret = $this->_request_midlayer_res($buf, 80118);
        
        $rsp = new UpdateMessage_ModifyUpdateInfoResponse();
        $rsp->ParseFromString($ret);
    }

    /**
     * 添加离线消息
     * @param number $fromid
     * @param number $toid
     * @param string $msg
     */
    public function add_offline_msg($fromid, $toid, $msg)
    {
        $query = new GameServerMiddleLayerAddOfflineMsg();
        $query->set_userIDFrom($fromid);
        $query->set_userIDTo($toid);
        $query->set_msg($msg);
        $buf = $query->SerializeToString();
        
        $ret = $this->_request_midlayer($buf, 60009);
    }
    

    /**
     * 添加vip card
     * @param string $uid
     * @param number $v
     */
    public function set_vipcode($uid, $v)
    {
        $param = new PairIntString();
        $param->set_fieldName(EnumUserInfoFieldName::enumUserInfoFieldNameVIPLevel);
        $param->set_fieldValue($v);

        $query = new GameServerModifyUserInfoRequest();
        $query->set_userid($uid);
        $query->set_kv(0, $param);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 20035);

        $rsp = new GameServerModifyUserInfoResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;
    }

    /*
     *  
     */
    
    public function query_user_info2($uid) {

        $query = new GameServerQueryUserInfoRequest();
        $query->set_userID($uid);
        $buf = $query->SerializeToString();

       // $retx = $this->_request_midlayer_res1($buf, 20031, "211.151.33.246", "9112");//_request_midlayer_res($buf, 20031);
        $retx = $this->_request_midlayer_res($buf, 20031);

        $userinfo = new GameServerQueryUserInfoResponse();
        $userinfo->ParseFromString($retx);
        
        $response_status = $userinfo->result();
 

        if ($userinfo->result() == EnumResult::enumResultFail) {
            return false;
        }
      
        $base   = $userinfo->basicUserInfo();
        $detail = $userinfo->detailUserInfo();
        
        $ip =$detail->ip();
        
        if (strlen($ip) > 0 && substr($ip, 0, 7) !== '192.168') {
               $ip   =  get_ip_info($ip);
           }

        $ret = array(
                'userID'     => $base->userID(),
                'userNick'   => $base->userNick(),
                'userAvatar' => $base->userAvatar(),
                'userGender' => $base->userGender(),
                'userScore'  => $base->userScore(),
                'coupon'     => $base->coupon(),
                'userExperience' => $base->userExperience(),
                'userID'     => $detail->userID(),
                'winCount'   => $detail->winCount(),
                'userAccount'   => $detail->user_email(),
                'lostCount'  => $detail->lostCount(),
                'drawCount'  => $detail->drawCount(),
                'gift'       => $detail->gift(),
                'speakerCount' => $detail->speakerCount(),
                'vipLevel'     => $base->vipLevel(),
                'mac'          => $detail->mac(),
                'registertime' => $detail->registertime(),
                'lastlogintime' => $detail->lastlogintime(),
                'mobilenumber' =>  $detail->mobilenumber(),
                "ip"  =>    $ip,
                'totalcompetitiontimes' =>  $detail->totalcompetitiontimes() ,
                "isblock"    => $detail->isblock(),
                "viplasteffectivetime"   => $detail->viplasteffectivetime(),
            
        );
        return $ret;
    }
    
    
    public function query_user_info1($uid) {

        $query = new GameServerQueryUserInfoRequest();
        $query->set_userID($uid);
        $buf = $query->SerializeToString();

       // $retx = $this->_request_midlayer_res1($buf, 20031, "211.151.33.246", "9112");//_request_midlayer_res($buf, 20031);
        $retx = $this->_request_midlayer_res($buf, 20031);
        
        $userinfo = new GameServerQueryUserInfoResponse();
        $userinfo->ParseFromString($retx);
        
        $response_status = $userinfo->result();
 

        if ($userinfo->result() == EnumResult::enumResultFail) {
            return false;
        }
        
       
      //  return $userinfo;

      
        $base   = $userinfo->basicUserInfo();
        $detail = $userinfo->detailUserInfo();

        $ret = array(
            'basicUserInfo'  => array(
                'userID'     => $base->userID(),
                'userNick'   => $base->userNick(),
                'userAvatar' => $base->userAvatar(),
                'userGender' => $base->userGender(),
                'userScore'  => $base->userScore(),
                'coupon'     => $base->coupon(),
                'userExperience' => $base->userExperience(),
            ),
            'defailUserInfo' => array(
                'userID'     => $detail->userID(),
                'winCount'   => $detail->winCount(),
                'userAccount'   => $detail->user_email(),
                'lostCount'  => $detail->lostCount(),
                'drawCount'  => $detail->drawCount(),
                'gift'       => $detail->gift(),
                'speakerCount' => $detail->speakerCount(),
            ),
        );
        
      //  print_r($ret);

        return $ret;
      
    }
    public function query_user_info($uid) {
        $query = new GameServerQueryUserInfoRequest();
        $query->set_userID($uid);
        $buf = $query->SerializeToString();

      //  $ret = $this->_request_midlayer_res1($buf, 20031, "211.151.33.246", "9112");//_request_midlayer_res($buf, 20031);
        
         $ret = $this->_request_midlayer_res($buf, 20031);

        $userinfo = new GameServerQueryUserInfoResponse();
        $userinfo->ParseFromString($ret);

        $response_status = $userinfo->result();

        if ($userinfo->result() == EnumResult::enumResultFail) {
            return false;
        }
        
        $base   = $userinfo->basicUserInfo();
        $detail = $userinfo->detailUserInfo();

        $ret = array(
            'basicUserInfo'  => array(
                'userID'     => $base->userID(),
                'userNick'   => $base->userNick(),
                'userAvatar' => $base->userAvatar(),
                'userGender' => $base->userGender(),
                'userScore'  => $base->userScore(),
                'coupon'     => $base->coupon(),
                'userExperience' => $base->userExperience(),
            ),
            'defailUserInfo' => array(
                'userID'     => $detail->userID(),
                'winCount'   => $detail->winCount(),
                'userAccount'   => $detail->user_email(),
                'lostCount'  => $detail->lostCount(),
                'drawCount'  => $detail->drawCount(),
                'gift'       => $detail->gift(),
                'speakerCount' => $detail->speakerCount(),
                'coupon_total_given' => 50000,
            ),
        );

        return $ret;
      
    }
    
    public function update_userinfo($basic, $detail) {
        $query = new ModifyUserInfoReq();
        $query->set_basicUserInfo($basic);
        $query->set_detailUserInfo($detail);

        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80023);

        if (!$ret) {
            return false;
        }

        $response = new ModifyUserInfoRsp();
        $response->ParseFromString($ret);

        return $response->returncode() == EnumResult::enumResultSucc;
    }
    
    public function update_basic_userinfo($uid, $k, $v) {

        $pair = new PairIntString();
        $pair->set_fieldName($k);
        $pair->set_fieldValue($v);

        $query = new GameServerModifyUserInfoRequest();
        $query->set_userid($uid);
        $query->set_kv(0, $pair);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res1($buf, 20035, "211.151.33.249", "9112");
        $rsp = new GameServerModifyUserInfoResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;

    }
    
     public function adduseruser($userid, $couponNum, $reason,$gameid,$gametype,$roomid,$taskID,$orderID,$goodID) {
   
        $this->_require('pb_proto_adduser');
        $query = new AddUserCoupon_AddUserCouponRequest();
        $query->set_userID($userid);
        $query->set_couponNumAdded($couponNum);
        $query->set_reason($reason);
        $query->set_gameCode($gameid);
        $query->set_gameType($gametype);
        $query->set_roomID($roomid);
        $query->set_taskID($taskID);
        $query->set_orderID($orderID);
        $query->set_goodID($goodID);
        
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 60139);
       // $ret = $this->_request_midlayer_res1($buf, 60139,"211.151.33.246", "10003");
     //   $ret = $this->_request_midlayer_res1($buf, 60139,"211.151.33.249", "9112");
       //    $ret = $this->_request_midlayer_res1($buf, 60139,"211.151.33.249", "10003");
      //  $ret = $this->_request_midlayer_res1($buf, 60139,"211.151.33.246", "9112");
        //$ret = $this->_request_midlayer_res1($buf, 60139,"10.0.0.6", "10004");
        $rsp = new AddUserCoupon_AddUserCouponResponse();
        $rsp->ParseFromString($ret);
        $res["result"] = $rsp->result();
        $res["userID"] = $rsp->userID();
        $res["couponNumAdded"] = $rsp->couponNumAdded();
        $res["reason"] = $rsp->reason();
        $res["gameCode"] = $rsp->gameCode();
        $res["gameType"] = $rsp->gameType();
        $res["roomID"] = $rsp->roomID();
        $res["newCouponNum"] = $rsp->newCouponNum();
 
        return $res;
    }

    /*
     * 添加小喇叭
     *
     */
    public function add_speaker($account, $v) {
        //$this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(1);
        $query->set_num($v);
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);

        if (!$ret) {
            return false;
        }

        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    public function account2id1($account) {
      
        $query = new GetUseridReq();
        $query->set_email($account);
        $buf = $query->SerializeToString();

       // $ret = $this->_request_midlayer_res1($buf, 80009,"211.151.33.246", "9112");
        $ret = $this->_request_midlayer_res($buf, 80009);

        $rsp = new GetUseridRsp();
        $rsp->ParseFromString($ret);
        
         if ($rsp->returncode() == EnumResult::enumResultSucc) {
            $ret = array(
               'email' => $rsp->email(),
               'userid' => $rsp->userID(),
            ); 
            return $ret;
        } else {
            return false;
        } 

    }

    public function account2id($account) {
        
        $query = new GetUseridReq();
        $query->set_email($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80009);

        $rsp = new GetUseridRsp();
        $rsp->ParseFromString($ret);

        if ($rsp->returncode() == EnumResult::enumResultSucc) {
            $ret = array(
               'email' => $rsp->email(),
               'userid' => $rsp->userID(),
            ); 
            return $ret;
        } else {
            return false;
        } 

    }

    /*
     * 踢人
     * @param $uid
     * @return boolean
     */
    public function kickuser($uid) {

        $query = new KickOffUserReq();
        $query->set_userID($uid);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80041);

        $rsp = new KickOffUserRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;

    }
    /******************************
     * test code from here 
     *****************************/
    
     public function add_buqian($account, $v) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(2);
        $query->set_num($v);
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }



   public function add_jipai($account, $v) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(3);
        $query->set_num($v);
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }

public function get_v5($account) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(101);
        $query->set_num("0");
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }


     public function get_v10($account) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(102);
        $query->set_num("0");
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }


     public function get_v15($account) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(103);
        $query->set_num("0");
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }


     public function get_v30($account) {
        $this->_require('pb_proto_SMCmiddlelayerserver');

        $query = new AddToolReq();
        $query->set_type(104);
        $query->set_num("0");
        $query->set_userID($account);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80021);
         
        $rsp = new AddToolRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }

    
    

}
