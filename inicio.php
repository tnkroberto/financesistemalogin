<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Início</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/menu.css">
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
</head>
<body>
     <header class="header">
        <div class="logo"><img src="image/logo.png"></div>
        <nav>
            <ul class="menu">
                <li><a href="adicionar_compras.php">Adicionar Compras</a></li>
                <li><a href="visualizar_compras.php">Visualizar Compras</a></li>
                <li><a href="editar_usuarios.php">Editar Usuário</a></li>
                <!--<li><span class="username"><?php// echo $_SESSION['user_nome']; ?></span></li>-->
            </ul>
        </nav>
        <a href="logout.php" class="logout-button">Sair</a>
    </header>
    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="image/banner2.png" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/banner2.png" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="image/banner2.png" alt="Third slide">
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>