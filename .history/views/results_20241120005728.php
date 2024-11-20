<?php
/**
 * Vista: results.php
 * Descripción: Página de resultados de búsqueda
 * 
 * Ubicación: /views/results.php
 * Autor: mag00s
 * Fecha: 19/11/2024
 */

include __DIR__ . '/layout/header.php';
?>

<div class="mb-4">
    <h2><?= htmlspecialchars($tipoBusqueda ?? 'Resultados de búsqueda') ?></h2>
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
                            <a href="<?= htmlspecialchars($resultado['url']) ?>" 
                               target="_blank"
                               class="btn btn-sm btn-outline-primary">
                                Visitar
                            </a>
                        </td>
                        <td><?= htmlspecialchars($resultado['nombre_categoria']) ?></td>
                        <td>
                            <span class="badge <?= $resultado['tipo_categoria'] === 'LENGUAJE' ? 'bg-success' : 'bg-info' ?>">
                                <?= htmlspecialchars($resultado['tipo_categoria']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/layout/footer.php'; ?>