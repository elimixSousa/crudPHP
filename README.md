# Gerenciador de Tarefas Simples (CRUD)

Este projeto envolve o desenvolvimento de um Gerenciador de Tarefas básico, implementando as operações CRUD (Create, Read, Update, Delete) utilizando PHP e MySQL.

## Funcionalidades

- **Listar Tarefas (Read):** Exibe todas as tarefas existentes em uma tabela, mostrando título, descrição e data de criação.
- **Adicionar Nova Tarefa (Create):** Permite criar novas tarefas com um título e uma descrição.
- **Editar Tarefa (Update):** Permite alterar o título e a descrição de uma tarefa existente.
- **Excluir Tarefa (Delete):** Remove uma tarefa específica do banco de dados.

## Tecnologias Utilizadas

- **Backend:** PHP 8.x
- **Banco de Dados:** MySQL
- **Frontend:** HTML5, CSS3
- **Conexão com DB:** PDO (PHP Data Objects)
- **Servidor Web:** Apache (via XAMPP)

## Pré-requisitos

Para rodar este projeto localmente, é necessário ter um ambiente de desenvolvimento PHP/MySQL configurado. Recomendo o uso do **XAMPP**.

- **XAMPP** (ou similar) instalado e configurado.
- Um navegador web.

## Configuração e Instalação

Siga os passos abaixo para configurar e executar o projeto em sua máquina local:

1.  **Clone o Repositório (ou baixe os arquivos):**
    Se você estiver usando Git, clone este repositório para a pasta `htdocs` do seu XAMPP:

    ```bash
    cd c:\xampp\htdocs
    git clone [URL_DO_SEU_REPOSITORIO_GITHUB] crudTarefas
    ```

    Ou, se baixou os arquivos, descompacte-os na pasta `c:\xampp\htdocs\crudTarefas`.

2.  **Inicie o XAMPP:**
    Abra o painel de controle do XAMPP e inicie os módulos **Apache** e **MySQL**.

3.  **Crie o Banco de Dados:**
    Acesse o phpMyAdmin (geralmente em `http://localhost/phpmyadmin/`) no seu navegador.

    - Crie um novo banco de dados chamado `task_manager`.

4.  **Crie a Tabela `tasks`:**
    Dentro do banco de dados `task_manager`, execute a seguinte query SQL para criar a tabela `tasks`:

    ```sql
    CREATE TABLE tasks (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

5.  **Acesse a Aplicação:**
    Abra seu navegador e acesse:
    ```
    http://localhost/crudTarefas/
    ```

## Como Usar

- **Página Inicial (`index.php`):** Exibe todas as tarefas. Você pode clicar em "Editar" para modificar uma tarefa ou "Excluir" para removê-la.
- **Adicionar Nova Tarefa (`create.php`):** Clique no botão "Adicionar Nova Tarefa" na página inicial para acessar o formulário de criação.
- **Editar Tarefa (`edit.php`):** Clique no botão "Editar" ao lado de uma tarefa para abrir o formulário pré-preenchido e fazer suas alterações.
- **Excluir Tarefa (`delete.php`):** Clique no botão "Excluir" ao lado de uma tarefa. Uma confirmação será solicitada antes da exclusão.

## Estrutura do Projeto

- `connection.php`: Responsável por estabelecer a conexão com o banco de dados MySQL.
- `index.php`: Página principal que lista todas as tarefas e contém os links para as operações de CRUD.
- `create.php`: Contém o formulário para adicionar novas tarefas e a lógica para inseri-las no banco de dados.
- `edit.php`: Contém o formulário para editar tarefas existentes e a lógica para atualizá-las no banco de dados.
- `delete.php`: Script que processa a exclusão de uma tarefa com base no ID fornecido.
- `style.css`: Arquivo de estilos CSS para a interface da aplicação.

## Licença

Free!
