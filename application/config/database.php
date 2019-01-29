<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

$mainDB1 = "";
$mainDB1_slave1 = "";
$mainDB1_slave2 = "";
$mainDB2 = "";
$mainDB2_slave1 = "";
$mainDB2_slave2 = "";
$hisDB = "";
$hisDB_slave1 = "";
$alluserDB = "";
$mainDB1_slave_real = "";
$mainDB2_slave_real = "";

if (DEV_ENV)
{
	$mainDB1 = "54.179.168.6";
	$mainDB1_slave1 = "54.179.168.6";
	$mainDB2 = "54.169.242.8";
	$mainDB2_slave1 = "54.169.242.8";
	$hisDB = "54.169.242.8";
	$hisDB_slave1 = "54.169.242.8";
	$alluserDB = "";
}
else
{
		//后台永远不要从从库！！！
        $mainDB1 = "192.168.111.5";
        $mainDB1_slave1 = "192.168.111.5";
        $mainDB2 = "192.168.111.6";
        $mainDB2_slave1 = "192.168.111.6";
        $hisDB = "192.168.111.7";
        $hisDB_slave1 = "192.168.111.7";
		$alluserDB = "192.168.111.5";
		$mainDB1_slave_real = "192.168.111.5";
		$mainDB2_slave_real = "192.168.111.6";
}

$dbConfigs = array(
		array("dbName" => "default", "dbHost" => $mainDB2, "database" => "db_smc"),
		array("dbName" => "default_slave", "dbHost" => $mainDB2_slave1, "database" => "db_smc"),
		array("dbName" => "gamehis", "dbHost" => $hisDB, "database" => "CASINOGAMEHISDB"),
		array("dbName" => "gamehis_slave", "dbHost" => $hisDB_slave1, "database" => "CASINOGAMEHISDB"),
		array("dbName" => "gamebuy", "dbHost" => $mainDB2, "database" => "CASINOBUYHISDB"),
		array("dbName" => "gamebuyee", "dbHost" => $mainDB1, "database" => "CASINOSTATDB"),
		array("dbName" => "gamebuygood", "dbHost" => $mainDB2, "database" => "CASINOBUYHISDB"),
		array("dbName" => "dbhischart", "dbHost" => $mainDB2, "database" => "CASINOGLOBALINFO"),
		array("dbName" => "dbhischartee", "dbHost" => $mainDB1, "database" => "CASINOSTATDB"),
		array("dbName" => "us1", "dbHost" => $mainDB2, "database" => "CASINOGLOBALINFO"),
		array("dbName" => "us2", "dbHost" => $mainDB2, "database" => "CASINOGLOBALINFO"),
		array("dbName" => "us3", "dbHost" => $mainDB2, "database" => "CASINOBLACKLISTDB"),
		array("dbName" => "db_userbak", "dbHost" => $alluserDB, "database" => "ALL_USER_INFO"),
		array("dbName" => "eus0_slave_real", "dbHost" => $mainDB1_slave_real, "database" => "CASINOUSERDB_0"),
		array("dbName" => "eus8_slave_real", "dbHost" => $mainDB2_slave_real, "database" => "CASINOUSERDB_8"),
		array("dbName" => "eus0", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_0"),
		array("dbName" => "eus1", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_1"),
		array("dbName" => "eus2", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_2"),
		array("dbName" => "eus3", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_3"),
		array("dbName" => "eus4", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_4"),
		array("dbName" => "eus5", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_5"),
		array("dbName" => "eus6", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_6"),
		array("dbName" => "eus7", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_7"),
		array("dbName" => "eus8", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_8"),
		array("dbName" => "eus9", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_9"),
		array("dbName" => "eus10", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_10"),
		array("dbName" => "eus11", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_11"),
		array("dbName" => "eus12", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_12"),
		array("dbName" => "eus13", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_13"),
		array("dbName" => "eus14", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_14"),
		array("dbName" => "eus15", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_15"),
		array("dbName" => "eus0_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_0"),
		array("dbName" => "eus1_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_1"),
		array("dbName" => "eus2_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_2"),
		array("dbName" => "eus3_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_3"),
		array("dbName" => "eus4_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_4"),
		array("dbName" => "eus5_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_5"),
		array("dbName" => "eus6_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_6"),
		array("dbName" => "eus7_slave", "dbHost" => $mainDB1_slave1, "database" => "CASINOUSERDB_7"),
		array("dbName" => "eus8_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_8"),
		array("dbName" => "eus9_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_9"),
		array("dbName" => "eus10_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_10"),
		array("dbName" => "eus11_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_11"),
		array("dbName" => "eus12_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_12"),
		array("dbName" => "eus13_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_13"),
		array("dbName" => "eus14_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_14"),
		array("dbName" => "eus15_slave", "dbHost" => $mainDB2_slave1, "database" => "CASINOUSERDB_15"),
		array("dbName" => "mus0", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_0"),
		array("dbName" => "mus1", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_1"),
		array("dbName" => "mus2", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_2"),
		array("dbName" => "mus3", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_3"),
		array("dbName" => "mus4", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_4"),
		array("dbName" => "mus5", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_5"),
		array("dbName" => "mus6", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_6"),
		array("dbName" => "mus7", "dbHost" => $mainDB1, "database" => "CASINOUSERDB_7"),
		array("dbName" => "mus8", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_8"),
		array("dbName" => "mus9", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_9"),
		array("dbName" => "mus10", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_10"),
		array("dbName" => "mus11", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_11"),
		array("dbName" => "mus12", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_12"),
		array("dbName" => "mus13", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_13"),
		array("dbName" => "mus14", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_14"),
		array("dbName" => "mus15", "dbHost" => $mainDB2, "database" => "CASINOUSERDB_15"),
		array("dbName" => "cashorder1", "dbHost" => $mainDB1, "database" => "db_smc"),
		array("dbName" => "cashorder1_slave", "dbHost" => $mainDB1_slave1, "database" => "db_smc"),
		array("dbName" => "cashorder2", "dbHost" => $mainDB2, "database" => "db_smc"),
		array("dbName" => "cashorder2_slave", "dbHost" => $mainDB2_slave1, "database" => "db_smc"),
		array("dbName" => "black", "dbHost" => $mainDB2, "database" => "CASINOBLACKLISTDB"),
		array("dbName" => "globalinfo", "dbHost" => $mainDB2, "database" => "CASINOGLOBALINFO"),
		array("dbName" => "globalinfo1", "dbHost" => $mainDB2, "database" => "CASINOGLOBALINFO"),
		);

if (!function_exists('generateDBConfig'))
{
	// 生成数据库配置
	function generateDBConfig($dbConfigs, &$db)
	{
		$db = array();
		for ($i = 0; $i < count($dbConfigs); $i++)
		{
			$dbName = $dbConfigs[$i]['dbName'];
			$dbHost = $dbConfigs[$i]['dbHost'];
			$database = $dbConfigs[$i]['database'];

			//$db[$dbName]['hostname'] = $dbHost;
			$db[$dbName]['hostname'] = '192.168.1.58';
			//$db[$dbName]['username'] = 'dbuserx';
			$db[$dbName]['username'] = 'RoamGame';
			//$db[$dbName]['password'] = 'dbpwdxxxxxxxxxxxxxxx';
			$db[$dbName]['password'] = 'Xmpx3hTpYujflCgbRkJV1';
			$db[$dbName]['database'] = $database;
			$db[$dbName]['dbdriver'] = 'mysql';
			$db[$dbName]['dbprefix'] = '';
			$db[$dbName]['pconnect'] = FALSE;
			$db[$dbName]['db_debug'] = TRUE;
			$db[$dbName]['cache_on'] = FALSE;
			$db[$dbName]['cachedir'] = '/log/mysqllog/';
			$db[$dbName]['char_set'] = 'utf8';
			$db[$dbName]['dbcollat'] = 'utf8_general_ci';
			$db[$dbName]['swap_pre'] = '';
			$db[$dbName]['autoinit'] = TRUE;
			$db[$dbName]['stricton'] = FALSE;
			$db[$dbName]['port']     = 3306;
		}
	}
}

generateDBConfig($dbConfigs, $db);

/* End of file database.php */
/* Location: ./application/config/database.php */
