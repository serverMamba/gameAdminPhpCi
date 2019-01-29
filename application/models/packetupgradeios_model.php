<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * 支付相关
 */
class packetupgradeios_model extends MY_Model {
    var $db = null;
    var $payment_tables = null; 

    public function __construct() {
        parent::__construct();
         //$this->load->model('usernew_mid_model');
    }
    
      public function get_gameserver_msg() {
        $url = "http://211.151.33.254:6001/smc?command=80161";
        $post_data = array("test"=>"test");
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    public function get_proxy_msg() {
        
        $ret = $this->get_gameserver_msg();
        $ret = json_decode($ret);
        $ret = $ret->UpadteInfoList;
        
        $temp = array();

        foreach ($ret as $key => $value) {
           $Url =  $value->Url;
           $PackageName =  $value->PackageName;
           $ExpiredVersion =  $value->ExpiredVersion;
           $LatestVersion  =  $value->LatestVersion;
           $temp[$PackageName]  = array("version" => $LatestVersion,"overversion" =>  $ExpiredVersion,"url"=>$Url );
        }
        
        
        $tablexx = array();

       $tablexx[] = array("gamename"=>"一起欢乐斗地主","packagename"=>"com.cepha.doudizhu","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/yi-qi-dou-zhu-han-dan-ji+huan/id673907937?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"我是掼蛋王","packagename"=>"com.515game.guandan2","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/wo-shi-guan-dan-wang-jiang/id734127600?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"一起斗牛","packagename"=>"com.515game.niuniu","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/yi-qi-dou-niu-feng-kuang-huan/id554495277?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"开心炸金花","packagename"=>"com.515game.baccaratXianMian","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/kai-xin-zha-jin-hua-zhi-chi/id553454882?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"一起捕鱼","packagename"=>"com.515game.bairenniuniu","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/yi-qi-bu-yu-huan-le-jie-ji/id580758306?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"一起斗地主","packagename"=>"com.bohaoo.doudizhu2","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/yi-qi-huan-le-dou-zhu-han/id680470997?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"一起德州扑克","packagename"=>"com.515game.baccarat","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       $tablexx[] = array("gamename"=>"万炮捕鱼-欢乐街机版","packagename"=>"com.515game.fishing","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
     //  $tablexx[] = array("gamename"=>"欢乐斗地主（一起游戏）","packagename"=>"com.cepha.zhajinhuaold","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
     //  $tablexx[] = array("gamename"=>"一起掼蛋","packagename"=>"com.bohaoo.zhajinhuaan","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
     //  $tablexx[] = array("gamename"=>"捕鱼电玩城","packagename"=>"com.bohaoo.yingsanzhang","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       $tablexx[] = array("gamename"=>"一起麻将","packagename"=>"com.casinoany.baccarat","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/du-chang-bai-jia-le-baccarat/id654711139?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"一起电玩城","packagename"=>"com.515game.zhajinhua2","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       $tablexx[] = array("gamename"=>"欢乐德州","packagename"=>"com.pokerjoin.TexasPoker","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/texas-poker-texas-holdem/id492569079?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"街机万炮捕鱼","packagename"=>"com.515game.huanleqianpaobuyu","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/jie-ji-wan-pao-bu-yu/id1097013608?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"捕鱼电玩城","packagename"=>"com.515game.happyby","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/bu-yu-dian-wan-cheng-huan/id1099073513?l=zh&ls=1&mt=8");
       $tablexx[] = array("gamename"=>"新欢乐斗地主","packagename"=>"com.515game.newdoudizhu","version"=>"0000","overversion"=>"0000","url"=>"https://itunes.apple.com/us/app/xin-huan-le-dou-de-zhu/id1099080649?l=zh&ls=1&mt=8");
   //    $tablexx[] = array("gamename"=>"捕鱼传奇","packagename"=>"com.deluxe.showhand","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       
       $tablexx[] = array("gamename"=>"开心斗牛","packagename"=>"com.515game.niuniuios2","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       $tablexx[] = array("gamename"=>"欢乐赢三张","packagename"=>"com.deluxe.showhand","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
       $tablexx[] = array("gamename"=>"天天赢三张","packagename"=>"com.bohaoo.yingsanzhang","version"=>"0000","overversion"=>"0000","url"=>"http://www.appstore.com/");
    

       
        foreach ( $tablexx as $key => $value) {
           $PackageName =  $value["packagename"];
           $op = $temp[$PackageName] ;
           $tablexx[$key]["version"] =   $op["version"];
           $tablexx[$key]["overversion"]  =   $op["overversion"]; 
           $tablexx[$key]["url"]  =   $op["url"];
        }

        return json_encode($tablexx);

    }

    public function update_proxy_msg($packagename ,$version,$overversion,$urlx) {
       
        $url = "http://211.151.33.254:6001/smc?command=80162";
        $post_data = array("Url"=>$urlx,"PackageName"=>$packagename,"LatestVersion" =>$version,"ExpiredVersion"=>$overversion);
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
    
    
    
    

    public function save_jsversion_msg($Tag, $Version){
    
        return false;
        
    }
    
    public function get_jsversion_msg() {
    
        return $output;
    }

}
