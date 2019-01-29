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
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
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
  function gameserverconnectionid()
  {
    return $this->_get_value("5");
  }
  function set_gameserverconnectionid($value)
  {
    return $this->_set_value("5", $value);
  }
  function targettype()
  {
    return $this->_get_value("6");
  }
  function set_targettype($value)
  {
    return $this->_set_value("6", $value);
  }
  function userID()
  {
    return $this->_get_value("7");
  }
  function set_userID($value)
  {
    return $this->_set_value("7", $value);
  }
  function selftype()
  {
    return $this->_get_value("8");
  }
  function set_selftype($value)
  {
    return $this->_set_value("8", $value);
  }
}
class EnumFuncCardType extends PBEnum
{
  const enumFuncCardKickUserFromTable  = 0;
}
class EnumLanguageType extends PBEnum
{
  const enumLanguageTypeEnglish  = 0;
  const enumLanguageTypeZhcn  = 1;
  const enumLanguageTypeFrench  = 2;
  const enumLanguageTypeItalian  = 3;
  const enumLanguageTypeGerman  = 4;
  const enumLanguageTypeSpanish  = 5;
  const enumLanguageTypeRussian  = 6;
  const enumLanguageTypeKorean  = 7;
  const enumLanguageTypeZhtw  = 8;
}
class EnumSysNotificationType extends PBEnum
{
  const enumSysNotificationNormal  = 0;
  const enumSysNotificationImportant  = 1;
}
class EnumSysActivityType extends PBEnum
{
  const enumActivityNormal  = 0;
  const enumActivityImportant  = 1;
}
class EnumSysActivityExpiredType extends PBEnum
{
  const enumActivityNotExpired  = 0;
  const enumActivityExpired  = 1;
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
class EnumIdentity extends PBEnum
{
  const enumIdentityRose  = 0;
  const enumIdentityTulip  = 1;
  const enumIdentityPeony  = 2;
  const enumIdentityBLUELOVER  = 3;
}
class EnumXiaoLaBaNotifyType extends PBEnum
{
  const enumXiaoLaBaNotifyTypePay  = 0;
  const enumXiaoLaBaNotifyTypeCardType  = 1;
  const enumXiaoLaBaNotifyTypePlayGame  = 2;
  const enumXiaoLaBaNotifyTypePlayRoulette  = 3;
}
class EnumGameLevel extends PBEnum
{
  const enumGameLevelChuJi  = 0;
  const enumGameLevelZhongJi  = 1;
  const enumGameLevelGaoJi  = 2;
  const enumGameLevelFuHao  = 3;
}
class EnumLoginType extends PBEnum
{
  const enumLoginTypeToRegisterNewUser  = 0;
  const enumLoginTypeGuestAccount  = 1;
  const enumLoginTypeRegisterAccount  = 2;
}
class EnumVIPLevel extends PBEnum
{
  const enumVIPLevelNone  = 0;
  const enumVIPLevelSilver  = 1;
  const enumVIPLevelGold  = 2;
  const enumVIPLevelPlatinum  = 3;
  const enumVIPLevelDiamond  = 4;
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
class EnumExchangeStatus extends PBEnum
{
  const enumExchangeStatus_Submited  = 0;
  const enumExchangeStatus_Done  = 1;
  const enumExchangeStatus_Failed  = 2;
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
  const enumChangeTotalScorePresentProperty  = 4;
  const enumChangeTotalScoreBonus  = 5;
  const enumChangeTotalScoreSellProperty  = 6;
  const enumChangeTotalScoreShutdownOldConnection  = 7;
  const enumChangeTotalScoreOnlineReward  = 8;
  const enumChangeTotalScoreTableReward  = 9;
  const enumRoulette  = 10;
  const enumSlotsReward  = 11;
  const enumChangeTotalScoreReasonZhaJinHuaXiQian  = 12;
  const enumChangeTotalScoreBuySpeaker  = 13;
  const enumChangeTotalScoreTax  = 14;
  const enumChangeTotalScoreSetPaySucc  = 15;
  const enumChangeTotalScoreSetQueryUserInfo  = 16;
  const enumChangeTotalScoreSetRobot  = 17;
  const enumChangeTotalScoreMinusPresentChipsInGameServer  = 18;
  const enumChangeTotalScoreDisconnect  = 19;
  const enumChangeTotalScoreLogin  = 20;
  const enumChangeTotalScoreMissionReward  = 21;
}
class EnumBroadcastEventType extends PBEnum
{
  const enumBroadcastEventTypeAddNotification  = 0;
  const enumBroadcastEventTypeDelNotification  = 1;
  const enumBroadcastEventTypeAddActivity  = 2;
  const enumBroadcastEventTypeDelActivity  = 3;
  const enumBroadcastEventTypePopNotification  = 4;
  const enumBroadcastEventTypePopActivity  = 5;
  const enumBroadcastEventTypeFeedBackOpen  = 6;
  const enumBroadcastEventTypeFeedBackClose  = 7;
  const enumBroadcastEventTypeExchangeProductStockChange  = 8;
}
class EnumFeedBackOperation extends PBEnum
{
  const enumFeedBackOpen  = 0;
  const enumFeedBackClose  = 1;
}
class EnumZhajinhuaCardType extends PBEnum
{
  const enumZhajinhuaCardTypeSingle  = 1;
  const enumZhajinhuaCardTypeDouble  = 2;
  const enumZhajinhuaCardTypeShunZi  = 3;
  const enumZhajinhuaCardTypeJinHua  = 4;
  const enumZhajinhuaCardTypeShunJin  = 5;
  const enumZhajinhuaCardTypeBaoZi  = 6;
  const enumZhajinhuaCardTypeSpecial  = 7;
}
class EnumFeedBackSwitch extends PBEnum
{
  const enumFeedBackSwitch_Close  = 0;
  const enumFeedBackSwitch_Open  = 1;
}
class EnumDailyMissionType extends PBEnum
{
  const enumDailyMissionType_GameTurnSum  = 0;
  const enumDailyMissionType_EnterRoom  = 1;
  const enumDailyMissionType_ContinuousWinTime  = 2;
}
class EnumExchangeProductType extends PBEnum
{
  const enumExchangeProductType_Card  = 0;
  const enumExchangeProductType_Real  = 1;
  const enumExchangeProductType_Game  = 2;
}
class EnumCardStatus extends PBEnum
{
  const enumCardStatus_NotUsed  = 0;
  const enumCardStatus_Used  = 1;
}
class EnumSystemMissionType extends PBEnum
{
  const enumSystemMissionType_UploadPic  = 0;
  const enumSystemMissionType_Buy  = 1;
  const enumSystemMissionType_Competition  = 2;
  const enumSystemMissionType_GameTurnSum  = 3;
  const enumSystemMissionType_Exchange  = 4;
}
class EnumMissionStatus extends PBEnum
{
  const enumMissionStatus_Unfinished  = 0;
  const enumMissionStatus_Finished  = 1;
  const enumMissionStatus_Finished_And_Got_Reward  = 2;
}
class EnumProductFrontShow extends PBEnum
{
  const enumProductFrontShow_Not  = 0;
  const enumProductFrontShow_Yes  = 1;
}
class EnumSelfExchangeProductType extends PBEnum
{
  const enumSelfExchangeProductType_Chip  = 1;
  const enumSelfExchangeProductType_Speaker  = 2;
  const enumSelfExchangeProductType_VIPSilver  = 3;
}
class EnumExchangeProductStatus extends PBEnum
{
  const enumExchangeProductStatus_Effective  = 1;
  const enumExchangeProductStatus_Invalid  = 2;
}
class FlagInfo extends PBMessage
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
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
  }
  function flagID()
  {
    return $this->_get_value("1");
  }
  function set_flagID($value)
  {
    return $this->_set_value("1", $value);
  }
  function flagPurview()
  {
    return $this->_get_value("2");
  }
  function set_flagPurview($value)
  {
    return $this->_set_value("2", $value);
  }
  function flagImg()
  {
    return $this->_get_value("3");
  }
  function set_flagImg($value)
  {
    return $this->_set_value("3", $value);
  }
  function flagName()
  {
    return $this->_get_value("4");
  }
  function set_flagName($value)
  {
    return $this->_set_value("4", $value);
  }
  function flagEffectiveDay()
  {
    return $this->_get_value("5");
  }
  function set_flagEffectiveDay($value)
  {
    return $this->_set_value("5", $value);
  }
  function flagPrice()
  {
    return $this->_get_value("6");
  }
  function set_flagPrice($value)
  {
    return $this->_set_value("6", $value);
  }
  function timeAddedToUser()
  {
    return $this->_get_value("7");
  }
  function set_timeAddedToUser($value)
  {
    return $this->_set_value("7", $value);
  }
  function flagImgInStore()
  {
    return $this->_get_value("8");
  }
  function set_flagImgInStore($value)
  {
    return $this->_set_value("8", $value);
  }
  function flagType()
  {
    return $this->_get_value("9");
  }
  function set_flagType($value)
  {
    return $this->_set_value("9", $value);
  }
}
class FlagInfos extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["11"] = "FlagInfo";
    $this->values["11"] = array();
  }
  function flags($offset)
  {
    return $this->_get_arr_value("11", $offset);
  }
  function add_flags()
  {
    return $this->_add_arr_value("11");
  }
  function set_flags($index, $value)
  {
    $this->_set_arr_value("11", $index, $value);
  }
  function remove_last_flags()
  {
    $this->_remove_last_arr_value("11");
  }
  function flags_size()
  {
    return $this->_get_arr_size("11");
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
    $this->fields["10"] = "EnumIdentity";
    $this->values["10"] = array();
    $this->fields["11"] = "FlagInfos";
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
  function identity($offset)
  {
    $v = $this->_get_arr_value("10", $offset);
    return $v->get_value();
  }
  function append_identity($value)
  {
    $v = $this->_add_arr_value("10");
    $v->set_value($value);
  }
  function set_identity($index, $value)
  {
    $v = new $this->fields["10"]();
    $v->set_value($value);
    $this->_set_arr_value("10", $index, $v);
  }
  function remove_last_identity()
  {
    $this->_remove_last_arr_value("10");
  }
  function identity_size()
  {
    return $this->_get_arr_size("10");
  }
  function flags()
  {
    return $this->_get_value("11");
  }
  function set_flags($value)
  {
    return $this->_set_value("11", $value);
  }
  function coupon()
  {
    return $this->_get_value("12");
  }
  function set_coupon($value)
  {
    return $this->_set_value("12", $value);
  }
  function gameTurnSum()
  {
    return $this->_get_value("13");
  }
  function set_gameTurnSum($value)
  {
    return $this->_set_value("13", $value);
  }
  function continuousWinTime()
  {
    return $this->_get_value("14");
  }
  function set_continuousWinTime($value)
  {
    return $this->_set_value("14", $value);
  }
  function totalBuy()
  {
    return $this->_get_value("15");
  }
  function set_totalBuy($value)
  {
    return $this->_set_value("15", $value);
  }
  function totalGameTurnSum()
  {
    return $this->_get_value("16");
  }
  function set_totalGameTurnSum($value)
  {
    return $this->_set_value("16", $value);
  }
  function rewardGameTurnSum()
  {
    return $this->_get_value("17");
  }
  function set_rewardGameTurnSum($value)
  {
    return $this->_set_value("17", $value);
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
    $this->fields["30"] = "PBInt";
    $this->values["30"] = "";
    $this->fields["31"] = "PBInt";
    $this->values["31"] = "";
    $this->fields["32"] = "PBInt";
    $this->values["32"] = "";
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
  function selfpooltotalwin()
  {
    return $this->_get_value("30");
  }
  function set_selfpooltotalwin($value)
  {
    return $this->_set_value("30", $value);
  }
  function selfpooltotalcost()
  {
    return $this->_get_value("31");
  }
  function set_selfpooltotalcost($value)
  {
    return $this->_set_value("31", $value);
  }
  function selfpooltotalgametime()
  {
    return $this->_get_value("32");
  }
  function set_selfpooltotalgametime($value)
  {
    return $this->_set_value("32", $value);
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
  const enumUserInfoFieldNameMobileNumber  = 6;
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
class EnumChatType extends PBEnum
{
  const enumChatTypeText  = 0;
  const enumChatTypeEmotion  = 1;
  const enumChatTypeShortcut  = 2;
  const enumChatTypeVoice  = 3;
}
class EnumMissionType extends PBEnum
{
  const enumMissionTypeDaily  = 0;
  const enumMissionTypeSystem  = 1;
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
    $this->fields["18"] = "PBString";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
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
  function channelid()
  {
    return $this->_get_value("19");
  }
  function set_channelid($value)
  {
    return $this->_set_value("19", $value);
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
class GameServerTableChat extends PBMessage
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
    $this->fields["4"] = "EnumChatType";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
  }
  function tableID()
  {
    return $this->_get_value("1");
  }
  function set_tableID($value)
  {
    return $this->_set_value("1", $value);
  }
  function senderUserID()
  {
    return $this->_get_value("2");
  }
  function set_senderUserID($value)
  {
    return $this->_set_value("2", $value);
  }
  function senderSeatID()
  {
    return $this->_get_value("3");
  }
  function set_senderSeatID($value)
  {
    return $this->_set_value("3", $value);
  }
  function chatType()
  {
    return $this->_get_value("4");
  }
  function set_chatType($value)
  {
    return $this->_set_value("4", $value);
  }
  function msg()
  {
    return $this->_get_value("5");
  }
  function set_msg($value)
  {
    return $this->_set_value("5", $value);
  }
  function senderNick()
  {
    return $this->_get_value("6");
  }
  function set_senderNick($value)
  {
    return $this->_set_value("6", $value);
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
  function baseScore()
  {
    return $this->_get_value("2");
  }
  function set_baseScore($value)
  {
    return $this->_set_value("2", $value);
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
class GameServerSearchUserRequest extends PBMessage
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
class GameServerSearchUserResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "BasicUserInfo";
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
  function basicUserInfo()
  {
    return $this->_get_value("3");
  }
  function set_basicUserInfo($value)
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
class GamerServerChangeScoreWithOldConnection extends PBMessage
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
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
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
  function score()
  {
    return $this->_get_value("10");
  }
  function set_score($value)
  {
    return $this->_set_value("10", $value);
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
class AddFriendRequest extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
    $this->fields["5"] = "BasicUserInfo";
    $this->values["5"] = "";
  }
  function userIDAdd()
  {
    return $this->_get_value("1");
  }
  function set_userIDAdd($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDAdded()
  {
    return $this->_get_value("2");
  }
  function set_userIDAdded($value)
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
  function userInfoAdd()
  {
    return $this->_get_value("4");
  }
  function set_userInfoAdd($value)
  {
    return $this->_set_value("4", $value);
  }
  function userInfoAdded()
  {
    return $this->_get_value("5");
  }
  function set_userInfoAdded($value)
  {
    return $this->_set_value("5", $value);
  }
}
class AcceptFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "BasicUserInfo";
    $this->values["3"] = "";
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
  }
  function userIDAccept()
  {
    return $this->_get_value("1");
  }
  function set_userIDAccept($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDAccepted()
  {
    return $this->_get_value("2");
  }
  function set_userIDAccepted($value)
  {
    return $this->_set_value("2", $value);
  }
  function userInfoAccept()
  {
    return $this->_get_value("3");
  }
  function set_userInfoAccept($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfoAccepted()
  {
    return $this->_get_value("4");
  }
  function set_userInfoAccepted($value)
  {
    return $this->_set_value("4", $value);
  }
}
class AcceptFriendResponse extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
    $this->fields["5"] = "BasicUserInfo";
    $this->values["5"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDAccept()
  {
    return $this->_get_value("2");
  }
  function set_userIDAccept($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDAccepted()
  {
    return $this->_get_value("3");
  }
  function set_userIDAccepted($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfoAccept()
  {
    return $this->_get_value("4");
  }
  function set_userInfoAccept($value)
  {
    return $this->_set_value("4", $value);
  }
  function userInfoAccepted()
  {
    return $this->_get_value("5");
  }
  function set_userInfoAccepted($value)
  {
    return $this->_set_value("5", $value);
  }
}
class RejectFriendRequest extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
    $this->fields["5"] = "BasicUserInfo";
    $this->values["5"] = "";
  }
  function userIDReject()
  {
    return $this->_get_value("1");
  }
  function set_userIDReject($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDRejected()
  {
    return $this->_get_value("2");
  }
  function set_userIDRejected($value)
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
  function userInfoReject()
  {
    return $this->_get_value("4");
  }
  function set_userInfoReject($value)
  {
    return $this->_set_value("4", $value);
  }
  function userInfoRejected()
  {
    return $this->_get_value("5");
  }
  function set_userInfoRejected($value)
  {
    return $this->_set_value("5", $value);
  }
}
class RemoveFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "BasicUserInfo";
    $this->values["3"] = "";
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
  }
  function userIDRemove()
  {
    return $this->_get_value("1");
  }
  function set_userIDRemove($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDRemoved()
  {
    return $this->_get_value("2");
  }
  function set_userIDRemoved($value)
  {
    return $this->_set_value("2", $value);
  }
  function userInfoRemove()
  {
    return $this->_get_value("3");
  }
  function set_userInfoRemove($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfoRemoved()
  {
    return $this->_get_value("4");
  }
  function set_userInfoRemoved($value)
  {
    return $this->_set_value("4", $value);
  }
}
class RemoveFriendResponse extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
    $this->fields["5"] = "BasicUserInfo";
    $this->values["5"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDRemove()
  {
    return $this->_get_value("2");
  }
  function set_userIDRemove($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDRemoved()
  {
    return $this->_get_value("3");
  }
  function set_userIDRemoved($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfoRemove()
  {
    return $this->_get_value("4");
  }
  function set_userInfoRemove($value)
  {
    return $this->_set_value("4", $value);
  }
  function userInfoRemoved()
  {
    return $this->_get_value("5");
  }
  function set_userInfoRemoved($value)
  {
    return $this->_set_value("5", $value);
  }
}
class RemoveFriendBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "BasicUserInfo";
    $this->values["3"] = "";
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = "";
  }
  function userIDRemove()
  {
    return $this->_get_value("1");
  }
  function set_userIDRemove($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDRemoved()
  {
    return $this->_get_value("2");
  }
  function set_userIDRemoved($value)
  {
    return $this->_set_value("2", $value);
  }
  function userInfoRemove()
  {
    return $this->_get_value("3");
  }
  function set_userInfoRemove($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfoRemoved()
  {
    return $this->_get_value("4");
  }
  function set_userInfoRemoved($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GetAddFriendRequestListRequest extends PBMessage
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GetAddFriendRequestListResponse extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = array();
    $this->fields["5"] = "PBBool";
    $this->values["5"] = "";
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
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfos($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_userInfos()
  {
    return $this->_add_arr_value("4");
  }
  function set_userInfos($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_userInfos()
  {
    $this->_remove_last_arr_value("4");
  }
  function userInfos_size()
  {
    return $this->_get_arr_size("4");
  }
  function end()
  {
    return $this->_get_value("5");
  }
  function set_end($value)
  {
    return $this->_set_value("5", $value);
  }
}
class GetFriendListRequest extends PBMessage
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GetFriendListResponse extends PBMessage
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
    $this->fields["4"] = "BasicUserInfo";
    $this->values["4"] = array();
    $this->fields["5"] = "PBBool";
    $this->values["5"] = "";
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
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function userInfos($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_userInfos()
  {
    return $this->_add_arr_value("4");
  }
  function set_userInfos($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_userInfos()
  {
    $this->_remove_last_arr_value("4");
  }
  function userInfos_size()
  {
    return $this->_get_arr_size("4");
  }
  function end()
  {
    return $this->_get_value("5");
  }
  function set_end($value)
  {
    return $this->_set_value("5", $value);
  }
}
class SingleChatMsg extends PBMessage
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
    $this->fields["5"] = "BasicUserInfo";
    $this->values["5"] = "";
    $this->fields["6"] = "BasicUserInfo";
    $this->values["6"] = "";
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function msg()
  {
    return $this->_get_value("3");
  }
  function set_msg($value)
  {
    return $this->_set_value("3", $value);
  }
  function timestamp()
  {
    return $this->_get_value("4");
  }
  function set_timestamp($value)
  {
    return $this->_set_value("4", $value);
  }
  function userInfoFrom()
  {
    return $this->_get_value("5");
  }
  function set_userInfoFrom($value)
  {
    return $this->_set_value("5", $value);
  }
  function userInfoTo()
  {
    return $this->_get_value("6");
  }
  function set_userInfoTo($value)
  {
    return $this->_set_value("6", $value);
  }
}
class GetOfflineMsgRequest extends PBMessage
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GetOfflineMsgResponse extends PBMessage
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
    $this->fields["4"] = "SingleChatMsg";
    $this->values["4"] = array();
    $this->fields["5"] = "PBBool";
    $this->values["5"] = "";
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
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function msgs($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_msgs()
  {
    return $this->_add_arr_value("4");
  }
  function set_msgs($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_msgs()
  {
    $this->_remove_last_arr_value("4");
  }
  function msgs_size()
  {
    return $this->_get_arr_size("4");
  }
  function end()
  {
    return $this->_get_value("5");
  }
  function set_end($value)
  {
    return $this->_set_value("5", $value);
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
class AddSystemBroadcastRsp extends PBMessage
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
class DeleteSystemBroadcastReq extends PBMessage
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
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function broadcastid()
  {
    return $this->_get_value("2");
  }
  function set_broadcastid($value)
  {
    return $this->_set_value("2", $value);
  }
}
class DeleteSystemBroadcastRsp extends PBMessage
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
class AddOnceBroadcastReq extends PBMessage
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
class AddOnceBroadcastRsp extends PBMessage
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
class GameServerPresentScoreRequest extends PBMessage
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
    $this->fields["4"] = "EnumGameType";
    $this->values["4"] = "";
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function score()
  {
    return $this->_get_value("3");
  }
  function set_score($value)
  {
    return $this->_set_value("3", $value);
  }
  function gameType()
  {
    return $this->_get_value("4");
  }
  function set_gameType($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerPresentScoreResponse extends PBMessage
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
    $this->fields["4"] = "EnumGameType";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDFrom()
  {
    return $this->_get_value("2");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("3");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("3", $value);
  }
  function gameType()
  {
    return $this->_get_value("4");
  }
  function set_gameType($value)
  {
    return $this->_set_value("4", $value);
  }
  function scoreFrom()
  {
    return $this->_get_value("5");
  }
  function set_scoreFrom($value)
  {
    return $this->_set_value("5", $value);
  }
  function scoreTo()
  {
    return $this->_get_value("6");
  }
  function set_scoreTo($value)
  {
    return $this->_set_value("6", $value);
  }
}
class PropertyInfo extends PBMessage
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
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function name()
  {
    return $this->_get_value("2");
  }
  function set_name($value)
  {
    return $this->_set_value("2", $value);
  }
  function price()
  {
    return $this->_get_value("3");
  }
  function set_price($value)
  {
    return $this->_set_value("3", $value);
  }
  function picurl()
  {
    return $this->_get_value("4");
  }
  function set_picurl($value)
  {
    return $this->_set_value("4", $value);
  }
  function type()
  {
    return $this->_get_value("5");
  }
  function set_type($value)
  {
    return $this->_set_value("5", $value);
  }
  function sellpercentage()
  {
    return $this->_get_value("6");
  }
  function set_sellpercentage($value)
  {
    return $this->_set_value("6", $value);
  }
}
class QueryUserPropertyReq extends PBMessage
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class QueryUserPropertyRsp extends PBMessage
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
    $this->fields["4"] = "PropertyInfo";
    $this->values["4"] = array();
    $this->fields["5"] = "PBBool";
    $this->values["5"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
  function userID()
  {
    return $this->_get_value("3");
  }
  function set_userID($value)
  {
    return $this->_set_value("3", $value);
  }
  function properties($offset)
  {
    return $this->_get_arr_value("4", $offset);
  }
  function add_properties()
  {
    return $this->_add_arr_value("4");
  }
  function set_properties($index, $value)
  {
    $this->_set_arr_value("4", $index, $value);
  }
  function remove_last_properties()
  {
    $this->_remove_last_arr_value("4");
  }
  function properties_size()
  {
    return $this->_get_arr_size("4");
  }
  function end()
  {
    return $this->_get_value("5");
  }
  function set_end($value)
  {
    return $this->_set_value("5", $value);
  }
}
class BuyPropertyReq extends PBMessage
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
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function propertyID()
  {
    return $this->_get_value("3");
  }
  function set_propertyID($value)
  {
    return $this->_set_value("3", $value);
  }
  function price()
  {
    return $this->_get_value("4");
  }
  function set_price($value)
  {
    return $this->_set_value("4", $value);
  }
}
class BuyPropertyRsp extends PBMessage
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
    $this->fields["5"] = "PropertyInfo";
    $this->values["5"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDFrom()
  {
    return $this->_get_value("2");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("3");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("3", $value);
  }
  function subscore()
  {
    return $this->_get_value("4");
  }
  function set_subscore($value)
  {
    return $this->_set_value("4", $value);
  }
  function properyInfo()
  {
    return $this->_get_value("5");
  }
  function set_properyInfo($value)
  {
    return $this->_set_value("5", $value);
  }
}
class SellPropertyReq extends PBMessage
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
  function propertyID()
  {
    return $this->_get_value("2");
  }
  function set_propertyID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SellPropertyRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
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
  function addscore()
  {
    return $this->_get_value("3");
  }
  function set_addscore($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GiftInfo extends PBMessage
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
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function name()
  {
    return $this->_get_value("2");
  }
  function set_name($value)
  {
    return $this->_set_value("2", $value);
  }
  function price()
  {
    return $this->_get_value("3");
  }
  function set_price($value)
  {
    return $this->_set_value("3", $value);
  }
  function picurl()
  {
    return $this->_get_value("4");
  }
  function set_picurl($value)
  {
    return $this->_set_value("4", $value);
  }
  function type()
  {
    return $this->_get_value("5");
  }
  function set_type($value)
  {
    return $this->_set_value("5", $value);
  }
}
class BuyGiftRequest extends PBMessage
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
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function giftID()
  {
    return $this->_get_value("3");
  }
  function set_giftID($value)
  {
    return $this->_set_value("3", $value);
  }
  function price()
  {
    return $this->_get_value("4");
  }
  function set_price($value)
  {
    return $this->_set_value("4", $value);
  }
}
class BuyGiftResponse extends PBMessage
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
    $this->fields["4"] = "GiftInfo";
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
  function userIDFrom()
  {
    return $this->_get_value("2");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("3");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("3", $value);
  }
  function giftInfo()
  {
    return $this->_get_value("4");
  }
  function set_giftInfo($value)
  {
    return $this->_set_value("4", $value);
  }
}
class QueryGiftInfoByIDRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function giftID()
  {
    return $this->_get_value("1");
  }
  function set_giftID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryGiftInfoByIDResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "GiftInfo";
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
  function giftID()
  {
    return $this->_get_value("2");
  }
  function set_giftID($value)
  {
    return $this->_set_value("2", $value);
  }
  function giftInfo()
  {
    return $this->_get_value("3");
  }
  function set_giftInfo($value)
  {
    return $this->_set_value("3", $value);
  }
}
class ModifyPropertyRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PropertyInfo";
    $this->values["1"] = "";
  }
  function property()
  {
    return $this->_get_value("1");
  }
  function set_property($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyPropertyResponse extends PBMessage
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
class DelPropertyRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function propertyid()
  {
    return $this->_get_value("1");
  }
  function set_propertyid($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DelPropertyResponse extends PBMessage
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
class ModifyGiftRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "GiftInfo";
    $this->values["1"] = "";
  }
  function gift()
  {
    return $this->_get_value("1");
  }
  function set_gift($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyGiftResponse extends PBMessage
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
class DelGiftRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function giftid()
  {
    return $this->_get_value("1");
  }
  function set_giftid($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DelGiftResponse extends PBMessage
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
class SwitchDispatchRequest extends PBMessage
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
class SwitchDispatchResponse extends PBMessage
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
class QuerytAllBroadcastRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function sessionID()
  {
    return $this->_get_value("1");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QuerytAllBroadcastResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "GameServerSetBroadcast";
    $this->values["3"] = array();
    $this->fields["4"] = "PBBool";
    $this->values["4"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
  function broadcasts($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_broadcasts()
  {
    return $this->_add_arr_value("3");
  }
  function set_broadcasts($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_broadcasts()
  {
    $this->_remove_last_arr_value("3");
  }
  function broadcasts_size()
  {
    return $this->_get_arr_size("3");
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
  }
}
class OnlineRewardDefine extends PBMessage
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
  function time()
  {
    return $this->_get_value("1");
  }
  function set_time($value)
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
class OnlineRewardRequest extends PBMessage
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
class OnlineRewardResponse extends PBMessage
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
  function reward()
  {
    return $this->_get_value("3");
  }
  function set_reward($value)
  {
    return $this->_set_value("3", $value);
  }
}
class TableRewardPoolInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function score()
  {
    return $this->_get_value("1");
  }
  function set_score($value)
  {
    return $this->_set_value("1", $value);
  }
}
class TableReward extends PBMessage
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
  function scoreAdd()
  {
    return $this->_get_value("2");
  }
  function set_scoreAdd($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SubSpeakerRequest extends PBMessage
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
  function speakernumtosub()
  {
    return $this->_get_value("2");
  }
  function set_speakernumtosub($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SubSpeakerResponse extends PBMessage
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
class StartRouletteRequest extends PBMessage
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
  function costchips()
  {
    return $this->_get_value("2");
  }
  function set_costchips($value)
  {
    return $this->_set_value("2", $value);
  }
  function gamecode()
  {
    return $this->_get_value("3");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("3", $value);
  }
}
class StartRouletteResponse extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function costchips()
  {
    return $this->_get_value("2");
  }
  function set_costchips($value)
  {
    return $this->_set_value("2", $value);
  }
  function winchips()
  {
    return $this->_get_value("3");
  }
  function set_winchips($value)
  {
    return $this->_set_value("3", $value);
  }
  function userID()
  {
    return $this->_get_value("4");
  }
  function set_userID($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GetNotificationRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumSysNotificationType";
    $this->values["2"] = "";
    $this->fields["3"] = "EnumLanguageType";
    $this->values["3"] = "";
  }
  function sessionID()
  {
    return $this->_get_value("1");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("1", $value);
  }
  function notificationType()
  {
    return $this->_get_value("2");
  }
  function set_notificationType($value)
  {
    return $this->_set_value("2", $value);
  }
  function notificationLanguageType()
  {
    return $this->_get_value("3");
  }
  function set_notificationLanguageType($value)
  {
    return $this->_set_value("3", $value);
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
    $this->fields["5"] = "EnumSysNotificationType";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "EnumLanguageType";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBInt";
    $this->values["11"] = "";
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
  function notificationLanguageType()
  {
    return $this->_get_value("7");
  }
  function set_notificationLanguageType($value)
  {
    return $this->_set_value("7", $value);
  }
  function notificationSummary()
  {
    return $this->_get_value("8");
  }
  function set_notificationSummary($value)
  {
    return $this->_set_value("8", $value);
  }
  function notificationForcePopTime()
  {
    return $this->_get_value("9");
  }
  function set_notificationForcePopTime($value)
  {
    return $this->_set_value("9", $value);
  }
  function notificationForcePopTimeInt()
  {
    return $this->_get_value("10");
  }
  function set_notificationForcePopTimeInt($value)
  {
    return $this->_set_value("10", $value);
  }
  function bNotified()
  {
    return $this->_get_value("11");
  }
  function set_bNotified($value)
  {
    return $this->_set_value("11", $value);
  }
}
class GetNotificationResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "SingleNotification";
    $this->values["3"] = array();
    $this->fields["4"] = "PBBool";
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
  function notifications($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_notifications()
  {
    return $this->_add_arr_value("3");
  }
  function set_notifications($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_notifications()
  {
    $this->_remove_last_arr_value("3");
  }
  function notifications_size()
  {
    return $this->_get_arr_size("3");
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
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
  function notificationID()
  {
    return $this->_get_value("1");
  }
  function set_notificationID($value)
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
class AddNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SingleNotification";
    $this->values["1"] = array();
  }
  function notification($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_notification()
  {
    return $this->_add_arr_value("1");
  }
  function set_notification($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_notification()
  {
    $this->_remove_last_arr_value("1");
  }
  function notification_size()
  {
    return $this->_get_arr_size("1");
  }
}
class DeleteNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = array();
  }
  function notificationID($offset)
  {
    $v = $this->_get_arr_value("1", $offset);
    return $v->get_value();
  }
  function append_notificationID($value)
  {
    $v = $this->_add_arr_value("1");
    $v->set_value($value);
  }
  function set_notificationID($index, $value)
  {
    $v = new $this->fields["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_notificationID()
  {
    $this->_remove_last_arr_value("1");
  }
  function notificationID_size()
  {
    return $this->_get_arr_size("1");
  }
}
class ForcePopNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = array();
  }
  function notificationID($offset)
  {
    $v = $this->_get_arr_value("1", $offset);
    return $v->get_value();
  }
  function append_notificationID($value)
  {
    $v = $this->_add_arr_value("1");
    $v->set_value($value);
  }
  function set_notificationID($index, $value)
  {
    $v = new $this->fields["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_notificationID()
  {
    $this->_remove_last_arr_value("1");
  }
  function notificationID_size()
  {
    return $this->_get_arr_size("1");
  }
}
class GetActivityRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumLanguageType";
    $this->values["2"] = "";
  }
  function sessionID()
  {
    return $this->_get_value("1");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("1", $value);
  }
  function activityLanguageType()
  {
    return $this->_get_value("2");
  }
  function set_activityLanguageType($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SingleActivity extends PBMessage
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
    $this->fields["5"] = "EnumSysActivityType";
    $this->values["5"] = "";
    $this->fields["6"] = "EnumSysActivityExpiredType";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
    $this->fields["9"] = "EnumLanguageType";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
    $this->fields["11"] = "PBString";
    $this->values["11"] = "";
    $this->fields["12"] = "PBString";
    $this->values["12"] = "";
    $this->fields["13"] = "PBInt";
    $this->values["13"] = "";
    $this->fields["14"] = "PBInt";
    $this->values["14"] = "";
  }
  function activityID()
  {
    return $this->_get_value("1");
  }
  function set_activityID($value)
  {
    return $this->_set_value("1", $value);
  }
  function activityTitle()
  {
    return $this->_get_value("2");
  }
  function set_activityTitle($value)
  {
    return $this->_set_value("2", $value);
  }
  function activityContent()
  {
    return $this->_get_value("3");
  }
  function set_activityContent($value)
  {
    return $this->_set_value("3", $value);
  }
  function activityAddTime()
  {
    return $this->_get_value("4");
  }
  function set_activityAddTime($value)
  {
    return $this->_set_value("4", $value);
  }
  function activityType()
  {
    return $this->_get_value("5");
  }
  function set_activityType($value)
  {
    return $this->_set_value("5", $value);
  }
  function activityExpired()
  {
    return $this->_get_value("6");
  }
  function set_activityExpired($value)
  {
    return $this->_set_value("6", $value);
  }
  function activityPicUrl()
  {
    return $this->_get_value("7");
  }
  function set_activityPicUrl($value)
  {
    return $this->_set_value("7", $value);
  }
  function activityGamecode()
  {
    return $this->_get_value("8");
  }
  function set_activityGamecode($value)
  {
    return $this->_set_value("8", $value);
  }
  function activityLanguageType()
  {
    return $this->_get_value("9");
  }
  function set_activityLanguageType($value)
  {
    return $this->_set_value("9", $value);
  }
  function activitySummary()
  {
    return $this->_get_value("10");
  }
  function set_activitySummary($value)
  {
    return $this->_set_value("10", $value);
  }
  function activityExpiredTime()
  {
    return $this->_get_value("11");
  }
  function set_activityExpiredTime($value)
  {
    return $this->_set_value("11", $value);
  }
  function activityAutoInvalidTime()
  {
    return $this->_get_value("12");
  }
  function set_activityAutoInvalidTime($value)
  {
    return $this->_set_value("12", $value);
  }
  function activityExpiredTimeInt()
  {
    return $this->_get_value("13");
  }
  function set_activityExpiredTimeInt($value)
  {
    return $this->_set_value("13", $value);
  }
  function activityAutoInvalidTimeInt()
  {
    return $this->_get_value("14");
  }
  function set_activityAutoInvalidTimeInt($value)
  {
    return $this->_set_value("14", $value);
  }
}
class GetActivityResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "SingleActivity";
    $this->values["3"] = array();
    $this->fields["4"] = "PBBool";
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
  function activities($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_activities()
  {
    return $this->_add_arr_value("3");
  }
  function set_activities($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_activities()
  {
    $this->_remove_last_arr_value("3");
  }
  function activities_size()
  {
    return $this->_get_arr_size("3");
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
  }
}
class AddActivityReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SingleActivity";
    $this->values["1"] = "";
  }
  function activity()
  {
    return $this->_get_value("1");
  }
  function set_activity($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddActivityRsp extends PBMessage
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
class DeleteActivityReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function activityID()
  {
    return $this->_get_value("1");
  }
  function set_activityID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteActivityRsp extends PBMessage
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
class AddActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SingleActivity";
    $this->values["1"] = array();
  }
  function activity($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_activity()
  {
    return $this->_add_arr_value("1");
  }
  function set_activity($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_activity()
  {
    $this->_remove_last_arr_value("1");
  }
  function activity_size()
  {
    return $this->_get_arr_size("1");
  }
}
class DeleteActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = array();
  }
  function activityID($offset)
  {
    $v = $this->_get_arr_value("1", $offset);
    return $v->get_value();
  }
  function append_activityID($value)
  {
    $v = $this->_add_arr_value("1");
    $v->set_value($value);
  }
  function set_activityID($index, $value)
  {
    $v = new $this->fields["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_activityID()
  {
    $this->_remove_last_arr_value("1");
  }
  function activityID_size()
  {
    return $this->_get_arr_size("1");
  }
}
class ForcePopActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = array();
  }
  function activityID($offset)
  {
    $v = $this->_get_arr_value("1", $offset);
    return $v->get_value();
  }
  function append_activityID($value)
  {
    $v = $this->_add_arr_value("1");
    $v->set_value($value);
  }
  function set_activityID($index, $value)
  {
    $v = new $this->fields["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_activityID()
  {
    $this->_remove_last_arr_value("1");
  }
  function activityID_size()
  {
    return $this->_get_arr_size("1");
  }
}
class BuySpeakerReq extends PBMessage
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
  function speakerNum()
  {
    return $this->_get_value("2");
  }
  function set_speakerNum($value)
  {
    return $this->_set_value("2", $value);
  }
  function totalPrice()
  {
    return $this->_get_value("3");
  }
  function set_totalPrice($value)
  {
    return $this->_set_value("3", $value);
  }
}
class BuySpeakerRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
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
  function subscore()
  {
    return $this->_get_value("3");
  }
  function set_subscore($value)
  {
    return $this->_set_value("3", $value);
  }
}
class KickUserFromTableRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumGameType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function userIDKicked()
  {
    return $this->_get_value("1");
  }
  function set_userIDKicked($value)
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
  function tableID()
  {
    return $this->_get_value("3");
  }
  function set_tableID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class KickUserFromTableResponse extends PBMessage
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
    $this->fields["4"] = "EnumGameType";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDKick()
  {
    return $this->_get_value("2");
  }
  function set_userIDKick($value)
  {
    return $this->_set_value("2", $value);
  }
  function userIDKicked()
  {
    return $this->_get_value("3");
  }
  function set_userIDKicked($value)
  {
    return $this->_set_value("3", $value);
  }
  function gameType()
  {
    return $this->_get_value("4");
  }
  function set_gameType($value)
  {
    return $this->_set_value("4", $value);
  }
  function tableID()
  {
    return $this->_get_value("5");
  }
  function set_tableID($value)
  {
    return $this->_set_value("5", $value);
  }
}
class ExchangeToolRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
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
  function productID()
  {
    return $this->_get_value("2");
  }
  function set_productID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ExchangeToolResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumResult";
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
class EnumTaskCategory extends PBEnum
{
  const enumTaskCategoryContinousWin  = 1;
  const enumTaskCategoryGetOneCardType  = 2;
  const enumTaskCategoryPlaySomeCards  = 3;
  const enumTaskCategoryPlaySomeCardsAndWin  = 4;
}
class EnumTaskRewardType extends PBEnum
{
  const enumTaskRewardTypeChips  = 1;
  const enumTaskRewardTypeYuanBao  = 2;
}
class TaskProperty extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumTaskCategory";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function taskCategory()
  {
    return $this->_get_value("1");
  }
  function set_taskCategory($value)
  {
    return $this->_set_value("1", $value);
  }
  function cards($offset)
  {
    $v = $this->_get_arr_value("2", $offset);
    return $v->get_value();
  }
  function append_cards($value)
  {
    $v = $this->_add_arr_value("2");
    $v->set_value($value);
  }
  function set_cards($index, $value)
  {
    $v = new $this->fields["2"]();
    $v->set_value($value);
    $this->_set_arr_value("2", $index, $v);
  }
  function remove_last_cards()
  {
    $this->_remove_last_arr_value("2");
  }
  function cards_size()
  {
    return $this->_get_arr_size("2");
  }
  function todoCount()
  {
    return $this->_get_value("3");
  }
  function set_todoCount($value)
  {
    return $this->_set_value("3", $value);
  }
  function todoCardType()
  {
    return $this->_get_value("4");
  }
  function set_todoCardType($value)
  {
    return $this->_set_value("4", $value);
  }
}
class TaskToDoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "TaskProperty";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumTaskRewardType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function taskProperty()
  {
    return $this->_get_value("1");
  }
  function set_taskProperty($value)
  {
    return $this->_set_value("1", $value);
  }
  function rewardType()
  {
    return $this->_get_value("2");
  }
  function set_rewardType($value)
  {
    return $this->_set_value("2", $value);
  }
  function rewardCount()
  {
    return $this->_get_value("3");
  }
  function set_rewardCount($value)
  {
    return $this->_set_value("3", $value);
  }
}
class TaskFinishNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "TaskProperty";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumTaskRewardType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function taskProperty()
  {
    return $this->_get_value("1");
  }
  function set_taskProperty($value)
  {
    return $this->_set_value("1", $value);
  }
  function rewardType()
  {
    return $this->_get_value("2");
  }
  function set_rewardType($value)
  {
    return $this->_set_value("2", $value);
  }
  function rewardCount()
  {
    return $this->_get_value("3");
  }
  function set_rewardCount($value)
  {
    return $this->_set_value("3", $value);
  }
  function userID()
  {
    return $this->_get_value("4");
  }
  function set_userID($value)
  {
    return $this->_set_value("4", $value);
  }
}
class AddFlagReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "FlagInfo";
    $this->values["1"] = "";
  }
  function flag()
  {
    return $this->_get_value("1");
  }
  function set_flag($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddFlagRsp extends PBMessage
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
class DeleteFlagReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function flagID()
  {
    return $this->_get_value("1");
  }
  function set_flagID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteFlagRsp extends PBMessage
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
class AddFlagForUserReq extends PBMessage
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
  function flagID()
  {
    return $this->_get_value("1");
  }
  function set_flagID($value)
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
}
class AddFlagForUserRsp extends PBMessage
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
class FeedBackOperationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumFeedBackOperation";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function operation()
  {
    return $this->_get_value("1");
  }
  function set_operation($value)
  {
    return $this->_set_value("1", $value);
  }
  function startTime()
  {
    return $this->_get_value("2");
  }
  function set_startTime($value)
  {
    return $this->_set_value("2", $value);
  }
  function endTime()
  {
    return $this->_get_value("3");
  }
  function set_endTime($value)
  {
    return $this->_set_value("3", $value);
  }
  function gamecode()
  {
    return $this->_get_value("4");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("4", $value);
  }
}
class FeedBackOperationRsp extends PBMessage
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
class ServerClientBroadcastData extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumBroadcastEventType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function broadcastEventType()
  {
    return $this->_get_value("1");
  }
  function set_broadcastEventType($value)
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
class XiaoLaBaNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumXiaoLaBaNotifyType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
  }
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function type()
  {
    return $this->_get_value("2");
  }
  function set_type($value)
  {
    return $this->_set_value("2", $value);
  }
  function value()
  {
    return $this->_get_value("3");
  }
  function set_value($value)
  {
    return $this->_set_value("3", $value);
  }
  function userID()
  {
    return $this->_get_value("4");
  }
  function set_userID($value)
  {
    return $this->_set_value("4", $value);
  }
  function nickName()
  {
    return $this->_get_value("5");
  }
  function set_nickName($value)
  {
    return $this->_set_value("5", $value);
  }
  function baseScore()
  {
    return $this->_get_value("6");
  }
  function set_baseScore($value)
  {
    return $this->_set_value("6", $value);
  }
}
class SpeakerAutoSendConfigInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
    $this->fields["3"] = "EnumZhajinhuaCardType";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
  }
  function msgBuyThreshold()
  {
    return $this->_get_value("1");
  }
  function set_msgBuyThreshold($value)
  {
    return $this->_set_value("1", $value);
  }
  function commonBuyThreshold()
  {
    return $this->_get_value("2");
  }
  function set_commonBuyThreshold($value)
  {
    return $this->_set_value("2", $value);
  }
  function zhaJinHuaCardTypeThreshold()
  {
    return $this->_get_value("3");
  }
  function set_zhaJinHuaCardTypeThreshold($value)
  {
    return $this->_set_value("3", $value);
  }
  function singleTurnWinThreshold()
  {
    return $this->_get_value("4");
  }
  function set_singleTurnWinThreshold($value)
  {
    return $this->_set_value("4", $value);
  }
  function rouletteWinThreshold()
  {
    return $this->_get_value("5");
  }
  function set_rouletteWinThreshold($value)
  {
    return $this->_set_value("5", $value);
  }
  function tableRewardThreshold()
  {
    return $this->_get_value("6");
  }
  function set_tableRewardThreshold($value)
  {
    return $this->_set_value("6", $value);
  }
}
class GetSpeakerAutoSendConfigReq extends PBMessage
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
class GetSpeakerAutoSendConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "SpeakerAutoSendConfigInfo";
    $this->values["2"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function configInfo()
  {
    return $this->_get_value("2");
  }
  function set_configInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ModifySpeakerAutoSendConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SpeakerAutoSendConfigInfo";
    $this->values["1"] = "";
  }
  function configInfo()
  {
    return $this->_get_value("1");
  }
  function set_configInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifySpeakerAutoSendConfigRsp extends PBMessage
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
class ModifySpeakerAutoSendConfigNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SpeakerAutoSendConfigInfo";
    $this->values["1"] = "";
  }
  function configInfo()
  {
    return $this->_get_value("1");
  }
  function set_configInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class RoomInfo extends PBMessage
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
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
  }
  function roomid()
  {
    return $this->_get_value("1");
  }
  function set_roomid($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameCode()
  {
    return $this->_get_value("2");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("2", $value);
  }
  function roomName()
  {
    return $this->_get_value("3");
  }
  function set_roomName($value)
  {
    return $this->_set_value("3", $value);
  }
  function roomDes()
  {
    return $this->_get_value("4");
  }
  function set_roomDes($value)
  {
    return $this->_set_value("4", $value);
  }
  function roomFee()
  {
    return $this->_get_value("5");
  }
  function set_roomFee($value)
  {
    return $this->_set_value("5", $value);
  }
  function roomBaseScore()
  {
    return $this->_get_value("6");
  }
  function set_roomBaseScore($value)
  {
    return $this->_set_value("6", $value);
  }
  function roomMinScorePlay()
  {
    return $this->_get_value("7");
  }
  function set_roomMinScorePlay($value)
  {
    return $this->_set_value("7", $value);
  }
}
class GetRoomInfoReq extends PBMessage
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
class GetRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RoomInfo";
    $this->values["1"] = array();
  }
  function roomInfo($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_roomInfo()
  {
    return $this->_add_arr_value("1");
  }
  function set_roomInfo($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_roomInfo()
  {
    $this->_remove_last_arr_value("1");
  }
  function roomInfo_size()
  {
    return $this->_get_arr_size("1");
  }
}
class ModifyRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RoomInfo";
    $this->values["1"] = "";
  }
  function roomInfo()
  {
    return $this->_get_value("1");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyRoomInfoRsp extends PBMessage
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
class AddRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RoomInfo";
    $this->values["1"] = "";
  }
  function roomInfo()
  {
    return $this->_get_value("1");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddRoomInfoRsp extends PBMessage
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
class DeleteRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteRoomInfoRsp extends PBMessage
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
class ModifyRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RoomInfo";
    $this->values["1"] = "";
  }
  function roomInfo()
  {
    return $this->_get_value("1");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RoomInfo";
    $this->values["1"] = "";
  }
  function roomInfo()
  {
    return $this->_get_value("1");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class CommonConfigInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumFeedBackSwitch";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
    $this->values["7"] = "";
  }
  function feedBackSwitch()
  {
    return $this->_get_value("1");
  }
  function set_feedBackSwitch($value)
  {
    return $this->_set_value("1", $value);
  }
  function feedBackStartTime()
  {
    return $this->_get_value("2");
  }
  function set_feedBackStartTime($value)
  {
    return $this->_set_value("2", $value);
  }
  function feedBackEndTime()
  {
    return $this->_get_value("3");
  }
  function set_feedBackEndTime($value)
  {
    return $this->_set_value("3", $value);
  }
  function feedBackStartTimeInt()
  {
    return $this->_get_value("4");
  }
  function set_feedBackStartTimeInt($value)
  {
    return $this->_set_value("4", $value);
  }
  function feedBackEndTimeInt()
  {
    return $this->_get_value("5");
  }
  function set_feedBackEndTimeInt($value)
  {
    return $this->_set_value("5", $value);
  }
  function bStartNotified()
  {
    return $this->_get_value("6");
  }
  function set_bStartNotified($value)
  {
    return $this->_set_value("6", $value);
  }
  function bEndNotified()
  {
    return $this->_get_value("7");
  }
  function set_bEndNotified($value)
  {
    return $this->_set_value("7", $value);
  }
}
class GetCommonConfigReq extends PBMessage
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
class GetCommonConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "CommonConfigInfo";
    $this->values["1"] = "";
  }
  function configInfo()
  {
    return $this->_get_value("1");
  }
  function set_configInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyCommonConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "CommonConfigInfo";
    $this->values["1"] = "";
  }
  function configInfo()
  {
    return $this->_get_value("1");
  }
  function set_configInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyCommonConfigRsp extends PBMessage
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
class DailyMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumDailyMissionType";
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
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "EnumZhajinhuaCardType";
    $this->values["11"] = "";
    $this->fields["12"] = "PBInt";
    $this->values["12"] = "";
    $this->fields["13"] = "PBInt";
    $this->values["13"] = "";
    $this->fields["14"] = "PBInt";
    $this->values["14"] = "";
    $this->fields["15"] = "PBString";
    $this->values["15"] = "";
    $this->fields["16"] = "PBInt";
    $this->values["16"] = "";
    $this->fields["17"] = "PBString";
    $this->values["17"] = "";
    $this->fields["18"] = "PBString";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
    $this->fields["20"] = "FlagInfo";
    $this->values["20"] = "";
  }
  function dailyMissionID()
  {
    return $this->_get_value("1");
  }
  function set_dailyMissionID($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType()
  {
    return $this->_get_value("2");
  }
  function set_missionType($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameCode()
  {
    return $this->_get_value("3");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("3", $value);
  }
  function userLevelStart()
  {
    return $this->_get_value("4");
  }
  function set_userLevelStart($value)
  {
    return $this->_set_value("4", $value);
  }
  function userLevelEnd()
  {
    return $this->_get_value("5");
  }
  function set_userLevelEnd($value)
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
  function userServiceFee()
  {
    return $this->_get_value("7");
  }
  function set_userServiceFee($value)
  {
    return $this->_set_value("7", $value);
  }
  function gameLength()
  {
    return $this->_get_value("8");
  }
  function set_gameLength($value)
  {
    return $this->_set_value("8", $value);
  }
  function gameTurnSum()
  {
    return $this->_get_value("9");
  }
  function set_gameTurnSum($value)
  {
    return $this->_set_value("9", $value);
  }
  function continuousWinTime()
  {
    return $this->_get_value("10");
  }
  function set_continuousWinTime($value)
  {
    return $this->_set_value("10", $value);
  }
  function zjhCardType()
  {
    return $this->_get_value("11");
  }
  function set_zjhCardType($value)
  {
    return $this->_set_value("11", $value);
  }
  function userGetProbability()
  {
    return $this->_get_value("12");
  }
  function set_userGetProbability($value)
  {
    return $this->_set_value("12", $value);
  }
  function couponNum()
  {
    return $this->_get_value("13");
  }
  function set_couponNum($value)
  {
    return $this->_set_value("13", $value);
  }
  function chipNum()
  {
    return $this->_get_value("14");
  }
  function set_chipNum($value)
  {
    return $this->_set_value("14", $value);
  }
  function flagName()
  {
    return $this->_get_value("15");
  }
  function set_flagName($value)
  {
    return $this->_set_value("15", $value);
  }
  function flagValidDay()
  {
    return $this->_get_value("16");
  }
  function set_flagValidDay($value)
  {
    return $this->_set_value("16", $value);
  }
  function missionName()
  {
    return $this->_get_value("17");
  }
  function set_missionName($value)
  {
    return $this->_set_value("17", $value);
  }
  function missionDescription()
  {
    return $this->_get_value("18");
  }
  function set_missionDescription($value)
  {
    return $this->_set_value("18", $value);
  }
  function flagID()
  {
    return $this->_get_value("19");
  }
  function set_flagID($value)
  {
    return $this->_set_value("19", $value);
  }
  function flagInfo()
  {
    return $this->_get_value("20");
  }
  function set_flagInfo($value)
  {
    return $this->_set_value("20", $value);
  }
}
class DailyMissionStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "DailyMission";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumMissionStatus";
    $this->values["2"] = "";
  }
  function dailyMission()
  {
    return $this->_get_value("1");
  }
  function set_dailyMission($value)
  {
    return $this->_set_value("1", $value);
  }
  function status()
  {
    return $this->_get_value("2");
  }
  function set_status($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddDailyMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "DailyMission";
    $this->values["1"] = "";
  }
  function dailyMissionInfo()
  {
    return $this->_get_value("1");
  }
  function set_dailyMissionInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddDailyMissionRsp extends PBMessage
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
class DeleteDailyMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function dailyMissionID()
  {
    return $this->_get_value("1");
  }
  function set_dailyMissionID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteDailyMissionRsp extends PBMessage
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
class SystemMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumSystemMissionType";
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
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBInt";
    $this->values["11"] = "";
    $this->fields["12"] = "PBInt";
    $this->values["12"] = "";
    $this->fields["13"] = "PBString";
    $this->values["13"] = "";
    $this->fields["14"] = "PBInt";
    $this->values["14"] = "";
    $this->fields["15"] = "PBInt";
    $this->values["15"] = "";
    $this->fields["16"] = "PBInt";
    $this->values["16"] = "";
    $this->fields["17"] = "PBBool";
    $this->values["17"] = "";
    $this->fields["18"] = "PBInt";
    $this->values["18"] = "";
    $this->fields["19"] = "PBInt";
    $this->values["19"] = "";
    $this->fields["20"] = "PBBool";
    $this->values["20"] = "";
    $this->fields["21"] = "PBString";
    $this->values["21"] = "";
    $this->fields["22"] = "PBString";
    $this->values["22"] = "";
    $this->fields["23"] = "PBInt";
    $this->values["23"] = "";
    $this->fields["24"] = "FlagInfo";
    $this->values["24"] = "";
  }
  function systemMissionID()
  {
    return $this->_get_value("1");
  }
  function set_systemMissionID($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType()
  {
    return $this->_get_value("2");
  }
  function set_missionType($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameCode()
  {
    return $this->_get_value("3");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("3", $value);
  }
  function userLevelStart()
  {
    return $this->_get_value("4");
  }
  function set_userLevelStart($value)
  {
    return $this->_set_value("4", $value);
  }
  function userLevelEnd()
  {
    return $this->_get_value("5");
  }
  function set_userLevelEnd($value)
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
  function userServiceFee()
  {
    return $this->_get_value("7");
  }
  function set_userServiceFee($value)
  {
    return $this->_set_value("7", $value);
  }
  function gameLength()
  {
    return $this->_get_value("8");
  }
  function set_gameLength($value)
  {
    return $this->_set_value("8", $value);
  }
  function gameTurnSum()
  {
    return $this->_get_value("9");
  }
  function set_gameTurnSum($value)
  {
    return $this->_set_value("9", $value);
  }
  function userGetProbability()
  {
    return $this->_get_value("10");
  }
  function set_userGetProbability($value)
  {
    return $this->_set_value("10", $value);
  }
  function couponNum()
  {
    return $this->_get_value("11");
  }
  function set_couponNum($value)
  {
    return $this->_set_value("11", $value);
  }
  function chipNum()
  {
    return $this->_get_value("12");
  }
  function set_chipNum($value)
  {
    return $this->_set_value("12", $value);
  }
  function flagName()
  {
    return $this->_get_value("13");
  }
  function set_flagName($value)
  {
    return $this->_set_value("13", $value);
  }
  function flagValidDay()
  {
    return $this->_get_value("14");
  }
  function set_flagValidDay($value)
  {
    return $this->_set_value("14", $value);
  }
  function userBuyMin()
  {
    return $this->_get_value("15");
  }
  function set_userBuyMin($value)
  {
    return $this->_set_value("15", $value);
  }
  function userBuyMax()
  {
    return $this->_get_value("16");
  }
  function set_userBuyMax($value)
  {
    return $this->_set_value("16", $value);
  }
  function requireFirstBuy()
  {
    return $this->_get_value("17");
  }
  function set_requireFirstBuy($value)
  {
    return $this->_set_value("17", $value);
  }
  function userExchangeMin()
  {
    return $this->_get_value("18");
  }
  function set_userExchangeMin($value)
  {
    return $this->_set_value("18", $value);
  }
  function userExchangeMax()
  {
    return $this->_get_value("19");
  }
  function set_userExchangeMax($value)
  {
    return $this->_set_value("19", $value);
  }
  function requireFirstExchange()
  {
    return $this->_get_value("20");
  }
  function set_requireFirstExchange($value)
  {
    return $this->_set_value("20", $value);
  }
  function missionName()
  {
    return $this->_get_value("21");
  }
  function set_missionName($value)
  {
    return $this->_set_value("21", $value);
  }
  function missionDescription()
  {
    return $this->_get_value("22");
  }
  function set_missionDescription($value)
  {
    return $this->_set_value("22", $value);
  }
  function flagID()
  {
    return $this->_get_value("23");
  }
  function set_flagID($value)
  {
    return $this->_set_value("23", $value);
  }
  function flagInfo()
  {
    return $this->_get_value("24");
  }
  function set_flagInfo($value)
  {
    return $this->_set_value("24", $value);
  }
}
class SystemMissionStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SystemMission";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumMissionStatus";
    $this->values["2"] = "";
  }
  function systemMission()
  {
    return $this->_get_value("1");
  }
  function set_systemMission($value)
  {
    return $this->_set_value("1", $value);
  }
  function status()
  {
    return $this->_get_value("2");
  }
  function set_status($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddSystemMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "SystemMission";
    $this->values["1"] = "";
  }
  function systemMissionInfo()
  {
    return $this->_get_value("1");
  }
  function set_systemMissionInfo($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddSystemMissionRsp extends PBMessage
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
class DeleteSystemMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function systemMissionID()
  {
    return $this->_get_value("1");
  }
  function set_systemMissionID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteSystemMissionRsp extends PBMessage
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
class QueryMissionReq extends PBMessage
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
class QueryMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "DailyMissionStatus";
    $this->values["2"] = array();
    $this->fields["3"] = "SystemMissionStatus";
    $this->values["3"] = array();
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function dailyMissions($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_dailyMissions()
  {
    return $this->_add_arr_value("2");
  }
  function set_dailyMissions($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_dailyMissions()
  {
    $this->_remove_last_arr_value("2");
  }
  function dailyMissions_size()
  {
    return $this->_get_arr_size("2");
  }
  function systemMissions($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_systemMissions()
  {
    return $this->_add_arr_value("3");
  }
  function set_systemMissions($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_systemMissions()
  {
    $this->_remove_last_arr_value("3");
  }
  function systemMissions_size()
  {
    return $this->_get_arr_size("3");
  }
  function userID()
  {
    return $this->_get_value("4");
  }
  function set_userID($value)
  {
    return $this->_set_value("4", $value);
  }
}
class FinishMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "DailyMissionStatus";
    $this->values["2"] = array();
    $this->fields["3"] = "SystemMissionStatus";
    $this->values["3"] = array();
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function dailyMissions($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_dailyMissions()
  {
    return $this->_add_arr_value("2");
  }
  function set_dailyMissions($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_dailyMissions()
  {
    $this->_remove_last_arr_value("2");
  }
  function dailyMissions_size()
  {
    return $this->_get_arr_size("2");
  }
  function systemMissions($offset)
  {
    return $this->_get_arr_value("3", $offset);
  }
  function add_systemMissions()
  {
    return $this->_add_arr_value("3");
  }
  function set_systemMissions($index, $value)
  {
    $this->_set_arr_value("3", $index, $value);
  }
  function remove_last_systemMissions()
  {
    $this->_remove_last_arr_value("3");
  }
  function systemMissions_size()
  {
    return $this->_get_arr_size("3");
  }
}
class ModifyMissionParaReq extends PBMessage
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
  function addGameTurns()
  {
    return $this->_get_value("2");
  }
  function set_addGameTurns($value)
  {
    return $this->_set_value("2", $value);
  }
  function addContinuousWinTime()
  {
    return $this->_get_value("3");
  }
  function set_addContinuousWinTime($value)
  {
    return $this->_set_value("3", $value);
  }
}
class ModifyMissionParaRsp extends PBMessage
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
class ExchangeCardType extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function cardTypeID()
  {
    return $this->_get_value("1");
  }
  function set_cardTypeID($value)
  {
    return $this->_set_value("1", $value);
  }
  function cardName()
  {
    return $this->_get_value("2");
  }
  function set_cardName($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ExchangeProduct extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumExchangeProductType";
    $this->values["2"] = "";
    $this->fields["3"] = "PBString";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "ExchangeCardType";
    $this->values["7"] = "";
    $this->fields["8"] = "EnumProductFrontShow";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBInt";
    $this->values["10"] = "";
    $this->fields["11"] = "PBInt";
    $this->values["11"] = "";
    $this->fields["12"] = "PBInt";
    $this->values["12"] = "";
    $this->fields["13"] = "EnumExchangeProductStatus";
    $this->values["13"] = "";
  }
  function productID()
  {
    return $this->_get_value("1");
  }
  function set_productID($value)
  {
    return $this->_set_value("1", $value);
  }
  function productType()
  {
    return $this->_get_value("2");
  }
  function set_productType($value)
  {
    return $this->_set_value("2", $value);
  }
  function productName()
  {
    return $this->_get_value("3");
  }
  function set_productName($value)
  {
    return $this->_set_value("3", $value);
  }
  function couponNum()
  {
    return $this->_get_value("4");
  }
  function set_couponNum($value)
  {
    return $this->_set_value("4", $value);
  }
  function productStock()
  {
    return $this->_get_value("5");
  }
  function set_productStock($value)
  {
    return $this->_set_value("5", $value);
  }
  function productPicUrl()
  {
    return $this->_get_value("6");
  }
  function set_productPicUrl($value)
  {
    return $this->_set_value("6", $value);
  }
  function cardType()
  {
    return $this->_get_value("7");
  }
  function set_cardType($value)
  {
    return $this->_set_value("7", $value);
  }
  function productFrontShow()
  {
    return $this->_get_value("8");
  }
  function set_productFrontShow($value)
  {
    return $this->_set_value("8", $value);
  }
  function selfExchangeProductid()
  {
    return $this->_get_value("9");
  }
  function set_selfExchangeProductid($value)
  {
    return $this->_set_value("9", $value);
  }
  function gamecode()
  {
    return $this->_get_value("10");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("10", $value);
  }
  function isTryLuckyProduct()
  {
    return $this->_get_value("11");
  }
  function set_isTryLuckyProduct($value)
  {
    return $this->_set_value("11", $value);
  }
  function getProductNum()
  {
    return $this->_get_value("12");
  }
  function set_getProductNum($value)
  {
    return $this->_set_value("12", $value);
  }
  function productStatus()
  {
    return $this->_get_value("13");
  }
  function set_productStatus($value)
  {
    return $this->_set_value("13", $value);
  }
}
class SingleCardInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "ExchangeCardType";
    $this->values["2"] = "";
    $this->fields["3"] = "EnumCardStatus";
    $this->values["3"] = "";
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
  }
  function cardID()
  {
    return $this->_get_value("1");
  }
  function set_cardID($value)
  {
    return $this->_set_value("1", $value);
  }
  function cardType()
  {
    return $this->_get_value("2");
  }
  function set_cardType($value)
  {
    return $this->_set_value("2", $value);
  }
  function cardStatus()
  {
    return $this->_get_value("3");
  }
  function set_cardStatus($value)
  {
    return $this->_set_value("3", $value);
  }
  function cardSN()
  {
    return $this->_get_value("4");
  }
  function set_cardSN($value)
  {
    return $this->_set_value("4", $value);
  }
}
class AddExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "ExchangeProduct";
    $this->values["1"] = "";
  }
  function product()
  {
    return $this->_get_value("1");
  }
  function set_product($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddExchangeProductRsp extends PBMessage
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
class ModifyExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "ExchangeProduct";
    $this->values["1"] = "";
  }
  function product()
  {
    return $this->_get_value("1");
  }
  function set_product($value)
  {
    return $this->_set_value("1", $value);
  }
}
class ModifyExchangeProductRsp extends PBMessage
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
class DeleteExchangeProductReq extends PBMessage
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
  function productID()
  {
    return $this->_get_value("1");
  }
  function set_productID($value)
  {
    return $this->_set_value("1", $value);
  }
  function gamecode()
  {
    return $this->_get_value("2");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("2", $value);
  }
}
class DeleteExchangeProductRsp extends PBMessage
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
class QueryExchangeProductListReq extends PBMessage
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
  function gamecode()
  {
    return $this->_get_value("1");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("1", $value);
  }
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class QueryExchangeProductListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "ExchangeProduct";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBBool";
    $this->values["4"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function products($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_products()
  {
    return $this->_add_arr_value("2");
  }
  function set_products($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_products()
  {
    $this->_remove_last_arr_value("2");
  }
  function products_size()
  {
    return $this->_get_arr_size("2");
  }
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
  }
}
class ExchangeProductReq extends PBMessage
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
    $this->fields["4"] = "PBString";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function productID()
  {
    return $this->_get_value("2");
  }
  function set_productID($value)
  {
    return $this->_set_value("2", $value);
  }
  function gamecode()
  {
    return $this->_get_value("3");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("3", $value);
  }
  function userName()
  {
    return $this->_get_value("4");
  }
  function set_userName($value)
  {
    return $this->_set_value("4", $value);
  }
  function userIDCard()
  {
    return $this->_get_value("5");
  }
  function set_userIDCard($value)
  {
    return $this->_set_value("5", $value);
  }
  function userTel()
  {
    return $this->_get_value("6");
  }
  function set_userTel($value)
  {
    return $this->_set_value("6", $value);
  }
  function userAdress()
  {
    return $this->_get_value("7");
  }
  function set_userAdress($value)
  {
    return $this->_set_value("7", $value);
  }
}
class ExchangeProductRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function productCode()
  {
    return $this->_get_value("2");
  }
  function set_productCode($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ExchangeProductStockChangeNotify extends PBMessage
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
  function productID()
  {
    return $this->_get_value("1");
  }
  function set_productID($value)
  {
    return $this->_set_value("1", $value);
  }
  function newStock()
  {
    return $this->_get_value("2");
  }
  function set_newStock($value)
  {
    return $this->_set_value("2", $value);
  }
}
class SelfExchangeProductInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "EnumSelfExchangeProductType";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBString";
    $this->values["5"] = "";
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
  }
  function productID()
  {
    return $this->_get_value("1");
  }
  function set_productID($value)
  {
    return $this->_set_value("1", $value);
  }
  function productcode()
  {
    return $this->_get_value("2");
  }
  function set_productcode($value)
  {
    return $this->_set_value("2", $value);
  }
  function producttype()
  {
    return $this->_get_value("3");
  }
  function set_producttype($value)
  {
    return $this->_set_value("3", $value);
  }
  function gamecode()
  {
    return $this->_get_value("4");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("4", $value);
  }
  function productname()
  {
    return $this->_get_value("5");
  }
  function set_productname($value)
  {
    return $this->_set_value("5", $value);
  }
  function productPicurl()
  {
    return $this->_get_value("6");
  }
  function set_productPicurl($value)
  {
    return $this->_set_value("6", $value);
  }
}
class QueryTryLuckListReq extends PBMessage
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
  function gamecode()
  {
    return $this->_get_value("1");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("1", $value);
  }
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class QueryTryLuckListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "ExchangeProduct";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBBool";
    $this->values["4"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function products($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_products()
  {
    return $this->_add_arr_value("2");
  }
  function set_products($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_products()
  {
    $this->_remove_last_arr_value("2");
  }
  function products_size()
  {
    return $this->_get_arr_size("2");
  }
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
  }
}
class StartTryLuckReq extends PBMessage
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
  function gamecode()
  {
    return $this->_get_value("2");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("2", $value);
  }
  function costCouponNum()
  {
    return $this->_get_value("3");
  }
  function set_costCouponNum($value)
  {
    return $this->_set_value("3", $value);
  }
}
class StartTryLuckRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function resultProductID()
  {
    return $this->_get_value("2");
  }
  function set_resultProductID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class CouponChangeHis extends PBMessage
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
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "EnumExchangeProductType";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBString";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
    $this->fields["11"] = "PBString";
    $this->values["11"] = "";
    $this->fields["12"] = "EnumExchangeStatus";
    $this->values["12"] = "";
    $this->fields["13"] = "PBString";
    $this->values["13"] = "";
    $this->fields["14"] = "PBString";
    $this->values["14"] = "";
    $this->fields["15"] = "PBInt";
    $this->values["15"] = "";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function datetime()
  {
    return $this->_get_value("2");
  }
  function set_datetime($value)
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
  function changeNum()
  {
    return $this->_get_value("4");
  }
  function set_changeNum($value)
  {
    return $this->_set_value("4", $value);
  }
  function margin()
  {
    return $this->_get_value("5");
  }
  function set_margin($value)
  {
    return $this->_set_value("5", $value);
  }
  function productType()
  {
    return $this->_get_value("6");
  }
  function set_productType($value)
  {
    return $this->_set_value("6", $value);
  }
  function productCode()
  {
    return $this->_get_value("7");
  }
  function set_productCode($value)
  {
    return $this->_set_value("7", $value);
  }
  function userName()
  {
    return $this->_get_value("8");
  }
  function set_userName($value)
  {
    return $this->_set_value("8", $value);
  }
  function userIDCard()
  {
    return $this->_get_value("9");
  }
  function set_userIDCard($value)
  {
    return $this->_set_value("9", $value);
  }
  function userTel()
  {
    return $this->_get_value("10");
  }
  function set_userTel($value)
  {
    return $this->_set_value("10", $value);
  }
  function userAdress()
  {
    return $this->_get_value("11");
  }
  function set_userAdress($value)
  {
    return $this->_set_value("11", $value);
  }
  function status()
  {
    return $this->_get_value("12");
  }
  function set_status($value)
  {
    return $this->_set_value("12", $value);
  }
  function remark()
  {
    return $this->_get_value("13");
  }
  function set_remark($value)
  {
    return $this->_set_value("13", $value);
  }
  function orderNo()
  {
    return $this->_get_value("14");
  }
  function set_orderNo($value)
  {
    return $this->_set_value("14", $value);
  }
  function exchangeProductID()
  {
    return $this->_get_value("15");
  }
  function set_exchangeProductID($value)
  {
    return $this->_set_value("15", $value);
  }
}
class QueryCouponChangeHisReq extends PBMessage
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
  function sessionID()
  {
    return $this->_get_value("2");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class QueryCouponChangeHisRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "CouponChangeHis";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBBool";
    $this->values["4"] = "";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function changeHis($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_changeHis()
  {
    return $this->_add_arr_value("2");
  }
  function set_changeHis($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_changeHis()
  {
    $this->_remove_last_arr_value("2");
  }
  function changeHis_size()
  {
    return $this->_get_arr_size("2");
  }
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function end()
  {
    return $this->_get_value("4");
  }
  function set_end($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameLengthRewardStageInfo extends PBMessage
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
  function configID()
  {
    return $this->_get_value("1");
  }
  function set_configID($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomID()
  {
    return $this->_get_value("2");
  }
  function set_roomID($value)
  {
    return $this->_set_value("2", $value);
  }
  function stage()
  {
    return $this->_get_value("3");
  }
  function set_stage($value)
  {
    return $this->_set_value("3", $value);
  }
  function timeLength()
  {
    return $this->_get_value("4");
  }
  function set_timeLength($value)
  {
    return $this->_set_value("4", $value);
  }
  function rewardChip()
  {
    return $this->_get_value("5");
  }
  function set_rewardChip($value)
  {
    return $this->_set_value("5", $value);
  }
}
class GameLengthRewardRoomInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "GameLengthRewardStageInfo";
    $this->values["2"] = array();
  }
  function roomID()
  {
    return $this->_get_value("1");
  }
  function set_roomID($value)
  {
    return $this->_set_value("1", $value);
  }
  function stageConfigs($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_stageConfigs()
  {
    return $this->_add_arr_value("2");
  }
  function set_stageConfigs($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_stageConfigs()
  {
    $this->_remove_last_arr_value("2");
  }
  function stageConfigs_size()
  {
    return $this->_get_arr_size("2");
  }
}
class AddGameLengthRewardStageInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "GameLengthRewardStageInfo";
    $this->values["1"] = "";
  }
  function config()
  {
    return $this->_get_value("1");
  }
  function set_config($value)
  {
    return $this->_set_value("1", $value);
  }
}
class AddGameLengthRewardStageInfoRsp extends PBMessage
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
class DeleteGameLengthRewardStageInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function configID()
  {
    return $this->_get_value("1");
  }
  function set_configID($value)
  {
    return $this->_set_value("1", $value);
  }
}
class DeleteGameLengthRewardStageInfoRsp extends PBMessage
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
class QueryGameLengthRewardConfigReq extends PBMessage
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
class QueryGameLengthRewardConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "GameLengthRewardRoomInfo";
    $this->values["2"] = array();
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function configInfos($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_configInfos()
  {
    return $this->_add_arr_value("2");
  }
  function set_configInfos($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_configInfos()
  {
    $this->_remove_last_arr_value("2");
  }
  function configInfos_size()
  {
    return $this->_get_arr_size("2");
  }
}
class ClientGameServerMissionComplete extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumMissionType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function missionType()
  {
    return $this->_get_value("1");
  }
  function set_missionType($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionID()
  {
    return $this->_get_value("2");
  }
  function set_missionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ClientGameServerGetMissoinRewardRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumMissionType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBInt";
    $this->values["2"] = "";
  }
  function missionType()
  {
    return $this->_get_value("1");
  }
  function set_missionType($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionID()
  {
    return $this->_get_value("2");
  }
  function set_missionID($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ClientGameServerGetMissoinRewardResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumMissionType";
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
  function missionType()
  {
    return $this->_get_value("2");
  }
  function set_missionType($value)
  {
    return $this->_set_value("2", $value);
  }
  function missionID()
  {
    return $this->_get_value("3");
  }
  function set_missionID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class UserMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumMissionType";
    $this->values["2"] = "";
    $this->fields["3"] = "EnumMissionStatus";
    $this->values["3"] = "";
  }
  function missionID()
  {
    return $this->_get_value("1");
  }
  function set_missionID($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType()
  {
    return $this->_get_value("2");
  }
  function set_missionType($value)
  {
    return $this->_set_value("2", $value);
  }
  function missionStatus()
  {
    return $this->_get_value("3");
  }
  function set_missionStatus($value)
  {
    return $this->_set_value("3", $value);
  }
}
class PayRecordInfo extends PBMessage
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
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
    $this->fields["6"] = "PBInt";
    $this->values["6"] = "";
    $this->fields["7"] = "PBString";
    $this->values["7"] = "";
    $this->fields["8"] = "PBString";
    $this->values["8"] = "";
    $this->fields["9"] = "PBInt";
    $this->values["9"] = "";
    $this->fields["10"] = "PBString";
    $this->values["10"] = "";
    $this->fields["11"] = "PBInt";
    $this->values["11"] = "";
  }
  function paytype()
  {
    return $this->_get_value("1");
  }
  function set_paytype($value)
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
  function tradeno()
  {
    return $this->_get_value("3");
  }
  function set_tradeno($value)
  {
    return $this->_set_value("3", $value);
  }
  function gamecode()
  {
    return $this->_get_value("4");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("4", $value);
  }
  function platformid()
  {
    return $this->_get_value("5");
  }
  function set_platformid($value)
  {
    return $this->_set_value("5", $value);
  }
  function totalfee()
  {
    return $this->_get_value("6");
  }
  function set_totalfee($value)
  {
    return $this->_set_value("6", $value);
  }
  function productid()
  {
    return $this->_get_value("7");
  }
  function set_productid($value)
  {
    return $this->_set_value("7", $value);
  }
  function productdesc()
  {
    return $this->_get_value("8");
  }
  function set_productdesc($value)
  {
    return $this->_set_value("8", $value);
  }
  function recordfrom()
  {
    return $this->_get_value("9");
  }
  function set_recordfrom($value)
  {
    return $this->_set_value("9", $value);
  }
  function recordfromip()
  {
    return $this->_get_value("10");
  }
  function set_recordfromip($value)
  {
    return $this->_set_value("10", $value);
  }
  function channelid()
  {
    return $this->_get_value("11");
  }
  function set_channelid($value)
  {
    return $this->_set_value("11", $value);
  }
}
class InsertPayRecordReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PayRecordInfo";
    $this->values["1"] = "";
  }
  function info()
  {
    return $this->_get_value("1");
  }
  function set_info($value)
  {
    return $this->_set_value("1", $value);
  }
}
class InsertPayRecordRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function bsuccess()
  {
    return $this->_get_value("2");
  }
  function set_bsuccess($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GetUseridReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function email()
  {
    return $this->_get_value("1");
  }
  function set_email($value)
  {
    return $this->_set_value("1", $value);
  }
}
class GetUseridRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function email()
  {
    return $this->_get_value("2");
  }
  function set_email($value)
  {
    return $this->_set_value("2", $value);
  }
  function userID()
  {
    return $this->_get_value("3");
  }
  function set_userID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class AddIPBlackListReq extends PBMessage
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
  function userip()
  {
    return $this->_get_value("1");
  }
  function set_userip($value)
  {
    return $this->_set_value("1", $value);
  }
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddIPBlackListRsp extends PBMessage
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
class deleteIPBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function userip()
  {
    return $this->_get_value("1");
  }
  function set_userip($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteIPBlackListRsp extends PBMessage
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
class AddUserIDBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
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
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddUserIDBlackListRsp extends PBMessage
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
class deleteUserIDBlackListReq extends PBMessage
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
class deleteUserIDBlackListRsp extends PBMessage
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
class AddMACBlackListReq extends PBMessage
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
  function usermac()
  {
    return $this->_get_value("1");
  }
  function set_usermac($value)
  {
    return $this->_set_value("1", $value);
  }
  function describecontent()
  {
    return $this->_get_value("2");
  }
  function set_describecontent($value)
  {
    return $this->_set_value("2", $value);
  }
}
class AddMACBlackListRsp extends PBMessage
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
class deleteMACBlackListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
  }
  function usermac()
  {
    return $this->_get_value("1");
  }
  function set_usermac($value)
  {
    return $this->_set_value("1", $value);
  }
}
class deleteMACBlackListRsp extends PBMessage
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
class QueryBrokerageReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryBrokerageRsp extends PBMessage
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
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function brokerage()
  {
    return $this->_get_value("2");
  }
  function set_brokerage($value)
  {
    return $this->_set_value("2", $value);
  }
}
class RankingInfo extends PBMessage
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
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
  {
    return $this->_set_value("1", $value);
  }
  function account()
  {
    return $this->_get_value("2");
  }
  function set_account($value)
  {
    return $this->_set_value("2", $value);
  }
  function value()
  {
    return $this->_get_value("3");
  }
  function set_value($value)
  {
    return $this->_set_value("3", $value);
  }
}
class QueryRankingInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
  }
  function type()
  {
    return $this->_get_value("1");
  }
  function set_type($value)
  {
    return $this->_set_value("1", $value);
  }
}
class QueryRankingInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "RankingInfo";
    $this->values["2"] = array();
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function info($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_info()
  {
    return $this->_add_arr_value("2");
  }
  function set_info($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_info()
  {
    $this->_remove_last_arr_value("2");
  }
  function info_size()
  {
    return $this->_get_arr_size("2");
  }
}
class AddToolReq extends PBMessage
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
  function type()
  {
    return $this->_get_value("1");
  }
  function set_type($value)
  {
    return $this->_set_value("1", $value);
  }
  function num()
  {
    return $this->_get_value("2");
  }
  function set_num($value)
  {
    return $this->_set_value("2", $value);
  }
  function userID()
  {
    return $this->_get_value("3");
  }
  function set_userID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class AddToolRsp extends PBMessage
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
class ModifyBrokerageReq extends PBMessage
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
  function id()
  {
    return $this->_get_value("1");
  }
  function set_id($value)
  {
    return $this->_set_value("1", $value);
  }
  function brokerage()
  {
    return $this->_get_value("2");
  }
  function set_brokerage($value)
  {
    return $this->_set_value("2", $value);
  }
}
class ModifyBrokerageRsp extends PBMessage
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
class KickOffUserReq extends PBMessage
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
class KickOffUserRsp extends PBMessage
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
class MarkWeipaiSuccessReq extends PBMessage
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
  }
  function tradeno()
  {
    return $this->_get_value("1");
  }
  function set_tradeno($value)
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
  function totalfee()
  {
    return $this->_get_value("3");
  }
  function set_totalfee($value)
  {
    return $this->_set_value("3", $value);
  }
}
class MarkWeipaiSuccessRsp extends PBMessage
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
  const enumAddScoreType_BuySpeaker  = 9;
  const enumAddScoreType_ServiceFee  = 10;
  const enumAddScoreType_User_Disconnect  = 11;
  const enumAddScoreType_Mission_Reward  = 12;
  const enumAddScoreType_Channel = 20;
}
class EnumMidLayerBroadcastEventType extends PBEnum
{
  const enumBroadcastEventType_SpeakerConfigModify  = 1;
  const enumBroadcastEventType_AddRoomInfo  = 2;
  const enumBroadcastEventType_ModifyRoomInfo  = 3;
  const enumBroadcastEventType_DeleteRoomInfo  = 4;
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
    $this->fields["6"] = "PBString";
    $this->values["6"] = "";
    $this->fields["7"] = "PBInt";
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
    $this->fields["13"] = "PBString";
    $this->values["13"] = "";
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
  function ipAddress()
  {
    return $this->_get_value("6");
  }
  function set_ipAddress($value)
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
  function tableID()
  {
    return $this->_get_value("8");
  }
  function set_tableID($value)
  {
    return $this->_set_value("8", $value);
  }
  function seatID()
  {
    return $this->_get_value("9");
  }
  function set_seatID($value)
  {
    return $this->_set_value("9", $value);
  }
  function baseScore()
  {
    return $this->_get_value("10");
  }
  function set_baseScore($value)
  {
    return $this->_set_value("10", $value);
  }
  function playCountToday()
  {
    return $this->_get_value("11");
  }
  function set_playCountToday($value)
  {
    return $this->_set_value("11", $value);
  }
  function continuousWinCountToday()
  {
    return $this->_get_value("12");
  }
  function set_continuousWinCountToday($value)
  {
    return $this->_set_value("12", $value);
  }
  function channelid()
  {
  	return $this->_get_value("13");
  }
  function set_channelid($value)
  {
  	echo $value;
  	return $this->_set_value("13", $value);
  }
}
class GameServerMiddleLayerTurnInfoReport extends PBMessage
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
  function gameCode()
  {
    return $this->_get_value("1");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("1", $value);
  }
  function baseScore()
  {
    return $this->_get_value("2");
  }
  function set_baseScore($value)
  {
    return $this->_set_value("2", $value);
  }
  function totalGameLength()
  {
    return $this->_get_value("3");
  }
  function set_totalGameLength($value)
  {
    return $this->_set_value("3", $value);
  }
  function averageWaitTime()
  {
    return $this->_get_value("4");
  }
  function set_averageWaitTime($value)
  {
    return $this->_set_value("4", $value);
  }
  function turnServiceFee()
  {
    return $this->_get_value("5");
  }
  function set_turnServiceFee($value)
  {
    return $this->_set_value("5", $value);
  }
}
class AddFuncCard extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBInt";
    $this->values["1"] = "";
    $this->fields["2"] = "EnumFuncCardType";
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
  function cardType()
  {
    return $this->_get_value("2");
  }
  function set_cardType($value)
  {
    return $this->_set_value("2", $value);
  }
  function cardCountAdded()
  {
    return $this->_get_value("3");
  }
  function set_cardCountAdded($value)
  {
    return $this->_set_value("3", $value);
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
class RewardScoreCell extends PBMessage
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
  function connectionID()
  {
    return $this->_get_value("3");
  }
  function set_connectionID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServerMiddleLayerServerRewardScore extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "RewardScoreCell";
    $this->values["1"] = array();
  }
  function cells($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_cells()
  {
    return $this->_add_arr_value("1");
  }
  function set_cells($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_cells()
  {
    $this->_remove_last_arr_value("1");
  }
  function cells_size()
  {
    return $this->_get_arr_size("1");
  }
}
class GameServerMiddleLayerServerOnlineNumReport extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "PBString";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
    $this->fields["5"] = "PBInt";
    $this->values["5"] = "";
  }
  function server_ip()
  {
    return $this->_get_value("1");
  }
  function set_server_ip($value)
  {
    return $this->_set_value("1", $value);
  }
  function server_desc()
  {
    return $this->_get_value("2");
  }
  function set_server_desc($value)
  {
    return $this->_set_value("2", $value);
  }
  function server_membernum()
  {
    return $this->_get_value("3");
  }
  function set_server_membernum($value)
  {
    return $this->_set_value("3", $value);
  }
  function game_code()
  {
    return $this->_get_value("4");
  }
  function set_game_code($value)
  {
    return $this->_set_value("4", $value);
  }
  function server_type()
  {
    return $this->_get_value("5");
  }
  function set_server_type($value)
  {
    return $this->_set_value("5", $value);
  }
}
class GameServerMiddleLayerServerAddExperience extends PBMessage
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
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function experience()
  {
    return $this->_get_value("2");
  }
  function set_experience($value)
  {
    return $this->_set_value("2", $value);
  }
}
class PaySuccessNotify extends PBMessage
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
    $this->fields["5"] = "FuncCard";
    $this->values["5"] = array();
    $this->fields["6"] = "EnumIdentity";
    $this->values["6"] = array();
    $this->fields["7"] = "FlagInfos";
    $this->values["7"] = "";
    $this->fields["8"] = "PBInt";
    $this->values["8"] = "";
  }
  function userid()
  {
    return $this->_get_value("1");
  }
  function set_userid($value)
  {
    return $this->_set_value("1", $value);
  }
  function newScore()
  {
    return $this->_get_value("2");
  }
  function set_newScore($value)
  {
    return $this->_set_value("2", $value);
  }
  function newSpeakerCount()
  {
    return $this->_get_value("3");
  }
  function set_newSpeakerCount($value)
  {
    return $this->_set_value("3", $value);
  }
  function newVipLevel()
  {
    return $this->_get_value("4");
  }
  function set_newVipLevel($value)
  {
    return $this->_set_value("4", $value);
  }
  function funcCards($offset)
  {
    return $this->_get_arr_value("5", $offset);
  }
  function add_funcCards()
  {
    return $this->_add_arr_value("5");
  }
  function set_funcCards($index, $value)
  {
    $this->_set_arr_value("5", $index, $value);
  }
  function remove_last_funcCards()
  {
    $this->_remove_last_arr_value("5");
  }
  function funcCards_size()
  {
    return $this->_get_arr_size("5");
  }
  function newIdentity($offset)
  {
    $v = $this->_get_arr_value("6", $offset);
    return $v->get_value();
  }
  function append_newIdentity($value)
  {
    $v = $this->_add_arr_value("6");
    $v->set_value($value);
  }
  function set_newIdentity($index, $value)
  {
    $v = new $this->fields["6"]();
    $v->set_value($value);
    $this->_set_arr_value("6", $index, $v);
  }
  function remove_last_newIdentity()
  {
    $this->_remove_last_arr_value("6");
  }
  function newIdentity_size()
  {
    return $this->_get_arr_size("6");
  }
  function flags()
  {
    return $this->_get_value("7");
  }
  function set_flags($value)
  {
    return $this->_set_value("7", $value);
  }
  function totalBuy()
  {
    return $this->_get_value("8");
  }
  function set_totalBuy($value)
  {
    return $this->_set_value("8", $value);
  }
}
class GameServerMiddleLayerAddOfflineMsg extends PBMessage
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
  }
  function userIDFrom()
  {
    return $this->_get_value("1");
  }
  function set_userIDFrom($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDTo()
  {
    return $this->_get_value("2");
  }
  function set_userIDTo($value)
  {
    return $this->_set_value("2", $value);
  }
  function msg()
  {
    return $this->_get_value("3");
  }
  function set_msg($value)
  {
    return $this->_set_value("3", $value);
  }
  function timestamp()
  {
    return $this->_get_value("4");
  }
  function set_timestamp($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerMiddleLayerAddOfflineFriendRequest extends PBMessage
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
  function userIDAdd()
  {
    return $this->_get_value("1");
  }
  function set_userIDAdd($value)
  {
    return $this->_set_value("1", $value);
  }
  function userIDAdded()
  {
    return $this->_get_value("2");
  }
  function set_userIDAdded($value)
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
}
class SystemBroadcastNotify extends PBMessage
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
  function gamecode()
  {
    return $this->_get_value("1");
  }
  function set_gamecode($value)
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
  function content()
  {
    return $this->_get_value("3");
  }
  function set_content($value)
  {
    return $this->_set_value("3", $value);
  }
}
class RegBroadcastConReq extends PBMessage
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
  function gamecode()
  {
    return $this->_get_value("1");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameserverip()
  {
    return $this->_get_value("2");
  }
  function set_gameserverip($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameserverport()
  {
    return $this->_get_value("3");
  }
  function set_gameserverport($value)
  {
    return $this->_set_value("3", $value);
  }
}
class RegBroadcastConRsp extends PBMessage
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
class OnlineNumReporte extends PBMessage
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
    $this->fields["4"] = "PBInt";
    $this->values["4"] = "";
  }
  function gamecode()
  {
    return $this->_get_value("1");
  }
  function set_gamecode($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameserverip()
  {
    return $this->_get_value("2");
  }
  function set_gameserverip($value)
  {
    return $this->_set_value("2", $value);
  }
  function totalonlinenum()
  {
    return $this->_get_value("3");
  }
  function set_totalonlinenum($value)
  {
    return $this->_set_value("3", $value);
  }
  function port()
  {
    return $this->_get_value("4");
  }
  function set_port($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServerMiddleServerGameResult extends PBMessage
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
  function score()
  {
    return $this->_get_value("2");
  }
  function set_score($value)
  {
    return $this->_set_value("2", $value);
  }
}
class UserDisconnect extends PBMessage
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
class AddYuanBao extends PBMessage
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
  function yuanBaoCountAdded()
  {
    return $this->_get_value("2");
  }
  function set_yuanBaoCountAdded($value)
  {
    return $this->_set_value("2", $value);
  }
}
class MidlayerGameServerBroadcastData extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "EnumMidLayerBroadcastEventType";
    $this->values["1"] = "";
    $this->fields["2"] = "PBString";
    $this->values["2"] = "";
  }
  function broadcastEventType()
  {
    return $this->_get_value("1");
  }
  function set_broadcastEventType($value)
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
class MidLayerGameServerQueryMissionConfigRequest extends PBMessage
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
class MidLayerGameServerQueryMissionConfigResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    $this->fields["1"] = "DailyMission";
    $this->values["1"] = array();
    $this->fields["2"] = "SystemMission";
    $this->values["2"] = array();
    $this->fields["3"] = "PBInt";
    $this->values["3"] = "";
  }
  function dm($offset)
  {
    return $this->_get_arr_value("1", $offset);
  }
  function add_dm()
  {
    return $this->_add_arr_value("1");
  }
  function set_dm($index, $value)
  {
    $this->_set_arr_value("1", $index, $value);
  }
  function remove_last_dm()
  {
    $this->_remove_last_arr_value("1");
  }
  function dm_size()
  {
    return $this->_get_arr_size("1");
  }
  function sm($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_sm()
  {
    return $this->_add_arr_value("2");
  }
  function set_sm($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function remove_last_sm()
  {
    $this->_remove_last_arr_value("2");
  }
  function sm_size()
  {
    return $this->_get_arr_size("2");
  }
  function gameCode()
  {
    return $this->_get_value("3");
  }
  function set_gameCode($value)
  {
    return $this->_set_value("3", $value);
  }
}
?>