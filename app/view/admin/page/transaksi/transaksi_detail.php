<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Transaksi Detail</title>
        <link rel="shortcut icon" href="../../../../assets/logo/<?php echo $_SESSION['logo']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <?php 
                            if(isset($_GET['id_pesanan'])){
                                $id = htmlspecialchars($_GET['id_pesanan']);
                                $sql = "SELECT * FROM pesanan JOIN barang ON pesanan.id_barang = barang.id_barang
                                JOIN user ON pesanan.id_akun = user.id_akun WHERE pesanan.id_pesanan = '$id'";
                                $row = $config->query($sql);
                            while($isi = $row->fetch_array()){
                        ?>
                        <table class="article">
                            <tr>
                                <td>Id Pesanan</td>
                                <td><?php echo $isi['id_pesanan']; ?></td>
                            </tr>
                            <tr>
                                <td>Barang</td>
                                <td><?php echo "[".$isi['id_barang']."] ".$isi['nama_barang']; ?></td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td><?php echo "Rp. ".$isi['harga_jual']; ?></td>
                            </tr>
                            <tr>
                                <td>Total Pembayaran</td>
                                <td><?php echo "Rp. ".number_format($isi['total']); ?></td>
                            </tr>
                            <tr>
                                <td>Qty</td>
                                <td><?php echo $isi['qty']; ?></td>
                            </tr>
                            <tr>
                                <td>Pemesan</td>
                                <td><?php echo "[".$isi['id_akun']."] ".$isi['nama_pengguna']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?php echo $isi['email']; ?></td>
                            </tr>
                            <tr>
                                <td>No HP</td>
                                <td><?php echo $isi['no_telepon']; ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td><?php echo $isi['alamat']; ?></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <a class="tombol-biru" href="?page=transaksi">Kembali</a>
                                </td>
                            </tr>
                        </table>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>