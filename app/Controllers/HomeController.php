<?php
require_once __DIR__ . '/../Models/Cupom.php';

class HomeController {
    public function index() {
        // 1. Pega os dados do Model
        $cupons = Cupom::listarTodos();

        // 2. Carrega a View e passa os dados
        require_once __DIR__ . '/../Views/home.php';
    }
}
?>