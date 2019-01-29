<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct(true);

        $this->load->library('midware/userinfo_mid', 'userinfo_mid');
        $this->load->library('midware/register_poker', 'register_poker');
        $this->load->library('midware/score_mid', 'score_mid');
        $this->load->library('midware/M_sys', 'm_sys');

        $this->statistics = $this->config->item('statistics');
        $this->special_admin = $this->config->item('special_admin');
    }
    
    public function index() {

        $data = array();
        $this->load->view('user', $data);
        
    }

    public function get_user_info () {
        $account = $this->input->get('account');

        if(empty($this->uid)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '请先登录');
            return;
        }
        
        if (empty($account)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '帐号不能为空');
            return;
        }

        if (strpos($account, '@')) {
            $account = $this->register_poker->get_id_from_email($account);
        }

        if (!$this->_is_account_exist($account)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '帐号不存在');
            return;
        }

        /*
        $get_field = array('score', 'success', 'fail', 'offline', 'registerTime', 
            'user_faceurl', 'status', 'user_chips', 'user_email', 'user_device_id', 
            'user_charge', 'language', 'user_active', 'user_property', 'user_gift', 
            'user_send_chips', 'user_login_type', 'user_location', 'user_best', 
            'user_online', 'user_online_time', 'user_chips_his', 'user_chips_time', 
            'user_lock', 'user_achievement', 'user_plat', 'user_push_time', 'user_money_charge');
        */
        $get_field = array('nickname', 'registerTime', 'user_email', 'user_faceurl', 'user_active', 'user_device_id', 'user_sex',
            'user_chips', 'zjh_chips', 'gd_chips' , //筹码
            //'user_chips', 'gd_chips' , //筹码
            'score', 'zjh_score', 'gd_score' , //积分
            'zjh_speaker', 'gd_speaker', //小喇叭
            'user_money_charge' , //欢乐果 
            'usr_property', 'user_property', 'zjh_property', 'gd_property', //财产
            //'fish_backpack', // 背包
            'user_lock',
            'zjh_recomed_times', 'zjh_recom',
        );
        $ret = $this->userinfo_mid->get($account, $get_field);

        if (!$ret) {
            echo json_return(RESPONSE_PARAMS_ERROR, '返回数据为空');
            return;
        }

        // chips字段改为新的中间层接口
        $zjh_chips = $this->score_mid->get_score($account);
        if (is_numeric($zjh_chips)) {
            $ret['zjh_chips'] = $zjh_chips; 
        } 
      
        $ret1 = array_merge(array('account'=>$account), $ret);

        echo json_return(RESPONSE_OK, '', array($ret1));

    }

    public function update_user_info() {

        if ($this->gid != 1) {
            echo json_return(RESPONSE_TOKEN_ERROR, '权限不足');
            return;
        }

        $account = trim($this->input->get('account'));
        $key = trim($this->input->get('key'));
        $val = trim($this->input->get('val'));
        $comment = trim($this->input->get('comment'));
        if (strlen($val) <= 0) {
            $val = '';
        }

        if(empty($this->uid)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '请先登录');
            return;
        }
        
        if (empty($account)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '帐号不能为空');
            return;
        }

        if (strpos($account, '@')) {
            $account = $this->register_poker->get_id_from_email($account);
        }

        if (!$this->_is_account_exist($account)) {
            echo json_return(RESPONSE_PARAMS_ERROR, '帐号不存在');
            return;
        }

        //修改密码
        if (in_array($key, array('pass', 'password', '密码'))) {
            echo $this->_modify_password($account, $val);
            return;
        }

        if (in_array($key, array('zjh_chips'))) {
            $ret_m = $this->_modify_zjh_chips($account, $val);
            echo $ret_m;
            if ($ret_m)
            {
                log_message('error', "user | update_user_info - succ oper:$this->username, account:$account, key: zjh_chips,  val: $val, comment:$comment"); 
            }
            return;
        }

        //更新字段
        echo $this->_updateField($account, $key, $val, $comment);
        //$ret = $this->userinfo_mid->set($account, array($key => $val));

        /*
        if ($ret) {
            echo json_return(RESPONSE_OK, '更新成功', array($ret));

           //log_message('error', "user | update_user_info - suc account:$account, key:$key, val: $val"); 
           log_message('error', "user | update_user_info - succ oper:$this->username, account:$account, key:$key, val: $val, comment:$comment"); 
        } else {
            echo json_return(RESPONSE_SYSTEM_BUSY, '修改失败');
        }
         */

    }

    private function _is_account_exist($account) {

        $ret = $this->register_poker->get_info_from_id($account);
		
		if (!$ret || $ret === 0) {
			return false;
		}

        return true;

    }

    private function _modify_password($id, $new_password) {
        $ret = $this->register_poker->update_user_pass($id, md5($new_password));

        if ($ret) {
            $ret = json_return(RESPONSE_OK, '修改密码成功');
        } else {
            $ret = json_return(RESPONSE_SYSTEM_BUSY, '修改密码失败');
        }

        return $ret;
    }

    /**
     * 修改赢三张筹码新接口
     * @param  [type] $account [description]
     * @param  [type] $val     [description]
     * @return [type]          [description]
     */
    private function _modify_zjh_chips($account, $val) {

        $old_val = $this->score_mid->get_score($account);

        //权限检查,普通admin不能加分
        if(!in_array($this->uid, $this->special_admin)) {
            if (intval($val) > intval($old_val) + 200000) {
                return json_return(RESPONSE_SYSTEM_BUSY, '没有权限加分');
            } 
        }

        $this->score_mid->del_score($account, $old_val, 'SMC_M');
        $ret = $this->score_mid->add_score($account, $val, 'SMC_M');

        $this->m_sys->insert_purchase($account, 'SMC_M', $val - $old_val, 'SMC_M', date('Ymd'));

         if ($ret) {
            $ret = json_return(RESPONSE_OK, '修改赢三张筹码成功');
        } else {
            $ret = json_return(RESPONSE_SYSTEM_BUSY, '修改赢三张筹码失败');
        }

        return $ret;

    }

    private function _updateField($account, $key, $val, $comment) {
         
        $checkFields = array(
            'user_chips', 'zjh_chips', 'gd_chips' , //筹码
            //'user_chips', 'gd_chips' , //筹码
            'score', 'zjh_score', 'gd_score' , //积分
            'zjh_speaker', 'gd_speaker', //小喇叭
            'user_money_charge' , //欢乐果 
            'usr_property', 'user_property', 'zjh_property', 'gd_property', //财产
        );

        //权限检查,普通admin不能加分
        if (!in_array($this->uid, $this->special_admin) && in_array($key, $checkFields)) {
            //echo 'P10';
            $old_value = $this->userinfo_mid->get($account, array($key));
                //return json_return(RESPONSE_SYSTEM_BUSY, array($old_value[$key], $val));
            if (intval($old_value[$key]) < intval($val)) {
            //echo 'P20';
                return json_return(RESPONSE_SYSTEM_BUSY, '没有权限加分');
            } else {
            //echo 'P30';
                $ret = $this->userinfo_mid->set($account, array($key => $val));
            }
        } else {
            $ret = $this->userinfo_mid->set($account, array($key => $val));
        } 

        if ($ret) {
           //log_message('error', "user | update_user_info - suc account:$account, key:$key, val: $val"); 
           log_message('error', "user | update_user_info - succ oper:$this->username, account:$account, key:$key, val: $val, comment:$comment"); 
           return json_return(RESPONSE_OK, '更新成功', array($ret));
        } else {
            return json_return(RESPONSE_SYSTEM_BUSY, '修改失败');
        }
    }

}
