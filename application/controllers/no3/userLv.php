<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserLv extends CI_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('userLv')) {
            redirect('no3/index');
        }
        $this->load->model('no3/User_model');
    }

    public function index() {
        $userLvList = $this->User_model->userLvGetList();

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            ),
            'userLvList' => $userLvList
        );

        $this->load->view('no3/userLvView', $data);
    }

    public function toAdd() {
        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            )
        );
        $this->load->view('no3/userLvAddView', $data);
    }

    public function add() {
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $upPrice = isset($_POST['upPrice']) ? intval($_POST['upPrice']) : '';
        $templateId = isset($_POST['templateId']) ? intval($_POST['templateId']) : '';
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';

        if ($name === '') {
            $this->session->set_flashdata ( 'error', '请输入等级名称' );
            redirect ( 'no3/userLv/toAdd' );
        }
        if ($upPrice === '') {
            $this->session->set_flashdata ( 'error', '请输入晋升条件' );
            redirect ( 'no3/userLv/toAdd' );
        }
        if (empty($templateId)) {
            $this->session->set_flashdata ( 'error', '请选择稽核模板' );
            redirect ( 'no3/userLv/toAdd' );
        }

        $ret = $this->User_model->userLvAdd($name, $upPrice, $templateId, $note);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '添加失败' );
            redirect ( 'no3/userLv/toAdd' );
        } else {
            $this->session->set_flashdata ( 'success', '添加成功' );
            redirect ( 'no3/userLv' );
        }
    }

    public function toEdit() {
        $id = isset($_GET['id']) && !empty($_GET['id']) ? intval($_GET['id']) : '';
        $name = isset($_GET['name']) ? trim($_GET['name']) : '';
        $upPrice = isset($_GET['upPrice']) ? intval($_GET['upPrice']) : '';
        $templateId = isset($_GET['templateId']) ? intval($_GET['templateId']) : '';
        $note = isset($_GET['note']) ? trim($_GET['note']) : '';

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户等级"
            ),
            'oldValue' => [
                'id' => $id,
                'name' => $name,
                'upPrice' => $upPrice,
                'templateId' => $templateId,

                'note' => $note
            ]
        );
        $this->load->view('no3/userLvEditView', $data);
    }

    public function edit() {
        $id = isset($_POST['id']) ? intval($_POST['id']) : '';
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $upPrice = isset($_POST['upPrice']) ? intval($_POST['upPrice']) : '';
        $templateId = isset($_POST['templateId']) ? intval($_POST['templateId']) : '';
        $note = isset($_POST['note']) ? trim($_POST['note']) : '';

        if (empty($id)) {
            $this->session->set_flashdata ( 'error', '参数错误' );
            redirect ( 'no3/userLv/toEdit' );
        }
        if ($name === '') {
            $this->session->set_flashdata ( 'error', '请输入标签名称' );
            redirect ( 'no3/userLv/toEdit' );
        }
        if ($upPrice === '') {
            $this->session->set_flashdata ( 'error', '请输入晋升条件' );
            redirect ( 'no3/userLv/toEdit' );
        }
        if (empty($templateId)) {
            $this->session->set_flashdata ( 'error', '请选择出款稽核模板' );
            redirect ( 'no3/userLv/toEdit' );
        }

        $ret = $this->User_model->userLvEdit($id, $name, $upPrice, $templateId, $note);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, param = ' . json_encode($_POST));
            $this->session->set_flashdata ( 'error', '修改失败' );
            redirect ( 'no3/userLv/toEdit' );
        } else {
            $this->session->set_flashdata ( 'success', '修改成功' );
            redirect ( 'no3/userLv' );
        }
    }
}