<?php
// Vista de resultados
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados - Gestor de Enlaces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Gestor de Enlaces</a>
        </div>
    </nav>

    <div class="container">
        <div class="mb-4">
            <h2><?= htmlspecialchars($tipoBusqueda) ?></h2>
            <a href="/" class="btn btn-secondary">Nueva Búsqueda</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Título</th>
                        <th>Enlace</th>
                        <th>Categoría</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($resultados)): ?>
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron resultados</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($resultados as $resultado): ?>
                            <tr>
                                <td><?= htmlspecialchars($resultado['titulo']) ?></td>
                                <td>
                                    <a href="<?= htmlspecialchars($resultado['url']) ?>" 
                                       target="_blank"
                                       class="btn btn-sm btn-outline-primary">
                                        Visitar
                                    </a>
                                </td>
                                <td><?= htmlspecialchars($resultado['nombre_categoria']) ?></td>
                                <td>
                                    <span class="badge <?= $resultado['tipo_categoria'] === 'LENGUAJE' ? 'bg-success' : 'bg-info' ?>">
                                        <?= htmlspecialchars($resultado['tipo_categoria']) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>