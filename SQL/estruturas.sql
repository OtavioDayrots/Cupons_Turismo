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
    nivel VARCHAR(20) DEFAULT 'usuario',
    documento VARCHAR(20),
    tipo_cadastro VARCHAR(20) DEFAULT 'pessoa_fisica',
    celular VARCHAR(20),
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 4. Cria a tabela de cupons
CREATE TABLE IF NOT EXISTS cupons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    imagem VARCHAR(255),
    quantidade INT,
    usuario_id INT,
    desconto VARCHAR(20)
);

-- 5. Insere dados de exemplo
INSERT INTO cupons (nome, imagem, quantidade) VALUES 
('Hotel Karlton', 'img/karlton.jpg', 11),
('Hotel Plaza', 'img/hotel.png', 5),
('Pousada Paraíso', 'img/paraiso.png', 8);

-- IMPORTANTE: Transforme o SEU usuário em admin
-- (Troque pelo seu e-mail real abaixo)
-- UPDATE usuarios SET nivel = 'admin' WHERE email = 'bruno@gmail.com';

-- Tabela para guardar os resgates
CREATE TABLE IF NOT EXISTS resgates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    cupom_id INT NOT NULL,
    codigo_unico VARCHAR(50) NOT NULL,
    data_resgate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (cupom_id) REFERENCES cupons(id)
);

-- (Opcional) Define que os cupons antigos pertencem ao Admin (ID 1) para não sumirem
-- UPDATE cupons SET usuario_id = 1 WHERE usuario_id IS NULL;

-- Vamos criar o nível 'empresa' nos usuários.
-- Crie um usuário novo no site (ex: "Hotel Plaza", email "plaza@hotel.com")
-- Depois, rode este comando para transformá-lo em empresa:
-- UPDATE usuarios SET nivel = 'empresa' WHERE email = 'plaza@hotel.com';

-- ============================================
-- ATUALIZAÇÃO: Adicionar campos para CPF/CNPJ
-- Se a tabela usuarios já existir, execute o arquivo SQL/atualizar_usuarios.sql
-- ============================================