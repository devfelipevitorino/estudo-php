<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}

include '../database.php';

$servicos = $conn->query("SELECT id, nome, valor FROM servico");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cliente = $_POST['nome_cliente'];
    $servico_id = $_POST['servico_id'];
    $valor = $_POST['valor'];

    $stmt = $conn->prepare("INSERT INTO venda (nome_cliente, servico_id, valor) VALUES (?, ?, ?)");
    $stmt->bind_param("sid", $nome_cliente, $servico_id, $valor);
    $stmt->execute();

    header("Location: ../../pages/dashboard.php");
    exit();
}

?>

<h2 class="form-title">Criar Venda</h2>

<form method="POST" class="edit-form">
    <label for="nome_cliente">Nome do Cliente:</label>
    <input type="text" id="nome_cliente" name="nome_cliente" required>

    <label>Serviço:</label>
    <select name="servico_id" id="servico_id" required>
        <option value="">Selecione um serviço</option>
        <?php while ($venda = $servicos->fetch_assoc()): ?>
            <option value="<?= $venda['id'] ?>" data-valor="<?= $venda['valor'] ?>">
                <?= $venda['nome'] ?> - R$ <?= number_format($venda['valor'], 2, ',', '.') ?>
            </option>
        <?php endwhile; ?>
    </select>


    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" required>

    <button type="submit">Salvar</button>
    <button type="button" onclick="history.back()" style="background: #c0392b;">Voltar</button>
</form>

<script>
document.getElementById("servico_id").addEventListener("change", function () {
    const valorCampo = document.getElementById("valor");
    const selectedOption = this.options[this.selectedIndex];
    const valor = selectedOption.getAttribute("data-valor");
    
    if (valor) {
        valorCampo.value = parseFloat(valor).toFixed(2);
    } else {
        valorCampo.value = "";
    }
});
</script>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f4f4f4;
        padding: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .form-title {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
    }

    .edit-form {
        background: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .edit-form label {
        font-weight: 600;
        color: #444;
    }

    .edit-form input {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
    }

    .edit-form select {
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ccc;
        font-size: 16px;
        background-color: #fff;
        color: #333;
        appearance: none;
    }

    .edit-form button {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .edit-form button:hover {
        background-color: #2980b9;
    }
</style>