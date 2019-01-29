<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Black_alipay_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getBlackAlipayNum($query) {
		if ($query ['alipay_account']) {
			$this->db->where ( 'alipay_account', $query ['alipay_account'] );
		}
		if ($query ['alipay_real_name']) {
			$this->db->where ( 'alipay_real_name', $query ['alipay_real_name'] );
		}
		return $this->db->count_all_results ( 'smc_black_alipay_account' );
	}
	public function getBlackAlipayList($query, $start, $limit) {
		$this->db->from ( 'smc_black_alipay_account' );
		if ($query ['alipay_account']) {
			$this->db->where ( 'alipay_account', $query ['alipay_account'] );
		}
		if ($query ['alipay_real_name']) {
			$this->db->where ( 'alipay_real_name', $query ['alipay_real_name'] );
		}
		$this->db->order_by ( 'id', 'DESC' );
		$this->db->limit ( $limit, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function insertBlack($data) {
		return $this->db->insert ( 'smc_black_alipay_account', $data );
	}
	public function deleteBlack($id) {
		$this->db->where ( 'id', $id );
		return $this->db->delete ( 'smc_black_alipay_account' );
	}
}