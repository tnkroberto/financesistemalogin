<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';
$user_nome = $_SESSION['user_nome'];

// Obter informações do usuário
$query = "SELECT * FROM usuario WHERE user_nome = '$user_nome'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Obter salário do usuário
$query = "SELECT * FROM salario WHERE user_nome = '$user_nome'";
$result = mysqli_query($conn, $query);
$salario = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_salario = $_POST['novo_salario'];

    // Atualizar salário
    $query = "UPDATE salario SET sal_valor = '$novo_salario' WHERE user_nome = '$user_nome'";
    if (mysqli_query($conn, $query)) {
        // Atualizar a variável $salario para exibir o novo valor na página
        $salario['sal_valor'] = $novo_salario;
    } else {
        echo "Erro ao atualizar o salário: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/editar_usuarios.css">
</head>
<body>
    <header class="header">
        <div class="logo"><img src="image/logo.png"></div>
        <nav>
            <ul class="menu">
                <li><a href="inicio.php">Início</a></li>
                <li><a href="adicionar_compras.php">Adicionar Compras</a></li>
                <li><a href="visualizar_compras.php">Visualizar Compras</a></li>
                <li><a href="editar_usuarios.php">Editar Usuário</a></li>
            </ul>
        </nav>
        <a href="logout.php" class="logout-button">Sair</a>
    </header>

    <div class="container">
        <h2>Dados do Usuário</h2>
        <p><strong>Nome de Usuário:</strong> <?php echo $user['user_nome']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['user_email']; ?></p>
        <p><strong>Salário:</strong> R$ <?php echo $salario['sal_valor']; ?></p>
        <form action="#" method="post">
            <label for="novo_salario">Novo Salário:</label>
            <input type="number" step="0.01" id="novo_salario" name="novo_salario" required><br>
            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>