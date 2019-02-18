<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getUserRegisterList($start_time, $end_time, $start, $per) {
        $db = $this->load->database('gamehis', true);
        $table_name = 'CASINOREGISTERHISTORY';
        $db_start = strtotime($start_time . ' 00:00:00');
        $db_end = strtotime($end_time . ' 00:00:00');

        $sql_ary = array();
        for ($i = $db_start; $i <= $db_end; $i += 3600 * 24) {
            array_push($sql_ary, '(SELECT * from CASINOREGISTERHISTORY' . date('Ymd', $i) . ')');
        }

        if (empty ($sql_ary)) {
            return array();
        }

        $sql = implode(' UNION ALL ', $sql_ary);
        $sql .= " ORDER BY registertime DESC LIMIT $start,$per";
        $query = $db->query($sql);
        $db->close();
        return $query->result_array();
    }

    public function getUserRegisterNum($start_time, $end_time) {
        $db = $this->load->database('gamehis', true);
        $table_name = 'CASINOREGISTERHISTORY';
        $db_start = strtotime($start_time . ' 00:00:00');
        $db_end = strtotime($end_time . ' 00:00:00');

        $sql_ary = array();
        for ($i = $db_start; $i <= $db_end; $i += 3600 * 24) {
            array_push($sql_ary, '(SELECT * from CASINOREGISTERHISTORY' . date('Ymd', $i) . ')');
        }

        if (empty ($sql_ary)) {
            return array();
        }

        $sql = "SELECT count(*) AS register_num FROM (" . implode(' UNION ALL ', $sql_ary) . ") AS reg";
        $query = $db->query($sql);
        $db->close();
        return $query->row()->register_num;
    }

    public function getUserDBPosByAccount($account) {
        $host = HASH_SERVER_IP;
        $port = HASH_SERVER_PORT;

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP) or die ('Could not create socket');
        $conn = socket_connect($socket, $host, $port);

        socket_write($socket, $account);
        $str = socket_read($socket, 1024); /* 倒数第二位为库索引，倒数第一位为表索引 */
        socket_close($socket);

        // 防止溢出，截取后8位
        $str = substr($str, -8);
        $str = strrev(dechex($str));
        $tb = hexdec($str{0});
        $db = hexdec($str{1});

        $ret = array(
            'useraccount' => $account,
            'dbindex' => $db,
            'tableindex' => $tb
        );
        return $ret;
    }

    public function getUserInfoByAccount($account) {
        $user_db_index = $this->getUserDBPosByAccount($account);
        if (!$user_db_index) {
            return array();
        }
        $db1 = $this->load->database('eus' . $user_db_index ['dbindex'], true);
        $db1->select('*');
        $db1->from('CASINOUSER_' . $user_db_index ['tableindex']);
        $db1->where('user_email', $account);
        $db1->limit(1);
        $query = $db1->get();
        $user_info = $query->row_array();
        if (empty($user_info)) {
            $db1->select('*');
            $db1->from('CASINOOLDACCOUNT2NEWACCOUNT_' . $user_db_index ['tableindex']);
            $db1->where('newuseraccount', $account);
            $db1->limit(1);
            $query = $db1->get();
            $db_index = $query->row_array();
            if (!empty($db_index)) {
                $db2 = $this->load->database('eus' . $db_index ['dbindex'], true);
                $db2->select('*');
                $db2->from('CASINOUSER_' . $db_index ['tableindex']);
                $db2->where('user_email', $account);
                $db2->limit(1);
                $query = $db2->get();
                $db2->close();
                $user_info = $query->row_array();
            }
        }
        $db1->close();
        return $user_info;
    }

    /**
     * 用户 - 获取
     * @param $userId
     * @param $dateBegin
     * @param $dateEnd
     * @param $account
     * @param $mobileNumber
     * @param $realName
     * @param $aliPayAccount
     * @return array
     */
    public function userGet($userId, $dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $indexArr = $this->Common_model->getUserDBPos($userId);
        $dbIndex = $indexArr['dbindex'];
        $tableIndex = $indexArr['tableindex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;
        $sql = 'select id, user_email, registertime, userIDCardName, user_chips from ' . $tableName;
        $sql .= ' where id = ' . $userId;

        if ($dateBegin !== '') {
            $item[] = 'registertime >= ' . $this->db->escape($dateBegin);
        }
        if ($dateEnd !== '') {
            $dateEnd = date('Y-m-d H:i:s', strtotime($dateEnd) + daySeconds);
            $item[] = 'registertime < ' . $this->db->escape($dateEnd);
        }
        if ($account !== '') {
            $item[] = 'user_email = ' . $this->db->escape($account);
        }
        if ($realName) {
            $item[] = 'userIDCardName = ' . $this->db->escape($realName);
        }
        if ($mobileNumber !== '') {
            $item[] = 'mobile_number = ' . $this->db->escape($mobileNumber);
        }
        if ($aliPayAccount !== '') {
            $item[] = 'alipay_account = ' . $this->db->escape($aliPayAccount);
        }

        if (!empty($item)) {
            $sql .= ' and ' . implode(' and ', $item);
        }
        $sql .= ' limit 1';

        $rows = $db->query($sql)->result_array();

        if (!empty($rows)) {
            $rows[0]['userSealStatus'] = $this->getUserSealStatus($userId) === 1 ? '禁用' : '启用';

            // 是否在线 - redisdb14, hash键user_dispatch, 中存在子键userId则在线, 否则不在线 (因为服务端是在析构函数中删除相应键的, 服务器关闭时不会自动清空这个键, 可以手动清空)
            $redisConfig = $this->config->item('redis');
            $redis = new Redis();
            $redis->connect($redisConfig['host'], $redisConfig['port']);
            if (!empty($redisConfig['pass'])) {
                $redis->auth($redisConfig['pass']);
            }
            $redis->select(14);

            $key = 'user_dispatch';
            $hashKey = $userId;
            $rows[0]['online'] = $redis->hExists($key, $hashKey) ? 1 : 0;

            $finalRet['content'] = $rows;
            $finalRet['totalNum'] = 1;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);
        }

        return $finalRet;
    }

    /**
     * 用户列表 - 获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $account
     * @param $mobileNumber
     * @param $realName
     * @param $aliPayAccount
     * @param $start
     * @param $per
     * @return array
     */
    public function userListGet($dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount, $start, $per) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];
        $content = [];

        $where = '';

        if ($dateBegin !== '') {
            $item[] = 'registertime >= ' . $this->db->escape($dateBegin);
        }
        if ($dateEnd !== '') {
            $dateEnd = date('Y-m-d H:i:s', strtotime($dateEnd) + daySeconds);
            $item[] = 'registertime < ' . $this->db->escape($dateEnd);
        }
        if ($account !== '') {
            $item[] = 'user_email = ' . $this->db->escape($account);
        }
        if ($realName) {
            $item[] = 'userIDCardName = ' . $this->db->escape($realName);
        }
        if ($mobileNumber !== '') {
            $item[] = 'mobile_number = ' . $this->db->escape($mobileNumber);
        }
        if ($aliPayAccount !== '') {
            $item[] = 'alipay_account = ' . $this->db->escape($aliPayAccount);
        }

        if (!empty($item)) {
            $where .= ' where ' . implode(' and ', $item);
        }

        for ($i = 0; $i <= 15; $i++) {
            $db = $this->load->database('eus' . $i, true);

            $sql = '';

            $tablePrefix = 'casinouser_';
            for ($j = 0; $j <= 15; $j++) {
                $tableName = $tablePrefix . $j;
                if (!empty($sql)) {
                    $sql .= ' union all ';
                }
                $sql .= 'select id, user_level, user_email, registertime, userIDCardName, user_chips';
                $sql .= ' from ' . $tableName;
                $sql .= $where;
            }
            $rows = $db->query($sql)->result_array();

            if (!empty($rows)) {
                $content = array_merge($content, $rows);
            } else {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $i
                    . ', tablePrefix = ' . $tablePrefix . ', sql = ' . $sql);
            }
        }

        if (!empty($content)) {
            $totalNum = count($content);

            array_multisort(array_column($content, 'id'), SORT_DESC, $content);
            $content = array_slice($content, $start, $per);

            $redisConfig = $this->config->item('redis');
            $redis = new Redis();
            $redis->connect($redisConfig['host'], $redisConfig['port']);
            if (!empty($redisConfig['pass'])) {
                $redis->auth($redisConfig['pass']);
            }
            $redis->select(14);

            foreach ($content as &$v) {
                $v['userSealStatus'] = $this->getUserSealStatus($v['id']) === 1 ? '禁用' : '启用';

                // 是否在线 - redisdb14, hash键user_dispatch, 中存在子键userId则在线, 否则不在线 (因为服务端是在析构函数中删除相应键的, 服务器关闭时不会自动清空这个键, 可以手动清空)
                $key = 'user_dispatch';
                $hashKey = $v['id'];
                $v['online'] = $redis->hExists($key, $hashKey) ? 1 : 0;
            }
            unset($v);

            $finalRet['content'] = $content;
            $finalRet['totalNum'] = $totalNum;
        }

        return $finalRet;
    }

    /**
     * 用户登录日志 - 根据userId获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $userId
     * @param $ip
     * @param $start
     * @param $per
     * @return array
     */
    public function userLoginLogGetByUserId($dateBegin, $dateEnd, $userId, $ip, $start, $per) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $indexArr = $this->Common_model->getUserDBPos($userId);
        $dbIndex = $indexArr['dbindex'];
        $tableIndex = $indexArr['tableindex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;

        $sql = 'select id, last_login_time, lastLoginIp, location, activate_device'; // activate_device, uuid, lastLoginMac哪个是设备
        $sql .= ' from ' . $tableName;
        $sql .= ' where id = ' . $userId;

        $sqlCount = 'select count(*) as totalNum from ' . $tableName . ' where id = ' . $userId;

        $item = [];
        if ($dateBegin !== '') {
            $tsBegin = strtotime($dateBegin);
            $item[] = 'last_login_time >= ' . $tsBegin;
        }
        if ($dateEnd !== '') {
            $tsEnd = strtotime($dateEnd) + daySeconds;
            $item[] = 'last_login_time < ' . $tsEnd;
        }
        if ($ip !== '') {
            $item[] = 'lastLoginIp = ' . $this->db->escape($ip);
        }

        if (!empty($item)) {
            $sql .= ' and ' . implode(' and ', $item);
            $sqlCount .= ' and ' . implode(' and ', $item);
        }

        $sql .= ' order by last_login_time desc limit ' . $start . ', ' . $per;

        $rows = $db->query($sql)->result_array();
        $rowCount = $db->query($sqlCount)->row_array();

        if (!empty($rows)) {
            foreach ($rows as &$row) {
                $row['last_login_time'] = date('Y-m-d H:i:s', $row['last_login_time']);
            }
            unset($row);
            $finalRet['content'] = $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);
        }

        if (!empty($rowCount)) {
            $finalRet['totalNum'] = intval($rowCount['totalNum']);
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sqlCount);
        }

        return $finalRet;
    }

    /**
     * 用户登陆日志 - 获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $ip
     * @param $start
     * @param $per
     * @return array
     */
    public function userLoginLogGet($dateBegin, $dateEnd, $ip, $start, $per) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];
        $content = [];

        $where = '';

        if ($dateBegin !== '') {
            $tsBegin = strtotime($dateBegin);
            $item[] = 'last_login_time >= ' . $tsBegin;
        }
        if ($dateEnd !== '') {
            $tsEnd = strtotime($dateEnd) + daySeconds;
            $item[] = 'last_login_time < ' . $tsEnd;
        }
        if ($ip !== '') {
            $item[] = 'ip = ' . $this->db->escape($ip);
        }

        if (!empty($item)) {
            $where .= ' where ' . implode(' and ', $item);
        }

        for ($i = 0; $i <= 15; $i++) {
            $db = $this->load->database('eus' . $i, true);

            $sql = '';

            $tablePrefix = 'casinouser_';
            for ($j = 0; $j <= 15; $j++) {
                $tableName = $tablePrefix . $j;
                if (!empty($sql)) {
                    $sql .= ' union all ';
                }
                $sql .= 'select id, last_login_time, lastLoginIp, location, activate_device';
                $sql .= ' from ' . $tableName;
                $sql .= $where;
            }
            $rows = $db->query($sql)->result_array();

            if (!empty($rows)) {
                $content = array_merge($content, $rows);
            } else {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $i
                    . ', tablePrefix = ' . $tablePrefix . ', sql = ' . $sql);
            }
        }

        if (!empty($content)) {
            array_multisort(array_column($content, 'id'), SORT_DESC, $content);

            $totalNum = count($content);
            $content = array_slice($content, $start, $per);
            foreach ($content as &$row) {
                $row['last_login_time'] = date('Y-m-d H:i:s', $row['last_login_time']);
            }
            unset($row);

            $finalRet['content'] = $content;
            $finalRet['totalNum'] = $totalNum;
        }

        return $finalRet;
    }

    /**
     * 用户投注记录 - 获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $gameId
     * @param $baseScore
     * @param $userId
     * @param $start
     * @param $per
     * @return array
     */
    public function betRecordGet($dateBegin, $dateEnd, $gameId, $baseScore, $userId, $start, $per) {
        $finalRet = [
            'content' => [],
            'totalNum' => 0
        ];

        $db = $this->load->database('gamehis', true);
        $sql = $this->betRecordGetGenerateSql($db, $dateBegin, $dateEnd, $gameId, $baseScore, $userId);

        if (empty($sql)) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', sql empty, dateBegin = ' . $dateBegin . ', dateEnd = ' . $dateEnd
                . ', gameId = ' . $gameId . ', baseScore = ' . $baseScore . ', userId = ' . $userId);
            return $finalRet;
        }

        $rows = $db->query($sql)->result_array();
        if (!empty($rows)) {
            $totalNum = count($rows);
            array_multisort(array_column($rows, 'recordTimestamp'), SORT_DESC, $rows);
            $content = array_slice($rows, $start, $per);

            foreach ($content as &$row) {
                $row['roomBaseScore'] = isset($row['roomBaseScore']) ? $row['roomBaseScore'] : baiRenBaseScore;
                $row['roomBaseScore'] = number_format($row['roomBaseScore'] / 100, 2, '.', ' ');

                $row['userGameResult'] = intval($row['userGameResult'] / 100); // todo 数据库中单位是什么, 需要精确到分
                $row['userScoreBegin'] = intval($row['userScoreBegin'] / 100);
                $row['userScoreEnd'] = intval($row['userScoreEnd'] / 100);

//                $row['userGameResult'] = number_format($row['userGameResult'] / 100, 2, '.', ' ');
//                $row['userScoreBegin'] = number_format($row['userScoreBegin'] / 100, 2, '.', ' ');
//                $row['userScoreEnd'] = number_format($row['userScoreEnd'] / 100, 2, '.', ' ');
            }
            unset($row);

            $finalRet['content'] = $content;
            $finalRet['totalNum'] = $totalNum;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = gamehis, sql = ' . $sql);
        }

        return $finalRet;
    }

    /**
     * 用户标签 - 获取
     * @return array
     */
    public function userTagGet() {
        $numArr = [];
        for ($i = 0; $i <= 15; $i++) {
            $db = $this->load->database('eus' . $i, true);

            $sql = '';

            $tablePrefix = 'casinouser_';
            for ($j = 0; $j <= 15; $j++) {
                $tableName = $tablePrefix . $j;
                if (!empty($sql)) {
                    $sql .= ' union all ';
                }
                $sql .= 'select userTag, count(*) as num from ' . $tableName . ' where userTag != 0';
            }
            $rows = $db->query($sql)->result_array();

            if (!empty($rows)) {
                $numArr = array_merge($numArr, $rows);
            } else {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $i
                    . ', tablePrefix = ' . $tablePrefix . ', sql = ' . $sql);
            }
        }

        $numRetArr = [];
        if (!empty($numArr)) {
            foreach ($numArr as $v) {
                $userTag = intval($v['userTag']);
                $num = intval($v['num']);

                $numRetArr[$userTag] += $num;
            }
        }

        $db = $this->load->database('default', true);
        $sql = 'select id, name, sort, autoMoney from smc_user_tag order by id desc limit ' . maxQueryNum;
        $rows = $db->query($sql)->result_array();

        if (!empty($rows)) {
            foreach ($rows as &$row) {
                $id = intval($row['id']);
                $row['personNum'] = isset($numRetArr[$id]) ? $numRetArr[$id] : 0;
            }
            unset($row);

            return $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = default, sql = ' . $sql);
            return [];
        }
    }

    /**
     * 用户标签 - 添加
     * @param $name
     * @param $autoMoney
     * @param $sort
     * @return bool
     */
    public function userTagAdd($name, $autoMoney, $sort) {
        $db = $this->load->database('default', true);
        $sql = 'insert into smc_user_tag (name, sort, autoMoney) values (';
        $sql .= $this->db->escape($name) . ', ' . $sort . ', ' . $this->db->escape($autoMoney) . ')';
        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
            return false;
        }

        return true;
    }

    /**
     * 用户标签 - 编辑
     * @param $id
     * @param $name
     * @param $autoMoney
     * @param $sort
     * @return bool
     */
    public function userTagEdit($id, $name, $autoMoney, $sort) {
        $db = $this->load->database('default', true);

        $sql = 'update smc_user_tag set name = ' . $this->db->escape($name) . ', sort = ' . $sort . ', autoMoney = ' . $autoMoney;
        $sql .= ' where id = ' . $id;
        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
            return false;
        }

        return true;
    }

    /**
     * 用户标签 - 删除
     * @param $id
     * @return bool
     */
    public function userTagDel($id) {
        $db = $this->load->database('default', true);
        $sql = 'delete from smc_user_tag where id = ' . $id;
        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
            return false;
        }

        return true;
    }

    /**
     * 用户等级 - 获取等级列表
     * @return array
     */
    public function userLvGetList() {
        $db = $this->load->database('default', true);
        $sql = 'select id, name, upPrice, templateId, note from smc_user_lv order by id limit ' . maxQueryNum;
        $rows = $db->query($sql)->result_array();
        if (!empty($rows)) {
            foreach ($rows as &$row) {
                $row['userNum'] = 0;
            }
            unset($row);

            return $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = default, sql = ' . $sql);
            return [];
        }
    }

    /**
     * 用户等级 - 添加
     * @param $name
     * @param $upPrice
     * @param $templateId
     * @param $note
     * @return bool
     */
    public function userLvAdd($name, $upPrice, $templateId, $note) {
        $db = $this->load->database('default', true);
        $sql = 'insert into smc_user_lv (name, upPrice, templateId, note) values (';
        $sql .= $this->db->escape($name) . ', ' . $upPrice . ', ' . $templateId . ', ' . $this->db->escape($note) . ')';
        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
            return false;
        }

        return true;
    }

    /**
     * 用户等级 - 编辑
     * @param $id
     * @param $name
     * @param $upPrice
     * @param $templateId
     * @param $note
     * @return bool
     */
    public function userLvEdit($id, $name, $upPrice, $templateId, $note) {
        $db = $this->load->database('default', true);
        $sql = 'update smc_user_lv set name = ' . $this->db->escape($name) . ', upPrice = ' . $upPrice;
        $sql .= ', templateId = ' . $templateId . ', note = ' . $this->db->escape($note) . ' where id = ' . $id;

        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
            return false;
        }

        return true;
    }

    /**
     * 用户详情 - 获取
     * @param $userId
     * @return array
     */
    public function userDetailGet($userId) {
        $indexArr = $this->Common_model->getUserDBPos($userId);
        $dbIndex = $indexArr['dbindex'];
        $tableIndex = $indexArr['tableindex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;

        /**
         * 用户基础信息 -
         *
         * 用户id - id
         * 上级:
         * 用户等级: 比如 普通会员, vip1, vip2 等
         * 真实姓名: userIDCardName
         * 用户状态: 黑名单
         * E-mail: user_email
         * 手机号码: mobile_number
         * 微信号码:
         * QQ号码:
         * 账户id: user_email
         * 注册时间: registertime - timestamp
         * 最后登录时间: last_login_time - bigint
         * 密码: password
         * 资金密码:
         * 用户标签: userTag
         * 设备唯一标识码: todo user_device_id, uuid, mac 哪个是
         * 备注: note
         *
         * ====
         * 账户信息 -
         *
         * 账户余额: wallet total_total_money todo
         * 保险箱余额:
         * 支付宝: alipay_account
         * 银行卡:
         * 银行名称:
         * 充值次数: payBonusGameCount todo
         * 充值金额: payContribution todo
         * 提现次数:
         * 提现金额:
         * 返水金额:
         *
         * ====
         * 会员权限设置 -
         *
         *
         * ====
         * 用户游戏信息 -
         *
         * 游戏:
         * 游戏次数: total_competition_times todo
         * 输赢:
         * 最后游戏时间:
         *
         * ====
         * 用户活动信息:
         *
         * 时间:
         * IP: lastLoginIp
         * 地址: location
         * 行为: 比如 官方充值请求, 用户绑定实名信息, 微信登录 等
         */
        $sql = 'select id, userIDCardName, user_email, mobile_number, registertime, last_login_time, password, wallet,';
        $sql .= ' alipay_account, payBonusGameCount, payContribution, total_competition_times, lastLoginIp, location,';
        $sql .= ' userTag, note';
        $sql .= ' from ' . $tableName;
        $sql .= ' where id = ' . $userId . ' limit 1';

        $row = $db->query($sql)->row_array();
        // test
        log_message('error', __METHOD__ . ', ' . __LINE__ . ', db = eus' . $dbIndex
            . ', table = ' . $tableName . ', sql = ' . $sql . ', row = ' . json_encode($row));
        if (!empty($row)) {
            $row['last_login_time'] = date('Y-m-d h:i:s', $row['last_login_time']);
            $row['userSealStatus'] = $this->getUserSealStatus($userId);
            return $row;
        } else {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);
            return [];
        }
    }

    /**
     * 用户详情 - 保存
     * @param $userId
     * @param $realName
     * @param $mobileNumber
     * @param $aliPayAccount
     * @param $userTag
     * @param $note
     * @return bool
     */
    public function userDetailSave($userId, $realName, $mobileNumber, $aliPayAccount, $userTag, $note) {
        $indexArr = $this->Common_model->getUserDBPos($userId);
        $dbIndex = $indexArr['dbindex'];
        $tableIndex = $indexArr['tableindex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;

        $sql = 'update ' . $tableName;
        $sql .= ' set userIDCardName = ' . $this->db->escape($realName) . ', mobile_number = '
            . $this->db->escape($mobileNumber) . ', alipay_account = ' . $this->db->escape($aliPayAccount)
            . ', userTag = ' . $userTag . ', note = ' . $this->db->escape($note);
        $sql .= ' where id = ' . $userId;

        $ret = $db->query($sql);
        // test
        log_message('error', __METHOD__ . ', ' . __LINE__ . ', db = eus' . $dbIndex
            . ', table = ' . $tableName . ', sql = ' . $sql . ', ret = ' . json_encode($ret));
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);
            return false;
        }

        return true;
    }

    // ====

    /**
     * 生成 (投注记录 - 获取)方法 的sql
     * @param $db
     * @param $dateBegin
     * @param $dateEnd
     * @param $gameId
     * @param $baseScore
     * @param $userId
     * @return string
     */
    public function betRecordGetGenerateSql(&$db, $dateBegin, $dateEnd, $gameId, $baseScore, $userId) {
        $sql = '';

        $tsBegin = strtotime($dateBegin);
        $tsEnd = strtotime($dateEnd);
        if ($dateBegin !== '') {
            for ($i = $tsBegin; $i <= $tsEnd; $i += 86400) {
                $tableSuffix = date('Ymd', $i);

                $oneDaySql = $this->getOneDaySql($db, $gameId, $baseScore, $userId, $tableSuffix);
                $sql .= $oneDaySql;
            }
        } else { // 如果没有选择日期, 默认取最近30天的数据
            $todayTs = strtotime(date('Ymd'));
            $dateMonthAgoTs = $todayTs - 2592000;
            for ($i = $dateMonthAgoTs; $i <= $todayTs; $i += 86400) {
                $tableSuffix = date('Ymd', $i);

                log_message('debug', __METHOD__ . ', ' . __LINE__ . ', tableSuffix = ' . $tableSuffix);

                $oneDaySql = $this->getOneDaySql($db, $gameId, $baseScore, $userId, $tableSuffix);
                $sql .= $oneDaySql;
            }
        }

        $sql = rtrim($sql, ' union all ');

        return $sql;
    }

    /**
     * 生成 (投注记录 - 获取)方法 一天的sql
     * @param $db
     * @param $gameId
     * @param $baseScore
     * @param $userId
     * @param $tableSuffix - 日期
     * @return string
     */
    public function getOneDaySql(&$db, $gameId, $baseScore, $userId, $tableSuffix) {
        $sql = '';

        if ($gameId === -1) {
            foreach (gameHistoryTables as $k => $tablePrefix) {
                if (!empty($tablePrefix)) { // 表前缀已定义
                    $tableName = $tablePrefix . $tableSuffix;

                    $gameName = '';
                    if (array_key_exists($k, gameIdName) && !empty(gameIdName[$k])) {
                        $gameName = gameIdName[$k];
                    }

                    if (checkTableExist($db, $tableName)) { // 表存在
                        $sql .= 'select user_id as userId, user_nickname as userNickname,';
                        $sql .= ' "' . $gameName . '" as gameName,';
                        $sql .= ' game_number as gameNumber, (user_score_end - user_score_begin) as userGameResult,';
                        $sql .= ' user_table_fee as userTableFee, user_score_begin as userScoreBegin,';
                        $sql .= ' user_score_end as userScoreEnd, game_time as gameTime, record_timestamp as recordTimestamp';

                        // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                        if (checkColumnExist('room_basescore', $tableName, $db)) {
                            $sql .= ', room_basescore as roomBaseScore';
                        } else {
                            $sql .= ', ' . baiRenBaseScore . ' as roomBaseScore';
                        }

                        $sql .= ' from ' . $tableName;

                        $haveWhere = false;

                        if ($baseScore !== '') {
                            // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                            if (checkColumnExist('room_basescore', $tableName, $db)) {
                                $sql .= ' where room_basescore = ' . $this->db->escape($baseScore);
                                $haveWhere = true;
                            }
                        }
                        if ($userId !== '') {
                            if ($haveWhere) {
                                $sql .= ' and user_id = ' . $userId;
                            } else {
                                $sql .= ' where user_id = ' . $userId;
                                $haveWhere = true;
                            }
                        }

                        $sql .= ' union all ';
                    } else {
                        log_message('info', __METHOD__ . ', ' . __LINE__ . ', table not exist, tableName = ' . $tableName);
                    }
                } else {
                    log_message('info', __METHOD__ . ', ' . __LINE__ . ', table not define, gameId = ' . $gameId);
                }
            }
        } else {
            if (!array_key_exists($gameId, gameHistoryTables)) {
                log_message('error', __METHOD__ . ', ' . __LINE__ . ', invalid gameId, gameId = ' . $gameId);
            }
            if (empty(gameHistoryTables[$gameId])) {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', table not define, gameId = ' . $gameId);
            }

            $tablePrefix = gameHistoryTables[$gameId];
            $tableName = $tablePrefix . $tableSuffix;

            $gameName = '';
            if (array_key_exists($gameId, gameIdName) && !empty(gameIdName[$gameId])) {
                $gameName = gameIdName[$gameId];
            }

            if (checkTableExist($db, $tableName)) { // 表存在
                $sql .= 'select user_id as userId, user_nickname as userNickname,';
                $sql .= ' "' . $gameName . '" as gameName,';
                $sql .= ' game_number as gameNumber, user_game_result as userGameResult,';
                $sql .= ' user_table_fee as userTableFee, user_score_begin as userScoreBegin,';
                $sql .= ' user_score_end as userScoreEnd, game_time as gameTime, record_timestamp as recordTimestamp';

                // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                if (checkColumnExist('room_basescore', $tableName, $db)) {
                    $sql .= ', room_basescore as roomBaseScore';
                } else {
                    $sql .= ', ' . baiRenBaseScore . ' as roomBaseScore';
                }

                $sql .= ' from ' . $tableName;

                $haveWhere = false;

                if ($baseScore !== '') {
                    // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                    if (checkColumnExist('room_basescore', $tableName, $db)) {
                        $sql .= ' where room_basescore = ' . $this->db->escape($baseScore);
                        $haveWhere = true;
                    }
                }
                if ($userId !== '') {
                    if ($haveWhere) {
                        $sql .= ' and user_id = ' . $userId;
                    } else {
                        $sql .= ' where user_id = ' . $userId;
                        $haveWhere = true;
                    }
                }

                $sql .= ' union all ';
            }
        }

        return $sql;
    }

    /**
     * 获取玩家封印状态
     * @param $userId
     * @return int
     */
    public function getUserSealStatus($userId) {
        $db = $this->load->database('us3', true);
        $sql = 'select id from casinouseridblacklist where userid = ' . $userId . ' limit 1';

        $row = $db->query($sql)->row_array();
        if (!empty($row)) {
            return UserList::sealStatusYes;
        } else {
            return UserList::sealStatusNo;
        }
    }
}