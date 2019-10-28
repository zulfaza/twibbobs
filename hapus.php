<?php 
$koneksi = mysqli_connect("localhost","root","","twibbon");
$id = $_GET['id'];
mysqli_query($koneksi,"DELETE FROM tb_images WHERE id='$id'") or die(mysqli_error($koneksi));

header("location:./timeline.php?pesan=hapus");
?>