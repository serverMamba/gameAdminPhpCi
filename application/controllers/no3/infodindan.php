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

    // searchType: 1精确搜索, 2范围搜索, 3快速查询(今日, 昨日...), 100搜索条件错误返回空结果
    public function index() {
        $searchType = isset($_REQUEST['searchType']) ? intval($_REQUEST['searchType']) : 2;
        $isShowPay = $this->input->get('isShowPay', true) ? intval($this->input->get('isShowPay', true)) : 1;

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];
        $query = [];

        $useDefault = false; // 日期控件是否显示默认时间

        if ($searchType === 1) { // 精确搜索
            $userId = isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) ? intval($_REQUEST['userId']) : '';
            $orderId = isset($_REQUEST['orderId']) && !empty($_REQUEST['orderId']) ? trim($_REQUEST['orderId']) : '';
            $thirdOrderId = isset($_REQUEST['thirdOrderId']) && !empty($_REQUEST['thirdOrderId']) ? trim($_REQUEST['thirdOrderId']) : '';
            $agentId = isset($_REQUEST['agentId']) && !empty($_REQUEST['agentId']) ? intval($_REQUEST['agentId']) : '';

            $operator = isset($_REQUEST['operator']) && !empty($_REQUEST['operator']) ? trim($_REQUEST['operator']) : '';

            if ($userId === '' && $orderId === '' && $thirdOrderId === '' && $agentId === '' && $operator === '') {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, param = '
                    . json_encode($_REQUEST));
                $this->session->set_flashdata('error', '参数错误');
                redirect('no3/infodindan?searchType=100'); // 参数错误, 返回空查询结果
            }

            $finalRet = $this->dindan_model->getOrderListByTypeOne($userId, $orderId, $thirdOrderId, $agentId, $operator, $start, $per);

            $query = [
                'userId' => $userId,
                'orderId' => $orderId,
                'agentId' => $agentId,
                'operator' => $operator,

                'searchType' => $searchType,
                'isShowPay' => $isShowPay
            ];

        } else if ($searchType === 2) {
            $payType = isset($_REQUEST['payType']) ? $_REQUEST['payType'] : -1;
            $payStatus = isset($_REQUEST['payStatus']) ? intval($_REQUEST['payStatus']) : -1;
            $paySituation = isset($_REQUEST['paySituation']) ? intval($_REQUEST['paySituation']) : -1;

            $payPlatform = isset($_REQUEST['pay_platform']) ? intval($_REQUEST['pay_platform']) : -1;
            $gameCode = isset($_REQUEST['game_code']) ? intval($_REQUEST['game_code']) : 0;

            $amountMinOriginal = isset($_REQUEST['amountMin']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMin']) : '';
            $amountMaxOriginal = isset($_REQUEST['amountMax']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMax']) : '';
            $amountMin = $amountMax = '';

            if ($amountMinOriginal !== '') {
                $amountMin = $amountMinOriginal * 100; // 数据库中钱的单位是分
            }
            if ($amountMaxOriginal !== '') {
                $amountMax = $amountMaxOriginal * 100;
            }

            if ($amountMin !== '' && $amountMax !== '') {
                if ($amountMax < $amountMin) {
                    $this->session->set_flashdata('error', '金额范围不合法');
                    redirect('no3/infodindan?searchType=100');
                }
            }

            $dateTimeBeginOriginal = isset($_REQUEST['dateTimeBegin']) ? trim($_REQUEST['dateTimeBegin']) : '';
            $dateTimeEndOriginal = isset($_REQUEST['dateTimeEnd']) ? trim($_REQUEST['dateTimeEnd']) : '';
            $dateTimeBegin = $dateTimeEnd = '';
            if ($dateTimeBeginOriginal !== '') {
                $dateTimeBegin = str_replace('T', ' ', $dateTimeBeginOriginal);
            }
            if ($dateTimeEndOriginal !== '') {
                $dateTimeEnd = str_replace('T', ' ', $dateTimeEndOriginal);
            }

            if (empty($_GET) && empty($_POST)) { // 点击左侧进入, 按照前端显示, 获取今天数据
                $dateTimeBegin = date('Y-m-d 00:00:00');
                $dateTimeEnd = date('Y-m-d 23:59:59');
                $useDefault = true;
            }

            $finalRet = $this->dindan_model->getOrderListByTypeTwo($payType, $payStatus, $paySituation,
                $payPlatform, $gameCode, $amountMin, $amountMax,
                $dateTimeBegin, $dateTimeEnd, $start, $per);

            $query = [
                'payType' => $payType,
                'payStatus' => $payStatus,
                'paySituation' => $paySituation,
                'pay_platform' => $payPlatform,

                'game_code' => $gameCode,
                'amountMin' => $amountMinOriginal,
                'amountMax' => $amountMaxOriginal,

                'dateTimeBegin' => $dateTimeBeginOriginal,
                'dateTimeEnd' => $dateTimeEndOriginal,
                'searchType' => $searchType,
                'isShowPay' => $isShowPay,
            ];
        } else if ($searchType === 3) { // 快速查询 - 今日, 昨日 ...
            $type = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 1;

            $payType = -1;
            $payStatus = -1;
            $paySituation = -1;

            $payPlatform = -1;
            $gameCode = 0;
            $amountMin = $amountMax = '';
            $now = time();

            $dateTimeBegin = $dateTimeEnd = '';
            switch ($type) {
                case 1: // 今日
                    $dateTimeBegin = date('Y-m-d 00:00:00', $now);
                    $dateTimeEnd = date('Y-m-d 23:59:59', $now);
                    break;
                case 2: // 昨日
                    $time = strtotime('-1 day', $now);
                    $dateTimeBegin = date('Y-m-d 00:00:00', $time);
                    $dateTimeEnd = date('Y-m-d 23:59:59', $time);
                    break;
                case 3: // 本周
                    $time = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);
                    $dateTimeBegin = date('Y-m-d 00:00:00', $time);
                    $dateTimeEnd = date('Y-m-d 23:59:59', strtotime('Sunday', $now));
                    break;
                case 4: // 上周
                    // 本周一
                    $thisMonday = '1' == date('w') ? strtotime('Monday', $now) : strtotime('last Monday', $now);
                    // 上周一
                    $lastMonday = strtotime('-7 days', $thisMonday);
                    $dateTimeBegin = date('Y-m-d 00:00:00', $lastMonday);
                    $dateTimeEnd = date('Y-m-d 23:59:59', strtotime('last sunday', $now));
                    break;
                case 5: // 本月
                    $dateTimeBegin = date('Y-m-01 00:00:00', strtotime(date("Y-m-d")));
                    $dateTimeEnd = date('Y-m-d 23:59:59', strtotime("$dateTimeBegin +1 month -1 day"));
                    break;
                case 6: // 上月
                    $dateTimeBegin = date('Y-m-d 00:00:00', strtotime(date('Y-m-01') . ' -1 month'));
                    $dateTimeEnd = date('Y-m-d 23:59:59', strtotime(date('Y-m-01') . ' -1 day'));
                    break;
                default:
                    log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, param = '
                        . json_encode($_REQUEST));
                    $this->session->set_flashdata('error', '参数错误');
                    redirect('no3/infodindan?searchType=100'); // 参数错误, 返回空查询结果
            }

            $finalRet = $this->dindan_model->getOrderListByTypeTwo($payType, $payStatus, $paySituation,
                $payPlatform, $gameCode, $amountMin, $amountMax,
                $dateTimeBegin, $dateTimeEnd, $start, $per);

            $query = [
                'payType' => $payType,
                'payStatus' => $payStatus,
                'paySituation' => $paySituation,
                'pay_platform' => $payPlatform,

                'game_code' => $gameCode,
                'amountMin' => $amountMin,
                'amountMax' => $amountMax,

                'dateTimeBegin' => '',
                'dateTimeEnd' => '',
                'searchType' => $searchType,
                'isShowPay' => $isShowPay,

                'type' => $type
            ];
        }

        $orderList = $finalRet['content'];

        if (!empty($orderList)) {
            $this->dindan_model->formatOrderList($orderList);
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
            'pay_platform_list' => $this->dindan_model->getPayList(),
            'game_codes' => $this->config->item('game_codes'),
            'query' => $query,
            'isNormal' => true,
            'payType' => payType,
            'payStatus' => payStatus,
            'paySituation' => paySituation,
            'pageInfo' => [
                'pageNum' => ceil($totalNum / $per),
                'page' => $page
            ],
            'useDefault' => $useDefault
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

    /**
     * 导出
     */
    public function exportData() {
        $payType = isset($_REQUEST['payType']) ? $_REQUEST['payType'] : -1;
        $payStatus = isset($_REQUEST['payStatus']) ? intval($_REQUEST['payStatus']) : -1;
        $paySituation = isset($_REQUEST['paySituation']) ? intval($_REQUEST['paySituation']) : -1;

        $payPlatform = isset($_REQUEST['pay_platform']) ? intval($_REQUEST['pay_platform']) : -1;
        $gameCode = isset($_REQUEST['game_code']) ? intval($_REQUEST['game_code']) : 0;

        $amountMinOriginal = isset($_REQUEST['amountMin']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMin']) : '';
        $amountMaxOriginal = isset($_REQUEST['amountMax']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMax']) : '';
        $amountMin = $amountMax = '';

        if ($amountMinOriginal !== '') {
            $amountMin = $amountMinOriginal * 100; // 数据库中钱的单位是分
        }
        if ($amountMaxOriginal !== '') {
            $amountMax = $amountMaxOriginal * 100;
        }

        if ($amountMin !== '' && $amountMax !== '') {
            if ($amountMax < $amountMin) {
                $this->session->set_flashdata('error', '金额范围不合法');
                redirect('no3/infodindan?searchType=100');
            }
        }

        $dateTimeBeginOriginal = isset($_REQUEST['dateTimeBegin']) ? trim($_REQUEST['dateTimeBegin']) : '';
        $dateTimeEndOriginal = isset($_REQUEST['dateTimeEnd']) ? trim($_REQUEST['dateTimeEnd']) : '';
        $dateTimeBegin = $dateTimeEnd = '';
        if ($dateTimeBeginOriginal !== '') {
            $dateTimeBegin = str_replace('T', ' ', $dateTimeBeginOriginal);
        }
        if ($dateTimeEndOriginal !== '') {
            $dateTimeEnd = str_replace('T', ' ', $dateTimeEndOriginal);
        }

        if (empty($_GET) && empty($_POST)) { // 点击左侧进入, 按照前端显示, 获取今天数据
            $dateTimeBegin = date('Y-m-d 00:00:00');
            $dateTimeEnd = date('Y-m-d 23:59:59');
        }

        $finalRet = $this->dindan_model->exportData($payType, $payStatus, $paySituation,
            $payPlatform, $gameCode, $amountMin, $amountMax,
            $dateTimeBegin, $dateTimeEnd);
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
        $searchType = isset($_REQUEST['searchType']) ? intval($_REQUEST['searchType']) : 2;
        $isShowPay = $this->input->get('isShowPay', true) ? intval($this->input->get('isShowPay', true)) : 1;

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];
        $query = [];

        if ($searchType === 1) { // 精确搜索
            $userId = isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) ? intval($_REQUEST['userId']) : '';
            $orderId = isset($_REQUEST['orderId']) && !empty($_REQUEST['orderId']) ? trim($_REQUEST['orderId']) : '';
            $thirdOrderId = isset($_REQUEST['thirdOrderId']) && !empty($_REQUEST['thirdOrderId']) ? trim($_REQUEST['thirdOrderId']) : '';
            $agentId = isset($_REQUEST['agentId']) && !empty($_REQUEST['agentId']) ? intval($_REQUEST['agentId']) : '';

            $operator = isset($_REQUEST['operator']) && !empty($_REQUEST['operator']) ? trim($_REQUEST['operator']) : '';

            if ($userId === '' && $orderId === '' && $thirdOrderId === '' && $agentId === '' && $operator === '') {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, param = '
                    . json_encode($_REQUEST));
                $this->session->set_flashdata('error', '参数错误');
                redirect('no3/infodindan?searchType=100'); // 参数错误, 返回空查询结果
            }

            $finalRet = $this->dindan_model->getDelayOrderListByTypeOne($userId, $orderId, $thirdOrderId, $agentId, $operator, $start, $per);

            $query = [
                'userId' => $userId,
                'orderId' => $orderId,
                'agentId' => $agentId,
                'operator' => $operator,

                'searchType' => $searchType,
                'isShowPay' => $isShowPay
            ];

        } else if ($searchType === 2) {
            $payType = isset($_REQUEST['payType']) ? $_REQUEST['payType'] : -1;
            $payStatus = isset($_REQUEST['payStatus']) ? intval($_REQUEST['payStatus']) : -1;
            $paySituation = isset($_REQUEST['paySituation']) ? intval($_REQUEST['paySituation']) : -1;

            $payPlatform = isset($_REQUEST['pay_platform']) ? intval($_REQUEST['pay_platform']) : -1;
            $gameCode = isset($_REQUEST['game_code']) ? intval($_REQUEST['game_code']) : 0;

            $amountMinOriginal = isset($_REQUEST['amountMin']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMin']) : '';
            $amountMaxOriginal = isset($_REQUEST['amountMax']) && !empty($_REQUEST['amountMin']) ? trim($_REQUEST['amountMax']) : '';
            $amountMin = $amountMax = '';

            if ($amountMinOriginal !== '') {
                $amountMin = $amountMinOriginal * 100; // 数据库中钱的单位是分
            }
            if ($amountMaxOriginal !== '') {
                $amountMax = $amountMaxOriginal * 100;
            }

            if ($amountMin !== '' && $amountMax !== '') {
                if ($amountMax < $amountMin) {
                    $this->session->set_flashdata('error', '金额范围不合法');
                    redirect('no3/infodindan?searchType=100');
                }
            }

            $dateTimeBeginOriginal = isset($_REQUEST['dateTimeBegin']) ? trim($_REQUEST['dateTimeBegin']) : '';
            $dateTimeEndOriginal = isset($_REQUEST['dateTimeEnd']) ? trim($_REQUEST['dateTimeEnd']) : '';
            $dateTimeBegin = $dateTimeEnd = '';
            if ($dateTimeBeginOriginal !== '') {
                $dateTimeBegin = str_replace('T', ' ', $dateTimeBeginOriginal);
            }
            if ($dateTimeEndOriginal !== '') {
                $dateTimeEnd = str_replace('T', ' ', $dateTimeEndOriginal);
            }

            if (empty($_GET) && empty($_POST)) { // 点击左侧进入, 按照前端显示, 获取今天数据
                $dateTimeBegin = date('Y-m-d 00:00:00');
                $dateTimeEnd = date('Y-m-d 23:59:59');
            }

            $finalRet = $this->dindan_model->getDelayOrderListByTypeTwo($payType, $payStatus, $paySituation,
                $payPlatform, $gameCode, $amountMin, $amountMax,
                $dateTimeBegin, $dateTimeEnd, $start, $per);

            $query = [
                'payType' => $payType,
                'payStatus' => $payStatus,
                'paySituation' => $paySituation,
                'pay_platform' => $payPlatform,

                'game_code' => $gameCode,
                'amountMin' => $amountMinOriginal,
                'amountMax' => $amountMaxOriginal,

                'dateTimeBegin' => $dateTimeBeginOriginal,
                'dateTimeEnd' => $dateTimeEndOriginal,
                'searchType' => $searchType,
                'isShowPay' => $isShowPay,
            ];
        }

        $orderList = $finalRet['content'];

        if (!empty($orderList)) {
            $this->dindan_model->formatOrderList($orderList);
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
                "child" => "玩家超时订单查询"
            ),
            "header2" => array(
                "father" => "玩家订单查询",
                "child" => "浏览玩家订单数据 "
            ),
            'orderList' => $orderList,
            'pay_platform_list' => $this->dindan_model->getPayList(),
            'game_codes' => $this->config->item('game_codes'),
            'query' => $query,
            'isNormal' => false,
            'payType' => payType,
            'payStatus' => payStatus,
            'paySituation' => paySituation,
            'pageInfo' => [
                'pageNum' => ceil($totalNum / $per),
                'page' => $page
            ]
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
