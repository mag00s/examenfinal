/**
 * Vista: Results
 * Descripción: Página de resultados de búsqueda
 * 
 * Ubicación: /views/results.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

require_once 'layout/header.php';
?>

<div class="mb-4">
    <h2><?= htmlspecialchars($tipoBusqueda) ?></h2>
    <a href="/" class="btn btn-secondary">Nueva Búsqueda</a>
</div>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Enlace</th>
                <th>Categoría</th>
                <th>Tipo</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($resultados)): ?>
                <tr>
                    <td colspan="4" class="text-center">No se encontraron resultados</td>
                </tr>
            <?php else: ?>
                <?php foreach($resultados as $resultado): ?>
                    <tr>
                        <td><?= htmlspecialchars($resultado['titulo']) ?></td>
                        <td>
                            <a href="<?= htmlspecialchars($resultado['url']) ?>" target="_blank">
                                Visitar
                            </a>
                        </td>
                        <td><?= htmlspecialchars($resultado['nombre_categoria']) ?></td>
                        <td><?= htmlspecialchars($resultado['tipo_categoria']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php
require_once 'layout/footer.php';