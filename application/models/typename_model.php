<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class typename_model extends MY_Model {


    public function __construct() {
        parent::__construct();
     }
    
     public function get_version($dir) {
        if (file_exists($dir)) {
            $json_string = file_get_contents($dir);
            $json = json_decode($json_string);
            return $json->version;
        }
        return "0";
    }
    
    public function get_overversion($dir) {
        if (file_exists($dir)) {
            $json_string = file_get_contents($dir);
            $json = json_decode($json_string);
            return $json->overversion+0;
        }
        return "0";
    }

    public function get_all_md5(){
       $dir = APP_ROOT."/log/res/game_packet_gen";
       $commonres = strtoupper(md5_file($dir."/common/res.zip"));
       $commonsrc = strtoupper(md5_file($dir."/common/src.zip"));
       $commonversion = $this->get_version($dir."/common/project.manifest");
       $commonversionxx = $this->get_overversion($dir."/common/project.manifest");
       
       $ddzres = strtoupper(md5_file($dir."/ddz/res.zip"));
       $ddzsrc = strtoupper(md5_file($dir."/ddz/src.zip"));
       $ddzversion = $this->get_version($dir."/ddz/project.manifest");
       $ddzversionxx = $this->get_overversion($dir."/ddz/project.manifest");
       
       $fishingres = strtoupper(md5_file($dir."/fishing/res.zip"));
       $fishingsrc = strtoupper(md5_file($dir."/fishing/src.zip"));
       $fishingversion = $this->get_version($dir."/fishing/project.manifest");
       $fishingversionxx = $this->get_overversion($dir."/fishing/project.manifest");
       
       $gccommonres = strtoupper(md5_file($dir."/gccommon/res.zip"));
       $gccommonsrc = strtoupper(md5_file($dir."/gccommon/src.zip"));
       $gccommonversion = $this->get_version($dir."/gccommon/project.manifest");
       $gccommonversionxx = $this->get_overversion($dir."/gccommon/project.manifest");
       
       $guandanres = strtoupper(md5_file($dir."/guandan/res.zip"));
       $guandansrc = strtoupper(md5_file($dir."/guandan/src.zip"));
       $guandanversion = $this->get_version($dir."/guandan/project.manifest");
       $guandanversionxx = $this->get_overversion($dir."/guandan/project.manifest");
       
       $hallres = strtoupper(md5_file($dir."/hall/res.zip"));
       $hallsrc = strtoupper(md5_file($dir."/hall/src.zip"));
       $hallversion = $this->get_version($dir."/hall/project.manifest");
       $hallversionxx = $this->get_overversion($dir."/hall/project.manifest");
       
       $hallstaticres = strtoupper(md5_file($dir."/hallstatic/res.zip"));
       $hallstaticsrc = strtoupper(md5_file($dir."/hallstatic/src.zip"));
       $hallstaticversion = $this->get_version($dir."/hallstatic/project.manifest");
       $hallstaticversionxx = $this->get_overversion($dir."/hallstatic/project.manifest");
       
       $niuniures = strtoupper(md5_file($dir."/niuniu/res.zip"));
       $niuniusrc = strtoupper(md5_file($dir."/niuniu/src.zip"));
       $niuniuversion = $this->get_version($dir."/niuniu/project.manifest");
       $niuniuversionxx = $this->get_overversion($dir."/niuniu/project.manifest");
       
       $zhajinhuares = strtoupper(md5_file($dir."/zhajinhua/res.zip"));
       $zhajinhuasrc = strtoupper(md5_file($dir."/zhajinhua/src.zip"));
       $zhajinhuaversion = $this->get_version($dir."/zhajinhua/project.manifest");
       $zhajinhuaversionxx = $this->get_overversion($dir."/zhajinhua/project.manifest");
       
       $res = array(
           "commonres"=>$commonres,
           "commonsrc"=>$commonsrc,
           "commonversion"=>$commonversion,
           "commonversionx"=>$commonversion,
           "commonversionxx"=>$commonversionxx,
           "ddzres"=>$ddzres,
           "ddzsrc"=>$ddzsrc,
           "ddzversion"=>$ddzversion,
           "ddzversionx"=>$ddzversion,
           "ddzversionxx"=>$ddzversionxx,
           "fishingres"=>$fishingres,
           "fishingsrc"=>$fishingsrc,
           "fishingversion"=>$fishingversion,
           "fishingversionx"=>$fishingversion,
           "fishingversionxx"=>$fishingversionxx,
           "gccommonres"=>$gccommonres,
           "gccommonsrc"=>$gccommonsrc,
           "gccommonversion"=>$gccommonversion,
           "gccommonversionx"=>$gccommonversion,
           "gccommonversionxx"=>$gccommonversionxx,
           "guandanres"=>$guandanres,
           "guandansrc"=>$guandansrc,
           "guandanversion"=>$guandanversion,
           "guandanversionx"=>$guandanversion,
           "guandanversionxx"=>$guandanversionxx,
           "hallres"=>$hallres,
           "hallsrc"=>$hallsrc,
           "hallversion"=>$hallversion,
           "hallversionx"=>$hallversion,
           "hallversionxx"=>$hallversionxx,
           "hallstaticres"=>$hallstaticres,
           "hallstaticsrc"=>$hallstaticsrc,
           "hallstaticversion"=>$hallstaticversion,
           "hallstaticversionx"=>$hallstaticversion,
           "hallstaticversionxx"=>$hallstaticversionxx,
           "niuniures"=>$niuniures,
           "niuniusrc"=>$niuniusrc,
           "niuniuversion"=>$niuniuversion,
           "niuniuversionx"=>$niuniuversion,
           "niuniuversionxx"=>$niuniuversionxx,
           "zhajinhuares"=>$zhajinhuares,
           "zhajinhuasrc"=>$zhajinhuasrc,
           "zhajinhuaversion"=>$zhajinhuaversion,
           "zhajinhuaversionx"=>$zhajinhuaversion,
           "zhajinhuaversionxx"=>$zhajinhuaversionxx,
           );
        return  $res;
    }
    
     public function get_config_data($gamename,$mode) {
       $allmd5 = $this->get_all_md5();
       echo json_encode($allmd5);
     }
     
     
      public function save_all_configdata_item($gamenamex, $modex, $itemname, $itemversion,$extradata) {
        $dir = APP_ROOT."/res/game_packet_gen";
        $resmd5 = strtoupper(md5_file($dir . "/$itemname/res.zip"));
        $srcmd5 = strtoupper(md5_file($dir . "/$itemname/src.zip"));
        
        $host = "www.515game.com";
        
        if($modex == "debug") $host = "211.151.33.247"; 
         if($modex == "gddebug") $host = "211.151.33.247"; 
        
        $url = "http://$host/res/gamejs$modex"."_"."$gamenamex/$itemname/";

        $modelproject = '{
           "packageUrl":"'.$url.'",
           "remoteVersionUrl":"'.$url.'version.manifest",
           "remoteManifestUrl":"'.$url.'project.manifest",
           "version":"'.$itemversion.'",
           "engineVersion":"Cocos2d-JS v3.6",
           "assets":{
                "src.zip":{"md5":"'.$srcmd5.'","compressed":true},
	        "res.zip":{"md5":"'.$resmd5.'","compressed":true}
	    },
	       "searchPaths":["src/'.$itemname.'"]
           }';
        
        if($extradata != ""){
            $modelproject = '{
           "packageUrl":"'.$url.'",
           "remoteVersionUrl":"'.$url.'version.manifest",
           "remoteManifestUrl":"'.$url.'project.manifest",
           "version":"'.$itemversion.'",
           "engineVersion":"Cocos2d-JS v3.6",
           '.$extradata.',
           "assets":{
                "src.zip":{"md5":"'.$srcmd5.'","compressed":true},
	        "res.zip":{"md5":"'.$resmd5.'","compressed":true}
	    },
	       "searchPaths":["src/'.$itemname.'"]
           }';
        }
        
        $modelversion = '{
          "packageUrl":"'.$url.'",
          "remoteVersionUrl":"'.$url.'version.manifest",
          "remoteManifestUrl":"'.$url.'project.manifest",
          "version":"'.$itemversion.'",
          "engineVersion":"Cocos2d-JS v3.6"
        }';
        
        file_put_contents($dir."/$itemname/project.manifest",$modelproject);
        file_put_contents($dir."/$itemname/version.manifest",$modelversion);
        
    }

    public function save_all_configdata($gamename, $mode,$postdata) {
        $gamenamex = $gamename;
        $modex = $mode;
        switch ($gamename . "_" . $mode) {
            case "ddz_debug":
                $gamenamex = "ddz3300";
                $modex = "debug";
                break;
            case "ddz_release":
                $gamenamex = "ddz3300";
                $modex = "";
                break;
            case "guandan_debug":
                $gamenamex = "gd3300";
                 $modex = "gddebug";
                break;
            case "guandan_release":
                 $gamenamex = "gd3300";
                 $modex = "gd";
                break;
            case "niuniu_debug":
                $gamenamex = "niuniu3300";
                $modex = "debug";
                break;
            case "niuniu_release":
                $gamenamex = "niuniu3300";
                $modex = "";
                break;
            case "wifiallkey_debug":
                $gamenamex = "wifiallkey3300";
                $modex = "debug";
                break;
            case "wifiallkey_release":
                $gamenamex = "wifiallkey3300";
                $modex = "";
                break;
            default:
        }
        
        foreach($postdata as $itemname => $itemversion){
            $extradata = "";
            switch($itemname){
                case "hall":
                   // $extradata = '"DDZIOS2":{"upgradeType":"2","desVersion":"3.3.0","appUrl":"https://itunes.apple.com/cn/app/yi-qi-huan-le-dou-zhu-han/id680470997?mt=8"}';
                    break;
                case "hallstatic":
                    break;
            }
            $this->save_all_configdata_item($gamenamex, $modex,$itemname,$itemversion,$extradata); 
        }
        
        echo "success";
       
    }

}
