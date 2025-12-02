<?php

class Database {
    private static $host = 'localhost';
    private static $db_name = 'cupons-turismo';
    private static $username = 'root'; // Padrão do XAMPP
    private static $password = '';     // Padrão do XAMPP é senha vazia
    public static $conn;

    public static function conectar() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name,
                    self::$username,
                    self::$password
                );
                // Configura para mostrar erros se algo der errado
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo "Erro na conexão: " . $e->getMessage();
            }
        }
        return self::$conn;
    }
}
?>