<div class="main-container">
    <h1 class="main-title">Programación Orientada a Objetos</h1>
    <div class="content-card">
        <form class="query-form" method="GET" action="index.php">
            <div class="search-section">
                <input type="text" 
                       name="busqueda" 
                       placeholder="Buscar productos..." 
                       class="search-input" 
                       value="<?= htmlspecialchars($busqueda ?? '') ?>">
            </div>

            <div class="queries-section">
                <h2 class="section-title">Consultas Disponibles</h2>
                <div class="query-options">
                    <label class="query-option">
                        <input type="radio" name="consulta" value="1" <?= ($consulta ?? '') === '1' ? 'checked' : '' ?>>
                        <span>Productos más caros por fabricante</span>
                    </label>

                    <label class="query-option">
                        <input type="radio" name="consulta" value="2" <?= ($consulta ?? '') === '2' ? 'checked' : '' ?>>
                        <span>Resumen por fabricante</span>
                    </label>

                    <label class="query-option">
                        <input type="radio" name="consulta" value="3" <?= ($consulta ?? '') === '3' ? 'checked' : '' ?>>
                        <span>Productos bajo precio medio</span>
                    </label>
                </div>
                <button type="submit" class="submit-button">Consultar Base de Datos</button>
            </div>
        </form>
    </div>
</div>