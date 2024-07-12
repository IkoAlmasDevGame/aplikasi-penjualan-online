<?php 
namespace controller;
use model\user;
use model\barang;
use model\kategori;
use model\satuan;
use model\pengaturan;
use model\cart;

class authentication {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new user($konfigs);
    }

    public function registerasi(){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $password = md5($_POST['password'], false);
        $repassword = md5($_POST['repassword'], false);

        $data = $this->konfigs->register($username,$email,$password,$repassword,$nama,$role);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function ubah(){
        $username = htmlentities($_POST['username']) ? htmlspecialchars($_POST['username']) : $_POST['username'];
        $email = htmlentities($_POST['email']) ? htmlspecialchars($_POST['email']) : $_POST['email'];
        $password = md5($_POST['password'], false);
        $repassword = md5($_POST['repassword'], false);
        $nama = htmlentities($_POST['nama_pengguna']) ? htmlspecialchars($_POST['nama_pengguna']) : $_POST['nama_pengguna'];
        $role = htmlentities($_POST['role']) ? htmlspecialchars($_POST['role']) : $_POST['role'];
        $id = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];

        $data = $this->konfigs->Edit($username,$email,$password,$repassword,$nama,$role,$id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $id = htmlentities($_GET['id_akun']) ? htmlspecialchars($_GET['id_akun']) : $_GET['id_akun'];
        $data = $this->konfigs->delete($id);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }

    public function login(){
        session_start();
        $userInput = htmlentities($_POST['userInput']) ? htmlspecialchars($_POST['userInput']) : $_POST['userInput'];
        $password = md5($_POST['password'], false);

        $data = $this->konfigs->signin($userInput,$password);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class briefcase {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new barang($konfigs);
    }

    public function buat(){
        $barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $kategori = htmlentities($_POST['id_kategori']) ? htmlspecialchars($_POST['id_kategori']) : $_POST['id_kategori'];
        $beli = htmlentities($_POST['beli']) ? htmlspecialchars($_POST['beli']) : $_POST['beli'];
        $jual = htmlentities($_POST['jual']) ? htmlspecialchars($_POST['jual']) : $_POST['jual'];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $satuan = htmlentities($_POST['id_satuan']) ? htmlspecialchars($_POST['id_satuan']) : $_POST['id_satuan'];
        $gambar = htmlentities($_FILES['gambar_produk']['name']) ? htmlspecialchars($_FILES['gambar_produk']['name']) : $_FILES['gambar_produk']['name'];
        $this->konfigs->create($barang, $kategori, $beli, $jual, $jumlah, $satuan, $gambar);
    }

    public function hapus(){
        $nbarang = htmlentities($_GET['barang']) ? htmlspecialchars($_GET['barang']) : $_GET['barang'];
        $this->konfigs->delete($nbarang);
    }

    public function jumlah(){
        $barang = htmlentities($_POST['nama_barang']) ? htmlspecialchars($_POST['nama_barang']) : $_POST['nama_barang'];
        $jumlah = htmlentities($_POST['jumlah']) ? htmlspecialchars($_POST['jumlah']) : $_POST['jumlah'];
        $this->konfigs->countBarang($barang,$jumlah);
    }
}

class Catalog {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new kategori($konfigs);
    }

    public function buat(){
        $kategori = htmlentities($_POST['nama_kategori']) ? htmlspecialchars($_POST['nama_kategori']) : $_POST['nama_kategori'];
        
        $data = $this->konfigs->create($kategori);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class unit {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new satuan($konfigs);
    } 

    public function buat(){
        $satuan = htmlentities($_POST['nama_satuan']) ? htmlspecialchars($_POST['nama_satuan']) : $_POST['nama_satuan'];
        
        $data = $this->konfigs->create($satuan);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class setting {
    
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new pengaturan($konfigs);
    } 
    
    public function ubah(){
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
        $gambar = htmlentities($_FILES['logo']['name']) ? htmlspecialchars($_FILES['logo']['name']) : $_FILES['logo']['name'];
        
        $data = $this->konfigs->edit($id, $nama, $jenis, $rekening, $gambar, $flags);
        if($data === true){
            return true;
        }else{
            return false;
        }
    }
}

class belanja {
    protected $konfigs;
    public function __construct($konfigs)
    {
        $this->konfigs = new cart($konfigs);
    }

    public function tambah(){
        $id_akun = htmlentities($_POST['id_akun']) ? htmlspecialchars($_POST['id_akun']) : $_POST['id_akun'];
        $id_barang = htmlentities($_POST['id_barang']) ? htmlspecialchars($_POST['id_barang']) : $_POST['id_barang'];
        $harga = htmlentities($_POST['harga']) ? htmlspecialchars($_POST['harga']) : $_POST['harga'];
        $qty = htmlentities($_POST['qty']) ? htmlspecialchars($_POST['qty']) : $_POST['qty'];
        $kurir = htmlentities($_POST['kurir']) ? htmlspecialchars($_POST['kurir']) : $_POST['kurir'];
        $date = date('Y-m-d');
        $total = $harga * $qty;

        $row = $this->konfigs->add($id_akun, $id_barang, $harga, $date, $qty, $kurir, $total);
        if($row === true){
            return true;
        }else{
            return false;
        }
    }
}
?>