<?php
session_start();

if(isset($_SESSION['nome']) && isset($_SESSION['email'])) {
    if($_SESSION['tipo_usuario'] === 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: perfil.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Entrar na Conta</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Css/Entrar.css'>
    <script src='main.js'></script>
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
                <i class='bx bx-user' id="user-icon"></i>
            </div>
        </div>
    </header>

    <div class="wrapper">
        <h1>Entrar</h1>
        <?php
        if (isset($_GET['logar'])){
             if ($_GET['logar'] == 'erro') {
                echo "<p style='color:red;'>Erro ao logar. Tente novamente. </p>";
            }
        }
        ?>
        <form action="login.php" method="post">
            Email: <input type="email" 
            name="email" required><br>
                Senha: <input type="password"
            name="senha" required><br>
        <div class="reg">
            <input type="submit" value="Login">
        </div>
        </form>
        <div class="member">
            Não possui conta? <a href="criar.php">
                Crie agora
            </a>
        </div>
    </div>

    <script>
        function VerPerfil() {
        window.location.href = 'perfil.php';
        }
       </script>

</body>
</html>
