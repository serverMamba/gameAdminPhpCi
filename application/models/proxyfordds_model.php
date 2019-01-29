<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class proxyfordds_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         //$this->load->model('usernew_mid_model');
    }
    
      public function get_gameserver_msg($url) {
         $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $output = curl_exec($ch);
        curl_close($ch);
        
        $ret = array();
        
        $ret["doudizhuslot_BindingAddress"] = "not conncted";
        $ret["doudizhuslot_ConnectAddress"] = "not conncted";
        
        $ret["doudizhu_BindingAddress"] = "not conncted";
        $ret["doudizhu_ConnectAddress"] = "not conncted";

        $ret["guandan_BindingAddress"]  = "not conncted";
        $ret["guandan_ConnectAddress"]  = "not conncted";

        $ret["niuniu_BindingAddress"]   = "not conncted";
        $ret["niuniu_ConnectAddress"]   = "not conncted";

        $ret["shanzhangpai_BindingAddress"] = "not conncted";
        $ret["shanzhangpai_ConnectAddress"] = "not conncted";

        $ret["tex_BindingAddress"] = "not conncted";
        $ret["tex_ConnectAddress"] = "not conncted";
        
        $ret["shenji_BindingAddress"] = "not conncted";
        $ret["shenji_ConnectAddress"] = "not conncted";
        
        
         if (strlen($output) > 10) {
            $ddjson = json_decode($output);
            
            $ret["doudizhuslot_BindingAddress"] = $ddjson->doudizhuslot->BindingAddress;
            $ret["doudizhuslot_ConnectAddress"] = $ddjson->doudizhuslot->ConnectAddress;

            $ret["doudizhu_BindingAddress"] = $ddjson->doudizhu->BindingAddress;
            $ret["doudizhu_ConnectAddress"] = $ddjson->doudizhu->ConnectAddress;

            $ret["guandan_BindingAddress"]  = $ddjson->guandan->BindingAddress;
            $ret["guandan_ConnectAddress"]  = $ddjson->guandan->ConnectAddress;

            $ret["niuniu_BindingAddress"]   = $ddjson->niuniu->BindingAddress;
            $ret["niuniu_ConnectAddress"]   = $ddjson->niuniu->ConnectAddress;

            $ret["shanzhangpai_BindingAddress"] = $ddjson->shanzhangpai->BindingAddress;
            $ret["shanzhangpai_ConnectAddress"] = $ddjson->shanzhangpai->ConnectAddress;

            $ret["tex_BindingAddress"] = $ddjson->tex->BindingAddress;
            $ret["tex_ConnectAddress"] = $ddjson->tex->ConnectAddress;
            
            $ret["shenji_BindingAddress"] = $ddjson->shenji->BindingAddress;
            $ret["shenji_ConnectAddress"] = $ddjson->shenji->ConnectAddress;
        }
        
        return  $ret;
    }

    public function get_proxy_msg() {
        $magic = md5("getalljson"."jhsdgvfiuergbiwregiuwire");
        
	$ret4 = $this->get_gameserver_msg("http://211.151.36.86/listserver/api?action=getalljson&magic=$magic");
        $ret6 = $this->get_gameserver_msg("http://211.151.32.23/listserver/api?action=getalljson&magic=$magic");
        $ret7 = $this->get_gameserver_msg("http://211.151.130.7/listserver/api?action=getalljson&magic=$magic");
        $ret8 = $this->get_gameserver_msg("http://211.151.32.22/listserver/api?action=getalljson&magic=$magic");
        $ret9 = $this->get_gameserver_msg("http://211.151.36.101/listserver/api?action=getalljson&magic=$magic");
  
        /*
        $reta1 = $this->get_gameserver_msg("http://60.205.5.168/listserver/api?action=getalljson&magic=$magic");
        $reta2 = $this->get_gameserver_msg("http://101.201.81.89/listserver/api?action=getalljson&magic=$magic");
        $reta3 = $this->get_gameserver_msg("http://101.201.82.51/listserver/api?action=getalljson&magic=$magic");
        $reta4 = $this->get_gameserver_msg("http://60.205.95.55/listserver/api?action=getalljson&magic=$magic");
        $reta5 = $this->get_gameserver_msg("http://101.201.80.188/listserver/api?action=getalljson&magic=$magic");
        */
        
        $rett1 = $this->get_gameserver_msg("http://115.159.187.113/listserver/api?action=getalljson&magic=$magic");
        $rett2 = $this->get_gameserver_msg("http://115.159.203.177/listserver/api?action=getalljson&magic=$magic");
        $rett3 = $this->get_gameserver_msg("http://115.159.59.226/listserver/api?action=getalljson&magic=$magic");
        $rett4 = $this->get_gameserver_msg("http://115.159.210.86/listserver/api?action=getalljson&magic=$magic");
        $rett5 = $this->get_gameserver_msg("http://182.254.149.184/listserver/api?action=getalljson&magic=$magic");
        
        $tablexx = array();
   
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhuslot","serverip"=>"211.151.36.86",  "BindingAddress" => $ret4["doudizhuslot_BindingAddress"],"ConnectAddress" => $ret4["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhuslot","serverip"=>"211.151.32.23",  "BindingAddress" => $ret6["doudizhuslot_BindingAddress"],"ConnectAddress" => $ret6["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhuslot","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $ret7["doudizhuslot_ConnectAddress"]);
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhuslot","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $ret8["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhuslot","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $ret9["doudizhuslot_ConnectAddress"]);
        
      /*  
        $tablexx[] = array("des"=>"阿里", "gamename"=>"doudizhuslot","serverip"=>"60.205.5.168",  "BindingAddress" => $reta1["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $reta1["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhuslot","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $reta2["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhuslot","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $reta3["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhuslot","serverip"=>"60.205.95.55",  "BindingAddress" => $reta4["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $reta4["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhuslot","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $reta5["doudizhuslot_ConnectAddress"]);
     */
        
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhuslot","serverip"=>"115.159.187.113",  "BindingAddress" => $rett1["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $rett1["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhuslot","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $rett2["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhuslot","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $rett3["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhuslot","serverip"=>"115.159.210.86",  "BindingAddress" => $rett4["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $rett4["doudizhuslot_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhuslot","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["doudizhuslot_BindingAddress"] ,"ConnectAddress" => $rett5["doudizhuslot_ConnectAddress"]);
   
        
        
	$tablexx[] = array("des"=>"兆维","gamename"=>"doudizhu","serverip"=>"211.151.36.86",  "BindingAddress" => $ret4["doudizhu_BindingAddress"],"ConnectAddress" => $ret4["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhu","serverip"=>"211.151.32.23",  "BindingAddress" => $ret6["doudizhu_BindingAddress"],"ConnectAddress" => $ret6["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhu","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["doudizhu_BindingAddress"] ,"ConnectAddress" => $ret7["doudizhu_ConnectAddress"]);
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhu","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["doudizhu_BindingAddress"] ,"ConnectAddress" => $ret8["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"doudizhu","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["doudizhu_BindingAddress"] ,"ConnectAddress" => $ret9["doudizhu_ConnectAddress"]);
    
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhu","serverip"=>"60.205.5.168",  "BindingAddress" => $reta1["doudizhu_BindingAddress"] ,"ConnectAddress" => $reta1["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhu","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["doudizhu_BindingAddress"] ,"ConnectAddress" => $reta2["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhu","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["doudizhu_BindingAddress"] ,"ConnectAddress" => $reta3["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhu","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["doudizhu_BindingAddress"] ,"ConnectAddress" => $reta4["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"doudizhu","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["doudizhu_BindingAddress"] ,"ConnectAddress" => $reta5["doudizhu_ConnectAddress"]);
        */
	
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhu","serverip"=>"115.159.187.113",  "BindingAddress" => $rett1["doudizhu_BindingAddress"] ,"ConnectAddress" => $rett1["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhu","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["doudizhu_BindingAddress"] ,"ConnectAddress" => $rett2["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhu","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["doudizhu_BindingAddress"] ,"ConnectAddress" => $rett3["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhu","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["doudizhu_BindingAddress"] ,"ConnectAddress" => $rett4["doudizhu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"doudizhu","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["doudizhu_BindingAddress"] ,"ConnectAddress" => $rett5["doudizhu_ConnectAddress"]);
    
        
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"guandan","serverip"=>"211.151.36.86",  "BindingAddress" => $ret4["guandan_BindingAddress"],"ConnectAddress" => $ret4["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"guandan","serverip"=>"211.151.32.23",  "BindingAddress" => $ret6["guandan_BindingAddress"],"ConnectAddress" => $ret6["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"guandan","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["guandan_BindingAddress"],"ConnectAddress" => $ret7["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"guandan","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["guandan_BindingAddress"],"ConnectAddress" => $ret8["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"guandan","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["guandan_BindingAddress"],"ConnectAddress" => $ret9["guandan_ConnectAddress"]);
      
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"guandan","serverip"=>"60.205.5.168",  "BindingAddress" => $reta1["guandan_BindingAddress"] ,"ConnectAddress" => $reta1["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"guandan","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["guandan_BindingAddress"] ,"ConnectAddress" => $reta2["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"guandan","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["guandan_BindingAddress"] ,"ConnectAddress" => $reta3["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"guandan","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["guandan_BindingAddress"] ,"ConnectAddress" => $reta4["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"guandan","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["guandan_BindingAddress"] ,"ConnectAddress" => $reta5["guandan_ConnectAddress"]);
       */ 
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"guandan","serverip"=>"115.159.187.113",  "BindingAddress" => $rett1["guandan_BindingAddress"] ,"ConnectAddress" => $rett1["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"guandan","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["guandan_BindingAddress"] ,"ConnectAddress" => $rett2["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"guandan","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["guandan_BindingAddress"] ,"ConnectAddress" => $rett3["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"guandan","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["guandan_BindingAddress"] ,"ConnectAddress" => $rett4["guandan_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"guandan","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["guandan_BindingAddress"] ,"ConnectAddress" => $rett5["guandan_ConnectAddress"]);
   
        
        
	$tablexx[] = array("des"=>"兆维","gamename"=>"niuniu","serverip"=>"211.151.36.86",  "BindingAddress" => $ret4["niuniu_BindingAddress"],"ConnectAddress" => $ret4["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"niuniu","serverip"=>"211.151.32.23",  "BindingAddress" => $ret6["niuniu_BindingAddress"],"ConnectAddress" => $ret6["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"niuniu","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["niuniu_BindingAddress"],"ConnectAddress" => $ret7["niuniu_ConnectAddress"]);
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"niuniu","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["niuniu_BindingAddress"],"ConnectAddress" => $ret8["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"niuniu","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["niuniu_BindingAddress"],"ConnectAddress" => $ret9["niuniu_ConnectAddress"]);
      
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"niuniu","serverip"=>"60.205.5.168",  "BindingAddress" => $reta1["niuniu_BindingAddress"] ,"ConnectAddress" => $reta1["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"niuniu","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["niuniu_BindingAddress"] ,"ConnectAddress" => $reta2["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"niuniu","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["niuniu_BindingAddress"] ,"ConnectAddress" => $reta3["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"niuniu","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["niuniu_BindingAddress"] ,"ConnectAddress" => $reta4["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"niuniu","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["niuniu_BindingAddress"] ,"ConnectAddress" => $reta5["niuniu_ConnectAddress"]);
       */
        
       $tablexx[] = array("des"=>"腾讯", "gamename"=>"niuniu","serverip"=>"115.159.187.113",  "BindingAddress" => $rett1["niuniu_BindingAddress"] ,"ConnectAddress" => $rett1["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"niuniu","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["niuniu_BindingAddress"] ,"ConnectAddress" => $rett2["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"niuniu","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["niuniu_BindingAddress"] ,"ConnectAddress" => $rett3["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"niuniu","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["niuniu_BindingAddress"] ,"ConnectAddress" => $rett4["niuniu_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"niuniu","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["niuniu_BindingAddress"] ,"ConnectAddress" => $rett5["niuniu_ConnectAddress"]);
   
        
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"shanzhangpai","serverip"=>"211.151.36.86",  "BindingAddress" => $ret4["shanzhangpai_BindingAddress"],"ConnectAddress" =>$ret4["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shanzhangpai","serverip"=>"211.151.32.23",  "BindingAddress" => $ret6["shanzhangpai_BindingAddress"],"ConnectAddress" =>$ret6["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shanzhangpai","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["shanzhangpai_BindingAddress"],"ConnectAddress" =>  $ret7["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shanzhangpai","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["shanzhangpai_BindingAddress"],"ConnectAddress" =>  $ret8["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shanzhangpai","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["shanzhangpai_BindingAddress"],"ConnectAddress" =>  $ret9["shanzhangpai_ConnectAddress"]);
     
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"shanzhangpai","serverip"=>"60.205.5.168",  "BindingAddress" => $reta1["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $reta1["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shanzhangpai","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $reta2["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shanzhangpai","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $reta3["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shanzhangpai","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $reta4["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shanzhangpai","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $reta5["shanzhangpai_ConnectAddress"]);
        */
   
        
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shanzhangpai","serverip"=>"115.159.187.113",  "BindingAddress" => $rett1["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $rett1["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shanzhangpai","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $rett2["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shanzhangpai","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $rett3["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shanzhangpai","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $rett4["shanzhangpai_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shanzhangpai","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["shanzhangpai_BindingAddress"] ,"ConnectAddress" => $rett5["shanzhangpai_ConnectAddress"]);
   
        
	$tablexx[] = array("des"=>"兆维","gamename"=>"tex","serverip"=>"211.151.36.86",  "BindingAddress" =>  $ret4["tex_BindingAddress"],"ConnectAddress" => $ret4["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"tex","serverip"=>"211.151.32.23",  "BindingAddress" =>  $ret6["tex_BindingAddress"],"ConnectAddress" => $ret6["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"tex","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["tex_BindingAddress"],"ConnectAddress" => $ret7["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"tex","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["tex_BindingAddress"],"ConnectAddress" => $ret8["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"tex","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["tex_BindingAddress"],"ConnectAddress" => $ret9["tex_ConnectAddress"]);
     
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"tex","serverip"=>"60.205.5.168",   "BindingAddress" => $reta1["tex_BindingAddress"] ,"ConnectAddress" => $reta1["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"tex","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["tex_BindingAddress"] ,"ConnectAddress" => $reta2["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"tex","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["tex_BindingAddress"] ,"ConnectAddress" => $reta3["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"tex","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["tex_BindingAddress"] ,"ConnectAddress" => $reta4["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"tex","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["tex_BindingAddress"] ,"ConnectAddress" => $reta5["tex_ConnectAddress"]);
        */
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"tex","serverip"=>"115.159.187.113",   "BindingAddress" => $rett1["tex_BindingAddress"] ,"ConnectAddress" => $rett1["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"tex","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["tex_BindingAddress"] ,"ConnectAddress" => $rett2["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"tex","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["tex_BindingAddress"] ,"ConnectAddress" => $rett3["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"tex","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["tex_BindingAddress"] ,"ConnectAddress" => $rett4["tex_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"tex","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["tex_BindingAddress"] ,"ConnectAddress" => $rett5["tex_ConnectAddress"]);    
        
        
        
        $tablexx[] = array("des"=>"兆维","gamename"=>"shenji","serverip"=>"211.151.36.86",  "BindingAddress" =>  $ret4["shenji_BindingAddress"],"ConnectAddress" => $ret4["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shenji","serverip"=>"211.151.32.23",  "BindingAddress" =>  $ret6["shenji_BindingAddress"],"ConnectAddress" => $ret6["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shenji","serverip"=>"211.151.130.7",  "BindingAddress" => $ret7["shenji_BindingAddress"],"ConnectAddress" => $ret7["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shenji","serverip"=>"211.151.32.22",  "BindingAddress" => $ret8["shenji_BindingAddress"],"ConnectAddress" => $ret8["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"兆维","gamename"=>"shenji","serverip"=>"211.151.36.101",  "BindingAddress" => $ret9["shenji_BindingAddress"],"ConnectAddress" => $ret9["shenji_ConnectAddress"]);
     
        /*
        $tablexx[] = array("des"=>"阿里","gamename"=>"shenji","serverip"=>"60.205.5.168",   "BindingAddress" => $reta1["shenji_BindingAddress"] ,"ConnectAddress" => $reta1["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shenji","serverip"=>"101.201.81.89",  "BindingAddress" => $reta2["shenji_BindingAddress"] ,"ConnectAddress" => $reta2["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shenji","serverip"=>"101.201.82.51",  "BindingAddress" => $reta3["shenji_BindingAddress"] ,"ConnectAddress" => $reta3["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shenji","serverip"=>"60.205.95.55",    "BindingAddress" => $reta4["shenji_BindingAddress"] ,"ConnectAddress" => $reta4["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"阿里","gamename"=>"shenji","serverip"=>"101.201.80.188",  "BindingAddress" => $reta5["shenji_BindingAddress"] ,"ConnectAddress" => $reta5["shenji_ConnectAddress"]);
        */
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shenji","serverip"=>"115.159.187.113",   "BindingAddress" => $rett1["shenji_BindingAddress"] ,"ConnectAddress" => $rett1["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shenji","serverip"=>"115.159.203.177",  "BindingAddress" => $rett2["shenji_BindingAddress"] ,"ConnectAddress" => $rett2["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shenji","serverip"=>"115.159.59.226",  "BindingAddress" => $rett3["shenji_BindingAddress"] ,"ConnectAddress" => $rett3["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shenji","serverip"=>"115.159.210.86",    "BindingAddress" => $rett4["shenji_BindingAddress"] ,"ConnectAddress" => $rett4["shenji_ConnectAddress"]);
        $tablexx[] = array("des"=>"腾讯", "gamename"=>"shenji","serverip"=>"182.254.149.184",  "BindingAddress" => $rett5["shenji_BindingAddress"] ,"ConnectAddress" => $rett5["shenji_ConnectAddress"]);    

        
        
        
        return json_encode($tablexx);

    }

    public function update_proxy_msg($gamename ,$serverip,$BindingAddress,$ConnectAddress) {
        
        $magic = md5($gamename."jhsdgvfiuergbiwregiuwire");
        $url ="http://".$serverip."/modify/api?gamename=$gamename&BindingAddress=$BindingAddress&ConnectAddress=$ConnectAddress&magic=$magic";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $output = curl_exec($ch);
        curl_close($ch);
        return "ok";
    }

    public function save_jsversion_msg($Tag, $Version){
    
        return false;
        
    }
    
    public function get_jsversion_msg() {
    
        return $output;
    }

}
