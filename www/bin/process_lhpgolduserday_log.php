<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

if (isset ( $argv [1] )) {
	$step = $argv [1];
} else {
	$step = 1;
}

$line = "\n";
$db_default = $db ['default'];
$db_gamehis = $db ['gamehis'];
$dbtablesx = "PinganGameScoreRecord_";

$now = time ();
$datefix = date ( 'Ymd', strtotime ( '-1 day' ) );
$date1 = date ( 'Y-m-d', strtotime ( '-1 day' ) );
$date_db = date ( 'Y-m-d', strtotime ( '-1 day' ) )." 00:00:00";
$db_time_start = $date_db;
$db_time_end = date ( 'Y-m-d', $now)." 00:00:00";

echo "0>>> ".$date_db.",".$db_time_start.",".$db_time_end."\n";
$conn_default = mysql_connect ( $db_default ['hostname'], $db_default ['username'], $db_default ['password'] );
if (! $conn_default) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_default ['database'], $conn_default );

$conn_gamehis = mysql_connect ( $db_gamehis ['hostname'], $db_gamehis ['username'], $db_gamehis ['password'] );
if (! $conn_gamehis) {
	exit ( 'connection lose' . $line );
}
mysql_select_db ( $db_gamehis ['database'], $conn_gamehis );

$sql = "DELETE FROM smc_log_lhpgolduser WHERE is_day=1 and date1 = '$date1'";
echo "1-2>>> ".$sql."\n";
mysql_query ( $sql, $conn_default );

$sql = "SELECT id FROM smc_log_lhpgolduser WHERE is_day=1 and date1 = '$date1' LIMIT 1";
$result = mysql_query ( $sql, $conn_default );
if (mysql_num_rows ( $result ) > 0) {
	exit ( 'log is exist' . $line );
}

$dbtablesx = $dbtablesx.$datefix;
echo "1>>> ".$dbtablesx.",".$db_time_start.",".$db_time_end."\n";
$where = '';

$sql = "SELECT
			x.userid_a AS userid,
			x.cha_gold,
			x.duihuan_gold,
			c.fanzhuan_gold
		FROM
			(
				SELECT
					*
				FROM
					(
						SELECT
							p.userid userid_a,
							sum(p.deltascore) cha_gold
						FROM
							$dbtablesx p
						GROUP BY
							userid
					) a
				LEFT JOIN (
					SELECT
						p.userid userid_b,
						sum(p.deltascore) *- 1 duihuan_gold
					FROM
						$dbtablesx p
					WHERE
						p.deltascore <= 0
					GROUP BY
						userid
				) b ON a.userid_a = b.userid_b
			) x
		LEFT JOIN (
			SELECT
				p.userid userid_c,
				sum(p.deltascore) fanzhuan_gold
			FROM
				$dbtablesx p
			WHERE
				p.deltascore > 0
			GROUP BY
				userid
		) c ON x.userid_a = c.userid_c";
$result = mysql_query ( $sql, $conn_gamehis );
$num = 0;
while ( $rowTabItem = mysql_fetch_array ( $result ) ) {
	$userid = $rowTabItem["userid"];
	$cha_gold = $rowTabItem["cha_gold"]?intval($rowTabItem["cha_gold"]):0;
	$duihuan_gold = $rowTabItem["duihuan_gold"]?intval($rowTabItem["duihuan_gold"]):0;
	$fanzhuan_gold = $rowTabItem["fanzhuan_gold"]?intval($rowTabItem["fanzhuan_gold"]):0;

	$sql = "INSERT INTO smc_log_lhpgolduser (date,userid,duihuan_gold,fanzhuan_gold,cha_gold,date1,is_day)
	VALUE ('$date_db','$userid','$duihuan_gold','$fanzhuan_gold','$cha_gold','$date1','1')";
	$resultInsert = mysql_query ( $sql, $conn_default );
	echo "8 ".++$num.",$resultInsert insert_day_sql>>>".$sql."\n";
}

mysql_close ( $conn_default );
mysql_close ( $conn_gamehis );