-- =====================================================
-- ATUALIZAÇÕES E MIGRAÇÕES
-- Use este arquivo apenas se já tiver o banco criado
-- =====================================================

USE `cupons-turismo`;

-- =====================================================
-- Adicionar coluna 'nivel' na tabela usuarios (se não existir)
-- =====================================================
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = 'cupons-turismo' 
    AND TABLE_NAME = 'usuarios' 
    AND COLUMN_NAME = 'nivel'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE usuarios ADD COLUMN nivel VARCHAR(20) DEFAULT ''usuario'' COMMENT ''usuario, empresa, admin''',
    'SELECT ''Coluna nivel já existe'' AS resultado'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- Adicionar coluna 'desconto' na tabela cupons (se não existir)
-- =====================================================
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = 'cupons-turismo' 
    AND TABLE_NAME = 'cupons' 
    AND COLUMN_NAME = 'desconto'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE cupons ADD COLUMN desconto VARCHAR(20) DEFAULT ''10%''',
    'SELECT ''Coluna desconto já existe'' AS resultado'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- Adicionar coluna 'usuario_id' na tabela cupons (se não existir)
-- =====================================================
SET @col_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.COLUMNS 
    WHERE TABLE_SCHEMA = 'cupons-turismo' 
    AND TABLE_NAME = 'cupons' 
    AND COLUMN_NAME = 'usuario_id'
);

SET @sql = IF(@col_exists = 0,
    'ALTER TABLE cupons ADD COLUMN usuario_id INT NULL COMMENT ''ID da empresa que criou o cupom''',
    'SELECT ''Coluna usuario_id já existe'' AS resultado'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- Adicionar foreign key para usuario_id (se não existir)
-- =====================================================
SET @fk_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
    WHERE TABLE_SCHEMA = 'cupons-turismo' 
    AND TABLE_NAME = 'cupons' 
    AND COLUMN_NAME = 'usuario_id' 
    AND REFERENCED_TABLE_NAME IS NOT NULL
);

SET @sql = IF(@fk_exists = 0,
    'ALTER TABLE cupons ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL',
    'SELECT ''Foreign key já existe'' AS resultado'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- Adicionar índice único para evitar resgate duplicado (se não existir)
-- =====================================================
SET @idx_exists = (
    SELECT COUNT(*) 
    FROM INFORMATION_SCHEMA.STATISTICS 
    WHERE TABLE_SCHEMA = 'cupons-turismo' 
    AND TABLE_NAME = 'resgates' 
    AND INDEX_NAME = 'unique_usuario_cupom'
);

SET @sql = IF(@idx_exists = 0,
    'ALTER TABLE resgates ADD UNIQUE KEY unique_usuario_cupom (usuario_id, cupom_id)',
    'SELECT ''Índice único já existe'' AS resultado'
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- =====================================================
-- Atualizar cupons existentes sem desconto
-- =====================================================
UPDATE cupons SET desconto = '10%' WHERE desconto IS NULL OR desconto = '';

-- =====================================================
-- FIM DAS ATUALIZAÇÕES
-- =====================================================

SELECT 'Atualizações concluídas com sucesso!' AS resultado;

