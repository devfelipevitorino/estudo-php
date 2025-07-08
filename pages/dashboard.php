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
    <?php include '../database/venda/listar.php'; ?>
    <div class="pagina-dashboard">
        <header class="dashboard-header">
            <h1 class="titulo-bemvindo">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h1>
            <a class="btn-sair" href="../database/logout.php">Sair</a>
        </header>
        
        <main class="dashboard-container">
            <section class="dashboard-box">
                <h2 class="titulo-h2">Vendas Finalizados</h2>
                <table class="tabela-servicos">
                    <thead>
                        <tr>
                            <th>Registro</th>
                            <th>Nome do Cliente</th>
                            <th>Serviço Feito</th>
                            <th>Valor</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendas as $venda): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($venda['id']); ?></td>
                                <td><?php echo htmlspecialchars($venda['nome_cliente']); ?></td>
                                <td><?php echo htmlspecialchars($venda['nome_servico']); ?></td>
                                <td>R$ <?php echo number_format($venda['valor'], 2, ',', '.'); ?></td>
                                <td class="acoes">
                                    <a href="../database/venda/editar.php?id=<?php echo $venda['id']; ?>" class="btn-editar">Editar</a>
                                    <a href="../database/venda/remover.php?id=<?php echo $venda['id']; ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este registro?');">Remover</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($vendas)): ?>
                                <tr>
                                <td colspan="4" style="text-align: center;">Nenhum serviço registrado.</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>    
                    <a href="../database/venda/criar.php" class="btn-criar">Adicionar Venda</a>
                </section>
                
                
                <section class="dashboard-box">
                <?php include '../database/servico/listar.php'; ?>
                <h2 class="titulo-h2">Serviços Cadastrados</h2>
                <table class="tabela-servicos">
                    <thead>
                        <tr>
                            <th>Registro</th>
                            <th>Nome do Serviço</th>
                            <th>Valor</th>
                            <th>Descrição</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($servicos as $servico): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($servico['id']); ?></td>
                                <td><?php echo htmlspecialchars($servico['nome']); ?></td>
                                <td>R$ <?php echo number_format($servico['valor'], 2, ',', '.'); ?></td>
                                <td><?php echo htmlspecialchars($servico['descricao']); ?></td>
                                <td class="acoes">
                                    <a href="../database/servico/editar.php?id=<?php echo $servico['id']; ?>" class="btn-editar">Editar</a>
                                    <a href="../database/servico/remover.php?id=<?php echo $servico['id']; ?>" class="btn-remover" onclick="return confirm('Tem certeza que deseja remover este registro?');">Remover</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($servicos)): ?>
                            <tr>
                                <td colspan="4" style="text-align: center;">Nenhum serviço registrado.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>    
                <a href="../database/servico/criar.php" class="btn-criar">Adicionar Serviço</a>
            </section>
        </main>

        <footer class="footer">
            <?php include 'componentes/footer.php'; ?>
        </footer>
    </div>
</body>

</html>