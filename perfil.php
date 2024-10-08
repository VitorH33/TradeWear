<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Css/perfil.css'>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){     
            $('#imagem-perfil').click(function(){
                $('#seletor-arquivos').click();
            });

            $('#seletor-arquivos').change(function(){
                var formData = new FormData();
                formData.append('foto', $(this)[0].files[0]);

                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        $('#imagem-perfil').css('background-image', 'url(' + response + ')');
                    }
                });
            });
        });
    </script>
    <style>
        #imagem-perfil {
            cursor: pointer;
            position: relative;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            overflow: hidden;
            background-size: cover;
            background-position: center;
            left: 100px;
            top: 175px;
        }

        #tooltip {
            display: none;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 5px;
            border-radius: 5px;
            top: -30px; 
            left: 0;
        }

        #imagem-perfil:hover #tooltip {
            display: block;
        }
    </style>
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
    
    <?php
session_start();

if(isset($_SESSION['nome']) && isset($_SESSION['email'])) {
    $nome = $_SESSION['nome'];
    $email = $_SESSION['email'];

    include 'bd.php';

    $sql = "SELECT foto FROM tb_cadastro WHERE Nm_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $foto = $row['foto'];

        if (!empty($foto)) {
            echo "<div id='imagem-perfil' style='position: relative; background-image: url(\"$foto\");'><div id='tooltip'>Clique para mudar a foto de perfil</div></div><br>";
        } else {
            echo "<div id='imagem-perfil' style='position: relative; background-image: url(\"uploads/default.jpg\");'><div id='tooltip'>Clique para mudar a foto de perfil</div></div><br>";
        }
    } else {
        echo "<div id='imagem-perfil' style='position: relative; background-image: url(\"uploads/default.jpg\");'><div id='tooltip'>Clique para mudar a foto de perfil</div></div><br>";
    }

    $conn->close();
} else {
    header("Location: entrar.php");
    exit();
}
?>
    
    <input type="file" id="seletor-arquivos" accept="image/*" style="display: none;">

    <div class="formas">
        <h2>Informações</h2></br>
        <h4><span style="color:  #05C0E9;">Nome:</span> <?php echo $nome ?></h4></br>
        <h4><span style="color:  #05C0E9;">Email:</span> <?php echo $email ?></h4></br>
        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>
    </div>
    </section>

   <div class="formas1">
        <button onclick="window.location.href='ap.php'">Postar Produto</button><br>
        <a href="propostas_recebidas.php"><button>Ver Propostas Recebidas</button></a><br>
        <a href="propostas_feitas.php"><button>Ver Propostas Feitas</button></a><br>
        <a href="historico.php"><button>Histórico</button></a>
    </div>

</body>
</html>