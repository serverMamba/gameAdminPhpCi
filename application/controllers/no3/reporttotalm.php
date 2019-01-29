<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reporttotalm extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
        
        
   public function get_reporttotalm_data() {

        $this->load->model('totalreportm_model');

        $time = $this->input->get_post('time');
        $key = $this->input->get_post('key');
        $gameid = $this->input->get_post('gameid');
        
        $channel = $this->input->get_post('channel');
        
        $starttime = $this->input->get_post('starttime');
         
        $endtime = $this->input->get_post('endtime');
        
        $saveres = "";
        
        $myfilename = "/var/www/html/smc/log/$key-$gameid-$time-$channel.log";
        
  /*
        if (file_exists( $myfilename)) {
            
           $saveres = file_get_contents($myfilename,LOCK_EX);
   
        } else {
*/
        $res = $this->totalreportm_model->get_totalm_static($time,$key,$gameid,$channel,$starttime,$endtime);
        
        $saveres = json_encode($res);
/*
        $timestr = date('Ymd',time());
         if((gt($time)<$timestr)&&(strlen($saveres)>1))
        {
          file_put_contents("/var/www/html/smc/log/$key-$gameid-$time.log", $saveres,LOCK_EX);
        }
    
       }
*/
        echo $saveres;

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
           
           
           $gamecodehuang = $this->config->item('gamecode');
           $channellisthuang = $this->config->item('channellist');
        
          //  if(($usernamezz  == "huangwei") || ( $usernamezz  == "qihualiang"))
          // {
           // $gamecodehuang = array_merge_recursive($this->config->item('gamecodehuang'),$this->config->item('gamecode'));
           // $channellisthuang = array_merge_recursive($this->config->item('channellisthuang'),$this->config->item('channellist'));
          // }
           
           $data =array(
               "systemconfig" => $this->configs->get_navmenu(),
               "menucheck" => $menucheck,
               "message" =>array("username"=> $usernamezz,"mail"=>"aaa"),
               "gamelist" => $gamecodehuang,
               "channellist" => $channellisthuang,
               "choose" => array("father"=>"运营报表","child"=>"运营数据总表(月)"),
               "header1" => array("father"=>"运营报表","child"=>"运营数据总表(月)"),
               "header2" => array("father"=>"运营数据总表(月)","child"=>"运营数据明细(月，创建于2014年7月28日) "),
               "header3" => array("father"=>"运营数据总表后台创建于2014年6月13日","child"=>" 游戏运营从2014年6月25日开始 (v1.0) "),
          );
           $this->load->view('no3/reporttotalmview',$data);
	}
	

}
