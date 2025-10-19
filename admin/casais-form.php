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

<div class="container-fluid pt-4 px-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 col-xl-6">
            <div class="bg-light rounded h-100 p-4 shadow-sm">
                <h6 class="mb-4 d-flex align-items-center gap-2">
                    <i class="fa fa-user-edit fa-2x text-primary"></i>
                    <?php echo isset($id) ? 'Editar casal' : 'Novo casal'; ?>
                </h6>
                <form action="<?php if (isset($id)) { echo "?page=$page&operacao=$operacao&id=$id"; } else { echo "?page=$page&operacao=$operacao"; } ?>" method="post">
                    <input type="hidden" name="enviar_form" value="enviar_form">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ele_nome" placeholder="Nome dele" name="ele_nome" value="<?php echo $casais["ele_nome"]; ?>">
                                <label for="ele_nome">Nome dele</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ele_apelido" placeholder="Nome no crachá dele" name="ele_apelido" value="<?php echo $casais["ele_apelido"]; ?>">
                                <label for="ele_apelido">Nome no crachá dele</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ela_nome" placeholder="Nome dela" name="ela_nome" value="<?php echo $casais["ela_nome"]; ?>">
                                <label for="ela_nome">Nome dela</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ela_apelido" placeholder="Nome no crachá dela" name="ela_apelido" value="<?php echo $casais["ela_apelido"]; ?>">
                                <label for="ela_apelido">Nome no crachá dela</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefone_ele" placeholder="Telefones dele" name="telefone_ele" value="<?php echo $casais["telefone_ele"]; ?>">
                                <label for="telefone_ele">Telefones dele</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="telefone_ela" placeholder="Telefones dela" name="telefone_ela" value="<?php echo $casais["telefone_ela"]; ?>">
                                <label for="telefone_ela">Telefones dela</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="endereco" placeholder="Endereço" name="endereco" value="<?php echo $casais["endereco"]; ?>">
                                <label for="endereco">Endereço</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check mb-3 <?php if ($page == "encontristas") { echo "d-none"; } ?>">
                                <input class="form-check-input" type="checkbox" value="1" id="coordenador_circulo" name="coordenador_circulo" <?php if ($casais["coordenador_circulo"] == "1") { echo "checked"; } ?>>
                                <label class="form-check-label" for="coordenador_circulo">Coordenador de círculo?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php echo montar_circulos($casais["circulo"]); ?>
                        </div>
                        <?php if ($page == "equipes") { ?>
                        <div class="col-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="coordenador_equipe" name="coordenador_equipe" <?php if ($casais["coordenador_equipe"] == "1") { echo "checked"; } ?>>
                                <label class="form-check-label" for="coordenador_equipe">Coordenador de Equipe de trabalho?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <?php echo montar_equipes($casais["equipe"]); ?>
                        </div>
                        <?php } ?>
                        <input type="hidden" name="tipo" value="<?php echo ($page == "encontristas") ? "encontrista" : "equipe"; ?>">
                        <div class="col-12 <?php if ($page == "encontristas") { echo "d-none"; } ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="outras_funcoes" placeholder="Outras funções" name="outras_funcoes" value="<?php echo $casais["outras_funcoes"]; ?>">
                                <label for="outras_funcoes">Outras funções</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="1" id="confirmado" name="confirmado" <?php if ($casais["confirmado"] == "1") { echo "checked"; } ?>>
                                <label class="form-check-label" for="confirmado">Confirmado?</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Deixe as observações aqui" id="obs" name="obs" style="height: 120px;"><?php echo $casais["obs"]; ?></textarea>
                                <label for="obs">Observações</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column flex-md-row gap-2 mt-3">
                        <button type="submit" class="btn btn-primary flex-fill">
                            <i class="fa fa-save me-1"></i> Salvar
                        </button>
                        <a href="?page=<?php echo $page; ?>" class="btn btn-outline-secondary flex-fill">
                            <i class="fa fa-times me-1"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>