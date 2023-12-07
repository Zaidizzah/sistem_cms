<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>CMS (Content manajement System)</title>
	<link rel="icon" href="<?= base_url('assets/sensive-master/') ?>img/Fevicon.png" type="image/png">

	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/themify-icons/themify-icons.css">
	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/linericon/style.css">
	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/owl-carousel/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>vendors/owl-carousel/owl.carousel.min.css">

	<link rel="stylesheet" href="<?= base_url('assets/sensive-master/') ?>css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
	<script src="<?= base_url('assets/sensive-master/') ?>vendors/jquery/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<!-- leflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
	<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
	<style>
		body {
            font-family: Arial, sans-serif;	
            background-color: #00B4D8;
            margin: 0;
            padding: 0;
        }
		#back-to-top {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 20px;
			background: tomato;
			color: #fff;
			padding: 10px 15px;
			border-radius: 50px;
			text-align: center;
			font-size: 24px;
			transition: background 0.3s;
			z-index: 9999 !important;
			box-shadow: 0 0 27px rgba(0, 0, 0, 0.5); 
		}

		#back-to-top:hover {
			background: blue;
		}
		/* .thumb-info-head {
			display: flex;
			flex-direction: column;
			justify-content: center; 
			align-items: center;
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background: transparent;
		} */

		.img-carousel {
			object-fit: cover; 
			display: block; 
			max-height: 775px; 
			height: 775px;
			width: 100%;
			padding-right: 15px; 
			padding-left: 20px;
			padding-top: 15px;
		}

		.owl-item {
			position: relative;
			opacity: 0;
			transition: opacity 0.8s ease-in;
		}

		.owl-item.active {
			opacity: 1;
		}

		.txt-white{
			color: white;
		}

		@media only screen and (max-width: 500px) {
			.img-carousel {
				object-fit: cover;
				height: 540px;
				width: 100%;
			}

			.jdl_carousel {
				font-size: 1em;
			}
		}

	</style>
</head>

<body>
	<?php $uri_header = $this->uri->segment(1); ?>

	<!--================Header Menu Area =================-->
	<header class="header_area" style="background-color: rgba(0, 0, 0, 0.1); box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); margin-bottom: 20px; width: 100%;">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light" width="auto">
				<div class="container box_1620">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="<?= base_url('beranda') ?>" style="font-size: xx-large;color: white;"><strong><h1 style="color: whitesmoke; text-shadow: 0 0 25px rgba(0, 0, 0, 0.2): "><?= $this->Umum->judul_website(); ?></h1></strong></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse"
						data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
						aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav justify-content-end">
							<li class="nav-item <?php if ($uri_header === 'beranda' && $this->uri->segment(2) === '' || $uri_header === 'Beranda' && $this->uri->segment(2) === ''){echo 'active';} ?>"><a class="nav-link" href="<?= base_url('beranda') ?>">Beranda</a>
							</li>
							<li class="nav-item <?php if ($this->uri->segment(2) === 'tentang' || $this->uri->segment(2) === 'Tentang'){echo 'active';} ?>"><a class="nav-link" href="<?= site_url('beranda/tentang') ?>">Tentang</a></li>
							<li class="nav-item <?php if ($this->uri->segment(2) === 'galeri_index'){echo 'active';} ?>"><a class="nav-link" href="<?= site_url('beranda/galeri_index') ?>">Galeri</a>
							<li class="nav-item <?php if ($this->uri->segment(2) === 'artikel_kategori' || $this->uri->segment(2) === 'Artikel_kategori'){echo 'active';} ?> submenu dropdown">
								<a href="javascript:void(0)" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
									aria-haspopup="true" aria-expanded="false">Kategori <i class="fa fa-caret-down"></i></a>
								<ul class="dropdown-menu">
									<?php 
									if (isset($kategori)):
										foreach ($kategori as $kt_header):
											$kategori_namaKategori_header = $this->db->where('id_kategori', $kt_header->id_kategori)->get('kategori')->row()->nama_kategori;
									?>
									<li class="nav-item"><a class="nav-link" href="<?= site_url('Konten/artikel_kategori/kategori='.$kt_header->id_kategori.'?=Kategori: '.ucfirst($kategori_namaKategori_header)) ?>"><?= ucfirst($kt_header->nama_kategori) ?></a></li>
									<?php
										endforeach;
									endif;
									?>
								</ul>
							</li>
							<li class="nav-item <?php if ($this->uri->segment(2) === 'kontak' || $this->uri->segment(2) === 'Kontak'){echo 'active';} ?>">
								<a class="nav-link" href="<?= site_url('beranda/kontak') ?>">Hubungi</a>
							</li>
							<li class="nav-item"><a class="nav-link" href="<?php if ($this->session->userdata('login')){echo base_url('Dashboard');}else{echo base_url('login');} ?>"><span style="color: red;">Login</span></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</header>
	<!--================Header Menu Area =================-->

	<main class="site-main">
		<?php if ($this->uri->segment(2) != 'tentang') : ?>
			<?php if ($this->uri->segment(2) != 'kontak') : ?>
				<?php if ($this->uri->segment(2) != 'galeri_index') : ?>
					<!--================Hero Banner start =================-->
					<section class="mb-30px" style="margin-top: 10px;">
						<div class="container" style="overflow: hidden; box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;">
							<div class="owl-carousel owl-theme blog-slider"
								style="background-color: #f0f0f0; margin-bottom: 5px; border-right: 5px solid #f0f0f0; box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;">
								<?php 
								if (isset($carousel)):
								foreach ($carousel as $crsl) : ?>
								<div class="blog__slide text-center">
									<div class="thumb">
										<div class="blog__slide__img">
											<img class="img-carousel"
												src="<?= base_url('assets/upload/'.$crsl->foto) ?>" alt="">
											<div class="thumb-info thumb-info-head blog__slide__content">
												<h1 class="jdl_carousel" style="color: rgba(0, 0, 0, 0.7);"><span style="border-bottom: 2.2px solid #fb8500;"><?= ucfirst($crsl->judul) ?></span></h1>
											</div>
										</div>
									</div>
								</div>
								<?php endforeach;
								else : ?>
									<div class="blog__slide text-center">
										<div class="thumb">
											<div class="blog__slide__img">
												<img class="img-carousel"
													src="<?= base_url('assets/img/348698772_811568947051079_1088458185248003489_n.jpg') ?>" alt="">
												<div class="thumb-info thumb-info-head blog__slide__content">
													<h1 class="jdl_carousel" style="color: rgba(0, 0, 0, 0.7);"><span style="border-bottom: 2.2px solid #fb8500;">The Flower of Nature</span></h1>
												</div>
											</div>
										</div>
									</div>
								<?php
								endif;
								?>
							</div>
						</div>
						</div>
					</section>
					<!--================Hero Banner end =================-->

					<!--================ Blog slider start =================-->
					<section>
						<div class="container">
							<hr>
						</div>
					</section>
					<!--================ Blog slider end =================-->
					<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>

		<!--================ Start Blog Post Area =================-->
		<section class="blog-post-area section-margin mt-4">
			<div class="container">
				<div class="row">
