<?php
class Onlinedata_RoomStatus extends PBMessage
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
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
  function onlineUserCount()
  {
    return $this->_get_value("2");
  }
  function set_onlineUserCount($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Onlinedata_GameStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Onlinedata_RoomStatus";
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
  function roomStatus($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_roomStatus()
  {
    return $this->_add_arr_value("2");
  }
  function set_roomStatus($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_roomStatus()
  {
    $this->_remove_last_arr_value("2");
  }
  function roomStatus_size()
  {
    return $this->_get_arr_size("2");
  }
}
class Onlinedata_OnlineGameStatusReport extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "Onlinedata_GameStatus";
    $this->values["1"] = array();
  }
  function gameStatus($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_gameStatus()
  {
    return $this->_add_arr_value("1");
  }
  function set_gameStatus($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_gameStatus()
  {
    $this->_remove_last_arr_value("1");
  }
  function gameStatus_size()
  {
    return $this->_get_arr_size("1");
  }
}
class Onlinedata extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>