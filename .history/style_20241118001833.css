<?php
require_once 'config/Database.php';
require_once 'models/ModelBBDD.php';
require_once 'controllers/ProductoController.php';

$database = new Database();
$db = $database->getConnection();
$model = new ModelBBDD($db);

$consulta = isset($_GET['consulta']) ? $_GET['consulta'] : '';
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
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
} elseif ($busqueda) {
    $resultado = $model->buscarProductos($busqueda);
    $titulo = "Resultados de búsqueda: " . htmlspecialchars($busqueda);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌱 Tienda Informática</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🌱</text></svg>">
</head>
<body>
    <header class="main-header">
        <div class="header-content">
            <h1>🌱 Análisis de Productos</h1>
            <form class="search-form">
                <input type="text" 
                       name="busqueda" 
                       placeholder="Buscar productos..." 
                       value="<?= htmlspecialchars($busqueda) ?>"
                       class="search-input">
                <button type="submit" class="search-button">🔍</button>
            </form>
        </div>
    </header>

    <main class="main-content">
        <div class="queries-section">
            <form class="queries-form">
                <div class="radio-group">
                    <div class="query-option">
                        <input type="radio" id="query1" name="consulta" value="1" 
                               <?= $consulta === '1' ? 'checked' : '' ?>>
                        <label for="query1">📊 Productos más caros por fabricante</label>
                    </div>
                    
                    <div class="query-option">
                        <input type="radio" id="query2" name="consulta" value="2" 
                               <?= $consulta === '2' ? 'checked' : '' ?>>
                        <label for="query2">📈 Resumen por fabricante</label>
                    </div>
                    
                    <div class="query-option">
                        <input type="radio" id="query3" name="consulta" value="3" 
                               <?= $consulta === '3' ? 'checked' : '' ?>>
                        <label for="query3">💰 Productos bajo precio medio</label>
                    </div>
                </div>
                
                <button type="submit" class="submit-button">Consultar</button>
            </form>
        </div>

        <?php if ($resultado && $resultado->rowCount() > 0): ?>
            <section class="results-section">
                <h2><?= $titulo ?></h2>
                
                <?php if ($busqueda): ?>
                    <div class="table-container">
                        <table class="results-table">
                            <thead>
                                <tr>
                                    <th>Fabricante</th>
                                    <th>Producto</th>
                                    <th>Precio Base</th>
                                    <th>IVA</th>
                                    <th>Precio Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['fabricante']) ?></td>
                                    <td><?= htmlspecialchars($row['producto']) ?></td>
                                    <td>€<?= number_format($row['precio'], 2) ?></td>
                                    <td>€<?= number_format($row['iva'], 2) ?></td>
                                    <td>€<?= number_format($row['precio_total'], 2) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="cards-grid">
                        <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                            <article class="product-card">
                                <div class="card-header">
                                    <h3><?= htmlspecialchars($row['fabricante'] ?? $row['producto']) ?></h3>
                                </div>
                                <div class="card-body">
                                    <?php if (isset($row['total_productos'])): ?>
                                        <div class="stats-info">
                                            <p><strong>Total productos:</strong> <?= $row['total_productos'] ?></p>
                                            <p><strong>Precio medio:</strong> €<?= number_format($row['precio_medio'], 2) ?></p>
                                            <p><strong>Rango:</strong></p>
                                            <p>€<?= number_format($row['precio_minimo'], 2) ?> - €<?= number_format($row['precio_maximo'], 2) ?></p>
                                        </div>
                                    <?php else: ?>
                                        <p class="product-name"><?= htmlspecialchars($row['producto'] ?? '') ?></p>
                                        <p class="price-tag">€<?= number_format($row['precio_total'], 2) ?></p>
                                        <div class="price-details">
                                            <span>Base: €<?= number_format($row['precio'], 2) ?></span>
                                            <span>IVA: €<?= number_format($row['iva'], 2) ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </section>
        <?php elseif ($consulta || $busqueda): ?>
            <div class="no-results">
                <p>⚠️ No se encontraron resultados</p>
            </div>
        <?php endif; ?>
    </main>

    <footer class="main-footer">
        <div class="footer-content">
            <p>Desarrollado con 💚 por mag00s</p>
            <p class="footer-date"><?= date('Y') ?></p>
        </div>
    </footer>
</body>
</html>