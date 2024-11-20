<?php
class Database {
    private $host = "localhost";
    private $db_name = "enlaces";  // Nombre de la base de datos
    private $username = "root";   // Cambia si tu usuario es diferente
    private $password = "root";       // Contraseña de tu base de datos
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {A
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
