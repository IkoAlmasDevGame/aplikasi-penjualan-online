<?php 
namespace model;

use Exception;

class cart {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function add($id_akun, $id_barang, $harga, $date, $qty, $kurir, $total){
        $id_akun = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];
        $id_barang = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];
        $harga = htmlentities($_POST['harga']) ? htmlspecialchars($_POST['harga']) : $_POST['harga'];
        $qty = htmlentities($_POST['qty']) ? htmlspecialchars($_POST['qty']) : $_POST['qty'];
        $kurir = htmlentities($_POST['kurir']) ? htmlspecialchars($_POST['kurir']) : $_POST['kurir'];
        $date = date('Y-m-d');
        $total = $harga * $qty;
        $sisa = htmlspecialchars($_POST['sisa']);
        $jumlahstok = $sisa - $qty;

        if ($qty > $sisa){
          echo "<script>alert('Kuantitas pesanan melebihi sisa stok barang');
          window.location='?page=belanja_detail&id=$id_barang&st=$sisa'</script>";
        }
        elseif ($qty <= 0){
          echo "<script>alert('Keliru dalam menginputkan kuantitas');
          window.location='?page=belanja_detail&id=$id_barang&st=$sisa'</script>";
        }       

        $table = "keranjang";
        $sql = "INSERT INTO $table (id_akun,id_barang,qty,kurir,date_in,total) VALUES (?,?,?,?,?,?)";
        $row = $this->db->prepare($sql);
        $row->execute(array($id_akun,$id_barang,$qty,$kurir,$date,$total));

        $this->db->prepare("UPDATE barang SET jumlah = ? WHERE id_barang = ?")->execute(array($jumlahstok, $id_barang));

        if($row != null){
            if($row){
            echo "<center><b>barang berhasil ditambahkan ke keranjang</b></center>";
            echo"<meta http-equiv='refresh' content='1; url=?page=beranda'>";
        }
            print "Added data failed: " . mysqli_connect_error() . "<br/>";
            die();
        }
    }
}
?>