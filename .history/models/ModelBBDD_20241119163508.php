<?php
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Query 1: Búsqueda por Categorías
    public function searchByCategory($category) {
        $query = "SELECT vinculos.id_vinculo, vinculos.titulo, vinculos.url, categorias.nombre_categoria
                  FROM vinculos
                  JOIN categorias ON vinculos.id_categoria = categorias.id_categoria
                  WHERE categorias.nombre_categoria LIKE :category";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Query 2: Búsqueda por Lenguaje de Programación
    public function searchByLanguage($language) {
        $query = "SELECT vinculos.id_vinculo, vinculos.titulo, vinculos.url, categorias.nombre_categoria
                  FROM vinculos
                  JOIN categorias ON vinculos.id_categoria = categorias.id_categoria
                  WHERE vinculos.titulo LIKE :language";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':language', $language, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Query 3: Búsqueda por Palabras en el Título
    public function searchByTitle($keyword) {
        $query = "SELECT vinculos.id_vinculo, vinculos.titulo, vinculos.url, categorias.nombre_categoria
                  FROM vinculos
                  JOIN categorias ON vinculos.id_categoria = categorias.id_categoria
                  WHERE vinculos.titulo LIKE :keyword";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':keyword', $keyword, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
