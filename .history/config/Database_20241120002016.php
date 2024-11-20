<?php
/**
 * Clase: Database
 * Descripción: Gestiona la conexión con la base de datos MySQL
 * 
 * Ubicación: /config/Database.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

class Database {
    // Credenciales de la base de datos
    private $host = "localhost";
    private $db_name = "enlaces";
    private $username = "root";    
    private $password = "root";        // Adjust this if your root has a password
    private $conn = null;

    /**
     * Obtiene la conexión a la base de datos
     */
    public function getConnection() {
        try {
            // Specifically for MariaDB/MySQL with explicit charset
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4",
                $this->username,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch(PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
        return $this->conn;
    }
}