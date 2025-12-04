<?php
// api_cidades.php
header('Access-Control-Allow-Origin: *'); // Permite que o front acesse sem bloqueios
header('Content-Type: application/json; charset=utf-8');

// --- CONFIGURAÇÕES DE CONEXÃO ---
$host = 'localhost';
$port = '3306';    
$db   = 'cidades';  
$user = 'root';     
$pass = '';         

try {
    // Conexão via PDO
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Busca as cidades ordenadas por nome
    $sql = "SELECT id, nome, estado FROM destinos ORDER BY nome ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Retorna o JSON
    echo json_encode($resultados);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['erro' => 'Falha na conexão: ' . $e->getMessage()]);
}
?>