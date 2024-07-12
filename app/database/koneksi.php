<?php 
// error_reporting(0);
date_default_timezone_set("Asia/Jakarta");

$config = mysqli_connect("localhost", "root", "", "aplikasi-sale") or mysqli_connect_errno();

try{
    $konfig = new PDO("mysql:host=localhost;dbname=aplikasi-sale", "root", "");
} catch (Exception $e){
    die("database gagal terhubung : ".$e->getMessage());
}
?>