<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include 'componentes/head.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <?php include '../database/database.php' ?>

    <div class="login-container">
        <div class="form-box">
            <h2 class="titulo-h2">Acesso ao Sistema</h2>
            <form action="../database/login_process.php" method="POST">
                <div class="form-input">
                    <input type="text" id="usuario" name="usuario" required>
                    <label for="usuario">Usuário</label>
                </div>
                <div class="form-input">
                    <input type="password" id="senha" name="senha" required>
                    <label for="senha">Senha</label>
                </div>
                <button class="btn_login" type="submit" name="btn_login">Entrar</button>
            </form>
        </div>
        <footer class="footer">
            <?php include 'componentes/footer.php'; ?>
        </footer>
    </div>
</body>
</html>
