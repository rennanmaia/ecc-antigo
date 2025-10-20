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

  // Botão de crachá em massa (telas grandes)
  $html = '<form method="post" action="">';
  $html .= '<div class="mb-3 d-none d-md-block">';
  $html .= '<button type="submit" name="botao_enviar" value="Cracha-Massa" class="btn btn-primary btn-sm" id="btn-cracha-massa" disabled><i class="fa fa-id-badge me-1"></i> Gerar crachás em massa</button>';
  $html .= '</div>';
  $html .= '<table class="casais-table">';
  $html .= '<thead><tr>';
  $html .= '<th style="width:40px">Sel.</th>';
  $html .= '<th style="width:60px">ID</th>';
  $html .= '<th>Encontrista</th>';
  $html .= '<th>Encontrista</th>';
  $html .= '<th>Endereço</th>';
  $html .= '<th>Telefone</th>';
  $html .= '<th>Circulo/Equipe</th>';
  $html .= '<th style="width:180px">Ações</th>';
  $html .= '</tr></thead><tbody>';
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
      $html .= '<tr>';
  $html .= '<td><input class="form-check-input casal-checkbox" type="checkbox" name="check_casal[]" value="'.$id.'" data-bs-toggle="tooltip" title="Selecionar casal"></td>';
      $html .= '<td>#'.$id.'</td>';
      $html .= '<td>'.$ele_nome.' <small class="text-muted">'.$ele_apelido.'</small></td>';
      $html .= '<td>'.$ela_nome.' <small class="text-muted">'.$ela_apelido.'</small></td>';
      $html .= '<td>'.$endereco.'</td>';
      $html .= '<td><span class="text-muted">'.$telefone_ele.'</span> | <span class="text-muted">'.$telefone_ela.'</span></td>';
      $html .= '<td>'.$valor_circulo_equipe.'</td>';
      $html .= '<td class="d-flex gap-2">';
      $html .= '<a href="?page='.$tipo_casal.'&operacao=editar&id='.$id.'" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Editar"><i class="fa fa-edit"></i></a>';
      $html .= '<button type="submit" name="botao_enviar" value="Crachá-'.$id.'" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Gerar crachá"><i class="fa fa-id-badge"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="Mesa-'.$id.'" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Gerar crachá de mesa"><i class="fa fa-table"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Vela-'.$id.'" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Gerar cartão Vela"><i class="fa fa-fire"></i></button>';
      $html .= '<button type="submit" name="botao_enviar" value="C.Cruz-'.$id.'" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Gerar cartão Cruz"><i class="fa fa-cross"></i></button>';
      $html .= '</td>';
      $html .= '</tr>';
  }
  $html .= '</tbody></table></form></div>';
  // Botão de crachá em massa (telas pequenas)
  $html .= '<form method="post" action="">';
  $html .= '<div class="mb-3 d-md-none">';
  $html .= '<button type="submit" name="botao_enviar" value="Cracha-Massa" class="btn btn-primary btn-sm" id="btn-cracha-massa-mobile" disabled><i class="fa fa-id-badge me-1"></i> Gerar crachás em massa</button>';
  $html .= '</div>';
  $html .= '<div class="row g-3">';
  $result->data_seek(0); // Reinicia ponteiro do resultado
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
      $html .= '<div class="col-12 col-md-6 col-xl-4">';
      $html .= '<div class="card shadow-sm h-100">';
      $html .= '<div class="card-body">';
      $html .= '<div class="d-flex align-items-center justify-content-between mb-2">';
      $html .= '<div class="d-flex align-items-center gap-2">';
      $html .= '<input class="form-check-input casal-checkbox-mobile" type="checkbox" name="check_casal[]" value="'.$id.'" data-bs-toggle="tooltip" title="Selecionar casal">';
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
  $html .= '</div></form>';
  return $html;
}




