<?php
if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit();
}

include '../database/database.php';

$servicos= [];
$sql = "
    SELECT id, nome, valor, descricao FROM servico
";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $servicos[] = $row;
    }
}

$conn->close();