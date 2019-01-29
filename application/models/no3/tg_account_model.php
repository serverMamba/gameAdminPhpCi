<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Tg_account_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getTgAccountList($return_ary, $parent_id) {
		$this->db->from ( 'smc_tg_account' );
		$this->db->where ( 'parent_id', $parent_id );
		$this->db->order_by ( 'id' );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			foreach ( $query->result_array () as $row ) {
				if ($row ['level'] > 1) {
					$pre = '|----';
					for($i = 1; $i < $row ['level']; $i ++) {
						$pre .= '----';
					}
					$row ['account'] = $pre . $row ['account'];
				}
				$row ['account'] .= '（' . $row ['level'] . '级）';
				array_push ( $return_ary, $row );
				$return_ary = $this->getTgAccountList ( $return_ary, $row ['id'] );
			}
		}
		return $return_ary;
	}
	public function getTgAccount($account, $id = 0) {
		$this->db->select ( 'id,account,status,salt,pass,channel_name,priv,channel_priv,host,last_login_time,last_login_ip,menu_priv,priv,agent_balance,agent_balance_lock,commission' );
		$this->db->from ( 'smc_tg_account' );
		if ($id) {
			$this->db->where ( 'id', $id );
		} else {
			$this->db->where ( 'account', $account );
		}
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function insertTgAccount($data) {
		$data ['salt'] = rand ( 10000, 99999 );
		$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		return $this->db->insert ( 'smc_tg_account', $data );
	}
	public function updateTgAccount($admin_id, $data) {
		if (isset ( $data ['pass'] ) && $data ['pass']) {
			$data ['salt'] = rand ( 10000, 99999 );
			$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		}
		$this->db->where ( 'id', $admin_id );
		return $this->db->update ( 'smc_tg_account', $data );
	}
	public function plusAgentBalance($acount_id, $money, $lock) {
		$sql = "UPDATE smc_tg_account SET agent_balance = agent_balance + $money,agent_balance_lock = agent_balance_lock + 1 WHERE id = $acount_id AND agent_balance_lock = $lock";
		return $this->db->query ( $sql );
	}
	public function reduceAgentBalance($acount_id, $money, $lock) {
		$sql = "UPDATE smc_tg_account SET agent_balance = agent_balance - $money,agent_balance_lock = agent_balance_lock + 1 WHERE id = $acount_id AND agent_balance_lock = $lock";
		return $this->db->query ( $sql );
	}
	public function insertAgentBalanceLog($data) {
		return $this->db->insert ( 'smc_tg_agent_balance_log', $data );
	}
	public function getAgentBalanceLogNumber($agent_account, $data_type, $user_id, $start_time, $end_time) {
		if ($agent_account) {
			$this->db->where ( 'agent_account', $agent_account );
		}
		if($data_type){
			$this->db->where ( 'data_type', $data_type );
		}
		if ($user_id) {
			$this->db->where ( 'userid', $user_id );
		}
		if ($start_time) {
			$this->db->where ( 'add_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'add_time < ', $end_time );
		}
		return $this->db->count_all_results ( 'smc_tg_agent_balance_log' );
	}
	public function getAgentBalanceLogList($agent_account, $data_type, $user_id, $start_time, $end_time, $start, $limit) {
		$this->db->from ( 'smc_tg_agent_balance_log' );
		if ($agent_account) {
			$this->db->where ( 'agent_account', $agent_account );
		}
		if($data_type){
			$this->db->where ( 'data_type', $data_type );
		}
		if ($user_id) {
			$this->db->where ( 'userid', $user_id );
		}
		if ($start_time) {
			$this->db->where ( 'add_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'add_time < ', $end_time );
		}
		
		$this->db->order_by ( 'add_time', 'DESC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function deleteTgAccount($admin_id) {
		$this->db->where ( 'id', $admin_id );
		return $this->db->delete ( 'smc_tg_account' );
	}
	public function getOperationNumber($acount_id) {
		$this->db->where ( 'account_id', $acount_id );
		return $this->db->count_all_results ( 'smc_tg_account_log' );
	}
	public function getOperationList($acount_id, $start, $limit) {
		$this->db->from ( 'smc_tg_account_log' );
		$this->db->where ( 'account_id', $acount_id );
		$this->db->order_by ( 'add_time', 'DESC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function getMenuList() {
		$this->db->from ( 'smc_tg_menu' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function getPromotionCount() {
		$db = $this->load->database ( 'default', true );
		$res = $db->count_all_results ( 'smc_tg_promotion' );
		$db->close ();
		return $res;
	}
	public function getPromotionList($start, $limit) {
		$db = $this->load->database ( 'default', true );
		$reutrn_ary = array ();
		$db->select ( 'p.id,p.promotion_url,p.add_time,a.account,a.channel_name' );
		$db->from ( 'smc_tg_promotion p' );
		$db->join ( 'smc_tg_account a', 'a.id = p.tg_account_id' );
		$db->order_by ( 'p.id', 'ASC' );
		$db->limit ( $limit, $start );
		$query = $db->get ();
		$db->close ();
		$reutrn_ary = $query->result_array ();
		if (! empty ( $reutrn_ary )) {
			foreach ( $reutrn_ary as $k => $v ) {
				$reutrn_ary [$k] ['tg_url'] = 'http://tuiguang.yuming.com/download/app/' . $v ['id'];
			}
		}
		return $reutrn_ary;
	}
	public function getPromotionStat($start_date, $end_date, $promotion_id) {
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 00:00:00' );
		
		$report_field_ary = json_decode ( $this->config->item ( 'report_field' ), true );
		$return_ary = array ();
		$tmp_data = array ();
		$db = $this->load->database ( 'gamebuyee', true );
		// 表头
		$th_ary = array ();
		array_push ( $th_ary, '' );
		for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
			$day = date ( 'Y-m-d', $i );
			array_push ( $th_ary, $day );
			
			$db->select ( '*' );
			$db->from ( 'CASINOPROMOTIONSTAT' );
			$db->where ( 'statistics_date', $day );
			$db->where ( 'promotionid', $promotion_id );
			$db->limit ( 1 );
			$query = $db->get ();
			if ($query->num_rows () > 0) {
				$tmp_data [$day] = $query->row_array ();
			} else {
				$tmp_data [$day] = array ();
			}
		}
		array_push ( $th_ary, '总额' );
		$return_ary ['th_ary'] = $th_ary;
		
		$total_ary = array ();
		foreach ( $tmp_data as $k => $v ) {
			foreach ( $v as $k1 => $v1 ) {
				if (! isset ( $total_ary [$k1] )) {
					$total_ary [$k1] = $v1;
				} else {
					$total_ary [$k1] += $v1;
				}
			}
		}
		// 表内容
		$return_ary ['td_ary'] = array ();
		$td_ary = array ();
		foreach ( $report_field_ary as $k1 => $v1 ) {
			$one_ary = array ();
			array_push ( $one_ary, $v1 ['value'] );
			for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
				$day = date ( 'Y-m-d', $i );
				if (empty ( $tmp_data [$day] )) {
					array_push ( $one_ary, '-' );
				} else {
					array_push ( $one_ary, $this->processStaticsData ( $v1 ['key'], $tmp_data [$day], $db, $day, $promotion_id, 1 ) );
				}
				
				if ($i == $start_time) {
					if ($v1 ['key'] != 'total22' && $v1 ['key'] != 'total23') {
						array_push ( $one_ary, $this->processStaticsData ( $v1 ['key'], $total_ary, $db, $day, $promotion_id, 1 ) );
					} else {
						array_push ( $one_ary, '-' );
					}
				}
			}
			
			array_push ( $return_ary ['td_ary'], $one_ary );
		}
		$db->close ();
		return $return_ary;
	}
	public function getIncomeStatistics($member, $start_date, $end_date) {
		if($member ['channel_priv']){
			$member_channel_priv_array = json_decode ( $member ['channel_priv'], true );
		}else{
			$member_channel_priv_array = array();
		}
		$channel_list_ary = $this->config->item ( 'channellist' );
		
		$db = $this->load->database ( 'default', true );
		$his_db = $this->load->database ( 'gamebuyee', true );
		$return_ary = array ();
		$return_ary ['total_income'] = 0;
		$return_ary ['total_mission'] = 0;
		$return_ary ['total_pay'] = 0;
		$members_promotion_list = array ();
		
		$db->select ( 'id,name' );
		$db->from ( 'smc_tg_promotion' );
		$db->where ( 'tg_account_id', $member ['id'] );
		$pq = $db->get ();
		if ($pq->num_rows () > 0) {
			foreach ( $pq->result () as $row ) {
				$members_promotion_list [$row->id] = $row->name;
			}
		}
		
		$start_time = strtotime ( $start_date . ' 00:00:00' );
		$end_time = strtotime ( $end_date . ' 00:00:00' );
		
		for($i = $end_time; $i >= $start_time; $i -= 3600 * 24) {
			$day = date ( 'Y-m-d', $i );
			$db_day = date ( 'Ymd', $i );
			$return_ary [$day] = array ();
			$myfilename = "/log/tgdata/".$member['id']."-".$day.".log";
			$flagtmp = (time()-strtotime ( $day ))>3600 * 24 * 1;
			$this->writeLogErr("$myfilename-----------------------------------");
			if ($flagtmp && file_exists ( $myfilename )) {
				$saveres_day = file_get_contents ( $myfilename, LOCK_EX );
				$return_ary [$day] = json_decode($saveres_day,true);
				$this->writeLogErr("$myfilename exit");
			}
			else{
				// 包
				if (is_array ( $member_channel_priv_array ) && ! empty ( $member_channel_priv_array )) {
					foreach ( $member_channel_priv_array as $channel_id ) {
						$sql = "SELECT IFNULL(sum(pay_total_money),0) AS sum_total_pay, IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui),0) AS c
						FROM CASINOBUSINESSSTATISTICS WHERE statistics_date = '$day' AND channelid = '$channel_id' LIMIT 1";
						$query = $his_db->query ( $sql );
						if ($query->row ()->c) {
							array_push ( $return_ary [$day], array (
							'sum_total_pay' => $query->row ()->sum_total_pay,
							'commission_amount' => $query->row ()->c,
							'name' => $channel_list_ary [$channel_id],
							'account_id' => $member ['id'],
							'income_amount' => $query->row ()->c * $member ['commission']
							) );
						}
					}
				}
				
				// 直推
				if (! empty ( $members_promotion_list )) {
					foreach ( $members_promotion_list as $pid => $pname ) {
						$sql = "SELECT IFNULL(sum(pay_total_money),0) AS sum_total_pay, IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui),0) AS c
						FROM CASINOPROMOTIONSTAT WHERE statistics_date = '$day' AND promotionid = '$pid' LIMIT 1";
						$query = $his_db->query ( $sql );
						if ($query->row ()->c) {
							array_push ( $return_ary [$day], array (
							'sum_total_pay' => $query->row ()->sum_total_pay,
							'commission_amount' => $query->row ()->c,
							'name' => $pname,
							'account_id' => $member ['id'],
							'income_amount' => $query->row ()->c * $member ['commission']
							) );
						}
					}
				}
				
				// 查自己的下级代理
				// 下级代理要先查出来，因为每个下级代理的提成不一样。。。要分别计算
				$db->select ( 'a.id,a.channel_name,a.commission,a.account' );
				$db->from ( 'smc_tg_account a' );
				$db->where ( 'a.parent_id', $member ['id'] );
				$pq1 = $db->get ();
				if ($pq1->num_rows () > 0) {
					foreach ( $pq1->result () as $row_c ) {
						$promotion_ids_ary = array ();
							
						// 先统计下级代理的直推
						$db->select ( 'p.id,p.name' );
						$db->from ( 'smc_tg_promotion p' );
						$db->where ( 'p.tg_account_id', $row_c->id );
						$pq = $db->get ();
						if ($pq->num_rows () > 0) {
							foreach ( $pq->result () as $row1 ) {
								array_push ( $promotion_ids_ary, $row1->id );
							}
						}
						// 然后递归统计下级代理的下级代理所有的推广
						$promotion_ids_ary = $this->getPromotionIdsByAccount ( $row_c->id, $db, $promotion_ids_ary );
							
						foreach ( $promotion_ids_ary as $pid ) {
							$promotion_info = $this->getPromotionInfoNoPriv ( $pid, $db );
				
							$sql = "SELECT IFNULL(sum(pay_total_money),0) AS sum_total_pay, IFNULL(SUM(ddz_choushui+huanle_ddz_choushui+laizi_ddz_choushui+zjh_choushui+niuniu_choushui+qiangzhuang_niuniu_choushui+buyu_choushui+fruit_money+bao_money+fruit_compare_money +zjh_bairen_choushui+lhp_choushui+malai_niuniu_choushui+sangong_choushui+hongheidz_choushui),0) AS c
							FROM CASINOPROMOTIONSTAT WHERE statistics_date = '$day' AND promotionid = '$pid' LIMIT 1";
							$query = $his_db->query ( $sql );
				
							array_push ( $return_ary [$day], array (
							'sum_total_pay' => $query->row ()->sum_total_pay,
							'commission_amount' => $query->row ()->c,
							'name' => $promotion_info ['name'],
							'agent_name' => $row_c->channel_name,
							'account_id' => $row_c->id,
							'commission' => $row_c->commission,
							'income_amount' => $query->row ()->c * ($member ['commission'] - $row_c->commission)
							) );
						}
					}
				}
			}
			
			if (! empty ( $return_ary [$day] )) {
				$num0 = count($return_ary [$day]);
				//去重复操作
				$res_keys0 = array();
				$res_values0 = array();
				foreach ( $return_ary [$day] as $k0 => $v0 ) {
					$v_str = md5("".json_encode($v0));
					if(!in_array($v_str, $res_keys0)){
						array_push($res_keys0,$v_str);
						array_push($res_values0,$v0);
					}
				}
				$return_ary [$day] = $res_values0;
				$this->writeLogErr($member ['id']."-".$day.":$num0,".count($return_ary [$day]));
				if ($flagtmp && !file_exists ( $myfilename )) {
					$this->writeLogErr("writefile: $myfilename");
					$this->writeLogData($member,$day,json_encode($return_ary [$day]));
				}
				
				// 合计
				$total_ary = array (
						'name' => '合计', 
						'commission_amount' => 0,
						'income_amount' => 0,
						'total_pay' => 0,
				);
				foreach ( $return_ary [$day] as $k => $v ) {
					! isset ( $total_ary ['commission_amount'] ) ? $total_ary ['commission_amount'] = $v ['commission_amount'] : $total_ary ['commission_amount'] += $v ['commission_amount'];
					! isset ( $total_ary ['income_amount'] ) ? $total_ary ['income_amount'] = $v ['income_amount'] : $total_ary ['income_amount'] += $v ['income_amount'];
					! isset ( $total_ary ['total_pay'] ) ? $total_ary ['total_pay'] = $v ['sum_total_pay'] : $total_ary ['total_pay'] += $v ['sum_total_pay'];
					if($v ['income_amount']==0){
						unset ( $return_ary [$day] [$k] );
					}
				}
				
				$return_ary ['total_income'] += $total_ary ['income_amount'];
				$return_ary ['total_mission'] += $total_ary ['commission_amount'];
				$return_ary ['total_pay'] += $total_ary ['total_pay'];
				array_push ( $return_ary [$day], $total_ary );
			} else {
				unset ( $return_ary [$day] );
			}
		}
		$his_db->close ();
		$db->close ();
		// print_r ( $return_ary );
		return $return_ary;
	}
	// 递归取出下级代理所有的推广
	private function getPromotionIdsByAccount($account_id, $db, $promotion_ids_ary) {
		$db->select ( 'p.id,a.id AS account_id' );
		$db->from ( 'smc_tg_promotion p' );
		$db->join ( 'smc_tg_account a', 'p.tg_account_id = a.id' );
		$db->where ( 'a.parent_id', $account_id );
		$pq1 = $db->get ();
		if ($pq1->num_rows () > 0) {
			foreach ( $pq1->result () as $row ) {
				array_push ( $promotion_ids_ary, $row->id );
				$promotion_ids_ary = $this->getPromotionIdsByAccount ( $row->account_id, $db, $promotion_ids_ary );
			}
		}
		return $promotion_ids_ary;
	}
	private function getPromotionInfoNoPriv($promotion_id, $db) {
		$db->select ( 'id,promotion_url,tg_account_id,short_url,name' );
		$db->from ( 'smc_tg_promotion' );
		$db->where ( 'id', $promotion_id );
		$db->limit ( 1 );
		$query = $db->get ();
		return $query->row_array ();
	}
	private function processStaticsData($priv, $static_data_ary, $db, $day, $promotion_id, $type, $member_channel_priv_array = array()) {
		$result = '';
		switch ($priv) {
			case 'total15' :
				$result = $static_data_ary ['pay_total_num'];
				break;
			case 'total1' :
				$result = $static_data_ary ['new_device_count'];
				break;
			case 'total2' :
				$result = $static_data_ary ['new_user_count'];
				break;
			case 'total3' :
				$result = $static_data_ary ['new_realuser_count'];
				break;
			case 'total4' :
				$result = $static_data_ary ['new_playgame_user_count'];
				break;
			case 'total5' :
				$result = $static_data_ary ['new_guest_count'];
				break;
			case 'total6' :
				$result = $static_data_ary ['firstgame_user_count'];
				break;
			case 'total9' :
				$result = $static_data_ary ['total_user_count'];
				break;
			case 'total18' :
				$result = round ( ($static_data_ary ['choushui_money'] + $static_data_ary ['choushui_money1']) / 100, 2 ) . '元';
				break;
			case 'total_alifee' :
				$result = round ( ($static_data_ary ['alifee'] + $static_data_ary ['alifee1']) / 100, 2 ) . '元';
				break;
			case 'total19' :
				$result = round ( ($static_data_ary ['cash_money'] + $static_data_ary ['cash_money1']) / 100, 2 ) . '元';
				break;
			case 'total20' :
				$result = $static_data_ary ['active_user_7day_count'];
				break;
			case 'total10' :
				$result = $static_data_ary ['active_user_count'];
				break;
			case 'total16' :
				$result = $static_data_ary ['pay_user_count'];
				break;
			case 'total17' :
				$result = round ( $static_data_ary ['pay_total_money'] / 100, 2 ) . '元';
				break;
			case 'total12' :
				$result = $static_data_ary ['active_device_count'];
				break;
			case 'total21' :
				$result = $static_data_ary ['active_device_7day_count'];
				break;
			case 'total29' :
				$result = round ( $static_data_ary ['ddz_choushui'] / 100, 2 ) . '元';
				break;
			case 'total30' :
				$result = round ( $static_data_ary ['huanle_ddz_choushui'] / 100, 2 ) . '元';
				break;
			case 'total24' :
				$result = round ( $static_data_ary ['laizi_ddz_choushui'] / 100, 2 ) . '元';
				break;
			case 'total25' :
				$result = round ( $static_data_ary ['zjh_choushui'] / 100, 2 ) . '元';
				break;
			case 'total26' :
				$result = round ( $static_data_ary ['niuniu_choushui'] / 100, 2 ) . '元';
				break;
			case 'total27' :
				$result = round ( $static_data_ary ['qiangzhuang_niuniu_choushui'] / 100, 2 ) . '元';
				break;
			case 'total28' :
				$result = round ( $static_data_ary ['buyu_choushui'] / 100, 2 ) . '元';
				break;
			case 'total35' :
				$result = round ( ($static_data_ary ['fruit_money'] + $static_data_ary ['bao_money'] + $static_data_ary ['fruit_compare_money']) / 100, 2 ) . '元';
				break;
			case 'total36' :
				$result = round ( $static_data_ary ['zjh_bairen_choushui'] / 100, 2 ) . '元';
				break;
			case 'total31' :
				$result = round ( ($static_data_ary ['ddz_choushui'] + $static_data_ary ['huanle_ddz_choushui'] + $static_data_ary ['laizi_ddz_choushui'] + $static_data_ary ['zjh_choushui'] + $static_data_ary ['niuniu_choushui'] + $static_data_ary ['qiangzhuang_niuniu_choushui'] + $static_data_ary ['buyu_choushui'] + $static_data_ary ['fruit_money'] + $static_data_ary ['bao_money'] + $static_data_ary ['fruit_compare_money'] + $static_data_ary ['zjh_bairen_choushui'] + $static_data_ary ['lhp_choushui'] + $static_data_ary ['malai_niuniu_choushui'] + $static_data_ary ['sangong_choushui'] + $static_data_ary ['hongheidz_choushui']) / 100, 2 ) . '元';
				break;
			case 'total_lhp' :
				$result = round ( $static_data_ary ['lhp_choushui'] / 100, 2 ) . '元';
				break;
			case 'total_nnml' :
				$result = round ( $static_data_ary ['malai_niuniu_choushui'] / 100, 2 ) . '元';
				break;
			case 'total_sangong' :
				$result = round ( $static_data_ary ['sangong_choushui'] / 100, 2 ) . '元';
				break;
			case 'total_hongheidz' :
				$result = round ( $static_data_ary ['hongheidz_choushui'] / 100, 2 ) . '元';
				break;
			case 'total22' :
				$db->select ( 'new_device_count' );
				if ($type == 1) {
					$db->from ( 'CASINOPROMOTIONSTAT' );
					$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 ) );
					$db->where ( 'promotionid', $promotion_id );
				} else {
					if ($promotion_id == 'all') {
						$tmp = array ();
						foreach ( $member_channel_priv_array as $c ) {
							array_push ( $tmp, "channelid = $c" );
						}
						$tmp_where = implode ( ' OR ', $tmp );
						$db->select ( 'sum(new_device_count) AS new_device_count' );
						$db->from ( 'CASINOBUSINESSSTATISTICS' );
						$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 ) );
						$db->where ( '(' . $tmp_where . ')' );
					} else {
						$db->select ( 'new_device_count' );
						$db->from ( 'CASINOBUSINESSSTATISTICS' );
						$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 ) );
						$db->where ( 'channelid', $promotion_id );
					}
				}
				$db->limit ( 1 );
				$query = $db->get ();
				if ($query->num_rows () > 0 && $query->row ()->new_device_count > 0) {
					$new_device_count = intval ( $query->row ()->new_device_count );
					$result = round ( $static_data_ary ['retention_lastday_count'] * 100 / $new_device_count, 3 ) . '%';
				} else {
					$result = '0.000%';
				}
				break;
			case 'total23' :
				$db->select ( 'new_device_count' );
				if ($type == 1) {
					$db->from ( 'CASINOPROMOTIONSTAT' );
					$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 * 7 ) );
					$db->where ( 'promotionid', $promotion_id );
				} else {
					if ($promotion_id == 'all') {
						$tmp = array ();
						foreach ( $member_channel_priv_array as $c ) {
							array_push ( $tmp, "channelid = $c" );
						}
						$tmp_where = implode ( ' OR ', $tmp );
						$db->select ( 'sum(new_device_count) AS new_device_count' );
						$db->from ( 'CASINOBUSINESSSTATISTICS' );
						$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 * 7 ) );
						$db->where ( '(' . $tmp_where . ')' );
					} else {
						$db->select ( 'new_device_count' );
						$db->from ( 'CASINOBUSINESSSTATISTICS' );
						$db->where ( 'statistics_date', date ( 'Y-m-d', strtotime ( $day . ' 00:00:00' ) - 3600 * 24 * 7 ) );
						$db->where ( 'channelid', $promotion_id );
					}
				}
				
				$db->limit ( 1 );
				$query = $db->get ();
				if ($query->num_rows () > 0 && $query->row ()->new_device_count > 0) {
					$new_device_count = intval ( $query->row ()->new_device_count );
					$result = round ( $static_data_ary ['retention_7day_count'] * 100 / $new_device_count, 3 ) . '%';
				} else {
					$result = '0.000%';
				}
				break;
		}
		return $result;
	}
	
	
	public function queryPromotionID($user_id){
		$user_id = intval($user_id);
		$this->writeLog("queryPromotionID: $user_id");
		if($user_id){
			$data = array();
			//1 proid_smc_user
			$db_default = $this->load->database ( 'default', true );
			$db_default->select ( 'promotion_id' );
			$db_default->from ( 'smc_user' );
			$db_default->where ( 'user_id', $user_id );
			$db_default->limit ( 1 );
			$query = $db_default->get ();
			$db_default->close ();
			if ($query->num_rows () > 0) {
				$data['proid_1'] = $query->row ()->promotion_id;
			}else{
				$this->writeLog("no casinouser:$user_id smc_user");
				return null;
			}
			//2 proid_user_channel
			$db_his = $this->load->database ( 'gamehis', true );
			$db_his->select ( 'promotion_id,channel_id' );
			$db_his->from ( 'CASINOUSERCHANNEL' );
			$db_his->where ( 'user_id', $user_id );
			$query = $db_his->get ();
			$db_his->close ();
			if ($query->num_rows () > 0) {
				$data['proid_2'] = $query->row ()->promotion_id;
				$data['channel_id'] = $query->row ()->channel_id;
			}else{
				$this->writeLog("no casinouser:$user_id CASINOUSERCHANNEL");
				$channelid_tmp = 0;
				$flagAdd = $this->addChannelRecord($user_id,$channelid_tmp,intval($data ['proid_1']));
				if(!$flagAdd){
					$this->writeLog ( "error add CASINOUSERCHANNEL: $user_id " );
					return null;
				}else{
					$data ['proid_2'] = intval($data ['proid_1']);
					$data ['channel_id'] = $channelid_tmp;
				}
			}
			//3 proid_casino_user
			$this->load->model ( 'detail_model' );
			$ttt = $this->detail_model->get_index ( $user_id );
			if(!$ttt||intval($ttt["dbx"])<0||intval($ttt["pos"])<0||intval($ttt["dbx"])>15||intval($ttt["pos"])>15){
				$this->writeLog("no db index and pos $user_id");
				return null;
			}
			$dbx1 = $ttt["dbx"];
			$posx1  = $ttt["pos"];
			$db_casino = $this->load->database ( 'eus'.$dbx1, true );
			$db_casino->select ( 'promotion_id' );
			$db_casino->from ( 'CASINOUSER_'.$posx1 );
			$db_casino->where ( 'id', $user_id );
			$query = $db_casino->get ();
			$db_casino->close ();
			if ($query->num_rows () > 0) {
				$data['proid_3'] = $query->row ()->promotion_id;
			}else{
				$this->writeLog("no casinouser:$user_id CASINOUSERDB_$dbx1,CASINOUSER_$posx1");
				return null;
			}
			$this->writeLog("data: ".json_encode($data));
			return $data;
		}
		return null;
	}
	private function addChannelRecord($user_id,&$channelid,$promotion_id=0){
		$channelid = 0;
		$user_id = intval($user_id);
		$promotion_id = intval($promotion_id);
		if($user_id>0){
			for ($datefix=0; $datefix<7; $datefix++){
				$data = $this->doQueryChannelFromRegisTab($user_id,$datefix);
				if($data && array_key_exists('channelid',$data) ){
					$channelid = intval($data['channelid']);
					$flag = $this->doAddChannelRecord($user_id,$channelid,$promotion_id);
					return $flag;
				}
			}
		}
		return false;
	}
	private function doQueryChannelFromRegisTab($user_id,$datefix=0){
		$user_id = intval($user_id);
		$datefix = intval($datefix);
		$tabFrom = 'CASINOREGISTERHISTORY' . date ( 'Ymd', time() );
		if($datefix>0){
			$tabFrom = 'CASINOREGISTERHISTORY' . date ( 'Ymd', strtotime("-$datefix day") );
		}
		$this->writeLog ( "getChannelFromRegisTab: $tabFrom" );
		$db_his = $this->load->database ( 'gamehis', true );
		$db_his->select ( 'channelid' );
		$db_his->from ( $tabFrom );
		$db_his->where ( 'userid', $user_id );
		$query = $db_his->get ();
		$db_his->close ();
		$data = array();
		if ($query->num_rows () > 0) {
			$data ['channelid'] = $query->row ()->channelid;
			return $data;
		} else {
			$this->writeLog ( "no registeruser:$user_id $tabFrom" );
			return null;
		}
		return null;
	}
	private function doAddChannelRecord($user_id,$channelid,$promotion_id=0){
		$user_id = intval($user_id);
		$channelid = intval($channelid);
		$promotion_id = intval($promotion_id);
		if($user_id > 0){
			$data = array('user_id'=>$user_id,'channel_id'=>$channelid,'promotion_id'=>$promotion_id);
			$db_his = $this->load->database ( 'gamehis', true );
			$flag = $db_his->insert ( 'CASINOUSERCHANNEL', $data );
			$db_his->close ();
			$this->writeLog ( "doAddChannelRecord $flag: ".json_encode($data) );
			return $flag;
		}
		return false;
	}
	public function queryChannelID($user_id) {
		$user_id = intval ( $user_id );
		if ($user_id) {
			// 2 proid_user_channel
			$db_his = $this->load->database ( 'gamehis', true );
			$db_his->select ( 'promotion_id,channel_id' );
			$db_his->from ( 'CASINOUSERCHANNEL' );
			$db_his->where ( 'user_id', $user_id );
			$query = $db_his->get ();
			$db_his->close ();
			if ($query->num_rows () > 0) {
				$channel_id = $query->row ()->channel_id;
				return $channel_id;
			} else {
				return -1;
			}
		}
		return -1;
	}
	public function updatePromotionID($user_id,$promotion_id){
		$user_id = intval($user_id);
		$promotion_id = intval($promotion_id);
		$this->writeLog("updatePromotionID: $user_id,$promotion_id");
		if($user_id&&$promotion_id>=0){
			$data = array("promotion_id"=>$promotion_id);
			//1 proid_smc_user
			$db_default = $this->load->database ( 'default', true );
			$db_default->where ( 'user_id', $user_id );
			$flag1 = $db_default->update ( 'smc_user', $data ); 
			$db_default->close ();
			
			//2 proid_user_channel
			$db_his = $this->load->database ( 'gamehis', true );
			$db_his->where ( 'user_id', $user_id );
			$flag2 = $db_his->update ( 'CASINOUSERCHANNEL', $data ); 
			$db_his->close ();
			//3 proid_casino_user
			$this->load->model ( 'detail_model' );
			$ttt = $this->detail_model->get_index ( $user_id );
			if(!$ttt||intval($ttt["dbx"])<0||intval($ttt["pos"])<0||intval($ttt["dbx"])>15||intval($ttt["pos"])>15){
				$this->writeLog("no db index and pos ");
				return false;
			}
			$dbx1 = $ttt["dbx"];
			$posx1  = $ttt["pos"];
			$this->writeLog("$dbx1,$posx1");
			$db_casino = $this->load->database ( 'eus'.$dbx1, true );
			$db_casino->where ( 'id', $user_id );
			$flag3 = $db_casino->update ( 'CASINOUSER_'.$posx1, $data );
			$db_casino->close ();
			$this->writeLog("flag1=$flag1,flag2=$flag2,flag3=$flag3 ");
			if ($flag1&&$flag2&&$flag3) {
				return true;
			}else{
				return false;
			}
		}
		return false;
	}
	
	public function insertCorrectionLog($data) {
		return $this->db->insert ( 'smc_tg_correction_log', $data );
	}
	
	public function getCorrectionLogList($user_id, $admin_name, $start_time, $end_time, $start=0, $limit=10, $promotion_old='', $promotion_new='') {
		$user_id = intval($user_id);
		$start = intval($start);
		$limit = intval($limit);
		$this->db->from ( 'smc_tg_correction_log' );
		if ($user_id) {
			$this->db->where ( 'user_id', $user_id );
		}
		if ($admin_name) {
			$this->db->where ( 'admin_name', $admin_name );
		}
		if ($start_time) {
			$this->db->where ( 'correction_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'correction_time < ', $end_time );
		}
		if ($promotion_old) {
			$this->db->where ( "promotion_old like ", "%".$promotion_old."%" );
		}
		if ($promotion_new) {
			$this->db->where ( "promotion_new like ", "%".$promotion_new."%" );
		}
		$this->db->order_by ( 'id', 'DESC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	
	public function getCorrectionLogNum($user_id, $admin_name, $start_time, $end_time, $promotion_old='', $promotion_new='') {
		$user_id = intval($user_id);
		$this->db->from ( 'smc_tg_correction_log' );
		if ($user_id) {
			$this->db->where ( 'user_id', $user_id );
		}
		if ($admin_name) {
			$this->db->where ( 'admin_name', $admin_name );
		}
		if ($start_time) {
			$this->db->where ( 'correction_time >= ', $start_time );
		}
		if ($end_time) {
			$this->db->where ( 'correction_time < ', $end_time );
		}
		if ($promotion_old) {
			$this->db->where ( "promotion_old like ", "%".$promotion_old."%" );
		}
		if ($promotion_new) {
			$this->db->where ( "promotion_new like ", "%".$promotion_new."%" );
		}
		$res = $this->db->count_all_results ();
		return $res;
	}
	
	private function writeLogData($member, $day, $txt){
		$tgid = $member['id'];
		$log_file = "/log/tgdata/".$tgid.'-'.$day.".log";
		$handle = fopen ( $log_file, "w+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$str = fwrite ( $handle, $txt );
		fclose ( $handle );
	}
	private function writeLogErr($txt) {
		$log_file = "/log/err_tg_account_model.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	private function writeLog($txt) {
		$log_file = "/log/tg_account_model.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date ( "Y-m-d H:i:s", time () );
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
}