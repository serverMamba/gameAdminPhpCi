<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_report_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getUserReportNum() {
		$db = $this->load->database ( 'default', true );
		$db->where ( 'status', 0 );
		$db->where ( 'type >', 0 );
		$num = $db->count_all_results ( 'smc_report' );
		$db->close ();
		return $num;
	}
	public function userReportList($start, $limit, $query) {
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->from ( 'smc_report' );
		if (! empty ( $query ['user_id'] )) {
			$w_user_id = $query ['user_id'];
			$db->where ( "(user_id = '$w_user_id' OR table_users LIKE '%$w_user_id%')");

			// 如果是选定用户，则order_status为0时表示全部筛选
			if (! empty ( $query ['order_status'] )) {
					if ($query ['order_status'] == 2) {
							$query ['order_status'] = 0;
					}
					$db->where ( 'status', $query ['order_status'] );
			}
		}
		else
		{
				if (! empty ( $query ['order_status'] )) {
						if ($query ['order_status'] == 2) {
								$query ['order_status'] = 0;
						}
						$db->where ( 'status', $query ['order_status'] );
				}else{
						$db->where ( 'status', 0 );
				}
		}


		if (! empty ( $query ['game'] )) {
			$db->where ( 'type', $query ['game'] );
		}else{
			$db->where ( 'type >', 0 );
		}	

		$db->order_by ( 'add_time', 'DESC' );
		$db->limit ( $limit, $start );
		$q = $db->get ();
		// echo $db->last_query();
		$db->close ();
		$return_ary = $q->result_array ();
		if (! empty ( $return_ary )) {
			foreach ( $return_ary as $k => $v ) {
				$p = $this->getGamePlayRecord ( $v ['type'], $v ['table_id'], $v ['user_id'] );
				if (! empty ( $p )) {
					$return_ary [$k] ['play_record'] = $p ['play_record'];
					$return_ary [$k] ['jinbi'] = intval ( $p ['user_score_end'] ) - intval ( $p ['user_score_begin'] );
				}
			}
		}
		return $return_ary;
	}
	public function getUserReport($id) {
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->from ( 'smc_report' );
		$db->where ( 'id', $id );
		$db->limit ( 1 );
		$q = $db->get ();
		$db->close ();
		$return_ary = $q->row_array ();
		return $return_ary;
	}
	public function updateUserReport($id, $data) {
		$db = $this->load->database ( 'default', true );
		$db->where ( 'id', $id );
		if ($db->update ( 'smc_report', $data )) {
			$db->close ();
			return true;
		} else {
			$db->close ();
			return false;
		}
	}
	public function getGamePlayRecord($type, $game_number, $user_id = 0) {
		$db_date = date ( 'Ymd', substr ( $game_number, 0, 10 ) );
		
		$return_ary = array ();
		$db = $this->load->database ( 'gamehis', true );
		if ($type == 1) {
			$db->select ( 'play_record,user_score_end,user_score_begin' );
			$db->from ( 'CASINOGAMERECORD_DDZ_' . $db_date );
			$db->where ( 'game_number', $game_number );
			if ($user_id) {
				$db->where ( 'user_id', $user_id );
			}
			$db->limit ( 1 );
			$q = $db->get ();
			$db->close ();
			$return_ary = $q->row_array ();
			return $return_ary;
		} else if ($type == 2) {
			// 4083531|*|4082019:4e|32|12|02|31|01|0d|0c|3a|09|38|08|37|05|14|33|13|*|4083531:4f|3d|2d|2c|1c|3b|2b|1b|0b|1a|0a|18|26|16|06|25|15|04|23|03|*|2995879:22|21|11|1d|3c|2a|39|29|19|28|27|17|07|36|35|34|24|*|4083531:23|03$4082019:38|08$2995879:0$4083531:1a|0a$4082019:31|01$2995879:0$4083531:0$4082019:14$2995879:2a$4083531:4f$4082019:0$2995879:0$4083531:25|15$4082019:0$2995879:21|11$4083531:0$4082019:0$2995879:28$4083531:3d$4082019:4e$2995879:0$4083531:0$4082019:05$2995879:1d$4083531:0$4082019:0$2995879:27|17|07|35$4083531:0$4082019:0$2995879:39|29|19|34|24$4083531:0$4082019:0$2995879:3c$4083531:2d$4082019:02$2995879:0$4083531:0$4082019:33|13$2995879:0$4083531:2c|1c$4082019:32|12$2995879:0$4083531:3b|2b|1b|0b$4082019:0$2995879:0$4083531:26|16|06|04$4082019:0$2995879:0$4083531:18$
			$db->select ( 'play_record,user_score_end,user_score_begin' );
			$db->from ( 'CASINOGAMERECORD_DDZHUANLE_' . $db_date );
			$db->where ( 'game_number', $game_number );
			if ($user_id) {
				$db->where ( 'user_id', $user_id );
			}
			$db->limit ( 1 );
			$q = $db->get ();
			$db->close ();
			$return_ary = $q->row_array ();
			return $return_ary;
		} else if ($type == 3) {
			// 10|*|0|*|4084479:01|1c|0b|3a|29|19|28|18|37|07|06|35|15|24|14|04|33|*|4084802:4e|32|02|21|2d|3b|2b|1b|39|09|17|25|05|34|23|13|03|*|4084325:4f|22|12|31|11|3d|1d|0d|3c|2c|0c|2a|1a|0a|38|08|27|36|26|16|*|4084325:27$4084802:2d$4084479:01$4084325:4f$4084802:0$4084479:0$4084325:38|08$4084802:39|09$4084479:0$4084325:31|11$4084802:32|02$4084479:0$4084325:0a|36|26|16$4084802:0$4084479:0$4084325:22|12$4084802:0$4084479:0$4084325:3c|2c|0c|1a$4084802:0$4084479:0$4084325:3d|1d|0d|2a$
			$db->select ( 'play_record,user_score_end,user_score_begin' );
			$db->from ( 'CASINOGAMERECORD_DDZLAIZI_' . $db_date );
			$db->where ( 'game_number', $game_number );
			if ($user_id) {
				$db->where ( 'user_id', $user_id );
			}
			$db->limit ( 1 );
			$q = $db->get ();
			$db->close ();
			$return_ary = $q->row_array ();
			return $return_ary;
		}
	}
}
