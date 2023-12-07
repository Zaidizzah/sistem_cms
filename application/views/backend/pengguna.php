<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri = $this->uri->segment(1);
?>

<!-- Content Wrapper. Contains page content -->
<style>
    @media (width < 400px) {
    .hapusLog {
        margin-right: -25px;
    }
    }

    @media (width > 400px) {
    .hapusLog {
        margin-right: 25px;
    }
    }

    .hidden{
        display: none;
    }

    .offcanvas {
        position: fixed;
        top: 0;
        right: -500px; 
        width: 500px; 
        height: 100%; 
        background-color: #f0f0f0; 
        transition: right 0.3s ease-in-out;
    }

    .offcanvas-content {
        padding: 35px;
    }

    .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
    }

    .times-new-roman {
      font-family: "Times New Roman", Times, serif;
    }

    .message-container {
    display: flex;
    align-items: center;
    justify-content: center;
    }

    .message-icon {
    margin-left: 5px;
    margin-right: 15px;
    margin-bottom: 5px; 
    }

    .message-text {
    margin-right: 10px;
    margin-left: 10px;
    margin-top: 7px;
    }
</style>
<!-- HTML-CONTENT -->
                <!-- Tab data-data pengguna akan dipanggil jika Admin menginginkannya -->
                <div id="tabUser">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel tabbed-panel">
                                <div class="panel-heading clearfix">
                                    <div class="panel-title pull-left"><strong>Data-data Pengguna.</strong></div>
                                    <div class="pull-right">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-user" data-toggle="tab" aria-expanded="true">Data Pengguna</a></li>
                                            <li class=""><a href="#tab-aksi" data-toggle="tab" aria-expanded="false">Tambah pengguna</a></li>
                                            <li><button aria-expanded="false" aria-hidden="true" id="tutupData">X</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Tab data-data pengguna akan dipanggil jika Admin menginginkannya -->
                    <!-- Tab Content -->
                    <div class="row">
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
                        <div class="col-md-12">    
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab-user">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Data-data pengguna
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                <div>
                                                    <select id="item-per-halaman">
                                                        <option value="5">5</option>
                                                        <option value="7">7</option>
                                                        <option value="10">10</option>
                                                        <option value="14">14</option>
                                                        <option value="17">17</option>
                                                        <option value="24">24</option>
                                                    </select>
                                                </div>
                                                <div class="input-group custom-search-form">
                                                        <input type="text" class="form-control search-input" data-tabel="tabel1" placeholder="Cari data terkait...">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-primary" type="button">
                                                            <i class="fa fa-search"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-striped no-footer paginasi-tabel" data-item-per-halaman="7" data-nama-tabel="tabel1" id="DataPengguna" role="grid">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Username</th>
                                                                    <th>Nama</th>
                                                                    <th>Password</th>
                                                                    <th>Tipe</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="pesan-nda-ada">
                                                                <?php
                                                                $no = 1;
                                                                foreach ($dataUser as $data) :
                                                                ?>
                                                                <tr class="data-row">
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $data['username'] ?></td>
                                                                    <td><?= $data['nama'] ?></td>
                                                                    <td><?= '---' ?></td>
                                                                    <td><?= $data['level'] ?></td>
                                                                    <td>
                                                                        <strong><button class="btn-danger hapus-user" data-hapusid="<?php echo $data['id_user'] ?>" data-dataUser="<?php echo 'User: '.$data['username'].', Role: '.$data['level'].'' ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button><span class="fa-2x">/</span><button class="btn-warning edit-user" data-editid="<?php echo $data['id_user'] ?>" data-datanama="<?= $data['username'] ?>" style="margin-left: 5px;"><i class="fa fa-pencil fa-2x"></i></button></strong>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach; ?>
                                                                <?php if (count($dataUser) === 0) : ?>
                                                                    <tr>
                                                                        <td colspan="12" class="text-center text-danger" style="padding-top: 50px; padding-bottom: 50px;">
                                                                        Tidak ada data-data pengguna.
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.table-responsive -->
                                                    <div class="panel-footer prev-next-container" data-tabel-target="tabel1">
                                                        <div class="row border-bottom" style="margin-bottom: 5px;">
                                                            <div class="col-md-4">
                                                                <nav aria-label="Page navigation">
                                                                    <ul class="pagination">
                                                                        <?php if (count($dataUser) > 7) : ?>
                                                                            <li class="page-item prev"><button class="page-link" id="prev"><< Previous</button></li>
                                                                        <?php endif; ?>
                                                                        <ul class="pagination-container pagination">
                                                                        </ul>
                                                                        <?php if (count($dataUser) > 7) : ?>
                                                                            <li class="page-item next"><button class="page-link" id="next">Next >></button></li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p id="" class="text-center keteranganHal"></p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p class="text-center"><?php if (count($dataUser) == 0){ echo "Tidak ada data pengguna";} else { echo "Ada total ". count($dataUser) ." data pengguna";} ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-aksi">
                                    <h3 class="times-new-roman text-center"><strong>Form tambah data pengguna</strong></h3>
                                    <hr style="border-bottom: 2px solid black;">
                                    <!-- Form edit pengguna -->
                                    <form role="form" action="<?php echo base_url('User/Tambah_user') ?>" method="post">
                                        <div class="form-group">
                                            <label for="username">Username: </label>
                                            <input type="text" class="form-control times-new-roman" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label for="nama">Nama: </label>
                                            <input type="text" class="form-control times-new-roman" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password: </label>
                                            <input type="text" class="form-control times-new-roman" maxlength="12" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_user">Tipe: </label>
                                            <select name="tipe_user" class="form-control times-new-roman">
                                                <option value="" selected disabled>~ Pilih tipe pengguna ~</option>
                                                <option value="Admin">Admin</option>
                                                <option value="Kontributor">Kontributor</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="form-control btn-primary">tambah Pengguna <i class="fa fa-plus"></i></button>
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
                                <p>Anda yakin ingin melanjutkan untuk menghapus data ini?</p>
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

                <div class="offcanvas" id="myOffcanvas" style="z-index: 9999;" data-backdrop="static" data-keyboard="false">
                    <div class="offcanvas-content">
                        <hr class="my-5">
                        <h3 style="margin-top: 60px; text-transform: capitalize;" class="times-new-roman text-center dataNama"><strong>Edit data Pengguna: User</strong></h3>
                        <hr style="border-bottom: 2px solid black;">
                        <!-- Form edit pengguna -->
                        <form role="form" action="<?php echo base_url('User/editData') ?>" method="post">
                            <input type="hidden" name="id_user" id="id_userEdit">
                            <div class="form-group">
                                <label for="username">Username: </label>
                                <input type="text" class="form-control times-new-roman" name="username" id="usernameEdit">
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama: </label>
                                <input type="text" class="form-control times-new-roman" name="nama" id="namaEdit">
                            </div>
                            <div class="form-group">
                                <label for="username">Tipe: </label>
                                <select name="tipe_user" id="tipe_userEdit" class="form-control times-new-roman">
                                    
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn-default">Ubah</button>
                            </div>
                            <div class="form-group">
                                <button type="button" class="form-control close" id="closeOffcanvas" aria-hidden="true">Tutup Tab Edit <i class="fa fa-sign-out fa-fw"></i></button>
                            </div>
                        </form>
                        <!-- form edit pengguna -->
                    </div>
                </div>

                <div id="logUser" style="z-index: 1;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel tabbed-panel">
                                <div class="panel-heading clearfix">
                                    <div class="panel-title pull-left"><strong>Data-data Aktivitas Login.</strong></div>
                                    <div class="pull-right">
                                        <ul class="nav nav-tabs">
                                            <li class="tab1 active"><a href="#tab-Loguser" data-toggle="tab" aria-expanded="true">Data aktivitas</a></li>
                                            <li class="tab2"><a href="javascript:void(0)" data-toggle="tab" id="hapusLogUser" aria-expanded="true" aria-hidden="true">hapus aktivitas ++</a></li>
                                            <li><button aria-expanded="false" aria-hidden="true" id="tutupLogData">X</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">    
                            <div class="tab-content">
                                <div class="tab-pane fade active in" id="tab-Loguser">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    Data-data aktivitas Login pengguna
                                                </div>
                                                <!-- /.panel-heading -->
                                                <div class="panel-body">
                                                    <div>
                                                        <select id="item-per-halaman">
                                                            <option value="5">5</option>
                                                            <option value="7">7</option>
                                                            <option value="10">10</option>
                                                            <option value="14">14</option>
                                                            <option value="17">17</option>
                                                            <option value="24">24</option>
                                                        </select>
                                                    </div>
                                                    <div class="input-group custom-search-form">
                                                            <input type="text" class="form-control search-input" data-tabel="tabel2" placeholder="Cari data terkait...">
                                                        <span class="input-group-btn">
                                                            <span class="btn btn-primary" type="button">
                                                                <i class="fa fa-search"></i>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-striped no-footer paginasi-tabel" data-item-per-halaman="10" data-nama-tabel="tabel2" role="grid">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Username/Pengguna</th>
                                                                    <th>Waktu</th>
                                                                    <th>Aktivitas</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="pesan-nda-ada">
                                                                <?php
                                                                $no = 1;
                                                                foreach ($logUser as $data) :
                                                                    ?>
                                                                <tr class="data-row">
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $data['pengguna'] ?></td>
                                                                    <td><?= tanggal_indonesia($data['tanggal']) ?></td>
                                                                    <td <?php if ($data['aktivitas'] === 'Telah melakukan Login') echo 'class="text-success"'; else echo 'class="text-danger"' ?>><?= $data['aktivitas'] ?></td>
                                                                    <form id="dataLogUser" action="<?php echo base_url('User/multipleLogDataHapus') ?>" method="post">
                                                                    <td>
                                                                        <strong><button class="btn-danger hapus-logUser" data-hapuslogid="<?php echo $data['id_log'] ?>" data-dataloguser="<?php echo 'Data: '.$data['pengguna'].''?>" data-datawaktu="<?php echo tanggal_indonesia($data['tanggal']) ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button><span class="fa-2x pembatas" style="display: none;">/</span>
                                                                        <input type="checkbox" class="hapus-checkbox" style="display: none;" name="data_log[]" value="<?php echo $data['id_log']; ?>" data-datanamalog="<?= $data['pengguna'] ?>" data-datawaktu="<?php echo tanggal_indonesia($data['tanggal']) ?>">
                                                                        <!-- Konten elemen cekbox -->
                                                                    </td>   
                                                                </tr>
                                                                <?php endforeach; ?>
                                                                <?php if (count($logUser) === 0) : ?>
                                                                    <tr>
                                                                        <td colspan="12" class="text-center text-danger" style="padding-top: 50px; padding-bottom: 50px;">
                                                                        Tidak ada data aktivitas pengguna.
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                            <tfoot id="button-hapus" style="display: none;">
                                                                <tr>
                                                                    <td colspan="12" class="submitBanyakLog"><div class="panel-heading clearfix"><div class="panel-tittle pull-left">check dan tekan button hapus+, untuk menghapus lebih dari 1 data: <i class=" fa fa-arrow-right"></i></div><div class="pull-right hapusLog"><button class="btn-danger" id="hapusBanyakDataLog" type="submit"><i class="fa fa-trash fa-2x"></i> <i class="fa fa-plus"></i></button></div></div></td>
                                                                </tr>
                                                            </tfoot>
                                                            </form>
                                                        </table>
                                                    </div>
                                                    <div class="panel-footer prev-next-container" data-tabel-target="tabel2">
                                                        <div class="row border-bottom" style="margin-bottom: 5px;">
                                                            <div class="col-md-4">
                                                                <nav aria-label="Page navigation">
                                                                    <ul class="pagination">
                                                                        <?php if (count($logUser) > 10) : ?>
                                                                            <li class="page-item prev"><button class="page-link" id="prev"><< Previous</button></li>
                                                                        <?php endif; ?>
                                                                        <ul class="pagination-container pagination">
                                                                        </ul>
                                                                        <?php if (count($logUser) > 10) : ?>
                                                                            <li class="page-item next"><button class="page-link" id="next">Next >></button></li>
                                                                        <?php endif; ?>
                                                                    </ul>
                                                                </nav>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4 text-center" id="dataTerpilih">
                                                                
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p id="" class="text-center keteranganHal"></p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <p class="text-center"><?php if (count($logUser) == 0){ echo "Tidak ada data aktivitas";} else { echo "Ada total ". count($logUser) ." data aktivitas";} ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- konten selanjtunya -->
                <div style="margin-top: 35px; padding-top: 50px;"></div>

                <!-- Javascript/JQuery -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
                <script type="text/javascript">
                    $(document).ready(function(){
                        // Ssembunyikan Element
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
                        setTimeout(sembunyikanElement, 7500);
                        // lihat data-data pengguna
                        // Lihat data-data pengguna
                        // Lihat data aktivitas pengguna
                        $('#tutupLogData').on('click', function() {
                            localStorage.setItem('tampilanDataLog', 'false');
                            localStorage.removeItem('buttonHapus');
                            $('.tab2').removeClass('active');
                            $('.tab1').addClass('active');
                            $('.pembatas').hide();
                            $('.hapus-checkbox').hide();
                            $('.submitBanyakLog').hide();
                        })
                        // Lihat data aktivitas pengguna

                        // Edit User
                        $('.edit-user').on('click', function() {
                            var id = $(this).data('editid');
                            $('.dataNama').text("Edit data Pengguna: User");

                            var dataPengguna = $(this).data('datanama');
                            var dataNama = $(".dataNama").text();
                            var dataNamaBaru = dataNama.replace("User", dataPengguna);

                            $('.dataNama').text(dataNamaBaru);
                            editUser(id);
                        });
                        // Batas Edit user

                        // Batas hapus log user lebih dari 1 data
                        const elementTampil = localStorage.getItem('buttonHapus') === 'ada';
                        if (elementTampil){
                            $('#button-hapus').show();
                        } else {
                            $('#button-hapus').hide();
                        }
                        const checkTampil = localStorage.getItem('checkbox') === 'ada';
                        var elemenSudahDitambahkan = false;
                        if (checkTampil){
                            $('.hapus-checkbox').show();
                            $('.pembatas').show();
                            $('.submitBanyakLog').show();
                        } else {
                            $('.hapus-checkbox').hide();
                            $('.submitBanyakLog').hide();
                        }
                        $('#hapusLogUser').on('click', function() {
                            $('#button-hapus').fadeIn();
                            $('.hapus-checkbox').show();
                            $('.submitBanyakLog').show();
                            localStorage.setItem('buttonHapus', 'ada');
                            localStorage.setItem('checkbox', 'ada');
                            $('.pembatas').show();
                        });
                        // Batas hapus log user lebih dari 1 data

                        // Function-function

                        // buka canvas
                        function openOffcanvas() {
                            $("#myOffcanvas").css("right", "0");
                        }

                        // tutup canvas
                        $('#closeOffcanvas').click(function(){
                            closeOffcanvas();
                        });
                        function closeOffcanvas() {
                            $("#myOffcanvas").css("right", "-500px"); 
                            $('.dataNama').text('Edit data pengguna: User');
                        }

                        function editUser(id) {
                            $.ajax({
                                url: '<?= site_url('User/UserDataEdit/'); ?>' + id,
                                method: 'POST',
                                success: function(data) {
                                    data = JSON.parse(data);

                                    $("#id_userEdit").val(data.id_user);
                                    $("#usernameEdit").val(data.username);
                                    $("#namaEdit").val(data.nama);
                                    // $("#tipe_userEdit").val(data.level);
                                    var selectOptions = '<option value="Kontributor">Kontributor</option><option value="Admin">Admin</option>';
                                    $("#tipe_userEdit").html(selectOptions);
                                    $("#tipe_userEdit").val(data.level);
                                    openOffcanvas();
                                },
                                error: function() {
                                    alert("terjadi kesalahan penanganan :), mohon kesabarannya.");
                                }
                            });
                        }

                        //Konfirmasi Hapus data
                        let result = null;
                        $(".hapus-user").click(function () {
                            $("#modalKonfirmasi").modal('show');
                            var dataUser = $(this).data('datauser');
                            $('#dataPengguna').text(dataUser);
                            var id = $(this).data('hapusid');

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
                                    window.location.href = "<?= base_url('user/userDataHapus/') ?>" + id;
                                } else if (result === false) {
                                    // Tidak ada kelakuan
                                    $('#dataPengguna').text('');
                                } else {
                                    alert('Maaf terjadi kesalahan!');
                                }
                                result = null;
                            });
                        });
                        // Konfirmasi Hapus data

                        // konfirmasi hapus data aktivitas user
                        $(".hapus-logUser").click(function () {
                            event.preventDefault();
                            $("#modalKonfirmasi").modal('show');
                            var dataUser = $(this).data('dataloguser');
                            var waktuLog = $(this).data('datawaktu');
                            $('#dataPengguna').text(dataUser+", " + waktuLog);
                            var id = $(this).data('hapuslogid');
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
                                    window.location.href = "<?= base_url('user/userLogDataHapus/') ?>" + id;
                                } else if (result === false) {
                                    $('#dataPengguna').text('');
                                } else {
                                    alert('Maaf terjadi kesalahan!');
                                }
                                result = null;
                            });
                        });
                        // konfirmasi hapus data aktivitas user

                        $('#hapusBanyakDataLog').on('click', function() {
                            event.preventDefault();
                            var jumlahTerpilih = $('.hapus-checkbox:checked').length;
                            $("#modalKonfirmasi").modal('show');
                            $('#dataPengguna').text("jumlah data aktivitas yang terpilih: "+jumlahTerpilih);
                            // $('#dataPenggunaLog').text("");
                            $('#dataPenggunaLog').empty();
                            var dataTerpilih = [];
                            $('.hapus-checkbox:checked').each(function(i) {
                                var nilai = $(this).data('datanamalog'); 
                                var waktu = $(this).data('datawaktu');
                                dataTerpilih.push({
                                    indeks: i + 1,
                                    nilai: nilai,
                                    waktu: waktu
                                });
                                // console.log(dataTerpilih);
                            });
                            var hasil = dataTerpilih.map(function(item) {
                                return "Data ke " + item.indeks + ": " + item.nilai + ": " + item.waktu;
                            });
                            if (dataTerpilih.length > 0) {
                                $('#dataPenggunaLog').html("<p class='text-success'>Data Aktivitas yang dipilih: " + hasil.join(', ') + "</p>");
                            } else {
                                $('#dataPenggunaLog').html('<p class="text-danger">Mohon pilih data  yang akan dihapus terlebih dahulu,</p>');
                            }
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
                                    $('#dataLogUser').submit();
                                } else if (result === false) {
                                    $('#dataPengguna').text('');
                                } else {
                                    alert('Maaf terjadi kesalahan!');
                                }
                                result = null;
                            });
                        });

                        // Membuat Paginasi 
                        function jumlahChek(){
                            var jumlahTerpilih = $('.hapus-checkbox:checked').length;
                            if (jumlahTerpilih === 0){
                                $('#dataTerpilih').text("");
                                $('#dataTerpilih').html("Tidak ada data yang dipilih");
                            } else {
                                $('#dataTerpilih').text("");
                                $('#dataTerpilih').html("<b>" + jumlahTerpilih +"</b> data yang anda pilih");
                            }
                        }
                        jumlahChek();
                        $('.hapus-checkbox').change(function() {
                            jumlahChek();
                        });
                        var statusPencarian = {};
                        
                        function initializePagination() {
                            $('.paginasi-tabel').each(function() {
                                var table = $(this);
                                var itemsPerPage = table.data('item-per-halaman');
                                var tableName = table.data('nama-tabel');
                                var CPage = 0;

                                var container = $('.prev-next-container[data-tabel-target="' + tableName + '"]');
                                var prevBtn = container.find('.prev');
                                var nextBtn = container.find('.next');
                                var keteranganHal = container.find('.keteranganHal');

                                function showPage(page) {
                                    var semuaBaris = table.find('.data-row');
                                    var start = page * itemsPerPage;
                                    var end = start + itemsPerPage;
                                    semuaBaris.addClass('hidden');
                                    // console.log(statusPencarian[tableName]);
                                    for (var i = start; i < end; i++) {
                                        semuaBaris.eq(i).removeClass('hidden');
                                    }

                                    if (semuaBaris.filter(':visible').length == 0 && !statusPencarian[tableName]) {
                                        if (!pesanYangDitampilkan) {
                                            table.find('.pesan-nda-ada').append('<tr class="no-data"><td class="text-center text-danger" colspan="6">Data yang Anda cari tidak ditemukan.</td></tr>');
                                            statusPencarian[tableName] = true;
                                        }
                                    } else if (semuaBaris.filter(':visible').length > 0 && statusPencarian[tableName]) {
                                        table.find('.no-data').remove();
                                        statusPencarian[tableName] = false;
                                    }
                                }

                                prevBtn.hide();
                                prevBtn.click(function() {
                                    if (CPage > 0) {
                                        CPage--;
                                        showPage(CPage);
                                    }
                                    if (CPage === 0) {
                                        prevBtn.hide();
                                    }
                                    nextBtn.show();
                                    updateKeteranganHalaman(CPage, tableName);
                                });

                                nextBtn.click(function() {
                                    var totalRows = table.find('.data-row').length;
                                    var totalPages = Math.ceil(totalRows / itemsPerPage);
                                    if (CPage < totalPages - 1) {
                                        CPage++;
                                        showPage(CPage);
                                        if (CPage === totalPages - 1) {
                                            nextBtn.hide();
                                        }
                                        if (CPage > 0) {
                                            prevBtn.show();
                                        }
                                    }
                                    updateKeteranganHalaman(CPage, tableName);
                                });
                                
                                // var totalRows = table.find('.data-row').length;
                                // var totalPages = Math.ceil(totalRows / itemsPerPage);
                                // var paginasiContiner = $('.pagination-container');
                                // paginasiContiner.empty();
                                // console.log(totalPages);
                                
                                // if (totalPages == 1){
                                //     // tidak ada link paginasi
                                // } else if (totalPages > 1) {
                                //     for (var i = 1; i <= totalPages; i++) {
                                //         var pageLink = $('<li class="page-item"><button class="page-link" data-page="' + i + '">' + i + '</button></li>');
                                //         paginasiContiner.append(pageLink);
                                //         if (i === 2 && totalPages > 5) {
                                //             var ellipsis2 = $('<span class="ellipsis">...</span>');
                                //             paginasiContiner.append(ellipsis2);
                                //             i = totalPages - 2; 
                                //         }
                                        
                                //         var linkPaginasi = paginasiContiner.find('.page-link');
                                //         linkPaginasi.click(function() {
                                //             var page = $(this).data('page') - 1; 
                                //             CPage = page;
                                //             showPage(CPage);
                                //             updateKeteranganHalaman(CPage, tableName);
                                //         });
                                //     }
                                // }
                                
                                showPage(CPage);
                                updateKeteranganHalaman(CPage, tableName);
                            });
                        }
                        

                        function updateKeteranganHalaman(CPage, tableName) {
                            var container = $('.prev-next-container[data-tabel-target="' + tableName + '"]');
                            var keteranganHal = container.find('.keteranganHal');
                            var table = $('.paginasi-tabel[data-nama-tabel="' + tableName + '"]');
                            var totalRows = table.find('.data-row').length;
                            var itemsPerPage = table.data('item-per-halaman');
                            var totalPages = Math.ceil(totalRows / itemsPerPage);
                            var pesanKeterangan = "";

                            if (totalPages === 0) {
                                pesanKeterangan = "Anda berada di Halaman <strong>Pertama</strong> dari 1 halaman";
                            } else if (CPage === 0) {
                                pesanKeterangan = "Anda berada di Halaman <strong>Pertama</strong> dari " + totalPages + " halaman";
                            } else if (CPage === totalPages - 1) {
                                pesanKeterangan = "Anda berada di Halaman <strong>Terakhir</strong> dari " + totalPages + " halaman";
                            } else {
                                pesanKeterangan = "Anda berada di Halaman <strong>" + (CPage + 1) + "</strong> dari " + totalPages + " halaman";
                            }
                            keteranganHal.html(pesanKeterangan);
                        }

                        initializePagination();

                        // fitur pencarian data
                        $('.search-input').on('input', function() {
                            var query = $(this).val().toLowerCase();
                            var tableName = $(this).data('tabel');
                            var table = $('.paginasi-tabel[data-nama-tabel="' + tableName + '"]');
                            var rows = table.find('.data-row');
                            table.find('.no-data').remove();
                            rows.each(function() {
                                var rowData = $(this).text().toLowerCase();
                                if (rowData.includes(query)) {
                                    $(this).show();
                                } else {
                                    $(this).hide();
                                }
                            });

                            if (rows.filter(':visible').length === 0) {
                                statusPencarian[tableName] = true;
                                table.find('.pesan-nda-ada').append('<tr class="no-data"><strong><td class="text-center text-danger" colspan="12">Data yang Anda cari tidak ditemukan.</td></strong></tr>');
                            }
                        });
                        // Membuat Paginasi 
                    });
                </script>
<!-- HTML_END_CONTENT -->