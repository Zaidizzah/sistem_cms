<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri = $this->uri->segment(1);
?>
<!-- ===================================================================================================================== -->
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel tabbed-panel">
                                <div class="panel-heading clearfix">
                                    <div class="panel-title pull-left"><strong>Saran-saran dari Pengguna.</strong></div>
                                    <div class="pull-right">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab-user" data-toggle="tab" aria-expanded="true">Data Saran</a></li>
                                            <li><button aria-expanded="false" aria-hidden="true" id="tutupData">X</button></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                                    Data-data Saran dari Pengguna
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
                                                        <table class="table table-hover table-responsive table-striped no-footer paginasi-tabel" data-item-per-halaman="7" data-nama-tabel="tabel1" id="DataPengguna" role="grid">
                                                            <thead>
                                                                <tr>
                                                                    <th>No</th>
                                                                    <th>Nama</th>
                                                                    <th>Email</th>
                                                                    <th>Keterangan Saran</th>
                                                                    <th>Tanggal</th>
                                                                    <th>Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="pesan-nda-ada">
                                                                <?php
                                                                $no = 1;
                                                                if (isset($saran)):
                                                                foreach ($saran as $data) :
                                                                ?>
                                                                <tr class="data-row" id="accordion">
                                                                    <td><?= $no++ ?></td>
                                                                    <td><?= $data->nama ?></td>
                                                                    <td><?= $data->email ?></td>
                                                                    <td><?= $data->saran ?></td>
                                                                    <td><?= tanggal_indonesia($data->tanggal) ?></td>
                                                                    <td>
                                                                        <strong>
                                                                            <?php if ($this->session->userdata('level') == 'Admin') : ?>
                                                                                <button class="btn-danger hapus-saran" data-hapusid="<?php echo $data->id_saran ?>" data-saran="<?php echo 'Saran Pengguna: '.$data->nama.' ('.$data->email.')' ?>" style="margin-right: 5px;"><i class="fa fa-trash fa-2x"></i></button>
                                                                                <span class="fa-2x">/</span>
                                                                            <?php endif; ?>
                                                                            <button class="btn-warning balas-pengguna collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseBalas" aria-expanded="false" data-nama="<?= $data->nama ?>" data-email="<?= $data->email ?>" style="margin-left: 5px;"><i class="fa fa-reply fa-2x"></i></button>
                                                                        </strong>
                                                                    </td>
                                                                </tr>
                                                                <?php endforeach;?>
                                                                <?php endif; if (count($saran) == 0 || $saran == null) : ?>
                                                                    <tr>
                                                                        <td colspan="6" class="text-center text-danger" style="padding-top: 50px; padding-bottom: 50px;">
                                                                        Tidak ada data-data saran dari pengguna.
                                                                        </td>
                                                                    </tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.table-responsive -->
                                                    <?php if (isset($saran)) : ?>
                                                        <div class="panel-footer prev-next-container" data-tabel-target="tabel1">
                                                        <tr>
                                                            <div class="panel panel-default">
                                                                <div id="collapseBalas" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                    <div class="panel-heading">
                                                                        <h2>Balas Saran dari Pengguna <i class="fa fa-reply"></i></h2>
                                                                    </div>
                                                                    <div class="panel-body">
                                                                    <form action="<?= site_url('email/send_email'); ?>" method="post">
                                                                        <div class="form-group">
                                                                            <label for="to">Kepada:</label>
                                                                            <input type="text" class="form-control" id="to" name="kepada" readonly>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="subject">Subjek:</label>
                                                                            <input type="text" class="form-control" id="subject" name="subjek">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="message">Keterangan Pesan:</label>
                                                                            <textarea class="form-control" id="message" name="keterangan" rows="5"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary">Kirim Email Balasan</button><strong style="font-size: 2em;">/</strong>
                                                                        <a href="" class="btn btn-warning email-langsung">Balas melalui Email langsung</a>
                                                                    </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                        <div class="row border-bottom" style="margin-bottom: 5px;">
                                                            <div class="col-md-4">
                                                                <nav aria-label="Page navigation">
                                                                    <ul class="pagination">
                                                                        <?php if (count($saran) > 7) : ?>
                                                                            <li class="page-item prev"><button class="page-link" id="prev"><< Previous</button></li>
                                                                        <?php endif; ?>
                                                                        <ul class="pagination-container pagination">
                                                                        </ul>
                                                                        <?php if (count($saran) > 7) : ?>
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
                                                                <p class="text-center"><?php if (count($saran) == 0){ echo "Tidak ada data saran pengguna";} else { echo "Ada total <strong>". count($saran) ."</strong> data saran dari pengguna";} ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <!-- /.panel-body -->
                                            </div>
                                            <!-- /.panel -->
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

                    <script type="text/javascript">
                        $(window).on('beforeunload', function() {
                            localStorage.clear();
                        });
                        tinymce.init({
                            selector: '#message',
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
                            function ucfirst(str) {
                                if (typeof str !== 'string') return str;
                                return str.charAt(0).toUpperCase() + str.slice(1);
                            }

                            $('.balas-pengguna').on('click', function() {
                                let kepada = ucfirst($(this).data('nama'));
                                let email = $(this).data('email');

                                $('#to').val(kepada+': '+email);
                                $('.email-langsung').attr('data-dataEmail', email);
                            });

                            $('.email-langsung').on('click', function() {
                                let email = $(this).data('dataemail');
                                $(this).attr('href', 'mailto:'+email);
                            }); 
                            let statusPencarian = {};
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

                            $(".hapus-saran").click(function () {
                                let result = null;
                                $("#modalKonfirmasi").modal('show');
                                var dataSaran = $(this).data('saran');
                                $('#dataPengguna').text(dataSaran);
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
                                        window.location.href = "<?= base_url('saran/hapusSaran/') ?>" + id;
                                    } else if (result === false) {
                                        // Tidak ada kelakuan
                                        $('#dataPengguna').text('');
                                    } else {
                                        alert('Maaf terjadi kesalahan!');
                                    }
                                    result = null;
                                });
                            });
                        });
                    </script>