<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$uri = $this->uri->segment(1);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Halaman Management Konten</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="<?php echo base_url('assets/staradmin') ?>/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets') ?>/overflow.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!-- [if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif] -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="<?= base_url('assets/tinymce/js/tinymce/tinymce.min.js') ?>"></script>
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo base_url('dashboard'); ?>"><i class="fa fa-envira"></i> Blog Apps</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-bell fa-fw"></i> <font style="text-transform: capitalize; text-decoration: none;">Notif</font> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <a href="#">
                                    <div>
                                        <i class="fa fa-comment fa-fw"></i> New Comment
                                        <span class="pull-right text-muted small">4 minutes ago</span>
                                    </div>
                                </a>
                            </li>   
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                            <i class="fa fa-user fa-fw"></i> <font style="text-transform: capitalize; text-decoration: none;"><?php echo $this->session->userdata('username'); ?></font> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="<?php echo site_url('dashboard/profile?username='.$this->session->userdata('username')); ?>"><i class="fa fa-user fa-fw"></i> <?php if ($this->session->userdata('tipe_user') == 'Admin'){echo 'Admin';}else{echo 'User';} ?> Profile</a>
                            </li>
                            <li><a href="<?= base_url('konfigurasi') ?>"><i class="fa fa-gear fa-fw"></i> Settings</a>
                            </li>
                            <li class="divider"></li>
                            <li><a class="logout" href="<?php echo base_url('Login/logout'); ?>" style="color: #d62828;"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <input type="text" class="form-control" placeholder="Search...">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="<?php echo base_url('dashboard'); ?>" class="<?php if ($uri === 'dashboard'){echo "active";}?> dashboardWeb"><i class="fa fa-home fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('konten'); ?>" class="<?php if ($uri === 'konten' || $uri === 'Konten'){echo "active";}?> kontenWeb"><i class="fa  fa-folder-open fa-fw"></i> Konten</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('kategori'); ?>" class="<?php if ($uri === 'kategori-konten' || $uri === 'Kategori' || $uri === 'kategori'){echo "active";}?> kategoriWeb"><i class="fa fa-folder fa-fw"></i> Kategori</a>
                            </li>
                            <?php if ($this->session->userdata('tipe_user') == 'Admin') {?>
                            <li>
                                <a href="<?php echo base_url('carousel'); ?>" class="<?php if ($uri === 'carousel'){echo "active";}?> carouselWeb"><i class="fa fa-clone fa-fw"></i> Carousel</a>
                            </li>
                            <!-- Admin Control -->
                                <li>
                                    <a href="<?php echo base_url('user'); ?>" class="<?php if ($uri === 'User'){echo "active";}?> userWeb"><i class="fa fa-user fa-fw"></i> User</a>
                                </li>
                            <!-- /Admin Control -->
                            <li>
                                <a href="<?php echo base_url('konfigurasi'); ?>" class="<?php if ($uri === 'konfigurasi'){echo "active";}?> konfigurasiWeb"><i class="fa fa-gears fa-fw"></i> Konfigurasi</a>
                            </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo base_url('saran'); ?>" class="<?php if ($uri === 'saran'){echo "active";}?>"><i class="fa fa-coffee fa-fw"></i> Saran</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('galeri'); ?>" class="<?php if ($uri === 'galeri'){echo "active";}?>"><i class="fa fa-image fa-fw"></i> Galeri</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('komentar'); ?>" class="<?php if ($uri === 'komentar'){echo "active";}?>"><i class="fa fa-comment-o fa-fw"></i> Komentar</a>
                            </li>
                            <li>
                                <br style="margin-top: 27px;">
                            </li>
                            <li>
                                <a href="<?php echo site_url('beranda'); ?>" style="color: #d62828;"><i class="fa fa-sign-out fa-fw"></i> Pergi Beranda</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div id="page-wrapper">
                <div class="row" style="margin-top: 50px;">
                    <div class="col-lg-12 col-md-12">
                        <div class="page-header">
                            <h1 class="">Dashboard / <?php if ($this->session->userdata('tipe_user') == 'Admin'){echo 'Admin';}else{echo 'Kontributor';} ?></h1>
                        </div>
                        <ol class="breadcrumb float-end text-left">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>" style="text-decoration: none;"><i class="fa fa-home fa-fw"></i> Website</a></li>
                            <li class="breadcrumb-item"><a style="cursor: pointer; text-decoration: none;"> <i class="fa fa-reorder fa-fw"></i> Panel</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php 
                                    if ($uri === 'dashboard'){echo "<a href='".base_url('dashboard')."' style='text-decoration: none;'><i class='fa fa-dashboard fa-fw'></i> Dashboard</a>";
                                    }elseif($uri === 'konten' || $uri === 'Konten'){echo "<a href='".base_url('konten')."' style='text-decoration: none;'><i class='fa fa-folder-open fa-fw'></i> Konten</a>";
                                    }elseif($uri === 'user'){echo "<a href='".base_url('user')."' style='text-decoration: none;'><i class='fa fa-user fa-fw'></i> User</a>";
                                    }elseif ($uri === 'kategori-konten' || $uri === 'Kategori' || $uri === 'kategori'){echo "<a href='".base_url('kategori')."' style='text-decoration: none;'><i class='fa fa-folder fa-fw'></i> Kategori</a>";
                                    }elseif($uri === 'carousel'){echo "<a href='".base_url('carousel')."' style='text-decoration: none;'><i class='fa fa-image fa-fw'></i> Carousel</a>";
                                    }elseif($uri === 'konfigurasi'){echo "<a href='".base_url('carousel')."' style='text-decoration: none;'><i class='fa fa-gears fa-fw'></i> Konfigurasi</a>";
                                    }elseif($uri === 'saran'){echo "<a href='".base_url('saran')."' style='text-decoration: none;'><i class='fa fa-coffee fa-fw'></i> Saran</a>";
                                    }elseif($uri === 'galeri'){echo "<a href='".base_url('galeri')."' style='text-decoration: none;'><i class='fa fa-image fa-fw'></i> Galeri</a>";
                                    }elseif($uri === 'komentar'){echo "<a href='".base_url('komentar')."' style='text-decoration: none;'><i class='fa fa-comment-o fa-fw'></i> Komentar</a>";
                                    }else{echo "---";}
                                ?>
                            </li>
                        </ol>
                    </div>
                </div>