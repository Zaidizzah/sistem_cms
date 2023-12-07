<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends CI_Controller {

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
            $data['dataCarousel'] = $this->db->get('caraousel')->result_array();
			$data['content'] = 'backend/carousel'; 
			load_template($data['content'], $data);
		}
	}

    public function editCarousel(){
        $id = $this->input->post('foto_ke');
        $judul = $this->input->post('judul', TRUE);

        if ($id === '' || $id === NULL){
            $this->session->set_flashdata('error', 'Maaf, Mohon pilih data Carousel keberapa terlebih dahulu.');
            redirect('carousel');
        } else {
            $nama_file = $_FILES['file']['name'];

            if ($nama_file != null || $nama_file != ''){
                $nama_file_tanpa_ekstensi = pathinfo($nama_file, PATHINFO_FILENAME);
                $nama_file_tanpa_ekstensi = iconv('UTF-8', 'UTF-8//IGNORE', $nama_file_tanpa_ekstensi);
                $nama_file_tanpa_ekstensi = preg_replace('/[^\p{L}\p{N}_\.]+/u', '', $nama_file_tanpa_ekstensi);

                if ($nama_file_tanpa_ekstensi === '' || preg_match('/[^\x20-\x7E]/', $nama_file_tanpa_ekstensi)) {
                    $nama_file_tanpa_ekstensi = date('YmdHis');
                }

                $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);
                $batasan_panjang = 27;

                if (strlen($nama_file_tanpa_ekstensi) > $batasan_panjang) {
                    $nama_file_tanpa_ekstensi = substr($nama_file_tanpa_ekstensi, 0, $batasan_panjang);
                }

                $nama_file_baru = $nama_file_tanpa_ekstensi . '.' . $ekstensi_file;
                $config['upload_path'] = 'assets/upload/';
                $config['allowed_types'] = '*';
                $config['max_size'] = 2500;
                $config['file_name'] = $nama_file_baru;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')){
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('carousel');
                }else{
                    $data = array('upload_data' => $this->upload->data());
                    $file_info = $this->upload->data();
                    $file_nama = $file_info['file_name'];
                    $data_lama = $this->db->where('id_caraousel', $id)->get('caraousel')->row(); 
                    $nama_file_lama = $data_lama->foto;
        
                    if (!empty($nama_file_lama)) {
                        $path_gambar_lama = 'assets/upload/' . $nama_file_lama; 
                        if (file_exists($path_gambar_lama)) {
                            unlink($path_gambar_lama); 
                        }
                    }
                    $this->session->set_flashdata('upload_message', 'Data Caraousel ke '.$id.' berhasil diubah dengan data yang baru.');
                    $this->session->set_flashdata('file_name', $data['upload_data']['file_name']);
                    $this->session->set_flashdata('file_type', $data['upload_data']['file_type']);
                    $this->session->set_flashdata('file_size', $data['upload_data']['file_size']);    

                    $datanama = array(
                        'judul' => $judul,
                        'foto' => $file_nama,
                    );

                    $this->db->where('id_caraousel', $id);
                    $this->db->update('caraousel', $datanama);
                    redirect('carousel');
                }
            } else {
                $datanama = array(
                    'judul' => $judul,
                );

                $this->db->where('id_caraousel', $id);
                $this->db->update('caraousel', $datanama);
                redirect('carousel');
            }
        }
    }

    public function tambahCarousel(){
        $query = $this->db->get('caraousel');
        $count = $query->num_rows();
        $judul = $this->input->post('judul', TRUE);

        if ($count === 7){
            $this->session->set_flashdata('error', 'Maaf, Foto Caraousel tidak diizinkan lebih dari '.$count.'.');
            redirect('carousel');
        } else if ($judul === '' || $judul === null) {
            $this->session->set_flashdata('error', 'Maaf, Pastikan semua bidang terisi!');
            redirect('carousel');
        } else {
            $nama_file = $_FILES['file']['name'];
            $nama_file_tanpa_ekstensi = pathinfo($nama_file, PATHINFO_FILENAME);
            $nama_file_tanpa_ekstensi = iconv('UTF-8', 'UTF-8//IGNORE', $nama_file_tanpa_ekstensi);
            $nama_file_tanpa_ekstensi = preg_replace('/[^\p{L}\p{N}_\.]+/u', '', $nama_file_tanpa_ekstensi);

            if ($nama_file_tanpa_ekstensi === '' || preg_match('/[^\x20-\x7E]/', $nama_file_tanpa_ekstensi)) {
                $nama_file_tanpa_ekstensi = date('YmdHis');
            }

            $ekstensi_file = pathinfo($nama_file, PATHINFO_EXTENSION);
            $batasan_panjang = 27;

            if (strlen($nama_file_tanpa_ekstensi) > $batasan_panjang) {
                $nama_file_tanpa_ekstensi = substr($nama_file_tanpa_ekstensi, 0, $batasan_panjang);
            }

            $nama_file_baru = $nama_file_tanpa_ekstensi . '.' . $ekstensi_file;
            $config['upload_path'] = 'assets/upload/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 2500;
            $config['file_name'] = $nama_file_baru;
            $this->load->library('upload', $config);
            
            if (!$this->upload->do_upload('file')){
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect('carousel');
            }else{
                if ($judul !== '' || $judul !== NULL){
                    $data = array('upload_data' => $this->upload->data());
                    $uploaded_file = $config['upload_path'] . $data['upload_data']['file_name'];

                    list($lebar, $tinggi) = getimagesize($uploaded_file);
                    
                    if ($lebar >= 382 && $tinggi >= 400) {
                        $this->session->set_flashdata('upload_message', 'Data Caraousel baru berhasil ditambahkan.');
                        $this->session->set_flashdata('file_name', $data['upload_data']['file_name']);
                        $this->session->set_flashdata('file_type', $data['upload_data']['file_type']);
                        $this->session->set_flashdata('file_size', $data['upload_data']['file_size']);
        
                        $file_nama = $data['upload_data']['file_name'];
        
                        $data = array(
                            'judul' => $judul,
                            'foto' => $file_nama
                        );
                        $this->db->insert('caraousel', $data);
                        redirect('carousel');
                    } else {
                        $this->session->set_flashdata('error', 'Maaf, Gambar tidak boleh melebihi 382x400 pixel.');
                        redirect('carousel');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Maaf, anda belum memasukkan data judul Caraousel.');
                    redirect('carousel');
                }
            }
        }
    }

    public function ambilDataCarousel() {
        $id = $this->input->post('id');
        $dataCarousel = $this->db->where('id_caraousel', $id)->get('caraousel')->row();
        echo json_encode($dataCarousel);
    }

    public function hapusCarousel($id){
        // hapus data gambar\
        $foto_carousel = $this->db->where('id_caraousel', $id)->get('caraousel')->row();
        $foto_lama = 'assets/upload/' . $foto_carousel->foto; 
        if (file_exists($foto_lama)) {
            unlink($foto_lama); 
        }

        $this->db->where('id_caraousel', $id);
        $this->db->delete('caraousel');
        $this->session->set_flashdata('success', 'Data yang terpilih berhasil dihapus');
        redirect('carousel');
    }
}