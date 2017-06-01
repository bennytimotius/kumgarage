<?php 
 
class User extends CI_Controller{
 
	function __construct(){
		parent::__construct();
		$this->load->model('mymodel');
		$this->load->library('email');
		$this->load->helper('url');
		$this->load->library('encryption');
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}
 
	function index(){
		if($this->session->userdata('status') != "login"){
			redirect(base_url("user"));
		}else{ 
			$this->load->view('logged/Home_user');
		}
	}

	function about(){
		$this->load->view('logged/About');
	}

	function services(){
		$this->load->view('logged/Services');
	}

	function booking(){
		$notif['status'] = "";
		$this->load->view('logged/Booking', $notif);
	}

	public function bookingJadwal() {
		$nama = $this->session->userdata('nama');
	   	$jadwal = $this->input->post('jadwal');
	    $kendaraan = $this->input->post('kendaraan');
	    $keluhan =  $this->input->post('keluhan');
	    
		$data = array(
		'nama' => $nama,
	    'jadwal' => $jadwal,
	    'kendaraan' => $kendaraan,
	    'keluhan' => $keluhan
	   );

	  $this->mymodel->addBooking($data);
	  $notif['status'] = "BOOKING TELAH DIKIRIM, ANDA AKAN MENDAPATKAN BALASAN EMAIL DARI KAMI";

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
	  $this->email->to('zenabirg350@gmail.com');
	  $this->email->from('zenabirg350@gmail.com' , 'KUM Garage');
	  $this->email->subject('Booking diterima !');
	  $this->email->message('Hai, anda menerima 1 booking service kendaraan oleh ' . $nama . " ! " . "Jadwal : " . $jadwal . "Tipe Kendaraan : " . $kendaraan . "Keluhan : " . $keluhan);
	  $this->email->send();

	  $this->load->view('logged/Booking', $notif);
	}

	public function viewProfile(){
		$session = (string)($this->session->userdata('nama'));
		$username = sha1($session);
		$profil = $this->mymodel->GetProfile("where username = '$username'");
		$data = array(
			// "username" => $profil[0]['username'],
			// "password" => $profil[0]['password'],
			"name" => $this->encryption->decrypt($profil[0]['name']),
			"email" => $this->encryption->decrypt($profil[0]['email']),
			"nomor" => $this->encryption->decrypt($profil[0]['nomor']),
			"pic" => $profil[0]['pic']
			 );
		$this->load->view('logged/Profil', $data);
	}

	public function updatePhoto(){
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
		    $username = (string)($this->session->userdata('nama'));
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
			    redirect('user/viewProfile');
		    }
	  	}else{
		    $data['user'] = $this->mymodel->get_profile_id($username);
		    $this->load->view('logged/Profil', $data);
	    }
  }

  	public function updateProfile(){
	    $this->load->helper('form');
	    $this->load->library('form_validation');
	    
	    
		    $session = (string)($this->session->userdata('nama'));
		    $user = sha1($session);
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
			    redirect('user/ViewProfile');
		    }
	  	}



}