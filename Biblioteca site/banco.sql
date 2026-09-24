CREATE DATABASE IF NOT EXISTS biblioteca_virtual
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE biblioteca_virtual;

DROP TABLE IF EXISTS livros;
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    ano INT NOT NULL,
    genero VARCHAR(50) NOT NULL,
    status_leitura ENUM('Não lido','Lendo','Lido') NOT NULL DEFAULT 'Não lido',
    emprestado_para VARCHAR(100) DEFAULT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Usuário de demonstração:
-- E-mail: admin@biblioteca.com
-- Senha: 123456
INSERT INTO usuarios (nome, email, senha) VALUES
('Administrador', 'admin@biblioteca.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC1pJYfZ1uFf5nM4iJrG');

INSERT INTO livros (titulo, autor, ano, genero, status_leitura, emprestado_para) VALUES
('Harry Potter e a Pedra Filosofal', 'J. K. Rowling', 1997, 'Fantasia', 'Lido', NULL),
('O Hobbit', 'J. R. R. Tolkien', 1937, 'Fantasia', 'Lendo', NULL),
('O Assassinato no Expresso do Oriente', 'Agatha Christie', 1934, 'Mistério', 'Não lido', 'Mariana'),
('As Crônicas de Nárnia', 'C. S. Lewis', 1950, 'Fantasia', 'Lido', NULL),
('O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 1943, 'Literatura', 'Não lido', NULL);
