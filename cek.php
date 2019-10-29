
<?php 
     require_once("config.php");
    $query  = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
    $data = mysqli_fetch_array($query);
    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];
    $pp = $data['photo'];
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
<table border="1">
    <tr><th>NO</th><th>id</th><th>username</th><th>email</th><th>nama</th></tr>
    <?php
    $user = mysqli_query($koneksi, "SELECT * from users");
    $no=1;
    foreach ($user as $row){
        echo "<tr>
            <td>$no</td>
            <td>".$row['id']."</td>
            <td>".$row['username']."</td>
            <td>".$row['email']."</td>
            <td>".$row['name']."</td>
              </tr>";
        $no++;
    }
    ?>
</table>
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
      <table border="1">
    <tr><th>NO</th><th>id</th><th>author</th><th>nama twibbon</th><th>caption</th></tr>
    <?php
    $user = mysqli_query($koneksi, "SELECT * from tb_images");
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