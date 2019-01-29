<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Proxy_ip_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function getProxyIp($select_tag) {
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->from ( 'smc_proxy_ip' );
		if ($select_tag) {
			$db->where ( 'tag', $select_tag );
		}
		$query = $db->get ();
		$db->close ();
		foreach ( $query->result () as $row ) {
			$return_ary [$row->tag] = $row->ip_list;
		}
		return $return_ary;
	}
	public function insertOrUpdateTag($tag, $data) {
		$db = $this->load->database ( 'default', true );
		$db->from ( 'smc_proxy_ip' );
		$db->where ( 'tag', $tag );
		$db->limit ( 1 );
		$query = $db->get ();
		if ($query->num_rows () > 0) {
			$db->where ( 'tag', $tag );
			$r = $db->update ( 'smc_proxy_ip', $data );
		} else {
			$data['tag'] = $tag;
			$r = $db->insert ( 'smc_proxy_ip', $data );
		}
		$db->close ();
		return $r;
	}
}