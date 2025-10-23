<?php
// conecta ao banco de dados mais uma vez
require_once 'connection.php';

// pega o ID da tarefa da URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

// verifica se o ID é true ou seja, válido
if($id){   
    try{
        // prepara a instrução SQL para deletar
        // a parte "WHERE id = :id" é necessária para não exluir todas as tarefas
        // do Banco de Dados
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        
        // associa (bind) o valor do ID ao parâmetro da consulta (:id)
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        // executa a consulta para apagar a linha correspondente no banco de dados
        $stmt->execute();

        // redireciona o usuário para a página index.php após a exclusão
        header("Location: index.php");
        exit();
    } catch(PDOException $e){
        // caso ocorra um erro durante a exclusão, exibe a mensagem
        die("Erro ao excluir a tarefa: " . $e->getMessage());
    }
    
    } else{
        // se o ID fornecido na URL for inválido, redireciona para a página index.php
        header("Location: index.php");
        exit();
    }
?>