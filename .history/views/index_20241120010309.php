<?php
// Vista principal
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Enlaces</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Gestor de Enlaces</a>
        </div>
    </nav>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Búsqueda por Categoría</h5>
                    </div>
                    <div class="card-body">
                        <form action="/buscar" method="POST">
                            <input type="hidden" name="tipo" value="categoria">
                            <select name="valor" class="form-select mb-3" required>
                                <option value="">Seleccionar categoría</option>
                                <?php foreach($categorias as $cat): ?>
                                    <option value="<?= htmlspecialchars($cat['nombre_categoria']) ?>">
                                        <?= htmlspecialchars($cat['nombre_categoria']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Lenguajes de Programación</h5>
                    </div>
                    <div class="card-body">
                        <form action="/buscar" method="POST">
                            <input type="hidden" name="tipo" value="lenguaje">
                            <button type="submit" class="btn btn-primary">Mostrar Lenguajes</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Búsqueda por Título</h5>
                    </div>
                    <div class="card-body">
                        <form action="/buscar" method="POST">
                            <input type="hidden" name="tipo" value="titulo">
                            <input type="text" name="valor" class="form-control mb-3" placeholder="Buscar en títulos..." required>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>