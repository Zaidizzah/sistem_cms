<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
	<?php if ($this->uri->segment(2) != 'tentang') :?>
		<?php if ($this->uri->segment(2) != 'kontak') :?>
			<?php if ($this->uri->segment(2) != 'galeri_index') :?>
				
			<!-- Start Blog Post Siddebar -->
			<div class="col-lg-4 sidebar-widgets" style="margin-bottom: 50px;">
				<div class="widget-wrap">
					<div class="single-sidebar-widget newsletter-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Cari Konten <i class="fa fa-search"></i></h4>
						<form id="form-pencarian" action="<?= site_url('beranda/cari_konten') ?>" method="post">
							<div class="form-group mt-30">
								<div class="col-autos">
								<p style="text-align: left;">Terdapat <strong><?= count($this->db->get('konten')->result()); ?></strong> Konten Keseluruhan.</p>
								<input type="text" class="form-control" id="inlineFormInputGroup" name="judul_konten" placeholder="Masukkan judul konten" onfocus="this.placeholder = ''"
									onblur="this.placeholder = 'Masukkan judul konten'" 
									value="<?php 
									if(isset($hasil_pencarian)){
										if($hasil_pencarian != null){$pecah = explode('yellow;">', $hasil_pencarian); $potong = explode('<', $pecah[1]); echo $potong[0];}
										} 
									?>">
								</div>
							</div>
							<button class="btn btn-default d-block mt-20 w-100" id="pencarian-btn" onclick="event.preventDefault();">Cari...</button>
						</form>
						<?php if ($this->uri->segment(1) == 'beranda' || $this->uri->segment(2) != '') :?>
							<a style="color: white;" class="btn btn-primary d-block mt-20 w-100 mt-2" href="<?= site_url('beranda') ?>">Kembali</a>
						<?php endif; ?>
					</div>


					<div class="single-sidebar-widget post-category-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Kategori</h4>
						<ul class="cat-list mt-20">
							<?php
							if (isset($kategori)) {
							foreach ($kategori as $ktgr) {
							?>
							<li>
								<a href="<?= site_url('Konten/artikel_kategori/kategori='.$ktgr->id_kategori.'?q=Kategori:'.ucfirst($ktgr->nama_kategori)) ?>" class="d-flex justify-content-between">
									<p><?= ucfirst($ktgr->nama_kategori) ?></p>
									<p>(<?= $ktgr->digunakan ?>)</p>
								</a>
							</li>
							<?php
								}
							}
							?>
						</ul>
					</div>

					<div class="single-sidebar-widget popular-post-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Postingan Populer</h4>
						<div class="popular-post-list">
							<?php if (isset($populer_post)):
								$no_ppost = 1;
								foreach($populer_post as $Ppost):	
							?>
								<div class="single-post-list" style="border-bottom: 1px solid black;">
									<div class="thumb">
									<a class="card-img rounded-0" href="<?= base_url('assets/upload/' . $Ppost->foto) ?>" data-lightbox="populer_post<?= $no_ppost++ ?>"><img class="card-img rounded-0" src="<?= base_url('assets/upload/'.$Ppost->foto) ?>" alt=""></a>
										<ul class="thumb-info">
											<li><a href="<?= site_url('Konten/artikel_pembuat/pengguna='.$Ppost->username.'?q='.ucfirst($Ppost->username)) ?>"><?= ucfirst($Ppost->username) ?></a></li>
											<li><a href="<?= site_url('Konten/artikel_tanggal/'.$Ppost->tanggal.'?q='.tanggal_indonesia($Ppost->tanggal)) ?>"><?= tanggal_indonesia($Ppost->tanggal) ?></a></li>
										</ul>
									</div>
									<div class="details mt-20">
										<a href="<?= site_url('Konten/artikel/'.$Ppost->id_konten.'?q='.$Ppost->slug) ?>">
											<h6><?= ucfirst($Ppost->judul) ?></h6>
										</a>
									</div>
								</div>
							<?php
								endforeach;
							endif;
							?>
						</div>
					</div>

					<div class="single-sidebar-widget post-category-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Arsip Postingan</h4>
						<ul class="cat-list mt-20">
						<?php
							$bulan = array(
								'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
								'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
							);

							$tahun = date('Y');
							for ($i = 0; $i <= (count($bulan) - 1); $i++){
								$data_arsip = $this->db->where('MONTH(tanggal)', $i + 1)->where('YEAR(tanggal)', $tahun)->get('konten')->num_rows();
								echo '<li><a href="'.site_url('Konten/artikel_tanggal/'.$tahun.'-'.($i +1)).'?q='.$tahun.'&bulan='.$bulan[$i].'" class="d-flex justify-content-between"><span><i class="fa fa-folder"></i> ('.$data_arsip.' Post)</span> '.$bulan[$i].' '.$tahun.'</li>';
							}
							?>
						</ul>
					</div>
					<?php
						$authors = $this->db->select('username')->from('user')->limit(10)->order_by('username', 'RANDOM')->get()->result();
						if ($authors != null) :
					?>

					<div class="single-sidebar-widget post-category-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Profil Kreator</h4>
						<ul class="cat-list mt-20">
							<?php

							foreach ($authors as $author) {
								$authorName = $author->username;

								$articleCount = $this->db->where('username', $authorName)->count_all_results('konten');
								?>
								<li>
									<a href="<?= site_url('Konten/artikel_pembuat/pengguna='.$authorName.'?q='.ucfirst($authorName)) ?>" class="d-flex justify-content-between">
										<span><?= ucfirst($authorName) ?></span>
										<span><?= $articleCount ?> Artikel</span>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
					<?php
						endif;
					?>
					
					<div class="single-sidebar-widget popular-post-widget" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.1);">
						<h4 class="single-sidebar-widget__title">Postingan Sebelumnya</h4>
						<div class="popular-post-list owl-carousel owl-theme blog-slider-lastest-content">
						<?php
						if (isset($lastest_post)){
							$no_last_post = 1;
							foreach ($lastest_post as $lp):
						?>
						<div class="single-post-list" style="padding: 5px;">
							<div class="thumb" style="border-radius: 8px;">
							<img class="card-img" height="265px" style='border-radius: 50%; border: 3px solid black;' src="<?= base_url('assets/upload/'.$lp->foto) ?>" alt="">
							<ul class="thumb-info" style="box-shadow: 0 0 7px rgba(0, 0, 0, 0.2);">
								<li><a href="<?= site_url('Konten/artikel_pembuat/pengguna='.$lp->username.'?q='.ucfirst($lp->username)) ?>"><?= $lp->username ?></a></li>
								<li><a href="<?= site_url('Konten/artikel_tanggal/'.$lp->tanggal.'?q='.tanggal_indonesia($lp->tanggal)) ?>"><?= tanggal_indonesia($lp->tanggal) ?></a></li>
							</ul>
							</div>
							<div class="details mt-20">
							<a href="<?= site_url('Konten/artikel/'.$lp->id_konten.'?q='.$lp->slug) ?>">
								<h6><?= $lp->judul ?></h6>
							</a>
							</div>
						</div>
						<?php
							endforeach;
							}
						?>
						</div>
					</div>
				
				</div>
			</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endif; ?>
		</div>
		<!-- End Blog Post Siddebar -->
	</div>
</section>
	<!--================ End Blog Post Area =================-->
</main>
<a id="back-to-top" href="#"><i class="fa fa-arrow-up"></i></a>
<!--================ Start Footer Area =================-->
<?php
	$query = $this->db->where('id_konfigurasi', 1)->get('konfigurasi')->row();
	if ($query->no_wa != null){
		$no_wa = preg_replace('/^0/', '62', $query->no_wa);
	} else {
		$no_wa = '';
	}

	$kategori_footer = $this->db->limit(7)->get('kategori')->result();
?>
<footer class="footer-area section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="single-footer-widget mb-2">
					<h6><?= ucfirst($query->judul_website) ?></h6>
					<p>
						<strong>Kunjungi Kami di, </strong>
					</p>
					<div class="footer-social d-flex align-items-center">
						<a href="https://www.instagram.com/<?= $query->facebook ?>" style="justify-content: flex-start;">
							<i class="fab fa-facebook-f fa-2x"></i>
						</a>
						<a href="https://www.instagram.com/<?= $query->instagram ?>">
							<i class="fab fa-instagram fa-2x"></i>
						</a>
						<a href="https://wa.me/<?= $no_wa ?>?text=Halo,%20salam%20kenal">
							<i class="fab fa-whatsapp fa-2x"></i>
						</a>
						<a href="mailto:<?= $query->email ?>">
							<i class="fa fa-envelope fa-2x"></i>
						</a>
						<a href="https://www.linkedin.com/in/zaid-izzah-nurbaain-42330b242/">
							<i class="fab fa-linkedin fa-2x"></i>
						</a>
					</div>
					<p style="padding-top: 25px;"><?= ucfirst($query->alamat) ?></p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6" style="padding-left: 20px;">
				<div class="single-footer-widget">
					<h6>Tautan Cepat</h6>
					<div class="footer-social">
						<a href="#" style="color: whitesmoke;">
							<i class="fa fa-chevron-right"></i> Beranda
						</a><br>
						<a href="#" style="color: whitesmoke;">
							<i class="fa fa-chevron-right"></i> Kontak
						</a><br>
						<a href="#" style="color: whitesmoke;">
							<i class="fa fa-chevron-right"></i> Tentang
						</a><br>
						<a href="#" style="color: whitesmoke;">
							<i class="fa fa-chevron-right"></i> Galeri
						</a><br>
						<a href="#" onclick="event.preventDefault()" style="color: whitesmoke;" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-chevron-right"></i> Kategori
						</a>
						<ul class="dropdown-menu" style="background-color: #000; padding-top: 0;">
							<?php
							foreach ($kategori_footer as $ktrfoo){
								echo '<li style="background-color: #4a4e69;"><a href="'.site_url('Konten/artikel_kategori/kategori='.$ktrfoo->id_kategori.'?q='.ucfirst($ktrfoo->nama_kategori).'').'" style="color: #fff; padding-left: 10px;">
										<i class="fa fa-chevron-right"></i> '.ucfirst($ktrfoo->nama_kategori).'
									</a></li>';
							}
							?>
						</ul>
					</div>
				</div>
			</div>
			<br>
			<div class="col-md-6 col-lg-4 col-sm-6" style="margin-top: 8px; padding-left: 20px;">
				<div class="single-footer-widget">
					<h6>Postingan Sebelunya</h6>
					<div class="footer-social">
						<?php
						if (isset($lastest_post)){
							foreach ($lastest_post as $lp){
						?>
							<a style="color: whitesmoke; margin-bottom: 3px;" href="<?= site_url('Konten/artikel/'.$lp->id_konten.'?q='.$lp->slug) ?>">
								<i class="fa fa-chevron-right"></i> <?php if(strlen($lp->judul) > 36) echo substr($lp->judul, 0, 36).' ...'; else echo $lp->judul ?>
							</a>
						<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<hr color="#DAD7CD">
		<div class="row">
			<div class="col-md-12 col-lg-12 col-sm-12">
				<div class="single-footer-widget">
					<h6 style="text-align: left;">Tentang Kami</h6>
					<p><?= ucfirst($query->profile_website) ?></p>
				</div>
			</div>
		</div>
		<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
			<p class="footer-text m-0">
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
				Copyright &copy;<script>
					document.write(new Date().getFullYear());

				</script> All rights reserved by Zaid izzah nurbaain | This template is made with <i class="fa fa-heart"
					aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
				<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
			</p>
		</div>
	</div>
</footer>
<!--================ End Footer Area =================-->

<script src="<?= base_url('assets/sensive-master/') ?>vendors/bootstrap/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/sensive-master/') ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?= base_url('assets/sensive-master/') ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?= base_url('assets/sensive-master/') ?>js/mail-script.js"></script>
<script src="<?= base_url('assets/sensive-master/') ?>js/main.js"></script>

<!-- Script area -->
<script>
	AOS.init();
	if ($('.blog-slider').length) {
		$('.blog-slider').owlCarousel({
			loop: true,
			margin: 2,
			items: 1,
			nav: true,
			autoplay: 3100,
			smartSpeed: 1750,
			dots: true,
			widhthAuto: true,
			responsiveClass: true,
			animateOut: 'fadeOut',
			animateIn: 'fadeIn',
			navText: [
				"<div class='blog-slider__leftArrow'><img src='<?= base_url('assets/sensive-master/') ?>img/home/left-arrow.png'></div>",
				"<div class='blog-slider__rightArrow'><img src='<?= base_url('assets/sensive-master/') ?>img/home/right-arrow.png'></div>"
			]
		})
	}

	if ($('.blog-slider-lastest-content').length) {
		$('.blog-slider-lastest-content').owlCarousel({
			loop: true,
			margin: 2,
			items: 1,
			autoplay: 3100,
			smartSpeed: 1750,
			widthAuto: true,
			dots: true,
			responsiveClass: true,
		})
	}

	$(document).ready(function() {
		// $('body').sticky();
		$(window).scroll(function() {
			if ($(this).scrollTop() > 100) {
				$('#back-to-top').fadeIn('slow');
			} else {
				$('#back-to-top').fadeOut('slow');
			}
		});

		$('#back-to-top').click(function() {
			$('html, body').animate({ scrollTop: 0 }, 800);
			return false;
		});
	});

	$('#pencarian-btn').on('click', function() {
		event.preventDefault();
		
		let nilai_pencarian = $('#form-pencarian').find('input[type="text"]').val();
		$('#form-pencarian').attr('action', '<?= site_url('beranda/cari_konten') ?>?q='+nilai_pencarian);
		$('#form-pencarian').submit();
	});

</script>
</body>

</html>
