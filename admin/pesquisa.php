<?php

if (isset($_POST["termo_busca"])) {
  $termo_busca = $_POST["termo_busca"];
} else { 
  $termo_busca = "";
}

if ($termo_busca != "") {
  $partes_termo = explode(":", $termo_busca);

  if (count($partes_termo) > 1) {
    $termo_controle = $partes_termo[0];
    $termo_texto = trim($partes_termo[1]);  
  } else {
    $termo_controle = "";
    $termo_texto = trim($termo_busca);
  }

  // echo "cont: " . $termo_controle . "<br>";
  // echo "busc: " . $termo_texto;  

  include_once("casais-listar.php");
}

?>