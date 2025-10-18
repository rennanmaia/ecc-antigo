<?php

$valor_botao = $_POST["botao_enviar"];

// echo "processar" . $valor  _botao;

// $check_casal = $_POST["check_casal"];

// print_r($check_casal);

if ($valor_botao == "Crachá") {
  include_once("relatorio-cracha.php");
} else if ($valor_botao == "C.Vela") {
  include_once("cartao_vela.php");
} else if ($valor_botao == "C.Cruz") {
  include_once("cartao_cruz.php");
} else if ($valor_botao == "Mesa") {
  include_once("relatorio-cracha-mesa.php");
}

// header("Location:cracha.php?var=" . http_build_query($check_casal));


// Consulta lista de equipes de trabalho
// SELECT  casais.id, casais.ele_nome, casais.ele_apelido, casais.ela_nome, casais.ela_apelido, equipes.nome FROM casais 
// INNER JOIN equipes ON equipes.id = casais.equipe
// WHERE tipo  = 'equipe';
?>