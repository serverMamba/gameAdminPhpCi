<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Qpalzm extends CI_Controller {
	var $base_url = 'http://13.229.59.233:18080/';
	var $pass = '123456bb';
	function index() {
		$data ['base_url'] = $this->base_url;
		$this->load->view ( 'qa/aaa_views', $data );
	}
	public function addGold() {
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		
		if (intval ( $redis->get ( 'add_gold_error' ) ) >= 3) {
			$redis->close ();
			$return_ary ['msg'] = '错误过多，请联系管理员';
			exit ( json_encode ( $return_ary ) );
		}
		
		$return_ary = array (
				'status' => 0,
				'msg' => '' 
		);
		$user_id = intval ( $this->input->post ( 'user_id' ) );
		$gold = intval ( $this->input->post ( 'gold' ) );
		$pass = $this->input->post ( 'pass', true );
		
		if (! $user_id || ! $gold || ! $pass) {
			$redis->incr ( 'add_gold_error' );
			$redis->close ();
			$return_ary ['msg'] = '参数错误';
			exit ( json_encode ( $return_ary ) );
		}
		
		if ($pass != $this->pass) {
			$redis->incr ( 'add_gold_error' );
			$redis->close ();
			$return_ary ['msg'] = '密码错误';
			exit ( json_encode ( $return_ary ) );
		}
		
		$this->load->model ( 'detail_model' );
		if ($this->detail_model->score_operation_by_recharge ( $user_id, $gold )) {
			$redis->close ();
			$return_ary ['status'] = 1;
			$return_ary ['msg'] = '成功';
			exit ( json_encode ( $return_ary ) );
		} else {
			$redis->close ();
			$return_ary ['msg'] = '添加失败';
			exit ( json_encode ( $return_ary ) );
		}
	}
}