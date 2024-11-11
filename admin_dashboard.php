<?php
session_start();

// Verificar se o usuário está logado e tem o papel de administrador
if (!isset($_SESSION['user_nome']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$user_nome = $_SESSION['user_nome']; // Obter o nome do usuário para personalizar a saudação
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="css/admin_dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <h1>Bem-vindo ao Painel Administrativo, <?php echo $user_nome; ?>!</h1>
        <!-- Conteúdo exclusivo para administradores -->
        <p>Gerencie os usuários e as finanças do sistema.</p>
        <a href="logout.php" class="btn-logout">Sair</a>
    </div>
</body>
</html>
