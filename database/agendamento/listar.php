<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

include '../database/database.php';

$agendamentos= [];
$sql = "
    SELECT 
        agendamento.id,
        agendamento.nome_cliente,
        servico.nome AS nome_servico,
        agendamento.valor,
        agendamento.data_agendamento
    FROM agendamento
    JOIN servico ON agendamento.servico_id = servico.id
    ORDER BY agendamento.id DESC
";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $agendamentos[] = $row;
    }
}

$conn->close();