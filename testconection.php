<?php
include 'config.php';

if ($conn) {
    echo "Conexão ao banco de dados foi bem-sucedida!";
} else {
    echo "Falha na conexão ao banco de dados.";
}
?>