<div class="box-title">
    <p>Beranda / <b>Produk Jualan</b></p>
</div>
<div id="box">
    <h1>Pembayaran</h1>
    <?php
// code by muh iriansyah putra pratama
    include '../../../database/koneksi.php';
// code by muh iriansyah putra pratama

    $total = $_GET['jum'];
    $id = $_GET['id'];
    try {
      $konfig ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $insert = $konfig->prepare("INSERT INTO pesanan (id_akun,id_barang,qty,kurir,date_in,total) SELECT id_akun,id_barang,qty,kurir,date_in,total FROM keranjang WHERE id_akun=?");
      $insert->execute(array($id));

      $delete = $konfig->prepare("DELETE FROM keranjang WHERE id_akun= ?");
      $delete->execute(array($id));
      ?>
    <table class="article">
        <tr>
            <td>Status</td>
            <td><a class="tombol-biru">Pesanan Berhasil</a></td>
        </tr>
        <tr>
            <td>Jumlah Pembayaran</td>
            <td><b><?php echo "Rp. ".$total; ?></b></td>
        </tr>
        <tr>
            <td>Deskripsi</td>
            <td>
                Lakukan pembayaran dengan mentransfer nominal <b>Jumlah Pembayaran</b> pada rekening :<br>
                <?php echo $_SESSION['jenis_bank'] ?><br>
                Rekening : <?php echo $_SESSION['nomor_rekening'] ?><br>
                A.N : <?php echo $_SESSION['nama_toko'] ?><br>
                Referensi : bayar/id user/jersey <b>contoh : bayar/<?php echo $id."/produk"; ?></b>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                Terima kasih telah membeli di website kami <br>
                anda dapat melihat <a class="link" href="?page=belanja">Detail Pesanan</a>
            </td>
        </tr>
    </table>

    <?php
    } catch (PDOexception $e) {
      print "Added data failed: " . $e->getMessage() . "<br/>";
       die();
    }
// code by muh iriansyah putra pratama
 ?>
</div>