<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Belanja</title>
        <link rel="shortcut icon" href="../../../../assets/logo/<?php echo $_SESSION['logo']?>" type="image/x-icon">
        <?php 
        if($_SESSION['role'] == "pengguna"){
            require_once("../ui/header.php");
        }else{
            header("location:../ui/header.php?page=beranda");
            exit;
        }
        ?>
        <style type="text/css">
        * {
            font-size: 14px;
            font-family: 'Times New Roman';
            font-weight: normal;
        }
        </style>
    </head>

    <body>
        <?php require_once("../ui/navbar.php") ?>
        <div class="container-fluid mt-3 pt-3">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="col-sm-9 col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h4 class="card-title display-4 fs-5"><b>Detail Barang</b></h4>
                        </div>
                        <div class="table-responsive">
                            <?php 
                                if(isset($_SESSION['username'])){
                                    $user = $_SESSION['username'];
                                    $ambiluser = $konfig->prepare("SELECT * FROM user WHERE username = ?");
                                    $ambiluser->execute(array($user));
                                    $data = $ambiluser->fetch();

                                    $id = htmlspecialchars($_GET['id']);
                                    $sisa = htmlspecialchars($_GET['st']);
                                    $result = $konfig->prepare("SELECT * FROM barang WHERE id_barang = ?");
                                    $result->execute(array($id));
                                    $row = $result->fetch();
                                }
                            ?>
                            <form action="?aksi=tambah-keranjang" name="belanja" enctype="multipart/form-data"
                                method="post">
                                <table class="table w-100 article">
                                    <tr>
                                        <td>Gambar</td>
                                        <td>
                                            <input type="hidden" name="id_akun" value="<?php echo $data['id_akun'] ?>">
                                            <input type="hidden" name="id_barang"
                                                value="<?php echo $row['id_barang'] ?>">
                                            <img src="../../../../assets/produk/<?php echo $row['gambar_produk'] ?>"
                                                width="100"><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>
                                            <?php echo $row['nama_barang'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>
                                            <input type="hidden" name="harga" value="<?php echo $row['harga_jual']; ?>">
                                            <?php echo "Rp. ".$row['harga_jual'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>
                                            <input type="hidden" name="sisa" value="<?php echo $sisa ?>">
                                            <?php echo $sisa ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Qty</td>
                                        <td>
                                            <input type="number" name="qty" min="1">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kurir Pengiriman</td>
                                        <td>
                                            <select name="kurir">
                                                <option>-- pilih salah satu --</option>
                                                <option value="POS">POS Indonesia</option>
                                                <option value="JNE">JNE</option>
                                                <option value="TIKI">TIKI</option>
                                                <option value="KILAT">KILAT</option>
                                                <option value="SICEPAT">SI-CEPAT</option>
                                                <option value="GOJEK">GO-JEK</option>
                                                <option value="GRAB">GRAB</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input class="tombol-biru" type="submit" name="belanja"
                                                value="Isi dalam keranjang">
                                            <a class="tombol-merah" href="?page=beranda">Kembali</a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>