<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class lhpgold_statistics_model extends CI_Model {
	var $chart_broad_width = 0;
	public function __construct() {
		parent::__construct ();
	}
	// 兑换总额总数
	public function getOrderStatistics($type_val, $date, $type_list) {
		$this->load->database ( 'default' );
		$return_ary = array (
				'order_total_num' => array (
						'labels' => array (),
						'datasets' => array (
								array (
										'label' => '今日'.$type_list[$type_val],
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'green',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '昨日'.$type_list[$type_val],
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'red',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '前日'.$type_list[$type_val],
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'blue',
										'spanGaps' => true,
										'lineTension' => 0.1 
								),
								array (
										'label' => '上周'.$type_list[$type_val],
										'data' => array (),
										'pointStrokeColor' => '#fff',
										'fill' => false,
										'borderColor' => 'yellow',
										'spanGaps' => true,
										'lineTension' => 0.1 
								) 
						) 
				) 
		);
		// 昨日
		$this->db->select ( 'date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold' );
		$this->db->from ( 'smc_log_lhpgold' );
		$this->db->where ( 'is_day',0);
		$this->db->where ( 'date1', date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 ) );
		$this->db->where ( 'date >=', date ( 'Y-m-d H:i:s', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 ) );
		$this->db->order_by ( 'date', 'ASC' );
		//$this->writeLog('date1=>'.date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 ));
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary, $type_val);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					array_push ( $return_ary [$k] ['labels'], date ( 'H:i:s', strtotime ( $row ['date']) ) );
					array_push ( $return_ary [$k] ['datasets'] [1] ['data'], $row [$type_val] );
				}
			}
		}
		
		// 今日
		$this->db->select ( 'date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold' );
		$this->db->from ( 'smc_log_lhpgold' );
		$this->db->where ( 'is_day',0);
		$this->db->where ( 'date1', date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' )) );
		$this->db->where ( 'date >=', date ( 'Y-m-d H:i:s', strtotime ( $date . ' 00:00:00' )) );
		$this->db->order_by ( 'date', 'ASC' );
		//$this->writeLog('date2=>'.date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' )));
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$query_ary = $query->result_array ();
			//$this->writeLog('count2=>'.count($query_ary));
			$this->dealWithDateTotalIncome($query_ary, $type_val);
			foreach ( $query_ary as $row ) {
				// 添加labels
				//$this->writeLog('row2=>'.$row);
				foreach ( $return_ary as $k => $v ) {
					//$this->writeLog(">>>".$k.'=>'.$v);
					array_push ( $return_ary [$k] ['datasets'] [0] ['data'], $row [$type_val] );
				}
			}
		}
		
		// 前日
		$this->db->select ( 'date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold' );
		$this->db->from ( 'smc_log_lhpgold' );
		$this->db->where ( 'is_day',0);
		$this->db->where ( 'date1', date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 48 ) );
		$this->db->where ( 'date >=', date ( 'Y-m-d H:i:s', strtotime ( $date . ' 00:00:00' ) - 3600 * 48 ) );
		$this->db->order_by ( 'date', 'ASC' );
		//$this->writeLog('date3=>'.date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 48 ));
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary, $type_val);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					array_push ( $return_ary [$k] ['datasets'] [2] ['data'], $row [$type_val] );
				}
			}
		}
		
		// 上周
		$this->db->select ( 'date,order_total_num,user_total_num,duihuan_gold,fanzhuan_gold,cha_gold' );
		$this->db->from ( 'smc_log_lhpgold' );
		$this->db->where ( 'is_day',0);
		$this->db->where ( 'date1', date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 * 7 ) );
		$this->db->where ( 'date >=', date ( 'Y-m-d H:i:s', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 * 7 ) );
		$this->db->order_by ( 'date', 'ASC' );
		//$this->writeLog('date4=>'.date ( 'Y-m-d', strtotime ( $date . ' 00:00:00' ) - 3600 * 24 * 7 ));
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$query_ary = $query->result_array ();
			$this->dealWithDateTotalIncome($query_ary, $type_val);
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					array_push ( $return_ary [$k] ['datasets'] [3] ['data'], $row [$type_val] );
				}
			}
		}
		
		$this->db->close ();
		return $return_ary;
	}

	/**
	 * 处理当某一天的某个小时没有收入时的状况，手动插入一条数据
	 * @param unknown_type $query_ary
	 */
	private function dealWithDateTotalIncome(&$query_ary, $type_val)
	{
		$lastDateTime = 0;
		for ($i = 0; $i < count($query_ary); $i++)
		{
			$dateTime = strtotime ( $query_ary[$i] ['date'] . ' 00:00:00' );
			if ($lastDateTime != 0 && $lastDateTime != $dateTime - 600)
			{
				// 缺少这个记录，手动插入一条
				$dateTime = $lastDateTime + 600;
				array_splice( $query_ary, $i, 0, array(array('date' => date('Y-m-d H:i:s', $dateTime), $type_val => 0)));
			}

			$lastDateTime = $dateTime;
		}
	}
	

	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "lhpgoldStatistsics";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	

}
