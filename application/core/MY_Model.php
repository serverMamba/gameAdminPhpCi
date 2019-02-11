<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 扩展CI的主Model类
 * 请开发人员自己的页面Model一定要继承本扩展类，而不要直接继承CI_Model
 * 
 * @author YanGf (yangf332@gmail.com)
 * @version 
 */

define('DYPATH', dirname(__FILE__)."/../models/dyconfig/");
define('DYCONFIG', dirname(__FILE__)."/../dyconfig/");

class MY_Model extends CI_Model {
    
    function __construct() {
        parent::__construct();
        
        $this->dbconfig = $this->config->item('dbconfig');
        $this->hostlist = $this->config->item('hostlist');
        $this->dbalias  = $this->config->item('dbalias');
        $this->midlayer = $this->config->item('midlayer');

    }

    protected function _get_tb_name($tbname)
    {
        $prefix = 'casino';

        //$ret = strtolower($prefix . $tbname);
        $ret = strtoupper($prefix . $tbname);

        return $ret;
    }
    
    protected function _use_read_db() {
        $this->dbconfig['hostname'] = $this->hostlist['b1'];
    } 

    protected function _use_write_db() {
        $this->dbconfig['hostname'] = $this->hostlist['m1'];
    }

    protected function _use_write_userdb($dbidx) {
        if (in_array($dbidx, explode(' ', '0 1 2 3 4 5 6 7'))) {
            $this->dbconfig['hostname'] = $this->hostlist['m1'];
        } else {
            $this->dbconfig['hostname'] = $this->hostlist['m2'];
        }
    }

    protected function _use_read_userdb($dbidx) {
        if (in_array($dbidx, explode(' ', '0 1 2 3 4 5 6 7'))) {
            $this->dbconfig['hostname'] = $this->hostlist['b1'];
        } else {
            $this->dbconfig['hostname'] = $this->hostlist['b2'];
        }
    }

    protected function _use_db($dbname) {
        $this->dbconfig['database'] = $dbname;
    }

    /*
     * 处理返回值
     */
    protected function _dealwith_ret($query) {
        if(!is_object($query) || !$query->conn_id) {
            return false;
        } else if (count($query->result_array()) > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    /**
     * 请求中间层
     * @param $buf - 
     * @param $command - 命令号
     * @param $newmidlayer array(host, port)
     * @return boolean
     */
    protected function _request_midlayer($buf, $command, $newmidlayer) {
        //require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
        $this->_require('pb_proto_pbclientgameserver');

        $pack = new Packet();
        $pack->set_version(0);
        $pack->set_command($command);
        $pack->set_serialized($buf);

        $buf_pack       = $pack->SerializeToString();
        $buf_length = sprintf('%08x', strlen($buf_pack));
        $buf_length = $this->_ntohl($buf_length); 

        $request_stream = pack('H*', $buf_length) . $buf_pack;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>3, 'usec'=>0));
        socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>3, 'usec'=>0));
        //socket_set_option($socket, SOL_SOCKET,SO_KEEPALIVE,10000);
       // $arrOpt = array('l_onoff' => 1, 'l_linger' => 1);
       // socket_set_block($socket);
       // socket_set_option($socket, SOL_SOCKET, SO_LINGER, $arrOpt);
        
        if (empty($newmidlayer)) {
            $length = count($this->midlayer);
            for ($i = 0; $i < $length; $i++) {
                try {
                    $conn = socket_connect($socket, $this->midlayer[$i]['host'], $this->midlayer[$i]['port']);
                } catch (Exception $e) {
                    log_message('error', "MY_Model | error - {$e->getMessage()}");
                }
                if ($conn) {
                    break;
                }
            }
        } else {
            $conn = socket_connect($socket, $newmidlayer['host'], $newmidlayer['port']);
        }

        if (!$conn) {
            return false;
        }

        socket_write($socket, $request_stream);

        socket_close($socket); 

        return true; 
    } 

    /*
     * 请求中间层并解析响应
     * @param $buf - 
     * @param $command - 命令号
     * @return $ret [stream]
     */
    public function _request_midlayer_res1($buf, $command,$host,$port) {
        // test
        log_message('error',__METHOD__ . ', ' . __LINE__ . ', ok20');
        //require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
        $this->_require('pb_proto_pbclientgameserver');
        $pack = new Packet();
        $pack->set_version(0);
        $pack->set_command($command);
        $pack->set_connectionid("99");
        $pack->set_serialized($buf);
        $buf_pack   = $pack->SerializeToString();

        $buf_length = sprintf('%08x', strlen($buf_pack));
        $buf_length = $this->_ntohl($buf_length); 

        $request_stream = pack('H*', $buf_length) . $buf_pack;

        // test
        log_message('error',__METHOD__ . ', ' . __LINE__ . ', ok21');
//        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        // test
        log_message('error',__METHOD__ . ', ' . __LINE__ . ', ok22');

        socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>20, 'usec'=>0));
        socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>20, 'usec'=>0));

        $conn = socket_connect($socket, $host, $port);

         if (!$conn) {
            exit("socket connect error");
            return false;
        }
		$res =socket_write($socket, $request_stream);
		// test
		log_message('error', __METHOD__ . ', ' . __LINE__ . ', res = ' . $res);
        if(!$res){
        	  $errorcode = socket_last_error();
        	$errormsg = socket_strerror($errorcode);
        
        	die("Couldn't create socket: [$errorcode] $errormsg");
        }
      //  sleep(10);

        if (!$conn) {
         	exit ('connet fail');
            return false;
        }
        
  
        
//         if ($socket === false) {
//         	$errorcode = socket_last_error();
//         	$errormsg = socket_strerror($errorcode);
        
//         	die("Couldn't create socket: [$errorcode] $errormsg");
//         }
      //  socket_set_block($socket);
       // socket_set_noblock($socket);

        $read_length = socket_read($socket, 4);
        // test
        log_message('error', __METHOD__ . ', ' . __LINE__ . ', read_length = ' . $read_length . ', json = ' . json_encode($read_length));
        
      //  print_r($read_length);
        
        
      //  print_r($read_length);
        
         if (strlen($read_length) <= 0) {
            $errorcode = socket_last_error();
            $errormsg = socket_strerror($errorcode); 
        //    echo $errorcode ,"---",$errormsg,"---",'no response';
   
            return false;
        } 

        $read_length = unpack('H*', $read_length);
        $read_length = $read_length[1];
        $buf_length = base_convert($this->_ntohl($read_length), 16, 10);
        $response_stream = socket_read($socket, $buf_length);

        $response_pack = new Packet();
        $response_pack->ParseFromString($response_stream);
      //  print_r($response_pack);
        $ret = $response_pack->serialized();
        socket_close($socket); 

        return $ret ; 
    } 
    
     protected function _request_midlayer_restaiguo($buf, $command) {
        //require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
        $this->_require('pb_proto_pbclientgameserver');
        $pack = new Packet();
        $pack->set_version(0);
        $pack->set_command($command);
        $pack->set_serialized($buf);

        $buf_pack   = $pack->SerializeToString();

        $buf_length = sprintf('%08x', strlen($buf_pack));
        $buf_length = $this->_ntohl($buf_length); 

        $request_stream = pack('H*', $buf_length) . $buf_pack;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>1, 'usec'=>0));
        socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>1, 'usec'=>0));
        
        $length = count($this->midlayer);
        for ($i = 0; $i < $length; $i++) {
            try {
                $conn = socket_connect($socket,"202.170.122.15", $this->midlayer[$i]['port']);
            } catch (Exception $e) {
                log_message('error', "MY_Model | error - {$e->getMessage()}");
            }
            
            if ($conn) {
                break;
            }
        }
        
//         $conn = socket_connect($socket, $this->midlayer['host'], $this->midlayer['port']);
        
        socket_write($socket, $request_stream);

        if (!$conn) {
            //echo 'connet fail';
            return false;
        }

        $read_length = socket_read($socket, 4);
        if (strlen($read_length) <= 0) {
            //echo 'no response';
            return false;
        } 

        $read_length = unpack('H*', $read_length);
        $read_length = $read_length[1];
        $buf_length = base_convert($this->_ntohl($read_length), 16, 10);
        $response_stream = socket_read($socket, $buf_length);

        $response_pack = new Packet();
        $response_pack->ParseFromString($response_stream);

        $ret = $response_pack->serialized();
        socket_close($socket); 

        return $ret; 
    } 
    
    protected function _request_midlayer_res($buf, $command) {
        //require_once(APPPATH . "third_party/proto/pb_proto_packet.php");
        $this->_require('pb_proto_pbclientgameserver');
        $pack = new Packet();
        $pack->set_version(0);
        $pack->set_command($command);
        $pack->set_serialized($buf);

        $buf_pack   = $pack->SerializeToString();

        $buf_length = sprintf('%08x', strlen($buf_pack));
        $buf_length = $this->_ntohl($buf_length); 

        $request_stream = pack('H*', $buf_length) . $buf_pack;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>1, 'usec'=>0));
        socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>1, 'usec'=>0));
        
        $length = count($this->midlayer);

        // test
        log_message('error', 'midlayer = ' . json_encode($this->midlayer));

        for ($i = 0; $i < $length; $i++) {
            try {
                $conn = socket_connect($socket, $this->midlayer[$i]['host'], $this->midlayer[$i]['port']);
            } catch (Exception $e) {
                log_message('error', "MY_Model | error - {$e->getMessage()}");
            }
            
            if ($conn) {
                break;
            }
        }
        
//         $conn = socket_connect($socket, $this->midlayer['host'], $this->midlayer['port']);
        
        socket_write($socket, $request_stream);

        if (!$conn) {
            //echo 'connet fail';
            return false;
        }

        $read_length = socket_read($socket, 4);
        if (strlen($read_length) <= 0) {
            //echo 'no response';
            return false;
        } 

        $read_length = unpack('H*', $read_length);
        $read_length = $read_length[1];
        $buf_length = base_convert($this->_ntohl($read_length), 16, 10);
        $response_stream = socket_read($socket, $buf_length);

        $response_pack = new Packet();
        $response_pack->ParseFromString($response_stream);

        $ret = $response_pack->serialized();
        socket_close($socket); 

        return $ret; 
    } 
    
    private function _socket($host, $port) {
        
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die('Could not create socket');
        socket_set_option($socket, SOL_SOCKET,SO_RCVTIMEO, array('sec'=>1, 'usec'=>0));
        socket_set_option($socket, SOL_SOCKET,SO_SNDTIMEO, array('sec'=>3, 'usec'=>0));
        $conn = socket_connect($socket, $host, $port);
        
        return $socket;
    }

    /*  
     * 加载proto文件
     */
    protected function _require($filename) {
        require_once(APPPATH . "third_party/proto/$filename.php");
    }  
    
    /*  
     * 高低位字节序转换 
     */
    private function _ntohl($n) {
        $ret = substr($n, 6, 2) . substr($n, 4, 2) . substr($n, 2, 2) . substr($n, 0, 2); 
        return $ret;
    }
}
