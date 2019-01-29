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
        $dateBegin = isset($_POST['beginDate']) ? trim($_POST['beginDate']) : '';
        $dateEnd = isset($_POST['endDate']) ? trim($_POST['endDate']) : '';
        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : 0;
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
            'userList' => $userList
        );

        $this->load->view('no3/userListView', $data);
    }
}