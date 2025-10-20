
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-12">
      <div class="p-2 mb-2 bg-info text-dark rounded shadow-sm">
        <h1 class="mb-0">Equipes de trabalho</h1>
      </div>
    </div>
  </div>

<?php
// operacao (inserir, editar)
// acao (form, enviar_dados)
if (isset($_POST["enviar_form"])) {
  $acao = "enviar_dados";
} else {
  $acao = "form";
}

if (isset($_GET["operacao"])) {
    $operacao = $_GET["operacao"];
} else {
    $operacao = "";
}

if ($operacao != "") {
  if ( ($operacao == "inserir") && ($acao == "form") ){
    include_once("casais-form.php");
  } elseif ( ($operacao == "inserir") && ($acao == "enviar_dados") ) {
    include_once("casais-enviar.php");
    include_once("casais-listar.php");
  } elseif ( ($operacao == "editar") && ($acao == "form") ) {
    include_once("casais-form.php");
  } elseif ( ($operacao == "editar") && ($acao == "enviar_dados") ){
    include_once("casais-enviar.php");
    include_once("casais-listar.php");
  }
} else {
  echo '<div class="container-fluid pt-4 px-4">';
  echo '<div class="row g-4">';
  echo '<div class="col-12">';
  echo '<div class="p-2 mb-2 bg-info text-dark rounded shadow-sm">';
  echo '<h1 class="mb-0">Equipes de trabalho</h1>';
  echo '</div></div></div>';
  echo '<form method="post" action="equipes.php">';
  include_once("casais-listar.php");
  echo listar_casais('equipes');
  echo '</form></div>';
}