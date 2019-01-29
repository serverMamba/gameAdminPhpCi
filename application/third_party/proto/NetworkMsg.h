#ifndef NETWORK_MSG_H_
#define NETWORK_MSG_H_

#define LOGINSERVER_LATEST_CMD_VERSION      0
#define LOGINSERVER_MIN_SUPPORT_CMD_VERSION 0

enum SUPPORT_GAME_TYPE
{
	kTexasPoker = 0,
};

enum NETWORK_MSG
{
    //gui与client network layer之间内部交互的命令字，暂定<=10000
    
    //status msg
    kDispatchConnected = 1,
    kDispatchDisconnected,
    kRoomConnected,
    kRoomDisconnected,
	kOnAndroidJNIResponse,
    
    //send msg
    //dispatch msg
	kConnectToDispatch,
    //room msg
    kConnectToRoom,
    kRoomKeepAlive,
    kMaxClientInternalMsg = 10000,
    
    //client与loginserver之间交互的命令字，暂定10000<= && <=20000
    kGetGameServerList         = 10001,
	kGetGameServerListResponse = 10002,
	kGameServerToLoginServerReportPlayerLoginInfo = 10003,
    kMaxClientLoginServerMsg   = 20000,
    
    //client与gameserver之间交互的命令字，暂定20000<= && <=50000
    kGameServerLoginRequest = 20001,
	kGameServerLoginResponse,
	kGameServerGetUserBasicInfoRequest,//no use
	kGameServerGetUserBasicInfoResponse,//no use
	kGameServerGetUserDetailInfoRequest,//no use
	kGameServerGetUserDetailInfoResponse,//no use
	kGameServerGetTableListRequest,
	kGameServerGetTableListResponse,
	kGameServerEnterTableRequest,
	kGameServerEnterTableResponse = 20010,
	kGameServerEnterTableBC,
	kGameServerEnterSeatRequest,
	kGameServerEnterSeatResponse,
	kGameServerEnterSeatBC,
	kGameServerLeaveSeatRequest,
	kGameServerLeaveSeatResponse,
	kGameServerLeaveSeatBC,
	kGameServerLogicData,
	kGameServerKeepAlive,
	kGameServerEnterGameRequest = 20020,
	kGameServerEnterGameResponse,
	kGameServerModifyTakeInScoreRequest,
	kGameServerModifyTakeInScoreResponse,
	kGameServerModifyTakeInScoreBC,
	kGameServerLeaveTableRequest,
	kGameServerLeaveTableResponse,
	kGameServerGetGameListRequest,
	kGameServerGetGameListResponse,
	kGameServerQuickStartRequest,
	kGameServerQuickStartResponse = 20030,
	kGameServerQueryUserInfoRequest,
	kGameServerQueryUserInfoResponse,
	kGameServerBonusChips,
	kGameServerKickDuplicateUser,
	kGameServerModifyUserInfoRequest,
	kGameServerModifyUserInfoResponse,
	kGameServerLeaveGameRequest,
	kGameServerLeaveGameResponse,
    kGameServerAdWallAdChips,
	kGameServerTotalScoreChanged = 20040,
	//管理命令字，45000-50000
	kGameServerDisconnectWithLoginServer = 45000,
	kGameServerQueryOnlineUserAmount = 45001,
	kGameServerSetBroadcast = 45002,
	kGameServerKickOnlineUser = 45003,
	kGameServerUseMasterDB = 45004,
	kGameServerUseSlaveDB = 45005,
	kSMCGameServerSwitchDispatchReq,
    kSMCGameServerSwitchDispatchRsp,
    kSMCLoginServerEnableGameServerReq,
    kSMCLoginServerEnableGameServerRsp,
	kMaxClientRoomServerMsg = 50000,
    
    //loginserver与gameserver之间交互的命令字，暂定50000<= && <=60000
	kGameServerReportSelfInfoToLoginServer           = 50001,
	kGameServerSendHeartBeatPackageToLoginServer,
	kLoginServerResponseHeartBeatPackageToGameServer,
    kMaxLoginServerGameServerMsg                     = 60000,

    //server to DBProxy
	kServerDBProxyBootstrap       = 60001,
    kServerDBProxyScoreOperation,
	kServerDBProxyProxyIsOn,
	kServerDBProxyProxyIsOff,
	kServerDBProxyRewardScore,
	kServerDBProxyScoreOperationAdWall,
	kServerDBProxyScoreOperationIAP,
    kMaxServerDBProxyMsg = 70000,

	//client to index server
	kGameServerToIndexServerCheckAppstoreIAP = 70001,
	kMaxClientIndexServerMsg = 80000,
    kSMCMiddleLayerQueryTotalChipNumRequest = 80001,
    kSMCMiddleLayerQueryTotalChipNumResponse,
    kSMCMiddleLayerAddScoreRequest,
    kSMCMiddleLayerAddScoreResponse,
    kSMCMiddleLayerSubScoreRequest,
    kSMCMiddleLayerSubScoreResponse,
    kSMCMiddleLayerAddBuyRecordRequest,
    kSMCMiddleLayerAddBuyRecordResponse,
    kSMCMiddleLayerGetUserIDRequest,
    kSMCMiddleLayerGetUserIDResponse = 80010,
    kSMCMiddleLayerQueryBrokerageRequest,
    kSMCMiddleLayerQueryBrokerageResponse,
    kSMCMiddleLayerAddIPBlackListRequest,
    kSMCMiddleLayerAddIPBlackListResponse,
    kSMCMiddleLayerAddUserIDBlackListRequest,
    kSMCMiddleLayerAddUserIDBlackListResponse,
    kSMCMiddleLayerAddMACBlackListRequest,
    kSMCMiddleLayerAddMACBlackListResponse,
    kSMCMiddleLayerQueryRankingInfoRequest,
    kSMCMiddleLayerQueryRankingInfoResponse = 80020,
    kSMCMiddleLayerAddToolRequest,
    kSMCMiddleLayerAddToolResponse,
    kSMCMiddleLayerModifyFullUserInfoRequest,
    kSMCMiddleLayerModifyFullUserInfoResponse,
    kSMCMiddleLayerQueryGiftInfoRequest,
    kSMCMiddleLayerQueryGiftInfoResponse,
    kSMCMiddleLayerModifyGiftInfoRequest,
    kSMCMiddleLayerModifyGiftInfoResponse,
    kSMCMiddleLayerModifyBrokerageRequest,
    kSMCMiddleLayerModifyBrokerageResponse = 80030,
    kSMCMiddleLayerRelieveIPBlackListRequest,
    kSMCMiddleLayerRelieveIPBlackListResponse,
    kSMCMiddleLayerRelieveUserIDBlackListRequest,
    kSMCMiddleLayerRelieveUserIDBlackListResponse,
    kSMCMiddleLayerRelieveMACBlackListRequest,
    kSMCMiddleLayerRelieveMACBlackListResponse,
    kSMCMiddleLayerAddSystemBroadcastRequest,
    kSMCMiddleLayerAddSystemBroadcastResponse,
    kSMCMiddleLayerDeleteSystemBroadcastRequest,
    kSMCMiddleLayerDeleteSystemBroadcastResponse = 80040,
    kSMCMiddleLayerKickOffUserRequest,
    kSMCMiddleLayerKickOffUserResponse,
    kSMCMiddleLayerMarkWeipaiSuccessRequest,
    kSMCMiddleLayerMarkWeipaiSuccessResponse,
    kSMCMiddleLayerModifyPropertyRequest,
    kSMCMiddleLayerModifyPropertyResponse,
    kSMCMiddleLayerDelPropertyRequest,
    kSMCMiddleLayerDelPropertyResponse,
    kSMCMiddleLayerModifyGiftRequest,
    kSMCMiddleLayerModifyGiftResponse, = 80050
    kSMCMiddleLayerDelGiftRequest,
    kSMCMiddleLayerDelGiftResponse,
    kSMCMiddleLayerAddNotificationRequest,
    kSMCMiddleLayerAddNotificationResponse,
    kSMCMiddleLayerDeleteNotificationRequest,
    kSMCMiddleLayerDeleteNotificationResponse,


    kSMCMiddleLayerMax = 90000,

};

#endif
