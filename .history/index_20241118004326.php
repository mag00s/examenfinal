<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    private $host = "localhost";
    private $db_name = "tienda";
    private $username = "root";
    private $password = "";
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
                WHERE p.nombre LIKE :busqueda 
                   OR f.nombre LIKE :busqueda";
        
        $stmt = $this->conn->prepare($query);
        $busqueda = "%{$busqueda}%";
        $stmt->bindParam(':busqueda', $busqueda);
        $stmt->execute();
        return $stmt;
    }

    public function productosMasCaros() {
        $query = "SELECT 
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
                )";
        return $this->conn->query($query);
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

// Initialize
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="text-center mb-5">Programación Orientada a Objetos</h1>
        
        <!-- Search Form -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form method="GET" class="d-flex gap-2">
                    <input type="text" 
                           name="busqueda" 
                           class="form-control form-control-lg" 
                           placeholder="Buscar productos..."
                           value="<?= htmlspecialchars($busqueda) ?>">
                    <button type="submit" class="btn btn-primary btn-lg">Buscar</button>
                </form>
            </div>
        </div>

        <!-- Queries Section -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Consultas Disponibles</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET">
                            <div class="mb-3">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="consulta" id="q1" value="1" 
                                           <?= $consulta === '1' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="q1">
                                        Productos más caros por fabricante
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="consulta" id="q2" value="2"
                                           <?= $consulta === '2' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="q2">
                                        Resumen por fabricante
                                    </label>
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="consulta" id="q3" value="3"
                                           <?= $consulta === '3' ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="q3">
                                        Productos bajo precio medio
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Consultar Base de Datos</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <?php if ($resultado && $resultado->rowCount() > 0): ?>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Resultados</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php elseif ($busqueda || $consulta): ?>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert alert-warning text-center">
                        No se encontraron resultados para esta consulta
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>