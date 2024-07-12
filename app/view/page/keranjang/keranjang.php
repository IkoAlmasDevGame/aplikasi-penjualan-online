<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Keranjang Belanjaan</title>
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
                <div class="col-sm-10 col-lg-9">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h4 class="card-title">Keranjang Belanja</h4>
                        </div>
                        <div class="table-reponsive">
                            <div class="card-body">
                                <table class="table w-100 table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Pesanan</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Kurir</th>
                                            <th>Total</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(isset($_SESSION['username'])){
                                                $user = htmlspecialchars($_SESSION['username']);
                                                $ambiluser = $konfig->prepare("SELECT * FROM user WHERE username = ?");
                                                $ambiluser->execute(array($user));
                                                $data = $ambiluser->fetch();
                                                if (isset($_SESSION['username'])){
                                                    $id = $data['id_akun'];
                                                    $query = $konfig->prepare("SELECT keranjang.*, barang.id_barang, barang.harga_jual, barang.nama_barang
                                                    FROM keranjang JOIN barang ON keranjang.id_barang = barang.id_barang
                                                    WHERE keranjang.id_akun = $id GROUP BY keranjang.id_keranjang");
                                                    $query->execute();
                                                    $data = $query->fetchAll();
                                                    $count = $query->rowCount();
                                            }
                                        $no=1;
                                        $jumlah=0;
                                        foreach ($data as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $value['id_keranjang'] ?></td>
                                            <td><?php echo $value['nama_barang'] ?></td>
                                            <td><?php echo "Rp. ".$value['harga_jual'] ?></td>
                                            <td><?php echo $value['qty'] ?></td>
                                            <td><?php echo $value['kurir'] ?></td>
                                            <td><?php echo "Rp. ".$value['total'] ?></td>
                                            <td>
                                                <a class="btn btn-danger btn-sm"
                                                    href="?page=keranjang_hapus&id=<?php echo $value['id_keranjang']; ?>">hapus</a>
                                            </td>
                                        </tr>
                                        <?php
                                            $no++;
                                            $jumlah = $jumlah + $value['total'];
                                            }
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="7"><b>TOTAL PEMBAYARAN</b></td>
                                            <td colspan="1"><b><?php echo "Rp. ".$jumlah; ?></td></b>
                                        </tr>
                                        <?php if ($count > 0) { ?>
                                        <tr>
                                            <td colspan="7">Anda dapat <b>menghapus</b> barang dalam keranjang jika ada
                                                perubahan. jika tidak ada
                                                perubahan lagi,
                                                anda dapat melanjutkan <b>Pemesanan</b> dengan memilih tombol
                                                <b>Proses</b>.
                                            </td>

                                            <td colspan="1"><a class="btn btn-sm btn-primary"
                                                    href="?page=pesanan&id=<?php echo $id ?>&jum=<?php echo $jumlah ?>">Proses</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>