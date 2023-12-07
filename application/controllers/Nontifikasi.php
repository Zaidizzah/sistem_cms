<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nontifikasi {
    private $ci;

    public function __construct($ci) {
        $this->ci = $ci;
    }

    public function nontifikasiBaru($id_kategori, $jHapusKategori) {
        $dataKategori = $this->ci->db->where_in('id_kategori', $id_kategori)->get('kategori')->result();
        $dataDataKategori = '';

        if (count($dataKategori) > 0) {
            foreach ($dataKategori as $r) {
                $dataDataKategori .= '<li>'.$r->nama_kategori . ',</li> ';
            }
            $dataDataKategori = rtrim($dataDataKategori, ', ');
        }
        $Jpesan = 'Anda memiliki pesan baru.';
        $Ipesan = 'Admin telah Menghapus '.$jHapusKategori.' Kategori konten:<br>
        '.$dataDataKategori.'<br>
        , Harap cek konten yang Anda unggah apabila kemungkinan Konten Anda memakainya. Dan ganti dengan Kategori yang masih tersedia';
        $daftarPenerimaNotif = $this->ci->db->select('username')->from('konten')->where_in('id_kategori', $id_kategori)->get()->result();
        $melacak_penerima = array();

        foreach ($daftarPenerimaNotif as $data_pengguna) {
            $penerima = $data_pengguna->username;
            if (!in_array($penerima, $melacak_penerima)) {
                $data_notifikasi = array(
                    'penerima_pesan_nontifikasi' => $data_pengguna->username,
                    'Judul_pesan_nontifikasi' => $Jpesan,
                    'Isi_pesan_nontifikasi' => $Ipesan,
                    'dibuat_pada' => date('Y-m-d H:i:s'),
                );
            
                $this->ci->db->insert('nontifikasi', $data_notifikasi);
                $melacak_penerima[] = $penerima;
            }
        }
    }
}
