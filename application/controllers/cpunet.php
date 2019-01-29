<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cpunet extends MY_Controller {
	function __construct() {
		parent::__construct(true, false);	//不判断登录
	}
	
    function index() {


        //  $syscontact = snmpget("127.0.0.1", "public", "system.SysContact.0");

		 // print_r($syscontact)



		$str = shell_exec('more /proc/stat'); 
       $pattern = "/(cpu[0-9]?)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)[\s]+([0-9]+)/"; 
      preg_match_all($pattern, $str, $out); 
       echo "共有".count($out[1])."个CPU，每个CPU利用率如下：<br>"; 
      for($n=0;$n<count($out[1]);$n++) 
     { 
       echo $out[1][$n]."=".(100*($out[1][$n]+$out[2][$n]+$out[3][$n])/($out[4][$n]+$out[5][$n]+$out[6][$n]+$out[7][$n]))."%<br>"; 
    } 
 
     $str = shell_exec('more /proc/meminfo'); 
     $pattern = "/(.+):\s*([0-9]+)/"; 
     preg_match_all($pattern, $str, $out); 
     echo "物理内存总量：".$out[2][0]."<br>"; 
     echo "已使用的内存：".$out[2][1]."<br>"; 
     echo "-----------------------------------------<br>"; 
     echo "内存使用率：".(100*($out[2][0]-$out[2][1])/$out[2][0])."%<br>"; 


    $str = shell_exec('more /proc/net/dev');
     $pattern = "/(eth[0-9]+):\s*([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)\s+([0-9]+)/";
     preg_match_all($pattern, $str, $out); 
     echo "共有".count($out[1])."个网络接口，每个网络接口利用率如下：<br>"; 
     for($n=0;$n<count($out[1]);$n++) 
     { 
        echo $out[1][$n]."：收到 ".$out[3][$n]." 个数据包，发送 ".$out[11][$n]." 个数据包<br>"; 
       } 
    }
}
