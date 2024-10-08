<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TradeWear</title>
    <link rel="icon" href="img/Trade Wear pqn11.png" type="image/icon type">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>  
    <link rel="stylesheet" href="Css/produtos.css">
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
            <div class="heart">
                <h2 class="heart-title">Favoritos</h2>
                <div class="heart-content">
                </div>
                <div class="line">
                    
                </div>
                <i class='bx bx-x' id="heart-close"></i>
            </div>
        </div>
    </header>

    <section id="hero"></section>

    <section class="shop container">
        <h2 class="section-title">Recentes</h2>
        <div class="dropdown">
            <button class="dropbtn">Selecione a Categoria</button>
            <div class="dropdown-content">
                <a href="#" onclick="filterProducts('all')">Mostrar Todos</a>
                <a href="#" onclick="filterProducts('Camisas')">Camisas</a>
                <a href="#" onclick="filterProducts('Tênis')">Tênis</a>
                <a href="#" onclick="filterProducts('Acessórios')">Acessórios</a>
            </div>
        </div>
        <div class="b"></div>
        <div class="shop-content">
            <div class="product-box" data-category="Camisas">
                <img src="img produtos/milan.webp" class="product-img" onclick="window.location.href='Html/produto4.html';">
                <h2 class="product-title">Camisa AC Milan</h2>
                <span class="product-des">Camisas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Tênis">
                <img src="img produtos/dunk1.avif" alt="" class="product-img" onclick="window.location.href='Html/produto5.html';">
                <h2 class="product-title">Tênis Nike Dunk Low</h2>
                <span class="product-des">Tênis</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img/oculos1.jpg" alt="" class="product-img" onclick="window.location.href='Html/produto6.html';">
                <h2 class="product-title">Óculos de sol</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Camisas">
                <img src="img/psg1.webp" alt="" class="product-img" onclick="window.location.href='Html/produto7.html';">
                <h2 class="product-title">Camisa PSG</h2>
                <span class="product-des">Camisas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img produtos/gorro.webp" alt="" class="product-img">
                <h2 class="product-title">Gorro chronic</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Camisas">
                <img src="img/Camisa são paulo 2.webp" alt="" class="product-img">
                <h2 class="product-title">Camisa São Paulo</h2>
                <span class="product-des">Camisas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img produtos/bone.jfif" alt="" class="product-img">
                <h2 class="product-title">boné los angeles</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Camisas"> 
                <img src="img/polo preta.jpg" alt="" class="product-img">
                <h2 class="product-title">Polo Preta</h2>
                <span class="product-des">Camisas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img/cinto de couro.jpg" alt="" class="product-img">
                <h2 class="product-title">Cinto de Couro</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img/corrente.webp" alt="" class="product-img">
                <h2 class="product-title">Corrente de Ouro</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Calças">
                <img src="img/calça lacoste.jpeg" alt="" class="product-img">
                <h2 class="product-title">Calça Lacoste</h2>
                <span class="product-des">Calças</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Camisas">
                <img src="img/1676310171803_450x600+fill_ffffff.png" alt="" class="product-img">
                <h2 class="product-title">Camisa Brasil</h2>
                <span class="product-des">Camisas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img/relogioo.webp" alt="" class="product-img">
                <h2 class="product-title">Relógio Mondaine</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Acessórios">
                <img src="img/Bonée.avif" alt="" class="product-img">
                <h2 class="product-title">Boné New Era</h2>
                <span class="product-des">Acessórios</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Calças">
                <img src="img/439fe35e-16ed-42e0-b6d4-ac3ad25f66b11-a9ab250a6ebd1b128316244925969627-1024-1024.jpeg" alt="" class="product-img">
                <h2 class="product-title">Calça Nike</h2>
                <span class="product-des">Calças</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Tênis">
                <img src="img/teniss.webp" alt="" class="product-img">
                <h2 class="product-title">Tênis Olympikus</h2>
                <span class="product-des">Tênis</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <div class="product-box" data-category="Bermudas">
                <img src="img/bermuda lacoste.png" alt="" class="product-img">
                <h2 class="product-title">Bermuada Lacoste</h2>
                <span class="product-des">Bermudas</span>
                <i class='bx bx-heart add-heart'></i>
            </div>
            <?php
            include 'bd.php';

            $sql = "SELECT * FROM tb_produto";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='product-box' data-category='" . $row['nm_categoria'] . "'>";
                        echo "<img src='" . $row['foto1'] . "' class='product-img' onclick='window.location.href=\"produto.php?id=" . $row['cd_produto'] . "\";'>";
                        echo "<h2 class='product-title'>" . $row['nm_produto'] . "</h2>";
                        echo "<span class='product-des'>" . $row['nm_categoria'] . "</span>";
                        echo "<i class='bx bx-heart add-heart'></i>";
                        echo "</div>";
                    }
                } else {
                    echo "";
                }

                $conn->close();
                ?>

        </div>
    </section>


    <script src="JavaScript/produtos.js"></script>
</body>

</html>