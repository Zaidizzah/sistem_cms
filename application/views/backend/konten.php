<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style>
     #imagePreview {
        max-width: 100%;
        max-height: 300px; 
    }

    img {
        width: 100%;
        height: 100%;
        object-fit: cover; 
    }
</style>
<div id="tabUser" style="margin-bottom: 55px;">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel tabbed-panel">
                <div class="panel-heading clearfix">
                    <div class="panel-title pull-left"><strong>Data-data Konten.</strong></div>
                    <div class="pull-right">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab-konten" data-toggle="tab" aria-expanded="true">Data Konten</a></li>
                            <li class=""><a href="#tab-aksi" data-toggle="tab" aria-expanded="false">Tambah Konten baru</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Tab data-data pengguna akan dipanggil jika Admin menginginkannya -->
    <!-- Tab Content -->
    <div class="row">
        <div style="margin-left: 20px; margin-right: 20px;">
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
        </div>
        <div class="row">    
            <div class="tab-content">
                <div class="tab-pane fade active in" id="tab-konten">
                    <div style="margin-left: 20px; margin-right: 20px;">
                        <?php
                            $no = 0;
                            $noKonten = 1;
                            $username = $this->session->userdata('username');
                            $levelUser = $this->session->userdata('tipe_user');
                            if (isset($konten)){
                            foreach ($konten as $data) {
                                $image_konten = getimagesize('./assets/upload/'.$data->foto);
                                $no++;
                        ?>
                        <div class="col-lg-4 col-md-4" style="margin-top: 25px;">
                            <div class="card" style="width: 100%; overflow-wrap: break-word;">
                                <img src="<?= base_url('assets/upload/').$data->foto ?>" class="img-thumbnail" alt="...">
                                <div class="card-body" style="margin-top: 15px;">
                                    <p class="card-text"><strong>Dimensi: </strong><?= $image_konten[0].'x'.$image_konten[1].' pixel' ?></p>
                                    <p class="card-text"><strong>Judul: </strong><?= $data->judul ?></p>
                                    <p class="card-text"><strong>Kategori: </strong><?= $data->nama_kategori ?></p>
                                    <p class="card-text"><strong>Kreator: </strong><?= ucfirst($data->username) ?></p>
                                    <p class="card-text"><strong>Waktu: </strong><?= tanggal_indonesia($data->tanggal) ?></p>
                                    <p class="card-text"><strong>Slug: </strong><?= $data->slug ?></p>
    
                                    <!-- button aksi -->
                                    <p class="card-text"><strong>Keterangan: </strong><a style="text-decoration: none; cursor: pointer;" class="lihatKeterangan" data-id="<?= $data->id_konten ?>"><i class="fa fa-caret-right"></i> Lihat</a></p>
                                    <p class="card-text"><strong>Kunjungi: </strong><a href="<?= site_url('Konten/artikel/'.$data->id_konten.'?q='.$data->slug) ?>" style="text-decoration: none; cursor: pointer;"><i class="fa fa-caret-right"></i> <i class="fa fa-eye"></i></a></p>
    
                                    <hr>
    
                                    <!-- Upload, aksi: hapus, edit -->
                                    <p class="card-text mt-0"><strong>Selang: </strong><?= waktu_berlalu($data->tanggal) ?></p>
                                    <p style="display: flex; justify-content: space-between;">
                                
                                    <?php if ($levelUser == 'Kontributor' && $data->username == $username) { ?>
                                            <strong>
                                                <button class="btn-danger hapus-konten" data-datake="<?= $no ?>" data-hapusid="<?php echo $data->id_konten ?>" data-datakonten="<?php echo 'Data Konten: data ke'.$noKonten++.', ('.$data->tanggal.'), User: '.$data->username.'' ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button>
                                                <span class="fa-2x">/</span>
                                                <button class="btn-warning edit-konten" data-idkonten="<?= $data->id_konten ?>" data-datafotoke="<?php echo $noKonten - 1 ?>" data-dimensifoto="<?php echo $image_konten[0].'x'.$image_konten[1] ?>" style="margin-left: 5px;"><i class="fa fa-pencil fa-2x"></i></button>
                                                <span class="fa-2x">/</span>
                                                <span style="padding: 4px; background-color: grey; border-radius: 3px;"><?= $no ?></span>
                                            </strong>
                                    <?php }else if ($data->username != $username) { ?>
                                        <span>---</span>
                                    <?php } ?>
                                    <?php if ($this->session->userdata('tipe_user') == 'Admin') { ?>
                                            <strong>
                                                <button class="btn-danger hapus-konten" data-datake="<?= $no ?>" data-hapusid="<?php echo $data->id_konten ?>" data-datakonten="<?php echo 'Data Konten: data ke'.$noKonten++.', ('.$data->tanggal.'), User: '.$data->username.'' ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button>
                                                <span class="fa-2x">/</span>
                                                <button class="btn-warning edit-konten" data-idkonten="<?= $data->id_konten ?>" data-datafotoke="<?php echo $noKonten - 1 ?>" data-dimensifoto="<?php echo $image_konten[0].'x'.$image_konten[1] ?>" style="margin-left: 5px;"><i class="fa fa-pencil fa-2x"></i></button>
                                                <span class="fa-2x">/</span>
                                                <span style="padding: 5px; background-color: grey; border-radius: 3px;"><?= $no ?></span>
                                            </strong>
                                    <?php } ?>
                                
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php 
                            }
                        }
                        ?>
                    </div>

                    <hr>

                    <!-- MODAL PREVIEW -->
                    <div class="modal fade" id="keteranganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Keterangan Konten</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="keteranganfoto">

                                    </div>
                                    <div class="keteranganKonten">
                                        
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /MODAL PREVIEW -->

                    <?php
                    $data_Katg = count($kategori);
                    ?>
                    <div style="margin-right: 20px; margin-left: 20px;">
                        <div class="col-md-12">
                            <hr>
                            <div id="aksiEdit" style="display: none;">
                                <h3 class="times-new-roman text-center judulEditKonten"><strong>Ubah data Konten ke </strong></h3>
                                <form action="<?= base_url('Konten/editKonten') ?>" enctype="multipart/form-data" method="post">
                                    <input type="hidden" name="id_konten" id="idEdit">
                                    <div class="form-group">
                                        <label for="judul">Judul Konten: </label>
                                        <input type="text" class="form-control times-new-roman" id="judulEdit" name="judul">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan Konten: </label>
                                        <textarea name="keterangan" class="form-control times-new-roman" id="editorEdit" cols="30" rows="10"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="file">Foto Konten: </label>
                                        <input type="file" class="form-control-file times-new-roman" name="file"><br>
                                        <button type="button" id="fileEdit">Lihat Data Foto sebelumnya <i class="fa fa-image"></i></button>
                                        <input type="hidden" id="dataFoto">
                                    </div>
                                    <div class="form-group">
                                        <label for="status">Kategori Konten: </label>
                                        <select name="kategori" id="kategoriEdit" class="form-control times-new-roman">
                                            <?php foreach ($kategori as $k): ?>
                                                <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                            <?php endforeach; ?>
                                            <?php if ($kategori === NULL || $data_Katg === 0 || $data_Katg > 0){ 
                                                echo '<option value="" selected disabled><span>Anda belum memilih Data Kategori</span></option>';
                                            }?>
                                        </select>
                                    </div>
                                    <button type="button" id="tutupAksiEdit" class="btn btn-tritary">Tutup</button>
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-aksi" style="margin-right: 20px; margin-left: 20px;">
                    <h3 class="times-new-roman text-center"><strong>Form tambah data Konten</strong></h3>
                    <hr style="border-bottom: 2px solid black;">
                    <!-- Form edit pengguna -->
                    <form role="form" action="<?php echo base_url('Konten/tambahKonten') ?>" enctype="multipart/form-data" method="post">
                        <div class="form-group">
                            <label for="judul">Judul Konten: </label>
                            <input type="text" class="form-control times-new-roman" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Konten: </label>
                            <textarea name="keterangan" class="form-control times-new-roman" id="editor" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Foto Konten: </label>
                            <input type="file" id="file" class="form-control-file times-new-roman" name="file">
                            <hr>
                            <div id="modalFoto" class="modal fade" style="display: none;" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
                            <button type="button" id="modalFoto" data-toggle="modal" data-target="#modalFoto">Lihat Foto Unggahan,</button><button id="resetButton" type="button">Reset foto</button><br>
                            <strong><span>Ukuran Gambar: </span></strong><span id="gambarUkuran"></span><br>
                            <strong><span>Lebar Gambar: </span></strong><span id="gambarLebar"></span><br>
                            <strong><span>Tinggi Gambar: </span></strong><span id="gambarTinggi"></span>
                        </div>
                        <div class="form-group">
                        <label for="kategori">Kategori: </label>
                            <select name="kategori" class="form-control times-new-roman">
                                <option value="" selected disabled>~ Pilih tipe Kategori ~</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option value="<?= $k->id_kategori ?>"><?= $k->nama_kategori ?></option>
                                <?php endforeach; ?>
                                <?php if ($kategori === NULL || $data_Katg === 0){ 
                                    echo '<option value="" selected disabled><span>Tidak Ada Data Kategori</span></option>';
                                }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn-primary">Tambahkan Konten <i class="fa fa-plus"></i></button>
                        </div>
                    </form>
                    <!-- form tambah pengguna -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<hr>
<div id="modalKonfirmasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h3 class="modal-title times-new-roman">Konfirmasi aksi,</h3></strong>
            </div>
            <div class="modal-body">
                <p id="title-modal">Anda yakin ingin melanjutkan untuk mengedit data ini?</p>
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

<script type="text/javascript">
    $(window).on('beforeunload', function() {
        localStorage.clear();
    });
    tinymce.init({
        selector: '#editor, #editorEdit',
        placeholder: 'Ketik disini...',
        plugins: 'accordion advlist anchor autolink autorezise autosave charmap code codesample directionality emoticons fullscreen help importcss insertdatetime link lists media nonbreaking pagebreak preview quickbars save searchreplace table template visualblocks visualchars wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        setup: function (editor) {
            editor.on('SaveContent', function (e) {
                // e.content = e.content.replace(/<img[^>]*>/g, '');
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

        $('#modalFoto').click(function() {
            event.preventDefault();
        });

        var fileInput = $('#file');
        var resetButton = $('#resetButton');
        var gambarUkuran = $('#gambarUkuran');
        var gambarLebar = $('#gambarLebar');
        var gambarTinggi = $('#gambarTinggi');

        resetButton.click(function() {
            event.preventDefault();
            fileInput.val('');
            gambarUkuran.text('');
            $('.previewFoto').attr('src', '');
            gambarLebar.text('');
            gambarTinggi.text('');
        });

        $('#file').on('change', function() {
            var input = this;

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    var url = e.target.result;
                    $('.previewFoto').attr('src', url);
                    $('#modalFoto').modal('show');

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

        $('.lihatKeterangan').click(function() {
            let keterangan_id = $(this).data('id');
            $('.keteranganKonten').empty();
            $.ajax({
                url: '<?= base_url('Konten/ambil_data_keterangan/') ?>'+keterangan_id,
                type: 'POST',
                dataType: 'json',
                success: function(data){
                    $('.keteranganKonten').append(data.keterangan);
                    $('.keteranganfoto').empty();
                    $('#keteranganModal').modal('show');
                }, error: function() {
                    alert("Terjadi Kesalahan: Gagal dalam memuat data");
                }
            });
        });

        $('.edit-konten').click(function() {
            let id = $(this).data('idkonten');
            let keteranganFoto = $(this).data('dimensifoto');
            let dataKe = $(this).data('datafotoke');
            let teks = $('.judulEditKonten').text(); 

            let kataKunci = 'ke';
            let posisi = teks.indexOf(kataKunci);
            if (posisi !== -1) {
                var teksBaru = teks.substring(0, posisi + kataKunci.length);
                $('.judulEditKonten').text(''+teksBaru); 
            }
            $.ajax({
                url: '<?= base_url('Konten/ambilDataKontenEdit/') ?>'+id,
                type: 'POST',
                dataType: 'json',
                success: function(data) {
                    $('#idEdit').val(id);
                    $('#judulEdit').val(data.judul);
                    $('.keteranganKonten').html(`<img src="<?= base_url('assets/upload/') ?>`+data.foto+`" alt="foto">`);
                    $('.keteranganfoto').html('<strong>Nama file Foto:</strong> '+data.foto+'<br> <strong>Dimensi Foto:</strong> '+keteranganFoto+' Pixel <p>Data Konten Ke: '+dataKe+'</p>');
                    $('#dataFoto').val(data.foto);
                    localStorage.setItem('dataKe', dataKe);
                    localStorage.setItem('dataDimensiFoto', keteranganFoto);
                    if (data.id_kategori === '0'){
                        $('#kategoriEdit').val('');
                    } else {
                        $('#kategoriEdit').val(data.id_kategori);
                    }
                    console.log(data.id_kategori);
                    $('#aksiEdit').slideDown();
                    $('.judulEditKonten').append("    "+dataKe);
                    tinymce.get('editorEdit').setContent(data.keterangan);
                }, 
                error : function() {
                    alert("Terjadi Kesalahan: Gagal dalam memuat data");
                }
            });
        });

        $(".hapus-konten").on("click", function () {
            event.preventDefault();
            let keterangan = $('#title-modal').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#title-modal').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');
            var dataUser = $(this).data('datakonten');
            var dataId = $(this).data('hapusid')
            $('#dataPengguna').text('Data ke: '+($(this).data('datake') - 1));
            $('#dataPenggunaLog').text(dataUser);

            let result = null;
            const confirmationPromise = new Promise(function (event) {
                $("#confirmButton").click(function () {
                    result = true;
                    event();
                })
                $("#cancelButton").click(function () {
                    result = false;
                    event();
                })
            });

            confirmationPromise.then(function () {
                $("#modalKonfirmasi").modal('hide');

                if (result === true) {
                    window.location.href = "<?= base_url('Konten/hapusKonten/') ?>" + dataId;
                } else if (result === false) {
                    $("#modalKonfirmasi").modal('hide');
                }
            })
        });

        $('#tutupAksiEdit').click(function() {
            $('#aksiEdit').slideUp();
        });

        $(document).on('click', '#fileEdit', function() { // Delegasi
            let data = this;
            let dataKe = $(this).data('datafotoke');
            previewFoto(data);
        });
    });
</script>
