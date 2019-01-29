<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castshoporder1 extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                 $this->load->model('no3/configs_model','configs');
                 $this->load->helper('other');
	}
        
       public function send_number() {
        $action = $this->input->get_post('action');
        $data = $this->input->get_post('data');
      //  $url = "http://test.800617.com:6001/submit.aspx";
        $url = "http://wr.800617.com:6001/submit.aspx";
       // $CompanyID = "1069";
        $CompanyID = "1141";
      //  $InterfacePwd = "f23385";
        $InterfacePwd = "84g3c9";
        
        
        $llst["0000"] = "提交成功";
        $llst["1001"] = "参数不完整";
        $llst["1002"] = "手机号不正确";
        $llst["1003"] = "金额不正确";
        $llst["1004"] = "用户不存在";
        $llst["1005"] = "密码不正确";
        $llst["2001"] = "用户暂停";
        $llst["1006"] = "IP鉴权失败";
        $llst["1007"] = "md5key验证不正确";
        $llst["2002"] = "账户余额异常";
        $llst["2003"] = "手机号是黑名单";
        $llst["2004"] = "订单是重复";
        $llst["2005"] = "余额不足";
        $llst["2006"] = "该产品未开通";
        $llst["9999"] = "系统错误";
        
        $rrs = array();
 
        $ch = curl_init();
        foreach ($data as $key => $value) {
           // $value["price"] = 5000;
            $value["price"] = $value["price"]*100;
          //  $key=md5($CompanyID.$InterfacePwd.$value["mobile"].$value["price"].$value["orderid"]."asasa1");
            $key=md5($CompanyID.$InterfacePwd.$value["mobile"].$value["price"].$value["orderid"]."d44rny");
            $post_data = array("CompanyID" => $CompanyID, "InterfacePwd" =>$InterfacePwd, "Mobile" => $value["mobile"], "Amount" => $value["price"], "OrderID" => $value["orderid"], "OrderSource" => "2", "Key" => $key);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
            $out = curl_exec($ch);
            $xml = simplexml_load_string($out);
            $result = (string) $xml->result;
            $rrs[$value["orderid"]] =  $llst[$result];
        }
        curl_close($ch);
        echo json_encode($rrs);
    }

    public function  exportData(){
            $this->load->model('castshoporder1_model');
            $action = $this->input->get_post('action');

            $orderid = $this->input->get_post('orderid');
            $myendtime = $this->input->get_post('myendtime');
            $mystarttime = $this->input->get_post('mystarttime');
            $phoneid = $this->input->get_post('phoneid');
            $userid = $this->input->get_post('userid');
            $beginindex = $this->input->get_post('beginindex');
         $res = $this->castshoporder1_model->exportData($action,$orderid,$myendtime,$mystarttime,$phoneid,$userid,$beginindex);
       }
       
       
        public function  save_config_data(){
           $this->load->model('castshoporder_model');
           $action = $this->input->get_post('action');
           $data1 = $this->input->get_post('data1');
           $data2 = $this->input->get_post('data2');
           $res = $this->castshoporder_model->save_config_data($data1,$data2);
           echo "配置已经生成！";
        }
        
       public function get_castshoporder1_data(){
            $this->load->model('castshoporder1_model');
            $action = $this->input->get_post('action');

            $orderid = $this->input->get_post('orderid');
            $myendtime = $this->input->get_post('myendtime');
            $mystarttime = $this->input->get_post('mystarttime');
            $phoneid = $this->input->get_post('phoneid');
            $userid = $this->input->get_post('userid');
            $beginindex = $this->input->get_post('beginindex');
            $res = $this->castshoporder1_model->get_shoporder_msg($action,$orderid,$myendtime,$mystarttime,$phoneid,$userid,$beginindex);
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
               "choose" => array("father"=>"运营管理","child"=>"一元话费管理"),
               "header1" => array("father"=>"运营管理","child"=>"一元话费管理"),
               "header2" => array("father"=>"一元话费管理","child"=>"管理实时一元话费订单以及兑换情况。 "),
               "header3" => array("father"=>"一元话费管理后台创建于2015年4月7日","child"=>"一元话费管理管理从2015年4月7日开始 (v1.0) "),
          );
           $this->load->view('no3/castshoporder1view',$data);
	}
	

}
