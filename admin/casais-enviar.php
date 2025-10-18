<?php

include_once("connect.php");

if (isset($_GET["id"])) {
  $id = $_GET["id"];
} else {
  $id = "";
}

if (isset($_POST["ele_nome"])) {
  $ele_nome = $_POST["ele_nome"];
} else {
  $ele_nome = "";
}

if (isset($_POST["ele_apelido"])) {
  $ele_apelido = $_POST["ele_apelido"];
} else {
  $ele_apelido = "";
}

if (isset($_POST["ela_nome"])) {
  $ela_nome = $_POST["ela_nome"];
} else {
  $ela_nome = "";
}

if (isset($_POST["ela_apelido"])) {
  $ela_apelido = $_POST["ela_apelido"];
} else {
  $ela_apelido = "";
}

if (isset($_POST["telefone_ele"])) {
  $telefone_ele = $_POST["telefone_ele"];
} else {
  $telefone_ele = "";
}

if (isset($_POST["telefone_ela"])) {
  $telefone_ela = $_POST["telefone_ela"];
} else {
  $telefone_ela = "";
}

if (isset($_POST["endereco"])) {
  $endereco = $_POST["endereco"];
} else {
  $endereco = "";
}

if (isset($_POST["coordenador_circulo"])) {
  $coordenador_circulo = 1;
} else {
  $coordenador_circulo = 0;
}

if (isset($_POST["circulo"])) {
  $circulo = $_POST["circulo"];
} else {
  $circulo = "";
}

if (isset($_POST["coordenador_equipe"])) {
  $coordenador_equipe = 1;
} else {
  $coordenador_equipe = 0;
}

if (isset($_POST["equipe"])) {
  $equipe = $_POST["equipe"];
} else {
  $equipe = "";
}

if (isset($_POST["tipo"])) {
  $tipo = $_POST["tipo"];
} else {
  $tipo = "";
}

if (isset($_POST["outras_funcoes"])) {
  $outras_funcoes = $_POST["outras_funcoes"];
} else {
  $outras_funcoes = "";
}

if (isset($_POST["obs"])) {
  $obs = $_POST["obs"];
} else {
  $obs = "";
}

if (isset($_POST["confirmado"])) {
  $confirmado = 1;
} else {
  $confirmado = 0;
}

// Verifica se os campos nome estão preenchidos
if (
  ($ele_nome != "") && ($ela_nome != "")
) {

  $sql = "";

  if ($operacao == "inserir") { //se for inserir colocar o SQL de inserir
    $sql = "INSERT INTO casais 
    (ele_nome, ele_apelido, ela_nome, ela_apelido, telefone_ele, telefone_ela, endereco, equipe, circulo, coordenador_equipe, coordenador_circulo, tipo, funcao, obs, confirmado) 
  VALUES 
    ('$ele_nome', '$ele_apelido', '$ela_nome', '$ela_apelido', '$telefone_ele', '$telefone_ela', '$endereco', '$equipe', '$circulo', '$coordenador_equipe', '$coordenador_circulo', '$tipo', '$outras_funcoes', '$obs', '$confirmado')";
  } else { // se não for inserir, usar o SQL de editar
    $sql = "UPDATE casais SET 
    ele_nome = '$ele_nome', ele_apelido = '$ele_apelido', ela_nome = '$ela_nome', ela_apelido = '$ela_apelido', telefone_ele = '$telefone_ele', telefone_ela = '$telefone_ela', endereco = '$endereco', equipe = '$equipe', circulo = '$circulo', coordenador_equipe = '$coordenador_equipe', coordenador_circulo = '$coordenador_circulo', tipo = '$tipo', funcao = '$outras_funcoes', obs = '$obs', confirmado = '$confirmado' WHERE id = '$id'";
  }

  if ( $result = mysqli_query($connection, $sql) ) {
    $mensagem_tipo = "alert-success";
    $mensagem = "Operação realizada com sucesso";  
  } else {
    $mensagem_tipo = "alert-danger";
    $mensagem = "Erro ao realizar a operação! " . mysqli_error($connection)  ;  
  }

} else {
  $mensagem_tipo = "alert-danger";
  $mensagem = "Erro: Os campos nome dele e dela devem ser preenchidos.";
}

?>

<div class="alert <?php echo $mensagem_tipo; ?> centered-message" role="alert">
    <?php echo $mensagem; ?>
</div>