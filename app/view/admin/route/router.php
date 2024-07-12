<?php 
require_once("../../../database/koneksi.php");
$row = $config->query("SELECT * FROM sistem WHERE flags = '1' order by id_sistem asc");
$hasil = mysqli_fetch_assoc($row);
$_SESSION['logo'] = $hasil['logo'];

// Model & Controller
// Model
require_once("../../../model/model_user.php");
require_once("../../../model/model_barang.php");
require_once("../../../model/model_kategori.php");
require_once("../../../model/model_satuan.php");
require_once("../../../model/model_laporan.php");
require_once("../../../model/model_pengaturan.php");
// Controller
require_once("../../../controller/controller.php");
$userAuth = new controller\authentication($config);
$barangAuth = new controller\briefcase($config);
$kategoriAuth = new controller\Catalog($config);
$satuanAuth = new controller\unit($config);
$laporanAuth = new model\Laporan($konfig);
$settingAuth = new controller\setting($config);

if(!isset($_GET['page'])){
    require_once("../dashboard/index.php");
}else{
    switch ($_GET['page']) {
        case 'beranda':
            require_once("../dashboard/index.php");
            break;

        case 'barang':
            require_once("../page/barang/barang.php");
            break;

        case 'kategori':
            require_once("../page/kategori/kategori.php");
            break;

        case 'pengguna':
            require_once("../page/pengguna/pengguna.php");
            break;

        case 'satuan':
            require_once("../page/satuan/satuan.php");
            break;

        case 'transaksi':
            require_once("../page/transaksi/transaksi.php");
            break;

        case 'transaksi_detail':
            require_once("../page/transaksi/transaksi_detail.php");
            break;

        case 'pengaturan':
            require_once("../page/pengaturan/pengaturan.php");
            break;

        case 'laporan':
            require_once("../page/laporan/laporan.php");
            break;

        case 'export-laporan':
            require_once("../page/laporan/excel.php");
            break;

        case 'keluar':
            if(isset($_SESSION['status'])){
                unset($_SESSION['status']);
                session_unset();
                session_destroy();
                $_SESSION = array();
            }
            header("location:../auth/login.php");
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
        case 'barang':
            $barangAuth->buat();
            break; 
        case 'updated-barang':
            $barangAuth->jumlah();
            break; 
        case 'hapus-barang':
            $barangAuth->hapus();
            break; 

        case 'ubahpengguna':
            $userAuth->ubah();
            break;
        case 'hapuspengguna':
            $userAuth->hapus();
            break;
                               
        case 'kategori':
            $kategoriAuth->buat();
            break;
                               
        case 'satuan':
            $satuanAuth->buat();
            break;
        
        case 'ubahpengaturan':
            $settingAuth->ubah();
            break;
        
        default:
            require_once("../../../controller/controller.php");
            break;
    }
}
?>