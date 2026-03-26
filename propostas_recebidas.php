<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

include 'bd.php';

$id_usuario = $_SESSION['cd_usuario'];

if (isset($_POST['acao']) && isset($_POST['id_proposta'])) {
    $acao = $_POST['acao'];
    $id_proposta = $_POST['id_proposta'];

    if ($acao === 'aceitar') {
        $novo_status = 'aceita';
    } else if ($acao === 'recusar') {
        $novo_status = 'recusada';
    }

    $sql_update = "UPDATE tb_proposta SET status = '$novo_status' WHERE cd_proposta = $id_proposta";
    $conn->query($sql_update);
}

$sql = "SELECT 
            prod.*,
            p.cd_proposta AS proposta,
            p.nm_produto AS nome_produto_proposto,
            p.imagem1 AS foto_produto_proposto, 
            p.imagem2 AS foto2_produto_proposto, 
            p.imagem3 AS foto3_produto_proposto, 
            p.imagem4 AS foto4_produto_proposto, 
            p.tipo_produto AS categoria_produto_proposto,
            p.ds_produto AS descricao_produto_proposto,
            p.nr_produto AS tamanho_produto_proposto,
            p.status AS status_troca,
            p.status_usuario_produto_original AS status_produto_original,
            u.nm_usuario AS nome_usuario_proposta,
            u.foto AS foto_perfil_usuario
        FROM tb_produto prod 
        JOIN tb_proposta p ON p.cd_produto = prod.cd_produto 
        JOIN tb_cadastro u ON p.cd_usuario = u.cd_usuario
        WHERE prod.cd_usuario = $id_usuario
        ORDER BY proposta DESC";  

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Propostas Recebidas</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Css/propostas.css'>
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

    <div class="b"></div>
    <div class="titulo1"><h2>Propostas Recebidas</h2></div>
    <div class="propostas">
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $foto_perfil = !empty($row['foto_perfil_usuario']) ? $row['foto_perfil_usuario'] : 'img/default_profile.png';
            echo "<div class='proposta'>";
            echo "<div class='proposta-usuario'>";
            echo "<img src='" . htmlspecialchars($foto_perfil) . "' alt='Foto de Perfil' width='150'>";
            echo "<p>Proposta enviada por: " . htmlspecialchars($row['nome_usuario_proposta']) . "</p>";
            echo "</div>";
            echo "<div class='proposta-produtos'>";
            echo "<div class='produto-proposta'>";
            echo "<img src='" . htmlspecialchars($row['foto_produto_proposto']) . "' alt='Imagem do Produto Proposto'>";
            echo "<p>Produto Proposto: " . htmlspecialchars($row['nome_produto_proposto']) . "</p>";
            echo "<p>Categoria do Produto Proposto: " . htmlspecialchars($row['categoria_produto_proposto']) . "</p>";
            echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_proposto']) . "\", \"" . htmlspecialchars($row['descricao_produto_proposto']) . "\", \"" . htmlspecialchars($row['categoria_produto_proposto']) . "\", \"" . htmlspecialchars($row['tamanho_produto_proposto']) . "\", [\"" . htmlspecialchars($row['foto_produto_proposto']) . "\", \"" . (!empty($row['foto2_produto_proposto']) ? htmlspecialchars($row['foto2_produto_proposto']) : '') . "\", \"" . (!empty($row['foto3_produto_proposto']) ? htmlspecialchars($row['foto3_produto_proposto']) : '') . "\", \"" . (!empty($row['foto4_produto_proposto']) ? htmlspecialchars($row['foto4_produto_proposto']) : '') . "\"])'>Ver mais</button>";
            echo "</div>";
            echo "<div class='produto-original'>";
            echo "<img src='" . htmlspecialchars($row['foto1']) . "' alt='Imagem do Produto Original'>";
            echo "<p>Produto Original: " . htmlspecialchars($row['nm_produto']) . "</p>";
            echo "<p>Categoria do Produto Original: " . htmlspecialchars($row['nm_categoria']) . "</p>";
            echo "</div>"; 
            echo "</div>"; 
            
            $status = htmlspecialchars($row['status_troca']);
            $status_usuario_produto_original = htmlspecialchars($row['status_produto_original']);

            echo "<div>";
            echo "<p>Status da Proposta: <span>$status</span></p>";

            if ($status === 'pendente') {
                echo "<form method='POST' style='margin-top: 10px;'>";
                echo "<input type='hidden' name='id_proposta' value='" . htmlspecialchars($row['proposta']) . "'>";
                echo "<button type='submit' name='acao' value='aceitar' class='btn-aprovar'>Aceitar</button>";
                echo "<button type='submit' name='acao' value='recusar' class='btn-reprovar'>Recusar</button>";
                echo "</form>";
                echo "<br>";
            }

            if ($status === 'aprovado' && empty($status_usuario_produto_original)) {
                echo "<form method='POST' action='marcar_recebido_original.php' style='margin-top: 10px;'>";
                echo "<input type='hidden' name='id_proposta' value='" . htmlspecialchars($row['proposta']) . "'>";
                echo "<button type='submit' class='recebido-btn'>Marcar como Recebido</button>";
                echo "</form>";
                echo "<br>";
            }
            
            if ($status === 'aceita') {
                echo "<p>Envie seu produto para o endereço: Bairro Aparecida, Rua General Rondon 2, Complemento 202</p>";
            }

            echo "</div>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "Você não tem propostas recebidas.";
        }

        if (isset($conn)) {
            $conn->close();
        }
        ?>
            </div>
        </div>

    <!-- Modal Structure -->
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2 id="modal-nome"></h2>
            <p id="modal-descricao"></p>
            <p id="modal-categoria"></p>
            <p id="modal-tamanho"></p>
            <div class="modal-images">
                <span class="prev" onclick="changeSlide(-1)">&#10094;</span>
                <img id="modal-main-image" src="" alt="Imagem do Produto">
                <span class="next" onclick="changeSlide(1)">&#10095;</span>
            </div>
        </div>
    </div>

    <script src="JavaScript/modal.js"></script>
</body>
</html>
