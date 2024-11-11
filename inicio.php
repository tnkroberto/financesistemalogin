<?php
session_start();


if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}


$user_nome = $_SESSION['user_nome'];
$user_role = $_SESSION['user_role'];


if ($user_role == 'admin') {
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
        <a href="logout.php" class="btn-logout">Sair</a>
    </div>
</body>
</html>
