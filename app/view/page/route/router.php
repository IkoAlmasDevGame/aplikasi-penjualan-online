<?php 
require_once("../../../database/koneksi.php");
$row = $config->query("SELECT * FROM sistem WHERE flags = '1' order by id_sistem asc");
$hasil = mysqli_fetch_assoc($row);
$_SESSION['logo'] = $hasil['logo'];
$_SESSION['nama_toko'] = $hasil['nama_toko'];
$_SESSION['jenis_bank'] = $hasil['jenis_bank'];
$_SESSION['nomor_rekening'] = $hasil['nomor_rekening'];

// Model
require_once("../../../model/model_user.php");
require_once("../../../model/model_barang.php");
require_once("../../../model/model_belanja.php");
// require_once("../../../model/model_transaksi.php");
// Controller
require_once("../../../controller/controller.php");
$userAuth = new controller\authentication($config);
$barangAuth = new controller\briefcase($config);
$belanjaAuth = new controller\belanja($konfig);

if(!isset($_GET['page'])){
    require_once("../dashboard/index.php");
}else{
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'pengguna':
            require_once("../pengguna/pengguna.php");
            break;

        case 'belanja':
            require_once("../belanja/belanja.php");
            break;

        case 'belanja_detail':
            require_once("../belanja/belanja_detail.php");
            break;

        case 'keranjang':
            require_once("../keranjang/keranjang.php");
            break;

        case 'pesanan':
            require_once("../pesanan/pesanan.php");
            break;
                        
        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../../auth/login.php");
            exit(0);
            break;
        
        default:
            require_once("../dashboard/index.php");
            break;
    }
}

if(!isset($_GET['aksi'])){
    require_once("../../../controller/controller.php");
}else{
    switch ($_GET['aksi']) {
        case 'tambah-keranjang':
            $belanjaAuth->tambah();
            break;
        
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>