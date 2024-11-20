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
            line-height: 1.6;
        }
        .results { margin-top: 20px; }
        .search-form {
            max-width: 500px;
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        select, input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .alert {
            padding: 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th { background-color: #f8f9fa; }
    </style>
</head>
<body>
    <h1>Buscador de Enlaces</h1>
    
    <form method="GET" class="search-form">
        <div class="form-group">
            <label for="tipo">Tipo de búsqueda</label>
            <select name="tipo" id="tipo" onchange="toggleSearch()">
                <option value="categoria">Por Categoría</option>
                <option value="lenguaje">Por Lenguaje</option>
                <option value="titulo">Por Título</option>
            </select>
        </div>
        
        <div class="form-group" id="searchField">
            <label for="q">Término de búsqueda</label>
            <input type="text" name="q" id="q">
        </div>
        
        <button type="submit">Buscar</button>
    </form>

    <div class="results">
        <?php if (isset($results)): ?>
            <?php if (empty($results)): ?>
                <div class="alert">No se encontraron resultados</div>
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
                                    <a href="<?php echo htmlspecialchars($link['url']); ?>" 
                                       target="_blank">Visitar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script>
        function toggleSearch() {
            const searchType = document.getElementById('tipo');
            const searchField = document.getElementById('searchField');
            searchField.style.display = searchType.value === 'lenguaje' ? 'none' : 'block';
        }
    </script>
</body>
</html>