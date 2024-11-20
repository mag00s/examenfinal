<?php
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllEnlaces() {
        $query = "SELECT * FROM vista_enlaces";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByCategory($category) {
        $query = "SELECT * FROM vista_enlaces WHERE nombre_categoria LIKE :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":category", $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
