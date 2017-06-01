<?php 
 
class Admin extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$this->load->library('encryption');
		if($this->session->userdata('status') != "admin"){
			redirect(base_url("Login_admin"));
		}
	}
 
	function index(){
		if($this->session->userdata('status') != "admin"){
			redirect(base_url("Admin"));
		}else{ 
			$data = $this->mymodel->getData();
	 		$this->load->view('admin/V_admin', array('data' => $data));
		}
	}

	function delete_booking(){
		 $delete = $this->input->post('booking');
		 $this->mymodel->delete_item($delete);
		 redirect(base_url("Admin"));
	}

	function delete_user(){
		 $delete = $this->input->post('user');
		 $this->mymodel->delete_user($delete);
		 redirect(base_url("Admin/readUser"));
	}

	function readUser(){
		$data = $this->mymodel->getDataUser();
		$decoded = $data;
		$index = 0;
		foreach ($data as $x) {
			$decoded[$index]['name'] = $this->encryption->decrypt($x['name']);
			$decoded[$index]['email'] = $this->encryption->decrypt($x['email']);
			$decoded[$index]['nomor'] = $this->encryption->decrypt($x['nomor']);
			$index++;
		}
	 	$this->load->view('admin/V_admindata', array('data' => $decoded));
	}

	public function viewProfile($username){
		$profil = $this->mymodel->GetProfile("where username = '$username'");
		$data = array(
			"username" => $profil[0]['username'],
			"password" => $profil[0]['password'],
			"name" => $this->encryption->decrypt($profil[0]['name']),
			"email" => $this->encryption->decrypt($profil[0]['email']),
			"nomor" => $this->encryption->decrypt($profil[0]['nomor']),
			"pic" => $profil[0]['pic']
			 );
		$this->load->view('admin/V_adminprofil', $data);
	}

	public function viewProfileAdmin(){
		$session = (string)($this->session->userdata('nama'));
		$username = sha1($session);
		$profil = $this->mymodel->GetProfileAdmin("where username = '$username'");
		$data = array(
			"username" => $profil[0]['username'],
			"password" => $profil[0]['password']
			 );
		$this->load->view('admin/V_adminedit', $data);
	}

	public function editProfileAdmin(){
			$session = (string)($this->session->userdata('nama'));
		    $username = sha1($session);
			    $data =array(
			    'username' => $this->input->post('username'),
			    'password' => $this->input->post('password'),
			    );
			    
			    $this->mymodel->update_profileAdmin($username, $data);
			    redirect('Admin/viewProfileAdmin');
	  	
	}


	public function updatePhoto($username){
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    $this->load->library('upload');
	    
	    $is_submit = $this->input->post('is_submit');
    
	    if(isset($is_submit) && $is_submit == 1){
		    $fileUpload = array();
		    $isUpload = FALSE;
		    $config = array(
		    'upload_path' => './images/',
		    'allowed_types' => 'jpg|jpeg|png',
		    'max_size' => 5210
		    );
		  
		    $this->upload->initialize($config);
		    if($this->upload->do_upload('userfile')){
			    $fileUpload = $this->upload->data();
			    $isUpload = TRUE;
		    }

		    if($isUpload){
			    $data =array(
			   	'pic' => './images/' . $fileUpload['file_name']
			    );
			    
			    $this->mymodel->update_profile($username, $data);
			    redirect('Admin/readUser');
		    }
	  	}else{
		    $data['user'] = $this->mymodel->get_profile_id($username);
		    $this->load->view('admin/V_adminprofil', $data);
	    }
  }

  public function updateProfile($user){
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    
	   
		    $isUpload = true;

		    if($isUpload){
			    $username = $this->input->post('username');
		    	$password = $this->input->post('password');
		    	$name  = $this->input->post('name');
		    	$email = $this->input->post('email');
		    	$nomor = $this->input->post('nomor');
			    $data =array(
			    'username' => sha1($username),
			    'password' => sha1($password),
			    'name' => $this->encryption->encrypt($name),
			    'email' => $this->encryption->encrypt($email),
			    'nomor' => $this->encryption->encrypt($nomor)
			    );
			    
			    $this->mymodel->update_profile($user, $data);
			    redirect('admin/readUser');
		    }
	  	}


	  	public function viewBooking($username){
			$profil = $this->mymodel->GetProfile("where username = '$username'");
			$data = array(
				"username" => $profil[0]['username'],
				"password" => $profil[0]['password'],
				"name" => $this->encryption->decrypt($profil[0]['name']),
				"email" => $this->encryption->decrypt($profil[0]['email']),
				"nomor" => $profil[0]['nomor'],
				"pic" => $profil[0]['pic']
				 );
			$this->load->view('admin/V_adminmessage', $data);
		}

		public function messageBooking() {
			  $email = $_POST['email'];
			  $nama= $_POST['name'];
			  $pesan = $_POST['message'];
			  $config['protocol'] = "smtp";
			  $config['smtp_host'] = "ssl://smtp.gmail.com";
			  $config['smtp_port'] = "465";
			  $config['charset'] = "utf-8";
			  $config['smtp_user'] = "zenabirg350@gmail.com";
			  $config['smtp_pass'] = "kumgarage350";
			  $config['mailtype'] = "html";
			  $config['newline'] = "\r\n";
			  $config['validation'] = TRUE;
			  $this->email->initialize($config);
			  $name = (string)($this->session->userdata('nama'));
			  $this->email->to($email);
			  $this->email->from('zenabirg350@gmail.com' , 'KUM Garage');
			  $this->email->subject('Hai '. $nama . ', Anda menerima pesan dari KUM Garage !');
			  $this->email->message($pesan);
			  $this->email->send();
			  redirect('admin');
			}

}