<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

if (!isset($_GET['id_produto'])) {
    header("Location: erro.php");
    exit();
}

$id_produto = $_GET['id_produto'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['cd_usuario'];

    $nome_produto = $_POST['nome_produto'];
    $descricao_produto = $_POST['descricao_produto'];
    $tipo_produto = $_POST['tipo_produto'];
    $numero_produto = $_POST['numero_produto'];

    include 'bd.php';

    $target_dir = "uploads/";
    $uploadOk = 1;
    $imagePaths = [];

    for ($i = 0; $i < count($_FILES["imagens"]["name"]); $i++) {
        $target_file = $target_dir . basename($_FILES["imagens"]["name"][$i]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["imagens"]["tmp_name"][$i]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["imagens"]["tmp_name"][$i], $target_file)) {
                $imagePaths[] = $target_file;
            } else {
                $uploadOk = 0;
                break;
            }
        } else {
            $uploadOk = 0;
            break;
        }
    }

    if ($uploadOk) {
        while (count($imagePaths) < 4) {
            $imagePaths[] = null;
        }

        $sql = "INSERT INTO tb_proposta (cd_usuario, cd_usuario_dono_produto, cd_produto, nm_produto, ds_produto, tipo_produto, nr_produto, imagem1, imagem2, imagem3, imagem4, status) 
                VALUES ('$id_usuario', (SELECT cd_usuario FROM tb_produto WHERE cd_produto = $id_produto), '$id_produto', '$nome_produto', '$descricao_produto', '$tipo_produto', '$numero_produto', '$imagePaths[0]', '$imagePaths[1]', '$imagePaths[2]', '$imagePaths[3]', 'pendente')";

        if ($conn->query($sql) === TRUE) {
            $mensagem = 'Proposta enviada com sucesso';
        } else {
            $mensagem = 'Erro ao enviar proposta: ' . $conn->error;
        }

    } else {
        $mensagem = 'Erro ao fazer upload das imagens.';
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeWear</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="stylesheet" href="Css/pp.css">
</head>
<body>
    
<header>
        <div class="nav container">
            <img src="img/Trade Wear pqn11.png">
            <div>
                <ul id="navbar">
                    <li><a href="Html/index.html">Inicio</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li><a href="Html/sobre.html">Sobre</a></li>
                    <li><a href="Html/contato.html">Contato</a></li>
                </ul>
            </div>    
            <div> 
                <i class='bx bx-heart' id="heart-icon"></i>   
                <i class='bx bx-user' id="heart-icon" onclick="window.location.href='Entrar.php';"></i> 
        </div>
    </header>

    <div class="wrapper">
        <h2>Enviar Proposta</h2>
        <p style='color:blue;'>
        <?php
        if (isset($mensagem)) {
            echo $mensagem;
        }
        ?>
        </p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id_produto=" . $id_produto; ?>" method="post" enctype="multipart/form-data">
        <label for="nome_produto">Nome do Produto:</label><br>
        <input type="text" id="nome_produto" name="nome_produto" required><br>

        <label for="descricao_produto">Descrição do Produto:</label><br>
        <input type="text" id="descricao_produto" name="descricao_produto" required><br>

        <label for="numero_produto">Número do Produto:</label><br>
        <input type="text" id="numero_produto" name="numero_produto" required><br>

        <label for="tipo_produto">Tipo do Produto:</label>
        <select id="tipo_produto" name="tipo_produto" required>
        <option value="Camisas">Camisas</option>
         <option value="Tênis">Tênis</option>
         <option value="Acessórios">Acessórios</option>
         <option value="Bermudas">Bermudas</option>
         <option value="Calças">Calças</option>
         <option value="Moletons">Moletons</option>
        </select><br><br>

        <label for="imagens">Imagens do Produto (4 imagens):</label><br>
        <input type="file" id="imagens" name="imagens[]" accept="image/*" multiple required><br>

        <button type="submit">Enviar Proposta</button>
    </form>
    <div>
</body>
</html>
