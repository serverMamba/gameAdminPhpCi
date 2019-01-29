<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jsversion extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    header("location:/no3/login.html");
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
   

        
       public function get_jsversion_data(){
            $this->load->model('jsversion_model');
            $res = $this->jsversion_model->get_jsversion_msg();
            echo $res;
           
       }
       
        public function save_jsversion_data(){
            $this->load->model('jsversion_model');

            $action = $this->input->get_post('action');
            $gameid = $this->input->get_post('gameid');
            $vnewversion = $this->input->get_post('newversion');
  
            $res = $this->jsversion_model->save_jsversion_msg($gameid, $vnewversion);
            echo json_encode($res);
           
       }
	
	public function index() {
  

         $menucheck = array();
        $myfilename = DYCONFIG."private_data.log";
        if (file_exists($myfilename)) {
            $saveres = file_get_contents($myfilename, LOCK_EX);
             $rxry = json_decode($saveres);
             foreach ($rxry as $rx => $ry){
                  foreach ($ry as $key => $val){
                      $menucheck[$rx][$key] = $rxry->$rx->$key;
                   }
             }
        }

            
           $usernamezz = $_COOKIE['SMC_NO3_YG'];
           $data =array(
               "systemconfig" => $this->configs->get_navmenu(),
               "menucheck" => $menucheck,
               "message" =>array("username"=> $usernamezz,"mail"=>"aaa"),
               "choose" => array("father"=>"运营管理","child"=>"js平台升级版本管理"),
               "header1" => array("father"=>"运营管理","child"=>"js平台升级版本管理"),
               "header2" => array("father"=>"js平台升级版本管理","child"=>"实时设置js平台升级系统的版本号"),
               "header3" => array("father"=>"js平台升级版本管理后台创建于2014年7月31日","child"=>"js平台升级版本管理从2014年8月1日开始 (v1.0) "),
          );
           $this->load->view('no3/jsversionview',$data);
	}
	

}
