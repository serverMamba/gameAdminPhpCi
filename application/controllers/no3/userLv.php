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
            'menu_list' => $this->Tg_account_model->getMenuList()
        );
        $this->load->view('no3/userLoginLogView', $data);
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
        $this->load->view('no3/tg_account_info_views', $data);
    }

    public function add() {
        $data ['account'] = trim($this->input->post('account', true));
        if ($data ['account'] == '' || strlen($data ['account']) > 200) {
            $this->session->set_flashdata('error', '请输推广账号');
            redirect('no3/tgAccount/toAdd');
        }
        if ($data ['account'] != str_replace(" ", "", $data ['account'])) {
            $this->session->set_flashdata('error', '推广账号由字母及数字组成，不可夹杂空格等非法字符！');
            redirect('no3/tgAccount/toAdd');
        }

        $data ['pass'] = trim($this->input->post('pass1', true));
        $pass2 = trim($this->input->post('pass2', true));
        $data ['status'] = trim($this->input->post('status', true));
        $data ['add_time'] = time();

        if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
            $this->session->set_flashdata('error', '密码错误,请重新输入');
            redirect('no3/tgAccount/toAdd');
        }

        $tgAccount = $this->Tg_account_model->getTgAccount($data ['account']);
        if (!empty ($tgAccount)) {
            $this->session->set_flashdata('error', '该账号已经存在,请输入其他账号');
            redirect('no3/tgAccount/toAdd');
        }
        $data ['channel_name'] = trim($this->input->post('channel_name', true));
        $data ['host'] = str_replace('http://', '', trim($this->input->post('host', true)));

        $field_priv = $this->input->post('field_priv', true);
        if (empty ($field_priv)) {
            $field_priv = array();
        }
        $data ['priv'] = json_encode($field_priv);

        $channel_priv = $this->input->post('channel_priv', true);
        if (empty ($channel_priv)) {
            $channel_priv = array();
        }
        $data ['channel_priv'] = json_encode($channel_priv);

        if ($this->Tg_account_model->insertTgAccount($data)) {
            $this->session->set_flashdata('success', '添加成功 ');
            redirect('no3/tgAccount');
        } else {
            $this->session->set_flashdata('error', '添加失败');
            redirect('no3/tgAccount');
        }
    }

    public function edit() {
        $tgAccount_id = $this->uri->segment(4) ? intval($this->uri->segment(4)) : 0;
        if (!$tgAccount_id) {
            redirect('no3/tgAccount');
        }

        $data ['account'] = trim($this->input->post('account', true));
        if ($data ['account'] == '' || strlen($data ['account']) > 200) {
            $this->session->set_flashdata('error', '请输入推广账号');
            redirect('no3/tgAccount/toEdit/' . $tgAccount_id);
        }
        if ($data ['account'] != str_replace(" ", "", $data ['account'])) {
            $this->session->set_flashdata('error', '推广账号由字母及数字组成，不可夹杂空格等非法字符！');
            redirect('no3/tgAccount/toEdit/' . $tgAccount_id);
        }

        $pass = trim($this->input->post('pass1', true));
        $pass2 = trim($this->input->post('pass2', true));
        $data ['status'] = trim($this->input->post('status', true));

        if ($pass != '') {
            $data ['pass'] = $pass;
            if ($data ['pass'] == '' || $data ['pass'] != $pass2) {
                $this->session->set_flashdata('error', '密码错误,请重新输入');
                redirect('no3/tgAccount/toEdit/' . $tgAccount_id);
            }
        }

        $data ['channel_name'] = trim($this->input->post('channel_name', true));
        $data ['host'] = str_replace('http://', '', trim($this->input->post('host', true)));

        $field_priv = $this->input->post('field_priv', true);
        if (empty ($field_priv)) {
            $field_priv = array();
        }
        $data ['priv'] = json_encode($field_priv);

        $channel_priv = $this->input->post('channel_priv', true);
        if (empty ($channel_priv)) {
            $channel_priv = array();
        }
        $data ['channel_priv'] = json_encode($channel_priv);

        $tgAccount = $this->Tg_account_model->getTgAccount($data ['account']);
        if (!empty ($tgAccount) && $tgAccount ['id'] != $tgAccount_id) {
            $this->session->set_flashdata('error', '该账号已经存在,请输入其他账号');
            redirect('no3/tgAccount/toEdit/' . $tgAccount_id);
        }
        if ($this->Tg_account_model->updateTgAccount($tgAccount_id, $data)) {
            $this->session->set_flashdata('success', '修改成功 ');
            redirect('no3/tgAccount');
        } else {
            $this->session->set_flashdata('error', '修改失败');
            redirect('no3/tgAccount');
        }
    }
}