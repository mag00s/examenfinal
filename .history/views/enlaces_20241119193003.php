<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador de Enlaces</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .search-form {
            max-width: 400px;
            margin: 20px 0;
        }
        select, input, button {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Buscador de Enlaces</h1>
    
    <form class="search-form">
        <div>
            <label>Tipo de búsqueda</label>
            <select name="tipo" id="tipo">
                <option value="categoria">Por Categoría</option>
                <option value="lenguaje">Por Lenguaje</option>
                <option value="titulo">Por Título</option>
            </select>
        </div>
        
        <div id="searchDiv">
            <label>Término de búsqueda</label>
            <?php if($tipo === 'categoria'): ?>
                <select name="q">
                    <?php foreach($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['nombre_categoria']); ?>">
                            <?php echo htmlspecialchars($cat['nombre_categoria']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            <?php else: ?>
                <input type="text" name="q" id="q">
            <?php endif; ?>
        </div>
        
        <button type="submit">Buscar</button>
    </form>

    <div>
        <?php if (empty($results)): ?>
            <p>No se encontraron resultados</p>
        <?php else: ?>
            <table border="1" style="width: 100%">
                <tr>
                    <th>Título</th>
                    <th>Categoría</th>
                    <th>Tipo</th>
                    <th>Enlace</th>
                </tr>
                <?php foreach ($results as $link): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($link['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($link['nombre_categoria']); ?></td>
                        <td><?php echo htmlspecialchars($link['tipo_categoria']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($link['url']); ?>" target="_blank">Visitar</a></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>