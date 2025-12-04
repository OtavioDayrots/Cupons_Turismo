<?php
require_once __DIR__ . '/../Models/Cupom.php';

class EmpresaController {

    // Segurança: Só entra se for nível 'empresa'
    private function verificarAcesso() {
        if (!isset($_SESSION['usuario_id']) || ($_SESSION['usuario_nivel'] !== 'empresa' && $_SESSION['usuario_nivel'] !== 'admin')) {
            // Se não for empresa (ou admin, que pode gerenciar tudo), manda pra home
            header('Location: index.php?page=home');
            exit;
        }
    }

    // Painel da Empresa
    public function index() {
        $this->verificarAcesso();
        // Busca apenas os cupons DESTE usuário logado
        $meus_cupons = Cupom::listarPorUsuario($_SESSION['usuario_id']);
        require_once __DIR__ . '/../Views/empresa_painel.php';
    }

    // Salvar novo cupom da empresa
    public function store() {
        $this->verificarAcesso();
        
        $nome = $_POST['nome'];
        $imagem = $_POST['imagem'];
        $quantidade = (int)$_POST['quantidade'];
        $desconto = $_POST['desconto']; 
        $usuario_id = $_SESSION['usuario_id'];

        if ($quantidade > 0 && !empty($nome)) {
            Cupom::criar($nome, $imagem, $quantidade, $usuario_id, $desconto);
        }
        
        header('Location: index.php?page=empresa-painel');
    }

    // Deletar cupom da empresa
    public function delete() {
        $this->verificarAcesso();
        
        if (isset($_GET['id'])) {
            // Idealmente, você buscaria o cupom para ter certeza que é do usuario_id logado antes de deletar
            Cupom::deletar($_GET['id']);
        }
        
        header('Location: index.php?page=empresa-painel');
    }
}
?>