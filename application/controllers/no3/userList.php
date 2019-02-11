<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserList extends CI_Controller {
    const sealIp = 1; // 封/解ip
    const sealMac = 2; // 封/解mac
    const sealUser = 3; // 封/解user

    const sealStatusYes = 1; // 封印状态 - 封
    const sealStatusNo = 2; // 封印状态 - 未封

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
            'query' => [
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

        // 用户详情
        $userDetail = $this->User_model->userDetailGet($userId);

        // 用户标签
        $userTag = [];
        $rows = $this->User_model->userTagGet();
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $userTag[$row['id']] = $row['name'];
            }
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
            'userDetail' => $userDetail,
            'userTag' => $userTag
        );
        $this->load->view('no3/userDetailView', $data);
    }

    /**
     * 用户详情 - 保存
     */
    public function ajaxUserDetailSave() {
        // 用户基础信息
        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : '';
        $realName = isset($_POST['realName']) ? trim($_POST['realName']) : '';
        $mobileNumber = isset($_POST['mobileNumber']) ? intval($_POST['mobileNumber']) : '';
        $userTag = isset($_POST['userTag']) ? intval($_POST['userTag']) : '';
        $note = isset($_POST['note']) ? intval($_POST['note']) : '';

        // 账户信息
        $aliPayAccount = isset($_POST['mobileNumber']) ? intval($_POST['mobileNumber']) : '';

        // 用户权限设置
        $userCharge = isset($_POST['userCharge']) ? intval($_POST['userCharge']) : '';
        $userTakeMoney = isset($_POST['userTakeMoney']) ? intval($_POST['userTakeMoney']) : '';
        $userBet = isset($_POST['userBet']) ? intval($_POST['userBet']) : '';
        $accountBalance = isset($_POST['accountBalance']) ? intval($_POST['accountBalance']) : '';

        if ($userId === '' || $userId <= 0) {
            $this->session->set_flashdata('error', '参数错误');
            redirect('no3/userList/userDetailView');
        }

        $ret = $this->User_model->userDetailSave($userId, $realName, $mobileNumber, $aliPayAccount);

        // test
        log_message('error', 'ret = ' . json_encode($ret));
        if (!$ret) {
            exit(json_encode([
                'status' => '0',
                'msg' => '修改失败'
            ]));
        } else {
            exit(json_encode([
                'status' => '1',
                'msg' => '修改成功'
            ]));
        }
    }

    /**
     * 黑名单 - 封
     */
    public function blacklistSeal() {
        $userId = isset($_GET['id']) ? intval($_GET['id']) : '';
        if (empty($userId)) {
            $this->session->set_flashdata('error', '没有选择userId');
            redirect('no3/userList');
        }

        $this->load->model('detail_model');
        $ret = $this->detail_model->add_blacklist(self::sealUser, $userId, '');
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata('error', '封账号失败');
            redirect('no3/userList');
        } else {
            $this->session->set_flashdata('success', '封账号成功');
            redirect('no3/userList');
        }
    }

    /**
     * 黑名单 - 解封
     */
    public function blacklistUnseal() {
        $userId = isset($_GET['id']) ? intval($_GET['id']) : '';
        if (empty($userId)) {
            $this->session->set_flashdata('error', '没有选择userId');
            redirect('no3/userList');
        }

        $this->load->model('detail_model');
        $ret = $this->detail_model->del_blacklist(self::sealUser, $userId);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata('error', '解封账号失败');
            redirect('no3/userList');
        } else {
            $this->session->set_flashdata('success', '解封账号成功');
            redirect('no3/userList');
        }
    }

    // ====

    /**
     * 获取玩家封印状态
     * @param $userId
     * @return mixed
     */
    public function getUserSealStatus($userId) {
        $this->load->model('User_model');
        return $this->User_model->getUserSealStatus($userId);
    }
}