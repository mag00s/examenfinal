<?php
/**
 * Clase: Database
 * Descripción: Gestiona la conexión con la base de datos MySQL para la aplicación de enlaces
 * 
 * Ubicación: /config/Database.php
 * Autor: Marc Urruela
 * Fecha: 19/11/2024
 * 
 * Propósito:
 * - Establece la conexión con la base de datos
 * - Maneja errores de conexión
 * - Proporciona métodos para obtener la conexión
 */

class Database {
    // Credenciales de la base de datos
    private $host = "localhost";
    private $db_name = "enlaces";
    private $username = "root";
    private $password = "";
    private $conn = null;

    /**
     * Obtiene la conexión a la base de datos
     * @return PDO|null Retorna la conexión PDO o null si hay error
     */
    public function getConnection() {
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
            return null;
        }
        return $this->conn;
    }

    /**
     * Cierra la conexión a la base de datos
     */
    public function closeConnection() {
        $this->conn = null;
    }
}