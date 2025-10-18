<?php 

include_once("connect.php");

$casais = [];

$casais["ele_nome"] = "";
$casais["ele_apelido"] = "";
$casais["ela_nome"] = "";
$casais["ela_apelido"] = "";
$casais["telefone_ele"] = "";
$casais["telefone_ela"] = "";
$casais["endereco"] = "";
$casais["coordenador_circulo"] = "";
$casais["circulo"] = "";
$casais["coordenador_equipe"] = "";
$casais["equipe"] = "";
$casais["outras_funcoes"] = "";
$casais["confirmado"] = "";
$casais["obs"] = "";

if (isset($_GET["operacao"]) && ($_GET["operacao"] == "editar")) {
    $casais = buscar_casal($_GET["id"]);
    $casais["outras_funcoes"] = $casais["funcao"];
} 

if (isset($_GET["id"]) && ($_GET["id"] != "")) {
    $id = $_GET["id"];
} 


function buscar_casal($id) {
    global $connection;

    $result = mysqli_query($connection, "SELECT * FROM casais WHERE id = '$id'") or die ("erro");

    $casais = $result->fetch_array();
    (array_key_exists("outras_funcoes", $casais)) ?: $casais["outras_funcoes"] = "";
    (array_key_exists("outras_funcoes", $casais)) ?: $casais["outras_funcoes"] = "";
    (array_key_exists("ele_nome", $casais)) ?: $casais["ele_nome"] = "";
    (array_key_exists("ele_apelido", $casais)) ?: $casais["ele_apelido"] = "";
    (array_key_exists("ela_nome", $casais)) ?: $casais["ela_nome"] = "";
    (array_key_exists("ela_apelido", $casais)) ?: $casais["ela_apelido"] = "";
    (array_key_exists("telefone_ele", $casais)) ?: $casais["telefone_ele"] = "";
    (array_key_exists("telefone_ela", $casais)) ?: $casais["telefone_ela"] = "";
    (array_key_exists("endereco", $casais)) ?: $casais["endereco"] = "";
    (array_key_exists("coordenador_circulo", $casais)) ?: $casais["coordenador_circulo"] = "";
    (array_key_exists("circulo", $casais)) ?: $casais["circulo"] = "";
    (array_key_exists("coordenador_equipe", $casais)) ?: $casais["coordenador_equipe"] = "";
    (array_key_exists("equipe", $casais)) ?: $casais["equipe"] = "";
    (array_key_exists("funcao", $casais)) ?: $casais["funcao"] = "";
    (array_key_exists("confirmado", $casais)) ?: $casais["confirmado"] = "";
    (array_key_exists("obs", $casais)) ?: $casais["obs"] = "";
    return $casais;
}

function montar_circulos($circulo) {
    global $connection;

    $html = '<div class="form-floating mb-3">
        <select class="form-select" id="floatingSelect"
            aria-label="Floating label select example"
            name="circulo">
            <option value="0" selected>Escolha o circulo</option>';

    $result = mysqli_query($connection, "SELECT * FROM circulos") or die ("erro");

    while ($row = $result->fetch_array()) {
        $id = $row["id"];
        $nome = $row["nome"];
        $cor = $row["cor"];
        $cor_codigo = $row["cor_codigo"];
    
        $html .= "<option value='$id'";
        if ($id == $circulo) {
            $html .= " selected ";
        }
        $html .= ">$nome - $cor</option>";
    }
    $html .= '</select>
            <label for="floatingSelect">Circulos de estudos</label>
        </div>';
    return $html;  
}

function montar_equipes($equipe) {
    global $connection;

    $html = '<div class="form-floating mb-3">
        <select class="form-select" id="floatingSelect"
            aria-label="" name="equipe">
            <option value="0" selected>Escolha a equipe</option>';

    $result = mysqli_query($connection, "SELECT * FROM equipes") or die ("erro");

    while ($row = $result->fetch_array()) {
        $id = $row["id"];
        $nome = $row["nome"];
    
        $html .= "<option value='$id'";
        if ($id == $equipe) {
            $html .= " selected ";
        }
        $html .= ">$nome</option>";
    }
    $html .= '</select>
            <label for="floatingSelect">Equipes de trabalho</label>
        </div>';
    return $html;  
}

?>

<div class="col-sm-12 col-xl-6">
    <div class="bg-light rounded h-100 p-4">
        <h6 class="mb-4">
            <i class="fa fa-plus-square fa-3x text-primary"></i>
            Novo casal
        </h6>

        <form action="
        <?php 
            if (isset($id)) {
                echo "?page=$page&operacao=$operacao&id=$id";
            } else {
                echo "?page=$page&operacao=$operacao";
            }  ?>" method="post">
            <input type="hidden" name="enviar_form" value="enviar_form">

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ele_nome"
                    placeholder="Nome Ele:" name="ele_nome" value="<?php echo $casais["ele_nome"]; ?>">
                <label for="ele_nome">Nome dele:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ele_apelido"
                    placeholder="Nome no crachá dele:" name="ele_apelido" value="<?php echo $casais["ele_apelido"]; ?>">
                <label for="ele_apelido">Nome no crachá dele:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ela_nome"
                    placeholder="" name="ela_nome" value="<?php echo $casais["ela_nome"]; ?>">
                <label for="ela_nome">Nome dela:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ela_apelido"
                    placeholder="" name="ela_apelido" value="<?php echo $casais["ela_apelido"]; ?>">
                <label for="ela_apelido">Nome no crachá dela:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="telefone_ele"
                    placeholder="" name="telefone_ele" value="<?php echo $casais["telefone_ele"]; ?>">
                <label for="telefone_ele">Telefones dele:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="telefone_ela"
                    placeholder="" name="telefone_ela" value="<?php echo $casais["telefone_ela"]; ?>">
                <label for="telefone_ela">Telefones dela:</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="endereco"
                    placeholder="" name="endereco" value="<?php echo $casais["endereco"]; ?>">
                <label for="endereco">Endereço</label>
            </div>
        
            <div class="form-check
                <?php
                    if ($page == "encontristas") {
                        echo " hidden ";
                    }
                ?>
            ">
                <input class="form-check-input" type="checkbox" value="" id="coordenador_circulo" name="coordenador_circulo"
                    <?php if ($casais["coordenador_circulo"] == "1") { echo "checked"; } ?>
                >
                <label class="form-check-label" for="coordenador_circulo">
                    Coordenador de círculo?
                </label>
            </div>

            <?php
                echo montar_circulos($casais["circulo"]);
            ?>

            <?php
                if ( 
                        ($page == "equipes")
                    ) {
            ?>

            <div class="form-check
                <?php
                    if ($page == "encontristas") {
                        echo " hidden ";
                    }
                ?>
            ">
                <input class="form-check-input" type="checkbox" value="" id="coordenador_equipe" name="coordenador_equipe"
                    <?php if ($casais["coordenador_equipe"] == "1") { echo "checked"; } ?>
                >
                <label class="form-check-label" for="coordenador_equipe">
                    Coordenador de Equipe de trabalho?
                </label>
            </div>         

            <?php
                    }

                if ($page == "equipes") {
                    echo montar_equipes($casais["equipe"]);
                }  
            ?>

            <input type="hidden" name="tipo" value="<?php
                if ($page == "encontristas") {
                    echo "encontrista";
                } else {
                    echo "equipe";
                }
                ?>">

            <div class="form-floating mb-3 
                <?php
                    if ($page == "encontristas") {
                            echo "hidden";
                    }
                ?>
            ">
                <input type="text" class="form-control" id="outras_funcoes"
                    placeholder="" name="outras_funcoes" value="<?php echo $casais["outras_funcoes"]; ?>">
                <label for="outras_funcoes">Outras funções</label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" 
                    id="confirmado" name="confirmado"
                    <?php if ($casais["confirmado"] == "1") { echo "checked"; } ?>
                >
                <label class="form-check-label" for="confirmado">
                    Confirmado?
                </label>
            </div>                

            <div class="form-floating">
                <textarea class="form-control" placeholder="Deixe as observacoes aqui"
                    id="obs" name="obs" style="height: 150px;"><?php echo $casais["obs"]; ?></textarea>
                <label for="obs">OBS</label>
            </div>

            <!-- <button class="btn btn-primary w-100 m-2" type="button">Enviar</button> -->
            <input type="submit" class="btn btn-primary w-100 m-2" value="Enviar">

            <a href="?page=<?php echo $page; ?>">
                <button class="btn btn-outline-primary w-100 m-2" type="button">
                    Cancelar
                </button>
            </a>

        </form>
    </div>
</div>