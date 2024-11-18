<?php if ($resultado && $resultado->rowCount() > 0): ?>
<div class="container pb-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <h3 class="h5 mb-0">Resultados</h3>
                    <span class="badge bg-primary"><?= $resultado->rowCount() ?> resultados</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 500px;">
                        <table class="table table-hover mb-0">
                            <thead class="table-light sticky-top">
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
                                    <td>€<?= number_format($row['base'] ?? 0, 2) ?></td>
                                    <td>€<?= number_format($row['iva'] ?? 0, 2) ?></td>
                                    <td class="fw-bold">€<?= number_format($row['precio_total'] ?? 0, 2) ?></td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php elseif (isset($busqueda) || isset($consulta)): ?>
<div class="container pb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="alert alert-warning text-center" role="alert">
                No se encontraron resultados para esta consulta
            </div>
        </div>
    </div>
</div>
<?php endif; ?>