<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class jsversion_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         $this->load->model('usernew_mid_model');
    }
    
     public function update_adv_msg($data) {

          $url = "http://211.151.33.246:6001/smc?command=80003";
        $post_data = array("UserID"=>$account,"Score"=>$v,"AddType"=>6,"GameCode"=>0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
    }

    public function save_jsversion_msg($gameid, $vnewversion){
           $url = "http://211.151.33.246:6001/smc?command=80143";
        $post_data = array("GameCode"=>$gameid,"Version"=>$vnewversion);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output);
        if($output->ResultCode == 0 ) return true;
        return false;
        
    }
    
    public function get_jsversion_msg() {
        $url = "http://211.151.33.246:6001/smc?command=80142";
        $post_data = array("UserID" => 100, "Score" => 100, "AddType" => 6, "GameCode" => 0);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

}
