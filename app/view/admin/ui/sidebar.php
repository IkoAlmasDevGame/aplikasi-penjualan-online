<?php 
if($_SESSION['role'] == ""){
    header("location:../auth/login.php");
    exit;
}
?>

<?php
    if($_SESSION['role'] == "admin"){
?>
<header id="header" class="header fixed-top d-flex align-items-center" style="position:fixed">
    <div class="d-flex align-items-center justify-content-between">
        <a href="" role="button" class="logo d-flex align-items-center fst-normal fw-semibold">
            <?php echo $hasil['nama_toko'] ?>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto mx-3">
        <ul>
            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" role="button"
                    data-bs-toggle="dropdown" aria-controls="dropdown">
                    <i class="fa fa-user-alt"></i>
                    <span class="d-none d-md-block dropdown-toggle ps-2"></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <hr class="dropdown-divider">
                        <div class="text-start">userName : <?php echo $_SESSION['username'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">nama : <?php echo $_SESSION['nama_pengguna'] ?></div>
                        <div class="mb-1"></div>
                        <div class="text-start">Jabatan : <?php echo $_SESSION['role'] ?></div>
                        <hr class="dropdown-divider">
                    </li>
                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->
        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- ======= Header ======= -->

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="?page=beranda" aria-current="page">
                <i class="fa fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <hr class="dropdown-divider mb-1 mt-1">

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=barang" aria-current="page">
                        <i class="bi bi-circle"></i><span>Data Barang</span>
                    </a>
                </li>
                <li>
                    <a href="?page=satuan" aria-current="page">
                        <i class="bi bi-circle"></i><span>Satuan</span>
                    </a>
                </li>
                <li>
                    <a href="?page=pengguna" aria-current="page">
                        <i class="bi bi-circle"></i><span>Data Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="?page=kategori" aria-current="page">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link" href="?page=transaksi" aria-current="page">
                <i class="bi bi-cash fa-1x"></i>
                <span>Data Transaksi</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link" href="?page=laporan" aria-current="page">
                <i class="fa fa-book fa-1x"></i>
                <span>Data Laporan</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link" href="?page=pengaturan&id_sistem=1" aria-current="page">
                <i class="fa fa-gear"></i>
                <span>Pengaturan Warung</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <hr class="dropdown-divider mb-1 mt-1">

        <li class="nav-item">
            <a class="nav-link" href="?page=keluar"
                onclick="return confirm('Apakah kamu ingin keluar dari aplikasi <?php echo $hasil['nama_toko']?> ?')"
                aria-current="page">
                <i class="fa fa-sign-out has-icon text-danger"></i>
                <span>Logout</span>
            </a>
        </li><!-- End Dashboard Nav -->
    </ul>

</aside>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">

                </div>

            </div><!-- End Right side columns -->

        </div>

    </section>

    <?php 
    }else{
        header("location:../auth/login.php");
        return;
        exit;
    }
?>