<?php
include 'bd.php';

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$termos = isset($_POST['termos']) ?
$_POST['termos'] : '';

$sql_verificar = "SELECT * FROM tb_cadastro WHERE nm_email='$email'";
$result_verificar = mysqli_query($conn, $sql_verificar);

if ($termos != 'on') {
    header("Location: criar.php?registro=termos_nao_aceitos");
        exit();
}

if (mysqli_num_rows($result_verificar) > 0) {
    header("Location: criar.php?registro=email_existente");
    exit();
}

$sql_inserir = "INSERT INTO tb_cadastro (nm_usuario, nm_email, nm_senha, foto) VALUES ('$nome', '$email', MD5('$senha'), 'uploads/default.jpg')";

if (mysqli_query($conn, $sql_inserir)) {
    header("Location: criar.php?registro=sucesso");
        exit();
}
else {
    header("Location: criar.php?registro=erro");
        exit();
}

mysqli_close($conn);
?>