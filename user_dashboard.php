<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

echo "<h1>Bem-vindo ao Painel do Usuário, " . htmlspecialchars($_SESSION['user_nome']) . "!</h1>";
echo "<p>Aqui você pode acessar funcionalidades de usuário.</p>";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário - Finance</title>
    <link rel="stylesheet" type="text/css" href="css/user_dashboard.css">
</head>
<body>

    <div class="dashboard-container">
        <h1>Bem-vindo ao seu painel, <?php echo htmlspecialchars($_SESSION['user_nome']); ?>!</h1>
        <p>Explore suas opções de usuário.</p>

        <!-- Exemplo de botões -->
        <a href="logout.php" class="btn-logout">Sair</a>
        <a href="user_profile.php" class="btn-back">Voltar ao Perfil</a>
    </div>

</body>
</html>
