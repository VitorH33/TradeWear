<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

include 'bd.php';

$diretorio_destino = "uploads/";

function processar_upload($nome_input) {
    global $diretorio_destino;
    
    $caminhos = [];
    
    if(isset($_FILES[$nome_input]) && is_array($_FILES[$nome_input]['name'])) {
        $total_arquivos = count($_FILES[$nome_input]['name']);

        for($i = 0; $i < $total_arquivos; $i++) {
            $nome_arquivo = $_FILES[$nome_input]['name'][$i];
            $caminho_imagem = $diretorio_destino . basename($nome_arquivo);
            
            if(move_uploaded_file($_FILES[$nome_input]['tmp_name'][$i], $caminho_imagem)) {
                $caminhos[] = $caminho_imagem;
            }
        }
    }

    return $caminhos;
}

$caminhos_imagens = processar_upload('fotos');

while(count($caminhos_imagens) < 4) {
    $caminhos_imagens[] = "";
}

$nm_produto = $_POST['nm_produto'];
$nm_tamanho = $_POST['nm_tamanho'];
$nm_categoria = $_POST['nm_categoria'];
$ds_produto = $_POST['ds_produto'];
$cd_usuario = $_SESSION['cd_usuario'];

$sql = "INSERT INTO tb_produto (cd_usuario, nm_produto, nm_tamanho, nm_categoria, ds_produto, foto1, foto2, foto3, foto4) VALUES ('$cd_usuario', '$nm_produto', '$nm_tamanho', '$nm_categoria', '$ds_produto', '{$caminhos_imagens[0]}', '{$caminhos_imagens[1]}', '{$caminhos_imagens[2]}', '{$caminhos_imagens[3]}')";

if ($conn->query($sql) === TRUE) {
    header("Location: ap.php?cadastro=sucesso");
        exit();
} else {
    header("Location: ap.php?cadastro=erro") . $conn->error;
        exit();
}

$conn->close();
?>
