<?php
header('Content-Type: text/html; charset=utf-8');
require_once "config/Database.php";
require_once "models/ModelBBDD.php";

$busqueda = $_GET['busqueda'] ?? '';
$consulta = $_GET['consulta'] ?? '';
$resultado = null;

if ($consulta && $busqueda) {
    $database = new Database();
    $db = $database->getConnection();
    $model = new ModelBBDD($db);

    switch ($consulta) {
        case '1': // Búsqueda por Categorías
            $resultado = $model->searchByCategory("%$busqueda%");
            break;
        case '2': // Búsqueda por Lenguaje de Programación
            $resultado = $model->searchByLanguage("%$busqueda%");
            break;
        case '3': // Búsqueda por Palabras en el Título
            $resultado = $model->searchByTitle("%$busqueda%");
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación Orientada a Objetos</title>
    <style>
        <!-- Keep all your existing CSS styles here -->
    </style>
</head>
<body>
    <header class="header">
        <div class="title-container">
            <span class="plant-icon">🌱</span>
            <h1 class="title">Programación Orientada a Objetos</h1>
        </div>
        <div class="doc-links">
            <a href="README.md" class="doc-link">
                📖 README
            </a>
            <a href="DOCUMENTACION.md" class="doc-link">
                📑 Documentación
            </a>
        </div>
    </header>

    <main class="main-content">
        <section class="search-section">
            <form class="search-form" method="GET" action="">
                <input type="text" 
                       name="busqueda" 
                       class="search-input"
                       placeholder="Introduce tu búsqueda..." 
                       value="<?= htmlspecialchars($busqueda) ?>">
                <button type="submit" class="btn">Buscar</button>
            </form>
        </section>

        <section class="queries-section">
            <h2 class="section-title">Consultas Disponibles</h2>
            <form method="GET" action="">
                <div class="query-options">
                    <label class="query-option">
                        <input type="radio" name="consulta" value="1" 
                               <?= $consulta === '1' ? 'checked' : '' ?>>
                        <span>Búsqueda por Categorías</span>
                    </label>
                    <label class="query-option">
                        <input type="radio" name="consulta" value="2"
                               <?= $consulta === '2' ? 'checked' : '' ?>>
                        <span>Búsqueda por Lenguaje de Programación</span>
                    </label>
                    <label class="query-option">
                        <input type="radio" name="consulta" value="3"
                               <?= $consulta === '3' ? 'checked' : '' ?>>
                        <span>Búsqueda por Palabras en el Título</span>
                    </label>
                </div>
                <button type="submit" class="btn">Consultar Base de Datos</button>
            </form>
        </section>

        <?php if ($resultado && $resultado->rowCount() > 0): ?>
        <section class="results-section">
            <h2 class="section-title">Resultados</h2>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>URL</th>
                        <th>Categoría</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['titulo']) ?></td>
                        <td><a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">Visitar</a></td>
                        <td><?= htmlspecialchars($row['nombre_categoria']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
        <?php else: ?>
        <section class="results-section">
            <h2 class="section-title">Resultados</h2>
            <p>No se encontraron resultados.</p>
        </section>
        <?php endif; ?>
    </main>
</body>
</html>
