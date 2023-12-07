<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .times-new-roman {
        font-family: "Times New Roman", Times, serif;
    }

    .config-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .config-item p {
        margin: 0;
    }

    .labelP {
        flex: 1;
        text-align: left;
        padding-right: 10px;
    }

    #imagePreview {
        max-width: 100%;
        max-height: 300px; 
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }

    .tox.tox-tinymce {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <strong><h2 class="times-new-roman" style="border-bottom: 2px black solid;">konfigurasi</h2></strong>
    </div>
</div>
<?php
foreach($konfigurasi as $k): ?>
    <div style="border-bottom: 2px black solid; padding-bottom: 10px">
        <div class="config-item">
            <p class="labelP"><strong>Judul Website:</strong></p>
            <p><?= $k['judul_website']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Profil Website:</strong></p>
            <p><?= $k['profile_website']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Instagram:</strong></p>
            <p><?= $k['instagram']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Facebook:</strong></p>
            <p><?= $k['facebook']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Email:</strong></p>
            <p><?= $k['email']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Alamat:</strong></p>
            <p><?= $k['alamat']; ?></p>
        </div>
        <div class="config-item">
            <p class="labelP"><strong>Nomor Whatsapp:</strong></p>
            <p><?php
            $no_wa_format = substr_replace($k['no_wa'], '-', 4, 0);
            $no_wa_format = substr_replace($no_wa_format, '-', 9, 0);
            echo $no_wa_format; ?></p>
        </div>
    </div>
    <br>
<?php endforeach; ?>

    <!-- alert -->
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
    <?php if ($this->session->flashdata('warning')) { ?>
        <div class="col-md-12 text-center alert alert-warning" role="alert">
            <div class="message-container">
                <i class="fa fa-cube fa-3x message-icon"></i>
                <div class="message-content" role="alert">
                    <p class="message-text"><?php echo $this->session->flashdata('warning'); ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php
    if ($this->session->flashdata('upload_message')) {
        echo '<div class="alert alert-success">' . $this->session->flashdata('upload_message') . '';
        echo '<ul>';
        echo '<li>Nama File  : ' . $this->session->flashdata('file_name') . '</li>';
        echo '<li>Tipe File  : ' . $this->session->flashdata('file_type') . '</li>';
        echo '<li>Ukuran File: ' . $this->session->flashdata('file_size') . ' KB</li>';
        echo '</ul>';
        echo '</div>';
    }
    ?>
    <!-- alert -->

    <div id="konfigurasi">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel tabbed-panel panel-default">
                    <div class="panel-heading clearfix">
                        <div class="panel-title pull-left"><strong>Data-data Konfigurasi Website.</strong></div>
                        <div class="pull-right">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab-konfigurasi" data-toggle="tab" aria-expanded="true">Data Konfigurasi</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">    
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab-konfigurasi">
                        <div class="row times-new-roman">
                            <div class="col-lg-12" style="padding-bottom: 45px;">
                                <h3 class="times-new-roman text-center"><strong>Konfigurasi Website</strong></h3>
                                <hr style="border-bottom: 2px solid black;">
                                <form role="form" method="post" action="<?= base_url('Konfigurasi/editKonfigurasi') ?>">
                                    <input type="hidden" name="id_konf" class="id_konfigurasi" value="<?= $k['id_konfigurasi'] ?>">
                                    <div class="form-group">
                                        <label for="">Judul Webiste: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-header"></i></span>
                                            <input type="text" class="form-control jWebsite" name="judul_website" value="<?= $k['judul_website'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Profile Webiste: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-bookmark"></i></span>
                                            <textarea class="form-control jWebsite" name="profile_website"><?= $k['profile_website'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Instagram: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-instagram"></i></span>
                                            <input type="text" class="form-control ins" name="instagram" value="<?= $k['instagram'] ?>">
                                        </div>
                                        <small><i class="fa fa-question-circle"></i> Isikan username instagram Anda</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Facebook: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-facebook"></i></span>
                                            <input type="text" class="form-control faceB" name="facebook" value="<?= $k['facebook'] ?>">
                                        </div>
                                        <small><i class="fa fa-question-circle"></i> Isikan username facebook Anda</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-envelope"></i></span>
                                            <input type="email" class="form-control email" name="email" value="<?= $k['email'] ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-home"></i></span>
                                            <input type="text" class="form-control alamat" name="alamat" value="<?= $k['alamat'] ?>"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Koordinat lokasi Geografi Anda <i class="fa fa-map-marker"></i>: </label>
                                        <div class="input-group" style="width: 100%; margin-bottom: 10px;">
                                            <span class="input-group-addon" style="width: 55px;">Latitude</span>
                                            <input type="text" class="form-control" name="latitude" value="<?= $k['latitude'] ?>" pattern="[0-9.-]*" 
                                            oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" title="Masukkan angka atau angka desimal" placeholder="Koordinat Latitude ">
                                        </div>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;">Longitude</span>
                                            <input type="text" class="form-control" name="longitude" value="<?= $k['longitude'] ?>" pattern="[0-9.-]*" 
                                            oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" title="Masukkan angka atau angka desimal" placeholder="Koordinat Longitude">
                                        </div>
                                        <small><i class="fa fa-question-circle"></i> Isikan Koordinat lokasi Geografi Anda, untuk menerima peta dihalaman kontak/hubungi</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nomor Whatsapp: </label>
                                        <div class="input-group" style="width: 100%;">
                                            <span class="input-group-addon" style="width: 55px;"><i class="fa fa-whatsapp"></i></span>
                                            <input type="text" pattern="[0-9]*" 
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1'); this.value.length > 13 ? this.value = this.value.slice(0, 13) : this.value" inputmode="numeric" class="form-control noWA" name="no_wa" value="<?= $k['no_wa'] ?>">
                                        </div>
                                        <small><i class="fa fa-question-circle"></i> Isikan nomor Anda tanpa kode negara</small>
                                    </div>
                                    <button type="submit" class="btn btn-warning form-control">Ubah data Konfigurasi <i class="fa fa-edit"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<hr style="border-bottom: 2px black solid; height: 35px;">
<div style="padding-bottom: 50px;"></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        placeholder: 'Ketik disini...',
        plugins: 'accordion advlist anchor autolink autosave code directionality fullscreen help importcss quickbars charmap codesample link emoticons lists searchreplace visualblocks wordcount insertdatetime',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        setup: function (editor) {
            editor.on('SaveContent', function (e) {
                e.content = e.content.replace(/<img[^>]*>/g, '');
                e.content = e.content.replace(/<p><\/p>/g, '');
            });
        },
        promotion: false
    });
    $(document).ready(function() {
        function sembunyikanElement() {
            $('.alert').animate({
                opacity: 0
            }, {
                duration: 3000,
                easing: 'easeOutBounce',
                complete: function() {
                    $(this).remove();
                }
            });
        }
        $('.alert').css({
            right: '0',
            opacity: '1'
        });
        setTimeout(sembunyikanElement, 10000);
    })
</script>