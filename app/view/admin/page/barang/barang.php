<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Data Barang</title>
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
            <div class="card shadow mb-4">
                <div class="card-header py-2">
                    <h4 class="card-title display-4">
                        <i class="fa fa-briefcase fa-1x"></i>
                        Data Barang
                    </h4>
                    <div class="text-end">
                        <a href="../ui/header.php?page=barang" class="text-decoration-none btn btn-info btn-sm">
                            <i class="fa fa-refresh"></i>
                        </a>
                        <a href="../ui/header.php?page=barang&stok=yes"
                            class="text-decoration-none btn btn-warning btn-sm">
                            <i class="fa fa-list"></i>
                        </a>
                    </div>
                    <div class="mt-1">
                        <?php require_once("functions.php") ?>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-responsive-lg">
                        <div class="form-group mb-1">
                            <form method="post">
                                <div class="form-inline d-flex justify-content-center align-items-center flex-wrap">
                                    <input type="search" name="cari" class="form-control"
                                        aria-controls="example2_filter" id="example1_filter" aria-required="true"
                                        required>
                                </div>
                            </form>
                        </div>
                        <table id="example1" class="table table-sm w-100 table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Photo Produk</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Kategori Produk</th>
                                    <th class="text-center">Modal Beli</th>
                                    <th class="text-center">Modal Jual</th>
                                    <th class="text-center">Jumlah Stok</th>
                                    <th class="text-center">Satuan Produk</th>
                                    <th class="text-center">Opsional</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                $hb = 0;
                                $hj = 0;
                                $jumlah = 0;
                                if(isset($_GET['stok'])){
                                    if($_GET['stok'] == "yes"){
                                        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan FROM barang
                                         inner join kategori on barang.id_kategori = kategori.id_kategori inner join satuan on barang.id_satuan = satuan.id_satuan WHERE jumlah <= 3 order by id_barang asc";
                                        $row = $config->query($sql);
                                    }
                                }else{
                                    $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan FROM barang
                                     inner join kategori on barang.id_kategori = kategori.id_kategori inner join satuan on barang.id_satuan = satuan.id_satuan order by id_barang asc";
                                    $row = $config->query($sql);
                                }
                                while($isi = mysqli_fetch_array($row)){
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $no; ?></td>
                                    <td class="text-center">
                                        <img src="../../../../assets/produk/<?=$isi['gambar_produk']?>"
                                            class="rounded-1" width="64" alt="<?=$isi['gambar_produk']?>">
                                    </td>
                                    <td class="text-center"><?php echo $isi['nama_barang'] ?></td>
                                    <td class="text-center"><?php echo $isi['nama_kategori'] ?></td>
                                    <td class="text-center">Rp. <?php echo number_format($isi['harga_beli']) ?> ,-</td>
                                    <td class="text-center">Rp. <?php echo number_format($isi['harga_jual']) ?> ,-</td>
                                    <td class="text-center">
                                        <?php 
                                        if(isset($_GET['stok'])){
                                            if($_GET['stok'] == "yes"){    
                                        ?>
                                        <form action="?aksi=updated-barang" method="post">
                                            <input type="hidden" name="nama_barang" value="<?=$isi['nama_barang']?>">
                                            <div class="form-inline
                                                 d-flex justify-content-between align-items flex-wrap">
                                                <input type="text" name="jumlah" class="border rounded-1 col-sm-10 py-1"
                                                    aria-required="true" value="<?=$isi['jumlah']?>" required id="">
                                                <button type="submit" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-save"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <?php 
                                            }
                                        }else if($isi['jumlah'] <= 3){ ?>
                                        <p>Jumlah Persediaan Barang Tersisa <?php echo $isi['jumlah'] ?></p>
                                        <?php 
                                        }else{
                                        ?>
                                        <?php echo $isi['jumlah'] ?>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $isi['nama_satuan'] ?></td>
                                    <td class="text-center">
                                        <a href="#" data-bs-target="#modalupdate<?=$isi['id_barang']?>"
                                            data-bs-toggle="modal" class="btn btn-warning btn-sm">
                                            <i class="fa fa-1x fa-edit"></i>
                                        </a>
                                        <a href="?page=barang&aksi=hapus-barang&barang=<?=$isi['nama_barang']?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah anda ingin menghapus data ini ?')">
                                            <i class="fa fa-1x fa-trash"></i>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="modalupdate<?=$isi['id_barang']?>" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><i class="bi bi-edit fa-1x"></i>
                                                        Edit Data Barang
                                                    </h4>
                                                    <button type='button' class='btn-close'
                                                        data-bs-dismiss='modal'></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="?aksi=barang" enctype="multipart/form-data"
                                                        method="post">
                                                        <input type="hidden" name="id_barang"
                                                            value="<?=$isi['id_barang']?>">
                                                        <div class="form-group">
                                                            <div class="mb-1"></div>
                                                            <div class="form-inline">
                                                                <div class="form-label">
                                                                    <label for="barang" class="label label-default">Nama
                                                                        Barang</label>
                                                                </div>
                                                                <input type="text" name="nama_barang" id="barang"
                                                                    value="<?=$isi['nama_barang']?>"
                                                                    aria-required="true" required class="form-control">
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-inline">
                                                                <div class="form-label">
                                                                    <label for="kategori"
                                                                        class="label label-default">Kategori
                                                                        Produk</label>
                                                                </div>
                                                                <select name="id_kategori" id="kategori"
                                                                    class="form-control form-select" required
                                                                    aria-required="true">
                                                                    <option value="">Pilih Kategori</option>
                                                                    <?php 
                                                                        $kategori = $config->query("SELECT * FROM kategori order by id_kategori asc");
                                                                            while($rk = $kategori->fetch_array()){
                                                                        ?>
                                                                    <option
                                                                        <?php if($isi['id_kategori'] == $rk['id_kategori']){?>
                                                                        selected <?php } ?>
                                                                        value="<?=$rk['id_kategori']?>">
                                                                        <?php echo $rk['nama_kategori'] ?>
                                                                    </option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-inline">
                                                                <div class="form-label">
                                                                    <label for="harga_beli"
                                                                        class="label label-default">Harga
                                                                        Beli</label>
                                                                </div>
                                                                <small id="rupiahText"></small>
                                                                <input type="text" name="beli"
                                                                    value="<?php echo $isi['harga_beli']?>"
                                                                    maxlength="13" onkeyup="rupiah()"
                                                                    placeholder="masukkan harga beli ..."
                                                                    class="form-control" required aria-required="true"
                                                                    id="nominal">
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-inline">
                                                                <div class="form-label">
                                                                    <label for="harga_jual"
                                                                        class="label label-default">Harga
                                                                        Jual</label>
                                                                </div>
                                                                <small id="rupiahText1"></small>
                                                                <input type="text" name="jual"
                                                                    value="<?=$isi['harga_jual']?>" maxlength="13"
                                                                    onkeyup="rupiah1()"
                                                                    placeholder="masukkan harga jual ..."
                                                                    class="form-control" required aria-required="true"
                                                                    id="nominal1">
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-group">
                                                                <div class="form-inline">
                                                                    <label for="nama_barang" class="form-label">Jumlah
                                                                        Produk</label>
                                                                </div>
                                                                <input type="text" name="jumlah" maxlength="11"
                                                                    placeholder="masukkan Jumlah Produk ..."
                                                                    class="form-control" value="<?=$isi['jumlah']?>"
                                                                    required aria-required="true" id="jumlah">
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-group">
                                                                <div class="form-inline">
                                                                    <label for="kategori" class="form-label">Satuan
                                                                        Produk</label>
                                                                </div>
                                                                <select name="id_satuan" id="satuan"
                                                                    class="form-control form-select" required
                                                                    aria-required="true">
                                                                    <option value="">Pilih Satuan</option>
                                                                    <?php 
                                                                        $satuan = $config->query("SELECT * FROM satuan order by id_satuan asc");
                                                                        while($rs = $satuan->fetch_array()){
                                                                    ?>
                                                                    <option
                                                                        <?php if($isi['id_satuan'] == $rs['id_satuan']){?>
                                                                        selected <?php } ?>
                                                                        value="<?=$rs['id_satuan']?>">
                                                                        <?php echo $rs['nama_satuan'] ?></option>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-1"></div>
                                                            <div class="form-group">
                                                                <img src="../../../../assets/produk/<?=$isi['gambar_produk']?>"
                                                                    id="preview" width="64" class="img-responsive"
                                                                    alt="">
                                                                <div class="form-inline">
                                                                    <label for="photo" class="form-label">Gambar
                                                                        Produk</label>
                                                                </div>
                                                                <input type="file" accept="image/*"
                                                                    onchange="previewImage(this)" name="gambar_produk"
                                                                    class="form-control" required aria-required="true"
                                                                    id="photo">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-secondary">
                                                                    <i class="fa fa-save fa-1x"></i>
                                                                    <span>Update</span>
                                                                </button>
                                                                <button type="reset" class="btn btn-danger">
                                                                    <i class="fa fa-eraser fa-1x"></i>
                                                                    <span>Hapus Semua</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php
                                $no++;
                                $hb += $isi['harga_beli'];
                                $hj += $isi['harga_jual'];
                                $jumlah += $isi['jumlah'];
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <th colspan="4" class="bg-secondary text-light">Total Keseluruhan</th>
                                <th class="text-center">Rp. <?php echo number_format($hb) ?> ,-</th>
                                <th class="text-center">Rp. <?php echo number_format($hj) ?> ,-</th>
                                <th class="text-center"><?php echo $jumlah ?></th>
                                <th colspan="2" class="bg-secondary text-light"></th>
                            </tfoot>
                        </table>
                        <table>
                            <tbody>
                                <a href="#" data-bs-target="#tambahbarang" data-bs-toggle="modal"
                                    class="btn btn-sm btn-danger">
                                    <i class="bi bi-plus"></i>
                                    <span>Tambah Data Barang</span>
                                </a>
                                <div class="modal fade" id="tambahbarang" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><i class="bi bi-plus fa-1x"></i>
                                                    Tambah Barang
                                                </h4>
                                                <button type='button' class='btn-close'
                                                    data-bs-dismiss='modal'></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="?aksi=barang" method="post" enctype="multipart/form-data">
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="nama_barang" class="form-label">Nama
                                                                Produk</label>
                                                        </div>
                                                        <input type="text" name="nama_barang" maxlength="200"
                                                            placeholder="masukkan nama produk anda ..."
                                                            class="form-control" required aria-required="true"
                                                            id="nama_barang">
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="kategori" class="form-label">Kategori
                                                                Produk</label>
                                                        </div>
                                                        <select name="id_kategori" id="kategori"
                                                            class="form-control form-select" required
                                                            aria-required="true">
                                                            <option value="">Pilih Kategori</option>
                                                            <?php 
                                                                $kategori = $config->query("SELECT * FROM kategori order by id_kategori asc");
                                                                while($rk = $kategori->fetch_array()){
                                                            ?>
                                                            <option value="<?=$rk['id_kategori']?>">
                                                                <?php echo $rk['nama_kategori'] ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="harga_beli" class="form-label">Harga
                                                                Beli</label>
                                                        </div>
                                                        <small id="rupiahText"></small>
                                                        <input type="text" name="beli" maxlength="13" onkeyup="rupiah()"
                                                            placeholder="masukkan harga beli ..." class="form-control"
                                                            required aria-required="true" id="nominal">
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="harga_jual" class="form-label">Harga
                                                                Jual</label>
                                                        </div>
                                                        <small id="rupiahText1"></small>
                                                        <input type="text" name="jual" maxlength="13"
                                                            onkeyup="rupiah1()" placeholder="masukkan harga jual ..."
                                                            class="form-control" required aria-required="true"
                                                            id="nominal1">
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="nama_barang" class="form-label">Jumlah
                                                                Produk</label>
                                                        </div>
                                                        <input type="text" name="jumlah" maxlength="11"
                                                            placeholder="masukkan Jumlah Produk ..."
                                                            class="form-control" required aria-required="true"
                                                            id="jumlah">
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <div class="form-inline">
                                                            <label for="kategori" class="form-label">Satuan
                                                                Produk</label>
                                                        </div>
                                                        <select name="id_satuan" id="satuan"
                                                            class="form-control form-select" required
                                                            aria-required="true">
                                                            <option value="">Pilih Satuan</option>
                                                            <?php 
                                                                $satuan = $config->query("SELECT * FROM satuan order by id_satuan asc");
                                                                while($rs = $satuan->fetch_array()){
                                                            ?>
                                                            <option value="<?=$rs['id_satuan']?>">
                                                                <?php echo $rs['nama_satuan'] ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="mb-1"></div>
                                                    <div class="form-group">
                                                        <img src="https://th.bing.com/th/id/OIP.kAkeoK_c-pTp9J-DXaWqbQAAAA?w=154&h=196&c=7&r=0&o=5&pid=1.7"
                                                            id="preview" width="64" class="img-responsive" alt="">
                                                        <div class="form-inline">
                                                            <label for="photo" class="form-label">Gambar
                                                                Produk</label>
                                                        </div>
                                                        <input type="file" accept="image/*"
                                                            onchange="previewImage(this)" name="gambar_produk"
                                                            class="form-control" required aria-required="true"
                                                            id="photo">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fa fa-save fa-1x"></i>
                                                            <span>Simpan</span>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../ui/footer.php") ?>