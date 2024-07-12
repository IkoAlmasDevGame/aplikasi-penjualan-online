<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pengaturan Website</title>
        <link rel="shortcut icon" href="../../../../assets/logo/<?php echo $_SESSION['logo']?>" type="image/x-icon">
        <?php 
            if($_SESSION['role'] == "admin"){
                require_once("../ui/header.php");
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
    </head>

    <body>
        <?php require_once("../ui/sidebar.php") ?>
        <div class="container-fluid">
            <?php 
                if(isset($_GET['id_sistem'])){
                    $id = htmlspecialchars($_GET['id_sistem']);
                    $sql = "SELECT * FROM sistem WHERE id_sistem = '$id' and flags = '1'";
                    $query = $config->query($sql);
                while($row = mysqli_fetch_array($query)){
                    $exp = explode("-", $row['nomor_rekening']);
            ?>
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="card shadow mb-4" style="width: 500px; max-width: 720px;">
                    <div class="card-header py-2">
                        <h4 class="card-title display-4 d-flex justify-content-around align-items-center flex-wrap">
                            <i class="bi bi-shop fa-2x"></i>
                            <?php echo $row['nama_toko'] ?>
                        </h4>
                        <div class="card-body">
                            <div class="table-responsive">
                                <form action="?aksi=ubahpengaturan" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="id_sistem" value="<?=$id?>">
                                    <input type="hidden" name="flags" value="1">
                                    <div class="form-group">
                                        <div class="form-inline mb-1">
                                            <div class="form-label">
                                                <label for="" class="label label-default">Nama Toko / Nama
                                                    Warung</label>
                                            </div>
                                            <input type="text" name="nama_toko" class="form-control" required
                                                value="<?=$row['nama_toko']?>" aria-required="TRUE" id="">
                                        </div>
                                        <div class="form-inline mb-1">
                                            <div class="form-label">
                                                <label for="" class="label label-default">Jenis Bank</label>
                                            </div>
                                            <select name="jenis_bank" class="form-select form-control"
                                                aria-required="TRUE" required id="">
                                                <option value="">Pilih Jenis Bank</option>
                                                <option <?php if($row['jenis_bank'] == "Bank Mandiri"){?> selected
                                                    <?php } ?> value="Bank Mandiri">Bank Mandiri</option>
                                                <option
                                                    <?php if($row['jenis_bank'] == "Bank Syariah Indonesia (BSI)"){?>
                                                    selected <?php } ?> value="Bank Syariah Indonesia (BSI)">Bank
                                                    Syariah Indonesia (BSI)
                                                </option>
                                                <option <?php if($row['jenis_bank'] == "Bank Negara Indonesia (BNI)"){?>
                                                    selected <?php } ?> value="Bank Negara Indonesia (BNI)">Bank Negara
                                                    Indonesia (BNI)
                                                </option>
                                                <option <?php if($row['jenis_bank'] == "Bank Rakyat Indonesia (BRI)"){?>
                                                    selected <?php } ?> value="Bank Rakyat Indonesia (BRI)">Bank Rakyat
                                                    Indonesia (BRI)
                                                </option>
                                                <option <?php if($row['jenis_bank'] == "Bank Central Asia (BCA)"){?>
                                                    selected <?php } ?> value="Bank Central Asia (BCA)">Bank Central
                                                    Asia (BCA)
                                                </option>
                                                <option <?php if($row['jenis_bank'] == "Bank Tabungan Negara (BTN)"){?>
                                                    selected <?php } ?> value="Bank Tabungan Negara (BTN)">Bank Tabungan
                                                    Negara (BTN)
                                                </option>
                                                <option <?php if($row['jenis_bank'] == "CIMB Niaga"){?> selected
                                                    <?php } ?> value="CIMB Niaga">CIMB Niaga</option>
                                                <option <?php if($row['jenis_bank'] == "CIMB Niaga Syariah"){?> selected
                                                    <?php } ?> value="CIMB Niaga Syariah">CIMB Niaga Syariah</option>
                                                <option <?php if($row['jenis_bank'] == "Bank Danamon"){?> selected
                                                    <?php } ?> value="Bank Danamon">Bank Danamon</option>
                                                <option <?php if($row['jenis_bank'] == "Bank Danamon Syariah"){?>
                                                    selected <?php } ?> value="Bank Danamon Syariah">Bank Danamon
                                                    Syariah</option>
                                                <option <?php if($row['jenis_bank'] == "Bank Muamalat"){?> selected
                                                    <?php } ?> value="Bank Muamalat">Bank Muamalat</option>
                                                <option <?php if($row['jenis_bank'] == "Maybank"){?> selected <?php } ?>
                                                    value="Maybank">Maybank</option>
                                                <option <?php if($row['jenis_bank'] == "OCBC NISP"){?> selected
                                                    <?php } ?> value="OCBC NISP">OCBC NISP</option>
                                                <option <?php if($row['jenis_bank'] == "Bank Bukopin"){?> selected
                                                    <?php } ?> value="Bank Bukopin">Bank Bukopin</option>
                                            </select>
                                        </div>
                                        <div class="form-inline mb-1">
                                            <div class="form-label">
                                                <label for="" class="label label-default">Nomer Rekening</label>
                                                <a href="" role="button" data-bs-target="#jenisbank"
                                                    data-bs-toggle="modal" class="btn btn-sm btn-default">
                                                    <i class="fa fa-table fa-1x"></i>
                                                    <span>lihat digit bank</span>
                                                </a>
                                                <div class="modal fade" id="jenisbank" tabindex="-1" aria-hidden="TRUE">
                                                    <div class="modal-dialog modal-dialog-centered
                                                         d-flex justify-content-center align-items-center flex-wrap"
                                                        style="position: relative; right:-9%; top:-9.2%;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title display-4">Jenis Bank Digit</h4>
                                                                <button type='button' class='btn btn-close'
                                                                    data-bs-dismiss='modal'></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="card-comment">
                                                                    <?php require_once("bank.php") ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="text" name="nomor1"
                                                class="p-1 col-sm-2 col-lg-2 border rounded-1 text-center" required
                                                value="<?=$exp['0']?>" aria-required="TRUE" id="">
                                            -
                                            <input type="text" name="nomor2"
                                                class="p-1 col-sm-2 col-lg-2 border rounded-1 text-center" required
                                                value="<?=$exp['1']?>" aria-required="TRUE" id="">
                                            -
                                            <input type="text" name="nomor3"
                                                class="p-1 col-sm-2 col-lg-2 border rounded-1 text-center" required
                                                value="<?=$exp['2']?>" aria-required="TRUE" id="">
                                            -
                                            <input type="text" name="nomor4"
                                                class="p-1 col-sm-2 col-lg-2 border rounded-1 text-center" required
                                                value="<?=$exp['3']?>" aria-required="TRUE" id="">
                                            -
                                            <input type="text" name="nomor5"
                                                class="p-1 col-sm-2 col-lg-2 border rounded-1 text-center" required
                                                value="<?=$exp['4']?>" aria-required="TRUE" id="">
                                        </div>
                                        <div class="form-group mb-1">
                                            <div class="form-inline mb-1">
                                                <label for="photo" class="form-label">Gambar
                                                    Logo</label>
                                            </div>
                                            <img src="../../../../assets/logo/<?=$row['logo']?>" id="preview" width="64"
                                                class="img-responsive mb-2 mx-2" alt="">
                                            <input type="file" accept="image/*" onchange="previewImage(this)"
                                                name="gambar_produk" class="form-control" required aria-required="true"
                                                id="photo">
                                        </div>
                                    </div>
                                    <div class="card-footer text-end">
                                        <button type="submit" class="btn btn-secondary">
                                            <i class="fa fa-save fa-1x"></i>
                                            <span>Update</span>
                                        </button>
                                        <button type="reset" class="btn btn-danger">
                                            <i class="fa fa-eraser fa-1x"></i>
                                            <span>Hapus Semua</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <?php require_once("../ui/footer.php") ?>