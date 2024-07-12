<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            require_once("../../../database/koneksi.php");
            $row = $config->query("SELECT * FROM sistem order by id_sistem asc");
            $hasil = $row->fetch_array();
        ?>
        <title>Registerasi</title>
        <link rel="shortcut icon" href="../../../../assets/logo/<?php echo $hasil['logo']?>" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <div class="container-fluid">
            <div class="d-flex justify-content-center align-items-center flex-wrap mt-3 pt-3">
                <div class="card">
                    <div class="card-header d-flex justify-content-between flex-wrap align-items-center">
                        <img src="../../../../assets/logo/<?php echo $hasil['logo']?>" alt="<?php echo $hasil['logo']?>"
                            width="64">
                        <h4 class="cart-title text-center">
                            <?php echo $hasil['nama_toko'] ?>
                        </h4>
                    </div>
                    <div class="m-1 p-1">
                        <?php require_once("../auth/functions.php") ?>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php 
                                require_once("../../../controller/controller.php");
                                require_once("../../../model/model_user.php");
                                $userAuth = new controller\authentication($config);
                                if(!isset($_GET['aksi'])){
                                    require_once("../../../controller/controller.php");
                                }else{
                                    switch ($_GET['aksi']) {
                                        case 'register':
                                            $userAuth->registerasi();
                                            break;
                                        
                                        default:
                                            require_once("../../../controller/controller.php");
                                            break;
                                    }
                                }
                            ?>
                            <form action="?aksi=register" method="post">
                                <div class="form-inline">
                                    <label for="username" class="form-label form-check-label">username</label>
                                    <input type="text" name="username" class="form-control" required
                                        aria-required="true" id="username"
                                        placeholder="masukkan username baru anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <label for="email" class="form-label form-check-label">email</label>
                                    <input type="email" name="email" class="form-control" required aria-required="true"
                                        id="email" placeholder="masukkan email baru anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <label for="password" class="form-label form-check-label">kata sandi</label>
                                    <input type="password" name="password" class="form-control" required
                                        aria-required="true" id="password" placeholder="masukkan password anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <label for="repassword" class="form-label form-check-label">ulangi kata
                                        sandi</label>
                                    <input type="password" name="repassword" class="form-control" required
                                        aria-required="true" id="repassword" placeholder="masukkan repassword anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <label for="nama_pengguna" class="form-label form-check-label">nama pengguna</label>
                                    <input type="text" name="nama_pengguna" class="form-control" required
                                        aria-required="true" id="nama_pengguna"
                                        placeholder="masukkan nama pengguna anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="title" class="form-check-label">jabatan</label>
                                    </div>
                                    <input type="radio" name="role" class="radio radio-inline" required
                                        aria-required="true" id="title" value="admin"> Admin
                                </div>
                                <div class="card-text text-center m-3">
                                    <a href="./login.php" role="button" class="text-decoration-none text-primary">sudah
                                        mempunyai akun </a>
                                </div>
                                <div class="card-footer text-center m-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save"></i>
                                        <span>Simpan</span>
                                    </button>
                                    <button type="reset" class="btn btn-danger">
                                        <i class="fa fa-eraser"></i>
                                        <span>Hapus Semua</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="container">
                            <footer class="footer my-1 py-1 border-top">
                                <p class="text-center my-3 py-1" id="tahun"></p>
                                <script type="text/javascript">
                                var today = new Date();
                                document.getElementById("tahun").innerHTML = "&copy " + today.getFullYear() +
                                    ', <?php echo $hasil['nama_toko']?>';
                                </script>
                            </footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    </body>

</html>