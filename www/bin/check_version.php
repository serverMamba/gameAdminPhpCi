<?php
set_time_limit ( 0 );
$system_path = '../../system';
define ( 'EXT', '.php' );
define ( 'BASEPATH', str_replace ( "\\", "/", $system_path ) );
require_once dirname ( __FILE__ ) . '/../../application/config/constants.php';
require_once dirname ( __FILE__ ) . '/../../application/config/config.php';
require_once dirname ( __FILE__ ) . '/../../application/config/database.php';

$taglist = $config['taglist'];
foreach ($taglist as $k=>$v){
	$url = 'http://webapi1.yuming.com/api/versionStatus?tag='.$k.'&v=1003';
	
	$ch = curl_init ();
	// print_r($ch);
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_HEADER, 0 );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
	$return = curl_exec ( $ch );
	curl_close ( $ch );
	if($return != 'ok'){
		echo $v.'-----'.$k.'---'.$return."\n";
	}
}
