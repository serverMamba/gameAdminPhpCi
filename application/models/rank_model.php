<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class rank_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
        require_once(APPPATH . 'third_party/message/pb_message.php');
        require_once(APPPATH . 'third_party/proto/pb_proto_rank.php');
    }

    
 public function get_profile_rank() {

        $rr["win_times_weekly"] = array(
            array("from" => "1", "to" => "1", "Chip" => "280000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "10", "NoteCardDevice" => "0", "KingFrameLevel" => "1", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "2", "to" => "2", "Chip" => "180000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "8", "NoteCardDevice" => "0", "KingFrameLevel" => "2", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "3", "to" => "3", "Chip" => "80000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "5", "NoteCardDevice" => "0", "KingFrameLevel" => "3", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "4", "to" => "5", "Chip" => "50000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "3", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "6", "to" => "10", "Chip" => "30000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "1", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "11", "to" => "50", "Chip" => "10000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
	);

        $rr["pay_rank_weekly"] = array(
            array("from" => "1", "to" => "1", "Chip" => "880000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "50"),
            array("from" => "2", "to" => "2", "Chip" => "580000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "20"),
            array("from" => "3", "to" => "3", "Chip" => "280000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "10"),
            array("from" => "4", "to" => "5", "Chip" => "280000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "5"),
            array("from" => "6", "to" => "10", "Chip" => "180000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "5"),
            array("from" => "11", "to" => "50", "Chip" => "80000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "3"),
            array("from" => "51", "to" => "100", "Chip" => "40000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "1"),
            array("from" => "101", "to" => "200", "Chip" => "20000", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
        );

        $rr["total_score_rank_weekly"] = array(
            array("from" => "1", "to" => "1", "Chip" => "0", "Speaker" => "0", "Coupon" => "200", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "1", "CanSaiQuan" => "50"),
            array("from" => "2", "to" => "2", "Chip" => "0", "Speaker" => "0", "Coupon" => "150", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "2", "CanSaiQuan" => "20"),
            array("from" => "3", "to" => "3", "Chip" => "0", "Speaker" => "0", "Coupon" => "100", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "3", "CanSaiQuan" => "10"),
            array("from" => "4", "to" => "5", "Chip" => "0", "Speaker" => "0", "Coupon" => "80", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "8"),
            array("from" => "6", "to" => "10", "Chip" => "0", "Speaker" => "0", "Coupon" => "50", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "5"),
            array("from" => "11", "to" => "50", "Chip" => "0", "Speaker" => "0", "Coupon" => "30", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "5"),
            array("from" => "51", "to" => "100", "Chip" => "0", "Speaker" => "0", "Coupon" => "10", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "3"),
            array("from" => "101", "to" => "200", "Chip" => "0", "Speaker" => "0", "Coupon" => "5", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "1"),
        );

        $rr["total_score_rank_daily"] = array(
            array("from" => "1", "to" => "1", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "2", "to" => "2", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "3", "to" => "3", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "4", "to" => "5", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "6", "to" => "10", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "11", "to" => "50", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "51", "to" => "100", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "101", "to" => "200", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
        );

        $rr["win_score_rank_daily"] = array(
            array("from" => "1", "to" => "1", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "2", "to" => "2", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "3", "to" => "3", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "4", "to" => "5", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "6", "to" => "10", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "11", "to" => "50", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "51", "to" => "100", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "101", "to" => "200", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
        );

        $rr["pay_rank_daily"] = array(
            array("from" => "1", "to" => "1", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "2", "to" => "2", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "3", "to" => "3", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "4", "to" => "5", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "6", "to" => "10", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "11", "to" => "50", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "51", "to" => "100", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
            array("from" => "101", "to" => "200", "Chip" => "0", "Speaker" => "0", "Coupon" => "0", "SignCard" => "0", "NoteCardDevice" => "0", "KingFrameLevel" => "0", "WealthFrameLevel" => "0", "CanSaiQuan" => "0"),
        );

        
        return $rr;
    }

    public function save_gamemessage_data() {
        

        $itemtype = array("Chip" => "0", "Speaker" => "1", "Coupon" => "2", "SignCard" => "3", "NoteCardDevice" => "4", "KingFrameLevel" => "5", "WealthFrameLevel" => "6", "CanSaiQuan" => "7");

        $ranktype = array("win_times_weekly" => "1", "pay_rank_weekly" => "2", "total_score_rank_weekly" => "3", "total_score_rank_daily" => "4", "win_score_rank_daily" => "5", "pay_rank_daily" => "6");

        $rr = $this->get_profile_rank();
        

        $query = new Rank_ModifyRankRewardConfigRequest();
        foreach ($rr as $key1 => $value1) {

            $RankRewardConfig = new Rank_RankRewardConfig();
            $RankRewardConfig->set_rankType($ranktype[$key1]);

            foreach ($value1 as $key2 => $value2) {
              
                $SectionRewardConfig = new Rank_SectionRewardConfig();
                $SectionRewardConfig->set_fromPos($value2["from"]);
                $SectionRewardConfig->set_toPos($value2["to"]);
             
                foreach ($itemtype as $key3 => $value3) {
                    $RankRewardItem = new Rank_RankRewardItem();
                    $RankRewardItem->set_itemType($value3);
                    $RankRewardItem->set_itemValue( $value2[$key3]);
                    $SectionRewardConfig->set_rewardItem($value3, $RankRewardItem);
                }
                 $RankRewardConfig->set_sectionRewardConfig($key2, $SectionRewardConfig);
               
            }
            $query->set_rankRewardConfig($ranktype[$key1], $RankRewardConfig);
         
        }
        

        $buf = $query->SerializeToString();
       // $ret = $this->_request_midlayer_res1($buf, 80130, "27.115.62.98", "10003");
        $ret = $this->_request_midlayer_res($buf, 80130);
        $rsp = new Rank_ModifyRankRewardConfigResponse();
        $rsp->ParseFromString($ret);
        
        return $rsp->result() == EnumResult::enumResultSucc;



    }
    
    
     public function save_gamemessage_datataiguo() {
        

        $itemtype = array("Chip" => "0", "Speaker" => "1", "Coupon" => "2", "SignCard" => "3", "NoteCardDevice" => "4", "KingFrameLevel" => "5", "WealthFrameLevel" => "6", "CanSaiQuan" => "7");

        $ranktype = array("win_times_weekly" => "1", "pay_rank_weekly" => "2", "total_score_rank_weekly" => "3", "total_score_rank_daily" => "4", "win_score_rank_daily" => "5", "pay_rank_daily" => "6");

        $rr = $this->get_profile_rank();
        

        $query = new Rank_ModifyRankRewardConfigRequest();
        foreach ($rr as $key1 => $value1) {

            $RankRewardConfig = new Rank_RankRewardConfig();
            $RankRewardConfig->set_rankType($ranktype[$key1]);

            foreach ($value1 as $key2 => $value2) {
              
                $SectionRewardConfig = new Rank_SectionRewardConfig();
                $SectionRewardConfig->set_fromPos($value2["from"]);
                $SectionRewardConfig->set_toPos($value2["to"]);
             
                foreach ($itemtype as $key3 => $value3) {
                    $RankRewardItem = new Rank_RankRewardItem();
                    $RankRewardItem->set_itemType($value3);
                    $RankRewardItem->set_itemValue( $value2[$key3]);
                    $SectionRewardConfig->set_rewardItem($value3, $RankRewardItem);
                }
                 $RankRewardConfig->set_sectionRewardConfig($key2, $SectionRewardConfig);
               
            }
            $query->set_rankRewardConfig($ranktype[$key1], $RankRewardConfig);
         
        }
        

        $buf = $query->SerializeToString();
       // $ret = $this->_request_midlayer_res1($buf, 80130, "27.115.62.98", "10003");
        $ret = $this->_request_midlayer_restaiguo($buf, 80130);
        $rsp = new Rank_ModifyRankRewardConfigResponse();
        $rsp->ParseFromString($ret);
        
        return $rsp->result() == EnumResult::enumResultSucc;



    }

}
