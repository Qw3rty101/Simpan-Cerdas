<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['anggota']) && !isset($_SESSION['role'])) {
    // Pengguna tidak memiliki sesi (belum login), arahkan kembali ke halaman login
    header('Location: ../public/login.php'); // Ganti dengan halaman login Anda
    exit;
  }



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=$data['judul'];?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= BASEURL;?>/assets/img/favicon.png" rel="icon">
  <link href="<?= BASEURL;?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= BASEURL;?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= BASEURL;?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= BASEURL;?>/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= BASEURL;?>/assets/img/logo.png" alt="">
        <span class="d-none d-lg-block ml">SimpanCerdas</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item dropdown">

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= BASEURL;?>/assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $data['nama']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= BASEURL; ?>/logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <aside id="sidebar" class="sidebar">
      <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
          <a class="nav-link" href="<?= BASEURL;?>/dashboard">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <!-- End Transaksi Cash -->

        <!-- Transaksi Cash -->
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "bendahara"): ?>
          <li class="nav-item">
            <a
              class="nav-link collapsed"
              data-bs-target="#forms-nav"
              data-bs-toggle="collapse"
              href="#"
            >
              <i class="bi bi-cash-coin"></i><span>Transaksi Kas</span
              ><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul
              id="forms-nav"
              class="nav-content collapse"
              data-bs-parent="#sidebar-nav"
            >
              <li>
                <a href="../transaksi/pemasukan.php">
                  <i class="bi bi-circle"></i><span>Pemasukan</span>
                </a>
              </li>
              <li>
                <a href="../transaksi/pengeluaran.php">
                  <i class="bi bi-circle"></i><span>Pengeluaran</span>
                </a>
              </li>
              <li>
                <a href="../transaksi/transfer.php">
                  <i class="bi bi-circle"></i><span>Transfer</span>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>


        
        <!-- End Components Nav -->

         <!-- Transaksi Cash -->
        <li class="nav-item">
          <a
            class="nav-link collapsed"
            data-bs-target="#simpan-nav"
            data-bs-toggle="collapse"
            href="#"
          >
            <i class="bi bi-piggy-bank"></i><span>Simpanan</span
            ><i class="bi bi-chevron-down ms-auto"></i>
          </a>
          <ul
            id="simpan-nav"
            class="nav-content collapse"
            data-bs-parent="#sidebar-nav"
          >
            <li>
              <a href="<?= BASEURL; ?>/simpanan/setoran">
                <i class="bi bi-circle"></i><span>Setoran Tunai</span>
              </a>
            </li>
            <li>
              <a href="<?= BASEURL; ?>/simpanan/penarikan">
                <i class="bi bi-circle"></i><span>Penarikan Tunai</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- End Components Nav -->
        
        <!-- Transaksi Cash -->
        <!-- <li class="nav-item">
          <a
            class="nav-link collapsed"
            data-bs-target="#pinjam-nav"
            data-bs-toggle="collapse"
            href="#"
          >
          <i class="bi bi-wallet2"></i></i><span>Pinjaman</span
            ><i class="bi bi-chevron-down ms-auto"></i>
          </a> 
          <ul
            id="pinjam-nav"
            class="nav-content collapse"
            data-bs-parent="#sidebar-nav"
          >
            <li>
              <a href="../pinjaman/data-pengajuan.php">
                <i class="bi bi-circle"></i><span>Data Pengajuan</span>
              </a>
            </li>
            <li>
              <a href="../pinjaman/data-pinjaman.php">
                <i class="bi bi-circle"></i><span>Data Pinjaman</span>
              </a>
            </li>
            <li>
              <a href="../pinjaman/bayar-angsuran.php">
                <i class="bi bi-circle"></i><span>Bayar Angsuran</span>
              </a>
            </li>
            <li>
              <a href="../pinjaman/pinjaman-lunas.php">
                <i class="bi bi-circle"></i><span>Pinjaman Lunas</span>
              </a>
            </li>
          </ul>
        </li> -->
        <!-- End Components Nav -->

        <!-- <li class="nav-item">
          <a class="nav-link collapsed" href="dashboard">
          <i class="bi bi-clipboard-data"></i>
            <span>Laporan</span>
          </a>
        </li> -->
        <!-- End Transaksi Cash -->
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "bendahara"): ?>
        <li class="nav-heading">Pages</li>

        <!-- End Profile Page Nav -->

        <li class="nav-item">
          <a class="nav-link collapsed" href="../masteruser/masteruser">
            <i class="bi bi-people"></i>
            <span>Master User</span>
          </a>
        </li>
        <!-- End Profile Page Nav -->
        <?php endif; ?>
      </ul>
    </aside>
    <!-- End Sidebar-->

  <main id="main" class="main">