<?php 
if(isset($_GET['info'])){
    if($_GET['info'] == "berhasil"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah menambahkan data produk baru ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=barang'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "ubah"){
?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah mengubah data produk baru ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=barang'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "hapus"){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah menghapus data produk baru ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=barang'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "gagal"){
?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Anda telah gagal menambahkan atau mengubaha atau menghapus data produk baru ...</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=barang'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
    if($_GET['info'] == "jumlah"){
?>
<div class="alert alert-secondary alert-dismissible fade show" role="alert">
    <strong>Informasi </strong>
    <p>Jumlah Stok Berhasil ter-update / ter-isi kembali</p>
    <button type="button" class="btn-close" onclick="document.location.href='../ui/header.php?page=barang'"
        data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
    }
}
?>