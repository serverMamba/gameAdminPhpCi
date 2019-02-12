<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class UserBetRecord extends CI_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('userBetRecord')) {
            redirect('no3/index');
        }
        $this->load->model('no3/User_model');
    }

    public function index() {
        $dateBegin = isset($_POST['dateBegin']) ? trim($_POST['dateBegin']) : '';
        $dateEnd = isset($_POST['dateEnd']) ? trim($_POST['dateEnd']) : '';
        $gameId = isset($_POST['gameId']) ? intval(intval($_POST['gameId'])) : -1;
        $baseScore = isset($_POST['baseScore']) ? $_POST['baseScore'] : '';

        $userId = isset($_POST['userId']) ? intval($_POST['userId']) : '';

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $finalRet = [];
        $finalRet = $this->User_model->betRecordGet($dateBegin, $dateEnd, $gameId, $baseScore, $userId, $start, $per);
        $betRecord = $finalRet['content'];
        $totalNum = $finalRet['totalNum'];

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "用户管理",
                "child" => "用户投注记录"
            ),
            "header1" => array(
                "father" => "用户管理",
                "child" => "用户投注记录"
            ),
            'betRecord' => $betRecord
        );

        $this->load->library('pagination');
        $config ['base_url'] = site_url('no3/userBetRecord/index');
        $config ['total_rows'] = $totalNum;
        $config ['per_page'] = $per;
        $this->pagination->initialize($config);

        $this->load->view('no3/userBetRecordView', $data);
    }
}