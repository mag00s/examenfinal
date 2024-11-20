<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Enlaces</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .search-form { max-width: 400px; margin: 20px 0; }
        select, input { width: 100%; padding: 8px; margin: 5px 0 15px; }
        button { 
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; text-align: left; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <h1>Buscador de Enlaces</h1>
    
    <form method="GET" class="search-form">
        <div>
            <label>Tipo de búsqueda</label>
            <select name="tipo" id="tipo" onchange="this.form.submit()">
                <option value="categoria" <?php echo $tipo === 'categoria' ? 'selected' : ''; ?>>Por Categoría</option>
                <option value="lenguaje" <?php echo $tipo === 'lenguaje' ? 'selected' : ''; ?>>Por Lenguaje</option>
                <option value="titulo" <?php echo $tipo === 'titulo' ? 'selected' : ''; ?>>Por Título</option>
            </select>
        </div>

        <?php if ($tipo !== 'lenguaje'): ?>
        <div>
            <label>Término de búsqueda</label>
            <?php if ($tipo === 'categoria' && !empty($categories)): ?>
                <select name="q">
                    <?php foreach($categories as $cat): ?>
                    <option value="<?php echo htmlspecialchars($cat['categoria']); ?>"
                            <?php echo isset($_GET['q']) && $_GET['q'] === $cat['categoria'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['categoria']); ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <input type="text" name="q" value="<?php echo htmlspecialchars($query); ?>">
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <button type="submit">Buscar</button>
    </form>

    <?php if (isset($results)): ?>
        <?php if (empty($results)): ?>
            <p>No se encontraron resultados</p>
        <?php else: ?>
            <table>
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
                            <a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank">Visitar</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>