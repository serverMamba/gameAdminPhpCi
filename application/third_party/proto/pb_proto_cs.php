<?php
class GameServer_Packet extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_Packet"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_Packet"]["1"] = "version";
    self::$fields["GameServer_Packet"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_Packet"]["2"] = "command";
    self::$fields["GameServer_Packet"]["3"] = "PBBytes";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_Packet"]["3"] = "serialized";
    self::$fields["GameServer_Packet"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_Packet"]["4"] = "connectionid";
    self::$fields["GameServer_Packet"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_Packet"]["5"] = "gameserverconnectionid";
    self::$fields["GameServer_Packet"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_Packet"]["6"] = "targettype";
    self::$fields["GameServer_Packet"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_Packet"]["7"] = "userID";
    self::$fields["GameServer_Packet"]["8"] = "PBInt";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_Packet"]["8"] = "selftype";
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
class GameServer_EnumFuncCardType extends PBEnum
{
  const enumFuncCardKickUserFromTable  = 0;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumFuncCardKickUserFromTable");
   }
}
class GameServer_EnumLanguageType extends PBEnum
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

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumLanguageTypeEnglish",
			1 => "enumLanguageTypeZhcn",
			2 => "enumLanguageTypeFrench",
			3 => "enumLanguageTypeItalian",
			4 => "enumLanguageTypeGerman",
			5 => "enumLanguageTypeSpanish",
			6 => "enumLanguageTypeRussian",
			7 => "enumLanguageTypeKorean",
			8 => "enumLanguageTypeZhtw");
   }
}
class GameServer_EnumSysNotificationType extends PBEnum
{
  const enumSysNotificationNormal  = 0;
  const enumSysNotificationImportant  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumSysNotificationNormal",
			1 => "enumSysNotificationImportant");
   }
}
class GameServer_EnumSysActivityType extends PBEnum
{
  const enumActivityNormal  = 0;
  const enumActivityImportant  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumActivityNormal",
			1 => "enumActivityImportant");
   }
}
class GameServer_EnumSysActivityExpiredType extends PBEnum
{
  const enumActivityNotExpired  = 0;
  const enumActivityExpired  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumActivityNotExpired",
			1 => "enumActivityExpired");
   }
}
class GameServer_FuncCard extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FuncCard"]["1"] = "GameServer_EnumFuncCardType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_FuncCard"]["1"] = "cardType";
    self::$fields["GameServer_FuncCard"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_FuncCard"]["2"] = "cardCount";
  }
  function cardType()
  {
    return $this->_get_value("1");
  }
  function set_cardType($value)
  {
    return $this->_set_value("1", $value);
  }
  function cardType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_EnumIdentity extends PBEnum
{
  const enumIdentityRose  = 0;
  const enumIdentityTulip  = 1;
  const enumIdentityPeony  = 2;
  const enumIdentityBLUELOVER  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumIdentityRose",
			1 => "enumIdentityTulip",
			2 => "enumIdentityPeony",
			3 => "enumIdentityBLUELOVER");
   }
}
class GameServer_EnumXiaoLaBaNotifyType extends PBEnum
{
  const enumXiaoLaBaNotifyTypePay  = 0;
  const enumXiaoLaBaNotifyTypeCardType  = 1;
  const enumXiaoLaBaNotifyTypePlayGame  = 2;
  const enumXiaoLaBaNotifyTypePlayRoulette  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumXiaoLaBaNotifyTypePay",
			1 => "enumXiaoLaBaNotifyTypeCardType",
			2 => "enumXiaoLaBaNotifyTypePlayGame",
			3 => "enumXiaoLaBaNotifyTypePlayRoulette");
   }
}
class GameServer_EnumGameLevel extends PBEnum
{
  const enumGameLevelChuJi  = 0;
  const enumGameLevelZhongJi  = 1;
  const enumGameLevelGaoJi  = 2;
  const enumGameLevelFuHao  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumGameLevelChuJi",
			1 => "enumGameLevelZhongJi",
			2 => "enumGameLevelGaoJi",
			3 => "enumGameLevelFuHao");
   }
}
class GameServer_EnumLoginType extends PBEnum
{
  const enumLoginTypeToRegisterNewUser  = 0;
  const enumLoginTypeGuestAccount  = 1;
  const enumLoginTypeRegisterAccount  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumLoginTypeToRegisterNewUser",
			1 => "enumLoginTypeGuestAccount",
			2 => "enumLoginTypeRegisterAccount");
   }
}
class GameServer_EnumVIPLevel extends PBEnum
{
  const enumVIPLevelNone  = 0;
  const enumVIPLevelSilver  = 1;
  const enumVIPLevelGold  = 2;
  const enumVIPLevelPlatinum  = 3;
  const enumVIPLevelDiamond  = 4;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumVIPLevelNone",
			1 => "enumVIPLevelSilver",
			2 => "enumVIPLevelGold",
			3 => "enumVIPLevelPlatinum",
			4 => "enumVIPLevelDiamond");
   }
}
class GameServer_EnumGameType extends PBEnum
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
  const enumGameTypeTournamentDouDiZhuHuanLe  = 0x0063;
  const enumGameTypeTournamentDouDiZhu  = 0x0064;
  const enumGameTypeDouDiZhuLaiZi  = 0x0065;
  const enumGameTypeBlackJack  = 0x0071;
  const enumGameTypeStud  = 0x0081;
  const enumGameTypeGuanDan  = 0x0091;
  const enumGameTypeShiSanZhang  = 0x00A1;
  const enumGameTypeMJ2P  = 0x00B1;
  const enumGameTypeFishingOnline  = 0x00C1;
  const enumGameTypeLKPY  = 0x00D1;
  const enumGameTypeBuYuOL  = 0x00F1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0x0000 => "enumGameTypeUnknown",
			0x0001 => "enumGameTypeTexasPokerPuTong",
			0x0002 => "enumGameTypeTexasPokerJiaBei",
			0x0003 => "enumGameTypeTexasPokerHuanLe",
			0x0011 => "enumGameTypeNiuNiu",
			0x0012 => "enumGameTypeNiuNiuQiangZhuang",
			0x0013 => "enumGameTypeNiuNiuXueZhanDaoDi",
			0x0021 => "enumGameTypeBaccarat",
			0x0031 => "enumGameTypeZhaJinHua",
			0x0041 => "enumGameTypeSlots",
			0x0051 => "enumGameTypeRoulette",
			0x0061 => "enumGameTypeDouDiZhu",
			0x0062 => "enumGameTypeDouDiZhuHuanLe",
			0x0063 => "enumGameTypeTournamentDouDiZhuHuanLe",
			0x0064 => "enumGameTypeTournamentDouDiZhu",
			0x0065 => "enumGameTypeDouDiZhuLaiZi",
			0x0071 => "enumGameTypeBlackJack",
			0x0081 => "enumGameTypeStud",
			0x0091 => "enumGameTypeGuanDan",
			0x00A1 => "enumGameTypeShiSanZhang",
			0x00B1 => "enumGameTypeMJ2P",
			0x00C1 => "enumGameTypeFishingOnline",
			0x00D1 => "enumGameTypeLKPY",
			0x00F1 => "enumGameTypeBuYuOL");
   }
}
class GameServer_EnumGameTypeStatus extends PBEnum
{
  const enumGameTypeStatusAvailable  = 0;
  const enumGameTypeStatusComingSoon  = 1;
  const enumGameTypeStatusComingHot  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumGameTypeStatusAvailable",
			1 => "enumGameTypeStatusComingSoon",
			2 => "enumGameTypeStatusComingHot");
   }
}
class GameServer_EnumDeviceType extends PBEnum
{
  const enumDeviceTypeiPhone  = 0;
  const enumDeviceTypeiPad  = 1;
  const enumDeviceTypeAndroid  = 2;
  const enumDeviceTypeWindows  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumDeviceTypeiPhone",
			1 => "enumDeviceTypeiPad",
			2 => "enumDeviceTypeAndroid",
			3 => "enumDeviceTypeWindows");
   }
}
class GameServer_EnumGender extends PBEnum
{
  const enumGenderFemale  = 0;
  const enumGenderMale  = 1;
  const enumGenderUnknown  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumGenderFemale",
			1 => "enumGenderMale",
			2 => "enumGenderUnknown");
   }
}
class GameServer_EnumResult extends PBEnum
{
  const enumResultSucc  = 0;
  const enumResultFail  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumResultSucc",
			1 => "enumResultFail");
   }
}
class GameServer_EnumExchangeStatus extends PBEnum
{
  const enumExchangeStatus_Submited  = 0;
  const enumExchangeStatus_Done  = 1;
  const enumExchangeStatus_Failed  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumExchangeStatus_Submited",
			1 => "enumExchangeStatus_Done",
			2 => "enumExchangeStatus_Failed");
   }
}
class GameServer_EnumLoginResult extends PBEnum
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
  const enumRegBlockedByCount  = 9;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumLoginResultSucc",
			1 => "enumLoginResultAccountNotExist",
			2 => "enumLoginResultWrongPassword",
			3 => "enumRegisterResultSucc",
			4 => "enumRegisterResultAlreadyExist",
			5 => "enumRegisterResultDatabaseError",
			6 => "enumBlackIP",
			7 => "enumBlackMac",
			8 => "enumBlackUserID",
			9 => "enumRegBlockedByCount");
   }
}
class GameServer_EnumNewVersion extends PBEnum
{
  const enumUpdateTipNoNewVersion  = 0;
  const enumUpdateTipHasNewVersion  = 1;
  const enumUpdateTipHasNewVersionMandatoryUpdate  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumUpdateTipNoNewVersion",
			1 => "enumUpdateTipHasNewVersion",
			2 => "enumUpdateTipHasNewVersionMandatoryUpdate");
   }
}
class GameServer_EnumUserPurchaseCategory extends PBEnum
{
  const enumPurchaseChips  = 0;
  const enumPurchaseSpeaker  = 1;
  const enumPurchaseProperty  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumPurchaseChips",
			1 => "enumPurchaseSpeaker",
			2 => "enumPurchaseProperty");
   }
}
class GameServer_EnumUserPurchaseResult extends PBEnum
{
  const enumPurchaseSucceed  = 0;
  const enumPurchaseFailed  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumPurchaseSucceed",
			1 => "enumPurchaseFailed");
   }
}
class GameServer_EnumChangeTotalScoreReason extends PBEnum
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
  const enumChangeTotalScoreTournamentReward  = 22;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumChangeTotalScoreReasonUnknown",
			1 => "enumChangeTotalScoreReasonPlayGame",
			2 => "enumChangeTotalScorePresentGift",
			3 => "enumChangeTotalScorePresentChips",
			4 => "enumChangeTotalScorePresentProperty",
			5 => "enumChangeTotalScoreBonus",
			6 => "enumChangeTotalScoreSellProperty",
			7 => "enumChangeTotalScoreShutdownOldConnection",
			8 => "enumChangeTotalScoreOnlineReward",
			9 => "enumChangeTotalScoreTableReward",
			10 => "enumRoulette",
			11 => "enumSlotsReward",
			12 => "enumChangeTotalScoreReasonZhaJinHuaXiQian",
			13 => "enumChangeTotalScoreBuySpeaker",
			14 => "enumChangeTotalScoreTax",
			15 => "enumChangeTotalScoreSetPaySucc",
			16 => "enumChangeTotalScoreSetQueryUserInfo",
			17 => "enumChangeTotalScoreSetRobot",
			18 => "enumChangeTotalScoreMinusPresentChipsInGameServer",
			19 => "enumChangeTotalScoreDisconnect",
			20 => "enumChangeTotalScoreLogin",
			21 => "enumChangeTotalScoreMissionReward",
			22 => "enumChangeTotalScoreTournamentReward");
   }
}
class GameServer_EnumBroadcastEventType extends PBEnum
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
  const enumBroadcastEventTypeTryLuckResult  = 9;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumBroadcastEventTypeAddNotification",
			1 => "enumBroadcastEventTypeDelNotification",
			2 => "enumBroadcastEventTypeAddActivity",
			3 => "enumBroadcastEventTypeDelActivity",
			4 => "enumBroadcastEventTypePopNotification",
			5 => "enumBroadcastEventTypePopActivity",
			6 => "enumBroadcastEventTypeFeedBackOpen",
			7 => "enumBroadcastEventTypeFeedBackClose",
			8 => "enumBroadcastEventTypeExchangeProductStockChange",
			9 => "enumBroadcastEventTypeTryLuckResult");
   }
}
class GameServer_EnumFeedBackOperation extends PBEnum
{
  const enumFeedBackOpen  = 0;
  const enumFeedBackClose  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumFeedBackOpen",
			1 => "enumFeedBackClose");
   }
}
class GameServer_EnumZhajinhuaCardType extends PBEnum
{
  const enumZhajinhuaCardTypeSingle  = 1;
  const enumZhajinhuaCardTypeDouble  = 2;
  const enumZhajinhuaCardTypeShunZi  = 3;
  const enumZhajinhuaCardTypeJinHua  = 4;
  const enumZhajinhuaCardTypeShunJin  = 5;
  const enumZhajinhuaCardTypeBaoZi  = 6;
  const enumZhajinhuaCardTypeSpecial  = 7;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumZhajinhuaCardTypeSingle",
			2 => "enumZhajinhuaCardTypeDouble",
			3 => "enumZhajinhuaCardTypeShunZi",
			4 => "enumZhajinhuaCardTypeJinHua",
			5 => "enumZhajinhuaCardTypeShunJin",
			6 => "enumZhajinhuaCardTypeBaoZi",
			7 => "enumZhajinhuaCardTypeSpecial");
   }
}
class GameServer_EnumFeedBackSwitch extends PBEnum
{
  const enumFeedBackSwitch_Close  = 0;
  const enumFeedBackSwitch_Open  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumFeedBackSwitch_Close",
			1 => "enumFeedBackSwitch_Open");
   }
}
class GameServer_EnumDailyMissionType extends PBEnum
{
  const enumDailyMissionType_GameTurnSum  = 0;
  const enumDailyMissionType_EnterRoom  = 1;
  const enumDailyMissionType_ContinuousWinTime  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumDailyMissionType_GameTurnSum",
			1 => "enumDailyMissionType_EnterRoom",
			2 => "enumDailyMissionType_ContinuousWinTime");
   }
}
class GameServer_EnumExchangeProductType extends PBEnum
{
  const enumExchangeProductType_Card  = 0;
  const enumExchangeProductType_Real  = 1;
  const enumExchangeProductType_Game  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumExchangeProductType_Card",
			1 => "enumExchangeProductType_Real",
			2 => "enumExchangeProductType_Game");
   }
}
class GameServer_EnumCardStatus extends PBEnum
{
  const enumCardStatus_NotUsed  = 0;
  const enumCardStatus_Used  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumCardStatus_NotUsed",
			1 => "enumCardStatus_Used");
   }
}
class GameServer_EnumSystemMissionType extends PBEnum
{
  const enumSystemMissionType_UploadPic  = 0;
  const enumSystemMissionType_Buy  = 1;
  const enumSystemMissionType_Competition  = 2;
  const enumSystemMissionType_GameTurnSum  = 3;
  const enumSystemMissionType_Exchange  = 4;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumSystemMissionType_UploadPic",
			1 => "enumSystemMissionType_Buy",
			2 => "enumSystemMissionType_Competition",
			3 => "enumSystemMissionType_GameTurnSum",
			4 => "enumSystemMissionType_Exchange");
   }
}
class GameServer_EnumMissionStatus extends PBEnum
{
  const enumMissionStatus_Unfinished  = 0;
  const enumMissionStatus_Finished  = 1;
  const enumMissionStatus_Finished_And_Got_Reward  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumMissionStatus_Unfinished",
			1 => "enumMissionStatus_Finished",
			2 => "enumMissionStatus_Finished_And_Got_Reward");
   }
}
class GameServer_EnumProductFrontShow extends PBEnum
{
  const enumProductFrontShow_Not  = 0;
  const enumProductFrontShow_Yes  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumProductFrontShow_Not",
			1 => "enumProductFrontShow_Yes");
   }
}
class GameServer_EnumSelfExchangeProductType extends PBEnum
{
  const enumSelfExchangeProductType_Chip  = 1;
  const enumSelfExchangeProductType_Speaker  = 2;
  const enumSelfExchangeProductType_VIPSilver  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumSelfExchangeProductType_Chip",
			2 => "enumSelfExchangeProductType_Speaker",
			3 => "enumSelfExchangeProductType_VIPSilver");
   }
}
class GameServer_EnumExchangeProductStatus extends PBEnum
{
  const enumExchangeProductStatus_Effective  = 1;
  const enumExchangeProductStatus_Invalid  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumExchangeProductStatus_Effective",
			2 => "enumExchangeProductStatus_Invalid");
   }
}
class GameServer_EnumQueryUserInfoType extends PBEnum
{
  const enumQueryUserInfoType_Normal  = 0;
  const enumQueryUserInfoType_Client  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumQueryUserInfoType_Normal",
			1 => "enumQueryUserInfoType_Client");
   }
}
class GameServer_EnumQuickStartFailReason extends PBEnum
{
  const enumFailReasonUnknown  = 0;
  const enumFailReasonUnMatchedScore  = 1;
  const enumFailReasonUnFinishedGame  = 2;
  const enumFailReasonNoValidTable  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumFailReasonUnknown",
			1 => "enumFailReasonUnMatchedScore",
			2 => "enumFailReasonUnFinishedGame",
			3 => "enumFailReasonNoValidTable");
   }
}
class GameServer_FlagInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FlagInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["1"] = "flagID";
    self::$fields["GameServer_FlagInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["2"] = "flagPurview";
    self::$fields["GameServer_FlagInfo"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["3"] = "flagImg";
    self::$fields["GameServer_FlagInfo"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["4"] = "flagName";
    self::$fields["GameServer_FlagInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["5"] = "flagEffectiveDay";
    self::$fields["GameServer_FlagInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["6"] = "flagPrice";
    self::$fields["GameServer_FlagInfo"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["7"] = "timeAddedToUser";
    self::$fields["GameServer_FlagInfo"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["8"] = "flagImgInStore";
    self::$fields["GameServer_FlagInfo"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_FlagInfo"]["9"] = "flagType";
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
class GameServer_FlagInfos extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FlagInfos"]["11"] = "GameServer_FlagInfo";
    $this->values["11"] = array();
    self::$fieldNames["GameServer_FlagInfos"]["11"] = "flags";
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
  function set_all_flagss($values)
  {
    return $this->_set_arr_values("11", $values);
  }
  function remove_last_flags()
  {
    $this->_remove_last_arr_value("11");
  }
  function flagss_size()
  {
    return $this->_get_arr_size("11");
  }
  function get_flagss()
  {
    return $this->_get_value("11");
  }
}
class GameServer_BasicUserInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BasicUserInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["1"] = "userID";
    self::$fields["GameServer_BasicUserInfo"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["2"] = "userNick";
    self::$fields["GameServer_BasicUserInfo"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["3"] = "userAvatar";
    self::$fields["GameServer_BasicUserInfo"]["4"] = "GameServer_EnumGender";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["4"] = "userGender";
    self::$fields["GameServer_BasicUserInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["5"] = "userScore";
    self::$fields["GameServer_BasicUserInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["6"] = "userExperience";
    self::$fields["GameServer_BasicUserInfo"]["7"] = "GameServer_EnumVIPLevel";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["7"] = "vipLevel";
    self::$fields["GameServer_BasicUserInfo"]["8"] = "GameServer_FuncCard";
    $this->values["8"] = array();
    self::$fieldNames["GameServer_BasicUserInfo"]["8"] = "funcCards";
    self::$fields["GameServer_BasicUserInfo"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["9"] = "yuanBaoCount";
    self::$fields["GameServer_BasicUserInfo"]["10"] = "GameServer_EnumIdentity";
    $this->values["10"] = array();
    self::$fieldNames["GameServer_BasicUserInfo"]["10"] = "identity";
    self::$fields["GameServer_BasicUserInfo"]["11"] = "GameServer_FlagInfos";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["11"] = "flags";
    self::$fields["GameServer_BasicUserInfo"]["12"] = "PBInt";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["12"] = "coupon";
    self::$fields["GameServer_BasicUserInfo"]["13"] = "PBInt";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["13"] = "gameTurnSum";
    self::$fields["GameServer_BasicUserInfo"]["14"] = "PBInt";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["14"] = "continuousWinTime";
    self::$fields["GameServer_BasicUserInfo"]["15"] = "PBInt";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["15"] = "totalBuy";
    self::$fields["GameServer_BasicUserInfo"]["16"] = "PBInt";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["16"] = "totalGameTurnSum";
    self::$fields["GameServer_BasicUserInfo"]["17"] = "PBInt";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["17"] = "rewardGameTurnSum";
    self::$fields["GameServer_BasicUserInfo"]["18"] = "PBInt";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["18"] = "totalGift";
    self::$fields["GameServer_BasicUserInfo"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["19"] = "fishWeaponCurLevel";
    self::$fields["GameServer_BasicUserInfo"]["20"] = "PBInt";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_BasicUserInfo"]["20"] = "bulletCount";
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
  function userGender_string()
  {
    return $this->values["4"]->get_description();
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
  function vipLevel_string()
  {
    return $this->values["7"]->get_description();
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
  function set_all_funcCardss($values)
  {
    return $this->_set_arr_values("8", $values);
  }
  function remove_last_funcCards()
  {
    $this->_remove_last_arr_value("8");
  }
  function funcCardss_size()
  {
    return $this->_get_arr_size("8");
  }
  function get_funcCardss()
  {
    return $this->_get_value("8");
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
    $v = new self::$fields["GameServer_BasicUserInfo"]["10"]();
    $v->set_value($value);
    $this->_set_arr_value("10", $index, $v);
  }
  function remove_last_identity()
  {
    $this->_remove_last_arr_value("10");
  }
  function identitys_size()
  {
    return $this->_get_arr_size("10");
  }
  function get_identitys()
  {
    return $this->_get_value("10");
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
  function totalGift()
  {
    return $this->_get_value("18");
  }
  function set_totalGift($value)
  {
    return $this->_set_value("18", $value);
  }
  function fishWeaponCurLevel()
  {
    return $this->_get_value("19");
  }
  function set_fishWeaponCurLevel($value)
  {
    return $this->_set_value("19", $value);
  }
  function bulletCount()
  {
    return $this->_get_value("20");
  }
  function set_bulletCount($value)
  {
    return $this->_set_value("20", $value);
  }
}
class GameServer_DetailUserInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DetailUserInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["1"] = "userID";
    self::$fields["GameServer_DetailUserInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["2"] = "winCount";
    self::$fields["GameServer_DetailUserInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["3"] = "lostCount";
    self::$fields["GameServer_DetailUserInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["4"] = "drawCount";
    self::$fields["GameServer_DetailUserInfo"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["5"] = "gift";
    self::$fields["GameServer_DetailUserInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["6"] = "speakerCount";
    self::$fields["GameServer_DetailUserInfo"]["7"] = "PBString";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["7"] = "password";
    self::$fields["GameServer_DetailUserInfo"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["8"] = "user_email";
    self::$fields["GameServer_DetailUserInfo"]["9"] = "PBString";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["9"] = "user_device_id";
    self::$fields["GameServer_DetailUserInfo"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["10"] = "wallet";
    self::$fields["GameServer_DetailUserInfo"]["11"] = "PBString";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["11"] = "ip";
    self::$fields["GameServer_DetailUserInfo"]["12"] = "PBString";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["12"] = "mac";
    self::$fields["GameServer_DetailUserInfo"]["13"] = "PBInt";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["13"] = "isblock";
    self::$fields["GameServer_DetailUserInfo"]["14"] = "PBString";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["14"] = "channel_id";
    self::$fields["GameServer_DetailUserInfo"]["15"] = "PBString";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["15"] = "activate_device";
    self::$fields["GameServer_DetailUserInfo"]["16"] = "PBString";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["16"] = "uuid";
    self::$fields["GameServer_DetailUserInfo"]["17"] = "PBString";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["17"] = "location";
    self::$fields["GameServer_DetailUserInfo"]["18"] = "PBString";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["18"] = "officalgiftinfo";
    self::$fields["GameServer_DetailUserInfo"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["19"] = "consecutive_login";
    self::$fields["GameServer_DetailUserInfo"]["20"] = "PBString";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["20"] = "registertime";
    self::$fields["GameServer_DetailUserInfo"]["21"] = "PBString";
    $this->values["21"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["21"] = "lastlogintime";
    self::$fields["GameServer_DetailUserInfo"]["22"] = "PBString";
    $this->values["22"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["22"] = "property";
    self::$fields["GameServer_DetailUserInfo"]["23"] = "PBInt";
    $this->values["23"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["23"] = "lastlogintime_int";
    self::$fields["GameServer_DetailUserInfo"]["24"] = "PBInt";
    $this->values["24"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["24"] = "gift_given_time";
    self::$fields["GameServer_DetailUserInfo"]["25"] = "PBInt";
    $this->values["25"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["25"] = "viplasteffectivetime";
    self::$fields["GameServer_DetailUserInfo"]["26"] = "PBInt";
    $this->values["26"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["26"] = "totalbuychips";
    self::$fields["GameServer_DetailUserInfo"]["27"] = "PBInt";
    $this->values["27"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["27"] = "monthbuychips";
    self::$fields["GameServer_DetailUserInfo"]["28"] = "PBInt";
    $this->values["28"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["28"] = "totalcompetitiontimes";
    self::$fields["GameServer_DetailUserInfo"]["29"] = "PBString";
    $this->values["29"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["29"] = "mobilenumber";
    self::$fields["GameServer_DetailUserInfo"]["30"] = "PBInt";
    $this->values["30"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["30"] = "selfpooltotalwin";
    self::$fields["GameServer_DetailUserInfo"]["31"] = "PBInt";
    $this->values["31"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["31"] = "selfpooltotalcost";
    self::$fields["GameServer_DetailUserInfo"]["32"] = "PBInt";
    $this->values["32"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["32"] = "selfpooltotalgametime";
    self::$fields["GameServer_DetailUserInfo"]["33"] = "PBInt";
    $this->values["33"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["33"] = "BuySpecialGoodsFirst";
    self::$fields["GameServer_DetailUserInfo"]["34"] = "PBInt";
    $this->values["34"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["34"] = "vip_left_seconds";
    self::$fields["GameServer_DetailUserInfo"]["35"] = "PBInt";
    $this->values["35"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["35"] = "fishexp";
    self::$fields["GameServer_DetailUserInfo"]["36"] = "PBInt";
    $this->values["36"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["36"] = "fishlevel";
    self::$fields["GameServer_DetailUserInfo"]["37"] = "PBInt";
    $this->values["37"] = "";
    self::$fieldNames["GameServer_DetailUserInfo"]["37"] = "fishpowerpool";
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
  function BuySpecialGoodsFirst()
  {
    return $this->_get_value("33");
  }
  function set_BuySpecialGoodsFirst($value)
  {
    return $this->_set_value("33", $value);
  }
  function vip_left_seconds()
  {
    return $this->_get_value("34");
  }
  function set_vip_left_seconds($value)
  {
    return $this->_set_value("34", $value);
  }
  function fishexp()
  {
    return $this->_get_value("35");
  }
  function set_fishexp($value)
  {
    return $this->_set_value("35", $value);
  }
  function fishlevel()
  {
    return $this->_get_value("36");
  }
  function set_fishlevel($value)
  {
    return $this->_set_value("36", $value);
  }
  function fishpowerpool()
  {
    return $this->_get_value("37");
  }
  function set_fishpowerpool($value)
  {
    return $this->_set_value("37", $value);
  }
}
class GameServer_ChipsBonusInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ChipsBonusInfo"]["1"] = "PBBool";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["1"] = "isLoginBonus";
    self::$fields["GameServer_ChipsBonusInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["2"] = "consecutiveLoginDays";
    self::$fields["GameServer_ChipsBonusInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["3"] = "bonusChips";
    self::$fields["GameServer_ChipsBonusInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["4"] = "totalChips";
    self::$fields["GameServer_ChipsBonusInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["5"] = "userID";
    self::$fields["GameServer_ChipsBonusInfo"]["6"] = "GameServer_EnumVIPLevel";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["6"] = "vipLevel";
    self::$fields["GameServer_ChipsBonusInfo"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_ChipsBonusInfo"]["7"] = "vipBonusChips";
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
  function vipLevel_string()
  {
    return $this->values["6"]->get_description();
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
class GameServer_TableUserInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TableUserInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TableUserInfo"]["1"] = "seatID";
    self::$fields["GameServer_TableUserInfo"]["2"] = "GameServer_BasicUserInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TableUserInfo"]["2"] = "basicInfo";
    self::$fields["GameServer_TableUserInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TableUserInfo"]["3"] = "takeInScore";
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
class GameServer_TableInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TableInfo"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TableInfo"]["1"] = "gameType";
    self::$fields["GameServer_TableInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TableInfo"]["2"] = "tableID";
    self::$fields["GameServer_TableInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TableInfo"]["3"] = "seatCount";
    self::$fields["GameServer_TableInfo"]["4"] = "GameServer_TableUserInfo";
    $this->values["4"] = array();
    self::$fieldNames["GameServer_TableInfo"]["4"] = "tableUserInfo";
    self::$fields["GameServer_TableInfo"]["100"] = "PBBytes";
    $this->values["100"] = "";
    self::$fieldNames["GameServer_TableInfo"]["100"] = "serialized";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_tableUserInfos($values)
  {
    return $this->_set_arr_values("4", $values);
  }
  function remove_last_tableUserInfo()
  {
    $this->_remove_last_arr_value("4");
  }
  function tableUserInfos_size()
  {
    return $this->_get_arr_size("4");
  }
  function get_tableUserInfos()
  {
    return $this->_get_value("4");
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
class GameServer_GameInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameInfo"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameInfo"]["1"] = "gameType";
    self::$fields["GameServer_GameInfo"]["2"] = "GameServer_EnumGameTypeStatus";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameInfo"]["2"] = "gameTypeStatus";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
  }
  function gameTypeStatus()
  {
    return $this->_get_value("2");
  }
  function set_gameTypeStatus($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameTypeStatus_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_NewGameInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_NewGameInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_NewGameInfo"]["1"] = "gameType";
    self::$fields["GameServer_NewGameInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_NewGameInfo"]["2"] = "gameTypeStatus";
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
class GameServer_UserInfoPair extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_UserInfoPair"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_UserInfoPair"]["1"] = "fieldName";
    self::$fields["GameServer_UserInfoPair"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_UserInfoPair"]["2"] = "fieldValue";
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
class GameServer_EnumUserInfoFieldName extends PBEnum
{
  const enumUserInfoFieldNameNick  = 1;
  const enumUserInfoFieldNameAvatar  = 2;
  const enumUserInfoFieldNameGender  = 3;
  const enumUserInfoFieldNameAvatarForModify  = 4;
  const enumUserInfoFieldNameVIPLevel  = 5;
  const enumUserInfoFieldNameMobileNumber  = 6;
  const enumUserInfoFieldNameGameTurnSum  = 7;
  const enumUserInfoFieldNameContinuousWinTime  = 8;
  const enumUserInfoFieldNameCoupon  = 9;
  const enumUserInfoFieldNameBuySpecialGoodsFirst  = 10;
  const enumUserInfoFieldNameFishWeaponLevel  = 11;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumUserInfoFieldNameNick",
			2 => "enumUserInfoFieldNameAvatar",
			3 => "enumUserInfoFieldNameGender",
			4 => "enumUserInfoFieldNameAvatarForModify",
			5 => "enumUserInfoFieldNameVIPLevel",
			6 => "enumUserInfoFieldNameMobileNumber",
			7 => "enumUserInfoFieldNameGameTurnSum",
			8 => "enumUserInfoFieldNameContinuousWinTime",
			9 => "enumUserInfoFieldNameCoupon",
			10 => "enumUserInfoFieldNameBuySpecialGoodsFirst",
			11 => "enumUserInfoFieldNameFishWeaponLevel");
   }
}
class GameServer_PairIntString extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_PairIntString"]["1"] = "GameServer_EnumUserInfoFieldName";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_PairIntString"]["1"] = "fieldName";
    self::$fields["GameServer_PairIntString"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_PairIntString"]["2"] = "fieldValue";
  }
  function fieldName()
  {
    return $this->_get_value("1");
  }
  function set_fieldName($value)
  {
    return $this->_set_value("1", $value);
  }
  function fieldName_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_EnumChatType extends PBEnum
{
  const enumChatTypeText  = 0;
  const enumChatTypeEmotion  = 1;
  const enumChatTypeShortcut  = 2;
  const enumChatTypeVoice  = 3;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumChatTypeText",
			1 => "enumChatTypeEmotion",
			2 => "enumChatTypeShortcut",
			3 => "enumChatTypeVoice");
   }
}
class GameServer_EnumMissionType extends PBEnum
{
  const enumMissionTypeDaily  = 0;
  const enumMissionTypeSystem  = 1;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			0 => "enumMissionTypeDaily",
			1 => "enumMissionTypeSystem");
   }
}
class GameServer_ConnectGameServer extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ConnectGameServer"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ConnectGameServer"]["1"] = "ip";
    self::$fields["GameServer_ConnectGameServer"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ConnectGameServer"]["2"] = "port";
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
class GameServer_LoginRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_LoginRequest"]["1"] = "GameServer_EnumLoginType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["1"] = "loginType";
    self::$fields["GameServer_LoginRequest"]["2"] = "GameServer_EnumGameType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["2"] = "gameType";
    self::$fields["GameServer_LoginRequest"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["3"] = "account";
    self::$fields["GameServer_LoginRequest"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["4"] = "password";
    self::$fields["GameServer_LoginRequest"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["5"] = "nickname";
    self::$fields["GameServer_LoginRequest"]["6"] = "GameServer_EnumGender";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["6"] = "gender";
    self::$fields["GameServer_LoginRequest"]["7"] = "GameServer_EnumDeviceType";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["7"] = "deviceType";
    self::$fields["GameServer_LoginRequest"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["8"] = "deviceID";
    self::$fields["GameServer_LoginRequest"]["9"] = "PBString";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["9"] = "deviceToken";
    self::$fields["GameServer_LoginRequest"]["10"] = "PBString";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["10"] = "macAddress";
    self::$fields["GameServer_LoginRequest"]["11"] = "PBString";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["11"] = "secureKey";
    self::$fields["GameServer_LoginRequest"]["12"] = "PBString";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["12"] = "channel";
    self::$fields["GameServer_LoginRequest"]["13"] = "PBInt";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["13"] = "version";
    self::$fields["GameServer_LoginRequest"]["14"] = "PBString";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["14"] = "loginipaddress";
    self::$fields["GameServer_LoginRequest"]["15"] = "PBInt";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["15"] = "loginipport";
    self::$fields["GameServer_LoginRequest"]["16"] = "PBInt";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["16"] = "gameserveripaddress";
    self::$fields["GameServer_LoginRequest"]["17"] = "PBInt";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["17"] = "gameserveripport";
    self::$fields["GameServer_LoginRequest"]["18"] = "PBString";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["18"] = "mobilenumber";
    self::$fields["GameServer_LoginRequest"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["19"] = "channelid";
    self::$fields["GameServer_LoginRequest"]["20"] = "PBString";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_LoginRequest"]["20"] = "imei";
  }
  function loginType()
  {
    return $this->_get_value("1");
  }
  function set_loginType($value)
  {
    return $this->_set_value("1", $value);
  }
  function loginType_string()
  {
    return $this->values["1"]->get_description();
  }
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameType_string()
  {
    return $this->values["2"]->get_description();
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
  function gender_string()
  {
    return $this->values["6"]->get_description();
  }
  function deviceType()
  {
    return $this->_get_value("7");
  }
  function set_deviceType($value)
  {
    return $this->_set_value("7", $value);
  }
  function deviceType_string()
  {
    return $this->values["7"]->get_description();
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
  function imei()
  {
    return $this->_get_value("20");
  }
  function set_imei($value)
  {
    return $this->_set_value("20", $value);
  }
}
class GameServer_LoginResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_LoginResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["1"] = "result";
    self::$fields["GameServer_LoginResponse"]["2"] = "GameServer_BasicUserInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["2"] = "basicUserInfo";
    self::$fields["GameServer_LoginResponse"]["3"] = "GameServer_GameInfo";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_LoginResponse"]["3"] = "gameInfo";
    self::$fields["GameServer_LoginResponse"]["4"] = "GameServer_EnumNewVersion";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["4"] = "update";
    self::$fields["GameServer_LoginResponse"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["5"] = "updateURL";
    self::$fields["GameServer_LoginResponse"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["6"] = "iOSUpdateURL";
    self::$fields["GameServer_LoginResponse"]["7"] = "PBString";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["7"] = "latestVersion";
    self::$fields["GameServer_LoginResponse"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["8"] = "updateInfo";
    self::$fields["GameServer_LoginResponse"]["16"] = "PBInt";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["16"] = "gameserveripaddress";
    self::$fields["GameServer_LoginResponse"]["17"] = "PBInt";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["17"] = "gameserveripport";
    self::$fields["GameServer_LoginResponse"]["18"] = "GameServer_ChipsBonusInfo";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["18"] = "bonusinfo";
    self::$fields["GameServer_LoginResponse"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["19"] = "speakerCount";
    self::$fields["GameServer_LoginResponse"]["20"] = "GameServer_EnumFeedBackOperation";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_LoginResponse"]["20"] = "feedback";
    self::$fields["GameServer_LoginResponse"]["21"] = "GameServer_NewGameInfo";
    $this->values["21"] = array();
    self::$fieldNames["GameServer_LoginResponse"]["21"] = "newGameInfo";
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
  function set_all_gameInfos($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_gameInfo()
  {
    $this->_remove_last_arr_value("3");
  }
  function gameInfos_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_gameInfos()
  {
    return $this->_get_value("3");
  }
  function update()
  {
    return $this->_get_value("4");
  }
  function set_update($value)
  {
    return $this->_set_value("4", $value);
  }
  function update_string()
  {
    return $this->values["4"]->get_description();
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
  function feedback_string()
  {
    return $this->values["20"]->get_description();
  }
  function newGameInfo($offset)
  {
    return $this->_get_arr_value("21", $offset);
  }
  function add_newGameInfo()
  {
    return $this->_add_arr_value("21");
  }
  function set_newGameInfo($index, $value)
  {
    $this->_set_arr_value("21", $index, $value);
  }
  function set_all_newGameInfos($values)
  {
    return $this->_set_arr_values("21", $values);
  }
  function remove_last_newGameInfo()
  {
    $this->_remove_last_arr_value("21");
  }
  function newGameInfos_size()
  {
    return $this->_get_arr_size("21");
  }
  function get_newGameInfos()
  {
    return $this->_get_value("21");
  }
}
class GameServer_GameServerTableChat extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerTableChat"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["1"] = "tableID";
    self::$fields["GameServer_GameServerTableChat"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["2"] = "senderUserID";
    self::$fields["GameServer_GameServerTableChat"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["3"] = "senderSeatID";
    self::$fields["GameServer_GameServerTableChat"]["4"] = "GameServer_EnumChatType";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["4"] = "chatType";
    self::$fields["GameServer_GameServerTableChat"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["5"] = "msg";
    self::$fields["GameServer_GameServerTableChat"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_GameServerTableChat"]["6"] = "senderNick";
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
  function chatType_string()
  {
    return $this->values["4"]->get_description();
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
class GameServer_GameServerGetUserBasicInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerGetUserBasicInfoRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerGetUserBasicInfoRequest"]["1"] = "userid";
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
class GameServer_GameServerGetUserBasicInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerGetUserBasicInfoResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerGetUserBasicInfoResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerGetUserBasicInfoResponse"]["2"] = "GameServer_BasicUserInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerGetUserBasicInfoResponse"]["2"] = "basicInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerEnterGameRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterGameRequest"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterGameRequest"]["1"] = "gameType";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
  }
}
class GameServer_GameServerEnterGameResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterGameResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterGameResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerEnterGameResponse"]["2"] = "GameServer_EnumGameType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterGameResponse"]["2"] = "gameType";
    self::$fields["GameServer_GameServerEnterGameResponse"]["3"] = "PBBytes";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerEnterGameResponse"]["3"] = "serialized";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
  }
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameType_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_GameServerLeaveGameRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveGameRequest"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveGameRequest"]["1"] = "gameType";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
  }
}
class GameServer_GameServerLeaveGameResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveGameResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveGameResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerLeaveGameResponse"]["2"] = "GameServer_EnumGameType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveGameResponse"]["2"] = "gameType";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
  }
  function gameType()
  {
    return $this->_get_value("2");
  }
  function set_gameType($value)
  {
    return $this->_set_value("2", $value);
  }
  function gameType_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_GameServerGetTableListRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerGetTableListRequest"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerGetTableListRequest"]["1"] = "gameType";
    self::$fields["GameServer_GameServerGetTableListRequest"]["2"] = "PBBytes";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerGetTableListRequest"]["2"] = "serialized";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerGetTableListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerGetTableListResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerGetTableListResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerGetTableListResponse"]["2"] = "GameServer_TableInfo";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_GameServerGetTableListResponse"]["2"] = "tableInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_tableInfos($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_tableInfo()
  {
    $this->_remove_last_arr_value("2");
  }
  function tableInfos_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_tableInfos()
  {
    return $this->_get_value("2");
  }
}
class GameServer_GameServerEnterTableRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterTableRequest"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterTableRequest"]["1"] = "gameType";
    self::$fields["GameServer_GameServerEnterTableRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterTableRequest"]["2"] = "tableID";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerEnterTableResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterTableResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterTableResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerEnterTableResponse"]["2"] = "GameServer_TableInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterTableResponse"]["2"] = "tableInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerModifyTakeInScoreRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerModifyTakeInScoreRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreRequest"]["1"] = "seatID";
    self::$fields["GameServer_GameServerModifyTakeInScoreRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreRequest"]["2"] = "scoreTakeIn";
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
class GameServer_GameServerModifyTakeInScoreResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerModifyTakeInScoreResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerModifyTakeInScoreResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreResponse"]["2"] = "seatID";
    self::$fields["GameServer_GameServerModifyTakeInScoreResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreResponse"]["3"] = "scoreTakeIn";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerModifyTakeInScoreBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerModifyTakeInScoreBC"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreBC"]["1"] = "seatID";
    self::$fields["GameServer_GameServerModifyTakeInScoreBC"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerModifyTakeInScoreBC"]["2"] = "scoreTakeIn";
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
class GameServer_GameServerEnterSeatRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterSeatRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatRequest"]["1"] = "seatID";
    self::$fields["GameServer_GameServerEnterSeatRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatRequest"]["2"] = "scoreTakeIn";
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
class GameServer_GameServerEnterSeatResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterSeatResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerEnterSeatResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatResponse"]["2"] = "tableID";
    self::$fields["GameServer_GameServerEnterSeatResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatResponse"]["3"] = "seatID";
    self::$fields["GameServer_GameServerEnterSeatResponse"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatResponse"]["4"] = "scoreTakeIn";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerEnterSeatBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerEnterSeatBC"]["1"] = "GameServer_BasicUserInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatBC"]["1"] = "basicUserInfo";
    self::$fields["GameServer_GameServerEnterSeatBC"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatBC"]["2"] = "tableID";
    self::$fields["GameServer_GameServerEnterSeatBC"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatBC"]["3"] = "seatID";
    self::$fields["GameServer_GameServerEnterSeatBC"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerEnterSeatBC"]["4"] = "scoreTakeIn";
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
class GameServer_GameServerLeaveSeatRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveSeatRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatRequest"]["1"] = "userID";
    self::$fields["GameServer_GameServerLeaveSeatRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatRequest"]["2"] = "tableID";
    self::$fields["GameServer_GameServerLeaveSeatRequest"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatRequest"]["3"] = "seatID";
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
class GameServer_GameServerLeaveSeatResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveSeatResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerLeaveSeatResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatResponse"]["2"] = "userID";
    self::$fields["GameServer_GameServerLeaveSeatResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatResponse"]["3"] = "tableID";
    self::$fields["GameServer_GameServerLeaveSeatResponse"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatResponse"]["4"] = "seatID";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerLeaveSeatBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveSeatBC"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatBC"]["1"] = "userID";
    self::$fields["GameServer_GameServerLeaveSeatBC"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatBC"]["2"] = "tableID";
    self::$fields["GameServer_GameServerLeaveSeatBC"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerLeaveSeatBC"]["3"] = "seatID";
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
class GameServer_GameServerLogicData extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLogicData"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLogicData"]["1"] = "cmd";
    self::$fields["GameServer_GameServerLogicData"]["100"] = "PBBytes";
    $this->values["100"] = "";
    self::$fieldNames["GameServer_GameServerLogicData"]["100"] = "serialized";
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
class GameServer_GameServerLeaveTableRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveTableRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveTableRequest"]["1"] = "userID";
    self::$fields["GameServer_GameServerLeaveTableRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveTableRequest"]["2"] = "tableID";
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
class GameServer_GameServerLeaveTableResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerLeaveTableResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerLeaveTableResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerLeaveTableResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerLeaveTableResponse"]["2"] = "userID";
    self::$fields["GameServer_GameServerLeaveTableResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerLeaveTableResponse"]["3"] = "tableID";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerGetGameListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerGetGameListResponse"]["1"] = "GameServer_GameInfo";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_GameServerGetGameListResponse"]["1"] = "gameInfo";
    self::$fields["GameServer_GameServerGetGameListResponse"]["2"] = "GameServer_NewGameInfo";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_GameServerGetGameListResponse"]["2"] = "newGameInfo";
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
  function set_all_gameInfos($values)
  {
    return $this->_set_arr_values("1", $values);
  }
  function remove_last_gameInfo()
  {
    $this->_remove_last_arr_value("1");
  }
  function gameInfos_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_gameInfos()
  {
    return $this->_get_value("1");
  }
  function newGameInfo($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_newGameInfo()
  {
    return $this->_add_arr_value("2");
  }
  function set_newGameInfo($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function set_all_newGameInfos($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_newGameInfo()
  {
    $this->_remove_last_arr_value("2");
  }
  function newGameInfos_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_newGameInfos()
  {
    return $this->_get_value("2");
  }
}
class GameServer_GameServerQuickStartRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerQuickStartRequest"]["1"] = "GameServer_EnumGameType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerQuickStartRequest"]["1"] = "gameType";
    self::$fields["GameServer_GameServerQuickStartRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerQuickStartRequest"]["2"] = "baseScore";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function gameType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerQuickStartResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerQuickStartResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerQuickStartResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerQuickStartResponse"]["2"] = "GameServer_TableInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerQuickStartResponse"]["2"] = "tableInfo";
    self::$fields["GameServer_GameServerQuickStartResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerQuickStartResponse"]["3"] = "failReason";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
  }
  function tableInfo()
  {
    return $this->_get_value("2");
  }
  function set_tableInfo($value)
  {
    return $this->_set_value("2", $value);
  }
  function failReason()
  {
    return $this->_get_value("3");
  }
  function set_failReason($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServer_GameServerQueryUserInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerQueryUserInfoRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerQueryUserInfoRequest"]["1"] = "userID";
    self::$fields["GameServer_GameServerQueryUserInfoRequest"]["2"] = "GameServer_EnumQueryUserInfoType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerQueryUserInfoRequest"]["2"] = "type";
  }
  function userID()
  {
    return $this->_get_value("1");
  }
  function set_userID($value)
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
  function type_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_GameServerQueryUserInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerQueryUserInfoResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerQueryUserInfoResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerQueryUserInfoResponse"]["2"] = "GameServer_BasicUserInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerQueryUserInfoResponse"]["2"] = "basicUserInfo";
    self::$fields["GameServer_GameServerQueryUserInfoResponse"]["3"] = "GameServer_DetailUserInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerQueryUserInfoResponse"]["3"] = "detailUserInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerSearchUserRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerSearchUserRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerSearchUserRequest"]["1"] = "userID";
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
class GameServer_GameServerSearchUserResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerSearchUserResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerSearchUserResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerSearchUserResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerSearchUserResponse"]["2"] = "userID";
    self::$fields["GameServer_GameServerSearchUserResponse"]["3"] = "GameServer_BasicUserInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerSearchUserResponse"]["3"] = "basicUserInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GameServerModifyUserInfoRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerModifyUserInfoRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerModifyUserInfoRequest"]["1"] = "userid";
    self::$fields["GameServer_GameServerModifyUserInfoRequest"]["2"] = "GameServer_PairIntString";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_GameServerModifyUserInfoRequest"]["2"] = "kv";
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
  function set_all_kvs($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_kv()
  {
    $this->_remove_last_arr_value("2");
  }
  function kvs_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_kvs()
  {
    return $this->_get_value("2");
  }
}
class GameServer_GameServerModifyUserInfoResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerModifyUserInfoResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerModifyUserInfoResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerModifyUserInfoResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerModifyUserInfoResponse"]["2"] = "userid";
    self::$fields["GameServer_GameServerModifyUserInfoResponse"]["3"] = "GameServer_PairIntString";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_GameServerModifyUserInfoResponse"]["3"] = "kv";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_kvs($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_kv()
  {
    $this->_remove_last_arr_value("3");
  }
  function kvs_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_kvs()
  {
    return $this->_get_value("3");
  }
}
class GameServer_GamerServerTotalScoreChanged extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GamerServerTotalScoreChanged"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GamerServerTotalScoreChanged"]["1"] = "userid";
    self::$fields["GameServer_GamerServerTotalScoreChanged"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GamerServerTotalScoreChanged"]["2"] = "totalScoreChanged";
    self::$fields["GameServer_GamerServerTotalScoreChanged"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GamerServerTotalScoreChanged"]["3"] = "totalScoreAfterChanged";
    self::$fields["GameServer_GamerServerTotalScoreChanged"]["4"] = "GameServer_EnumChangeTotalScoreReason";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GamerServerTotalScoreChanged"]["4"] = "reason";
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
  function reason_string()
  {
    return $this->values["4"]->get_description();
  }
}
class GameServer_GamerServerChangeScoreWithOldConnection extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GamerServerChangeScoreWithOldConnection"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GamerServerChangeScoreWithOldConnection"]["1"] = "userid";
    self::$fields["GameServer_GamerServerChangeScoreWithOldConnection"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GamerServerChangeScoreWithOldConnection"]["2"] = "totalScoreChanged";
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
class GameServer_GameServerSetBroadcast extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerSetBroadcast"]["1"] = "PBBool";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["1"] = "open";
    self::$fields["GameServer_GameServerSetBroadcast"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["2"] = "userid";
    self::$fields["GameServer_GameServerSetBroadcast"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["3"] = "username";
    self::$fields["GameServer_GameServerSetBroadcast"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["4"] = "broadcastid";
    self::$fields["GameServer_GameServerSetBroadcast"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["5"] = "broadcasttype";
    self::$fields["GameServer_GameServerSetBroadcast"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["6"] = "content";
    self::$fields["GameServer_GameServerSetBroadcast"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["7"] = "interval";
    self::$fields["GameServer_GameServerSetBroadcast"]["8"] = "PBInt";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["8"] = "countdown";
    self::$fields["GameServer_GameServerSetBroadcast"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["9"] = "gamecode";
    self::$fields["GameServer_GameServerSetBroadcast"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_GameServerSetBroadcast"]["10"] = "score";
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
class GameServer_GameServerDisconnectLoginServer extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerDisconnectLoginServer"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerDisconnectLoginServer"]["1"] = "time";
    self::$fields["GameServer_GameServerDisconnectLoginServer"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerDisconnectLoginServer"]["2"] = "code";
    self::$fields["GameServer_GameServerDisconnectLoginServer"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerDisconnectLoginServer"]["3"] = "check";
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
class GameServer_GameServerQueryOnlineUserAmount extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerQueryOnlineUserAmount"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerQueryOnlineUserAmount"]["1"] = "game";
    self::$fields["GameServer_GameServerQueryOnlineUserAmount"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerQueryOnlineUserAmount"]["2"] = "blind";
    self::$fields["GameServer_GameServerQueryOnlineUserAmount"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerQueryOnlineUserAmount"]["3"] = "online";
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
class GameServer_AndroidJNIResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AndroidJNIResponse"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AndroidJNIResponse"]["1"] = "key";
    self::$fields["GameServer_AndroidJNIResponse"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AndroidJNIResponse"]["2"] = "value1";
    self::$fields["GameServer_AndroidJNIResponse"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_AndroidJNIResponse"]["3"] = "value2";
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
class GameServer_GameServerKickOnlineUser extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerKickOnlineUser"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerKickOnlineUser"]["1"] = "userid";
    self::$fields["GameServer_GameServerKickOnlineUser"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerKickOnlineUser"]["2"] = "key";
    self::$fields["GameServer_GameServerKickOnlineUser"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerKickOnlineUser"]["3"] = "token";
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
class GameServer_GameServerSwitchDB extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerSwitchDB"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerSwitchDB"]["1"] = "hash";
    self::$fields["GameServer_GameServerSwitchDB"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerSwitchDB"]["2"] = "token";
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
class GameServer_SwitchTarget extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SwitchTarget"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SwitchTarget"]["1"] = "keyone";
    self::$fields["GameServer_SwitchTarget"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SwitchTarget"]["2"] = "keytwo";
    self::$fields["GameServer_SwitchTarget"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SwitchTarget"]["3"] = "token";
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
class GameServer_GameServerAdWallAddChips extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerAdWallAddChips"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerAdWallAddChips"]["1"] = "userid";
    self::$fields["GameServer_GameServerAdWallAddChips"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerAdWallAddChips"]["2"] = "chips";
    self::$fields["GameServer_GameServerAdWallAddChips"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerAdWallAddChips"]["3"] = "str";
    self::$fields["GameServer_GameServerAdWallAddChips"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerAdWallAddChips"]["4"] = "token";
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
class GameServer_GameServerUserPurchaseUpdate extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerUserPurchaseUpdate"]["1"] = "GameServer_EnumUserPurchaseCategory";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerUserPurchaseUpdate"]["1"] = "category";
    self::$fields["GameServer_GameServerUserPurchaseUpdate"]["2"] = "GameServer_EnumUserPurchaseResult";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerUserPurchaseUpdate"]["2"] = "result";
    self::$fields["GameServer_GameServerUserPurchaseUpdate"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerUserPurchaseUpdate"]["3"] = "finalamount";
  }
  function category()
  {
    return $this->_get_value("1");
  }
  function set_category($value)
  {
    return $this->_set_value("1", $value);
  }
  function category_string()
  {
    return $this->values["1"]->get_description();
  }
  function result()
  {
    return $this->_get_value("2");
  }
  function set_result($value)
  {
    return $this->_set_value("2", $value);
  }
  function result_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_ModifyUserInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyUserInfoReq"]["1"] = "GameServer_BasicUserInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyUserInfoReq"]["1"] = "basicUserInfo";
    self::$fields["GameServer_ModifyUserInfoReq"]["2"] = "GameServer_DetailUserInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ModifyUserInfoReq"]["2"] = "detailUserInfo";
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
class GameServer_ModifyUserInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyUserInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyUserInfoRsp"]["1"] = "returncode";
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
class GameServer_AddFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddFriendRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddFriendRequest"]["1"] = "userIDAdd";
    self::$fields["GameServer_AddFriendRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AddFriendRequest"]["2"] = "userIDAdded";
    self::$fields["GameServer_AddFriendRequest"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_AddFriendRequest"]["3"] = "reason";
    self::$fields["GameServer_AddFriendRequest"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_AddFriendRequest"]["4"] = "userInfoAdd";
    self::$fields["GameServer_AddFriendRequest"]["5"] = "GameServer_BasicUserInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_AddFriendRequest"]["5"] = "userInfoAdded";
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
class GameServer_AcceptFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AcceptFriendRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AcceptFriendRequest"]["1"] = "userIDAccept";
    self::$fields["GameServer_AcceptFriendRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AcceptFriendRequest"]["2"] = "userIDAccepted";
    self::$fields["GameServer_AcceptFriendRequest"]["3"] = "GameServer_BasicUserInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_AcceptFriendRequest"]["3"] = "userInfoAccept";
    self::$fields["GameServer_AcceptFriendRequest"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_AcceptFriendRequest"]["4"] = "userInfoAccepted";
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
class GameServer_AcceptFriendResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AcceptFriendResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AcceptFriendResponse"]["1"] = "result";
    self::$fields["GameServer_AcceptFriendResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AcceptFriendResponse"]["2"] = "userIDAccept";
    self::$fields["GameServer_AcceptFriendResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_AcceptFriendResponse"]["3"] = "userIDAccepted";
    self::$fields["GameServer_AcceptFriendResponse"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_AcceptFriendResponse"]["4"] = "userInfoAccept";
    self::$fields["GameServer_AcceptFriendResponse"]["5"] = "GameServer_BasicUserInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_AcceptFriendResponse"]["5"] = "userInfoAccepted";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_RejectFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RejectFriendRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RejectFriendRequest"]["1"] = "userIDReject";
    self::$fields["GameServer_RejectFriendRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_RejectFriendRequest"]["2"] = "userIDRejected";
    self::$fields["GameServer_RejectFriendRequest"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_RejectFriendRequest"]["3"] = "reason";
    self::$fields["GameServer_RejectFriendRequest"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_RejectFriendRequest"]["4"] = "userInfoReject";
    self::$fields["GameServer_RejectFriendRequest"]["5"] = "GameServer_BasicUserInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_RejectFriendRequest"]["5"] = "userInfoRejected";
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
class GameServer_RemoveFriendRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RemoveFriendRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RemoveFriendRequest"]["1"] = "userIDRemove";
    self::$fields["GameServer_RemoveFriendRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_RemoveFriendRequest"]["2"] = "userIDRemoved";
    self::$fields["GameServer_RemoveFriendRequest"]["3"] = "GameServer_BasicUserInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_RemoveFriendRequest"]["3"] = "userInfoRemove";
    self::$fields["GameServer_RemoveFriendRequest"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_RemoveFriendRequest"]["4"] = "userInfoRemoved";
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
class GameServer_RemoveFriendResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RemoveFriendResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RemoveFriendResponse"]["1"] = "result";
    self::$fields["GameServer_RemoveFriendResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_RemoveFriendResponse"]["2"] = "userIDRemove";
    self::$fields["GameServer_RemoveFriendResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_RemoveFriendResponse"]["3"] = "userIDRemoved";
    self::$fields["GameServer_RemoveFriendResponse"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_RemoveFriendResponse"]["4"] = "userInfoRemove";
    self::$fields["GameServer_RemoveFriendResponse"]["5"] = "GameServer_BasicUserInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_RemoveFriendResponse"]["5"] = "userInfoRemoved";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_RemoveFriendBC extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RemoveFriendBC"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RemoveFriendBC"]["1"] = "userIDRemove";
    self::$fields["GameServer_RemoveFriendBC"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_RemoveFriendBC"]["2"] = "userIDRemoved";
    self::$fields["GameServer_RemoveFriendBC"]["3"] = "GameServer_BasicUserInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_RemoveFriendBC"]["3"] = "userInfoRemove";
    self::$fields["GameServer_RemoveFriendBC"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_RemoveFriendBC"]["4"] = "userInfoRemoved";
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
class GameServer_GetAddFriendRequestListRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetAddFriendRequestListRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListRequest"]["1"] = "userID";
    self::$fields["GameServer_GetAddFriendRequestListRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListRequest"]["2"] = "sessionID";
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
class GameServer_GetAddFriendRequestListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetAddFriendRequestListResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListResponse"]["1"] = "result";
    self::$fields["GameServer_GetAddFriendRequestListResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListResponse"]["2"] = "userID";
    self::$fields["GameServer_GetAddFriendRequestListResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListResponse"]["3"] = "sessionID";
    self::$fields["GameServer_GetAddFriendRequestListResponse"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = array();
    self::$fieldNames["GameServer_GetAddFriendRequestListResponse"]["4"] = "userInfos";
    self::$fields["GameServer_GetAddFriendRequestListResponse"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GetAddFriendRequestListResponse"]["5"] = "end";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_userInfoss($values)
  {
    return $this->_set_arr_values("4", $values);
  }
  function remove_last_userInfos()
  {
    $this->_remove_last_arr_value("4");
  }
  function userInfoss_size()
  {
    return $this->_get_arr_size("4");
  }
  function get_userInfoss()
  {
    return $this->_get_value("4");
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
class GameServer_GetFriendListRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetFriendListRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetFriendListRequest"]["1"] = "userID";
    self::$fields["GameServer_GetFriendListRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetFriendListRequest"]["2"] = "sessionID";
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
class GameServer_GetFriendListResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetFriendListResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetFriendListResponse"]["1"] = "result";
    self::$fields["GameServer_GetFriendListResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetFriendListResponse"]["2"] = "userID";
    self::$fields["GameServer_GetFriendListResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GetFriendListResponse"]["3"] = "sessionID";
    self::$fields["GameServer_GetFriendListResponse"]["4"] = "GameServer_BasicUserInfo";
    $this->values["4"] = array();
    self::$fieldNames["GameServer_GetFriendListResponse"]["4"] = "userInfos";
    self::$fields["GameServer_GetFriendListResponse"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GetFriendListResponse"]["5"] = "end";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_userInfoss($values)
  {
    return $this->_set_arr_values("4", $values);
  }
  function remove_last_userInfos()
  {
    $this->_remove_last_arr_value("4");
  }
  function userInfoss_size()
  {
    return $this->_get_arr_size("4");
  }
  function get_userInfoss()
  {
    return $this->_get_value("4");
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
class GameServer_SingleChatMsg extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SingleChatMsg"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["1"] = "userIDFrom";
    self::$fields["GameServer_SingleChatMsg"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["2"] = "userIDTo";
    self::$fields["GameServer_SingleChatMsg"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["3"] = "msg";
    self::$fields["GameServer_SingleChatMsg"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["4"] = "timestamp";
    self::$fields["GameServer_SingleChatMsg"]["5"] = "GameServer_BasicUserInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["5"] = "userInfoFrom";
    self::$fields["GameServer_SingleChatMsg"]["6"] = "GameServer_BasicUserInfo";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SingleChatMsg"]["6"] = "userInfoTo";
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
class GameServer_GetOfflineMsgRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetOfflineMsgRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgRequest"]["1"] = "userID";
    self::$fields["GameServer_GetOfflineMsgRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgRequest"]["2"] = "sessionID";
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
class GameServer_GetOfflineMsgResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetOfflineMsgResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgResponse"]["1"] = "result";
    self::$fields["GameServer_GetOfflineMsgResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgResponse"]["2"] = "userID";
    self::$fields["GameServer_GetOfflineMsgResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgResponse"]["3"] = "sessionID";
    self::$fields["GameServer_GetOfflineMsgResponse"]["4"] = "GameServer_SingleChatMsg";
    $this->values["4"] = array();
    self::$fieldNames["GameServer_GetOfflineMsgResponse"]["4"] = "msgs";
    self::$fields["GameServer_GetOfflineMsgResponse"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GetOfflineMsgResponse"]["5"] = "end";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_msgss($values)
  {
    return $this->_set_arr_values("4", $values);
  }
  function remove_last_msgs()
  {
    $this->_remove_last_arr_value("4");
  }
  function msgss_size()
  {
    return $this->_get_arr_size("4");
  }
  function get_msgss()
  {
    return $this->_get_value("4");
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
class GameServer_AddSystemBroadcastReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddSystemBroadcastReq"]["1"] = "GameServer_GameServerSetBroadcast";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddSystemBroadcastReq"]["1"] = "broadcastinfo";
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
class GameServer_AddSystemBroadcastRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddSystemBroadcastRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddSystemBroadcastRsp"]["1"] = "returncode";
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
class GameServer_DeleteSystemBroadcastReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteSystemBroadcastReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteSystemBroadcastReq"]["1"] = "userid";
    self::$fields["GameServer_DeleteSystemBroadcastReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DeleteSystemBroadcastReq"]["2"] = "broadcastid";
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
class GameServer_DeleteSystemBroadcastRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteSystemBroadcastRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteSystemBroadcastRsp"]["1"] = "returncode";
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
class GameServer_AddOnceBroadcastReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddOnceBroadcastReq"]["1"] = "GameServer_GameServerSetBroadcast";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddOnceBroadcastReq"]["1"] = "broadcastinfo";
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
class GameServer_AddOnceBroadcastRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddOnceBroadcastRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddOnceBroadcastRsp"]["1"] = "returncode";
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
class GameServer_GameServerPresentScoreRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerPresentScoreRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreRequest"]["1"] = "userIDFrom";
    self::$fields["GameServer_GameServerPresentScoreRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreRequest"]["2"] = "userIDTo";
    self::$fields["GameServer_GameServerPresentScoreRequest"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreRequest"]["3"] = "score";
    self::$fields["GameServer_GameServerPresentScoreRequest"]["4"] = "GameServer_EnumGameType";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreRequest"]["4"] = "gameType";
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
  function gameType_string()
  {
    return $this->values["4"]->get_description();
  }
}
class GameServer_GameServerPresentScoreResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameServerPresentScoreResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["1"] = "result";
    self::$fields["GameServer_GameServerPresentScoreResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["2"] = "userIDFrom";
    self::$fields["GameServer_GameServerPresentScoreResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["3"] = "userIDTo";
    self::$fields["GameServer_GameServerPresentScoreResponse"]["4"] = "GameServer_EnumGameType";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["4"] = "gameType";
    self::$fields["GameServer_GameServerPresentScoreResponse"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["5"] = "scoreFrom";
    self::$fields["GameServer_GameServerPresentScoreResponse"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_GameServerPresentScoreResponse"]["6"] = "scoreTo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function gameType_string()
  {
    return $this->values["4"]->get_description();
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
class GameServer_PropertyInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_PropertyInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["1"] = "id";
    self::$fields["GameServer_PropertyInfo"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["2"] = "name";
    self::$fields["GameServer_PropertyInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["3"] = "price";
    self::$fields["GameServer_PropertyInfo"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["4"] = "picurl";
    self::$fields["GameServer_PropertyInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["5"] = "type";
    self::$fields["GameServer_PropertyInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_PropertyInfo"]["6"] = "sellpercentage";
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
class GameServer_QueryUserPropertyReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryUserPropertyReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyReq"]["1"] = "userID";
    self::$fields["GameServer_QueryUserPropertyReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyReq"]["2"] = "sessionID";
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
class GameServer_QueryUserPropertyRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryUserPropertyRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryUserPropertyRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyRsp"]["2"] = "sessionID";
    self::$fields["GameServer_QueryUserPropertyRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyRsp"]["3"] = "userID";
    self::$fields["GameServer_QueryUserPropertyRsp"]["4"] = "GameServer_PropertyInfo";
    $this->values["4"] = array();
    self::$fieldNames["GameServer_QueryUserPropertyRsp"]["4"] = "properties";
    self::$fields["GameServer_QueryUserPropertyRsp"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_QueryUserPropertyRsp"]["5"] = "end";
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
  function set_all_propertiess($values)
  {
    return $this->_set_arr_values("4", $values);
  }
  function remove_last_properties()
  {
    $this->_remove_last_arr_value("4");
  }
  function propertiess_size()
  {
    return $this->_get_arr_size("4");
  }
  function get_propertiess()
  {
    return $this->_get_value("4");
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
class GameServer_BuyPropertyReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuyPropertyReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuyPropertyReq"]["1"] = "userIDFrom";
    self::$fields["GameServer_BuyPropertyReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuyPropertyReq"]["2"] = "userIDTo";
    self::$fields["GameServer_BuyPropertyReq"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuyPropertyReq"]["3"] = "propertyID";
    self::$fields["GameServer_BuyPropertyReq"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_BuyPropertyReq"]["4"] = "price";
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
class GameServer_BuyPropertyRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuyPropertyRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuyPropertyRsp"]["1"] = "returncode";
    self::$fields["GameServer_BuyPropertyRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuyPropertyRsp"]["2"] = "userIDFrom";
    self::$fields["GameServer_BuyPropertyRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuyPropertyRsp"]["3"] = "userIDTo";
    self::$fields["GameServer_BuyPropertyRsp"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_BuyPropertyRsp"]["4"] = "subscore";
    self::$fields["GameServer_BuyPropertyRsp"]["5"] = "GameServer_PropertyInfo";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_BuyPropertyRsp"]["5"] = "properyInfo";
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
class GameServer_SellPropertyReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SellPropertyReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SellPropertyReq"]["1"] = "userID";
    self::$fields["GameServer_SellPropertyReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SellPropertyReq"]["2"] = "propertyID";
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
class GameServer_SellPropertyRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SellPropertyRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SellPropertyRsp"]["1"] = "returncode";
    self::$fields["GameServer_SellPropertyRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SellPropertyRsp"]["2"] = "userID";
    self::$fields["GameServer_SellPropertyRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SellPropertyRsp"]["3"] = "addscore";
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
class GameServer_GiftInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GiftInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GiftInfo"]["1"] = "id";
    self::$fields["GameServer_GiftInfo"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GiftInfo"]["2"] = "name";
    self::$fields["GameServer_GiftInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GiftInfo"]["3"] = "price";
    self::$fields["GameServer_GiftInfo"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GiftInfo"]["4"] = "picurl";
    self::$fields["GameServer_GiftInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GiftInfo"]["5"] = "type";
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
class GameServer_BuyGiftRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuyGiftRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuyGiftRequest"]["1"] = "userIDFrom";
    self::$fields["GameServer_BuyGiftRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuyGiftRequest"]["2"] = "userIDTo";
    self::$fields["GameServer_BuyGiftRequest"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuyGiftRequest"]["3"] = "giftID";
    self::$fields["GameServer_BuyGiftRequest"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_BuyGiftRequest"]["4"] = "price";
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
class GameServer_BuyGiftResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuyGiftResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuyGiftResponse"]["1"] = "result";
    self::$fields["GameServer_BuyGiftResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuyGiftResponse"]["2"] = "userIDFrom";
    self::$fields["GameServer_BuyGiftResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuyGiftResponse"]["3"] = "userIDTo";
    self::$fields["GameServer_BuyGiftResponse"]["4"] = "GameServer_GiftInfo";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_BuyGiftResponse"]["4"] = "giftInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_QueryGiftInfoByIDRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryGiftInfoByIDRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryGiftInfoByIDRequest"]["1"] = "giftID";
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
class GameServer_QueryGiftInfoByIDResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryGiftInfoByIDResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryGiftInfoByIDResponse"]["1"] = "result";
    self::$fields["GameServer_QueryGiftInfoByIDResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryGiftInfoByIDResponse"]["2"] = "giftID";
    self::$fields["GameServer_QueryGiftInfoByIDResponse"]["3"] = "GameServer_GiftInfo";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_QueryGiftInfoByIDResponse"]["3"] = "giftInfo";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_ModifyPropertyRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyPropertyRequest"]["1"] = "GameServer_PropertyInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyPropertyRequest"]["1"] = "property";
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
class GameServer_ModifyPropertyResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyPropertyResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyPropertyResponse"]["1"] = "returncode";
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
class GameServer_DelPropertyRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DelPropertyRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DelPropertyRequest"]["1"] = "propertyid";
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
class GameServer_DelPropertyResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DelPropertyResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DelPropertyResponse"]["1"] = "returncode";
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
class GameServer_ModifyGiftRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyGiftRequest"]["1"] = "GameServer_GiftInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyGiftRequest"]["1"] = "gift";
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
class GameServer_ModifyGiftResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyGiftResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyGiftResponse"]["1"] = "returncode";
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
class GameServer_DelGiftRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DelGiftRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DelGiftRequest"]["1"] = "giftid";
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
class GameServer_DelGiftResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DelGiftResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DelGiftResponse"]["1"] = "returncode";
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
class GameServer_SwitchDispatchRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SwitchDispatchRequest"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SwitchDispatchRequest"]["1"] = "ip";
    self::$fields["GameServer_SwitchDispatchRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SwitchDispatchRequest"]["2"] = "port";
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
class GameServer_SwitchDispatchResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SwitchDispatchResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SwitchDispatchResponse"]["1"] = "returncode";
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
class GameServer_QuerytAllBroadcastRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QuerytAllBroadcastRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QuerytAllBroadcastRequest"]["1"] = "sessionID";
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
class GameServer_QuerytAllBroadcastResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QuerytAllBroadcastResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QuerytAllBroadcastResponse"]["1"] = "returncode";
    self::$fields["GameServer_QuerytAllBroadcastResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QuerytAllBroadcastResponse"]["2"] = "sessionID";
    self::$fields["GameServer_QuerytAllBroadcastResponse"]["3"] = "GameServer_GameServerSetBroadcast";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_QuerytAllBroadcastResponse"]["3"] = "broadcasts";
    self::$fields["GameServer_QuerytAllBroadcastResponse"]["4"] = "PBBool";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_QuerytAllBroadcastResponse"]["4"] = "end";
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
  function set_all_broadcastss($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_broadcasts()
  {
    $this->_remove_last_arr_value("3");
  }
  function broadcastss_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_broadcastss()
  {
    return $this->_get_value("3");
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
class GameServer_OnlineRewardDefine extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_OnlineRewardDefine"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_OnlineRewardDefine"]["1"] = "time";
    self::$fields["GameServer_OnlineRewardDefine"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_OnlineRewardDefine"]["2"] = "reward";
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
class GameServer_OnlineRewardRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_OnlineRewardRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_OnlineRewardRequest"]["1"] = "userID";
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
class GameServer_OnlineRewardResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_OnlineRewardResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_OnlineRewardResponse"]["1"] = "result";
    self::$fields["GameServer_OnlineRewardResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_OnlineRewardResponse"]["2"] = "userID";
    self::$fields["GameServer_OnlineRewardResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_OnlineRewardResponse"]["3"] = "reward";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_TableRewardPoolInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TableRewardPoolInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TableRewardPoolInfo"]["1"] = "score";
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
class GameServer_TableReward extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TableReward"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TableReward"]["1"] = "userID";
    self::$fields["GameServer_TableReward"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TableReward"]["2"] = "scoreAdd";
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
class GameServer_SubSpeakerRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SubSpeakerRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SubSpeakerRequest"]["1"] = "userID";
    self::$fields["GameServer_SubSpeakerRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SubSpeakerRequest"]["2"] = "speakernumtosub";
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
class GameServer_SubSpeakerResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SubSpeakerResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SubSpeakerResponse"]["1"] = "returncode";
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
class GameServer_StartRouletteRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_StartRouletteRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_StartRouletteRequest"]["1"] = "userID";
    self::$fields["GameServer_StartRouletteRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_StartRouletteRequest"]["2"] = "costchips";
    self::$fields["GameServer_StartRouletteRequest"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_StartRouletteRequest"]["3"] = "gamecode";
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
class GameServer_StartRouletteResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_StartRouletteResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_StartRouletteResponse"]["1"] = "returncode";
    self::$fields["GameServer_StartRouletteResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_StartRouletteResponse"]["2"] = "costchips";
    self::$fields["GameServer_StartRouletteResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_StartRouletteResponse"]["3"] = "winchips";
    self::$fields["GameServer_StartRouletteResponse"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_StartRouletteResponse"]["4"] = "userID";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
  {
    return $this->_set_value("1", $value);
  }
  function returncode_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GetNotificationRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetNotificationRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetNotificationRequest"]["1"] = "sessionID";
    self::$fields["GameServer_GetNotificationRequest"]["2"] = "GameServer_EnumSysNotificationType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetNotificationRequest"]["2"] = "notificationType";
    self::$fields["GameServer_GetNotificationRequest"]["3"] = "GameServer_EnumLanguageType";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GetNotificationRequest"]["3"] = "notificationLanguageType";
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
  function notificationType_string()
  {
    return $this->values["2"]->get_description();
  }
  function notificationLanguageType()
  {
    return $this->_get_value("3");
  }
  function set_notificationLanguageType($value)
  {
    return $this->_set_value("3", $value);
  }
  function notificationLanguageType_string()
  {
    return $this->values["3"]->get_description();
  }
}
class GameServer_SingleNotification extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SingleNotification"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["1"] = "notificationID";
    self::$fields["GameServer_SingleNotification"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["2"] = "notificationTitle";
    self::$fields["GameServer_SingleNotification"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["3"] = "notificationContent";
    self::$fields["GameServer_SingleNotification"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["4"] = "notificationAddTime";
    self::$fields["GameServer_SingleNotification"]["5"] = "GameServer_EnumSysNotificationType";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["5"] = "notificationType";
    self::$fields["GameServer_SingleNotification"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["6"] = "notificationGamecode";
    self::$fields["GameServer_SingleNotification"]["7"] = "GameServer_EnumLanguageType";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["7"] = "notificationLanguageType";
    self::$fields["GameServer_SingleNotification"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["8"] = "notificationSummary";
    self::$fields["GameServer_SingleNotification"]["9"] = "PBString";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["9"] = "notificationForcePopTime";
    self::$fields["GameServer_SingleNotification"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["10"] = "notificationForcePopTimeInt";
    self::$fields["GameServer_SingleNotification"]["11"] = "PBInt";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_SingleNotification"]["11"] = "bNotified";
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
  function notificationType_string()
  {
    return $this->values["5"]->get_description();
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
  function notificationLanguageType_string()
  {
    return $this->values["7"]->get_description();
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
class GameServer_GetNotificationResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetNotificationResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetNotificationResponse"]["1"] = "result";
    self::$fields["GameServer_GetNotificationResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetNotificationResponse"]["2"] = "sessionID";
    self::$fields["GameServer_GetNotificationResponse"]["3"] = "GameServer_SingleNotification";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_GetNotificationResponse"]["3"] = "notifications";
    self::$fields["GameServer_GetNotificationResponse"]["4"] = "PBBool";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GetNotificationResponse"]["4"] = "end";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_notificationss($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_notifications()
  {
    $this->_remove_last_arr_value("3");
  }
  function notificationss_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_notificationss()
  {
    return $this->_get_value("3");
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
class GameServer_AddNotificationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddNotificationReq"]["1"] = "GameServer_SingleNotification";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddNotificationReq"]["1"] = "notification";
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
class GameServer_AddNotificationRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddNotificationRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddNotificationRsp"]["1"] = "returncode";
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
class GameServer_ModifyNotificationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyNotificationReq"]["1"] = "GameServer_SingleNotification";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyNotificationReq"]["1"] = "notification";
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
class GameServer_ModifyNotificationRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyNotificationRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyNotificationRsp"]["1"] = "returncode";
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
class GameServer_DeleteNotificationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteNotificationReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteNotificationReq"]["1"] = "notificationID";
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
class GameServer_DeleteNotificationRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteNotificationRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteNotificationRsp"]["1"] = "returncode";
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
class GameServer_AddNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddNotificationNotify"]["1"] = "GameServer_SingleNotification";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_AddNotificationNotify"]["1"] = "notification";
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
  function set_all_notifications($values)
  {
    return $this->_set_arr_values("1", $values);
  }
  function remove_last_notification()
  {
    $this->_remove_last_arr_value("1");
  }
  function notifications_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_notifications()
  {
    return $this->_get_value("1");
  }
}
class GameServer_DeleteNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteNotificationNotify"]["1"] = "PBInt";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_DeleteNotificationNotify"]["1"] = "notificationID";
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
    $v = new self::$fields["GameServer_DeleteNotificationNotify"]["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_notificationID()
  {
    $this->_remove_last_arr_value("1");
  }
  function notificationIDs_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_notificationIDs()
  {
    return $this->_get_value("1");
  }
}
class GameServer_ForcePopNotificationNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ForcePopNotificationNotify"]["1"] = "PBInt";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_ForcePopNotificationNotify"]["1"] = "notificationID";
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
    $v = new self::$fields["GameServer_ForcePopNotificationNotify"]["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_notificationID()
  {
    $this->_remove_last_arr_value("1");
  }
  function notificationIDs_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_notificationIDs()
  {
    return $this->_get_value("1");
  }
}
class GameServer_GetActivityRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetActivityRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetActivityRequest"]["1"] = "sessionID";
    self::$fields["GameServer_GetActivityRequest"]["2"] = "GameServer_EnumLanguageType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetActivityRequest"]["2"] = "activityLanguageType";
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
  function activityLanguageType_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_SingleActivity extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SingleActivity"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["1"] = "activityID";
    self::$fields["GameServer_SingleActivity"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["2"] = "activityTitle";
    self::$fields["GameServer_SingleActivity"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["3"] = "activityContent";
    self::$fields["GameServer_SingleActivity"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["4"] = "activityAddTime";
    self::$fields["GameServer_SingleActivity"]["5"] = "GameServer_EnumSysActivityType";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["5"] = "activityType";
    self::$fields["GameServer_SingleActivity"]["6"] = "GameServer_EnumSysActivityExpiredType";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["6"] = "activityExpired";
    self::$fields["GameServer_SingleActivity"]["7"] = "PBString";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["7"] = "activityPicUrl";
    self::$fields["GameServer_SingleActivity"]["8"] = "PBInt";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["8"] = "activityGamecode";
    self::$fields["GameServer_SingleActivity"]["9"] = "GameServer_EnumLanguageType";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["9"] = "activityLanguageType";
    self::$fields["GameServer_SingleActivity"]["10"] = "PBString";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["10"] = "activitySummary";
    self::$fields["GameServer_SingleActivity"]["11"] = "PBString";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["11"] = "activityExpiredTime";
    self::$fields["GameServer_SingleActivity"]["12"] = "PBString";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["12"] = "activityAutoInvalidTime";
    self::$fields["GameServer_SingleActivity"]["13"] = "PBInt";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["13"] = "activityExpiredTimeInt";
    self::$fields["GameServer_SingleActivity"]["14"] = "PBInt";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_SingleActivity"]["14"] = "activityAutoInvalidTimeInt";
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
  function activityType_string()
  {
    return $this->values["5"]->get_description();
  }
  function activityExpired()
  {
    return $this->_get_value("6");
  }
  function set_activityExpired($value)
  {
    return $this->_set_value("6", $value);
  }
  function activityExpired_string()
  {
    return $this->values["6"]->get_description();
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
  function activityLanguageType_string()
  {
    return $this->values["9"]->get_description();
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
class GameServer_GetActivityResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetActivityResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetActivityResponse"]["1"] = "result";
    self::$fields["GameServer_GetActivityResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetActivityResponse"]["2"] = "sessionID";
    self::$fields["GameServer_GetActivityResponse"]["3"] = "GameServer_SingleActivity";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_GetActivityResponse"]["3"] = "activities";
    self::$fields["GameServer_GetActivityResponse"]["4"] = "PBBool";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GetActivityResponse"]["4"] = "end";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function set_all_activitiess($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_activities()
  {
    $this->_remove_last_arr_value("3");
  }
  function activitiess_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_activitiess()
  {
    return $this->_get_value("3");
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
class GameServer_AddActivityReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddActivityReq"]["1"] = "GameServer_SingleActivity";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddActivityReq"]["1"] = "activity";
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
class GameServer_AddActivityRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddActivityRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddActivityRsp"]["1"] = "returncode";
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
class GameServer_ModifyActivityReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyActivityReq"]["1"] = "GameServer_SingleActivity";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyActivityReq"]["1"] = "activity";
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
class GameServer_ModifyActivityRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyActivityRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyActivityRsp"]["1"] = "returncode";
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
class GameServer_DeleteActivityReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteActivityReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteActivityReq"]["1"] = "activityID";
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
class GameServer_DeleteActivityRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteActivityRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteActivityRsp"]["1"] = "returncode";
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
class GameServer_AddActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddActivityNotify"]["1"] = "GameServer_SingleActivity";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_AddActivityNotify"]["1"] = "activity";
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
  function set_all_activitys($values)
  {
    return $this->_set_arr_values("1", $values);
  }
  function remove_last_activity()
  {
    $this->_remove_last_arr_value("1");
  }
  function activitys_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_activitys()
  {
    return $this->_get_value("1");
  }
}
class GameServer_DeleteActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteActivityNotify"]["1"] = "PBInt";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_DeleteActivityNotify"]["1"] = "activityID";
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
    $v = new self::$fields["GameServer_DeleteActivityNotify"]["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_activityID()
  {
    $this->_remove_last_arr_value("1");
  }
  function activityIDs_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_activityIDs()
  {
    return $this->_get_value("1");
  }
}
class GameServer_ForcePopActivityNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ForcePopActivityNotify"]["1"] = "PBInt";
    $this->values["1"] = array();
    self::$fieldNames["GameServer_ForcePopActivityNotify"]["1"] = "activityID";
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
    $v = new self::$fields["GameServer_ForcePopActivityNotify"]["1"]();
    $v->set_value($value);
    $this->_set_arr_value("1", $index, $v);
  }
  function remove_last_activityID()
  {
    $this->_remove_last_arr_value("1");
  }
  function activityIDs_size()
  {
    return $this->_get_arr_size("1");
  }
  function get_activityIDs()
  {
    return $this->_get_value("1");
  }
}
class GameServer_BuySpeakerReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuySpeakerReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuySpeakerReq"]["1"] = "userID";
    self::$fields["GameServer_BuySpeakerReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuySpeakerReq"]["2"] = "speakerNum";
    self::$fields["GameServer_BuySpeakerReq"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuySpeakerReq"]["3"] = "totalPrice";
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
class GameServer_BuySpeakerRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_BuySpeakerRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_BuySpeakerRsp"]["1"] = "returncode";
    self::$fields["GameServer_BuySpeakerRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_BuySpeakerRsp"]["2"] = "userID";
    self::$fields["GameServer_BuySpeakerRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_BuySpeakerRsp"]["3"] = "subscore";
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
class GameServer_KickUserFromTableRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_KickUserFromTableRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_KickUserFromTableRequest"]["1"] = "userIDKicked";
    self::$fields["GameServer_KickUserFromTableRequest"]["2"] = "GameServer_EnumGameType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_KickUserFromTableRequest"]["2"] = "gameType";
    self::$fields["GameServer_KickUserFromTableRequest"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_KickUserFromTableRequest"]["3"] = "tableID";
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
  function gameType_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_KickUserFromTableResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_KickUserFromTableResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_KickUserFromTableResponse"]["1"] = "result";
    self::$fields["GameServer_KickUserFromTableResponse"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_KickUserFromTableResponse"]["2"] = "userIDKick";
    self::$fields["GameServer_KickUserFromTableResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_KickUserFromTableResponse"]["3"] = "userIDKicked";
    self::$fields["GameServer_KickUserFromTableResponse"]["4"] = "GameServer_EnumGameType";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_KickUserFromTableResponse"]["4"] = "gameType";
    self::$fields["GameServer_KickUserFromTableResponse"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_KickUserFromTableResponse"]["5"] = "tableID";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
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
  function gameType_string()
  {
    return $this->values["4"]->get_description();
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
class GameServer_ExchangeToolRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeToolRequest"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeToolRequest"]["1"] = "userID";
    self::$fields["GameServer_ExchangeToolRequest"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeToolRequest"]["2"] = "productID";
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
class GameServer_ExchangeToolResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeToolResponse"]["1"] = "GameServer_EnumResult";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeToolResponse"]["1"] = "result";
  }
  function result()
  {
    return $this->_get_value("1");
  }
  function set_result($value)
  {
    return $this->_set_value("1", $value);
  }
  function result_string()
  {
    return $this->values["1"]->get_description();
  }
}
class GameServer_EnumTaskCategory extends PBEnum
{
  const enumTaskCategoryContinousWin  = 1;
  const enumTaskCategoryGetOneCardType  = 2;
  const enumTaskCategoryPlaySomeCards  = 3;
  const enumTaskCategoryPlaySomeCardsAndWin  = 4;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumTaskCategoryContinousWin",
			2 => "enumTaskCategoryGetOneCardType",
			3 => "enumTaskCategoryPlaySomeCards",
			4 => "enumTaskCategoryPlaySomeCardsAndWin");
   }
}
class GameServer_EnumTaskRewardType extends PBEnum
{
  const enumTaskRewardTypeChips  = 1;
  const enumTaskRewardTypeYuanBao  = 2;

  public function __construct($reader=null)
  {
   	parent::__construct($reader);
 	$this->names = array(
			1 => "enumTaskRewardTypeChips",
			2 => "enumTaskRewardTypeYuanBao");
   }
}
class GameServer_TaskProperty extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TaskProperty"]["1"] = "GameServer_EnumTaskCategory";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TaskProperty"]["1"] = "taskCategory";
    self::$fields["GameServer_TaskProperty"]["2"] = "PBInt";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_TaskProperty"]["2"] = "cards";
    self::$fields["GameServer_TaskProperty"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TaskProperty"]["3"] = "todoCount";
    self::$fields["GameServer_TaskProperty"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_TaskProperty"]["4"] = "todoCardType";
  }
  function taskCategory()
  {
    return $this->_get_value("1");
  }
  function set_taskCategory($value)
  {
    return $this->_set_value("1", $value);
  }
  function taskCategory_string()
  {
    return $this->values["1"]->get_description();
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
    $v = new self::$fields["GameServer_TaskProperty"]["2"]();
    $v->set_value($value);
    $this->_set_arr_value("2", $index, $v);
  }
  function remove_last_cards()
  {
    $this->_remove_last_arr_value("2");
  }
  function cardss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_cardss()
  {
    return $this->_get_value("2");
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
class GameServer_TaskToDoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TaskToDoNotify"]["1"] = "GameServer_TaskProperty";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TaskToDoNotify"]["1"] = "taskProperty";
    self::$fields["GameServer_TaskToDoNotify"]["2"] = "GameServer_EnumTaskRewardType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TaskToDoNotify"]["2"] = "rewardType";
    self::$fields["GameServer_TaskToDoNotify"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TaskToDoNotify"]["3"] = "rewardCount";
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
  function rewardType_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_TaskFinishNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TaskFinishNotify"]["1"] = "GameServer_TaskProperty";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TaskFinishNotify"]["1"] = "taskProperty";
    self::$fields["GameServer_TaskFinishNotify"]["2"] = "GameServer_EnumTaskRewardType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TaskFinishNotify"]["2"] = "rewardType";
    self::$fields["GameServer_TaskFinishNotify"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TaskFinishNotify"]["3"] = "rewardCount";
    self::$fields["GameServer_TaskFinishNotify"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_TaskFinishNotify"]["4"] = "userID";
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
  function rewardType_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_AddFlagReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddFlagReq"]["1"] = "GameServer_FlagInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddFlagReq"]["1"] = "flag";
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
class GameServer_AddFlagRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddFlagRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddFlagRsp"]["1"] = "returncode";
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
class GameServer_DeleteFlagReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteFlagReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteFlagReq"]["1"] = "flagID";
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
class GameServer_DeleteFlagRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteFlagRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteFlagRsp"]["1"] = "returncode";
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
class GameServer_AddFlagForUserReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddFlagForUserReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddFlagForUserReq"]["1"] = "flagID";
    self::$fields["GameServer_AddFlagForUserReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AddFlagForUserReq"]["2"] = "userID";
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
class GameServer_AddFlagForUserRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddFlagForUserRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddFlagForUserRsp"]["1"] = "returncode";
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
class GameServer_FeedBackOperationReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FeedBackOperationReq"]["1"] = "GameServer_EnumFeedBackOperation";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_FeedBackOperationReq"]["1"] = "operation";
    self::$fields["GameServer_FeedBackOperationReq"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_FeedBackOperationReq"]["2"] = "startTime";
    self::$fields["GameServer_FeedBackOperationReq"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_FeedBackOperationReq"]["3"] = "endTime";
    self::$fields["GameServer_FeedBackOperationReq"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_FeedBackOperationReq"]["4"] = "gamecode";
  }
  function operation()
  {
    return $this->_get_value("1");
  }
  function set_operation($value)
  {
    return $this->_set_value("1", $value);
  }
  function operation_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_FeedBackOperationRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FeedBackOperationRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_FeedBackOperationRsp"]["1"] = "returncode";
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
class GameServer_ServerClientBroadcastData extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ServerClientBroadcastData"]["1"] = "GameServer_EnumBroadcastEventType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ServerClientBroadcastData"]["1"] = "broadcastEventType";
    self::$fields["GameServer_ServerClientBroadcastData"]["2"] = "PBBytes";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ServerClientBroadcastData"]["2"] = "serialized";
  }
  function broadcastEventType()
  {
    return $this->_get_value("1");
  }
  function set_broadcastEventType($value)
  {
    return $this->_set_value("1", $value);
  }
  function broadcastEventType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_XiaoLaBaNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_XiaoLaBaNotify"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["1"] = "gameCode";
    self::$fields["GameServer_XiaoLaBaNotify"]["2"] = "GameServer_EnumXiaoLaBaNotifyType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["2"] = "type";
    self::$fields["GameServer_XiaoLaBaNotify"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["3"] = "value";
    self::$fields["GameServer_XiaoLaBaNotify"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["4"] = "userID";
    self::$fields["GameServer_XiaoLaBaNotify"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["5"] = "nickName";
    self::$fields["GameServer_XiaoLaBaNotify"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_XiaoLaBaNotify"]["6"] = "baseScore";
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
  function type_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_SpeakerAutoSendConfigInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["1"] = "msgBuyThreshold";
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["2"] = "commonBuyThreshold";
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["3"] = "GameServer_EnumZhajinhuaCardType";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["3"] = "zhaJinHuaCardTypeThreshold";
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["4"] = "singleTurnWinThreshold";
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["5"] = "rouletteWinThreshold";
    self::$fields["GameServer_SpeakerAutoSendConfigInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SpeakerAutoSendConfigInfo"]["6"] = "tableRewardThreshold";
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
  function zhaJinHuaCardTypeThreshold_string()
  {
    return $this->values["3"]->get_description();
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
class GameServer_GetSpeakerAutoSendConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetSpeakerAutoSendConfigReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetSpeakerAutoSendConfigReq"]["1"] = "gameCode";
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
class GameServer_GetSpeakerAutoSendConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetSpeakerAutoSendConfigRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetSpeakerAutoSendConfigRsp"]["1"] = "returncode";
    self::$fields["GameServer_GetSpeakerAutoSendConfigRsp"]["2"] = "GameServer_SpeakerAutoSendConfigInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GetSpeakerAutoSendConfigRsp"]["2"] = "configInfo";
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
class GameServer_ModifySpeakerAutoSendConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifySpeakerAutoSendConfigReq"]["1"] = "GameServer_SpeakerAutoSendConfigInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifySpeakerAutoSendConfigReq"]["1"] = "configInfo";
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
class GameServer_ModifySpeakerAutoSendConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifySpeakerAutoSendConfigRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifySpeakerAutoSendConfigRsp"]["1"] = "returncode";
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
class GameServer_ModifySpeakerAutoSendConfigNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifySpeakerAutoSendConfigNotify"]["1"] = "GameServer_SpeakerAutoSendConfigInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifySpeakerAutoSendConfigNotify"]["1"] = "configInfo";
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
class GameServer_RoomInfoItem extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RoomInfoItem"]["1"] = "PBString";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RoomInfoItem"]["1"] = "configKey";
    self::$fields["GameServer_RoomInfoItem"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_RoomInfoItem"]["2"] = "configValue";
  }
  function configKey()
  {
    return $this->_get_value("1");
  }
  function set_configKey($value)
  {
    return $this->_set_value("1", $value);
  }
  function configValue()
  {
    return $this->_get_value("2");
  }
  function set_configValue($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServer_RoomInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_RoomInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_RoomInfo"]["1"] = "roomid";
    self::$fields["GameServer_RoomInfo"]["2"] = "GameServer_RoomInfoItem";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_RoomInfo"]["2"] = "roomInfoItems";
  }
  function roomid()
  {
    return $this->_get_value("1");
  }
  function set_roomid($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfoItems($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_roomInfoItems()
  {
    return $this->_add_arr_value("2");
  }
  function set_roomInfoItems($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function set_all_roomInfoItemss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_roomInfoItems()
  {
    $this->_remove_last_arr_value("2");
  }
  function roomInfoItemss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_roomInfoItemss()
  {
    return $this->_get_value("2");
  }
}
class GameServer_GetRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetRoomInfoReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetRoomInfoReq"]["1"] = "gameType";
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
class GameServer_GetRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetRoomInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetRoomInfoRsp"]["1"] = "gameType";
    self::$fields["GameServer_GetRoomInfoRsp"]["2"] = "GameServer_RoomInfo";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_GetRoomInfoRsp"]["2"] = "roomInfo";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo($offset)
  {
    return $this->_get_arr_value("2", $offset);
  }
  function add_roomInfo()
  {
    return $this->_add_arr_value("2");
  }
  function set_roomInfo($index, $value)
  {
    $this->_set_arr_value("2", $index, $value);
  }
  function set_all_roomInfos($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_roomInfo()
  {
    $this->_remove_last_arr_value("2");
  }
  function roomInfos_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_roomInfos()
  {
    return $this->_get_value("2");
  }
}
class GameServer_ModifyRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyRoomInfoReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyRoomInfoReq"]["1"] = "gameType";
    self::$fields["GameServer_ModifyRoomInfoReq"]["2"] = "GameServer_RoomInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ModifyRoomInfoReq"]["2"] = "roomInfo";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServer_ModifyRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyRoomInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyRoomInfoRsp"]["1"] = "returncode";
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
class GameServer_AddRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddRoomInfoReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddRoomInfoReq"]["1"] = "gameType";
    self::$fields["GameServer_AddRoomInfoReq"]["2"] = "GameServer_RoomInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_AddRoomInfoReq"]["2"] = "roomInfo";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServer_AddRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddRoomInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddRoomInfoRsp"]["1"] = "returncode";
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
class GameServer_DeleteRoomInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteRoomInfoReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteRoomInfoReq"]["1"] = "gameType";
    self::$fields["GameServer_DeleteRoomInfoReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DeleteRoomInfoReq"]["2"] = "roomID";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
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
}
class GameServer_DeleteRoomInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteRoomInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteRoomInfoRsp"]["1"] = "returncode";
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
class GameServer_ModifyRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyRoomInfoNotify"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyRoomInfoNotify"]["1"] = "gameType";
    self::$fields["GameServer_ModifyRoomInfoNotify"]["2"] = "GameServer_RoomInfo";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ModifyRoomInfoNotify"]["2"] = "roomInfo";
  }
  function gameType()
  {
    return $this->_get_value("1");
  }
  function set_gameType($value)
  {
    return $this->_set_value("1", $value);
  }
  function roomInfo()
  {
    return $this->_get_value("2");
  }
  function set_roomInfo($value)
  {
    return $this->_set_value("2", $value);
  }
}
class GameServer_AddRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddRoomInfoNotify"]["1"] = "GameServer_RoomInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddRoomInfoNotify"]["1"] = "roomInfo";
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
class GameServer_DeleteRoomInfoNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteRoomInfoNotify"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteRoomInfoNotify"]["1"] = "roomID";
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
class GameServer_CommonConfigInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_CommonConfigInfo"]["1"] = "GameServer_EnumFeedBackSwitch";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["1"] = "feedBackSwitch";
    self::$fields["GameServer_CommonConfigInfo"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["2"] = "feedBackStartTime";
    self::$fields["GameServer_CommonConfigInfo"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["3"] = "feedBackEndTime";
    self::$fields["GameServer_CommonConfigInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["4"] = "feedBackStartTimeInt";
    self::$fields["GameServer_CommonConfigInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["5"] = "feedBackEndTimeInt";
    self::$fields["GameServer_CommonConfigInfo"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["6"] = "bStartNotified";
    self::$fields["GameServer_CommonConfigInfo"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_CommonConfigInfo"]["7"] = "bEndNotified";
  }
  function feedBackSwitch()
  {
    return $this->_get_value("1");
  }
  function set_feedBackSwitch($value)
  {
    return $this->_set_value("1", $value);
  }
  function feedBackSwitch_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_GetCommonConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetCommonConfigReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetCommonConfigReq"]["1"] = "gameCode";
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
class GameServer_GetCommonConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GetCommonConfigRsp"]["1"] = "GameServer_CommonConfigInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GetCommonConfigRsp"]["1"] = "configInfo";
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
class GameServer_ModifyCommonConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyCommonConfigReq"]["1"] = "GameServer_CommonConfigInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyCommonConfigReq"]["1"] = "configInfo";
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
class GameServer_ModifyCommonConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyCommonConfigRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyCommonConfigRsp"]["1"] = "returncode";
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
class GameServer_DailyMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DailyMission"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DailyMission"]["1"] = "dailyMissionID";
    self::$fields["GameServer_DailyMission"]["2"] = "GameServer_EnumDailyMissionType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DailyMission"]["2"] = "missionType";
    self::$fields["GameServer_DailyMission"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_DailyMission"]["3"] = "gameCode";
    self::$fields["GameServer_DailyMission"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_DailyMission"]["4"] = "userLevelStart";
    self::$fields["GameServer_DailyMission"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_DailyMission"]["5"] = "userLevelEnd";
    self::$fields["GameServer_DailyMission"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_DailyMission"]["6"] = "roomID";
    self::$fields["GameServer_DailyMission"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_DailyMission"]["7"] = "userServiceFee";
    self::$fields["GameServer_DailyMission"]["8"] = "PBInt";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_DailyMission"]["8"] = "gameLength";
    self::$fields["GameServer_DailyMission"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_DailyMission"]["9"] = "gameTurnSum";
    self::$fields["GameServer_DailyMission"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_DailyMission"]["10"] = "continuousWinTime";
    self::$fields["GameServer_DailyMission"]["11"] = "GameServer_EnumZhajinhuaCardType";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_DailyMission"]["11"] = "zjhCardType";
    self::$fields["GameServer_DailyMission"]["12"] = "PBInt";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_DailyMission"]["12"] = "userGetProbability";
    self::$fields["GameServer_DailyMission"]["13"] = "PBInt";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_DailyMission"]["13"] = "couponNum";
    self::$fields["GameServer_DailyMission"]["14"] = "PBInt";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_DailyMission"]["14"] = "chipNum";
    self::$fields["GameServer_DailyMission"]["15"] = "PBString";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_DailyMission"]["15"] = "flagName";
    self::$fields["GameServer_DailyMission"]["16"] = "PBInt";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_DailyMission"]["16"] = "flagValidDay";
    self::$fields["GameServer_DailyMission"]["17"] = "PBString";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_DailyMission"]["17"] = "missionName";
    self::$fields["GameServer_DailyMission"]["18"] = "PBString";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_DailyMission"]["18"] = "missionDescription";
    self::$fields["GameServer_DailyMission"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_DailyMission"]["19"] = "flagID";
    self::$fields["GameServer_DailyMission"]["20"] = "GameServer_FlagInfo";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_DailyMission"]["20"] = "flagInfo";
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
  function missionType_string()
  {
    return $this->values["2"]->get_description();
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
  function zjhCardType_string()
  {
    return $this->values["11"]->get_description();
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
class GameServer_DailyMissionStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DailyMissionStatus"]["1"] = "GameServer_DailyMission";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DailyMissionStatus"]["1"] = "dailyMission";
    self::$fields["GameServer_DailyMissionStatus"]["2"] = "GameServer_EnumMissionStatus";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DailyMissionStatus"]["2"] = "status";
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
  function status_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_AddDailyMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddDailyMissionReq"]["1"] = "GameServer_DailyMission";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddDailyMissionReq"]["1"] = "dailyMissionInfo";
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
class GameServer_AddDailyMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddDailyMissionRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddDailyMissionRsp"]["1"] = "returncode";
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
class GameServer_DeleteDailyMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteDailyMissionReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteDailyMissionReq"]["1"] = "dailyMissionID";
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
class GameServer_DeleteDailyMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteDailyMissionRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteDailyMissionRsp"]["1"] = "returncode";
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
class GameServer_SystemMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SystemMission"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SystemMission"]["1"] = "systemMissionID";
    self::$fields["GameServer_SystemMission"]["2"] = "GameServer_EnumSystemMissionType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SystemMission"]["2"] = "missionType";
    self::$fields["GameServer_SystemMission"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SystemMission"]["3"] = "gameCode";
    self::$fields["GameServer_SystemMission"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SystemMission"]["4"] = "userLevelStart";
    self::$fields["GameServer_SystemMission"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SystemMission"]["5"] = "userLevelEnd";
    self::$fields["GameServer_SystemMission"]["6"] = "PBInt";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SystemMission"]["6"] = "roomID";
    self::$fields["GameServer_SystemMission"]["7"] = "PBInt";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_SystemMission"]["7"] = "userServiceFee";
    self::$fields["GameServer_SystemMission"]["8"] = "PBInt";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_SystemMission"]["8"] = "gameLength";
    self::$fields["GameServer_SystemMission"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_SystemMission"]["9"] = "gameTurnSum";
    self::$fields["GameServer_SystemMission"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_SystemMission"]["10"] = "userGetProbability";
    self::$fields["GameServer_SystemMission"]["11"] = "PBInt";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_SystemMission"]["11"] = "couponNum";
    self::$fields["GameServer_SystemMission"]["12"] = "PBInt";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_SystemMission"]["12"] = "chipNum";
    self::$fields["GameServer_SystemMission"]["13"] = "PBString";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_SystemMission"]["13"] = "flagName";
    self::$fields["GameServer_SystemMission"]["14"] = "PBInt";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_SystemMission"]["14"] = "flagValidDay";
    self::$fields["GameServer_SystemMission"]["15"] = "PBInt";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_SystemMission"]["15"] = "userBuyMin";
    self::$fields["GameServer_SystemMission"]["16"] = "PBInt";
    $this->values["16"] = "";
    self::$fieldNames["GameServer_SystemMission"]["16"] = "userBuyMax";
    self::$fields["GameServer_SystemMission"]["17"] = "PBBool";
    $this->values["17"] = "";
    self::$fieldNames["GameServer_SystemMission"]["17"] = "requireFirstBuy";
    self::$fields["GameServer_SystemMission"]["18"] = "PBInt";
    $this->values["18"] = "";
    self::$fieldNames["GameServer_SystemMission"]["18"] = "userExchangeMin";
    self::$fields["GameServer_SystemMission"]["19"] = "PBInt";
    $this->values["19"] = "";
    self::$fieldNames["GameServer_SystemMission"]["19"] = "userExchangeMax";
    self::$fields["GameServer_SystemMission"]["20"] = "PBBool";
    $this->values["20"] = "";
    self::$fieldNames["GameServer_SystemMission"]["20"] = "requireFirstExchange";
    self::$fields["GameServer_SystemMission"]["21"] = "PBString";
    $this->values["21"] = "";
    self::$fieldNames["GameServer_SystemMission"]["21"] = "missionName";
    self::$fields["GameServer_SystemMission"]["22"] = "PBString";
    $this->values["22"] = "";
    self::$fieldNames["GameServer_SystemMission"]["22"] = "missionDescription";
    self::$fields["GameServer_SystemMission"]["23"] = "PBInt";
    $this->values["23"] = "";
    self::$fieldNames["GameServer_SystemMission"]["23"] = "flagID";
    self::$fields["GameServer_SystemMission"]["24"] = "GameServer_FlagInfo";
    $this->values["24"] = "";
    self::$fieldNames["GameServer_SystemMission"]["24"] = "flagInfo";
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
  function missionType_string()
  {
    return $this->values["2"]->get_description();
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
class GameServer_SystemMissionStatus extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SystemMissionStatus"]["1"] = "GameServer_SystemMission";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SystemMissionStatus"]["1"] = "systemMission";
    self::$fields["GameServer_SystemMissionStatus"]["2"] = "GameServer_EnumMissionStatus";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SystemMissionStatus"]["2"] = "status";
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
  function status_string()
  {
    return $this->values["2"]->get_description();
  }
}
class GameServer_AddSystemMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddSystemMissionReq"]["1"] = "GameServer_SystemMission";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddSystemMissionReq"]["1"] = "systemMissionInfo";
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
class GameServer_AddSystemMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddSystemMissionRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddSystemMissionRsp"]["1"] = "returncode";
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
class GameServer_DeleteSystemMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteSystemMissionReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteSystemMissionReq"]["1"] = "systemMissionID";
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
class GameServer_DeleteSystemMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteSystemMissionRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteSystemMissionRsp"]["1"] = "returncode";
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
class GameServer_QueryMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryMissionReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryMissionReq"]["1"] = "userID";
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
class GameServer_QueryMissionRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryMissionRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryMissionRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryMissionRsp"]["2"] = "GameServer_DailyMissionStatus";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_QueryMissionRsp"]["2"] = "dailyMissions";
    self::$fields["GameServer_QueryMissionRsp"]["3"] = "GameServer_SystemMissionStatus";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_QueryMissionRsp"]["3"] = "systemMissions";
    self::$fields["GameServer_QueryMissionRsp"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_QueryMissionRsp"]["4"] = "userID";
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
  function set_all_dailyMissionss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_dailyMissions()
  {
    $this->_remove_last_arr_value("2");
  }
  function dailyMissionss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_dailyMissionss()
  {
    return $this->_get_value("2");
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
  function set_all_systemMissionss($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_systemMissions()
  {
    $this->_remove_last_arr_value("3");
  }
  function systemMissionss_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_systemMissionss()
  {
    return $this->_get_value("3");
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
class GameServer_FinishMissionReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_FinishMissionReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_FinishMissionReq"]["1"] = "userID";
    self::$fields["GameServer_FinishMissionReq"]["2"] = "GameServer_DailyMissionStatus";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_FinishMissionReq"]["2"] = "dailyMissions";
    self::$fields["GameServer_FinishMissionReq"]["3"] = "GameServer_SystemMissionStatus";
    $this->values["3"] = array();
    self::$fieldNames["GameServer_FinishMissionReq"]["3"] = "systemMissions";
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
  function set_all_dailyMissionss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_dailyMissions()
  {
    $this->_remove_last_arr_value("2");
  }
  function dailyMissionss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_dailyMissionss()
  {
    return $this->_get_value("2");
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
  function set_all_systemMissionss($values)
  {
    return $this->_set_arr_values("3", $values);
  }
  function remove_last_systemMissions()
  {
    $this->_remove_last_arr_value("3");
  }
  function systemMissionss_size()
  {
    return $this->_get_arr_size("3");
  }
  function get_systemMissionss()
  {
    return $this->_get_value("3");
  }
}
class GameServer_ModifyMissionParaReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyMissionParaReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyMissionParaReq"]["1"] = "userID";
    self::$fields["GameServer_ModifyMissionParaReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ModifyMissionParaReq"]["2"] = "addGameTurns";
    self::$fields["GameServer_ModifyMissionParaReq"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ModifyMissionParaReq"]["3"] = "addContinuousWinTime";
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
class GameServer_ModifyMissionParaRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyMissionParaRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyMissionParaRsp"]["1"] = "returncode";
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
class GameServer_ExchangeCardType extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeCardType"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeCardType"]["1"] = "cardTypeID";
    self::$fields["GameServer_ExchangeCardType"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeCardType"]["2"] = "cardName";
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
class GameServer_ExchangeProduct extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeProduct"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["1"] = "productID";
    self::$fields["GameServer_ExchangeProduct"]["2"] = "GameServer_EnumExchangeProductType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["2"] = "productType";
    self::$fields["GameServer_ExchangeProduct"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["3"] = "productName";
    self::$fields["GameServer_ExchangeProduct"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["4"] = "couponNum";
    self::$fields["GameServer_ExchangeProduct"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["5"] = "productStock";
    self::$fields["GameServer_ExchangeProduct"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["6"] = "productPicUrl";
    self::$fields["GameServer_ExchangeProduct"]["7"] = "GameServer_ExchangeCardType";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["7"] = "cardType";
    self::$fields["GameServer_ExchangeProduct"]["8"] = "GameServer_EnumProductFrontShow";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["8"] = "productFrontShow";
    self::$fields["GameServer_ExchangeProduct"]["9"] = "PBInt";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["9"] = "selfExchangeProductid";
    self::$fields["GameServer_ExchangeProduct"]["10"] = "PBInt";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["10"] = "gamecode";
    self::$fields["GameServer_ExchangeProduct"]["11"] = "PBInt";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["11"] = "isTryLuckyProduct";
    self::$fields["GameServer_ExchangeProduct"]["12"] = "PBInt";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["12"] = "getProductNum";
    self::$fields["GameServer_ExchangeProduct"]["13"] = "GameServer_EnumExchangeProductStatus";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_ExchangeProduct"]["13"] = "productStatus";
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
  function productType_string()
  {
    return $this->values["2"]->get_description();
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
  function productFrontShow_string()
  {
    return $this->values["8"]->get_description();
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
  function productStatus_string()
  {
    return $this->values["13"]->get_description();
  }
}
class GameServer_SingleCardInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SingleCardInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SingleCardInfo"]["1"] = "cardID";
    self::$fields["GameServer_SingleCardInfo"]["2"] = "GameServer_ExchangeCardType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SingleCardInfo"]["2"] = "cardType";
    self::$fields["GameServer_SingleCardInfo"]["3"] = "GameServer_EnumCardStatus";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SingleCardInfo"]["3"] = "cardStatus";
    self::$fields["GameServer_SingleCardInfo"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SingleCardInfo"]["4"] = "cardSN";
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
  function cardStatus_string()
  {
    return $this->values["3"]->get_description();
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
class GameServer_AddExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddExchangeProductReq"]["1"] = "GameServer_ExchangeProduct";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddExchangeProductReq"]["1"] = "product";
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
class GameServer_AddExchangeProductRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddExchangeProductRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddExchangeProductRsp"]["1"] = "returncode";
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
class GameServer_ModifyExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyExchangeProductReq"]["1"] = "GameServer_ExchangeProduct";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyExchangeProductReq"]["1"] = "product";
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
class GameServer_ModifyExchangeProductRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ModifyExchangeProductRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ModifyExchangeProductRsp"]["1"] = "returncode";
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
class GameServer_DeleteExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteExchangeProductReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteExchangeProductReq"]["1"] = "productID";
    self::$fields["GameServer_DeleteExchangeProductReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_DeleteExchangeProductReq"]["2"] = "gamecode";
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
class GameServer_DeleteExchangeProductRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteExchangeProductRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteExchangeProductRsp"]["1"] = "returncode";
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
class GameServer_QueryExchangeProductListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryExchangeProductListReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryExchangeProductListReq"]["1"] = "gamecode";
    self::$fields["GameServer_QueryExchangeProductListReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryExchangeProductListReq"]["2"] = "sessionID";
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
class GameServer_QueryExchangeProductListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryExchangeProductListRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryExchangeProductListRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryExchangeProductListRsp"]["2"] = "GameServer_ExchangeProduct";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_QueryExchangeProductListRsp"]["2"] = "products";
    self::$fields["GameServer_QueryExchangeProductListRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_QueryExchangeProductListRsp"]["3"] = "sessionID";
    self::$fields["GameServer_QueryExchangeProductListRsp"]["4"] = "PBBool";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_QueryExchangeProductListRsp"]["4"] = "end";
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
  function set_all_productss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_products()
  {
    $this->_remove_last_arr_value("2");
  }
  function productss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_productss()
  {
    return $this->_get_value("2");
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
class GameServer_ExchangeProductReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeProductReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["1"] = "userID";
    self::$fields["GameServer_ExchangeProductReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["2"] = "productID";
    self::$fields["GameServer_ExchangeProductReq"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["3"] = "gamecode";
    self::$fields["GameServer_ExchangeProductReq"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["4"] = "userName";
    self::$fields["GameServer_ExchangeProductReq"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["5"] = "userIDCard";
    self::$fields["GameServer_ExchangeProductReq"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["6"] = "userTel";
    self::$fields["GameServer_ExchangeProductReq"]["7"] = "PBString";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_ExchangeProductReq"]["7"] = "userAdress";
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
class GameServer_ExchangeProductRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeProductRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeProductRsp"]["1"] = "returncode";
    self::$fields["GameServer_ExchangeProductRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeProductRsp"]["2"] = "productID";
    self::$fields["GameServer_ExchangeProductRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ExchangeProductRsp"]["3"] = "newStock";
    self::$fields["GameServer_ExchangeProductRsp"]["4"] = "PBString";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_ExchangeProductRsp"]["4"] = "productCode";
  }
  function returncode()
  {
    return $this->_get_value("1");
  }
  function set_returncode($value)
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
  function newStock()
  {
    return $this->_get_value("3");
  }
  function set_newStock($value)
  {
    return $this->_set_value("3", $value);
  }
  function productCode()
  {
    return $this->_get_value("4");
  }
  function set_productCode($value)
  {
    return $this->_set_value("4", $value);
  }
}
class GameServer_ExchangeProductStockChangeNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ExchangeProductStockChangeNotify"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ExchangeProductStockChangeNotify"]["1"] = "productID";
    self::$fields["GameServer_ExchangeProductStockChangeNotify"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ExchangeProductStockChangeNotify"]["2"] = "newStock";
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
class GameServer_SelfExchangeProductInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_SelfExchangeProductInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["1"] = "productID";
    self::$fields["GameServer_SelfExchangeProductInfo"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["2"] = "productcode";
    self::$fields["GameServer_SelfExchangeProductInfo"]["3"] = "GameServer_EnumSelfExchangeProductType";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["3"] = "producttype";
    self::$fields["GameServer_SelfExchangeProductInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["4"] = "gamecode";
    self::$fields["GameServer_SelfExchangeProductInfo"]["5"] = "PBString";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["5"] = "productname";
    self::$fields["GameServer_SelfExchangeProductInfo"]["6"] = "PBString";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_SelfExchangeProductInfo"]["6"] = "productPicurl";
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
  function producttype_string()
  {
    return $this->values["3"]->get_description();
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
class GameServer_QueryTryLuckListReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryTryLuckListReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListReq"]["1"] = "gamecode";
    self::$fields["GameServer_QueryTryLuckListReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListReq"]["2"] = "sessionID";
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
class GameServer_QueryTryLuckListRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryTryLuckListRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryTryLuckListRsp"]["2"] = "GameServer_ExchangeProduct";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_QueryTryLuckListRsp"]["2"] = "products";
    self::$fields["GameServer_QueryTryLuckListRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListRsp"]["3"] = "sessionID";
    self::$fields["GameServer_QueryTryLuckListRsp"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListRsp"]["4"] = "costCouponNum";
    self::$fields["GameServer_QueryTryLuckListRsp"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_QueryTryLuckListRsp"]["5"] = "end";
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
  function set_all_productss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_products()
  {
    $this->_remove_last_arr_value("2");
  }
  function productss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_productss()
  {
    return $this->_get_value("2");
  }
  function sessionID()
  {
    return $this->_get_value("3");
  }
  function set_sessionID($value)
  {
    return $this->_set_value("3", $value);
  }
  function costCouponNum()
  {
    return $this->_get_value("4");
  }
  function set_costCouponNum($value)
  {
    return $this->_set_value("4", $value);
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
class GameServer_StartTryLuckReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_StartTryLuckReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_StartTryLuckReq"]["1"] = "userID";
    self::$fields["GameServer_StartTryLuckReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_StartTryLuckReq"]["2"] = "gamecode";
    self::$fields["GameServer_StartTryLuckReq"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_StartTryLuckReq"]["3"] = "costCouponNum";
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
class GameServer_StartTryLuckRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_StartTryLuckRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_StartTryLuckRsp"]["1"] = "returncode";
    self::$fields["GameServer_StartTryLuckRsp"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_StartTryLuckRsp"]["2"] = "resultProductID";
    self::$fields["GameServer_StartTryLuckRsp"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_StartTryLuckRsp"]["3"] = "productCode";
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
  function productCode()
  {
    return $this->_get_value("3");
  }
  function set_productCode($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServer_CouponChangeHis extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_CouponChangeHis"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["1"] = "userID";
    self::$fields["GameServer_CouponChangeHis"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["2"] = "datetime";
    self::$fields["GameServer_CouponChangeHis"]["3"] = "PBString";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["3"] = "reason";
    self::$fields["GameServer_CouponChangeHis"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["4"] = "changeNum";
    self::$fields["GameServer_CouponChangeHis"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["5"] = "margin";
    self::$fields["GameServer_CouponChangeHis"]["6"] = "GameServer_EnumExchangeProductType";
    $this->values["6"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["6"] = "productType";
    self::$fields["GameServer_CouponChangeHis"]["7"] = "PBString";
    $this->values["7"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["7"] = "productCode";
    self::$fields["GameServer_CouponChangeHis"]["8"] = "PBString";
    $this->values["8"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["8"] = "userName";
    self::$fields["GameServer_CouponChangeHis"]["9"] = "PBString";
    $this->values["9"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["9"] = "userIDCard";
    self::$fields["GameServer_CouponChangeHis"]["10"] = "PBString";
    $this->values["10"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["10"] = "userTel";
    self::$fields["GameServer_CouponChangeHis"]["11"] = "PBString";
    $this->values["11"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["11"] = "userAdress";
    self::$fields["GameServer_CouponChangeHis"]["12"] = "GameServer_EnumExchangeStatus";
    $this->values["12"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["12"] = "status";
    self::$fields["GameServer_CouponChangeHis"]["13"] = "PBString";
    $this->values["13"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["13"] = "remark";
    self::$fields["GameServer_CouponChangeHis"]["14"] = "PBString";
    $this->values["14"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["14"] = "orderNo";
    self::$fields["GameServer_CouponChangeHis"]["15"] = "PBInt";
    $this->values["15"] = "";
    self::$fieldNames["GameServer_CouponChangeHis"]["15"] = "exchangeProductID";
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
  function productType_string()
  {
    return $this->values["6"]->get_description();
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
  function status_string()
  {
    return $this->values["12"]->get_description();
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
class GameServer_QueryCouponChangeHisReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryCouponChangeHisReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryCouponChangeHisReq"]["1"] = "userID";
    self::$fields["GameServer_QueryCouponChangeHisReq"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_QueryCouponChangeHisReq"]["2"] = "sessionID";
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
class GameServer_QueryCouponChangeHisRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryCouponChangeHisRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryCouponChangeHisRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryCouponChangeHisRsp"]["2"] = "GameServer_CouponChangeHis";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_QueryCouponChangeHisRsp"]["2"] = "changeHis";
    self::$fields["GameServer_QueryCouponChangeHisRsp"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_QueryCouponChangeHisRsp"]["3"] = "sessionID";
    self::$fields["GameServer_QueryCouponChangeHisRsp"]["4"] = "PBBool";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_QueryCouponChangeHisRsp"]["4"] = "end";
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
  function set_all_changeHiss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_changeHis()
  {
    $this->_remove_last_arr_value("2");
  }
  function changeHiss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_changeHiss()
  {
    return $this->_get_value("2");
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
class GameServer_GameLengthRewardStageInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameLengthRewardStageInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameLengthRewardStageInfo"]["1"] = "configID";
    self::$fields["GameServer_GameLengthRewardStageInfo"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_GameLengthRewardStageInfo"]["2"] = "roomID";
    self::$fields["GameServer_GameLengthRewardStageInfo"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_GameLengthRewardStageInfo"]["3"] = "stage";
    self::$fields["GameServer_GameLengthRewardStageInfo"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_GameLengthRewardStageInfo"]["4"] = "timeLength";
    self::$fields["GameServer_GameLengthRewardStageInfo"]["5"] = "PBInt";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_GameLengthRewardStageInfo"]["5"] = "rewardChip";
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
class GameServer_GameLengthRewardRoomInfo extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_GameLengthRewardRoomInfo"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_GameLengthRewardRoomInfo"]["1"] = "roomID";
    self::$fields["GameServer_GameLengthRewardRoomInfo"]["2"] = "GameServer_GameLengthRewardStageInfo";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_GameLengthRewardRoomInfo"]["2"] = "stageConfigs";
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
  function set_all_stageConfigss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_stageConfigs()
  {
    $this->_remove_last_arr_value("2");
  }
  function stageConfigss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_stageConfigss()
  {
    return $this->_get_value("2");
  }
}
class GameServer_AddGameLengthRewardStageInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddGameLengthRewardStageInfoReq"]["1"] = "GameServer_GameLengthRewardStageInfo";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddGameLengthRewardStageInfoReq"]["1"] = "config";
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
class GameServer_AddGameLengthRewardStageInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_AddGameLengthRewardStageInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_AddGameLengthRewardStageInfoRsp"]["1"] = "returncode";
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
class GameServer_DeleteGameLengthRewardStageInfoReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteGameLengthRewardStageInfoReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteGameLengthRewardStageInfoReq"]["1"] = "configID";
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
class GameServer_DeleteGameLengthRewardStageInfoRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_DeleteGameLengthRewardStageInfoRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_DeleteGameLengthRewardStageInfoRsp"]["1"] = "returncode";
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
class GameServer_QueryGameLengthRewardConfigReq extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryGameLengthRewardConfigReq"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryGameLengthRewardConfigReq"]["1"] = "gameCode";
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
class GameServer_QueryGameLengthRewardConfigRsp extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_QueryGameLengthRewardConfigRsp"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_QueryGameLengthRewardConfigRsp"]["1"] = "returncode";
    self::$fields["GameServer_QueryGameLengthRewardConfigRsp"]["2"] = "GameServer_GameLengthRewardRoomInfo";
    $this->values["2"] = array();
    self::$fieldNames["GameServer_QueryGameLengthRewardConfigRsp"]["2"] = "configInfos";
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
  function set_all_configInfoss($values)
  {
    return $this->_set_arr_values("2", $values);
  }
  function remove_last_configInfos()
  {
    $this->_remove_last_arr_value("2");
  }
  function configInfoss_size()
  {
    return $this->_get_arr_size("2");
  }
  function get_configInfoss()
  {
    return $this->_get_value("2");
  }
}
class GameServer_ClientGameServerMissionComplete extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ClientGameServerMissionComplete"]["1"] = "GameServer_EnumMissionType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionComplete"]["1"] = "missionType";
    self::$fields["GameServer_ClientGameServerMissionComplete"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionComplete"]["2"] = "missionID";
    self::$fields["GameServer_ClientGameServerMissionComplete"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionComplete"]["3"] = "userID";
  }
  function missionType()
  {
    return $this->_get_value("1");
  }
  function set_missionType($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType_string()
  {
    return $this->values["1"]->get_description();
  }
  function missionID()
  {
    return $this->_get_value("2");
  }
  function set_missionID($value)
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
class GameServer_ClientGameServerGetMissoinRewardRequest extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ClientGameServerGetMissoinRewardRequest"]["1"] = "GameServer_EnumMissionType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardRequest"]["1"] = "missionType";
    self::$fields["GameServer_ClientGameServerGetMissoinRewardRequest"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardRequest"]["2"] = "missionID";
  }
  function missionType()
  {
    return $this->_get_value("1");
  }
  function set_missionType($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType_string()
  {
    return $this->values["1"]->get_description();
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
class GameServer_ClientGameServerGetMissoinRewardResponse extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ClientGameServerGetMissoinRewardResponse"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardResponse"]["1"] = "result";
    self::$fields["GameServer_ClientGameServerGetMissoinRewardResponse"]["2"] = "GameServer_EnumMissionType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardResponse"]["2"] = "missionType";
    self::$fields["GameServer_ClientGameServerGetMissoinRewardResponse"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardResponse"]["3"] = "missionID";
    self::$fields["GameServer_ClientGameServerGetMissoinRewardResponse"]["4"] = "PBInt";
    $this->values["4"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardResponse"]["4"] = "userID";
    self::$fields["GameServer_ClientGameServerGetMissoinRewardResponse"]["5"] = "PBBool";
    $this->values["5"] = "";
    self::$fieldNames["GameServer_ClientGameServerGetMissoinRewardResponse"]["5"] = "getMissionReward";
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
  function missionType_string()
  {
    return $this->values["2"]->get_description();
  }
  function missionID()
  {
    return $this->_get_value("3");
  }
  function set_missionID($value)
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
  function getMissionReward()
  {
    return $this->_get_value("5");
  }
  function set_getMissionReward($value)
  {
    return $this->_set_value("5", $value);
  }
}
class GameServer_UserMission extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_UserMission"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_UserMission"]["1"] = "missionID";
    self::$fields["GameServer_UserMission"]["2"] = "GameServer_EnumMissionType";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_UserMission"]["2"] = "missionType";
    self::$fields["GameServer_UserMission"]["3"] = "GameServer_EnumMissionStatus";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_UserMission"]["3"] = "missionStatus";
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
  function missionType_string()
  {
    return $this->values["2"]->get_description();
  }
  function missionStatus()
  {
    return $this->_get_value("3");
  }
  function set_missionStatus($value)
  {
    return $this->_set_value("3", $value);
  }
  function missionStatus_string()
  {
    return $this->values["3"]->get_description();
  }
}
class GameServer_TryLuckNotify extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_TryLuckNotify"]["1"] = "PBInt";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_TryLuckNotify"]["1"] = "userID";
    self::$fields["GameServer_TryLuckNotify"]["2"] = "PBString";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_TryLuckNotify"]["2"] = "userNick";
    self::$fields["GameServer_TryLuckNotify"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_TryLuckNotify"]["3"] = "productID";
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
  function productID()
  {
    return $this->_get_value("3");
  }
  function set_productID($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServer_ClientGameServerMissionIng extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
    self::$fields["GameServer_ClientGameServerMissionIng"]["1"] = "GameServer_EnumMissionType";
    $this->values["1"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionIng"]["1"] = "missionType";
    self::$fields["GameServer_ClientGameServerMissionIng"]["2"] = "PBInt";
    $this->values["2"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionIng"]["2"] = "missionID";
    self::$fields["GameServer_ClientGameServerMissionIng"]["3"] = "PBInt";
    $this->values["3"] = "";
    self::$fieldNames["GameServer_ClientGameServerMissionIng"]["3"] = "leftCount";
  }
  function missionType()
  {
    return $this->_get_value("1");
  }
  function set_missionType($value)
  {
    return $this->_set_value("1", $value);
  }
  function missionType_string()
  {
    return $this->values["1"]->get_description();
  }
  function missionID()
  {
    return $this->_get_value("2");
  }
  function set_missionID($value)
  {
    return $this->_set_value("2", $value);
  }
  function leftCount()
  {
    return $this->_get_value("3");
  }
  function set_leftCount($value)
  {
    return $this->_set_value("3", $value);
  }
}
class GameServer extends PBMessage
{
  var $wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
  public function __construct($reader=null)
  {
    parent::__construct($reader);
  }
}
?>