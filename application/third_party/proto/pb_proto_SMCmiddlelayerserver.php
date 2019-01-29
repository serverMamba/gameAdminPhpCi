<?php
class PayRecordInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
  }
  function paytype()
  {
    return $this->_get_value("1");
  }
  function set_paytype($value)
  {
    return $this->_set_value("1", $value);
  }
  function userID()
  {
    return $this->_get_value("2");
  }
  function set_userID($value)
  {
    return $this->_set_value("2", $value);
  }
  function tradeno()
  {
    return $this->_get_value("3");
  }
  function set_tradeno($value)
  {
    return $this->_set_value("3", $value);
  }
  function gamecode()
  {
    return $this->_get_value("4");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("4", $value);
  }
  function platformid()
  {
    return $this->_get_value("5");
  }
  function set_platformid($value)
  {
    return $this->_set_value("5", $value);
  }
  function totalfee()
  {
    return $this->_get_value("6");
  }
  function set_totalfee($value)
  {
    return $this->_set_value("6", $value);
  }
  function productid()
  {
    return $this->_get_value("7");
  }
  function set_productid($value)
  {
    return $this->_set_value("7", $value);
  }
  function productdesc()
  {
    return $this->_get_value("8");
  }
  function set_productdesc($value)
  {
    return $this->_set_value("8", $value);
  }
}
class InsertPayRecordReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PayRecordInfo";
    $this->values["1"] = "";
  }
  function info()
  {
    return $this->_get_value("1");
  }
  function set_info($value)
  {
    return $this->_set_value("1", $value);
  }
}
class InsertPayRecordRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GetUseridReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function email()
  {
    return $this->_get_value("1");
  }
  function set_email($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GetUseridRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function email()
  {
    return $this->_get_value("2");
  }
  function set_email($value)
  {
    return $this->_set_value("2", $value);
  }
  function userID()
  {
    return $this->_get_value("3");
  }
  function set_userID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class AddIPBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function userip()
  {
    return $this->_get_value("1");
  }
  function set_userip($value)
  {
    return $this->_set_value("1", $value);
  }
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddIPBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteIPBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function userip()
  {
    return $this->_get_value("1");
  }
  function set_userip($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteIPBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddUserIDBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddUserIDBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteUserIDBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteUserIDBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddMACBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function usermac()
  {
    return $this->_get_value("1");
  }
  function set_usermac($value)
  {
    return $this->_set_value("1", $value);
  }
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddMACBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteMACBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function usermac()
  {
    return $this->_get_value("1");
  }
  function set_usermac($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteMACBlackListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryBrokerageReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryBrokerageRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function brokerage()
  {
    return $this->_get_value("2");
  }
  function set_brokerage($value)
  {
    return $this->_set_value("2", $value);
  }
}
class RankingInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function account()
  {
    return $this->_get_value("2");
  }
  function set_account($value)
  {
    return $this->_set_value("2", $value);
  }
  function value()
  {
    return $this->_get_value("3");
  }
  function set_value($value)
  {
    return $this->_set_value("3", $value);
  }
}
class QueryRankingInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function type()
  {
    return $this->_get_value("1");
  }
  function set_type($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryRankingInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "RankingInfo";
    $this->values["2"] = array();
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function info($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_info()
  {
    return $this->_add_arr_value("2");
  }
  function set_info($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_info()
  {
    $this->_remove_last_arr_value("2");
  }
  function info_size()
  {
    return $this->_get_arr_size("2");
  }
}
class AddToolReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function type()
  {
    return $this->_get_value("1");
  }
  function set_type($value)
  {
    return $this->_set_value("1", $value);
  }
  function num()
  {
    return $this->_get_value("2");
  }
  function set_num($value)
  {
    return $this->_set_value("2", $value);
  }
  function userID()
  {
    return $this->_get_value("3");
  }
  function set_userID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class AddToolRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyBrokerageReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function brokerage()
  {
    return $this->_get_value("2");
  }
  function set_brokerage($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ModifyBrokerageRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class KickOffUserReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class KickOffUserRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddSystemBroadcastRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteSystemBroadcastReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function broadcastid()
  {
    return $this->_get_value("2");
  }
  function set_broadcastid($value)
  {
    return $this->_set_value("2", $value);
  }
}
class DeleteSystemBroadcastRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerMiddleLayerAddOfflineMsg extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function msg()
  {
    return $this->_get_value("3");
  }
  function set_msg($value)
  {
    return $this->_set_value("3", $value);
  }
  function timestamp()
  {
    return $this->_get_value("4");
  }
  function set_timestamp($value)
  {
    return $this->_set_value("4", $value);
  }
}
?>
