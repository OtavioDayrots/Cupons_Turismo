<?php
require_once 'Database.php';

class Cupom {

    // LISTAR TODOS (READ)
    public static function listarTodos() {
        $conn = Database::conectar();
        $sql = "SELECT * FROM cupons ORDER BY id DESC";
        $stmt = $conn->query($sql);
        // Retorna como OBJETO para não quebrar sua Home antiga
        return $stmt->fetchAll(PDO::FETCH_OBJ); 
    }

    // CRIAR NOVO (CREATE)
    public static function criar($nome, $imagem, $quantidade) {
        $conn = Database::conectar();
        $sql = "INSERT INTO cupons (nome, imagem, quantidade) VALUES (:nome, :imagem, :quantidade)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':nome' => $nome,
            ':imagem' => $imagem,
            ':quantidade' => $quantidade
        ]);
    }

    // DELETAR (DELETE)
    public static function deletar($id) {
        $conn = Database::conectar();
        $sql = "DELETE FROM cupons WHERE id = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    // BUSCAR POR ID (Para preencher o formulário de edição)
    public static function buscarPorId($id) {
        $conn = Database::conectar();
        $sql = "SELECT * FROM cupons WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // ATUALIZAR (UPDATE)
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
