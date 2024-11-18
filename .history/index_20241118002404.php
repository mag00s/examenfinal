<?php
class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function productosMasCaros() {
        $query = "WITH MaxPrecios AS (
                    SELECT fk_codigo, MAX(precio) as max_precio
                    FROM producto
                    GROUP BY fk_codigo
                )
                SELECT 
                    f.nombre AS fabricante,
                    p.nombre AS producto,
                    p.precio AS base,
                    ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                    ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                FROM fabricante f
                INNER JOIN producto p ON f.pk_codigo = p.fk_codigo
                INNER JOIN MaxPrecios mp ON p.fk_codigo = mp.fk_codigo AND p.precio = mp.max_precio
                CROSS JOIN parametros pa
                ORDER BY p.precio DESC";
        
        return $this->conn->query($query);
    }

    public function totalProductosPorFabricante() {
        $query = "SELECT 
                    f.nombre AS fabricante,
                    COUNT(p.id_producto) AS total_productos,
                    ROUND(MIN(p.precio), 2) AS precio_min,
                    ROUND(AVG(p.precio), 2) AS precio_medio,
                    ROUND(MAX(p.precio), 2) AS precio_max
                FROM fabricante f
                LEFT JOIN producto p ON f.pk_codigo = p.fk_codigo
                GROUP BY f.pk_codigo, f.nombre
                ORDER BY total_productos DESC";
        
        return $this->conn->query($query);
    }

    public function productosBajoPrecioMedio() {
        $query = "WITH PrecioMedio AS (
                    SELECT AVG(precio) as media FROM producto
                )
                SELECT 
                    f.nombre AS fabricante,
                    p.nombre AS producto,
                    p.precio AS base,
                    ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                    ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                FROM producto p
                JOIN fabricante f ON p.fk_codigo = f.pk_codigo
                CROSS JOIN parametros pa
                WHERE p.precio < (SELECT media FROM PrecioMedio)
                ORDER BY p.precio DESC";
        
        return $this->conn->query($query);
    }

    public function buscarProductos($busqueda) {
        $query = "SELECT 
                    f.nombre AS fabricante,
                    p.nombre AS producto,
                    p.precio AS base,
                    ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
                    ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
                FROM producto p
                JOIN fabricante f ON p.fk_codigo = f.pk_codigo
                CROSS JOIN parametros pa
                WHERE p.nombre LIKE :busqueda OR f.nombre LIKE :busqueda
                ORDER BY f.nombre, p.nombre";
        
        $stmt = $this->conn->prepare($query);
        $busqueda = "%{$busqueda}%";
        $stmt->bindParam(':busqueda', $busqueda);
        $stmt->execute();
        return $stmt;
    }
}