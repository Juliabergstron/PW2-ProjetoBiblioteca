# 📚 Biblioteca Virtual — Sistema CRUD

Projeto acadêmico de uma biblioteca virtual desenvolvido com **PHP + MySQL + Bootstrap + JavaScript**.

O visual foi criado com uma estética editorial de biblioteca: fundo creme, verde-petróleo, terracota, tipografia serifada para títulos e uma ilustração de estante de livros feita em CSS.

## Funcionalidades

### 🔐 Autenticação
- Login
- Cadastro de usuário
- Logout
- Sessão PHP
- Senhas armazenadas com `password_hash`
- Proteção das páginas internas

### 📚 Biblioteca
- Cadastro de livros
- Listagem
- Pesquisa por título/autor
- Filtro por status
- Filtro por gênero
- Edição
- Exclusão com confirmação JavaScript
- Dashboard com indicadores

### Campos do livro
- Título
- Autor
- Ano
- Gênero
- Status de leitura
- Emprestado para quem

## CRUD

**Create:** `livros/cadastrar.php`  
**Read:** `livros/listar.php`  
**Update:** `livros/editar.php`  
**Delete:** `livros/excluir.php`

## Tecnologias

- PHP 8+
- MySQL
- PDO
- HTML5
- CSS3
- Bootstrap 5.3
- JavaScript
- Google Fonts

## Como executar com XAMPP

1. Instale o XAMPP.
2. Inicie **Apache** e **MySQL**.
3. Extraia a pasta `biblioteca-virtual-premium` para:
   `C:\xampp\htdocs\`
4. Abra:
   `http://localhost/phpmyadmin`
5. Importe o arquivo `banco.sql`.
6. Abra:
   `http://localhost/biblioteca-virtual-premium/`

Se seu MySQL tiver senha, altere `$pass` em `config/conexao.php`.

## Login de demonstração

**E-mail:** admin@biblioteca.com  
**Senha:** 123456

Também é possível criar uma conta pela tela de cadastro.

## Estrutura

```text
biblioteca-virtual-premium/
├── index.php
├── login.php
├── cadastro.php
├── logout.php
├── dashboard.php
├── banco.sql
├── README.md
├── config/
│   ├── conexao.php
│   └── auth.php
├── includes/
│   ├── app-header.php
│   └── app-footer.php
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

## Roteiro do vídeo

1. Abrir a tela de login.
2. Mostrar o login de demonstração.
3. Entrar no dashboard.
4. Mostrar os indicadores.
5. Ir para "Meu acervo".
6. Cadastrar um livro (**CREATE**).
7. Mostrar o registro na lista (**READ**).
8. Pesquisar e filtrar.
9. Editar o livro (**UPDATE**).
10. Excluir o livro e confirmar (**DELETE**).
11. Mostrar que o registro foi removido.
12. Finalizar mostrando a navegação e as tecnologias utilizadas.

## Observação

O banco contém dados de exemplo para facilitar os testes. Antes de uma apresentação final, você pode trocar os livros de exemplo pelos seus próprios registros.
