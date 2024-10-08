<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['tipo_usuario'] !== 'admin') {
    header("Location: entrar.php");
    exit();
}

include 'bd.php';

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
        WHERE p.status IN ('aceita', 'aprovado', 'reprovado', 'concluido')
        ORDER BY p.cd_proposta DESC";


$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Administração</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Css/propostas.css'>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .proposta-usuario img {
    border-radius: 50%;
    margin-right: 10px;
    width: 100px;
    height: 100px;
}

.btn-aprovar, .btn-reprovar {
    color: #fff;
    border: none;
    padding: 12px 24px; /* Ajuste o padding conforme necessário para aumentar o tamanho */
    border-radius: 4px;
    cursor: pointer;
    margin-right: 40px;
}
    </style>
</head>
<body>
    <header>
        <div class="nav container">
            <img src="img/Trade Wear pqn11.png">
            <div>
                <ul id="navbar">
                    <li><a href="Html/index.html">Início</a></li>
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
        <div class="titulo1"><h2>Administração</h2></div>
        <div class="propostas">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='proposta'>";
                    echo "<div class='proposta-usuario'>";
                    echo "<img src='" . htmlspecialchars($row['foto_usuario_dono_produto_proposto']) . "' alt='Imagem do Usuario Produto Proposto' width='150'>";
                    echo "<p>Proposta enviada por: " . htmlspecialchars($row['nome_usuario_dono_produto_proposto']) . "</p>";
                    echo "</div>";
                    echo "<div class='proposta-usuario'>";
                    echo "<img src='" . htmlspecialchars($row['foto_usuario_dono_produto_original']) . "' alt='Imagem do Usuario Produto Original' width='150'>";
                    echo "<p>Proposta recebida por: " . htmlspecialchars($row['nome_usuario_dono_produto_original']) . "</p>";
                    echo "</div>";
                    echo "<div class='proposta-produtos'>";
                    echo "<div class='produto-proposta'>";
                    echo "<img src='" . htmlspecialchars($row['foto_produto_proposto']) . "' alt='Imagem do Produto Proposto' width='150'>";
                    echo "<p>Produto Proposto: " . htmlspecialchars($row['nome_produto_proposto']) . "</p>";
                    echo "<p>Categoria do Produto Proposto: " . htmlspecialchars($row['categoria_produto_proposto']) . "</p>";
                    echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_proposto']) . "\", \"" . htmlspecialchars($row['descricao_produto_proposto']) . "\", \"" . htmlspecialchars($row['categoria_produto_proposto']) . "\" , \"" . htmlspecialchars($row['tamanho_produto_proposto']) . "\", [\"" . htmlspecialchars($row['foto_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto2_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto3_produto_proposto']) . "\", \"" . htmlspecialchars($row['foto4_produto_proposto']) . "\"])'>Ver mais</button>";
                    echo "</div>";
                    echo "<div class='produto-original'>";
                    echo "<img src='" . htmlspecialchars($row['foto_produto_original']) . "' alt='Imagem do Produto Original' width='150'>";
                    echo "<p>Produto Original: " . htmlspecialchars($row['nome_produto_original']) . "</p>";
                    echo "<p>Categoria do Produto Original: " . htmlspecialchars($row['categoria_produto_original']) . "</p>";
                    echo "<button class='ver-mais-btn' onclick='openModal(\"" . htmlspecialchars($row['nome_produto_original']) . "\", \"" . htmlspecialchars($row['descricao_produto_original']) . "\", \"" . htmlspecialchars($row['categoria_produto_original']) . "\" , \"" . htmlspecialchars($row['tamanho_produto_original']). "\", [\"" . htmlspecialchars($row['foto_produto_original']) . "\", \"" . htmlspecialchars($row['foto2_produto_original']) . "\", \"" . htmlspecialchars($row['foto3_produto_original']) . "\", \"" . htmlspecialchars($row['foto4_produto_original']) . "\"])'>Ver mais</button>";
                    echo "</div>";
                    echo "</div>";

                    $status = htmlspecialchars($row['status']);

                    if ($status === 'aceita') {
                        echo "<form method='post' action='admin_action.php'>";
                        echo "<input type='hidden' name='id_proposta' value='" . htmlspecialchars($row['cd_proposta']) . "'>";
                        echo "<button type='submit' name='acao' value='aprovado' class='btn-aprovar'>Aprovar</button>";
                        echo "<button type='submit' name='acao' value='reprovado' class='btn-reprovar'>Reprovar</button>";
                        echo "</form>";
                    }

                    if ($status === 'aprovado') {
                        echo "<p>Status da Proposta: <span>$status</span></p>";
                    }

                    if ($status === 'reprovado') {
                        echo "<p>Status da Proposta: <span>$status</span></p>";
                    }

                    if ($status === 'concluido') {
                        echo "<p>Status da Proposta: <span>$status</span></p>";
                    }
                    
                    echo "<hr>";
                    echo "</div>";
                }
            } else {
                echo "Não há propostas aceitas.";
            }

            $conn->close();
            ?>
        </div>

        <form action="logout.php" method="post">
            <input type="submit" value="Logout">
        </form>

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
