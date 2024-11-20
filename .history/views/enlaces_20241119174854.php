<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación Orientada a Objetos</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="header">
        <h1 class="title">Programación Orientada a Objetos</h1>
    </header>
    <main class="main-content">
        <form method="GET">
            <input type="text" name="busqueda" placeholder="Buscar..." value="<?= htmlspecialchars($busqueda) ?>">
            <div>
                <label><input type="radio" name="consulta" value="1" <?= $consulta === '1' ? 'checked' : '' ?>> Búsqueda por Categorías</label>
                <label><input type="radio" name="consulta" value="2" <?= $consulta === '2' ? 'checked' : '' ?>> Búsqueda por Lenguaje</label>
                <label><input type="radio" name="consulta" value="3" <?= $consulta === '3' ? 'checked' : '' ?>> Búsqueda por Título</label>
            </div>
            <button type="submit">Consultar</button>
        </form>
        <section>
            <h2 class="section-title">Resultados</h2>
            <?php if ($resultado && $resultado->rowCount() > 0): ?>
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
            <?php else: ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
