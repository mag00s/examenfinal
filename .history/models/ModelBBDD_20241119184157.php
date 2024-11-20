<?php
/**
 * Ubicación: enlaces-project/models/ModeloBDD.php 
 * Modelo para gestionar las consultas a la base de datos enlaces
 */

class ModeloBDD {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Búsqueda General - Pregunta 1
     */
    public function buscarGeneral($query, $tipo) {
        $sql = "SELECT * FROM vista_enlaces WHERE 1=1";
        
        if (!empty($query)) {
            switch($tipo) {
                case 'titulo':
                    $sql .= " AND titulo LIKE :query";
                    break;
                case 'categoria':
                    $sql .= " AND nombre_categoria LIKE :query";
                    break;
                case 'tipo':
                    $sql .= " AND tipo_categoria LIKE :query";
                    break;
            }
        }

        $stmt = $this->db->prepare($sql);
        
        if (!empty($query)) {
            $queryParam = "%$query%";
            $stmt->bindParam(':query', $queryParam);
        }
        
        $stmt->execute();
        return $stmt;
    }

    /**
     * Métodos para Pregunta 2
     */
    public function getCategorias() {
        $sql = "SELECT DISTINCT categoria FROM categoria WHERE tipo != 'LENGUAJE' ORDER BY categoria";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLenguajes() {
        $sql = "SELECT DISTINCT categoria FROM categoria WHERE tipo = 'LENGUAJE' ORDER BY categoria";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorCategoria($categoria) {
        $sql = "SELECT * FROM vista_enlaces WHERE nombre_categoria = :categoria";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->execute();
        return $stmt;
    }

    public function buscarPorLenguaje($lenguaje) {
        $sql = "SELECT * FROM vista_enlaces WHERE nombre_categoria = :lenguaje AND tipo_categoria = 'LENGUAJE'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':lenguaje', $lenguaje);
        $stmt->execute();
        return $stmt;
    }
}