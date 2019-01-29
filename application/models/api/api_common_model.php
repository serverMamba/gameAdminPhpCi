<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Api_common_model extends CI_Model {
	var $key = 'fxxxxxxxxx';
	public function __construct() {
		parent::__construct ();
	}
	public function validSign($param, $sign) {
		ksort ( $param );
		$param_string = urldecode(http_build_query ( $param )) . $this->key;
		//exit($param_string);
		if (md5 ( $param_string ) != $sign) {
			return false;
		} else {
			return true;
		}
	}
	public function showResult($status, $msg, $data = array()) {
		$return_ary = array (
				'status' => $status,
				'msg' => $msg,
				'data' => $data 
		);
		exit ( json_encode ( $return_ary ) );
	}
}