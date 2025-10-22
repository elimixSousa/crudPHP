<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // inclui o arquivo de conexão com o banco de dados e pra que seja possível usar a variável $pdo
    require_once 'connection.php';

    try{
        // pega os dados enviados pelo formulário
        /*  'title' e 'description' correspondem aos atributos 'name'
        dos campos do formulário
        */
        $title = $_POST['title'];
        $description = $_POST['description'];

        // prepara a instrução SQL para inserir os dados
        $sql = "INSERT INTO tasks (title, description) VALUES (:title, :description)"; //(:title, :description) = "prepared statements" para evitar SQL Injection
        $stmt = $pdo->prepare($sql);

        // associa (bind) os valores das variáveis aos parâmetros da consulta
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);

        // executa a instrução no banco de dados
        $stmt->execute();

        // redireciona o usuário de volta para o index.php
        header("Location: index.php");
        exit();
    } catch(PDOException $e){
        // caso ocorra um erro durante a inserção, ele é capturado
        die("Erro ao criar a tarefa: " . $e->getMessage());
    }
}
?>

<!-- Criação do formulário -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content= "width=device-width, initial-scale=1.0">
        <title>Criar tarefa</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>

        <div class="container">
            <h1>Adicionar Nova Tarefa</h1>

            <form action="create.php" method="post">
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição</label>
                    <textarea type="text" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn">Salvar</button>
                    <a href="index.php" class="btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </body>
</html>