<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php 
            if($_SESSION["role"] == "admin")
            {
                error_reporting(0);
                require_once("../ui/header.php");
                require_once("../../database/koneksi.php");

                $bulan_tes = array(
                '01' => "Januari",
                '02' => "Februari",
                '03' => "Maret",
                '04' => "April",
                '05' => "Mei",
                '06' => "Juni",
                '07' => "Juli",
                '08' => "Agustus",
                '09' => "September",
                '10' => "Oktober",
                '11' => "November",
                '12' => "Desember");

                header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
                header("Content-Disposition: attachment; filename=Laporan_Penjualan ".date('d-m-Y').".xls");  //File name extension was wrong
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private",false);
            }else{
                header("location:../ui/header.php?page=beranda");
            }
        ?>
        <title>Laporan Penjualan</title>
    </head>

    <div class="container-fluid">
        <div class="row">
            <h3 style="text-align:center;">
                <?php if(!empty(htmlentities($_POST['cari']))){ ?>
                Data Laporan Penjualan <?= $bulan_tes[htmlentities($_POST['bln'])];?>
                <?= htmlentities($_POST['thn']);?>
                <?php }elseif(!empty(htmlentities($_POST['hari']))){?>
                Data Laporan Penjualan <?= htmlentities($_POST['tgl']);?>
                <?php }else{?>
                Data Laporan Penjualan <?= $bulan_tes[date('m')];?> <?= date('Y');?>
                <?php }?>
            </h3>
            <table border="1" width="100%" cellpadding="3" cellspacing="4">
                <thead>
                    <tr style="background:#DFF0D8;color:#333;">
                        <th> No</th>
                        <th> Nama Barang</th>
                        <th style="width:10%; max-width:10%;"> Jumlah</th>
                        <th style="width:10%; max-width:10%;"> Modal Beli</th>
                        <th style="width:10%; max-width:10%;"> Modal Jual</th>
                        <th style="width:10%; max-width:10%;"> Total</th>
                        <th> Tanggal Input</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $modal2 = 0;
                        $modal1 = 0;
                        $jumlah = 0;
                        $bayar = 0;
                        $keperluan = 0;
                        $no=1; 
                        
                        if(!empty($_POST['cari'])){
                            $periode = $_POST['bln'].'-'.$_POST['thn'];
                            $no=1; 
                            $jumlah = 0;
                            $bayar = 0;
                            $hasil = $laporanAuth-> periode_jual($periode);
                        }elseif(!empty($_POST['hari'])){
                            $hari = $_POST['hari'];
                            $no=1; 
                            $jumlah = 0;
                            $bayar = 0;
                            $hasil = $laporanAuth-> hari_jual($hari);
                        }else{
                            $hasil = $laporanAuth->jual();
                        }
                                        
                        foreach ($hasil as $isi) {
                            $bayar += $isi['total'];
                            $modal1 += $isi['harga_beli'];
                            $modal2 += $isi['harga_jual'];
                            $jumlah += $isi['jumlah'];
                            $keperluan += $isi['total'] - ($modal1 + $modal2);
                        ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $isi['nama_barang'];?></td>
                        <td><?php echo $isi['jumlah'];?> </td>
                        <td>Rp.<?php echo number_format($isi['harga_beli']);?>,-</td>
                        <td>Rp.<?php echo number_format($isi['harga_jual']);?>,-</td>
                        <td>Rp.<?php echo number_format($isi['total']);?>,-</td>
                        <td><?php echo $isi['tanggal_input'];?></td>
                    </tr>
                    <?php
                    $no++;
                        }
                    ?>
                    <tr>
                        <td colspan="1"></td>
                        <td><b>Total Terjual</b></td>
                        <td><b><?php echo $jumlah;?></b></td>
                        <td><b>Rp.<?php echo number_format($modal1);?>,-</b></td>
                        <td><b>Rp.<?php echo number_format($modal2);?>,-</b></td>
                        <td><b>Rp.<?php echo number_format($bayar);?>,-</b></td>
                        <td><b>Keuntungan</b></td>
                        <td><b>Rp.<?php echo number_format($keperluan);?>,-</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <?php require_once("../ui/footer.php"); ?>