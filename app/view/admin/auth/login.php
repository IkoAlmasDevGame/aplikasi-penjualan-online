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
        <title>Login Admin</title>
        <link rel="shortcut icon" href="../../../../assets/logo/<?php echo $hasil['logo']?>" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link rel="stylesheet" href="./style.css" type="text/css">
    </head>

    <body>
        <div class="container-fluid mt-3 pt-5">
            <div class="d-flex justify-content-center align-items-center flex-wrap mt-5 pt-5">
                <div class="card width-card">
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
                    <div class="card-body height-card">
                        <div class="form-group">
                            <?php 
                                require_once("../../../controller/controller.php");
                                require_once("../../../model/model_user.php");
                                $userAuth = new controller\authentication($config);
                                
                                if(!isset($_GET['aksi'])){
                                    require_once("../../../controller/controller.php");
                                }else{
                                    switch ($_GET['aksi']) {
                                        case 'signin':
                                            $userAuth->login();
                                            break;
                                        
                                        default:
                                            require_once("../../../controller/controller.php");
                                            break;
                                    }
                                }
                            ?>
                            <form action="?aksi=signin" method="post">
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="userName" class="form-check-label">username / email</label>
                                    </div>
                                    <input type="text" name="userInput" class="form-control" required
                                        aria-required="true" id="userName"
                                        placeholder="masukkan username atau email anda ...">
                                </div>
                                <div class="m-3"></div>
                                <div class="form-inline">
                                    <div class="form-label">
                                        <label for="password" class="form-check-label">kata sandi</label>
                                    </div>
                                    <input type="password" name="password" class="form-control" required
                                        aria-required="true" id="password" placeholder="masukkan password anda ...">
                                </div>
                                <div class="card-text text-center m-3">
                                    <a href="./register.php" role="button"
                                        class="text-decoration-none text-primary">membuat akun baru </a>
                                </div>
                                <div class="card-footer text-center m-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-sign-in-alt"></i>
                                        <span>Sign In</span>
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