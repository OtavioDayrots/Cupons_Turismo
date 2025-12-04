<?php
require_once 'Database.php';

class Resgate
{

    // Salvar o resgate
    public static function salvar($usuario_id, $cupom_id, $codigo)
    {
        $conn = Database::conectar();
        $sql = "INSERT INTO resgates (usuario_id, cupom_id, codigo_unico) VALUES (:uid, :cid, :cod)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            ':uid' => $usuario_id,
            ':cid' => $cupom_id,
            ':cod' => $codigo
        ]);
    }

    // Listar cupons de um usuário específico (com dados do hotel)
    public static function listarPorUsuario($usuario_id)
    {
        $conn = Database::conectar();
        // Aqui fazemos um JOIN para pegar o Nome, Imagem e Desconto do cupom original
        $sql = "SELECT r.*, c.nome as nome_hotel, c.imagem, c.desconto 
                FROM resgates r 
                JOIN cupons c ON r.cupom_id = c.id 
                WHERE r.usuario_id = :uid 
                ORDER BY r.data_resgate DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':uid' => $usuario_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // Verificar se usuário já pegou esse cupom (opcional, para evitar duplicidade)
    public static function jaResgatou($usuario_id, $cupom_id)
    {
        $conn = Database::conectar();
        $sql = "SELECT id FROM resgates WHERE usuario_id = :uid AND cupom_id = :cid";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':uid' => $usuario_id, ':cid' => $cupom_id]);
        return $stmt->fetch();
    }
}
