<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

define("GAME_SWITCH_DATA", 'game_switch_data');

class game_switch_model extends CI_Model {
	private $DEFAULT_CHANNEL = 0;
	private $COPY_LIST = array(
			'useDefault',
			'ddz',
			'ddzhl',
			'ddzlz',
			'zhajinhua',
			'zhajinhuabr',
			'niuniu',
			'niuniuqz',
			'niuniubr',
			'videoarcade',
			'fishing',
			'lhp',
			'niuniuml',
			'shisanzhang',
			'pacs',
			'sangong',
			'hongheidz',
			);
	
	public function __construct() {
		parent::__construct ();
	}

	public function getGameSwitchList()
	{
		$allChannelList = $this->config->item('allChannelList');
		
		// 拉取数据库内容
		$db = $this->load->database('default', true);
		$db->select('*')->from('smc_game_switch');
		$dbData = $db->get()->result_array();
		
		// 重组后的dbData
		$dbDataMap = array();
		foreach ($dbData as $v)
		{
			$dbDataMap[$v['channelId']] = $v;
		}
		
		$returnData = array();
		
		// 先插入默认行
		$returnData[] = array('channelId' => $this->DEFAULT_CHANNEL, 'channelName' => '默认', 'channelTag' => '[无]');
		foreach ($allChannelList as $v)
		{
			$returnData[] = array('channelId' => $v['channelId'], 'channelName' => $v['name'], 'channelTag' => $v['tag']);
		}
		
		// 查询数据库返回数据中的开关情况
		$returnDataCount = count($returnData);
		for ($i = 0; $i < $returnDataCount; $i++)
		{
			$channelId = $returnData[$i]['channelId'];
			if (isset($dbDataMap[$channelId]))
			{
				$dbEntry = $dbDataMap[$channelId];
				foreach ($this->COPY_LIST as $c)
				{
					$returnData[$i][$c] = $dbEntry[$c];
				}
			}
			else
			{
				// 数据库中没有，则使用默认配置
				foreach ($this->COPY_LIST as $c)
				{
					$returnData[$i][$c] = 0;
				}
				
				$returnData[$i]['useDefault'] = 1;
			}
		}
		
		return $returnData;
	}
	
	public function updateGameSwitch($channelId, $gameSwitchData)
	{
		$db = $this->load->database('default', true);
		$dbData = $db->select('*')->from('smc_game_switch')->where(array('channelId' => $channelId))->limit(1)->get()->row_array();
		if (count($dbData) > 0)
		{
			$db->update('smc_game_switch', $gameSwitchData, array('channelId' => $channelId));
		}
		else
		{
            // test
            log_message('error', ', ok23, data = ' . json_encode(get_object_vars($gameSwitchData)));
			$gameSwitchData->channelId = $channelId;
			// 找到对应的channelTag
			$allChannelList = $this->config->item('allChannelList');

			foreach ($allChannelList as $v)
			{
				if ($v['channelId'] == $channelId)
				{
					$gameSwitchData->channelTag = $v['tag'];
					break;
				}
			}

            // test
            log_message('error', ', ok24');
			$db->insert('smc_game_switch', $gameSwitchData);
            // test
            log_message('error', ', ok25');
		}

		// 删除redis内容
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
        // test
        log_message('error', ', ok26');
		$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
        // test
        log_message('error', ', ok27');
		$redis->delete(GAME_SWITCH_DATA);
		
		$this->writeLog(GAME_SWITCH_DATA.": ".json_encode($gameSwitchData));
	}
	
	
	private function writeLog($txt) {
		$log_file = "/log/game_switch.log";
		$handle = fopen ( $log_file, "a+" );
		$dateTime = date("Y-m-d H:i:s", time());
		$str = fwrite ( $handle, "[$dateTime] " . $txt . "\n" );
		fclose ( $handle );
	}
	
	
}