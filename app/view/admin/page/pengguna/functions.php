<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "update"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah mengubah data pengguna ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=pengguna'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "hapus"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah menghapus data pengguna ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=pengguna'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "gagal"){
?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah gagal menambahkan atau mengubaha atau menghapus data pengguna ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=pengguna'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "passconfirm"){
?>
<div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Kata sandi dan Ulangi Kata Sandi anda tidak cocok ...</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert"
        onclick="document.location.href='../ui/header.php?page=pengguna'" aria-label="Close"></button>
</div>
<?php
    }
}
?>