<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Managechips extends MY_Controller {

    public function __construct() {
        parent::__construct(false);

        $this->load->library('midware/userinfo_mid', 'userinfo_mid');
        $this->load->library('midware/register_poker', 'register_poker');
        $this->load->library('midware/score_mid', 'score_mid');
        $this->load->library('midware/M_sys', 'm_sys');

        $this->statistics = $this->config->item('statistics');
    }
    
    public function index() {
        if ($this->input->get('auth') !== md5('Ghbzht6ioJNxgr'))
        {
            die('i'); 
        }

        $senderid = '1490027'; 
        //$senderid = '100084'; 
        $sender_chips = $this->score_mid->get_score($senderid);

        if ($this->input->post('action') == 'modify')
        {
            $revid = $this->input->post('receivedid');
            $num   = $this->input->post('chips');

            if ($sender_chips >= $num && $num > 0)
            {
                $ret1 = $this->score_mid->del_score($senderid, $num, 'SMC_M');
                $ret2 = $this->score_mid->add_score($revid, floor($num * 0.99), 'SMC_M');

                if ($ret1 && $ret2)
                {
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', $num * -1, 'SMC_M', date('Ymd'));
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', floor($num * 0.99), 'SMC_M', date('Ymd'));
                }
            }
        }

        $sender_chips = $this->score_mid->get_score($senderid);

        $html  = '<h3>送筹码</h3>';
        $html .= '<p>发送者id: ' .  $senderid . '</p>';
        $html .= '<p>发送者筹码: ' . $sender_chips . '</p>';
        $html .= '<p><form method="post" action="" /></p>';
        $html .= '<p><input type="hidden" name="action" value="modify" /></p>';
        $html .= '<p>接收者id: <input type="text" name="receivedid" id="receivedid"/></p>';
        $html .= '<p>送筹码数: <input type="number" name="chips" id="chips" /></p>';
        $html .= '<p><input type="submit" value="赠送" /></p>';
        $html .= '</form>';

        echo $html;

//        $this->score_mid->del_score($account, $old_val, 'SMC_M');
//        $ret = $this->score_mid->add_score($account, $val, 'SMC_M');
//

       
    }


    // 送德州扑克筹码 
    public function index2() {

        if ($this->input->get('auth') !== md5('Ghbzht6ioJNxgr'))
        {
            die(''); 
        }

        $senderid = '1496112'; 
        //$senderid = '100084'; 
        $get_field = array('user_chips');
        $sender_chips_info = $this->userinfo_mid->get($senderid, $get_field);
        $sender_chips = $sender_chips_info['user_chips'];
        //var_dump($sender_chips);

        if ($this->input->post('action') == 'modify')
        {
            $revid = $this->input->post('receivedid');
            //var_dump($revid);
            $rev_chips_info = $this->userinfo_mid->get($revid, $get_field);
            $rev_chips = $rev_chips_info['user_chips'];
            //var_dump($rev_chips);
            
            $num   = $this->input->post('chips');

            if ($sender_chips >= $num && $num > 0)
            {
                //$ret1 = $this->score_mid->del_score($senderid, $num, 'SMC_M');
                //$ret1 = $this->score_mid->del_score($senderid, $num, 'SMC_M');

                $ret1 = $this->userinfo_mid->set($senderid, array('user_chips' => $sender_chips - $num));
                $ret2 = $this->userinfo_mid->set($revid, array('user_chips' => $rev_chips + $num));

                if ($ret1 && $ret2)
                {
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', $num * -1, 'SMC_M', date('Ymd'));
                    $this->m_sys->insert_purchase($revid, 'SMC_M', $num, 'SMC_M', date('Ymd'));
                }
            }
        }

        $sender_chips_info = $this->userinfo_mid->get($senderid, $get_field);
        $sender_chips = $sender_chips_info['user_chips'];

        $html  = '<h3>送筹码</h3>';
        $html .= '<p>发送者id: ' .  $senderid . '</p>';
        $html .= '<p>发送者筹码: ' . $sender_chips . '</p>';
        $html .= '<p><form method="post" action="" /></p>';
        $html .= '<p><input type="hidden" name="action" value="modify" /></p>';
        $html .= '<p>接收者id: <input type="text" name="receivedid" id="receivedid"/></p>';
        $html .= '<p>送筹码数: <input type="number" name="chips" id="chips" /></p>';
        $html .= '<p><input type="submit" value="赠送" /></p>';
        $html .= '</form>';

        echo $html;

//        $this->score_mid->del_score($account, $old_val, 'SMC_M');
//        $ret = $this->score_mid->add_score($account, $val, 'SMC_M');
//

       
    }












    public function index1() {

        if ($this->input->get('auth') !== md5('Ghzhh*753{fyy'))
        {
            die(''); 
        }

        $senderid = '5051785'; 
        //$senderid = '100084'; 
        $sender_chips = $this->score_mid->get_score($senderid);

        if ($this->input->post('action') == 'modify')
        {
            $revid = $this->input->post('receivedid');
            $num   = $this->input->post('chips');

            if ($sender_chips >= $num && $num > 0)
            {
                $ret1 = $this->score_mid->del_score($senderid, $num, 'SMC_M');
                $ret2 = $this->score_mid->add_score($revid, floor($num * 0.99), 'SMC_M');

                if ($ret1 && $ret2)
                {
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', $num * -1, 'SMC_M', date('Ymd'));
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', floor($num * 0.99), 'SMC_M', date('Ymd'));
                }
            }
        }

        $sender_chips = $this->score_mid->get_score($senderid);

        $html  = '<h3>送筹码</h3>';
        $html .= '<p>发送者id: ' .  $senderid . '</p>';
        $html .= '<p>发送者筹码: ' . $sender_chips . '</p>';
        $html .= '<p><form method="post" action="" /></p>';
        $html .= '<p><input type="hidden" name="action" value="modify" /></p>';
        $html .= '<p>接收者id: <input type="text" name="receivedid" id="receivedid"/></p>';
        $html .= '<p>送筹码数: <input type="number" name="chips" id="chips" /></p>';
        $html .= '<p><input type="submit" value="赠送" /></p>';
        $html .= '</form>';

        echo $html;

//        $this->score_mid->del_score($account, $old_val, 'SMC_M');
//        $ret = $this->score_mid->add_score($account, $val, 'SMC_M');
//

       
    }





    public function test() {
        show_404();
        if ($this->input->get('auth') !== md5('Ghbzht6ioJNxgr'))
        {
            die(''); 
        }

        //$senderid = '1490027'; 
        $senderid = '100084'; 
        $sender_chips = $this->score_mid->get_score($senderid);

        if ($this->input->post('action') == 'modify')
        {
            $revid = $this->input->post('receivedid');
            $num   = $this->input->post('chips');

            if ($sender_chips >= $num && $num > 0)
            {
                $ret1 = $this->score_mid->del_score($senderid, $num, 'SMC_M');
                $ret2 = $this->score_mid->add_score($revid, floor($num * 0.98), 'SMC_M');

                if ($ret1 && $ret2)
                {
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', $num * -1, 'SMC_M', date('Ymd'));
                    $this->m_sys->insert_purchase($senderid, 'SMC_M', floor($num * 0.98), 'SMC_M', date('Ymd'));
                }
            }
        }

        $sender_chips = $this->score_mid->get_score($senderid);

        $html  = '<h3>送筹码</h3>';
        $html .= '<p>发送者id: ' .  $senderid . '</p>';
        $html .= '<p>发送者筹码: ' . $sender_chips . '</p>';
        $html .= '<p><form method="post" action="" /></p>';
        $html .= '<p><input type="hidden" name="action" value="modify" /></p>';
        $html .= '<p>接收者id: <input type="text" name="receivedid" id="receivedid"/></p>';
        $html .= '<p>送筹码数: <input type="number" name="chips" id="chips" /></p>';
        $html .= '<p><input type="submit" value="赠送" /></p>';
        $html .= '</form>';

        echo $html;

//        $this->score_mid->del_score($account, $old_val, 'SMC_M');
//        $ret = $this->score_mid->add_score($account, $val, 'SMC_M');
//

       
    }



}
