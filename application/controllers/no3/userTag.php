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
}