<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wanshun5 extends MY_Controller {

    public function __construct() {
        parent::__construct(false, false);
        if(empty($_COOKIE['SMC_NO3_YG'])){
            redirect(site_url('no3/login'));
        }
        $this->load->model('no3/configs_model', 'configs');
        $this->load->helper('other');
    }

    public function get_exchange_data() {
        $this->load->model('wanshun5_model');
        $action = $this->input->get_post('action');
        $mydate = $this->input->get_post('mydate');
        $res = $this->wanshun5_model->get_exchange_his($mydate);
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
        
                   $usernamezz = $_COOKIE['SMC_NO3_YG'];
            if(($usernamezz !="huanwei")&&($usernamezz !="huangwei")&&($usernamezz !="wangshun")){
               redirect(site_url('no3/login'));
                return;
            }
        $data = array(
            "systemconfig" => $this->configs->get_navmenu(),
            "menucheck" => $menucheck,
            "message" => array("username" => $usernamezz, "mail" => "aaa"),
            "gamelist" => $this->config->item('gamecode'),
            "choose" => array("father" => "运营报表", "child" => "充值贡献度排名"),
            "header1" => array("father" => "运营报表", "child" => "充值贡献度排名"),
            "header2" => array("father" => "充值贡献度排名", "child" => "充值贡献度排名历史统计 "),
            "header3" => array("father" => "充值贡献度排名创建于2015年11月13日", "child" => " 游戏运营从2014年6月25日开始 (v1.0) "),
        );
        $this->load->view('no3/wanshun5_view', $data);
    }

}
