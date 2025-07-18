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
    <?php include '../database/agendamento/listar.php'; ?>
    <div class="pagina-dashboard">
        <header class="dashboard-header">
            <h1 class="titulo-bemvindo">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
            <a class="btn-sair" href="../database/logout.php">Sair</a>
        </header>
        
        <main class="dashboard-container">
            <section class="dashboard-box">
                <h2 class="titulo-h2">Agendamentos</h2>
                <table class="tabela-servicos">
                    <thead>
                        <tr>
                            <th>Registro</th>
                            <th>Nome do Cliente</th>
                            <th>Serviço Feito</th>
                            <th>Valor</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($agendamentos as $agendamento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($agendamento['id']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['nome_cliente']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['nome_servico']); ?></td>
                                <td>R$ <?php echo number_format($agendamento['valor'], 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['data_agendamento']); ?></td>
                                <td>
                                    <a href="../database/agendamento/editar.php?id=<?php echo $agendamento['id']; ?>" class="btn-editar">Editar</a>
                                </td>
                                <td>
                                    <a href="../database/agendamento/remover.php?id=<?php echo $agendamento['id']; ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este registro?');">Remover</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($agendamentos)): ?>
                                <tr>
                                <td colspan="4" style="text-align: center;">Nenhum agendamento registrado.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>    
                    <a href="../database/agendamento/criar.php" class="btn-criar">Adicionar agendamento</a>
                </section>
        </div>
        <footer class="footer">
            <?php include 'componentes/footer.php'; ?>
        </footer>
</body>

</html>