<?php
class AddUserCoupon_AddUserCouponRequest extends PBMessage
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
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function couponNumAdded()
  {
    return $this->_get_value("2");
  }
  function set_couponNumAdded($value)
  {
    return $this->_set_value("2", $value);
  }
  function reason()
  {
    return $this->_get_value("3");
  }
  function set_reason($value)
  {
    return $this->_set_value("3", $value);
  }
  function gameCode()
  {
    return $this->_get_value("4");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("4", $value);
  }
  function gameType()
  {
    return $this->_get_value("5");
  }
  function set_gameType($value)
  {
    return $this->_set_value("5", $value);
  }
  function roomID()
  {
    return $this->_get_value("6");
  }
  function set_roomID($value)
  {
    return $this->_set_value("6", $value);
  }
  function taskID()
  {
    return $this->_get_value("7");
  }
  function set_taskID($value)
  {
    return $this->_set_value("7", $value);
  }
  function goodID()
  {
    return $this->_get_value("8");
  }
  function set_goodID($value)
  {
    return $this->_set_value("8", $value);
  }
  function orderID()
  {
    return $this->_get_value("9");
  }
  function set_orderID($value)
  {
    return $this->_set_value("9", $value);
  }
}
class AddUserCoupon_AddUserCouponResponse extends PBMessage
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
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
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
  function couponNumAdded()
  {
    return $this->_get_value("3");
  }
  function set_couponNumAdded($value)
  {
    return $this->_set_value("3", $value);
  }
  function reason()
  {
    return $this->_get_value("4");
  }
  function set_reason($value)
  {
    return $this->_set_value("4", $value);
  }
  function gameCode()
  {
    return $this->_get_value("5");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("5", $value);
  }
  function gameType()
  {
    return $this->_get_value("6");
  }
  function set_gameType($value)
  {
    return $this->_set_value("6", $value);
  }
  function roomID()
  {
    return $this->_get_value("7");
  }
  function set_roomID($value)
  {
    return $this->_set_value("7", $value);
  }
  function newCouponNum()
  {
    return $this->_get_value("8");
  }
  function set_newCouponNum($value)
  {
    return $this->_set_value("8", $value);
  }
  function goodID()
  {
    return $this->_get_value("9");
  }
  function set_goodID($value)
  {
    return $this->_set_value("9", $value);
  }
  function orderID()
  {
    return $this->_get_value("10");
  }
  function set_orderID($value)
  {
    return $this->_set_value("10", $value);
  }
}
class AddUserCoupon extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>