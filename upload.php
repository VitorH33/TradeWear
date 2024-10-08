<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["foto"])) {
   
    $diretorio_destino = "uploads/";

   
    $nome_arquivo = basename($_FILES["foto"]["name"]);


    $caminho_arquivo = $diretorio_destino . $nome_arquivo;

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho_arquivo)) {
     
        include 'bd.php';

        session_start();
        $email = $_SESSION['email'];

        $sql = "UPDATE Tb_cadastro SET foto = '$caminho_arquivo' WHERE Nm_email = '$email'";
        if ($conn->query($sql) === TRUE) {
         
            echo $caminho_arquivo;
        } else {
            echo "Erro ao atualizar a imagem de perfil: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Erro ao fazer o upload do arquivo.";
    }
} else {
    echo "Nenhum arquivo foi enviado.";
}
?>
