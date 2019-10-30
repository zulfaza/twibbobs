<?php 
    require_once("config.php");
    session_start();
    if($_SESSION["user"]['level']!="admin") header("Location: 404.html");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <title>Cek</title>
</head>
<body>
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
              <a class="nav-link" href="./">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./timeline.php">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./logout.php" style="color:#007bff">logout</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>

<section id="tw_uploaded">
    <div class="container">
    <div class="accordion" id="accordionExample">
  
    <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          users
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
      <div class="row>
          <div class="table-responsive">
<table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Id</th>
      <th scope="col">Username</th>
      <th scope="col">email</th>
      <th scope="col">nama</th>
      <th scope="col">Level</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $user = mysqli_query($koneksi, "SELECT * from users");
    $no=1;
    foreach ($user as $row){
        echo "<tr>
            <td scope=\"row\">$no</td>
            <td>".$row['id']."</td>
            <td>".$row['username']."</td>
            <td>".$row['email']."</td>
            <td>".$row['name']."</td>
            <td>".$row['level']."</td>
            <td><a class=\"btn btn-danger\" href=\"./hapus.php?akun=".$row['id']."\" role=\"button\">Hapus</a></td>
              </tr>";
        $no++;
    }
    ?>
  </tbody>
</table>
          </div>
          </div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          tb_image
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
          <div class="row">
              <div class="col">
      <table border="1">
    <tr><th>NO</th><th>id</th><th>author</th><th>nama twibbon</th><th>caption</th></tr>
    <?php
 if(isset($_POST['cek'])){   
    if ($_POST['author']!="all") {
        $syarat=$_POST['author'];
        $where="WHERE author='$syarat' ";
        $user = mysqli_query($koneksi, "SELECT * from tb_images $where");
    } else {
    $user = mysqli_query($koneksi, "SELECT * from tb_images");
    }
}else {
    $user = mysqli_query($koneksi, "SELECT * from tb_images");
    }
    $no=1;
    foreach ($user as $row){
        echo "<tr>
            <td>$no</td>
            <td>".$row['id']."</td>
            <td>".$row['author']."</td>
            <td>".$row['nama_tw']."</td>
            <td>".$row['caption']."</td>
              </tr>";
        $no++;
    }
    ?>
</table>
</div>
<div class="col">
<form action="" method="POST">
<fieldset>
            <label>author</label>
            <select name="author">
            <?php
    $user = mysqli_query($koneksi, "SELECT * from users");
    $no=1;
    $all="all";
    foreach ($user as $row){
        $author=$row['username'];
        echo "<option value=\"$author\">$author</option>";
        $no++;
    }echo "<option value=\"$all\">All</option";
    ?>
   
            </select>
        </p>
        <p>
            <input type="submit" name="cek" value="Daftar" />
        </p>
</fieldset>
</form>
</div>
</div>
      </div>
    </div>
  </div>

  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          tb_pp
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
      <div class="row>
                  <div class="col-12">
          <table border="1">
    <tr><th>NO</th><th>id</th><th>nama</th><th>tipe image</th></tr>
    <?php
    $user = mysqli_query($koneksi, "SELECT * from tb_pp");
    $no=1;
    foreach ($user as $row){
        echo "<tr>
            <td>$no</td>
            <td>".$row['id']."</td>
            <td>".$row['nama']."</td>
            <td>".$row['tipeimage']."</td>
              </tr>";
        $no++;
    }
    ?>
</table>
         </div>
        </div>
      </div>
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
