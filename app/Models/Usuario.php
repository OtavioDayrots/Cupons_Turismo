<?php
require_once 'Database.php';

class Usuario {
    
    // Cadastrar novo usuário (Atualizado com Nível)
    public static function cadastrar($nome, $email, $senha, $nivel) {
        $conn = Database::conectar();

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        // Adicionamos a coluna 'nivel' no INSERT
        $sql = "INSERT INTO usuarios (nome, email, senha, nivel) VALUES (:nome, :email, :senha, :nivel)";
        $stmt = $conn->prepare($sql);

        try {
            $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senhaHash,
                ':nivel' => $nivel
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Listar Todos (CRUD Admin)
    public static function listarTodos() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM usuarios ORDER BY id DESC";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Buscar por ID
    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Verificar login
    public static function logar($email, $senha) {
        $conn = Database::conectar();

        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }

        return false;
    }

    // Atualizar e Deletar continuam iguais (para o Admin)
    public static function atualizar($id, $nome, $email, $nivel) {
        $conn = Database::conectar();
        $sql = "UPDATE usuarios SET nome = :nome, email = :email, nivel = :nivel WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id, ':nome' => $nome, ':email' => $email, ':nivel' => $nivel]);
    }

    public static function deletar($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
?>