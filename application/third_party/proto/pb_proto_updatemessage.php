<?php
class UpdateMessage_ModifyUpdateInfoRequest extends PBMessage
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
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
    $this->fields["11"] = "PBString";
    $this->values["11"] = "";
    $this->fields["12"] = "PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "PBString";
    $this->values["13"] = "";
    $this->fields["14"] = "PBString";
    $this->values["14"] = "";
  }
  function channelID()
  {
    return $this->_get_value("1");
  }
  function set_channelID($value)
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
  function channelName()
  {
    return $this->_get_value("3");
  }
  function set_channelName($value)
  {
    return $this->_set_value("3", $value);
  }
  function channelDesc()
  {
    return $this->_get_value("4");
  }
  function set_channelDesc($value)
  {
    return $this->_set_value("4", $value);
  }
  function gameName()
  {
    return $this->_get_value("5");
  }
  function set_gameName($value)
  {
    return $this->_set_value("5", $value);
  }
  function downloadURL()
  {
    return $this->_get_value("6");
  }
  function set_downloadURL($value)
  {
    return $this->_set_value("6", $value);
  }
  function version()
  {
    return $this->_get_value("7");
  }
  function set_version($value)
  {
    return $this->_set_value("7", $value);
  }
  function updateVersion()
  {
    return $this->_get_value("8");
  }
  function set_updateVersion($value)
  {
    return $this->_set_value("8", $value);
  }
  function updateType()
  {
    return $this->_get_value("9");
  }
  function set_updateType($value)
  {
    return $this->_set_value("9", $value);
  }
  function updateContent()
  {
    return $this->_get_value("10");
  }
  function set_updateContent($value)
  {
    return $this->_set_value("10", $value);
  }
  function versionStr()
  {
    return $this->_get_value("11");
  }
  function set_versionStr($value)
  {
    return $this->_set_value("11", $value);
  }
  function packageSize()
  {
    return $this->_get_value("12");
  }
  function set_packageSize($value)
  {
    return $this->_set_value("12", $value);
  }
  function md5()
  {
    return $this->_get_value("13");
  }
  function set_md5($value)
  {
    return $this->_set_value("13", $value);
  }
  function packageName()
  {
    return $this->_get_value("14");
  }
  function set_packageName($value)
  {
    return $this->_set_value("14", $value);
  }
}
class UpdateMessage_ModifyUpdateInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
}
class UpdateMessage extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>