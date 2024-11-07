<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $user_email = $_POST['user_email'];
    $user_senha = $_POST['user_senha'];

    // Buscar usuário no banco de dados com base no e-mail
    $query = "SELECT * FROM usuario WHERE email = '$user_email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        // Verificar a senha
        if (password_verify($user_senha, $user['senha'])) {
            // Senha correta, iniciar sessão
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];  // Salvar o e-mail também, caso necessário
            header("Location: inicio.php");
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body class="login-body">
    <div class="login-container">
        <h2 class="login-title"><img src="image/logo.png" alt="Logo" class="login-logo"> Login</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="login-form">
            <div class="form-group">
                <label for="user_email" class="form-label">E-mail:</label>
                <input type="email" id="user_email" name="user_email" class="form-input" required>
            </div>

            <div class="form-group">
                <label for="user_senha" class="form-label">Senha:</label>
                <input type="password" id="user_senha" name="user_senha" class="form-input" required>
            </div>

            <button type="submit" class="login-button">Login</button>
        </form>

        <p class="register-link">Não tem uma conta? <a href="register.php" class="register-anchor">Cadastre-se aqui</a>.</p>
    </div>
</body>
</html>
