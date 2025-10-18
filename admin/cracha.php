<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crachás</title>
  <link href="css/cracha.css" rel="stylesheet">
</head>
<body>

<div id="folha-a4" class="folha a4_vertical">

<?php


include_once("connect.php");
include_once("config-cartao.php");
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
    $tipo = strtolower(trim($row["tipo"]));
    $confirmado = $row["confirmado"];

    // Busca configuração do cartão
  $config = get_config_cartao($tipo);
  $largura = $config ? $config['largura_mm'] : 90; // padrão 90mm
  $altura = $config ? $config['altura_mm'] : 54;   // padrão 54mm
  $imagem_fundo = $config && $config['imagem_fundo'] ? $config['imagem_fundo'] : '';

    if ($tipo == "encontrista") {
      $valor_circulo_equipe = $circulo;
    } else {
      $valor_circulo_equipe = $equipe;
    }

    if ($confirmado == 1) {
        $bg_style = $imagem_fundo ? "background-image: url('../$imagem_fundo'); background-size: cover;" : "";
        echo ' 
          <div class="cracha" style="border-style: double; border-width: 0.5mm; border-color: '.$circulo_cor.'; width:'.$largura.'mm; height:'.$altura.'mm; '.$bg_style.'">
            <div class="cracha-nomes" >
              <div class="cracha-nome-grande">
                <p>' . $ele_apelido . '</p>
              </div>
              <div class="cracha-nome-pequeno">
                <p>' . $ela_apelido . '</p>
              </div>
            </div>    
            <div class="cor-do-circulo"  style="background-color:' . $circulo_cor . ';">
            </div>
          </div>';

        echo '
          <div class="cracha" style="border-style: double; border-width: 0.5mm; border-color: '.$circulo_cor.'; width:'.$largura.'mm; height:'.$altura.'mm; '.$bg_style.'">
            <div class="cracha-nomes">
              <div class="cracha-nome-grande">
                <p>' . $ela_apelido . '</p>
              </div>
              <div class="cracha-nome-pequeno">
                <p>' . $ele_apelido . '</p>
              </div>
            </div>    
            <div class="cor-do-circulo"  style="background-color:' . $circulo_cor . ';">
            </div>
          </div>';
    }
    if ( ( (($i+1) % 4) == 0) ) {
      echo '<div class="quebra-pagina"></div>';
    }
}



?>

</div>

</body>
</html>