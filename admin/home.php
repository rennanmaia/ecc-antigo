<?php

$qtd_casais_encontristas = 0;
$qtd_casais_equipes = 0;
$qtd_circulos = 0;

include_once("connect.php");

global $connection;

// Corrige contagem para ignorar maiúsculas/minúsculas e espaços
$sql = "SELECT COUNT(*) as total FROM casais WHERE LOWER(TRIM(tipo)) = 'encontrista'";
$result = mysqli_query($connection, $sql) or die ("erro");
$row = mysqli_fetch_assoc($result);
$qtd_casais_encontristas = $row['total'];

$sql = "SELECT COUNT(*) as total FROM casais WHERE LOWER(TRIM(tipo)) = 'equipe'";
$result = mysqli_query($connection, $sql) or die ("erro");
$row = mysqli_fetch_assoc($result);
$qtd_casais_equipes = $row['total'];

$sql = "SELECT * FROM circulos";
$result = mysqli_query($connection, $sql) or die ("erro");
$qtd_circulos = $result->num_rows;


?>


<!-- Barra de ferramentas -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <a href="?page=encontristas" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <i class="fa fa-users fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-1 fw-bold text-primary">Encontristas</p>
                            <h3 class="mb-0 fw-bold"><?php echo $qtd_casais_encontristas; ?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <a href="?page=equipes" class="text-decoration-none">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <i class="fa fa-people-carry fa-3x text-success"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-1 fw-bold text-success">Equipes</p>
                            <h3 class="mb-0 fw-bold"><?php echo $qtd_casais_equipes; ?></h3>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <i class="fa fa-circle fa-3x text-warning"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 fw-bold text-warning">Círculos</p>
                        <h3 class="mb-0 fw-bold"><?php echo $qtd_circulos; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <i class="fa fa-cogs fa-3x text-secondary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-1 fw-bold text-secondary">Configurações</p>
                        <a href="config-cartao-form.php" class="btn btn-outline-secondary btn-sm mt-1"><i class="fa fa-cog me-1"></i> Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Barra de ferramentas FIM -->


            <?php
                include_once("casais-listar.php");
                echo listar_casais('todos');
            ?>      