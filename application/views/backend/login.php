<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$flashdata = $this->session->flashdata('item'); 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <style>
            ::-webkit-scrollbar {
                width: 0.5em;
            }

            ::-webkit-scrollbar-thumb {
                background-color: transparent;
            }

            ::-webkit-scrollbar-thumb:hover {
                background-color: transparent;
            }

            ::-webkit-scrollbar-button:start {
                display: none;
            }

            ::-webkit-scrollbar-button:end {
                display: none;
            }

            .textHeader {
                text-align: center;
            }
        </style>

        <title>Sign-In | Login Aplikasi</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="login-panel panel panel-default" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                        <div class="panel-heading">
                            <h1 class="title text-center textHeader"><strong>Login</strong></h1>
                            <p class="text-center">Masuk dengan Akun anda.</p>
                        </div>
                        <div class="panel-body">
                            <form role="form" action="<?php echo base_url('Login/Authentifikasi') ?>" method="post">
                                <fieldset>
                                    <div class="form-group">
                                        <label>Username: </label>
                                        <input class="form-control" placeholder="Username" name="username" type="text" value="<?php if ($flashdata === NULL){} else {$data = unserialize($flashdata); echo $data['username'];}?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password: </label>
                                        <input class="form-control" placeholder="Password" name="password" type="password" value="<?php if ($flashdata === NULL){} else {$data = unserialize($flashdata); echo $data['password'];}?>">
                                    </div>
                                    <hr class="my-1">
                                    <!-- Change this to a button or input when using this as a form -->
                                    <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                                </fieldset>
                            </form>
                        </div>
                        <div class="panel-footer">
                            <h3 class="panel-title text-center">Login ke Dashboard manajement konten <i class="fa fa-book" aria-hidden="true"></i></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-0">
                <div class="col-md-4 mb-0 col-md-offset-4">
                    <?php if ($this->session->flashdata('validation_error')) { ?><div class="text-center alert alert-danger alert-dismissable"><?php echo $this->session->flashdata('validation_error'); ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button></div><?php } ?>
                    <?php if ($this->session->flashdata('validation_success')) { ?><div class="text-center alert alert-success alert-dismissable"><?php echo $this->session->flashdata('validation_success'); ?><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button></div><?php } ?><br>
                    <div class="text-center"><span>Kembali ke <a href="<?= base_url('beranda') ?>" style="text-decoration: none;">Beranda</a> --></span></div>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <p class="text-center"><font size="2"><strong>Terimakasih atas Kunjungan anda, Silahkan Masuk💖</strong></font></p>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url('assets/staradmin') ?>/js/startmin.js"></script>
        <script>
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 4500);
        </script>
    </body>
</html>

