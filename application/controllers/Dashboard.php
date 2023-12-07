<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }

	public function index()
	{
		if (!$this->session->userdata('login')) {
			redirect('login');
		} else {
			$this->db->select('k.nama_kategori, k.id_kategori, COUNT(c.id_konten) AS jumlah_konten');
			$this->db->from('kategori k');
			$this->db->join('konten c', 'k.id_kategori = c.id_kategori', 'left');
			$this->db->group_by('k.nama_kategori, k.id_kategori');

			$query = $this->db->get();
			$data['jml_konten_ktgr'] = $query->result();

			$data['content'] = 'backend/dashboard'; 
			load_template($data['content'], $data);
		}
	}

	public function hapusNontifikasi(){
		$id = $this->input->post('id');
		$this->db->where('id_nontifikasi', $id);
		$this->db->delete('nontifikasi');
		$success = "terhapus";
		echo json_encode($success);
	}

	public function captcha()
	{
		$data = captcha_generator($this->input->post('captcha') == null ? '' : $this->input->post('captcha'));
		$this->session->set_flashdata('success', 'Captcha berhasil dibuat dengan: nama file = '.$data['filename'].', karakter = '.$data['text'].', disimpan ke = '.$data['outputPath']);
		redirect('dashboard');
	}

	public function hapus_captcha($id = '')
	{
		$query = $this->db->get('captcha');

		if ($query->num_rows() < 4){
			$this->session->set_flashdata('error', 'Maaf, penghapisan Captcha mencapai batas data maksimum(3)');
			redirect('dashboard');
		}

		$data_captcha = $this->input->post('hapus_captcha');
		if ($data_captcha != null){
			$this->db->where_in('captcha_id', $data_captcha)->delete('captcha');
			$this->session->set_flashdata('success', 'Captcha terkait berhasil dihapus');
			redirect('dashboard');
		}

		if ($id != '' || $data_captcha === null){
			$this->db->where('captcha_id', $id)->delete('captcha');
			$this->session->set_flashdata('success', 'Captcha terkait berhasil dihapus');
			redirect('dashboard');
		}
	}

	public function profile(){
		$username = $this->input->get('username');

		if ($username == null){
            $data['profile_valid_user'] = false;
            redirect('profile');
        } else {
            $data['profile_valid_user'] = true; 
            redirect(base_url('profile/index/'.$username));
        }
	}
}
