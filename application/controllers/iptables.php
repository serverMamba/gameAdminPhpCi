<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iptables extends MY_Controller {

    public function __construct() {
        parent::__construct(true);
        
        $this->load->library('midware/m_poker', 'm_poker');
    }
    
    public function index() {
        echo 'your ip is:' . $this->getIP();

        $list = $this->m_poker->get_all();

        $data = array(
            'list' => $list
        );
        $this->load->view('iptables', $data);
        
    }

    public function add() {

        if ($this->gid != 1) {
            echo json_return(RESPONSE_TOKEN_ERROR, '权限不足');
            return;
        }   
        
        $ip = trim($this->input->get('ip'));
        $ret = $this->m_poker->add($ip);

        if ($ret) {
            echo json_return(RESPONSE_OK, '添加成功', array());
        } else {
            echo json_return(RESPONSE_PARAMS_ERROR, '参数错误');
        }
    }

    public function del() {
    
        $ip = trim($this->input->get('ip'));
        $ret = $this->m_poker->del($ip);

        if ($ret) {
            echo json_return(RESPONSE_OK, '添加成功', array());
        } else {
            echo json_return(RESPONSE_PARAMS_ERROR, '参数错误');
        }
    
    }


    private function getIP() {

        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
                $cip = $_SERVER["HTTP_CLIENT_IP"];
        } elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
                $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty($_SERVER["REMOTE_ADDR"])){
                $cip = $_SERVER["REMOTE_ADDR"];
        } else {
                $cip = "";
        }

        return $cip;

    }

}
