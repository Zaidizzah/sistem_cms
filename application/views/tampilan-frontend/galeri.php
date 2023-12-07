<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="w-100">
    <h1 style="text-align: center; line-break: auto;">Halaman Galeri:</h1><br>
    <p><strong>Galeri Item List: </strong> <?= count($galeri_frontend) ?></p>
    <hr>
    
    <div class="row">
        <?php
        $no = 1;
        if (isset($galeri_frontend)){
            foreach ($galeri_frontend as $glr_front){
        
        ?>
            <div class="col-md-3 mb-3">
                <div class="thumbnail">
                    <a class="img-thumbnail" style="border-bottom-left-radius: 0; border-bottom-right-radius: 0;" href="<?= base_url('assets/galeri/'.$glr_front->foto) ?>" data-lightbox="galeri_frontend">
                        <img class="img-thumbnail" src="<?= base_url('assets/galeri/'.$glr_front->foto) ?>" alt="...">
                    </a>
                    <div class="caption" style="background-color: #fff; padding: 7px; border-bottom-left-radius: 5px; border-bottom-right-radius: 5px;">
                        <h3><?= $glr_front->judul ?></h3>
                        <p><?= $glr_front->deskripsi ?></p>
                        <div style="display: flex; justify-content: space-between;">
                            <span>Tanggal:</span>
                            <span><?= tanggal_indonesia($glr_front->tanggal) ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
        ?>
            <p><strong>Maaf, </strong> data galeri kosong atau belum ada data</p>
        <?php
        };
        ?>
    </div>
    <hr>
</div>