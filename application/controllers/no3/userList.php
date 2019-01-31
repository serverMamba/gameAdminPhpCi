<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserList extends CI_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('userList')) {
            redirect('no3/index');
        }
        $this->load->model('no3/User_model');
    }

    public function index() {
        $dateBegin = isset($_POST['dateBegin']) ? trim($_POST['dateBegin']) : '';
        $dateEnd = isset($_POST['dateEnd']) ? trim($_POST['dateEnd']) : '';
        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : '';
        $account = isset($_POST['account']) ? trim($_POST['account']) : '';

        $mobileNumber = isset($_POST['mobileNumber']) ? trim($_POST['mobileNumber']) : '';
        $realName = isset($_POST['realName']) ? trim($_POST['realName']) : '';
        $aliPayAccount = isset($_POST['aliPayAccount']) ? trim($_POST['aliPayAccount']) : '';

        if ($userId) {
            $user = $this->User_model->userGet($userId, $dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount);
            $userList = !empty($user) ? [$user] : [];
        } else {
            $userList = $this->User_model->userListGet($dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount);
        }

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户列表"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户列表"
            ),
            'userList' => $userList,
            'query' =>[
                'dateBegin' => $dateBegin,
                'dateEnd' => $dateEnd,
                'userId' => $userId,
                'account' => $account,

                'mobileNumber' => $mobileNumber,
                'realName' => $realName,
                'aliPayAccount' => $aliPayAccount
            ]
        );

        $this->load->view('no3/userListView', $data);
    }
}