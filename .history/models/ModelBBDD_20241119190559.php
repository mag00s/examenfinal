<?php
class ModelBBDD {
    private $host = 'localhost';
    private $db = 'enlaces';
    private $user = 'root';
    private $password = 'root';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->db;charset=utf8mb4",
                $this->user,
                $this->password,
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllLinks() {
        $query = "SELECT * FROM vista_enlaces";
        return $this->executeQuery($query);
    }

    public function getLinksByCategory($category) {
        $query = "SELECT * FROM vista_enlaces WHERE nombre_categoria = :category";
        return $this->executeQuery($query, [':category' => $category]);
    }

    public function getLinksByLanguage() {
        $query = "SELECT * FROM vista_enlaces WHERE tipo_categoria = 'LENGUAJE'";
        return $this->executeQuery($query);
    }

    public function searchByTitle($term) {
        $query = "SELECT * FROM vista_enlaces WHERE titulo LIKE :term";
        return $this->executeQuery($query, [':term' => "%$term%"]);
    }

    public function getCategories() {
        $query = "SELECT DISTINCT nombre_categoria FROM vista_enlaces";
        return $this->executeQuery($query);
    }

    private function executeQuery($query, $params = []) {
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}