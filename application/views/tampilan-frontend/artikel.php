<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
				<?php if ($this->session->flashdata('error')): ?>
					<script>
						Swal.fire(
							'Gagal!',
							'<?= $this->session->flashdata('error'); ?>',
							'error'
						)
					</script>
				<?php endif; ?>
				<?php if ($this->session->flashdata('success')): ?>
					<script>
						Swal.fire(
							'Berhasil!',
							'<?= $this->session->flashdata('success'); ?>',
							'success'
						)
					</script>
				<?php endif; ?>
				<div class="sessi-valid" data-sessi="<?= $this->session->userdata('login'); ?>"></div>
				<div class="col-lg-8">
					<div class="main_blog_details" style="background-color: #f0f0f0; padding: 25px; border-top-right-radius: 5px; border-top-left-radius: 5px;">
						<a style="border-radius: 8px; box-shadow: 0 0 18px rgba(0, 0, 0, 0.5);" class="img-thumbnail rounded-0" href="<?= base_url('assets/upload/'.$artikel->foto) ?>" data-lightbox="gallery"><img class="img-thumbnail rounded-0" src="<?= base_url('assets/upload/'.$artikel->foto) ?>" alt=""></a>
						<h4 style="text-transform: capitalize;"><?= $artikel->judul ?></h4>
						<div class="user_details">
							<div class="float-left">
								<a href="<?php
								$nama_kategori_terkait = $this->db->select('nama_kategori')->where('id_kategori', $artikel->id_kategori)->get('kategori')->row();
								echo site_url('Konten/artikel_kategori/kategori='.$artikel->id_kategori.'?q='.ucfirst($nama_kategori_terkait->nama_kategori)) ?>"><?= $nama_kategori_terkait->nama_kategori ?></a>
							</div>
							<div class="float-right mt-sm-0 mt-3">
								<div class="media">
									<div class="media-body">	
										<a href="<?= site_url('Konten/artikel_pembuat/pengguna='.$artikel->username.'?q='.ucfirst($artikel->username)) ?>">
											<h5><?= ucfirst($artikel->username) ?></h5>
										</a><br>
										<a href="<?= site_url('Konten/artikel_tanggal/'.$artikel->tanggal.'?q='.tanggal_indonesia($artikel->tanggal)) ?>">
											<p><?= tanggal_indonesia($artikel->tanggal) ?></p>
										</a>
										<p><strong>Diupload:</strong> <?= waktu_berlalu($artikel->tanggal) ?></p>
									</div>
									<div class="d-flex">
										<img width="42" height="42" class="rounded" src="<?= base_url('assets/sensive-master/') ?>img/blog/user-img.png" alt="">
									</div>
								</div>
							</div>
						</div>
						<hr>
						<p><?= $artikel->keterangan ?></p>
						<div class="news_d_footer flex-column flex-sm-row">
							<a href="<?= base_url('beranda') ?>"><button class="btn btn-default button"><i class="fa fa-angle-left"></i> Kembali ke Beranda</button></a>
							<a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#comments-area" style="scroll-behavior: smooth;"><span
									class="align-middle mr-2"><i class="ti-themify-favicon"></i></span><?php if (isset($komentar)){if(count($komentar) > 0){echo count($komentar).' Komentar';}else{echo '0 Komentar';}}else{echo '0 Komentar';} ?></a>
							<div class="news_socail ml-sm-auto mt-sm-0 mt-2">
								<a href="#"><i class="fab fa-facebook-f"></i></a>
								<a href="#"><i class="fab fa-twitter"></i></a>
								<a href="#"><i class="fab fa-instagram"></i></a>
								<a href="#"><i class="fab fa-behance"></i></a>
							</div>
						</div>
					</div>


					<div class="navigation-area" style="background-color: #f0f0f0; padding: 25px;">
						<div class="row">
							<?php 
								$this->db->from('konten')->where('username', $artikel->username)->where('id_konten <', $artikel->id_konten)->order_by('id_konten', 'desc')->limit(1);
								$dataKonten_sebelumnya = $this->db->get()->row();
			
								if (isset($dataKonten_sebelumnya)){
							?>
							<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
								<div class="thumb">
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_sebelumnya->id_konten.'?q='.$dataKonten_sebelumnya->slug) ?>">
										<img class="img-fluid" width="60px" height="60px" src="<?= base_url('assets/upload/'.$dataKonten_sebelumnya->foto) ?>" alt="">
									</a>
								</div>
								<div class="arrow">
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_sebelumnya->id_konten.'?q='.$dataKonten_sebelumnya->slug) ?>">
										<span class="lnr text-white lnr-arrow-left"></span>
									</a>
								</div>
								<div class="detials">
									<p>Postingan sebelumnya</p>
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_sebelumnya->id_konten.'?q='.$dataKonten_sebelumnya->slug) ?>">
										<h4><?= $dataKonten_sebelumnya->judul ?></h4>
									</a>
								</div>
							</div>
							<?php } else { ?>
								<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center"></div>
							<?php } ?>
							<?php 
								$this->db->from('konten')->where('username', $artikel->username)->where('id_konten >', $artikel->id_konten)->order_by('id_konten', 'asc')->limit(1);
								$dataKonten_setelahnya = $this->db->get()->row();
								
								if (isset($dataKonten_setelahnya)){
							?>
							<div
								class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
								<div class="detials">
									<p>Postingan Selanjutnya</p>
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_setelahnya->id_konten.'?q='.$dataKonten_setelahnya->slug) ?>">
										<h4><?= $dataKonten_setelahnya->judul ?></h4>
									</a>
								</div>
								<div class="arrow">
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_setelahnya->id_konten.'?q='.$dataKonten_setelahnya->slug) ?>">
										<span class="lnr text-white lnr-arrow-right"></span>
									</a>
								</div>
								<div class="thumb">
									<a href="<?= site_url('Konten/artikel/'.$dataKonten_setelahnya->id_konten.'?q='.$dataKonten_setelahnya->slug) ?>">
										<img class="img-fluid" width="60px" height="60px" src="<?= base_url('assets/upload/'.$dataKonten_setelahnya->foto) ?>" alt="">
									</a>
								</div>
							</div>
							<?php } else { ?>
								<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center"></div>
							<?php } ?>
						</div>
					</div>
					<div class="comments-area" id="comments-area" style="background-color: #f0f0f0; padding: 25px; margin-bottom: 15px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;">
						<h4><?php if (isset($komentar)){if(count($komentar) > 0){echo count($komentar).' Komentar';}else{echo '0 Komentar';}}else{echo '0 Komentar';} ?></h4>
						<?php if (isset($komentar) && is_array($komentar)):
							function tampilkanKomentar($komentar, $parent_id = 0, $level = 0) {
								foreach ($komentar as $cmn):
									$padding = 0;
									if ($cmn->parent_id > 0 && $level < 3) {
										if ($level == 2){
											$padding = 15 + (1 * 30);
										} else if ($level > 2) {
											$padding = 15 + (1 * 30);
										}else{
											$padding = 15 + (1 * 30);
										}
									} else if ($level > 2) {
										$padding = 15 + (1 * 30);
									}

									if ($cmn->parent_id == $parent_id) {
									?>

									<div class="comment-list" style="padding: 0 0 40px <?php echo $padding; ?>px;">
										<div class="single-comment justify-content-between d-flex">
											<div class="user justify-content-between d-flex">
												<div class="thumb">
													<?php $gambar = [
														['gambar' => 'user.webp'],
														['gambar' => 'user1.png'],
													];
													$gambar_foto = $gambar[array_rand($gambar)];
													?>
													<img src="<?= base_url('assets/upload/'.$gambar_foto['gambar']) ?>" width="60" height="60" alt="">
												</div>
												<div class="desc">
													<h5><a href="#"><?= $cmn->nama_pengguna ?></a></h5>
													<p class="date" style="margin-bottom: 0; text-transform: none;"><?= tanggal_indonesia($cmn->waktu)	 ?></p>
													<p>
														<?php if($cmn->membalas != null){echo '<span style="color: #7678ed;">Membalas : @'.$cmn->membalas.',</span> ';} ?>
														<?php if ($cmn->blocked == 1){echo '<span style="color: red;"><i class="fa fa-ban"></i> Blocked, Komentar ini mungkin berisi ungkapan sara atau hal-hal negatif lainnya</span> ';} 
															else { echo ucfirst($cmn->keterangan);} ?>
													</p>
												</div>
											</div>
											<div class="reply-btn">
												<?php $namaPengguna = $cmn->nama_pengguna; ?>
												<button class="btn-reply text-uppercase membalas" 
													data-balasan="<?php 
													if (strpos($namaPengguna, '<i') !== false) {
														$pecahString = explode(' ', $namaPengguna, 2);
														echo $pecahString[0];
													} else {
														echo $cmn->nama_pengguna;
													}
													?>"
													data-pengguna="<?= $cmn->id_komentar ?>">Balas</button>
											</div>
										</div>
									</div>
									<?php 
									tampilkanKomentar($komentar, $cmn->id_komentar, $level + 1);
									}
								endforeach;
							}
							tampilkanKomentar($komentar);
						endif;
						?>
					</div>

					<div class="comment-form" style="background-color: #f0f0f0; padding: 15px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); border-radius: 5px; margin-bottom: 0 auto;">
						<h4>Tinggalkan Balasan Kamu, :)</h4>
						<form id="komentar_baru" action="<?= base_url('frontend/Komentar/tambah_komentar') ?>" method="post">
							<div class="form-group form-inline" id="tertuju">
								<div class="form-group col-lg-6 col-md-6 name">
									<input type="text" style="text-transform: none;" class="form-control" placeholder="Masukkan nama kamu"
										onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan nama kamu'" name="nama" required>
								</div>
								<div class="form-group col-lg-6 col-md-6 email">
									<input type="email" style="text-transform: none;" class="form-control"
										placeholder="Masukkan alamat email kamu" onfocus="this.placeholder = ''"
										onblur="this.placeholder = 'Masukkan alamat email kamu'" name="email" required>
								</div>
							</div>
							<div class="form-group">
								<input type="text" style="text-transform: capitalize;" class="form-control" value="Subject: <?= $artikel->judul ?>" readonly>
								<input type="hidden" style="text-transform: capitalize;" class="form-control" name="id_konten" value="<?= $artikel->id_konten ?>" readonly>
								<input type="hidden" name="parent_id" id="parent_id" value="0">
							</div>
							<div class="form-group" id="balas" style="display: none;">
								<input type="text" name="subject" id="subject" style="text-transform: none;" class="form-control" value="" readonly>
							</div>
							<div class="form-group">
								<textarea class="form-control mb-10" style="text-transform: none;" rows="5" name="keterangan" placeholder="Masukkan pesan komentar kamu"
									onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan pesan komentar kamu'"
									required=""></textarea>
							</div>
							<hr>
							<div class="form-group">
								<label for="captcha">Captcha,</label><br>
								<span id="captchaImageContainer" style="border-radius: 4px;"><?php echo '<img style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;" src="'.base_url('assets/captcha/').$captcha->filename.'" alt="">' ?></span><button id="refreshCaptcha" class="btn btn-primary ml-2"><i class="fa fa-caret-down"></i></button><br>
								<span id="pesan-peringatan-captcha"></span>
								<br>
								<input type="text" class="form-control" style="text-transform: none;" name="captcha" placeholder="Isikan Jawaban Captcha" required>
								<input type="hidden" name="id_captcha" value="<?= $captcha->captcha_id ?>">
							</div>
							<p id="pesan_kesalahan"></p>
							<button type="submit" style="border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);" class="button submit_btn">Posting Komentar <i class="fa fa-comments"></i></button>
						</form>
					</div>
				</div>
	<script>
		lightbox.option({
			'resizeDuration': 200,
			'wrapAround': true
		})
		$(document).ready(function() {
			$('#captcha').on('input', function() {
				let jawabanUser = $('#captcha').val();
				let jawaban = $('#captcha').data('jawaban');
				$('#pesan_kesalahan').empty();
			
				if (jawabanUser == '') {
				$('#jawaban').val('Jawaban: ---').css({
					'border': 'none',
					'background-color': 'transparent',
					'color': 'black'
				});
				} else if (jawabanUser == jawaban) {
				$('#jawaban').val('Jawaban: Benar').css({
					'border': '2px solid black',
					'color': 'white',
					'border-radius': '3px',
					'background-color': 'lightgreen'
				});
				} else {
				$('#jawaban').val('Jawaban: Salah').css({
					'border': '2px solid black',
					'color': 'white',
					'border-radius': '3px',
					'background-color': 'red'
				});
				}
			});

			$('.membalas').click(function() {
				let membalas = $(this).data('balasan');
				let pengguna = $(this).data('pengguna');
				$('#subject').val('Membalas : @' + membalas);
				$('#parent_id').val(pengguna);
				$('#balas').fadeIn();
				console.log("hmmm");
				$('.comment-form').get(0).scrollIntoView({ behavior: 'smooth', block: 'end' });
			});

			setTimeout(function() {
				$('.alert').slideUp();
			}, 5500);

			function refreshCaptcha() {
				let path = '<?= base_url('assets/captcha/') ?>';
				$.ajax({
					url: '<?= base_url('frontend/beranda_konten/captcha_refresh') ?>',
					type: 'GET',
					dataType: 'json',
					success: function(data) {
						$('#pesan-peringatan-captcha').empty();
						$('#captchaImageContainer').html('<img style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px;" src="'+ path + data.filename + '" alt="">');
						$('[name="id_captcha"]').val(data.captcha_id);
					},
					error: function() {
						console.log('Terjadi kesalahan saat merefresh captcha.');
						$('#pesan-peringatan-captcha').empty();
						$('#pesan-peringatan-captcha').html('<p style="color: red;">Terjadi kesalahan saat merefresh captcha.</p>');
					}
				});
			}

			// Handler untuk tombol refresh
			$('#refreshCaptcha').on('click', function(e) {
				e.preventDefault();
				refreshCaptcha();
			});
		});
	</script>
