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
class Onlinedata_TournamentGameStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "Onlinedata_RoomStatus";
    $this->values["3"] = array();
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function tournamentGameType()
  {
    return $this->_get_value("2");
  }
  function set_tournamentGameType($value)
  {
    return $this->_set_value("2", $value);
  }
  function roomStatus($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_roomStatus()
  {
    return $this->_add_arr_value("3");
  }
  function set_roomStatus($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_roomStatus()
  {
    $this->_remove_last_arr_value("3");
  }
  function roomStatus_size()
  {
    return $this->_get_arr_size("3");
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
    $this->fields["2"] = "Onlinedata_TournamentGameStatus";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
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
  function tournamentGameStatus($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_tournamentGameStatus()
  {
    return $this->_add_arr_value("2");
  }
  function set_tournamentGameStatus($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_tournamentGameStatus()
  {
    $this->_remove_last_arr_value("2");
  }
  function tournamentGameStatus_size()
  {
    return $this->_get_arr_size("2");
  }
  function reportTime()
  {
    return $this->_get_value("3");
  }
  function set_reportTime($value)
  {
    return $this->_set_value("3", $value);
  }
  function gameserverip()
  {
    return $this->_get_value("4");
  }
  function set_gameserverip($value)
  {
    return $this->_set_value("4", $value);
  }
  function gameserverport()
  {
    return $this->_get_value("5");
  }
  function set_gameserverport($value)
  {
    return $this->_set_value("5", $value);
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