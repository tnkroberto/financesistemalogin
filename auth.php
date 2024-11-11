<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados para obter o usuário
    $query = $conn->prepare("SELECT id, nome, senha, role FROM usuario WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verificar se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            // Autenticação bem-sucedida, criar a sessão do usuário
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_role'] = $user['role'];

            // Redirecionar o usuário com base no papel
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit;
        } else {
            echo "<script>alert('Erro: Senha incorreta.'); window.location.href = 'login.php';</script>";
        }
    } else {
        echo "<script>alert('Erro: Usuário não encontrado.'); window.location.href = 'login.php';</script>";
    }

    $query->close();
}
$conn->close();
?>
