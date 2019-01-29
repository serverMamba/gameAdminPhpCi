<?php
error_reporting ( 0 );
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$line = "<br/>";
$db_history = $db ['gamehis'];

$bak_mode = "auto";//"auto";
$ipbak = '54.255.160.49';//bak server
$ip1 = '*******';//slove server 192.168.111.13 192.168.111.15
$ip2 = '*******';//slove server 192.168.111.13 192.168.111.15

$db ['db_bak'] ['hostname'] = $ipbak;
$db ['db_bak'] ['username'] = 'dbuserx';
$db ['db_bak'] ['password'] = '7HjcHQ7qtJ';
$db ['db_bak'] ['database'] = 'ALL_USER_INFO';
$db ['db_bak'] ['dbdriver'] = 'mysql';
$db ['db_bak'] ['dbprefix'] = '';
$db ['db_bak'] ['pconnect'] = FALSE;
$db ['db_bak'] ['db_debug'] = TRUE;
$db ['db_bak'] ['cache_on'] = FALSE;
$db ['db_bak'] ['cachedir'] = '';
$db ['db_bak'] ['char_set'] = 'utf8';
$db ['db_bak'] ['dbcollat'] = 'utf8_general_ci';
$db ['db_bak'] ['swap_pre'] = '';
$db ['db_bak'] ['autoinit'] = TRUE;
$db ['db_bak'] ['stricton'] = FALSE;
$db ['db_bak'] ['port'] = 3306;

$db ['db1_0'] ['hostname'] = $ip1;
$db ['db1_0'] ['username'] = 'dbuserx';
$db ['db1_0'] ['password'] = '7HjcHQ7qtJ';
$db ['db1_0'] ['database'] = 'CASINOUSERDB_0';
$db ['db1_0'] ['dbdriver'] = 'mysql';
$db ['db1_0'] ['dbprefix'] = '';
$db ['db1_0'] ['pconnect'] = FALSE;
$db ['db1_0'] ['db_debug'] = TRUE;
$db ['db1_0'] ['cache_on'] = FALSE;
$db ['db1_0'] ['cachedir'] = '';
$db ['db1_0'] ['char_set'] = 'utf8';
$db ['db1_0'] ['dbcollat'] = 'utf8_general_ci';
$db ['db1_0'] ['swap_pre'] = '';
$db ['db1_0'] ['autoinit'] = TRUE;
$db ['db1_0'] ['stricton'] = FALSE;
$db ['db1_0'] ['port'] = 3306;

$db ['db2_8'] ['hostname'] = $ip2;
$db ['db2_8'] ['username'] = 'dbuserx';
$db ['db2_8'] ['password'] = '7HjcHQ7qtJ';
$db ['db2_8'] ['database'] = 'CASINOUSERDB_12';
$db ['db2_8'] ['dbdriver'] = 'mysql';
$db ['db2_8'] ['dbprefix'] = '';
$db ['db2_8'] ['pconnect'] = FALSE;
$db ['db2_8'] ['db_debug'] = TRUE;
$db ['db2_8'] ['cache_on'] = FALSE;
$db ['db2_8'] ['cachedir'] = '';
$db ['db2_8'] ['char_set'] = 'utf8';
$db ['db2_8'] ['dbcollat'] = 'utf8_general_ci';
$db ['db2_8'] ['swap_pre'] = '';
$db ['db2_8'] ['autoinit'] = TRUE;
$db ['db2_8'] ['stricton'] = FALSE;
$db ['db2_8'] ['port'] = 3306;

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
$serverarr = array (
		$db ['db1_0'],
		$db ['db2_8']
);
$serverarr = array (
		$db ['db2_8']
);
//$columns = "";//"`id`,`nickname`,`password`,`registertime`,`user_email`,`user_device_id`,`user_chips`,`ip`,`mac`,`win_game`,`lose_game`,`draw_game`,`channel_id`,`totalBuy`,`lastLoginIp`,`lastLoginMac`,`alipay_real_name`,`alipay_account`,`total_total_money`,`boundmobilenumber`,`last_login_time`";
$tableBak = 'ALL_CASINOUSER_' . date ( 'YmdH', time () );//'ALL_CASINOUSER_' . date ( 'YmdHis', time () );

$res = "";
$totalItemCount = 0;
$sqlCreateTab = "CREATE TABLE IF NOT EXISTS `" . $tableBak . "` (
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
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `user_email` (`user_email`),
				  KEY `user_chips_index` (`user_chips`),
				  KEY `user_alipay_account` (`alipay_account`,`alipay_real_name`),
				  KEY `mac` (`mac`),
				  KEY `nickname` (`nickname`(255)),
				  KEY `alipay_account` (`alipay_account`),
				  KEY `boundmobilenumber` (`boundmobilenumber`),
				  KEY `registertime` (`registertime`),
				  KEY `last_login_time` (`last_login_time`)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

// 新建备份表
try {
	$bak_server_name = $db ['db_bak'] ["hostname"];
	$bak_username = $db ['db_bak'] ["username"];
	$bak_password = $db ['db_bak'] ["password"];
	$bak_database = $db ['db_bak'] ["database"];
	$bak_char_set = $db ['db_bak'] ["char_set"];
	$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
	mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码 应该数据库编码保持一致.建议用UTF-8
	// 国际标准编码.
	mysql_select_db ( $bak_database, $conn ); // 打开数据库
	writeLog($sqlCreateTab,"sql");
	$resultCreate = mysql_query ( $sqlCreateTab, $conn );
	mysql_close ( $conn ); // 关闭MySQL连接
} catch ( Exception $e ) {
	try {
		writeLog($e->getMessage(),"exception");
		mysql_close ( $conn ); // 关闭MySQL连接
	} catch ( Exception $e ) {
	}
	writeLog("create baktable error ","error");
	exit ();
}
$colums_type_arr = array();
$columns = "";
// 获取字段类型
try {
	$bak_server_name = $db ['db_bak'] ["hostname"];
	$bak_username = $db ['db_bak'] ["username"];
	$bak_password = $db ['db_bak'] ["password"];
	$bak_database = $db ['db_bak'] ["database"];
	$bak_char_set = $db ['db_bak'] ["char_set"];
	$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
	mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码 应该数据库编码保持一致.建议用UTF-8
	// 国际标准编码.
	mysql_select_db ( $bak_database, $conn ); // 打开数据库
	$sqlDatatype = "SELECT COLUMN_NAME,DATA_TYPE from information_schema.`COLUMNS` where TABLE_SCHEMA='" . $bak_database . "' and TABLE_NAME='" . $tableBak . "';";
	writeLog($sqlDatatype,"sql");
	$resultDatatype = mysql_query ( $sqlDatatype, $conn );
	while ( $row = mysql_fetch_array ( $resultDatatype ) ) {
		if(strlen($columns)>0){$columns = $columns.",";}
		$columns = $columns."`".$row ['COLUMN_NAME']."`";
		$colums_type_arr [$row ['COLUMN_NAME']] = $row ['DATA_TYPE'];
	}
	writeLog("columns:".$columns,"info");
	mysql_close ( $conn ); // 关闭MySQL连接
} catch ( Exception $e ) {
	try {
		writeLog($e->getMessage(),"exception");
		mysql_close ( $conn ); // 关闭MySQL连接
	} catch ( Exception $e ) {
	}
	writeLog("get baktable column type error ","error");
}
// 开始
foreach ( $serverarr as $dbconfig ) {
	$mysql_server_name = $dbconfig ["hostname"];
	$mysql_username = $dbconfig ["username"];
	$mysql_password = $dbconfig ["password"];
	$mysql_database = $dbconfig ["database"];
	$mysql_char_set = $dbconfig ["char_set"];

	$insql = "";
	for($i = 0; $i < count ( $tabarr ); $i ++) {
		if ($i > 0) {
			$insql = $insql . ",";
		}
		$insql = $insql . "'" . $tabarr [$i] . "'";
	}
	$usertabs = array ();
	try {
		$conn = mysql_pconnect ( $mysql_server_name, $mysql_username, $mysql_password ); // 连接数据库
		if (! $conn) {
			writeLog('connection lose',"exception");
			echo 'connection lose' . $line;
			exit ();
		}
		mysql_query ( "set names '" . $mysql_char_set . "'", $conn ); // 数据库输出编码
		// 应该数据库编码保持一致.建议用UTF-8
		// 国际标准编码.
		mysql_select_db ( $mysql_database, $conn ); // 打开数据库
		$sqlSchema = "";
		if("auto"!==$bak_mode)
		{
			$sqlSchema = " TABLE_SCHEMA='".$mysql_database."' and ";
		}
		$sql = "select TABLE_SCHEMA DB_TABS,GROUP_CONCAT(DISTINCT TABLE_NAME) COUNT_TABS from information_schema.`COLUMNS` where " . $sqlSchema . " TABLE_NAME in (" . $insql . ") GROUP BY TABLE_SCHEMA ORDER BY TABLE_NAME"; // SQL语句
		writeLog($sql,"sql");
		$resultTabs = mysql_query ( $sql, $conn ); // 查询
		while ( $row = mysql_fetch_array ( $resultTabs ) ) {
			$name_db = $row ['DB_TABS'];
			$name_tabs = $row ['COUNT_TABS'];
			// array_push($usertabs, $name_db, $name_tabs);
			$usertabs [$name_db] = $name_tabs;
		}
		mysql_close ( $conn ); // 关闭MySQL连接
	} catch ( Exception $e ) {
		try {
			writeLog($e->getMessage(),"exception");
			mysql_close ( $conn ); // 关闭MySQL连接
		} catch ( Exception $e ) {
		}
		$res = "no table" . $line;
		writeLog($res,"exception");
	}

	$columnArr = split ( ',', str_replace ( "`", "", $columns ) );
	foreach ( $usertabs as $name_db => $name_tabs ) {
		$nameTabArr = split ( ',', $name_tabs );
		for($j = 0; $j < count ( $nameTabArr ); $j ++) {
			$nameTabItem = $nameTabArr [$j];
			if ($nameTabItem) {
				// if(!("CASINOUSERDB_12"===$name_db&&"CASINOUSER_2"===$nameTabItem)){continue;}

				$sqlInsert = "insert into " . $tableBak . " (" . $columns . ") values ";
				// 查询某个库.某个用户表的数据
				try {
					$sqlTabItem = "select * from " . $nameTabItem . ";"; // SQL语句
					$conn = mysql_pconnect ( $mysql_server_name, $mysql_username, $mysql_password ); // 连接数据库
					if (! $conn) {
						writeLog('connection lose',"exception");
						echo 'connection lose' . $line;
						exit ();
					}
					mysql_query ( "set names '" . $mysql_char_set . "'", $conn ); // 数据库输出编码
					// 应该数据库编码保持一致.建议用UTF-8
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
						for($k = 0; $k < count ( $columnArr ); $k ++) {
							if ($k > 0) {
								$sqlInsertVals = $sqlInsertVals . ",";
							}
							$columnName = $columnArr [$k];
							$columnVal = $rowTabItem [$columnName];

							$strVal = "''";
							if (empty ( $columnVal )) {
								$strVal = "null";
								if("".$columnVal==="0" || $colums_type_arr[$columnName]==='tinyint'|| $colums_type_arr[$columnName]==='smallint'|| $colums_type_arr[$columnName]==='mediumint'|| $colums_type_arr[$columnName]==='int'|| $colums_type_arr[$columnName]==='bigint')
								{
									$strVal = "'0'";
								}
								else if(strlen($columnVal."")>0)
								{
									writeLog($sqlTabItem,"error");
								}
							} else {
								$strVal = "'" . $columnVal . "'";
							}
							$sqlInsertVals = $sqlInsertVals . $strVal;
						}

						$sqlInsertVals = "(" . $sqlInsertVals . ")";
						$sqlInsert = $sqlInsert . $sqlConnStr . $sqlInsertVals;
					}
					mysql_close ( $conn ); // 关闭MySQL连接
				} catch ( Exception $e ) {
					try {
						writeLog($e->getMessage(),"exception");
						mysql_close ( $conn ); // 关闭MySQL连接
					} catch ( Exception $e ) {
					}
				}
				$totalItemCount = $totalItemCount + $reTabItemCount;
				$bakCountOld = 0;
				// 数据量查询
				try {
					$bak_server_name = $db ['db_bak'] ["hostname"];
					$bak_username = $db ['db_bak'] ["username"];
					$bak_password = $db ['db_bak'] ["password"];
					$bak_database = $db ['db_bak'] ["database"];
					$bak_char_set = $db ['db_bak'] ["char_set"];
					$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
					mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码
					// 应该数据库编码保持一致.建议用UTF-8
					// 国际标准编码.
					mysql_select_db ( $bak_database, $conn ); // 打开数据库
					$resultInsert = mysql_query ( "select count(1) rec_num from " . $tableBak, $conn );
					while ( $rowInsert = mysql_fetch_array ( $resultInsert ) ) {
						$bakCountOld = ( int ) $rowInsert ['rec_num'];
					}
					mysql_close ( $conn ); // 关闭MySQL连接
				} catch ( Exception $e ) {
					try {
						writeLog($e->getMessage(),"exception");
						mysql_close ( $conn ); // 关闭MySQL连接
					} catch ( Exception $e ) {
					}
				}

				// 数据导入备份表
				try {
					$bak_server_name = $db ['db_bak'] ["hostname"];
					$bak_username = $db ['db_bak'] ["username"];
					$bak_password = $db ['db_bak'] ["password"];
					$bak_database = $db ['db_bak'] ["database"];
					$bak_char_set = $db ['db_bak'] ["char_set"];
					$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
					mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码
					// 应该数据库编码保持一致.建议用UTF-8
					// 国际标准编码.
					mysql_query ( "set global max_allowed_packet =  2*1024*1024*10;", $conn );
					mysql_select_db ( $bak_database, $conn ); // 打开数据库
					writeLog($sqlInsert,"sql");
					mysql_query ( $sqlInsert, $conn );
					mysql_close ( $conn ); // 关闭MySQL连接
				} catch ( Exception $e ) {
					try {
						writeLog($e->getMessage(),"exception");
						mysql_close ( $conn ); // 关闭MySQL连接
					} catch ( Exception $e ) {
					}
				}

				$bakCountNew = 0;
				// 数据量查询
				try {
					$bak_server_name = $db ['db_bak'] ["hostname"];
					$bak_username = $db ['db_bak'] ["username"];
					$bak_password = $db ['db_bak'] ["password"];
					$bak_database = $db ['db_bak'] ["database"];
					$bak_char_set = $db ['db_bak'] ["char_set"];
					$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
					mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码
					// 应该数据库编码保持一致.建议用UTF-8
					// 国际标准编码.
					mysql_select_db ( $bak_database, $conn ); // 打开数据库
					$resultInsert = mysql_query ( "select count(1) rec_num from " . $tableBak, $conn );
					while ( $rowInsert = mysql_fetch_array ( $resultInsert ) ) {
						$bakCountNew = ( int ) $rowInsert ['rec_num'];
					}
					mysql_close ( $conn ); // 关闭MySQL连接
				} catch ( Exception $e ) {
					try {
						writeLog($e->getMessage(),"exception");
						mysql_close ( $conn ); // 关闭MySQL连接
					} catch ( Exception $e ) {
					}
				}
				$bakCount = $bakCountNew - $bakCountOld;
				if ($reTabRowCount !== $reTabItemCount) {
					$logStr = " reTabRowCount != reTabItemCount => " . $mysql_server_name . "-" . $name_db . "-" . $nameTabItem . ":" . $reTabRowCount . "::" . $reTabItemCount. $line;
					// 							$res = $res . $logStr;
					writeLog($logStr,"error");
				}
				if ($bakCount !== $reTabItemCount || $bakCount!== $reTabRowCount ) {
					$logStr = " data lose reTabRowCount>>> " . $mysql_server_name . "-" . $name_db . "-" . $nameTabItem . ":" . $reTabRowCount . "-" . $bakCount . "=" . ($reTabRowCount - $bakCount) . $line;
					// 							$res = $res . $logStr;
					writeLog($logStr,"error");
				}
			}
		}
	}
}
writeLog("totalItemCount=".$totalItemCount,"info");
// 数据量查询
try {
	$bak_server_name = $db ['db_bak'] ["hostname"];
	$bak_username = $db ['db_bak'] ["username"];
	$bak_password = $db ['db_bak'] ["password"];
	$bak_database = $db ['db_bak'] ["database"];
	$bak_char_set = $db ['db_bak'] ["char_set"];
	$conn = mysql_pconnect ( $bak_server_name, $bak_username, $bak_password ); // 连接数据库
	if (! $conn) {
		writeLog("connection lose","exception");
		echo 'connection lose' . $line;
		exit ();
	}
	mysql_query ( "set names '" . $bak_char_set . "'", $conn ); // 数据库输出编码 应该数据库编码保持一致.建议用UTF-8
	// 国际标准编码.
	mysql_select_db ( $bak_database, $conn ); // 打开数据库
	$resultInsert = mysql_query ( "select count(1) rec_num from " . $tableBak, $conn );
	if ( $rowInsert = mysql_fetch_array ( $resultInsert ) ) {
		$rec_num = ( int ) $rowInsert ['rec_num'];
		$flag = $totalItemCount == $rec_num;
		$res = $totalItemCount . "-" . $rec_num . "=>" . $flag . $line;
		writeLog($res,"info");
	}
	mysql_close ( $conn ); // 关闭MySQL连接
} catch ( Exception $e ) {
	try {
		writeLog($e->getMessage(),"exception");
		mysql_close ( $conn ); // 关闭MySQL连接
	} catch ( Exception $e ) {
	}
}
echo $res;
function writeLog($txt,$type) {
	if(!$txt)
	{
		return 1;
	}
	if(!$type)
	{
		$type = "info";
	}
	$fileName = "log/".$type.date ( 'Ymd', time () ).".log";
	$myfile = fopen($fileName, "a+");
	if($myfile)
	{
		$txt = date ( 'YmdHis', time () ) . " " . $txt . "\n";
		fwrite($myfile, $txt);
		fclose($myfile);
		return 1;
	}
	else
	{
		return 0;
	}
}