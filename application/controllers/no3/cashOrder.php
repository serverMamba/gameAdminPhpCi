<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class CashOrder extends CI_Controller {

    // 提现订单状态
    const orderStatus = [
        CASH_ORDER_STATUS_ALL => "全部",
        CASH_ORDER_STATUS_NOT_COMPLETE => "等待处理",
        CASH_ORDER_STATUS_NEW => "新建",
        CASH_ORDER_STATUS_SUCCESS => "成功",
        CASH_ORDER_STATUS_FAIL => "失败",
        CASH_ORDER_STATUS_WAIT_REVIEW => "被过滤",
        CASH_ORDER_STATUS_REVIEW_PASS => "审核通过",
        CASH_ORDER_STATUS_UNKNOWN => "未知状态",
        CASH_ORDER_STATUS_DEALING => "处理中",
    ];

    public function __construct() {
        parent::__construct(false, false);
        if (!$this->Common_model->isLogin()) {
            redirect('no3/login');
        }
        if (!$this->Common_model->isPriv('cash_order')) {
            redirect('no3/index');
        }
        $this->load->model('api/User_model');
        $this->load->model('no3/Order_model');
        $this->load->model('no3/Admin_model');
        $this->load->model('no3/Push_model');
        $this->load->model('no3/Chat_model');
    }

    public function index() {
        $searchType = isset($_REQUEST['searchType']) ? intval($_REQUEST['searchType']) : 2;

        $finalRet = [
            'content' =>[]
        ];
        $query = [];

        if ($searchType === 1) { // 精确搜索
            $userId = isset($_REQUEST['userId']) && !empty($_REQUEST['userId']) ? intval($_REQUEST['userId']) : '';
            $aliPayAccount = isset($_REQUEST['aliPayAccount']) && !empty($_REQUEST['aliPayAccount']) ? trim($_REQUEST['aliPayAccount']) : '';
            $orderId = isset($_REQUEST['orderId']) && !empty($_REQUEST['orderId']) ? intval($_REQUEST['orderId']) : '';
            $operator = isset($_REQUEST['operator']) && !empty($_REQUEST['operator']) ? trim($_REQUEST['operator']) : '';

            if ($userId === '' && $aliPayAccount === '' && $orderId === '' && $operator === '') {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid param, param = '
                    . json_encode($_REQUEST));
                $this->session->set_flashdata('error', '参数错误');
                redirect('no3/cashOrder?searchType=100'); // 参数错误, 返回空查询结果
            }

            $finalRet = $this->Order_model->getCashOrderListByTypeOne($userId, $aliPayAccount, $orderId, $operator);

            $query = [
                'userId' => $userId,
                'aliPayAccount' => $aliPayAccount,
                'orderId' => $orderId,
                'operator' => $operator,

                'searchType' => $searchType
            ];

        } else if ($searchType === 2) {
            $orderStatus = isset($_REQUEST['orderStatus']) ? intval($_REQUEST['orderStatus']) : CASH_ORDER_STATUS_ALL;
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
                    redirect('no3/cashOrder?searchType=100');
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

            $finalRet = $this->Order_model->getCashOrderListByTypeTwo($orderStatus, $amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd);

            $query = [
                'orderStatus' => $orderStatus,
                'amountMin' => $amountMinOriginal,
                'amountMax' => $amountMaxOriginal,

                'dateTimeBegin' => $dateTimeBeginOriginal,
                'dateTimeEnd' => $dateTimeEndOriginal,
                'searchType' => $searchType
            ];
        } else if ($searchType === 3) { // 快速查询 - 今日, 昨日 ...
            $type = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? intval($_REQUEST['type']) : 1;

            $orderStatus = CASH_ORDER_STATUS_ALL;
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
                    redirect('no3/cashOrder?searchType=100'); // 参数错误, 返回空查询结果
            }

            $finalRet = $this->Order_model->getCashOrderListByTypeTwo($orderStatus, $amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd);
        }

        $cashOrderList = $finalRet['content'];

        $tip_msg = "11";
        $goto_artificial = $this->ifGotoArtificialCash($tip_msg);
        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "财务管理",
                "child" => "提现订单"
            ),
            "header1" => array(
                "father" => "财务管理",
                "child" => "提现订单"
            ),
            'tip_msg' => $tip_msg,
            'goto_artificial' => $goto_artificial,
            'cashOrderList' => $cashOrderList,
            'query' => $query,
            'no_process_num' => $this->Order_model->getNoPorcessCashOrderNum()
        );

        // test
        log_message('error', 'query = ' . json_encode($query));

        $this->load->view('no3/cash_order_list_views', $data);
    }

    /**
     * 导出
     */
    public function exportData() {
        $orderStatus = isset($_REQUEST['orderStatus']) ? intval($_REQUEST['orderStatus']) : CASH_ORDER_STATUS_ALL;
        $amountMinOriginal = isset($_POST['amountMin']) && !empty($_POST['amountMin']) ? trim($_POST['amountMin']) : '';
        $amountMaxOriginal = isset($_POST['amountMax']) && !empty($_POST['amountMin']) ? trim($_POST['amountMax']) : '';
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
                redirect('no3/cashOrder');
            }
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

        $res = $this->Order_model->exportData($orderStatus, $amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd);
    }

    public function batchFinish() {
        $admin_id = $this->session->userdata('id');
        $select_cash_ids = $this->input->post('select_cash_ids');
        if (empty ($select_cash_ids)) {
            $this->session->set_flashdata('error', '请选择订单');
            redirect('no3/cashOrder');
        }

        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("batchFinish");
        $data1 = array(
            'status' => CASH_ORDER_STATUS_SUCCESS,
            'update_time' => time(),
            'discribe' => $admin_name . '批量完成',
        );
        $flag = $this->Order_model->createBatchLogTab();
        foreach ($select_cash_ids as $id) {
            $order = $this->Order_model->getCashOrder($id);
            if (!empty ($order)) {
                $data1 ['real_cash_money'] = intval($this->Order_model->calMoney($order ['cash_money'] / 100)) * 100;
                if (($order ['status'] == CASH_ORDER_STATUS_DEALING || $order ['status'] == CASH_ORDER_STATUS_UNKNOWN || $order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) &&
                    $this->Order_model->updateCashOrder($id, $data1)
                ) {
                    $this->Order_model->logBatchCashOrder($id, $order['status'], time(), $this->session->userdata('admin_name'), 'batchFinish');
                    $user_db_index = $this->User_model->getUserDBPos($order ['user_id']);
                    if (!empty ($user_db_index)) {
                        $db1 = $this->load->database('eus' . $user_db_index ['dbindex'], true);
                        $sql = "UPDATE CASINOUSER_" . $user_db_index ['tableindex'] . " SET total_total_money = total_total_money + '" . $order ['cash_money'] . "' WHERE id = '" . $order ['user_id'] . "'";
                        $db1->query($sql);
                        $db1->close();
                    }

                    if ($this->Chat_model->createChatSession($order ['user_id'])) {
                        $data ['admin_id'] = $admin_id;
                        $data ['content'] = '您的兑换已经处理完毕，请查看支付宝账单,处理时间（' . date('Y-m-d H:i', $data1 ['update_time']) . '）';
                        $data ['user_id'] = $order ['user_id'];
                        $data ['add_time'] = time();
                        if ($this->Chat_model->insertMessage($data)) {
                            // 推送
                            $this->Push_model->addPushQueue($order ['user_id'], '您的兑换已成功');
                        }
                    }
                }
            }
        }

        $this->session->set_flashdata('success', '修改成功');
        redirect('no3/cashOrder');
    }

    public function batchSuccess() {
        $admin_id = $this->session->userdata('id');
        $select_cash_ids = $this->input->post('select_cash_ids');
        if (empty ($select_cash_ids)) {
            $this->session->set_flashdata('error', '请选择订单');
            redirect('no3/cashOrder');
        }

        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("batchSuccess");
        $data1 = array(
            'status' => CASH_ORDER_STATUS_SUCCESS,
            'update_time' => time(),
            'discribe' => $admin_name . '批量成功',
        );
        $flag = $this->Order_model->createBatchLogTab();
        foreach ($select_cash_ids as $id) {
            $order = $this->Order_model->getCashOrder($id);
            $data1 ['real_cash_money'] = intval($this->Order_model->calMoney($order ['cash_money'] / 100)) * 100;
            if (!empty ($order)) {
                $this->Order_model->updateCashOrder($id, $data1);
                $this->Order_model->logBatchCashOrder($id, $order['status'], time(), $this->session->userdata('admin_name'), 'batchSuccess');
            }
        }

        $this->session->set_flashdata('success', '修改成功');
        redirect('no3/cashOrder');
    }

    public function refund() {
        $admin_id = $this->session->userdata('id');
        $id = $this->input->get('id') ? $this->input->get('id') : 0;
        if (!$id) {
            $this->session->set_flashdata('error', '参数错误1');
            redirect('no3/cashOrder');
        }

        $discribe = $this->input->get('discribe') ? $this->input->get('discribe') : '';

        $cash_order = $this->Order_model->getCashOrder($id);
        if (empty ($cash_order)) {
            $this->session->set_flashdata('error', '参数错误2');
            redirect('no3/cashOrder');
        }

        if (($cash_order ['status'] != CASH_ORDER_STATUS_NEW) && ($cash_order ['status'] != CASH_ORDER_STATUS_WAIT_REVIEW) && ($cash_order ['status'] != CASH_ORDER_STATUS_DEALING)) {
            $this->session->set_flashdata('error', '参数错误3');
            redirect('no3/cashOrder');
        }
        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("refund: $id");
        $data = array(
            'discribe' => urldecode($discribe) . " " . $admin_name,
            'status' => 2,
            'update_time' => time()
        );
        if ($this->Order_model->updateCashOrder($id, $data)) {
            $this->load->model('detail_model');
            $this->detail_model->score_operation_by_cash($cash_order ['user_id'], $cash_order ['cash_money']);

            // 客服消息和推送
            if ($this->Chat_model->createChatSession($cash_order ['user_id'])) {
                $data1 ['admin_id'] = $admin_id;
                $data1 ['content'] = '您的兑换失败，因为' . $data ['discribe'] . '，您的兑换金币已返还到您的游戏账户，处理时间（' . date('Y-m-d H:i', $data ['update_time']) . '）';
                $data1 ['user_id'] = $cash_order ['user_id'];
                $data1 ['add_time'] = time();
                if ($this->Chat_model->insertMessage($data1)) {
                    // 推送
                    $this->Push_model->addPushQueue($cash_order ['user_id'], '您的兑换失败');
                }
            }

            $this->session->set_flashdata('success', '退款成功');
            redirect('no3/cashOrder');
        } else {
            $this->session->set_flashdata('error', '退款失败');
            redirect('no3/cashOrder');
        }
    }

    public function reviewOrder() {
        $admin_id = $this->session->userdata('id');
        $id = $this->input->get('id') ? $this->input->get('id') : 0;
        if (!$id) {
            $this->session->set_flashdata('error', '参数错误1');
            redirect('no3/cashOrder');
        }

        $cash_order = $this->Order_model->getCashOrder($id);
        if (empty ($cash_order)) {
            $this->session->set_flashdata('error', '参数错误2');
            redirect('no3/cashOrder');
        }

        if ($cash_order ['status'] != CASH_ORDER_STATUS_NEW) {
            $this->session->set_flashdata('error', '参数错误3');
            redirect('no3/cashOrder');
        }
        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("reviewOrder: $id");
        $data = array(
            'status' => CASH_ORDER_STATUS_REVIEW_PASS,
            'update_time' => time(),
            'discribe' => $admin_name . '审核通过',
        );
        if ($this->Order_model->updateCashOrder($id, $data)) {
            $this->session->set_flashdata('success', '审核通过');
            redirect('no3/cashOrder');
        } else {
            $this->session->set_flashdata('error', '审核失败');
            redirect('no3/cashOrder');
        }
    }

    public function batchProcessAgain() {
        $admin_id = $this->session->userdata('id');
        $select_cash_ids = $this->input->post('select_cash_ids');
        if (empty ($select_cash_ids)) {
            $this->session->set_flashdata('error', '请选择订单');
            redirect('no3/cashOrder');
        }

        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("batchProcessAgain");
        $data1 = array(
            'status' => CASH_ORDER_STATUS_NEW,
            'update_time' => time(),
            'discribe' => $admin_name . '批量重新处理',
            'is_process' => 1
        );

        foreach ($select_cash_ids as $id) {
            $order = $this->Order_model->getCashOrder($id);
            if (!empty ($order)) {
                if ($order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) {
                    $this->Order_model->deleteOneBlack($order ['alipay_account'], $order ['alipay_real_name']);
                    $this->Order_model->updateCashOrder($id, $data1);
                } else if ($order['status'] == CASH_ORDER_STATUS_DEALING) {
                    $this->Order_model->updateCashOrder($id, $data1);
                } else if ($order['status'] == CASH_ORDER_STATUS_UNKNOWN) {
                    $this->Order_model->updateCashOrder($id, $data1);
                }
            }
        }

        $this->session->set_flashdata('success', '修改成功');
        redirect('no3/cashOrder');
    }

    public function processAgain() {
        $id = $this->input->get('id') ? $this->input->get('id') : 0;
        if (!$id) {
            $this->session->set_flashdata('error', '参数错误1');
            redirect('no3/cashOrder');
        }

        $cash_order = $this->Order_model->getCashOrder($id);
        if (empty ($cash_order)) {
            $this->session->set_flashdata('error', '参数错误2');
            redirect('no3/cashOrder');
        }
        if ($cash_order ['status'] != CASH_ORDER_STATUS_WAIT_REVIEW &&
            $cash_order['status'] != CASH_ORDER_STATUS_DEALING &&
            $cash_order['status'] != CASH_ORDER_STATUS_UNKNOWN
        ) {
            $this->session->set_flashdata('error', '参数错误3');
            redirect('no3/cashOrder');
        }
        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("processAgain: $id");
        $this->Order_model->deleteOneBlack($cash_order ['alipay_account'], $cash_order ['alipay_real_name']);

        $data = array(
            'status' => 0,
            'update_time' => time(),
            'discribe' => $admin_name . '重新处理',
            'is_process' => 1
        );
        if ($this->Order_model->updateCashOrder($id, $data)) {
            $this->session->set_flashdata('success', '重新处理成功');
            redirect('no3/cashOrder');
        } else {
            $this->session->set_flashdata('error', '重新处理失败');
            redirect('no3/cashOrder');
        }
    }

    /**
     * 查看支付宝相关日志数据
     */
    public function checkAlipayLogData() {
        $order_sn = $this->input->get('order_sn', true);
        if (empty($order_sn)) {
            $this->session->set_flashdata('error', '订单号不存在');
            redirect('no3/cashOrder');
        }

        $data = array(
            'menu' => $this->Common_model->getAdminMenuList(),
            "choose" => array(
                "father" => "财务管理",
                "child" => "提现订单"
            ),
            "header1" => array(
                "father" => "财务管理",
                "child" => "提现订单(查看支付宝日志数据)"
            ),
            'data' => $this->Order_model->getRelatedAlipayLogData($order_sn),
        );

        $this->load->view('no3/cash_order_alipay_data_view', $data);
    }

    /**
     * 设置订单成功
     */
    public function setCashOrderSuccess() {
        $id = $this->input->get('id', true);
        if (empty($id)) {
            $this->session->set_flashdata('error', '参数不正确');
            redirect('no3/cashOrder');
        }

        $admin_id = $this->session->userdata('id');
        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("setCashOrderSuccess: $id");
        $data1 = array(
            'status' => CASH_ORDER_STATUS_SUCCESS,
            'update_time' => time(),
            'discribe' => $admin_name . '确认转账成功',
        );

        $order = $this->Order_model->getCashOrder($id);
        if (!empty ($order)) {
            $data1 ['real_cash_money'] = intval($this->Order_model->calMoney($order ['cash_money'] / 100)) * 100;
            if (($order ['status'] == CASH_ORDER_STATUS_DEALING || $order ['status'] == CASH_ORDER_STATUS_UNKNOWN || $order ['status'] == CASH_ORDER_STATUS_WAIT_REVIEW) &&
                $this->Order_model->updateCashOrder($id, $data1)
            ) {
                $user_db_index = $this->User_model->getUserDBPos($order ['user_id']);
                if (!empty ($user_db_index)) {
                    $db1 = $this->load->database('eus' . $user_db_index ['dbindex'], true);
                    $sql = "UPDATE CASINOUSER_" . $user_db_index ['tableindex'] . " SET total_total_money = total_total_money + '" . $order ['cash_money'] . "' WHERE id = '" . $order ['user_id'] . "'";
                    $db1->query($sql);
                    $db1->close();
                }

                if ($this->Chat_model->createChatSession($order ['user_id'])) {
                    $data ['admin_id'] = $admin_id;
                    $data ['content'] = '您的兑换已经处理完毕，请查看支付宝账单,处理时间（' . date('Y-m-d H:i', $data1 ['update_time']) . '）';
                    $data ['user_id'] = $order ['user_id'];
                    $data ['add_time'] = time();
                    if ($this->Chat_model->insertMessage($data)) {
                        // 推送
                        $this->Push_model->addPushQueue($order ['user_id'], '您的兑换已成功');
                    }
                }
            }
        }

        $this->session->set_flashdata('success', '修改成功');
        redirect('no3/cashOrder');
    }

    public function clearBlackAlipayAccount() {
        // exit('123');
        $this->writeLog("clearBlackAlipayAccount");
        $this->Order_model->deleteBlack();
        $this->session->set_flashdata('success', '清空成功');
        redirect('no3/cashOrder');
    }

    private function writeLog($txt) {
        if (!$txt) {
            return;
        }
        $log_file = "/log/cashOrder.log";
        $handle = fopen($log_file, "a+");
        $admin_name = $this->session->userdata('admin_name');
        $txt = "[" . date('Y-m-d H:i:s', time()) . "][" . $this->getIp() . "][$admin_name] " . $txt;
        $str = fwrite($handle, $txt . "\n");
        fclose($handle);
    }

    private function getIp() {
        if (!empty ($_SERVER ["HTTP_CLIENT_IP"])) {
            $cip = $_SERVER ["HTTP_CLIENT_IP"];
        } elseif (!empty ($_SERVER ["HTTP_X_FORWARDED_FOR"])) {
            $cip = $_SERVER ["HTTP_X_FORWARDED_FOR"];
        } elseif (!empty ($_SERVER ["REMOTE_ADDR"])) {
            $cip = $_SERVER ["REMOTE_ADDR"];
        } else {
            $cip = "无法获取！";
        }
        return $cip;
    }

    private function cashAlipayTips() {
        $res = array(
            "00" => "支付宝提现已停止，请通知技术人员查看或开始人工提现",
            "01" => "支付宝提现已关闭，请通知技术人员查看",
            "11" => "支付宝提现运行中...",
            "10" => "支付宝提现异常，请通知技术人员重启进程！！！",
        );
        return $res;
    }

    private function ifGotoArtificialCash(&$tip_msg) {
        $tip_msg = "11";
        $admin_name = $this->session->userdata('admin_name');
        if (!$admin_name) {
            return false;
        }
        $tip_msg = $this->alipayCashStatus();
        if ("11" == $flag_str) {//正常运行，禁止人工
            return false;
        }
        if ("10" == $flag_str) {//提现进程异常！！！禁止人工
            return false;
        }
        if ("01" == $flag_str) {//总闸已经关闭，等待进程结束
            return false;
        }
        if ("00" == $flag_str) {//人为关闭或进程自行关闭,开始人工
            return true;
        }
        return false;
    }

    private function alipayCashStatus() {
        $ALIPAYCASHSWTICH_STATUS_KEY = "alipaycashswtich_status";
        $redis_config = $this->config->item('redis');
        $redis = new Redis ();
        $redis->connect($redis_config ['host'], $redis_config ['port']);
        $switch_status = $redis->get($ALIPAYCASHSWTICH_STATUS_KEY);
        $alipaycashps_status = $redis->exists($ALIPAYCASHSWTICH_STATUS_KEY . "_PS");//提现进程状态
        $redis->close();
        $a = "1";
        $b = "1";
        if ("open" != $switch_status) {
            $a = "0";
        }
        if (!$alipaycashps_status) {
            $b = "0";
        }
        return $a . $b;
    }

    public function setCashArtificial() {
        $admin_name = $this->session->userdata('admin_name');
        $ip = $this->getIp();

        //首先判断提现进程是否开启
        $tip_msg = "11";
        $artificialflag = $this->ifGotoArtificialCash($tip_msg);
        if (!$artificialflag) {
            $this->session->set_flashdata('error', '提现支付宝运行中，不可人工提现！');
            redirect('no3/cashOrder');
        }

        $id = $this->input->get('id', true);
        if (empty($id)) {
            $this->session->set_flashdata('error', '参数不正确');
            redirect('no3/cashOrder');
        }

        $admin_id = $this->session->userdata('id');
        $admin_name = $this->session->userdata('admin_name');
        $this->writeLog("setCashArtificial: $id");
        $order = $this->Order_model->getCashOrder($id);
        if (empty ($order)) {
            $this->session->set_flashdata('error', '订单不存在');
            redirect('no3/cashOrder');
        }
        if (CASH_ORDER_STATUS_NEW != $order['status'] && CASH_ORDER_STATUS_REVIEW_PASS != $order['status']) {
            $this->session->set_flashdata('error', '新建或审核通过订单，才可人工提现');
            redirect('no3/cashOrder');
            return false;
        }
        $data1 = array(
            'status' => CASH_ORDER_STATUS_DEALING,
            'update_time' => time(),
            'discribe' => $admin_name . '人工提现中...',
        );
        $flag = $this->Order_model->updateCashOrder($id, $data1);
        $info = $this->Order_model->getUserBankCardInfo($order['user_id']);
        if (!$info || empty($info)) {
            //未绑卡处理
            $flag0 = $this->cashNoBankcard($id, $order, $admin_name, $admin_id);
            $this->session->set_flashdata('error', '玩家未绑定银行卡');
            redirect('no3/cashOrder');
        } else {
            //打开转账界面
            $info['user_id'] = $order['user_id'];
            $info['order_sn'] = $id;
            $info['cash_money'] = intval($this->Order_model->calMoney($order ['cash_money'] / 100));
            $info['admin_name'] = $admin_name;
            $info['admin_id'] = $admin_id;
            echo $this->pageHtml("http://webapi.yuming.com/al/bt", $info);
        }


    }

    private function cashNoBankcard($id, $cash_order, $admin_name, $admin_id) {
        $data = array(
            'discribe' => "玩家未绑定银行卡 " . $admin_name,
            'status' => 2,
            'update_time' => time()
        );
        if ($this->Order_model->updateCashOrder($id, $data)) {
            $this->load->model('detail_model');
            $this->detail_model->score_operation_by_cash($cash_order ['user_id'], $cash_order ['cash_money']);

            // 客服消息和推送
            if ($this->Chat_model->createChatSession($cash_order ['user_id'])) {
                $data1 ['admin_id'] = $admin_id;
                $data1 ['content'] = '请绑定银行卡重试，您的兑换金币已返还到您的游戏账户，处理时间（' . date('Y-m-d H:i', $data ['update_time']) . '）';
                $data1 ['user_id'] = $cash_order ['user_id'];
                $data1 ['add_time'] = time();
                if ($this->Chat_model->insertMessage($data1)) {
                    // 推送
                    $this->Push_model->addPushQueue($cash_order ['user_id'], '您的兑换失败');
                }
            }
            return true;
        } else {
            return false;
        }
        return false;
    }

    public function pageHtml($Url, $PostArry) {
        if (!is_array($PostArry)) {
            throw new Exception ("无法识别的数据类型【PostArry】");
        }
        $FormString = "<body onLoad=\"document.actform.submit()\">loading...<form  id=\"actform\" name=\"actform\" method=\"post\" action=\"" . $Url . "\">";
        foreach ($PostArry as $key => $value) {
            $FormString .= "<input name=\"" . $key . "\" type=\"hidden\" value='" . $value . "'>\r\n";
        }
        $FormString .= "</form></body>";

        return $FormString;
    }
}
