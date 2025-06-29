<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include 'componentes/head.php'; ?>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include '../database/database.php' ?>
    <div>
        <div>
            <h2>Acesso ao Sistema</h2>
            <form action="../database/login_process.php" method="POST">
                <div>
                    <input type="text" id="usuario" name="usuario" placeholder="Usuário" required>
                    <label for="usuario">Usuário</label>
                </div>
                <div>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>
                <button type="submit" name="btn_login">Entrar</button>
            </form>
        </div>
    </div>

    <?php include 'componentes/footer.php'; ?>

</body>
</html>