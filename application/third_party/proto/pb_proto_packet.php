<?php
class Packet extends PBMessage
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
  function version()
  {
    return $this->_get_value("1");
  }
  function set_version($value)
  {
    return $this->_set_value("1", $value);
  }
  function command()
  {
    return $this->_get_value("2");
  }
  function set_command($value)
  {
    return $this->_set_value("2", $value);
  }
  function serialized()
  {
    return $this->_get_value("3");
  }
  function set_serialized($value)
  {
    return $this->_set_value("3", $value);
  }
  function connectionid()
  {
    return $this->_get_value("4");
  }
  function set_connectionid($value)
  {
    return $this->_set_value("4", $value);
  }
}
?>