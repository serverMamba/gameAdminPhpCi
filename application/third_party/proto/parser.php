<?php
// EXECUTE test_new.php first 

require_once('../parser/pb_parser.php');

$test = new PBParser();
// 注意，每次只能解析一个文件

// $test->parse('packet.proto');
// $test->parse('clientgameserver.proto');
// $test->parse('SMCmiddlelayerserver.proto');
// $test->parse('other.proto');
// $test->parse('login.proto');

$test->parse('pbclientgameserver.proto');
echo 'succ';

?>
