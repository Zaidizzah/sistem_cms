<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'frontend_beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard'] = 'dashboard';
$route['user'] = 'user';
$route['beranda'] = 'frontend/beranda_konten/index';
$route['beranda/Halaman-ke=(:num)'] = 'frontend/beranda_konten/index/$1';
$route['Konten/artikel/(:any)'] = 'frontend/beranda_konten/artikel/$1';
// Konten berdasarkan Pengguna
$route['Konten/artikel_pembuat/pengguna=(:any)'] = 'frontend/beranda_konten/artikel_berdasarkan_pengguna/$1';
$route['Konten/artikel_pembuat/pengguna=(:any)/Halaman-ke=(:num)'] = 'frontend/beranda_konten/artikel_berdasarkan_pengguna/$1/$2';
// Konten berdasarkan tanggal
$route['Konten/artikel_tanggal/(:any)'] = 'frontend/beranda_konten/artikel_berdasarkan_tanggal/$1';
$route['Konten/artikel_tanggal/(:any)/Halaman-ke=(:num)'] = 'frontend/beranda_konten/artikel_berdasarkan_tanggal/$1/$2';
// Konten berdasarkan Kategori
$route['Konten/artikel_kategori/kategori=(:num)'] = 'frontend/beranda_konten/artikel_berdasarkan_kategori/$1';
$route['Konten/artikel_kategori/kategori=(:num)/Halaman-ke=(:num)'] = 'frontend/beranda_konten/artikel_berdasarkan_kategori/$1/$2';
// Komentar dan pencarian
$route['beranda/cari_konten/Halaman-ke=(:num)'] = 'frontend/beranda_konten/cari_konten/$1';
$route['Artikel/tambah_komentar/'] = 'frontend/Komentar/tambah_komentar';
$route['beranda/cari_konten'] = 'frontend/beranda_konten/cari_konten';

$route['dashboard/profile?username=(:any)'] = 'profile/index/$1';

//* End Konten beranda, pembahasan fitur tentang dan kontak, saran
$route['beranda/tentang'] = 'frontend/beranda_konten/beranda_tentang';
$route['beranda/kontak'] = 'frontend/beranda_konten/beranda_kontak';
$route['kontak/saran'] = 'saran/beranda_kontak_saran';
$route['email/send_email'] = 'saran/send_email';
$route['galeri/index'] = 'galeri';
$route['komentar'] = 'frontend/komentar';
$route['beranda/galeri_index'] = 'galeri/galeri_index';
