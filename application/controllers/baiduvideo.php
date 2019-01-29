<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baiduvideo extends MY_Controller {
    function __construct() {
        parent::__construct(true, false); //不判断登录
       // $this->load->library('pay/payment_api_lib');
      //  $this->load->model('order_model');
    }
    
    public static function sign ($data,$partnerKey)
    {   
        /*
        if(!$partnerKey)
            return false;
        //对待签名参数数组排序
        $data = self::argSort($data);
        $data['key']=$partnerKey;
        $sign_str=http_build_query($data);
        $sign_str=urldecode($sign_str);
        $sign=md5($sign_str);
        return $sign;
         * 
         */
    } 


public static function RSAverifyNew($arrData,$strSign,$strPublicKeyFile){
    
    /*
        if(empty($strPublicKeyFile)){
            return false;
        }
        $data = self::argSort($arrData);
        $data=http_build_query($data);
        $strData=urldecode($data);
        $strPubKey = file_get_contents($strPublicKeyFile);
        // 转换为openssl格式密钥
        $objRes = openssl_get_publickey($strPubKey);
        // 调用openssl内置方法验签，返回bool值
        $result = (bool) openssl_verify($strData, base64_decode($strSign), $objRes);
        // 释放资源
        openssl_free_key($objRes);
        return $result;
     * 
     */
    }

    public static function RSASignNew($strData,$strPrivateKeyFile){
        /*
        $strSign = '';
        if(empty($strPrivateKeyFile)){
            return $strSign;
        }
        $data = self::argSort($strData);
        $data=http_build_query($data);
        $strData=urldecode($data);
        $strPrivateKey = file_get_contents($strPrivateKeyFile);
        // 转换为openssl密钥，必须是没有经过pkcs8转换的私钥
        $getRes = openssl_get_privatekey($strPrivateKey);
        // 调用openssl内置签名方法，生成签名$sign
        openssl_sign($strData, $strSign, $getRes);
        // 释放资源
        openssl_free_key($getRes);
        // base64编码
        $strSign = base64_encode($strSign);
        return $strSign;
         * 
         */
    }



  public static function argSort($para) {
      /*
        ksort($para);
        reset($para);
        return $para;
       * 
       */
    }
    
    
    public function test(){
        /*
        $params["orderId"] = "*e713ea52782defc";
        
        $params["userUid"] = "test_test12345";
        
        $params["payMoney"] = "5";
        
        $params["goods_id"] = "0";
        
        $params["goods_num"] = "1";
        
        $params["payTime"] = "1468934704";
        
        $params["sign"] = "YhBANW6reAY3YbJ6FrninK8eDaeTVwFHLydSvhOZt1MDoHLXtaWqA4hH32sDw2NCfhdVT2vZNQmhaoI9OLcPVia0LMswRM4gRtG15qivFZExIuJW27mHwajq+Y3G8LZrOilAf7J+YZtgdwOU5mhsFnmP6KNPehsbAhgV03c4UbA=";
       
        unset($params["sign"]); 
        
        $strData =  $params;
        $strPrivateKeyFile = "/var/www/html/pokerjoin.com/application/controllers/payment/rsa_public_key.pem";
        
        $sign = "YhBANW6reAY3YbJ6FrninK8eDaeTVwFHLydSvhOZt1MDoHLXtaWqA4hH32sDw2NCfhdVT2vZNQmhaoI9OLcPVia0LMswRM4gRtG15qivFZExIuJW27mHwajq+Y3G8LZrOilAf7J+YZtgdwOU5mhsFnmP6KNPehsbAhgV03c4UbA=";
        
        $checkok = self::RSAverifyNew($strData, $sign,$strPrivateKeyFile);
        
         $ret = array();
 
         if($checkok == false){
            log_message('error', "Baiduvideo | chech error:" .$sign);
             $ret["code"] = "fail";
             echo json_encode($ret);
             return;
        }
        
         $ret["code"] = "success";
         echo json_encode($ret);
         * 
         */
         
         return;
        
    }
    
    public function check() {
        /*
       log_message('error', "Baiduvideo | callback params:" . json_encode($_REQUEST));
       $ret = array();
               
        $orderId = $this->input->get_post('orderId');
         * 
         */

/*
        $strData = $_REQUEST;
        $strPrivateKeyFile = "/var/www/html/pokerjoin.com/application/controllers/payment/rsa_public_key.pem";
        
        $sign = $this->input->get_post('sign');
        
        unset($strData["sign"]); 
        $strdata1 = $strData;
        $checkok = self::RSAverifyNew($strdata1, $sign,$strPrivateKeyFile);
 
         if($checkok == false){
            log_message('error', "Baiduvideo | check check error:" .$sign);
             $ret["code"] = "fail";
             echo json_encode($ret);
             return;
        }
  */

        /*
        $res = $this->order_model->getorder($orderId);

        log_message('error', "Baiduvideo | callback res:" . json_encode($res));

        if ($res) {
            $userid = $res[0]["userid"];
            $gameid = $res[0]["gameid"];
            $gamecode = $res[0]["gamecode"];
            $paytype = $res[0]["paytype"];
            $producttype = $res[0]["producttype"];
            $productid = $res[0]["productid"];
            $money = $res[0]["money"];
            $channel = $res[0]["channel"];

            $callbackstatus = $res[0]["callbackstatus"];

            $ret["error"] = array();
            $ret["error"]["errno"] = 0;
            $ret["error"]["errmsg"] = "";
            $ret["error"]["usermsg"] = "";

            $ret["data"] = array();
            $ret["data"]["itemId"] = 0;
            $ret["data"]["productId"] = $producttype . $productid;
            $ret["data"]["name"] = 0;
            $ret["data"]["desc"] = "";
            $ret["data"]["price"] = $money * 100;
        }

        log_message('error', "Baiduvideo | return:" . json_encode($ret));
         */
        echo json_encode($ret);
    }

    public function callback()
    {
        /*
        log_message('error', "Baiduvideo | callback params:" . json_encode($_REQUEST));
        
        $ret = array();
        
        $key = "GH178VEISZ7MFN4IYGAOP3BUFBPMA854";
        
        $strData = $_REQUEST;
        $strPrivateKeyFile = "/var/www/html/pokerjoin.com/application/controllers/payment/rsa_public_key.pem";
        
        $sign = $this->input->get_post('sign');
        
        unset($strData["sign"]); 
        $checkok = self::RSAverifyNew($strData, $sign,$strPrivateKeyFile);
 
         if($checkok == false){
            log_message('error', "Baiduvideo | check callback error:" .$sign);
             $ret["code"] = "fail";
             echo json_encode($ret);
             return;
        }
        
        $orderId = $this->input->get_post('orderId');

        $res = $this->order_model->getorder($orderId);

        log_message('error', "Baiduvideo | callback res:" . json_encode($res));


        if ($res) {
            $userid = $res[0]["userid"];
            $gameid = $res[0]["gameid"];
            $gamecode = $res[0]["gamecode"];
            $paytype = $res[0]["paytype"];
            $producttype = $res[0]["producttype"];
            $productid = $res[0]["productid"];
            $money = $res[0]["money"];
            $channel = $res[0]["channel"];

            $callbackstatus = $res[0]["callbackstatus"];

            if ($callbackstatus == "1") {
                $ret["code"] = "fail";
                 echo json_encode($ret);

                return;
            }

            $backtime = date('Y-m-d H:i:s', time());

            $order = array(
                'tradeno' => $OrderId,
                'userid' => $userid,
                'gamecode' => $gameid,
                'platformid' => $paytype,
                'productcode' => $producttype . $productid,
            );

            if (($gameid == "041") || ($gameid == "048")) {

                $moneyx = array(
                    "02140011" => "30",
                    "02010011" => "30",
                    "02010012" => "5",
                    "02010014" => "10",
                    "02010016" => "50",
                    "02010017" => "100",
                    "02010018" => "500",
                    "02010019" => "1000",
                    "02010020" => "5000",
                    "02100011" => "5",
                    "02120011" => "5",
                    "02140021" => "30",
                    "02010021" => "30",
                    "02010022" => "5",
                    "02010024" => "10",
                    "02010026" => "50",
                    "02010027" => "100",
                    "02010028" => "500",
                    "02010029" => "1000",
                    "02010020" => "5000",
                    "02100021" => "5",
                    "02120021" => "5",
                    "02141011" => "30",
                    "02011011" => "30",
                    "02011012" => "5",
                    "02011014" => "10",
                    "02011016" => "50",
                    "02011017" => "100",
                    "02011018" => "500",
                    "02011019" => "1000",
                    "02011020" => "5000",
                    "02101011" => "5",
                    "02121011" => "5",
                    "02160011" => "30",
                    "02160012" => "5",
                    "02160014" => "10",
                    "02160016" => "50",
                    "02160017" => "100",
                    "02160018" => "500",
                    "02161011" => "30",
                    "02161012" => "5",
                    "02161014" => "10",
                    "02161016" => "50",
                    "02161017" => "100",
                    "02161018" => "500",
                    "02021011" => "6",
                    "02021012" => "30",
                );


                $vx = array(
                    "02140011" => "30",
                    "02010011" => "200000",
                    "02010012" => "25000",
                    "02010014" => "55000",
                    "02010016" => "350000",
                    "02010017" => "750000",
                    "02010018" => "3900000",
                    "02010019" => "10000000",
                    "02010020" => "69000000",
                    "02100011" => "5",
                    "02120011" => "5",
                    "02140021" => "30",
                    "02010021" => "200000",
                    "02010022" => "25000",
                    "02010024" => "55000",
                    "02010026" => "350000",
                    "02010027" => "750000",
                    "02010028" => "3900000",
                    "02010029" => "10000000",
                    "02010020" => "69000000",
                    "02100021" => "5",
                    "02120021" => "5",
                    "02141011" => "30",
                    "02011011" => "210000",
                    "02011012" => "30000",
                    "02011014" => "60000",
                    "02011016" => "350000",
                    "02011017" => "800000",
                    "02011018" => "4500000",
                    "02011019" => "10000000",
                    "02011020" => "69000000",
                    "02101011" => "5",
                    "02121011" => "5",
                    "02160011" => "300",
                    "02160012" => "50",
                    "02160014" => "100",
                    "02160016" => "500",
                    "02160017" => "1000",
                    "02160018" => "5000",
                    "02161011" => "300",
                    "02161012" => "50",
                    "02161014" => "100",
                    "02161016" => "500",
                    "02161017" => "1000",
                    "02161018" => "5000",
                    "02021011" => "12",
                    "02021012" => "60",
                );

                $pp = $producttype . $productid;

                $v = $vx[$pp];

                $money = $moneyx[$pp];

                log_message('error', "Baiduvideo | product:" . $pp . "----" . $v . "----" . $money);

                $this->load->model('usernew_mid_model');
                $this->load->model('pay_mid_model');

                $jindu_m = 0;
                $buqianka_m = 0;
                $jipaiqi_m = 0;

                $guizhu_m = 0;

                $zhanshi_m = 0;

                $speaker_m = 0;
                if ($producttype == "0202") {
                    $speaker_m = $v;
                }

                if ($producttype == "0216") {
                    $zhanshi_m = $v;
                }


                if ($producttype == "0214") {
                    $guizhu_m = $v;
                }


                if (($producttype == "0214") && (($productid == "0011") || ($productid == "0021"))) {
                    $jindu_m = $jindu_m + 200000;
                }

                if (($producttype == "0214") && ($productid == "1011")) {
                    $jindu_m = $jindu_m + 200000;
                }


                if ($producttype == "0201") {
                    $jindu_m = $v;
                }

                if ($producttype == "0210") {
                    $buqianka_m = $v;
                }

                if ($producttype == "0212") {
                    $jipaiqi_m = $v;
                }


                if (($producttype == "0201") && (($productid == "0011") || ($productid == "0021"))) {
                    if ($this->usernew_mid_model->get_vy30($userid)) {
                        $jindu_m = $jindu_m + 88888;
                        $buqianka_m = $buqianka_m + 6;
                        $jipaiqi_m = $jipaiqi_m + 15;
                    }
                }

                if (($producttype == "0201") && ($productid == "1011")) {
                    if ($this->usernew_mid_model->get_vy30($userid)) {
                        $jindu_m = $jindu_m + 60000;
                        $buqianka_m = $buqianka_m + 4;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && (($productid == "0012") || ($productid == "0022"))) {
                    if ($this->usernew_mid_model->get_vy5($userid)) {
                        $jindu_m = $jindu_m + 28888;
                        $buqianka_m = $buqianka_m + 1;
                        $jipaiqi_m = $jipaiqi_m + 3;
                    }
                }

                if (($producttype == "0201") && ($productid == "1012")) {
                    if ($this->usernew_mid_model->get_vy5($userid)) {
                        $jindu_m = $jindu_m + 10000;
                        $buqianka_m = $buqianka_m + 2;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && (($productid == "0014") || ($productid == "0024"))) {
                    if ($this->usernew_mid_model->get_vy10($userid)) {
                        $jindu_m = $jindu_m + 38888;
                        $buqianka_m = $buqianka_m + 3;
                        $jipaiqi_m = $jipaiqi_m + 7;
                    }
                }

                if (($producttype == "0201") && ($productid == "1014")) {
                    if ($this->usernew_mid_model->get_vy10($userid)) {
                        $jindu_m = $jindu_m + 20000;
                        $buqianka_m = $buqianka_m + 3;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && (($productid == "0016") || ($productid == "0026"))) {
                    if ($this->usernew_mid_model->get_vy50($userid)) {
                        $jindu_m = $jindu_m + 188888;
                        $buqianka_m = $buqianka_m + 10;
                        $jipaiqi_m = $jipaiqi_m + 30;
                    }
                }

                if (($producttype == "0201") && ($productid == "1016")) {
                    if ($this->usernew_mid_model->get_vy50($userid)) {
                        $jindu_m = $jindu_m + 100000;
                        $buqianka_m = $buqianka_m + 5;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }


                if (($producttype == "0201") && (($productid == "0017") || ($productid == "0027"))) {
                    if ($this->usernew_mid_model->get_vy100($userid)) {
                        $jindu_m = $jindu_m + 0;
                        $buqianka_m = $buqianka_m + 0;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && ($productid == "1017")) {
                    if ($this->usernew_mid_model->get_vy100($userid)) {
                        $jindu_m = $jindu_m + 200000;
                        $buqianka_m = $buqianka_m + 6;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && (($productid == "0018") || ($productid == "0028"))) {
                    if ($this->usernew_mid_model->get_vy500($userid)) {
                        $jindu_m = $jindu_m + 0;
                        $buqianka_m = $buqianka_m + 0;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && ($productid == "1018")) {
                    if ($this->usernew_mid_model->get_vy500($userid)) {
                        $jindu_m = $jindu_m + 1000000;
                        $buqianka_m = $buqianka_m + 7;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && (($productid == "0019") || ($productid == "0029"))) {
                    if ($this->usernew_mid_model->get_vy1000($userid)) {
                        $jindu_m = $jindu_m + 0;
                        $buqianka_m = $buqianka_m + 0;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }

                if (($producttype == "0201") && ($productid == "1019")) {
                    if ($this->usernew_mid_model->get_vy1000($userid)) {
                        $jindu_m = $jindu_m + 2000000;
                        $buqianka_m = $buqianka_m + 8;
                        $jipaiqi_m = $jipaiqi_m + 0;
                    }
                }


                log_message('error', "Baiduvideo | varry:" . $jindu_m . "------" . $buqianka_m . "------" . $jipaiqi_m);


                $PlatformID = $paytype;

                $msg = array("UserID" => $userid, "PayType" => $paytype, "ChannelD" => $channel, "GameID" => $gameid, "ProductID" => $pp,
                    "PlatformID" => $PlatformID, "TradeNo" => $OrderId, "Score" => $jindu_m, "Vip" => $guizhu_m, "BuQianKa" => $buqianka_m, "JiPaiQi" => $jipaiqi_m,
                    "Diamond" => $zhanshi_m, "Speaker" => $speaker_m, "TotalFee" => $money);

                log_message('error', "Baiduvideo | send_msgqueue:" . json_encode($msg));

                $ret = $this->usernew_mid_model->send_msgqueue($msg);
        }

        
        
        
        
        $ret["code"] = "success";
  
        echo json_encode($ret);
        
        }
         * 
         */
        
    }
  



}
