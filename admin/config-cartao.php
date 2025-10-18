<?php
// config-cartao.php
include_once("connect.php");

function get_config_cartao($tipo) {
    global $connection;
    $sql = "SELECT * FROM configuracoes_cartao WHERE tipo = '" . mysqli_real_escape_string($connection, $tipo) . "' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row;
    }
    return null;
}

function set_config_cartao($tipo, $largura_mm, $altura_mm, $imagem_fundo) {
    global $connection;
    $tipo = mysqli_real_escape_string($connection, $tipo);
    $largura_mm = (int)$largura_mm;
    $altura_mm = (int)$altura_mm;
    $imagem_fundo = mysqli_real_escape_string($connection, $imagem_fundo);
    $sql = "INSERT INTO configuracoes_cartao (tipo, largura_mm, altura_mm, imagem_fundo) VALUES ('$tipo', $largura_mm, $altura_mm, '$imagem_fundo') ON DUPLICATE KEY UPDATE largura_mm=$largura_mm, altura_mm=$altura_mm, imagem_fundo='$imagem_fundo'";
    return mysqli_query($connection, $sql);
}
?>
