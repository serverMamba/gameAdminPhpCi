<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sns extends MY_Controller {
	public function __construct() {
		parent::__construct(false, true);
                require APP_ROOT."/UmengIM/Autoloader.php";
	}
        
    public function  query_friends_lists($UserID, $AppKey){
        //$url = "http://27.115.62.98:6001/smc?command=20049";
        $post_data = array("UserID"=>$UserID,"AppKey"=>$AppKey);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
                
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
    public function api_my_query_friends_lists(){
        header("Content-type: text/html; charset=utf-8");
        $UserID = $this->input->get_post('UserID');
        $AppKey = $this->input->get_post('AppKey');
        echo $this->query_friends_lists($UserID, $AppKey);
    }
   
   
   public function  add_friend($UserIDAccept,$AppKey, $UserIDAccepted,$AcceptedAppKey){
        $url = "http://27.115.62.98:6001/smc?command=20042";
        $post_data = array("UserIDAccept"=>$UserIDAccept,"AppKey"=>$AppKey,"UserIDAccepted"=>$UserIDAccepted,"AcceptedAppKey"=>$AcceptedAppKey);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
    public function api_my_add_friend(){
        header("Content-type: text/html; charset=utf-8");
        $UserIDAccept = $this->input->get_post('UserIDAccept');
        $AppKey = $this->input->get_post('AppKey');
        $UserIDAccepted = $this->input->get_post('UserIDAccepted');
        $AcceptedAppKey = $this->input->get_post('AcceptedAppKey');
        echo $this->add_friend($UserIDAccept,$AppKey, $UserIDAccepted,$AcceptedAppKey);
    }
   
   public function  delete_friend($UserIDRemove,$UserIDRemoveAppkey,$UserIDRemoved,$UserIDRemovedAppKey){
        $url = "http://27.115.62.98:6001/smc?command=20044";
        $post_data = array("UserIDRemove"=>$UserIDRemove,"UserIDRemoveAppkey"=>$UserIDRemoveAppkey,"UserIDRemoved"=>$UserIDRemoved ,"UserIDRemovedAppKey"=>$UserIDRemovedAppKey);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode( $post_data));
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
    
     public function api_my_delete_friend() {
        header("Content-type: text/html; charset=utf-8");
        $UserIDRemove = $this->input->get_post('UserIDRemove');
        $UserIDRemoveAppkey = $this->input->get_post('UserIDRemoveAppkey');
        $UserIDRemoved = $this->input->get_post('UserIDRemoved');
        $UserIDRemovedAppKey = $this->input->get_post('UserIDRemovedAppKey');
        echo $this->delete_friend($UserIDRemove, $UserIDRemoveAppkey, $UserIDRemoved, $UserIDRemovedAppKey);
    }

    public function  taobao_add_member($userid, $password,$nick,$icon){
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimUsersAddRequest;
        $userinfos = new Userinfos;
        $userinfos->nick = $nick;
        $userinfos->icon_url = $icon;
       // $userinfos->email = "coopcoop@163.com";
       // $userinfos->mobile = "13995588949";
       // $userinfos->taobaoid = "";
        $userinfos->userid = $userid;
        $userinfos->password = $password;
      //  $userinfos->remark = "demo";
      //  $userinfos->extra = json_encode("demo");
      //  $userinfos->career = "demo";
      //  $userinfos->vip = json_encode("demo");
      //  $userinfos->address = "demo";
      //  $userinfos->name = "demo";
      //  $userinfos->age = "123";
      //  $userinfos->gender = "M";
      //  $userinfos->wechat = "demo";
      //  $userinfos->qq = "demo";
      //  $userinfos->weibo = "demo";
      //  echo json_encode($userinfos);
          $req->setUserinfos(json_encode($userinfos));
          $resp = $c->execute($req);
          return json_encode((array) $resp);
    }
    
     public function  api_taobao_add_member(){
          header("Content-type: text/html; charset=utf-8");
          $userid = $this->input->get_post('userid');
          $password = $this->input->get_post('password');
          $nick = $this->input->get_post('nick');
          $icon = $this->input->get_post('icon');
          echo $this->taobao_add_member($userid, $password,$nick,$icon);
     }
    
      public function taobao_get_member($userid) {
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimUsersGetRequest;
        $req->setUserids($userid);
        $resp = $c->execute($req);
        return json_encode((array)$resp);
     }
     
      public function api_taobao_get_member() {
         header("Content-type: text/html; charset=utf-8");
         $userid = $this->input->get_post('userid');
         echo $this->taobao_get_member($userid);
      }
     
     
      public function taobao_delete_member($userid) {
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimUsersDeleteRequest;
        $req->setUserids($userid);
        $resp = $c->execute($req);
        return json_encode((array)$resp);
    }
    
    public function api_taobao_delete_member(){
         header("Content-type: text/html; charset=utf-8");
         $userid = $this->input->get_post('userid');
         echo $this->taobao_delete_member($userid);
    } 
    
    
    public function  taobao_update_member($userid, $password,$nick,$icon){
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimUsersUpdateRequest;
        $userinfos = new Userinfos;
        $userinfos->nick = $nick;
        $userinfos->icon_url = $icon;
       // $userinfos->email = "coopcoop@163.com";
       // $userinfos->mobile = "13995588949";
       // $userinfos->taobaoid = "";
        $userinfos->userid = $userid;
        $userinfos->password = $password;
      //  $userinfos->remark = "demo";
      //  $userinfos->extra = json_encode("demo");
      //  $userinfos->career = "demo";
      //  $userinfos->vip = json_encode("demo");
      //  $userinfos->address = "demo";
      //  $userinfos->name = "demo";
      //  $userinfos->age = "123";
      //  $userinfos->gender = "M";
      //  $userinfos->wechat = "demo";
      //  $userinfos->qq = "demo";
      //  $userinfos->weibo = "demo";
      //  echo json_encode($userinfos);
          $req->setUserinfos(json_encode($userinfos));
          $resp = $c->execute($req);
        return json_encode((array) $resp);
        
    }
    
    public function  api_taobao_update_member(){
        header("Content-type: text/html; charset=utf-8");
        $userid = $this->input->get_post('userid'); 
        $password = $this->input->get_post('password');
        $nick = $this->input->get_post('nick');
        $icon = $this->input->get_post('icon');
        echo $this->taobao_update_member($userid, $password,$nick,$icon);
    }
    
    
    public function taobao_sendmessage_member($from_user,$to_users,$data,$summary) {
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimCustmsgPushRequest;
        $custmsg = new CustMsg;
        $custmsg->from_user = $from_user;
        $custmsg->to_appkey = "12329a8e077ed55b1c080f782bf573e2";
        $custmsg->to_users = $to_users;
        $custmsg->summary = $summary;
        $custmsg->data = $data;
        $custmsg->aps = "{\"alert\":\"ios apns push\"}";
        $custmsg->apns_param = "apns推送的附带数据";
        $req->setCustmsg(json_encode($custmsg));
        $resp = $c->execute($req);
        return json_encode((array) $resp);
    }
    
    public function api_taobao_sendmessage_member(){
        header("Content-type: text/html; charset=utf-8");
        $from_user = $this->input->get_post('from_user'); 
        $to_users = $this->input->get_post('to_users');
        $data = $this->input->get_post('data');
        $summary = $this->input->get_post('summary');
        echo $this->taobao_sendmessage_member($from_user,$to_users,$data,$summary);
    }
    
    public function taobao_getmessagerelation_member($userid, $fromedate,$todata) {
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimRelationsGetRequest;
        $req->setBegDate($fromedate);
        $req->setEndDate($todata);
        $user = new OpenImUser;
        $user->uid = $userid;
        $user->taobao_account = "false";
        $user->app_key = "23277035";
        $req->setUser(json_encode($user));
        $resp = $c->execute($req);
        return json_encode((array) $resp);
    }
    
    public function api_taobao_getmessagerelation_member() {
        header("Content-type: text/html; charset=utf-8");
        $userid = $this->input->get_post('userid'); 
        $fromedate = $this->input->get_post('fromedate');
        $todata = $this->input->get_post('todata');
        echo $this->taobao_getmessagerelation_member($userid, $fromedate,$todata);
    }
    
    public function taobao_creategroup_member($userid, $tribename,$membersUser) {
        $c = new TopClient;
        $c->appkey = "23277035";
        $c->secretKey = "12329a8e077ed55b1c080f782bf573e2";
        $req = new OpenimTribeCreateRequest;
        $user = new OpenImUser;
        $user->uid = $userid;
        $user->taobao_account = "false";
        $user->app_key = "23277035";
        $req->setUser(json_encode($user));
        $req->setTribeName($tribename);
        $req->setNotice($tribename);
        $req->setTribeType("0");
        $members = new OpenImUser;
        $members->uid = $membersUser;
        $members->taobao_account = "false";
        $members->app_key = "23277035";
        $req->setMembers(json_encode($members));
        $resp = $c->execute($req);
        return json_encode((array) $resp);
    }

    public function  test(){
      header("Content-type: text/html; charset=utf-8"); 
      //$ret =  $this->query_friends_lists("890007");
      $ret1 =$this->taobao_add_member("890007", "zshshy","zshshy","pic_1_lg");
      print_r($ret1);
      echo "</br>";
      echo "</br>";

      $ret =$this->taobao_get_member("890007");
      print_r($ret);
      
      echo "</br>";
      echo "</br>";
      
      $ret2 =$this->taobao_delete_member("890007");
      print_r($ret2);
      
      $ret3 =$this->add_friend("890007","23277035", "890008","23277035");
       $ret3 =$this->add_friend("890007","23277035", "890009","23277035");
        $ret3 =$this->add_friend("890007","23277035", "890010","23277035");
      print_r($ret3);
      
      $ret4 =$this->query_friends_lists("890007","23277035");
      print_r($ret4);

    }


    public function index() {

        /*
          echo "AAAAAAAAAAAAAAAAAAAAAAAAAAA";
          $this->add_friend("10001", "10002");
          $ret =  $this->query_friends_lists("10001");
          echo "BBBBBBBBBBBBBBBBBBBBBBBBBB";
          print_r($ret);
         * 
         */
    }

}
