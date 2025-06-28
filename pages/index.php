<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include 'componentes/head.php'; ?>
</head>

<body>
    <?php include '../database/database.php' ?>
    <div class="content-wrapper">
        <div class="login-container text-center">
            <h2 class="mb-4">Acesso ao Sistema</h2>
            <form action="../database/login_process.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário" required>
                    <label for="usuario">Usuário</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>
                <button type="submit" class="btn btn-primary w-100" name="btn_login">Entrar</button>
            </form>
        </div>
    </div>

    <?php include 'componentes/footer.php'; ?>

</body>
</html>