<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?= $title ?></title>

  <!-- Custom fonts for this theme -->
  <link href="<?= base_url('assets/template_beranda/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!-- Theme CSS -->
  <link href="<?= base_url('assets/template_beranda/'); ?>css/freelancer.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="<?= base_url(); ?>">RollinCigar</a>
      <button class="navbar-toggler navbar-toggler-right text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item mt-2 dropdown mx-0 mx-lg-1">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-3 d-none d-lg-inline text-gray-600 large text-uppercase">Kategori</span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <?php foreach ($kategori as $p) : ?>
                    <a class="dropdown-item" href="<?= base_url('beranda/daftar/'), $p['cat_id'];; ?>">
                        <?= $p['cat_name']; ?>
                    </a> 
                <?php endforeach; ?>
                </div>
            </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?= base_url('beranda/pembayaran') ?>">Cara Pembayaran</a>
          </li>
          <li class="nav-item mx-0 mx-lg-1">
            <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?= base_url('beranda/about') ?>">About</a>
          </li>
          <?php if ($this->session->userdata('username') == null) { ?>
            <li class="nav-item mx-0 mx-lg-1">
                  <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="<?=  base_url('beranda/login') ?>">Login</a>
            </li>
          <?php } else { ?>
            <li class="nav-item mt-2 dropdown mx-0 mx-lg-1">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-3 d-none d-lg-inline text-gray-600 large text-uppercase"><?= $this->session->userdata('username') ?></span>
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="<?= base_url('beranda/pesanan') ?>">
                    <i class="fas fa-align-justify fa-sm fa-fw mr-2 text-gray-400""></i>
                        Daftar Pesanan
                    </a>
                    <a class="dropdown-item" href="<?= base_url('beranda/keranjang') ?>">
                        <i class="fas fa-shopping-cart fa-sm fa-fw mr-2 text-gray-400""></i>
                        Keranjang Belanja
                    </a>
                    <a class="dropdown-item" href="<?= base_url('login/logout') ?>">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Keluar
                    </a>
                </div>
            </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>
