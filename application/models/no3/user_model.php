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
     * @return array
     */
    public function userGet($userId, $dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount) {
        $indexArr = $this->Common_model->getDbTablePos($userId);
        $dbIndex = $indexArr['dbIndex'];
        $tableIndex = $indexArr['tableIndex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;
        $sql = 'select id, user_email, registertime, userIDCardName from ' . $tableName;
        $sql .= ' where id = ' . $userId;

        if ($dateBegin !== '') {
            $item[] = 'registertime >= ' . $dateBegin;
        }
        if ($dateEnd !== '') {
            $item[] = 'registertime <= ' . $dateEnd;
        }
        if ($account !== '') {
            $item[] = 'user_email = ' . $account;
        }
        if ($realName) {
            $item[] = 'userIDCardName = ' . $realName;
        }
        if ($mobileNumber !== '') {
            $item[] = 'mobile_number = ' . $mobileNumber;
        }
        if ($aliPayAccount !== '') {
            $item[] = 'alipay_account = ' . $aliPayAccount;
        }

        if (!empty($item)) {
            $sql .= ' and ' . implode(' and ', $item);
        }

        $row = $db->query($sql)->row_array();

        if (!empty($row)) {
            return $row;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);
            return [];
        }
    }

    /**
     * 用户列表 - 获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $account
     * @param $mobileNumber
     * @param $realName
     * @param $aliPayAccount
     * @return array
     */
    public function userListGet($dateBegin, $dateEnd, $account, $mobileNumber, $realName, $aliPayAccount) {
        $finalRet = [];

        $where = '';

        if ($dateBegin !== '') {
            $item[] = 'registertime >= ' . $dateBegin;
        }
        if ($dateEnd !== '') {
            $item[] = 'registertime <= ' . $dateEnd;
        }
        if ($account !== '') {
            $item[] = 'user_email = ' . $account;
        }
        if ($realName) {
            $item[] = 'userIDCardName = ' . $realName;
        }
        if ($mobileNumber !== '') {
            $item[] = 'mobile_number = ' . $mobileNumber;
        }
        if ($aliPayAccount !== '') {
            $item[] = 'alipay_account = ' . $aliPayAccount;
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
                $sql .= 'select id, user_email, registertime, userIDCardName';
                $sql .= ' from ' . $tableName;
                $sql .= $where;
            }
            $sql .= ' limit ' . maxQueryNum; // todo 分页
            $rows = $db->query($sql)->result_array();

            if (!empty($rows)) {
                $finalRet = array_merge($finalRet, $rows);
            } else {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $i
                    . ', tablePrefix = ' . $tablePrefix . ', sql = ' . $sql);
            }
        }

        return $finalRet;
    }

    /**
     * 用户登录日志 - 根据userId获取
     * @param $userId
     * @param $dateBegin
     * @param $dateEnd
     * @param $ip
     * @return array
     */
    public function userLoginLogGetByUserId($userId, $dateBegin, $dateEnd, $ip) {
        $indexArr = $this->Common_model->getDbTablePos($userId);
        $dbIndex = $indexArr['dbIndex'];
        $tableIndex = $indexArr['tableIndex'];

        $db = $this->load->database('eus' . $dbIndex, true);
        $tableName = 'casinouser_' . $tableIndex;

        $sql = 'select id, last_login_time, lastLoginIp, location, lastLoginMac'; // activate_device, uuid, lastLoginMac哪个是设备
        $sql .= ' from ' . $tableName;
        $sql .= ' where id = ' . $userId;

        $item = [];
        if ($dateBegin !== '') {
            $tsBegin = strtotime($dateBegin);
            $item[] = 'last_login_time >= ' . $tsBegin;
        }
        if ($dateEnd !== '') {
            $tsEnd = strtotime($dateEnd);
            $item[] = 'last_login_time <= ' . $tsEnd;
        }
        if ($ip) {
            $item[] = 'lastLoginIp = ' . $ip;
        }

        if (!empty($item)) {
            $sql .= ' and ' . implode(' and ', $item);
        }

        $sql .= ' limit ' . maxQueryNum; // todo 分页

        $rows = $db->query($sql)->result_array();
        if (empty($rows)) {
            return $rows;
        } else {
            log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $dbIndex
                . ', table = ' . $tableName . ', sql = ' . $sql);

            return [];
        }
    }

    /**
     * 用户登陆日志 - 获取
     * @param $dateBegin
     * @param $dateEnd
     * @param $ip
     * @return array
     */
    public function userLoginLogGet($dateBegin, $dateEnd, $ip) {
        $finalRet = [];

        $where = '';

        if ($dateBegin !== '') {
            $tsBegin = strtotime($dateBegin);
            $item[] = 'last_login_time >= ' . $tsBegin;
        }
        if ($dateEnd !== '') {
            $tsEnd = strtotime($dateEnd);
            $item[] = 'last_login_time <= ' . $tsEnd;
        }
        if ($ip !== '') {
            $item[] = 'ip = ' . $ip;
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
                $sql .= 'select id, user_email, registertime, userIDCardName';
                $sql .= ' from ' . $tableName;
                $sql .= $where;
            }
            $sql .= ' limit ' . maxQueryNum; // todo 分页
            $rows = $db->query($sql)->result_array();

            if (!empty($rows)) {
                $finalRet = array_merge($finalRet, $rows);
            } else {
                log_message('info', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = eus' . $i
                    . ', tablePrefix = ' . $tablePrefix . ', sql = ' . $sql);
            }
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
     * @return array
     */
    public function betRecordGet($dateBegin, $dateEnd, $gameId, $baseScore, $userId) {
        $db = $this->load->database('gamehis', true);
        $sql = $this->betRecordGetGenerateSql($db, $dateBegin, $dateEnd, $gameId, $baseScore, $userId);

        if (empty($sql)) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', sql empty, dateBegin = ' . $dateBegin.  ', dateEnd = ' . $dateEnd
                . ', gameId = ' . $gameId . ', baseScore = ' . $baseScore . ', userId = ' . $userId);
            return [];
        }

        $rows = $db->query($sql)->result_array();
        if (empty($rows)) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', db select return empty, db = gamehis, sql = ' . $sql);
            return [];
        }

        foreach ($rows as &$row) {
            $row['roomBaseScore'] = isset($row['roomBaseScore']) ? $row['roomBaseScore'] : baiRenBaseScore;
            $row['roomBaseScore'] = number_format($row['roomBaseScore'] / 100, 2, '.', ' ');

            $row['userGameResult'] = number_format($row['userGameResult'] / 100, 2, '.', ' ');
            $row['userScoreBegin'] = number_format($row['userScoreBegin'] / 100, 2, '.', ' ');
            $row['userScoreEnd'] = number_format($row['userScoreEnd'] / 100, 2, '.', ' ');
        }
        unset($row);

        return $rows;
    }

    /**
     * 用户标签 - 获取
     * @return array
     */
    public function userTagGet() {
        $db = $this->load->database('default', true);
        $sql = 'select id, name, sort, autoMoney from smc_user_tag order by id desc limit ' . maxQueryNum;
        $rows = $db->query($sql)->result_array();
        if (!empty($rows)) {
            foreach ($rows as &$row) {
                $row['personNum'] = 0; // notice 测试数据
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
     * @param $sort
     * @param $autoMoney
     * @return bool
     */
    public function userTagAdd($name, $sort, $autoMoney) {
        $db = $this->load->database('default', true);
        $sql = 'insert into smc_user_tag (name, sort, autoMoney) values (';
        $sql .= $name . ', ' . $sort . ', ' . $autoMoney;
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
     * @param $sort
     * @param $autoMoney
     * @return bool
     */
    public function userTagEdit($id, $name, $sort, $autoMoney) {
        $db = $this->load->database('default', true);

        $sql = 'update smc_user_tab set name = ' . $name . ', sort = ' . $sort . ', autoMoney = ' . $autoMoney;
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
        $db = $this->load->database('default');
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
        $db = $this->load->database('default');
        $sql = 'select id, name, upPrice, templateId, note from smc_user_lv order by lv limit ' . maxQueryNum;
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
        $db = $this->load->database('default');
        $sql = 'insert into smc_user_lv (name, upPrice, templateId, note) values (';
        $sql .= $name . ', ' . $upPrice . ', ' . $templateId . ', ' . $note;
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
        $db = $this->load->database('default');
        $sql = 'update smc_user_lv set name = ' . $name . ', upPrice = ' . $upPrice;
        $sql .= ', templateId = ' . $templateId . ', note = ' . $note . ' where id = ' . $id;
        $ret = $db->query($sql);
        if (!$ret) {
            log_message('error', __METHOD__ . ', ' . __LINE__ . ', fail, db = default, sql = ' . $sql);
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
        if ($dateBegin !== -1) {
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

                        if ($baseScore !== -1) {
                            // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                            if (checkColumnExist('room_basescore', $tableName, $db)) {
                                $sql .= ' where room_basescore = ' . $baseScore;
                                $haveWhere = true;
                            }
                        }
                        if ($userId !== -1) {
                            if ($haveWhere) {
                                $sql .= ' and user_id = :userId';
                            } else {
                                $sql .= ' where user_id = :userId';
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

                if ($baseScore !== -1) {
                    // 判断是否存在 room_basescore 字段 (bairen类的游戏表中不存在该字段, 且表结构跟其他不同)
                    if (checkColumnExist('room_basescore', $tableName, $db)) {
                        $sql .= ' where room_basescore = ' . $baseScore;
                        $haveWhere = true;
                    }
                }
                if ($userId !== -1) {
                    if ($haveWhere) {
                        $sql .= ' and user_id = :userId';
                    } else {
                        $sql .= ' where user_id = :userId';
                        $haveWhere = true;
                    }
                }

                $sql .= ' union all ';
            }
        }

        return $sql;
    }
}