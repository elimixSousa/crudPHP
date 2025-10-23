<?php
//inclui o arquivo de conexão com o banco de dados
require_once 'connection.php'; 

try{
    // prepara e executa a consulta para buscar as tarefas
    $stmt = $pdo-> query("SELECT id, title, description, date_creation FROM tasks ORDER BY date_creation DESC");

    // busca todas as tarefas como um array associativo
    //fetchAll() é um método do objeto de declaração que busca todos os registros retornados pela consulta
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC); //


} catch(PDOException $e){
    // caso a consulta falhe, é exibida a mensagem de erro e encerra o programa
    die("Erro ao consultar as tarefas:" .$e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Tarefas</title>
    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Gerenciador de Tarefas</h1>
            <a href="create.php" class="btn">Adicionar Nova Tarefa</a>

            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Data de Criação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- estrutura de controle if/else que verifica se há alguma
                     tarefa para exibir -->
                    <?php if(count($tasks) > 0): ?> 
                        <?php foreach ($tasks as $task): ?>
                        <tr>
                            <td><?= htmlspecialchars($task['title']) ?></td>
                            <td><?= htmlspecialchars($task['description']) ?></td>
                            <!-- agora formato a data que vem do Banco de Dados
                             para um formato mais amigável -->
                            <td><?= date('d/m/Y - H:i:s', strtotime($task['date_creation'])) ?></td>
                            <td class="actions">
                                <!-- crio os links para a página de edição e exclusão -->
                                <a href="edit.php?id=<?= $task['id'] ?>" class="btn-edit">Editar</a>
                                <a href="delete.php?id=<?= $task['id'] ?>" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?');">Excluir</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">Nenhuma tarefa encontrada.</td>
                                </tr>
                            <?php endif; ?>
                </tbody>
            </table>
        </div>
    </body>
    </html>

