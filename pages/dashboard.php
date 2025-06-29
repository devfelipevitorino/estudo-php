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
    <?php include '../database/listar_servicos_process.php'; ?>
    <div class="pagina-dashboard">
        <header class="dashboard-header">
            <h1 class="titulo-bemvindo">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
            <a class="btn-sair" href="../database/logout.php">Sair</a>
        </header>

        <main class="dashboard-container">
            <section class="dashboard-box">
                <h2 class="titulo-h2">Serviços Realizados</h2>
                <table class="tabela-servicos">
                    <thead>
                        <tr>
                            <th>Registro</th>
                            <th>Nome do Cliente</th>
                            <th>Serviço Feito</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $venda): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($venda['id']); ?></td>
                                <td><?php echo htmlspecialchars($venda['nome_cliente']); ?></td>
                                <td><?php echo htmlspecialchars($venda['nome_servico']); ?></td>
                                <td>R$ <?php echo number_format($venda['valor'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($vendas)): ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">Nenhum serviço registrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer class="footer">
            <?php include 'componentes/footer.php'; ?>
        </footer>
    </div>
</body>

</html>