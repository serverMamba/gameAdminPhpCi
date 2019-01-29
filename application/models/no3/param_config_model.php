<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Param_config_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getParamConfig() {
		$this->db->select ( 'config_key,config_value,des' );
		$this->db->from ( 'smc_config' );
		$this->db->order_by ( 'id' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function update($key, $data) {
		$this->db->where ( 'config_key', $key );
		return $this->db->update ( 'smc_config', $data );
	}
}