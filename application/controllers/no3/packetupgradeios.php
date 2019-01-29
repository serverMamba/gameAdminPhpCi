<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Packetupgradeios extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
   
       public function get_proxy_data(){
            $this->load->model('packetupgradeios_model');
            $res = $this->packetupgradeios_model->get_proxy_msg();
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
       
       
       public function update_proxy_data(){
            $this->load->model('packetupgradeios_model');
            $packagename  = $this->input->get_post('packagename');
            $version  = $this->input->get_post('version');

            $overversion = $this->input->get_post('overversion');
            $url = $this->input->get_post('url');
 
            $res = $this->packetupgradeios_model->update_proxy_msg($packagename ,$version,$overversion,$url);
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
               "choose" => array("father"=>"运营管理","child"=>"IOS升级服务器管理"),
               "header1" => array("father"=>"运营管理","child"=>"IOS升级服务器管理"),
               "header2" => array("father"=>"IOS升级服务器管理","child"=>"IOS升级服务器管理"),
               "header3" => array("father"=>"IOS升级服务器管理后台创建于2016年4月21日","child"=>"IOS升级服务器管理服务器切换从2016年4月21日开始 (v1.0) "),
          );
           $this->load->view('no3/packetupgradeiosview',$data);
	}
	

}
