<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
ob_start(); 
session_start();

include 'database.php';

if (isset($_POST['btn_login'])) {
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

            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            echo "Usuário ou senha inválidos.";
        }
    } else {
        echo "Usuário ou senha inválidos.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Formulário não enviado corretamente.";
}
