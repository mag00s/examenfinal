<?php
/**
 * Página principal de la aplicación de Tienda
 * 
 * Esta página implementa la interfaz de usuario para:
 * - Búsqueda de productos por fabricante
 * - Búsqueda de productos por tipo
 * - Búsqueda de productos por precio máximo
 * 
 * @author mag00s
 * @version 1.0
 */

// Importar las clases necesarias
require_once 'config/Database.php';
require_once 'models/ModelBBDD.php';
require_once 'controllers/ProductoController.php';

// Inicializar la conexión y el controlador
$database = new Database();
$db = $database->getConnection();
$controller = new ProductoController($db);

// Obtener parámetros de búsqueda
$tipo = isset($_GET['tipo']) ? $_GET['tipo'] : '';
$valor = isset($_GET['valor']) ? $_GET['valor'] : '';
$resultado = null;

// Realizar búsqueda si hay parámetros
if ($tipo && $valor) {
    $resultado = $controller->buscarProductos($tipo, $valor);
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
    <div class="search-container">
        <h1>🌱 Buscador de Productos</h1>
        
        <!-- Formulario de búsqueda -->
        <form class="search-form">
            <div class="form-group">
                <label>Tipo de búsqueda:</label>
                <select name="tipo" class="form-control">
                    <option value="fabricante" <?= $tipo === 'fabricante' ? 'selected' : '' ?>>Por Fabricante</option>
                    <option value="tipo" <?= $tipo === 'tipo' ? 'selected' : '' ?>>Por Tipo de Producto</option>
                    <option value="precio" <?= $tipo === 'precio' ? 'selected' : '' ?>>Por Precio Menor que</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Valor de búsqueda:</label>
                <input type="text" name="valor" 
                       value="<?= htmlspecialchars($valor) ?>" 
                       class="form-control" 
                       placeholder="Ingrese su búsqueda...">
            </div>
            
            <button type="submit" class="btn-search">🔍 Buscar</button>
        </form>

        <!-- Tabla de resultados -->
        <?php if ($resultado && $resultado->rowCount() > 0): ?>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Fabricante</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>IVA</th>
                        <th>Total</th>
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
        <?php elseif ($tipo && $valor): ?>
            <div class="no-results">
                ⚠️ No se encontraron resultados para tu búsqueda.
            </div>
        <?php endif; ?>

        <footer class="footer">
            <p>Desarrollado por mag00s 🌱</p>
        </footer>
    </div>
</body>
</html>