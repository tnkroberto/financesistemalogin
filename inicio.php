<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';
$user_nome = $_SESSION['user_nome'];

// Obter informações do usuário
$query = "SELECT * FROM usuario WHERE nome = '$user_nome'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Verificar se a foto existe no banco de dados
$foto_perfil = $user['foto'] ?? ''; // Se não houver foto, vai ser uma string vazia

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
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/editar_usuarios.css">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
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

    <!-- Banner Simples -->
    <div class="banner">
        <img class="d-block w-100" src="image/banner2.png" alt="Banner">
    </div>

    <div class="container">
        <h2>Dados do Usuário</h2>

        <div class="user-data">
            <p><strong>Nome de Usuário:</strong> <?php echo $user['nome']; ?></p>
            <p><strong>Salário:</strong> R$ <?php echo number_format($salario['sal_valor'], 2, ',', '.'); ?></p>
            <p><strong>Profissão:</strong> <?php echo $user['profissao']; ?></p>
            <p><strong>Meta:</strong> <?php echo $user['meta']; ?></p>
        </div>

        <div class="user-photo">
            <h3>Foto de Perfil:</h3>
            <?php
            // Verifica se a foto existe e exibe
            if (!empty($foto_perfil)) {
                echo "<img src='" . $foto_perfil . "' alt='Foto de Perfil' width='100px'>";
            } else {
                echo "Sem foto de perfil.";
            }
            ?>
        </div>

        <div class="salary-change">
            <h3>Alterar Salário</h3>
            <form action="#" method="post">
                <label for="novo_salario">Novo Salário:</label>
                <input type="number" step="0.01" id="novo_salario" name="novo_salario" required><br>
                <button type="submit">Salvar</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
