<?php

$db_host = "127.0.0.1";
$db_user = "zul";
$db_pass = "zulfaza123";
$db_name = "twibbon";

try {    
    //create PDO connection 
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    //show error
    die("Terjadi masalah: " . $e->getMessage());
}

$koneksi = mysqli_connect("$db_host","$db_user","$db_pass","$db_name");

if (!$koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}
