<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logreport extends MY_Controller {

    public function __construct() {
        parent::__construct(false);
    }
    
  
    public function index() {
       // if($_REQUEST["debugname"] == "xianglei"){
        $_REQUEST["time"] =  $timestr = date('Y-m-d h:m:s', time());
        file_put_contents(APP_ROOT."/log/xianglei.txt", json_encode($_REQUEST)."\n", FILE_APPEND);
       // }
		
		//if($_REQUEST["debugname"] == "hualiang"){
       // $_REQUEST["time"] =  $timestr = date('Y-m-d h:s:m', time());
       // file_put_contents(APP_ROOT."/log/hualiang.txt", json_encode($_REQUEST)."\n", FILE_APPEND);
       // }
         echo "ok";
    }


}
