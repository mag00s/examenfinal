<?php
header('Content-Type: text/html; charset=utf-8');
// Your existing Database and ModelBBDD classes stay the same
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programación Orientada a Objetos</title>
    <style>
        :root {
            --primary: #3b82f6;
            --text: #1f2937;
            --background: #ffffff;
            --surface: #f3f4f6;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: var(--background);
            color: var(--text);
            line-height: 1.5;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .title-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .plant-icon {
            font-size: 2rem;
        }

        .title {
            font-size: 2rem;
            color: var(--text);
            font-weight: 600;
        }

        .doc-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .doc-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .doc-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        .main-content {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .search-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .search-form {
            display: flex;
            gap: 1rem;
        }

        .search-input {
            flex: 1;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            font-size: 1rem;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }

        .btn {
            padding: 0.75rem 1.5rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .queries-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        .section-title {
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
            color: var(--text);
        }

        .query-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .query-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem;
            border: 1px solid var(--border);
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .query-option:hover {
            background: var(--surface);
        }

        .results-section {
            background: white;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            overflow-x: auto;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th,
        .results-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .results-table th {
            background: var(--surface);
            font-weight: 600;
        }

        .results-table tr:hover {
            background: var(--surface);
        }

        .price-col {
            font-family: monospace;
            text-align: right;
        }

        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
            }
            
            .doc-links {
                flex-direction: column;
            }
        }
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
                       placeholder="Buscar productos..." 
                       value="<?= htmlspecialchars($busqueda ?? '') ?>">
                <button type="submit" class="btn">Buscar</button>
            </form>
        </section>

        <section class="queries-section">
            <h2 class="section-title">Consultas Disponibles</h2>
            <form method="GET" action="">
                <div class="query-options">
                    <label class="query-option">
                        <input type="radio" name="consulta" value="1" 
                               <?= ($consulta ?? '') === '1' ? 'checked' : '' ?>>
                        <span>Productos más caros por fabricante</span>
                    </label>
                    <label class="query-option">
                        <input type="radio" name="consulta" value="2"
                               <?= ($consulta ?? '') === '2' ? 'checked' : '' ?>>
                        <span>Resumen por fabricante</span>
                    </label>
                    <label class="query-option">
                        <input type="radio" name="consulta" value="3"
                               <?= ($consulta ?? '') === '3' ? 'checked' : '' ?>>
                        <span>Productos bajo precio medio</span>
                    </label>
                </div>
                <button type="submit" class="btn">Consultar Base de Datos</button>
            </form>
        </section>

        <?php if (isset($resultado) && $resultado && $resultado->rowCount() > 0): ?>
        <section class="results-section">
            <h2 class="section-title">Resultados</h2>
            <table class="results-table">
                <thead>
                    <tr>
                        <th>Fabricante</th>
                        <th>Producto</th>
                        <th>Precio Base</th>
                        <th>IVA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['fabricante']) ?></td>
                        <td><?= htmlspecialchars($row['producto'] ?? '-') ?></td>
                        <td class="price-col">€<?= number_format($row['base'] ?? 0, 2) ?></td>
                        <td class="price-col">€<?= number_format($row['iva'] ?? 0, 2) ?></td>
                        <td class="price-col">€<?= number_format($row['precio_total'] ?? 0, 2) ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
        <?php endif; ?>
    </main>
</body>
</html>