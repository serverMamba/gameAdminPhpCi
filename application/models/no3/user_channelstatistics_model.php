<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class user_channelstatistics_model extends CI_Model {
	var $chart_broad_width = 0;
	public function __construct() {
		parent::__construct ();
		$this->load->database ( 'default' );
	}
	public function getUserStatisticsByChannel($channelList,$startTime,$endTime,$timeColumn,$channelId,$select_area_province,$select_area_city)
	{
		$dbDataArr = $this->getDBDataArr($channelList,$startTime,$endTime,$timeColumn,$channelId,$select_area_province,$select_area_city);
		$chartDataArr = $this->getChartDataArr($dbDataArr);	
		return $chartDataArr;
	}
	public function getDBDataArr2Types($channelList,$startTime,$endTime,$channelId,$select_area_province,$select_area_city){
		$dataArrRegister = $this->getDBDataArr($channelList,$startTime,$endTime,"registertime",$channelId,$select_area_province,$select_area_city);
		$dataArrLogin = $this->getDBDataArr($channelList,$startTime,$endTime,"last_login_time",$channelId,$select_area_province,$select_area_city);
		$megerLabelArr = array();
		foreach ($dataArrRegister as $areaName=>$sum_rec_num)
		{
			array_push($megerLabelArr, $areaName);
		}
		foreach ($dataArrLogin as $areaName=>$sum_rec_num)
		{
			if(!in_array($areaName, $megerLabelArr))
			{
				array_push($megerLabelArr, $areaName);
			}
		}
		
		$dataArrRegisterNew = array();
		$dataArrLoginNew = array();
		foreach ($megerLabelArr as $areaName)
		{
			if(!$dataArrRegister[$areaName])
			{
				$dataArrRegisterNew[$areaName] = 0;
			}
			else{
				$dataArrRegisterNew[$areaName] = $dataArrRegister[$areaName];
			}
			if(!$dataArrLogin[$areaName])
			{
				$dataArrLoginNew[$areaName] = 0;
			}
			else{
				$dataArrLoginNew[$areaName] = $dataArrLogin[$areaName];
			}
		}
		return array("registertime"=>$dataArrRegister,"last_login_time"=>$dataArrLogin);
	}
	public function getDBDataArr($channelList,$startTime,$endTime,$timeColumn,$channelId,$select_area_province,$select_area_city){
		$whereSql = "";
		$groupColumn = "p.province";
		if($startTime)
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			if("last_login_time"==$timeColumn)
			{
				$whereSql = $whereSql." last_login_time>=".strtotime($startTime)." ";
			}
			else{
				$whereSql = $whereSql." registertime>='".$startTime."' ";
			}
		}
		if($endTime)
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			if("last_login_time"==$timeColumn)
			{
				$whereSql = $whereSql." last_login_time<".strtotime($endTime)." ";
			}
			else{
				$whereSql = $whereSql." registertime<'".$endTime."' ";
			}
		}
		if($channelId && !empty($channelId))
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			$whereSql = $whereSql." channel_id='".$channelId."' ";
		}		
		if(!$select_area_province)
		{
			$groupColumn = "CONCAT(p.country,p.province)";
		}
		else
		{
			$groupColumn = "CONCAT(p.country,p.province,p.city)";
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			$whereSql = $whereSql." province='".$select_area_province."' ";
			if($select_area_city && !empty($select_area_city))
			{
				$whereSql = $whereSql." and city='".$select_area_city."' ";
			}
		}
		if($whereSql && !empty($whereSql))
		{
			$whereSql = " where ".$whereSql;
		}
		$columnSql = " count(1) rec_num,".$groupColumn." area_name ";
		$groupSql = " group by ".$groupColumn." ";
	
		$ipTabName = $this->getIpTableNameRegister();
		if("last_login_time"==$timeColumn)
		{
			$ipTabName = $this->getIpTableNameLogin();
		}
		$sql = " select sum_rec_num,area_name from (select sum(X.rec_num) sum_rec_num,X.area_name from (select $columnSql from ".$ipTabName." p $whereSql $groupSql   order by rec_num desc) X group by X.area_name) Y order by sum_rec_num desc; ";
		//$this->writeLog("sql>>>".$sql);
		$db = $this->load->database ( $this->getDBName(), true );
		$query = $db->query ( $sql );
		$resDbArr = $query->result_array ();
		$db->close ();
	
		$resArr = $this->parseDbArr($resDbArr);
		return $resArr;
		
	}
	public function parseDbArr($resDbArr)
	{
		$resArr = array();
		foreach ($resDbArr as $row)
		{
			$area_name = $row['area_name'];
			if(!$resArr[$area_name])
			{
				$resArr[$area_name] = $row['sum_rec_num'];
			}else
			{
				$resArr[$area_name] += $row['sum_rec_num'];
			}
		}
		return $resArr;
	}
	public function contructWhereSql($channelList,$startTime,$endTime,$timeColumn,$channelId,$select_area_province,$select_area_city)
	{
		$whereSql = "";
		if($startTime)
		{
			if("last_login_time"==$timeColumn)
			{
				$whereSql = "u.last_login_time >= ".strtotime($startTime);
			}
			else
			{
				$whereSql = "u.registertime >= '$startTime'";
			}
		}
		if($endTime)
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			if("last_login_time"==$timeColumn)
			{
				$whereSql = "u.last_login_time <= ".strtotime($endTime);
			}
			else
			{
				$whereSql = $whereSql."u.registertime <= '$endTime'";
			}
		}
		if($channelId)
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			$whereSql = $whereSql."u.channel_id = '$channelId'";
		}
		if($select_area_province)
		{
			if($whereSql && !empty($whereSql))
			{
				$whereSql = $whereSql." and ";
			}
			$whereSql = $whereSql."p.province = '$select_area_province'";
			if($select_area_city)
			{
				if($whereSql && !empty($whereSql))
				{
					$whereSql = $whereSql." and ";
				}
				$whereSql = $whereSql."p.city = '$select_area_city'";
			}
		}
		
		if($whereSql && !empty($whereSql))
		{
			$whereSql = " and ".$whereSql;
		}
		//$this->writeLog("whereSql=".$whereSql);
		return $whereSql;
	}
	public function getChartDataArr($resArr,$timeColumn){
		$labelsArr = array();
		$datasetsArr = array();
		$num = 0;
		foreach ($resArr as $areaName=>$sum_rec_num)
		{
			++$num;
			$colorArr = $this->getColorArr();
			array_push($labelsArr, $areaName);
			array_push($datasetsArr, $sum_rec_num);
			//$this->writeLog("$num: $channelId=>".$sum_rec_num);
		}
		$return_ary = array (
				'user_chart' => array (
						'labels' => $labelsArr,
						'datasets' => array (
								array (
										'label' => "last_login_time"==$timeColumn?'活跃玩家数量':'新增玩家数量',
										'borderWidth' => 1,
										'data' => $datasetsArr,
										'backgroundColor' => "last_login_time"==$timeColumn?'red':'green'
								)
						)
				)
		);
		return $return_ary;
	}
	public function getChartDataArr2Types($datasArr){
		if(!$datasArr)
		{
			return array();
		}
		$datasArrRegister = $datasArr["registertime"];
		$datasArrLogin = $datasArr["last_login_time"];
		$labelsArr = array();
		$datasetsArrRegister = array();
		$datasetsArrLogin = array();
		foreach ($datasArrRegister as $areaName=>$sum_rec_num)
		{
			array_push($labelsArr, $areaName);
			array_push($datasetsArrRegister, $sum_rec_num);
			array_push($datasetsArrLogin, $datasArrLogin[$areaName]?$datasArrLogin[$areaName]:0);
		}
		
		$return_ary = array (
				'user_chart' => array (
						'labels' => $labelsArr,
						'datasets' => array (
								array (
										'label' => '新增玩家数量',
										'borderWidth' => 1,
										'data' => $datasetsArrRegister,
										'backgroundColor' => 'green'
								),
								array (
										'label' => '活跃玩家数量',
										'borderWidth' => 1,
										'data' => $datasetsArrLogin,
										'backgroundColor' => 'red'
								)
						)
				)
		);
		return $return_ary;
	}
	
	
	public function getAreaProvince()
	{
		$columnName = "province";
		$whereSql = "";
		$res = $this->getAreaData($columnName, $whereSql);
		return $res;
	}
	public function getAreaCity($province)
	{
		$columnName = "city";
		$whereSql = " where province='".$province."' ";
		$res = $this->getAreaData($columnName, $whereSql);
		return $res;
	}
	public function getAreaData($columnName,$whereSql)
	{
		$columnSql = 'distinct '.$columnName;
		$sql = " select ".$columnSql." from ".$this->getIpTableName()." $whereSql";
		//$this->writeLog("getAreaData sql=".$sql);
		$db = $this->load->database ( $this->getDBName(), true );
		$query = $db->query ( $sql );
		$resDbArr = $query->result_array ();
		$db->close ();
		$resArr = array();
		$index = 0;
		foreach ($resDbArr as $row)
		{
			array_push($resArr, $row[$columnName]);
			//$this->writeLog("getAreaData areaName=".$row[$columnName]);
		}
		return $resArr;
	}
	
	public function getDBName()
	{
		return "db_userbak";	
	}
	public function getIpTableName()
	{
		return "CASINOIPLOCATION";
	}
	public function getIpTableNameLogin()
	{
		$fix = date('Ymd',time());
		$strTime0 = date('Y-m-d H:i:s',time());
		$strTime1 = date('Y-m-d',time())." 05:30:00";
		$flag = strtotime($strTime0)<strtotime($strTime1);
		if($flag)
		{
			$fix = date ( 'Ymd', strtotime ( "-1 day", time()) );
		}
		$res = "ALL_CASINOUSER_IP_LOGIN".$fix;
		//$this->writeLog(">>> $strTime0,$strTime1,$flag,$res");
		return $res;
	}
	public function getIpTableNameRegister()
	{
		$fix = date('Ymd',time());
		$strTime0 = date('Y-m-d H:i:s',time());
		$strTime1 = date('Y-m-d',time())." 05:30:00";
		$flag = strtotime($strTime0)<strtotime($strTime1);
		if($flag)
		{
			$fix = date ( 'Ymd', strtotime ( "-1 day", time()) );
		}
		$res = "ALL_CASINOUSER_IP_REGISTER".$fix;
		//$this->writeLog(">>> $strTime0,$strTime1,$flag,$res");
		return $res;
	}
	
	public function writeLog($txt, $dayflag=false) {
		if(!$txt){return;}
		$filename = "areaStaticsChannel";
		if($dayflag){$filename=$filename.date ( '_Y-m-d', time () );}
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	
	public function getColorArr()
	{
		$colorArr = array(1=>"red",2=>"green",3=>"aquamarine",4=>"black",5=>"yellow",6=>"gray",7=>"pink",8=>"brown",9=>"silver",10=>"gold",11=>"greenyellow",12=>"khaki",13=>"chocolate",14=>"cyan",15=>"maroon",16=>"blue",17=>"navy",18=>"coral",19=>"darkviolet",20=>"Brown",21=>"maroon",22=>"bisque",23=>"salmon",24=>"Tan",25=>"wheat",26=>"teal",27=>"snow",28=>"slategray",29=>"seagreen",30=>"lawngreen",31=>"azure",32=>"aquamarine");
		return $colorArr;
	}
	
	public function getPieData($dbDataArr,$totalNum)
	{
		/**
		$dataArr = array(
				array(
						name=> '北京',
						value=> '13',
						y=> 0.13,
						color=> 'red'
				),
				array(
						name=> '上海',
						value=> '15',
						y=> 0.15,
						color=> 'blue'
				),
				array(
						name=> '广州',
						value=> '20',
						y=> 0.23,
						color=> 'green'
				)
		);**/
		
		if($dbDataArr && $totalNum)
		{
			$count = 0;
			$colorArr = $this->getColorArr();
			$colorNum = count($colorArr);
			$dataArr = array();
			foreach ($dbDataArr as $areaName=>$recNum)
			{
				++$count;
				$tmpDataArr["name"] = $areaName;
				$tmpDataArr["value"] = $recNum;
				$tmpDataArr["y"] = round($recNum/$totalNum,4)*100;
				$tmpDataArr["color"] = $colorArr[$count%$colorNum];
				array_push($dataArr, $tmpDataArr);
			}
			$resData =  json_encode($dataArr);
			return $resData;
		}
		return null;
	}
	
	
}
