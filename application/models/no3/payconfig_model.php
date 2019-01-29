<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Payconfig_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getList() {
		$this->db->from ( 'smc_pay_config' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function get($id) {
		$this->db->from ( 'smc_pay_config' );
		$this->db->where ( 'id', $id );
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function update($id, $data) {
		$this->db->where ( 'id', $id );
		return $this->db->update ( 'smc_pay_config', $data );
	}
	public function insert($data) {
		return $this->db->insert ( 'smc_pay_config', $data );
	}
}