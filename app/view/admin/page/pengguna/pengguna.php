<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Pengguna</title>
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
                    <h4 class="card-title display-4"><i class="fa fa-1x fa-user-alt"></i> Data Master Pengguna</h4>
                    <?php require_once("functions.php") ?>
                </div>
                <div class="card-body">
                    <div class="card-default">
                        <div class="form-group mb-1">
                            <form method="post">
                                <div class="form-inline d-flex justify-content-center align-items-center flex-wrap">
                                    <input type="search" name="cari" class="form-control"
                                        aria-controls="example2_filter" id="example1_filter" aria-required="true"
                                        required>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive table-responsive-lg">
                            <table class="table table-bordered w-100" id="example1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengguna</th>
                                        <th>User Name</th>
                                        <th>E - Mailing</th>
                                        <th>Password</th>
                                        <th>Repasword</th>
                                        <th>Alamat</th>
                                        <th>No Telepon</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $no = 1;
                                        $row = $config->query("SELECT * FROM user order by id_akun asc");
                                        while($isi = $row->fetch_array()){
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $isi['nama_pengguna'] ?></td>
                                        <td><?php echo $isi["username"] ?></td>
                                        <td><?php echo $isi["email"] ?></td>
                                        <td>Password Ter-Enkripsi</td>
                                        <td>Password Ter-Enkripsi</td>
                                        <?php 
                                            if($isi['role'] == "pengguna"){
                                        ?>
                                        <td>
                                            <a href="" data-bs-target="#alamatpengguna<?=$isi['id_akun']?>"
                                                data-bs-toggle="modal" class="btn btn-sm btn-danger">
                                                <i class="fa fa-map fa-1x"></i>
                                            </a>
                                            <div class="modal fade" aria-hidden="TRUE" tabindex="-1"
                                                id="alamatpengguna<?=$isi['id_akun']?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title display-4">Alamat rumah
                                                                <?php echo $isi['nama_pengguna'] ?></h4>
                                                            <button type='button' class='btn-close'
                                                                data-bs-dismiss='modal'></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-comment">
                                                                <p class="text-center">
                                                                    <?php echo $isi['alamat'] ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="" data-bs-target="#phonepengguna<?=$isi['id_akun']?>"
                                                data-bs-toggle="modal" class="btn btn-sm btn-secondary">
                                                <i class="fa fa-phone-alt fa-1x"></i>
                                            </a>
                                            <div class="modal fade" aria-hidden="TRUE" tabindex="-1"
                                                id="phonepengguna<?=$isi['id_akun']?>">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title display-4">No Telepon
                                                                <?php echo $isi['nama_pengguna'] ?></h4>
                                                            <button type='button' class='btn-close'
                                                                data-bs-dismiss='modal'></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card-comment">
                                                                <p class="text-center">
                                                                    <a href="http://wa.me/<?=$isi['no_telepon']?>"
                                                                        target="_blank"
                                                                        class="text-decoration-none text-primary"
                                                                        rel="noopener noreferrer"><?=$isi['no_telepon']?></a>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                            }else{
                                        ?>
                                        <td><?php echo "" ?></td>
                                        <td><?php echo "" ?></td>
                                        <?php
                                            }
                                        ?>
                                        <td>
                                            <?php 
                                                if($isi['role'] == "admin"){
                                            ?>
                                            <a href="?page=pengguna&aksi=hapuspengguna&id_akun=<?=$isi['id_akun']?>"
                                                onclick="return confirm('Apakah anda ingin menghapus data ini ?')"
                                                class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash fa-1x"></i>
                                            </a>
                                            <a href="" data-bs-target="#editprofile<?=$isi['id_akun']?>"
                                                data-bs-toggle="modal" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit fa-1x"></i>
                                            </a>
                                            <?php
                                                }elseif($isi['role'] == "pengguna"){
                                            ?>
                                            <a href="" class="btn btn-sm btn-danger">
                                                <i class="fa fa-trash fa-1x"></i>
                                            </a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <div class="modal fade" id="editprofile<?=$isi['id_akun']?>" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title display-4">Edit Pengguna</h4>
                                                        <button type='button' class='btn-close'
                                                            data-bs-dismiss='modal'></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="?aksi=ubahpengguna" method="post">
                                                            <input type="hidden" name="id_akun"
                                                                value="<?=$isi['id_akun']?>">
                                                            <input type="hidden" name="role" value="<?=$isi['role']?>">
                                                            <div class="form-group">
                                                                <div class="form-inline mb-1">
                                                                    <div class="form-label">
                                                                        <label for="" class="label label-default">User
                                                                            Name</label>
                                                                    </div>
                                                                    <input type="text" name="username"
                                                                        value="<?=$isi['username']?>" required id=""
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-inline mb-1">
                                                                    <div class="form-label">
                                                                        <label for="" class="label label-default">E -
                                                                            Mailing</label>
                                                                    </div>
                                                                    <input type="email" name="email"
                                                                        value="<?=$isi['email']?>" required id=""
                                                                        class="form-control">
                                                                </div>
                                                                <div class="form-inline mb-1">
                                                                    <div class="form-label">
                                                                        <label for=""
                                                                            class="label label-default">Password</label>
                                                                    </div>
                                                                    <input type="password" name="password" required
                                                                        id="" class="form-control">
                                                                </div>
                                                                <div class="form-inline mb-1">
                                                                    <div class="form-label">
                                                                        <label for=""
                                                                            class="label label-default">Repassword</label>
                                                                    </div>
                                                                    <input type="password" name="repassword" required
                                                                        id="" class="form-control">
                                                                </div>
                                                                <div class="form-inline mb-1">
                                                                    <div class="form-label">
                                                                        <label for="" class="label label-default">Nama
                                                                            Pengguna</label>
                                                                    </div>
                                                                    <input type="text" name="nama_pengguna"
                                                                        value="<?=$isi['nama_pengguna']?>" required
                                                                        id="" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-secondary">
                                                                    <i class="fa fa-save fa-1x"></i>
                                                                    <span>Update</span>
                                                                </button>
                                                                <button type="reset" class="btn btn-danger">
                                                                    <i class="fa fa-eraser fa-1x"></i>
                                                                    <span>Hapus Semua</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        </div>
        <?php require_once("../ui/footer.php") ?>