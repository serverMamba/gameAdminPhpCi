<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$res = doBak($db);
writeLog("-----bak END-----".$res,'info');
exit();

//脚本中根据配置上下文情况获取
function getDBConfig($paramDbConfig)
{
	$db = array();
	if($paramDbConfig)
	{
		$db [getBakDbKey()] = $paramDbConfig[getBakDbKey()];
		$db ['db1_0'] = $paramDbConfig[getDBName()];
		$db ['db8_0'] = $paramDbConfig[getDBName8()];
		writeLog(">>>paramDbConfig not null", "info");
		return $db;
	}
	writeLog(">>>paramDbConfig is null", "error");
	exit();
}
function getDBName()
{
	return 'eus0_slave_real';
}
function getDBName8()
{
	return 'eus8_slave_real';
}
function getServerArr()
{
// 	$serverarr = array ('db1_0');
	$serverarr = array ('db1_0','db8_0');
	return $serverarr;
}
function getBakMode()//"auto"——自动检索整个服务器
{
	return "auto";//"auto";
}
function getGlobalStep()
{
	return 10000;//数据查询步长
}
function getBakDbKey()
{
	return 'db_userbak';
}
function baseBakTableName()
{
	return 'ALL_CASINOUSER';
}
function getIpTableName()
{
	return "CASINOIPLOCATION";
}
function getIpTableNameLogin()
{
	return "ALL_CASINOUSER_IP_LOGIN";
}
function getIpTableNameRegister()
{
	return "ALL_CASINOUSER_IP_REGISTER";
}
function getBakTableName()
{
	return baseBakTableName().date('Ymd',time());
}
function getBakTableName1DayBefore()
{
	return baseBakTableName().date("Ymd",strtotime("-1 day"));
}
function getBakTableName2DayBefore()
{
	return baseBakTableName().date("Ymd",strtotime("-2 day"));
}
function getBakTableName6DayBefore()
{
	return baseBakTableName().date("Ymd",strtotime("-6 day"));
}
function getBakTableName1DayAfter()
{
	return baseBakTableName().date("Ymd",strtotime("1 day"));
}
function getBakTableName2DayAfter()
{
	return baseBakTableName().date("Ymd",strtotime("2 day"));
}
function getBakTableName100DayBefore()
{
	return baseBakTableName().date("Ymd",strtotime("-100 day"));
}
function getSourceTableArr()
{
	$tabarr = array (
			'CASINOUSER_0',
			'CASINOUSER_1',
			'CASINOUSER_2',
			'CASINOUSER_3',
			'CASINOUSER_4',
			'CASINOUSER_5',
			'CASINOUSER_6',
			'CASINOUSER_7',
			'CASINOUSER_8',
			'CASINOUSER_9',
			'CASINOUSER_10',
			'CASINOUSER_11',
			'CASINOUSER_12',
			'CASINOUSER_13',
			'CASINOUSER_14',
			'CASINOUSER_15'
	);
	return $tabarr;
}



function doBak($paramDbConfig){
	writeLog("-----------------0-------------------------","info");
	//writeLog("-----------------0-------------------------","sql");
	$res = "";
	dirHandle();
	$tableBak = getBakTableName();
	$line = "<br/>";
	$bak_mode = getBakMode();
	$db_cus = getDBConfig($paramDbConfig);
	$tabarr = getSourceTableArr();
	$serverarr = getServerArr();
	//$columns = "";//"`id`,`nickname`,`password`,`registertime`,`user_email`,`user_device_id`,`user_chips`,`ip`,`mac`,`win_game`,`lose_game`,`draw_game`,`channel_id`,`totalBuy`,`lastLoginIp`,`lastLoginMac`,`alipay_real_name`,`alipay_account`,`total_total_money`,`boundmobilenumber`,`last_login_time`";
	//'ALL_CASINOUSER_' . date ( 'YmdH', time () );//'ALL_CASINOUSER_' . date ( 'YmdHis', time () );
	//初始化全部数据库连接
	logAllInfo($db_cus[getBakDbKey()]);
	writeLog("init conn ...","info");
	$db_cus = initAllDbConn($db_cus);
	logAllInfo($db_cus[getBakDbKey()]);
	writeLog("start bak data ...","info");
	$res = bakData($db_cus, $serverarr, $tabarr);
	setEmptyArea($db_cus);
	writeLog("start update data ...","info");
	$updatFlag = setSumGame($db_cus);
	//关闭全部数据库连接
	writeLog("close all conn ...","info");
	closeAllDbConn($db_cus);
	return $res;
}
function getColumnTypeArr()
{
	$resArr = array();
	$resArr['id']="bigint";
	$resArr['nickname']="varchar";
	$resArr['password']="varchar";
	$resArr['registertime']="timestamp";
	$resArr['user_email']="varchar";
	$resArr['user_device_id']="varchar";
	$resArr['user_chips']="bigint";
	$resArr['ip']="varchar";
	$resArr['mac']="varchar";
	$resArr['win_game']="int";
	$resArr['lose_game']="int";
	$resArr['draw_game']="int";
	$resArr['channel_id']="varchar";
	$resArr['totalBuy']="int";
	$resArr['lastLoginIp']="varchar";
	$resArr['lastLoginMac']="varchar";
	$resArr['alipay_real_name']="varchar";
	$resArr['alipay_account']="varchar";
	$resArr['total_total_money']="bigint";
	$resArr['boundmobilenumber']="varchar";
	$resArr['last_login_time']="bigint";
	$resArr['sum_game']="int";
	$resArr['inet_ip']="int";
	$resArr['inet_lastLoginIp']="int";
	return $resArr;
}
function bakData($db, $serverarr, $tabarr)
{
	$res = "";
	$totalItemCount = 0;
	$creatBakFlag = createBakTable($db);
	writeLog(">>>creatBakFlag=".$creatBakFlag,"info");
	$colums_type_arr = getColumnTypeArr();
	writeLog("count(colums_type_arr)=".count($colums_type_arr),"info");
	$columns = contructColumnsStr($colums_type_arr);
	writeLog("columns=".$columns,"info");
	// 开始
	for( $x=0; $x<count($serverarr); $x++ ) {
		$dbkey = $serverarr[$x];
		$dbItem = $db[$dbkey];
		writeLog("see serverarr,dbkey=".$dbkey.",dbitem=".$dbItem,"info");
		$mysql_server_name = $dbItem ["hostname"];
		$mysql_username = $dbItem ["username"];
		$mysql_password = $dbItem ["password"];
		$mysql_database = $dbItem ["database"];
		$mysql_char_set = $dbItem ["char_set"];
		logAllInfo($dbItem);
		$insql = "";
		$usertabs = getDBTablesMap($dbItem, $tabarr);
		$columnArr = split ( ',', str_replace ( "`", "", $columns ) );
		foreach ( $usertabs as $name_db => $name_tabs ) {
			$nameTabArr = split ( ',', $name_tabs );
			for($j = 0; $j < count ( $nameTabArr ); $j ++) {
				$nameTabItem = $nameTabArr [$j];
				if ($nameTabItem) {
					$dbItem = getDbItem($db, $dbkey);
					$tabDBConn = getDbConn($dbItem);
					$num_rec_tab = getRecNum($tabDBConn,$name_db,$nameTabItem);
					$stepNum = getGlobalStep();//步长
					$batchNum = getBatchNum($num_rec_tab, $stepNum);
					writeLog("stepNum=".$stepNum.",num_rec_tab=".$num_rec_tab.",batchNum=".$batchNum." mysql_server_name=".$mysql_server_name.",name_db=".$name_db.",nameTabItem=".$nameTabItem,"info");
					for($batchIndex=0; $batchIndex<$batchNum; $batchIndex++)
					{
						$realIndex = $batchIndex*$stepNum;
						$realNum = $stepNum;
						//最后一次循环做特殊处理
						if($batchIndex===($batchNum-1))
						{
							$realNum = $num_rec_tab-$batchIndex*$stepNum;
						}
						writeLog("$realNum=".$realNum.",num_rec_tab=".$num_rec_tab.",$realIndex=".$realIndex,"info");
						$insertRes = contructInsertSql($db, $dbkey, $name_db, $nameTabItem, $columns, $colums_type_arr, $realIndex, $realNum);
						$reTabRowCount = $insertRes["reTabRowCount"];
						$sqlInsert = $insertRes["sqlInsert"];
						$totalItemCount = $totalItemCount + $reTabRowCount;
						writeLog("reTabRowCount=".$reTabRowCount.",totalItemCount=".$totalItemCount,"info");
						$bakCountOld = getRecNumDBBak($db);
						$currMaxPkid = getMaxPkid($db);
						$insertflag = insertDataToBak($db, $sqlInsert);
						$bakCountNew = getRecNumDBBak($db);
						writeLog("insertflag=".$insertflag." bakCountNew=".$bakCountNew.",bakCountOld=".$bakCountOld,"info");
						$bakCount = $bakCountNew - $bakCountOld;
						if($bakCount>0)
						{
							updateIpStaticsNum($db,$currMaxPkid);
						}
						if ($bakCount!== $reTabRowCount ) {
							$logStr = " data lose reTabRowCount>>> " . $mysql_server_name . "-" . $name_db . "-" . $nameTabItem . ":" . $reTabRowCount . "-" . $bakCount . "=" . ($reTabRowCount - $bakCount);
							writeLog($logStr,"error");
							writeLog($sqlInsert,"exception");
						}
					}
				}
			}
		}
	}
	$currRecNum = getRecNumDBBak($db);
	writeLog("totalItemCount-currRecNum=".($totalItemCount-$currRecNum).", currRecNum=".$currRecNum.",totalItemCount=".$totalItemCount,"info");
	$res = $currRecNum."-".$totalItemCount;
	return $res;
}
function contructInsertSql($db, $dbkey, $name_db, $nameTabItem, $columns, $colums_type_arr, $realIndex, $realNum)
{
	$res = array("sqlInsert"=>"","reTabRowCount"=>0);
	$dbItem = getDbItem($db, $dbkey);
	$conn = getDbConn($dbItem);
	$tableBak = getBakTableName();
	$mysql_server_name = $dbItem ["hostname"];
	$sqlInsert = "insert into " . getBakTableName() . " (" . $columns . ") values ";
	// 查询某个库.某个用户表的数据
	try {
		$sqlTabColumns = " `id`,`nickname`,`password`,`registertime`,`user_email`,`user_device_id`,`user_chips`,`ip`,`mac`,`win_game`,`lose_game`,`draw_game`,`channel_id`,`totalBuy`,`lastLoginIp`,`lastLoginMac`,`alipay_real_name`,`alipay_account`,`total_total_money`,`boundmobilenumber`,`last_login_time`,INET_ATON(ip) inet_ip,INET_ATON(lastLoginIp) inet_lastLoginIp ";
		$sqlTabItem = "select ".$sqlTabColumns." from " . $nameTabItem . " limit ".$realIndex.",".$realNum.";"; // SQL语句
		// 国际标准编码.
		mysql_select_db ( $name_db, $conn ); // 打开数据库
		writeLog($sqlTabItem,"sql");
		$resultTabItem = mysql_query ( $sqlTabItem, $conn ); // 查询
		$reTabItemCount = 0;
		$reTabRowCount = mysql_num_rows ( $resultTabItem );
		writeLog($reTabRowCount . " >>>" . $mysql_server_name . "-" . $name_db . "-" . $nameTabItem,"info");
		$userid = "";
		while ( $rowTabItem = mysql_fetch_array ( $resultTabItem ) ) {
			$sqlConnStr = "";
			if ($reTabItemCount > 0) {
				$sqlConnStr = ",";
			}
			$reTabItemCount ++;
			$sqlInsertVals = "";
			foreach ($colums_type_arr as $columnName=>$columnType){
				if (strlen($sqlInsertVals) > 0) {
					$sqlInsertVals = $sqlInsertVals . ",";
				}
				$columnVal = $rowTabItem [$columnName];
				$strVal = "null";
				if($columnName=="password"||$columnName=="`password`")
				{
					$strVal = "null";
				}else if (empty ( $columnVal )) {
					if($columnType==='tinyint'|| $columnType==='smallint'|| $columnType==='mediumint'|| $columnType==='int'|| $columnType==='bigint')
					{
						$strVal = "0";
					}
					else
					{
						$strVal = "null";
					}
				} else {
					$columnVal = str_replace("'","\\'",$columnVal);
					$strVal = "'" . $columnVal . "'";
				}
				$sqlInsertVals = $sqlInsertVals . $strVal;
			}

			$sqlInsertVals = "(" . $sqlInsertVals . ")";
			$sqlInsert = $sqlInsert . $sqlConnStr . $sqlInsertVals;
		}
		$res["sqlInsert"] = $sqlInsert;
		$res["reTabRowCount"] = $reTabRowCount;
		return $res;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
	}
	return $res;
}
function insertDataToBak($db, $sqlInsert)
{
	// 数据导入备份表
	try {
		$dbkey = getBakDbKey();
		$dbItem = getDbItem($db, $dbkey);
		$conn = getDbConn($dbItem);
		$bak_database = getDataBase($db, $dbkey);
		$tableBak = getBakTableName();
		// 国际标准编码.
		mysql_query ( "set global max_allowed_packet =  2*1024*1024*10;", $conn );
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		//writeLog($sqlInsert,"sql");
		mysql_query ( $sqlInsert, $conn );
		return true;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		return false;
	}
}
function createBakTable($db)
{
	$dbkey = getBakDbKey();
	$tableBak = getBakTableName();
	$sqlDropTab = "DROP TABLE IF EXISTS `" . getBakTableName100DayBefore() . "`;";
	$sqlCreateTab = " CREATE TABLE IF NOT EXISTS `" . $tableBak . "` (
				  `pkid` bigint(20) NOT NULL AUTO_INCREMENT,	
				  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
				  `nickname` varchar(256) DEFAULT '',
				  `password` varchar(256) DEFAULT '',
				  `registertime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
				  `user_email` varchar(64) DEFAULT '',
				  `user_device_id` varchar(256) DEFAULT '',
				  `user_chips` bigint(20) DEFAULT '300' COMMENT '玩家金币',
				  `ip` varchar(32) DEFAULT '' COMMENT '注册IP',
				  `mac` varchar(64) DEFAULT '' COMMENT '注册MAC',
				  `win_game` int(10) unsigned DEFAULT '0' COMMENT '胜利游戏数',
				  `lose_game` int(10) unsigned DEFAULT '0' COMMENT '失败游戏数',
				  `draw_game` int(10) unsigned DEFAULT '0' COMMENT '放弃游戏数',
				  `channel_id` varchar(32) DEFAULT '',
				  `totalBuy` int(11) DEFAULT '0' COMMENT '总充值',
				  `lastLoginIp` varchar(32) DEFAULT '' COMMENT '最后登录IP',
				  `lastLoginMac` varchar(64) DEFAULT '' COMMENT '最后登录MAC',
				  `alipay_real_name` varchar(50) DEFAULT '' COMMENT '支付宝名称',
				  `alipay_account` varchar(100) CHARACTER SET utf8mb4 DEFAULT '' COMMENT '支付宝帐号',
				  `total_total_money` bigint(20) DEFAULT '0' COMMENT '总提现',
				  `boundmobilenumber` varchar(30) DEFAULT '' COMMENT '绑定手机号',
				  `last_login_time` bigint(20) DEFAULT NULL COMMENT '最后登录时间',
				  `sum_game` int(10) unsigned DEFAULT '0' COMMENT '总游戏数',
			      `inet_ip` int(10) unsigned DEFAULT '0' COMMENT 'inet_ip',
				  `inet_lastLoginIp` int(10) unsigned DEFAULT '0' COMMENT 'inet_lastLoginIp',
				  PRIMARY KEY (`pkid`),
  				  UNIQUE KEY `id` (`id`),
				  KEY `user_email` (`user_email`),
				  KEY `user_chips_index` (`user_chips`),
				  KEY `user_alipay_account` (`alipay_account`,`alipay_real_name`),
				  KEY `mac` (`mac`),
				  KEY `nickname` (`nickname`(255)),
				  KEY `alipay_account` (`alipay_account`),
				  KEY `boundmobilenumber` (`boundmobilenumber`),
				  KEY `registertime` (`registertime`),
				  KEY `last_login_time` (`last_login_time`),
				  KEY `inet_ip` (`inet_ip`),
				  KEY `inet_lastLoginIp` (`inet_lastLoginIp`),
				  KEY `sum_game` (`sum_game`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

	// 新建备份表
	try {
		$dbItem = getDbItem($db, $dbkey);
		$conn = getDbConn($dbItem);
		writeLog("dbkey=".$dbkey.">>>".getDbInfo($dbItem)." conn=".$dbItem['conn']." conn1=".$conn,"info");
		$bak_database = getDataBase($db, $dbkey);
		// 国际标准编码.
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		writeLog($sqlDropTab,"info");
		$resultDrop = mysql_query ( $sqlDropTab, $conn );
		writeLog("resultDrop=".$resultDrop,"info");
		writeLog($sqlCreateTab,"sql");
		$resultCreate = mysql_query ( $sqlCreateTab, $conn );
		writeLog("resultCreate=".$resultCreate,"info");
		$sqlIpRegister = createIpStaticTableRegister();
		$resultCreateIpRegister = mysql_query ( $sqlIpRegister, $conn );
		writeLog("resultCreateIpRegister=".$resultCreateIpRegister,"info");
		$sqlIpLogin = createIpStaticTableLogin();
		$resultCreateIpLogin = mysql_query ( $sqlIpLogin, $conn );
		writeLog("resultCreateIpLogin=".$resultCreateIpLogin,"info");
		return true;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		writeLog("create baktable error ","error");
		return false;
	}
}
function getBatchNum($totalDataNum, $stepNum)
{
	$batchNum = (int)($totalDataNum/$stepNum);
	if($totalDataNum%$stepNum > 0)
	{
		$batchNum = $batchNum+1;
	}
	return $batchNum;
}
function setSumGame($db){
	// 新建备份表
	try {
		$dbkey = getBakDbKey();
		$dbItem = getDbItem($db, $dbkey);
		$conn = getDbConn($dbItem);
		$bak_database = getDataBase($db, $dbkey);
		// 国际标准编码.
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		$sqlUpdateTab = " update ".getBakTableName()." set sum_game=win_game+lose_game+draw_game; ";
		writeLog($sqlUpdateTab,"sql");
		$resultUpdate = mysql_query ( $sqlUpdateTab, $conn );
		writeLog("resultUpdate=".$resultUpdate,"info");
		return true;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		writeLog("resultUpdate baktable error ","error");
		return false;
	}
}
function initAllDbConn($dbparam)
{
	if($dbparam)
	{
		writeLog('initAllDbConn->dbparam='.$dbparam.','.count($dbparam),'info');
		foreach($dbparam as $key => $dbItem)
		{
			writeLog('initAllDbConn->foreach key='.$key,'info');
			$conn = $dbItem['conn']?$dbItem['conn']:setDbConn($dbItem);
			$dbItem['conn'] = $conn;
			$dbparam[$key]['conn'] = $conn;
			if(!$conn)
			{
				writeLog($key." >>> create db conn error ","error");
				exit();
			}
		}
	}
	return $dbparam;
}
function getColumnTypeArrFromDB($db)
{
	$dbkey = getBakDbKey();
	$tableBak = getBakTableName();
	$dbItem = getDbItem($db, $dbkey);
	$conn = getDbConn($dbItem);
	$bak_database = getDataBase($db, $dbkey);
	// 获取字段类型
	$colums_type_arr = array();
	try {
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		$sqlDatatype = "SELECT COLUMN_NAME,DATA_TYPE from information_schema.`COLUMNS` where TABLE_SCHEMA='" . $bak_database . "' and TABLE_NAME='" . $tableBak . "';";
		writeLog($sqlDatatype,"sql");
		$resultDatatype = mysql_query ( $sqlDatatype, $conn );
		while ( $row = mysql_fetch_array ( $resultDatatype ) ) {
			$colums_type_arr [$row ['COLUMN_NAME']] = $row ['DATA_TYPE'];
		}
		return $colums_type_arr;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		writeLog("get baktable column type error ","error");
	}
	return null;
}
function contructColumnsStr($colums_type_arr)
{
	$colums = "";
	foreach ($colums_type_arr as $k=>$v)
	{
		if(strlen($colums)>0)
		{
			$colums .= ",";
		}
		$colums .= "`".$k."`";
	}
	return $colums;
}
function getDBTablesMap($dbItem, $tabarr)
{
	for($i = 0; $i < count ( $tabarr ); $i ++) {
		if ($i > 0) {
			$insql = $insql . ",";
		}
		$insql = $insql . "'" . $tabarr [$i] . "'";
	}
	$usertabs = array ();
	try {
		$conn = getDbConn($dbItem);
		$mysql_database = $dbItem["database"];
		// 国际标准编码.
		mysql_select_db ( $mysql_database, $conn ); // 打开数据库
		$sqlSchema = "";
		if("auto"!== getBakMode())
		{
			$sqlSchema = " TABLE_SCHEMA='".$mysql_database."' and ";
		}
		$sql = "select TABLE_SCHEMA DB_TABS,GROUP_CONCAT(DISTINCT TABLE_NAME) COUNT_TABS from information_schema.`COLUMNS` where " . $sqlSchema . " TABLE_NAME in (" . $insql . ") GROUP BY TABLE_SCHEMA ORDER BY TABLE_NAME"; // SQL语句
		//writeLog($sql,"sql");
		$resultTabs = mysql_query ( $sql, $conn ); // 查询
		$tabNum = mysql_num_rows ( $resultTabs );
		writeLog(getDbInfo($dbItem)." conn=".$conn.",tabNum=".$tabNum,"info");
		while ( $row = mysql_fetch_array ( $resultTabs ) ) {
			$name_db = $row ['DB_TABS'];
			$name_tabs = $row ['COUNT_TABS'];
			// array_push($usertabs, $name_db, $name_tabs);
			$usertabs [$name_db] = $name_tabs;
		}
		writeLog("count(usertabs)=".count($usertabs),"info");
		return $usertabs;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
			mysql_close ( $conn ); // 关闭MySQL连接
		} catch ( Exception $e ) {
		}
		$res = "no table";
		writeLog($res,"exception");
	}
	return null;
}
function getDbInfo($dbItem)
{
	$db_server_name = $dbItem ["hostname"];
	$db_database = $dbItem ["database"];
	return "db_server_name=".$db_server_name.",db_databas=".$db_database;
}
function logAllInfo($dbItem)
{
	$res = "";
	foreach($dbItem as $key => $val)
	{
		$res .= $key."->".$val."\n";
	}
	writeLog("dbItemInfo>>>".$res,"info");
}
function closeAllDbConn($db)
{
	if($db)
	{
		foreach($db as $key => $dbItem)
		{
			if($dbItem && $dbItem['conn'])
			{
				try{
					writeLog("close>>>".getDbInfo($dbItem)." conn=".$dbItem['conn'],"info");
					mysql_close ( $dbItem['conn'] );
				}catch ( Exception $e ) {
					writeLog($e->getMessage(),"exception");
				}
			}
		}
	}
}

function setDbConn($dbItem)
{
	try
	{
		$db_server_name = $dbItem ["hostname"];
		$db_username = $dbItem ["username"];
		$db_password = $dbItem ["password"];
		$db_database = $dbItem ["database"];
		$db_char_set = $dbItem ["char_set"];
		writeLog("try conn $db_server_name,$db_database,$db_username,$db_password,$db_char_set","info");
		$dbItem['conn'] = mysql_pconnect ( $db_server_name, $db_username, $db_password ); // 连接数据库
		writeLog("res conn $db_server_name,$db_database:".$dbItem['conn'],"info");
		mysql_query ( "set names '" . $db_char_set . "'", $dbItem['conn'] ); // 数据库输出编码 应该数据库编码保持一致.建议用UTF-8
		logAllInfo($dbItem);
		return $dbItem['conn'];
	}catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
			mysql_close ( $dbItem['conn'] ); // 关闭MySQL连接
		} catch ( Exception $e ) {
		}
		writeLog("create db conn error ","error");
		return null;
	}
	return null;
}
function getDbItem($db, $dbkey)
{
	if($db && $dbkey)
	{
		return $db[$dbkey];
	}
	return null;
}
function getDbConn($dbItem)
{
	if(null!=$dbItem)
	{
		writeLog(getDbInfo($dbItem)." conn=".$dbItem['conn'],"info");
		return $dbItem['conn'];
	}
	writeLog(getDbInfo($dbItem)." conn=null","info");
	return null;
}
function getDbConn2($db, $dbkey)
{
	$dbItem = getDbItem($db, $dbkey);
	getDbConn($dbItem);
}
function getRecNumDBBak($db)
{
	if($db)
	{
		$dbkey = getBakDbKey();
		$paramDatabase = getDataBase($db, $dbkey);
		$paramDBConn = getDbConn(getDbItem($db, $dbkey));
		$paramTablename = getBakTableName();
		return getRecNum($paramDBConn,$paramDatabase,$paramTablename);
	}
	return 0;
}
function getDataBaseByItem($db, $dbkey)
{
	if($db && $dbkey && $db[$dbkey])
	{
		return $db [$dbkey] ['database'];
	}
	return "";
}
function getDataBase($db, $dbkey)
{
	if($db && $dbkey && $db[$dbkey])
	{
		return $db [$dbkey] ['database'];
	}
	return "";
}
function getRecNum($paramDBConn,$paramDatabase,$paramTablename)
{
	// 数据量查询
	try {
		// 国际标准编码.
		mysql_select_db ( $paramDatabase, $paramDBConn ); // 打开数据库
		$resultInsert = mysql_query ( "select count(1) rec_num from " . $paramTablename, $paramDBConn );
		if ( $rowInsert = mysql_fetch_array ( $resultInsert ) ) {
			$rec_num = ( int ) $rowInsert ['rec_num'];
			return $rec_num;
		}
	} catch ( Exception $e ) {
		writeLog($e->getMessage(),"exception");
	}
	return 0;
}
function dirHandle()
{
	$path = "/logbakuser";
	if (is_dir($path)){
		for($i=15; $i>6; $i--)
		{
		$fixStr = date ( 'Ymd', strtotime ( "-".$i." day", time()) );
		try
		{
		$fileName = "/logbakuser/info".$fixStr.".log";
		unlink ( $fileName );
		writeLog($fileName." del ","info");
				}
				catch (Exception $e){}
				try
				{
				$fileName = "/logbakuser/sql".$fixStr.".log";
				unlink ( $fileName);
				writeLog($fileName." del ","info");
				}
						catch (Exception $e){}
						try
						{
						$fileName = "/logbakuser/error".$fixStr.".log";
						unlink ( $fileName );
						writeLog($fileName." del ","info");
						}
						catch (Exception $e){}
						try
						{
						$fileName = "/logbakuser/exception".$fixStr.".log";
						unlink ( $fileName);
						writeLog($fileName." del ","info");
						}
						catch (Exception $e){}
		}
	}
	else
	{
		//第三个参数是“true”表示能创建多级目录，iconv防止中文目录乱码
		$res=mkdir(iconv("UTF-8", "GBK", $path),0777,true);
	}

}
function writeLog($txt,$type) {
	/**if("sql"==$type||"sql"===$type){return;}
	$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] ".$type.">>" . $txt . "\n";
	print $txt;
	return;**/
	if(!$txt)
	{
		return 1;
	}
	if(!$type||empty($type))
	{
		$type = "info";
	}
	$fileName = "/logbakuser/".$type.date ( 'Ymd', time () ).".log";
	$myfile = fopen($fileName, "a+");
	if($myfile)
	{
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " . $txt . "\n";
		fwrite($myfile, $txt);
		fclose($myfile);
		return 1;
	}
	else
	{
		return 0;
	}
}

function arrToStr($result)
{
	$res = "";
	/* foreach($result as $value)
		{
	$res = $res."v->".$value.",";
	} */
	foreach ($result as $key => $value)
	{
		$res = $res.$key."->".$value;
	}
	/* for ($i= 0;$i< count($result); $i++){
	 $str= $result[$i];
	$res = $res.$str.",";
	} */
	return $res;
}

function doQuery($sql,$mysql_server_name,$mysql_username,$mysql_password,$mysql_database)
{
	$res = array();
	try {
		$conn=mysql_pconnect($mysql_server_name,$mysql_username,$mysql_password) or die("error connecting") ; //连接数据库
		if($conn)
		{
			mysql_select_db($mysql_database); //打开数据库
			$result = mysql_query($sql,$conn); //查询
			$num=0;
			while($row = mysql_fetch_array($result))
			{
				$res[$num] = $row;
				$num++;
			}
			mysql_close(); //关闭MySQL连接
		}
	}catch(Exception $e){
		try {
			writeLog($e->getMessage(),"exception");
			mysql_close(); //关闭MySQL连接
		} catch (Exception $e) {
		}
	}
	return $res;
}


function getMaxPkid($db)
{
	if($db)
	{
		$dbkey = getBakDbKey();
		$paramDatabase = getDataBase($db, $dbkey);
		$paramDBConn = getDbConn(getDbItem($db, $dbkey));
		$paramTablename = getBakTableName();
		return doGetMaxPkid($paramDBConn,$paramDatabase,$paramTablename);
	}
	return 0;
}
function doGetMaxPkid($paramDBConn,$paramDatabase,$paramTablename)
{
	// 获得最大主键
	try {
		mysql_select_db ( $paramDatabase, $paramDBConn ); // 打开数据库
		$result = mysql_query ( "select max(pkid) max_pkid from " . $paramTablename, $paramDBConn );
		if ( $row = mysql_fetch_array ( $result ) ) {
			$max_pkid = ( int ) $row ['max_pkid'];
			return $max_pkid;
		}
	} catch ( Exception $e ) {
		writeLog($e->getMessage(),"exception");
	}
	return 0;
}
function updateIpStaticsNum($db,$max_pkid)
{
	if($max_pkid<0 || !$db)
	{
		return false;
	}
	try {
		$dbkey = getBakDbKey();
		$dbItem = getDbItem($db, $dbkey);
		$conn = getDbConn($dbItem);
		$bak_database = getDataBase($db, $dbkey);
		$tableBak = getBakTableName();
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		$maxPkidNow = getMaxPkid($db);
		$endStr = date("Y-m-d",time())." 00:00:00";
		$startStr = date("Y-m-d",strtotime("-30 day"))." 00:00:00";
		$updateSqlRegister = " insert into ".getIpTableNameRegister().date('Ymd',time())."(id,registertime,channel_id,continent,country,province,city) SELECT u.id,u.registertime,u.channel_id,p.continent,p.country,p.province,p.city from ".getBakTableName()." u,".getIpTableName()." p where u.pkid>".$max_pkid." and u.pkid<=".$maxPkidNow." and u.registertime>='".$startStr."' and u.registertime<'".$endStr."' and u.inet_ip>=p.ip_begin and u.inet_ip<=p.ip_end; ";
		writeLog($updateSqlRegister,"sql");
		mysql_query ( $updateSqlRegister, $conn );
		$updateSqlLogin = " insert into ".getIpTableNameLogin().date('Ymd',time())."(id,last_login_time,channel_id,continent,country,province,city) SELECT u.id,u.last_login_time,u.channel_id,p.continent,p.country,p.province,p.city from ".getBakTableName()." u,".getIpTableName()." p where u.pkid>".$max_pkid." and u.pkid<=".$maxPkidNow." and u.last_login_time>=".strtotime($startStr)." and u.last_login_time<".strtotime($endStr)." and u.inet_lastLoginIp>=p.ip_begin and u.inet_lastLoginIp<=p.ip_end; ";
		writeLog($updateSqlLogin,"sql");
		mysql_query ( $updateSqlLogin, $conn );
		return true;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		return false;
	}
}
function createIpStaticTableRegister()
{
	$sql0 = " drop table ".getIpTableNameRegister().date("Ymd",strtotime("-100 day"))."; ";
	$sql = $sql0."CREATE TABLE IF NOT EXISTS `".getIpTableNameRegister().date("Ymd",time())."` (
			  `pkid` bigint(20) NOT NULL AUTO_INCREMENT,
			  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `channel_id` varchar(32) DEFAULT '',
			  `registertime` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
			  `continent` varchar(64) NOT NULL DEFAULT '',
			  `country` varchar(64) NOT NULL DEFAULT '',
			  `province` varchar(64) NOT NULL DEFAULT '',
			  `city` varchar(64) NOT NULL DEFAULT '',
			  PRIMARY KEY (`pkid`),
			  UNIQUE KEY `id` (`id`),
			  KEY `channel_id` (`channel_id`),
			  KEY `registertime` (`registertime`),
			  KEY `continent` (`continent`),
			  KEY `country` (`country`),
			  KEY `province` (`province`),
			  KEY `city` (`city`),
			  KEY `cpc` (`country`,`province`,`city`) USING BTREE,
  			  KEY `pc` (`province`,`city`) USING BTREE
			) ENGINE=InnoDB AUTO_INCREMENT=56667 DEFAULT CHARSET=utf8;";
	return $sql;
}
function createIpStaticTableLogin()
{
	$sql0 = " drop table ".getIpTableNameLogin().date("Ymd",strtotime("-100 day"))."; ";
	$sql = $sql0."CREATE TABLE IF NOT EXISTS `".getIpTableNameLogin().date("Ymd",time())."` (
			  `pkid` bigint(20) NOT NULL AUTO_INCREMENT,
			  `id` bigint(20) unsigned NOT NULL DEFAULT '0',
			  `channel_id` varchar(32) DEFAULT '',
			  `last_login_time` bigint(20) DEFAULT NULL COMMENT '最后登录时间',
			  `continent` varchar(64) NOT NULL DEFAULT '',
			  `country` varchar(64) NOT NULL DEFAULT '',
			  `province` varchar(64) NOT NULL DEFAULT '',
			  `city` varchar(64) NOT NULL DEFAULT '',
			  PRIMARY KEY (`pkid`),
			  UNIQUE KEY `id` (`id`),
			  KEY `channel_id` (`channel_id`),
			  KEY `last_login_time` (`last_login_time`),
			  KEY `continent` (`continent`),
			  KEY `country` (`country`),
			  KEY `province` (`province`),
			  KEY `city` (`city`),
			  KEY `cpc` (`country`,`province`,`city`) USING BTREE,
  			  KEY `pc` (`province`,`city`) USING BTREE
			) ENGINE=InnoDB AUTO_INCREMENT=80127 DEFAULT CHARSET=utf8;";
	return $sql;
}
function setEmptyArea($db)
{
	if(!$db)
	{
		return false;
	}
	try {
		$dbkey = getBakDbKey();
		$dbItem = getDbItem($db, $dbkey);
		$conn = getDbConn($dbItem);
		$bak_database = getDataBase($db, $dbkey);
		$tableBak = getBakTableName();
		mysql_select_db ( $bak_database, $conn ); // 打开数据库
		$tableName = getIpTableNameLogin().date('Ymd',time());
		
		$sql = "update ".$tableName." set continent='未知大洲' where continent='' or continent is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set country='未知国家' where country='' or country is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set province='未知省份' where province='' or province is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set city='未知城市' where city='' or city is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		
		$tableName = getIpTableNameRegister().date('Ymd',time());
		$sql = "update ".$tableName." set continent='未知大洲' where continent='' or continent is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set country='未知国家' where country='' or country is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set province='未知省份' where province='' or province is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		
		$sql = "update ".$tableName." set city='未知城市' where city='' or city is null;";
		writeLog($sql,"sql");
		mysql_query ( $sql, $conn );
		return true;
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
		} catch ( Exception $e ) {
		}
		return false;
	}
}