<?php


class EnumAddScoreType extends PBEnum
{
  const enumAddScoreType_TableReward  = 1;
  const enumAddScoreType_OnlineReward  = 2;
  const enumAddScoreType_RouletteReward  = 3;
  const enumAddScoreType_SlotsReward  = 4;
  const enumAddScoreType_ZhaJinHuaXiQianReward  = 5;
  const enumAddScoreType_UserBuy  = 6;
  const enumAddScoreType_BackgroundAdd  = 7;
  const enumAddScoreType_BackgroundSub  = 8;
}


class GameServerMiddleLayerServerScoreOperation extends PBMessage
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
    $this->fields["5"] = "EnumAddScoreType";
    $this->values["5"] = "";
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function score()
  {
    return $this->_get_value("2");
  }
  function set_score($value)
  {
    return $this->_set_value("2", $value);
  }
  function adwalltype()
  {
    return $this->_get_value("3");
  }
  function set_adwalltype($value)
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
  function addtype()
  {
    return $this->_get_value("5");
  }
  function set_addtype($value)
  {
    return $this->_set_value("5", $value);
  }
}



class GameServerMiddleLayerServerScoreOperationRsp extends PBMessage
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

