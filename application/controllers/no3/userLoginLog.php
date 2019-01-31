<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserLoginLog extends CI_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('userLoginLog')) {
            redirect('no3/index');
        }
        $this->load->model('no3/User_model');
    }

    public function index() {
        $dateBegin = isset($_POST['dateBegin']) ? trim($_POST['dateBegin']) : '';
        $dateEnd = isset($_POST['dateEnd']) ? trim($_POST['dateEnd']) : '';
        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : '';
        $ip = isset($_POST['ip']) ? trim($_POST['ip']) : '';

        if ($userId) {
            $userLoginLog = $this->User_model->userLoginLogGetByUserId($dateBegin, $dateEnd, $userId, $ip);
        } else {
            $userLoginLog = $this->User_model->userLoginLogGet($dateBegin, $dateEnd, $ip);
        }

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户登录日志"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户登录日志"
            ),
            'userLoginLog' => $userLoginLog,
            'query' => [
                'dateBegin' => $dateBegin,
                'dateEnd' => $dateEnd,
                'userId' => $userId,
                'ip' => $ip
            ]
        );

        $this->load->view('no3/userLoginLogView', $data);
    }
}