<?php 
if(isset($_SESSION["status"])){
    if(isset($_COOKIE["cookies"])){
        if(isset($_SESSION["id_akun"])){
            if(isset($_SESSION["nomor_telepon"])){
                if(isset($_SESSION["username"])){
                    if(isset($_SESSION["nama_pengguna"])){
                        if(isset($_SESSION["title"])){
                        }
                    }
                }
            }
        }
    }
}else{
   echo "<script lang='javascript'>
    window.setTimeout(() => {
        alert('Maaf anda gagal masuk ke halaman utama ...'),
        window.location.href='../../auth/login.php'
    }, 3000);
    </script>
    ";
    die;
    exit(0);
}
?>