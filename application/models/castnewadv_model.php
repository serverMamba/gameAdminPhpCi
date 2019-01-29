<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class castnewadv_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
    }
    
     public function update_adv_msg($DeviceType,$GameCode,$Version,$Status) {
        $url = "http://211.151.33.246:6001/smc?command=80147";
        $post_data = array("DeviceType"=>$DeviceType,"GameCode"=>$GameCode,"Version"=>$Version,"Status" =>$Status);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output1 = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output1);
        if($output->ResultCode == 0 ) return true;
        return false;
     }

    public function save_adv_msg($DeviceType,$GameCode,$Version,$Status){
        $url = "http://211.151.33.246:6001/smc?command=80146";
        $post_data = array("DeviceType"=>$DeviceType,"GameCode"=>$GameCode,"Version"=>$Version,"Status" =>$Status);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output1 = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output1);
        if($output->ResultCode == 0 ) return true;
        return false;
      }
    
    public function get_adv_msg($DeviceType,$GameCode,$Version){
        $url = "http://211.151.33.246:6001/smc?command=80145";
        $post_data = array("DeviceType"=>$DeviceType,"GameCode"=>$GameCode,"Version"=>$Version);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output1 = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($output1);
        return  $output;
     }


}
