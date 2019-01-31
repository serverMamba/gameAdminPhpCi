<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

class Common_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->model('no3/Admin_model');
        @session_start();
    }

    // 是否登陆
    public function isLogin() {
        if ($_SESSION['smc_id']) {
            return true;
        } else {
            return false;
        }
    }

    // 是否有权限
    public function isPriv($priv_name) {
        // @session_start();
        $role_id = $_SESSION['smc_role_id'];
        $role = $this->Admin_model->getRole($role_id);
        if (empty ($role)) {
            return false;
        }

        if ($role ['priv'] == 'all') {
            return true;
        }

        $priv_ary = json_decode($role ['priv'], true);
        if (!empty ($priv_ary) && in_array($priv_name, $priv_ary)) {
            return true;
        }
        return false;
    }

    public function getAdminMenuList() {
        // @session_start();
        $role_id = $_SESSION['smc_role_id'];

        $this->load->model('no3/configs_model', 'configs');
        $total_menu_list = $this->configs->get_navmenu();

        //$role_id = $this->session->userdata ( 'role_id' );
        $role = $this->Admin_model->getRole($role_id);
        if (empty ($role)) {
            return array();
        }

        if ($role ['priv'] == 'all') {
            return $total_menu_list;
        }

        $priv_ary = json_decode($role ['priv'], true);
        foreach ($total_menu_list as $k => $v) {
            foreach ($v ['child'] as $kc => $vc) {
                if (!in_array($vc ['ns'], $priv_ary)) {
                    unset ($total_menu_list [$k] ['child'] [$kc]);
                }
            }
            if (empty ($total_menu_list [$k] ['child'])) {
                unset ($total_menu_list [$k]);
            }
        }
        return $total_menu_list;
    }

    /**
     * 获取用户所在数据库和数据表
     * @param $user_id
     * @return bool
     */
    public function getUserDBPos($user_id) {
        $tmp = $user_id & 0x00000000000000FF;
        $dbx = ($tmp & 0xF0) >> 4;
        $server = 'eus' . $dbx;
        $posx = $tmp & 0x0F;
        $db = $this->load->database($server, true);
        $db->select('dbindex,tableindex');
        $db->from('CASINOUSER2ACCOUNT_' . $posx);
        $db->where('userid', $user_id);
        $db->limit(1);
        $query = $db->get();
        $db->close();
        $user_db_index = $query->row_array();
        if (empty ($user_db_index)) {
            return false;
        }
        return $user_db_index;
    }

    /**
     * 通过id拿渠道信息
     * @param unknown_type $channelId
     */
    public function getChannelInfoById($channelId) {
        $allChannels = $this->config->item('allChannelList');
        foreach ($allChannels as $k => $v) {
            if ($channelId == $v['channelId']) {
                return $v;
            }
        }

        return null;
    }

    /**
     * 通过tag拿渠道信息
     * @param unknown_type $channelTag
     */
    public function getChannelInfoByTag($channelTag) {
        $allChannels = $this->config->item('allChannelList');
        foreach ($allChannels as $k => $v) {
            if ($channelTag == $v['tag']) {
                return $v;
            }
        }

        return null;
    }
}
