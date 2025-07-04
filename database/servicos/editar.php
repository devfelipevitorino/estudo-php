<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../../index.php");
    exit();
}

include '../database.php';


$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID inválido!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome_cliente = $_POST['nome_cliente'];
    $valor = $_POST['valor'];

    $stmt = $conn->prepare("UPDATE venda SET nome_cliente = ?, valor = ? WHERE id = ?");
    $stmt->bind_param("sdi", $nome_cliente, $valor, $id);
    $stmt->execute();

    header("Location: ../../pages/dashboard.php");
    exit();
}


$stmt = $conn->prepare("
    SELECT v.*, s.nome AS nome_servico 
    FROM venda v
    JOIN servico s ON v.servico_id = s.id
    WHERE v.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$venda = $result->fetch_assoc();

if (!$venda) {
    echo "Venda não encontrada.";
    exit();
}

?>

<h2 class="form-title">Editar Venda</h2>

<form method="POST" class="edit-form">
    <label for="nome_cliente">Nome do Cliente:</label>
    <input type="text" id="nome_cliente" name="nome_cliente" value="<?php echo htmlspecialchars($venda['nome_cliente']); ?>" required>

    <label for="nome_servico">Serviço Feito:</label>
    <input type="text" id="nome_servico" name="nome_servico"
        value="<?php echo htmlspecialchars($venda['nome_servico']); ?>"
        readonly>

    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" value="<?php echo $venda['valor']; ?>" required>

    <button type="button" type="submit">Salvar</button>
    <button onclick="history.back()" style="background: #c0392b;">Voltar</button>
</form>

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