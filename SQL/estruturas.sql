-- =====================================================
-- SISTEMA DE CUPONS DE TURISMO
-- Script de criação do banco de dados
-- =====================================================

-- =====================================================
-- 1. CRIAÇÃO DO BANCO DE DADOS
-- =====================================================
CREATE DATABASE IF NOT EXISTS `cupons-turismo`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `cupons-turismo`;

-- =====================================================
-- 2. CRIAÇÃO DAS TABELAS
-- =====================================================

-- Tabela de Usuários
CREATE TABLE IF NOT EXISTS `usuarios` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL UNIQUE,
    `senha` VARCHAR(255) NOT NULL,
    `nivel` VARCHAR(20) DEFAULT 'usuario' COMMENT 'usuario, empresa, admin',
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_email` (`email`),
    INDEX `idx_nivel` (`nivel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Cupons
CREATE TABLE IF NOT EXISTS `cupons` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `nome` VARCHAR(100) NOT NULL,
    `imagem` VARCHAR(255) NOT NULL,
    `quantidade` INT NOT NULL DEFAULT 0,
    `desconto` VARCHAR(20) DEFAULT '10%',
    `usuario_id` INT NULL COMMENT 'ID da empresa que criou o cupom',
    `criado_em` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE SET NULL,
    INDEX `idx_usuario_id` (`usuario_id`),
    INDEX `idx_quantidade` (`quantidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabela de Resgates
CREATE TABLE IF NOT EXISTS `resgates` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `usuario_id` INT NOT NULL COMMENT 'Usuário que resgatou',
    `cupom_id` INT NOT NULL COMMENT 'Cupom resgatado',
    `codigo_unico` VARCHAR(50) NOT NULL UNIQUE COMMENT 'Código único do cupom resgatado',
    `data_resgate` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`usuario_id`) REFERENCES `usuarios`(`id`) ON DELETE CASCADE,
    FOREIGN KEY (`cupom_id`) REFERENCES `cupons`(`id`) ON DELETE CASCADE,
    INDEX `idx_usuario_id` (`usuario_id`),
    INDEX `idx_cupom_id` (`cupom_id`),
    INDEX `idx_codigo_unico` (`codigo_unico`),
    UNIQUE KEY `unique_usuario_cupom` (`usuario_id`, `cupom_id`) COMMENT 'Evita resgate duplicado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- 3. DADOS DE EXEMPLO
-- =====================================================

-- Insere cupons de exemplo
INSERT INTO `cupons` (`nome`, `imagem`, `quantidade`, `desconto`, `usuario_id`) VALUES
('Hotel Karlton', 'img/karlton.jpg', 11, '20%', NULL),
('Hotel Plaza', 'img/hotel.png', 5, '15%', NULL),
('Pousada Paraíso', 'img/paraiso.png', 8, '25%', NULL);

-- =====================================================
-- 4. USUÁRIOS DE TESTE (OPCIONAL)
-- =====================================================

-- Descomente as linhas abaixo para criar usuários de teste automaticamente

-- Usuário Administrador de teste
-- INSERT INTO `usuarios` (`nome`, `email`, `senha`, `nivel`) VALUES
-- ('Admin Teste', 'admin@teste.com', MD5('123456'), 'admin');

-- Usuário Empresa de teste
-- INSERT INTO `usuarios` (`nome`, `email`, `senha`, `nivel`) VALUES
-- ('Empresa Teste', 'empresa@teste.com', MD5('123456'), 'empresa');

-- Usuário comum de teste
-- INSERT INTO `usuarios` (`nome`, `email`, `senha`, `nivel`) VALUES
-- ('Usuário Teste', 'usuario@teste.com', MD5('123456'), 'usuario');

-- =====================================================
-- 5. INSTRUÇÕES PÓS-INSTALAÇÃO
-- =====================================================

-- Após executar este script:
-- 
-- 1. Cadastre-se no sistema normalmente
-- 
-- 2. Para tornar seu usuário em ADMIN, execute:
--    UPDATE usuarios SET nivel = 'admin' WHERE email = 'seu_email@aqui.com';
-- 
-- 3. Para tornar um usuário em EMPRESA, execute:
--    UPDATE usuarios SET nivel = 'empresa' WHERE email = 'email_empresa@aqui.com';
-- 
-- 4. Os cupons de exemplo já estão criados e podem ser visualizados na home

-- =====================================================
-- FIM DO SCRIPT
-- =====================================================
