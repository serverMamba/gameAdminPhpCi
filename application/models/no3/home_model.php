<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Admin_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    /**
     * 获取总数据
     * @return array
     */
    public function getTotalData() {

        return [];
    }

    /**
     * 获取指定时间段数据
     * @param $channelId
     * @param $dateTimeBegin
     * @param $dateTimeEnd
     * @param $start
     * @param $per
     * @return array
     */
    public function getTimeData($channelId, $dateTimeBegin, $dateTimeEnd, $start, $per) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $db = $this->load->database('default_slave', true);

        $itemArr = [];

        $sql = 'select o.*, a.admin_name from smc_order o left join smc_admin a on o.refer = a.id';
        $sqlCount = 'select count(*) as totalNum from smc_order o left join smc_admin a on o.refer = a.id';

        if (!empty($itemArr)) {
            $str = implode(' and ', $itemArr);
            $sql .= ' where ' . $str;
            $sqlCount .= ' where ' . $str;
        }
        $sql .= ' limit ' . $start . ', ' . $per;

        $rows = $db->query($sql)->result_array();

        if (!empty($rows)) {
            $finalRet['content'] = $rows;

            $rowCount = $db->query($sqlCount)->row_array();
            if (!empty($rowCount)) {
                $finalRet['totalNum'] = intval($rowCount['totalNum']);
            } else {
                log_message('error', __METHOD__ . ', ' . __LINE__ .
                    ', db select return empty, db = default_slave' . ', sqlCount = ' . $sqlCount);
            }
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ .
                ', db select return empty, db = default_slave' . ', sql = ' . $sql);

            return $finalRet;
        }

        return $finalRet;
    }

    /**
     * 获取详细 - 营收
     * @return array
     */
    public function getDetailRevenue() {

        return [];
    }

    /**
     * 获取详细 - 充值
     * @return array
     */
    public function getDetailRecharge() {

        return [];
    }

    /**
     * 获取详细 - 兑换
     * @return array
     */
    public function getDetailExchange() {

        return [];
    }

    /**
     * 获取详细 - 总金币
     * @return array
     */
    public function getDetailTotalGold() {

        return [];
    }

    /**
     * 获取详细 - 注册用户数
     * @return array
     */
    public function getDetailRegisterNum() {

        return [];
    }

    /**
     * 获取详细 - 登陆用户数
     * @return array
     */
    public function getDetailLoginNum() {

        return [];
    }

    /**
     * 获取详细 - 总税收
     * @return array
     */
    public function getDetailTotalTax() {

        return [];
    }

    /**
     * 获取详细 - 游戏记录
     * @return array
     */
    public function getDetailGameRecord() {

        return [];
    }
}