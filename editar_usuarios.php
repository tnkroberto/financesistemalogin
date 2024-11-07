<?php
session_start();
if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

include 'config.php';
$user_nome = $_SESSION['user_nome'];

// Obter informações do usuário, incluindo profissão, meta e foto
$query = "SELECT * FROM usuario WHERE nome = '$user_nome'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Obter salário do usuário
$query = "SELECT * FROM salario WHERE user_nome = '$user_nome'";
$result = mysqli_query($conn, $query);
$salario = mysqli_fetch_assoc($result);

// Atualizar salário e outras informações
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novo_salario = $_POST['novo_salario'];
    $nova_profissao = $_POST['nova_profissao'];
    $nova_meta = $_POST['nova_meta'];
    
    // Processar foto (se for enviada)
    if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] == 0) {
        $extensao = pathinfo($_FILES['nova_foto']['name'], PATHINFO_EXTENSION);
        $foto_nome = 'uploads/' . uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['nova_foto']['tmp_name'], $foto_nome);
    } else {
        $foto_nome = $user['foto']; // Manter a foto atual caso não haja upload
    }

    // Atualizar dados no banco
    $query = "UPDATE salario SET sal_valor = '$novo_salario' WHERE user_nome = '$user_nome'";
    mysqli_query($conn, $query);

    $query = "UPDATE usuario SET profissao = '$nova_profissao', meta = '$nova_meta', foto = '$foto_nome' WHERE nome = '$user_nome'";
    if (mysqli_query($conn, $query)) {
        // Atualizar as variáveis
        $salario['sal_valor'] = $novo_salario;
        $user['profissao'] = $nova_profissao;
        $user['meta'] = $nova_meta;
        $user['foto'] = $foto_nome;
    } else {
        echo "Erro ao atualizar as informações: " . mysqli_error($conn);
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
        <p><strong>Nome de Usuário:</strong> <?php echo $user['nome']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Salário:</strong> R$ <?php echo $salario['sal_valor']; ?></p>
        <p><strong>Profissão:</strong> <?php echo $user['profissao']; ?></p>
        <p><strong>Meta:</strong> <?php echo $user['meta']; ?></p>
        
        <!-- Exibir Foto Atual -->
        <p><strong>Foto de Perfil:</strong></p>
        <?php if ($user['foto']): ?>
            <img src="<?php echo $user['foto']; ?>" alt="Foto de Perfil" width="100px">
        <?php else: ?>
            <p>Sem foto de perfil.</p>
        <?php endif; ?>

        <form action="#" method="post" enctype="multipart/form-data">
            <label for="novo_salario">Novo Salário:</label>
            <input type="number" step="0.01" id="novo_salario" name="novo_salario" required><br>

            <label for="nova_profissao">Profissão:</label>
            <input type="text" id="nova_profissao" name="nova_profissao" value="<?php echo $user['profissao']; ?>"><br>

            <label for="nova_meta">Meta:</label>
            <textarea id="nova_meta" name="nova_meta"><?php echo $user['meta']; ?></textarea><br>

            <label for="nova_foto">Nova Foto de Perfil:</label>
            <input type="file" name="nova_foto" id="nova_foto"><br><br>

            <button type="submit">Salvar</button>
        </form>
    </div>
</body>
</html>
