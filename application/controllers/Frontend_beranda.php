<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Frontend_beranda extends CI_Controller 
{
    public function __construct(){
        parent::__construct();
        // if ($this->session->userdata('login')) {
        //     redirect('Dashboard');
        // }
    }

    public function index(){
        redirect(site_url('beranda'));
    }

}