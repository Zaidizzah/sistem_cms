<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ListenerKategori {

    private $ci;

    public function __construct($ci) {
        $this->ci = $ci;
    }
    public function saatTambah($data)
    {
        $id_kategori_baru = $data['id_kategori'];
        
        $this->ci->db->where('id_kategori', $id_kategori_baru)
                ->set('digunakan', 'digunakan + 1', FALSE)
                ->update('kategori');
    }

    public function saatEdit($data, $id_kategori_sebelumnya)
    {
        $id_kategori_sekarang = $data['id_kategori'];
        $dataKategori = $this->ci->db->where('id_kategori', $id_kategori_sebelumnya)->get('kategori')->row();

        if ($id_kategori_sebelumnya !== $id_kategori_sekarang) {
            $this->ci->db->where('id_kategori', $id_kategori_sebelumnya)
            ->set('digunakan', 'digunakan - 1', FALSE)
            ->update('kategori');

            $this->ci->db->where('id_kategori', $id_kategori_sekarang)
            ->set('digunakan', 'digunakan + 1', FALSE)
            ->update('kategori');
        } else if ($id_kategori_sebelumnya === $id_kategori_sekarang){
            // tidak ada yang dilakukan   
        }
    }

    public function saatHapus($id){
        $this->ci->db->where('id_kategori', $id)
        ->set('digunakan', 'digunakan - 1', FALSE)
        ->update('kategori');
    }
}
