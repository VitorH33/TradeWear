<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

$cd_usuario = $_SESSION['cd_usuario'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postar Produto</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <link rel='stylesheet' type='text/css' media='screen' href='Css/pp.css'>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>  
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
                <i class='bx bx-user' id="heart-icon" onclick="window.location.href='entrar.php';"></i> 
        </div>
    </header>

    <div class="wrapper">
    <h2>Postar Produto</h2><br>
    <?php
        if (isset($_GET['cadastro'])){
            if ($_GET['cadastro'] == 'sucesso') {
                echo "<p style='color:green;'>Produto Postado!</p>";
            }elseif ($_GET['cadastro'] == 'erro') {
                echo "<p style='color:red;'Erro ao Postar Produto.</p>";
            }
        }
    ?>
    <form id="myForm" action="cadastrar_produto.php" method="post" enctype="multipart/form-data">
        <label for="nm_produto">Nome:</label>
        <input type="text" id="name" name="nm_produto" required>

        <label for="nm_tamanho">Tamanho:</label>
        <input type="text" id="tam" name="nm_tamanho" required>

        <label for="ds_produto">Descrição:</label>
       <input type="des" id="des" name="ds_produto" required>

        <label for="nm_categoria">Selecione uma Categoria:</label>
     <select id="opcoes" name ="nm_categoria">
         <option value="Camisas">Camisas</option>
         <option value="Tênis">Tênis</option>
         <option value="Acessórios">Acessórios</option>
         <option value="Bermudas">Bermudas</option>
         <option value="Calças">Calças</option>
         <option value="Moletons">Moletons</option>
     </select><br>

     Selecione as imagens: <input type="file" name="fotos[]" multiple required><br>
        
        <div class="reg"><input type="submit" Value="Postar">
        <button onclick="window.location.href='perfil.php'">Voltar</button></div>
    </form>
    </div>
</body>
</html>
