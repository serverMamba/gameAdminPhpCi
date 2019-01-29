<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewlog extends MY_Controller {

    public function __construct() {
        parent::__construct(true);
        
    }
    
    public function index() {
        $this->load->view('viewlog');
    }

    public function view() {
        $year = $this->input->get('year');
        $month = $this->input->get('month');
        $day = $this->input->get('day');

        $command = "cat ".APP_ROOT."/log/log-". $year ."-". $month ."-". $day .".php | grep 'user |'";
        system($command);
    }

}
