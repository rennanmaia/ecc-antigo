<?php

include_once("connect.php");

$qtd_casais = 0;

function circulo_nome($id) {
  if ($id != "0") {
    global $connection;
    $sql = "SELECT * FROM circulos WHERE id = '$id'";
    $result = mysqli_query($connection, $sql) or die ("erro");
    $row = $result->fetch_array();
    if ($row !== null) {
      $cor = strtoupper($row["nome"]) . " - " .strtoupper($row["cor"]);
      return $cor;
    } else {
      return "N/A";
    }
  }
}

function equipe_nome($id) {
  if ($id != "0") {
    global $connection;
    $sql = "SELECT * FROM equipes WHERE id = '$id'";
    $result = mysqli_query($connection, $sql) or die ("erro");
    $row = $result->fetch_array();
    if ($row !== null) {
      return strtoupper($row["nome"]);
    } else {
      return "N/A";
    }
  }
}

function listar_casais($tipo) {
  global $connection;
  global $qtd_casais;

  $campo_circulo_equipe = "";
  $valor_circulo_equipe = "";

  $sql = "";
  if ($tipo == "encontristas") {
    $sql = "SELECT * FROM casais WHERE tipo = 'encontrista' ORDER BY ele_nome";
    $campo_circulo_equipe = "Circulo";
  } elseif ($tipo == "equipes") {
    $sql = "SELECT * FROM casais WHERE tipo = 'equipe' ORDER BY ele_nome";
    $campo_circulo_equipe = "Equipe";
  } else {
    $sql = "SELECT * FROM casais ORDER BY ele_nome";
    $campo_circulo_equipe = "Equipe";
  }
  $result = mysqli_query($connection, $sql) or die ("erro");

  // Cabeçalho estilo tabela para telas grandes
  $html = '<div class="casais-table-header d-none d-md-flex">';
  $html .= '<div>Selecionar</div>';
  $html .= '<div>ID</div>';
  $html .= '<div>Encontrista</div>';
  $html .= '<div>Encontrista</div>';
  $html .= '<div>Endereço</div>';
  $html .= '<div>Telefone</div>';
  $html .= '<div>Circulo/Equipe</div>';
  $html .= '<div>Ações</div>';
  $html .= '</div>';
  $html .= '<div class="row g-3">';
  while ($row = $result->fetch_array()) {
      $id = $row["id"];
      $ele_nome = strtoupper($row["ele_nome"]);
      $ele_apelido = strtoupper($row["ele_apelido"]);
      $ela_nome = strtoupper($row["ela_nome"]);
      $ela_apelido = strtoupper($row["ela_apelido"]);
      $telefone_ele = $row["telefone_ele"];
      $telefone_ela = $row["telefone_ela"];
      $endereco = strtoupper($row["endereco"]);
      $circulo = circulo_nome($row["circulo"]);
      $equipe = equipe_nome($row["equipe"]);
      $confirmado = $row["confirmado"];
      $tipo_casal = $row["tipo"] . "s";
      if ($tipo_casal == "encontristas") {
        $valor_circulo_equipe = $circulo;
      } else {
        $valor_circulo_equipe = $equipe;
      }
      // Card em formato de linha para telas grandes
      $html .= '<div class="col-12 casais-table-row d-none d-md-flex">';
      $html .= '<div class="card">';
      $html .= '<div class="card-body py-2 px-1 d-flex align-items-center">';
      $html .= '<input class="form-check-input me-2" type="checkbox" name="check_casal[]" value="'.$id.'" data-bs-toggle="tooltip" title="Selecionar casal">';
      $html .= '</div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1">#'.$id.'</div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1">'.$ele_nome.' <small class="text-muted">'.$ele_apelido.'</small></div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1">'.$ela_nome.' <small class="text-muted">'.$ela_apelido.'</small></div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1">'.$endereco.'</div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1"><span class="text-muted">'.$telefone_ele.'</span> | <span class="text-muted">'.$telefone_ela.'</span></div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1">'.$valor_circulo_equipe.'</div></div>';
      $html .= '<div class="card"><div class="card-body py-2 px-1 d-flex gap-2">';
      $html .= '<a href="?page='.$tipo_casal.'&operacao=editar&id='.$id.'" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i></a>';
      $html .= '<button type="submit" name="botao_enviar" value="Crachá-'.$id.'" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Gerar crachá"><i class="fa fa-id-badge"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="Mesa-'.$id.'" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Gerar crachá de mesa"><i class="fa fa-table"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Vela-'.$id.'" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Gerar cartão Vela"><i class="fa fa-fire"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Cruz-'.$id.'" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Gerar cartão Cruz"><i class="fa fa-cross"></i></button>';
      $html .= '</div></div>';
      $html .= '</div>';
      // Card tradicional para telas pequenas
      $html .= '<div class="col-12 col-md-6 col-xl-4 d-md-none">';
      $html .= '<div class="card shadow-sm h-100">';
      $html .= '<div class="card-body">';
      $html .= '<div class="d-flex align-items-center justify-content-between mb-2">';
      $html .= '<div class="d-flex align-items-center gap-2">';
      $html .= '<input class="form-check-input" type="checkbox" name="check_casal[]" value="'.$id.'" data-bs-toggle="tooltip" title="Selecionar casal">';
      if ($confirmado == 1) {
        $html .= '<i class="fas fa-check-circle text-success ms-1" data-bs-toggle="tooltip" title="Confirmado"></i>';
      } else {
        $html .= '<i class="fas fa-times-circle text-secondary ms-1" data-bs-toggle="tooltip" title="Não confirmado"></i>';
      }
      $html .= '</div>';
      $html .= '<span class="badge bg-primary">#'.$id.'</span>';
      $html .= '</div>';
      $html .= '<h5 class="card-title mb-1"><a href="?page='.$tipo_casal.'&operacao=editar&id='.$id.'" class="text-decoration-none text-primary">'.$ele_nome.' <small class="text-muted">'.$ele_apelido.'</small></a></h5>';
      $html .= '<h6 class="mb-1">'.$ela_nome.' <small class="text-muted">'.$ela_apelido.'</small></h6>';
      $html .= '<div class="mb-1"><i class="fa fa-home me-1"></i> '.$endereco.'</div>';
      $html .= '<div class="mb-1"><i class="fa fa-phone me-1"></i> <span class="text-muted">'.$telefone_ele.'</span> | <span class="text-muted">'.$telefone_ela.'</span></div>';
      $html .= '<div class="mb-2"><i class="fa fa-users me-1"></i> '.$valor_circulo_equipe.'</div>';
      $html .= '<div class="d-flex gap-2 mt-2">';
      $html .= '<a href="?page='.$tipo_casal.'&operacao=editar&id='.$id.'" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i></a>';
      $html .= '<button type="submit" name="botao_enviar" value="Crachá-'.$id.'" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Gerar crachá"><i class="fa fa-id-badge"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="Mesa-'.$id.'" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Gerar crachá de mesa"><i class="fa fa-table"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Vela-'.$id.'" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Gerar cartão Vela"><i class="fa fa-fire"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Cruz-'.$id.'" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Gerar cartão Cruz"><i class="fa fa-cross"></i></button>';
      $html .= '</div>';
      $html .= '</div></div></div>';
  }
  $html .= '</div>';
  return $html;
}




