<style>
    th{
        text-align: center;
    }
    .h1-komentar{
        border: 1px solid black;
        padding-left: 10px;
        border-radius: 5px;
        color: #000;
        background-color: #edede9;
    }
</style>
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
    <div class="col-md-12">
        <h1 class="h1-komentar"><i class="fa fa-caret-right"></i> Komentar </h1>
        <div class="table-responsive">
            <table style="width: 100%;" border="1px" class="table table-striped table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Keterangan</th>
                        <th>Balas</th>
                        <th>Membalas</th>
                        <th>Waktu Komentar</th>
                        <th>Blocked</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($komentar)):
                        $no = 0;
                        foreach ($komentar as $kmr) :
                            if (strpos($kmr->nama_pengguna, "<i") !== false) {
                                $dataPengguna_berkomentar = explode("<", $kmr->nama_pengguna);
                                $dataPengguna_berkomentar = trim($dataPengguna_berkomentar[0]);
                            }
                            $data_nama_pengguna = $this->db->select('konten.username, komentar.id_konten')
                                                            ->from('komentar')
                                                            ->join('konten', 'komentar.id_konten = konten.id_konten')
                                                            ->where('konten.id_konten', $kmr->id_konten)
                                                            ->get()->row()->username;
                        ?>
                    <tr>
                        <td><?= ++$no ?></td>
                        <td><?= ucfirst($kmr->nama_pengguna) ?></td>
                        <td><?php if ($kmr->email == null){echo "---";}else{echo $kmr->email;} ?></td>
                        <td><?= $kmr->keterangan ?></td>
                        <td><?php if ($kmr->parent_id == 0){
                            if ($data_nama_pengguna == $this->session->userdata('username')) { echo "Mengomentari konten Anda.";} else {echo "Mengomentari konten ".$data_nama_pengguna.".";}}else{echo "Membalas ".ucfirst($kmr->membalas);} ?></td>
                        <td><?php echo "Membalas konten dengan judul: <span style='background-color: #ffb703; padding: 5px; border-radius: 4px;'>".$kmr->judul."</span>" ?></td>
                        <td><?= tanggal_indonesia($kmr->waktu) ?></td>
                        <td><?php if ($kmr->blocked == '0'){echo "---";}else{echo "<span style='color: #e63946;'>blocked <i class='fa fa-ban'></i></span>";} ?></td>
                        <td>
                            <button style="color: #e63946;" title="Hapus komentar ini." class="hapus-komentar" data-ke="<?= $no ?>" data-pengguna="<?php if (strpos($kmr->nama_pengguna, "<") !== false){echo $dataPengguna_berkomentar;}else{echo $kmr->nama_pengguna;} ?>" data-id-komentar="<?= $kmr->id_komentar ?>"><i class="fa fa-trash fa-2x"></i></button>
                            <span><strong>/</strong></span>
                            <button style="color: #ffb703;" title="Balas komentar ini." class="btn-balas"
                                data-id-konten="<?= $kmr->id_konten ?>" data-id-komentar="<?= $kmr->id_komentar ?>" data-nama-pengguna="<?php if (strpos($kmr->nama_pengguna, "<") !== false){echo $dataPengguna_berkomentar;}else{echo $kmr->nama_pengguna;} ?>"><i class="fa fa-reply fa-2x"></i>
                            </button>
                            <span><strong>/</strong></span>
                            <button title="Blok komentar yang tidak pantas." class="btn-block" data-block="<?= $kmr->blocked ?>" data-pengguna='<?php if (strpos($kmr->nama_pengguna, "<") !== false){echo $dataPengguna_berkomentar;}else{echo $kmr->nama_pengguna;} ?>' data-id-komentar="<?= $kmr->id_komentar ?>" data-ke="<?= $no ?>"><i class="fa fa-ban fa-2x"></i></button>
                        </td>
                    </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<hr>
<div class="row" id="form-balas" style="display: none;">
    <div class="col-md-12">
        <form action="<?= base_url('frontend/komentar/membalas_komentar') ?>" method="post">
            <input type="hidden" name="id_komentar" value="">
            <input type="hidden" name="id_konten" value="">
            <div class="form-group">
                <label>Membalas</label>
                <input type="text" class="form-control" name="membalas" id="membalas" readonly>
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea type="text" id="keterangan" class="form-control" name="keterangan"></textarea>
                <p class="char-count" style="color: #666; font-size: 12px;">Sisa karakter: 1000</p>
            </div>
            <button type="submit" class="btn btn-primary">Balas <i class="fa fa-reply"></i></button> <button type="reset" id="batal-membalas" class="btn btn-warning">Batal <i class="fa fa-times"></i></button>
        </form>
    </div>
</div>

<div id="modalKonfirmasi" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <strong><h3 class="modal-title times-new-roman">Konfirmasi aksi,</h3></strong>
            </div>
            <div class="modal-body">
                <p id="judul-konfirmasi">Anda yakin ingin melanjutkan untuk mengedit data ini?</p>
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

<div class="row">
    <div class="col-md-12">
        <hr style="border: 2px solid #edede9;">
    </div>
</div>

<script>
    $(document).ready(function(){
        let maxChars = 1000;
    
        $('#keterangan').on('input', function () {
            let ketikkan = maxChars - $(this).val().length;
            if (ketikkan < 0) {
                $(this).val($(this).val().substr(0, maxChars));
            } else {
                $('.char-count').text('Sisa karakter: ' + ketikkan);
            }
        });
    
        $('.btn-balas').on('click', function() {
            membalas();
            let dataIdKomentar = $(this).data('id-komentar');
            let dataIdKonten = $(this).data('id-konten');
            let dataNamaPengguna = $(this).data('nama-pengguna');
    
            $('input[name="id_komentar"]').val(dataIdKomentar);
            $('input[name="id_konten"]').val(dataIdKonten);
            $('#membalas').val(dataNamaPengguna);
            $('#form-balas').slideDown(
                function(){
                    $('#form-balas').get(0).scrollIntoView({ behavior: 'smooth', block: 'end' });
                }
            );
        });
    
        function membalas(){
            $('input[name="id_komentar"]').val('');
            $('input[name="id_konten"]').val('');
            $('#membalas').val('');
        }
    
        $('#batal-membalas').on('click', function() {
            membalas();
            $('#form-balas').slideUp();
        });
    
        $(".hapus-komentar").on("click", function () {
            event.preventDefault();
            let keterangan = $('#judul-konfirmasi').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#judul-konfirmasi').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');

            let dataUser = $(this).data('pengguna');
            let dataId = $(this).data('id-komentar');
            $('#dataPengguna').text('Data komentar ke: '+$(this).data('ke'));
            $('#dataPenggunaLog').text('Nama pengguna berkomentar: '+dataUser);
    
            let result = null;
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
                    window.location.href = "<?= base_url('frontend/komentar/hapus_komentar/') ?>" + dataId;
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

        $('.btn-block').on('click', function(){
            event.preventDefault();
            let dataIdKomentar = $(this).data('id-komentar');
            let dataUser = $(this).data('pengguna');
            let btn_block = $(this).data('block');

            let keterangan = $('#judul-konfirmasi').text();
            let keteranganBaru = '';
            if (btn_block != 1){
                if (keterangan.includes('men-unblock')) {
                    keteranganBaru = keterangan.replace('men-unblock', 'memblock');
                } else if (keterangan.includes('memblock')){
                    keteranganBaru = keterangan.replace('memblock', 'memblock');
                } else {
                    keteranganBaru = keterangan.replace('mengedit', 'memblock');
                }
            } else {
                if (keterangan.includes('meengedit')){
                    keteranganBaru = keterangan.replace('mengedit', 'men-unblock');
                } else if (keterangan.includes('memblock')){
                    keteranganBaru = keterangan.replace('memblock', 'men-unblock');
                } else {
                    keteranganBaru = 'Anda yakin ingin melanjutkan untuk men-unblock data ini?';
                }
            }
            $('#judul-konfirmasi').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');

            $('#dataPengguna').text('Data komentar ke: '+$(this).data('ke'));
            $('#dataPenggunaLog').text('Nama pengguna berkomentar: '+dataUser);

            let result = null;
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
                    if (btn_block != 1){
                        window.location.href = "<?= base_url('frontend/komentar/block_komentar/') ?>" + dataIdKomentar;
                    } else {
                        window.location.href = "<?= base_url('frontend/komentar/unblock_komentar/') ?>" + dataIdKomentar;
                    }
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });

        })
    });
</script>

