<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Services_c extends CI_Controller {

	public function __construct() {
  		parent::__construct();

 	}
	
	public function index() {
		if($this->session->userdata('status') != "login"){
			$this->load->view('Services');
		}else{ 
			echo "YOU'RE ALREADY LOGGED IN";
		}
	}
}