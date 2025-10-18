<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cartão Vela</title>
  <link href="css/cartao_vela.css" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">


</head>
<body>

<div id="folha-a4" class="folha a4_vertical">

<?php

include_once("connect.php");
$check_casal = $_POST["check_casal"];

function circulo_nome($id) {
  if ($id != "0") {
    global $connection;
    $sql = "SELECT * FROM circulos WHERE id = '$id'";
    $result = mysqli_query($connection, $sql) or die ("erro");
    $row = $result->fetch_array();
    $cor = $row["cor"];
    return $cor;  
  }
}

function circulo_cor($id) {
  if ($id != "0") {
    global $connection;
    $sql = "SELECT * FROM circulos WHERE id = '$id'";
    $result = mysqli_query($connection, $sql) or die ("erro");
    $row = $result->fetch_array();
    $cor = $row["cor_codigo"];
    return $cor;  
  }
}


function equipe_nome($id) {
  if ($id != "0") {
    global $connection;
    $sql = "SELECT * FROM equipes WHERE id = '$id'";
    $result = mysqli_query($connection, $sql) or die ("erro");
    $row = $result->fetch_array();
    $cor = $row["nome"];
    return $cor;
  }
}

    for ($i = 0; $i < count($check_casal); $i++) {
      // echo "<p>" . $i . ": " . $check_casal[$i] . "</p>";
    // }
      $sql = "SELECT * FROM casais WHERE id = '" . $check_casal[$i] . "'";
      $result = mysqli_query($connection, $sql);
      $row = $result->fetch_array();
        $id = $row["id"];
        $ele_nome = $row["ele_nome"];
        $ele_apelido = $row["ele_apelido"];
        $ela_nome = $row["ela_nome"];
        $ela_apelido = $row["ela_apelido"];
        $telefone_ele = $row["telefone_ele"];
        $telefone_ela = $row["telefone_ela"];
        $endereco = $row["endereco"];
        $circulo = circulo_nome($row["circulo"]);
        $circulo_cor = circulo_cor($row["circulo"]); 
        $equipe = equipe_nome($row["equipe"]);
        $tipo = $row["tipo"];
        $confirmado = $row["confirmado"];
  
        if ($tipo == "encontristas") {
          $valor_circulo_equipe = $circulo;
        } else {
          $valor_circulo_equipe = $equipe;
        }

        // <div class="cracha-nomes"  style="background-color:' . $circulo_cor . ';">
        if ($confirmado == 1) {
    echo ' 
      <div class="cartao">
        <div class="cracha-nomes">
          <div class="cracha-nome-grande">
            <p class="nome">' . $ele_apelido . '</p>
            <p>&</e>
            <p class="nome">' . $ela_apelido . '</p>
          </div>
        </div>    
  
        <div class="cor-do-circulo"  style="background-color:' . $circulo_cor . ';">
        </div>
      </div>
      ';

    // echo '
    // <div class="cracha" style="border-style: double;
    // border-width: 5px;
    // border-color: '.$circulo_cor.';">
    //   <div class="cracha-nomes"  style="background-color:#ccc">
    //     <div class="cracha-nome-grande">
    //       <p>' . $ela_apelido . '</p>
    //     </div>
    //     <div class="cracha-nome-pequeno">
    //       <p>' . $ele_apelido . '</p>
    //     </div>
    //   </div>    

    //   <div class="cor-do-circulo"  style="background-color:' . $circulo_cor . ';">
    //   </div>
    // </div>
    //   ';
    }
    if ( ( (($i+1) % 2) == 0) ) {
      echo '<div class="quebra-pagina"></div>';
    }
  }



?>

</div>

</body>
</html>