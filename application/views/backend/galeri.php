<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
    .vertical-tabs {
        display: flex;
        /* max-width: 550px; */
        margin: 0 auto;
    }

    .tab-list {
        list-style: none;
        display: flex;
        text-align: left;
        padding: 0;
    }

    .tab-list li {
        background-color: #ced4da;
        padding: 10px 20px;
        margin: 0 5px 0 0;
        cursor: pointer;
        transition: background-color 0.3s;
        border-bottom: 2px solid #000;
    }

    .tab-list li.active {
        background-color: #3498db;
        color: #fff;
    }

    input[type='file'] {
        width: 100%;
    }

    .tab-content {
        display: none;
        padding: 20px;
        width: 100%;
        border-radius: 5px;
        background-color: #fff;
        color: #000;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .tab-content p {
        margin: 0;
    }

    .tab-content.active {
        display: block;
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
</style>

<div class="row mt-5">
    <div class="col-md-12">
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

        <!-- Galeri -->
        <h1 id="galeri_judul">Galeri Foto</h1>
        <p style="background-color: lightpink; border-radius: 4px; padding: 7px; width: fit-content;"><i class="fa fa-bookmark-o"></i> Buat galeri anda sendiri :)</p>
        <!-- Form untuk Unggah Gambar -->
        <hr style="border: 0.5px solid black;">
        <div class="row">
            <div class="horizontal-tabs col-md-6 col-lg-12 mt-5">
                <ul class="tab-list">
                    <li class="active"><a href="#tab1" style="color: #fff; text-decoration: none;">Tambah Galeri baru <i class="fa fa-plus"></i></a></li>
                    <li><a href="#tab2" id="editGaleriTab" style="color: #fff; text-decoration: none;">Edit Galeri <i class="fa fa-pencil"></i></a></li>
                </ul>
                <div class="tab-content active" id="tab1">
                    <form action="<?php echo base_url('galeri/tambah_galeri') ?>" method="post" style="margin-bottom: 15px;" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul:</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto:</label>
                            <input type="file" class="form-control-file" style="margin-bottom: 5px;" name="file" id="file" accept="image/*" required>
                            <button id="previewUnggahan" data-toggle="modal" data-target="#modalPreviewFotoUnggahan" onclick="event.preventDefault()" style="color: #000;">Lihat Foto Unggahan,</button><button type="button" class="resetButton" style="color: #000;">Reset Gambar</button><br>
                            <strong><span>Ukuran Gambar: </span></strong><span id="gambarUkuran"></span><br>
                            <strong><span>Lebar Gambar: </span></strong><span id="gambarLebar"></span><br>
                            <strong><span>Tinggi Gambar: </span></strong><span id="gambarTinggi"></span>
                        </div>

                        <button type="submit" class="btn btn-primary">Unggah</button>
                    </form>
                </div>
                <!-- Tab ke 2 -->
                <div class="tab-content" id="tab2">
                    <div class="form-group" id="ajax_galeri">
                        <label for="judul">Pilih Data Galeri:</label>
                        <?php $data_Galeri = $this->db->select('id_galeri')->get('galeri')->result(); ?>
                        <select class="form-control" name="dataGaleri" id="dataGaleri" required>
                            <?php $no_glr = 1; foreach ($data_Galeri as $id_glr) : ?>
                                <option value="<?= $id_glr->id_galeri; ?>">Data Galeri ke <?= $no_glr++ ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div id="formEditGaleri">
                        <form action="<?php echo base_url('galeri/edit_galeri') ?>" method="post" style="margin-bottom: 15px;" enctype="multipart/form-data">
                            <input type="hidden" name="id_galeri" id="edit-id">
                            <div class="form-group">
                                <label for="judul">Judul:</label>
                                <input type="text" class="form-control" name="judul" id="edit-judul" required>
                            </div>
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" name="deskripsi" id="edit-deskripsi" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="foto">Foto:</label>
                                <input type="file" class="form-control-file" style="margin-bottom: 5px;" name="file" id="edit-file" accept="image/*">
                                <button id="previewUnggahan-edit" data-toggle="modal" data-target="#modalPreviewFotoUnggahan" onclick="event.preventDefault()" style="color: #000;">Lihat Foto Unggahan,</button><button type="button" class="resetButton" style="color: #000;">Reset Gambar</button><br>
                                <strong><span>Ukuran Gambar: </span></strong><span id="gambarUkuran"></span><br>
                                <strong><span>Lebar Gambar: </span></strong><span id="gambarLebar"></span><br>
                                <strong><span>Tinggi Gambar: </span></strong><span id="gambarTinggi"></span>
                            </div>

                            <button type="submit" class="btn btn-primary">Unggah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr style="border: 0.5px solid black;">

        <div id="modalPreviewFotoUnggahan" class="modal fade" style="display: none;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <strong><h3 class="modal-title times-new-roman" style="color: #000;">Preview foto Unggahan: </h3></strong>
                    </div>
                    <div class="modal-body" style="overflow: hidden;">
                        <img src="" alt="Logo" class="img-thumbnail previewFoto">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Ok <i>X</i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Galeri Foto -->
        <!-- <div class="container mt-5"> -->
            <div class="row" style="display: flex; flex-wrap: wrap-reverse;">
                <?php if (isset($galeri)):
                    $no = 1;
                    if ($this->uri->segment(3) != null){
                        $no_glr = intval($this->uri->segment(3));
                    } else {
                        $no_glr = 0;
                    }
                    foreach ($galeri as $glr): 
                        if (strlen($glr->deskripsi) > 30) {
                            $glr->deskripsi = substr($glr->deskripsi, 0, 28) . '...';
                        }
                        $data_galeri_gambar = getimagesize('assets/galeri/'.$glr->foto);
                ?>
                <div class="col-lg-4 mb-4 w-100" style="margin-top: 42px; display: flex; flex-direction: row; height: fit-content;">
                    <div class="card" style="box-shadow: rgba(255, 255, 255, 0.1) 0px 1px 1px 0px inset, rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px; max-width: fit-content; overflow: hidden; border-top-right-radius: 10px;">
                        <img src="<?= base_url('assets/galeri/'.$glr->foto) ?>" class="img-thumbnail" alt="Judul Gambar 1" style="border-top-left-radius: 10px; border-top-right-radius: 10px; width: fit-content; max-height: 450px;">
                        <div class="card-body" style="border-right: 2px solid rgba(0, 0, 0, 0.2); border-left: 2px solid rgba(0, 0, 0, 0.2); border-top: 2px solid rgba(0, 0, 0, 0.2); padding: 5px;">
                            <h5 class="card-title"><strong>Judul Gambar:</strong> <?= $glr->judul ?></h5>
                            <p class="card-text"><strong>Dimensi gambar:</strong> <?= $data_galeri_gambar[0].'x'.$data_galeri_gambar[1].' pixel' ?></p>
                            <p class="card-text"><strong>Deskripsi gambar:</strong> <?= $glr->deskripsi ?></p>
                            <p class="card-text"><strong>Deskripsi gambar:</strong>__ <?= tanggal_indonesia($glr->tanggal) ?></p>
                        </div>
                        <div class="card-footer" style="padding: 5px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px; border-right: 2px solid rgba(0, 0, 0, 0.2); border-left: 2px solid rgba(0, 0, 0, 0.2); border-bottom: 2px solid rgba(0, 0, 0, 0.2); border-top: 2px solid rgba(0, 0, 0, 0.2);">
                        <strong><button class="btn-danger hapus-galeri" data-idgaleri="<?= $glr->id_galeri ?>" data-galeri="<?php echo 'Data Galeri: '.$no++.', '.$glr->judul.' ('.$glr->deskripsi.')' ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button><span class="fa-2x">/</span><button class="btn-warning edit-galeri" data-judul="<?= $glr->judul ?>" data-deskripsi="<?= $glr->deskripsi ?>" data-foto="<?= $glr->foto ?>" data-idgaleri="<?= $glr->id_galeri ?>" style="margin-left: 5px;"><i class="fa fa-pencil fa-2x"></i></button></button><span class="fa-2x">/</span><span style="border-radius: 4px; padding: 5px; background-color: #e5e5e5;"><?= ++$no_glr ?></strong>
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        <!-- </div> -->
        <hr>
        <div class="container text-center">
            <?= $pagination ?>
        </div>
    </div>
</div>

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

<div style="margin-bottom: 75px; padding-bottom: 75px;"><hr></div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tab-list li').on('click', function () {
            event.preventDefault();
            var tabId = $(this).find('a').attr('href');
            $('.tab-list li').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $(tabId).addClass('active');
        });

        var gambarUkuran = $('#gambarUkuran');
        var gambarLebar = $('#gambarLebar');
        var gambarTinggi = $('#gambarTinggi');
        var fileInput = $('#file');
        var fileInputEdit = $('#edit-file');
        var imagePreview = $('#modalPreviewFotoUnggahan').find('.previewFoto');
        var resetButton = $('.resetButton');

        resetButton.click(function() {
            event.preventDefault();
            fileInput.val('');
            fileInputEdit.val('');
            imagePreview.attr('src', '');
            gambarUkuran.text('');
            gambarLebar.text('');
            gambarTinggi.text('');
        });
        
        $('input[type="file"]').on('change', function() {
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

        $(".hapus-galeri").on("click", function () {
            event.preventDefault();
            let keterangan = $('#keteranganKonten').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#keteranganKonten').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');
            var dataUser = $(this).data('galeri');
            var dataId = $(this).data('idgaleri')
            $('#dataPengguna').text(dataUser);
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
                    window.location.href = "<?= base_url('Galeri/hapus_galeri/') ?>" + dataId;
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

        $('.edit-galeri').on('click', function () {
            let id = $(this).data('idgaleri');
            $('a[href="#tab2"]').click();
            ambil_data_galeri(id, true);
            $('#tab2').get(0).scrollIntoView({ behavior: 'smooth', block: 'end' });
        });

        $('#dataGaleri').on('change', function() {
            let dataGaleri = $(this).val();
            ambil_data_galeri(dataGaleri);
        });

        $('.tab-list li').on('click', function() {
            let ok = $(this).find('a').attr('id');
            if (ok === 'editGaleriTab'){
                $('#ajax_galeri').show();
            }
        });

        function ambil_data_galeri(id, pop = false){
            if (pop === true){
                $('#ajax_galeri').hide();
            }
            $.ajax(
            {
                url: '<?= base_url('galeri/ambil_data_galeri/') ?>'+id,     
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#edit-id').val(data.id_galeri);
                    $('#edit-judul').val(data.judul);
                    $('#edit-deskripsi').val(data.deskripsi);
                    $('#previewUnggahan-edit').text('Lihat Foto Unggahan Sebelumnya,');
                    imagePreview.attr('src', '<?= base_url('assets/galeri/') ?>'+data.foto);
                    $('#modalPreviewFotoUnggahan').modal('show');
                },
                error: function() {
                    alert("terjadi kesalahan penanganan :), mohon kesabarannya.");
                }
            }
            )
        }

        $('#edit-file').change(function() {
            $('#previewUnggahan-edit').text('Lihat Foto Unggahan,');
        });
    });
</script>
