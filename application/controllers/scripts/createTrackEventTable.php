<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

/**
 * 新建hisDB的埋点数据库表
 * 在crontab中每天0点执行：/sbin/php www/index.php scripts/createTrackEventTable
 * @author Administrator
 */
class CreateTrackEventTable extends CI_Controller {
	private $tableNamePrefix = "CASINO_TRACKING_";
	private $hisDB = null;

	public function __construct() {
		parent::__construct ( false, false );
		
		// 判断是否命令行模式
		if (!$this->input->is_cli_request())
		{
			$this->writeLog('Not cli mode');
			exit();
		}
		
		$this->hisDB = $this->load->database('gamehis', true);
	}
	
	private function writeLog($msg)
	{
		$dateTime = date("Y-m-d H:i:s", time());
		echo "[$dateTime] $msg\n";
	}

	public function index() 
	{
		// 每次判断三天的数据库表是否存在，不存在则创建
		$createDays = 3;
		$now = time();
		for ($i = 0; $i < $createDays; $i++)
		{
			$date = date("Ymd", strtotime("+ {$i}days", $now));
			
			//  判断是否存在该表
			$tableName = $this->tableNamePrefix . $date;
			if (!$this->checkTableExists($tableName))
			{
				if ($this->createTrackEventTable($tableName))
				{
					$this->writeLog('Create table succesfully: ' . $tableName);
				}
				else 
				{
					$this->writeLog('Create table failed: ' . $tableName);
				}
			}
		}
	}
	
	private function checkTableExists($tableName)
	{
		$sql = "SELECT table_name FROM information_schema.TABLES WHERE table_name ='$tableName'";
		$query = $this->hisDB->query($sql);
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
	
	private function createTrackEventTable($tableName)
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS `$tableName`(
				id int(11) NOT NULL AUTO_INCREMENT,
				userId int(11) NOT NULL,
				channelId int(11) NOT NULL,
				ip varchar(64) NOT NULL,
				reportTime int(11) NOT NULL COMMENT '事件发生时间',
				event varchar(64) NOT NULL COMMENT '事件名',
				params varchar(256) NOT NULL COMMENT '上报时间的参数',
				PRIMARY KEY (`id`)
			)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;
				";
		
		$query = $this->hisDB->query($sql);
		if ($query === false)
		{
			return false;
		}
		
		return true;
	}
}
