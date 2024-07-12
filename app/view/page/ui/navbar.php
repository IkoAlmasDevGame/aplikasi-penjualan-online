<?php 
if($_SESSION['role'] == ""){
    header("location:../../auth/login.php");
    exit(0);
}
?>

<?php 
if($_SESSION['role'] == "pengguna"){
?>
<header class="header-nav">
    <nav class="navbar navbar-expand-lg bg-body-secondary">
        <div class="container-fluid">
            <a href="../ui/header.php?page=beranda" class="navbar-brand">
                <img src="../../../../assets/logo/<?=$_SESSION['logo']?>" class="img-responsive mx-3"
                    alt="<?=$_SESSION['logo']?>" width="32">
                <?php echo $hasil['nama_toko'] ?>
            </a>
            <button type="button" class="navbar-toggler" data-bs-target="#navbarToggleSupport" data-bs-toggle="collapse"
                aria-expanded="false" aria-controls="navbarToggleSupport">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapsed" id="navbarToggleSupport">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="?page=beranda" aria-current="page" class="nav-link active">
                            <i class="fa fa-home fa-1x"></i>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=belanja" aria-current="page" class="nav-link active">
                            <i class="fa fa-shopping-bag fa-1x"></i>
                            <span>Belanja</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=keranjang" aria-current="page" class="nav-link active">
                            <i class="fa fa-shopping-cart fa-1x"></i>
                            <span>Keranjang</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=keluar" onclick="return confirm('Apakah kamu ingin keluar ?')"
                            aria-current="page" class="nav-link">
                            <i class="fa fa-sign-out-alt"></i>
                            Keluar
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<?php
}else{
    header("location:../../auth/login.php");
    exit(0);
}
?>