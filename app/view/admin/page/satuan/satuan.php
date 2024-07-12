<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Satuan Barang</title>
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
                    <h4 class="card-title display-4">
                        <i class="fa fa-briefcase fa-1x"></i>
                        Data Satuan Barang
                        <i class="fa fa-list fa-1x"></i>
                    </h4>
                    <div class="text-end mb-1">
                        <a href="../ui/header.php?page=satuan" class="text-decoration-none btn btn-info btn-sm">
                            <i class="fa fa-refresh"></i>
                        </a>
                    </div>
                    <?php require_once("functions.php") ?>
                </div>
                <div class="card-body">
                    <form action="?aksi=satuan" method="post">
                        <div class="form-group mt-1">
                            <?php if(isset($_GET['id_satuan'])){ 
                                $id = htmlspecialchars($_GET['id_satuan']);
                                $sql = "SELECT * FROM satuan WHERE id_satuan = '$id' order by id_satuan asc";
                                $row = $config->query($sql);
                                while($s = $row->fetch_array()){
                            ?>
                            <div class="form-inline
                             d-flex justify-content-start align-items-center flex-wrap gap-2">
                                <div class="form-label">
                                    <label for="satuan" class="label label-danger">Nama Satuan</label>
                                </div>
                                <input type="hidden" name="id_satuan" value="<?=$s['id_satuan']?>">
                                <input type="text" name="nama_satuan" value="<?=$s['nama_satuan']?>"
                                    style="width: 25pc;" maxlength="80" class="form-control" id="satuan" required
                                    aria-required="true">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-save fa-1x"></i>
                                </button>
                                <button type="reset" class="btn btn-sm btn-danger">
                                    <i class="fa fa-eraser fa-1x"></i>
                                </button>
                            </div>
                            <?php
                                }
                            }else{
                            ?>
                            <div class="form-inline mb-1
                             d-flex justify-content-start align-items-center flex-wrap gap-2">
                                <div class="form-label">
                                    <label for="satuan" class="label label-danger">Nama Satuan</label>
                                </div>
                                <input type="text" name="nama_satuan" style="width: 25pc;" maxlength="80"
                                    class="form-control" id="satuan" required aria-required="true">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-save fa-1x"></i>
                                </button>
                                <button type="reset" class="btn btn-sm btn-danger">
                                    <i class="fa fa-eraser fa-1x"></i>
                                </button>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </form>
                    <div class="border border-top"></div>
                    <div class="table-responsive table-responsive-lg">
                        <div class="form-group mb-1">
                            <form method="post">
                                <div class="form-inline d-flex justify-content-center align-items-center flex-wrap">
                                    <input type="text" class="form-control" aria-controls="example2_filter"
                                        id="example1_filter" aria-required="true" required>
                                </div>
                            </form>
                        </div>
                        <table class="table w-100 table-bordered" id="example1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Satuan</th>
                                    <th>Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    $sql = "SELECT * FROM satuan order by id_satuan asc";
                                    $row = $config->query($sql);
                                    while($isi = $row->fetch_array()){
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $isi['nama_satuan'] ?></td>
                                    <td>
                                        <a href="?page=satuan&id_satuan=<?=$isi['id_satuan']?>"
                                            class="btn btn-sm btn-warning">
                                            <i class="fa fa-1x fa-edit"></i>
                                        </a>
                                        <a href="?page=satuan&aksi=satuan&id=<?=$isi['id_satuan']?>"
                                            class="btn btn-sm btn-danger"
                                            onclick="return confirm('Apakah anda ingin menghapus data ini ?')">
                                            <i class="fa fa-1x fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                $no++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>