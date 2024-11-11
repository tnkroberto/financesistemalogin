<?php
// Iniciar ou retomar uma sessão
session_start();

// Verificar se o usuário está logado
$isLoggedIn = isset($_SESSION['user_nome']);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Finance</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body class="corpo"> 
    <!-- Centralizando o botão de login ou exibição de boas-vindas -->
    <div class="login-container">
        <?php if ($isLoggedIn): ?>
            <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_nome']); ?>!</p>
            <?php if ($_SESSION['user_role'] === 'admin'): ?>
                <a href="admin_dashboard.php" class="dashboard-btn">Painel Administrativo</a>
            <?php else: ?>
                <a href="user_dashboard.php" class="dashboard-btn">Painel do Usuário</a>
            <?php endif; ?>
            <a href="logout.php" class="logout-btn">Sair</a>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>

    <div class="logo">
        <img src="image/logo.png" alt="Logo Finance">
    </div>
    <main class="banner">
        <article class="banner-paragrafo">
            <p class="paragrafo1">Construa seu futuro e descubra o segredo do sucesso agora</p>
            <p class="paragrafo2">Use Finance para melhorar o seu futuro</p>
        </article>
        <article class="imagem">
            <img src="image/iphone.png" alt="iPhone">
        </article>
    </main>
    <footer class="Rodapé">
    </footer>
</body>
</html>
