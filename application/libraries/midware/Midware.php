<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 中间层请求通用类
 * 本类可以单独实例化并用以调试某中间层
 * 
 * @author ARTFANTASY (artfantasy@gmail.com)
 * @version 2011.03.11 17:41
 */


class Midware {
	public $debug = false;		//是否开启DEBUG模式，开启将会打印很多信息
	public $host = '';			//中间层IP
	public $port = '';			//中间层端口号
	public $ctime = 0.7;		//连接超时设置，可为浮点数
	public $ptime = 1;			//读写超时设置，可为浮点数
	
	// ------------------------------------------------------------------------

	/**
	 * 构造函数
	 * 
	 * @param array $config 中间层配置信息， array('debug'=>xxx,'host'=>'xxx','port'=>'xxx');
	 */
	public function __construct($config = array()) {
		$default_config = array(
			'debug', 'host', 'port', 'ctime','ptime'
		);
		
		foreach($default_config as $var) {
			if(array_key_exists($var, $config)) {
				if($var == 'debug') $this->debug = ($this->debug || $config[$var]); //DEBUG模式可以由参数传入开启，也可由本类强制开启
				else $this->$var = $config[$var];
			}
		}
	}
	
	/**
	 * 发起中间层标准协议请求
	 * 生成中间层标准请求字节流，并调用SOCKET接口发起请求，接收响应结果，并进行解析
	 * $parse_detail参数主要用在中间层返回的结果集是多条记录时使用
	 * 
	 * @param string $protocol 请求协议号
	 * @param array $request_array 请求数组，数组的键值顺序需要按照中间层给出的文档顺序排列，否则会出错
	 * @param string $hash_key 散列KEY，中间层用来作数据库散列用，一般传入用户ID即可，不传或为空字符串时会随便用一个整数代替
	 * @param mixed $parse_detail 是否将结果集解析为详细数组，可传入响应数组中的键位，如设置为true, 默认是第4位（也就是相当于传了3)，传0或false将不解析
	 * @return mixed false or 中间层响应后PHP解析后的结果
	 */
	public function request($protocol, $request_array = array(), $hash_key = '', $parse_detail= false) {
		if(!is_array($request_array)) {
			return $this->debug ? __FILE__ . ': LINE ' . __LINE__ . ': Result: false' : false;
		}
		
		if($hash_key === '') {
			$hash_key = rand(1,1000);
		}
		
		array_unshift($request_array, $protocol, $hash_key);
		
		$stream  = '';
		foreach($request_array as $str) {
			$stream .= sprintf("%06x",strlen($str)) . $str;	
		}
		$stream = sprintf("%06x",strlen($stream)) . $stream;
		
		if($this->debug) {
			echo 'SEND:' . $stream . '<br /><br />';
		}
		
		$error_msg = null;


		$buff = $this->send_tcp_stream($this->host, $this->port, $stream, $error_msg, $this->ctime, $this->ptime);

		if($this->debug) {
			echo 'RESP:' . strval($buff) . '<br /><br />';
			if($buff == false) {
				echo 'Error:' . strval($error_msg) . '<br /><br />';
			}
		}
		
		if($buff == false) {
			return false;
		}
		
		$result = $this->parse_buff_to_array($buff, $parse_detail);
		if($this->debug) {
			echo 'RESU:';
			var_dump($result);
			echo '<br /><br />';
		}
		
		return $result;
	}
	
	/**
	 * 调用中间层存储过程
	 * 
	 * 存储过程参数示例
	 * $params = array(
	 * 		'v1' => array('str', 'in', $account),
	 * 		'v2' => array('str', 'in', $password),
	 * 		'v3' => array('int', 'in', $state),
	 * 		'v4' => array('str', 'in', $email),
	 * 		'v5' => array('str', 'out'),
	 * 		'v6' => array('int', 'out')
	 *	)
	 * 
	 * @param string $protocol 请求协议号
	 * @param string $procedure 存储过程名
	 * @param array $params 存储过程参数，数组的键值顺序需要按照中间层给出的文档顺序排列，否则会出错
	 * @param string $hash_key 散列KEY
	 * @param mixed $parse_detail 是否需要将结果集本身解析为详细数组
	 * @return mixed false or 中间层响应后PHP解析后的结果
	 */
	public function request_stored_procedure($protocol, $procedure, $params, $hash_key = '', $parse_detail = false) {
		if(!is_array($params)) {
			return $this->debug ? __FILE__ . ': LINE ' . __LINE__ . ': Result: false' : false;	
		}
		
		$p = '';
	    foreach ($params as $key => $value) {
	        if ($p == '') {
	            $p = ":{$key}";
	        } else {
	            $p .= ",:{$key}";
	        }
	    }
	    $call = "begin $procedure($p);end;";
	    
	    $extra_params = array ($call);
	    foreach ($params as $key => $item) {
	        if ($item[1] == 'in') {
	            $extra_params[] = $item[0];
	            $extra_params[] = 'in';
	            $extra_params[] = $item[2];
	        } else {
	            $extra_params[] = $item[0];
	            $extra_params[] = 'out';
	        }
	    }
	    
	    return $this->request($protocol, $extra_params, $hash_key, $parse_detail);
	}
	
	/**
	 * 将中间层返回的字节流解析为数组
	 * 
	 * @param string $buff 中间层响应字节流
	 * @param mixed $parse_detail 是否需要将结果集本身解析为详细数组
	 * @return mixed false or array
	 */
	public function parse_buff_to_array($buff, $parse_detail = false) {		
		$pos = 0;
		$stream_len = strlen($buff);
		$len_fmt = '%06x';
	
		if ( $pos == $stream_len ) {
			return $this->debug ? __FILE__ . ': LINE ' . __LINE__ . ': Result: false' : false;
		}
	
		sscanf(substr($buff, $pos, 6), $len_fmt, $len);
		$pos += 6;
	
		if ( $len == 0 ) {
			return $this->debug ? __FILE__ . ': LINE ' . __LINE__ . ': Result: false' : false;
		}
	
		if($stream_len != $len + 6) {
			var_dump($stream_len, $len);
			return $this->debug ? __FILE__ . ': LINE ' . __LINE__ . ': Result: false' : false;
		}
		
		$result = array();
		while($pos < $stream_len) {
			sscanf(substr($buff, $pos, 6), $len_fmt, $len);
			$pos += 6;
			if($len == 0) {
				$result[] = '';
			} else {
				$result[] = substr($buff, $pos, $len);
				$pos += $len;
			}
		}
		
		//$parse_detail不为0和false时，需要解析结果集
		if($parse_detail != false) {
			$parse_detail = is_numeric($parse_detail) ? $parse_detail : 3;
			if(array_key_exists($parse_detail, $result)) {
				$result[$parse_detail] = $this->parse_detail_info($result[$parse_detail]);
			}
		}
		
		return $result;
	}
	
	public function parse_detail_info($stream_body) {
		$flow_midware_result = array();
	
		$pos = 0;
		$stream_body_len = strlen($stream_body);
		$len_fmt = '%06x';
	
		while ( $pos < $stream_body_len ) {
	
			sscanf(substr($stream_body, $pos, 6), $len_fmt, $len);
			$pos += 6;
	
			if ( $len == 0 ) {
				$flow_midware_result[] = '';
				continue;
			}
	
			$sub_stream_body_len = intval(substr($stream_body, $pos, $len));
			$pos += $len;
	
			if ( $sub_stream_body_len == 0 ) {
				$flow_midware_result[] = '';
				continue;
			}
	
			$sub_stream_body = substr($stream_body, $pos, $sub_stream_body_len);
			$pos += $sub_stream_body_len;
	
			$sub_pos = 0;
			$sub_result = array();
			while ( $sub_pos < $sub_stream_body_len ) {
				sscanf(substr($sub_stream_body, $sub_pos, 6), $len_fmt, $len);
				$sub_pos += 6;
	
				if ( $len == 0 ) {
					$sub_result[] = '';
				}
				else {
					$sub_result[] = substr($sub_stream_body, $sub_pos, $len);
					$sub_pos += $len;
				}
			}
	
			$flow_midware_result[] = $sub_result;
		}

		return $flow_midware_result;
	}
	
	/**
	 * 物理socket连接处理函数
	 * 
	 * @param string $host 连接服务器ip
	 * @param int $port 对应服务器的端口
	 * @param string $stream 需要发送的SOCKET字节流
	 * @param float $ctime 链接超时；此参数为浮点数，如1, 1.0, 1.2均可
	 * @param float $ptime 读写超时；格式和$ctime相同
	 * @param string $error_msg 错误描述
	 * @return 成功返回服务端的返回数据；失败返回false，参数$error_msg指出当前的错误描述
	 */
	public function send_tcp_stream($host, $port, $stream, &$error_msg, $ctime = 0.7, $ptime = 1, $not_sixbyte = false) {
		$sock = $this->socket_connect($host, $port, $ctime, $ptime, $error_msg);
		if ($sock == false) {
			return false;
		}
		
		$result = $this->socket_write($sock, $host, $port, $stream, $error_msg);
		if ($result == false) {
			socket_close($sock);
			return false;
		}
		
		if($not_sixbyte) {
			$response = $this->socket_read($sock, $host, $port, $error_msg);
		}  else {
			$response = $this->socket_read_by_sixbyte($sock, $host, $port, $error_msg);
		}
		
		if ($response == false) {
			socket_close($sock);
			return false;
		}
		socket_close($sock);
		
		return $response;
	}
	
    private function socket_connect($host, $port, $ctime, $ptime, &$error_msg) {
        error_reporting(0); 
	    $sock = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	    if(!$sock) {
	        $error_msg = "Failed to create socket: $host : $port " . socket_strerror(socket_last_error($sock));
	        return false;
	    }
	
	    socket_set_nonblock($sock);
	    @socket_connect($sock, $host, $port);
	    socket_set_block($sock);
	    $fd_read = array($sock);
	    $fd_write = array($sock);
	    $except = null;
	    $ret = @socket_select($fd_read, $fd_write, $except, floor($ctime), fmod($ctime, 1) * 1000000);
	    if($ret != 1) {
	        if ($ret == 0) {
	        	$error_msg = "Connection timeout: $host : $port " . socket_strerror(socket_last_error($sock));
	        } elseif ($ret == 2) {
	        	$error_msg = "Connection refused: $host : $port " . socket_strerror(socket_last_error($sock));
	        } else {
	        	$error_msg = socket_strerror(socket_last_error($sock)) . ": $host : $port";
	        }
			socket_close($sock);
	        return false;
	    }
	
		// 分别设置读写超时
	    socket_set_option($sock, SOL_SOCKET, SO_SNDTIMEO, array("sec" =>floor($ptime), "usec" => fmod($ptime, 1) * 1000000));
	    socket_set_option($sock, SOL_SOCKET, SO_RCVTIMEO, array("sec" =>floor($ptime), "usec" => fmod($ptime, 1) * 1000000));
		
		return $sock;
	}
	
	private function socket_write($sock, $host, $port, $stream, &$error_msg) {
	    $written_len = 0; // 已经写的长度
	    $counter = 0; // 循环写的次数，最多循环20次写
	    $content = $stream;
	    do {
		    $written = @socket_write($sock, $content, strlen($content));
		    if (false === $written) {
		        $error_msg = "Failed to write data on the socket: $host : $port " . socket_strerror(socket_last_error($sock));
		        return false;
		    }
		    $written_len += $written;
		    $counter++;
		    if ($counter > 20) {
	        	$error_msg = "Exceed 20 time while writing data on socket: $host : $port " . socket_strerror(socket_last_error($sock));
		    	return false;
		    }
		    if ($written < strlen($stream)) {
		    	$content = substr($stream, $written_len);
		    }
	    } while ($written_len < strlen($stream));
	    
	    return true;
	}
	
	private function socket_read($sock, $host, $port, &$error_msg) {
	    $str = @socket_read($sock, 8190);
	    if ($str == false) { // 接收数据错误或者不完成
			$error_msg = "Failed to read data on the socket: $host : $port " . socket_strerror(socket_last_error($sock));
			return false;
	    }
	    
		return $str;
	}
	
	private function socket_read_by_sixbyte($sock, $host, $port, &$error_msg) {
		$lenstr = @socket_read($sock, 6);
		
		if( $lenstr == false ) {
			$error_msg = "socket_read:".socket_strerror(socket_last_error());
			return false;
		}
		
		$len = hexdec($lenstr);
		
		if($len == 0) {
			$error_msg = "socket_read head".socket_strerror(socket_last_error());
			return false;
		}
		
		$defReadBufSize = 1024;
		$hasread = 0;
		$recvbuf = $lenstr;
	
		do{
			$len_unrecv = $len - $hasread;
			if($len_unrecv < $defReadBufSize)
			{
				$defReadBufSize = $len_unrecv;
			}
	
			$res = @socket_read($sock, $defReadBufSize);
			if ($res === false) {
				$error_msg = "socket_read body".socket_strerror(socket_last_error());
				return false;
			}
			
			$hasread += strlen($res);
			$recvbuf = $recvbuf . $res;
		} while ($hasread < $len);
		
		return $recvbuf;
	}

	public function ignore_len($str) {
		$pos = 0;
		sscanf(substr($str, $pos, 6), '%06x', $len);
		$pos += 6;
		sscanf(substr($str, $pos, $len), '%s', $new);
		$pos += $len;

		sscanf(substr($str, $pos, 6), '%06x', $len);
		$pos += 6;
		sscanf(substr($str, $pos, $len), '%s', $new);

		return $new;
	}
}
