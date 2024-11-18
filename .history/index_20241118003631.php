<?php
// Use absolute paths to prevent include errors
define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/config/Database.php';
require_once BASE_PATH . '/models/ModelBBDD.php';
require_once BASE_PATH . '/controllers/ProductoController.php';

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $database = new Database();
    $db = $database->getConnection();
    $model = new ModelBBDD($db);

    $consulta = isset($_GET['consulta']) ? $_GET['consulta'] : '';
    $busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
    $resultado = null;

    if ($consulta) {
        switch($consulta) {
            case '1': $resultado = $model->productosMasCaros(); break;
            case '2': $resultado = $model->totalProductosPorFabricante(); break;
            case '3': $resultado = $model->productosBajoPrecioMedio(); break;
        }
    } elseif ($busqueda) {
        $resultado = $model->buscarProductos($busqueda);
    }
} catch (Exception $e) {
    die("Error en la aplicación: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación Orientada a Objetos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Programación Orientada a Objetos</h1>
        
        <form method="GET" action="">
            <div class="search-box">
                <input type="text" 
                       name="busqueda" 
                       class="search-input"
                       placeholder="Buscar productos..." 
                       value="<?= htmlspecialchars($busqueda) ?>">
            </div>

            <div class="consultas-section">
                <h2 class="consultas-title">Consultas Disponibles</h2>
                
                <div class="radio-group">
                    <label class="radio-option">
                        <input type="radio" name="consulta" value="1" 
                               <?= $consulta === '1' ? 'checked' : '' ?>>
                        <span>Productos más caros por fabricante</span>
                    </label>

                    <label class="radio-option">
                        <input type="radio" name="consulta" value="2" 
                               <?= $consulta === '2' ? 'checked' : '' ?>>
                        <span>Resumen por fabricante</span>
                    </label>

                    <label class="radio-option">
                        <input type="radio" name="consulta" value="3" 
                               <?= $consulta === '3' ? 'checked' : '' ?>>
                        <span>Productos bajo precio medio</span>
                    </label>
                </div>

                <button type="submit" class="submit-button">
                    Consultar Base de Datos
                </button>
            </div>
        </form>

        <?php if (isset($resultado) && $resultado && $resultado->rowCount() > 0): ?>
            <div class="results">
                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="result-item">
                        <h3><?= htmlspecialchars($row['fabricante'] ?? '') ?></h3>
                        <?php if (isset($row['producto'])): ?>
                            <p><?= htmlspecialchars($row['producto']) ?></p>
                            <p>Precio: €<?= number_format($row['precio'], 2) ?></p>
                        <?php endif; ?>
                        
                        <?php if (isset($row['total_productos'])): ?>
                            <p>Total productos: <?= $row['total_productos'] ?></p>
                            <p>Precio medio: €<?= number_format($row['precio_medio'], 2) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php elseif (isset($resultado)): ?>
            <div class="no-results">
                <p>No se encontraron resultados</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>