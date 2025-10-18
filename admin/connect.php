<?php 

$server = "localhost";
$port = "3306";
$user = "root";
$pass = "";
$db = "cloudi_ecc_cristo25";

// $user = "cloudi";
// $pass = "yQudrgtMs7lM";
// $db = "cloudi_ecc_cristo25";


$connection = mysqli_connect($server, $user, $pass, $db, $port);


if ($connection->connect_errno) {
  echo "Falha ao conectar ao MySQL: (" . $mysqli->connct_errno . ") " . $mysqli->connect_errno;
}

mysqli_set_charset($connection, "utf8");
