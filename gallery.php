<?php
session_start();
include "../config.php";
$nama = $_SESSION['username'];
$query  = mysqli_query($koneksi, "SELECT * FROM tb_images WHERE nama = '$nama' ORDER BY id DESC");
?>

<form action="gambar.php" method="post">
    <table border="1" cellpadding="0" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Url</th>
            <th>autor</th>
        </tr>
        <?php if(mysqli_num_rows($query)>0){ ?>
        <?php
            $no = 1;
            while($data = mysqli_fetch_array($query)){
              $id =  $data['id'];
              $author = $data['nama'];
              $url ="./add_tw.php?id= $id";
        ?>
        <tr>
            <td><?php echo $no ?></td>
            <td><?php echo $url;?></td>
            <td><?php echo $author?></td>
            <td><input type="submit" value="<?php echo $author?>" /></td>
        </tr>
        <?php $no++; } ?>
        <?php } ?>
    </table>
</form>