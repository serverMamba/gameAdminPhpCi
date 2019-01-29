<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jsversionex extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
   

        
       public function get_jsversion_data(){
            $this->load->model('jsversionex_model');
            $res = $this->jsversionex_model->get_jsversion_msg();
            echo $res;
           
       }
       
        public function save_jsversion_data(){
            $this->load->model('jsversionex_model');

            $action = $this->input->get_post('action');
            $Version = $this->input->get_post('Version');
            $Tag = $this->input->get_post('Tag');
  
            $res = $this->jsversionex_model->save_jsversion_msg($Tag, $Version);
            echo json_encode($res);
           
       }
       
       
       public function update_jsversion_data(){
            $this->load->model('jsversionex_model');

            $action = $this->input->get_post('action');
            $Version = $this->input->get_post('Version');
            $Tag = $this->input->get_post('Tag');
  
            $res = $this->jsversionex_model->update_jsversion_msg($Tag, $Version);
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
               "choose" => array("father"=>"运营管理","child"=>"js平台升级版本管理EX"),
               "header1" => array("father"=>"运营管理","child"=>"js平台升级版本管理EX"),
               "header2" => array("father"=>"js平台升级版本管理EX","child"=>"实时设置js平台升级系统的版本号"),
               "header3" => array("father"=>"js平台升级版本管理EX后台创建于2015年11月02日","child"=>"js平台升级版本管理从2015年11月15日开始 (v1.0) "),
          );
           $this->load->view('no3/jsversionexview',$data);
	}
	

}
