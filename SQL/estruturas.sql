-- 1. Cria o banco
CREATE DATABASE IF NOT EXISTS `cupons-turismo`;

-- 2. Seleciona esse banco para usar
USE `cupons-turismo`;

-- 3. Cria a tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Cria a tabela de cupons
CREATE TABLE IF NOT EXISTS cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    imagem VARCHAR(255),
    quantidade INT
);

-- 5. Insere dados de exemplo
INSERT INTO cupons (nome, imagem, quantidade) VALUES 
('Hotel Karlton', 'img/karlton.jpg', 11),
('Hotel Plaza', 'img/hotel.png', 5),
('Pousada Paraíso', 'img/paraiso.png', 8);

-- http://localhost/cupons_turismo/public/index.php?page=admin

-- Adiciona a coluna de nível (padrão é 'usuario')
ALTER TABLE usuarios ADD COLUMN nivel VARCHAR(20) DEFAULT 'usuario';

-- IMPORTANTE: Transforme o SEU usuário em admin
-- (Troque pelo seu e-mail real abaixo)
UPDATE usuarios SET nivel = 'admin' WHERE email = 'teste@gmail.com';