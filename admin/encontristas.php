<a href="?page=encontristas">
  <div class="p-2 mb-2 bg-info text-dark">
    <h1>Encontristas</h1>
  </div>
</a>

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
  include_once("casais-listar.php");
}


?>