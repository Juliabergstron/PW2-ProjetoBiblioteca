# PW2-ProjetoBiblioteca
# 📚 Biblioteca Virtual

Sistema web desenvolvido para o gerenciamento de livros de uma biblioteca virtual. O projeto permite cadastrar, visualizar, editar e excluir livros, além de acompanhar o status de leitura e informar quando um livro está emprestado.

O sistema foi desenvolvido utilizando **PHP, MySQL, Bootstrap e JavaScript**, aplicando as operações de **CRUD (Create, Read, Update e Delete)**.

---

## 🎯 Objetivo do Projeto

O objetivo da Biblioteca Virtual é facilitar o gerenciamento de livros de forma simples e organizada.

O sistema permite que o usuário:

* Cadastre novos livros;
* Visualize os livros cadastrados;
* Pesquise livros;
* Filtre livros por gênero e status de leitura;
* Edite informações dos livros;
* Exclua livros cadastrados;
* Informe para quem determinado livro foi emprestado;
* Visualize informações gerais da biblioteca através de um painel inicial.

---

## ⚙️ Funcionalidades

### 📖 Cadastro de livros

É possível cadastrar um livro informando:

* Título;
* Autor;
* Ano de publicação;
* Gênero;
* Status de leitura;
* Pessoa para quem o livro foi emprestado.

### 🔎 Consulta de livros

O sistema apresenta uma lista com todos os livros cadastrados.

Também é possível realizar pesquisas e utilizar filtros para facilitar a localização dos livros.

### ✏️ Edição

O usuário pode alterar as informações de um livro já cadastrado.

### 🗑️ Exclusão

É possível excluir livros do sistema.

Antes da exclusão, o sistema solicita uma confirmação para evitar que um livro seja apagado acidentalmente.

### 📊 Dashboard

A página inicial apresenta informações resumidas da biblioteca, como:

* Quantidade total de livros;
* Quantidade de livros lidos;
* Quantidade de livros em leitura;
* Quantidade de livros não lidos;
* Quantidade de livros emprestados.

---

## 🔄 Operações CRUD

O projeto utiliza as quatro operações básicas de um sistema de gerenciamento de dados:

| Operação   | Função    | No projeto                     |
| ---------- | --------- | ------------------------------ |
| **Create** | Criar     | Cadastro de novos livros       |
| **Read**   | Ler       | Listagem e consulta dos livros |
| **Update** | Atualizar | Edição dos livros              |
| **Delete** | Excluir   | Exclusão dos livros            |

### CREATE

Permite inserir novos livros no banco de dados.

### READ

Permite consultar e visualizar os livros cadastrados.

### UPDATE

Permite modificar os dados de um livro existente.

### DELETE

Permite remover um livro do banco de dados.

---

## 🛠️ Tecnologias utilizadas

### PHP

Utilizado para desenvolver a lógica do sistema, realizar as operações CRUD e fazer a comunicação com o banco de dados.

### MySQL

Utilizado para armazenar os dados dos livros.

### Bootstrap

Utilizado para construir a interface do sistema e facilitar a criação de um layout organizado e responsivo.

### JavaScript

Utilizado para interações do sistema, como confirmações antes da exclusão e comportamentos da interface.

### HTML e CSS

Utilizados na estrutura e personalização das páginas.

---

## 🗄️ Banco de Dados

O projeto utiliza um banco de dados chamado:

```sql
biblioteca_virtual
```

A principal tabela do sistema é:

```sql
livros
```

### Estrutura da tabela

| Campo             | Tipo         | Descrição                              |
| ----------------- | ------------ | -------------------------------------- |
| `id`              | INT          | Identificador único do livro           |
| `titulo`          | VARCHAR(150) | Título do livro                        |
| `autor`           | VARCHAR(100) | Autor do livro                         |
| `ano`             | INT          | Ano de publicação                      |
| `genero`          | VARCHAR(50)  | Gênero literário                       |
| `status_leitura`  | ENUM         | Status de leitura                      |
| `emprestado_para` | VARCHAR(100) | Pessoa que está com o livro emprestado |

O campo `id` é utilizado como chave primária e possui incremento automático.

---

## 📁 Estrutura do Projeto

```text
biblioteca-virtual/
│
├── index.php
├── banco.sql
├── README.md
│
├── config/
│   └── conexao.php
│
├── livros/
│   ├── listar.php
│   ├── cadastrar.php
│   ├── editar.php
│   └── excluir.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   └── js/
│       └── script.js
│
└── includes/
    ├── header.php
    └── footer.php
```

---

## 💻 Requisitos

Para executar o projeto é necessário ter instalado:

* PHP;
* MySQL;
* Apache;
* XAMPP ou outro ambiente de servidor local;
* Navegador web.

Para facilitar a execução, recomenda-se utilizar o **XAMPP**, que já possui Apache, PHP e MySQL.

---

## 🚀 Como instalar e executar

### 1. Instalar o XAMPP

Instale o XAMPP no computador.

Depois de instalar, abra o **XAMPP Control Panel**.

---

### 2. Ativar o servidor

No XAMPP, ative:

```text
Apache
MySQL
```

Os dois serviços devem estar em execução.

---

### 3. Colocar o projeto no XAMPP

Copie a pasta do projeto para:

```text
C:\xampp\htdocs\
```

A estrutura deverá ficar semelhante a:

```text
C:\xampp\htdocs\biblioteca-virtual\
```

---

### 4. Criar o banco de dados

Abra o navegador e acesse:

```text
http://localhost/phpmyadmin
```

Depois:

1. Acesse a opção **Importar**;
2. Selecione o arquivo `banco.sql`;
3. Execute a importação.

O banco de dados `biblioteca_virtual` será criado.

---

### 5. Verificar a conexão

O arquivo responsável pela conexão com o banco está localizado em:

```text
config/conexao.php
```

A configuração padrão utiliza:

```text
Servidor: localhost
Banco: biblioteca_virtual
Usuário: root
Senha: vazia
```

Caso o MySQL do computador possua uma senha diferente, será necessário alterar o arquivo de conexão.

---

### 6. Abrir o sistema

Depois de iniciar o Apache e o MySQL, acesse:

```text
http://localhost/biblioteca-virtual/
```

O sistema será aberto no navegador.

---

## 🧪 Testando o CRUD

Para verificar se todas as funcionalidades estão funcionando:

### 1. Cadastrar

Acesse a opção **Cadastrar Livro** e preencha os dados.

Exemplo:

```text
Título: O Hobbit
Autor: J. R. R. Tolkien
Ano: 1937
Gênero: Fantasia
Status: Lido
Emprestado para: —
```

Depois, salve o cadastro.

---

### 2. Visualizar

Acesse a lista de livros e verifique se o livro cadastrado aparece.

Essa etapa representa o:

```text
READ
```

---

### 3. Editar

Selecione um livro e clique em **Editar**.

Altere alguma informação e salve.

Essa etapa representa o:

```text
UPDATE
```

---

### 4. Excluir

Selecione um livro e clique em **Excluir**.

Confirme a exclusão.

Depois, verifique se o livro não aparece mais na lista.

Essa etapa representa o:

```text
DELETE
```

---

## 🎥 Tutorial em vídeo

Como parte da entrega do projeto, deve ser apresentado um vídeo demonstrando a navegação pelo sistema e as operações CRUD.

### Sugestão de sequência para o vídeo:

1. Apresentar a página inicial;
2. Mostrar o dashboard;
3. Acessar a lista de livros;
4. Cadastrar um novo livro;
5. Mostrar o livro cadastrado;
6. Editar as informações do livro;
7. Mostrar a alteração realizada;
8. Excluir o livro;
9. Mostrar que o livro foi removido;
10. Finalizar apresentando brevemente as tecnologias utilizadas.

### Exemplo de fala:

> "Este é o projeto Biblioteca Virtual, desenvolvido utilizando PHP, MySQL, Bootstrap e JavaScript. O objetivo do sistema é permitir o gerenciamento de livros de uma biblioteca."
>
> "Nesta tela inicial temos um resumo com a quantidade de livros e seus respectivos status."
>
> "Agora vamos acessar a área de livros, onde podemos visualizar os registros cadastrados."
>
> "Primeiramente, vamos cadastrar um novo livro. Essa é a operação Create do CRUD."
>
> "Após o cadastro, podemos visualizar o livro na lista, representando a operação Read."
>
> "Agora vamos editar suas informações, realizando a operação Update."
>
> "Por fim, vamos excluir o registro. Após a confirmação, o livro deixa de aparecer na lista, representando a operação Delete."
>
> "Dessa forma, o sistema apresenta as quatro operações básicas do CRUD."

---

## 🔐 Validações

O sistema possui validações para evitar o cadastro de informações incompletas.

Os campos obrigatórios devem ser preenchidos antes do envio do formulário.

Também existe uma confirmação antes da exclusão de um livro.

---

## 📱 Interface

A interface foi desenvolvida utilizando Bootstrap, permitindo uma apresentação organizada e adaptável a diferentes tamanhos de tela.

O sistema possui:

* Menu de navegação;
* Cards informativos;
* Tabelas;
* Formulários;
* Botões de ação;
* Mensagens de confirmação;
* Layout responsivo.

---

## 📌 Exemplos de livros

O banco de dados pode conter alguns registros iniciais para facilitar os testes, como:

* Harry Potter e a Pedra Filosofal — J. K. Rowling;
* O Hobbit — J. R. R. Tolkien;
* O Assassinato no Expresso do Oriente — Agatha Christie.

Esses registros podem ser utilizados para testar as funções de visualização, edição e exclusão.

---

## 📚 Aprendizados

Durante o desenvolvimento do projeto foram trabalhados conceitos de:

* Desenvolvimento web com PHP;
* Integração entre PHP e MySQL;
* Banco de dados relacional;
* Comandos SQL;
* Operações CRUD;
* Formulários HTML;
* Validação de dados;
* JavaScript;
* Bootstrap;
* Organização de projetos;
* Estrutura de arquivos;
* Versionamento utilizando Git e GitHub.

---

## 👩‍💻 Projeto

**Nome:** Biblioteca Virtual

**Área:** Desenvolvimento de Sistemas

**Tecnologias:** PHP, MySQL, Bootstrap, JavaScript, HTML e CSS

**Tipo:** Sistema web para gerenciamento de livros

---

## 📄 Licença

Projeto desenvolvido para fins acadêmicos e educacionais.
