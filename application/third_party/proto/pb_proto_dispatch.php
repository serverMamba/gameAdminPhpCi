<?php
//class SwitchDispatchRequest extends PBMessage
//{
//  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
//  public function __construct($reader=null)
//  {
//    parent::__construct($reader);
//    $this->fields["1"] = "PBString";
//    $this->values["1"] = "";
//    $this->fields["2"] = "PBInt";
//    $this->values["2"] = "";
//  }
//  function ip()
//  {
//    return $this->_get_value("1");
//  }
//  function set_ip($value)
//  {
//    return $this->_set_value("1", $value);
//  }
//  function port()
//  {
//    return $this->_get_value("2");
//  }
//  function set_port($value)
//  {
//    return $this->_set_value("2", $value);
//  }
//}
//class SwitchDispatchResponse extends PBMessage
//{
//  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
//  public function __construct($reader=null)
//  {
//    parent::__construct($reader);
//    $this->fields["1"] = "PBInt";
//    $this->values["1"] = "";
//  }
//  function returncode()
//  {
//    return $this->_get_value("1");
//  }
//  function set_returncode($value)
//  {
//    return $this->_set_value("1", $value);
//  }
//}
class SetGameserverEnableReq extends PBMessage
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
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function ip()
  {
    return $this->_get_value("1");
  }
  function set_ip($value)
  {
    return $this->_set_value("1", $value);
  }
  function port()
  {
    return $this->_get_value("2");
  }
  function set_port($value)
  {
    return $this->_set_value("2", $value);
  }
  function enable()
  {
    return $this->_get_value("3");
  }
  function set_enable($value)
  {
    return $this->_set_value("3", $value);
  }
  function key()
  {
    return $this->_get_value("4");
  }
  function set_key($value)
  {
    return $this->_set_value("4", $value);
  }
}
class SetGameserverEnableRsp extends PBMessage
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
?>
