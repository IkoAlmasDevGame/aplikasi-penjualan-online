<?php 
namespace model;

class satuan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($satuan){
        $id = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];
        $satuan = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];
        
        $table = "satuan";
        $select = "SELECT count(id_satuan) as id FROM satuan WHERE id_satuan = '$id'";
        $select_db = $this->db->query($select);
        $cek_select = mysqli_fetch_array($select_db);

        if($cek_select['id'] > 0){
            $data = $this->db->query("UPDATE $table SET nama_satuan = '$satuan' WHERE id_satuan = '$id'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=satuan&info=ubah'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=satuan&info=gagal'</script>";
                return;
                exit;
            }
        }else if(isset($_GET['id'])){
            $id = htmlentities($_GET['id']) ? htmlspecialchars($_GET['id']) : $_GET['id'];
            $data = $this->db->query("DELETE FROM $table WHERE id_satuan = '$id'");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=satuan&info=hapus'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=satuan&info=gagal'</script>";
                return;
                exit;
            }
        }else{
            $data = $this->db->query("INSERT INTO $table (nama_satuan) VALUES ('$satuan')");
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=satuan&info=berhasil'</script>";
                    return;
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=satuan&info=gagal'</script>";
                return;
                exit;
            }
        }
    }
}

?>