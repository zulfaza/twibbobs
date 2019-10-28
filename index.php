<?php
session_start();
error_reporting(0);
if($_SESSION['status']=="login"){
  $login="Dashboard";
} else {
  $login = "Login";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Twibbobs</title>

  <!-- menyisipkan bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
</head>

<body class="bg-light">
  <header id="header">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light >
        <a class="navbar-brand" href="#">
          <h1>Twibbobs</h1>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./login.php" style="color:#007bff"><?=$login?></a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </header>
  <section id="intro" class="clearfix">
    <div class="container">
      <div class="row">
      <div class="col d-md-block">
          <div class="intro-info d-md-block">
            <h2 id="h2" class="animated bounce slow">Apa sih Twibbobs itu?</h2>
            <br>
            <p>
              <font color="#222000">Twibbobs adalah suatu web yang penyedia layanan pemasang twibbon
                yang akan membantu event atau acara kalian :) 
              </font>
            </p>
            <div>
              <a href="./register.php" alt="daftar kuy!!" class="btn-get-started scrollto">Sign Up</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="intro-img d-none d-md-block">
            <img src="./img/ilus.png" alt="" class="img-fluid">
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
  <?php
if(isset($_GET['pesan'])){
        switch ($_GET['pesan'])
        {
          case 'logout_done' :
            echo "<div class=\"pesan\">
                  <div class=\"alert alert-success animated fadeInUp slow\" role=\"alert\" style=\"position: fixed;right: 50px;top: 70px;\">Logout Berhasil!  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"> 
                  <span aria-hidden=\"true\">&times;</span> 
                  </button></div></div>
                  ";
            break;
            default : 
                    ;
          }}
?>
</body>

</html>