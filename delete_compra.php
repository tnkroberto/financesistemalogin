<?php
include 'config.php';

if (isset($_GET['hist_cod'])) {
    $hist_cod = $_GET['hist_cod'];
    $query = "DELETE FROM historico WHERE hist_cod = $hist_cod";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Exclusão bem-sucedida, redirecionar para a página de visualização de compras
        header("Location: visualizar_compras.php");
        exit;
    } else {
        // Se houver algum erro, você pode lidar com ele aqui
        echo "Erro ao excluir a compra.";
    }
} else {
    // Se o parâmetro hist_cod não estiver presente na URL, redirecione para a página de visualização de compras
    header("Location: visualizar_compras.php");
    exit;
}
?>