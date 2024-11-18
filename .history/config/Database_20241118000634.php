<?php
/**
 * Clase Database
 * 
 * Esta clase maneja la conexión a la base de datos MySQL.
 * Implementa el patrón Singleton para asegurar una única conexión.
 * 
 * Configuración:
 * - host: dirección del servidor de base de datos (localhost)
 * - db_name: nombre de la base de datos (tienda)
 * - username: usuario de la base de datos (root)
 * - password: contraseña de la base de datos ("")
 * 
 * @author mag00s
 * @version 1.0
 */
class Database {
    // Propiedades de conexión
    private $host = "localhost";
    private $db_name = "tienda";
    private $username = "root";
    private $password = "root";
    private $conn = null;

    /**
     * Establece y retorna la conexión a la base de datos
     * 
     * @return PDO|null Retorna la conexión PDO o null si hay error
     */
    public function getConnection() {
        try {
            // Crear nueva conexión PDO
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            
            // Configurar el modo de error y charset
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
            
            return $this->conn;
        } catch(PDOException $e) {
            // Manejo de errores
            echo "🚫 Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}