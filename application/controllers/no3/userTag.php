<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserTag extends CI_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('userTag')) {
            redirect('no3/index');
        }
        $this->load->model('no3/User_model');
    }

    public function index() {
        $userTag = $this->User_model->userTagGet();

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
            'userTag' => $userTag
        );

        $this->load->view('no3/userTagView', $data);
    }

    public function toAdd() {
        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户标签"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户标签"
            )
        );
        $this->load->view('no3/userTagAddView', $data);
    }

    public function add() {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $autoMoney = isset($_POST['autoMoney']) ? intval($_POST['autoMoney']) : '';
        $sort = isset($_POST['sort']) ? intval($_POST['sort']) : '';

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

        $ret = $this->User_model->userTagAdd($name, $autoMoney, $sort);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '添加失败' );
            redirect ( 'no3/userTag/toAdd' );
        }

        $userTag = $this->User_model->userTagGet();
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
            'userTag' => $userTag
        );

        $this->load->view('no3/userTagView', $data);
    }

    public function toEdit() {
        $tgAccount_id = $this->uri->segment(4) ? intval($this->uri->segment(4)) : 0;
        if (!$tgAccount_id) {
            redirect('no3/tgAccount');
        }
        $priv_ary = json_decode($this->config->item('report_field'), true);
        foreach ($priv_ary as $k => $v) {
            if ($v ['key'] == 'total7' || $v ['key'] == 'total8') {
                unset ($priv_ary [$k]);
            }
        }

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "推广管理",
                "child" => "推广帐号"
            ),
            "header1" => array(
                "father" => "运维管理",
                "child" => "推广帐号"
            ),
            'promotion_user_priv' => $priv_ary,
            'channel_list' => $this->config->item('channellist'),
            'tg_account' => $this->Tg_account_model->getTgAccount('', $tgAccount_id),
            'menu_list' => $this->Tg_account_model->getMenuList()
        );
        $this->load->view('no3/userTagView', $data);
    }

    public function del() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : '';
        if (empty($id)) {
            $this->session->set_flashdata ( 'error', '没有选择id' );
            redirect ( 'no3/userTag' );
        }

        $ret = $this->User_model->userTagDel($id);
        // test
        log_message('error', 'ok11, id = ' . $id . ', ret = ' . json_encode($ret));
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