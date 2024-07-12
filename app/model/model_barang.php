<?php 
namespace model;

class barang {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($barang, $kategori, $beli, $jual, $jumlah, $satuan, $gambar){
        $barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['beli']) ? htmlspecialchars($_POST['beli']) : $_POST['beli'];
        $jual = htmlentities($_POST['jual']) ? htmlspecialchars($_POST['jual']) : $_POST['jual'];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];
        $id = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];
        
        /* Data Gambar Produk */
        $ekstensi_diperbolehkan_gambar = array('png', 'jpg', 'jpeg', 'jfif', 'gif'); 
        $gambar = htmlentities($_FILES['gambar_produk']['name']) ? htmlspecialchars($_FILES['gambar_produk']['name']) : $_FILES['gambar_produk']['name'];
        $x_gambar = explode('.', $gambar);
        $ekstensi_gambar = strtolower(end($x_gambar));
        $ukuran_gambar = $_FILES['gambar_produk']['size'];
        $file_tmp_gambar = $_FILES['gambar_produk']['tmp_name'];
        /* Data Insert */

        $table = "barang";
        $select = "SELECT count(id_barang) as id FROM $table WHERE id_barang = '$id'";
        $reselect = $this->db->query($select);
        $cek_select = mysqli_fetch_array($reselect);
        
        if(in_array($ekstensi_gambar, $ekstensi_diperbolehkan_gambar) === true){
            if($ukuran_gambar < 10440070){
                move_uploaded_file($file_tmp_gambar, "../../../../assets/produk/" . $gambar);
            }else{
                echo "Tidak Dapat Ter - Upload Size Gambar";
                exit;                
            }
        }else{
            echo "Tidak Dapat Ter - Upload Gambar";
            exit;
        }

        if($cek_select['id'] > 0){
            $sqlupdated = "UPDATE $table SET nama_barang='$barang', id_kategori='$kategori', harga_beli='$beli', harga_jual='$jual',
             jumlah='$jumlah', id_satuan='$satuan', gambar_produk='$gambar' WHERE id_barang='$id'";
            $dataUpdated = $this->db->query($sqlupdated);
                    
            if($dataUpdated != null){
                if($dataUpdated){
                    echo "<script>document.location.href = '../ui/header.php?page=barang&info=ubah'</script>";
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=barang&info=gagal'</script>";
                exit;
            }
        }else{
            $sql = "INSERT INTO barang (nama_barang,id_kategori,harga_beli,harga_jual,jumlah,id_satuan,gambar_produk)
             VALUES ('$barang','$kategori','$beli','$jual','$jumlah','$satuan','$gambar')";
            $data = $this->db->query($sql);
                    
            if($data != null){
                if($data){
                    echo "<script>document.location.href = '../ui/header.php?page=barang&info=berhasil'</script>";
                    exit;
                }
            }else{
                echo "<script>document.location.href = '../ui/header.php?page=barang&info=gagal'</script>";
                exit;
            }
        }
    }

    public function delete($nbarang){
        $nbarang = htmlentities($_GET['barang']) ? htmlspecialchars($_GET['barang']) : $_GET['barang'];
        $table = "barang";
        $sqlhapus = "DELETE FROM $table WHERE nama_barang = '$nbarang'";
        $dataHapus = $this->db->query($sqlhapus);
                    
        if($dataHapus != null){
            if($dataHapus){
                echo "<script>document.location.href = '../ui/header.php?page=barang&info=hapus'</script>";
                exit;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=barang&info=gagal'</script>";
            exit;
        }
    }

    public function countBarang($barang,$jumlah){
        $barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $table = "barang";
        $sqlupdate = "UPDATE $table SET jumlah = '$jumlah' WHERE nama_barang = '$barang'";
        $dataUpdate = $this->db->query($sqlupdate);
                
        if($dataUpdate != null){
            if($dataUpdate){
                echo "<script>document.location.href = '../ui/header.php?page=barang&info=jumlah'</script>";
                exit;
            }
        }else{
            echo "<script>document.location.href = '../ui/header.php?page=barang&info=gagal'</script>";
            exit;
        }
    }
}
?>