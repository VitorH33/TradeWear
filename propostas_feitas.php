<?php
session_start();

if (!isset($_SESSION['nome']) || !isset($_SESSION['email'])) {
    header("Location: entrar.php");
    exit();
}

include 'bd.php';

$id_usuario = $_SESSION['cd_usuario'];

$sql = "SELECT 
            p.*, 
            prod.nm_produto AS nome_produto_original, 
            prod.foto1 AS foto_produto_original, 
            prod.foto2 AS foto2_produto_original,
            prod.foto3 AS foto3_produto_original,
            prod.foto4 AS foto4_produto_original,
            prod.ds_produto AS descricao_produto_original,
            prod.nm_categoria AS categoria_produto_original,
            prod.nm_tamanho AS tamanho_produto_original,
            u.nm_usuario AS nome_usuario_dono,
            u.foto AS foto_perfil_usuario
        FROM tb_proposta p 
        JOIN tb_produto prod ON p.cd_produto = prod.cd_produto 
        JOIN tb_cadastro u ON prod.cd_usuario = u.cd_usuario
        WHERE p.cd_usuario = $id_usuario
        ORDER BY p.cd_proposta DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Propostas Feitas</title>
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
                    <li><a href="index.html">Inicio</a></li>
                    <li><a href="produtos.php">Produtos</a></li>
                    <li><a href="sobre.html">Sobre</a></li>
                    <li><a href="contato.html">Contato</a></li>
                </ul>
            </div>    
            <div>
                <i class='bx bx-heart' id="heart-icon"></i>
                <i class='bx bx-user' id="heart-icon" onclick="window.location.href='entrar.php';"></i> 
            </div>
        </div>
    </header>

    <div class="b"></div>
    <div class="titulo1"><h2>Propostas Feitas</h2></div>
    <div class="propostas">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $foto_perfil = !empty($row['foto_perfil_usuario']) ? $row['foto_perfil_usuario'] : 'img/default_profile.png';
            echo "<div class='proposta'>";
            echo "<div class='proposta-usuario'>";
            echo "<img src='" . htmlspecialchars($foto_perfil) . "' alt='Foto de Perfil' width='150'>";
            echo "<p>Proposta feita para: " . htmlspecialchars($row['nome_usuario_dono']) . "</p>";
            echo "</div>";
            echo "<div class='proposta-produtos'>";
            echo "<div class='produto-proposta'>";
            echo "<img src='" . htmlspecialchars($row['imagem1']) . "' alt='Imagem do Produto Proposto' width='150'>";
            echo "<p>Produto Proposto: " . htmlspecialchars($row['nm_produto']) . "</p>";
            echo "<p>Categoria do Produto Proposto: " . htmlspecialchars($row['tipo_produto']) . "</p>";
            echo "</div>";
            echo "<div class='produto-original'>";
            echo "<img src='" . htmlspecialchars($row['foto_produto_original']) . "' alt='Imagem do Produto Original' width='150'>";
            echo "<p>Produto Original: " . htmlspecialchars($row['nome_produto_original']) . "</p>";
            echo "<p>Categoria do Produto Original: " . htmlspecialchars($row['categoria_produto_original']) . "</p>";
            echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_original']) . "\", \"" . htmlspecialchars($row['descricao_produto_original']) . "\", \"" . htmlspecialchars($row['categoria_produto_original']) . "\", \"" . htmlspecialchars($row['tamanho_produto_original']) . "\", [\"" . htmlspecialchars($row['foto_produto_original']) . "\", \"" . (!empty($row['foto2_produto_original']) ? htmlspecialchars($row['foto2_produto_original']) : '') . "\", \"" . (!empty($row['foto3_produto_original']) ? htmlspecialchars($row['foto3_produto_original']) : '') . "\", \"" . (!empty($row['foto4_produto_original']) ? htmlspecialchars($row['foto4_produto_original']) : '') . "\"])'>Ver mais</button>";
            echo "</div>";
            echo "</div>";
            $status = htmlspecialchars($row['status']);
            $status_usuario_produto_proposto = htmlspecialchars($row['status_usuario_produto_proposto']);
            echo "<div>";
            echo "<p>Status da Proposta: <span>$status</span></p>";

            if ($status === 'aprovado' && empty($status_usuario_produto_proposto)) {
                echo "<form method='POST' action='marcar_recebido_proposto.php' style='margin-top: 10px;'>";
                echo "<input type='hidden' name='id_proposta' value='" . htmlspecialchars($row['cd_proposta']) . "'>";
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
        echo "Você não tem propostas feitas.";
    }

    $conn->close();
    ?>
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
