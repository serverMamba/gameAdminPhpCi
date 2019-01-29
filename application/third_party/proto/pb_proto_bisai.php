<?php
class Bisai_RewardItem extends PBMessage
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
  function itemType()
  {
    return $this->_get_value("1");
  }
  function set_itemType($value)
  {
    return $this->_set_value("1", $value);
  }
  function itemValue()
  {
    return $this->_get_value("2");
  }
  function set_itemValue($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Bisai_SMCTournamentPlacingReward extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "Bisai_RewardItem";
    $this->values["4"] = array();
  }
  function placingFrom()
  {
    return $this->_get_value("2");
  }
  function set_placingFrom($value)
  {
    return $this->_set_value("2", $value);
  }
  function placingTo()
  {
    return $this->_get_value("3");
  }
  function set_placingTo($value)
  {
    return $this->_set_value("3", $value);
  }
  function reward($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_reward()
  {
    return $this->_add_arr_value("4");
  }
  function set_reward($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_reward()
  {
    $this->_remove_last_arr_value("4");
  }
  function reward_size()
  {
    return $this->_get_arr_size("4");
  }
}
class Bisai_SMCTournamentReward extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Bisai_SMCTournamentPlacingReward";
    $this->values["2"] = array();
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function placingReward($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_placingReward()
  {
    return $this->_add_arr_value("2");
  }
  function set_placingReward($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_placingReward()
  {
    $this->_remove_last_arr_value("2");
  }
  function placingReward_size()
  {
    return $this->_get_arr_size("2");
  }
}
class Bisai_DateTime extends PBMessage
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
  }
  function year()
  {
    return $this->_get_value("1");
  }
  function set_year($value)
  {
    return $this->_set_value("1", $value);
  }
  function month()
  {
    return $this->_get_value("2");
  }
  function set_month($value)
  {
    return $this->_set_value("2", $value);
  }
  function day()
  {
    return $this->_get_value("3");
  }
  function set_day($value)
  {
    return $this->_set_value("3", $value);
  }
  function hour()
  {
    return $this->_get_value("4");
  }
  function set_hour($value)
  {
    return $this->_set_value("4", $value);
  }
  function minute()
  {
    return $this->_get_value("5");
  }
  function set_minute($value)
  {
    return $this->_set_value("5", $value);
  }
}
class Bisai_SMCTournamentGameConfig extends PBMessage
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
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBInt";
    $this->values["11"] = "";
    $this->fields["12"] = "PBInt";
    $this->values["12"] = "";
    $this->fields["13"] = "PBInt";
    $this->values["13"] = "";
    $this->fields["14"] = "PBInt";
    $this->values["14"] = "";
    $this->fields["15"] = "PBInt";
    $this->values["15"] = "";
    $this->fields["16"] = "PBInt";
    $this->values["16"] = "";
    $this->fields["17"] = "PBInt";
    $this->values["17"] = "";
    $this->fields["18"] = "PBInt";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
    $this->fields["20"] = "PBInt";
    $this->values["20"] = "";
    $this->fields["21"] = "PBInt";
    $this->values["21"] = "";
    $this->fields["22"] = "PBInt";
    $this->values["22"] = "";
    $this->fields["23"] = "PBInt";
    $this->values["23"] = "";
    $this->fields["24"] = "PBInt";
    $this->values["24"] = "";
    $this->fields["25"] = "Bisai_DateTime";
    $this->values["25"] = "";
    $this->fields["26"] = "Bisai_DateTime";
    $this->values["26"] = "";
    $this->fields["27"] = "PBInt";
    $this->values["27"] = "";
    $this->fields["28"] = "PBInt";
    $this->values["28"] = "";
    $this->fields["29"] = "PBBool";
    $this->values["29"] = "";
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
  function tournamentStartKey()
  {
    return $this->_get_value("3");
  }
  function set_tournamentStartKey($value)
  {
    return $this->_set_value("3", $value);
  }
  function tournamentFlag()
  {
    return $this->_get_value("4");
  }
  function set_tournamentFlag($value)
  {
    return $this->_set_value("4", $value);
  }
  function tournamentRoomID()
  {
    return $this->_get_value("5");
  }
  function set_tournamentRoomID($value)
  {
    return $this->_set_value("5", $value);
  }
  function tournamentName()
  {
    return $this->_get_value("6");
  }
  function set_tournamentName($value)
  {
    return $this->_set_value("6", $value);
  }
  function tournamentDesc()
  {
    return $this->_get_value("7");
  }
  function set_tournamentDesc($value)
  {
    return $this->_set_value("7", $value);
  }
  function preliminaryBoutCount()
  {
    return $this->_get_value("8");
  }
  function set_preliminaryBoutCount($value)
  {
    return $this->_set_value("8", $value);
  }
  function preliminaryRoundCount()
  {
    return $this->_get_value("9");
  }
  function set_preliminaryRoundCount($value)
  {
    return $this->_set_value("9", $value);
  }
  function extraBoutCount()
  {
    return $this->_get_value("10");
  }
  function set_extraBoutCount($value)
  {
    return $this->_set_value("10", $value);
  }
  function finalBoutCount()
  {
    return $this->_get_value("11");
  }
  function set_finalBoutCount($value)
  {
    return $this->_set_value("11", $value);
  }
  function finalRoundCount()
  {
    return $this->_get_value("12");
  }
  function set_finalRoundCount($value)
  {
    return $this->_set_value("12", $value);
  }
  function preliminaryCutOffCount()
  {
    return $this->_get_value("13");
  }
  function set_preliminaryCutOffCount($value)
  {
    return $this->_set_value("13", $value);
  }
  function finalPromotedCount()
  {
    return $this->_get_value("14");
  }
  function set_finalPromotedCount($value)
  {
    return $this->_set_value("14", $value);
  }
  function initialBaseScore()
  {
    return $this->_get_value("15");
  }
  function set_initialBaseScore($value)
  {
    return $this->_set_value("15", $value);
  }
  function baseScoreIncrement()
  {
    return $this->_get_value("16");
  }
  function set_baseScoreIncrement($value)
  {
    return $this->_set_value("16", $value);
  }
  function baseScoreIncrementGrowth()
  {
    return $this->_get_value("17");
  }
  function set_baseScoreIncrementGrowth($value)
  {
    return $this->_set_value("17", $value);
  }
  function baseScoreGrowthInterval()
  {
    return $this->_get_value("18");
  }
  function set_baseScoreGrowthInterval($value)
  {
    return $this->_set_value("18", $value);
  }
  function initialUserScore()
  {
    return $this->_get_value("19");
  }
  function set_initialUserScore($value)
  {
    return $this->_set_value("19", $value);
  }
  function minApplyCount()
  {
    return $this->_get_value("20");
  }
  function set_minApplyCount($value)
  {
    return $this->_set_value("20", $value);
  }
  function maxApplyCount()
  {
    return $this->_get_value("21");
  }
  function set_maxApplyCount($value)
  {
    return $this->_set_value("21", $value);
  }
  function applyFeeType()
  {
    return $this->_get_value("22");
  }
  function set_applyFeeType($value)
  {
    return $this->_set_value("22", $value);
  }
  function applyFeeCount()
  {
    return $this->_get_value("23");
  }
  function set_applyFeeCount($value)
  {
    return $this->_set_value("23", $value);
  }
  function rewardID()
  {
    return $this->_get_value("24");
  }
  function set_rewardID($value)
  {
    return $this->_set_value("24", $value);
  }
  function startTime()
  {
    return $this->_get_value("25");
  }
  function set_startTime($value)
  {
    return $this->_set_value("25", $value);
  }
  function stopTime()
  {
    return $this->_get_value("26");
  }
  function set_stopTime($value)
  {
    return $this->_set_value("26", $value);
  }
  function period()
  {
    return $this->_get_value("27");
  }
  function set_period($value)
  {
    return $this->_set_value("27", $value);
  }
  function vipLevelLimit()
  {
    return $this->_get_value("28");
  }
  function set_vipLevelLimit($value)
  {
    return $this->_set_value("28", $value);
  }
  function useClock()
  {
    return $this->_get_value("29");
  }
  function set_useClock($value)
  {
    return $this->_set_value("29", $value);
  }
}
class Bisai_ModifyTournamentGameConfigRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Bisai_SMCTournamentGameConfig";
    $this->values["2"] = "";
  }
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameConfig()
  {
    return $this->_get_value("2");
  }
  function set_gameConfig($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Bisai_ModifyTournamentGameConfigResponse extends PBMessage
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
class Bisai_QueryTournamentGameConfigRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
}
class Bisai_QueryTournamentGameConfigResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Bisai_SMCTournamentGameConfig";
    $this->values["2"] = array();
    $this->fields["3"] = "Bisai_SMCTournamentReward";
    $this->values["3"] = array();
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameConfig($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_gameConfig()
  {
    return $this->_add_arr_value("2");
  }
  function set_gameConfig($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_gameConfig()
  {
    $this->_remove_last_arr_value("2");
  }
  function gameConfig_size()
  {
    return $this->_get_arr_size("2");
  }
  function reward($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_reward()
  {
    return $this->_add_arr_value("3");
  }
  function set_reward($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_reward()
  {
    $this->_remove_last_arr_value("3");
  }
  function reward_size()
  {
    return $this->_get_arr_size("3");
  }
}
class Bisai_DeleteTournamentGameConfigRequest extends PBMessage
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
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function tournamentRoomID()
  {
    return $this->_get_value("2");
  }
  function set_tournamentRoomID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Bisai_DeleteTournamentGameConfigResponse extends PBMessage
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
class Bisai_ModifyTournamentRewardRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Bisai_SMCTournamentReward";
    $this->values["2"] = "";
  }
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function reward()
  {
    return $this->_get_value("2");
  }
  function set_reward($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Bisai_ModifyTournamentRewardResponse extends PBMessage
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
class Bisai_DeleteTournamentRewardRequest extends PBMessage
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
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function rewardID()
  {
    return $this->_get_value("2");
  }
  function set_rewardID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class Bisai_DeleteTournamentRewardResponse extends PBMessage
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
class Bisai extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>