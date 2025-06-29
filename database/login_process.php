<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

include 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_form = $_POST['usuario'] ?? '';
    $senha_form = $_POST['senha'] ?? '';

    $stmt = $conn->prepare("SELECT id, senha FROM usuario WHERE usuario = ?");
    $stmt->bind_param("s", $usuario_form);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if ($senha_form === $row['senha']) {
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nome'] = $usuario_form;

            echo 'ok';
        } else {
            echo 'Senha incorreta.';
        }
    } else {
        echo 'Usuário não encontrado.';
    }

    $stmt->close();
    $conn->close();
} else {
    echo 'Requisição inválida.';
}
