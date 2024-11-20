<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enlaces Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <main class="container mt-4">
        <h1 class="mb-4">Buscador de Enlaces</h1>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="index.php" method="GET" class="card p-3">
                    <div class="mb-3">
                        <label for="searchType" class="form-label">Tipo de búsqueda</label>
                        <select name="tipo" id="searchType" class="form-select" required>
                            <option value="categoria">Por Categoría</option>
                            <option value="lenguaje">Por Lenguaje</option>
                            <option value="titulo">Por Título</option>
                        </select>
                    </div>
                    
                    <div class="mb-3" id="searchTermDiv">
                        <label for="searchTerm" class="form-label">Término de búsqueda</label>
                        <input type="text" name="q" id="searchTerm" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>
        </div>

        <div class="results-section">
            <?php if (isset($results) && empty($results)): ?>
                <div class="alert alert-info">No se encontraron resultados</div>
            <?php elseif (isset($results)): ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Tipo</th>
                            <th>Enlace</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $link): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($link['titulo']); ?></td>
                                <td><?php echo htmlspecialchars($link['nombre_categoria']); ?></td>
                                <td><?php echo htmlspecialchars($link['tipo_categoria']); ?></td>
                                <td>
                                    <a href="<?php echo htmlspecialchars($link['url']); ?>" 
                                       target="_blank" 
                                       class="btn btn-sm btn-primary">
                                        Visitar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </main>

    <script src="assets/js/main.js"></script>
</body>
</html>