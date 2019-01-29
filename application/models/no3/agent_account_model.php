<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Agent_account_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getAgentAccountList() {
		$this->db->from ( 'smc_agent_account' );
		$this->db->order_by ( 'id' );
		$query = $this->db->get ();
		return $query->result_array ();
	}
	public function getAgentAccount($account, $id = 0) {
		$this->db->select ( 'id,account,status,salt,pass,channel_priv,field_priv,host' );
		$this->db->from ( 'smc_agent_account' );
		if ($id) {
			$this->db->where ( 'id', $id );
		} else {
			$this->db->where ( 'account', $account );
		}
		$this->db->limit ( 1 );
		$query = $this->db->get ();
		return $query->row_array ();
	}
	public function insertAgentAccount($data) {
		$data ['salt'] = rand ( 10000, 99999 );
		$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		return $this->db->insert ( 'smc_agent_account', $data );
	}
	public function updateAgentAccount($admin_id, $data) {
		if (isset ( $data ['pass'] ) && $data ['pass']) {
			$data ['salt'] = rand ( 10000, 99999 );
			$data ['pass'] = crypt ( $data ['pass'], $data ['salt'] );
		}
		$this->db->where ( 'id', $admin_id );
		return $this->db->update ( 'smc_agent_account', $data );
	}
	public function deleteAgentAccount($admin_id) {
		$this->db->where ( 'id', $admin_id );
		return $this->db->delete ( 'smc_agent_account' );
	}
}