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
    <link rel="stylesheet" href="../css/dashboard.css">
</head>
<body>
    <div>
        <header>
            <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
            <a href="../database/logout.php">Sair</a>
        </header>

        <main>

        </main>

        <footer>
            <?php include 'componentes/footer.php'; ?>
        </footer>
    </div>
</body>

</html>