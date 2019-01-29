<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class ProxyIp extends CI_Controller {
	private $VIP3_LIST_KEY = "vip3_iplist";
	private $VIP2_LIST_KEY = "vip2_iplist";
	private $VIP_LIST_KEY = "vip_iplist";
	private $NOTVIP_LIST_KEY = "notvip_iplist";
	
	public function __construct() {
		parent::__construct ( false, false );
		if (! $this->Common_model->isLogin ()) {
			redirect ( 'no3/login' );
		}
		if (! $this->Common_model->isPriv ( 'proxy_ip' )) {
			redirect ( 'no3/index' );
		}
		$this->load->model ( 'no3/Proxy_ip_model' );
	}
	public function index() {
		$p_list = array ();
		$select_tag = $this->input->get ( 'tag', true ) ? $this->input->get ( 'tag', true ) : '';
		$package_list = $this->Proxy_ip_model->getProxyIp ( $select_tag );
		$tag_list = $this->config->item ( 'taglist' );
		
		foreach ( $tag_list as $k => $v ) {
			if (isset ( $package_list [$k] )) {
				array_push ( $p_list, array (
						'packagename' => $k,
						'ip_list' => $package_list [$k],
						'name' => $v 
				) );
			} else {
				if ($select_tag == '' || $select_tag == $k) {
					array_push ( $p_list, array (
							'packagename' => $k,
							'ip_list' => '',
							'name' => $v 
					) );
				}
			}
		}
		$vipArr= $this->vipProxys();
		$data = array (
				'menu' => $this->Common_model->getAdminMenuList (),
				"choose" => array (
						"father" => "运营管理",
						"child" => "Proxy IP管理" 
				),
				"header1" => array (
						"father" => "运营管理",
						"child" => "Proxy IP管理" 
				),
				'packageList' => $p_list,
				'taglist' => $tag_list,
				'vip3_proxys' => $vipArr['vip3_proxys'],
				'vip2_proxys' => $vipArr['vip2_proxys'],
				'vip_proxys' => $vipArr['vip_proxys'],
				'notvip_proxys' => $vipArr['notvip_proxys'],
				'select_tag' => $select_tag 
		);
		
		$this->load->view ( 'no3/proxy_ip_list_views', $data );
	}
	public function ajaxSaveProxyIp() {
		$return_ary = array ();
		$select_tag = $this->input->post ( 'tag', true ) ? $this->input->post ( 'tag', true ) : '';
		$ip_list = $this->input->post ( 'ip_list', true ) ? $this->input->post ( 'ip_list', true ) : '';
		
		if (! $select_tag) {
			$return_ary ['status'] = 0;
			$return_ary ['msg'] = '参数错误';
			exit ( json_encode ( $return_ary ) );
		}
		
		$data = array (
				'ip_list' => $ip_list 
		);
		
		if ($this->Proxy_ip_model->insertOrUpdateTag ( $select_tag, $data )) {
			
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$redis->del ( 'ip_list_' . $select_tag );
			$redis->close ();
			
			$return_ary ['status'] = 1;
			$return_ary ['msg'] = '修改成功';
			exit ( json_encode ( $return_ary ) );
		} else {
			$return_ary ['status'] = 0;
			$return_ary ['msg'] = '修改错误';
			exit ( json_encode ( $return_ary ) );
		}
	}
	public function ajaxSyncDbToRedis() {
		$return_ary = array ();
		$return_ary ['status'] = 0;
		$return_ary ['msg'] = '服务端运行错误';
		$package_list = $this->Proxy_ip_model->getProxyIp ( null );
	
		/**
		foreach ( $package_list as $tag => $ip_list ) {
			$logStr = 'ip_list_' . $tag."->".$ip_list;
			$this->writeLog($logStr);
		}
		exit ( json_encode ( $return_ary ) );
		**/
		if ($package_list) {
			$redis_config = $this->config->item ( 'redis' );
			$redis = new Redis ();
			$redis->connect ( $redis_config ['host'], $redis_config ['port'] );
			$num = 0;
			foreach ( $package_list as $tag => $ip_list ) {
				//$redis->del ( 'ip_list_' . $tag );
				$redis->set ( 'ip_list_' . $tag, $ip_list );
				$num++;
			}
			$redis->close ();
				
			$return_ary ['status'] = 1;
			$return_ary ['msg'] = '同步成功('.$num.")";
			exit ( json_encode ( $return_ary ) );
		} else {
			$return_ary ['status'] = 0;
			$return_ary ['msg'] = '同步失败';
			exit ( json_encode ( $return_ary ) );
		}
	}
	public function writeLog($txt) {
		if(!$txt){return;}
		$filename = "houtai_proxyIp";
		$log_file = "/log/".$filename.".log";
		$handle = fopen ( $log_file, "a+" );
		$txt = "[".date ( 'Y-m-d H:i:s', time () ) . "] " .$txt;
		$str = fwrite ( $handle, $txt . "\n" );
		fclose ( $handle );
	}
	private function vipProxys(){
		$redis_config = $this->config->item ( 'redis' );
		$redis = new Redis ();
		$connFlagRedis = $redis->connect ( $redis_config ['host'], $redis_config ['port'] );
		$ipsVIP3 = $redis->get($this->VIP3_LIST_KEY);
		$ipsVIP2 = $redis->get($this->VIP2_LIST_KEY);
		$ipsVIP = $redis->get($this->VIP_LIST_KEY);
		$ips0 = $redis->get($this->NOTVIP_LIST_KEY);
		$redis->close ();
		$res = array("vip3_proxys"=>$ipsVIP3,"vip2_proxys"=>$ipsVIP2,"vip_proxys"=>$ipsVIP,"notvip_proxys"=>$ips0);
		return $res;
	}
	
}