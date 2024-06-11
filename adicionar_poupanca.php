<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_nome'])) {
    header("Location: login.php");
    exit;
}

$user_nome = $_SESSION['user_nome'];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['valor'])) {
    $valor_poupanca = $_POST['valor'];

    // Insira o valor na tabela historico como uma compra do tipo poupanca
    $query = "INSERT INTO historico (user_nome, hist_nome, hist_valor, hist_data, tipo_compra) VALUES ('$user_nome', 'Poupança', $valor_poupanca, NOW(), 3)"; // Tipo 3 representa poupanca
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>