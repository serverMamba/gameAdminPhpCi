<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class bakuser_model extends CI_Model {
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'db_userbak' );
	}
	function getBakTableName()
	{
		$fix = date('Ymd',time());
		$strTime0 = date('Y-m-d H:i:s',time());
		$strTime1 = date('Y-m-d',time())." 05:30:00";
		$flag = strtotime($strTime0)<strtotime($strTime1);
		if($flag)
		{
			$fix = date ( 'Ymd', strtotime ( "-1 day", time()) );
		}
		$res = "ALL_CASINOUSER".$fix;
		//$this->writeLog(">>> $strTime0,$strTime1,$flag,$res");
		return $res;
	}
	public function getUserInfoList($query, $per, $start)
	{
		$sql = " select * from ".$this->getBakTableName()." ";
		if($query)
		{
			$sql .= $this->contructSqlStr($query);
		}
		$db = $this->load->database ( 'db_userbak', true );
		$sql .= " ORDER BY id DESC LIMIT $start,$per";
		$query = $db->query ( $sql );
		$db->close ();
		$resDbArr = $query->result_array ();
		return $resDbArr;
	}
	public function getRecordNum($query) {
		$sql = " select count(1) rec_num from ".$this->getBakTableName()." ";
		if($query)
		{
			$sql .= $this->contructSqlStr($query);
		}
		$db = $this->load->database ( 'db_userbak', true );
		$query = $db->query ( $sql );
		$db->close ();
		$resDbArr = $query->result_array ();
		$recNum = 0;
		if(count($resDbArr)>0)
		{
			$recNum = (int)$resDbArr[0]['rec_num'];
		}
		return $recNum;
	}
	/**public function getUserInfoList_bak($query, $per, $start)
	{
		$columnSql = $this->getColumnSql();
		$orderSql = " ORDER BY id DESC ";
		$whereSql = $this->contructSqlStr($query);
		$limitSql = " LIMIT $start,$per ";
		
		$sql1 = " select * from ".$this->getTableNameDB1($columnSql,$orderSql,$whereSql, $limitSql);
		$db1 = $this->load->database ( 'eus0_slave', true );
		$query1 = $db1->query ( $sql1 );
		$resDbArr1 = $query1->result_array ();
		$db1->close ();
		
		$sql2 = " select * from ".$this->getTableNameDB2($columnSql,$orderSql,$whereSql, $limitSql);
		$db2 = $this->load->database ( 'eus8_slave', true );
		$query2 = $db2->query ( $sql2 );
		$resDbArr2 = $query2->result_array ();
		$db2->close ();
		
		$resDbArr = array_merge($resDbArr1, $resDbArr2);
		$resDbArr = $this->cus_multi_array_sort($resDbArr,'id',SORT_DESC);
		$num = count($resDbArr);
		if($num>$per)
		{
			$num = $per;
		}
		$resDbArr = array_slice($resDbArr,0,$num);
		return $resDbArr;
	}
	public function getRecordNum_bak($query) {
		$res = 0;
		$columnSql = " count(id) rec_id";
		$orderSql = " ";
		$whereSql = $this->contructSqlStr($query);
		$limitSql = " ";
		
		$sql1 = " select sum(rec_id) total_rec_id from ".$this->getTableNameDB1($columnSql,$orderSql,$whereSql, $limitSql);
		//$this->writeLog("getRecordNum>>>".$sql1, "info");
		$db1 = $this->load->database ( 'eus0_slave', true );
		$query1 = $db1->query ( $sql1 );
		$resDbArr1 = $query1->result_array ();
		$db1->close ();
		
		$sql2 = " select sum(rec_id) total_rec_id from ".$this->getTableNameDB2($columnSql,$orderSql,$whereSql, $limitSql);
		//$this->writeLog("getRecordNum>>>".$sql2, "info");
		$db2 = $this->load->database ( 'eus8_slave', true );
		$query2 = $db2->query ( $sql2 );
		$resDbArr2 = $query2->result_array ();
		$db2->close ();
		
		$resDbArr = array_merge($resDbArr1, $resDbArr2);
		foreach($resDbArr as $row)
		{
			$res += $row['total_rec_id'];
		}
		//$this->writeLog("getRecordNum>>>".$res, "info");
		return $res;
	}**/
	public function contructSqlStr($query)
	{
		$whereSql = "";
		$keyTypeArr = $this->getColumnTypeArr();
		foreach($keyTypeArr as $columnName=>$columnType)
		{
			$val = $this->getVal($query, $columnName); //$query[$columnName];
			$val_extra = $this->getVal($query, "extra_".$columnName); //$query["extra_".$columnName];
			if($columnName && strlen("".$val)>0)
			{
				$connStr = $this->getConnStr($columnType);
				$oper = $query["operation_".$columnName];
				$columnSql = $this->createColumnSql($val, $connStr, $oper, $columnName);
				if($val_extra)
				{
					$oper_extra = $query["operation_extra_".$columnName];
					$columnSql .= " and ".$this->createColumnSql($val_extra, $connStr, $oper_extra, $columnName);;
				}
				if(strlen($whereSql)>0)
				{
					$whereSql .= " and ";
				}
				$whereSql .= " (" . $columnSql . ") ";
			}
			
		}
		if(strlen($whereSql)>0)
		{
			$whereSql = " where ".$whereSql;
		}
		return " ".$whereSql." ";
	}
	public function createColumnSql($val, $connStr, $oper, $columnName)
	{
		if($val)
		{
			$columnSql = "";
			if("6"=="".$oper)//部分匹配
			{
				$columnSql = "instr(".$columnName.",'".$val."')> 0";
				return $columnSql;
			}
			else if("7"=="".$oper)//后缀匹配
			{
				$columnSql = "reverse(".$columnName.") like reverse('%".$val."')";
				return $columnSql;
			}
			else if("8"=="".$oper)//后缀匹配
			{
				$columnSql = $columnName." like '".$val."%'";
				return $columnSql;
			}
			else
			{
				$val_real = $this->transColumnVal($val, $connStr, $oper);
				$oper_real = $this->getRealOperStr($oper);
				$columnSql = $columnName." ".$oper_real." ".$val_real;
				return $columnSql;
			}
		}
		
		return "";
	}
	public function getVal($query, $columnName)
	{
		$res = $query[$columnName];
		if("last_login_time"==$columnName || "extra_last_login_time"==$columnName)
		{
			return strtotime($res);
		}
		return $res;
	}
	public function getColumnTypeArr()
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
		return $resArr;
	}
	public function getColumnTypeArr1()
	{
		$db = $this->load->database ( 'db_userbak', true );
		$bak_database = 'ALL_USER_INFO';
		$tableBak = $this->getBakTableName();
		$sql = "SELECT COLUMN_NAME,DATA_TYPE from information_schema.`COLUMNS` where TABLE_SCHEMA='" . $bak_database . "' and TABLE_NAME='" . $tableBak . "';";
		//$sql .= " ORDER BY registertime DESC LIMIT $start,$per";
		$query = $db->query ( $sql );
		$db->close ();
		$resDbArr = $query->result_array ();
		$str = "";
		$resArr = array();
		for($i=0; $i<count($resDbArr); $i++)
		{
			$key = $resDbArr[i]['COLUMN_NAME'];
			$val = $resDbArr[i]['DATA_TYPE'];
			$resArr[$key] = $val;
		}
		return $resArr;
	}
	public function getConnStr($columnType)
	{
		if($columnType)
		{
			$columnType = strtolower($columnType);
		}
		if($columnType==='tinyint' || $columnType==='smallint' || $columnType==='mediumint' || $columnType==='int' || $columnType==='bigint')
		{
			return "";
		}
		else
		{
			return "'";
		}
	}
	public function transColumnVal($val, $connStr, $oper)
	{
		$res = $val;
		if("'"===$connStr || "\\'"===$connStr)
		{
			/**
			 * <option value="0">等于</option>
			<option value="1">不等于</option>
			<option value="2">大于</option>
			<option value="3">小于</option>
			<option value="4">大于等于</option>
			<option value="5">小于等于</option>
			<option value="6">部分匹配</option>
			<option value="7">前缀匹配</option>
			<option value="8">后缀匹配</option>
			 * 
			 * **/
			if("6"===$oper)
			{
				
				$res = "%".$res."%";
			}
			else if("7"===$oper)
			{
				$res = "%".$res;
			}
			else if("8"===$oper)
			{
				$res = $res."%";
			}
			$res = $connStr.$res.$connStr;
			return $res;
		}
		else
		{
			return $res;
		}
	}
	public function getRealOperStr($oper)
	{
		/**
			 * <option value="0">等于</option>
				<option value="1">不等于</option>
				<option value="2">大于</option>
				<option value="3">小于</option>
				<option value="4">大于等于</option>
				<option value="5">小于等于</option>
				<option value="6">部分匹配</option>
				<option value="7">前缀匹配</option>
				<option value="8">后缀匹配</option>
				**/
		switch ($oper) {
			case '1':
				return "<>";
			case '2':
				return ">";
			case '3':
				return "<";
			case '4':
				return ">=";
			case '5':
				return "<=";
			case '6':
				return "like";
			case '7':
				return "like";
			case '8':
				return "like";
			default:
				return "=";
		}
		return "=";
	}
	
	function dirHandle()
	{
		$path = "log";
		if (is_dir($path)){
			for($i=15; $i>6; $i--)
			{
				$fixStr = date ( 'Ymd', strtotime ( "-".$i." day", time()) );
				try
				{
					$fileName = "log/info".$fixStr.".log";
					unlink ( $fileName );
					//$this->writeLog($fileName." del ","info");
				}
				catch (Exception $e){}
				try
				{
					$fileName = "log/sql".$fixStr.".log";
					unlink ( $fileName);
					//$this->writeLog($fileName." del ","info");
				}
				catch (Exception $e){}
				try
				{
					$fileName = "log/error".$fixStr.".log";
					unlink ( $fileName );
					//$this->writeLog($fileName." del ","info");
				}
				catch (Exception $e){}
				try
				{
					$fileName = "log/exception".$fixStr.".log";
					unlink ( $fileName);
					//$this->writeLog($fileName." del ","info");
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
		if(!$txt)
		{
			return 1;
		}
		if(!$type)
		{
			$type = "info";
		}
		$fileName = "/log/".$type.date ( 'Ymd', time () ).".log";
		$myfile = fopen($fileName, "a+");
		if($myfile)
		{
			$txt = date ( 'Y-m-d H:i:s', time () ) . " " . $txt . "\n";
			fwrite($myfile, $txt);
			fclose($myfile);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	
	public function getColumnSql()
	{
		$columns = "`id`,`nickname`,`password`,`registertime`,`user_email`,`user_device_id`,`user_chips`,`ip`,`mac`,`win_game`,`lose_game`,`draw_game`,`channel_id`,`totalBuy`,`lastLoginIp`,`lastLoginMac`,`alipay_real_name`,`alipay_account`,`total_total_money`,`boundmobilenumber`,`last_login_time`,(win_game+lose_game+draw_game) sum_game";
		//$columns = "`id`,`nickname`,`password`,`registertime`,`user_email`,`user_device_id`,`user_chips`,`ip`,`mac`,`win_game`,`lose_game`,`draw_game`,`channel_id`,`totalBuy`,`lastLoginIp`,`lastLoginMac`,`alipay_real_name`,`alipay_account`,`boundmobilenumber`,`last_login_time`,(win_game+lose_game+draw_game) sum_game";
		return $columns;
	}
	public function getTableNameDB1($columnSql,$orderSql,$whereSql,$limitSql)
	{
		$res = "";
		
		return $res;
	}
	public function getTableNameDB2($columnSql,$orderSql,$whereSql,$limitSql)
	{
		$res = "";
		
		return $res;
	}
	function cus_multi_array_sort($multi_array, $sort_key, $sort = SORT_DESC) {
		$key_array = array();
		if (is_array($multi_array)) {
			foreach ($multi_array as $row_array) {
				if (is_array($row_array)) {
					array_push($key_array,$row_array[$sort_key]);
				} else {
					return FALSE;
				}
			}
		} else {
			return FALSE;
		}
		array_multisort($key_array, $sort, $multi_array);
		return $multi_array;
	}
	
}
