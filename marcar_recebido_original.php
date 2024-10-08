<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

include 'bd.php';

if (isset($_POST['id_proposta'])) {
    $id_proposta = $_POST['id_proposta'];

    $sql_update_status_original = "UPDATE tb_proposta SET status_usuario_produto_original = 'recebido' WHERE cd_proposta = $id_proposta";
    if ($conn->query($sql_update_status_original) === TRUE) {
        
        $sql_check_status = "SELECT status_usuario_produto_original, status_usuario_produto_proposto FROM tb_proposta WHERE cd_proposta = $id_proposta";
        $result = $conn->query($sql_check_status);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['status_usuario_produto_original'] === 'recebido' && $row['status_usuario_produto_proposto'] === 'recebido') {
                $sql_update_status = "UPDATE tb_proposta SET status = 'concluido' WHERE cd_proposta = $id_proposta";
                $conn->query($sql_update_status);
            }
        }

    } else {
        echo "Erro ao atualizar o status: " . $conn->error;
    }

    header("Location: propostas_recebidas.php");
    exit();
}

if (isset($conn)) {
    $conn->close();
}
?>
