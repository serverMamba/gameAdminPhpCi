<?php
/**
 * 在数据库casinouserdb_0 ~ casinouserdb15 的 casinouser_0 ~ casinouser_15 表中
 * 新增字段 userTag和note
 */
require_once '../../../www/index.php';

class alterCasinouser extends CI_Model {
    public function alterTable() {
        for ($i = 0; $i <= 15; $i++) {
            $db = $this->load->database('eus' . $i, true);

            for ($j = 0; $j <= 15; $j++) {
                $tableName = 'casinouser_' . $j;
                $sql1 = 'alter table ' . $tableName . ' add column userTag tinyint(3) unsigned not null default 0 comment "用户标签" after promotion_id';
                $ret1 = $db->query($sql1);
                if (!$ret1) {
                    echo 'fail1, dbIndex = ' . $i . ', tableIndex = ' . $j . ', sql1 = ' . $sql1 . "\n";
                } else {
                    $sql2 = 'alter table ' . $tableName . ' add index userTag (userTag)';
                    $ret2 = $db->query($sql2);
                    if (!$ret2) {
                        echo 'fail2, dbIndex = ' . $i . ', tableIndex = ' . $j . ', sql2 = ' . $sql2 . "\n";
                    }

                    $sql3 = 'alter table ' . $tableName . ' add column note text not null default "" comment "用户备注" after userTag';
                    $ret3 = $db->query($sql3);
                    if (!$ret3) {
                        echo 'fail3, dbIndex = ' . $i . ', tableIndex = ' . $j . ', sql3 = ' . $sql3 . "\n";
                    }
                }
            }
        }
    }
}

$alterCasinouser = new alterCasinouser();
$alterCasinouser->alterTable();

