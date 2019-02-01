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

    /**
     * 用户列表
     */
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

    /**
     * 用户详情 - 获取
     */
    public function userDetailGet() {
        $userId = isset($_GET['userId']) && !empty($_GET['userId']) ? intval($_GET['userId']) : '';
        if (empty($userId) || $userId < 0) {
            $this->session->set_flashdata('error', '参数错误');

        }

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户标签"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户标签"
            ),
        );
        $this->load->view('no3/userTagEditView', $data);
    }

    /**
     * 用户详情 - 保存
     */
    public function userDetailSave() {
        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $autoMoney = isset($_POST['autoMoney']) ? intval($_POST['autoMoney']) : '';
        $sort = isset($_POST['sort']) ? intval($_POST['sort']) : '';

        if (empty($id)) {
            $this->session->set_flashdata ( 'error', '参数错误' );
            redirect ( 'no3/userTag/toAdd' );
        }
        if ($name === '') {
            $this->session->set_flashdata ( 'error', '请输入标签名称' );
            redirect ( 'no3/userTag/toAdd' );
        }
        if (empty($autoMoney)) {
            $this->session->set_flashdata ( 'error', '请选择是否自动出款' );
            redirect ( 'no3/userTag/toAdd' );
        }
        if (empty($sort)) {
            $this->session->set_flashdata ( 'error', '请输入排序' );
            redirect ( 'no3/userTag/toAdd' );
        }

        $ret = $this->User_model->userTagEdit($id, $name, $autoMoney, $sort);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '修改失败' );
            redirect ( 'no3/userTag/toAdd' );
        } else {
            $this->session->set_flashdata ( 'success', '修改成功' );
            redirect ( 'no3/userTag' );
        }
    }

    /**
     * 用户黑名单 - 添加
     */
    public function userBlackListAdd() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : '';
        if (empty($id)) {
            $this->session->set_flashdata ( 'error', '没有选择id' );
            redirect ( 'no3/userTag' );
        }

        $ret = $this->User_model->userTagDel($id);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '删除失败' );
            redirect ( 'no3/userTag' );
        } else {
            $this->session->set_flashdata ( 'success', '删除成功' );
            redirect ( 'no3/userTag' );
        }
    }

    /**
     * 用户黑名单 - 移除
     */
    public function userBlackListRemove() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : '';
        if (empty($id)) {
            $this->session->set_flashdata ( 'error', '没有选择id' );
            redirect ( 'no3/userTag' );
        }

        $ret = $this->User_model->userTagDel($id);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '删除失败' );
            redirect ( 'no3/userTag' );
        } else {
            $this->session->set_flashdata ( 'success', '删除成功' );
            redirect ( 'no3/userTag' );
        }
    }
}