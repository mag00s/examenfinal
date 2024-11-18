<?php
/**
 * Modelo para consultas específicas de la tienda
 * Aquí se implementan las tres consultas principales:
 * 1. Productos más caros por fabricante
 * 2. Total de productos por fabricante
 * 3. Productos por debajo del precio medio
 */
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Consulta 1: Obtiene el producto más caro de cada fabricante
     */
    public function productosMasCaros() {
        try {
            $query = "SELECT 
                        f.nombre AS fabricante,
                        p.nombre AS producto,
                        p.precio,
                        ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                        ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                    FROM fabricante f
                    INNER JOIN producto p ON f.pk_codigo = p.fk_codigo
                    CROSS JOIN parametros pa
                    WHERE (f.pk_codigo, p.precio) IN (
                        SELECT fk_codigo, MAX(precio)
                        FROM producto
                        GROUP BY fk_codigo
                    )
                    ORDER BY p.precio DESC";
            
            return $this->conn->query($query);
        } catch (PDOException $e) {
            echo "Error en consulta 1: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Consulta 2: Cuenta total de productos por fabricante
     */
    public function totalProductosPorFabricante() {
        try {
            $query = "SELECT 
                        f.nombre AS fabricante,
                        COUNT(p.id_producto) AS total_productos,
                        ROUND(AVG(p.precio), 2) AS precio_medio,
                        MIN(p.precio) AS precio_minimo,
                        MAX(p.precio) AS precio_maximo
                    FROM fabricante f
                    LEFT JOIN producto p ON f.pk_codigo = p.fk_codigo
                    GROUP BY f.pk_codigo, f.nombre
                    ORDER BY total_productos DESC";
            
            return $this->conn->query($query);
        } catch (PDOException $e) {
            echo "Error en consulta 2: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Consulta 3: Productos por debajo del precio medio
     */
    public function productosBajoPrecioMedio() {
        try {
            $query = "WITH precio_medio AS (
                        SELECT AVG(precio) AS media FROM producto
                    )
                    SELECT 
                        f.nombre AS fabricante,
                        p.nombre AS producto,
                        p.precio,
                        ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                        ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total,
                        (SELECT media FROM precio_medio) AS precio_medio
                    FROM producto p
                    JOIN fabricante f ON p.fk_codigo = f.pk_codigo
                    CROSS JOIN parametros pa
                    WHERE p.precio < (SELECT media FROM precio_medio)
                    ORDER BY p.precio DESC";
            
            return $this->conn->query($query);
        } catch (PDOException $e) {
            echo "Error en consulta 3: " . $e->getMessage();
            return null;
        }
    }
}