<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah berhasil membuat akun baru ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='register.php'" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "gagal"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah gagal membuat akun baru ...</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href='register.php'"
        aria-label="Close"></button>
</div>
<?php        
    }
    if($_GET['info'] == "passconfirm"){
?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Kata sandi dan Ulangi Kata Sandi anda tidak cocok ...</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href='register.php'"
        aria-label="Close"></button>
</div>
<?php        
    }
    if($_GET['info'] == "blank"){
?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Tidak Boleh Kosong Form Sign In</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" onclick="document.location.href='login.php'"
        aria-label="Close"></button>
</div>
<?php        
    }
}
?>