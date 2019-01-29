<?php
class SwitchTarget extends PBMessage
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
  }
  function keyone()
  {
    return $this->_get_value("1");
  }
  function set_keyone($value)
  {
    return $this->_set_value("1", $value);
  }
  function keytwo()
  {
    return $this->_get_value("2");
  }
  function set_keytwo($value)
  {
    return $this->_set_value("2", $value);
  }
  function token()
  {
    return $this->_get_value("3");
  }
  function set_token($value)
  {
    return $this->_set_value("3", $value);
  }
}
?>