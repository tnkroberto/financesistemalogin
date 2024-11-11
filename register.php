<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_nome = $_POST['user_nome'];
    $user_email = $_POST['user_email'];
    $user_senha = $_POST['user_senha'];
    $confirmar_senha = $_POST['confirmar_senha'];
    $sal_valor = $_POST['salario'];
    $user_role = $_POST['role'];

    // Verificar se a senha e a confirmação de senha são iguais
    if ($user_senha !== $confirmar_senha) {
        echo "<script>alert('Erro: As senhas não coincidem.'); window.location.href = 'register.php';</script>";
        exit;
    }

    // Hash da senha
    $hashed_senha = password_hash($user_senha, PASSWORD_DEFAULT);

    // Preparar a inserção do usuário com segurança contra SQL Injection
    $query_usuario = $conn->prepare("INSERT INTO usuario (nome, email, senha, role) VALUES (?, ?, ?, ?)");
    $query_usuario->bind_param("ssss", $user_nome, $user_email, $hashed_senha, $user_role);

    if ($query_usuario->execute()) {
        // Preparar a inserção do salário
        $query_salario = $conn->prepare("INSERT INTO salario (user_nome, sal_valor) VALUES (?, ?)");
        $query_salario->bind_param("sd", $user_nome, $sal_valor);

        if ($query_salario->execute()) {
            // Redirecionar para a página de login
            header("Location: login.php");
            exit;
        } else {
            echo "Erro ao cadastrar salário: " . $query_salario->error;
            exit;
        }
    } else {
        echo "Erro ao cadastrar usuário: " . $query_usuario->error;
    }

    $query_usuario->close();
    $query_salario->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Cadastro</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body class="cadastro-body">
    <div class="cadastro-container">
        <h2 class="cadastro-title"><img src="image/logo.png" alt="Logo" class="cadastro-logo"> Cadastro</h2>
        <form method="POST" class="cadastro-form">
            <div class="form-group">
                <label for="user_nome" class="form-label">Nome de Usuário:</label>
                <input type="text" id="user_nome" name="user_nome" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="user_email" class="form-label">E-mail:</label>
                <input type="email" id="user_email" name="user_email" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="user_senha" class="form-label">Senha:</label>
                <input type="password" id="user_senha" name="user_senha" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="confirmar_senha" class="form-label">Confirmar Senha:</label>
                <input type="password" id="confirmar_senha" name="confirmar_senha" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="salario" class="form-label">Salário:</label>
                <input type="number" id="salario" name="salario" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="role" class="form-label">Permissão:</label>
                <select id="role" name="role" class="form-input" required>
                    <option value="usuario_comum">Usuário Comum</option>
                    <option value="admin">Administrador</option>
                </select>
            </div>

            <button type="submit" class="cadastro-button">Cadastrar</button>
        </form>
        <p class="login-link">Já tem uma conta? <a href="login.php" class="login-anchor">Faça login aqui</a>.</p>
    </div>
</body>
</html>
