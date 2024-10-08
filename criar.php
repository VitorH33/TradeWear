<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Criar Conta</title>
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
        <h1>Criar Conta</h1>
        <?php
            if (isset($_GET['registro'])){
                if ($_GET['registro'] == 'sucesso') {
                    echo "<p style='color:green;'>Registro realizado com sucesso!</p>";
                } elseif ($_GET['registro'] == 'erro') {
                    echo "<p style='color:red;'>Erro ao registrar. Tente novamente. </p>";
                }elseif ($_GET['registro'] == 'email_existente') {
                    echo "<p style='color:red;'>Este email já está cadastrado. Por Favor, escolha outro email.</p>";
                }elseif ($_GET['registro'] == 'termos_nao_aceitos') {
                    echo "<p style='color:red;'>Você precisa aceitar os Termos e Condições!</p>";
                }
            }
        ?>
        <form action="processa.php"
    method="post">
        Email: <input type="email" 
    name="email" required><br>
        Nome: <input type="text"
    name="nome" required><br>
        Senha: <input type="password"
    name="senha" required><br>
        <div class="terms">
            <input type="checkbox" name="termos" id="checkbox">
            <label for="checkbox">Eu concordo com os <a href="#">Termos de Condição</a></a></label>
        </div>
        <div class="reg">
            <input type="submit" value="Registrar">
        </div>
        </form>
        <div class="member">
            Já possui uma conta? <a href="entrar.php">
                Entre aqui
            </a>
        </div>
    </div>

</body>
</html>