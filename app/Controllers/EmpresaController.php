<?php
require_once __DIR__ . '/../Models/Cupom.php';

class EmpresaController {

    // Segurança: Só entra se for nível 'empresa'
    private function verificarAcesso() {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_nivel'] !== 'empresa') {
            // Se não for empresa, manda pra home
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
        $quantidade = $_POST['quantidade'];
        $desconto = $_POST['desconto']; // <--- Pega do form
        $usuario_id = $_SESSION['usuario_id'];

        // Passa o desconto para o model
        Cupom::criar($nome, $imagem, $quantidade, $usuario_id, $desconto);
        
        header('Location: index.php?page=empresa-painel');
    }

    // Deletar cupom da empresa
    public function delete() {
        $this->verificarAcesso();
        
        // Aqui seria ideal verificar se o cupom pertence mesmo à empresa antes de deletar
        // Mas para simplificar o tutorial, vamos confiar no ID por enquanto
        if (isset($_GET['id'])) {
            Cupom::deletar($_GET['id']);
        }
        
        header('Location: index.php?page=empresa-painel');
    }
}
?>