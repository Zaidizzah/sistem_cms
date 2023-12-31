<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['full_tag_open'] = '<div class="row">
                            <div class="col-lg-12">
                            <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">';
$config['full_tag_close'] = '</ul>
                            </nav>
                            </div>
                            </div>';

$config['first_link'] = 'Terawal';
$config['first_tag_open'] = '<li class="page-item">';
$config['first_tag_close'] = '</li>';

$config['last_link'] = 'Terakhir';
$config['last_tag_open'] = '<li class="page-item">';
$config['last_tag_close'] = '</li>';

$config['next_link'] = '&raquo';
$config['next_tag_open'] = '<li class="page-item">';
$config['next_tag_close'] = '</li>';

$config['prev_link'] = '&laquo';
$config['prev_tag_open'] = '<li class="page-item">';
$config['prev_tag_close'] = '</li>';

$config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
$config['cur_tag_close'] = '</a></li>';

$config['num_tag_open'] = '<li class="page-item">';
$config['num_tag_close'] = '</li>';

$config['attributes'] = array('class' => 'page-link');