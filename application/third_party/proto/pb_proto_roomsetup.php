<?php
class Roomsetup_RoomInfoItem extends PBMessage
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
  function configKey()
  {
    return $this->_get_value("1");
  }
  function set_configKey($value)
  {
    return $this->_set_value("1", $value);
  }
  function configValue()
  {
    return $this->_get_value("2");
  }
  function set_configValue($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Roomsetup_RoomInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Roomsetup_RoomInfoItem";
    $this->values["2"] = array();
  }
  function roomid()
  {
    return $this->_get_value("1");
  }
  function set_roomid($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfoItems($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_roomInfoItems()
  {
    return $this->_add_arr_value("2");
  }
  function set_roomInfoItems($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_roomInfoItems()
  {
    $this->_remove_last_arr_value("2");
  }
  function roomInfoItems_size()
  {
    return $this->_get_arr_size("2");
  }
}
class Roomsetup_GetRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
}
class Roomsetup_GetRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Roomsetup_RoomInfo";
    $this->values["2"] = array();
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_roomInfo()
  {
    return $this->_add_arr_value("2");
  }
  function set_roomInfo($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_roomInfo()
  {
    $this->_remove_last_arr_value("2");
  }
  function roomInfo_size()
  {
    return $this->_get_arr_size("2");
  }
}
class Roomsetup_ModifyRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Roomsetup_RoomInfo";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Roomsetup_ModifyRoomInfoRsp extends PBMessage
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
class Roomsetup_AddRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Roomsetup_RoomInfo";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Roomsetup_AddRoomInfoRsp extends PBMessage
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
class Roomsetup_DeleteRoomInfoReq extends PBMessage
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
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomID()
  {
    return $this->_get_value("2");
  }
  function set_roomID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Roomsetup_DeleteRoomInfoRsp extends PBMessage
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
class Roomsetup_ModifyRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Roomsetup_RoomInfo";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Roomsetup_AddRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "Roomsetup_RoomInfo";
    $this->values["1"] = "";
  }
  function roomInfo()
  {
    return $this->_get_value("1");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class Roomsetup_DeleteRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class Roomsetup extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>