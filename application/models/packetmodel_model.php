<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class packetmodel_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	public function get_proxy_msg() {
		$return_ary = array ();
		$db = $this->load->database ( 'default', true );
		$db->from ( 'smc_version_module' );
		$db->order_by ( 'id' );
		$query = $db->get ();
		$db->close ();
		if ($query->num_rows () > 0) {
			foreach ( $query->result () as $row ) {
				array_push ( $return_ary, array (
						'modelname' => $row->moduleName,
						'version' => $row->latestVersion . '',
						'overversion' => $row->expiredVersion . '' 
				) );
			}
		}
		return json_encode ( $return_ary );
	}
	public function update_proxy_msg($upgradetag, $modelname, $version, $overversion) {
		$db = $this->load->database ( 'default', true );
		$data = array (
				'latestVersion' => $version,
				'expiredVersion' => $overversion 
		);
		$db->where ( 'modulename', $modelname );
		if ($db->update ( 'smc_version_module', $data )) {
			$db->close ();
			
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->del ( 'moduleUpdateInfo' );
			return true;
		} else {
			$db->close ();
			return false;
		}
	}
}
