<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';
$user_nome = $_SESSION['user_nome'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hist_nome = $_POST['hist_nome'];
    $hist_valor = $_POST['hist_valor'];
    $tipo_compra = $_POST['tipo_compra'];

    // Inserir nova compra na tabela historico usando prepared statements
    $query = "INSERT INTO historico (user_nome, hist_nome, hist_valor, hist_data, tipo_compra) VALUES (?, ?, ?, CURDATE(), ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssds", $user_nome, $hist_nome, $hist_valor, $tipo_compra);

    if ($stmt->execute()) {
        header("Location: visualizar_compras.php");
        exit;
    } else {
        echo "Erro ao adicionar compra: " . $stmt->error;
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Adicionar Compras</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/adicionar_compras.css">
</head>
<body>
    <header class="header">
        <div class="logo"><img src="image/logo.png" alt="Logo"></div>
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
        <h1>Bem-vindo, <?php echo htmlspecialchars($user_nome); ?>!</h1>
        <h2>Adicionar Compras</h2>
        <form action="" method="post">
            <label for="hist_nome">Nome da Compra:</label>
            <input type="text" id="hist_nome" name="hist_nome" required><br>

            <label for="hist_valor">Valor:</label>
            <input type="number" step="0.01" id="hist_valor" name="hist_valor" required><br>

            <label for="tipo_compra">Tipo de Compra:</label>
            <select id="tipo_compra" name="tipo_compra" required>
                <option value="1">Necessidade</option>
                <option value="2">Desejos Pessoais</option>
                <option value="3">Poupança</option>
                <option value="4">Dívidas</option>
            </select><br>

            <button type="submit">Adicionar Compra</button>
        </form>
    </div>
</body>
</html>
