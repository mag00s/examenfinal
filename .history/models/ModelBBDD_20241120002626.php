<?php
/**
 * Clase: ModelBBDD
 * Descripción: Modelo principal para gestionar todas las operaciones con la base de datos
 * 
 * Ubicación: /models/ModelBBDD.php
 * Autor: [Tu Nombre]
 * Fecha: 19/11/2024
 * 
 * Propósito:
 * - Gestionar consultas a la vista vista_enlaces
 * - Proporcionar métodos para búsqueda por categoría, lenguaje y título
 * - Manejar la obtención de datos para el frontend
 */

require_once __DIR__ . '/../config/Database.php';

class ModelBBDD {
    private $conn;
    private $db;

    public function __construct() {
        $this->db = new Database();
        $this->conn = $this->db->getConnection();
    }

    /**
     * Obtiene todas las categorías únicas
     * @return array Lista de categorías
     */
    public function getCategorias() {
        try {
            $query = "SELECT DISTINCT nombre_categoria, tipo_categoria 
                     FROM vista_enlaces 
                     ORDER BY nombre_categoria";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener categorías: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Busca enlaces por categoría
     * @param string $categoria Nombre de la categoría
     * @return array Resultados de la búsqueda
     */
    public function buscarPorCategoria($categoria) {
        try {
            $query = "SELECT * FROM vista_enlaces WHERE nombre_categoria = :categoria";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':categoria', $categoria);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error en búsqueda por categoría: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene enlaces por lenguaje de programación
     * @return array Enlaces de tipo lenguaje
     */
    public function getLenguajes() {
        try {
            $query = "SELECT * FROM vista_enlaces 
                      WHERE tipo_categoria = 'LENGUAJE'
                      ORDER BY nombre_categoria";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener lenguajes: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Busca enlaces por texto en el título
     * @param string $texto Texto a buscar
     * @return array Resultados de la búsqueda
     */
    public function buscarPorTitulo($texto) {
        try {
            $busqueda = "%$texto%";
            $query = "SELECT * FROM vista_enlaces WHERE titulo LIKE :texto";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':texto', $busqueda);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error en búsqueda por título: " . $e->getMessage();
            return [];
        }
    }

    /**
     * Obtiene todos los enlaces
     * @return array Todos los enlaces
     */
    public function getTodos() {
        try {
            $query = "SELECT * FROM vista_enlaces";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error al obtener enlaces: " . $e->getMessage();
            return [];
        }
    }
}