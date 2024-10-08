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
            prod.nm_categoria AS categoria_produto_original, 
            prod.ds_produto AS descricao_produto_original,
            prod.nm_tamanho AS tamanho_produto_original,
            p.nm_produto AS nome_produto_proposto, 
            p.imagem1 AS foto_produto_proposto, 
            p.imagem2 AS foto2_produto_proposto, 
            p.imagem3 AS foto3_produto_proposto, 
            p.imagem4 AS foto4_produto_proposto, 
            p.tipo_produto AS categoria_produto_proposto, 
            p.ds_produto AS descricao_produto_proposto,
            p.nr_produto AS tamanho_produto_proposto,
            u1.nm_usuario AS nome_usuario_dono_produto_original,
            u2.nm_usuario AS nome_usuario_dono_produto_proposto,
            u1.foto AS foto_usuario_dono_produto_original,
            u2.foto AS foto_usuario_dono_produto_proposto
        FROM tb_proposta p 
        JOIN tb_produto prod ON p.cd_produto = prod.cd_produto 
        JOIN tb_cadastro u1 ON prod.cd_usuario = u1.cd_usuario
        JOIN tb_cadastro u2 ON p.cd_usuario = u2.cd_usuario
        WHERE p.status = 'concluido' AND (p.cd_usuario_dono_produto = $id_usuario OR p.cd_usuario = $id_usuario)
        ORDER BY p.cd_proposta DESC";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Histórico</title>
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
        </div>
    </header>
    
    <div class="b"></div>
    <div class="titulo1"><h2>Histórico</h2></div>
    <div class="propostas">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='proposta'>";
            echo "<div class='proposta-produtos'>";
            echo "<div class='produto-original'>";
            echo "<p>Produto Original:</p>";
            echo "<img src='" . htmlspecialchars($row['foto_produto_original']) . "' alt='Imagem do Produto Original' width='150'>";
            echo "<p>Nome: " . htmlspecialchars($row['nome_produto_original']) . "</p>";
            echo "<p>Categoria: " . htmlspecialchars($row['categoria_produto_original']) . "</p>";
            echo "<p>Antigo Dono: " . htmlspecialchars($row['nome_usuario_dono_produto_original']) . "</p>";
            echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_original']) . "\", \"" . htmlspecialchars($row['descricao_produto_original']) . "\", \"" . htmlspecialchars($row['categoria_produto_original']) . "\", \"" . htmlspecialchars($row['tamanho_produto_original']) . "\", [\"" . htmlspecialchars($row['foto_produto_original']) . "\", \"" . htmlspecialchars($row['foto2_produto_original']) . "\", \"" . htmlspecialchars($row['foto3_produto_original']) . "\", \"" . htmlspecialchars($row['foto4_produto_original']) . "\"])'>Ver mais</button>";
            echo "</div>";
            echo "<div class='produto-proposta'>";
            echo "<p>Produto Proposto:</p>";
            echo "<img src='" . htmlspecialchars($row['foto_produto_proposto']) . "' alt='Imagem do Produto Proposto' width='150'>";
            echo "<p>Nome: " . htmlspecialchars($row['nome_produto_proposto']) . "</p>";
            echo "<p>Categoria: " . htmlspecialchars($row['categoria_produto_proposto']) . "</p>";
            echo "<p>Antigo Dono: " . htmlspecialchars($row['nome_usuario_dono_produto_proposto']) . "</p>";
            echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_proposto']) . "\", \"" . htmlspecialchars($row['descricao_produto_proposto']) . "\", \"" . htmlspecialchars($row['categoria_produto_proposto']) . "\", \"" . htmlspecialchars($row['tamanho_produto_proposto']) . "\", [\"" . htmlspecialchars($row['foto_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto2_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto3_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto4_produto_proposto']) . "\"])'>Ver mais</button>";
            echo "</div>";
            echo "</div>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "Você não tem propostas concluidas.";
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
