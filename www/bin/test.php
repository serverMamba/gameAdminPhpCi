<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$line = "\n";
$redis = new Redis ();
$redis->connect ( '192.168.222.27', 6379 );
// $redis->auth ( '{DE162344-69B1-41C6-8F6D-0085FE821AC7}{8FCFE755-611D-44E2-A11A-9F22EF130804}' );
$redis->select ( 15 );
// for($i = 0; $i <= 1000; $i ++) {
// $push_ary = rand ( 1000, 9999 );
// if ($redis->rPush ( 'test_queue', $push_ary )) {
// echo 'Success';
// } else {
// echo '22';
// }

// }
echo $redis->ping("1");
$redis->close ();
