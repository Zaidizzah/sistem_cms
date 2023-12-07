<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Umum extends CI_Model{

    public function nama_kategori($id_kategori)
    {
        $query = $this->db->select('nama_kategori')->from('kategori')->where('id_kategori', $id_kategori)->get()->row()->nama_kategori;
        return $query;
    }

    public function judul_website()
    {
        $query = $this->db->select('judul_website')->from('konfigurasi')->where('id_konfigurasi', 1)->get()->row()->judul_website;
        return $query;
    }

    public function komentar_konten($id_konten)
    {
        $query = $this->db->where('id_konten', $id_konten)->get('komentar')->result();
        
        if ($query != null):
        $query = count($query);
        endif;

        return $query;
    }
}