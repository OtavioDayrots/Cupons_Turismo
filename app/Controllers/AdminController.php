<?php
require_once __DIR__ . '/../Models/Cupom.php';

class AdminController {

    // Verifica se o usuário é admin (ou se está logado)
    private function verificarAcesso() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
    }

    // Mostra o Painel (Lista + Formulário)
    public function index() {
        $this->verificarAcesso();
        $cupons = Cupom::listarTodos();
        require_once __DIR__ . '/../Views/admin_painel.php';
    }

    // Salva um novo cupom
    public function store() {
        $this->verificarAcesso();
        
        $nome = $_POST['nome'];
        $imagem = $_POST['imagem']; // Por enquanto vamos digitar o caminho (ex: img/hotel.png)
        $quantidade = $_POST['quantidade'];

        Cupom::criar($nome, $imagem, $quantidade);
        
        header('Location: index.php?page=admin');
    }

    // Deleta um cupom
    public function delete() {
        $this->verificarAcesso();
        
        if (isset($_GET['id'])) {
            Cupom::deletar($_GET['id']);
        }
        
        header('Location: index.php?page=admin');
    }

    // Tela de Edição
    public function edit() {
        $this->verificarAcesso();
        
        if (isset($_GET['id'])) {
            // Busca os dados atuais para preencher os inputs
            $cupom = Cupom::buscarPorId($_GET['id']);
            require_once __DIR__ . '/../Views/admin_editar.php';
        } else {
            header('Location: index.php?page=admin');
        }
    }

    // Processar a Edição
    public function update() {
        $this->verificarAcesso();
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $imagem = $_POST['imagem'];
        $quantidade = $_POST['quantidade'];

        Cupom::atualizar($id, $nome, $imagem, $quantidade);
        
        // Volta para o painel
        header('Location: index.php?page=admin');
    }
}
