<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Transaksi</title>
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
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title display-4">Transaksi atau Transaksi Pembelian Barang</h4>
                </div>
                <div class="table-resposive table-responsive-lg">
                    <div class="card-body">
                        <div class="form-group mb-1">
                            <form method="post">
                                <div class="form-inline d-flex justify-content-center align-items-center flex-wrap">
                                    <input type="search" name="cari" class="form-control"
                                        aria-controls="example2_filter" id="example1_filter" aria-required="true"
                                        required>
                                </div>
                            </form>
                        </div>
                        <table class="table table-sm w-100 table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>Id Pesanan</th>
                                    <th>Pemesan</th>
                                    <th>Id Barang</th>
                                    <th>Qty</th>
                                    <th>Kurir</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count = 0;
                                    $sql = "SELECT * FROM pesanan JOIN barang ON pesanan.id_barang = barang.id_barang
                                     JOIN user ON pesanan.id_akun = user.id_akun ORDER BY date_in DESC";
                                    $query = $config->query($sql);
                                    while($isi = $query->fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $isi['id_pesanan'] ?></td>
                                    <td><?php echo "(".$isi['id_akun'].") ".$isi['nama_pengguna'] ?></td>
                                    <td><?php echo $isi['nama_barang'] ?></td>
                                    <td><?php echo $isi['qty'] ?></td>
                                    <td><?php echo $isi['kurir'] ?></td>
                                    <td><?php echo $isi['date_in'] ?></td>
                                    <td><?php echo $isi['total'] ?></td>
                                    <td>
                                        <a class="btn btn-primary">Sukses</a><br><br>
                                        <a class="btn btn-primary"
                                            href="?page=transaksi_detail&id_pesanan=<?php echo $isi['id_pesanan']; ?>">Detail</a>
                                    </td>
                                </tr>
                                <?php
                                $count = mysqli_num_rows($query);
                                    }
                                ?>
                            </tbody>
                        </table>
                        <br>
                        <?php 
                        if ($count == 0){
                            echo "<center>-- Belum ada pesanan barang --</center>";
                            echo "<br>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>