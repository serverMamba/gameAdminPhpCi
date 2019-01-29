<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Avatar extends MY_Controller {

    public function __construct() {
        parent::__construct(true);
    }
    
    public function index() {

        $data = array();
        $this->load->view('avatar', $data);
        
    }

}
