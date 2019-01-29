<?php
class EnumLoginType extends PBEnum
{
  const enumLoginTypeToRegisterNewUser  = 0;
  const enumLoginTypeGuestAccount  = 1;
  const enumLoginTypeRegisterAccount  = 2;
}
class EnumGameType extends PBEnum
{
  const enumGameTypeUnknown  = 0;
  const enumGameTypeTexasPokerPuTong  = 1;
  const enumGameTypeTexasPokerJiaBei  = 2;
  const enumGameTypeTexasPokerHuanLe  = 3;
}
class EnumGameTypeStatus extends PBEnum
{
  const enumGameTypeStatusAvailable  = 0;
  const enumGameTypeStatusComingSoon  = 1;
  const enumGameTypeStatusComingHot  = 2;
}
class EnumDeviceType extends PBEnum
{
  const enumDeviceTypeiPhone  = 0;
  const enumDeviceTypeiPad  = 1;
  const enumDeviceTypeAndroid  = 2;
  const enumDeviceTypeWindows  = 3;
}
class EnumGender extends PBEnum
{
  const enumGenderFemale  = 0;
  const enumGenderMale  = 1;
  const enumGenderUnknown  = 2;
}
class EnumResult extends PBEnum
{
  const enumResultSucc  = 0;
  const enumResultFail  = 1;
}
class EnumLoginResult extends PBEnum
{
  const enumLoginResultSucc  = 0;
  const enumLoginResultAccountNotExist  = 1;
  const enumLoginResultWrongPassword  = 2;
  const enumRegisterResultSucc  = 3;
  const enumRegisterResultAlreadyExist  = 4;
  const enumRegisterResultDatabaseError  = 5;
}
class EnumNewVersion extends PBEnum
{
  const enumUpdateTipNoNewVersion  = 0;
  const enumUpdateTipHasNewVersion  = 1;
  const enumUpdateTipHasNewVersionMandatoryUpdate  = 2;
}
class EnumUserPurchaseCategory extends PBEnum
{
  const enumPurchaseChips  = 0;
  const enumPurchaseSpeaker  = 1;
  const enumPurchaseProperty  = 2;
}
class EnumUserPurchaseResult extends PBEnum
{
  const enumPurchaseSucceed  = 0;
  const enumPurchaseFailed  = 1;
}
class EnumChangeTotalScoreReason extends PBEnum
{
  const enumChangeTotalScoreReasonUnknown  = 0;
  const enumChangeTotalScoreReasonPlayGame  = 1;
  const enumChangeTotalScorePresentGift  = 2;
  const enumChangeTotalScorePresentChips  = 3;
}
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
class EnumVIPLevel extends PBEnum
{
  const enumVIPLevelSilver  = 1;
  const enumVIPLevelGold  = 2;
  const enumVIPLevelPlatinum  = 3;
  const enumVIPLevelDiamond  = 4;
}
class EnumFuncCardType extends PBEnum
{
  const enumFuncCardKickUserFromTable  = 0;
}
class FuncCard extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumFuncCardType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function cardType()
  {
    return $this->_get_value("1");
  }
  function set_cardType($value)
  {
    return $this->_set_value("1", $value);
  }
  function cardCount()
  {
    return $this->_get_value("2");
  }
  function set_cardCount($value)
  {
    return $this->_set_value("2", $value);
  }
}
class BasicUserInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "EnumGender";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "EnumVIPLevel";
    $this->values["7"] = "";
    $this->fields["8"] = "FuncCard";
    $this->values["8"] = array();
    $this->fields["9"] = "PBInt";
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
  function userNick()
  {
    return $this->_get_value("2");
  }
  function set_userNick($value)
  {
    return $this->_set_value("2", $value);
  }
  function userAvatar()
  {
    return $this->_get_value("3");
  }
  function set_userAvatar($value)
  {
    return $this->_set_value("3", $value);
  }
  function userGender()
  {
    return $this->_get_value("4");
  }
  function set_userGender($value)
  {
    return $this->_set_value("4", $value);
  }
  function userScore()
  {
    return $this->_get_value("5");
  }
  function set_userScore($value)
  {
    return $this->_set_value("5", $value);
  }
  function userExperience()
  {
    return $this->_get_value("6");
  }
  function set_userExperience($value)
  {
    return $this->_set_value("6", $value);
  }
  function vipLevel()
  {
    return $this->_get_value("7");
  }
  function set_vipLevel($value)
  {
    return $this->_set_value("7", $value);
  }
  function funcCards($offset)
  {
    return $this->_get_arr_value("8", $offset);
  }
  function add_funcCards()
  {
    return $this->_add_arr_value("8");
  }
  function set_funcCards($index, $value)
  {
    $this->_set_arr_value("8", $index, $value);
  }
  function remove_last_funcCards()
  {
    $this->_remove_last_arr_value("8");
  }
  function funcCards_size()
  {
    return $this->_get_arr_size("8");
  }
  function yuanBaoCount()
  {
    return $this->_get_value("9");
  }
  function set_yuanBaoCount($value)
  {
    return $this->_set_value("9", $value);
  }
}
class DetailUserInfo extends PBMessage
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
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBString";
    $this->values["11"] = "";
    $this->fields["12"] = "PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "PBInt";
    $this->values["13"] = "";
    $this->fields["14"] = "PBString";
    $this->values["14"] = "";
    $this->fields["15"] = "PBString";
    $this->values["15"] = "";
    $this->fields["16"] = "PBString";
    $this->values["16"] = "";
    $this->fields["17"] = "PBString";
    $this->values["17"] = "";
    $this->fields["18"] = "PBString";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
    $this->fields["20"] = "PBString";
    $this->values["20"] = "";
    $this->fields["21"] = "PBString";
    $this->values["21"] = "";
    $this->fields["22"] = "PBString";
    $this->values["22"] = "";
    $this->fields["23"] = "PBInt";
    $this->values["23"] = "";
    $this->fields["24"] = "PBInt";
    $this->values["24"] = "";
    $this->fields["25"] = "PBInt";
    $this->values["25"] = "";
    $this->fields["26"] = "PBInt";
    $this->values["26"] = "";
    $this->fields["27"] = "PBInt";
    $this->values["27"] = "";
    $this->fields["28"] = "PBInt";
    $this->values["28"] = "";
    $this->fields["29"] = "PBString";
    $this->values["29"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function winCount()
  {
    return $this->_get_value("2");
  }
  function set_winCount($value)
  {
    return $this->_set_value("2", $value);
  }
  function lostCount()
  {
    return $this->_get_value("3");
  }
  function set_lostCount($value)
  {
    return $this->_set_value("3", $value);
  }
  function drawCount()
  {
    return $this->_get_value("4");
  }
  function set_drawCount($value)
  {
    return $this->_set_value("4", $value);
  }
  function gift()
  {
    return $this->_get_value("5");
  }
  function set_gift($value)
  {
    return $this->_set_value("5", $value);
  }
  function speakerCount()
  {
    return $this->_get_value("6");
  }
  function set_speakerCount($value)
  {
    return $this->_set_value("6", $value);
  }
  function password()
  {
    return $this->_get_value("7");
  }
  function set_password($value)
  {
    return $this->_set_value("7", $value);
  }
  function user_email()
  {
    return $this->_get_value("8");
  }
  function set_user_email($value)
  {
    return $this->_set_value("8", $value);
  }
  function user_device_id()
  {
    return $this->_get_value("9");
  }
  function set_user_device_id($value)
  {
    return $this->_set_value("9", $value);
  }
  function wallet()
  {
    return $this->_get_value("10");
  }
  function set_wallet($value)
  {
    return $this->_set_value("10", $value);
  }
  function ip()
  {
    return $this->_get_value("11");
  }
  function set_ip($value)
  {
    return $this->_set_value("11", $value);
  }
  function mac()
  {
    return $this->_get_value("12");
  }
  function set_mac($value)
  {
    return $this->_set_value("12", $value);
  }
  function isblock()
  {
    return $this->_get_value("13");
  }
  function set_isblock($value)
  {
    return $this->_set_value("13", $value);
  }
  function channel_id()
  {
    return $this->_get_value("14");
  }
  function set_channel_id($value)
  {
    return $this->_set_value("14", $value);
  }
  function activate_device()
  {
    return $this->_get_value("15");
  }
  function set_activate_device($value)
  {
    return $this->_set_value("15", $value);
  }
  function uuid()
  {
    return $this->_get_value("16");
  }
  function set_uuid($value)
  {
    return $this->_set_value("16", $value);
  }
  function location()
  {
    return $this->_get_value("17");
  }
  function set_location($value)
  {
    return $this->_set_value("17", $value);
  }
  function officalgiftinfo()
  {
    return $this->_get_value("18");
  }
  function set_officalgiftinfo($value)
  {
    return $this->_set_value("18", $value);
  }
  function consecutive_login()
  {
    return $this->_get_value("19");
  }
  function set_consecutive_login($value)
  {
    return $this->_set_value("19", $value);
  }
  function registertime()
  {
    return $this->_get_value("20");
  }
  function set_registertime($value)
  {
    return $this->_set_value("20", $value);
  }
  function lastlogintime()
  {
    return $this->_get_value("21");
  }
  function set_lastlogintime($value)
  {
    return $this->_set_value("21", $value);
  }
  function property()
  {
    return $this->_get_value("22");
  }
  function set_property($value)
  {
    return $this->_set_value("22", $value);
  }
  function lastlogintime_int()
  {
    return $this->_get_value("23");
  }
  function set_lastlogintime_int($value)
  {
    return $this->_set_value("23", $value);
  }
  function gift_given_time()
  {
    return $this->_get_value("24");
  }
  function set_gift_given_time($value)
  {
    return $this->_set_value("24", $value);
  }
  function viplasteffectivetime()
  {
    return $this->_get_value("25");
  }
  function set_viplasteffectivetime($value)
  {
    return $this->_set_value("25", $value);
  }
  function totalbuychips()
  {
    return $this->_get_value("26");
  }
  function set_totalbuychips($value)
  {
    return $this->_set_value("26", $value);
  }
  function monthbuychips()
  {
    return $this->_get_value("27");
  }
  function set_monthbuychips($value)
  {
    return $this->_set_value("27", $value);
  }
  function totalcompetitiontimes()
  {
    return $this->_get_value("28");
  }
  function set_totalcompetitiontimes($value)
  {
    return $this->_set_value("28", $value);
  }
  function mobilenumber()
  {
    return $this->_get_value("29");
  }
  function set_mobilenumber($value)
  {
    return $this->_set_value("29", $value);
  }
}
class ChipsBonusInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBBool";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function isLoginBonus()
  {
    return $this->_get_value("1");
  }
  function set_isLoginBonus($value)
  {
    return $this->_set_value("1", $value);
  }
  function consecutiveLoginDays()
  {
    return $this->_get_value("2");
  }
  function set_consecutiveLoginDays($value)
  {
    return $this->_set_value("2", $value);
  }
  function bonusChips()
  {
    return $this->_get_value("3");
  }
  function set_bonusChips($value)
  {
    return $this->_set_value("3", $value);
  }
  function totalChips()
  {
    return $this->_get_value("4");
  }
  function set_totalChips($value)
  {
    return $this->_set_value("4", $value);
  }
}
class TableUserInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "BasicUserInfo";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function seatID()
  {
    return $this->_get_value("1");
  }
  function set_seatID($value)
  {
    return $this->_set_value("1", $value);
  }
  function basicInfo()
  {
    return $this->_get_value("2");
  }
  function set_basicInfo($value)
  {
    return $this->_set_value("2", $value);
  }
  function takeInScore()
  {
    return $this->_get_value("3");
  }
  function set_takeInScore($value)
  {
    return $this->_set_value("3", $value);
  }
}
class TableInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "TableUserInfo";
    $this->values["4"] = array();
    $this->fields["100"] = "PBString";
    $this->values["100"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
  function seatCount()
  {
    return $this->_get_value("3");
  }
  function set_seatCount($value)
  {
    return $this->_set_value("3", $value);
  }
  function tableUserInfo($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_tableUserInfo()
  {
    return $this->_add_arr_value("4");
  }
  function set_tableUserInfo($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_tableUserInfo()
  {
    $this->_remove_last_arr_value("4");
  }
  function tableUserInfo_size()
  {
    return $this->_get_arr_size("4");
  }
  function serialized()
  {
    return $this->_get_value("100");
  }
  function set_serialized($value)
  {
    return $this->_set_value("100", $value);
  }
}
class GameInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumGameTypeStatus";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameTypeStatus()
  {
    return $this->_get_value("2");
  }
  function set_gameTypeStatus($value)
  {
    return $this->_set_value("2", $value);
  }
}
class UserInfoPair extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function fieldName()
  {
    return $this->_get_value("1");
  }
  function set_fieldName($value)
  {
    return $this->_set_value("1", $value);
  }
  function fieldValue()
  {
    return $this->_get_value("2");
  }
  function set_fieldValue($value)
  {
    return $this->_set_value("2", $value);
  }
}
class EnumUserInfoFieldName extends PBEnum
{
  const enumUserInfoFieldNameNick  = 1;
  const enumUserInfoFieldNameAvatar  = 2;
  const enumUserInfoFieldNameGender  = 3;
  const enumUserInfoFieldNameAvatarForModify  = 4;
  const enumUserInfoFieldNameVIPLevel  = 5;
  const enumUserInfoFieldNameMobileNumber = 6;
  const enumUserInfoFieldNameGameTurnSum = 7;
  const enumUserInfoFieldNameContinuousWinTime = 8;
  const enumUserInfoFieldNameCoupon = 9;
  const enumUserInfoFieldNameBuySpecialGoodsFirst = 10;
}
class PairIntString extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumUserInfoFieldName";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function fieldName()
  {
    return $this->_get_value("1");
  }
  function set_fieldName($value)
  {
    return $this->_set_value("1", $value);
  }
  function fieldValue()
  {
    return $this->_get_value("2");
  }
  function set_fieldValue($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ConnectGameServer extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
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
}
class LoginRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumLoginType";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumGameType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "EnumGender";
    $this->values["6"] = "";
    $this->fields["7"] = "EnumDeviceType";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
    $this->fields["11"] = "PBString";
    $this->values["11"] = "";
    $this->fields["12"] = "PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "PBInt";
    $this->values["13"] = "";
    $this->fields["14"] = "PBString";
    $this->values["14"] = "";
    $this->fields["15"] = "PBInt";
    $this->values["15"] = "";
    $this->fields["16"] = "PBInt";
    $this->values["16"] = "";
    $this->fields["17"] = "PBInt";
    $this->values["17"] = "";
  }
  function loginType()
  {
    return $this->_get_value("1");
  }
  function set_loginType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
  {
    return $this->_set_value("2", $value);
  }
  function account()
  {
    return $this->_get_value("3");
  }
  function set_account($value)
  {
    return $this->_set_value("3", $value);
  }
  function password()
  {
    return $this->_get_value("4");
  }
  function set_password($value)
  {
    return $this->_set_value("4", $value);
  }
  function nickname()
  {
    return $this->_get_value("5");
  }
  function set_nickname($value)
  {
    return $this->_set_value("5", $value);
  }
  function gender()
  {
    return $this->_get_value("6");
  }
  function set_gender($value)
  {
    return $this->_set_value("6", $value);
  }
  function deviceType()
  {
    return $this->_get_value("7");
  }
  function set_deviceType($value)
  {
    return $this->_set_value("7", $value);
  }
  function deviceID()
  {
    return $this->_get_value("8");
  }
  function set_deviceID($value)
  {
    return $this->_set_value("8", $value);
  }
  function deviceToken()
  {
    return $this->_get_value("9");
  }
  function set_deviceToken($value)
  {
    return $this->_set_value("9", $value);
  }
  function macAddress()
  {
    return $this->_get_value("10");
  }
  function set_macAddress($value)
  {
    return $this->_set_value("10", $value);
  }
  function secureKey()
  {
    return $this->_get_value("11");
  }
  function set_secureKey($value)
  {
    return $this->_set_value("11", $value);
  }
  function channel()
  {
    return $this->_get_value("12");
  }
  function set_channel($value)
  {
    return $this->_set_value("12", $value);
  }
  function version()
  {
    return $this->_get_value("13");
  }
  function set_version($value)
  {
    return $this->_set_value("13", $value);
  }
  function loginipaddress()
  {
    return $this->_get_value("14");
  }
  function set_loginipaddress($value)
  {
    return $this->_set_value("14", $value);
  }
  function loginipport()
  {
    return $this->_get_value("15");
  }
  function set_loginipport($value)
  {
    return $this->_set_value("15", $value);
  }
  function gameserveripaddress()
  {
    return $this->_get_value("16");
  }
  function set_gameserveripaddress($value)
  {
    return $this->_set_value("16", $value);
  }
  function gameserveripport()
  {
    return $this->_get_value("17");
  }
  function set_gameserveripport($value)
  {
    return $this->_set_value("17", $value);
  }
}
class LoginResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumLoginResult";
    $this->values["1"] = "";
    $this->fields["2"] = "BasicUserInfo";
    $this->values["2"] = "";
    $this->fields["3"] = "GameInfo";
    $this->values["3"] = array();
    $this->fields["4"] = "EnumNewVersion";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function basicUserInfo()
  {
    return $this->_get_value("2");
  }
  function set_basicUserInfo($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameInfo($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_gameInfo()
  {
    return $this->_add_arr_value("3");
  }
  function set_gameInfo($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_gameInfo()
  {
    $this->_remove_last_arr_value("3");
  }
  function gameInfo_size()
  {
    return $this->_get_arr_size("3");
  }
  function update()
  {
    return $this->_get_value("4");
  }
  function set_update($value)
  {
    return $this->_set_value("4", $value);
  }
  function updateURL()
  {
    return $this->_get_value("5");
  }
  function set_updateURL($value)
  {
    return $this->_set_value("5", $value);
  }
  function iOSUpdateURL()
  {
    return $this->_get_value("6");
  }
  function set_iOSUpdateURL($value)
  {
    return $this->_set_value("6", $value);
  }
  function latestVersion()
  {
    return $this->_get_value("7");
  }
  function set_latestVersion($value)
  {
    return $this->_set_value("7", $value);
  }
  function updateInfo()
  {
    return $this->_get_value("8");
  }
  function set_updateInfo($value)
  {
    return $this->_set_value("8", $value);
  }
}
class GameServerGetUserBasicInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerGetUserBasicInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "BasicUserInfo";
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
  function basicInfo()
  {
    return $this->_get_value("2");
  }
  function set_basicInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerEnterGameRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerEnterGameResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumGameType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
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
}
class GameServerLeaveGameRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerLeaveGameResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumGameType";
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
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerGetTableListRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function serialized()
  {
    return $this->_get_value("2");
  }
  function set_serialized($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerGetTableListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "TableInfo";
    $this->values["2"] = array();
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableInfo($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_tableInfo()
  {
    return $this->_add_arr_value("2");
  }
  function set_tableInfo($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_tableInfo()
  {
    $this->_remove_last_arr_value("2");
  }
  function tableInfo_size()
  {
    return $this->_get_arr_size("2");
  }
}
class GameServerEnterTableRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerEnterTableResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "TableInfo";
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
  function tableInfo()
  {
    return $this->_get_value("2");
  }
  function set_tableInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerModifyTakeInScoreRequest extends PBMessage
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
  function seatID()
  {
    return $this->_get_value("1");
  }
  function set_seatID($value)
  {
    return $this->_set_value("1", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("2");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerModifyTakeInScoreResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function seatID()
  {
    return $this->_get_value("2");
  }
  function set_seatID($value)
  {
    return $this->_set_value("2", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("3");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerModifyTakeInScoreBC extends PBMessage
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
  function seatID()
  {
    return $this->_get_value("1");
  }
  function set_seatID($value)
  {
    return $this->_set_value("1", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("2");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerEnterSeatRequest extends PBMessage
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
  function seatID()
  {
    return $this->_get_value("1");
  }
  function set_seatID($value)
  {
    return $this->_set_value("1", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("2");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerEnterSeatResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
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
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
  function seatID()
  {
    return $this->_get_value("3");
  }
  function set_seatID($value)
  {
    return $this->_set_value("3", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("4");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerEnterSeatBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "BasicUserInfo";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function basicUserInfo()
  {
    return $this->_get_value("1");
  }
  function set_basicUserInfo($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
  function seatID()
  {
    return $this->_get_value("3");
  }
  function set_seatID($value)
  {
    return $this->_set_value("3", $value);
  }
  function scoreTakeIn()
  {
    return $this->_get_value("4");
  }
  function set_scoreTakeIn($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerLeaveSeatRequest extends PBMessage
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
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
  function seatID()
  {
    return $this->_get_value("3");
  }
  function set_seatID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerLeaveSeatResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
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
  function userID()
  {
    return $this->_get_value("2");
  }
  function set_userID($value)
  {
    return $this->_set_value("2", $value);
  }
  function tableID()
  {
    return $this->_get_value("3");
  }
  function set_tableID($value)
  {
    return $this->_set_value("3", $value);
  }
  function seatID()
  {
    return $this->_get_value("4");
  }
  function set_seatID($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerLeaveSeatBC extends PBMessage
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
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
  function seatID()
  {
    return $this->_get_value("3");
  }
  function set_seatID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerLogicData extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["100"] = "PBString";
    $this->values["100"] = "";
  }
  function cmd()
  {
    return $this->_get_value("1");
  }
  function set_cmd($value)
  {
    return $this->_set_value("1", $value);
  }
  function serialized()
  {
    return $this->_get_value("100");
  }
  function set_serialized($value)
  {
    return $this->_set_value("100", $value);
  }
}
class GameServerLeaveTableRequest extends PBMessage
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
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function tableID()
  {
    return $this->_get_value("2");
  }
  function set_tableID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerLeaveTableResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
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
  function tableID()
  {
    return $this->_get_value("3");
  }
  function set_tableID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerGetGameListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "GameInfo";
    $this->values["1"] = array();
  }
  function gameInfo($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_gameInfo()
  {
    return $this->_add_arr_value("1");
  }
  function set_gameInfo($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_gameInfo()
  {
    $this->_remove_last_arr_value("1");
  }
  function gameInfo_size()
  {
    return $this->_get_arr_size("1");
  }
}
class GameServerQuickStartRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumGameType";
    $this->values["1"] = "";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerQuickStartResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "TableInfo";
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
  function tableInfo()
  {
    return $this->_get_value("2");
  }
  function set_tableInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerQueryUserInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerQueryUserInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "BasicUserInfo";
    $this->values["2"] = "";
    $this->fields["3"] = "DetailUserInfo";
    $this->values["3"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function basicUserInfo()
  {
    return $this->_get_value("2");
  }
  function set_basicUserInfo($value)
  {
    return $this->_set_value("2", $value);
  }
  function detailUserInfo()
  {
    return $this->_get_value("3");
  }
  function set_detailUserInfo($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerModifyUserInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PairIntString";
    $this->values["2"] = array();
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function kv($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_kv()
  {
    return $this->_add_arr_value("2");
  }
  function set_kv($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_kv()
  {
    $this->_remove_last_arr_value("2");
  }
  function kv_size()
  {
    return $this->_get_arr_size("2");
  }
}
class GameServerModifyUserInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PairIntString";
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
  function userid()
  {
    return $this->_get_value("2");
  }
  function set_userid($value)
  {
    return $this->_set_value("2", $value);
  }
  function kv($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_kv()
  {
    return $this->_add_arr_value("3");
  }
  function set_kv($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_kv()
  {
    $this->_remove_last_arr_value("3");
  }
  function kv_size()
  {
    return $this->_get_arr_size("3");
  }
}
class GamerServerTotalScoreChanged extends PBMessage
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
    $this->fields["4"] = "EnumChangeTotalScoreReason";
    $this->values["4"] = "";
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function totalScoreChanged()
  {
    return $this->_get_value("2");
  }
  function set_totalScoreChanged($value)
  {
    return $this->_set_value("2", $value);
  }
  function totalScoreAfterChanged()
  {
    return $this->_get_value("3");
  }
  function set_totalScoreAfterChanged($value)
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
}
class GameServerSetBroadcast extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBBool";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
  }
  function open()
  {
    return $this->_get_value("1");
  }
  function set_open($value)
  {
    return $this->_set_value("1", $value);
  }
  function userid()
  {
    return $this->_get_value("2");
  }
  function set_userid($value)
  {
    return $this->_set_value("2", $value);
  }
  function username()
  {
    return $this->_get_value("3");
  }
  function set_username($value)
  {
    return $this->_set_value("3", $value);
  }
  function broadcastid()
  {
    return $this->_get_value("4");
  }
  function set_broadcastid($value)
  {
    return $this->_set_value("4", $value);
  }
  function broadcasttype()
  {
    return $this->_get_value("5");
  }
  function set_broadcasttype($value)
  {
    return $this->_set_value("5", $value);
  }
  function content()
  {
    return $this->_get_value("6");
  }
  function set_content($value)
  {
    return $this->_set_value("6", $value);
  }
  function interval()
  {
    return $this->_get_value("7");
  }
  function set_interval($value)
  {
    return $this->_set_value("7", $value);
  }
  function countdown()
  {
    return $this->_get_value("8");
  }
  function set_countdown($value)
  {
    return $this->_set_value("8", $value);
  }
  function gamecode()
  {
    return $this->_get_value("9");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("9", $value);
  }
}
class AddSystemBroadcastReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "GameServerSetBroadcast";
    $this->values["1"] = "";
  }
  function broadcastinfo()
  {
    return $this->_get_value("1");
  }
  function set_broadcastinfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GameServerDisconnectLoginServer extends PBMessage
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
  }
  function time()
  {
    return $this->_get_value("1");
  }
  function set_time($value)
  {
    return $this->_set_value("1", $value);
  }
  function code()
  {
    return $this->_get_value("2");
  }
  function set_code($value)
  {
    return $this->_set_value("2", $value);
  }
  function check()
  {
    return $this->_get_value("3");
  }
  function set_check($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerQueryOnlineUserAmount extends PBMessage
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
  }
  function game()
  {
    return $this->_get_value("1");
  }
  function set_game($value)
  {
    return $this->_set_value("1", $value);
  }
  function blind()
  {
    return $this->_get_value("2");
  }
  function set_blind($value)
  {
    return $this->_set_value("2", $value);
  }
  function online()
  {
    return $this->_get_value("3");
  }
  function set_online($value)
  {
    return $this->_set_value("3", $value);
  }
}
class AndroidJNIResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
  }
  function key()
  {
    return $this->_get_value("1");
  }
  function set_key($value)
  {
    return $this->_set_value("1", $value);
  }
  function value1()
  {
    return $this->_get_value("2");
  }
  function set_value1($value)
  {
    return $this->_set_value("2", $value);
  }
  function value2()
  {
    return $this->_get_value("3");
  }
  function set_value2($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerKickOnlineUser extends PBMessage
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
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function key()
  {
    return $this->_get_value("2");
  }
  function set_key($value)
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
class GameServerSwitchDB extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function hash()
  {
    return $this->_get_value("1");
  }
  function set_hash($value)
  {
    return $this->_set_value("1", $value);
  }
  function token()
  {
    return $this->_get_value("2");
  }
  function set_token($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServerAdWallAddChips extends PBMessage
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
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function chips()
  {
    return $this->_get_value("2");
  }
  function set_chips($value)
  {
    return $this->_set_value("2", $value);
  }
  function str()
  {
    return $this->_get_value("3");
  }
  function set_str($value)
  {
    return $this->_set_value("3", $value);
  }
  function token()
  {
    return $this->_get_value("4");
  }
  function set_token($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerUserPurchaseUpdate extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumUserPurchaseCategory";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumUserPurchaseResult";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function category()
  {
    return $this->_get_value("1");
  }
  function set_category($value)
  {
    return $this->_set_value("1", $value);
  }
  function result()
  {
    return $this->_get_value("2");
  }
  function set_result($value)
  {
    return $this->_set_value("2", $value);
  }
  function finalamount()
  {
    return $this->_get_value("3");
  }
  function set_finalamount($value)
  {
    return $this->_set_value("3", $value);
  }
}
class ModifyUserInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "BasicUserInfo";
    $this->values["1"] = "";
    $this->fields["2"] = "DetailUserInfo";
    $this->values["2"] = "";
  }
  function basicUserInfo()
  {
    return $this->_get_value("1");
  }
  function set_basicUserInfo($value)
  {
    return $this->_set_value("1", $value);
  }
  function detailUserInfo()
  {
    return $this->_get_value("2");
  }
  function set_detailUserInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ModifyUserInfoRsp extends PBMessage
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
class SingleNotification extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
  }
  function notificationID()
  {
    return $this->_get_value("1");
  }
  function set_notificationID($value)
  {
    return $this->_set_value("1", $value);
  }
  function notificationTitle()
  {
    return $this->_get_value("2");
  }
  function set_notificationTitle($value)
  {
    return $this->_set_value("2", $value);
  }
  function notificationContent()
  {
    return $this->_get_value("3");
  }
  function set_notificationContent($value)
  {
    return $this->_set_value("3", $value);
  }
  function notificationAddTime()
  {
    return $this->_get_value("4");
  }
  function set_notificationAddTime($value)
  {
    return $this->_set_value("4", $value);
  }
  function notificationType()
  {
    return $this->_get_value("5");
  }
  function set_notificationType($value)
  {
    return $this->_set_value("5", $value);
  }
  function notificationGamecode()
  {
    return $this->_get_value("6");
  }
  function set_notificationGamecode($value)
  {
    return $this->_set_value("6", $value);
  }
}
class AddNotificationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SingleNotification";
    $this->values["1"] = "";
  }
  function notification()
  {
    return $this->_get_value("1");
  }
  function set_notification($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddNotificationRsp extends PBMessage
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
class DeleteNotificationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function notificationid()
  {
    return $this->_get_value("1");
  }
  function set_notificationid($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteNotificationRsp extends PBMessage
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
