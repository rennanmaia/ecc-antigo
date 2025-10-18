<?php

include_once("connect.php");

global $connection;

$sql = "SELECT * FROM usuarios";
$result = mysqli_query($connection, $sql) or die ("erro");
$valid_passwords = array("admin" => "tcc8522*dulce");
// $valid_passwords = array ("rennan" => "rennan");

while ($row = $result->fetch_array()) {
    $id = $row["id"];
    $login = $row["usuario"];
    $senha = $row["senha"];
//     array_push($valid_passwords, $login, $senha);
    $valid_passwords[$login] = $senha;
}

$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

// print_r($valid_passwords);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="My Realm"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}

// If arrives here, is a valid user.
// echo "<p>Welcome $user.</p>";
// echo "<p>Congratulation, you are into the system.</p>";
