<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
	
/*
 * gs直接写入到redis中的金豆变化数据
 */
class jindoubianhua_gs_model extends MY_Model {
	var $db = null;
	var $payment_tables = null;
	public function __construct() {
		parent::__construct ();
	}
	public function get_jindoubianhua_his($userId, $startIndex) {
		$CI = &get_instance ();

        $redis_config = $this->config->item ( 'game_redis' );
        $redis = new Redis ();
        $redis->connect ( $redis_config ['host'], $redis_config ['port'] );
        $redis->auth ( '{DE162344-69B1-41C6-8F6D-0085FE821AC7}{8FCFE755-611D-44E2-A11A-9F22EF130804}' );
        $redis->select(8);
		
        // 拿到总数
        $totalCount = $redis->zcount($userId . "_score", 0, 9999999999999999);
        // 从redis中倒序拿startIndex开始的20条数据
        $dataSet = $redis->zrevrange($userId . "_score", $startIndex, 20);

        $redis->close();
		
		return array (
				"count" => $totalCount,
				"dataSet" => $dataSet,
		);
	}
}
