<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include 'componentes/head.php'; ?>
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
    <?php include 'componentes/footer.php'; ?>
</body>
</html>
