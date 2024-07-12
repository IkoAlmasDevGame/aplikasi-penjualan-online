<?php 
namespace model;

class kategori {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($kategori){
        $id = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $kategori = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];
        
        $table = "kategori";
        $select = "SELECT count(id_kategori) as id FROM kategori WHERE id_kategori = '$id'";
        $select_db = $this->db->query($select);
        $cek_select = mysqli_fetch_array($select_db);

        if($cek_select['id'] > 0){
            $data = $this->db->query("UPDATE $table SET nama_kategori = '$kategori' WHERE id_kategori = '$id'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=kategori&info=ubah'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=kategori&info=gagal'</script>";
                return;
                exit;
            }
        }else if(isset($_GET['id'])){
            $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
            $data = $this->db->query("DELETE FROM $table WHERE id_kategori = '$id'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=kategori&info=hapus'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=kategori&info=gagal'</script>";
                return;
                exit;
            }
        }else{
            $data = $this->db->query("INSERT INTO $table (nama_kategori) VALUES ('$kategori')");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=kategori&info=berhasil'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=kategori&info=gagal'</script>";
                return;
                exit;
            }
        }
    }
}
?>