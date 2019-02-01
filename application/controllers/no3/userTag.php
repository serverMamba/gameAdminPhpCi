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
        } else {
            $this->session->set_flashdata ( 'success', '添加成功' );
            redirect ( 'no3/userTag' );
        }
    }

    public function toEdit() {
        $id = isset($_GET['id']) && !empty($_GET['id']) ? intval($_GET['id']) : '';
        $name = isset($_GET['name']) && !empty($_GET['name']) ? trim($_GET['name']) : '';
        $sort = isset($_GET['sort']) && !empty($_GET['sort']) ? intval($_GET['sort']) : '';
        $autoMoney = isset($_GET['autoMoney']) && !empty($_GET['autoMoney']) ? intval($_GET['autoMoney']) : '';

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
            'oldValue' => [
                'id' => $id,
                'name' => $name,
                'sort' => $sort,
                'autoMoney' => $autoMoney
            ]
        );
        $this->load->view('no3/userTagEditView', $data);
    }

    public function edit() {
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

    public function del() {
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