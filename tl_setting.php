<?php require_once("auth.php"); ?>

<?php require_once("config.php"); ?>

<?php 
	if($_SESSION['status']!="login"){
		header("location:./login.php?pesan=belum_login");
	}
    ?>
<?php
        $id = $_GET['edit'];
        $query  = mysqli_query($koneksi, "SELECT * FROM users WHERE id = '$id' ORDER BY id DESC");
        $data = mysqli_fetch_array($query);
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];

if (count($_FILES) > 0) {

    if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
        
        $fileName = $_FILES['photo']['name']; 
        $size=$_FILES['photo']['size'];

        if($size<=3000000){

        
        $datagambar = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
        $propertiesgambar = getimageSize($_FILES['photo']['tmp_name']);
        $ukuran = $propertiesgambar[1];
        
        $syarat  = mysqli_query($koneksi,"SELECT * FROM tb_pp WHERE id = '$id'");
        $cek = mysqli_num_rows($syarat);

        if($cek==0){
            $sql = "INSERT INTO tb_pp (id,nama,tipeimage ,dataimage) VALUES('" . $id . "','" . $fileName . "','" . $propertiesgambar['mime'] . "', '" . $datagambar . "')";
            mysqli_query($koneksi, $sql) or die(header("Location: tl_setting.php?pesan=setting_fail&edit=$id"));
            $lastrecord = "SELECT id FROM tb_pp ORDER BY id DESC LIMIT 1";
        
            $result = mysqli_query($koneksi, $lastrecord) or die("<b>Error:</b> Ada kesalahan<br/>" . mysqli_error($koneksi));
        
            $getid = mysqli_fetch_array($result);
        }

        else {    
            $properti=$propertiesgambar['mime'];
            
            $sql = "UPDATE tb_pp 
                    SET tipeimage='$properti',
                    dataimage='$datagambar',
                    nama='$fileName',
                    id='$id'

                WHERE id=$id";

            
            mysqli_query($koneksi, $sql) or die(header("Location: tl_setting.php?pesan=setting_fail&edit=$id"));
        
        }


        if (isset($_POST['edit'])) {
        $pp = "./add_pp.php?id=$id";
            
            $id=$_POST['id'];
            $name=$_POST['name'];
            $username=$_POST['username'];
            $email=$_POST['email'];
            
            $sql = "UPDATE users SET username='$username', email='$email', name='$name', photo='$pp' WHERE id=$id";
            mysqli_query($koneksi, $sql) or die(header("Location: tl_setting.php?pesan=setting_fail&edit=$id"));
            header("Location: timeline.php?pesan=setting_berhasil");
        } else {
            header("Location: tl_setting.php?pesan=gagal&edit=$id");
        }
    } else {
        header("Location: tl_setting.php?pesan=overload&edit=$id");
    }
    }

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
    <title>Setting - Twibbobs</title>
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
            <div class="col-md">
            <?php 
        if(isset($_GET['pesan'])){
            switch ($_GET['pesan'])
            {
                case 'setting_fail' :
                echo "<div class=\"row\" id=\"section\">
                    <div class=\"col-md\" id=\"pesan\">
                    <div class=\"pesan\">
                    <div class=\"alert alert-danger\" role=\"alert\">Terjadi kesalahan, perubahan tidak tersimpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                    <span aria-hidden=\"true\">&times;</span> 
                    </button></div>
                    </div></div></div>
                    ";
                    break;
                case 'gagal' :
                echo "<div class=\"row\" id=\"section\">
                    <div class=\"col-md\" id=\"pesan\">
                    <div class=\"pesan\">
                    <div class=\"alert alert-danger\" role=\"alert\">Terjadi kesalahan, perubahan tidak tersimpan<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                    <span aria-hidden=\"true\">&times;</span> 
                    </button></div>
                    </div></div></div>
                    ";
                case 'overload' :
                echo "<div class=\"row\" id=\"section\">
                    <div class=\"col-md\" id=\"pesan\">
                    <div class=\"pesan\">
                    <div class=\"alert alert-danger\" role=\"alert\">File foto terlalu besar<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
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
                    <label for="photo">Upload Profil Picture</label>
                    <input class="form-control" type="file" name="photo" class="form-control-file" accept="image/*" />
                    <small class="form-text text-muted d-none d-md-block">
                    disarankan mengupload foto berasio 1:1
                    </small>
                    </div>

                    <div class="form-group">
                    <label for="name">Nama</label>
                    <input class="form-control" type="text" name="name" placeholder="Masukan Nama Lengkapmu" value="<?php echo $name; ?>" />
                    </div>
                    
                    <div class="form-group">
                    <label for="username">Nama</label>
                    <input class="form-control" type="text" name="username" placeholder="Masukan username" value="<?php echo $username; ?>" />
                    </div>

                    <div class="form-group">
                    <label for="email">email</label>
                    <input class="form-control" type="text" name="email" placeholder="Masukan Nama Twibbon" value="<?php echo $email; ?>" />
                    </div>

                        <button type="submit" class="btn btn-primary" name="edit">Submit</button>
                        <a href="./timeline.php" class="btn btn-info">Cancel</a>
                </form>
                </div>
            </div>

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
