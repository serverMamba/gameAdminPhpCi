<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phonecheck extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
        public function  modify_operation($Account,$Password,$MobileNumber,$IsVerified)
        {
        $url = "http://211.151.33.246:6001/smc?command=20254";
        $post_data = array("Account"=>$Account,"Password"=>$Password,"MobileNumber"=>$MobileNumber,"IsVerified"=>$IsVerified);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        return  $output->ResultCode;
    }  
        
    public function  getphone_operation($Account){
        $url = "http://211.151.33.246:6001/smc?command=80144";
        $post_data = array("Account"=>$Account);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        //return  $output;
        return $output->BoundMobileNumber;
    }   
        
        
    public function  check_operation($userid,$password,$phonenumbei,$status){
        $url = "http://211.151.33.246:6001/smc?command=20255";
        $post_data = array("UserID"=>$userid,"Password"=>$password,"MobileNumber"=>$phonenumbei,IsVerified=>$status);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
    
    public function  ucheck_operation($userid,$password,$phonenumbei,$status){
        $url = "http://211.151.33.246:6001/smc?command=20256";
        $post_data = array("UserID"=>$userid,"Password"=>$password,"MobileNumber"=>$phonenumbei,IsVerified=>$status);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        if($output->ResultCode == 0 ) return true;
        return false;
    }
    
    
     public function toremotecheckphone($phone, $code) {
        $api = 'https://api.sms.mob.com/sms/verify';
        $params = array(
            'appkey' => '992d33c6d878',
            'phone' => $phone,
            'zone' => '86',
            'code' => $code,
                );
        $timeout = 30;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Accept: application/json',
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        $ret = json_decode($response);
        return $ret->status;
    }
    
    public function toremotecheckphonenew($phone, $code) {
        $api = 'https://web.sms.mob.com/sms/verify';
        $params = array(
            'appkey' => '992d33c6d878',
            'phone' => $phone,
            'zone' => '86',
            'code' => $code,
                );
        $timeout = 30;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded;charset=UTF-8',
            'Accept: application/json',
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        $ret = json_decode($response);
        return $ret->status;
    }
    
    public function  check(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $userid = $PostData->userid;
        $password = $PostData->password;
        $phonenumbei = $PostData->phonenumbei;
        $code = $PostData->code;
        if($this->toremotecheckphone($phonenumbei, $code)  == 200){
             $this->check_operation($userid,$password,$phonenumbei,1);
        }else{
            $this->check_operation($userid,$password,$phonenumbei,0);
        }
         echo "成功";
    }
    
        public function  checknew(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $userid = $PostData->userid;
        $password = $PostData->password;
        $phonenumbei = $PostData->phonenumbei;
        $code = $PostData->code;
        if($this->toremotecheckphonenew($phonenumbei, $code)  == 200){
             $this->check_operation($userid,$password,$phonenumbei,1);
        }else{
            $this->check_operation($userid,$password,$phonenumbei,0);
        }
         echo "成功";
    }
    
    
     public function  ucheck(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $userid = $PostData->userid;
        $password = $PostData->password;
        $phonenumbei = $PostData->phonenumbei;
        $code = $PostData->code;
        if($this->toremotecheckphone($phonenumbei, $code)  == 200){
             $this->ucheck_operation($userid,$password,$phonenumbei,1);
        }else{
            $this->ucheck_operation($userid,$password,$phonenumbei,0);
        }
         echo "成功";
    }
    
    public function  uchecknew(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $userid = $PostData->userid;
        $password = $PostData->password;
        $phonenumbei = $PostData->phonenumbei;
        $code = $PostData->code;
        if($this->toremotecheckphonenew($phonenumbei, $code)  == 200){
             $this->ucheck_operation($userid,$password,$phonenumbei,1);
        }else{
            $this->ucheck_operation($userid,$password,$phonenumbei,0);
        }
         echo "成功";
    }
    
    
    public function  getphone(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $account = $PostData->account;
        echo $this->getphone_operation($account);
    }
    
    
     public function  getphone_operationYM($Account){
     	return '13661930521';
        $url = "http://211.151.33.254:6001/smc?command=80144";
        $post_data = array("Account"=>$Account);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        //return  $output;
        return $output->BoundMobileNumber;
    } 
    
    public function  getphoneYM(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $account = $PostData->account;
        echo $this->getphone_operationYM($account);
    }
    
    
    
    public function  getVerificationCodeYM(){
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $Account = $PostData->Account;
        $MobileNumber  = $PostData->MobileNumber;
        $url = "http://211.151.33.254:6001/smc?command=20289";
        $post_data = array("Account"=>$Account,"MobileNumber"=>$MobileNumber);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($outputx);
        return $output->BoundMobileNumber;
     }
    
      public function modifypassword() {
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $Account = $PostData->Account;
        $Password = $PostData->Password;
        $MobileNumber = $PostData->MobileNumber;
        $IsVerified = $PostData->IsVerified;
        
         if($this->toremotecheckphone($MobileNumber, $IsVerified)  == 200){
              $rr = $this->modify_operation($Account, $Password, $MobileNumber, 1);
              echo $rr;
        }else{
             $rr = $this->modify_operation($Account, $Password, $MobileNumber, 0);
            // echo "100";
             echo $rr;
        }
        // echo $rr;
    }
    
    public function modifypasswordnew() {
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $Account = $PostData->Account;
        $Password = $PostData->Password;
        $MobileNumber = $PostData->MobileNumber;
        $IsVerified = $PostData->IsVerified;
        
         if($this->toremotecheckphonenew($MobileNumber, $IsVerified)  == 200){
              $rr = $this->modify_operation($Account, $Password, $MobileNumber, 1);
              echo $rr;
        }else{
             $rr = $this->modify_operation($Account, $Password, $MobileNumber, 0);
            // echo "100";
             echo $rr;
        }
        // echo $rr;
    }
    
    
     public function modifypasswordnewYM() {
        $PostDatax = file_get_contents("php://input");
        $PostData = json_decode($PostDatax);
        $Account = $PostData->Account;
        $Password = $PostData->Password;
        $MobileNumber = $PostData->MobileNumber;
        $VerificationCode = $PostData->VerificationCode;
        $url = "http://211.151.33.254:6001/smc?command=20290";
        $post_data = array("Account"=>$Account,"Password" => $Password ,"VerificationCode"=>$VerificationCode);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $outputx = curl_exec($ch);
        curl_close($ch);
       // echo  $outputx;
        $output = json_decode($outputx);
        echo $output->ResultCode;
    }

    public function test(){
        $phonenumbei = "13995588949";
        $code  = "5452";
        $userid = "890007";
        $password = "zshshy";
        
        if($this->toremotecheckphone($phonenumbei, $code)  == 200){
             $this->check_operation($userid,$password,$phonenumbei,1);
        }else{
            $this->check_operation($userid,$password,$phonenumbei,0);
        }
         echo "success";
        
      // $ret = $this->toremotecheckphone($phone, $code);
       print_r($ret);
    }
    
    
    

    public function   score_operation_test(){
         header("Content-type: text/html; charset=utf-8");
         $account = "890007";
         $v = 100000;
         $output=$this->score_operation($account,$v);
         print_r($output);
   }

}
