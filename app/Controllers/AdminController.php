<?php
require_once __DIR__ . '/../Models/Cupom.php';
require_once __DIR__ . '/../Models/Usuario.php'; // Adicionado para gestão de usuários

class AdminController {

    // Verifica se o usuário é admin
    private function verificarAcesso() {
        if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_nivel'] !== 'admin') {
            header('Location: index.php?page=home');
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
        $imagem = $_POST['imagem'];
        $quantidade = (int)$_POST['quantidade'];
        $desconto = $_POST['desconto'];

        // Admin insere o cupom como se fosse dele
        Cupom::criar($nome, $imagem, $quantidade, $_SESSION['usuario_id'], $desconto);
        
        header('Location: index.php?page=admin');
    }

    // ... (Métodos delete, edit, update, usuarios, editUser, updateUser, deleteUser são mantidos)
    public function delete() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) {
            Cupom::deletar($_GET['id']);
        }
        header('Location: index.php?page=admin');
    }
    public function edit() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) {
            $cupom = Cupom::buscarPorId($_GET['id']);
            require_once __DIR__ . '/../Views/admin_editar.php';
        } else {
            header('Location: index.php?page=admin');
        }
    }
    public function update() {
        $this->verificarAcesso();
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $imagem = $_POST['imagem'];
        $quantidade = (int)$_POST['quantidade'];
        $desconto = $_POST['desconto'];
        Cupom::atualizar($id, $nome, $imagem, $quantidade, $desconto);
        header('Location: index.php?page=admin');
    }
    public function usuarios() {
        $this->verificarAcesso();
        $usuarios = Usuario::listarTodos();
        require_once __DIR__ . '/../Views/admin_usuarios_lista.php';
    }
    public function editUser() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) {
            $usuario = Usuario::buscarPorId($_GET['id']);
            require_once __DIR__ . '/../Views/admin_usuarios_editar.php';
        }
    }
    public function updateUser() {
        $this->verificarAcesso();
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nivel = $_POST['nivel'];
        Usuario::atualizar($id, $nome, $email, $nivel);
        header('Location: index.php?page=admin-users');
    }
    public function deleteUser() {
        $this->verificarAcesso();
        $id = $_GET['id'];
        if ($id == $_SESSION['usuario_id']) {
            echo "<script>alert('Você não pode se auto-excluir!'); window.history.back();</script>";
            return;
        }
        Usuario::deletar($id);
        header('Location: index.php?page=admin-users');
    }
}
?>