<?php include_once "layouts/header.php"; ?>

<main>
    <form method="get">
        <label for="category">Buscar por Categoría:</label>
        <input type="text" id="category" name="category" placeholder="Escribe una categoría">
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
            <?php if (!empty($enlaces)) : ?>
                <?php foreach ($enlaces as $enlace) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($enlace['titulo']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($enlace['url']); ?>" target="_blank">Visitar</a></td>
                        <td><?php echo htmlspecialchars($enlace['nombre_categoria']); ?></td>
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
