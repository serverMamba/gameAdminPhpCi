<?php
test('120.76.227.99',9102);
test('120.76.224.14',9102);
test('47.75.137.218',9102);
test('www.google.com',80);
test('www.google.com',8080);

function test($ip,$port){
	$res = false;
	$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	socket_set_nonblock($sock);
	socket_connect($sock,$ip, $port);
	socket_set_block($sock);
	$ret = @socket_select($r = array($sock), $w = array($sock), $f = array($sock), 5);
	socket_close ( $sock );
	$res = $ret==1;
	if($res){
		echo "$ip,$port,open\n";
	}else{
		echo "$ip,$port,err:$ret\n";
	}
	echo "res=$res,$ip,$port\n";
	return $res;
}
