<?php

class GameMessage_AddBystanderSystemMsgRequest extends PBMessage
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
  }
  function gameID()
  {
    return $this->_get_value("1");
  }
  function set_gameID($value)
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
  function textmsg()
  {
    return $this->_get_value("3");
  }
  function set_textmsg($value)
  {
    return $this->_set_value("3", $value);
  }
  function intervalBySeconds()
  {
    return $this->_get_value("4");
  }
  function set_intervalBySeconds($value)
  {
    return $this->_set_value("4", $value);
  }
}


class GameMessage_AddBystanderSystemMsgResponse extends PBMessage
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
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->values["6"] = new PBInt();
    $this->values["6"]->value = -1;
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameID()
  {
    return $this->_get_value("2");
  }
  function set_gameID($value)
  {
    return $this->_set_value("2", $value);
  }
  function roomID()
  {
    return $this->_get_value("3");
  }
  function set_roomID($value)
  {
    return $this->_set_value("3", $value);
  }
  function textmsg()
  {
    return $this->_get_value("4");
  }
  function set_textmsg($value)
  {
    return $this->_set_value("4", $value);
  }
  function intervalBySeconds()
  {
    return $this->_get_value("5");
  }
  function set_intervalBySeconds($value)
  {
    return $this->_set_value("5", $value);
  }
  function msgID()
  {
    return $this->_get_value("6");
  }
  function set_msgID($value)
  {
    return $this->_set_value("6", $value);
  }
}

class GameMessage_RemoveBystanderSystemMsgRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function msgID()
  {
    return $this->_get_value("1");
  }
  function set_msgID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameMessage_RemoveBystanderSystemMsgResponse extends PBMessage
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
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function msgID()
  {
    return $this->_get_value("2");
  }
  function set_msgID($value)
  {
    return $this->_set_value("2", $value);
  }
}


class GameMessage_QueryBystanderSystemMsgRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->values["2"] = new PBInt();
    $this->values["2"]->value = -1;
  }
  function gameID()
  {
    return $this->_get_value("1");
  }
  function set_gameID($value)
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
class GameMessage_BystanderRoomSystemMsg extends PBMessage
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
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
  function textmsg()
  {
    return $this->_get_value("2");
  }
  function set_textmsg($value)
  {
    return $this->_set_value("2", $value);
  }
  function intervalBySeconds()
  {
    return $this->_get_value("3");
  }
  function set_intervalBySeconds($value)
  {
    return $this->_set_value("3", $value);
  }
  function msgID()
  {
    return $this->_get_value("4");
  }
  function set_msgID($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameMessage_QueryBystanderSystemMsgResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "GameMessage_BystanderRoomSystemMsg";
    $this->values["2"] = array();
  }
  function gameID()
  {
    return $this->_get_value("1");
  }
  function set_gameID($value)
  {
    return $this->_set_value("1", $value);
  }
  function msgs($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_msgs()
  {
    return $this->_add_arr_value("2");
  }
  function set_msgs($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_msgs()
  {
    $this->_remove_last_arr_value("2");
  }
  function msgs_size()
  {
    return $this->_get_arr_size("2");
  }
}

class GameMessage_ModifyBystanderSystemMsgRequest extends PBMessage
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
  function msgID()
  {
    return $this->_get_value("1");
  }
  function set_msgID($value)
  {
    return $this->_set_value("1", $value);
  }
  function textmsg()
  {
    return $this->_get_value("2");
  }
  function set_textmsg($value)
  {
    return $this->_set_value("2", $value);
  }
  function intervalBySeconds()
  {
    return $this->_get_value("3");
  }
  function set_intervalBySeconds($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameMessage_ModifyBystanderSystemMsgResponse extends PBMessage
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
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function msgID()
  {
    return $this->_get_value("2");
  }
  function set_msgID($value)
  {
    return $this->_set_value("2", $value);
  }
  function textmsg()
  {
    return $this->_get_value("3");
  }
  function set_textmsg($value)
  {
    return $this->_set_value("3", $value);
  }
  function intervalBySeconds()
  {
    return $this->_get_value("4");
  }
  function set_intervalBySeconds($value)
  {
    return $this->_set_value("4", $value);
  }
}


class GameMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}

?>