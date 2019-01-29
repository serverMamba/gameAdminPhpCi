<?php
class Rank_RankRewardItem extends PBMessage
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
class Rank_SectionRewardConfig extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "Rank_RankRewardItem";
    $this->values["3"] = array();
  }
  function fromPos()
  {
    return $this->_get_value("1");
  }
  function set_fromPos($value)
  {
    return $this->_set_value("1", $value);
  }
  function toPos()
  {
    return $this->_get_value("2");
  }
  function set_toPos($value)
  {
    return $this->_set_value("2", $value);
  }
  function rewardItem($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_rewardItem()
  {
    return $this->_add_arr_value("3");
  }
  function set_rewardItem($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_rewardItem()
  {
    $this->_remove_last_arr_value("3");
  }
  function rewardItem_size()
  {
    return $this->_get_arr_size("3");
  }
}
class Rank_RankRewardConfig extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "Rank_SectionRewardConfig";
    $this->values["2"] = array();
  }
  function rankType()
  {
    return $this->_get_value("1");
  }
  function set_rankType($value)
  {
    return $this->_set_value("1", $value);
  }
  function sectionRewardConfig($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_sectionRewardConfig()
  {
    return $this->_add_arr_value("2");
  }
  function set_sectionRewardConfig($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_sectionRewardConfig()
  {
    $this->_remove_last_arr_value("2");
  }
  function sectionRewardConfig_size()
  {
    return $this->_get_arr_size("2");
  }
}
class Rank_ModifyRankRewardConfigRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "Rank_RankRewardConfig";
    $this->values["1"] = array();
  }
  function rankRewardConfig($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_rankRewardConfig()
  {
    return $this->_add_arr_value("1");
  }
  function set_rankRewardConfig($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_rankRewardConfig()
  {
    $this->_remove_last_arr_value("1");
  }
  function rankRewardConfig_size()
  {
    return $this->_get_arr_size("1");
  }
}
class Rank_ModifyRankRewardConfigResponse extends PBMessage
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
class Rank extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>