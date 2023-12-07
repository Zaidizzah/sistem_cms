<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'Nontifikasi.php';
class Kategori extends CI_Controller {

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
            $data['kategori'] = $this->db->get('kategori')->result_array();
            $data['content'] = 'backend/kategori'; 
            load_template($data['content'], $data);
        }
    }

    public function tambahKategori(){
        $namaKategori = $this->input->post('kategori', TRUE);
        if (trim($namaKategori) === ''){
            $this->session->set_flashdata('error', 'Data nama Kategori Tidak Boleh Kosong');
            redirect('Kategori');
        } else {
            $namaKategori_aman = htmlspecialchars($namaKategori, ENT_QUOTES, 'UTF-8');
            $kategori = $this->db->where('nama_kategori', $namaKategori)->get('kategori');

            if (strpos($namaKategori_aman, 'removed') == true){
                $this->session->set_flashdata('error', 'Maaf, Data nama Kategori anda mengandung sqript yang tidak diperbolehkan.');
                redirect('Kategori');
            }

            if (strlen($namaKategori_aman) > strlen($namaKategori)){
                $this->session->set_flashdata('error', 'Maaf, Data nama Kategori anda mengandung sqript yang tidak diperbolehkan.');
                redirect('Kategori');
            }
            
            if ($kategori->num_rows() > 0){
                $this->session->set_flashdata('error', 'Data nama Kategori Sudah Ada');
                redirect('Kategori');
            } else {
                $this->db->insert('kategori', ['nama_kategori' => $namaKategori_aman, 'digunakan' => 0, 'dibuat_pada' => date('Y-m-d')]);
                $this->session->set_flashdata('success', 'Data nama Kategori Berhasil Ditambahkan');
                redirect('Kategori');
            }
        }
    }

    public function hapusKategori($idKategori){
        $notif = new Nontifikasi($this);
        if (trim($idKategori) === '' || trim($idKategori) === null){
            $this->session->set_flashdata('error', 'Data Kategori Tidak Boleh Kosong');
            redirect('Kategori');
        } else {
            if (is_array($idKategori) === true){
                $jumlahKategoriHapus = count($idKategori);
            } else {
                // Nop
            }
            $notif->nontifikasiBaru($idKategori, $jumlahKategoriHapus);
            $this->db->where('id_kategori', $idKategori)
            ->set('id_kategori', 'id_kategori = ""', FALSE)
            ->update('konten');

            $this->db->where_in('id_kategori', $idKategori);
            $this->db->delete('kategori');
            $this->session->set_flashdata('success', 'Data Kategori Berhasil Dihapus');
            $this->db->where('id_kategori', $idKategori)->delete('kategori');
            redirect('Kategori');
        }
    }

    public function hapusBanyakKategori(){
        $notif = new Nontifikasi($this);
        $idKategori = $this->input->post('idKategori');
        if ($idKategori === '' || $idKategori === null){
            $this->session->set_flashdata('error', 'Data Kategori Tidak Boleh Kosong');
            redirect('Kategori');
        } else {
            $jumlahKategoriHapus = count($idKategori);
            $notif->nontifikasiBaru($idKategori, $jumlahKategoriHapus);

            // Menghapus nilai id_kategori dari masing konten yang memiliki kategori terkait
            $this->db->set('id_kategori', '')->where_in('id_kategori', $idKategori)->update('konten');
            $this->db->where_in('id_kategori', $idKategori);
            $this->db->delete('kategori');
            $this->session->set_flashdata('success', 'Data Kategori Berhasil Dihapus');
            $this->db->where_in('id_kategori', $idKategori)->delete('konten');
            redirect('Kategori');
        }
    }

    public function editKategori(){
        $id = $this->input->post('id_kategori');
        $namaKategori = $this->input->post('kategori', TRUE);
        $namaKategori_aman = htmlspecialchars($namaKategori, ENT_QUOTES, 'UTF-8');
        $dataLama = $this->db->from('kategori')->where('id_kategori', $id)->get()->row()->nama_kategori;

        if (trim($namaKategori) === '' || trim($id) === ''){
            $this->session->set_flashdata('error', 'Maaf, Bidang untuk edit Kategori Tidak Boleh Kosong');
            redirect('kategori');
        } else if ($namaKategori == $dataLama){
            $this->session->set_flashdata('error', 'Maaf, Mungkin anda harus merubah sesuatu.');
            redirect('kategori');
        } else {
            $this->db->where('id_kategori', $id);
            $this->db->update('kategori', ['nama_kategori' => $namaKategori_aman]);
            $this->session->set_flashdata('success', 'Data Kategori Berhasil Diubah');
            redirect('Kategori');
        }
    }
}