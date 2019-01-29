<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Android extends CI_Controller {
	// 品付
	var $pf_partener_id = '200950';
	var $pf_secret_key = 'hkjvgFHGyiu6ritugyJfhdte4%R^tiuyglhkjou879^*Tygfdtsew%$65876ritufd';
	public function __construct() {
		parent::__construct ();
	}
	function queryOrder() {
		$order_sn = $this->input->get ( 'agent_bill_id' );
		$pay_platform = $this->input->get ( 'pay_platform' );
		if (! $order_sn || ! $pay_platform) {
			$return_ary = array (
					'status' => 0 
			);
			exit ( json_encode ( $return_ary ) );
		}
		
		if ($pay_platform == '品付') {
			$data ['merchantId'] = $this->pf_partener_id;
			$data ['traceNO'] = $order_sn;
			$data ['sign'] = hash ( 'sha256', $data ['merchantId'] . $data ['traceNO'] . $this->pf_secret_key );
			
			$ch = curl_init ();
			// print_r($ch);
			curl_setopt ( $ch, CURLOPT_URL, 'http://api.99epay.net/mctrpc/order/queryOrderFromMerchant.htm' );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $data ) );
			$return = curl_exec ( $ch );
			curl_close ( $ch );
			// 000|{"createTime":"20161214010025","extend":"app_name=六六游戏&bundle_id=com.liuliugame1.thzjh","orderFinishTime":"20161214010102","orderId":4175401,"orderStatus":1,"orderSuccAmount":1000.00,"payments":[{"itemNum":1,"itemResponseMsg":{"localUrl":"http://api.99epay.net/fcrpc/h5Pay/weixin/4103034.htm","paySeq":"8012016121401240019808881","wxurl":"http://xyt.test.bank.ecitic.com:8000/ydsd.html?rdurl=https%3A%2F%2Fwx.tenpay.com%2Fcgi-bin%2Fmmpayweb-bin%2Fcheckmweb%3Fprepay_id%3Dwx20161214010025a137e8d9030170063973%26package%3D2330434580"},"itemStatus":1,"itemSuccAmount":1000.00}],"traceNO":"7173601481648410785919Otyf"}|49b2d0ce0047b87c679043b9d37582f2c992147c824c8d967b539b1567f03743
			
			$return_ary = explode ( '|', $return );
			if (count ( $return_ary ) != 3) {
				$return_ary = array (
						'status' => 0 
				);
				exit ( json_encode ( $return_ary ) );
			}
			
			if ($return_ary [0] != '000') {
				$return_ary = array (
						'status' => 0 
				);
				exit ( json_encode ( $return_ary ) );
			}
			
			$payment_info = json_decode ( $return_ary [1], true );
			$return_ary = array (
					'status' => '1',
					'agent_bill_id' => $payment_info ['orderId'] . '',
					'extend' => $return,
					'pay_amt' => $payment_info ['orderSuccAmount'] . '',
					'result' => $payment_info ['orderStatus'] . '' 
			);
			exit ( json_encode ( $return_ary ) );
		}
	}
	
	public function budan(){
		$data['msg'] = $this->input->post('msg');
	
		$ch = curl_init ();
		// print_r($ch);
		curl_setopt ( $ch, CURLOPT_URL, 'http://webapi.yuming.com/pay/android6/notify.html' );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $data ) );
		$return = curl_exec ( $ch );
		curl_close ( $ch );
		exit($return.'');
	}
}
