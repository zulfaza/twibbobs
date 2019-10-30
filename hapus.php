<?php 
require_once("config.php"); 
$id = $_GET['id'];

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($koneksi,"DELETE FROM tb_images WHERE id='$id'") or die(mysqli_error($koneksi));
header("location:./timeline.php?pesan=hapus");
}
if(isset($_GET['akun'])){
    $id = $_GET['akun'];
    mysqli_query($koneksi,"DELETE FROM users WHERE id='$id'") or die(mysqli_error($koneksi));
    header("location:./cek.php?pesan=hapus");
    }
?>
