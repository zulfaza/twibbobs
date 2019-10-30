<?php require_once("auth.php"); ?>
<?php 
	if($_SESSION['status']!="login"){
		header("location:./login.php?pesan=belum_login");
	}
    $id = $_SESSION['user']['id'];
    $koneksi = mysqli_connect("localhost","root","","twibbon");
    $query  = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id' ORDER BY id DESC");
    $data = mysqli_fetch_array($query);
    $name = $data['name'];
    $email = $data['email'];
    $pp = $data['photo'];
    ?>
<?php
if (count($_FILES) > 0) {
    if (is_uploaded_file($_FILES['gambar']['tmp_name'])) {
        $extensionList = array("png");
        $fileName = $_FILES['gambar']['name']; 
        $pecah = explode(".", $fileName);
        $ekstensi = $pecah[1];
        $size=$_FILES['gambar']['size'];
        list( $lebar, $tinggi ) = getimagesize($filesave);
        if (in_array($ekstensi, $extensionList))
            {
                if($size<=2000000){
        $koneksi = mysqli_connect("localhost","root","","twibbon");
		$datagambar = addslashes(file_get_contents($_FILES['gambar']['tmp_name']));
        $propertiesgambar = getimageSize($_FILES['gambar']['tmp_name']);
        $nama = $_SESSION['username'];
        $nama_tw = $_POST['nama_tw'];
        $caption = $_POST['caption'];
        $ukuran = $propertiesgambar[1];

        $sql = "INSERT INTO tb_images(author,tipeimage ,dataimage,nama_tw,ukuran,caption) VALUES('" . $nama . "','" . $propertiesgambar['mime'] . "', '" . $datagambar . "', '" . $nama_tw . "','" . $ukuran . "','".$caption."' )";
        mysqli_query($koneksi, $sql) or die("<b>Error:</b> Ada kesalahan<br/>" . mysqli_error($koneksi));
        $lastrecord = "SELECT id FROM tb_images ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($koneksi, $lastrecord) or die("<b>Error:</b> Ada kesalahan<br/>" . mysqli_error($koneksi));
        $getid = mysqli_fetch_array($result);
        if (isset($getid["id"])) {
            header("Location: timeline.php?pesan=upload_berhasil");
        }
    } else {
        header("Location: timeline.php?pesan=overload");
    }
        } else{
            header("Location: timeline.php?pesan=format_salah");
        }
    }
}
?>
<?php
        $id=0;
        $nama_tw = " ";
        $caption= " ";
        $update = false;
        $id_user=$_SESSION["user"]["id"];

        $koneksi = mysqli_connect("localhost","root","","twibbon");
        
        $nama = $_SESSION['username'];
        
        
        if(isset($_GET['edit'])){
            $id = $_GET['edit'];
            $query  = mysqli_query($koneksi, "SELECT * FROM tb_images WHERE id = '$id' ORDER BY id DESC");
            $data = mysqli_fetch_array($query);
            $nama_tw = $data['nama_tw'];
            $caption = $data['caption'];
            $update=true;
        }
        if(isset($_POST['update'])){
            $id=$_POST['id'];
            $nama_tw=$_POST['nama_tw'];
            $caption=$_POST['caption'];
            
            $sql = "UPDATE tb_images SET nama_tw='$nama_tw', caption='$caption' WHERE id=$id";
            mysqli_query($koneksi, $sql) or die(header("Location: timeline.php?pesan=update_fail"));
            header("Location: timeline.php?pesan=updated");
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Twibbobs</title>
</head>

<body class="bg-light">

<header id="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light >
        <a class="navbar-brand" href="./index.php">
          <h1>Twibbobs</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
            <?php
            if($_SESSION["user"]['level']=="admin"){
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"./cek.php\" style=\"color:red\">Admin Page</a></li>"; 
            }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php" style="color:#007bff">logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>

    <section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-body text-center">
                        
                            <div class="container mb-3" id="pp">
                        <img class="img img-responsive" height="160"
                            src="<?php echo $pp ?>" />
                            </div>

                        <h3><?php echo  $name ?></h3>
                        <p><?php echo $email ?></p>

                        <a href="logout.php" class="btn btn-primary">Logout</a>
                        <a href="./tl_setting.php?edit=<?=$id_user?>" class="btn btn-primary">Setting</a>
                    </div>
                </div>


            </div>
            <div class="col-md-8">
            <?php 
        if(isset($_GET['pesan'])){
            switch ($_GET['pesan'])
            {
                case 'format_salah' :
                echo "<div class=\"row\" id=\"section\">
                    <div class=\"col-md\" id=\"pesan\">
                    <div class=\"pesan\">
                    <div class=\"alert alert-danger\" role=\"alert\">File yang diupload harus berformat png<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                    <span aria-hidden=\"true\">&times;</span> 
                    </button></div>
                    </div></div></div>
                    ";
                    break;
                case 'update_fail' :
                    echo "
                        <div class=\"row\" id=\"section\">
                        <div class=\"col-md\" id=\"pesan\">
                        <div class=\"pesan\">
                        <div class=\"alert alert-danger\" role=\"alert\">Data gagal diupdate<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                        <span aria-hidden=\"true\">&times;</span> 
                        </button></div>
                        </div></div></div>
                        ";
                    break;
                case 'upload_berhasil' :
                    echo "
                      <div class=\"row\" id=\"section\">
                      <div class=\"col-md\" id=\"pesan\">
                      <div class=\"pesan\">
                      <div class=\"alert alert-success\" role=\"alert\">Upload Berhasil<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                      <span aria-hidden=\"true\">&times;</span> 
                      </button></div>
                      </div></div></div>
                      ";
                    break;
                case 'updated' :
                    echo "
                        <div class=\"row\" id=\"section\">
                        <div class=\"col-md\" id=\"pesan\">
                        <div class=\"pesan\">
                        <div class=\"alert alert-success\" role=\"alert\">Data berhasil diupdate<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                        <span aria-hidden=\"true\">&times;</span> 
                        </button></div>
                        </div></div></div>
                        ";
                    break;
                case 'hapus' :
                    echo "
                        <div class=\"row\" id=\"section\">
                        <div class=\"col-md\" id=\"pesan\">
                        <div class=\"pesan\">
                        <div class=\"alert alert-success\" role=\"alert\">Twibbon berhasil dihapus<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                        <span aria-hidden=\"true\">&times;</span> 
                        </button></div>
                        </div></div></div>
                        ";
                    break;
                    case 'setting_berhasil' :
                    echo "
                        <div class=\"row\" id=\"section\">
                        <div class=\"col-md\" id=\"pesan\">
                        <div class=\"pesan\">
                        <div class=\"alert alert-success\" role=\"alert\">Setting berhasil disimpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                        <span aria-hidden=\"true\">&times;</span> 
                        </button></div>
                        </div></div></div>
                        ";
                    break;
                case 'overload' :
                        echo "
                        <div class=\"row\" id=\"section\">
                        <div class=\"col-md\" id=\"pesan\">
                        <div class=\"pesan\">
                        <div class=\"alert alert-danger\" role=\"alert\">Ukuran file terlalu besar<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                        <span aria-hidden=\"true\">&times;</span> 
                        </button></div>
                        </div></div></div>
                        ";
                    break;
                default : 
                    ;
            }
      }
        ?>
                <div class="card" id="formup">
                <form name="formupload" enctype="multipart/form-data" action="" method="post">
                <input type="hidden" name="id" value="<?php echo $id ?>">    
                    <div class="form-group">
                    <label for="gambar">Upload Gambar</label>
                    <input class="form-control" type="file" name="gambar" class="form-control-file" accept="image/png" />
                    <small class="form-text text-muted d-none d-md-block">
                    Twibbon harus berformat png, memiliki bagian transparan dan berukuran maksimal 2mb.
                    </small>
                    </div>
                    <div class="form-group">
                    <label for="nama_tw">Nama Twibbon</label>
                    <input class="form-control" type="text" name="nama_tw" placeholder="Masukan Nama Twibbon" value="<?php echo $nama_tw; ?>" />
                    <small class="form-text text-muted d-none d-md-block">
                    Nama twibbon akan digunakan pada nama file hasil pemasangan twibbon dan judul pada page pemasangan twibbon.
                    </small>
                    </div>
                    <div class="form-group">
                    <label for="Caption">Caption</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="caption"><?php echo $caption; ?></textarea>
                    <small class="form-text text-muted d-none d-md-block">
                    Berikan caption untuk twibbon anda yang ingin dimasukan pada halaman pemasangan twibbon. 
                    </small>
                    </div>
                    <?php 
                    if($update == true){
                        echo "<button type=\"submit\" class=\"btn btn-info\" name=\"update\">Update</button>";
                    } else {
                        echo "<button type=\"submit\" class=\"btn btn-primary\">Submit</button>";
                    }
                    ?>
                    
                </form>
                </div>
            </div>

        </div>
    </div>


    </section>

    <section id="tw_uploaded">
    <div class="container">
        <?php
        $koneksi = mysqli_connect("localhost","root","","twibbon");
        $nama = $_SESSION['username'];
        $query  = mysqli_query($koneksi, "SELECT * FROM tb_images WHERE author = '$nama' ORDER BY id DESC");
    ?>
                <div class="accordion" id="accordionExample">
                <?php if(mysqli_num_rows($query)>0){ ?>
                <?php
                    $no = 1;
                    while($data = mysqli_fetch_array($query)){
                    $id =  $data['id'];
                    $author = $data['author'];
                    $url ="./add_tw.php?id= $id";
                    $nama_tw = $data['nama_tw'];
                    $ukuran = $data['ukuran'];
                    $caption=$data['caption']
                ?>
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse"
                                    data-target="#collapse<?php echo $no?>" aria-expanded="true" aria-controls="collapse<?php echo $no?>">
                                    <?php echo $nama_tw?>
                                </button>
                            </h2>
                        </div>
                        <div id="collapse<?php echo $no?>" class="collapse" aria-labelledby="heading<?php echo $no?>" data-parent="#accordionExample">
                            <div class="card-body">
                            <div class="container">
                            <div class="row">
                                <div class="col-md">
                                <img src="<?=$url?>" alt="<?=$nama_tw?>" class="img-fluid">
                                </div>
                                <div class="col-md">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <h5>Nama Twibbon</h5>
                                        <p><?=$nama_tw?></p>
                                    </li>
                                    <li class="list-group-item">
                                        <h5>Caption Twibbon</h5>
                                        <div class="p-wrapper">
                                        <p><?=$caption?></p>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        
                            <a class="btn btn-primary" href="./twibbon/index.php?pesan=<?php echo $id?>" role="button" target="_blank" >Pasang Twibbon</a>
                            <a class="btn btn-info" href="./timeline.php?edit=<?php echo $id?>" role="button" >Edit</a>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#pophapus" role="button" style="color: #FFF;">Hapus</a>
                                    </li>
                                </ul>
                                </div>
                            </div>
                            </div>    
                        </div>
                        </div>
                    </div>
                    <!-- Modal -->
    <div class="modal fade" id="pophapus" tabindex="-1" role="dialog" aria-labelledby="pophapusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="pophapusLabel">Hapus Twibbon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus twibbon?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Ga jadi!</button>
        <a class="btn btn-danger" href="./hapus.php?id=<?php echo $data['id']; ?>" role="button">Hapus</a>
      </div>
    </div>
  </div>
</div>
                    <?php $no++; } ?>
                    <?php } ?>
                </div>
        </div>
        </section>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
