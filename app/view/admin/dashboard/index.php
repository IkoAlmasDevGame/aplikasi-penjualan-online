<?php 
require_once("../ui/header.php");
require_once("../ui/sidebar.php");
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title text-center fs-2">Terjual</h4>
                </div>
                <div class="card-body">
                    <?php 
                        $row = $config->query("SELECT sum(qty) as terjual FROM pesanan");
                        $isi = $row->fetch_array();
                    ?>
                    <p class="text-center fs-2"><?php echo $isi['terjual'] ?></p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title text-center fs-2">Total Modal</h4>
                </div>
                <div class="card-body">
                    <?php 
                        $row = $config->query("SELECT sum(total) as terbeli FROM pesanan");
                        $isi = $row->fetch_array();
                    ?>
                    <p class="text-center fs-2">Rp. <?php echo number_format($isi['terbeli']) ?> ,-</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
require_once("../ui/footer.php");
?>