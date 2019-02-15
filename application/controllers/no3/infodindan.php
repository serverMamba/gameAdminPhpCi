<?php

if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Infodindan extends MY_Controller {
    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('kfgl_wjddcx')) {
            redirect('no3/index');
        }
        $this->load->model('dindan_model');
    }

    public function test() {

        // $userinfo = $this->usernew_model->get_info_index_by_uid(890007);
        $ret = $this->usernew_mid_model->query_user_info(890007);

        print_r($ret);

        $ret = $this->usernew_mid_model->account2id1("coopcoop@163.com");

        print_r($ret->userID());
    }

    public function get_dindan_data() {
        $action = $this->input->get_post('action');
        $mystarttime = $this->input->get_post('mystarttime');
        $myendtime = $this->input->get_post('myendtime');
        $userid = $this->input->get_post('userid');
        $dindan = $this->input->get_post('dindan');
        $account = $this->input->get_post('account');
        $beginindex = $this->input->get_post('beginindex');
        $statusid = $this->input->get_post('statusid');
        $gameid = $this->input->get_post('gameid');

        $res = $this->dindan_model->get_dindan_his($userid, $dindan, $statusid, $gameid, $mystarttime, $myendtime, $account, $beginindex);

        echo json_encode($res);
    }

    public function index() {
        $searchType = isset($_POST['searchType']) ? intval($_POST['searchType']) : 2;

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $finalRet = [];
        $query = [];

        // test
        log_message('error', 'ok777, post = ' . json_encode($_POST));

        if ($searchType === 1) { // 精确搜索
            $userId = isset($_POST['userId']) && !empty($_POST['userId']) ? intval($_POST['userId']) : '';
            $orderId = isset($_POST['orderId']) && !empty($_POST['orderId']) ? trim($_POST['orderId']) : '';
            $agentId = isset($_POST['agentId']) && !empty($_POST['agentId']) ? intval($_POST['agentId']) : '';
            $operator = isset($_POST['operator']) && !empty($_POST['operator']) ? trim($_POST['operator']) : '';

            if ($userId <= 0
                || ($userId === '' && $orderId === '' && $agentId === '' && $operator === '')
            ) {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, param = '
                    . json_encode($_POST));
                $this->session->set_flashdata('error', '参数错误');
                redirect('no3/infodindan');
            }

            $finalRet = $this->dindan_model->getOrderListByTypeOne($userId, $orderId, $agentId, $operator, $start, $per);

            $query = [
                'userId' => $userId,
                'orderId' => $orderId,
                'agentId' => $agentId,
                'operator' => $operator,

                'searchType' => $searchType
            ];

        } else {
            $payType = isset($_POST['payType']) ? $_POST['payType'] : -1;
            $payStatus = isset($_POST['payStatus']) ? intval($_POST['payStatus']) : -1;
            $paySituation = isset($_POST['paySituation']) ? intval($_POST['paySituation']) : -1;

            $amountMinOriginal = isset($_POST['amountMin']) && !empty($_POST['amountMin']) ? trim($_POST['amountMin']) : '';
            $amountMaxOriginal = isset($_POST['amountMax']) && !empty($_POST['amountMin']) ? trim($_POST['amountMax']) : '';
            $amountMin = $amountMax = '';

            if ($amountMinOriginal !== '') {
                $amountMin = $amountMinOriginal * 100; // 数据库中钱的单位是分
            }
            if ($amountMaxOriginal !== '') {
                $amountMax = $amountMaxOriginal * 100;
            }

            if ($amountMax < $amountMin) {
                $this->session->set_flashdata('error', '金额范围不合法');
                redirect('no3/infodindan');
            }

            $dateTimeBeginOriginal = isset($_POST['dateTimeBegin']) ? trim($_POST['dateTimeBegin']) : '';
            $dateTimeEndOriginal = isset($_POST['dateTimeEnd']) ? trim($_POST['dateTimeEnd']) : '';
            $dateTimeBegin = $dateTimeEnd = '';
            if ($dateTimeBeginOriginal !== '') {
                $dateTimeBegin = str_replace('T', ' ', $dateTimeBeginOriginal);
            }
            if ($dateTimeEndOriginal !== '') {
                $dateTimeEnd = str_replace('T', ' ', $dateTimeEndOriginal);
            }

            $finalRet = $this->dindan_model->getOrderListByTypeTwo($payType, $payStatus, $paySituation, $amountMin, $amountMax,
                $dateTimeBegin, $dateTimeEnd, $start, $per);

            $query = [
                'payType' => $payType,
                'payStatus' => $payStatus,
                'paySituation' => $paySituation,

                'amountMin' => $amountMinOriginal,
                'amountMax' => $amountMaxOriginal,

                'dateTimeBegin' => $dateTimeBeginOriginal,
                'dateTimeEnd' => $dateTimeEndOriginal,
                'searchType' => $searchType
            ];
        }

        $orderList = $finalRet['content'];

        foreach ($orderList as &$row) { // todo 之前的做法和现在的状态定义不一致
            $row['money'] = $row['money'] / 100;

            if ($row ['status'] == 1) {
                $row ['after_chips'] = $row ['before_chips'] + $row ['money'];
            } else {
                $row['after_chips'] = '--';
            }

            if ($row ['status'] == 0) {
                $row ['status'] = '未支付';
            } else if ($row['status'] == 1) {
                $row ['status'] = '支付成功';
            } else {
                $row ['status'] = '支付失败';
            }

            $row ['add_time'] = date('Y-m-d H:i:s', $row ['add_time']);
            if ($row['pay_success_time']) {
                $row ['pay_success_time'] = date('Y-m-d H:i:s', $row ['pay_success_time']);
            } else {
                $row ['pay_success_time'] = ' - ';
            }
        }
        $totalNum = $finalRet['totalNum'];

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "财务管理",
                "child" => "玩家订单查询"
            ),
            "header1" => array(
                "father" => "财务管理",
                "child" => "玩家订单查询"
            ),
            "header2" => array(
                "father" => "玩家订单查询",
                "child" => "浏览玩家订单数据 "
            ),
            'orderList' => $orderList,
            'query' => $query,
            'isNormal' => true,
            'payType' => payType,
            'payStatus' => payStatus,
            'paySituation' => paySituation
        );

        $data ['total_rows'] = $totalNum;
        $data['page'] = $page;

        $this->load->library('pagination');
        $url = site_url('no3/infodindan/index') . '?' . http_build_query($query);
        $config ['base_url'] = $url;
        $config ['total_rows'] = $data ['total_rows'];
        $config ['per_page'] = $per;

        $this->pagination->initialize($config);

        $this->load->view('no3/infodindanview', $data);
    }

    public function frameset() {
        if (!$this->uid) {
            $this->_gologin();
            return;
        }

        $this->load->view('frameset');
    }

    /**
     * [170307] 查询超时订单
     */
    public function delayOrders() {
        $query ['user_id'] = $this->input->get('user_id', true) ? intval($this->input->get('user_id', true)) : 0;
        $query ['start_time'] = $this->input->get('start_time', true) ? $this->input->get('start_time', true) : 0;
        $query ['start_time_time'] = $this->input->get('start_time_time', true) ? $this->input->get('start_time_time', true) : 0;
        $query ['end_time'] = $this->input->get('end_time', true) ? $this->input->get('end_time', true) : 0;
        $query ['end_time_time'] = $this->input->get('end_time_time', true) ? $this->input->get('end_time_time', true) : 0;
        $query ['account'] = $this->input->get('account', true) ? $this->input->get('account', true) : '';
        $query ['pay_platform'] = $this->input->get('pay_platform', true) ? intval($this->input->get('pay_platform', true)) : 0;
        $query ['game_code'] = $this->input->get('game_code', true) ? $this->input->get('game_code', true) : '0';

        $startTime = "";
        if ($query['start_time'] != 0) {
            $startTime = $query['start_time'] . " " . $query['start_time_time'];
        }

        $endTime = "";
        if ($query['end_time'] != 0) {
            $endTime = $query['end_time'] . " " . $query['end_time_time'];
        }

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $delayOrderData = $this->dindan_model->get_delay_dindan_his($query ['user_id'], $startTime, $endTime, $query ['account'], $query['pay_platform'], $start, $per, $query ['game_code']);
        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "财务管理",
                "child" => "玩家订单查询"
            ),
            "header1" => array(
                "father" => "财务管理",
                "child" => "玩家超时订单查询"
            ),
            "header2" => array(
                "father" => "玩家订单查询",
                "child" => "浏览玩家订单数据 "
            ),
            'order_list' => $delayOrderData['orderList'],
            'total_rows' => $delayOrderData['totalNum'],
            'game_codes' => $this->config->item('game_codes'),
            'pay_platform_list' => $this->dindan_model->getPayList(),
            'query' => $query,
            'isNormal' => false,
        );

        $this->load->library('pagination');
        $url = site_url('no3/infodindan/delayOrders') . '?' . http_build_query($query);
        $config ['base_url'] = $url;
        $config ['total_rows'] = $data ['total_rows'];
        $config ['per_page'] = $per;
        $this->pagination->initialize($config);

        $this->load->view('no3/infodindanview', $data);
    }

    public function header() {
        if (!$this->uid) {
            $this->_gologin();
            return;
        }

        $this->load->view('header');
    }

    public function nav() {
        if (!$this->uid) {
            $this->_gologin();
            return;
        }

        $this->load->view('nav');
    }

    public function sysinfo() {
        if (!$this->uid) {
            $this->_gologin();
            return;
        }

        $this->load->database();
        $query = $this->db->query('SELECT version() as version');
        $db_info = $query->row_array();

        $data = array(
            'server_env' => $_SERVER ['SERVER_SOFTWARE'],
            'php_version' => phpversion(),
            'database' => 'MySQL ' . $db_info ['version'],
            'max_memory_limit' => ini_get('memory_limit'),
            'file_uploads' => ini_get('file_uploads') ? '允许' : '禁用',
            'upload_max_filesize' => ini_get('upload_max_filesize'),
            'post_max_size' => ini_get('post_max_size'),
            'php_display_errors' => ini_get('display_errors') ? '开启' : '禁用',
            'php_error_reporting' => ini_get('error_reporting'),
            'magic_quotes_gpc' => ini_get('magic_quotes_gpc') ? '开启' : '禁用'
        );
        $this->load->view('sysinfo', $data);
    }

    private function _login() {
        $gourl = $this->input->get('gourl');
        $msg = @base64_decode($this->input->get('msg'));
        $this->load->view('login', array(
            'gourl' => $gourl,
            'msg' => $msg
        ));
    }

    public function login_submit() {
        $callback = $this->input->get('callback');
        $username = $this->input->get('username');
        $password = $this->input->get('password');
        $password = md5($password);
        $gourl = $this->input->get('gourl');

        if (empty ($gourl))
            $gourl = site_url(DEFAULT_PAGE_URI);

        if (empty ($username)) {
            echo jsonp_return($callback, RESPONSE_PARAMS_ERROR, '需要输入帐号才能进行登录');
            return;
        }

        if (empty ($password)) {
            echo jsonp_return($callback, RESPONSE_PARAMS_ERROR, '需要输入密码才能进行登录');
            return;
        }

        $this->load->model('backuser_model');
        $userinfo = $this->backuser_model->get_userinfo_by_username($username);

        if ($userinfo === false) {
            echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1001)');
            return;
        } elseif (empty ($userinfo) || $userinfo ['password'] != $password) {
            echo jsonp_return($callback, 2, '帐号或密码错误');
            return;
        }

        $this->load->library('login_lib');
        $cookie_ok = $this->login_lib->set_login_cookie($username);
        if ($cookie_ok) {
            $this->backuser_model->add_login_count($username, 1);
            // $this->backuser_model->update_user_by_username($username,
            // array('last_login_time'=>date('Y-m-d H:i:s'),
            // 'last_login_ip'=>$this->input->ip_address()));
            $this->backuser_model->update_user_by_username($username, array(
                'last_login_ip' => $this->input->ip_address()
            ));
            echo jsonp_return($callback, RESPONSE_OK, $gourl);
        } else {
            echo jsonp_return($callback, RESPONSE_SYSTEM_BUSY, '系统繁忙，请稍候再试！(Code:1002)');
        }
    }

    public function logout() {
        $gourl = $this->input->get('gourl');
        if (empty ($gourl))
            $gourl = site_url(DEFAULT_PAGE_URI);

        $this->load->library('login_lib');
        $this->login_lib->logout();
        header("location: $gourl");
    }
}
