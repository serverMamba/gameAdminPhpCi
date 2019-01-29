<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * 支付相关
 */

class black_model extends MY_Model {

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

        return $rsp->returncode() == EnumResult::enumResultSucc;

    } 
    
    public function save_all_detail_datax($arrip, $arrmac, $arrid) {
        foreach ($arrip as $key => $value) {
             $this->del_blacklist(1, $value);
        }

        foreach ($arrmac as $key => $value) {
            $this->del_blacklist(2, $value);
         }

        foreach ($arrid as $key => $value) {
            $this->del_blacklist(3, $value);
        }
    }

    public function save_detail_hisx($action, $helpid) {
    	$this->load->model('detail_model');
        switch ($action) {
            case "fongzhanghao":
                $this->detail_model->del_blacklist(3, $helpid);
                break;
            case "fongip":
                $this->detail_model->del_blacklist(1, $helpid);
                break;
            case "fongmac":
                $this->detail_model->del_blacklist(2, $helpid);
                break;
            default:
                echo "No number between 1 and 3";
        }
    }

    public function get_detail_hisx($mystarttime,$myendtime,$black_target){
    	
    	$userid = intval($userid);
    	// 判断是否合法的时间
    	if (!isDate($mystarttime))
    	{
    		return array();
    	}
    	
    	if (!isDate($myendtime))
    	{
    		return array();
    	}
    	
        $CI = &get_instance();
        $db = $CI->load->database('us3', true);
        $wheretarget1 = "";
        $wheretarget3 = "";
        $wheretarget4 = "";
        if($black_target && !empty($black_target))
        {
        	$wheretarget1 = " userip = '".$black_target."' and ";
        	$wheretarget3 = " usermac = '".$black_target."' and ";
        	$wheretarget4 = " userid = ".$black_target." and ";
        }
        $where1 = "where ".$wheretarget1." opertime  >= '$mystarttime' and  opertime <= '$myendtime' order by opertime desc";
        $where2 = "where opertime  >= '$mystarttime' and  opertime <= '$myendtime' order by opertime desc";
        $where3 = "where ".$wheretarget3." opertime  >= '$mystarttime' and  opertime <= '$myendtime' order by opertime desc";
        $where4 = "where ".$wheretarget4." opertime  >= '$mystarttime' and  opertime <= '$myendtime' order by opertime desc";
        
        $sql1 =  "select * from CASINOIPBLACKLIST $where1";
        $sql2 =  "select * from CASINOIPRANGEBLACKLIST $where2 ";
        $sql3 =  "select * from CASINOMACBLACKLIST $where3 ";
        $sql4 =  "select * from CASINOUSERIDBLACKLIST $where4 ";
        
        $query1 =  $db->query($sql1);
        $ret1 = $this->_dealwith_ret($query1); 
        
        $query2 =  $db->query($sql2);
        $ret2 = $this->_dealwith_ret($query2); 
        
        $query3 =  $db->query($sql3);
        $ret3 = $this->_dealwith_ret($query3); 
        
        $query4 =  $db->query($sql4);
        $ret4 = $this->_dealwith_ret($query4); 

        return array("m1"=>$ret1,"m2"=>$ret2,"m3"=>$ret3,"m4"=>$ret4);    
    
    }
    
    public function patchfenguserby_alipay_account($alipay_account){
    	if($alipay_account){
    		$uids = $this->getUidsByAliaccount($alipay_account);
    		$this->load->model ( 'detail_model' );
    		$num=0;
    		$this->writeLog(">>>".count($uids));
    		foreach ($uids as $k=>$v){
    			$this->writeLog($num."$k=>$v");
    			$uid = $v['user_id'];
    			if($uid){
    				$this->writeLog($num." uid=".$uid);
    				$ttt = $this->detail_model->get_index ( $uid );
    				$dbx1 = $ttt["dbx"];
    				$posx1  = $ttt["pos"];
    				$des = "恶劣支付宝".$alipay_account."关联  批量封号";
    				$sql = "INSERT INTO `CASINOBLACKUSER_$posx1`(`userid`,`account`,`remarks`) VALUES ('".$uid."', (select user_email from CASINOUSER_$posx1 where id=$uid), '$des');";
    				$this->writeLog('eus'.$dbx1.">>>".$sql);
    				$db2 = $this->load->database ( 'eus'.$dbx1, true );
    				$res = $db2->query ( $sql );
    				$db2->close ();
    				if($res){
    					$num++;
    				}
    				$this->writeLog("$alipay_account: ".$num);
    			}
    		}
    		
    		return $num;
    	}
    	return 0;
    }
    
    public function patchfenguserby_pwd($black_pwd){
    	$this->writeLog("0 patchfenguserby_pwd");
    	$res_num = 0;
    	for ($x=0; $x<=15; $x++) {
    		$this->writeLog("x=$x");
    		$dbx = 'eus'.$x;
    		$db2 = $this->load->database ( $dbx, true );
    		$this->writeLog("2 dbx=".$dbx);
    		for ($y=0; $y<=15; $y++) {
    			$tab_to = "CASINOBLACKUSER_".$y;
    			$tab_from = "CASINOUSER_".$y;
    			$remarks = "平安游戏-多账号恶意刷金币";
    			$now = time();
    			$nowStr = date("Y-m-d H:i:s", $now);
    			$sql = " insert into CASINOUSERDB_$x.$tab_to(userid,account,remarks,addtime) select id as userid,user_email as account,'$remarks' as remarks,'2017-09-13 00:00:00' as addtime from CASINOUSERDB_$x.$tab_from where registertime>='2017-09-09 00:00:00' and `password` in ('qq1111','qqq111','qwe123','qq123123','a123123','qqq222','qqq111','a123456','zxc123');";
    			$sql = " insert into CASINOUSERDB_$x.$tab_to(userid,account,remarks,addtime) SELECT userid_base as userid,account,'$remarks' as remarks,'2017-09-13 00:00:00' as addtime from(
					SELECT a.userid,b.userid as userid_base,b.account from CASINOUSERDB_$x.$tab_to a right JOIN
					(select id as userid,user_email as account,'平安游戏-多账号恶意刷金币' as remarks,'$nowStr' as addtime from CASINOUSERDB_$x.$tab_from where registertime>='2017-09-09 00:00:00' and `password` in ('qq1111','qqq111','qwe123','qq123123','a123123','qqq222','qqq111','a123456','zxc123')) b
					on a.userid=b.userid) x where x.userid is null;";
    			//$this->writeLog($sql);
    			$res = 0;
    			try{
    				$res = $db2->query ( $sql );
    				/**
    				$arr = $res->result_array();
    				foreach ($arr as $key=>$row){
    					$userid=$row['userid'];
    					$account=$row['account'];
    					$this->writeLog(">>>userid=$userid,account=$account");
    				}**/
    			}catch(Exception $e) {
    				$db2->close ();
    			}
    			$res_num = $res_num+intval($res);
    		}
    		$db2->close ();
    	}
    	return $res_num;
    }
    
    public function getUidsByAliaccount($alipay_account){
    	$sql = "SELECT DISTINCT user_id from smc_user u where lower(u.alipay_account) = '".strtolower($alipay_account)."'";
    	$this->writeLog("getUidsByAliaccount>>".$sql);
    	$query = $this->db->query($sql);
    	if ($query->num_rows () > 0) {
    		$this->writeLog("getUidsByAliaccount>>".$query->num_rows ());
    		return $query->result_array();
    	} else {
    		return false;
    	}
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
        
        if (in_array($gameid, array('0', '17',"18","49","97","98","177"))){
            return $this->get_hismsg1($gameid,$mytime);
        }
        
        if (in_array($gameid, array('100'))){
          return $this->get_hismsg2($gameid,$mytime);  
        }
 
    }
    
    public function writeLog($txt) {
    	$log_file = "/log/black_model.log";
    	$handle = fopen ( $log_file, "a+" );
    	$str = fwrite ( $handle, $txt . "\n" );
    	fclose ( $handle );
    }
    

}
