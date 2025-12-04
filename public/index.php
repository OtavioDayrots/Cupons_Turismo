<?php
// Inicia a sessão sempre no topo
session_start();

// Define o caminho base para que o CSS e as Imagens funcionem
define('BASE_URL', 'http://localhost/Cupons_Turismo/public/'); 

// Carrega os controladores
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/UserController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/EmpresaController.php'; // Garantindo que todos estão carregados

// Roteamento Simples
$pagina = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($pagina) {
    case 'home':
        (new HomeController())->index();
        break;
    
    // Rotas de Usuário/Auth
    case 'cadastro':
        (new UserController())->create();
        break;
    case 'salvar-usuario':
        (new UserController())->store();
        break;
    case 'login':
        (new UserController())->login();
        break;
    case 'fazer-login':
        (new UserController())->autenticar();
        break;
    case 'logout':
        (new UserController())->logout();
        break;
    case 'meus-cupons':
        (new UserController())->painel();
        break;
    case 'resgatar':
        (new UserController())->resgatar();
        break;

    // Rotas da Empresa
    case 'empresa-painel':
        (new EmpresaController())->index();
        break;
    case 'empresa-store':
        (new EmpresaController())->store();
        break;
    case 'empresa-delete':
        (new EmpresaController())->delete();
        break;
        
    // Rotas do Admin
    case 'admin':
        (new AdminController())->index();
        break;
    case 'admin-store':
        (new AdminController())->store();
        break;
    case 'admin-delete':
        (new AdminController())->delete();
        break;
    case 'admin-edit':
        (new AdminController())->edit();
        break;
    case 'admin-update':
        (new AdminController())->update();
        break;
    
    // Rotas de Usuários (Admin)
    case 'admin-users':
        (new AdminController())->usuarios();
        break;
    case 'admin-user-edit':
        (new AdminController())->editUser();
        break;
    case 'admin-user-update':
        (new AdminController())->updateUser();
        break;
    case 'admin-user-delete':
        (new AdminController())->deleteUser();
        break;
        
    default:
        // Evitar erro de página não encontrada
        http_response_code(404);
        echo "<h1>Página não encontrada!</h1>";
        break;
}
?>