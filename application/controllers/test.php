<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Test extends CI_Controller {
	public function __construct() {
		parent::__construct ();
	}
	public function index() {
		$tmp = 8349740;
		
		$dbx = ($tmp & 0xF0) >> 4;
        
        $server = "eus".$dbx;

        $posx = $tmp & 0x0F ;  
        
        echo $dbx.'-'.$posx;
	}
	
	public function test01(){
		$r1 = "0";
		$flag1 = !$r1;
		$r2 = array();
		$flag2 = empty($r2);
		$flag3 = !($r2);
		$r3 = "[ ]";
		$r4 = json_decode($r3);
		$flag4 = empty($r4);
		$r5 = json_encode($r2);
		$flag5 = ($r5=="[]");
		exit("$flag1:".$flag2.",$flag3:".$flag4.$r5.":".$flag5);
	}
	private function pingAddress($address) {
		$status = -1;
		$pingresult = exec("ping -c 1 {$address}", $outcome, $status);
		if (0 == $status) {
			return true;
		}
		return false;
	}
	private function writeLog($txt) {
		// echo $txt . "<br/>";
		$log_file = "/log/ccc.log";
		$handle = fopen ( $log_file, "a+" );
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
}
