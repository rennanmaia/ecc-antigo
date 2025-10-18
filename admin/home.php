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
                    <div class="col-sm-6 col-xl-3">
                        <a href="?page=encontristas">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa fa-chart-line fa-3x text-primary"></i>
                                <div class="ms-3">
                                    <p class="mb-2">Encontristas</p>
                                    <h6 class="mb-0"><?php echo $qtd_casais_encontristas; ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                    <a href="?page=equipes">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Equipes</p>
                                <h6 class="mb-0"><?php echo $qtd_casais_equipes; ?></h6>
                            </div>
                        </div>
</a>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Circulos</p>
                                <h6 class="mb-0"><?php echo $qtd_circulos; ?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2">???</p>
                                <h6 class="mb-0">???</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Barra de ferramentas FIM -->


            <?php
                include_once("casais-listar.php");
            ?>      