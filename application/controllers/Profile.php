<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Profile extends CI_Controller {

    public function index($username = '')
    {
        if (!$this->session->userdata('login')){
            redirect('login');
        }

        if ($username == ''){
            $data['profile_valid_user'] = false;
            load_template('backend/profile', $data);
        } else {
            $data['profile_valid_user'] = true;
            $data['profile'] = $this->db->get_where('user', ['username' => $username])->row();
            load_template('backend/profile', $data);
        }
    }
}