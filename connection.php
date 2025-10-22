<?php
$host = 'localhost'; //variável que armazena o endereço do servidor MySQL
$dbname = 'task_manager'; //variável que armazena o nome do banco de dados
$user = 'root'; //variável que armazena o usuário padrão do XAMPP
$password = ''; //variável que armazena a senha padrão do XAMPP

try{
    // cria uma conexão com o banco de dados usando PDO (PHP Data Objects)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);

    // configura o PDO para lançar exceções em caso de erros
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    // caso a conexão falhe, é exibida a mensagem de erro e encerra o programa
    die("Erro ao conectar ao banco de dados:" .$e->getMessage());
}
?>