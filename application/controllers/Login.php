<?php 

class Login extends CI_Controller{

	function __construct(){
		parent::__construct();		
		$this->load->model('m_login');

	}

	function index(){
		$data['err_message'] = "";
		if($this->session->userdata('status') != "login"){
			$this->load->view('V_login', $data);
		}else{ 
			echo "YOU'RE ALREADY LOGGED IN";
		}
		
	}

	function aksi_login(){
		$username = $this->input->post('username');
		$password = $this->input->post('pass');
		$where = array(
			'username' => sha1($username),
			'password' => sha1($password)
			);
		$cek = $this->m_login->cek_login("user",$where);
		if($cek->num_rows()==1){

			$data_session = array(
				'nama' => $username,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("user"));

		}else{
			$data['err_message'] = "USERNAME / SPASSWORD SALAH";
			$this->load->view('V_login', $data);
			echo $password;
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}