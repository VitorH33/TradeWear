<?php
session_start();

include 'bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acao']) && isset($_POST['id_proposta'])) {
    $acao = $_POST['acao'];
    $id_proposta = $_POST['id_proposta'];

    if ($acao === 'aprovado') {
        $novo_status = 'aprovado';
    } else if ($acao === 'reprovado') {
        $novo_status = 'reprovado';
    }

    $sql_update = "UPDATE tb_proposta SET status = '$novo_status' WHERE cd_proposta = $id_proposta";
    $conn->query($sql_update);
    header("Location: admin.php");
    exit();
}
?>
