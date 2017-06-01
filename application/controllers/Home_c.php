<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_c extends CI_Controller {

	public function __construct() {
  		parent::__construct();
  		$this->load->model('mymodel');
  		$this->load->library('encryption');
 	}

 	public function index() {
		if($this->session->userdata('status') != "login"){
			$this->load->view('Home');
		}else{ 
			$this->load->view('logged/Home_user');
		}
	}
	

	public function registerData(){
        if (isset($_POST['register-submit'])){
            $target = "./images/".basename($_FILES['pic']['name']);
            $username = $_POST['username'];
            $password = $_POST['password'];
            $name =  $_POST['name'];
            $email = $_POST['email'];
            $nomor = $_POST['nomor'];
            $data_insert = array(
                'username' => sha1($username),
                'password' => sha1($password),
                'name' => $this->encryption->encrypt($name),
                'email' => $this->encryption->encrypt($email),
                'nomor' => $this->encryption->encrypt($nomor),
                'pic' => $target
            );
            
            if(is_uploaded_file($_FILES['pic']['tmp_name'])){
                move_uploaded_file($_FILES['pic']['tmp_name'], $target);
                $data['err_message'] = "REGISTER SUKSES";
                $this->load->view('V_login', $data);
            } else {
                $data['err_message'] = "REGISTER SUKSES";
                $this->load->view('V_login', $data);
            }
            $res = $this->db->insert('user', $data_insert);
        }
    }


	public function home(){
		$this->load->view('Home');
	}

}
