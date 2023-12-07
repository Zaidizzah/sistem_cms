<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<style>
    .times-new-roman {
        font-family: "Times New Roman", Times, serif;
    }

    body {
        margin: 0;
        padding: 0;
        z-index: 1;
    }

    .offcanvas {
        position: fixed;
        top: 0;
        bottom: 0;
        right: -300px;
        padding: 50px;
        background-color: #fff;
        transition: right 0.3s ease;
        box-shadow: 0px -5px 10px rgba(0, 0, 0, 0.2);
        z-index: 999 !important;
    }

    .offcanvas-content {
        text-align: center;
    }

    button#batalKategori {
        background-color: #ccc;
        margin-top: 20px;
    }

    button#simpanKategori {
        background-color: #007BFF;
        color: #fff;
        margin-top: 10px;
    }
</style>
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
    <?php if ($this->session->userdata('tipe_user') == 'Admin') :?>
        <div class="col-md-12" style="margin-bottom: 15px;">
            <div>
                <div class="row times-new-roman">
                    <div class="col-lg-12" style="padding-bottom: 45px;">
                        <h3 class="times-new-roman text-center"><strong>Data-data Kategori</strong></h3>
                        <hr style="border-bottom: 2px solid black;">
                        <div id="modalTambahKategori" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <strong><h3 class="modal-title times-new-roman">Tambah Data Kategori Baru,</h3></strong>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tambah Data Kategori baru untuk digunakan,</p>
                                        <form role="form" method="post" action="<?= base_url('Kategori/tambahKategori') ?>">
                                            <div class="form-group">
                                                <label for="kategori">Kategori: </label>
                                                <input type="text" class="form-control times-new-roman" name="kategori">
                                            </div>
                                        </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Ya <i class="fa fa-check"></i></button>
                                    </form>
                                        <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Batal <i>X</i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="form-control btn btn-primary" data-toggle="modal" data-target="#modalTambahKategori">Tambah Kategori Baru <i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            Data-data Kategori Konten
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped no-footer paginasi-tabel" data-item-per-halaman="8" data-nama-tabel="tabel2" role="grid">
                        <thead>
                            <tr class="pull-right">
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
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Digunakan</th>
                                <th>Menggunakan</th>
                                <?php if ($this->session->userdata('tipe_user') == 'Admin') :?> 
                                    <th class="text-right" style="padding-right: 35px;">Aksi Edit</th>
                                    <th class="text-right" style="padding-right: 35px;">Aksi Hapus</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="pesan-nda-ada">
                            <?php
                            $no = 1;
                            foreach ($kategori as $data) :
                            ?>
                            <tr class="data-row">
                                <td><?= $no++ ?></td>
                                <td><?= ucfirst($data['nama_kategori']) ?></td>
                                <?php if ($data['digunakan'] === '' || $data['digunakan'] === NULL || $data['digunakan'] <= '0') { ?>
                                    <td>Tidak ada Konten yang menggunakan</td>
                                <?php } else { ?>
                                    <td><?= $data['digunakan'] ?> Konten menggunakan kategori ini</td>
                                <?php } ?>

                                <td><?php
                                $dataBerdasarkanUser = $this->db->where('id_kategori', $data['id_kategori'])->where('username', $this->session->userdata('username'))->get('konten');
                                $jumlahKategoriDigunakan = $dataBerdasarkanUser->num_rows();
                                if ($jumlahKategoriDigunakan > 0){
                                    echo "".$jumlahKategoriDigunakan." Konten Anda telah menggunakannya.";
                                } else {
                                    echo "Tidak ada konten Anda yang menggunakan kategori ini.";
                                }
                                ?>
                                </td>
                                <form id="dataKategori" action="<?php echo base_url('kategori/hapusBanyakKategori') ?>" method="post">
                                <?php if ($this->session->userdata('tipe_user') == 'Admin') :?>
                                    <td class="text-right" style="padding-right: 25px;"><strong><button type="button" class="btn-warning editKategori" data-datakategori="<?php echo $data['nama_kategori']?>" data-idkategori="<?php echo $data['id_kategori']?>" style="margin-right: 5px;"><i class="fa fa-edit fa-2x"></i></button></td>
                                    <td class="text-right" style="padding-right: 25px;">
                                        <input type="checkbox" class="hapus-checkbox" name="idKategori[]" value="<?php echo $data['id_kategori']; ?>" data-datakategori="<?= $data['nama_kategori'] ?>"><span class="fa-2x pembatas">/</span>
                                        <strong><button type="button" class="btn-danger hapusKategori" data-hapuskategoriid="<?php echo $data['id_kategori'] ?>" data-datakategori="<?php echo 'Data Kategori: '.$data['nama_kategori'].''?>" data-penggunaandata="<?= $data['digunakan'] ?> Konten telah menggunakan kategori ini" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button>
                                        <!-- Konten elemen cekbox -->
                                    </td>   
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                            <?php if (count($kategori) === 0) : ?>
                                <tr>
                                    <td colspan="12" class="text-center text-danger" style="padding-top: 50px; padding-bottom: 50px;">
                                    Tidak ada data-data Kategori konten.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <?php if($this->session->userdata('tipe_user') == 'Admin') { ?>
                                    <td colspan="12" class="submitBanyakLog"><div class="panel-heading clearfix"><div class="panel-tittle pull-left"><b>Pilih dan tekan button hapus+, untuk menghapus lebih dari 1 data: </b><i class=" fa fa-arrow-right"></i></div><div class="pull-right hapusLog"><button class="btn-danger" id="hapusBanyakDataKategori" type="submit"><i class="fa fa-trash fa-2x"></i> <i class="fa fa-plus"></i></button></div></div></td>
                                <?php } ?>
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
                                    <?php if (count($kategori) > 8) : ?>
                                        <li class="page-item prev"><button class="page-link" id="prev"><< Previous</button></li>
                                    <?php endif; ?>
                                    <?php if (count($kategori) > 8) : ?>
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
                            <p class="text-center"><?php if (count($kategori) == 0){ echo "Tidak ada data Kategori";} else { echo "Ada total ". count($kategori) ." data Kategori";} ?></p>
                        </div>
                    </div>
                </div>
            </div>
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
                <p id="keteranganKategori">Anda yakin ingin melanjutkan untuk menghapus data ini?</p>
                <strong><p id="dataKategoriDulu" class="text-primary"></p></strong>
                <strong><p id="dataPenggunaLog" class="text-primary"></p></strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="confirmButton">Ya <i class="fa fa-check"></i></button>
                <button type="button" class="btn btn-warning" data-dismiss="modal" id="cancelButton">Batal <i>X</i></button>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas times-new-roman" id="offcanvas">
    <div class="offcanvas-content" style="margin-top: 250px;">
        <h3>Edit Data Kategori</h3>
        <hr>
        <form id="formKategori" method="post" action="<?= base_url('kategori/editKategori') ?>">
            <div class="form-group">
                <label for="editField">Kategori:</label>
                <input type="text" class="form-control" name="kategori" id="editKategoriNama">
                <input type="hidden" class="form-control" name="id_kategori" id="editID">
            </div>
            <button type="button" id="simpanKategori" class="btn btn-primary">Simpan</button>
            <button type="button" id="batalKategori" class="btn btn-tritary">Tutup</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        let dataKategori;
        $('.editKategori').click(function() {
            dataKategori = $(this).data('datakategori');
            let idKategori = $(this).data('idkategori');
            $('#editKategoriNama').val(dataKategori);
            $('#editID').val(idKategori);
            $('#offcanvas').animate({ right: '0' }, 300);
        });

        $('#batalKategori').click(function() {
            event.preventDefault();
            $('#offcanvas').animate({ right: '-300px' }, 300);
        });

        $('#simpanKatgeori').click(function() {
            $('#offcanvas').animate({ right: '-300px' }, 300);
        });

        $("#simpanKategori").on("click", function () {
            event.preventDefault();
            $("#modalKonfirmasi").modal('show');
            let keterangan = $('#keteranganKategori').text();
            let keteranganBaru = keterangan.replace('menghapus', 'mengedit');
            $('#keteranganKategori').text(keteranganBaru);
            $('#dataKategoriDulu').text('Mengganti data ini: '+dataKategori);
            $('#dataPenggunaLog').empty();
            var dataKategoriBaru = $('#editKategoriNama').val();
            $('#dataPenggunaLog').text('Dengan data baru: '+dataKategoriBaru);
            const dataId = $('#editID').val();

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
                    $('#formKategori').submit();
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

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

        $(".hapusKategori").on("click", function () {
            event.preventDefault();
            let keterangan = $('#keteranganKategori').text();
            let keteranganBaru = keterangan.replace('mengedit', 'menghapus');
            $('#keteranganKategori').text(keteranganBaru);
            $("#modalKonfirmasi").modal('show');
            var dataUser = $(this).data('datakategori');
            var dataId = $(this).data('hapuskategoriid')
            $('#dataKategoriDulu').text(dataUser);
            $('#dataPenggunaLog').text($(this).data('penggunaandata'));

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
                    window.location.href = "<?= base_url('kategori/hapusKategori/') ?>" + dataId;
                } else if (result === false) {
                    $('#dataPengguna').text('');
                } else {
                    alert('Maaf terjadi kesalahan!');
                }
                result = null;
            });
        });

        $('#hapusBanyakDataKategori').on('click', function() {
            event.preventDefault();
            var jumlahTerpilih = $('.hapus-checkbox:checked').length;
            $("#modalKonfirmasi").modal('show');
            $('#dataKategoriDulu').text("jumlah data Kategori yang terpilih: "+jumlahTerpilih);
            // $('#dataPenggunaLog').text("");
            $('#dataPenggunaLog').empty();
            var dataTerpilih = [];
            $('.hapus-checkbox:checked').each(function(i) {
                var nilai = $(this).data('datakategori'); 
                dataTerpilih.push({
                    indeks: i + 1,
                    nilai: nilai
                });
                // console.log(dataTerpilih);
            });
            var hasil = dataTerpilih.map(function(item) {
                return "Data ke " + item.indeks + ": " + item.nilai;
            });
            if (dataTerpilih.length > 0) {
                $('#dataPenggunaLog').html("<p class='text-success'>Data Kategori yang dipilih: " + hasil.join(', ') + "</p>");
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
                    $('#dataKategori').submit();
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