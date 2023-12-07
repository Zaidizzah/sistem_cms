<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function load_template($content_view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('module_website/header', $data);
    $CI->load->view($content_view, $data);
    $CI->load->view('module_website/footer', $data);
}

function load_template_frontend($content_view, $data = array())
{
    $CI = &get_instance();
    $CI->load->view('module_website/header_frontend', $data);
    $CI->load->view($content_view, $data);
    $CI->load->view('module_website/footer_frontend', $data);
}
?>  
