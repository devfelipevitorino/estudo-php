<?php

$serverName = 'localhost';
$usuario = 'root';
$senha = '';
$db_nome = 'db_corte_facil';

$conn = new mysqli($serverName, $usuario, $senha, $db_nome);

if ($conn->connect_error) {
    die('Falha na conexão com o banco: ' . $conn->connect_error);
}
