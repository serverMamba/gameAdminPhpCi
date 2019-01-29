<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * 对于埋点原始数据进行统计
 * 在crontab中每隔一段时间执行一次：/sbin/php www/index.php scripts/trackEventStatistics
 * 在crontab中每天凌晨执行一次：/sbin/php www/index.php scripts/trackEventStatistics/index 1
 * @author Administrator
 *
 */
class TrackEventStatistics extends CI_Controller {
	private $tableNamePrefix = "CASINO_TRACKING_";
	private $statTableNamePrefix = "CASINO_EVENT_";
	private $hisDB = null;
	private $statDB = null;

	public function __construct() {
		parent::__construct ( false, false );
		
		// 判断是否命令行模式
		if (!$this->input->is_cli_request())
		{
			$this->writeLog('Not cli mode');
			exit();
		}
		
		$this->hisDB = $this->load->database('gamehis', true);
		$this->statDB = $this->load->database('gamebuyee', true);
		
		$this->load->model('trackevent/track_event_model');
	}
	
	private function writeLog($msg)
	{
		$dateTime = date("Y-m-d H:i:s", time());
		echo "[$dateTime] $msg\n";
	}

	/**
	 * 参数为往前推几天
	 * @param unknown_type $prevDays
	 */
	public function index($prevDays = 0) 
	{
		$this->writeLog('Start statistics...');
		$now = time();
		$date = date("Ymd", strtotime("- {$prevDays}days", $now));
		$statisticsDate = date("Y-m-d", strtotime("- {$prevDays}days", $now));
		
		//  判断是否存在该表
		$tableName = $this->tableNamePrefix . $date;
		if (!$this->checkTableExists($this->hisDB, $tableName))
		{
			$this->writeLog('Table not exist: ' . $tableName);
			exit();
		}
		
		// 统计每个事件每天每个渠道的数据
		$allEvents = $this->track_event_model->getAllEvents();
		for ($i = 0; $i < count($allEvents); $i++)
		{
			$event = $allEvents[$i];
			$statTableName = $this->statTableNamePrefix . $event;
			if (!$this->checkTableExists($this->statDB, $statTableName))
			{
				// 创建统计数据库
				$this->createStatTable($statTableName);
			}
				
			$channelData = array();
			// 进行统计,要统计的内容有：总事件数、达成事件的人数、达成事件的所有人的id
			
			// 总事件数
			$this->hisDB->from($tableName);
			$this->hisDB->select('count(*) as times, channelId');
			$this->hisDB->group_by('channelId');
			$dbData = $this->hisDB->get()->result_array();
			
			foreach($dbData as $d)
			{
				$channelData[$d['channelId']] = array('times' => $d['times'], 'userIds' => array());
			}
			
			// 达成事件数
			$this->hisDB->from($tableName);
			$this->hisDB->select('distinct(userId) as userId, channelId');
			$this->hisDB->group_by('channelId');
			$dbData = $this->hisDB->get()->result_array();
			foreach($dbData as $d)
			{
				$cd = &$channelData[$d['channelId']];
				$cd['userIds'][] = $d['userId'];
			}
			
			$insertData = array();
			foreach($channelData as $k => $v)
			{
				$em = array(
						'statisticsDate' => $statisticsDate,
						'channelId' => $k,
						'userCount' => count($v['userIds']),
						'times' => $v['times'],
						'userIds' => json_encode($v['userIds'])
						);
				
				$insertData[] = $em;
			}
			
			// 删除目前的统计数据
			$this->statDB->delete($statTableName, array('statisticsDate' => $statisticsDate));
			
			if (count($insertData) > 0)
			{
				$this->writeLog("Insert into $statTableName success.");
				$this->statDB->insert_batch($statTableName, $insertData);
			}
			else 
			{
				$this->writeLog("Nothing need to be inserted into $statTableName.");
			}

		}
	}
	
	private function checkTableExists($db, $tableName)
	{
		$sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tableName'";
		$query = $db->query($sql);
		if ($query === false)
		{
			return false;
		}
		
		$result = $query->result_array();
		
		if (count($result) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	private function createStatTable($tableName)
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS `$tableName`(
				statisticsDate date NOT NULL,
				channelId int(11) NOT NULL,
				userCount int(11) NOT NULL COMMENT '多少人上报了此事件',
				times int(11) NOT NULL COMMENT '总共上报次数',
				userIds text COMMENT '上报时间的ID',
				UNIQUE INDEX `statisticesDate` (`statisticsDate`, `channelId`) USING BTREE
			)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
				";
		
		$query = $this->statDB->query($sql);
		if ($query === false)
		{
			return false;
		}
		
		return true;
	}
}
