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
  } elseif ($tipo == "pesquisar") {
    global $termo_controle;
    global $termo_texto;

    if ($termo_controle == "equipe") {
      $sql = "SELECT casais.*, equipes.nome FROM `casais`
        INNER JOIN equipes ON casais.equipe = equipes.id
        WHERE
        equipes.nome LIKE '%$termo_texto%'";
    } elseif ($termo_controle == "circulo") {
      $sql = "SELECT casais.*, circulos.cor FROM `casais`
        INNER JOIN circulos ON casais.circulo = circulos.id
        WHERE
        circulos.cor LIKE '%$termo_texto%'";
    } elseif ($termo_controle == "palestra") {
      echo $sql = "SELECT casais.* FROM `casais`
        WHERE
        casais.funcao = 'palestra' OR
        casais.obs LIKE '%$termo_texto%'";
    } else {
      $sql = "SELECT * FROM casais WHERE
        (ele_nome LIKE '%$termo_texto%') ||
        (ele_apelido LIKE '%$termo_texto%') ||
        (ela_nome LIKE '%$termo_texto%') ||
        (ela_apelido LIKE '%$termo_texto%')  
      ";
    }

    // echo "cont: " . $termo_controle . "<br>";
    // echo "busc: " . $termo_texto;  
    $campo_circulo_equipe = "Pesquisa";    
  } else {
    $sql = "SELECT * FROM casais ORDER BY ele_nome";
    $campo_circulo_equipe = "Equipe";
  }
  
  $result = mysqli_query($connection, $sql) or die ("erro");

  // $qtd_casais = mysqli_num_rows($result);

  $html = '';

  $html .= "<input type='hidden' name=''";

  while ($row = $result->fetch_array()) {
      $id = $row["id"];
      $ele_nome = strtoupper($row["ele_nome"]);
      $ele_aplido = strtoupper($row["ele_apelido"]);
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

      $html .= '
        <tr>
          <th scope="row">
            <input class="form-check-input" type="checkbox" 
              name="check_casal[]" value="'.$id.'">';
              $html .= '<i class="fas fa-check-circle';
            if ($confirmado == 1) {
              $html .= ' color-checked"></i>';
            } else {
              $html .= ' color-unchecked"></i>';
            }
         $html .= ' </th>
          <td>'.$id.'</td>
          <td>
            <a href="?page='.$tipo_casal.'&operacao=editar&id='.$id.'">'.$ele_nome.'</a>
          </td>
          <td>'.$ela_nome.'</td>
          <td>'.$valor_circulo_equipe.'</td>
        </tr>';
  
  }

  return $html;  

}

?>

<!-- <script> -->
  <!-- function alerta(variavel) { -->
    <!-- let checks = getElementByName("check_casal[0]"); -->
    <!-- // alert(variavel.value); -->
    <!-- alert(checks); -->
  <!-- } -->
<!-- </script> -->

<!-- Barra de ferramentas -->

<?php

    if (!isset($page) || $page == "" || $page == "home") { 
    } else { ?>
<form action="processar.php" method="post">

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
          <a href="?page=<?php echo $page; ?>&operacao=inserir" class="text-decoration-none">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm h-100">
                <i class="fa fa-plus-square fa-3x text-success"></i>
                <div class="ms-3">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar novo casal">
                        <i class="fa fa-user-plus me-1"></i> Novo casal
                    </button>
                </div>
            </div>
          </a>
        </div>
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm h-100">
        <i class="fa fa-id-badge fa-3x text-primary"></i>
        <div class="ms-3">
          <button type="submit" name="botao_enviar" value="Crachá" class="btn btn-outline-primary w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar crachá dos selecionados">
            <i class="fa fa-id-badge me-1"></i> Crachá
          </button>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm h-100">
        <i class="fa fa-table fa-3x text-warning"></i>
        <div class="ms-3">
          <button type="submit" name="botao_enviar" value="Mesa" class="btn btn-outline-warning w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar crachá de mesa dos selecionados">
            <i class="fa fa-table me-1"></i> Mesa
          </button>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm h-100">
        <i class="fa fa-fire fa-3x text-danger"></i>
        <div class="ms-3">
          <button type="submit" name="botao_enviar" value="C.Vela" class="btn btn-outline-danger w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar cartão Vela dos selecionados">
            <i class="fa fa-fire me-1"></i> C.Vela
          </button>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-xl-3">
      <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 shadow-sm h-100">
        <i class="fa fa-cross fa-3x text-secondary"></i>
        <div class="ms-3">
          <button type="submit" name="botao_enviar" value="C.Cruz" class="btn btn-outline-secondary w-100" data-bs-toggle="tooltip" data-bs-placement="top" title="Gerar cartão Cruz dos selecionados">
            <i class="fa fa-cross me-1"></i> C.Cruz
          </button>
        </div>
      </div>
    </div>
        
        <!-- <div class="col-sm-6 col-xl-3">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                <i class="fa fa-chart-pie fa-3x text-primary"></i>
                <div class="ms-3">
                    <p class="mb-2">Qtd casais</p>
                    <h6 class="mb-0">
                      <?php
                        // if (isset($page) && $page != "") {
                        //   echo qtd_casais($page);   
                        // } else {
                        //   echo qtd_casais("");   
                        // } 
                      ?>
                    </h6>
                </div>
            </div>
        </div> -->
    </div>
</div>
<?php } ?>
<!-- Barra de ferramentas FIM -->


<!-- Listagem de casais início -->
<div class="container-fluid pt-4 px-4">
  <div class="row g-4">
    <div class="col-12">
      <div class="bg-light rounded h-100 p-4 shadow-sm">
        <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3 gap-2">
          <h6 class="mb-0 fw-bold">
            <i class="fa fa-users text-primary me-2"></i>
            <?php
              if ($page == "encontristas") {
                echo "Casais encontristas";
              } elseif ($page == "equipes") {
                echo "Casais de equipes";
              } else {
                echo "Todos os casais";
              }
            ?>
          </h6>
          <a href="?page=<?php echo $page; ?>&operacao=inserir" class="btn btn-success d-flex align-items-center gap-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Adicionar novo casal">
            <i class="fa fa-user-plus"></i> Novo casal
          </a>
        </div>
        <div class="table-responsive mt-3">
          <table class="table table-hover align-middle table-bordered mb-0">
            <thead class="table-light">
              <tr>
                <th scope="col" class="text-center" style="width:48px;">
                  <input class="form-check-input" type="checkbox" id="checkAll" name="checkAll" data-bs-toggle="tooltip" data-bs-placement="top" title="Selecionar todos">
                </th>
                <th scope="col">#</th>
                <th scope="col">Ele</th>
                <th scope="col">Ela</th>
                <th scope="col">
                  <?php
                    if ($page == "encontristas") {
                      echo "Circulo";
                    } elseif ($page == "equipes") {
                      echo "Equipe";
                    } else {
                      echo "Equipe/circ";
                    }
                  ?>
                </th>
              </tr>
            </thead>
            <tbody>
              <?php 
                if (isset($page) && $page != "") {
                  echo listar_casais($page);   
                } else {
                  echo listar_casais("");   
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Listagem de casais fim -->
