<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

// Obter informações do usuário da sessão
$user_nome = htmlspecialchars($_SESSION['user_nome']);
$user_role = htmlspecialchars($_SESSION['user_role']);

// Definir mensagem de boas-vindas com base no papel do usuário
if ($user_role === 'admin') {
    $mensagem_boas_vindas = "Bem-vindo(a), $user_nome!<br>Você está logado como <strong>Administrador</strong>.<br>Usuário cadastrado com sucesso no sistema Finance.";
} else {
    $mensagem_boas_vindas = "Bem-vindo(a), $user_nome!<br>Você está logado como <strong>Usuário Comum</strong>.<br>Usuário cadastrado com sucesso no sistema Finance.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início - Finance</title>
    <link rel="stylesheet" type="text/css" href="css/inicio.css">
</head>
<body class="inicio-body">
    <div class="inicio-container">
        <h1><?php echo $mensagem_boas_vindas; ?></h1>
        <p>Explore o sistema e descubra suas funcionalidades.</p>

        <!-- Links de navegação dinâmicos com base no papel do usuário -->
        <?php if ($user_role === 'admin'): ?>
            <a href="admin_dashboard.php" class="btn-dashboard">Painel Administrativo</a>
        <?php else: ?>
            <a href="user_dashboard.php" class="btn-dashboard">Painel do Usuário</a>
        <?php endif; ?>

        <!-- Botão de logout -->
        <a href="logout.php" class="btn-logout">Sair</a>
    </div>
</body>
</html>
