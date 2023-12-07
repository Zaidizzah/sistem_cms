<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Beranda_konten extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }

    public function index($page = 0){
        // Paginasi halaman beranda
        $config['base_url'] = site_url('beranda');
        $config['total_rows'] = $this->db->count_all('konten');
        $config['per_page'] = 5;
        if ($page != 0){
            $offset = $page;
        } else {
            $offset = 0;
        }

        $hasil_bagi = ceil($config['total_rows'] / $config['per_page']);
        $config['prefix'] = 'Halaman-ke=';
        $config['suffix'] = '?=Dari-total:'.$hasil_bagi.'-halaman';
        $this->pagination->initialize($config);
        
        $data['halaman_ke'] = 'Ke <strong>'.$page.'</strong>';
        $data_beranda = $this->data_beranda();
        $data['konten'] = $this->ambil_data_konten($config['per_page'], $offset);
        $data['pagination'] = $this->pagination->create_links();

        $data = array_merge($data_beranda, $data);
        load_template_frontend('tampilan-frontend/beranda', $data);
    }
    
    private function ambil_data_konten($limit, $start){
        $data = $this->db->select('konten.*, kategori.nama_kategori')->from('konten')->join('kategori', 'konten.id_kategori = kategori.id_kategori')->limit($limit, $start)->order_by('id_konten', 'DESC')->get()->result();
        return $data;
    }

    private function ambil_data_konten_5_dari_terakhir(){
        $data = $this->db->order_by('tanggal', 'desc')->limit(5)->get('konten')->result();
        return $data;
    }

    public function artikel($id_konten){
        $data = $this->data_beranda();
        $data['artikel'] = $this->db->select('konten.*, kategori.nama_kategori')->from('konten')->join('kategori', 'konten.id_kategori = kategori.id_kategori')->where('konten.id_konten', $id_konten)->get()->row();
        $data['komentar'] = $this->db->where('id_konten', $id_konten)->from('komentar')->get()->result();
        $data['konten'] = 'artikel';
        $data['captcha'] = $this->db->order_by('RAND()')->limit(1)->get('captcha')->row();

        load_template_frontend('tampilan-frontend/artikel', $data);
    }

    public function artikel_berdasarkan_kategori($id_kategori, $page = 0){
        $config['base_url'] = site_url('Konten/artikel_kategori/kategori='.$id_kategori);
        $config['total_rows'] = $this->db->where('id_kategori', $id_kategori)->count_all('konten');
        $config['per_page'] = 4;
        if ($page != 0){
            $offset = ($page - 1) * $config['per_page'];
        } else {
            $offset = 0;
        }
        // var_dump($config['per_page'], $offset, $page, $config['total_rows']);
        $nama_kategori = $this->db->where('id_kategori', $id_kategori)->get('kategori')->row()->nama_kategori;

        $config['prefix'] = 'Halaman-ke=';
        $config['suffix'] = '?Dengan_Kategori='.$nama_kategori.'';

        $this->pagination->initialize($config);
        $data['halaman_ke'] = 'Ke <strong>'.$page.'</strong>';
        $data['pagination'] = $this->pagination->create_links();
        $data['kategori_pencarian'] = '<h1>Pencarian Kategori: <span style="background-color: yellow;">'.ucfirst($this->db->where('id_kategori', $id_kategori)->get('kategori')->row()->nama_kategori).'<span></h1>';
        $data['data_pencarian_kategori'] = $this->db->where('id_kategori', $id_kategori)->get('kategori')->row()->nama_kategori;
        // var_dump($page);die;

        $data_beranda = $this->data_beranda();
        $data['konten'] = $this->db->from('konten')->where('id_kategori', $id_kategori)->order_by('tanggal', 'desc')->limit($config['per_page'], $offset)->get()->result();
        $data = array_merge($data_beranda, $data);
        load_template_frontend('tampilan-frontend/beranda', $data);
    }    

    private function data_beranda() {
        $data['populer_post'] = $this->db
            ->select('konten.*, COUNT(komentar.id_komentar) AS jumlah_komentar')
            ->from('konten')
            ->join('komentar', 'konten.id_konten = komentar.id_konten', 'left')
            ->group_by('konten.id_konten')
            ->order_by('jumlah_komentar', 'DESC')
            ->limit(3)
            ->get()
            ->result();
    
        $data['carousel'] = $this->db->get('caraousel')->result();
        $data['lastest_post'] = $this->ambil_data_konten_5_dari_terakhir();
        $data['kategori'] = $this->db->get('kategori')->result();
    
        return $data;
    }    

    public function cari_konten(){
        if ($this->input->post('judul_konten') == '' || $this->input->post('judul_konten') == null){
            $judul_konten = $this->session->userdata('data_pencarian');
        } else {
            $judul_konten = trim($this->input->post('judul_konten'));
        }
        $judul_konten = strtolower($judul_konten);

        $config['base_url'] = site_url('beranda/cari_konten');
        $config['total_rows'] = count($this->db->like('judul', $judul_konten)->from('konten')->get()->result());
        $config['per_page'] = 4;
        $config['prefix'] = 'Halaman-ke=';
        $config['suffix'] = '?pencarian='.$judul_konten.'';
        $this->pagination->initialize($config);

        // var_dump($this->uri->segment(3));
        if ($this->uri->segment(3) == null){
            $uri_db = 0;
        } else {
            if (strstr($this->uri->segment(3), 'Halaman-ke=')){
                $uri_db = explode('Halaman-ke=', $this->uri->segment(3));
                $uri_db = $uri_db[1];
            }
        }
        // var_dump($config['total_rows'], 'Judul konten: '.$judul_konten, $uri_db, $this->uri->segment(3));
        $data['konten'] = $this->db
                        ->like('LOWER(judul)', $judul_konten)
                        ->from('konten')
                        ->select('konten.*, kategori.nama_kategori')
                        ->join('kategori', 'konten.id_kategori = kategori.id_kategori')
                        ->order_by('tanggal', 'DESC')
                        ->limit($config['per_page'], $uri_db)
                        ->get()
                        ->result();
                        
        if ($this->input->post('judul_konten') != null || empty($this->session->userdata('data_pencarian'))){
            $this->session->set_userdata('data_pencarian', $this->input->post('judul_konten'));
        }
        $data_pencarian = $this->data_data_pencarian($judul_konten);

        $data['halaman_ke'] = 'Ke <strong>'.$this->uri->segment(3).'</strong>';
        $data_beranda = $this->data_beranda();
        $data['pagination'] = $this->pagination->create_links();
        $data = array_merge($data_beranda, $data, $data_pencarian);
        load_template_frontend('tampilan-frontend/beranda', $data);
    }

    private function data_data_pencarian($JKonten)
    {
        $data['hasil_pencarian'] = '<h1>Hasil pencarian: <span style="background-color: yellow;">'.$JKonten.'<span></h1>';
        $data['data_pencarian'] = $JKonten;

        return $data;
    }

    public function artikel_berdasarkan_pengguna($username, $page = 0)
    {
        $config['base_url'] = site_url('Konten/artikel_pembuat/pengguna='.$username);
        $config['total_rows'] = $this->db->where('username', $username)->count_all('konten');
        $config['per_page'] = 4;
        if ($page != 0){
            $offset = $page;
        } else {
            $offset = 0;
        }
        // var_dump($offset);
        $config['prefix'] = 'Halaman-ke=';
        $config['suffix'] = '?Dengan_konten_pengguna='.ucfirst($username).'';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // var_dump($page);die;

        $data['halaman_ke'] = 'Ke <strong>'.$page.'</strong>';
        $data_beranda = $this->data_beranda();
        $data['konten'] = $this->db->from('konten')->where('username', $username)->order_by('tanggal', 'desc')->limit($config['per_page'], $offset)->get()->result();
        $data = array_merge($data_beranda, $data);
        load_template_frontend('tampilan-frontend/beranda', $data);
    }

    public function artikel_berdasarkan_tanggal($tanggal, $page = 0)
    {
        if(strlen($tanggal) == 7){
            $jumlahKonten = count($this->db->like('tanggal', $tanggal, 'after')->get('konten')->result());
        } else {
            $jumlahKonten = count($this->db->where('tanggal', $tanggal)->get('konten')->result());
        }
        $config['base_url'] = site_url('Konten/artikel_tanggal/'.$tanggal);
        $config['total_rows'] = $jumlahKonten;
        $config['per_page'] = 4;
        if ($page != 0){
            $offset = $page;
        } else {
            $offset = 0;
        }
        // var_dump($config['total_rows'], $tanggal);
        $config['prefix'] = 'Halaman-ke=';
        $config['suffix'] = '?Dengan_konten_tanggal='.ucfirst($tanggal).'';

        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        // var_dump($page);die;

        $data['halaman_ke'] = 'Ke <strong>'.$page.'</strong>';
        $data_beranda = $this->data_beranda();
        if (strlen($tanggal) == 7) {
            $data['konten'] = $this->db->from('konten')->like('tanggal', $tanggal, 'after')->order_by('tanggal', 'desc')->limit($config['per_page'], $offset)->get()->result();
        }else{
            $data['konten'] = $this->db->from('konten')->where('tanggal', $tanggal)->order_by('tanggal', 'desc')->limit($config['per_page'], $offset)->get()->result();
        }
        $data = array_merge($data_beranda, $data);
        load_template_frontend('tampilan-frontend/beranda', $data);
    }


    //* End of file Beranda_Konten.php, Tepatnya untuk Konten

    public function beranda_tentang()
    {
        $data = $this->data_beranda();
        $data['konten'] = 'terisi';
        load_template_frontend('tampilan-frontend/tentang', $data);
    }
    
    public function beranda_kontak()
    {
        $data = $this->data_beranda();
        $data['konten'] = 'terisi';
        load_template_frontend('tampilan-frontend/kontak', $data);
    }

    public function captcha_refresh()
    {
        $data = $this->db->order_by('RAND()')->limit(1)->get('captcha')->row();
        echo json_encode($data);
    }
}