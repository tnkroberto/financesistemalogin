<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icons/png/dollar-sign.png" type="image/png">
    <title>Visualizar Compras</title>
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/visualizar_compras.css">
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
        <h2>Histórico de Compras</h2>
        <table>
            <thead>
                <tr>
                    <th>Nome da Compra</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Tipo</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                session_start();
                if (!isset($_SESSION['user_nome'])) {
                    header("Location: login.php");
                    exit;
                }

                include 'config.php';
                $user_nome = $_SESSION['user_nome'];

                $query = "SELECT * FROM historico WHERE user_nome = '$user_nome'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $tipo_compra_class = "";
                    $tipo_compra_nome = "";
                    switch ($row['tipo_compra']) {
                        case 1:
                            $tipo_compra_class = "necessidade";
                            $tipo_compra_nome = "Necessidade";
                            break;
                        case 2:
                            $tipo_compra_class = "desejos";
                            $tipo_compra_nome = "Desejos Pessoais";
                            break;
                        case 3:
                            $tipo_compra_class = "poupanca";
                            $tipo_compra_nome = "Poupança";
                            break;
                        case 4:
                            $tipo_compra_class = "dividas";
                            $tipo_compra_nome = "Dívidas";
                            break;
                        default:
                            $tipo_compra_class = "";
                            $tipo_compra_nome = "Outro";
                            break;
                    }

                    echo "<tr class='$tipo_compra_class'>";
                    echo "<td>" . $row['hist_nome'] . "</td>";
                    echo "<td>R$ " . number_format($row['hist_valor'], 2, ',', '.') . "</td>";
                    echo "<td>" . date('d/m/Y', strtotime($row['hist_data'])) . "</td>";
                    echo "<td>" . $tipo_compra_nome . "</td>";
                    echo "<td><button class='delete-button' data-id='" . $row['hist_cod'] . "'>X</button></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const histCod = this.getAttribute('data-id');
                if (confirm("Tem certeza que deseja excluir esta compra?")) {
                    window.location.href = `delete_compra.php?hist_cod=${histCod}`;
                }
            });
        });
    });
    </script>
    <div class="saldo-container">

    <?php



    $user_nome = $_SESSION['user_nome'];

    // Obter o salário do usuário
    $querySalario = "SELECT sal_valor FROM salario WHERE user_nome = '$user_nome'";
    $resultSalario = mysqli_query($conn, $querySalario);
    $rowSalario = mysqli_fetch_assoc($resultSalario);
    $salario = $rowSalario['sal_valor'];

    // Calcular a soma de todas as compras no mês atual
    $mesAtual = date('m');
    $anoAtual = date('Y');
    $queryCompras = "SELECT SUM(hist_valor) AS total_compras FROM historico WHERE user_nome = '$user_nome' AND MONTH(hist_data) = $mesAtual AND YEAR(hist_data) = $anoAtual";
    $resultCompras = mysqli_query($conn, $queryCompras);
    $rowCompras = mysqli_fetch_assoc($resultCompras);
    $totalCompras = $rowCompras['total_compras'];

    // Calcular o saldo disponível
    $saldoDisponivel = $salario - $totalCompras;

    if ($saldoDisponivel > 0) {
        echo '<p id="saldo-disponivel">Sobrou R$ ' . number_format($saldoDisponivel, 2, ',', '.') . '. Deseja adicionar à poupança?</p>';
        echo '<button onclick="adicionarPoupanca()">Adicionar à Poupança</button>';
    } elseif ($saldoDisponivel == 0) {
        echo '<p>Você já atingiu o valor do salário. Considere guardar na poupança para os próximos meses.</p>';
    } else {
        echo '<p>Você ultrapassou o valor do salário em R$ ' . number_format(abs($saldoDisponivel), 2, ',', '.') . '.</p>';
    }
    ?>
    </div>

    <script>
    function adicionarPoupanca() {
    var saldoDisponivel = parseFloat(document.getElementById('saldo-disponivel').innerText.replace('Sobrou R$ ', '').replace('.', '').replace(',', '.'));

    if (confirm("Tem certeza que deseja adicionar o valor à poupança?")) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "adicionar_poupanca.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200 && xhr.responseText === "success") {
                    alert("Valor adicionado à poupança com sucesso!");
                    window.location.href = "visualizar_compras.php"; // Redirecionar para a página de visualização de compras
                } else {
                    alert("Erro ao adicionar valor à poupança.");
                }
            }
        };
        xhr.send("valor=" + saldoDisponivel);
    }
    }

    </script>
</body>
</html>