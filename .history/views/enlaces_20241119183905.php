// views/enlaces.php
<main class="main-content">
    <div class="search-container">
        <!-- Búsqueda por Categorías -->
        <div class="search-section">
            <h3>Búsqueda por Categoría</h3>
            <form method="GET" action="">
                <input type="hidden" name="tipo" value="categoria">
                <select name="q" class="category-select">
                    <option value="">Seleccionar Categoría</option>
                    <?php foreach($this->model->getCategorias() as $cat): ?>
                        <option value="<?= htmlspecialchars($cat['categoria']) ?>"
                            <?= ($_GET['q'] ?? '') === $cat['categoria'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['categoria']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Búsqueda por Lenguaje -->
        <div class="search-section">
            <h3>Búsqueda por Lenguaje</h3>
            <form method="GET" action="">
                <input type="hidden" name="tipo" value="lenguaje">
                <select name="q" class="language-select">
                    <option value="">Seleccionar Lenguaje</option>
                    <?php foreach($this->model->getLenguajes() as $lang): ?>
                        <option value="<?= htmlspecialchars($lang['categoria']) ?>"
                            <?= ($_GET['q'] ?? '') === $lang['categoria'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($lang['categoria']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Búsqueda por Título -->
        <div class="search-section">
            <h3>Búsqueda por Título</h3>
            <form method="GET" action="">
                <input type="hidden" name="tipo" value="titulo">
                <input type="text" name="q" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" 
                       placeholder="Buscar por título..." class="title-search">
                <button type="submit">Buscar</button>
            </form>
        </div>
    </div>

    <!-- Resultados -->
    <div class="results">
        <?php if ($resultados && $resultados->rowCount() > 0): ?>
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
                    <?php while ($row = $resultados->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['titulo']) ?></td>
                            <td><?= htmlspecialchars($row['nombre_categoria']) ?></td>
                            <td><?= htmlspecialchars($row['tipo_categoria']) ?></td>
                            <td><a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">Visitar</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-results">No se encontraron resultados</p>
        <?php endif; ?>
    </div>
</main>

// ModeloBDD.php additions
public function getCategorias() {
    $stmt = $this->db->query("SELECT DISTINCT categoria FROM categoria WHERE tipo != 'LENGUAJE' ORDER BY categoria");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getLenguajes() {
    $stmt = $this->db->query("SELECT DISTINCT categoria FROM categoria WHERE tipo = 'LENGUAJE' ORDER BY categoria");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Add CSS
<style>
.search-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.search-section {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.search-section h3 {
    margin-top: 0;
    color: #2c3e50;
}

select, input, button {
    width: 100%;
    padding: 0.5rem;
    margin: 0.5rem 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

button {
    background: #4a90e2;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background: #357abd;
}

.results table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
    background: white;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.results th, .results td {
    padding: 0.75rem;
    border: 1px solid #ddd;
    text-align: left;
}

.results th {
    background: #2c3e50;
    color: white;
}

.results tr:nth-child(even) {
    background: #f8f9fa;
}
</style>