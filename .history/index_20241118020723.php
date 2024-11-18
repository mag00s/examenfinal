<?php
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    private $host = "localhost";
    private $db_name = "tienda";
    private $username = "root";
    private $password = "root";
    private $conn = null;

    public function getConnection() {
        try {
            $this->conn = new PDO(
                "mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}

class ModelBBDD {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
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
                WHERE LOWER(p.nombre) LIKE LOWER(:busqueda) 
                   OR LOWER(f.nombre) LIKE LOWER(:busqueda)";
        
        $stmt = $this->conn->prepare($query);
        $busqueda = "%{$busqueda}%";
        $stmt->bindParam(':busqueda', $busqueda);
        $stmt->execute();
        return $stmt;
    }

    public function productosMasCaros() {
        return $this->conn->query("SELECT 
            f.nombre AS fabricante,
            p.nombre AS producto,
            p.precio AS base,
            ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
            ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
        FROM producto p
        JOIN fabricante f ON p.fk_codigo = f.pk_codigo
        CROSS JOIN parametros pa
        WHERE (f.pk_codigo, p.precio) IN (
            SELECT fk_codigo, MAX(precio)
            FROM producto
            GROUP BY fk_codigo
        )");
    }

    public function totalProductosPorFabricante() {
        return $this->conn->query("SELECT 
            f.nombre AS fabricante,
            COUNT(*) as total,
            MIN(p.precio) AS precio_min,
            MAX(p.precio) AS precio_max,
            AVG(p.precio) AS precio_medio
        FROM fabricante f
        LEFT JOIN producto p ON f.pk_codigo = p.fk_codigo
        GROUP BY f.pk_codigo");
    }

    public function productosBajoPrecioMedio() {
        return $this->conn->query("SELECT 
            f.nombre AS fabricante,
            p.nombre AS producto,
            p.precio AS base,
            ROUND(p.precio * pa.porcentaje_iva, 2) AS iva,
            ROUND(p.precio * (1 + pa.porcentaje_iva), 2) AS precio_total
        FROM producto p
        JOIN fabricante f ON p.fk_codigo = f.pk_codigo
        CROSS JOIN parametros pa
        WHERE p.precio < (SELECT AVG(precio) FROM producto)");
    }
}

$database = new Database();
$db = $database->getConnection();
$model = new ModelBBDD($db);

$consulta = $_GET['consulta'] ?? '';
$busqueda = $_GET['busqueda'] ?? '';
$resultado = null;

if ($busqueda) {
    $resultado = $model->buscarProductos($busqueda);
} elseif ($consulta) {
    switch($consulta) {
        case '1': $resultado = $model->productosMasCaros(); break;
        case '2': $resultado = $model->totalProductosPorFabricante(); break;
        case '3': $resultado = $model->productosBajoPrecioMedio(); break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POO - Tienda</title>
    <style>
        body {
            font-family: system-ui, -apple-system, sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            background: #fff;
            color: #333;
        }
        .site-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .title-with-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        .doc-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .doc-link {
            color: #0d6efd;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        .search-container {
            max-width: 500px;
            margin: 0 auto 2rem;
        }
        .search-box {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            margin-bottom: 1rem;
        }
        .queries-section {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 1rem;
            margin-bottom: 2rem;
        }
        .query-option {
            padding: 0.5rem;
            cursor: pointer;
        }
        .submit-button {
            width: 100%;
            background: #0d6efd;
            color: white;
            border: none;
            padding: 0.75rem;
            border-radius: 4px;
            cursor: pointer;
        }
        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        .results-table th,
        .results-table td {
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .results-table th {
            background: #f8f9fa;
        }
        .section-title {
            margin-bottom: 1rem;
            color: #333;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="title-with-icon">
            <span role="img" aria-label="plant">🌱</span>
            <h1>Programación Orientada a Objetos</h1>
        </div>
        <div class="doc-links">
            <a href="README.md" class="doc-link" target="_blank">📖 README</a>
            <a href="DOCUMENTACION.md" class="doc-link" target="_blank">📑 Documentación</a>
        </div>
    </header>

    <main>
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" 
                       name="busqueda" 
                       class="search-box"
                       placeholder="Buscar productos..." 
                       value="<?= htmlspecialchars($busqueda) ?>">
                <button type="submit" class="submit-button">Buscar</button>
            </form>
        </div>

        <div class="queries-section">
            <h2 class="section-title">Consultas Disponibles</h2>
            <form method="GET" action="">
                <div class="query-option">
                    <input type="radio" name="consulta" id="q1" value="1" 
                           <?= $consulta === '1' ? 'checked' : '' ?>>
                    <label for="q1">Productos más caros por fabricante</label>
                </div>
                <div class="query-option">
                    <input type="radio" name="consulta" id="q2" value="2"
                           <?= $consulta === '2' ? 'checked' : '' ?>>
                    <label for="q2">Resumen por fabricante</label>
                </div>
                <div class="query-option">
                    <input type="radio" name="consulta" id="q3" value="3"
                           <?= $consulta === '3' ? 'checked' : '' ?>>
                    <label for="q3">Productos bajo precio medio</label>
                </div>
                <button type="submit" class="submit-button">Consultar Base de Datos</button>
            </form>
        </div>

        <?php if ($resultado && $resultado->rowCount() > 0): ?>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Fabricante</th>
                        <th>Producto</th>
                        <th>Precio Base</th>
                        <th>IVA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['fabricante']) ?></td>
                            <td><?= htmlspecialchars($row['producto'] ?? '-') ?></td>
                            <td>€<?= number_format($row['base'] ?? 0, 2) ?></td>
                            <td>€<?= number_format($row['iva'] ?? 0, 2) ?></td>
                            <td>€<?= number_format($row['precio_total'] ?? 0, 2) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php elseif ($busqueda || $consulta): ?>
            <div style="text-align: center; padding: 2rem; color: #856404; background: #fff3cd; border-radius: 4px;">
                No se encontraron resultados
            </div>
        <?php endif; ?>
    </main>
</body>
</html>