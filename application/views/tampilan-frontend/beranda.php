<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
          <div class="col-lg-8">
            <?php if (isset($hasil_pencarian)){echo $hasil_pencarian.'<hr>';} ?>
            <?php if (isset($kategori_pencarian)){echo $kategori_pencarian.'<hr>';} ?>
            <?php
              if (isset($konten)) {
                $no_post = 1;
                foreach ($konten as $ktn):
                  $data_komentar = $this->db->where('id_konten', $ktn->id_konten)->from('komentar')->get()->result();
                  $max_characters = 450; 

                  if (strlen($ktn->keterangan) > $max_characters) {
                      $ktn->keterangan = substr($ktn->keterangan, 0, $max_characters) . '  ......';
                  }

                  if (strlen($ktn->keterangan) < $max_characters){
                    $ktn->keterangan = $ktn->keterangan.'......';
                  }
            ?>
            <div class="single-recent-blog-post" style="box-shadow: 0 0 27px rgba(0, 0, 0, 0.5); background-color: #f0f0f0; margin-top: 0; margin-bottom: 20px;">
              <div class="thumb">
                
                <a class="card-img rounded-0" style="border: 1px solid rgba(0, 0, 0, 0.3); border-top-left-radius: 10px; border-top-right-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.3)" href="<?= base_url('assets/upload/'.$ktn->foto) ?>" data-lightbox="gallery_konten<?= $no_post++ ?>">
                  <img class="card-img img-konten rounded-0" style="border: 1px solid rgba(0, 0, 0, 0.3); object-fit: cover;" height="475px" src="<?= base_url('assets/upload/'.$ktn->foto) ?>" alt="">
                </a>

                <ul class="thumb-info">
                  <li><a href="<?= site_url('Konten/artikel_pembuat/pengguna='.$ktn->username.'?q='.ucfirst($ktn->username)) ?>">
                    <i class="ti-user"></i><?= ucfirst($ktn->username) ?></a>
                  </li>
                  <li><a href="<?= site_url('Konten/artikel_tanggal/'.$ktn->tanggal.'?q='.tanggal_indonesia($ktn->tanggal)) ?>">
                    <i class="ti-notepad"></i><?= tanggal_indonesia($ktn->tanggal) ?></a>
                  </li>
                  <li><a href="<?= site_url('Konten/artikel/'.$ktn->id_konten.'?q='.$ktn->slug) ?>"><i class="ti-themify-favicon"></i><?= count($data_komentar) ?> Comments</a></li>
                </ul>
              </div>
              <div class="details cat-list mt-20" style="margin-left: 15px; margin-right: 15px;">
                <a href="<?= site_url('Konten/artikel/'.$ktn->id_konten.'?q='.$ktn->slug) ?>">
                <?php 
                  if (isset($hasil_pencarian)) {
                    $judul = ucfirst($ktn->judul);
                    $data_pencarian_yang_ada = $data_pencarian != '' ? $data_pencarian : $this->session->userdata('data_pencarian');
                    $judul = str_replace($data_pencarian_yang_ada, '<span style="background-color: yellow;">' . $data_pencarian_yang_ada . '</span>', $judul);
                
                    echo '<h3>' . $judul . '</h3>';
                  } else {
                    echo '<h3>'.ucfirst($ktn->judul).'</h3>';
                  }
                ?>
                </a>
                <?php 
                  if($ktn->id_kategori!==NULL){
                    $kategori_namaKategori = $this->Umum->nama_kategori($ktn->id_kategori);
                  } else {
                    $kategori_namaKategori = $ktn->nama_kategori;
                  }
                ?>
                <p class="tag-list-inline"><strong>Kategori:</strong> <a href="<?= site_url('Konten/artikel_kategori/kategori='.$ktn->id_kategori.'?q='.ucfirst($kategori_namaKategori)) ?>">
                    <?php
                    if (isset($kategori_pencarian)){
                      $data_kategori = ucfirst($kategori_namaKategori);
                      $dataKategori = ucfirst($data_pencarian_kategori);
                      $data_kategori = str_replace($dataKategori, '<span style="background-color: yellow;">' . $dataKategori . '</span>', $data_kategori);
                      echo $data_kategori;
                    } else {
                      echo ucfirst($kategori_namaKategori);
                    }
                    ?>
                </a></p>
                <p><strong>Diupload:</strong> <?= waktu_berlalu($ktn->tanggal) ?></p>
                <hr>
                <p><?= ucfirst($ktn->keterangan) ?>
                    <br>
                    '"
                </p><br>
                <a class="button" style="margin-bottom: 15px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 5px;" href="<?= site_url('Konten/artikel/'.$ktn->id_konten.'?q='.$ktn->slug) ?>">Baca Selengkapnya <i class="ti-arrow-right"></i></a>
              </div>
            </div>
            <?php
                endforeach;
              }
              if (isset($konten)){
                if (count($konten) == 0) {
                  echo '<p><strong>Maaf,</strong> tidak ada data yang relevan / Konten belum terisi dan ada</p>';
                }
              }
            ?>
            <!-- Pagination -->
            <?= $pagination ?>
          </div>
