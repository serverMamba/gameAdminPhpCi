<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_statistics_model extends CI_Model {
	var $chart_broad_width = 0;
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	// 充值总数，充值总用户，充值总额，提现总额，税收总额
	public function getUserStatistics($channel_id,$day_num) {
		$return_ary = array (
				'user_chart' => array (
						'labels' => array (),
						'datasets' => array (
								array (
										'label' => '用户注册数',
										'borderWidth' => $this->chart_broad_width,
										'data' => array (),
										'backgroundColor' => 'red' 
								),
								array (
										'label' => '用户登录数',
										'borderWidth' => $this->chart_broad_width,
										'data' => array (),
										'backgroundColor' => 'blue' 
								) 
						) 
				) 
		);
		$this->db->from ( 'smc_log_user' );
		$this->db->where('channel_id',$channel_id);
		$this->db->order_by ( 'date', 'DESC' );
		$this->db->limit ( $day_num );
		$query = $this->db->get ();
		if ($query->num_rows () > 0) {
			$query_ary = array_reverse ( $query->result_array () );
			foreach ( $query_ary as $row ) {
				// 添加labels
				foreach ( $return_ary as $k => $v ) {
					array_push ( $return_ary [$k] ['labels'], date ( 'Y-m-d H:i', strtotime ( $row ['date'] . '0000' ) ) );
					array_push ( $return_ary [$k] ['datasets'] [0] ['data'], $row ['reg_user_num'] );
					array_push ( $return_ary [$k] ['datasets'] [1] ['data'], $row ['login_user_num'] );
				}
			}
		}
		return $return_ary;
	}
}