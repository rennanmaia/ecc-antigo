<?php
// config-cartao-form.php
include_once("config-cartao.php");

$tipos = ['encontrista' => 'Encontristas', 'equipe' => 'Equipes de Trabalho'];
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'];
    $largura = $_POST['largura'];
    $altura = $_POST['altura'];
    $imagem_fundo = '';
    if (isset($_FILES['imagem_fundo']) && $_FILES['imagem_fundo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['imagem_fundo']['name'], PATHINFO_EXTENSION);
        $dest_dir = __DIR__ . '/img';
        if (!is_dir($dest_dir)) {
            mkdir($dest_dir, 0777, true);
        }
        $dest_filename = 'bg_' . $tipo . '.' . $ext;
        $dest_path = $dest_dir . '/' . $dest_filename;
        if (move_uploaded_file($_FILES['imagem_fundo']['tmp_name'], $dest_path)) {
            $imagem_fundo = 'img/' . $dest_filename;
        } else {
            $imagem_fundo = '';
        }
    } else if (!empty($_POST['imagem_fundo_atual'])) {
        $imagem_fundo = $_POST['imagem_fundo_atual'];
    }
    if (set_config_cartao($tipo, $largura, $altura, $imagem_fundo)) {
        $msg = 'Configuração salva com sucesso!';
    } else {
        global $connection;
        $msg = 'Erro ao salvar configuração: ' . mysqli_error($connection);
    }
}

$configs = [];
foreach ($tipos as $tipo => $label) {
    $configs[$tipo] = get_config_cartao($tipo);
}
?>
<?php include_once("autentica.php"); include_once("funcoes.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Configurações</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/customized_style.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <?php include_once("topo-esquerdo.php"); include_once("menu-esquerdo.php"); ?>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Content Start -->
        <div class="content">
            <?php include_once("menu-topo.php"); ?>
            <div class="container-fluid pt-4 px-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2>Configurações</h2>
                    <a href="index.php" class="btn btn-secondary">Voltar para o sistema</a>
                </div>
                <?php if ($msg): ?>
                    <div class="alert alert-info"><?= $msg ?></div>
                <?php endif; ?>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo de Cartão</label>
                        <select name="tipo" id="tipo" class="form-select" required>
                            <?php foreach ($tipos as $key => $label): ?>
                                <option value="<?= $key ?>"><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="largura" class="form-label">Largura (mm)</label>
                        <input type="number" name="largura" id="largura" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="altura" class="form-label">Altura (mm)</label>
                        <input type="number" name="altura" id="altura" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagem_fundo" class="form-label">Imagem de Fundo</label>
                        <input type="file" name="imagem_fundo" id="imagem_fundo" class="form-control">
                        <input type="hidden" name="imagem_fundo_atual" id="imagem_fundo_atual">
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
                <hr>
                <h4>Configurações Atuais</h4>
                <div class="row">
                    <?php foreach ($configs as $tipo => $conf): ?>
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header">Tipo: <?= $tipos[$tipo] ?></div>
                                <div class="card-body">
                                    <p>Largura: <?= $conf ? $conf['largura_mm'] : '-' ?> mm</p>
                                    <p>Altura: <?= $conf ? $conf['altura_mm'] : '-' ?> mm</p>
                                    <p>Imagem de Fundo:<br>
                                        <?php if ($conf && $conf['imagem_fundo']): ?>
                                            <img src="../<?= $conf['imagem_fundo'] ?>" alt="Fundo" style="max-width:100%;max-height:120px;">
                                        <?php else: ?>
                                            <em>Não definida</em>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">1ºECC São Francisco</a>, Arquidiocese de Santarém. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Adaptadado por Rennan Maia
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
