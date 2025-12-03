<?php
require_once 'Database.php';

class Cupom {

    // LISTAR TODOS (Para a Home e para o Admin Geral)
    public static function listarTodos() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM cupons ORDER BY id DESC";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // --- NOVO: LISTAR SÓ OS DA EMPRESA ---
    public static function listarPorUsuario($usuario_id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM cupons WHERE usuario_id = :uid ORDER BY id DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // --- ATUALIZADO: CRIAR COM DONO ---
    public static function criar($nome, $imagem, $quantidade, $usuario_id) {
        $conn = Database::conectar();
        $sql = "INSERT INTO cupons (nome, imagem, quantidade, usuario_id) VALUES (:nome, :imagem, :quantidade, :uid)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':imagem' => $imagem,
            ':quantidade' => $quantidade,
            ':uid' => $usuario_id // Salva quem criou
        ]);
    }

    // DELETAR (Seguro: verifica se o cupom é mesmo daquela empresa)
    public static function deletar($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM cupons WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // BUSCAR POR ID
    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM cupons WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // ATUALIZAR
    public static function atualizar($id, $nome, $imagem, $quantidade) {
        $conn = Database::conectar();
        $sql = "UPDATE cupons SET nome = :nome, imagem = :imagem, quantidade = :quantidade WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':imagem' => $imagem,
            ':quantidade' => $quantidade
        ]);
    }
}
?>