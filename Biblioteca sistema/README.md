# 📚 Biblioteca Virtual

Sistema web para gerenciamento de livros desenvolvido como projeto acadêmico utilizando **PHP, MySQL, Bootstrap e JavaScript**.

## 🎯 Objetivo

Permitir o cadastro e gerenciamento de livros de uma biblioteca virtual, registrando:

- Título
- Autor
- Ano
- Gênero
- Status de leitura
- Pessoa para quem o livro foi emprestado

O projeto implementa as quatro operações do CRUD:

- **Create** — cadastrar livros
- **Read** — visualizar e pesquisar livros
- **Update** — editar livros
- **Delete** — excluir livros

## 🛠️ Tecnologias

- PHP 8+
- MySQL
- HTML5
- CSS3
- Bootstrap 5.3
- JavaScript
- PDO para conexão com MySQL

## 📁 Estrutura

```text
biblioteca-virtual/
├── index.php
├── banco.sql
├── config/
│   └── conexao.php
├── includes/
│   ├── header.php
│   └── footer.php
├── livros/
│   ├── listar.php
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
└── assets/
    ├── css/
    │   └── style.css
    └── js/
        └── script.js
```

## 💻 Como executar localmente

### 1. Instalar o ambiente

Instale o XAMPP e inicie:

- Apache
- MySQL

### 2. Copiar o projeto

Coloque a pasta `biblioteca-virtual` dentro de:

```text
C:\xampp\htdocs\
```

### 3. Criar o banco

Abra o **phpMyAdmin** em:

```text
http://localhost/phpmyadmin
```

Crie/importa o arquivo:

```text
banco.sql
```

O script cria automaticamente o banco `biblioteca_virtual`, a tabela `livros` e alguns registros de teste.

### 4. Conferir a conexão

O arquivo:

```text
config/conexao.php
```

usa por padrão:

```text
Host: localhost
Banco: biblioteca_virtual
Usuário: root
Senha: vazia
```

Se sua instalação do MySQL tiver outra senha, altere a variável `$pass`.

### 5. Abrir o sistema

No navegador:

```text
http://localhost/biblioteca-virtual/
```

## 🔄 Demonstração do CRUD

### CREATE
1. Clique em **Cadastrar**.
2. Preencha os dados.
3. Clique em **Salvar livro**.
4. O livro aparecerá na lista.

### READ
1. Acesse **Livros**.
2. Consulte os registros cadastrados.
3. Utilize a busca ou os filtros de status e gênero.

### UPDATE
1. Escolha um livro.
2. Clique em **Editar**.
3. Altere uma informação.
4. Clique em **Salvar alterações**.

### DELETE
1. Escolha um livro.
2. Clique em **Excluir**.
3. Confirme a exclusão na janela do JavaScript.
4. O registro será removido do banco.

## 🗃️ Banco de dados

A tabela principal é `livros`:

| Campo | Tipo | Descrição |
|---|---|---|
| id | INT | Identificador único |
| titulo | VARCHAR(150) | Título do livro |
| autor | VARCHAR(100) | Autor |
| ano | INT | Ano de publicação |
| genero | VARCHAR(50) | Gênero literário |
| status_leitura | ENUM | Não lido, Lendo ou Lido |
| emprestado_para | VARCHAR(100) | Pessoa que recebeu o empréstimo |

## 🔐 Boas práticas utilizadas

- Consultas preparadas com PDO
- Validação dos dados no servidor
- `htmlspecialchars()` para exibição de dados
- Confirmação JavaScript antes da exclusão
- Separação entre configuração, páginas, estilos e scripts

## 🎥 Roteiro sugerido para o vídeo

1. Apresentar rapidamente a página inicial.
2. Mostrar os indicadores da biblioteca.
3. Entrar em **Livros**.
4. Cadastrar um novo livro — **CREATE**.
5. Mostrar o livro cadastrado — **READ**.
6. Utilizar a busca/filtros.
7. Editar o livro — **UPDATE**.
8. Excluir o livro — **DELETE**.
9. Mostrar novamente a lista e confirmar que o registro foi removido.
10. Encerrar mostrando que o sistema possui as quatro operações CRUD.

## 👩‍💻 Projeto acadêmico

**Projeto:** Biblioteca Virtual  
**Tecnologias:** PHP + Bootstrap + JavaScript + MySQL  
**Finalidade:** Sistema CRUD para gerenciamento de livros.
