<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//通用错误码返回
if(!defined('RESPONSE_OK')) 				define('RESPONSE_OK', 1);
if(!defined('RESPONSE_SYSTEM_BUSY')) 		define('RESPONSE_SYSTEM_BUSY', 0);
if(!defined('RESPONSE_UN_LOGIN')) 			define('RESPONSE_UN_LOGIN', -1);
if(!defined('RESPONSE_PARAMS_ERROR')) 		define('RESPONSE_PARAMS_ERROR', -2);
if(!defined('RESPONSE_TOKEN_ERROR'))		define('RESPONSE_TOKEN_ERROR', -3);
if(!defined('RESPONSE_NO_EXISTS_ACCOUNT'))	define('RESPONSE_NO_EXISTS_ACCOUNT', -4);
if(!defined('RESPONSE_UNKNOWN_ERROR'))		define('RESPONSE_UNKNOWN_ERROR', -99);
if(!defined('RESPONSE_MAIL_ERROR'))		define('RESPONSE_MAIL_ERROR', 2);

if(!function_exists('js_alert')) {
	function js_alert($msg, $go_method = 'back', $other = '') {
		$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . "\n";
		$html .= '<script type="text/javascript">' . "\n";
		$html .= 'alert("'. addslashes($msg) .'");' . "\n";
		$html .= (($go_method == 'back'  || empty($other)) ? 'history.back();' : ($go_method == 'url' ? 'location.href="'. $other .'";' : $other)) . "\n";
		$html .= '</script>';
		return $html;
	}
}

if(!function_exists('jsonp_return')) {
	function jsonp_return($callback, $return_code = RESPONSE_SYSTEM_BUSY, $msg = '', $data = array()) {
		$response = array('result' => $return_code, 'msg'=> $msg, 'data' => $data);
		return $callback . '(' . json_encode($response) . ');';
	}
}

if(!function_exists('json_return')) {
	function json_return($return_code = RESPONSE_SYSTEM_BUSY, $msg = '', $data = array()) {
		$response = array('result' => $return_code, 'msg'=> $msg, 'data' => $data);
		return json_encode($response);
	}
}

if(!function_exists('js_echo')) {
	function js_echo($js, $js_files = array(), $css_files = array()) {
		$html = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />' . "\n";
		
		if(is_array($css_files)) {
			foreach($css_files as $var) {
				$html .= '<link rel="stylesheet" href="'. base_url() .'css/'. $var .'.css?v=' . CSS_VERSION . '" type="text/css" />';
			}
		}
		
		if(is_array($js_files)) {
			foreach($js_files as $var) {
				$html .= '<script type="text/javascript" src="'. base_url() .'js/'. $var .'.js?v=' . JS_VERSION . '"></script>';
			}
		}

		$html .= '<script type="text/javascript">' . "\n";
		$html .= $js;
		$html .= '</script>';
		return $html;
	}
}
