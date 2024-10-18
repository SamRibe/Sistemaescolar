-- Criando o banco de dados
CREATE DATABASE GerenciamentoTurmas;

-- Selecionando o banco de dados
USE GerenciamentoTurmas;

-- Tabela de professores (usuários)
CREATE TABLE Professores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

-- Tabela de turmas
CREATE TABLE Turmas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES Professores(id) ON DELETE CASCADE
);

-- Tabela de atividades
CREATE TABLE Atividades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_entrega DATE,
    turma_id INT,
    FOREIGN KEY (turma_id) REFERENCES Turmas(id) ON DELETE CASCADE
);

-- Inserindo alguns professores
INSERT INTO Professores (nome, email, senha) VALUES
('João Silva', 'joao.silva@email.com', 'senha123'),
('Maria Oliveira', 'maria.oliveira@email.com', 'senha456'),
('Carlos Pereira', 'carlos.pereira@email.com', 'senha789');

-- Inserindo algumas turmas
INSERT INTO Turmas (nome, descricao, professor_id) VALUES
('Matemática 1A', 'Turma de Matemática para o 1º ano', 1),
('História 2B', 'Turma de História para o 2º ano', 2),
('Química 3C', 'Turma de Química para o 3º ano', 3);

-- Inserindo algumas atividades
INSERT INTO Atividades (nome, descricao, data_entrega, turma_id) VALUES
('Prova de Geometria', 'Prova sobre triângulos e círculos', '2024-10-30', 1),
('Trabalho sobre Revolução Francesa', 'Trabalho em grupo sobre os principais eventos', '2024-11-10', 2),
('Experimento de Reações Químicas', 'Realizar um experimento sobre ácidos e bases', '2024-11-15', 3);