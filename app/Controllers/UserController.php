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
        $documento = isset($_POST['documento']) ? $_POST['documento'] : '';
        $tipo_cadastro = isset($_POST['tipo_cadastro']) ? $_POST['tipo_cadastro'] : 'pessoa_fisica';
        $celular = isset($_POST['celular']) ? $_POST['celular'] : '';

        // Define o nível baseado no tipo de cadastro
        $nivel = ($tipo_cadastro === 'empresa') ? 'empresa' : 'usuario';

        if (Usuario::cadastrar($nome, $email, $senha, $documento, $tipo_cadastro, $celular, $nivel)) {
            header('Location: index.php?page=login&msg=sucesso');
            exit;
        } else {
            header('Location: index.php?page=cadastro&erro=email_existe');
            exit;
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

            header('Location: index.php?page=home');
            exit;
        } else {
            echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?page=home');
        exit;
    }

    // --- CUPONS E RESGATE (QR CODE) ---

    public function resgatar() {
        // 1. Verifica login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];
        $cupom_id = isset($_GET['id']) ? $_GET['id'] : null;

        if (!$cupom_id) {
            echo "<script>alert('Cupom não encontrado!'); window.location='index.php?page=home';</script>";
            exit;
        }

        // --- NOVO: VERIFICA ESTOQUE ANTES DE TUDO ---
        // Precisamos buscar o cupom para ver a quantidade atual
        require_once __DIR__ . '/../Models/Cupom.php'; // Garante que o Model Cupom está carregado
        $cupom = Cupom::buscarPorId($cupom_id);

        if (!$cupom) {
            echo "<script>alert('Cupom não encontrado!'); window.location='index.php?page=home';</script>";
            exit;
        }

        if ($cupom->quantidade <= 0) {
            echo "<script>alert('Poxa! Esse cupom acabou de esgotar.'); window.location='index.php?page=home';</script>";
            exit;
        }

        // 2. Verifica se já pegou (opcional)
        if (Resgate::jaResgatou($usuario_id, $cupom_id)) {
            echo "<script>alert('Você já pegou esse cupom!'); window.location='index.php?page=meus-cupons';</script>";
            exit;
        }

        // 3. Gera código e Salva o Resgate
        $codigo = "#CUP-" . strtoupper(substr(md5(uniqid()), 0, 5));
        
        if (Resgate::salvar($usuario_id, $cupom_id, $codigo)) {
            
            // --- NOVO: DIMINUI O ESTOQUE AGORA ---
            Cupom::decrementarEstoque($cupom_id);

            // Sucesso
            header('Location: index.php?page=meus-cupons');
            exit;
        } else {
            echo "<script>alert('Erro ao resgatar cupom. Tente novamente.'); window.location='index.php?page=home';</script>";
            exit;
        }
    }

    public function painel() {
        // Verifica se está logado
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        
        // Busca os resgates reais do banco usando o Model Resgate
        $meus_cupons = Resgate::listarPorUsuario($_SESSION['usuario_id']);
        
        // Garante que $meus_cupons seja um array mesmo se não houver resgates
        if (!is_array($meus_cupons)) {
            $meus_cupons = [];
        }
        
        require_once __DIR__ . '/../Views/meus_cupons.php';
    }
}
