<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

include '../database/database.php';

$vendas = [];
$sql = "
    SELECT 
        venda.id,
        venda.nome_cliente,
        servico.nome AS nome_servico,
        venda.valor
    FROM venda
    JOIN servico ON venda.servico_id = servico.id
    ORDER BY venda.id DESC
";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $vendas[] = $row;
    }
}

$conn->close();