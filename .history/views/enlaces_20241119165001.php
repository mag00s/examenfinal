<?php include_once "layouts/header.php"; ?>

<main>
    <h2>Consultas Disponibles</h2>
    <form method="get">
        <!-- Select Query Type -->
        <label for="query">Selecciona una consulta:</label>
        <select id="query" name="query" required>
            <option value="category">Búsqueda por Categorías</option>
            <option value="language">Búsqueda por Lenguaje de Programación</option>
            <option value="keyword">Búsqueda por Palabras en el Título</option>
        </select>

        <!-- Input Search Term -->
        <label for="term">Introduce un término de búsqueda:</label>
        <input type="text" id="term" name="term" placeholder="Introduce un término" required>

        <!-- Submit Button -->
        <button type="submit">Consultar</button>
    </form>

    <!-- Display Results -->
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>URL</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)) : ?>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['titulo']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['url']); ?>" target="_blank">Visitar</a></td>
                        <td><?php echo htmlspecialchars($row['nombre_categoria']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3">No se encontraron resultados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>


<?php include_once "layouts/footer.php"; ?>
