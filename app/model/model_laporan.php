<?php 
namespace model;

class Laporan {
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function jual(){
        $sql = "SELECT pesanan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from pesanan 
        inner join barang on barang.id_barang = pesanan.id_barang where pesanan.date_in = ? ORDER BY id_pesanan ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array(date("Y-m-d")));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function periode_jual($periode){
        $sql = "SELECT pesanan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from pesanan 
        inner join barang on barang.id_barang = pesanan.id_barang where pesanan.date_in = ? ORDER BY id_pesanan ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($periode));
        $hasil = $row->fetchAll();
        return $hasil;
    }

    public function hari_jual($hari){
        $ex = explode('-', $hari);
        $monthNum  = $ex[1];
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }
        $cek = $tgl.' '.$monthName.' '.$ex[0];
        $param = "%{$cek}%";
        $sql = "SELECT pesanan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, barang.harga_jual from pesanan 
        inner join barang on barang.id_barang = pesanan.id_barang where pesanan.date_in = ? ORDER BY id_pesanan ASC";
        $row = $this->db->prepare($sql);
        $row->execute(array($param));
        $hasil = $row->fetchAll();
        return $hasil;
    }
}
?>