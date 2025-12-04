<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Resgate.php'; // Importante para o QR Code funcionar

class UserController {

    // --- CADASTRO ---

    public function create() {
        require_once __DIR__ . '/../Views/cadastro.php';
    }

    public function store() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (Usuario::cadastrar($nome, $email, $senha)) {
            header('Location: main.php?page=login&msg=sucesso');
        } else {
            header('Location: main.php?page=cadastro&erro=email_existe');
        }
    }

    // --- LOGIN ---

    public function login() {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function autenticar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = Usuario::logar($email, $senha);

        if ($usuario) {
            // Salva dados na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_nivel'] = $usuario['nivel']; 

            header('Location: main.php?page=home');
            exit;
        } else {
            echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: main.php?page=home');
        exit;
    }

    // --- CUPONS E RESGATE (QR CODE) ---

    public function resgatar() {
        // 1. Verifica login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: main.php?page=login');
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];
        $cupom_id = $_GET['id'];

        // --- NOVO: VERIFICA ESTOQUE ANTES DE TUDO ---
        // Precisamos buscar o cupom para ver a quantidade atual
        require_once __DIR__ . '/../Models/Cupom.php'; // Garante que o Model Cupom está carregado
        $cupom = Cupom::buscarPorId($cupom_id);

        if ($cupom->quantidade <= 0) {
            echo "<script>alert('Poxa! Esse cupom acabou de esgotar.'); window.location='main.php?page=home';</script>";
            exit;
        }

        // 2. Verifica se já pegou (opcional)
        if (Resgate::jaResgatou($usuario_id, $cupom_id)) {
            echo "<script>alert('Você já pegou esse cupom!'); window.location='main.php?page=meus-cupons';</script>";
            exit;
        }

        // 3. Gera código e Salva o Resgate
        $codigo = "#CUP-" . strtoupper(substr(md5(uniqid()), 0, 5));
        
        if (Resgate::salvar($usuario_id, $cupom_id, $codigo)) {
            
            // --- NOVO: DIMINUI O ESTOQUE AGORA ---
            Cupom::decrementarEstoque($cupom_id);

            // Sucesso
            header('Location: main.php?page=meus-cupons');
        } else {
            echo "Erro ao resgatar.";
        }
    }

    public function painel() {
        // Verifica se está logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: main.php?page=login');
            exit;
        }
        
        // Busca os resgates reais do banco usando o Model Resgate
        $meus_cupons = Resgate::listarPorUsuario($_SESSION['usuario_id']);
        
        require_once __DIR__ . '/../Views/meus_cupons.php';
    }
}
