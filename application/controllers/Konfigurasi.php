<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }

    public function index(){
        if (!$this->session->userdata('login')) {
            redirect('login');
        } else {
            $data['konfigurasi'] = $this->ambil_data_konfigurasi()->result_array();
            $data['content'] = 'backend/konfigurasi'; 
            load_template($data['content'], $data);
        }
    }

    private function ambil_data_konfigurasi(){
        return $this->db->get('konfigurasi');
    }

    public function editKonfigurasi(){
        $Jwebsite = $this->input->post('judul_website', TRUE);
        $PWebsite = $this->input->post('profile_website', TRUE);
        $IG = $this->input->post('instagram', TRUE);
        $FC = $this->input->post('facebook', TRUE);
        $email = $this->input->post('email', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
        $latitude = $this->input->post('latitude', TRUE);
        $longitude = $this->input->post('longitude', TRUE);
        $noWA = $this->input->post('no_wa', TRUE);
        
        $data = $this->db->get('konfigurasi')->row();
        if (trim($Jwebsite) === '' || trim($PWebsite) === '' || trim($IG) === '' || trim($FC) === '' || trim($email) === '' || trim($alamat) === '' || trim($noWA) === '') {
            $this->session->set_flashdata('error', 'Maaf, Data tidak boleh ada yang kosong.');
            redirect('konfigurasi');
        } else {
            $konfigurasi = array(
                'judul_website' => $Jwebsite != null ? $Jwebsite : $data->judul_website,
                'profile_website' => $PWebsite != null ? $PWebsite : $data->profile_website,
                'instagram' => $IG != null ? $IG : $data->instagram,
                'facebook' => $FC != null ? $FC : $data->facebook,
                'email' => $email != null ? $email : $data->email,
                'alamat' => $alamat != null ? $alamat : $data->alamat,
                'latitude' => $latitude != null ? $latitude : $data->latitude,
                'longitude' => $longitude != null ? $longitude : $data->longitude,
                'no_wa' => $noWA != null ? $noWA : $data->no_wa,
            );

            $this->db->update('konfigurasi', $konfigurasi);
            $this->session->set_flashdata('success', 'Data Konfigurasi berhasil diubah.');
            redirect('konfigurasi');
        }
    }
}