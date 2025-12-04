<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Resgate.php';

class UserController {

    // --- CADASTRO ---

    public function create() {
        require_once __DIR__ . '/../Views/cadastro.php';
    }

    public function store() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        // Captura o nível escolhido
        $nivel = $_POST['nivel'];

        // SEGURANÇA BÁSICA:
        // Garante que só aceite 'usuario' ou 'empresa'. 
        // Se alguém tentar enviar 'admin' hackeando o HTML, forçamos virar 'usuario'.
        if ($nivel !== 'empresa') {
            $nivel = 'usuario';
        }

        // Passa o nível para o cadastro
        if (Usuario::cadastrar($nome, $email, $senha, $nivel)) {
            header('Location: index.php?page=login&msg=sucesso');
        } else {
            header('Location: index.php?page=cadastro&erro=email_existe');
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

    // --- CUPONS E RESGATE ---

    public function resgatar() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];
        
        if (!isset($_GET['id'])) {
            header('Location: index.php?page=home');
            exit;
        }
        $cupom_id = $_GET['id']; 

        // NOVO: Verifica Estoque
        require_once __DIR__ . '/../Models/Cupom.php';
        $cupom = Cupom::buscarPorId($cupom_id);

        if ($cupom->quantidade <= 0) {
            echo "<script>alert('Esgotado!'); window.location='index.php?page=home';</script>";
            exit;
        }

        if (Resgate::jaResgatou($usuario_id, $cupom_id)) {
            echo "<script>alert('Você já pegou esse cupom!'); window.location='index.php?page=meus-cupons';</script>";
            exit;
        }

        $codigo = "#CUP-" . strtoupper(substr(md5(uniqid()), 0, 5));

        if(Resgate::salvar($usuario_id, $cupom_id, $codigo)){
            Cupom::decrementarEstoque($cupom_id);
            header('Location: index.php?page=meus-cupons');
        }
    }

    public function painel() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        $meus_cupons = Resgate::listarPorUsuario($_SESSION['usuario_id']);
        require_once __DIR__ . '/../Views/meus_cupons.php';
    }
}
?>