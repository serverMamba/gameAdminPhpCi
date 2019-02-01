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

        $betRecord = $this->User_model->betRecordGet($dateBegin, $dateEnd, $gameId, $baseScore, $userId);

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

        $this->load->view('no3/userBetRecordView', $data);
    }
}