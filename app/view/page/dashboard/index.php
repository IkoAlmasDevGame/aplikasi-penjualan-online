<?php 
require_once("../ui/header.php");
require_once("../ui/navbar.php");
?>
<div class="container-fluid">
    <div class="table-responsive">
        <div class="d-flex justify-content-evenly flex-wrap align-items-center">
            <div class="col-sm-9 col-md-8 mx-auto mt-2">
                <table class="table table-sm w-100 table-hover" id="example3">
                    <thead>
                        <tr class="">
                            <?php
                            $no = 1;
                            $query = $konfig->prepare("SELECT * FROM barang");
                            $query->execute();
                            $data = $query->fetchAll();
                            foreach ($data as $value) {
                        ?>
                            <td class="list sorting_desc_disabled sorting_asc_disabled">
                                <img src="../../../../assets/produk/<?php echo $value['gambar_produk']; ?>" width="80">
                                <br><?php echo $value['nama_barang']; ?>
                                <br><b><?php echo "Rp.".number_format($value['harga_jual']); ?></b>
                                <br>
                                <?php 
                                $id = htmlspecialchars($value['id_barang']);
                                $query = $konfig->prepare("SELECT SUM(qty)AS jumlah FROM pesanan WHERE id_barang = ?");
                                $query->execute(array($id));
                                $data = $query->fetch();
                                $hasil = $data['jumlah'];
                                    
                                $stok = $value['jumlah'];
                                $sisa = ($stok-$hasil);
                            ?>
                                <button type="button" class="btn btn-outline-secondary btn-sm">Stok :
                                    <?php
                                    if ($stok > 0){ 
                                        echo $stok;
                                    }else{ 
                                        echo "Habis";
                                    }
                                    ?>
                                </button>
                                <?php
                            if ($sisa > 0){
                            if (isset ($_SESSION['id_akun']) != ""){ ?>
                                <a class="btn btn-success btn-sm"
                                    href="?page=belanja_detail&id=<?php echo $value['id_barang']; ?>&st=<?php echo $sisa; ?>">Beli</a>
                                <?php 
                                }
                            } 
                            ?>
                            </td>
                            <?php
                            if ($no%4 == 0){
                                echo "</tr><tr>";
                                $no++;
                            } 
                            ?>
                            </td>
                            <?php
                                }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php 
require_once("../ui/footer.php");
?>