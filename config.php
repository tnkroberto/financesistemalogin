<?php
$servername = "localhost";
$username = "tnkrob";
$password = "Gtagod096@";
$dbname = "finance";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Checa a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
?>