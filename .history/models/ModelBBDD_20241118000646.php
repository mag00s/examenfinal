<?php
/**
 * Clase ModelBBDD
 * 
 * Modelo principal que gestiona todas las consultas a la base de datos.
 * Implementa los métodos de búsqueda requeridos para la tienda:
 * - Búsqueda por fabricante
 * - Búsqueda por tipo de producto
 * - Búsqueda por precio máximo
 * 
 * @author mag00s
 * @version 1.0
 */
class ModelBBDD {
    private $conn;

    /**
     * Constructor de la clase
     * 
     * @param PDO $db Conexión a la base de datos
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Busca productos por nombre de fabricante
     * 
     * @param string $fabricante Nombre del fabricante a buscar
     * @return PDOStatement Resultado de la consulta
     */
    public function buscarPorFabricante($fabricante) {
        try {
            // Consulta SQL con JOIN para obtener datos relacionados
            $query = "SELECT 
                        f.nombre AS fabricante,
                        p.nombre AS producto,
                        p.precio,
                        ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                        ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                     FROM fabricante f
                     JOIN producto p ON f.pk_codigo = p.fk_codigo
                     CROSS JOIN parametros pa
                     WHERE f.nombre LIKE :fabricante";
            
            $stmt = $this->conn->prepare($query);
            $fabricante = "%{$fabricante}%";
            $stmt->bindParam(":fabricante", $fabricante);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "🚫 Error en la búsqueda por fabricante: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Busca productos por tipo/nombre
     * 
     * @param string $tipo Tipo o nombre del producto a buscar
     * @return PDOStatement Resultado de la consulta
     */
    public function buscarPorTipo($tipo) {
        try {
            $query = "SELECT 
                        f.nombre AS fabricante,
                        p.nombre AS producto,
                        p.precio,
                        ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                        ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                     FROM producto p
                     JOIN fabricante f ON f.pk_codigo = p.fk_codigo
                     CROSS JOIN parametros pa
                     WHERE p.nombre LIKE :tipo";
            
            $stmt = $this->conn->prepare($query);
            $tipo = "%{$tipo}%";
            $stmt->bindParam(":tipo", $tipo);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "🚫 Error en la búsqueda por tipo: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Busca productos con precio menor al especificado
     * 
     * @param float $precio Precio máximo a buscar
     * @return PDOStatement Resultado de la consulta
     */
    public function buscarPorPrecioMenor($precio) {
        try {
            $query = "SELECT 
                        f.nombre AS fabricante,
                        p.nombre AS producto,
                        p.precio,
                        ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                        ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                     FROM producto p
                     JOIN fabricante f ON f.pk_codigo = p.fk_codigo
                     CROSS JOIN parametros pa
                     WHERE p.precio < :precio
                     ORDER BY p.precio ASC";
            
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":precio", $precio);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo "🚫 Error en la búsqueda por precio: " . $e->getMessage();
            return null;
        }
    }
}