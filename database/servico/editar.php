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
    $nome_servico = $_POST['nome_servico'];
    $valor = $_POST['valor'];
    $descricao = $_POST['descricao'] ?? null; 

    $stmt = $conn->prepare("UPDATE servico SET nome = ?, valor = ?, descricao = ? WHERE id = ?");
    $stmt->bind_param("sdsi", $nome_servico, $valor, $descricao, $id);
    $stmt->execute();

    header("Location: ../../pages/dashboard.php");
    exit();
}

$stmt = $conn->prepare("SELECT nome, valor, descricao FROM servico WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$servico = $result->fetch_assoc();

if (!$servico) {
    echo "Serviço não encontrado.";
    exit();
}
?>

<h2 class="form-title">Editar Serviço</h2>

<form method="POST" class="edit-form">
    <label for="nome_servico">Nome do Serviço:</label>
    <input type="text" id="nome_servico" name="nome_servico" value="<?php echo htmlspecialchars($servico['nome']); ?>" required>

    <label for="valor">Valor:</label>
    <input type="number" id="valor" name="valor" step="0.01" value="<?php echo htmlspecialchars($servico['valor']); ?>" required>

    <label for="descricao">Descrição:</label>
    <textarea id="descricao" name="descricao"><?php echo htmlspecialchars($servico['descricao']); ?></textarea>

    <button type="submit">Salvar</button>
    <button type="button" onclick="history.back()" style="background: #c0392b;">Voltar</button>
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