<?php
// Iniciar ou retomar uma sessão
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['user_nome'])) {
    // Destruir todas as variáveis de sessão
    session_unset();

    // Destruir a sessão
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Finance</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body class="corpo"> 
    <!-- Centralizando o botão de login -->
    <div class="login-container">
        <a href="login.php" class="login-btn">Login</a>
    </div>

    <div class="logo"><img src="image/logo.png"></div>
    <main class="banner">
        <article class="banner-paragrafo">
            <p class="paragrafo1">Construa seu futuro e descubra o segredo do sucesso agora</p>
            <p class="paragrafo2">Use finance para melhorar o seu futuro</p>
        </article>
        <article class="imagem">
            <img src="image/iphone.png" alt="iPhone">
        </article>
    </main>
    <footer class="Rodapé">
    </footer>
</body>
</html>
