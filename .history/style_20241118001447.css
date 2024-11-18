<?php
/**
 * Página principal con selección de consultas predefinidas
 * Muestra resultados en formato de tarjetas
 */
require_once 'config/Database.php';
require_once 'models/ModelBBDD.php';
require_once 'controllers/ProductoController.php';

$database = new Database();
$db = $database->getConnection();
$model = new ModelBBDD($db);

$consulta = isset($_GET['consulta']) ? $_GET['consulta'] : '';
$resultado = null;

if ($consulta) {
    switch($consulta) {
        case '1':
            $resultado = $model->productosMasCaros();
            $titulo = "Productos más caros por fabricante";
            break;
        case '2':
            $resultado = $model->totalProductosPorFabricante();
            $titulo = "Resumen por fabricante";
            break;
        case '3':
            $resultado = $model->productosBajoPrecioMedio();
            $titulo = "Productos bajo el precio medio";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌱 Consultas Tienda</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🌱</text></svg>">
</head>
<body>
    <div class="container">
        <h1 class="main-title">🌱 Análisis de Productos</h1>
        
        <form class="query-form">
            <div class="radio-group">
                <div class="radio-option">
                    <input type="radio" id="query1" name="consulta" value="1" <?= $consulta === '1' ? 'checked' : '' ?>>
                    <label for="query1">🏷️ Productos más caros por fabricante</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="query2" name="consulta" value="2" <?= $consulta === '2' ? 'checked' : '' ?>>
                    <label for="query2">📊 Resumen por fabricante</label>
                </div>
                
                <div class="radio-option">
                    <input type="radio" id="query3" name="consulta" value="3" <?= $consulta === '3' ? 'checked' : '' ?>>
                    <label for="query3">💰 Productos bajo precio medio</label>
                </div>
            </div>
            
            <button type="submit" class="btn-consultar">Consultar 🔍</button>
        </form>

        <?php if ($resultado && $resultado->rowCount() > 0): ?>
            <h2 class="results-title"><?= $titulo ?></h2>
            <div class="cards-container">
                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <div class="card">
                        <?php if ($consulta === '1'): ?>
                            <h3><?= htmlspecialchars($row['fabricante']) ?></h3>
                            <p class="product-name"><?= htmlspecialchars($row['producto']) ?></p>
                            <p class="price">€<?= number_format($row['precio_total'], 2) ?></p>
                            <div class="price-details">
                                <span>Base: €<?= number_format($row['precio'], 2) ?></span>
                                <span>IVA: €<?= number_format($row['iva'], 2) ?></span>
                            </div>
                        <?php elseif ($consulta === '2'): ?>
                            <h3><?= htmlspecialchars($row['fabricante']) ?></h3>
                            <div class="stats">
                                <p>Total productos: <?= $row['total_productos'] ?></p>
                                <p>Precio medio: €<?= number_format($row['precio_medio'], 2) ?></p>
                                <p>Rango: €<?= number_format($row['precio_minimo'], 2) ?> - €<?= number_format($row['precio_maximo'], 2) ?></p>
                            </div>
                        <?php else: ?>
                            <h3><?= htmlspecialchars($row['producto']) ?></h3>
                            <p class="manufacturer"><?= htmlspecialchars($row['fabricante']) ?></p>
                            <p class="price">€<?= number_format($row['precio_total'], 2) ?></p>
                            <div class="price-details">
                                <p>Precio medio: €<?= number_format($row['precio_medio'], 2) ?></p>
                                <p>Diferencia: €<?= number_format($row['precio_medio'] - $row['precio'], 2) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php elseif ($consulta): ?>
            <div class="no-results">
                ⚠️ No se encontraron resultados
            </div>
        <?php endif; ?>

        <footer class="footer">
            <p>Desarrollado por mag00s 🌱</p>
        </footer>
    </div>
</body>
</html>