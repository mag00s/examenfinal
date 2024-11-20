<?php include_once "layouts/header.php"; ?>

<main>
    <form method="get">
        <label for="category">Buscar por Categoría:</label>
        <input type="text" id="category" name="category" placeholder="Escribe una categoría">
        <button type="submit">Buscar</button>
    </form>

    <form method="get">
        <label for="language">Buscar por Lenguaje de Programación:</label>
        <input type="text" id="language" name="language" placeholder="Escribe un lenguaje">
        <button type="submit">Buscar</button>
    </form>

    <form method="get">
        <label for="keyword">Buscar por Palabras en el Título:</label>
        <input type="text" id="keyword" name="keyword" placeholder="Escribe una palabra clave">
        <button type="submit">Buscar</button>
    </form>

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
