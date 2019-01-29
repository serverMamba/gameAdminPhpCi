<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class gameddzbisai_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        require_once(APPPATH . 'third_party/proto/pb_proto_bisai.php');
    }
    
    
    public function do_delete_gamemessage_data($id){
       $DeleteTournamentGameConfigRequest = new Bisai_DeleteTournamentGameConfigRequest();
       $DeleteTournamentGameConfigRequest->set_gameCode(6);
       $DeleteTournamentGameConfigRequest->set_tournamentRoomID($id);
       $buf = $DeleteTournamentGameConfigRequest->SerializeToString();
       $ret = $this->_request_midlayer_res1($buf, 80136, "27.115.62.98", "9102");
        
       $rsp = new Bisai_DeleteTournamentGameConfigResponse();
       $rsp->ParseFromString($ret);
        
       return $rsp->result() == EnumResult::enumResultSucc;
    }
    
    
    public function do_bisaicheng_gamemessage_data($input){
       
         $gameType=$input->get_post("gameType");
         $tournamentFlag = $input->get_post("tournamentFlag");
         $baseScoreIncrementGrowth = $input->get_post("baseScoreIncrementGrowth");
         $tournamentStartKey = $input->get_post("tournamentStartKey");
         $tournamentGameType=$input->get_post("tournamentGameType");
         $tournamentRoomID=$input->get_post("tournamentRoomID");
         $tournamentName=$input->get_post("tournamentName");
         $tournamentDesc=$input->get_post("tournamentDesc");
         $preliminaryBoutCount=$input->get_post("preliminaryBoutCount");
         $preliminaryRoundCount=$input->get_post("preliminaryRoundCount");
         $extraBoutCount=$input->get_post("extraBoutCount");
         $finalBoutCount=$input->get_post("finalBoutCount");
         $finalRoundCount=$input->get_post("finalRoundCount");
         $preliminaryCutOffCount=$input->get_post("preliminaryCutOffCount");
         $finalPromotedCount=$input->get_post("finalPromotedCount");
         $initialBaseScore=$input->get_post("initialBaseScore");
         $baseScoreIncrement=$input->get_post("baseScoreIncrement");
         $baseScoreGrowthInterval=$input->get_post("baseScoreGrowthInterval");
         $initialUserScore=$input->get_post("initialUserScore");
         $minApplyCount=$input->get_post("minApplyCount");
         $maxApplyCount=$input->get_post("maxApplyCount");
         $applyFeeType=$input->get_post("applyFeeType");
         $applyFeeCount=$input->get_post("applyFeeCount");
         $rewardID=$input->get_post("rewardID");
         $startyear=$input->get_post("startyear");
         $startmonth=$input->get_post("startmonth");
         $startday=$input->get_post("startday");
         $starthour=$input->get_post("starthour");
         $startminute=$input->get_post("startminute");
         $stopyear=$input->get_post("stopyear");
         $stopmonth=$input->get_post("stopmonth");
         $stopday=$input->get_post("stopday");
         $stophour=$input->get_post("stophour");
         $stopminute=$input->get_post("stopminute");
         $period= $input->get_post("period");
         $vipLevelLimit=$input->get_post("vipLevelLimit");
         $useClock=$input->get_post("useClock");
         
        $ModifyTournamentGameConfigRequest  = new Bisai_ModifyTournamentGameConfigRequest();
        $ModifyTournamentGameConfigRequest->set_gameCode(6);
        
         $SMCTournamentGameConfig = new Bisai_SMCTournamentGameConfig();
         $SMCTournamentGameConfig->set_gameType($gameType);
         $SMCTournamentGameConfig->set_tournamentFlag($tournamentFlag);
         $SMCTournamentGameConfig->set_baseScoreIncrementGrowth($baseScoreIncrementGrowth);
         $SMCTournamentGameConfig->set_tournamentGameType($tournamentGameType);
         $SMCTournamentGameConfig->set_tournamentStartKey($tournamentStartKey);
         $SMCTournamentGameConfig->set_tournamentRoomID($tournamentRoomID);
         $SMCTournamentGameConfig->set_tournamentName($tournamentName);
         $SMCTournamentGameConfig->set_tournamentDesc($tournamentDesc);
         $SMCTournamentGameConfig->set_preliminaryBoutCount($preliminaryBoutCount);
         $SMCTournamentGameConfig->set_preliminaryRoundCount($preliminaryRoundCount);
         $SMCTournamentGameConfig->set_extraBoutCount($extraBoutCount);
         $SMCTournamentGameConfig->set_finalBoutCount($finalBoutCount);
         $SMCTournamentGameConfig->set_finalRoundCount($finalRoundCount);
         $SMCTournamentGameConfig->set_preliminaryCutOffCount($preliminaryCutOffCount);
         $SMCTournamentGameConfig->set_finalPromotedCount($finalPromotedCount);
         $SMCTournamentGameConfig->set_initialBaseScore($initialBaseScore);
         $SMCTournamentGameConfig->set_baseScoreIncrement($baseScoreIncrement);
         $SMCTournamentGameConfig->set_baseScoreGrowthInterval($baseScoreGrowthInterval);
         $SMCTournamentGameConfig->set_initialUserScore($initialUserScore);
         $SMCTournamentGameConfig->set_minApplyCount($minApplyCount);
         $SMCTournamentGameConfig->set_maxApplyCount($maxApplyCount);
         $SMCTournamentGameConfig->set_applyFeeType($applyFeeType);
         $SMCTournamentGameConfig->set_applyFeeCount($applyFeeCount);
         $SMCTournamentGameConfig->set_rewardID($rewardID);
         
         $starttime = new Bisai_DateTime();
         $stoptime = new Bisai_DateTime();
         $starttime->set_year($startyear);
         $starttime->set_month($startmonth);
         $starttime->set_day($startday);
         $starttime->set_hour($starthour);
         $starttime->set_minute($startminute);
         $stoptime->set_year($stopyear);
         $stoptime->set_month($stopmonth);
         $stoptime->set_day($stopday);
         $stoptime->set_hour($stophour);
         $stoptime->set_minute($stopminute);
         
         
         $SMCTournamentGameConfig->set_startTime($stoptime);
         $SMCTournamentGameConfig->set_stopTime($stoptime);
         
         $SMCTournamentGameConfig->set_period($period);
         $SMCTournamentGameConfig->set_vipLevelLimit($vipLevelLimit);
         $SMCTournamentGameConfig->set_useClock($useClock);
         
         $ModifyTournamentGameConfigRequest->set_gameConfig($SMCTournamentGameConfig);
        
       
        $buf = $ModifyTournamentGameConfigRequest->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80134, "27.115.62.98", "9102");
        
        $rsp = new Bisai_ModifyTournamentGameConfigResponse();
        $rsp->ParseFromString($ret);
        
        return $rsp->result() == EnumResult::enumResultSucc;
         
    }
    
    public function delete_gamemessage_data_byid($id){
        $query = new Bisai_DeleteTournamentGameConfigRequest();
        $query->set_gameCode(6);
        $query->set_tournamentRoomID($id);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80140, "27.115.62.98", "9102");
        
        $rsp = new Bisai_DeleteTournamentGameConfigResponse();
        $rsp->ParseFromString($ret);
        
        return $rsp->result() == EnumResult::enumResultSucc;
        
    }
    
    public function get_allgamemessage_data() {
        $query = new Bisai_QueryTournamentGameConfigRequest();
        $query->set_gameCode(6);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80132, "27.115.62.98", "9102");
        $rsp = new Bisai_QueryTournamentGameConfigResponse();
        $rsp->ParseFromString($ret);
        $result = array();
        $gameConfig_size = $rsp->gameConfig_size();
        $reward_size = $rsp->reward_size();
        
         for ($no1 = 0; $no1 < $reward_size; $no1++) {
            $item = $rsp->reward($no1);
            $placingReward_size = $item->placingReward_size();
            $resultno2 = array();
            for ($no2 = 0; $no2 < $placingReward_size; $no2++) {
                $placingReward = $item->placingReward($no2);
                $yy = array();
                $yy["placingFrom"] = $placingReward->placingFrom();
                $yy["placingTo"] = $placingReward->placingTo();
            
                $reward_sizex = $placingReward->reward_size();
                $resultno3 = array();
                
                for ($no3 = 0; $no3 < $reward_sizex; $no3++) {
                    $reward = $placingReward->reward($no3);
                    $xx = array();
                    $xx["itemType"] = $reward->itemType();
                    $xx["itemValue"] = $reward->itemValue();
                    $resultno3[] =$xx;
                }
          
               $yy["no2"] = $resultno3;
               
               $resultno2[] = $yy;
             }
             $resultno1 = array();
             $resultno1["id"]    = $item->id();
             $resultno1["no1"] = $resultno2;
             
             $result["reward"][] =   $resultno1;
         }
       
         
         

          for ($ii = 0; $ii < $gameConfig_size; $ii++) {
            $result1 = array();
            $item = $rsp->gameConfig($ii);
            $result1['gameType'] = $item->gameType();
            $result1['tournamentFlag'] = $item->tournamentFlag();
            $result1['baseScoreIncrementGrowth'] = $item->baseScoreIncrementGrowth();
            $result1['tournamentStartKey'] = $item->tournamentStartKey();
            $result1['tournamentGameType'] = $item->tournamentGameType();
            $result1['tournamentRoomID'] = $item->tournamentRoomID();
            $result1['tournamentName'] = $item->tournamentName();
            $result1['tournamentDesc'] = $item->tournamentDesc();
            $result1['preliminaryBoutCount'] = $item->preliminaryBoutCount();
            $result1['preliminaryRoundCount'] = $item->preliminaryRoundCount();
            $result1['extraBoutCount'] = $item->extraBoutCount();
            $result1['finalBoutCount'] = $item->finalBoutCount();
            $result1["finalRoundCount"] = $item->finalRoundCount();
            $result1["preliminaryCutOffCount"] = $item->preliminaryCutOffCount();
            $result1["finalPromotedCount"] = $item->finalPromotedCount();
            $result1["initialBaseScore"] = $item->initialBaseScore();
            $result1["baseScoreIncrement"] = $item->baseScoreIncrement();
            $result1["baseScoreGrowthInterval"] = $item->baseScoreGrowthInterval();
            $result1["initialUserScore"] = $item->initialUserScore();
            $result1["minApplyCount"] = $item->minApplyCount();
            $result1["maxApplyCount"] = $item->maxApplyCount();
            $result1["applyFeeType"] = $item->applyFeeType();
            $result1["applyFeeCount"] = $item->applyFeeCount();
            $result1["rewardID"] = $item->rewardID();
            $startTime = $item->startTime();
            $result1['startyear'] = $startTime->year();
            $result1['startmonth'] = $startTime->month();
            $result1['startday'] = $startTime->day();
            $result1['starthour'] = $startTime->hour();
            $result1['startminute'] = $startTime->minute();
            $result1['startday'] = $startTime->day();
            $stopTime = $item->stopTime();
            $result1['stopyear'] = $stopTime->year();
            $result1['stopmonth'] = $stopTime->month();
            $result1['stopday'] = $stopTime->day();
            $result1['stophour'] = $stopTime->hour();
            $result1['stopminute'] = $stopTime->minute();
            $result1['stopday'] = $stopTime->day();
            $result1['period'] = $item->period();
            $result1['vipLevelLimit'] = $item->vipLevelLimit();
            $result1['useClock'] = $item->useClock();
            $result["config"][] = $result1;
        }
        return $result;
    }
    
    public function save_gamemessage_data_byid($id, $msg) {
        
        $RewardRequest = new Bisai_ModifyTournamentRewardRequest();
        $RewardRequest->set_gameCode(6);
        $TournamentReward = new Bisai_SMCTournamentReward();
        $TournamentReward->set_id($id);

        foreach ($msg as $Key => $Value) {
            $PlacingReward = new Bisai_SMCTournamentPlacingReward();
            $From = $Value["From"];
            $To = $Value["To"];
            $Item = $Value["Item"];
            
            $PlacingReward->set_placingFrom($From);
            $PlacingReward->set_placingTo($To);

            foreach ($Item as $Key1 => $Value1) {
                $RewardItem = new Bisai_RewardItem();
                $Type = $Value1["Type"];
                $Value = $Value1["Value"];
                $RewardItem->set_itemType($Type);
                $RewardItem->set_itemValue( $Value);
                $PlacingReward->set_reward($Key1, $RewardItem);
            }
            $TournamentReward->set_placingReward($Key, $PlacingReward);
        }
        $RewardRequest->set_reward($TournamentReward);
        $buf = $RewardRequest->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80138, "27.115.62.98", "9102");
        $rsp = new Bisai_ModifyTournamentRewardResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;
        
    }

    public function save_gamemessage_data($id,$gamecode,$roomid,$inter,$msg){
        $query = new GameMessage_ModifyBystanderSystemMsgRequest();
        $query->set_msgID($id);
        $query->set_intervalBySeconds($inter);
        $query->set_textmsg($msg);
        $buf = $query->SerializeToString();
        $ret = $this->_request_midlayer_res1($buf, 80134, "27.115.62.98", "9102");
        $rsp = new GameMessage_ModifyBystanderSystemMsgResponse();
        $rsp->ParseFromString($ret);

        return $rsp->result() == EnumResult::enumResultSucc;
           
       }
   

}
