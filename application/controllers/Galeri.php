<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Galeri extends CI_Controller{

    public function __construct()
    {
        parent::__construct();   
    }

    public function index()
    {   
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
        // Validasi
        $config['base_url'] = site_url('galeri/index');
        $config['total_rows'] = $this->db->count_all('galeri');
        $config['per_page'] = 6;

        $this->pagination->initialize($config);
        // var_dump($config['total_rows']);
        $data['pagination'] = $this->pagination->create_links();
        $data['galeri'] = $this->db->limit($config['per_page'], ($this->uri->segment(3) ? $this->uri->segment(3) : 0))->get('galeri')->result();
        $data['content'] = 'backend/galeri'; 
        load_template($data['content'], $data);
    }

    public function tambah_galeri()
    {
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
        // Validasi
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', 'Maaf, Harap isi semua bidang!');
            redirect('galeri');
        } else {
            if ($_FILES['file']['name'] == '' || $_FILES['file']['error'] > 0 || $_FILES['file']['name'] == null) {
                $this->session->set_flashdata('error', 'Maaf, Gambar harus diisi!');
                redirect('galeri');
            }
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
            $config['upload_path'] = 'assets/galeri/';
            $config['allowed_types'] = '*';
            $config['max_width'] = 2500; 
            $config['max_height'] = 1800;
            $config['max_size'] = 1800;
            $config['file_name'] = $nama_file_baru;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('galeri');
            } else {
                $data = $this->upload->data();
                $nama_file_foto = $data['file_name'];

                $keterangan = $this->input->post('deskripsi', TRUE);

                if ($keterangan === '' || $keterangan === null){
                    $this->session->set_flashdata('error', 'Maaf, Galeri yang anda masukkan gagal untuk ditambahkan!');
                    redirect('galeri');
                }

                $judul = $this->input->post('judul', TRUE);
                $tanggal = date('Y-m-d');

                $data_galeri = [
                    'judul' => $judul,
                    'deskripsi' => $keterangan,
                    'foto' => $nama_file_foto,
                    'tanggal' => $tanggal
                ];
                $this->db->insert('galeri', $data_galeri);
                $this->session->set_flashdata('success', 'Data Galeri baru telah berhasil ditambahkan.');
                redirect('galeri');
            }
        }
    }

    public function hapus_galeri($id)
    {
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
        // Validasi
        $data = $this->db->where('id_galeri', $id)->get('galeri')->row();
        if ($data->foto == file_exists('./assets/galeri/' . $data->foto)) {
            unlink('./assets/galeri/' . $data->foto);
        }
        $this->session->set_flashdata('success', 'Data Galeri dengan Judul: '.$data->judul.' telah berhasil dihapus.');
        $this->db->where('id_galeri', $id)->delete('galeri');
        redirect('galeri');
    }

    public function ambil_data_galeri($id)
    {
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
        // Validasi
        $data_galeri = $this->db->where('id_galeri', $id)->get('galeri')->row();
        echo json_encode($data_galeri);
    }

    public function edit_galeri()
    {
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
        // Validasi
        $id = $this->input->post('id_galeri');
        $judul = trim($this->input->post('judul', true));
        $deskrip = trim($this->input->post('deskripsi'));
        $file = $_FILES['file'];
        // var_dump($file, 'Judul: '. $judul, 'Deskripsi: '. $deskrip);die;

        $data_glr = $this->db->where('id_galeri', $id);
        if ($judul == null){
            $this->session->set_flashdata('error', 'Maaf, Data Galeri dengan Judul: '.$data->judul.' gagal untuk diedit.');
            redirect('galeri');
        }
        if ($deskrip == null){
            $this->session->set_flashdata('error', 'Maaf, Data Galeri dengan Judul: '.$data->judul.' gagal untuk diedit.');
            redirect('galeri');
        }
        if ($file['name'] != null && $file['error'] > 0) {
            $nama_file_tanpa_ekstensi = pathinfo($file['name'], PATHINFO_FILENAME);
            $nama_file_tanpa_ekstensi = iconv('UTF-8', 'UTF-8//IGNORE', $nama_file_tanpa_ekstensi);
            $nama_file_tanpa_ekstensi = preg_replace('/[^\p{L}\p{N}_\.]+/u', '', $nama_file_tanpa_ekstensi);

            if ($nama_file_tanpa_ekstensi === '' || preg_match('/[^\x20-\x7E]/', $nama_file_tanpa_ekstensi)) {
                $nama_file_tanpa_ekstensi = date('YmdHis');
            }

            $ekstensi_file = pathinfo($file['name'], PATHINFO_EXTENSION);
            $batasan_panjang = 27;

            if (strlen($nama_file_tanpa_ekstensi) > $batasan_panjang) {
                $nama_file_tanpa_ekstensi = substr($nama_file_tanpa_ekstensi, 0, $batasan_panjang);
            }

            $nama_file_baru = $nama_file_tanpa_ekstensi . '.' . $ekstensi_file;
            $config['upload_path'] = 'assets/galeri/';
            $config['allowed_types'] = '*';
            $config['max_size'] = 2500;
            $config['max_width'] = 1800; 
            $config['max_height'] = 1800;
            $config['file_name'] = $nama_file_baru;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('galeri');
            } else {
                $data = $this->upload->data();
                $nama_file_foto = $data['file_name'];

                if (!empty($data_glr->foto)) {
                    $path_gambar_lama = 'assets/galeri/' . $data_glr->foto; 
                    if (file_exists($path_gambar_lama)) {
                        unlink($path_gambar_lama); 
                    }
                }

                $tanggal = date('Y-m-d');
                $data_galeri = [
                    'judul' => $judul,
                    'deskripsi' => $deskrip,
                    'foto' => $nama_file_foto,
                    'tanggal' => $tanggal
                ];
                $this->db->where('id_galeri', $id);
                $this->db->update('galeri', $data_galeri);
                $this->session->set_flashdata('success', 'Data Galeri baru telah berhasil ditambahkan.');
                redirect('galeri');
            }
        }

        $tanggal = date('Y-m-d');
        $data_galeri = [
            'judul' => $judul,
            'deskripsi' => $deskrip,
            'tanggal' => $tanggal
        ];
        $this->db->where('id_galeri', $id);
        $this->db->update('galeri', $data_galeri);
        $this->session->set_flashdata('success', 'Data Galeri baru telah berhasil ditambahkan.');
        redirect('galeri');
    }

    // End file Galeri.php untuk Backend

    // Start file Galeri.php untuk Frontend

    public function galeri_index()
    {
        $data['title'] = 'Galeri';
        $data['galeri_frontend'] = $this->db->get('galeri')->result();
        load_template_frontend('tampilan-frontend/galeri', $data);
    }
}