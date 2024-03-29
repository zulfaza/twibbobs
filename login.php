<?php 

require_once("config.php");
session_start();
error_reporting(0);
if($_SESSION['status']=="login"){
  header("location:./timeline.php");
}else if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username OR email=:email";
    $stmt = $db->prepare($sql);
    
    // bind parameter ke query
    $params = array(
        ":username" => $username,
        ":email" => $username
    );

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // jika user terdaftar
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["user"] = $user;
            $_SESSION["username"] = $username;
            $_SESSION['status'] = "login";
            // login sukses, alihkan ke halaman timeline
            header("Location: timeline.php");
        }
    }else {
      header("Location: ./login.php?pesan=data_salah");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Twibbobs</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>

<body class="bg-light">
  <header id="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light >
        <a class=" navbar-brand" href="./index.php">
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
            <!-- <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="./register.php" style="color:#007bff">Sign Up</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>

  <div class="container" id="body">
    <?php 
        if(isset($_GET['pesan'])){
        if($_GET['pesan']=="belum_login"){
        echo "
        <link rel=\"stylesheet\" href=\"./css/style.css\">
        <div class=\"row\" id=\"section\">
        <div class=\"col-md-6\" id=\"pesan\">
        <div class=\"pesan\">
        <div class=\"alert alert-danger\" role=\"alert\">Anda harus login untuk masuk ke dashboard<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>
        </div></div></div>
        ";
        } else if($_GET['pesan']=="data_salah"){
          echo "
          <link rel=\"stylesheet\" href=\"./css/style.css\">
          <div class=\"row\" id=\"section\">
          <div class=\"col-md-6\" id=\"pesan\">
          <div class=\"pesan\">
          <div class=\"alert alert-danger\" role=\"alert\">Password atau username salah  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>
          </div></div></div>
          ";
          } 
      }
        ?>
    <div class="row" id="section">

      <div class="col bg-light animated fadeInUp slow" id="form">

        <h4>Masuk ke Twibbobs</h4>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

        <form action="" method="POST">

          <div class="form-group">
            <label for="username">Username</label>
            <input class="form-control" type="text" name="username" placeholder="Username atau email" />
          </div>


          <div class="form-group">
            <label for="password">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Password" />
          </div>

          <input type="submit" class="btn btn-success btn-block" name="login" value="Masuk" />

        </form>

      </div>

      <div class="col-7 d-none d-md-block animated fadeInDown slow">
      <div class="intro-img d-none d-md-block">
            <img src="./img/login.png" alt="" class="img-fluid">
          </div>
      </div>
    </div>
  </div>

  <?php include('./php/footer.php')?>

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