<?php
class EnumLoginType extends PBEnum
{
  const enumLoginTypeToRegisterNewUser  = 0;
  const enumLoginTypeGuestAccount  = 1;
  const enumLoginTypeRegisterAccount  = 2;
}
class EnumGameType extends PBEnum
{
  const enumGameTypeUnknown  = 0x0000;
  const enumGameTypeTexasPokerPuTong  = 0x0001;
  const enumGameTypeTexasPokerJiaBei  = 0x0002;
  const enumGameTypeTexasPokerHuanLe  = 0x0003;
  const enumGameTypeNiuNiu  = 0x0011;
  const enumGameTypeNiuNiuQiangZhuang  = 0x0012;
  const enumGameTypeNiuNiuXueZhanDaoDi  = 0x0013;
  const enumGameTypeBaccarat  = 0x0021;
  const enumGameTypeZhaJinHua  = 0x0031;
  const enumGameTypeSlots  = 0x0041;
  const enumGameTypeRoulette  = 0x0051;
  const enumGameTypeDouDiZhu  = 0x0061;
  const enumGameTypeDouDiZhuHuanLe  = 0x0062;
  const enumGameTypeBlackJack  = 0x0071;
  const enumGameTypeStud  = 0x0081;
  const enumGameTypeGuanDan  = 0x0091;
  const enumGameTypeShiSanZhang  = 0x00A1;
}
class EnumGender extends PBEnum
{
  const enumGenderFemale  = 0;
  const enumGenderMale  = 1;
  const enumGenderUnknown  = 2;
}
class EnumDeviceType extends PBEnum
{
  const enumDeviceTypeiPhone  = 0;
  const enumDeviceTypeiPad  = 1;
  const enumDeviceTypeAndroid  = 2;
  const enumDeviceTypeWindows  = 3;
}
class EnumLoginResult extends PBEnum
{
  const enumLoginResultSucc  = 0;
  const enumLoginResultAccountNotExist  = 1;
  const enumLoginResultWrongPassword  = 2;
  const enumRegisterResultSucc  = 3;
  const enumRegisterResultAlreadyExist  = 4;
  const enumRegisterResultDatabaseError  = 5;
  const enumBlackIP  = 6;
  const enumBlackMac  = 7;
  const enumBlackUserID  = 8;
  const enumMax  = 9;
}
class EnumVIPLevel extends PBEnum
{
  const enumVIPLevelNone  = 0;
  const enumVIPLevelSilver  = 1;
  const enumVIPLevelGold  = 2;
  const enumVIPLevelPlatinum  = 3;
  const enumVIPLevelDiamond  = 4;
}
class EnumFuncCardType extends PBEnum
{
  const enumFuncCardKickUserFromTable  = 0;
}
class EnumNewVersion extends PBEnum
{
  const enumUpdateTipNoNewVersion  = 0;
  const enumUpdateTipHasNewVersion  = 1;
  const enumUpdateTipHasNewVersionMandatoryUpdate  = 2;
}
class EnumFeedBackOperation extends PBEnum
{
  const enumFeedBackOpen  = 0;
  const enumFeedBackClose  = 1;
}
/*
class EnumGameType extends PBEnum
{
  const enumGameTypeUnknown  = 0x0000;
  const enumGameTypeTexasPokerPuTong  = 0x0001;
  const enumGameTypeTexasPokerJiaBei  = 0x0002;
  const enumGameTypeTexasPokerHuanLe  = 0x0003;
  const enumGameTypeNiuNiu  = 0x0011;
  const enumGameTypeNiuNiuQiangZhuang  = 0x0012;
  const enumGameTypeNiuNiuXueZhanDaoDi  = 0x0013;
  const enumGameTypeBaccarat  = 0x0021;
  const enumGameTypeZhaJinHua  = 0x0031;
  const enumGameTypeSlots  = 0x0041;
  const enumGameTypeRoulette  = 0x0051;
  const enumGameTypeDouDiZhu  = 0x0061;
  const enumGameTypeDouDiZhuHuanLe  = 0x0062;
  const enumGameTypeBlackJack  = 0x0071;
  const enumGameTypeStud  = 0x0081;
  const enumGameTypeGuanDan  = 0x0091;
  const enumGameTypeShiSanZhang  = 0x00A1;
}
 * 
 */
class EnumGameTypeStatus extends PBEnum
{
  const enumGameTypeStatusAvailable  = 0;
  const enumGameTypeStatusComingSoon  = 1;
  const enumGameTypeStatusComingHot  = 2;
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
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "EnumVIPLevel";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
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
  function userID()
  {
    return $this->_get_value("5");
  }
  function set_userID($value)
  {
    return $this->_set_value("5", $value);
  }
  function vipLevel()
  {
    return $this->_get_value("6");
  }
  function set_vipLevel($value)
  {
    return $this->_set_value("6", $value);
  }
  function vipBonusChips()
  {
    return $this->_get_value("7");
  }
  function set_vipBonusChips($value)
  {
    return $this->_set_value("7", $value);
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
    $this->fields["18"] = "PBString";
    $this->values["18"] = "";
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
  function mobilenumber()
  {
    return $this->_get_value("18");
  }
  function set_mobilenumber($value)
  {
    return $this->_set_value("18", $value);
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
    $this->fields["16"] = "PBInt";
    $this->values["16"] = "";
    $this->fields["17"] = "PBInt";
    $this->values["17"] = "";
    $this->fields["18"] = "ChipsBonusInfo";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
    $this->fields["20"] = "EnumFeedBackOperation";
    $this->values["20"] = "";
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
  function bonusinfo()
  {
    return $this->_get_value("18");
  }
  function set_bonusinfo($value)
  {
    return $this->_set_value("18", $value);
  }
  function speakerCount()
  {
    return $this->_get_value("19");
  }
  function set_speakerCount($value)
  {
    return $this->_set_value("19", $value);
  }
  function feedback()
  {
    return $this->_get_value("20");
  }
  function set_feedback($value)
  {
    return $this->_set_value("20", $value);
  }
}
?>