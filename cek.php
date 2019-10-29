<?php
   $link = mysqli_connect("127.0.0.1", "zul", "zulfaza123","twibbon");
   $result = mysqli_query($link, "SELECT * FROM tb_pp");
   // tampilkan query
while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
{
   echo $row['id']." ".$row['nama']." ".$row['tipeimage']." ";
   echo "<br />";
}
   mysqli_close($link);
?>
