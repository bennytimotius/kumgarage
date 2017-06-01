<?php 
 
class Login_admin extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('m_login');
	}
 
	function index(){
		$data['err_message'] = ""; 
		$this->load->view('admin/V_loginadmin', $data);
	}

	function aksi_login(){
		$username = $this->input->post('useradmin');
		$password = $this->input->post('passadmin');
		$where = array(
			'username' => sha1($username),
			'password' => sha1($password)
			);
		$cek = $this->m_login->cek_login("admin",$where);
		if($cek->num_rows()==1){

			$data_session = array(
				'nama' => $username,
				'status' => "admin"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("Admin"));

		}else{
			$data['err_message'] = "USERNAME / PASSWORD SALAH";
			$this->load->view('admin/V_loginadmin', $data);
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}
}