<?php
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function searchByCategory($category) {
        $query = "SELECT * FROM vista_enlaces WHERE nombre_categoria LIKE :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public function searchByLanguage($language) {
        $query = "SELECT * FROM vista_enlaces WHERE lenguaje LIKE :language";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':language', $language, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }

    public function searchByTitle($title) {
        $query = "SELECT * FROM vista_enlaces WHERE titulo LIKE :title";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt;
    }
}
?>
