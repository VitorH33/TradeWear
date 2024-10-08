<?php
include 'bd.php';

$product_name = '';

if (isset($_GET['id'])) {
    $id_produto = $_GET['id'];

    $sql = "SELECT nm_produto FROM tb_produto WHERE cd_produto = $id_produto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['nm_produto'];
    } else {
        $product_name = "Produto não encontrado";
    }
} else {
    $product_name = "ID do produto não fornecido";
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo htmlspecialchars($product_name); ?></title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='Css/produtos1.css'>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'> 
    <style>
    

    </style>
</head>
<body>
    <header>
        <div class="nav container">
            <img src="img/Trade Wear pqn11.png">
            <div>
                <ul id="navbar">
                    <li><a href="Html/index.html">Inicio</a></li>
                    <li><a class="active" href="produtos.php">Produtos</a></li>
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

    <?php

    
    include 'bd.php';

    if (isset($_GET['id'])) {
        $id_produto = $_GET['id'];

        $sql = "SELECT * FROM tb_produto WHERE cd_produto = $id_produto";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<section id='prodetails' class='section-p1'>";
            echo "<div class='single-pro-image'>";
            echo "<img src='" . $row['foto1'] . "' width='100%' class='MainImg' id='mainimgid'>";
            echo "<div class='small-img-group'>";
            echo "<div class='small-img-col'>";
            echo "<img src='" . $row['foto1'] . "' width='100%' class='small-img' id='1' alt=''>";
            echo "</div>";
            echo "<div class='small-img-col'>";
            echo "<img src='" . $row['foto2'] . "' width='100%' class='small-img' id='2' alt=''>";
            echo "</div>";
            echo "<div class='small-img-col'>";
            echo "<img src='" . $row['foto3'] . "' width='100%' class='small-img' id='3' alt=''>";
            echo "</div>";
            echo "<div class='small-img-col'>";
            echo "<img src='" . $row['foto4'] . "' width='100%' class='small-img' id='4' alt=''>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "<div class='single-pro-details'>";
            echo "<h2>" . $row['nm_categoria'] . "</h2>";
            echo "<h4>" . $row['nm_produto'] . "</h4>";
            echo "<h4>Tamanho: " . $row['nm_tamanho'] . "</h4>";
            echo "<a class='trade-button' href='enviar_proposta.php?id_produto=" . $id_produto . "'>Trade</a>";
            echo "<div class='b'></div>";
            echo "<h2>Descrição</h2>";
            echo "<span>" . $row['ds_produto'] . "</span>";
            echo "</div>";
            echo "</section>";
        } else {
            echo "Produto não encontrado.";
        }
    } else {
        echo "ID do produto não fornecido.";
    }

    $conn->close();
    ?>

</body>
</html>