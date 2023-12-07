<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ($profile_valid_user == false){
    echo '<h1>Maaf, Halaman ini sedang terdapat masalah</h1>';
    echo '<p>Profile tidak ditemukan</p>';
} else {
    echo '<h1>Profile</h1>';
    echo '<p>Pesan: Maaf, untuk halaman ini sedang dalam tahap pengerjaan. Mohon tunggu dalam beberapa waktu kedepan.</p>';
}
?>