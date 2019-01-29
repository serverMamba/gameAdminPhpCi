<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ping extends MY_Controller {
	public function __construct() {
		parent::__construct(true, false);
	}
	
	public function index() {
		echo "pong";
	}
	
	
}
