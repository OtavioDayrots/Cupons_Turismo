<?php
require_once __DIR__ . '/../Models/Usuario.php';

class UserController {

    // Exibir tela de cadastro
    public function create() {
        require_once __DIR__ . '/../Views/cadastro.php';
    }

    // SALVAR NO BANCO DE DADOS
    public function store() {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if (Usuario::cadastrar($nome, $email, $senha)) {
            // Sucesso! Manda para o login
            header('Location: index.php?page=login&msg=sucesso');
        } else {
            // Erro! Volta para o cadastro
            header('Location: index.php?page=cadastro&erro=email_existe');
        }
    }

    // Exibir tela de login
    public function login() {
        require_once __DIR__ . '/../Views/login.php';
    }

    // PROCESSAR LOGIN
    public function autenticar() {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $usuario = Usuario::logar($email, $senha);

        if ($usuario) {
            // Guardamos os dados na sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            
            // --- NOVO: Guardamos o nível de acesso ---
            $_SESSION['usuario_nivel'] = $usuario['nivel']; 

            header('Location: index.php?page=home');
            exit;
        } else {
            echo "<script>alert('E-mail ou senha incorretos!'); window.history.back();</script>";
        }
    }

    // ADICIONE TAMBÉM A FUNÇÃO DE SAIR (LOGOUT)
    public function logout() {
        session_destroy(); // Destrói a memória
        header('Location: index.php?page=home');
        exit;
    }

    public function painel() {
        // Verifica se está logado antes de mostrar
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: index.php?page=login');
            exit;
        }
        require_once __DIR__ . '/../Views/meus_cupons.php';
    }
}