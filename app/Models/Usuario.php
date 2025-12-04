<?php
require_once 'Database.php';

class Usuario {
    
    // Cadastrar novo usuário
    public static function cadastrar($nome, $email, $senha, $documento = '', $tipo_cadastro = 'pessoa_fisica', $celular = '', $nivel = 'usuario') {
        $conn = Database::conectar();

        // 1. Criptografar a senha (SEGURANÇA É VITAL)
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // 2. Preparar o comando SQL
        // Tenta inserir com todos os campos, se algum campo não existir, tenta sem ele
        try {
            $sql = "INSERT INTO usuarios (nome, email, senha, nivel, documento, tipo_cadastro, celular) 
                    VALUES (:nome, :email, :senha, :nivel, :documento, :tipo_cadastro, :celular)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':nivel' => $nivel,
                ':documento' => $documento,
                ':tipo_cadastro' => $tipo_cadastro,
                ':celular' => $celular
            ]);
            return true;
        } catch (PDOException $e) {
            // Se der erro por coluna não existir, tenta sem os campos opcionais
            if (strpos($e->getMessage(), "Unknown column") !== false) {
                try {
                    $sql = "INSERT INTO usuarios (nome, email, senha, nivel) 
                            VALUES (:nome, :email, :senha, :nivel)";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([
                        ':nome' => $nome,
                        ':email' => $email,
                        ':senha' => $senhaHash,
                        ':nivel' => $nivel
                    ]);
                    return true;
                } catch (PDOException $e2) {
                    // Se der erro (ex: email já existe)
                    return false;
                }
            }
            // Se der erro (ex: email já existe)
            return false;
        }
    }

    // Verificar login
    public static function logar($email, $senha) {
        $conn = Database::conectar();

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se achou o usuário E se a senha bate
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    // LISTAR TODOS (READ)
    public static function listarTodos() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // BUSCAR POR ID (Para edição)
    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // ATUALIZAR (UPDATE - Sem alterar senha)
    public static function atualizar($id, $nome, $email, $nivel) {
        $conn = Database::conectar();
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, nivel = :nivel WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':nivel' => $nivel
        ]);
    }

    // DELETAR (DELETE)
    public static function deletar($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}