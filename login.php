<?php
include 'bd.php';

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM tb_cadastro WHERE nm_email = '$email' AND nm_senha = MD5('$senha')";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    session_start();

    $_SESSION['nome'] = $usuario['nm_usuario'];
    $_SESSION['email'] = $usuario['nm_email'];
    $_SESSION['cd_usuario'] = $usuario['cd_usuario']; 
    $_SESSION['tipo_usuario'] = $usuario['tipo_usuario'];

    if($usuario['tipo_usuario'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: perfil.php");
    }
    exit();
} else {
    header("Location: entrar.php?logar=erro");
}

$conn->close();
?>
