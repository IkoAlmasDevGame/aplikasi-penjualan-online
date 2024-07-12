<?php 
namespace model;

class pengaturan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function edit($id, $nama, $jenis, $rekening, $gambar, $flags){
        $id = htmlentities($_POST['id_sistem']) ? htmlspecialchars($_POST['id_sistem']) : $_POST['id_sistem'];
        $nama = htmlentities($_POST['nama_toko']) ? htmlspecialchars($_POST['nama_toko']) : $_POST['nama_toko'];
        $jenis = htmlentities($_POST['jenis_bank']) ? htmlspecialchars($_POST['jenis_bank']) : $_POST['jenis_bank'];
        $nomor1 = htmlentities($_POST['nomor1']) ? htmlspecialchars($_POST['nomor1']) : $_POST['nomor1'];
        $nomor2 = htmlentities($_POST['nomor2']) ? htmlspecialchars($_POST['nomor2']) : $_POST['nomor2'];
        $nomor3 = htmlentities($_POST['nomor3']) ? htmlspecialchars($_POST['nomor3']) : $_POST['nomor3'];
        $nomor4 = htmlentities($_POST['nomor4']) ? htmlspecialchars($_POST['nomor4']) : $_POST['nomor4'];
        $nomor5 = htmlentities($_POST['nomor5']) ? htmlspecialchars($_POST['nomor5']) : $_POST['nomor5'];
        $rekening = $nomor1." - ".$nomor2." - ".$nomor3." - ".$nomor4." - ".$nomor5;
        $flags = htmlentities($_POST['flags']) ? htmlspecialchars($_POST['flags']) : $_POST['flags'];
        /* Data Insert Logo */ 
        $ekstensi_diperbolehkan_gambar = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $gambar = htmlentities($_FILES['logo']['name']) ? htmlspecialchars($_FILES['logo']['name']) : $_FILES['logo']['name'];
        $x_gambar = explode('.', $gambar);
        $ekstensi_gambar = strtolower(end($x_gambar));
        $ukuran_gambar = $_FILES['logo']['size'];
        $file_tmp_gambar = $_FILES['logo']['tmp_name'];
        /* Data Insert */ 

        if(in_array($ekstensi_gambar, $ekstensi_diperbolehkan_gambar) === true){
            if($ukuran_gambar < 10440070){
                move_uploaded_file($file_tmp_gambar, "../../../../assets/logo/" . $gambar);
                uniqid("../../../../assets/logo/".$id."/".$gambar);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        $table = "sistem";
        $sql = "UPDATE $table SET nama_toko='$nama', jenis_bank='$jenis', nomor_rekening='$rekening', logo='$gambar', flags='$flags' WHERE id_sistem='$id'";
        $data = $this->db->query($sql);
        if($data != null){
            if($data){
                echo "<script>document.location.href = '../ui/header.php?page=pengaturan&id_sistem=$id'</script>";
                return;
                exit;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=beranda'</script>";
            return;
            exit;
        }
    }
}
?>