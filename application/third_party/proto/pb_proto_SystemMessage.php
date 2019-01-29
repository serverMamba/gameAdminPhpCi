<?php
class SystemMessage_UserInfoRangeCondition extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function conditionName()
  {
    return $this->_get_value("1");
  }
  function set_conditionName($value)
  {
    return $this->_set_value("1", $value);
  }
  function lower()
  {
    return $this->_get_value("2");
  }
  function set_lower($value)
  {
    return $this->_set_value("2", $value);
  }
  function upper()
  {
    return $this->_get_value("3");
  }
  function set_upper($value)
  {
    return $this->_set_value("3", $value);
  }
}
class SystemMessage_SendSystemMessageReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "SystemMessage_UserInfoRangeCondition";
    $this->values["3"] = array();
  }
  function fromUserID()
  {
    return $this->_get_value("1");
  }
  function set_fromUserID($value)
  {
    return $this->_set_value("1", $value);
  }
  function message()
  {
    return $this->_get_value("2");
  }
  function set_message($value)
  {
    return $this->_set_value("2", $value);
  }
  function rangeConditions($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_rangeConditions()
  {
    return $this->_add_arr_value("3");
  }
  function set_rangeConditions($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_rangeConditions()
  {
    $this->_remove_last_arr_value("3");
  }
  function rangeConditions_size()
  {
    return $this->_get_arr_size("3");
  }
}
class SystemMessage_SendSystemMessageRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function reason()
  {
    return $this->_get_value("2");
  }
  function set_reason($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SystemMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>