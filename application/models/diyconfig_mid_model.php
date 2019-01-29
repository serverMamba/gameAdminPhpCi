<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diyconfig_mid_model extends MY_Model {

    public function __construct() {
        parent::__construct();

        require_once(APPPATH . 'third_party/message/pb_message.php');
        //require_once(APPPATH . "third_party/proto/pb_proto_packet.php");

        //$this->_require('pb_proto_clientgameserver');
        //$this->_require('pb_proto_SMCmiddlelayerserver');
        //$this->_require('pb_proto_propertyandgift');

        $this->_require('pb_proto_pbclientgameserver');
    }

    /**
     * 添加系统公告
     * @param array $notifycation array(title, content, gamecode)
     * @return boolean
     */
    public function add_notifycation($notifycation)
    {
        $sn = new SingleNotification();
        $sn->set_notificationID(0);
        $sn->set_notificationTitle($notifycation['title']);
        $sn->set_notificationContent($notifycation['content']);
        //$sn->set_notificationAddTime('');
	$sn->set_notificationAddTime(date('Y-m-d h:m:s'));
//         $sn->set_notificationType($notifycation['type']);
        $sn->set_notificationGamecode($notifycation['gamecode']);
        
        
        $query = new AddNotificationReq();
        $query->set_notification($sn);
        $buf = $query->SerializeToString();
        
        $ret = $this->_request_midlayer_res($buf, 80053);
        
        $rsp = new AddNotificationRsp();
        $rsp->ParseFromString($ret);
        
        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    /**
     * 删除系统公告
     * @return boolean
     */
    public function del_notifycation($id)
    {
        $query = new DeleteNotificationReq();
        $query->set_notificationid($id);
        $buf = $query->SerializeToString();
        
        $ret = $this->_request_midlayer_res($buf, 80055);
        
        $rsp = new DeleteNotificationRsp();
        $rsp->ParseFromString($ret);
        
        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    public function get_brokerate() {

        $query = new QueryBrokerageReq();
        $query->set_id(1);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80011);

        $rsp = new QueryBrokerageRsp();
        $rsp->ParseFromString($ret);

        if (!$rsp || $rsp->returncode() == EnumResult::enumResultFail) {
            return false;
        } else {
            return $rsp->brokerage();
        }

    } 
    
    public function modify_brokerate($type, $rate) {
        
        $query = new ModifyBrokerageReq();
        $query->set_id($type);
        $query->set_brokerage($rate);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80029);

        if (!$ret) {
            return false;
        }

        $rsp = new ModifyBrokerageRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;
    }

    /*
     * 添加广播
     */
    public function add_broadcast($record) {

        $bc = new GameServerSetBroadcast();
        $bc->set_open(true);
        $bc->set_userid($record['userid']);
        $bc->set_username($record['username']);
        $bc->set_broadcastid(0);
        $bc->set_broadcasttype($record['broadcasttype']);
        $bc->set_content($record['content']);
        $bc->set_interval($record['interval']);
        $bc->set_countdown(0);
        $bc->set_gamecode($record['gamecode']);

        $query = new AddSystemBroadcastReq();
        $query->set_broadcastinfo($bc);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80037);

        if (!$ret) {
            return false;
        }

        $rsp = new AddSystemBroadcastRsp();
        $rsp->ParseFromString($ret);
        
        return $rsp->returncode() == EnumResult::enumResultSucc;

    }

    public function del_broadcast($uid, $broadcastid) {

        $query = new DeleteSystemBroadcastReq();
        $query->set_userid($uid);
        $query->set_broadcastid($broadcastid);

        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res($buf, 80039);

        $rsp = new DeleteSystemBroadcastRsp();
        $rsp->ParseFromString($ret);

        return $rsp->returncode() == EnumResult::enumResultSucc;

    }
    
    /**
     * 
     * @param string $ip
     * @param string $port
     * @return boolean
     */
    public function switch_dispatch($ip, $port) {
    	
    	$this->_require('pb_proto_dispatch');
    	
    	$query = new SwitchDispatchRequest();
    	$query->set_ip($ip);
    	$query->set_port($port);
    	
    	$buf = $query->SerializeToString();
    	
    	$ret = $this->_request_midlayer_res($buf, 45006);
    	
    	if (!$ret) {
    		return false;
    	}
    	
    	$rsp = new SwitchDispatchResponse();
    	$rsp->ParseFromString($ret);
    	
    	return $rsp->returncode() == EnumResult::enumResultSucc;
    	
    }
    
    /**
     * 
     * @param string $ip
     * @param string $port
     * @param string $toip
     * @param string $toport
     * @param boolean $enable
     * @return boolean
     */
    public function set_gameserver($toip, $toport,$ip, $port,  $enable) {
    	
    	$this->_require('pb_proto_dispatch');

    	$iValue = intval($port) + strlen($ip) * 5 + 3;
    	$key = $ip . 'P36J9FH3o[pese)433237201dhWER2$' . strval(($port + 21800) * $iValue);
    	$key .= '27302&%ljkH00192' . $enable . '42980%&gjkaf';
    	
    	$query = new SetGameserverEnableReq();
    	$query->set_ip($ip);
    	$query->set_port($port);
    	$query->set_enable($enable);
    	$query->set_key($key);
    	
    	$buf = $query->SerializeToString();
    	
    	$ret = $this->_request_midlayer($buf, 45008, array('host' => $toip, 'port' => $toport));
    	
    	if (!$ret) {
    		return false;
    	}
    	
    	$rsp = new SetGameserverEnableRsp();
    	$rsp->ParseFromString($ret);
    	
    	return $rsp->returncode() == EnumResult::enumResultSucc;
    	
    }
    
    /**
     *
     * @param string $propertyid
     * @return boolean
     */
    public function del_property($propertyid) {
         
        $query = new DelPropertyRequest();
        $query->set_propertyid($propertyid);
    
        $buf = $query->SerializeToString();
    
        $ret = $this->_request_midlayer_res($buf, 80047);
        if (!$ret) {
            return false;
        }
         
        $rsp = new DelPropertyResponse();
    
        return $rsp->returncode() == EnumResult::enumResultSucc;
    
    }
    
    /**
     *
     * @param string $giftid
     * @return boolean
     */
    public function del_gift($giftid) {
    
        $query = new DelGiftRequest();
        $query->set_giftid($giftid);
    
        $buf = $query->SerializeToString();
    
        $ret = $this->_request_midlayer_res($buf, 80051);
        if (!$ret) {
            return false;
        }
        $rsp = new DelGiftResponse();
    
        return $rsp->returncode() == EnumResult::enumResultSucc;
    
    }
    
    /**
     *
     * @param string $data
     * @return boolean
     */
    public function modify_property($data) {
    
        $property = new PropertyInfo();
        $property->set_id($data['id']);
        $property->set_name($data['name']);
        $property->set_price($data['price']);
        $property->set_picurl($data['picurl']);
        $property->set_type($data['type']);
    
        $query = new ModifyPropertyRequest();
        $query->set_property($property);
    
        $buf = $query->SerializeToString();
    
        $ret = $this->_request_midlayer_res($buf, 80045);
        if (!$ret) {
            return false;
        }
        $rsp = new ModifyPropertyResponse();
    
        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    /**
     *
     * @param string $data
     * @return boolean
     */
    public function modify_gift($data) {
    
        $gift = new GiftInfo();
        $gift->set_id($data['id']);
        $gift->set_name($data['name']);
        $gift->set_price($data['price']);
        $gift->set_picurl($data['picurl']);
        $gift->set_type($data['type']);
    
        $query = new ModifyGiftRequest();
        $query->set_gift($gift);
    
        $buf = $query->SerializeToString();
    
        $ret = $this->_request_midlayer_res($buf, 80049);
        if (!$ret) {
            return false;
        }
        $rsp = new ModifyGiftResponse();
    
        return $rsp->returncode() == EnumResult::enumResultSucc;
    }
    
    public function switchTargetMaster($host, $port) {
        $this->_require('pb_proto_other');
        return $this->_switchTarget($host, $port, 45004);
    }
    
    public function switchTargetSlave($host, $port) {
        $this->_require('pb_proto_other');
        return $this->_switchTarget($host, $port, 45005);
    }
    
    private function _switchTarget($host, $port, $command) {
        
        $keyone = rand(10000, 99999);
        $keytwo = rand(10000, 99999);
        
        $iTemp1 = 23890 + strlen($keyone) * 2 + strlen($keytwo) * 392;
        $iTemp2 = 80090 + strlen($keytwo) * 76 + strlen($keyone) * 867;
        $oss = '';
        $oss = 'kdak*&q9{309418' . strval($iTemp2) . strval( $keyone + 8874631 );
        $oss .= strval($iTemp1) . strval($keytwo +  8671) . '8327439I&@50KJRT';
        
        $query = new SwitchTarget();
        $query->set_keyone($keyone);
        $query->set_keytwo($keytwo);
        $query->set_token($oss);
        
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer($buf, $command, array('host' => $host, 'port' => $port));
        
        return $ret;
        
    }
    /******************************
     * test code from here 
     *****************************/

}
