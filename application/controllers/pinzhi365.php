<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pinzhi365 extends MY_Controller {

    public function __construct() {
        parent::__construct(false);
        $this->load->model('usernew_mid_model');
    }
    
     public function test() {
       //  $userinfo = $this->usernew_mid_model->adduseruser("109541", "100000", "2","23","1","1","-1","111111111","2222222222");
        $userinfo = $this->usernew_mid_model->adduseruser("890007", "1504", "2","23","1","1","-1","111111111","2222222222");
        print_r($userinfo);
    }
    
     public function gettoplist() {

        $timestr = date('Ymd', time());
        $myfilename = APP_ROOT."/log/gettoplist_$timestr.log";

        if (file_exists($myfilename)) {
            $saveres = file_get_contents($myfilename, LOCK_EX);
        } else {
            $choose = array(0 => "10元手机话费", 1 => "30元手机话费", 2 => "50元手机话费", 3 => "三星 Galaxy Note 3 N9006 3G手机（炫酷黑）5.7英寸高清炫丽屏 2.3GHZ四核处理器 1300万像素摄像头（单卡联通版）");
            $result = array();
            for (;;) {
                $userid = rand(150009, 2500000);
                $userinfo = $this->usernew_mid_model->query_user_info($userid);
                $coupon = $userinfo["basicUserInfo"]["coupon"];
                $account = $userinfo["defailUserInfo"]["userAccount"];
                $nickname = $userinfo["basicUserInfo"]["userNick"];
                $chooseid = rand(0, 100);
                if($chooseid<90) {$chooseid =0;}
                if(($chooseid<95)&&($chooseid>=90)) {$chooseid =1;}
                if(($chooseid<99)&&($chooseid>=95)) {$chooseid =3;}
                if($chooseid>=99) {$chooseid =4;}
                
                $sangpin = $choose[$chooseid];
                $result[] = array("userid" => $userid, "coupon" => $coupon, "account" => $account, "nickname" => $nickname, "sangpin" => $sangpin);
                if (count($result) >= 20)
                    break;
            }
            $saveres = json_encode($result);
            file_put_contents($myfilename, $saveres, LOCK_EX);
        }

        echo $saveres;
    }

    public function redir() {
        $userid  = $this->input->get('userid'); 
        $reason = $this->input->get('reason'); 
        $gameid= $this->input->get('gameid'); 
        $gametype= $this->input->get('gametype'); 
        $channel= $this->input->get('channel'); 
        $roomid = $this->input->get('roomid'); 
        $displaytitle = $this->input->get('displaytitle'); 
        
        $taskID = -1;//$this->input->get('taskid'); 
        
       // $sign = $this->input->get('sign');
        $key  = "rol11998888";
        $signx = md5($userid.$reason.$gameid.$gametype.$roomid.$channel.$taskID.$key);
        
        // $redirect_url = "http://www.pinzhi365.com/mini/billExchange/index.do?userName=$userid&reason=$reason&gameid=$gameid&gametype=$gametype&roomid=$roomid&channel=$channel&taskid=$taskID&sign=$signx ";
      //  $redirect_url = "http://www.515game.com/dh/start?userName=$userid&reason=$reason&gameid=$gameid&gametype=$gametype&roomid=$roomid&channel=$channel&taskid=$taskID&sign=$signx ";
         $redirect_url = "http://www.515game.com/pk/start?awardClassId=0&userName=$userid&reason=$reason&gameid=$gameid&gametype=$gametype&roomid=$roomid&channel=$channel&taskid=$taskID&displaytitle=$displaytitle&sign=$signx ";
         header("Location: $redirect_url");
    }
    
       public function isaccountexist($account) {
        $account = $this->input->get('account');
        if (!empty($account)) {
            if (!is_numeric($account)) {
                $ret = $this->usernew_mid_model->account2id1($account);
                $userid = $ret['userid'];
            } else {
                $userid = $account;
            }
        }
        if (!empty($userid)) {
            $userinfo = $this->usernew_mid_model->query_user_info($userid);
            if (!empty($userinfo)) {
                echo "yes";
                return;
            }
        }
        echo "no";
    }

    public function getaccountmsg() {
        $account = $this->input->get('account');
        if (!empty($account)) {
            if (!is_numeric($account)) {
                $ret = $this->usernew_mid_model->account2id1($account);
                $userid = $ret['userid'];
            }else{
                $userid = $account;
            }
        }
        
        

        if (!empty($userid)) {
            $userinfo = $this->usernew_mid_model->query_user_info($userid);
            print_r($userinfo);
        }
    }

    public function getcoupon() {
        $account = $this->input->get('account');
        $sign = $this->input->get('sign');
        $key  = "rol11998888";
        $signx = md5($account.$key);
        
        //echo $sign."----".$signx."------";
        
        if($sign != $signx)
        {
            echo "errorsign";
            return;
        }
        
        
        if (!empty($account)) {
            if (!is_numeric($account)) {
                $ret = $this->usernew_mid_model->account2id1($account);
                $userid = $ret['userid'];
            }else{
                $userid = $account;
             }
        }else{
            echo "-1";
            return;
         }

        if (!empty($userid)) {
            $userinfo = $this->usernew_mid_model->query_user_info1($userid);
            if($userinfo)
            {
              $coupon = $userinfo["basicUserInfo"]["coupon"];
              echo $coupon;
            }else{
               echo "-1";
               return;
            }
            return;
        }

        echo "-1";
    }

public function addcoupon() {
        $userid  = $this->input->get('userid'); 
        $couponNum = $this->input->get('couponNum');  
        $reason = $this->input->get('reason'); 
        $gameid= $this->input->get('gameid'); 
        $gametype= $this->input->get('gametype'); 
        $channel= $this->input->get('channel'); 
        $roomid = $this->input->get('roomid'); 
        $taskID = $this->input->get('taskid'); 
        $orderID = $this->input->get('orderid'); 
        $goodID = $this->input->get('goodid'); 
        $sign = $this->input->get('sign');
        
        $key  = "rol11998888";
        $signx = md5($userid.$couponNum.$reason.$gameid.$gametype.$channel.$roomid.$taskID.$orderID.$goodID.$key);
        
       // echo $sign."----".$signx."------";
        
        if($sign != $signx)
        {
            echo "errorsign";
            return;
        }
        $userinfo = $this->usernew_mid_model->adduseruser($userid, $couponNum, $reason,$gameid,$gametype,$roomid,$taskID,$orderID,$goodID);
        echo json_encode($userinfo);

    }
    
    public function updatecoupon() {
        $userid  = $this->input->get('userid'); 
        $couponNum = $this->input->get('couponNum');  
        $userinfo = $this->usernew_mid_model->update_basic_userinfo($userid, "coupon", $couponNum);
        print_r($userinfo);
    }


}
