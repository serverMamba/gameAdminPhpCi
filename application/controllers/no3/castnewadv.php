<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castnewadv extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
       public function  update_castadv_data(){
           $this->load->model('castnewadv_model');
           $DeviceType = $this->input->get_post('DeviceType');
           $GameCode = $this->input->get_post('GameCode');
           $Version = $this->input->get_post('Version');
           $Status = $this->input->get_post('Status');
           $res = $this->castnewadv_model->update_adv_msg($DeviceType,$GameCode,$Version,$Status);
           echo "配置成功！";
        }
        
       public function get_castadv_data(){
            $this->load->model('castnewadv_model');
            $DeviceType = $this->input->get_post('DeviceType');
            $GameCode = $this->input->get_post('GameCode');
            $Version = $this->input->get_post('Version');
            $res = $this->castnewadv_model->get_adv_msg($DeviceType,$GameCode,$Version);
            echo json_encode($res);
       }
       
        public function save_castadv_data(){
            $this->load->model('castnewadv_model');
            
            $DeviceType = $this->input->get_post('DeviceType');
            $GameCode = $this->input->get_post('GameCode');
            $Version = $this->input->get_post('Version');
            $Status = $this->input->get_post('Status');
  
            $res = $this->castnewadv_model->save_adv_msg($DeviceType,$GameCode,$Version,$Status);
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
               "choose" => array("father"=>"运营管理","child"=>"新广告墙开关"),
               "header1" => array("father"=>"运营管理","child"=>"新广告墙开关"),
               "header2" => array("father"=>"新广告墙开关","child"=>"新广告墙实时服务器管理 "),
               "header3" => array("father"=>"新广告墙开关后台创建于2014年7月31日","child"=>" 广告墙开关从2015年9月1日开始 (v1.0) "),
          );
           $this->load->view('no3/castnewadvview',$data);
	}

}
