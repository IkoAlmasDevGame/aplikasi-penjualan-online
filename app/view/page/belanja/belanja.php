<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Belanja</title>
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
                <div class="col-sm-10">
                    <div class="card shadow mb-4">
                        <div class="card-header py-2">
                            <h4 class="card-title display-4 fs-5">Pesanan / <b>Daftar Pesanan</b></h4>
                        </div>
                        <div class="table-responsive">
                            <div class="card-body">
                                <div class="form-group mb-1">
                                    <form method="post">
                                        <div
                                            class="form-inline d-flex justify-content-center align-items-center flex-wrap">
                                            <input type="search" name="cari" class="form-control"
                                                aria-controls="example2_filter" id="example1_filter"
                                                aria-required="true" required>
                                        </div>
                                    </form>
                                </div>
                                <table class="table table-sm w-100 table-bordered" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id Pesanan</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>
                                            <th>Qty</th>
                                            <th>Kurir</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            if(isset($_SESSION['username'])){
                                                $user = htmlspecialchars($_SESSION['username']);
                                                $queryuser = $konfig->prepare("SELECT * FROM user WHERE username = ?");
                                                $queryuser->execute(array($user));
                                                $data = $queryuser->fetch();
                                                if(isset($_SESSION['username'])){
                                                    $id = $data['id_akun'];
                                                    $query = $konfig->prepare("SELECT * FROM pesanan JOIN barang ON pesanan.id_barang = barang.id_barang
                                                        WHERE pesanan.id_akun = ? GROUP BY pesanan.id_pesanan");
                                                    $query->execute(array($id));
                                                    $data = $query->fetchAll();
                                                    $count = $query->rowCount();
                                                }
                                            $no = 1;
                                            foreach ($data as $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $no; ?></td>
                                            <td><?php echo $value['id_pesanan'] ?></td>
                                            <td><?php echo $value['nama_barang'] ?></td>
                                            <td><?php echo $value['harga_jual'] ?></td>
                                            <td><?php echo $value['qty'] ?></td>
                                            <td><?php echo $value['kurir'] ?></td>
                                            <td><?php echo $value['date_in'] ?></td>
                                            <td><?php echo $value['total'] ?></td>
                                            <td>
                                                <a class="tombol-biru">Sukses</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $no++;
                                            }
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
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>