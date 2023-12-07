<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'ListenerKategori.php';
date_default_timezone_set('Asia/Jakarta');
class Konten extends CI_Controller 
{
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
            $data['konten'] = $this->db->select('konten.*, kategori.nama_kategori')->from('konten')->join('kategori', 'konten.id_kategori = kategori.id_kategori', 'left')->get()->result();
            $data['kategori'] = $this->db->select('*')->from('kategori')->get()->result();
            $data['content'] = 'backend/konten'; 
            load_template($data['content'], $data);
        }
    }

    public function ambilDataKontenEdit($id){
        $query = $this->db->from('konten')->where('id_konten', $id)->get()->row();
        echo json_encode($query);
    }
    
    public function tambahKonten(){
        $listenerKategori = new ListenerKategori($this);
        // Objek dari class ListenerKategori
        
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required|is_unique[konten.judul]', array('is_unique' => 'Maaf, Judul yang dimasukkan sudah ada dalam tabel konten!'));
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('kategori', 'Kategori', 'trim|required');

        $judul = $this->input->post('judul', TRUE);
        $data_data_judul_lama = $this->db->select('judul')->get('konten')->result();

        $judul_exist = false;
        foreach ($data_data_judul_lama as $data_judul) {
            if ($data_judul->judul == $judul) {
                $judul_exist = true;
                break;
            }
        }

        if ($judul_exist) {
            $this->session->set_flashdata('error', 'Maaf, Judul yang dimasukkan sudah ada atau terpakai dalam basis data!');
            redirect('Konten');
        } else {
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', 'Maaf, Harap isi semua bidang! / '.validation_errors());
                redirect('Konten');
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
                $config['max_width'] = 1500;
                $config['max_height'] = 1500;
                $config['file_name'] = $nama_file_baru;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file')) {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('konten');
                } else {
                    $data = $this->upload->data();
                    $nama_file_foto = $data['file_name'];

                    // Validasi jika terdapat gambar yang ditambahkan maupun juga apabila terdapat tag paragraph yang kosong,
                    $keterangan = $this->input->post('keterangan');
                    
                    $kode_1 = '<p></p>';
                    if (strpos($keterangan, $kode_1) !== false) {
                        $keterangan = str_replace($kode_1, '', $keterangan);
                    }
                    $keterangan = trim($keterangan);

                    if (preg_match('/<p><\/p>/', $keterangan)) {
                        $this->session->set_flashdata('error', 'Maaf, Konten anda gagal untuk ditambahkan!');
                        redirect('Konten');
                    }

                    if ($keterangan === '' || $keterangan === null){
                        $this->session->set_flashdata('error', 'Maaf, Konten anda gagal untuk ditambahkan!');
                        redirect('Konten');
                    }

                    $judul = $this->input->post('judul', TRUE);
                    $kategori = $this->input->post('kategori', TRUE);
                    $tanggal = date('Y-m-d');
                    $user = $this->session->userdata('username');
                    $pattern = '/(?<=[A-Z])(?=[a-z])|(?<=[A-Z])(?=[A-Z][a-z])/';
                    $dataSlugKonten = preg_replace($pattern, '+', $judul);
                    if (strpos($dataSlugKonten, ' ') !== false) {
                        $dataSlugKonten = str_replace(' ', '-', $judul);
                    }

                    $dataSlugKonten = strtolower($dataSlugKonten);
                    $dataKonten = [
                        'judul' => $judul,
                        'keterangan' => $keterangan,
                        'foto' => $nama_file_foto,
                        'slug' => $dataSlugKonten,
                        'id_kategori' => $kategori,
                        'tanggal' => $tanggal,
                        'username' => $user
                    ];
                    $listenerKategori->saatTambah($dataKonten);
                    $this->db->insert('konten', $dataKonten);
                    $this->session->set_flashdata('success', 'Data konten baru telah berhasil ditambahkan.');
                    redirect('konten');
                }
            }
        }
    }

    public function hapusKonten($id){
        $listenerKategori = new ListenerKategori($this);
        if ($id === NULL || $id === ''){
            $this->session->set_flashdata('error', 'Maaf, Terjadi kesalahan saat menghapus data yang dipilih');
            redirect('konten');
        } else {
            $dataLama = $this->db->where('id_konten', $id)->get('konten')->row();
            if ($dataLama->foto == file_exists('./assets/upload/' . $dataLama->foto)) {
                unlink('./assets/upload/' . $dataLama->foto);
            }
            $dataIDKategori = $this->db->where('id_konten', $id)->get('konten')->row();
            $listenerKategori->saatHapus($dataIDKategori->id_kategori);
            $this->db->where('id_konten', $id)->delete('konten');
            $this->db->where('id_konten', $id)->delete('komentar');
            $this->session->set_flashdata('success', 'Data yang terpilih berhasil dihapus.');
            redirect('konten');
        }
    }

    public function editKonten(){
        $listenerKategori = new ListenerKategori($this);
        // Objek dari class ListenerKategori

        $id = $this->input->post('id_konten');
        $judul = $this->input->post('judul', TRUE);
        $keterangan = $this->input->post('keterangan');
        $data_data_judul_lama = $this->db->select('judul')->where_not_in('id_konten', $id)->get('konten')->result();

        $judul_exist = false;
        foreach ($data_data_judul_lama as $data_judul) {
            if ($data_judul->judul == $judul) {
                $judul_exist = true;
                break;
            }
        }

        if ($judul_exist) {
            $this->session->set_flashdata('error', 'Maaf, Judul yang dimasukkan sudah ada atau terpakai dalam basis data!');
            redirect('Konten');
        } else {
            $kode_1 = '<p></p>';
            if (strpos($keterangan, $kode_1) !== false) {
                $keterangan = str_replace($kode_1, '', $keterangan);
            }
            $keterangan = trim($keterangan);
            
            if (preg_match('/<p><\/p>/', $keterangan)) {
                $this->session->set_flashdata('error', 'Maaf, Konten anda gagal untuk ditambahkan!');
                redirect('Konten');
            }

            $kategori = $this->input->post('kategori', TRUE);
            $tanggal = date('Y-m-d');
            $user = $this->session->userdata('username');
            $pattern = '/(?<=[a-z])(?=[A-Z])|(?<=[A-Z])(?=[A-Z][a-z])/';
            $dataSlugKonten = preg_replace($pattern, '+', $judul);
            if (strpos($dataSlugKonten, ' ') !== false) {
                $dataSlugKonten = str_replace(' ', '+', $judul);
            } 
            $dataSlugKonten = strtolower($dataSlugKonten);
            $idKategoriSebelumnya = $this->db->where('id_konten', $id)->get('konten')->row()->id_kategori;
            $fileInfo = $_FILES['file'];

            if (trim($judul) === '' && trim($keterangan) === '' && trim($kategori) === '' || $id === '' || $kategori ===  NULL || $kategori === 'tidak ada') {
                $this->session->set_flashdata('error', 'Maaf, Harap isi semua bidang!');
                redirect('konten');
            } else {
                if ($fileInfo['error'] != 0 || $fileInfo['name'] === ''){
                    $dataKonten = [
                        'judul' => $judul,
                        'keterangan' => trim($keterangan),
                        'slug' => $dataSlugKonten,
                        'id_kategori' => $kategori,
                        'tanggal' => $tanggal,
                        'username' => $user
                    ];
                    $listenerKategori->saatEdit($dataKonten, $idKategoriSebelumnya);
                    $this->db->where('id_konten', $id)->update('konten', $dataKonten);
                    $this->session->set_flashdata('success', 'Data konten terpilih telah berhasil diupdate');
                    redirect('konten');
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
                    $config['max_size'] = 2500;
                    $config['max_width'] = 1200;
                    $config['file_name'] = $nama_file_baru;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('file')) {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', $error);
                        redirect('konten');
                    } else {
                        $data = $this->upload->data();
                        $nama_file_foto = $data['file_name'];
                        $dataKonten = [
                            'judul' => $judul,
                            'keterangan' => $keterangan,
                            'foto' => $nama_file_foto,
                            'slug' => $dataSlugKonten,
                            'id_kategori' => $kategori,
                            'tanggal' => $tanggal,
                            'username' => $user
                        ];
                        $dataLama = $this->db->where('id_konten', $id)->get('konten')->row();
                        if ($dataLama->foto == file_exists('./assets/upload/' . $dataLama->foto)) {
                            unlink('./assets/upload/' . $dataLama->foto);
                        }
                        $listenerKategori->saatEdit($dataKonten, $idKategoriSebelumnya);
                        $this->db->where('id_konten', $id)->update('konten', $dataKonten);
                        $this->session->set_flashdata('success', 'Data konten baru telah berhasil diupdate.');
                        redirect('konten');
                    }
                }
            }
        }
    }

    public function ambil_data_keterangan($id)
    {
        $query = $this->db->where('id_konten', $id)->get('konten')->row();
        echo json_encode($query);
    }
}
