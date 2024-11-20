<main class="main-content">
    <div class="search-container">
        <!-- Búsqueda por Categorías -->
        <select name="categoria" id="categoriaSelect" onchange="submitForm(this, 'categoria')">
            <option value="">Seleccionar Categoría</option>
            <?php foreach($categorias as $cat): ?>
                <option value="<?= htmlspecialchars($cat['categoria']) ?>"
                    <?= ($_GET['q'] ?? '') === $cat['categoria'] && ($_GET['tipo'] ?? '') === 'categoria' ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['categoria']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Búsqueda por Lenguaje -->
        <select name="lenguaje" id="lenguajeSelect" onchange="submitForm(this, 'lenguaje')">
            <option value="">Seleccionar Lenguaje</option>
            <?php foreach($lenguajes as $lang): ?>
                <option value="<?= htmlspecialchars($lang['categoria']) ?>"
                    <?= ($_GET['q'] ?? '') === $lang['categoria'] && ($_GET['tipo'] ?? '') === 'lenguaje' ? 'selected' : '' ?>>
                    <?= htmlspecialchars($lang['categoria']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Búsqueda por Título -->
        <form method="GET" class="search-form">
            <input type="hidden" name="tipo" value="titulo">
            <input type="text" name="q" placeholder="Buscar por título..." 
                   value="<?= htmlspecialchars($_GET['q'] ?? '') ?>"
                   class="search-input">
            <button type="submit">Buscar</button>
        </form>
    </div>

    <!-- Tabla de Resultados -->
    <table class="results-table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Categoría</th>
                <th>Tipo</th>
                <th>Enlace</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($resultados && $resultados->rowCount() > 0): ?>
            <?php while ($row = $resultados->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($row['titulo']) ?></td>
                    <td><?= htmlspecialchars($row['nombre_categoria']) ?></td>
                    <td><?= htmlspecialchars($row['tipo_categoria']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">Visitar</a></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No se encontraron resultados</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>

<script>
function submitForm(select, tipo) {
    if (select.value) {
        window.location.href = `?tipo=${tipo}&q=${encodeURIComponent(select.value)}`;
    }
}
</script>