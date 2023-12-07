<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('login')){
			redirect(site_url('dashboard'));
		} else {
			$this->load->view('backend/login');
		}
	}

	private function Authentifikasi_model($user){
		$this->db->from('user');
		$this->db->where('username', $user);
		$query = $this->db->get();
		return $query->row();
	}

	public function Authentifikasi(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'username' => $username,
			'password' => $password
		);
		$dataPengguna = serialize($data);

		$dataValid = $this->Authentifikasi_model($username);

		if ($username === '' && $password === ''){
			$this->session->set_flashdata('validation_error', 'Maaf, <strong>Username</strong> dan <strong>Password</strong> kosong!');
			$this->session->set_flashdata('item', $dataPengguna);
			redirect('login');
		} else if ($username === ''){ 
			$this->session->set_flashdata('validation_error', 'Maaf, <strong>Username</strong> kosong!');
			$this->session->set_flashdata('item', $dataPengguna);
			redirect('login');
		}else if ($password === ''){ 
			$this->session->set_flashdata('validation_error', 'Maaf, <strong>Password</strong> kosong!');
			$this->session->set_flashdata('item', $dataPengguna);
			redirect('login');
		}else {
			if ($dataValid === NULL){
				$this->session->set_flashdata('validation_error', 'Maaf, <strong>Username</strong> yang anda masukkan tidak ada dalam Data.');
				$this->session->set_flashdata('item', $dataPengguna);
				redirect('login');
			} else if ($dataValid->username == $username){
				if ($dataValid->password == $password) {
					if ($dataValid->level === 'Admin'){
						$dataSessi = array(
							'id_user' => $dataValid->id_user,
							'username' => $username,
							'password' => $password,
							'nama'    => $dataValid->nama,
							'tipe_user' => $dataValid->level,
							'login' => 'loged_in'
						);
						$this->session->set_userdata($dataSessi);
						$data = array(
							'pengguna' => "".$username."(".$dataValid->id_user.")",
							'tanggal' => date('Y-m-d H:i:s'),
							'aktivitas' => "Telah melakukan Login"
						);
						$this->db->insert('log_user', $data);
						redirect(site_url('dashboard'));
					} else if ($dataValid->level === 'Kontributor') {
						$dataSessi = array(
							'id_user' => $dataValid->id_user,
							'username' => $username,
							'password' => $password,
							'nama'    => $dataValid->nama,
							'tipe_user' => $dataValid->level,
							'login' => 'loged_in'
						);
						$this->session->set_userdata($dataSessi);
						$data = array(
							'pengguna' => "".$this->session->userdata('username')."(".$this->session->userdata('id_user').")",
							'tanggal' => date('Y-m-d H:i:s'),
							'aktivitas' => "Telah melakukan Logout"
						);
						$this->db->insert('log_user', $data);
						redirect(site_url('dashboard'));
					} else {
						$this->session->set_flashdata('validation_error', 'Maaf, terjadi kesalahan saat Login.');
						redirect('login');
					}
				} else if ($dataValid != $password) {
					$this->session->set_flashdata('validation_error', 'Maaf, <strong>Password</strong> yang anda masukkan tidak Valid.');
					$this->session->set_flashdata('item', $dataPengguna);
					redirect('login');
				}
			} else if ($dataValid->username != $username) {
				$this->session->set_flashdata('validation_error', 'Maaf, <strong>Username</strong> yang anda masukkan tidak Valid.');
				$this->session->set_flashdata('item', $dataPengguna);
				redirect('login');
			} else {
				$this->session->set_flashdata('validation_error', 'Maaf, Terjadi kesalahan saat Login.');
				redirect('login');
			}
		}
	}

	public function logout(){
		$data = array(
			'pengguna' => "".$this->session->userdata('username')."(".$this->session->userdata('id_user').")",
			'tanggal' => date('Y-m-d H:i:s'),
			'aktivitas' => "Telah melakukan Logout"
		);
		$this->db->insert('log_user', $data);
		$this->session->sess_destroy();
		$this->session->set_flashdata('validation_success', 'Anda berhasil Logout.');
		redirect('login');
	}
}