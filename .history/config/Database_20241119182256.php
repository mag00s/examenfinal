<?php
// config/Database.php
/**
 * Clase Database
 * Maneja la conexión con la base de datos MySQL
 * Implementa el patrón Singleton para una única conexión
 */
class Database {
    private static $instance = null;
    private $conn;
    private $host = "localhost";
    private $db_name = "enlaces";
    private $username = "root";
    private $password = "root";

    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        }
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}