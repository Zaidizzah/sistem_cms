<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Komentar extends CI_Controller {

    public function index()
    {
        if (!$this->session->userdata('login')){
            redirect('login');
        }
        $this->db->select('komentar.*, konten.id_konten, konten.username, konten.judul')
                ->join('konten', 'komentar.id_konten = konten.id_konten')
                ->order_by('id_komentar', 'desc');
        $data['komentar'] = $this->db->get('komentar')->result();
        load_template('backend/komentar', $data);
    }

    public function tambah_komentar()
    {
        $id_konten = $this->input->post('id_konten');
        $slug = $this->db->select('slug')->from('konten')->where('id_konten', $id_konten)->get()->row()->slug;

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');
        
        if ($this->form_validation->run() == false)
        {
            $this->session->set_flashdata('pesan', 'Maaf, Komentar anda gagal untuk ditambahkan, Cek kembali format komentar anda :)');
            redirect(site_url('Konten/artikel/'.$id_konten.'?q='.$slug));
        } else {
            $id_captcha = $this->input->post('id_captcha');
            $captcha_text = $this->input->post('captcha');

            $data_captcha = $this->db->where('captcha_id', $id_captcha)->get('captcha')->row();

            if ($captcha_text != $data_captcha->word) {
                $this->session->set_flashdata('error', 'Maaf, Captcha anda tidak sesuai');
                redirect(site_url('Konten/artikel/'.$id_konten.'?q='.$slug));
            }

            $string = $this->input->post('subject');
            $split = explode('@', $string);
            if (count($split) > 1) {
                $dibalas = $split[1];
            }

            $data = array(
                'id_konten' => $id_konten,
                'parent_id' => $this->input->post('parent_id', true),
                'nama_pengguna' => strip_tags($this->input->post('nama', true)) == '' ? 'Anonymous' : strip_tags($this->input->post('nama', true)),
                'email' => $this->input->post('email', true),
                'keterangan' => html_escape($this->input->post('keterangan', true)),
                'membalas' => $dibalas != '' ? $dibalas : '',
                'waktu' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('komentar', $data);
            $this->session->set_flashdata('pesan', 'Komentar kamu berhasil ter-upload, :>');
            redirect(site_url('Konten/artikel/'.$id_konten.'?q='.$slug));
        }
    }

    public function membalas_komentar()
    {
        $id_komentar = $this->input->post('id_komentar');
        $id_konten = $this->input->post('id_konten');
        $nama_pengguna = $this->input->post('membalas');
        $keterangan_komentar = html_escape($this->input->post('keterangan'));

        if ($id_komentar === null || $id_konten === null || $nama_pengguna === null || trim($keterangan_komentar) === null || trim($keterangan_komentar) === '') {
            $this->session->set_flashdata('error', 'Maaf, Komentar anda gagal untuk ditambahkan, Cek kembali format komentar anda :)');
            redirect('komentar');
        } else {
            $data_balasan = array(
                'id_konten' => $id_konten,
                'parent_id' => $id_komentar,
                'nama_pengguna' => ucfirst($this->session->userdata('username')).' <i class="fa fa-check"></i>',
                'keterangan' => $keterangan_komentar,
                'membalas' => $nama_pengguna,
                'waktu' => date('Y-m-d H:i:s'),
            );

            $this->db->insert('komentar', $data_balasan);
            $this->session->set_flashdata('success', 'Komentar kamu berhasil ter-upload, :>');
            redirect('komentar');
        }
    }

    public function hapus_komentar($id)
    {
        $data_nama_pengguna = $this->db->where('id_komentar', $id)->get('komentar')->row();

        $this->db->where('id_komentar', $id);
        $this->db->delete('komentar');
        $this->session->set_flashdata('success', 'Berhasil, komentar dengan pengguna: '.$data_nama_pengguna->nama_pengguna.' telah di hapus');
        redirect('komentar');
    }

    public function block_komentar($id)
    {
        $data = array(
            'blocked' => '1',
        );

        $data_nama_pengguna = $this->db->where('id_komentar', $id)->get('komentar')->row()->nama_pengguna;

        $this->db->where('id_komentar', $id);
        $this->db->update('komentar', $data);

        $this->session->set_flashdata('success', 'Berhasil, komentar dengan dengan pengguna: '.$data_nama_pengguna.' telah di block');
        redirect('komentar');
    }

    public function unblock_komentar($id)
    {
        $data = array(
            'blocked' => '0',
        );

        $data_nama_pengguna = $this->db->where('id_komentar', $id)->get('komentar')->row()->nama_pengguna;

        $this->db->where('id_komentar', $id);
        $this->db->update('komentar', $data);

        $this->session->set_flashdata('success', 'Berhasil, komentar dengan pengguna:  '.$data_nama_pengguna.' telah di unblock');
        redirect('komentar');
    }
}


