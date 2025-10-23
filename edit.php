<?php
// inclui o arquivo de conexão com o banco de dados
require_once 'connection.php';

// Inicializa as variáveis para evitar erros
$task = null;
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// 1. Lógica para processar a atualização (quando o formulário é enviado via POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pega os dados do formulário
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $title = trim($_POST['title']); // trim() remove espaços em branco no início e no fim
    $description = trim($_POST['description']);

    // Validação simples: verifica se o ID e o título não estão vazios
    if ($id && !empty($title)) {
        try {
            // Prepara a instrução SQL para atualizar a tarefa
            $sql = "UPDATE tasks SET title = :title, description = :description WHERE id = :id";
            $stmt = $pdo->prepare($sql);

            // Associa (bind) os valores aos parâmetros
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Executa a instrução
            $stmt->execute();

            // Redireciona o usuário de volta para a página inicial
            header("Location: index.php");
            exit();
        } catch (PDOException $e) {
            // Em caso de erro, exibe a mensagem
            die("Erro ao atualizar a tarefa: " . $e->getMessage());
        }
    } else {
        // Se o título estiver vazio, podemos redirecionar com uma mensagem de erro (opcional)
        // Por simplicidade, aqui apenas interrompemos
        die("O título é obrigatório.");
    }
}

// 2. Lógica para buscar a tarefa e exibir no formulário (quando a página é carregada via GET)
if ($id) {
    try {
        $stmt = $pdo->prepare("SELECT id, title, description FROM tasks WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        // Se nenhuma tarefa for encontrada com o ID, redireciona para o início
        if (!$task) {
            header("Location: index.php");
            exit();
        }
    } catch (PDOException $e) {
        die("Erro ao buscar a tarefa: " . $e->getMessage());
    }
} else {
    // Se nenhum ID for fornecido na URL, redireciona para o início
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>

        <form action="edit.php" method="post">
            <!-- Campo oculto para enviar o ID da tarefa junto com o formulário -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">

            <div class="form-group">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea id="description" name="description"><?= htmlspecialchars($task['description']) ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn">Salvar Alterações</button>
                <a href="index.php" class="btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>
