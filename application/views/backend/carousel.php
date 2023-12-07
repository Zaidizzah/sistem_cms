<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }
</style>
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
    <div class="row">
        <?php
            $no = 1;
            $data_ke = 1;
            if (isset($dataCarousel)){
                foreach ($dataCarousel as $item) { ?>
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <div style="background-color: #eaf4f4; padding-top: 10px; padding-right: 15px; padding-bottom: 10px; padding-left: 10px; border: 1px solid #8d99ae; border-top-right-radius: 10px; border-top-left-radius: 10px;">
                            <strong><p>Data ke: <?= $no++ ?></p></strong>
                            <strong><p>Judul:</strong> <?= $item['judul'] ?>,</p>
                            <strong><p>Nama Foto:</strong> <?= $item['foto'] ?>,</p>
                            <strong><p>Dimensi Foto:</strong> <?php $gambar_dimensi = getimagesize('./assets/upload/' . $item['foto']); echo $gambar_dimensi[0].'x'.$gambar_dimensi[1].' Pixel' ?>,</p>
                        </div>
                        <div style="border-right: 1px solid #8d99ae; border-left: 1px solid #8d99ae; border-bottom: 1px solid #8d99ae;">
                            <br>
                            <img src="<?= base_url('assets/upload/'.$item['foto']) ?>" alt="" class="card-img" style="height: 412px;" width="100%">
                            <div class="d-flex justify-content-between" style="width: 100%; margin-bottom: 10px; margin-left: 10px;">
                                <button class="HapusDatacarousel btn-danger" data-id="<?= $item['id_caraousel'] ?>" data-datake="<?= $data_ke++ ?>" style="margin-top: 10px;"><i class="fa fa-trash"></i></button>
                                <button class="modalFoto" data-img-url="<?= base_url('assets/upload/'.$item['foto']) ?>">Lihat Data Foto</button>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="id_caraousel" value="<?= $item['id_caraousel'] ?>"> -->
                        <hr>
                    </div>
                <?php 
                }
            } ?>
            </div>
            <hr>
            <!-- Modal foto -->
            <div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <strong><h3 class="modal-title times-new-roman">Preview foto Unggahan: </h3></strong>
                        </div>
                        <div class="modal-body">
                            <img src="" alt="Logo" class="img-fluid  previewFoto">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Ok <i>X</i></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal foto -->
        <form id="formCaraousel" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <?php if (count($dataCarousel) >= 1) { ?>
                    <div class="form-group">
                        <label for="file"><strong>Edit Data ke: </strong></label>
                        <select name="foto_ke" id="data_ke" class="form-control-file form-control">
                            <option value="" selected>Pilih data ke berapa terlebih dahulu,</option>
                            <?php $data_ke = 1; foreach ($dataCarousel as $id) : ?>
                            <option value="<?= $id['id_caraousel'] ?>">Data ke: <?php echo $data_ke++ ?></option>
                            <?php var_dump($id) ?>
                            <?php endforeach; ?>
                        </select>
                    <?php } ?>
                    </div>
                    <div class="form-groub">
                        <label for="judul"><strong>Judul: </strong></label>
                        <input type="text" name="judul" id="judulData" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="file"><strong>Upload Foto: </strong></label>
                        <input type="file" name="file" id="file" class="form-control-file">
                        <span class="text-danger"><strong>Catatan:</strong> Pilih foto keberapa terlebih dahulu sebelum ingin mengedit data foto Caraousel Dan judulnya, sebaliknya jika ingin menambah data baru lewati pemilihan data</span><br>
                        <span class="text-danger"><strong>Catatan:</strong> Ukuran/dimensi foto harus lebih dari 382x400 pixel</span><br><br>
                        <div id="modalPreviewFotoUnggahan" class="modal fade" style="display: none;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <strong><h3 class="modal-title times-new-roman">Preview foto Unggahan: </h3></strong>
                                    </div>
                                    <div class="modal-body">
                                        <img src="" alt="Logo" class="img-fluid previewFoto">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Ok <i>X</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button id="previewUnggahan" data-toggle="modal" data-target="#modalPreviewFotoUnggahan">Lihat Foto Unggahan,</button><button type="button" id="resetButton">Reset Gambar</button><br>
                        <strong><span>Ukuran Gambar: </span></strong><span id="gambarUkuran"></span><br>
                        <strong><span>Lebar Gambar: </span></strong><span id="gambarLebar"></span><br>
                        <strong><span>Tinggi Gambar: </span></strong><span id="gambarTinggi"></span>
                    </div>
                    <hr>
                    <?php if (count($dataCarousel) >= 1) { ?>
                    <button type="button" class="btn form-control btn-warning" id="ubahFoto" style="margin-bottom: 10px; display: none;">Ubah data <i class="fa fa-edit"></i></button>
                    <?php } ?>
                    <button type="button" class="btn form-control btn-primary" id="tambahFoto">Tambah data baru <i class="fa fa-plus"></i></button>
                </div>
            </div>
        </form>
<hr style="border-bottom: 2px black solid; height: 35px;">
<div style="padding-bottom: 50px;"></div>

<div id="modalKonfirmasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h3 class="modal-title times-new-roman">Konfirmasi aksi,</h3></strong>
            </div>
            <div class="modal-body">
                <p id="keteranganKonten">Anda yakin ingin melanjutkan untuk menghedit data ini?</p>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script type="text/javascript">
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

        $('#previewUnggahan').click(function() {
            event.preventDefault();
        });

        $('.modalFoto').click(function() {
            var imgUrl = $(this).data('img-url');
            $('#modalPreview').find('.previewFoto').attr('src', '');
            $('#modalPreview').find('.previewFoto').attr('src', imgUrl);
            $('#modalPreview').modal('show');
        });

        var gambarUkuran = $('#gambarUkuran');
        var gambarLebar = $('#gambarLebar');
        var gambarTinggi = $('#gambarTinggi');
        var fileInput = $('#file');
        var imagePreview = $('#modalPreviewFotoUnggahan').find('.previewFoto');
        var resetButton = $('#resetButton');

        resetButton.click(function() {
            event.preventDefault();
            console.log('oke');
            fileInput.val('');
            imagePreview.attr('src', '');
            gambarUkuran.text('');
            gambarLebar.text('');
            gambarTinggi.text('');
        });
        
        $('#file').on('change', function() {
            var input = this;
            $('#modalPreviewFotoUnggahan').modal('show');
            
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var url = e.target.result;
                    imagePreview.attr('src', url);

                    var fileSize = input.files[0].size; 
                    var fileSizeKB = fileSize / 1024;
                    gambarUkuran.text(fileSizeKB.toFixed(2) + ' KB');

                    // Memuat diimensi gambar terlebih dahulu
                    // Lebar dan tinggi gambar,,
                    var image = new Image();
                    image.src = url;
                    image.onload = function() {
                        var width = image.width;
                        var height = image.height;
                        gambarLebar.text(width + ' pixels');
                        gambarTinggi.text(height + ' pixels');
                    };
                };
                
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#ubahFoto').click(function() {
            var dataID = $('#data_ke').val();
            console.log(dataID);
            if (dataID != '') {
                $("#confirmButton").show();
                $('#dataPengguna').text('Anda yakin untuk mengubah data ini?');
                $("#modalKonfirmasi").modal('show');
                
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
                        $('#formCaraousel').attr('action', '<?= base_url('carousel/editCarousel') ?>');
                        $('#formCaraousel').submit();
                    } else if (result === false) {
                        $('#dataPengguna').text('');
                    } else {
                        alert('Maaf terjadi kesalahan!');
                    }
                    result = null;
                });
            } else {
                $('#dataPengguna').text('Anda Belum memilih data mana yang akan diubah.');
                $("#confirmButton").hide();
                $("#modalKonfirmasi").modal('show');
                const confirmationPromise = new Promise(function (event) {
                    $("#confirmButton").click(function () {
                        result = true;
                        event();
                    });
                });

                confirmationPromise.then(function () {
                    $("#modalKonfirmasi").modal('hide');
    
                    if (result === true && result) {
                        // tidak ada tindakan
                    } else {
                        $('#dataPengguna').text('');
                    }
                    result = null;
                });
            }
        });

        $('#tambahFoto').click(function() {   
            $('#formCaraousel').attr('action', '<?= base_url('carousel/tambahCarousel') ?>');
            $('#formCaraousel').submit();
        });

        $('.HapusDatacarousel').click(function() {   
            event.preventDefault();
            let keterangan = $('#keteranganKonten').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#keteranganKonten').text(keteranganBaru);
            var dataCRSL = $(this).data('datake');
            var dataId = $(this).data('id')
            $('#dataPengguna').text("Data Caraousel ke: "+dataCRSL);
            $('#dataPenggunaLog').empty();  
            let id = $(this).data('id');
            $("#modalKonfirmasi").modal('show');
            
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
                    window.location.href = "<?= base_url('carousel/hapusCarousel/') ?>"+id;
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

        $('#data_ke').change(function() {
            if ($(this).val() == '') {
                $('#ubahFoto').fadeOut();
                console.log($(this).val());
            }
            if ($(this).val() != '') {
                $('#ubahFoto').fadeIn();
            }
            var id = $(this).val();
            if (id != '') {
                // Maap masih salah harusnya pak 'GET'
                $.ajax({
                    url: '<?= base_url('carousel/ambilDataCarousel') ?>',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#judulData').val(data.judul);
                    },
                    error : function() {
                        alert("Terjadi Kesalahan: Gagal dalam memuat data");
                    }
                })
            } else {
                $('#judulData').val('');
            }
        });
    });
</script>