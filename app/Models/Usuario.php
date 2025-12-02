<?php
require_once 'Database.php';

class Usuario {
    
    // Cadastrar novo usuário
    public static function cadastrar($nome, $email, $senha) {
        $conn = Database::conectar();

        // 1. Criptografar a senha (SEGURANÇA É VITAL)
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // 2. Preparar o comando SQL
        $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $conn->prepare($sql);

        // 3. Executar com os dados
        try {
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash
            ]);
            return true;
        } catch (PDOException $e) {
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