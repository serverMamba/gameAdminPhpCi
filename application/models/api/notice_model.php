<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Notice_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getNoticeList($start, $per) {
		$this->db->from ( 'smc_sys_notice' );
		$this->db->where ( 'status', 1 );
		$this->db->order_by ( 'add_time', 'DESC' );
		$this->db->limit ( $per, $start );
		$query = $this->db->get ();
		return $query->result_array ();
	}
}