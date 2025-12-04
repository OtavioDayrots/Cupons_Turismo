<?php
require_once __DIR__ . '/../Models/Cupom.php';
require_once __DIR__ . '/../Models/Usuario.php';

class AdminController {

    // Verifica se o usuário é admin (ou se está logado)
    private function verificarAcesso() {
        // Se não tá logado OU se o nível não é admin, chuta pra fora
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
        $quantidade = $_POST['quantidade'];
        $desconto = $_POST['desconto']; // <--- Pega do form

        // Passa o desconto para o model
        Cupom::criar($nome, $imagem, $quantidade, $_SESSION['usuario_id'], $desconto);
        
        header('Location: index.php?page=admin');
        exit;
    }

    // Deleta um cupom
    public function delete() {
        $this->verificarAcesso();
        
        if (isset($_GET['id'])) {
            Cupom::deletar($_GET['id']);
        }
        
        header('Location: index.php?page=admin');
        exit;
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
            exit;
        }
    }

    // Processar a Edição
    public function update() {
        $this->verificarAcesso();
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $imagem = $_POST['imagem'];
        $quantidade = $_POST['quantidade'];
        $desconto = $_POST['desconto']; // <--- Pega do form

        Cupom::atualizar($id, $nome, $imagem, $quantidade, $desconto);
        
        header('Location: index.php?page=admin');
        exit;
    }

    // --- GESTÃO DE USUÁRIOS ---

    // Listar Usuários
    public function usuarios() {
        $this->verificarAcesso();
        $usuarios = Usuario::listarTodos();
        require_once __DIR__ . '/../Views/admin_usuarios_lista.php';
    }

    // Tela de Editar Usuário
    public function editUser() {
        $this->verificarAcesso();
        if (isset($_GET['id'])) {
            $usuario = Usuario::buscarPorId($_GET['id']);
            if ($usuario) {
                require_once __DIR__ . '/../Views/admin_usuarios_editar.php';
            } else {
                header('Location: index.php?page=admin-users');
                exit;
            }
        } else {
            header('Location: index.php?page=admin-users');
            exit;
        }
    }

    // Processar Atualização
    public function updateUser() {
        $this->verificarAcesso();
        
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $nivel = $_POST['nivel']; // Aqui definimos se é admin ou usuario

        Usuario::atualizar($id, $nome, $email, $nivel);
        header('Location: index.php?page=admin-users');
        exit;
    }

    // Deletar Usuário
    public function deleteUser() {
        $this->verificarAcesso();
        
        $id = $_GET['id'];

        // Proteção: Não deixar apagar o próprio usuário logado
        if ($id == $_SESSION['usuario_id']) {
            echo "<script>alert('Você não pode se auto-excluir!'); window.history.back();</script>";
            return;
        }

        Usuario::deletar($id);
        header('Location: index.php?page=admin-users');
        exit;
    }
}
