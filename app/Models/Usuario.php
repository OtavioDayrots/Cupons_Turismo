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
}