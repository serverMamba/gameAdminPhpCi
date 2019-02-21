<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class HomePage extends CI_Controller {
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
        $searchType = isset($_REQUEST['searchType']) ? intval($_REQUEST['searchType']) : 1;

        $per = 20;
        $page = $this->input->get('page') ? intval($this->input->get('page')) : 1;
        $start = ($page - 1) * $per;

        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];
        $query = [];

        $useDefault = false; // 日期控件是否显示默认时间

        $channelList = $this->config->item('channellist');

        $channelId = isset($_POST['channelId']) ? intval($_POST['channelId']) : -1;

        if ($searchType === 1) { // 根据渠道和统计时间查询
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

//            $finalRet = $this->dindan_model->getOrderListByTypeTwo();

            $query = [
                'channelId' => $channelId,
                'dateTimeBegin' => $dateTimeBeginOriginal,
                'dateTimeEnd' => $dateTimeEndOriginal,
                'searchType' => $searchType,
            ];
        } else if ($searchType === 2) { // 快速查询 - 今日, 昨日 ...
            $type = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 1;

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

//            $finalRet = $this->dindan_model->getOrderListByTypeTwo();

            $query = [
                'dateTimeBegin' => $dateTimeBegin,
                'dateTimeEnd' => $dateTimeEnd,
                'searchType' => $searchType,
                'type' => $type
            ];
        }


        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "首页",
                "child" => "首页"
            ),
            "header1" => array(
                "father" => "首页",
                "child" => "首页"
            ),
            'channelList' => $channelList,
            'query' => $query,
            'useDefault' => $useDefault,
            'totalData' => [], // 总数据
            'timeData' => [ // 根据时间搜索数据
                [
                    'date' => '2019-01-01', // 统计时间 todo 这个啥玩意
                    'revenue' => '100.00', // 营收
                    'recharge' => '100.00', // 充值
                    'exchange' => '100.00', // 兑换

                    'totalGold' => '100.00', // 总金币
                    'registerNum' => '100.00', // 注册用户数
                    'loginNum' => '100.00', // 登录用户数
                    'totalTax' => '100.00', // 总税收

                    'gameRecord' => '100.00', // 游戏记录
                    'lastUpdateTime' => '2019-01-01', // 最后更新时间
                ]
            ],
            'pageInfo' => [
                'pageNum' => ceil($totalNum / $per),
                'page' => $page
            ],
        );

        $this->load->view('no3/homePageView', $data);
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

    public function getDetail($id) {
        $ret = [];
        switch ($id) {
            case 1: // 营收
                break;
            case 2: // 充值
                break;
            case 3: // 兑换
                break;
            case 4: // 总金币
                break;
            case 5: // 注册用户数
                break;
            case 6: // 登录用户数
                break;
            case 7: // 总税收
                break;
            case 8: // 游戏记录
                break;
            default:
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, id = ' . $id);
                $this->session->set_flashdata('error', '参数错误');
                redirect('no3/homePage?searchType=100'); // 参数错误, 返回空查询结果
        }
        $this->load->model('gamehis_model');

        $action = $this->input->get_post('action', true);
        $mystarttime = $this->input->get_post('mystarttime', true);
        $myendtime = $this->input->get_post('myendtime', true);
        $userid = intval($this->input->get_post('userid'));
        $paijuhao = $this->input->get_post('paijuhao', true);
        $beginindex = $this->input->get_post('beginindex', true);
        $gameid = $this->input->get_post('gameid', true);

        $res = $this->gamehis_model->get_game_his($userid, $gameid, $mystarttime, $myendtime, $paijuhao, $beginindex);

        echo json_encode($res);
    }
}