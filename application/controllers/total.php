<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Total extends MY_Controller {

    public function __construct() {
        parent::__construct(true);
        $this->load->model('total_model');
        $this->load->library('midware/userchip_mid', 'userchip_mid');
        $this->load->library('midware/register_poker', 'register_poker');

        $this->statistics = $this->config->item('statistics');
    }
    
    public function index() {
        $year  = $this->input->get('year');
        $month = $this->input->get('month');
        $day   = $this->input->get('day');

        if (empty($year)) {
            //$strDate = date('Y-m-d', strtotime('-1 day'));
            $strDate = date('Y-m-d');
        } else {
            $strDate = $year . '-' . $month . '-' . $day; 
        } 
        $result = $this->total_model->get_total($strDate);

        $data = array(
            'result'  => $result,
            'strDate' => $strDate,
            'statistics' => $this->statistics,
        );

        $this->load->view('total', $data);
    }

    public function profit() {
        $year  = $this->input->get('year');
        $month = $this->input->get('month');
        $day   = $this->input->get('day');

        if (empty($year)) {
            $strDate = date('Y-m-d', strtotime('-1 day'));
        } else {
            $strDate = $year . '-' . $month . '-' . $day; 
        } 

        $result = $this->total_model->get_profit($strDate);

        $data = array(
            'result'  => $result,
            'strDate' => $strDate,
            'statistics' => $this->statistics,
        );

        $this->load->view('total/profit', $data);
    } 

    public function top_user() {
        $result = $this->total_model->get_top_user();
        $data = array(
            'result' => $result,    
            'statistics' => $this->statistics,
        );
        $this->load->view('total/top_user', $data);
    } 

    public function top_num() {
        $result = $this->total_model->get_top_num();
        $data = array(
            'result' => $result,    
            'statistics' => $this->statistics,
        );
        $this->load->view('total/top_num', $data);
    } 

    public function reg_num() {
        //fromDay
        $d1   = $this->input->get('d1');
        //toDay
        $d2   = $this->input->get('d2');

        if (empty($d1)) {
            $d1 = date('Y-m-d', strtotime('-8 day'));
            $d2 = date('Y-m-d', strtotime('-1 day'));
            // d1之前30天
            $d3 = date('Y-m-d', strtotime('-38 day'));
        } else {
            // 30天前
            $d3 = date('Y-m-d', strtotime($d1) - 24 * 60 * 60 * 30);
        } 

        $result = $this->total_model->get_reg_num($d1, $d2);
        $day_reg_num = $this->total_model->get_day_reg_num($d3, $d2);
        // 查询天数+前30天每日注册数
        $day_reg = array(); 
        
        for ($i=0; $i<count($day_reg_num); $i++) {
            $day_reg[$day_reg_num[$i]['profit_day']] = $day_reg_num[$i]['day_reg_num'];
        }

        $data = array(
            'd1'      => $d1,
            'd2'      => $d2,
            'result'  => $result,
            'day_reg' => $day_reg,
            'statistics' => $this->statistics,
        );

        $this->load->view('total/reg_num', $data);
    } 
    
    public function player_change_score() {

        $limit   = 30; // 勿改 
        $offset  = trim($this->input->get('offset'));
        $account = trim($this->input->get('account'));
        $query_time = trim($this->input->get('query_time'));
        $haveNextpage = false;

        if (empty($account)) {
            $result = array();
            $offset = 0;
            $query_time   = 0; 
        } else {
            if (strpos($account, '@')) {
                $account = $this->register_poker->get_id_from_email($account);
            }
//echo "account:$account, offset:$offset, limit:$limit;";
            if ($query_time == 0) {
                $from_time = date('Y-m-d', strtotime('-1 day')) . ' 23:59:59';
                $to_time   = date('Y-m-d') . ' 23:59:59';
            } else {
                $temp_time = $query_time - 1;
                $from_time = date('Y-m-d', strtotime("$temp_time day")) . ' 23:59:59';
                $to_time   = date('Y-m-d', strtotime("$query_time day")) . ' 23:59:59';
            }
            $result = $this->userchip_mid->get_change_score($account, $from_time, $to_time, $offset * $limit, $limit);
            $haveNextPage = count($result) == $limit; 
        }

        $data = array(
            'result'  => $result,
            'account' => $account,
            'offset'  => $offset,
            'limit'   => $limit,
            'query_time' => $query_time,
            'haveNextPage'  => $haveNextPage,
            'statistics' => $this->statistics,
        );

        $this->load->view('total/player_change_score', $data);
    }  

    public function time_change_score() {
 
        $limit   = 30; // 勿改 
        $year = trim($this->input->get('year'));
        $month = trim($this->input->get('month'));
        $day = trim($this->input->get('day'));
        $hour = trim($this->input->get('hour'));
        $minute = trim($this->input->get('minute'));
        $second = trim($this->input->get('second'));

        $offset  = trim($this->input->get('offset'));
        $haveNextpage = false;

        if (empty($year)) {
            $strDate = date('Y-m-d H:i:s');
        } else {
            $strDate = $year . '-' . $month . '-' . $day . ' ' . $hour . ':' . $minute . ':' . $second; 
        } 


        if (empty($year)) {
            $result = array();
            $offset = 0;
        } else {
            $result = $this->userchip_mid->get_score_by_time($offset * $limit, $limit, $strDate);
            $haveNextPage = count($result) == $limit; 
        }

        $data = array(
            'result'  => $result,
            'offset'  => $offset,
            'limit'   => $limit,
            'strDate' => $strDate,
            'haveNextPage' => $haveNextPage,
            'statistics' => $this->statistics,
        );

        $this->load->view('total/time_change_score', $data);
    }

}
