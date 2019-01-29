<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$step = 1;
if (isset ( $argv [1] )) {
	$step = $argv [1];
} else {
	$step = 1;
}

$channellist = $config ['channellist'];
$pay_statics_platforms = $config ['pay_statics_platforms'];
$pay_statics_timedelay = $config ['pay_statics_timedelay'];
$line = "\n";
$db_default = $db ['default'];
$db_stat = $db ['gamebuyee'];
$table_from = 'smc_order';
$table_to = 'CASINOPAYTOTALSTATISTICS';

$date_yestaday = date ( 'Y-m-d', time () - 3600 * 24 * $step );
$date_today = date ( 'Y-m-d', time () - 3600 * 24 * ($step-1) );
echo ">>>".$date_yestaday."~".$date_today."\n";

$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn_default) {
	exit ( 'connection default lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn_default );

$conn_stat = mysql_connect ( $db_stat ['hostname'], $db_stat ['username'], $db_stat ['password'] );
if (! $conn_stat) {
	exit ( 'connection stat lose' . $line );
}
mysql_select_db ( $db_stat ['database'], $conn_stat );

$db_time_start = strtotime ( $date_yestaday . ' 00:00:00' );
$db_time_end = strtotime ( $date_today . ' 00:00:00' );

$sql = "DELETE FROM $table_to WHERE statistics_date = '$date_yestaday'";
echo "[".date ( 'Y-m-d H:i:s', time ())."] ".$sql."\n";
mysql_query ( $sql, $conn_stat );

$sql = "SELECT GROUP_CONCAT(DISTINCT channel_id) channels,GROUP_CONCAT(DISTINCT  pay_platform) platforms from $table_from where (add_time>=".strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step+1) ) )." and add_time<=".strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step-1) ) ).") or (pay_success_time>=".strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step+1) ) )." and pay_success_time<=".strtotime ( date ( 'Y-m-d', time () - 3600 * 24 * ($step-1) ) ).")";
echo "[".date ( 'Y-m-d H:i:s', time ())."] ".$sql."\n";
$result = mysql_query ( $sql, $conn_default );
if (mysql_num_rows ( $result ) <= 0) {
	exit ( 'order is empty' . $line );
}
$db_channels = array();
$db_platforms =  array();
if (mysql_num_rows ( $result ) > 0) {
	if(mysql_result ( $result, 0, 'channels' )){
		$db_channels = split (",", mysql_result ( $result, 0, 'channels' ));
	}
	if(mysql_result ( $result, 0, 'platforms' )){
		$db_platforms = split (",", mysql_result ( $result, 0, 'platforms' ));
	}
}
//补全$db_channels
foreach($channellist as $k => $v){
	if(!in_array($k, $db_channels))
	{
		array_push($db_channels, $k);
	}
}
foreach ( $db_channels as $tmp_channel ) {
	foreach ( $db_platforms as $tmp_platform ) {
		$time_field = isset($pay_statics_platforms[intval($tmp_platform)])?$pay_statics_platforms[intval($tmp_platform)]:'pay_success_time';//默认到帐时间
		$timedelay = (isset($pay_statics_timedelay[intval($tmp_platform)]))?$pay_statics_timedelay[intval($tmp_platform)]:0;
		$db_time_start_tmp = $db_time_start+$timedelay;
		$db_time_end_tmp = $db_time_end+$timedelay;
		$sql = "SELECT SUM(money) AS total_money,count(distinct(user_id)) AS pay_user_count,count(id) AS pay_total_num FROM $table_from WHERE status=1  and pay_platform=$tmp_platform and channel_id=$tmp_channel and $time_field>=$db_time_start_tmp and $time_field<$db_time_end_tmp";
		$result = mysql_query ( $sql, $conn_default );
		//echo "[".date ( 'Y-m-d H:i:s', time ())."] ".$sql."\n";
		$total_money = 0;
		$pay_user_count = 0;
		$pay_total_num = 0;
		if (mysql_num_rows ( $result ) > 0) {
			$total_money = mysql_result ( $result, 0, 'total_money' )?intval(mysql_result ( $result, 0, 'total_money' )):0;
			$pay_user_count = mysql_result ( $result, 0, 'pay_user_count' )?intval(mysql_result ( $result, 0, 'pay_user_count' )):0;
			$pay_total_num = mysql_result ( $result, 0, 'pay_total_num' )?intval(mysql_result ( $result, 0, 'pay_total_num' )):0;
		}
		//echo "[".date ( 'Y-m-d H:i:s', time ())."] statistics_date=$date_yestaday,platform=$tmp_platform,channel=$tmp_channel,total_money=$total_money,pay_user_count=$pay_user_count,pay_total_num=$pay_total_num"."\n";
		$sql = "insert into $table_to (`statistics_date`,`channelid`,`pay_platform`,`pay_user_count`,`pay_total_money`,`pay_total_num`,`stat_standard`) values ('$date_yestaday',$tmp_channel,$tmp_platform,$pay_user_count,$total_money,$pay_total_num,'$time_field')";
		//echo "[".date ( 'Y-m-d H:i:s', time ())."] ".$sql."\n";
		mysql_query ( $sql, $conn_stat );
	}
}

mysql_close ( $conn_default );
mysql_close ( $conn_stat );
