<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castkami extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                	redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
        
   public function generatedo(){
         $this->load->model('castkami_model');
         $action = $this->input->get_post('action');
         $price = $this->input->get_post('price');
         $exp = $this->input->get_post('exp');
         $count = $this->input->get_post('count');
         $res = $this->castkami_model->generatedo($action,$price,$exp,$count);
         echo  $res;
   }     
        


    public function  exportData(){
         $this->load->model('castshoporder_model');
          $action = $this->input->get_post('action');
            $goodtype = $this->input->get_post('goodtype');
            $myendtime = $this->input->get_post('myendtime');
            $mystarttime = $this->input->get_post('mystarttime');
            $status = $this->input->get_post('status');
            $userid = $this->input->get_post('userid');
            $beginindex = $this->input->get_post('beginindex');
         $res = $this->castshoporder_model->exportData($action,$goodtype,$myendtime,$mystarttime,$status,$userid,$beginindex);
       }
       
       
        public function  save_config_data(){
           $this->load->model('castshoporder_model');
           $action = $this->input->get_post('action');
           $data1 = $this->input->get_post('data1');
           $data2 = $this->input->get_post('data2');
           $res = $this->castshoporder_model->save_config_data($data1,$data2);
           echo "配置已经生成！";
        }
        
       public function get_kami_data(){
            $this->load->model('castkami_model');
            $action = $this->input->get_post('action');
            $goodtype = $this->input->get_post('goodtype');
            $myendtime = $this->input->get_post('myendtime');
            $mystarttime = $this->input->get_post('mystarttime');
            $status = $this->input->get_post('status');
            $userid = $this->input->get_post('userid');
            $beginindex = $this->input->get_post('beginindex');
            $res = $this->castkami_model->get_kami_msg($action,$goodtype,$myendtime,$mystarttime,$status,$userid,$beginindex);
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
               "choose" => array("father"=>"运营管理","child"=>"卡密管理系统"),
               "header1" => array("father"=>"运营管理","child"=>"卡密管理系统"),
               "header2" => array("father"=>"卡密管理系统","child"=>"管理卡密的生成，请求等。 "),
               "header3" => array("father"=>"卡密管理系统后台创建于2014年9月9日","child"=>"实物订单管理从2014年9月15日开始 (v1.0) "),
          );
           $this->load->view('no3/castkamiview',$data);
	}
	

}
