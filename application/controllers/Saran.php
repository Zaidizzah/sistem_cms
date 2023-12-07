<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends CI_Controller{

    public function __construct()
    {
        parent::__construct();   
        if (!$this->session->userdata('login')) {
            redirect('login');
        }
    }

    public function index()
    {
        $data['saran'] = $this->db->get('saran')->result();
        $data['content'] = 'backend/saran'; 
        load_template($data['content'], $data);
    }

    public function beranda_kontak_saran()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('saran', 'Saran', 'trim|required');
        $this->form_validation->set_rules('captcha', 'Captcha', 'trim|required');

        if ($this->form_validation->run() == false){
            $this->session->set_flashdata('error', 'Maaf, Saran anda tidak dapat ditambahkan pastikan tidak ada bidang yang kosong atau tunggu beberapa saat lagi.');
            redirect(site_url('beranda/kontak'));
        } else {
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $saran = $this->input->post('saran');

            $captcha_pengg = $this->input->post('captcha');
            $jawaban_captcha = $this->input->post('jawaban_captcha');

            if ($captcha_pengg != $jawaban_captcha) {
                $this->session->set_flashdata('error', 'Maaf, Captcha anda tidak sesuai');
                redirect(site_url('beranda/kontak'));
            } else{
                $tanggal = date('Y-m-d');
    
                $data_saran = array(
                    'nama' => $nama,
                    'email' => $email,
                    'saran' => $saran,
                    'tanggal' => $tanggal
                );
    
                $this->db->insert('saran', $data_saran);
                $this->session->set_flashdata('success', 'Saran anda berhasil ditambahkan :)');
                redirect(site_url('beranda/kontak'));
            }
        }
    }

    public function send_email() {
        $this->form_validation->set_rules('kepada', 'Kepada', 'trim|required');
        $this->form_validation->set_rules('subjek', 'Subjek', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required');

        $to = $this->input->post('kepada');
        $kepada = explode(': ', $to);

        if ($this->form_validation->run() == false){
            $this->session->set_flashdata('error', 'Maaf, Email balasan gagal dikirim untuk '.$kepada[0].' ('.$kepada[1].')');
            redirect('saran');
        } else {
            $this->load->library('email');

            $subject = $this->input->post('subjek');
            $message = $this->input->post('keterangan');

            $dari = $this->db->get('konfigurasi')->row()->email;
            $this->email->from($dari, ucfirst($this->session->userdata('username')));

            $this->email->to($kepada[1]);
            $this->email->subject($subject);
            $this->email->message($message);

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'Berhasil, Email balasan gagal dikirim untuk '.$kepada[0].' ('.$kepada[1].')');
                redirect('saran');
            } else {
                $this->session->set_flashdata('error', 'Maaf, Email balasan gagal dikirim untuk '.$kepada[0].' ('.$kepada[1].')');
                redirect('saran');
            }
        }
    }

    public function hapusSaran($id)
    {
        $dataSaran = $this->db->where('id_saran', $id)->get('saran')->row();
        $this->db->where('id_saran', $id)->delete('saran');
        $this->session->set_flashdata('success', 'Berhasil, Data saran dari pengguna '.ucfirst($dataSaran->nama).' ('.$dataSaran->email.'), berhasil di hapus.');
        redirect('saran');
    }
}