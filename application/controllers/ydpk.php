<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ydpk extends MY_Controller {

    public function __construct() {
        parent::__construct(false);
        $this->load->model('usernew_mid_model');
    }
    
    
    public function get_reporttotal_data() {

        $this->load->model('totalreport16_model');

        $time = $this->input->get_post('time');
        $key = $this->input->get_post('key');
        $gameid = $this->input->get_post('gameid');
        
        $channel = $this->input->get_post('channel');
        
        $saveres = "";
     
        $myfilename = APP_ROOT."/log/$key-$gameid-$time-$channel.log";
        
  
        if (file_exists( $myfilename)) {
            
           $saveres = file_get_contents($myfilename,LOCK_EX);
   
        } else {

        $res = $this->totalreport16_model->get_total_static($time,$key,$gameid,$channel);
        
        $saveres = json_encode($res);

        $timestr = date('Ymd',time());
         if((gt($time)<$timestr)&&(strlen($saveres)>1))
        {
          file_put_contents(APP_ROOT."/log/$key-$gameid-$time.log", $saveres,LOCK_EX);
        }
    
       }

        echo $saveres;

    }
    
      public function get_online_data1() {
        $this->load->model('online_mid_model');
        $gameid = $this->input->get_post('gameid');
        $res = $this->online_mid_model->get_onlinemsgx($gameid);
        echo json_encode($res);
    }
    
         public function get_his_data() {
        $this->load->model('his_mid_model');
        $gameid = $this->input->get_post('gameid');
        $mytime = $this->input->get_post('mytime');
        $res = $this->his_mid_model->get_hismsg($gameid,$mytime);
        echo json_encode($res);
    }
    
      public function get_reportgame_data() {

        $this->load->model('gamereport_model');

        $time = $this->input->get_post('time');
        $key = $this->input->get_post('key');
        $gameid = $this->input->get_post('gameid');
        
        $saveres = "";

        $myfilename = APP_ROOT."/log/$key-$gameid-$time.log";

        if (file_exists( $myfilename)) {
            
           $saveres = file_get_contents($myfilename,LOCK_EX);
   
        } else {

        $res = $this->gamereport_model->get_game_static($time,$key,$gameid);
        
        $saveres = json_encode($res);

        $timestr = date('Ymd',time());
        if((gt($time)<$timestr)&&(strlen($saveres)>1))
        {
          file_put_contents(APP_ROOT."/log/$key-$gameid-$time.log", $saveres,LOCK_EX);
        }
      }

        echo $saveres;

    }

    public function index() {

        $username = $this->input->get_post('username');
        $password = $this->input->get_post('password');
        

        if ((($username == "frodo") && ($password == "success12321")) || (($username == "huangwei") && ($password == "fengqinyang"))) {
       // if  (($username == "huangwei") && ($password == "fengqinyang")) {
            $data = array(
                "systemconfig" => "bb",
            );
            $this->load->view('ydpkview', $data);
        } else {
            echo "error";
        }
    }

}
