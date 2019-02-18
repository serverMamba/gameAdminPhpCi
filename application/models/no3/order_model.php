<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Order_model extends CI_Model {
    var $choushui1 = 3; // 100以下扣3元
    var $choushui2 = 0.02; // 100以上扣2%

    public function __construct() {
        parent::__construct();
        $this->load->database('default');
    }

    public function isExistOrder($user_id, $transaction_id) {
        $this->db->select('id');
        $this->db->from('smc_order');
        $this->db->where('user_id', $user_id);
        $this->db->where('third_order_sn', $transaction_id);
        $this->db->where('status', 1);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertOrder($data) {
        return $this->db->insert('smc_order', $data);
    }

    public function getTodayBuy($user_id) {
        $start_time = strtotime("today");
        $this->db->select('SUM(money)/100 as todayBuy');
        $this->db->from('smc_order');
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 1);
        $this->db->where('add_time >= ', $start_time);
        $this->db->limit(1);
        $q = $this->db->get();
        $return_ary = $q->row_array();
        $todayBuy = intval($return_ary['todayBuy']);
        return $todayBuy;
    }

    public function getTodayCash($user_id) {
        $start_time = strtotime("today");
        $db1 = $this->load->database('cashorder1_slave', true);
        $db1->select('SUM(cash_money)/100 as todayCash');
        $db1->from('smc_cash_order');
        $db1->where('user_id', $user_id);
        $db1->where('status', 1);
        $db1->where('add_time >= ', $start_time);
        $db1->limit(1);
        $q1 = $db1->get();
        $db1->close();
        $return_ary1 = $q1->row_array();
        $todayCash1 = 0;
        if (!$return_ary1 || empty($return_ary1)) {
            $todayCash1 = 0;
        } else {
            $todayCash1 = intval($return_ary1['todayCash']);
        }

        $db2 = $this->load->database('cashorder2_slave', true);
        $db2->select('SUM(cash_money)/100 as todayCash');
        $db2->from('smc_cash_order');
        $db2->where('user_id', $user_id);
        $db2->where('status', 1);
        $db2->where('add_time >= ', $start_time);
        $db2->limit(1);
        $q2 = $db2->get();
        $db2->close();
        $return_ary2 = $q2->row_array();
        $todayCash2 = 0;
        if (!$return_ary2 || empty($return_ary2)) {
            $todayCash2 = 0;
        } else {
            $todayCash2 = intval($return_ary2['todayCash']);
        }

        $todayCash = $todayCash1 + $todayCash2;
        return $todayCash;
    }

    public function getOrder($agent_bill_id) {
        $this->db->select('id,status,user_id,money');
        $this->db->from('smc_order');
        $this->db->where('order_sn', $agent_bill_id);
        $this->db->limit(1);
        $q = $this->db->get();
        return $q->row_array();
    }

    public function getCashOrder($order_sn) {
        $db1 = $this->load->database('cashorder1_slave', true);
        $db1->from('smc_cash_order');
        $db1->where('order_sn', $order_sn);
        $db1->limit(1);
        $query = $db1->get();
        if ($query->num_rows() > 0) {
            $db1->close();
            return $query->row_array();
        } else {
            $db2 = $this->load->database('cashorder2_slave', true);
            $db2->from('smc_cash_order');
            $db2->where('order_sn', $order_sn);
            $db2->limit(1);
            $query2 = $db2->get();
            $db2->close();
            return $query2->row_array();
        }
    }

    public function getNoPorcessCashOrderNum() {
        $db1 = $this->load->database('cashorder1_slave', true);
        $db1->where("(status = 0 OR status = 3 OR status = 4 OR status=5 OR status=6)");
        $num1 = $db1->count_all_results('smc_cash_order');
        $db1->close();

        $db2 = $this->load->database('cashorder2_slave', true);
        $db2->where("(status = 0 OR status = 3 OR status = 4 OR status=5 OR status=6)");
        $num2 = $db2->count_all_results('smc_cash_order');
        $db2->close();

        return $num1 + $num2;
    }

    public function getCashOrderList($user_id, $alipay_account, $start_time, $end_time, $order_status, $order_sn) {
        $channel_list = $this->config->item('channellist');
        $start_time = strtotime($start_time . ' 00:00:00');
        $end_time = strtotime($end_time . ' 23:59:59');
        $db1 = $this->load->database('cashorder1_slave', true);
        $db1->from('smc_cash_order');
        if ($user_id) {
            $db1->where('user_id', $user_id);
        }
        if ($alipay_account) {
            $db1->where('alipay_account', $alipay_account);
        }
        if ($order_sn) {
            $db1->where('order_sn', $order_sn);
        }

        $checkCashMoney = ceil(CASH_ORDER_NEED_REVIEW_AMOUNT / (1 - $this->choushui2)) * 100;

        if ($order_status == CASH_ORDER_STATUS_NOT_COMPLETE) {
            // 包含：3、4、5状态，处理中但是超过两分钟的，新建但是需要审核，新建但是超过5分钟没处理
            $db1->where("(status = 3 OR status = 4 OR status=5 or (status = 6 and (unix_timestamp(now()) - update_time) > 120) or (status = 0 and cash_money > $checkCashMoney)  or (status = 0 and (unix_timestamp(now()) - add_time) > 300))");
        } else if ($order_status != CASH_ORDER_STATUS_ALL) {
            $db1->where('status', $order_status);
        }

        $db1->where('add_time >= ', $start_time);
        $db1->where('add_time <= ', $end_time);
        $db1->order_by('id', 'DESC');
        $db1->limit(40);
        $query = $db1->get();
        $return_ary1 = $query->result_array();

        $db2 = $this->load->database('cashorder2_slave', true);
        $db2->from('smc_cash_order');
        if ($user_id) {
            $db2->where('user_id', $user_id);
        }
        if ($alipay_account) {
            $db2->where('alipay_account', $alipay_account);
        }
        if ($order_sn) {
            $db2->where('order_sn', $order_sn);
        }

        if ($order_status == CASH_ORDER_STATUS_NOT_COMPLETE) {
            // 包含：3、4、5状态，处理中但是超过两分钟的，新建但是需要审核，新建但是超过5分钟没处理
            $db2->where("(status = 3 OR status = 4 OR status=5 or (status = 6 and (unix_timestamp(now()) - update_time) > 120) or (status = 0 and cash_money > $checkCashMoney)  or (status = 0 and (unix_timestamp(now()) - add_time) > 300))");
            // $db2->where ( "(status = 0 OR status = 3 OR status = 4 OR status=5 OR status=6)" );
        } else if ($order_status != CASH_ORDER_STATUS_ALL) {
            $db2->where('status', $order_status);
        }

        $db2->where('add_time >= ', $start_time);
        $db2->where('add_time < ', $end_time);
        $db2->order_by('id', 'DESC');
        $db2->limit(50);
        $query = $db2->get();
        $return_ary2 = $query->result_array();

        $return_ary = array_merge($return_ary1, $return_ary2);
        $this->sortArrByField($return_ary, 'add_time', true);
        $now = time();
        if (!empty ($return_ary)) {
            $todayBuyArr = array();
            $todayCashArr = array();
            $todayGoldHisArr = array();
            $this->load->model('api/User_model');
            foreach ($return_ary as $k => $v) {
                $return_ary [$k] ['cash_money'] = $v ['cash_money'] / 100;
                $return_ary [$k] ['cut_money'] = $this->calMoney($return_ary [$k] ['cash_money']);
                $return_ary[$k]['add_delay_time'] = $this->getDelayTimeText($now - $return_ary[$k]['add_time']);
                if ($return_ary[$k]['update_time']) {
                    $return_ary[$k]['update_delay_time'] = $this->getDelayTimeText($now - $return_ary[$k]['update_time']);
                } else {
                    $return_ary[$k]['update_delay_time'] = 0;
                }

                $user_db_index = $this->User_model->getUserDBPos($v ['user_id']);
                if (!empty ($user_db_index)) {
                    $db1 = $this->load->database('eus' . $user_db_index ['dbindex'], true);
                    $sql = "SELECT total_total_money,totalBuy FROM CASINOUSER_" . $user_db_index ['tableindex'] . " WHERE id = '" . $v ['user_id'] . "'";
                    $q = $db1->query($sql);
                    $db1->close();
                    $return_ary [$k] ['cash_total_money'] = $q->row()->total_total_money / 100;
                    $return_ary [$k] ['totalBuy'] = $q->row()->totalBuy / 100;
                } else {
                    $return_ary [$k] ['cash_total_money'] = 0;
                    $return_ary [$k] ['totalBuy'] = $q->row()->totalBuy / 100;
                }

                if (!array_key_exists($v ['user_id'], $todayBuyArr)) {
                    $todayBuyArr[$v ['user_id']] = $this->getTodayBuy($v ['user_id']);
                }
                $return_ary [$k] ['todayBuy'] = intval($todayBuyArr[$v ['user_id']]);
                if (!array_key_exists($v ['user_id'], $todayCashArr)) {
                    $todayCashArr[$v ['user_id']] = $this->getTodayCash($v ['user_id']);
                }
                $return_ary [$k] ['todayCash'] = intval($todayCashArr[$v ['user_id']]);
                if (!array_key_exists($v ['user_id'], $todayGoldHisArr)) {
                    $todayGoldHisArr[$v ['user_id']] = $this->queryTodayGoldHis($v ['user_id']);
                }
                $jd_his = $todayGoldHisArr[$v ['user_id']];
                $return_ary [$k] ['todayGoldRecNum'] = intval($jd_his['total_num']);
                $return_ary [$k] ['todayBuyRecNum'] = intval($jd_his['pay_num']);

                if (isset($channel_list [$v ['channel_id']])) {
                    $return_ary [$k] ['channel'] = $channel_list [$v ['channel_id']];
                } else {
                    $return_ary [$k] ['channel'] = "--";
                }
            }
        }

        return $return_ary;
    }

    /**
     * 获取提现订单列表 - 按查询方式1
     * @param $userId
     * @param $aliPayAccount
     * @param $orderId
     * @param $operator
     * @return array
     */
    public function getCashOrderListByTypeOne($userId, $aliPayAccount, $orderId, $operator) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $itemArr = [];

        // 获取adminId
        if ($operator !== '') {
            $db = $this->load->database('default_slave', true);
            $sql = 'select id from smc_admin where admin_name = ' . $this->db->escape($operator);
            $row = $db->query($sql)->row_array();
            if (empty($row)) {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = default_slave, sql = ' . $sql);
                return $finalRet;
            }
            $adminId = intval($row['id']);
            if ($adminId) {
                $itemArr[] = 'refer = ' . $adminId;
            }
        }

        $db1 = $this->load->database('cashorder1_slave', true);
        $sql1 = 'select * from smc_cash_order';

        $db2 = $this->load->database('cashorder2_slave', true);
        $sql2 = 'select * from smc_cash_order';

        $itemArr = [];
        if ($userId !== '') {
            $itemArr[] = 'user_id = ' . $userId;
        }
        if ($aliPayAccount !== '') {
            $itemArr[] = 'alipay_account = ' . $this->db->escape($aliPayAccount);
        }
        if ($orderId !== '') {
            $itemArr[] = 'order_sn = ' . $this->db->escape($orderId);
        }

        if (!empty($itemArr)) {
            $str = implode(' and ', $itemArr);

            $sql1 .= ' where ' . $str;

            $sql2 .= ' where ' . $str;
        }
        $sql1 .= ' order by id desc limit 40';

        $sql2 .= ' order by id desc limit 50';

        $rows1 = $db1->query($sql1)->result_array();
        $rows2 = $db2->query($sql2)->result_array();

        if (empty($rows1)) {
            $rows1 = [];
        }
        if (empty($rows2)) {
            $rows2 = [];
        }

        $rows = array_merge($rows1, $rows2);
        $this->sortArrByField($rows, 'add_time', true);

        if (!empty($rows)) {
            $rows = $this->formatCashOrderList($rows);
            $finalRet['content'] = $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ .
                ', db select return empty, db1 = cashorder1_slave, sql1 = ' . $sql1
                . ', db2 = cashorder2_slave, sql2 = ' . $sql2);

            return $finalRet;
        }

        return $finalRet;
    }

    /**
     * 获取提现订单列表 - 按查询方式2
     * @param $amountMin
     * @param $amountMax
     * @param $dateTimeBegin
     * @param $dateTimeEnd
     * @param bool $export
     * @return array
     */
    public function getCashOrderListByTypeTwo($amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd, $export = false) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $db1 = $this->load->database('cashorder1_slave', true);
        $sql1 = 'select * from smc_cash_order';

        $db2 = $this->load->database('cashorder2_slave', true);
        $sql2 = 'select * from smc_cash_order';

        $itemArr = [];
        if ($amountMin !== '') {
            $itemArr[] = 'cash_money >= ' . $amountMin;
        }
        if ($amountMax !== '') {
            $itemArr[] = 'cash_money <= ' . $amountMax;
        }
        if ($dateTimeBegin !== '') {
            $itemArr[] = 'add_time >= ' . strtotime($dateTimeBegin);
        }
        if ($dateTimeEnd !== '') {
            $itemArr[] = 'add_time <= ' . strtotime($dateTimeEnd);
        }

        if (!empty($itemArr)) {
            $str = implode(' and ', $itemArr);

            $sql1 .= ' where ' . $str;

            $sql2 .= ' where ' . $str;
        }

        if (!$export) {
            $sql1 .= ' order by id desc limit 40';
            $sql2 .= ' order by id desc limit 50';
        }

        $rows1 = $db1->query($sql1)->result_array();
        $rows2 = $db2->query($sql2)->result_array();

        if (empty($rows1)) {
            $rows1 = [];
        }
        if (empty($rows2)) {
            $rows2 = [];
        }

        $rows = array_merge($rows1, $rows2);
        $this->sortArrByField($rows, 'add_time', true);

        if (!empty($rows)) {
            $rows = $this->formatCashOrderList($rows);
            $finalRet['content'] = $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ .
                ', db select return empty, db1 = cashorder1_slave, sql1 = ' . $sql1
                . ', db2 = cashorder2_slave, sql2 = ' . $sql2);

            return $finalRet;
        }

        return $finalRet;
    }

    /**
     * 格式化
     * @param $return_ary
     * @return mixed
     */
    public function formatCashOrderList($return_ary) {
        if (!empty($return_ary)) {
            $now = time();

            $todayBuyArr = array();
            $todayCashArr = array();
            $todayGoldHisArr = array();
            $this->load->model('api/User_model');
            foreach ($return_ary as $k => $v) {
                $return_ary [$k] ['cash_money'] = $v ['cash_money'] / 100;
                $return_ary [$k] ['cut_money'] = $this->calMoney($return_ary [$k] ['cash_money']);
                $return_ary[$k]['add_delay_time'] = $this->getDelayTimeText($now - $return_ary[$k]['add_time']);
                if ($return_ary[$k]['update_time']) {
                    $return_ary[$k]['update_delay_time'] = $this->getDelayTimeText($now - $return_ary[$k]['update_time']);
                } else {
                    $return_ary[$k]['update_delay_time'] = 0;
                }

                $user_db_index = $this->User_model->getUserDBPos($v ['user_id']);
                if (!empty ($user_db_index)) {
                    $db1 = $this->load->database('eus' . $user_db_index ['dbindex'], true);
                    $sql = "SELECT total_total_money,totalBuy FROM CASINOUSER_" . $user_db_index ['tableindex'] . " WHERE id = '" . $v ['user_id'] . "'";
                    $q = $db1->query($sql);
                    $db1->close();
                    $return_ary [$k] ['cash_total_money'] = $q->row()->total_total_money / 100;
                    $return_ary [$k] ['totalBuy'] = $q->row()->totalBuy / 100;
                } else {
                    $return_ary [$k] ['cash_total_money'] = 0;
                    $return_ary [$k] ['totalBuy'] = 0;
                }

                if (!array_key_exists($v ['user_id'], $todayBuyArr)) {
                    $todayBuyArr[$v ['user_id']] = $this->getTodayBuy($v ['user_id']);
                }
                $return_ary [$k] ['todayBuy'] = intval($todayBuyArr[$v ['user_id']]);
                if (!array_key_exists($v ['user_id'], $todayCashArr)) {
                    $todayCashArr[$v ['user_id']] = $this->getTodayCash($v ['user_id']);
                }
                $return_ary [$k] ['todayCash'] = intval($todayCashArr[$v ['user_id']]);
                if (!array_key_exists($v ['user_id'], $todayGoldHisArr)) {
                    $todayGoldHisArr[$v ['user_id']] = $this->queryTodayGoldHis($v ['user_id']);
                }
                $jd_his = $todayGoldHisArr[$v ['user_id']];
                $return_ary [$k] ['todayGoldRecNum'] = intval($jd_his['total_num']);
                $return_ary [$k] ['todayBuyRecNum'] = intval($jd_his['pay_num']);

                if (isset($channel_list [$v ['channel_id']])) {
                    $return_ary [$k] ['channel'] = $channel_list [$v ['channel_id']];
                } else {
                    $return_ary [$k] ['channel'] = "--";
                }
            }
        }

        return $return_ary;
    }

    /**
     * 导出
     * @param $amountMin
     * @param $amountMax
     * @param $dateTimeBegin
     * @param $dateTimeEnd
     */
    public function exportData($amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd) {
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="提现订单.csv"');
        header('Cache-Control: max-age=0');

        $finalRet = $this->getCashOrderListByTypeTwo($amountMin, $amountMax, $dateTimeBegin, $dateTimeEnd,  true);
        $rows = $finalRet['content'];

        $ret = [];
        foreach ($rows as $row) {
            $tmpArr = [];
            $tmpArr['userId'] = $row['id'];
            $tmpArr['order_sn'] = $row['order_sn'];
            $tmpArr['totalBuy'] = $row['totalBuy'];
            $tmpArr['cash_total_money'] = $row['cash_total_money'];

            $tmpArr['cash_money'] = $row['cash_money'];
            $tmpArr['cut_money'] = $row['cut_money'];
            $tmpArr['cash_send_money'] = $row['cash_send_money'];
            $tmpArr['balance'] = $row['balance'];

            $tmpArr['add_time'] = date('Y-m-d H:i:s', $row['add_time']);
            $tmpArr['alipay_account'] = $row['alipay_account'];
            $tmpArr['alipay_real_name'] = $row['alipay_real_name'];
            $tmpArr['channel'] = $row['channel'];

            $tmpArr['status'] = $row['status'];
            $tmpArr['update_time'] = $row['update_time'] ? $row['update_time'] : '-';
            $tmpArr['discribe'] = $row['discribe'];

            $ret[] = $tmpArr;
        }

        $fp = fopen('php://output', 'a');

        $head = [
            "用户ID", "提现订单号", "总充值", "总提现",
            "实际提现金额", "扣除手续费后金额", "提现赠送金额", "提现后金币",
            "提现时间", "支付宝账号", "支付宝实名", "渠道",
            "状态", "处理完成/退款时间", "	描述"
        ];
        foreach ($head as $i => $v) {
            $head[$i] = iconv('utf-8', 'gbk', $v);
        }

        fputcsv($fp, $head);

        $cnt = 0;
        $limit = 100000;

        foreach ($ret as $index => $row) {
            $cnt++;
            if ($limit == $cnt) {
                ob_flush();
                flush();
                $cnt = 0;
            }

            foreach ($row as $i => $v) {
                $row[$i] = iconv('utf-8', 'gbk', $v) . "\t";
            }
            fputcsv($fp, $row);
        }
    }


    function sortArrByField(&$array, $field, $desc = false) {
        $fieldArr = array();
        foreach ($array as $k => $v) {
            $fieldArr [$k] = $v [$field];
        }
        $sort = $desc == false ? SORT_ASC : SORT_DESC;
        array_multisort($fieldArr, $sort, $array);
    }

    public function calMoney($money) {
        if ($money <= 100) {
            $money = $money - $this->choushui1;
        } else {
            $money = floor($money * (1 - $this->choushui2));
        }
        return $money;
    }

    public function updateCashOrder($order_sn, $data) {
        $db1 = $this->load->database('cashorder1', true);
        $db1->where('order_sn', $order_sn);
        $r1 = $db1->update('smc_cash_order', $data);

        $db2 = $this->load->database('cashorder2', true);
        $db2->where('order_sn', $order_sn);
        $r2 = $db2->update('smc_cash_order', $data);

        $db1->close();
        $db2->close();
        if ($r1 || $r2) {
            return true;
        } else {
            return false;
        }
    }

    public function insertBlack($data) {
        return $this->db->insert('smc_black_alipay_account', $data);
    }

    public function deleteBlack() {
        $this->db->where('is_lock ', 0);
        return $this->db->delete('smc_black_alipay_account');
    }

    public function deleteOneBlack($alipay_account, $alipay_real_name) {
        $this->db->where('alipay_account ', $alipay_account);
        $this->db->where('alipay_real_name ', $alipay_real_name);
        return $this->db->delete('smc_black_alipay_account');
    }

    public function getBlackRecNum($alipay_account, $alipay_real_name) {
        if ($alipay_real_name) {
            if (!$alipay_account || empty($alipay_account)) {
                $alipay_account = "*";
            }
            $this->db->from('smc_black_alipay_account');
            $this->db->where("(alipay_account = '" . $alipay_account . "' AND alipay_real_name = '" . $alipay_real_name . "') OR (alipay_account = '*' AND alipay_real_name = '" . $alipay_real_name . "')");
            $query = $this->db->get();
            return $query->num_rows();
        }
        return 0;
    }

    /**
     * 获取提现订单相关支付宝数据
     * @param string $orderSN
     */
    public function getRelatedAlipayLogData($orderSN) {
        $retData = array();
        // 1. 首先获取提现订单数据
        $orderData = $this->getCashOrder($orderSN);
        $orderData['cut_money'] = $this->calMoney($orderData['cash_money']);

        $retData['orderData'] = $orderData;

        // 2. 通过把支付宝帐号和支付宝名字用星号代替，然后再通过时间匹配找到可能相关的数据
        $alipayLogData = array();

        $retData['alipayLogData'] = $alipayLogData;
        return $retData;
    }

    private function getDelayTimeText($sec) {
        if ($sec < 60) {
            return $sec . "秒";
        } else if ($sec < 60 * 60) {
            return intval($sec / 60) . "分" . ($sec % 60) . "秒";
        } else if ($sec < 24 * 60 * 60) {
            $hour = intval($sec / 3600);
            $minutes = intval(($sec % 3600) / 60);
            $seconds = $sec % 60;
            return $hour . "时" . $minutes . "分" . $seconds . "秒";
        } else {
            $day = intval($sec / (3600 * 24));
            $leftSec = $sec % (3600 * 24);
            $hour = intval($leftSec / 3600);
            $minutes = intval(($leftSec % 3600) / 60);
            $seconds = $leftSec % 60;
            return $day . "天" . $hour . "时" . $minutes . "分" . $seconds . "秒";
        }
    }

    public function getOrderAllInfo($orderSN) {
        $this->db->select('*');
        $this->db->from('smc_order');
        $this->db->where('order_sn', $orderSN);
        $this->db->limit(1);
        $q = $this->db->get();
        $this->db->close();
        return $q->row_array();
    }

    public function createBatchLogTab() {
        $db2 = $this->load->database('cashorder2', true);
        $sql = "CREATE TABLE IF NOT EXISTS `smc_log_batch_cash_order` (
				  `id` int(10) NOT NULL AUTO_INCREMENT,
				  `order_sn` varchar(25) NOT NULL,
				  `status_old` tinyint(1) NOT NULL DEFAULT '0',
				  `update_time` int(11) NOT NULL DEFAULT '0',
				  `admin_name` varchar(100) NOT NULL DEFAULT '',
				  `action` varchar(25) NOT NULL DEFAULT 'batchSuccess', 
				  PRIMARY KEY (`id`),
				  UNIQUE KEY `order_sn` (`order_sn`),
				  KEY `status_old` (`status_old`) USING BTREE,
				  KEY `update_time` (`update_time`) USING BTREE,
				  KEY `admin_name` (`admin_name`) USING BTREE,
				  KEY `action` (`action`) USING BTREE
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;";
        $res = $db2->query($sql);
        $db2->close();
        return $res;
    }

    public function logBatchCashOrder($order_sn, $status_old, $update_time, $admin_name, $action) {
        if (!$order_sn || 1 === $status_old) {
            return false;
        }
        $db2 = $this->load->database('cashorder2', true);
        $sql = "INSERT INTO `smc_log_batch_cash_order`(`order_sn`,`status_old`,`update_time`,`admin_name`,`action`) VALUES ('" . $order_sn . "', '" . $status_old . "', '" . $update_time . "', '" . $admin_name . "', '" . $action . "');";
        $res = $db2->query($sql);
        $db2->close();
        return $res;
    }

    public function writeLog($txt, $dayflag = false) {
        if (!$txt) {
            return;
        }
        $filename = "order_model";
        if ($dayflag) {
            $filename = $filename . date('_Y-m-d', time());
        }
        $log_file = "/log/" . $filename . ".log";
        $handle = fopen($log_file, "a+");
        $txt = "[" . date('Y-m-d H:i:s', time()) . "] " . " " . $txt;
        $str = fwrite($handle, $txt . "\n");
        fclose($handle);
    }


    public function getUserBankCardInfo($user_id) {
        $user_id = intval($user_id);
        if ($user_id) {
            $this->db->select('bankcard_account,bank_name,bankcard_holder_name,bank_branch,bank_city,bankcard_change_time');
            $this->db->from('smc_user_bankcard');
            $this->db->where('user_id', $user_id);
            $this->db->limit(1);
            $query = $this->db->get();
            $bankcard_info = $query->row_array();
            return $bankcard_info;
        }
        return null;
    }

    public function queryTodayGoldHis($userid) {
        $userid = intval($userid);
        $res = array("total_num" => 0, "pay_num" => 0);
        if ($userid) {
            try {
                $dbhis = $this->load->database('gamehis', true);
                $tablename = "CASINOGAMEHISTORY" . date('Ymd', time());
                $mystarttime = date("Y-m-d", time());
                $mystarttime = $mystarttime . " 00:00:00";
                $sql = " select gamecode,count(1) as rec_num from $tablename where happentime  >= '$mystarttime' and userid = $userid group by gamecode ";
                $query = $dbhis->query($sql);
                $ret = $query->result_array();
                $dbhis->close();

                if ($ret && is_array($ret) && count($ret) > 0) {
                    foreach ($ret as $row) {
                        $rec_num = intval($row['rec_num']);
                        $res['total_num'] = $res['total_num'] + $rec_num;
                        if ($row['gamecode'] . "" == '999990') {
                            $res['pay_num'] = $rec_num;
                        }
                    }
                }
                return $res;
            } catch (Exception $e) {
            }
        }

        return $res;
    }


}
