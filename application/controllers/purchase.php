<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase extends MY_Controller {

    public function __construct() {
        parent::__construct(true);
        $this->load->library('midware/M_sys', 'm_sys');

        $this->statistics = $this->config->item('statistics');
    }
    
    public function recently() {
        $limit  = 50; // 勿改 
        $year   = trim($this->input->get('year'));
        $month  = trim($this->input->get('month'));
        $day    = trim($this->input->get('day'));
        $offset = trim($this->input->get('offset'));
        $haveNextpage = false;

        if (empty($year)) {
            $strDate = date('Y-m-d');
            $offset = 0;
        } else {
            $strDate = "$year-$month-$day"; 
        }

        $result = $this->m_sys->get_purchase_recently($offset * $limit, $limit, $strDate);
        $haveNextPage = count($result) == $limit; 

        $data = array(
            'result'  => $result,
            'offset'  => $offset,
            'limit'   => $limit,
            'strDate' => $strDate,
            'haveNextPage' => $haveNextPage,
            'statistics' => $this->statistics,
        );

        $this->load->view('purchase/recently', $data); 
    } 

    public function type() {
        $limit  = 50; // 勿改 
        $year   = trim($this->input->get('year'));
        $month  = trim($this->input->get('month'));
        $day    = trim($this->input->get('day'));
        $offset = trim($this->input->get('offset'));
        $type   = trim($this->input->get('type'));
        $haveNextpage = false;
 
        if (empty($year)) {
            $strDate = date('Y-m-d');
            $offset  = 0;
            $type    = 'SMC_M';
        } else {
            $strDate = "$year-$month-$day"; 
        }

        $result = $this->m_sys->get_purchase_by_type($type, $strDate, $offset * $limit, $limit);
        $haveNextPage = count($result) == $limit; 

        $data = array(
            'result'  => $result,
            'offset'  => $offset,
            'limit'   => $limit,
            'strDate' => $strDate,
            'type'    => $type,
            'haveNextPage' => $haveNextPage,
            'statistics' => $this->statistics,
        );

        $this->load->view('purchase/type', $data);         
    } 

    public function user() {
        $limit  = 50; // 勿改 
        $year   = trim($this->input->get('year'));
        $month  = trim($this->input->get('month'));
        $day    = trim($this->input->get('day'));
        $offset = trim($this->input->get('offset'));
        $type   = trim($this->input->get('type'));
        $account      = trim($this->input->get('account'));
        $haveNextpage = false;

        if (empty($year)) {
            $strDate = date('Y-m-d');
            $result = array();
            $offset = 0;
        } else {
            $strDate = "$year-$month-$day"; 
            $result = $this->m_sys->get_purchase_by_user($type, $account, $strDate, $offset * $limit, $limit);
            $haveNextPage = count($result) == $limit; 
        }

        $data = array(
            'result'  => $result,
            'offset'  => $offset,
            'limit'   => $limit,
            'strDate' => $strDate,
            'type'    => $type,
            'account'      => $account,
            'haveNextPage' => $haveNextPage,
            'statistics'   => $this->statistics,
        );

        $this->load->view('purchase/user', $data);                 
    } 

    public function insert() {
        $account = trim($this->input->get('account'));
        $type    = trim($this->input->get('type'));
        $chip    = trim($this->input->get('chip'));
        $source  = trim($this->input->get('source'));
        $strDate = date('Ymd'); 
        if (!empty($account)) {
            $result = $this->m_sys->insert_purchase($account, $type, $chip, $source, $strDate);
        }

        $data = array(
            'account' => $account,
            'type'    => $typc,
            'chip'    => $chip,
            'source'  => $source,
            'result'  => $result,
            'statistics'   => $this->statistics,
        );

        $this->load->view('purchase/insert', $data);

    }
}
