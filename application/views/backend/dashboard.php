<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri = $this->uri->segment(1);
?>
<style>
    .konten_notifikasi {
        background-color: #fff;
        padding: 15px;
        /* border-top-left-radius: 37px 140px;
        border-top-right-radius: 23px 130px;
        border-bottom-left-radius: 110px 19px;
        border-bottom-right-radius: 120px 24px; */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px, rgb(51, 51, 51) 0px 0px 0px 3px; */
    }
</style>
<!-- HTML_CONTENT -->
                <!-- /.row -->
                <?php 
                    $username = $this->session->userdata('username');
                    $dataUntukNotifikasi = $this->db->where('penerima_pesan_nontifikasi', $username)->order_by('dibuat_pada', 'desc')->get('nontifikasi')->result();
                    $notifikasi_komentar = $this->db->select('komentar.*', 'konten.judul')->join('konten', 'komentar.id_konten = konten.id_konten')->order_by('waktu', 'desc')->get('komentar')->result();
                    ?>
                    <div style="margin-bottom: 75px; margin-right: 15px; margin-left: 15px;">
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="col-md-12 text-center alert alert-danger" role="alert">
                                <div class="message-container" role="alert"> 
                                    <i class="fa fa-exclamation-triangle fa-3x"></i> 
                                    <div class="message-content" role="alert">
                                        <p class="message-text"><?php echo $this->session->flashdata('error'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="col-md-12 text-center alert alert-success" role="alert">
                                <div class="message-container">
                                    <i class="fa fa-check fa-3x message-icon"></i> 
                                    <div class="message-content" role="alert">
                                        <p class="message-text"><?php echo $this->session->flashdata('success'); ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 konten_notifikasi">
                                <div>
                                    <h1>Notifikasi</h1>
                                    <p style="color: #fff; background-color: #007bff; border-radius: 5px; padding: 5px;">
                                        <i class="fa fa-envelope" style="margin-right: 5px;"></i> <span id="keteranganPesan"><?php if (count($dataUntukNotifikasi) === 0){echo "Tidak ada";}else{echo count($dataUntukNotifikasi);} ?></span> Pesan Notifikasi Baru
                                    </p>
                                </div>
                                <hr>
                                <?php if (count($dataUntukNotifikasi) > 0){ ?>
                                <ul>
                                    <?php foreach ($dataUntukNotifikasi as $notif) : ?>
                                        <div class="notif<?= $notif->id_nontifikasi; ?> nontifikasi">
                                            <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px; text-align: left;">
                                                <strong><?= $notif->Judul_pesan_nontifikasi; ?></strong> <br>
                                                    <p style="margin-bottom: 0;">Pada: <?= $notif->dibuat_pada; ?></p><br>
                                                <?= $notif->Isi_pesan_nontifikasi; ?><br>
                                                <button class="hapusNotif" style="margin-top: 5px;" data-idnotif="<?= $notif->id_nontifikasi; ?>">
                                                    Hapus Notifikasi <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </ul>
                                <?php } else{echo "---";} ?>   
                                <hr>             
                                <p>
                                <a href="<?= base_url('konten'); ?>" style="text-decoration: none; margin-left: 10px;">---> Perikasa Konten Saya <---</a></p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 konten_notifikasi">
                                <div>
                                    <h1>Artikel</h1>
                                    <p style="color: rgba(0, 0, 0, 0.7); background-color: lightblue; border-radius: 5px; padding: 5px;">
                                        <i class="fa fa-envelope" style="margin-right: 5px;"></i> <span id="keteranganPesanKomentar"><?php if (count($notifikasi_komentar) === 0){echo "Tidak ada";}else{echo count($notifikasi_komentar);} ?></span> Pesan Notifkasi Komentar Baru
                                    </p>
                                </div>
                                <hr>
                                <?php if (count($notifikasi_komentar) > 0){ ?>
                                <ul>
                                    <?php foreach ($dataUntukNotifikasi as $notif) : ?>
                                        <div class="notif<?= $notif->id_nontifikasi; ?> nontifikasi">
                                            <div style="border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; border-radius: 5px; text-align: left;">
                                                <strong><?= $notif->Judul_pesan_nontifikasi; ?></strong> <br>
                                                    <p style="margin-bottom: 0;">Pada: <?= $notif->dibuat_pada; ?></p><br>
                                                <?= $notif->Isi_pesan_nontifikasi; ?><br>
                                                <button class="hapusNotif" style="margin-top: 5px;" data-idnotif="<?= $notif->id_nontifikasi; ?>">
                                                    Hapus Notifikasi <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </ul>
                                <?php } else{echo "---";} ?>
                                <hr>
                                <p><a href="<?= site_url('beranda') ?>" style="text-decoration: none; margin-left: 10px;">---> Pergi ke Beranda <---</a></p>
                            </div>
                        </div>
                        <!-- /.row -->
                        <br>

                        <div class="row" style="box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
                            <div class="col-lg-6 col-md-6">
                                <div style="padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                
                                    <h1 style="border-bottom: 4px solid orange; display: inline-block;">Kategori </h1>
                                    <h1 style="display: inline-block;"> konten</h1>

                                    <div style="display: flex; justify-content: space-between; margin-top: 15px;">
                                        <p><strong>Kategori:</strong></p>
                                        <p><strong>Digunakan:</strong></p>
                                    </div>

                                    <hr style="margin-top: 0;">
                                    <?php if (isset($jml_konten_ktgr)):
                                        foreach ($jml_konten_ktgr as $ktgr):
                                        ?>
                                            <a href="<?= site_url('kategori') ?>" style="text-decoration: none; color: rgba(0, 0, 0, 0.7);">
                                                <div style="display: flex; justify-content: space-between;">
                                                    <p><strong><i class="fa fa-chevron-right"></i> <?= ucfirst($ktgr->nama_kategori) ?>:</strong></p>
                                                    <span style="margin: 0 5px;"><?= str_repeat('.', 50) ?></span>
                                                    <p><?= $ktgr->jumlah_konten ?></p>
                                                </div>
                                            </a> 
                                        <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>

                                <div style="padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                
                                    <h1 style="border-bottom: 4px solid orange; display: inline-block;">Caraousel</h1>
                                    
                                    <hr>
                                    <?php
                                        $jml_carousel = $this->db->count_all_results('caraousel');
                                    ?>
                                    <div style="display: flex; justify-content: space-between;">
                                        <p><strong><i class="fa fa-chevron-right"></i> Jumlah Carousel:</strong></p>
                                        <span style="margin: 0 5px;"><?= str_repeat('.', 50) ?></span>
                                        <p><?= $jml_carousel ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6" style="border-right:0.7x;">
                                <div style="padding: 10px; border-radius: 5px; margin-bottom: 44px;">
                                    <h1 style="border-bottom: 4px solid orange; display: inline-block;">Konten</h1>
                                    <hr>
                                    <?php
                                        $jml_konten = $this->db->count_all_results('konten');
                                    ?>
                                    <div style="display: flex; justify-content: space-between;">
                                        <p><strong><i class="fa fa-chevron-right"></i> Jumlah Konten:</strong></p>
                                        <p><?= $jml_konten ?></p>
                                    </div>
                                </div>
                                <div style="padding: 10px; border-radius: 5px; margin-bottom: 15px;">
                                    <h1 style="border-bottom: 4px solid orange; display: inline-block;">Galeri</h1>
                                    <hr>
                                    <?php
                                        $jml_galeri = $this->db->count_all_results('galeri');
                                    ?>
                                    <div style="display: flex; justify-content: space-between;">
                                        <p><strong><i class="fa fa-chevron-right"></i> Jumlah Galeri:</strong></p>
                                        <p><?= $jml_galeri ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br>    

                        <div class="row">
                            <div class="col-lg-12 col-md-12 konten_notifikasi">
                                <h1><strong>Captcha</strong></h1>
                                <hr>

                                <!-- captcha baru -->
                                <div class="col-md-6 offset-md-3">
                                    <form action="<?= base_url('dashboard/captcha') ?>" method="post">
                                        <div class="form-group">
                                            <label for="inputCaptcha">Buat Captcha baru</label>
                                            <input type="text" class="form-control" id="inputCaptcha" name="captcha" maxlength="8" placeholder="inputkan text captcha" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                            <span><strong>/</strong></span>
                                        <button type="button" class="btn btn-warning" onclick="location.href = '<?= base_url('dashboard/captcha') ?>';">Buat captcha otomatis</button>
                                    </form>
                                </div>

                                <div class="col-md-12 offset-md-3" style="margin-top: 15px;">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Striped Rows
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama file</th>
                                                            <th>Text</th>
                                                            <th>Gambar file</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <form id="captcha-form" action="<?= site_url('dashboard/hapus_captcha') ?>" method="post">
                                                            <?php
                                                                $data_captcha = $this->db->get('captcha')->result();
                                                                $no = 1;
                                                                if ($data_captcha != null):
                                                                    foreach ($data_captcha as $cptc):
                                                            ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $cptc->filename ?></td>
                                                                <td><?= $cptc->word ?></td>
                                                                <td><img src="<?= base_url('assets/captcha/'.$cptc->filename) ?>" alt=""></td>
                                                                <td>
                                                                    <button type="button" class="btn btn-danger hapus-captcha" data-hapus-captcha="<?= $cptc->captcha_id ?>" data-ke="<?= $no ?>"><i class="fa fa-trash"></i></button>
                                                                    <span><strong>/</strong></span>
                                                                    <input type="checkbox" class="captcha_checkbox" data-captcha_checkbox="<?= $no ?>" name="hapus_captcha[]" value="<?= $cptc->captcha_id ?>">
                                                                </td>
                                                            </tr>
                                                            <?php
                                                                    endforeach;
                                                                endif;    
                                                            ?>
                                                            <tr style="border: 2px black solid;">
                                                                <td colspan="2">
                                                                    <div style="display: flex; justify-content: space-between;">
                                                                        <p>Jumlah data captcha:</p>  
                                                                        <span style="margin: 0 5px;"><?= str_repeat('.', 130) ?></span>
                                                                        <p><?= $this->db->count_all_results('captcha'); ?></p>
                                                                    </div>
                                                                </td>
                                                                <td colspan="2">Hapus semua:</td>
                                                                <td><button type="submit" class="btn btn-danger" id="hapus-captcha-all"><i class="fa fa-trash"></i> All</button></td>
                                                            </tr>
                                                        </form>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->
                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>

                    <!-- MODAL KONFIRMASI -->
                    <div id="modalKonfirmasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <strong><h3 class="modal-title times-new-roman">Konfirmasi aksi,</h3></strong>
                                </div>
                                <div class="modal-body">
                                    <p id="keteranganKonten">Anda yakin ingin melanjutkan untuk mengedit data ini?</p>
                                    <strong><p id="dataPengguna" class="text-primary"></p></strong>
                                    <strong><p id="dataPenggunaLog" class="text-primary"></p></strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="confirmButton">Ya <i class="fa fa-check"></i></button>
                                    <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Batal <i>X</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /MODAL KONFIRMASI -->
<!-- HMTL_END_CONTENT -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.hapusNotif').click(function(){
            var id = $(this).data('idnotif');
            $('.notif'+id+'').fadeOut(function() {
                $('.notif'+id+'').remove();

                $.ajax({    
                    url: '<?= base_url('Dashboard/hapusNontifikasi') ?>',
                    type: 'POST',
                    data: {
                        id: id
                    },
                    success: function(respon){
                        if ($('.nontifikasi').length >= 1){
                            $('#keteranganPesan').text($('.nontifikasi').length);
                        } else {
                            $('#keteranganPesan').text('Tidak ada');
                        }
                    }, 
                    error: function(){
                        alert("maaf terjadi kesalahan");
                    }
                })
            });
        });

        $(".hapus-captcha").on("click", function () {
            event.preventDefault();
            let keterangan = $('#keteranganKonten').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#keteranganKonten').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');

            $('')

            var dataCaptcha = 'Data captcha ke: '+$(this).data('ke');
            var dataId = $(this).data('hapus-captcha')
            $('#dataPengguna').text(dataCaptcha);
            $('#dataPenggunaLog').empty();

            const confirmationPromise = new Promise(function (event) {
                $("#confirmButton").click(function () {
                    result = true;
                    event();
                });

                $("#cancelButton").click(function () {
                    result = false;
                    event();
                });
            });

            confirmationPromise.then(function () {
                $("#modalKonfirmasi").modal('hide');

                if (result === true) {
                    window.location.href = "<?= base_url('dashboard/hapus_captcha/') ?>" + dataId;
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

        $("#hapus-captcha-all").on("click", function () {
            event.preventDefault();
            let keterangan = $('#keteranganKonten').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#keteranganKonten').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');

            let data_captcha_checkbox = ''; 
            let jumlah_captcha_terpilih = 0;
            $('.captcha_checkbox:checked').each(function() {
                jumlah_captcha_terpilih += 1;
                data_captcha_checkbox += $(this).data('captcha_checkbox') + ', ';
            });

            var dataId = $(this).data('hapus-captcha')
            $('#dataPengguna').text('Data captcha ke: '+data_captcha_checkbox);
            $('#dataPenggunaLog').text('Jumlah data terpilih: '+jumlah_captcha_terpilih);

            const confirmationPromise = new Promise(function (event) {
                $("#confirmButton").click(function () {
                    result = true;
                    event();
                });

                $("#cancelButton").click(function () {
                    result = false;
                    event();
                });
            });

            confirmationPromise.then(function () {
                $("#modalKonfirmasi").modal('hide');

                if (result === true) {
                    $('#captcha-form').submit();
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });
    })
</script>