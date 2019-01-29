<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class gamemessage_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        require_once(APPPATH . 'third_party/proto/pb_proto_gamemessage.php');
    }
    
    
    public function get_allgamemessage_data($gamecode) {
        $query = new GameMessage_QueryBystanderSystemMsgRequest();
        $query->set_gameID($gamecode);
        $query->set_roomID("-1");
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80114, "27.115.62.98", "10003");
        $rsp = new GameMessage_QueryBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);
        $result = array();
        $count = $rsp->msgs_size();
        for ($ii = 0; $ii < $count; $ii++) {
            $result1 = array();
            $item = $rsp->msgs($ii);
            $result1['gameid'] =$rsp->gameID();
            $result1['roomID'] =$item->roomID();
            $result1['textmsg'] =$item->textmsg();
            $result1['msgID'] =$item->msgID();
            $result1['intervalBySeconds'] =$item->intervalBySeconds();
            $result[] =  $result1;
         }
        return $result;
    }
    
    public function get_gamemessage_data($gamecode, $roomid) {
        $query = new GameMessage_QueryBystanderSystemMsgRequest();
        $query->set_gameID($gamecode);
        $query->set_roomID($roomid);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80114, "27.115.62.98", "10003");
        $rsp = new GameMessage_QueryBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);
        $result = array();
        $count = $rsp->msgs_size();
        for ($ii = 0; $ii < $count; $ii++) {
            $result1 = array();
            $item = $rsp->msgs($ii);
            $result1['gameid'] =$rsp->gameID();
            $result1['roomID'] =$item->roomID();
            $result1['textmsg'] =$item->textmsg();
            $result1['msgID'] =$item->msgID();
            $result1['intervalBySeconds'] =$item->intervalBySeconds();
            $result[] =  $result1;
         }
        return $result;
    }

    public function save_gamemessage_data($id,$gamecode,$roomid,$inter,$msg){
        $query = new GameMessage_ModifyBystanderSystemMsgRequest();
        $query->set_msgID($id);
        $query->set_intervalBySeconds($inter);
        $query->set_textmsg($msg);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80116, "27.115.62.98", "10003");
        $rsp = new GameMessage_ModifyBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;
           
       }
       
    public function insert_gamemessage_data($gamecode,$roomid,$inter,$msg){
        $query = new GameMessage_AddBystanderSystemMsgRequest();
        $query->set_gameID($gamecode);
        $query->set_roomID($roomid);
        $query->set_textmsg($msg);
        $query->set_intervalBySeconds($inter);
        $buf = $query->SerializeToString();

        $ret = $this->_request_midlayer_res1($buf, 80110, "27.115.62.98", "10003");
        $rsp = new GameMessage_AddBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);
         return $rsp->msgID();
        //return $rsp->result() == EnumResult::enumResultSucc; 
       }
       
       
       public function delete_gamemessage_data($messageID){
        $query = new GameMessage_RemoveBystanderSystemMsgRequest();
        $query->set_msgID($messageID);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80112, "27.115.62.98", "10003");
        $rsp = new GameMessage_RemoveBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);
        return $rsp->result() == EnumResult::enumResultSucc; 
           
       }

}
