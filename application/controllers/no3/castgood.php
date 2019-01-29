<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Castgood extends MY_Controller {
	public function __construct() {
		parent::__construct(false, false);
                if(empty($_COOKIE['SMC_NO3_YG'])){
                    redirect(site_url('no3/login'));
                }
                $this->load->model('no3/configs_model','configs');
                $this->load->helper('other');
	}
        
       public function  save_config_data(){
           $this->load->model('castgood_model');
           $action = $this->input->get_post('action');
           $data = $this->input->get_post('data');
           $content = "<?php\n";
           $myfilename = DYCONFIG."good_config.php";
           foreach ($data as $key => $value){
               $content =  $content."\$goodconfig['".$value["key"]."']='".$value["value"]."';\n";
            }
           $content = $content."return \$goodconfig;\n";
           file_put_contents($myfilename,$content, LOCK_EX);
           echo "配置已经生成！";
        }
        
        
       public function get_castgood_data() {
        $this->load->model('castgood_model');
        $res = $this->castgood_model->get_static_good_config();

        $myfilename = DYCONFIG."good_config.php";

        if (file_exists($myfilename)) {
            $rr = require_once($myfilename);
            foreach ($res as $key => $value) {
                $id = $value["id"];
                $res[$key]["choosed"] = $rr[$id];
            }
        }


        echo json_encode($res );
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
               "choose" => array("father"=>"运营管理","child"=>"销售商品管理"),
               "header1" => array("father"=>"运营管理","child"=>"销售商品管理"),
               "header2" => array("father"=>"销售商品管理","child"=>"管理待销售的商品"),
               "header3" => array("father"=>"销售商品管理后台创建于2014年8月3日","child"=>"销售商品管理从2014年8月5日开始 (v1.0) "),
          );
           $this->load->view('no3/castgoodview',$data);
	}
	

}
