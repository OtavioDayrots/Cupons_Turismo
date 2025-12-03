<?php
require_once __DIR__ . '/../app/Controllers/EmpresaController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
session_start();

define('BASE_URL', 'http://localhost/Cupons_Turismo/public/');

// Carrega os controladores
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';

// Roteamento Simples
// Se existir ?page=algumacoisa na URL, pega esse valor. Se não, assume 'home'.
$pagina = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($pagina) {
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;
    
    // --- Rotas de Cadastro ---
    case 'cadastro':
        $controller = new UserController();
        $controller->create();
        break;

    case 'salvar-usuario':
        $controller = new UserController();
        $controller->store();
        break;

    // --- NOVAS ROTAS DE LOGIN ---
    case 'login':
        $controller = new UserController();
        $controller->login(); // Mostra o formulário
        break;

    case 'fazer-login':
        $controller = new UserController();
        $controller->autenticar(); // Processa os dados
        break;
        
    default:
        echo "Página não encontrada!";
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;

    case 'meus-cupons':
        $controller = new UserController();
        $controller->painel();
        break;

    // --- ROTAS DO ADMIN (CRUD) ---
    case 'admin':
        $controller = new AdminController();
        $controller->index();
        break;

    case 'admin-store':
        $controller = new AdminController();
        $controller->store();
        break;

    case 'admin-delete':
        $controller = new AdminController();
        $controller->delete();
        break;

    case 'admin-edit':
        $controller = new AdminController();
        $controller->edit(); // Mostra o formulário preenchido
        break;

    case 'admin-update':
        $controller = new AdminController();
        $controller->update(); // Salva no banco
        break;

    // --- ROTAS DE USUÁRIOS (ADMIN) ---
    case 'admin-users':
        $controller = new AdminController();
        $controller->usuarios();
        break;

    case 'admin-user-edit':
        $controller = new AdminController();
        $controller->editUser();
        break;

    case 'admin-user-update':
        $controller = new AdminController();
        $controller->updateUser();
        break;

    case 'admin-user-delete':
        $controller = new AdminController();
        $controller->deleteUser();
        break;

    case 'resgatar':
        $controller = new UserController();
        $controller->resgatar(); // Vai pegar o ID da URL e gerar o cupom
        break;

    // --- ROTAS DA EMPRESA ---
    case 'empresa-painel':
        $controller = new EmpresaController();
        $controller->index();
        break;

    case 'empresa-store':
        $controller = new EmpresaController();
        $controller->store();
        break;

    case 'empresa-delete':
        $controller = new EmpresaController();
        $controller->delete();
        break;
}