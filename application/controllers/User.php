<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }

	public function check_not_empty($validasi) {
        $trimmedValue = trim($validasi);
        if ($trimmedValue === '') {
            // $this->form_validation->set_message('check_not_empty', 'Bidang %s harus disii dan tidak boleh kosong.');
            return false;
        }
        return true;
    }

	public function index()
	{
		if (!$this->session->userdata('login')) {
			redirect('login');
		} else {
			$data['dataUser'] = $this->User_model->data_user();
			$data['logUser'] = $this->User_model->log_dataUser();
			$data['content'] = 'backend/pengguna'; 
			load_template($data['content'], $data);
		}
	}

	public function UserDataEdit($id){
		$DataUser = $this->User_model->dataUserEdit($id);
		echo json_encode($DataUser);
	}

	public function editData(){
		$this->form_validation->set_rules('username', 'Username', 'callback_check_not_empty');		
		$this->form_validation->set_rules('nama', 'Nama', 'callback_check_not_empty');		
		$this->form_validation->set_rules('tipe_user', 'Tipe User', 'callback_check_not_empty');
		
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('error', "Pastikan tidak ada bidang data yang kosong dalam mengubah data!");
			redirect('user');
		} else {
			$id = $this->input->post('id_user', true);
			$username = $this->input->post('username', true);
			$nama = $this->input->post('nama', true);
			$tipe_user = $this->input->post('tipe_user', true);
			$dataPengguna = $this->db->from('user')->where('username', $username)->where_not_in('id_user', $id)->get();
			$dataLama = $this->db->from('user')->where('id_user', $id)->get()->row();

			if ($dataPengguna->num_rows() > 0){
				$this->session->set_flashdata('error', "Username tidak boleh sama dengan data yang sudah ada!");
				redirect('user');
			} else if ($username == $dataLama->username && $nama == $dataLama->nama && $tipe_user == $dataLama->level) {
				$this->session->set_flashdata('warning', "Data yang dipilih tidak mengalami perubahan apapun!");
				redirect('user');
			} else {
				$dataPengguna = array(
					'username' => $username_aman,
					'nama' => $nama_aman,
					'level' => $tipe_user_aman
				);
				$this->User_model->editDataUser($dataPengguna, $id);
				$this->session->set_flashdata('success', "Data pengguna yang dipilih berhasil diubah!");
				redirect('user');
			}
		}
	}

	public function userDataHapus($id){
		$this->User_model->dataUserHapus($id);
		$this->session->set_flashdata('success', 'Data pengguna yang dipilih berhasil dihapus.');
		redirect('user');
	}

	public function userLogDataHapus($id){
		$this->User_model->dataLogUserHapus($id);
		$this->session->set_flashdata('success', 'Data akktivitas yang dipilih berhasil dihapus.');
		redirect('user');
	}

	public function multipleLogDataHapus() {
		$items = $this->input->post('data_log', true);
		// var_dump($items);die;
		if (!empty($items)) {
			$this->User_model->delete_items($items);
			$this->session->set_flashdata('success', 'Item-item yang dipilih telah berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Maaf, mohon untuk memilih data yang akan dihapus.');
		}
		redirect('user');
	}

	public function tambah_user(){
		$this->form_validation->set_rules('username', 'Username', 'callback_check_not_empty');		
		$this->form_validation->set_rules('nama', 'Nama', 'callback_check_not_empty');		
		$this->form_validation->set_rules('password', 'Password', 'callback_check_not_empty');		
		$this->form_validation->set_rules('tipe_user', 'Tipe User', 'callback_check_not_empty');	
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', "Pastikan tidak ada bidang data yang kosong dalam menambahkan data!");
			redirect('user');
		} else {
			$username = $this->input->post('username', true);
			$nama = $this->input->post('nama', true);
			$password = $this->input->post('password', true);
			$tipe_user = $this->input->post('tipe_user', true);

			$dataPengguna = $this->db->from('user')->where('username', $username)->get();
			if ($dataPengguna->num_rows() > 0){
				$this->session->set_flashdata('error', "Username tidak boleh sama dengan data yang sudah ada!");
				redirect('user');
			}

			$dataPengguna = array(
				'username' => $username,
				'nama' => $nama,
				'password' => $password,
				'level' => $tipe_user
			);

			$dataTambah = $this->User_model->tambah_user($dataPengguna);
			if ($dataTambah === TRUE){
				$this->session->set_flashdata('success', "Data berhasil ditambahkan!");
				redirect('user');
			}else{
				$this->session->set_flashdata('warning', "Maaf, Data Username telah digunakan!");
				redirect('user');
			}
		}
		
	}
}
