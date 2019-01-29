<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castadv extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
       public function  save_config_data(){
           $this->load->model('castadv_model');
           $action = $this->input->get_post('action');
           $data = $this->input->get_post('data');
           $res = $this->castadv_model->update_adv_msg($data);
           echo "配置成功！";
        }
        
       public function get_castadv_data(){
            $this->load->model('castadv_model');
            $action = $this->input->get_post('action');
            $mainversionid = 0;//$this->input->get_post('mainversionid');
            $subversionid = $this->input->get_post('subversionid');
            $systemid = $this->input->get_post('systemid');
            $gameid = $this->input->get_post('gameid');
            $beginindex = $this->input->get_post('beginindex');
            $res = $this->castadv_model->get_adv_msg($action,$mainversionid,$subversionid,$systemid,$gameid,$beginindex);
            echo json_encode($res);
           
       }
       
        public function save_castadv_data(){
            $this->load->model('castadv_model');

            $action = $this->input->get_post('action');
            $status = $this->input->get_post('status');
            $version = $this->input->get_post('version');
            $systemid = $this->input->get_post('systemid');
            $gameid = $this->input->get_post('gameid');
  
            $res = $this->castadv_model->save_adv_msg($status, $version,$systemid,$gameid);
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
               "choose" => array("father"=>"运营管理","child"=>"广告墙开关"),
               "header1" => array("father"=>"运营管理","child"=>"广告墙开关"),
               "header2" => array("father"=>"广告墙开关","child"=>"在线人数实时统计 "),
               "header3" => array("father"=>"广告墙开关后台创建于2014年7月31日","child"=>" 广告墙开关从2014年8月1日开始 (v1.0) "),
          );
           $this->load->view('no3/castadvview',$data);
	}
	

}
